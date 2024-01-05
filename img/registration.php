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


$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$email = mysqli_real_escape_string($conn, $_POST['email']);


$sql = "INSERT INTO utenti (username, password, email)
VALUES ('$username', '$password', '$email')";


if ($conn->query($sql) === TRUE) {
    $response = array("message" => "Nuovo utente registrato con successo");
    echo json_encode($response);
} else {
    $response = array("error" => "Errore nell'inserimento dell'utente: " . $conn->error);
    echo json_encode($response);
}


// Chiusura della connessione
$conn->close();

?>
