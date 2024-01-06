<?php
include_once './header.php';
?>

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

<!DOCTYPE html>
<html lang="en">
<!-- Questo è il codice che precedentemente era stato usato in login.html (solo la parte di registrazione)-->
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../css/login.css">

</head>

<body>

    <div id="div_registrazione">
        <h2 id="titolo_registrazione">Registrazione</h2>
        <br>
        <p>Inserire email, username e password</p>
        <br>
        <form onsubmit="registra_utente()">
            <input type="email" name="email" placeholder="Inserisci la tua email"></input>
            <p></p>
            <input type="text" name="username" placeholder="Inserisci il tuo username"></input>
            <p></p>
            <input type="password" name="password" placeholder="Inserisci la tua password"> </input>
            <p></p>
            <input type="submit" value="Registra">
        </form>
    </div>

<script src="../js/utenti_main.js"></script>
</body>
</html>

<?php
include_once './footer.php';
?>