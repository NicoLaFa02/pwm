<?php

if (!isset($_SESSION["login"] )|| $_SESSION["login"]==false) {
    header("Location: http://localhost/Progetto/img/login.php");
    exit();
}  
?>
