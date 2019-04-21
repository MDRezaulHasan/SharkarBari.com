<?php
function dateFormat($date){
    return date('F j,Y, g:i A',strtotime($date));
}
function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function readMore($text, $limit = 400){
    $text = $text." ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text."...";
    return $text;

}
function send_mail($email,$message,$subject)
{						
    require_once('mailer/class.phpmailer.php');
    $mail = new PHPMailer();
    $mail->IsSMTP(); 
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "ssl";                 
    $mail->Host       = "smtp.gmail.com";      
    $mail->Port       = 465;             
    $mail->AddAddress($email);
    $mail->Username="sharkarbari@gmail.com";  
    $mail->Password="asdfghjkl456";            
    $mail->SetFrom('sharkarbari@gmail.com','sarkarbari.com');
    $mail->AddReplyTo("sharkarbari@gmail.com","sarkarbari.com");
    $mail->Subject    = $subject;
    $mail->MsgHTML($message);
    $mail->Send();
}


?>

