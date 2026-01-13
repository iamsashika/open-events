<?php

class MailService
{
    public static function send($to, $subject, $message)
    {
        $headers = "From: no-reply@openevents.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8";

        return mail($to, $subject, $message, $headers);
    }

    public static function sendVerificationCode($email, $code)
    {
        $message = "Your verification code is: $code\n\nThis code expires in 5 minutes.";
        return self::send($email, 'Verify Your Email', $message);
    }

    public static function sendPasswordReset($email, $link)
    {
        $message = "Reset your password:\n$link\n\nThis link expires in 30 minutes.";
        return self::send($email, 'Reset Password', $message);
    }
}
