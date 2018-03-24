<?php
function sendMail($name, $email, $subject, $content){
    header('Content-Type: text/html; charset=utf-8');
    include_once 'src/PHPMailer.php';

    $mail = new PHPMailer(true);                      
    try {
        //Server settings
        $mail->CharSet = 'UTF-8';

        $mail->SMTPDebug = 0;   
        $mail->isSMTP();    
        
        $mail->Host = 'smtp.gmail.com';  
        
        $mail->SMTPAuth = true;          

        $mail->Username = 'huonghuong08.php@gmail.com';                 // SMTP username
        $mail->Password = '0123456789000';                           // SMTP password
        $mail->SMTPSecure = 'tls'; //ssl                            
        $mail->Port = 587;         //546           

        //Recipients
        $mail->setFrom('huonghuong08.php@gmail.com', 'Restaurant 3110');
        $mail->addAddress($email, $name);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('huonghuong08.php@gmail.com', 'Information');

        //Content
        $mail->isHTML(true); 

        $mail->Subject = $subject;
        $mail->Body    = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
        
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }
}