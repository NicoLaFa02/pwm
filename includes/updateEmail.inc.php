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

$actualemail = $user["email"];
$username = $user["username"];
$pwd = $user["password"];

$oldemail = $_POST["oldEmail"];
$newemail = $_POST["newEmail"];

if (emptyInputCheck($oldemail, $newemail) !== false) {
    header("location: ../img/impostazioni.php?error=emptyinput");
    exit(); 
}

if (fieldMatch($oldemail, $actualemail) !== false) {
    header("location: ../img/impostazioni.php?error=emaildontmatch");
    exit(); 
}

if (!(fieldMatch($oldemail, $newemail)) !== false) {
    header("location: ../img/impostazioni.php?error=sameemail");
    exit(); 
}

if (invalidEmail($newemail) !== false) {
    header("location: ../img/impostazioni.php?error=invalidemail");
    exit(); 
}

if (usernameExists($conn, $newemail, $newemail) !== false) {
    header("location: ../img/impostazioni.php?error=emailtaken");
    exit(); 
}

if(updateCampo($conn, 'utenti', 'email', $oldemail, $newemail)){
    session_unset();
    session_destroy();
    reLoginUser($conn, $username, $pwd);
}else{
    header("location: ../img/impostazioni.php?error=updatefailed");
    exit(); 
}
