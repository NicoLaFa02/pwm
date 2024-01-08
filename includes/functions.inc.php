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