<?php 
    session_start();
    if (!isset($_SESSION['username'])){
        header("location: ../img/index.php");
        exit();
    }

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Query per ottenere le informazioni personali
    $user = getUserInfo($conn, $_SESSION['username']);
    $username = $user["username"];
    $email = $user["email"];
    $data_creaz = $user["data_creazione_acc"];
    $uid = $user["UID"];

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo - <?php echo $username ; ?></title>
    <link rel="stylesheet" type="text/css" href="../css/profilo.css">
    <style>
    h1 {
        text-shadow: 2px 2px green;
    }
</style>

</head>

<body>
    <br><br><br><br>
    <div id="Benvenuto_profilo">
        <h1>Benvenuto nel tuo profilo <?php echo $username ; ?> </h1>
        <br>
        <div id="informazioni_utente">
            <h4>Le tue informazioni</h4>
        </div>
        <br>
        <div id="dati_utente">
            <p id="e-mail">ID utente: <?php echo $uid ; ?> </p>
            <p id="nome-utente">Nome utente: <?php echo $username ; ?> </p>
            <p id="e-mail">Email: <?php echo $email ; ?> </p>
            <p id="data-creazione-account">Data creazione dell'account: <?php echo $data_creaz ; ?> </p>
            <br><br>
        </div>
    </div>
    
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    
</body>
