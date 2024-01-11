<?php
include_once './header.php';
?>

<?php

require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';

if (isset($_GET["campoID"])) {

    $campoID = $_GET["campoID"];

    // Query per ottenere le informazioni dell'campo dal DB
    
    $campoData = getCampoInfo($conn, $campoID);
    $nomeCampo = $campoData['$nomeCampo'];
    
    stampaCampo($conn, $campoID);

    // Query per ottenere tutte le recensioni per un determinato campoID
    $query = "SELECT id_recensione, testo_recensione, utente_id, campoID_r, username, data_creazione_rec, voto
    FROM recensioni
    WHERE campoID_r = ?";

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $campoID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_recensione, $testo_recensione, $utente_id, $campoID_r, $username, $data_creazione_rec, $voto);
        while (mysqli_stmt_fetch($stmt)) {
            echo "ID Recensione: $id_recensione<br>";
            echo "Testo Recensione: $testo_recensione<br>";
            echo "ID Utente: $utente_id<br>";
            echo "Username: $username<br>";
            echo "Data Creazione Recensione: $data_creazione_rec<br>";
            echo "<hr>";
        }
        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recensioni - <?php echo $campoNome ; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

</body>
</html>

<?php
include_once './footer.php';
?>