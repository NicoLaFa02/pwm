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
