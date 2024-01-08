<?php
include_once './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<!-- Questo è il codice che precedentemente era stato usato in login.html (solo la parte di login)-->
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../css/login.css">

</head>

<body>

    <div id="div_login">
        <h2 id="titolo_login">Login</h2>
        <br>
        <p>Inserire nome utente e password</p>
        <br>
        <form action="../includes/login.inc.php" method="post">
            <input type="text" name="username" placeholder="Inserisci username o email"></input>
            <input type="password" name="password" placeholder="Inserisci la tua password"> </input>
            <button type="submit" name="submit">Accedi</button>

            <p>Non sei ancora registrato?</p>
            <a href="./registration.php">Registrati ora</a>

            
            
        </form>
    </div>


<!-- Gestione errori php -->
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

</body>
</html>

<?php
include_once './footer.php';
?>