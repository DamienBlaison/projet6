<?php

/* classe permettant le paramétarge de l'envoi des mails */

namespace Kalaweit\Controller\Component\Member;

class Member_send_mail
{
    function render(){

        /* verification de la présence d'un mail a envoyer */

        if (isset($_POST["send_message"])){

            /* instanciation de la connexion a la bdd */

            $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

            /* récupération de l'email du membre */

            $to = (new \Kalaweit\Manager\Member($bdd))->get_mail();

            /* import de la clase gérant l'envoi de mail */

            require '../src/Kalaweit/Manager/Send_mail.php';

            /* envoi du mail en passant les infos de destinatiares de sujet et de contenu */

            send_mail($to["cld_valc"],$_POST["subject"],$_POST["mail_body"]);

        };

        /* affihage du composant HTML Box send mail */

        return (new \Kalaweit\htmlElement\Box_send_mail())->render();
    }

}




 ?>
