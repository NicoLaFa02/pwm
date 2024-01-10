<?php
include_once './header.php';
?>

<?php 
$campoID = $_GET["campoID"];
// verifico se l'utente è loggato
session_start();
//se non è stato effettuato l'accesso allora non si possono lasciare recensioni
if (!isset($_SESSION['username'])){
    header("location: ../img/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lascia una recensione</title>
    <link rel="stylesheet" href="../css/impostazioni.css">
</head>
<body>

    <form action="../includes/recensioni.inc.php" method="post">Lascia una recensione
        
        <label for="voto">Voto:</label>
        <input type="number" id="voto" name="voto_rec" min="1" max="5" required><br><br>
        
        <label for="testo_recensione">Testo della recensione:</label><br>
        <textarea id="testo" name="testo_rec" rows="4" cols="50" required></textarea><br><br>
        
        <input type="hidden" name="campoID" value="<?php echo $campoID; ?>">

        <input type="submit" name="submit">

    </form>

    <!-- <a href='../includes/recensioni.inc.php?campoID=1'><button>Vai alle recensioni</button></a> -->

</body>
</html>

<?php
include_once './footer.php';
?>
