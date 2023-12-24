<?php
header('Content-Type: application/json');
include 'config.php';

// Gestisci richiesta di inserimento recensione
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $utenteID = $data['utenteID'];
    $campoID = $data['campoID'];
    $voto = $data['voto'];
    $commento = $data['commento'];

    $sql = "INSERT INTO Recensioni (UtenteID, CampoID, Voto, Commento) VALUES ('$utenteID', '$campoID', '$voto', '$commento')";
    $result = $conn->query($sql);

    if ($result) {
        echo json_encode(['message' => 'Recensione inserita con successo.']);
    } else {
        echo json_encode(['error' => 'Errore durante l'inserimento della recensione.']);
    }
}

// Gestisci richiesta di ottenere tutte le recensioni
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT r.*, u.Nome AS NomeUtente, c.NomeCampo
            FROM Recensioni r
            INNER JOIN Utenti u ON r.UtenteID = u.ID
            INNER JOIN CampiDaCalcio c ON r.CampoID = c.ID
            ORDER BY r.DataRecensione DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $recensioni = [];
        while ($row = $result->fetch_assoc()) {
            $recensioni[] = $row;
        }
        echo json_encode($recensioni);
    } else {
        echo json_encode(['message' => 'Nessuna recensione trovata.']);
    }
}

$conn->close();
?>
