<?php
$host = "localhost";
$username_db = "root";
$password_db = "";
$database = "pwm";

//creazione connessione
$conn = new mysqli($host, $username_db, $password_db, $database);

//verifica connessione
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];



?>
