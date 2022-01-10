<?php
		$host     = 'localhost'; // host
		$username = 'JonasH'; // username
		$password = 'Password'; // Passwort 
		$database = 'W02'; // database
		
		// mit Datenbank verbinden
		$conn = new mysqli($host, $username, $password, $database);
		
		// fehlermeldung, falls die Verbindung fehl schlägt.
		if ($conn->connect_error) {
		   die('Verbindungsfehler (' . $conn->connect_error . ') '. $conn->connect_error);
		}
		echo "Verbindung erfolgreich";
		?>
