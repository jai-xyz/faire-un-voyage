<?php
session_start();
setcookie('Uname', '',time() - 3600, "/");
setcookie('Upwd', '',time() - 3600, "/");   
session_unset();
session_destroy();
header('Location: http://localhost/faire-un-voyage/admin/login.php');
