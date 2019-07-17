<?php
namespace Site\Controller;

/**
*
*/
class Maj_password

{

    function render(){

        $aside = (new \Site\View\Aside())->render();

        $content = [

            "aside" => $aside
        ];


        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        $token = $_GET['token'];

        $sso_token = new \Kalaweit\Manager\Sso_token('',$token,$bdd);

        $login = $sso_token->get_login();

        if($login === false){

            (new \Site\View\Link_dead())->render($content);
        }

        else{

            if(isset($_POST['new_password']) && isset($_POST["new_password_confirm"])){

                if($_POST['new_password'] === $_POST["new_password_confirm"]){

                    (new \Kalaweit\Manager\Member($bdd))->maj_password($login["ptok_email"],$_POST["new_password"]);

                    header("location: /www/Connexion");

                    $sso_token->delete();

                } else {

                    echo '<script> alert("Les mots de passe sont différents, merci de recommencer"); </script>';

                }

            }

            (new \Site\View\Maj_password())->render($content);
        }
    }
}
