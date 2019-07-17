<?php
/* classe permettant de gérer la connexion/deconnexion à l'application */

namespace Kalaweit\Controller;

class App_connexion
{
    /* methode gérant la connexion a l'applcation */

    function log_in(){

        /* instanciation de la connexion a la bdd */

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        /* verification de la presence du login et du mdp dans le formulaire lors de l envoi de la demande de connexion*/

        if ( isset($_POST['login']) && isset($_POST['password']) ) {

            if($_POST['login']=='' || $_POST['password']==''){

                echo "<script>alert('Login ou mot de passe manquant')</script>";

                (new \Kalaweit\View\App_connexion\Log_in("",""))->render();

            } else {


                /* appelle de la methode de verification */

                $check = (new \Kalaweit\Manager\Users($bdd))->log_in($_POST['login'],$_POST['password']);


                /* si verif ok on rentre dans l'application sinon un message d'erreur apparait et on ai rediriger vers la page de connexion*/

                switch ($check) {
                    case '1':

                    $_SESSION["user_login"] = $_POST['login'];

                    header("location: /www/Kalaweit/dashboard/get");

                    break;

                    case '0':

                    echo "<script>alert('Mot de passe eronné');</script>";

                    (new \Kalaweit\View\App_connexion\Log_in("",""))->render();

                    break;

                    default:

                    echo "<script>alert('Ce compte n\'existe pas !');</script>";

                    (new \Kalaweit\View\App_connexion\Log_in("",""))->render();

                    break;
                }

            }

        }

        /* si les variables du post ne sont pas definies on redirige vers la page de connexion */

        else {

            (new \Kalaweit\View\App_connexion\Log_in("",""))->render();

        }

    }

    /* methode gérant la connexion a l'applcation */

    function log_out()
    {
        /* on detruit les variables de session */

        session_destroy();

        /* redirection vers la page de connexion */

        header("location:/www/Kalaweit/app_connexion/log_in" );
    }

    function forgotten_pwd(){

        if(isset($_POST['login'])){

            $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

            $check = (new \Kalaweit\Manager\Users($bdd))->check_login($_POST["login"]);

            if($check == 1){

                $p_to = $_POST["login"];
                $p_subject = 'Reintialisation du mot de passe';
                $token = md5(uniqid());

                (new \Kalaweit\Manager\Sso_token($_POST["login"],$token,$bdd))->add();

                $p_body = "
                <p>
                Bonjour,
                </p>
                <p>
                vous avez souhaitez réinitialiser votre mot de passe .
                <p>
                </p>
                Merci de cliquer sur le lien ci dessous :
                </p>
                <p><a href='http://localhost:8888/www/Kalaweit/app_connexion/maj_pwd?token=$token'>http://localhost:8888/www//Kalaweit/app_connexion/maj_pwd?token=$token</a>
                </p>
                <br>
                <p>Ce lien sera valable 24 heures.</p>

                <br>
                <p>Cordialement</p>
                <p>Kalaweit Administration</p>

                ";

                require_once(__DIR__ .'/../Manager/Send_mail.php');

                send_mail($p_to,$p_subject,$p_body);

                header("location: /www/Kalaweit/app_connexion/log_in");

            }

            else {

                echo '<script> alert("Ce compte n\'existe pas !");</script>';
            }

        }

        (new \Kalaweit\View\App_connexion\Forgotten_pwd("",""))->render();
    }

    function maj_pwd(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        $token = $_GET['token'];

        $sso_token = new \Kalaweit\Manager\Sso_token('',$token,$bdd);

        $login = $sso_token->get_login();

        if($login === false){

            (new \Kalaweit\View\App_connexion\Link_dead())->render();
        }

        else {

            if(isset($_POST['new_password']) && isset($_POST["new_password_confirm"])){

                if($_POST['new_password'] === $_POST["new_password_confirm"]){

                    (new \Kalaweit\Manager\Users($bdd))->maj_pwd($login["ptok_email"],$_POST["new_password"]);

                    header("location: /www/Kalaweit/app_connexion/log_in");

                } else {

                    echo '<script> alert("Les mots de passe sont différents, merci de recommencer"); </script>';

                }


            }

            (new \Kalaweit\View\App_connexion\Maj_pwd())->render();

        }

    }
}
?>
