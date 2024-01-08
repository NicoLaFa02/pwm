<?php
if(isset($_POST["submit"])){
    
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $pwd) !== false) {
        header("location: ../img/login.php?error=emptyinput");
        exit(); 
    }

    // altre funzioni di controllo

    loginUser($conn, $username, $pwd);
}
else{
    header("location: ../img/login.php");
    exit();
}