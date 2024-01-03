<?php
$servername = "localhost";
$username = "root";
$pw = "";
$dbname = "pwm";

// Crea la connessione
$conn = new mysqli($servername, $username, $pw, $dbname);

// Verifica la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Codice di login 

$conn->close();

?>
