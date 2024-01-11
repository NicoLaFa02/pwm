<?php

function emptyInputSignup($username, $email, $pwd, $pwdrepeat){
    $result = null;
    if (empty($username) || empty($email) || empty($pwd) || empty($pwdrepeat)){
        $result = true;
    }
    else{  
        $result = false;
    }
    return $result;
}

function invalidStringInput($string){
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9 '\"._,;:*+\\-<>]*$/", $string)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{  
        $result = false;
    }
    return $result;
}

function fieldMatch($firstField, $secondField){
    $result = null;
    if ($firstField !== $secondField){
        $result = true;
    }
    else{  
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username, $email){
    $sql = "SELECT * FROM utenti WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../img/registration.php?error=stmtfailed");
        exit(); 
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return $row;
    }
    else{
        $resultData = false;
        mysqli_stmt_close($stmt);
        return $resultData;
    }

}

function createUser($conn, $username, $email, $pwd){
    $sql = "INSERT INTO utenti(username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../img/registration.php?error=stmtfailed");
        exit(); 
    }

    $hashedPwd= password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../img/registration.php?error=none");
    exit();
}

function emptyInputCheck($firstField, $secondField){
    $result = null;
    if (empty($firstField) || empty($secondField)){
        $result = true;
    }
    else{  
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $userExists = usernameExists($conn, $username, $username);
    //mettere di nuovo $username come 3 parametro garantisce che il controllo nel DB venga effettuato sia sulla mail che sull'username,
    // in modo da poter effettuare l'accesso con uno o con l'altro
    if ($userExists === false){
        header("location: ../img/login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists['password'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false){
        header("location: ../img/login.php?error=incorrectpassword");
        exit();
    }
    else if ($checkPwd === true){
        session_start();
        $_SESSION["uid"] = $userExists["uid"];
        $_SESSION["username"] = $userExists["username"];
        header("location: ../img/index.php");
        exit();
    }
}

function reLoginUser($conn, $username, $pwd){
    $userExists = usernameExists($conn, $username, $username);
    //mettere di nuovo $username come 3 parametro garantisce che il controllo nel DB venga effettuato sia sulla mail che sull'username,
    // in modo da poter effettuare l'accesso con uno o con l'altro
    if ($userExists === false){
        header("location: ../img/login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $userExists['password'];
    
    if ($pwdHashed === $pwd){
        session_start();
        $_SESSION["uid"] = $userExists["uid"];
        $_SESSION["username"] = $userExists["username"];
        header("location: ../img/impostazioni.php?error=none");
        exit(); 
    }
    else{
        header("location: ../img/login.php?error=incorrectpassword");
        exit();
    }
}

// Funzione per ottenere le informazioni dal database
function getCampoInfo($conn, $campoID) {
    // Esegui la query per ottenere le informazioni del campo dal database
    $sql = "SELECT nomeCampo, votazioneCampo, url_foto FROM campoDaCalcio WHERE campoID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../img/index.php?error=stmtfailed");
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "i", $campoID); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Ottieni il risultato della query
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return null;
    }
}


function setLatestReview($conn, $campoID) {
    
    $currentTimestamp = date('Y-m-d H:i:s'); // timestamp corrente

    // Query per aggiornare il campo ultima_rec
    $sql = "UPDATE campoDaCalcio SET ultima_rec = ? WHERE campoID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../img/index.php?error=stmtfailed");
        exit(); 
    }
    mysqli_stmt_bind_param($stmt, "si", $currentTimestamp, $campoID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    // Ottieni il risultato della query
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return null;
    }
}

function stampaCampo($conn, $campoID){
    $campoInfo = getCampoInfo($conn, $campoID);

    // Stampare le informazioni ottenute
    if ($campoInfo) {
        // Se ci sono informazioni sul campo, stampale
        $nomeCampo = $campoInfo['nomeCampo'];
        $votazioneCampo = $campoInfo['votazioneCampo'];
        $urlFoto = $campoInfo['url_foto'];

        // Stampare le informazioni nel formato desiderato
        echo "<div>";
        echo "<h3>$nomeCampo</h3>"; // Stampa il nome del campo sopra la foto
        echo "<img src='$urlFoto' alt='Foto del campo'>"; // Stampa l'immagine del campo
        echo "<p>Votazione: $votazioneCampo &#11088;</p>"; // Stampa la votazione sotto la foto
        // pulsante per andare a recensioni.php passando l'ID del campo
        echo "<a href='../img/recensioni.php?campoID=$campoID'><button>Lascia una recensione</button></a>";
        echo "</div>";
    } else {
        echo "Nessuna informazione trovata per il campo con ID $campoID";
    }
}

function getRecensioniCampo($conn, $campoID) {
    //questa query serve a selezionare le recensioni collegate a quel determinato campoID unendo le informazioni relative all'utente recensore
    $sql = "SELECT recensioni.*, utenti.* 
            FROM recensioni 
            JOIN utenti ON recensioni.UID = utenti.UserID 
            WHERE recensioni.campoID = ?";
    
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return null;
    } else {
        mysqli_stmt_bind_param($stmt, "i", $campoID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $recensioni = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $recensioni[] = $row;
        }
        
        return $recensioni;
    }
}

function updateCampo($conn, $tabella, $record, $vecchio_valore, $nuovo_valore) {
    $sql = "UPDATE $tabella SET $record = ? WHERE $record = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return false;
    }
    mysqli_stmt_bind_param($stmt, "ss", $nuovo_valore, $vecchio_valore);
    if (!mysqli_stmt_execute($stmt)) {
        return false;
    }
    mysqli_stmt_close($stmt);
    return true;
}