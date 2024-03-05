<?php
 
//Parametere til databaseserver
$host = 'localhost';
$brukernavn = 'root';
$passord = '';
$database = 'ansatt';
 
//Lag en forbindelses-streng
$conn = mysqli_connect($host, $brukernavn, $passord, $database);
 
//Sjekk forbindelsen
if(!$conn)
    {
    die("Feil med oppkobling" . mysqli_connect_error());
    }