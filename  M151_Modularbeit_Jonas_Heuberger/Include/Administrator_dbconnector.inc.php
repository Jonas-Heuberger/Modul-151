<?php
		$host     = 'localhost'; // host
		$username = 'Administrator'; // username
		$password = 'c2Q`(_FV9vL}Bx)d'; // Passwort 
		$database = 'todoDatabase'; // database
		
		// mit Datenbank verbinden
		$conn = new mysqli($host, $username, $password, $database);
		
		// fehlermeldung, falls die Verbindung fehl schlägt.
		if ($conn->connect_error) {
		   die('Verbindungsfehler (' . $conn->connect_error . ') '. $conn->connect_error);
		}
		echo "Verbindung erfolgreich";
		?>