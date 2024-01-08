<?php
    session_start();
    //se non è stato effettuato l'accesso allora non è possibile accedere
    if (!isset($_SESSION['username'])){
        header("location: ../img/index.php");
        exit();
    }
    $username = $_SESSION["username"];
    $email = $_SESSION["email"];
    $data_creaz = $_SESSION["data_creazione_acc"];
    $uid = $_SESSION["uid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo - <?php echo $username ; ?></title>
    <link rel="stylesheet" href="../css/profilo.css">

</head>

<body>
    <div>
        <h2>Benvenuto nel tuo profilo <?php echo $username ; ?> </h2>
        <div id="informazioni-utente">
            <h4>Le tue informazioni</h4>
            <p id="nome-utente">Nome utente <?php echo $username ; ?> </p>
            <p id="e-mail">Email <?php echo $email ; ?> </p>
            <p id="data-creazione-account">Data creazione dell'account <?php echo $data_creaz ; ?> </p>
            <p id="e-mail">ID utente <?php echo $uid ; ?> </p>
        </div>
    </div>
    
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    
</body>
