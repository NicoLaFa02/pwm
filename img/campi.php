<?php

?>

<?php
$percorsoImmagine1 = 'https://www.messinasportiva.it/wp-content/uploads/2015/05/1capo-1280x720.jpg';
$percorsoImmagine2 = '';
$percorsoImmagine3 = '';
$percorsoImmagine4 = '';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/campi.css">
</head>
<body>
    
<img src="<?php echo $percorsoImmagine1; ?>" alt="Immagine 1">
<img src="<?php echo $percorsoImmagine2; ?>" alt="Immagine 2">
<img src="<?php echo $percorsoImmagine3; ?>" alt="Immagine 3">
<img src="<?php echo $percorsoImmagine4; ?>" alt="Immagine 4">

</body>
</html>

<?php
include_once './footer.php';
//dovremmo fare una funzione che guarda le colonne della tabella "campoDaCalcio" e per ogni campo stampa la foto asegnata a quel campo e le informazioni, rendendo il campo accessibile per le recensioni
?>