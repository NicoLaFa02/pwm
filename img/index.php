<?php
include_once './header.php';
if (isset($_SESSION['username'])){
    echo '<link rel="stylesheet" type="text/css" href="styles.css">';

    echo '<p>Bentornato ' . $_SESSION['username'] . '</p>';
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecenField</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
    h1 {
        text-shadow: 2px 2px green;
    }
</style>
</head>
<body>

<div id="container">
    <div id="div_titolo">
    <h1 id="titolo">Recensioni Campi da Calcio</h1>
    </div>

    
    <label for="ordineRecensioni">Ordina per:</label>
    <select id="ordineRecensioni">
        <option value="data">Data</option>
        <option value="voto">Voto</option>
    </select>

    <form id="recensioneForm">
        <!-- Il resto del tuo form rimane invariato -->
    </form>

    <div id="recensioni-container">
        <!-- Il contenitore delle recensioni verrà riempito dinamicamente con JavaScript -->
    </div>
</div>

<div id="login">
    <form id="pulsante_login" action="../img/login.php">
        <input type="submit" value="login">
    </form>
</div>

<form id="search_bar">
    <input type="text" id="searchInput" placeholder="Cerca recensioni: ...">
</form>

<?php
include_once './campi.php';
?>

<?php
include_once './footer.php';
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/main.js"></script>
<script src="../js/barraric.js"></script>
</body>
</html>
