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

function invalidUsername($username){
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
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

function pwdMatch($pwd, $pwdrepeat){
    $result = null;
    if ($pwd !== $pwdrepeat){
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

function emptyInputLogin($username, $pwd){
    $result = null;
    if (empty($username) || empty($pwd)){
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
    echo "<p>Votazione: $votazioneCampo</p>"; // Stampa la votazione sotto la foto
    echo "</div>";
} else {
    // Se non ci sono informazioni, stampa un messaggio di errore o gestisci diversamente
    echo "Nessuna informazione trovata per il campo con ID $campoID";
}
}