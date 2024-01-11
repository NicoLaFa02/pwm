<?php
// session_start(); //non credo sia necessario fare partire la sessione se non è necessario essere loggati

// if(!isset($_POST["submit"])){
//     header("location: ../img/impostazioni.php");
//     exit();
// } Non devo per forza arrivare da un tasto

if (isset($_POST["campoID"])) {

    // Query per ottenere le informazioni dell'campo dal DB
    $user = getCampoInfo($conn, $_POST["campoID"]);

    $campoData = getCampoInfo($conn, $_POST["campoID"]);
    $nomeCampo = $campoData["nomeCampo"];

}