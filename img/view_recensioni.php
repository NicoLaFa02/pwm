<?php
include_once './header.php';
?>

<div id=recensioni_utente>

<?php

require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';

if (isset($_GET["campoID"])) {

    $campoID = $_GET["campoID"];

    // Query per ottenere le informazioni dell'campo dal DB
    
    $campoData = getCampoInfo($conn, $campoID);
    $nomeCampo = $campoData['$nomeCampo'];
    
    stampaCampo($conn, $campoID);

    //query per le recensioni di un determinato campoID
    $sql = "SELECT id_recensione, testo_recensione, utente_id, campoID_r, username, data_creazione_rec, voto FROM recensioni WHERE campoID_r = ?";

    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $campoID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_recensione, $testo_recensione, $utente_id, $campoID_r, $username, $data_creazione_rec, $voto);
        echo "<table border='1'>";
        echo "<tr><th>ID Recensione</th><th>Testo Recensione</th><th>ID Utente</th><th>Username</th><th>Data Creazione Recensione</th><th>Voto</th></tr>";

        while (mysqli_stmt_fetch($stmt)) {
            echo "<tr>";
            echo "<td>$id_recensione</td>";
            echo "<td>$testo_recensione</td>";
            echo "<td>$utente_id</td>";
            echo "<td>$username</td>";
            echo "<td>$data_creazione_rec</td>";
            echo "<td>";
            // Aggiungi stelle in base al voto
            for ($i = 1; $i <= $voto; $i++) {
                echo "&#11088";
            }
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
        mysqli_stmt_close($stmt);
    }
}

?>

</div>

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