// da inserire neò config

<?php
// Connessione al database (assicurati di configurare correttamente le tue credenziali)
$connessione = new mysqli("localhost", "nome_utente", "password", "nome_database");

// Verifica della connessione
if ($connessione->connect_error) {
    die("Connessione al database fallita: " . $connessione->connect_error);
}

// Verifica se il form di registrazione è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ottieni i dati inviati dal form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Esegui l'hash della password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query per inserire l'utente nella tabella "Utenti"
    $query = "INSERT INTO Utenti (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($connessione->query($query) === TRUE) {
        echo "Registrazione completata con successo";
    } else {
        echo "Errore durante la registrazione: " . $connessione->error;
    }
}

// Chiudi la connessione al database
$connessione->close();
?>
