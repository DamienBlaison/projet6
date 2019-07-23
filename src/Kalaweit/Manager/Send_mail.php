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

function send_mailold($p_to,$p_subject,$p_body){
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    //Load Composer's autoloader
    require_once __DIR__ . '/../../../vendor/autoload.php';

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    //$mail->setLanguage($langcode = 'fr', $lang_path = './../../../vendor/phpmailer/phpmailer/language/');

    try {
        //Server settings
        //$mail->SMTPDebug = 2;

        $mail->CharSet = "UTF-8";
        // Enable verbose debug output
        $mail->isSMTP();                                        // Set mailer to use SMTP


        $mail->Host = 'smtp.ionos.fr';
        //$mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        //$mail->Username = 'kalaweit.backoffice@gmail.com';      // SMTP username
        $mail->Username ='damien.blaison@projet-bd-open-classroom.fr';
        //$mail->Password = 'kalaweit.backoffice57';                      // SMTP password
        $mail->Password = 'Projet-bd-open-classroom57100!';                      // SMTP password

        $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
        //$mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                      // TCP port to connect to

        //Recipients
        //$mail->setFrom('kalaweit.backoffice@gmail.com');
        $mail->setFrom('damien.blaison@projet-bd-open-classroom.fr');

        $mail->addAddress($p_to);                               // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $p_subject;
        $mail->Body    = $p_body;
        $mail->AltBody = strip_tags($p_body);

        $mail->send();

        echo '<script>alert("Le message a bien été envoyé")</script>';

    } catch ( \PHPMailer\PHPMailer\Exception $e) {

        echo '<script>
        alert("Le Message n\'a pas pu être envoyé. \nErreur:\n'. $mail->ErrorInfo.'");
        </script>';

    }
}
