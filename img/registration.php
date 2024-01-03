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
$email = $_POST['email'];

$sql = "INSERT INTO utenti (username, password, email)
VALUES ('$username', '$password', '$email')";


if ($conn->query($sql) === TRUE) {
    echo "Nuovo utente registrato con successo";
} else {
    echo "Errore nell'inserimento dell'utente: " . $conn->error;
}

// Chiusura della connessione
$conn->close();

?>
