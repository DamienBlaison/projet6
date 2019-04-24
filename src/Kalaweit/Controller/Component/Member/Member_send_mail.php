<?php
namespace Kalaweit\Controller\Component\Member;

/**
 *
 */


class Member_send_mail
{
    function render(){

        if (isset($_POST["send_message"])){

            $bdd = (new \Kalaweit\Manager\Connexion())->getBdd();

            $to = (new \Kalaweit\Manager\Member($bdd))->get_mail();

            require '../src/Kalaweit/Manager/Send_mail.php';

            send_mail($to["cld_valc"],$_POST["subject"],$_POST["mail_body"]);

        };

        return (new \Kalaweit\htmlElement\Box_send_mail())->render();
    }

}




 ?>
