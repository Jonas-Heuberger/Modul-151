<?php

        $host = 'localhost'; // host
		$username = 'JonasH'; // username
		$password = 'Password'; // Passwort 
		$database = 'W02'; // database

// mit datenbank verbinden
$mysqli = new mysqli($host, $username, $password, $database);

// fehlermeldung, falls die Verbindung fehl schlägt.
if ($mysqli->connect_error){
    die('Connect Error (' . $mysqli->connect_error . ') '. $mysqli->connect_error);
}

?>