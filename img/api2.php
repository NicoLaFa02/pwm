<?php

use Firebase\JWT\JWT;

// Connessione al database (sostituisci con i tuoi dettagli di connessione)
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "nome_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Funzione per verificare l'autenticazione e restituire un token JWT
function verificaAutenticazione($username, $password) {
    global $conn;

    // Implementa la logica di verifica dell'autenticazione (es. verifica con database)
    $query = "SELECT * FROM utenti WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Utente autenticato, genera e restituisci un token JWT
        $token = generaTokenJWT($username);
        return $token;
    } else {
        return false;
    }
}

// Funzione per generare un token JWT
function generaTokenJWT($username) {
    $chiaveSegreta = 'la_tua_chiave_segrata'; //sostituire chiave segreta 
    

    $payload = array(
        "iss" => "issuer", //chi ha emesso il token
        "aud" => "audience", //a chi è destinato il token
        "iat" => time(), //Timestamp di quando è stato emesso il token
        "exp" => time() + 3600, //Timestamp di quando il token scadrà
        "data" => array(
            "username" => $username
    ) 
        );

    $token = JWT::encode($payload, $chiaveSegreta, 'HS256');

    return $token;
}

// Funzione per ottenere recensioni paginate dal database
function ottieniRecensioniPaginate($offset, $limit) {
    global $conn;

    // Implementa la logica per ottenere recensioni paginate dal database (usa LIMIT e OFFSET)
    $query = "SELECT * FROM recensioni ORDER BY DataRecensione DESC LIMIT $offset, $limit";
    $result = $conn->query($query);

    $recensioni = array();

    while ($row = $result->fetch_assoc()) {
        $recensioni[] = $row;
    }

    return $recensioni;
}

// Gestisci le richieste in base al metodo HTTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Autenticazione dell'utente
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $token = verificaAutenticazione($username, $password);

    if ($token) {
        echo json_encode(['token' => $token]);
    } else {
        http_response_code(401);
        echo json_encode(['messaggio' => 'Autenticazione fallita']);
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pagina'])) {
    // Ottenere recensioni paginate
    $pagina = $_GET['pagina'];
    $recensioniPerPage = 10;
    $offset = ($pagina - 1) * $recensioniPerPage;

    $recensioni = ottieniRecensioniPaginate($offset, $recensioniPerPage);
    echo json_encode($recensioni);

} else {
    // Gestire altri tipi di richieste o restituire un errore
    http_response_code(400);
    echo json_encode(['messaggio' => 'Richiesta non valida']);
}

// Chiudi la connessione al database
$conn->close();

?>
