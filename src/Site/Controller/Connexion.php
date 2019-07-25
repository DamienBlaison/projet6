<?php
    namespace Site\Controller;

    /**
     *
     */
    class Connexion

        {

            function render(){

                /* instanciation de la connexion a la bdd */

                $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

                /* verification de la presence du login et du mdp dans le formulaire lors de l envoi de la demande de connexion*/

                if ( isset($_POST['login']) && isset($_POST['password'] )) {

                    /* appelle de la methode de verification */

                    $check = (new \Kalaweit\Manager\Member($bdd))->log_in();
                }




            $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();;

            $aside = (new \Site\View\Aside())->render();

            $info_member = [

            "login"      => (new \Site\htmlElement\Form_group_input('login','text,','Identifiant','','fa fa-lock','required'))->render(),
            "password"   => (new \Site\htmlElement\Form_group_input('password','password','Mot de passe', '','fa fa-lock','required'))->render(),
            "submit"     => (new \Site\htmlElement\Form_group_btn('submit','btn-form ','receipt_btn','Enregistrer'))->render()


        ];

        $content = [

            "param" =>$info_member,
            "aside" => $aside
        ];



        return (new \Site\View\Connexion())->render($content);

        }
    }

 ?>
