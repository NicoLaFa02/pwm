<?php
session_start();
include_once './header.php';
?>

<?php include_once '../includes/profilo.inc.php'; ?>

<form id="impostazioni" action="../img/impostazioni.php">
        <button type="submit" name="impostazioni">Impostazioni profilo</button>
</form>
<p></p>

<?php
include_once './footer.php';
?>