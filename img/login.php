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

$sql = "SELECT username, password, email FROM utenti";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo"Username: " . $row["username"] . " - Password: ". $row["password"];
    }
}else{
    echo "Nessun risultato trovato nella tabella utenti";
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<!-- Questo è il codice che precedentemente era stato usato in login.html (solo la parte di login)-->
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../css/login.css">

</head>

<body>

    <div id="div_login">
        <h2 id="titolo_login">Login</h2>
        <br>
        <p>Inserire nome utente e password</p>
        <br>
        <form action="../img/login.php" method="post">

            <input type="text" name="email" placeholder="Inserisci la tua email"></input>
            <p></p>
            <input type="text" name="username" placeholder="Inserisci il tuo username"></input>
            <p></p>
            <input type="text" name="password" placeholder="Inserisci la tua password"> </input>
            <p></p>

            <input type="submit" value="Accesso"></input>
            
            <p>Non sei ancora registrato?</p>
            <a href="./registration.php">Registrati ora</a>

            
            
        </form>
    </div>

</body>
</html>