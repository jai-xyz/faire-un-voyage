<?php
require '../helpers/init_conn_db.php';   
$token =  $_POST["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM users 
        WHERE reset_token_hash = ?";

$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)) { 
    header('Location: ../reset-pwd.php?err=sqlerr');    
    exit();            
} else {
    mysqli_stmt_bind_param($stmt,'s', $token_hash);            
    mysqli_stmt_execute($stmt);

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();


    if ($user === null){
            die("token not found");
    }

 if   (strtotime($user["reset_token_expires_at"]) <= time()){
        die("token has expired");
 }
}     

 $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

 $sql = "UPDATE users
        SET password = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE user_id = ?";

$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql)) { 
    header('Location: ../reset-pwd.php?err=sqlerr');    
    exit();            
} else {
    mysqli_stmt_bind_param($stmt,'ss', $password_hash, $user["user_id"]);            
    mysqli_stmt_execute($stmt);
    $flag = true;

    if(!$flag == false){
        header('Location: ../login.php?password=updated');
    } else {
        header('Location: ../reset-pwd.php?err=sqlerr');    
        exit();     
    }

}     




