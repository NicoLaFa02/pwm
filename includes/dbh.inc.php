<?php
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "pwm";

//creazione connessione
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

//Messaggio di errore se fallisce la connessione
if (!$conn){
    die("Connessione fallita: " . mysqli_connect_error());
}