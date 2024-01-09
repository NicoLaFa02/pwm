<?php
//IF per fare in modo che si possa accedere alla pagina solo tramite il pulsante in registration.php
session_start();
if(!isset($_POST["submit"])){
    header("location: ../img/impostazioni.php");
    exit();
}
require_once './dbh.inc.php';
require_once './functions.inc.php';

$actualusername = $_SESSION['username'];
$oldusername = $_POST["oldUsername"];
$newusername = $_POST["newUsername"];

// Query per ottenere le informazioni personali
$stmt = $conn->prepare("SELECT * FROM utenti WHERE username = ?");
$stmt->bind_param("s", $_SESSION["username"]);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
}
$pwd = $user["password"];



if (emptyInputLogin($oldusername, $newusername) !== false) {
    header("location: ../img/impostazioni.php?error=$pwd");
    exit(); 
}

if (fieldMatch($oldusername, $actualusername) !== false) {
    header("location: ../img/impostazioni.php?error=usernamedontmatch");
    exit(); 
}

if (!(fieldMatch($oldusername, $newusername)) !== false) {
    header("location: ../img/impostazioni.php?error=sameusername");
    exit(); 
}

if (invalidUsername($newusername) !== false) {
    header("location: ../img/impostazioni.php?error=invalidusername");
    exit(); 
}

if (usernameExists($conn, $newusername, $newusername) !== false) {
    header("location: ../img/impostazioni.php?error=usernametaken");
    exit(); 
}

if(updateCampo($conn, 'utenti', 'username', $oldusername, $newusername)){
    session_unset();
    session_destroy();
    reLoginUser($conn, $newusername, $pwd);
}else{
    header("location: ../img/impostazioni.php?error=updatefailed");
    exit(); 
}



