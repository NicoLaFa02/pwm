<!-- header.php -->
<?php
    session_start();
?>

<style>
    <?php include '../css/style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecenField</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <header class="header-container">
        <nav class="header-sections">
            <ul>
                <li><a class="link_nav-bar" href="../img/">HOME</a></li>
                <?php
                if (isset($_SESSION['username'])){
                    echo '<li><a class="link_nav-bar" href="./profilo.php" >PROFILO</a></li>';
                    echo '<li><a class="link_nav-bar" href="../includes/logout.inc.php">LOGOUT</a></li>';
                }
                else{
                    echo '<li><a class="link_nav-bar" href="./login.php">LOGIN</a></li>';
                    echo '<li><a class="link_nav-bar" href="./registration.php">REGISTRAZIONE</a></li>';
                }
                ?>
                
            </ul>
        </nav>
    </header>
