<?php

//Datenbankverbindung
include('Include/root_dbconnector.inc.php');


$error = '';
$message = '';

// Formular wurde gesendet und Besucher ist noch nicht angemeldet.
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error)){
	// username
	if(!empty(trim($_POST['username']))){

		$username = trim($_POST['username']);
		
		// prüfung Benutzername
		if(!preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}/", $username) || strlen($username) > 30){
			$error .= "Der Benutzername entspricht nicht dem geforderten Format.<br />";
		}
	}else{
		$error .= "Geben Sie bitte den Benutzername an.<br />";
	}
	// password
	if(!empty(trim($_POST['password']))){
		$password = trim($_POST['password']);
		// passwort gültig?
		if(!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)){
			$error .= "Das Passwort entspricht nicht dem geforderten Format.<br />";
		}
	}else{
		$error .= "Geben Sie bitte das Passwort an.<br />";
	}
	
	// kein fehler
	if(empty($error)){
		// query
		$query = "SELECT username, password, role from Users where username = ?";
		// query vorbereiten
		$stmt = $conn->prepare($query);
		if($stmt===false){
			$error .= 'prepare() failed '. $conn->error . '<br />';
		}
		// parameter an query binden
		if(!$stmt->bind_param("s", $username)){
			$error .= 'bind_param() failed '. $conn->error . '<br />';
		}
		// query ausführen
		if(!$stmt->execute()){
			$error .= 'execute() failed '. $conn->error . '<br />';
		}
		// daten auslesen
		$result = $stmt->get_result();
		// benutzer vorhanden
		if($result->num_rows){
			// userdaten lesen
			$row = $result->fetch_assoc();
			// Passwort prüfen und Role überprüfen
			if($row['role'] == 1){
			if(password_verify($password, $row['password'])){
				$message .= "Sie sind nun eingeloggt";
				session_start();
				session_regenerate_id();
				$_SESSION['username'] = $username;
				$_SESSION['loggedIn'] = true;
				header('Location: admin.php');
			}
			// benutzername oder passwort stimmen nicht,
			}elseif(password_verify($password, $row['password'])){
				$message .= "Sie sind nun eingeloggt";
				session_start();
				session_regenerate_id();
				$_SESSION['username'] = $username;
				$_SESSION['loggedIn'] = true;
				header('Location: home.php');
			}
			
			else{
				$error .= "Benutzername oder Passwort ist falsch";
			} 
		}
	}
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log In</title>
	<!-- Latest compiled and minified CSS -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">


	
</head>
<body>
<div class="container">
			<h1>Login</h1>
			<p>
				Bitte melden Sie sich mit Benutzernamen und Passwort an.
			</p>
			<?php
				// fehlermeldung oder nachricht ausgeben
				if(!empty($message)){
					echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
				} else if(!empty($error)){
					echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
				}
			?>
			<form action="" method="POST">
				<div class="form-group">
				<label for="username">Benutzername *</label>
				<input type="text" name="username" class="form-control" id="username"
						value=""
						placeholder="Gross- und Keinbuchstaben, min 6 Zeichen."
						maxlength="30" required="true"
						pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}"
						title="Gross- und Keinbuchstaben, min 6 Zeichen.">
				</div>
				<!-- password -->
				<div class="form-group">
					<label for="password">Password *</label>
					<input type="password" name="password" class="form-control" id="password"
							placeholder="Gross- und Kleinbuchstaben, Zahlen, Sonderzeichen, min. 8 Zeichen, keine Umlaute"
							pattern="(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
							title="mindestens einen Gross-, einen Kleinbuchstaben, eine Zahl und ein Sonderzeichen, mindestens 8 Zeichen lang,keine Umlaute."
							required="true">
				</div>
		  		<button type="submit" name="button" value="submit" class="btn btn-info">Submit</button>
		  		<button type="reset" name="button" value="reset" class="btn btn-warning">Clear</button>
			</form>
		</div>



	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>	
