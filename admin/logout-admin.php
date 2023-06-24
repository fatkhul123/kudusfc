<?php
 if(!isset($_SESSION['role_pengguna'])){
session_start();
unset($_SESSION['username']);
}

else if(!isset($_SESSION['role_pengguna'])){
session_start();
unset($_SESSION['username']);
}

header('Location: login-admin.php');
?>
