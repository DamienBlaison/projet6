<?php namespace Kalaweit\Manager;

class Users
{
    use \Kalaweit\Transverse\Get_param_request;

    function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    function add(){

        $check_account = $this->bdd->prepare("SELECT user_login FROM sso_user WHERE user_login= :user_login");
        $prepare_check = [":user_login"=>$_POST["user_login"]];
        $check_account->execute($prepare_check);
        $check = $check_account->fetch();

        if($check["user_login"]== FALSE){

            $reqprep = $this->bdd->prepare(

                "INSERT INTO

                sso_user (user_login,user_password,user_email,user_first_name,user_last_name,user_title,user_preferred_language,user_avatar,user_active)

                VALUES

                (:user_login,
                    :user_password,
                    :user_email,
                    :user_first_name,
                    :user_last_name,
                    :user_title,
                    :user_preferred_language,
                    '/Documents/Avatar/Unknown_PersonH.png',
                    1);

            ");

            $prepare =[

                ":user_login" => $_POST["user_login"],
                ":user_password" => password_hash('temp',PASSWORD_BCRYPT),
                ":user_email" => $_POST["user_email"],
                ":user_first_name" => $_POST["user_first_name"],
                ":user_last_name" => $_POST["user_last_name"],
                ":user_title" => $_POST["user_title"],
                ":user_preferred_language" => $_POST["user_preferred_language"]

            ];
        
            $reqprep->execute($prepare);

            $max_user = $this->bdd->query("SELECT MAX(user_id) FROM sso_user");
            $max_user->execute();

            $new_user = $max_user->fetch();

            header("Location: /www/Kalaweit/Users/update?user_id=".$new_user[0]);

        }

        else

        {
            echo "<script> alert('Un compte existe déjà avec ce Login, merci d'en choisir un autre) </script>";
        };

    }

    function update(){

        if(isset($_POST)) {

            $save_submit = array_pop($_POST);

            switch ($save_submit) {

                case 'Enregistrer':

                echo '<script> alert("je suis bien ici");</script>';

                $p_dir = '/Documents/Avatar/';
                $p_file_to_upload = 'avatar';
                $p_extension = ['png','jpeg','jpg','gif','png'];
                $p_size = 10000000;

                (new \Kalaweit\Manager\File($p_dir,$p_file_to_upload,$p_extension,$p_size))->upload_file("sso_user","user_avatar","user_id",$_GET["user_id"]);

                break;

                case 'Sauvegarder les informations':

                    $prepare = [];
                    $set = '';

                    foreach ($_POST as $key => $value) {

                        $param = [
                            ':'.$key => $value

                        ];

                        $set .= $key.' = :'.$key.' , ';

                        $prepare = array_merge($prepare,$param);

                    }

                    $set = substr($set, 0 , -2);

                    $prepare = array_merge($prepare,[":user_id" => $_GET["user_id"]]);

                    $reqprep = $this->bdd->prepare("UPDATE sso_user SET $set WHERE user_id = :user_id");

                    $reqprep->execute($prepare);


                    break;

                    case 'Envoyer nouveau mot de passe':
                    echo '<script> alert("modif password")</script>';
                    break;

                    case 'Envoyer':

                    require '../src/Kalaweit/Manager/Send_mail.php';

                    $to = $this->get();


                    send_mail($to['user_email'],$_POST["subject"],$_POST["mail_body"]);

                    break;

                    case 'Désactiver le compte':

                    $reqprep = $this->bdd->prepare("UPDATE sso_user SET user_active = 0 WHERE user_id= :user_id" );
                    $prepare = [":user_id" => $_GET["user_id"]];
                    $reqprep->execute($prepare);

                    echo '<script> alert("Ce compte a bien été désactivé")</script>';

                    break;

                    case 'Activer le compte':

                    $reqprep = $this->bdd->prepare("UPDATE sso_user SET user_active = 1 WHERE user_id= :user_id" );
                    $prepare = [":user_id" => $_GET["user_id"]];
                    $reqprep->execute($prepare);

                    echo '<script> alert("Ce compte a bien été activé")</script>';
                    break;

                }



            }


            $user  = $this->get();

            return $user;

        }

    function get()

    {
        $reqprep = $this->bdd->prepare("SELECT * FROM sso_user WHERE user_id = :user_id");

        $prepare = [":user_id" => $_GET["user_id"]];

        $reqprep->execute($prepare);

        $user = $reqprep->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    function get_id_from_Login($login)
    {

        // ***************************************************************************** //

        $reqprep = $this->bdd->prepare("SELECT * FROM sso_user WHERE user_login = :user_login");

        $prepare = [":user_login" => $login];

        $reqprep->execute($prepare);

        $user = $reqprep->fetch(\PDO::FETCH_ASSOC);

        return $user;
    }

    function get_list(){

        $param_request = $this->get_param_request();

        $where = '';
        $prepare =[];

        $url = explode('?',$_SERVER['REQUEST_URI']);

        $slice_url = explode('/',$url[0]);

        $page = array_pop($slice_url);

        if($page == 1){ $filter = 0 ;} else { $filter = (($page - 1) * 12); };

        if(isset($param_request[0])){

            foreach ($param_request[0] as $key => $value) {
                if($value != ''){
                    $where .= ' AND '.$key.' LIKE :'.$key ;
                    $prepare = array_merge($prepare,[':'.$key => '%'.$_GET["$key"].'%']);

                }
            }

        }


        $reqprep = $this->bdd->prepare( "SELECT   user_id, user_login, user_email, user_first_name, user_last_name,user_active FROM sso_user WHERE 1=1 $where LIMIT $filter,12");
        $reqprepcount = $this->bdd->prepare( "SELECT COUNT(user_id)  FROM sso_user WHERE 1=1 $where");

        $reqprep->execute($prepare);
        $reqprepcount->execute($prepare);


        $count = $reqprepcount->fetch(\PDO::FETCH_NUM);

        $list = [

            "head" => ["Id","Login","Email","Prénom","Nom","Actif"],
            "content" => $reqprep->fetchAll(\PDO::FETCH_NUM),
            "count" => $count

        ];

        return $list ;
    }

    function log_in($login,$password){

        $reqprep = $this->bdd->prepare("SELECT  user_password FROM sso_user WHERE user_login = :login AND user_active = 1");

        $prepare = [

            ":login" => $login,
        ];

        $reqprep->execute($prepare);

        $pwd = $reqprep->fetch(\PDO::FETCH_NUM);


        if(isset($pwd[0])){

            $check = password_verify($password, $pwd[0]);

            if($check == true) { $data = 1 ;}

            else { $data = 0 ;};

            return $data;

        } else {

            $data = 'login_nok';

            return $data;

        }
    }

    function delete(){

        $reqprep = $this->bdd->prepare("DELETE FROM sso_user WHERE user_id = :user_id");

        $prepare =[

            ":user_id" => $_GET["user_id"]

        ];

        $reqprep->execute($prepare);

        header("Location:".$_SERVER['HTTP_REFERER']);

    }

    function maj_pwd($user_mail,$password){

        $reqprep = $this->bdd->prepare("UPDATE sso_user SET user_password =:password WHERE user_login= :email ");
        $prepare =[
            ":password" => password_hash($password,PASSWORD_BCRYPT),
            ":email" => $user_mail
    ];

        $reqprep->execute($prepare);

    }

    function check_login($login){

        $reqprep = $this->bdd->prepare("SELECT user_id FROM sso_user WHERE user_login = :user_login");
        $prepare =[
            ":user_login" => $login,
        ];

        $reqprep->execute($prepare);

        $check = $reqprep->fetch(\PDO::FETCH_NUM);

        if (isset($check[0])){ $return = 1;} else { $return = 0;};

        return $return;

    }

}
