<?php
$servername = "localhost";
$username = "root";
$password = "";

// Crea la connessione
$conn = new mysqli($servername, $username, $password);

// Verifica la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

echo "Connessione riuscita!";
?>
