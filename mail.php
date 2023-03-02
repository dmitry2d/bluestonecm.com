<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/bluestonecm/www/PHPMailerTest/PHPMailer/src/Exception.php';
require '/home/bluestonecm/www/PHPMailerTest/PHPMailer/src/PHPMailer.php';
require '/home/bluestonecm/www/PHPMailerTest/PHPMailer/src/SMTP.php';
require '/home/bluestonecm/www/mail_form_credentials.php';

$response = array ('success' => 0, 'message' => 'Mail sent fail');


if (isset($_POST['contact_firstname'], $_POST['contact_lastname'], $_POST['contact_email'])){
    
    $recaptcha = false;
    $recaptcha_input = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
    . $reCaptchaSecretKey . '&response=' . $recaptcha_input;
    $recaptcha_response = file_get_contents($url);
    $recaptcha_response = json_decode($recaptcha_response);
    if ($recaptcha_response->success == true) {
        $recaptcha = true;
    };
    if ($recaptcha) {
        $firstname = $_POST['contact_firstname'];
        $lastname = $_POST['contact_lastname'];
        $email = $_POST['contact_email'];
        $phone = $_POST['contact_phone'] ?? "-";
        $message = $_POST['contact_message'] ?? "-";
        // $to = "info@bluestonecm.com";

        $to = "volcharo@gmail.com";
        $subject = "New contact message from Bluestone";
        $body = "First Name: " . $firstname . "\r\nLast Name: " . $lastname . "\r\nEmail: " . $email . "\r\nPhone: " . $phone . "\r\nMessage: " . $message;
        try {
            $mail = new PHPMailer(true);
            // $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isMail(); // Set mailer to use SMTP
            $mail->Host = 'localhost'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $mailUserName; // SMTP username
            $mail->Password = $mailUserPass; // SMTP password
            $mail->Port = 587; // TCP port to connect to
        
            $mail->setFrom('info@alphacrypto.capital', 'Bluestone Site');
            $mail->addAddress('brian@bluestonecm.com', 'Owner'); // Add a recipient
            $mail->addAddress('volcharo@gmail.com', 'Admin'); // Add a recipient
            $mail->addAddress('tddragon@gmail.com', 'TDD'); // Add a recipient
            $mail->addReplyTo('volcharo@gmail.com', 'Admin');
        //  $mail->addCC('cc@example.com');
        //  $mail->addBCC('bcc@example.com');
            $mail->isHTML(false); // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            $response['success'] = 1;
            $response['message'] = 'Success';
        } catch (Exception $e) {
            $response['message'] = $e;
        }
    } else {
        $response['message'] = 'Recaptcha fail';
    }

} else {
    $response['message'] = 'Form data fail';
}


echo json_encode ($response);

exit;


