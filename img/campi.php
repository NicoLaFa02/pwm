<?php
require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/campi.css">
</head>
<script>
    // "$i" andrà sostituito con il campo con l'ultimo 
for ($i = 1; $i < 3; $i++) {
    stampaCampo($conn, $i);
}</script>
<body>

</body>
</html>

<?php
include_once './footer.php';
//dovremmo fare una funzione che guarda le colonne della tabella "campoDaCalcio" e per ogni campo stampa la foto asegnata a quel campo e le informazioni, rendendo il campo accessibile per le recensioni
?>