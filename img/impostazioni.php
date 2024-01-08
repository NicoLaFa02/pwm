<?php
include_once './header.php';
?>

<?php

// Verifica se l'utente è loggato
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

require_once '../includes/dbh.inc.php';
require_once '../includes/functions.inc.php';

?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impostazioni</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="settings-container">
        <h1>Impostazioni</h1>
        
        <!-- Sezione Modifica Username -->
        <h2>Modifica Username</h2>
        <form action="update_username.php" method="post">
            <label for="oldUsername">Vecchio Username:</label>
            <input type="text" id="oldUsername" name="oldUsername" value="<?php echo $userData['username']; ?>">
            
            <label for="newUsername">Nuovo Username:</label>
            <input type="text" id="newUsername" name="newUsername">
            
            <button type="submit" name="updateUsername">Salva Modifiche</button>
        </form>
        
        <hr>
        
        <!-- Sezione Modifica Email -->
        <h2>Modifica Email</h2>
        <form action="update_email.php" method="post">
            <label for="oldEmail">Vecchia Email:</label>
            <input type="email" id="oldEmail" name="oldEmail" value="<?php echo $userData['email']; ?>">
            
            <label for="newEmail">Nuova Email:</label>
            <input type="email" id="newEmail" name="newEmail">
            
            <button type="submit" name="updateEmail">Salva Modifiche</button>
        </form>
        
        <hr>
        
        <!-- Sezione Modifica Password -->
        <h2>Modifica Password</h2>
        <form action="update_password.php" method="post">
            <label for="oldPassword">Vecchia Password:</label>
            <input type="password" id="oldPassword" name="oldPassword">
            
            <label for="newPassword">Nuova Password:</label>
            <input type="password" id="newPassword" name="newPassword">
            
            <label for="confirmNewPassword">Conferma Nuova Password:</label>
            <input type="password" id="confirmNewPassword" name="confirmNewPassword">
            
            <button type="submit" name="updatePassword">Salva Modifiche</button>
        </form>
        
        <hr>
        
        <h2>Elimina Account</h2>
        <form action="delete_account.php" method="post">
            <label for="confirmDelete">Conferma Eliminazione dell'Account:</label>
            <input type="checkbox" id="confirmDelete" name="confirmDelete">
            
            <button type="submit" name="deleteAccount">Elimina Account</button>
        </form>
    </div>

</body>
</html>


<?php
include_once './footer.php';
?>