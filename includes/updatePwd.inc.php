<?php
//IF per fare in modo che si possa accedere alla pagina solo tramite il pulsante in registration.php
session_start();
if(!isset($_POST["submit"])){
    header("location: ../img/impostazioni.php");
    exit();
}
require_once './dbh.inc.php';
require_once './functions.inc.php';

// Query per ottenere le informazioni personali
$user = getUserInfo($conn, $_SESSION["username"]);

$actualpwd_hashed = $user["password"];
$username = $user["username"];

$newpwd = $_POST["newPassword"];
$newpwdrepeat = $_POST["newPasswordRepeat"];

if (emptyInputCheck($newpwd, $newpwdrepeat) !== false) {
    header("location: ../img/impostazioni.php?error=emptyinput");
    exit(); 
}

if (fieldMatch($newpwd, $newpwdrepeat) !== false) {
    header("location: ../img/impostazioni.php?error=pwddontmatch");
    exit(); 
}

if (invalidStringInput($newpwd) !== false) {
    header("location: ../img/impostazioni.php?error=invalidpwd");
    exit(); 
}

$newpwd_hashed = password_hash($newpwd, PASSWORD_DEFAULT);

if(updateCampo($conn, 'utenti', 'password', $actualpwd_hashed, $newpwd_hashed)){
    session_unset();
    session_destroy();
    reLoginUser($conn, $username, $newpwd_hashed);
}else{
    header("location: ../img/impostazioni.php?error=updatefailed");
    exit(); 
}
