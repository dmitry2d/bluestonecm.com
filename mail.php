<?php

$reCaptchaPublicKey = "6LcE4zAfAAAAAJqo8MheGrC1LnKqfgThVm49YdWb";
$reCaptchaSecretKey = "6LcE4zAfAAAAALtk1N6VKn4RGJijvpBWax1ALsTc";

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
        $sent = mail (
            $to,
            $subject,
            $body,
            'From: info@bluestonecm.com' . "\r\n" .
            'Reply-To: info@bluestonecm.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" . 
            'Content-type:text/html; charset=UTF-8' . "\r\n".
            'X-Mailer: PHP/' . phpversion()
        );

        // $sent = mail (
        //     "volcharo@gmail.com",
        //     "Hello man",
        //     "lol then",
        //     'From: info@bluestonecm.com'
        // );


        $response['success'] = 1;
        $response['sent'] = $sent;
        $response['message'] = 'Success';
    } else {
        $response['message'] = 'Recaptcha fail';
    }

} else {
    $response['message'] = 'Form data fail';
}

echo json_encode ($response);

exit;



if (isset($_POST['username']) && $_POST['username'] && isset($_POST['password']) && $_POST['password']) {
    // do user authentication as per your requirements 
    // ... 
    // ... 
    // based on successful authentication 
    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
}
?>