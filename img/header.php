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
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <header class="header-container">
        <nav class="header-sections">
            <div class="header-content">
            <ul>
                <li><a class="link_nav-bar" href="../img/">HOME</a></li>
                <li><a class="link_nav-bar" href="../img/impostazioni.php">IMPOSTAZIONI</a></li>
                <?php
                if (isset($_SESSION['username'])){
                    echo '<li><a class="link_nav-bar" href="../img/impostazioni.php">IMPOSTAZIONI ACCOUNT</a></li>';
                    echo '<li><a class="link_nav-bar" href="./profilo.php" >PROFILO</a></li>';
                    echo '<li><a class="link_nav-bar" href="../includes/logout.inc.php">LOGOUT</a></li>';
                }
                else{
                    echo '<li><a class="link_nav-bar" href="./login.php">LOGIN</a></li>';
                    echo '<li><a class="link_nav-bar" href="./registration.php">REGISTRAZIONE</a></li>';
                }
                ?>
                
            </ul>
        </div>
        </nav>
    </header>
