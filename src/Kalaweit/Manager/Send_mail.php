<?php

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

function send_mail($p_to,$p_subject,$p_body){
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
//Load Composer's autoloader
require '../vendor/autoload.php';

$mail = new \PHPMailer\PHPMailer\PHPMailer(true);                                 // Passing `true` enables exceptions

$mail->setLanguage($langcode = 'fr', $lang_path = '../vendor/phpmailer/phpmailer/language/');

try {
    //Server settings
    //$mail->SMTPDebug = 2;                                   // Enable verbose debug output
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
    //$mail->Host = 'smtp.ionos.fr';                         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
    $mail->Username = 'kalaweit.backoffice@gmail.com';      // SMTP username
    //$mail->Username ='damien.blaison@projet-bd-open-classroom.fr';
    $mail->Password = '**************';                      // SMTP password
    //$mail->Password = '**************';                      // SMTP password

    $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
    //$mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                      // TCP port to connect to

    //Recipients
    $mail->setFrom('kalaweit.backoffice@gmail.com');
    //$mail->setFrom('damien.blaison@projet-bd-open-classroom.fr');

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
    echo '<script> alert("Le Message n\'a pas pu être envoyé. \nErreur:\n'. $mail->ErrorInfo.'")</script>';
}
}
