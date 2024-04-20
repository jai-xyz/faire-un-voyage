<?php

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['reset-req-submit'])) {

    require '../helpers/init_conn_db.php';   


    $token =  bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);
    $user_email = $_POST['user_email'];
    if(!filter_var($user_email,FILTER_VALIDATE_EMAIL)) {
        header('Location: ../reset-pwd.php?err=invalidemail');    
        exit();
    }    

    $sql = "UPDATE users SET reset_token_hash = ?,
                            reset_token_expires_at = ?
                        WHERE email = ?";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)) { 
        header('Location: ../reset-pwd.php?err=sqlerr');    
        exit();            
    } else {
        mysqli_stmt_bind_param($stmt,'sss', $token_hash, $expiry, $user_email);            
        mysqli_stmt_execute($stmt);
    }     

    // $sql = 'INSERT INTO PwdReset (pwd_reset_email,pwd_reset_selector,pwd_reset_token,
    // pwd_reset_expires) VALUES (?,?,?,?);';
    // $stmt = mysqli_stmt_init($conn);
    // if(!mysqli_stmt_prepare($stmt,$sql)) {
    //     header('Location: ../reset-pwd.php?err=sqlerr');     
    //     exit();            
    // } else {
    //     $token_hash = password_hash($token,PASSWORD_DEFAULT);
    //     mysqli_stmt_bind_param($stmt,'ssss',$user_email,$selector,$token_hash,$expires);            
    //     mysqli_stmt_execute($stmt);
    // } 

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    require_once "../vendor/autoload.php";
    include '../vendor/phpmailer/phpmailer/src/Exception.php';
    include '../vendor/phpmailer/phpmailer/src/PHPMailer.php';  
    try {     
        $mail = new PHPMailer(true);        
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = 'rhyaaaaa01072001@gmail.com';
        $mail->Password   = 'yslxszzcvhlplnbj';
        $mail->IsHTML(true);
        $mail->SetFrom('rhyaaaaa01072001@gmail.com');
        $mail->AddAddress($user_email);    
        $mail->Subject = "Reset Password Request";
        $content .= '<p>Click <a href="http://localhost/faire-un-voyage/create-new-pwd.php?token='.$token.'"> here</a> to reset your password.</p>';
             
        $mail->MsgHTML($content); 
        $mail->Send();
        header('Location: ../reset-pwd.php?mail=success');       
    } 
    catch(Exception $e) {        
        // echo $mail->ErrorInfo;
        header('Location: ../reset-pwd.php?err=mailerr');      
    }
   
} else {
    header('Location: ../reset-pwd.php?');    
} 


