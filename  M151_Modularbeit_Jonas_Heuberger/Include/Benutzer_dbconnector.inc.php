<?php
		$host     = 'localhost'; // host
		$username = 'Benutzer'; // username
		$password = '\(7/ep9~=?HmU8BH'; // Passwort 
		$database = 'todoDatabase'; // database
		
		// mit Datenbank verbinden
		$conn = new mysqli($host, $username, $password, $database);
		
		// fehlermeldung, falls die Verbindung fehl schlägt.
		if ($conn->connect_error) {
		   die('Verbindungsfehler (' . $conn->connect_error . ') '. $conn->connect_error);
		}
		echo "Verbindung erfolgreich";
		?>