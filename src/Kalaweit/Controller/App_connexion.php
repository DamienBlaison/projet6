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

            /* appelle de la methode de verification */

            $check = (new \Kalaweit\Manager\Users($bdd))->log_in($_POST['login'],$_POST['password']);

            /* si verif ok on rentre dans l'application sinon un message d'erreur apparait et on ai rediriger vers la page de connexion*/

            if ($check == 1){

                $_SESSION["user_login"] = $_POST['login'];

                header("location: /www/Kalaweit/member/list/1");
            }
            else {

                (new \Kalaweit\View\App_connexion\Log_in("",""))->render();
                echo "<script>alert('Login ou mot de passe manquant(s) ou eronné(s)')</script>";

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
}
 ?>
