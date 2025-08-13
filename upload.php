<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sturox528@gmail.com';
        $mail->Password = 'zxea rbhu uunf txwb';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('sturox528@gmail.com', 'Print Service Website');
        $mail->addAddress('sturox528@gmail.com');

        if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
            $mail->addAttachment($_FILES['document']['tmp_name'], $_FILES['document']['name']);
        }
        if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == 0) {
            $mail->addAttachment($_FILES['receipt']['tmp_name'], $_FILES['receipt']['name']);
        }

        $mail->isHTML(true);
        $mail->Subject = 'New Print Order Upload';
        $mail->Body = "<b>Name:</b> {$name}<br><b>Address:</b> {$address}";

        $mail->send();
        echo "Your files have been sent successfully!";
    } catch (Exception $e) {
        echo "Error sending message: {$mail->ErrorInfo}";
    }
}
?>
