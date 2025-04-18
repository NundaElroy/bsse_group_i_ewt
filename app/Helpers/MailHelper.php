<?php
namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHelper
{
    public static function sendEmail($to, $subject, $body, $fromName = null)
    {
        $mail = new PHPMailer(true);

        try {

            $mail->SMTPDebug = 0; // Set to 0 in production
            $mail->Debugoutput = function ($str, $level) {
                \Log::debug("PHPMailer Debug [$level]: $str"); // Log to Laravel's debug channel
            };
            // Server settings
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST','smtp.gmail.com');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME','');
            $mail->Password = env('MAIL_PASSWORD', '');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls');
            $mail->Port = env('MAIL_PORT', 587);

            //Validate From address
            $fromAddress = env('MAIL_FROM_ADDRESS', '');
            if (empty($fromAddress) || !filter_var($fromAddress, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Invalid or missing MAIL_FROM_ADDRESS in .env');
            }
            //change just made

            // Sender and recipient
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), $fromName ?? env('MAIL_FROM_NAME'));
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body); // Plain text version

            $mail->send();
            return ['success' => true, 'message' => 'Email sent successfully!'];
        } catch (Exception $e) {
            \Log::error('PHPMailer Error: ' . $mail->ErrorInfo);
            return ['success' => false, 'message' => "Email could not be sent. Error: {$mail->ErrorInfo}"];
        }
    }
}