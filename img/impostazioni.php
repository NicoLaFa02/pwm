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
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="settings-container">
        <h1>Impostazioni</h1>
        
        <!-- Sezione Modifica Username -->
        <h2>Modifica Username</h2>
        <form action="../includes/updateUsername.inc.php" method="post">
            <label for="oldUsername">Vecchio Username:</label>
            <input type="text" id="oldUsername" name="oldUsername" placeholder="inserisci qua il vecchio username">
            
            <label for="newUsername">Nuovo Username:</label>
            <input type="text" id="newUsername" name="newUsername" placeholder="inserisci qua il nuovo username">
            
            <button type="submit" name="submit">Cambia username</button>
        </form>
        
        <hr>
        
        <!-- Sezione Modifica Email -->
        <h2>Modifica Email</h2>
        <form action="../includes/updateEmail.inc.php" method="post">
            <label for="oldEmail">Vecchia Email:</label>
            <input type="email" id="oldEmail" name="oldEmail" value="<?php echo $userData['email']; ?>">
            
            <label for="newEmail">Nuova Email:</label>
            <input type="email" id="newEmail" name="newEmail">
            
            <button type="submit" name="action" value="changeEmail">Cambia email</button>
        </form>
        
        <hr>
        
        <!-- Sezione Modifica Password -->
        <h2>Modifica Password</h2>
        <form action="../includes/updatePwd.inc.php" method="post">
            <label for="oldPassword">Vecchia Password:</label>
            <input type="password" id="oldPassword" name="oldPassword">
            
            <label for="newPassword">Nuova Password:</label>
            <input type="password" id="newPassword" name="newPassword">
            
            <label for="confirmNewPassword">Conferma Nuova Password:</label>
            <input type="password" id="confirmNewPassword" name="confirmNewPassword">
            
            <button type="submit" name="action" value="changePassword">Cambia password</button>
        </form>
        
        <hr>
        
        <h2>Elimina Account</h2>
        <form action="../includes/deleteAccount.inc.php" method="post">
            <label for="confirmDelete">Conferma Eliminazione dell'Account:</label>
            <input type="checkbox" id="confirmDelete" name="confirmDelete">
            
            <button type="submit" name="deleteAccount">Elimina Account</button>
        </form>
    </div>

</body>
</html>

<?php
//gestione degli errori php
if (isset($_GET['error'])) {
    if($_GET['error'] == 'emptyinput'){
        echo '<p>Riempi tutti i campi!</p>';
    }
    if($_GET['error'] == 'usernamedontmatch'){
        echo '<p>Inserisci il tuo vecchio nome utente!</p>';
    }
    if($_GET['error'] == 'sameusername'){
        echo "<p>Non puoi cambiare il tuo username con lo stesso username!</p>";
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
    if($_GET['error'] == 'none'){
        echo "<p>Cambio username riuscito con successo!</p>";
    }
}
?>
<?php
include_once './footer.php';
?>