<!DOCTYPE html>
<html lang="it">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LOGIN</title>
<link rel="stylesheet" href="../css/login.css">
<style>
    h1 {
        text-shadow: 2px 2px green;
    }
</style>
</head>

<body>
<?php include_once './header.php';
include_once './sicurezza.php' ?>

<div id="div_login">
    <h1 id="titolo_login">LOGIN</h1>
    <br><br><br><br>
    <div id="messaggio_utente_password">
    <p>Inserire nome utente e password: </p>
    </div>
    <form action="../includes/login.inc.php" method="post">
        <div id="form_login">
        <input type="text" name="username" placeholder="Inserisci username o email">
        <br><br>
        <input type="password" name="password" placeholder="Inserisci la tua password">
        <br><br>
        <button type="submit" name="submit">Accedi</button>
        </div>
        <br><br><br>
        <div id="messaggio_registrazione">
        <p>Non sei ancora registrato?</p>
        </div>
        <div id="registrati_ora">
        <a href="./registration.php">Registrati ora</a>
        </div>
    </form>
    <br>
</div>

<!-- Gestione errori php -->
<div id="messaggi_errori_login">
<?php
    if (isset($_GET['error'])) {
        if($_GET['error'] == 'emptyinput'){
            echo '<p>Riempi tutti i campi!</p>';
        }
        if($_GET['error'] == 'wronglogin'){
            echo '<p>Utente non esistente!</p>';
        }
        if($_GET['error'] == 'incorrectpassword'){
            echo '<p>La mail o la password non è corretta!</p>';
        }
    }
?>
</div>
<br>

    
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



<?php
include_once './footer.php';
?>

</body>
</html>
