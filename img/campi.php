<?php
require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';

echo '<div style="display: flex;">'; // Utilizzo di Flexbox per allineare i campi in linea

for ($i = 1; $i < 3; $i++) {
    echo '<div style="margin-left: 20px;">'; // Aggiungo un margine tra i campi (puoi personalizzarlo)
    stampaCampo($conn, $i);
    echo '</div>';
}

echo '</div>';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/campi.css">
</head>
<body>

</body>
</html>