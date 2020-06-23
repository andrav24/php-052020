<?php

$form['recipient'] = $_POST['recipient'];
$form['message'] = $_POST['message'];
$form['theme'] = $_POST['theme'];
if (!empty($_FILES['attachment']['tmp_name'])) {
    $form['file'] = $_FILES['attachment']['tmp_name'];
    $form['file_name'] = $_FILES['attachment']['name'];
}

try {

// Create the Transport
    $transport = (new Swift_SmtpTransport(MAIL_HOST, MAIL_PORT, MAIL_ENCRYPTION))
        ->setUsername(MAIL_USERNAME)
        ->setPassword(MAIL_PASSWORD)
    ;

// Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

// Create a message
    $message = (new Swift_Message($form['theme']))
        ->setFrom([ADMIN_EMAIL => ADMIN_EMAIL])
        ->setTo([$form['recipient']])
        ->setBody($form['message']);
    if (isset($form['file_name'])) {
        $message = $message->attach(new Swift_Attachment($form['file'], $form['file_name']));
    }

// Send the message
    $result = $mailer->send($message);
    if ($result) {
        echo '<a href="index.php">Главная</a><br><br>Письмо отправлено.';
    } else {
        echo '<a href="index.php">Главная</a><br><br>При отправке письма произошла ошибка.';
    }
} catch (Exception $e) {
    var_dump($e->getMessage());
    echo '<pre>' . print_r($e->getTrace(), 1);
}
