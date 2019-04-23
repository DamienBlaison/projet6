<?php
namespace Kalaweit\Controller\Component\Users;

/**
 *
 */
class Table_users
{
    use \Kalaweit\Transverse\Get_param_request;

    function render(){

        $param_request = $this->Get_param_request();

        $bddM = new \Kalaweit\Manager\Connexion();
        $bddM = $bddM->getBdd();

        //$member         = new \Kalaweit\Model\Member();
        $userM        = new \Kalaweit\Manager\Users($bddM);

        $list = $userM->get_list($param_request);

        $request = '';

        if(isset($list[5])){
            $page = $list[5];
        }else{
            $page = 1;
        }

        if(isset($_GET['user_first_name'])){ $user_first_name = $_GET['user_first_name'];} else { $user_first_name = '';};
        if(isset($_GET['user_last_name'])){ $user_last_name = $_GET['user_last_name'];} else { $user_last_name = '';};
        if(isset($_GET['user_active'])){ $user_active = $_GET['user_active'];} else { $user_active = '';};
        if(isset($_GET['user_email'])){ $user_email = $_GET['user_email'];} else { $user_email = '';};
        if(isset($_GET['user_login'])){ $user_login = $_GET['user_login'];} else { $user_login = '';};

        $fields =

        [

            [
                "type_balise"   => 'input',
                "id"            => 'user_first_name',
                "type"          => 'text',
                "name"          => 'user_first_name',
                "placeholder"   => 'Prénom',
                "class"         => '6',
                "value"         =>  $user_first_name
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'user_last_name',
                "type"          => 'text',
                "name"          => 'user_last_name',
                "placeholder"   => 'Nom',
                "class"         => '6',
                "value"         =>  $user_last_name
            ]
            ,

            [
                "type_balise"   => 'input',
                "id"            => 'user_login',
                "type"          => 'text',
                "name"          => 'user_login',
                "placeholder"   => 'login',
                "class"         => '3',
                "value"         =>  $user_login
            ]

            ,

            [
                "type_balise"   => 'input',
                "id"            => 'user_email',
                "type"          => 'text',
                "name"          => 'user_email',
                "placeholder"   => 'email',
                "class"         => '3',
                "value"         =>  $user_email
            ]

            ,


            [
                "type_balise"   => 'input',
                "id"            => 'user_active',
                "type"          => 'text',
                "name"          => 'user_active',
                "placeholder"   => 'Actif = 1, inactif = 0',
                "class"         => '4',
                "value"         =>  $user_active
            ]

        ];

        $data =[
            "table"             => $list["content"],
            "head"              => $list["head"],
            "count"             => $list["count"][0],
            "title"             => "Liste des utilisateurs"
        ];

        $id = "list_users_filtered";

        return $p_render = [
            "fields"     => $fields ,
            "data"       => $data,
            "id"         => $id
        ];
    }

}
