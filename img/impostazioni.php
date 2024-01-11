<?php
include_once './header.php';
?>

<?php
// verifico se l'utente è loggato
session_start();
//se non è stato effettuato l'accesso allora non esistono impostazioni utente
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
    <title>Impostazioni - <?php echo $_SESSION['username'] ?></title>
    <link rel="stylesheet" href="../css/impostazioni.css">
    <style>
    h1 {
        text-shadow: 2px 2px green;
    }
</style>
</head>
<body>

    <div class="settings-container">
        <br><br>
        <h1>Impostazioni</h1>
        
       <div class="modifica_username">
        <!-- Sezione Modifica Username -->
        <h2>Modifica Username</h2>
        <form action="../includes/updateUsername.inc.php" method="post">
            <label for="oldUsername">Vecchio Username:</label>
            <input type="text" id="oldUsername" name="oldUsername" placeholder="inserisci il vecchio username">
            <br>
            <label for="newUsername">Nuovo Username:</label>
            <input type="text" id="newUsername" name="newUsername" placeholder="inserisci il nuovo username">
            <br>
            <button type="submit" name="submit">Cambia username</button>
        </form>
       </div>
        <hr>
        
        <div class="modifica_email">
        <!-- Sezione Modifica Email -->
        <h2>Modifica Email</h2>
        <form action="../includes/updateEmail.inc.php" method="post">
            <label for="oldEmail">Vecchia Email:</label>
            <input type="email" id="oldEmail" name="oldEmail" placeholder="inserisci la vecchia email">
            <br>
            <label for="newEmail">Nuova Email:</label>
            <input type="email" id="newEmail" name="newEmail" placeholder="inserisci la nuova email">
            <br>
            <button type="submit" name="submit" id="put">Cambia email</button>        </form>
        </div>
        <hr>
        
        <div class="modifica_password">
        <!-- Sezione Modifica Password -->
        <h2>Modifica Password</h2>
        <form action="../includes/updatePwd.inc.php" method="post">
            <label for="newPassword">Nuova Password:</label>
            <input type="password" id="newPassword" name="newPassword" placeholder="inserisci la nuova password">
            <br>
            <label for="newPasswordRepeat">Conferma Nuova Password:</label>
            <input type="password" id="newPasswordRepeat" name="newPasswordRepeat" placeholder="RE-inserisci la nuova password">
            <br>
            <button type="submit" name="submit">Cambia password</button>        </form>
        </div>
        <hr>
        
        <div class="elimina_account">
        <h2>Elimina Account</h2>
        <form action="../includes/deleteAccount.inc.php" method="post">
            <label for="confirmDelete">Conferma Eliminazione dell'Account:</label>
            <input type="checkbox" id="confirmDelete" name="confirmDelete">
            
            <button type="submit" name="deleteAccount">Elimina Account</button>
        </form>
    </div>
</div>
</body>
</html>


<div id="gestione_errori">
<?php
//gestione degli errori php
if (isset($_GET['error'])) {
    //gestione generale
    if($_GET['error'] == 'emptyinput'){
        echo '<p>Riempi tutti i campi!</p>';
    }

    if($_GET['error'] == 'none'){
        echo "<p>Cambio credenziali riuscito con successo!</p>";
    }

    // gestioni errori modifica username
    if($_GET['error'] == 'usernamedontmatch'){
        echo '<p>Inserisci il tuo vecchio nome utente!</p>';
    }

    if($_GET['error'] == 'sameusername'){
        echo "<p>Non puoi cambiare il tuo username con uno uguale!</p>";
    }

    if($_GET['error'] == 'invalidusername'){
        echo "<p>L'username inserito non è valido!</p>";
    }

    if($_GET['error'] == 'usernametaken'){
        echo "<p>Esiste già un utente con questo nome!</p>";
    }

    if($_GET['error'] == 'updatefailed'){
        echo "<p>C'è stato un problema con l'aggiornamento!</p>";
    }

    //gestione errori della parte di modifica email
    if($_GET['error'] == 'emaildontmatch'){
        echo '<p>Inserisci la tua vecchia email!</p>';
    }
    
    if($_GET['error'] == 'sameemail'){
        echo "<p>Non puoi cambiare la tua email con una uguale!</p>";
    }

    if($_GET['error'] == 'invalidemail'){
        echo "<p>La mail inserita non è valida!</p>";
    }

    if($_GET['error'] == 'emailtaken'){
        echo "<p>Questa email non è disponibile!</p>";
    }

    //gestione errori modifica password

    if($_GET['error'] == 'pwddontmatch'){
        echo "<p>Le password non combaciano!</p>";
    }

    if($_GET['error'] == 'invalidpwd'){
        echo "<p>La password inserita non è valida!</p>";
    }   
}
?>
</div>
<?php
include_once './footer.php';
?>
