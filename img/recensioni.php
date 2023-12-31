<?php
$utente_id = 1; // Sostituisci con l'ID dell'utente autenticato
$testo_recensione = "Campo da calcio fantastico!";
$voto = 5; // Puoi utilizzare un sistema di punteggio da 1 a 5, ad esempio

// Connessione al database (assicurati di configurare correttamente le tue credenziali)
$connessione = new mysqli("localhost", "nome_utente", "password", "nome_database");

// Verifica della connessione
if ($connessione->connect_error) {
    die("Connessione al database fallita: " . $connessione->connect_error);
}

// Query per inserire la recensione nella tabella "Recensioni"
$query = "INSERT INTO Recensioni (utente_id, testo, voto) VALUES ('$utente_id', '$testo_recensione', '$voto')";

if ($connessione->query($query) === TRUE) {
    echo "Recensione inserita con successo";
} else {
    echo "Errore durante l'inserimento della recensione: " . $connessione->error;
}

// Chiudi la connessione al database
$connessione->close();
?>
