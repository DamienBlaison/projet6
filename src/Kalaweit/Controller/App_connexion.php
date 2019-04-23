<?php

namespace Kalaweit\Controller;

class App_connexion
{

    function log_in(){

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        if ( isset($_POST['login']) && isset($_POST['password']) ) {

            $check = (new \Kalaweit\Manager\Users($bdd))->log_in($_POST['login'],$_POST['password']);

            if ($check == 1){

                $_SESSION["user_login"] = $_POST['login'];
                //$_SESSION["user_id"] = (new \Kalaweit\Manager\Users($bdd))->get_id_from_Login($_POST['login']);
                //$_SESSION["sess_id"]= 1;

                header("location: http://localhost:8888/www/Kalaweit/member/list/1");
            }
            else {

                (new \Kalaweit\View\App_connexion\Log_in("",""))->render();
                echo "<script>alert('Login ou mot de passe eronné')</script>";

            }

        }

        else {

            (new \Kalaweit\View\App_connexion\Log_in("",""))->render();
        }

    }

    function log_out()
    {
        session_destroy();
        header("location:http://localhost:8888/www/Kalaweit/app_connexion/log_in" );
    }
}
 ?>
