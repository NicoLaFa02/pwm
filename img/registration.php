<?php
include_once './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<!-- Questo è il codice che precedentemente era stato usato in login.html (solo la parte di registrazione)-->
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../css/login.css">

</head>

<body>

    <div id="div_registrazione">
        <h2 id="titolo_registrazione">Registrazione</h2>
        <br>
        <p>Inserire email, username e password</p>
        <br>
        <form action="../includes/signup.inc.php" method="post">
            <input type="email" name="email" placeholder="Inserisci la tua email"></input>
            <input type="text" name="username" placeholder="Inserisci il tuo username"></input>
            <input type="password" name="pwd" placeholder="Inserisci la tua password"> </input>
            <input type="password" name="pwdrepeat" placeholder="Ripeti la tua password"> </input>
            <button type="submit" name="submit">Registrati</button>
        </form>
    </div>

<?php
    if (isset($_GET['error'])) {
        if($_GET['error'] == 'emptyinput'){
            echo '<p>Riempi tutti i campi!</p>';
        }
        if($_GET['error'] == 'invalidusername'){
            echo '<p>Username non valido! Inserisci solo caratteri alfanumerici!</p>';
        }
        if($_GET['error'] == 'invalidemail'){
            echo '<p>Email non valida! Inserisci solo caratteri alfanumerici!</p>';
        }
        if($_GET['error'] == 'passwordsdontmatch'){
            echo '<p>Le password non combaciano!</p>';
        }
        if($_GET['error'] == 'usernametaken'){
            echo '<p>Username o mail non disponibile!</p>';
        }
        if($_GET['error'] == 'stmtfailed'){
            echo '<p>Qualcosa è andato storto, prova di nuovo</p>';
        }
        if($_GET['error'] == 'none'){
            echo '<p>Registrazione effettuata con successo!</p>';
        }
        
    }
?>

</body>
</html>

<?php
include_once './footer.php';
?>