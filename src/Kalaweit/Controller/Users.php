<?php
/* classe permettant de gérer les infos liées au utilisateurs de l'application */

namespace Kalaweit\Controller;

class Users
{
    /* intégration du trait Get_param_request pour récupération des filtres eventuellemnt appliqués et ou a appliquer */

    use \Kalaweit\Transverse\Get_param_request;

    /* methode  permettant de récupérer la liste des utilisateurs */

    function get_list(){

        /* instanciation du composant Table user */

        $p_render = (new \Kalaweit\Controller\Component\Users\Table_users)->render();

        /* instanciation de la vue avec comme parametre l'opbjet precedement crée */

        return (new \Kalaweit\View\Table\Table_filter)->render($p_render);

    }

    /* methode  permettant d'ajouter un nouvel utilisateur */

    function add(){

        /* instanciation de la connexio a la BDD */

        $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

        /* verification de la présence des elements des données dans POST pour permettre la création del'utilsateur */

        if
        (
            ((isset($_POST["user_login"]))&&($_POST["user_login"])!= '')&&
            ((isset($_POST["user_password"]))&&($_POST["user_password"])!='')&&
            ((isset($_POST["user_first_name"]))&&($_POST['user_first_name'])!='')&&
            ((isset($_POST["user_last_name"]))&&($_POST['user_last_name'])!='')&&
            ((isset($_POST["user_email"]))&&($_POST['user_email'])!='')
        )
            /* si toute les conditions sont remplies alors on crée l'utilsateur en bdd via la methode add() du manager */

            {

                (new \Kalaweit\Manager\Users($bdd))->add();

            }

            /* sinon on affiche une alerte */

            else {

                echo "<script> alert('au moins un des champs n\'est pas renseigné')</script>";
            }

            /* récupéraiton des elements de config a passer dans le formaulaire*/

            $gender = (new \Kalaweit\Manager\Gender())->getAll();
            $lang  = (new \Kalaweit\Manager\Cli_lang())->getAll();

            /* création d'un tableau d'élément HTML à passer à la vue */

            $box_identification_content =
            [
                $user_title = (new \Kalaweit\htmlElement\Form_group_select("user_title",$gender,"","fa fa-venus-mars","config"))->render(),
                $firstname = (new \Kalaweit\htmlElement\Form_group_input("user_first_name","Prénom","","fa fa-user"))->render(),
                $lastname = (new \Kalaweit\htmlElement\Form_group_input("user_last_name","Nom","","fa fa-user"))->render(),
                $mail = (new \Kalaweit\htmlElement\Form_group_input("user_email","Email","","fa fa-at"))->render(),
                $login = (new \Kalaweit\htmlElement\Form_group_input("user_login","Login","","fa fa-lock"))->render(),
                $password = (new \Kalaweit\htmlElement\Form_group_input("user_password","Password","","fa fa-lock"))->render(),

                $lang = (new \Kalaweit\htmlElement\Form_group_select("user_preferred_language",$lang,"","fa fa-commenting","config"))->render(),
                $submit_identification = (new \Kalaweit\htmlElement\Form_group_btn("submit","btn btn-primary pull-right","submit_identification","Ajouter cet utilisateur"))->render()

            ];

            $param = [

                "box_identification" => (new \Kalaweit\htmlElement\Box("Informations utilisateur","box-primary",$box_identification_content,""))->render(),

            ];

            return (new \Kalaweit\View\Users\Add_user())->render($param);

        }

    /* methode  permettant la MAJ d'un utilisateur */

        function update(){

            /* instanciation de la connexio a la BDD */

            $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

            /* application de la méthode permettant la maj au chargement de la page (si il y a des infos dans le post -> MAJ) */

            (new \Kalaweit\Manager\Users($bdd))->update();

            /* instanciation de l'objet Users , application de la methode get pour cibler un user en particulier */

            $user = (new \Kalaweit\Manager\Users($bdd))->get();

            /* récupéraiton des elements de config a passer dans le formaulaire*/

            $gender = (new \Kalaweit\Manager\Gender())->getAll();
            $lang  = (new \Kalaweit\Manager\Cli_lang())->getAll();

            /* création d'un tableau d'élément HTML à passer à la vue */

            $box_identification_content =
            [
                $user_title = (new \Kalaweit\htmlElement\Form_group_select("user_title",$gender,$user["user_title"],"fa fa-venus-mars","config"))->render(),
                $firstname = (new \Kalaweit\htmlElement\Form_group_input("user_first_name","Prénom",$user["user_first_name"],"fa fa-user"))->render(),
                $lastname = (new \Kalaweit\htmlElement\Form_group_input("user_last_name","Nom",$user["user_last_name"],"fa fa-user"))->render(),
                $mail = (new \Kalaweit\htmlElement\Form_group_input("user_email","Email",$user["user_email"],"fa fa-at"))->render(),
                $lang = (new \Kalaweit\htmlElement\Form_group_select("user_preferred_language",$lang,$user["user_preferred_language"],"fa fa-commenting","config"))->render(),
                $submit_identification = (new \Kalaweit\htmlElement\Form_group_btn("submit","btn btn-primary pull-right","submit_identification","Sauvegarder les informations"))->render()

            ];

            /* création d'un tableau d'élément HTML à passer à la vue */

            $box_init_mdp_content =
            [
                $mail = (new \Kalaweit\htmlElement\Form_group_input("Password","Nouveau mot de passe","","fa fa-lock"))->render(),
                $mdp_submit = (new \Kalaweit\htmlElement\Form_group_btn("submit","btn btn-primary col-md-12","new_password","Envoyer nouveau mot de passe"))->render()
            ];

            /* création d'un tableau d'élément HTML à passer à la vue */

            $box_download_avatar_content =
            [
                $avatar_img = (new \Kalaweit\htmlElement\Img($user["user_avatar"],$user["user_first_name"],'avatar_user_admin'))->render(),
                $avatar_link = '<a href="http://localhost:8888/www/Kalaweit/users/crop?user_id='.$_GET['user_id'].'" class="btn btn-primary col-md-12">Modifier l\'Avatar</a>'
            ];

            /* création d'un tableau d'élément HTML à passer à la vue */

            $box_avatar_img_content = [

                $avatar_img = (new \Kalaweit\htmlElement\Img('/Documents/Avatar/GRENADINE_2018_00473.JPG','Damien Blaison','avatar_user_admin', ' max-width:250px;max-height: 250px;'))->render()


            ];

            /* création d'un tableau d'élément HTML à passer à la vue */

            if($user["user_active"] == 1){

                $box_activation_account_content = [

                    $activation_activate = (new \Kalaweit\htmlElement\Form_group_btn("submit","btn btn-danger col-md-12","account_desactivation","Désactiver le compte"))->render()

                ];

            } else {

                $box_activation_account_content = [

                    $activation_activate = (new \Kalaweit\htmlElement\Form_group_btn("submit","btn btn-success col-md-12","account_activation","Activer le compte"))->render(),

                ];
            };

            /* Synthese des elements à passer a la vue */

            $param = [

                "box_identification" => (new \Kalaweit\htmlElement\Box("Informations utilisateur","box-primary",$box_identification_content,""))->render(),
                "box_init_password"  => (new \Kalaweit\htmlElement\Box("Réinitialisation de mot de passe","box-primary",$box_init_mdp_content,""))->render(),
                "box_init_avatar"    => (new \Kalaweit\htmlElement\Box("Avatar","box-primary",$box_download_avatar_content,""))->render(),
                "box_avatar"         => (new \Kalaweit\htmlElement\Box("Image du profil","box-primary",$box_avatar_img_content,""))->render(),
                "box_activation"     => (new \Kalaweit\htmlElement\Box("Activation/désactivation","box-primary",$box_activation_account_content,""))->render()

            ];

            /* instanciation de la vue avec comme param le tableau précédement créé */

            return (new \Kalaweit\View\Users\User())->render($param);

        }

        /* methode  permettant la suppression d'un utilisateur */

        function delete(){

            /* instanciation de la connexio a la BDD */

            $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

            /* instanciation de l'objet Users et application de la methode delete */

            (new \Kalaweit\Manager\Users($bdd))->delete();

        }

        /* methode  permettant la MAJ de l'avatar d'un utilisateur */

        function crop(){

            (new \Kalaweit\View\Users\Crop_avatar())->render();

        }

    }
