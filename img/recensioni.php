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
    <link rel="stylesheet" href="../css/recensioni.css">
    <style>
    h1 {
        text-shadow: 2px 2px green;
    }
</style>
</head>
<body>
<div id="div_titolo_rec">
    <h1 id="titolo">Lascia una Recensione</h1>
    </div>
    <div id="form_recensioni">
    <form action="../includes/recensioni.inc.php" method="post">
        
        <label for="voto">Voto:</label>
        <input type="number" id="voto" name="voto_rec" min="1" max="5" required><br><br>
        <br>
        <label for="testo_recensione">Testo della recensione:</label><br>
        <textarea id="testo" name="testo_rec" rows="4" cols="50" required></textarea><br><br>
        <br>
        <input type="hidden" name="campoID" value="<?php echo $campoID; ?>">

        <input type="submit" name="submit">
</div>
<br>
    </form>

    <!-- <a href='../includes/recensioni.inc.php?campoID=1'><button>Vai alle recensioni</button></a> -->

</body>
</html>

<?php
include_once './footer.php';
?>
