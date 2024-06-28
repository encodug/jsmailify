<?php
require 'vendor/autoload.php'; // Include PHPMailer autoloader
require_once 'securetoken.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($host, $username, $password, $port, $fromEmail, $fromName, $toEmail, $subject, $body) {
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

    try {
        // Server settings
        $mail->isSMTP();

        /**
         * SMTP Configuration to be returned from API From JAVASCRIPT Function
         */
        $mail->Host       = $host; // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = $username; // SMTP username
        $mail->Password   = $password; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = $port; // TCP port to connect to

        /** ---------- */

        // Recipients
        $mail->setFrom($fromEmail, $fromName);
        $mail->addReplyTo($fromEmail, $fromName);

        if(is_array($toEmail)) {
            foreach ($toEmail as $email) {
                $mail->addAddress($email); // Add a recipient
            }
        } else {
            $mail->addAddress($toEmail); // Add a single recipient
        }
        

        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name


        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        if($mail->send()) {
            return array('success' => true);
        } else {
            throw new Exception($mail->ErrorInfo);
        }
    } catch (Exception $e) {
        return array('success' => false, 'error' => $e->getMessage());
    }
}

// Check if request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from request body
    $postData = json_decode(file_get_contents('php://input'), true);

    if(isset($postData['secureToken'])) {
        $smtpResult = decryption($postData['secureToken']);
        
        if($smtpResult['success']) {
            $smtpSettings = $smtpResult['smtp_settings'];
        }

        $result = sendEmail(
            $smtpSettings['host'], 
            $smtpSettings['username'], 
            $smtpSettings['password'], 
            $smtpSettings['port'], 
            $postData['fromEmail'], 
            $postData['fromName'], 
            $postData['toEmail'], 
            $postData['subject'], 
            $postData['body']
        );
    } else {
        // Check if the 'port' field exists in the JSON data
        $port = isset($postData['port']) ? $postData['port'] : 587;

        // Call sendEmail function
        $result = sendEmail(
            $postData['host'], 
            $postData['username'], 
            $postData['password'], 
            $port, 
            $postData['fromEmail'], 
            $postData['fromName'], 
            $postData['toEmail'], 
            $postData['subject'], 
            $postData['body']
        );
    }

    // Return response
    echo json_encode($result);
} else {
    // Handle unsupported request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Method Not Allowed'));
}
?>
