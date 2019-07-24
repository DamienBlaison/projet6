<?php

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

function send_mail($p_to,$p_subject,$p_body){


    require_once __DIR__ . '/../../../vendor/autoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    $mail->CharSet = "UTF-8";

    //echo '<pre>';
    //var_dump($mail);
    //echo '</pre>';

    //Set who the message is to be sent from
    $mail->setFrom('kalaweit.backoffice@gmail.com', 'Kalaweit-admin');

    //Set an alternative reply-to address
    //$mail->addReplyTo('replyto@example.com', 'First Last');

    //Set who the message is to be sent to
    $mail->addAddress($p_to);

    //Set the subject line
    $mail->Subject = $p_subject;

    //Read an HTML message body from an external file, convert referenced images to embedded,

    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML($p_body);

    //Replace the plain text body with one created manually
    $mail->AltBody = $p_body;


    //echo '<pre>';
    //var_dump($mail);
    //echo '</pre>';
    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo '<script>
        alert("Le Message n\'a pas pu être envoyé. \nErreur:\n'. $mail->ErrorInfo.'");
        </script>';

    } else {
        echo '<script>alert("Le message a bien été envoyé")</script>';
    }

}
