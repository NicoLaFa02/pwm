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

        <div id="recensioni_utente">
        <?php
        //query per le recensioni di un determinato campoID
        
            $sql = "SELECT id_recensione, testo_recensione, utente_id, campoID_r, username, data_creazione_rec, voto FROM recensioni WHERE utente_id = ?";
            $stmt = mysqli_stmt_init($conn);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $uid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_recensione, $testo_recensione, $utente_id, $campoID_r, $username, $data_creazione_rec, $voto);
                echo "<table border='1'>";
                echo "<tr><th>ID Recensione</th><th>Testo Recensione</th><th>ID Utente</th><th>Username</th><th>Data Creazione Recensione</th><th>ID Campo Recensito</th><th>Voto</th></tr>";
                while (mysqli_stmt_fetch($stmt)) {
                    echo "<tr>";
                    echo "<td>$id_recensione</td>";
                    echo "<td id='testo_tabella'>$testo_recensione</td>";
                    echo "<td>$utente_id</td>";
                    echo "<td>$username</td>";
                    echo "<td>$data_creazione_rec</td>";
                    echo "<td>$campoID_r</td>";
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
        ?>

        </div>
    </div>
    
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    
</body>
