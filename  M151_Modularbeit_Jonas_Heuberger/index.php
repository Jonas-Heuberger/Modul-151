<?php

//verbindung zur Datenbank Auslagern
include('Include/Administrator_dbconnector.inc.php');
//include('Include/Benutzer_dbconnector.inc.php');

// Initialisierung
$error = $message =  '';
$firstname = $lastname = $email = $username = '';

// Wurden Daten mit "POST" gesendet?
if($_SERVER['REQUEST_METHOD'] == "POST"){
  // Ausgabe des gesamten $_POST Arrays
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";

  // vorname vorhanden, mindestens 1 Zeichen und maximal 30 Zeichen lang
  if(isset($_POST['firstname']) && !empty(trim($_POST['firstname'])) && strlen(trim($_POST['firstname'])) <= 30){
    // Spezielle Zeichen Escapen > Script Injection verhindern
    $firstname = htmlspecialchars(trim($_POST['firstname']));
  } else {
    // Ausgabe Fehlermeldung
    $error .= "Geben Sie bitte einen korrekten Vornamen ein.<br />";
  }

  // nachname vorhanden, mindestens 1 Zeichen und maximal 30 zeichen lang
  if(isset($_POST['lastname']) && !empty(trim($_POST['lastname'])) && strlen(trim($_POST['lastname'])) <= 30){
    // Spezielle Zeichen Escapen > Script Injection verhindern
    $lastname = htmlspecialchars(trim($_POST['lastname']));
  } else {
    // Ausgabe Fehlermeldung
    $error .= "Geben Sie bitte einen korrekten Nachnamen ein.<br />";
  }

  // emailadresse vorhanden, mindestens 1 Zeichen und maximal 100 zeichen lang
  if(isset($_POST['email']) && !empty(trim($_POST['email'])) && strlen(trim($_POST['email'])) <= 100){
    $email = htmlspecialchars(trim($_POST['email']));
    // korrekte emailadresse?
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
      $error .= "Geben Sie bitte eine korrekte Email-Adresse ein<br />";
    }
  } else {
    // Ausgabe Fehlermeldung
    $error .= "Geben Sie bitte eine korrekte Email-Adresse ein.<br />";
  }

  // benutzername vorhanden, mindestens 6 Zeichen und maximal 30 zeichen lang
  if(isset($_POST['username']) && !empty(trim($_POST['username'])) && strlen(trim($_POST['username'])) <= 30){
    $username = trim($_POST['username']);
    // entspricht der benutzername unseren vogaben (minimal 6 Zeichen, Gross- und Kleinbuchstaben)
		if(!preg_match("/(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}/", $username)){
			$error .= "Der Benutzername entspricht nicht dem geforderten Format.<br />";
		}
  } else {
    // Ausgabe Fehlermeldung
    $error .= "Geben Sie bitte einen korrekten Benutzernamen ein.<br />";
  }

  // passwort vorhanden, mindestens 8 Zeichen
  if(isset($_POST['password']) && !empty(trim($_POST['password']))){
    $password = trim($_POST['password']);
    //entspricht das passwort unseren vorgaben? (minimal 8 Zeichen, Zahlen, Buchstaben, keine Zeilenumbrüche, mindestens ein Gross- und ein Kleinbuchstabe)
    if(!preg_match("/(?=^.{8,}$)((?=.*\d+)(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)){
      $error .= "Das Passwort entspricht nicht dem geforderten Format.<br />";
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }
  } else {
    // Ausgabe Fehlermeldung
    $error .= "Geben Sie bitte einen korrekten Nachnamen ein.<br />";
  }

  // wenn kein Fehler vorhanden ist, schreiben der Daten in die Datenbank
  if(empty($error)){
    //firstname, lastname, username, password, email
    $query = "Insert into users (firstname, lastname, username, password, email) values (?,?,?,?,?)";
    // query vorbereiten
    $stmt = $mysqli->prepare($query);
    if($stmt===false){
      $error .= 'prepare() failed '. $mysqli->error . '<br />';
    }
    // parameter an query binden
    if(!$stmt->bind_param('sssss', $firstname, $lastname, $username, $hashedPassword, $email)){
      $error .= 'bind_param() failed '. $mysqli->error . '<br />';
    }

    // query ausführen
    if(!$stmt->execute()){
      $error .= 'execute() failed '. $mysqli->error . '<br />';
    }
    // kein Fehler!
    if(empty($error)){
      $message .= "Die Daten wurden erfolgreich in die Datenbank geschrieben<br/ >";
      // felder leeren > oder weiterleitung auf anderes script: z.B. Login!
      $username = $hashedPassword = $firstname = $lastname = $email =  '';
      // verbindung schliessen
      $mysqli->close();
      // weiterleiten auf login formular
      header('Location: login.php');
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
	<title>Sign Up</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
<!--Font Roboto from Google-->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">


	
</head>
<body>
<div class="container">
      <h1>Registrierung</h1>
      <p>
        Bitte registrieren Sie sich, damit Sie diesen Dienst benutzen können.
      </p>
      <?php
        // Ausgabe der Fehlermeldungen
        if(!empty($error)){
          echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        } else if (!empty($message)){
          echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        }
      ?>
      <form action="" method="post">
        <!-- vorname -->
        <div class="form-group">
          <label for="firstname">Vorname *</label>
          <input type="text" name="firstname" class="form-control" id="firstname"
                  value="<?php echo $firstname ?>"
                  placeholder="Geben Sie Ihren Vornamen an."
                  required="true">
        </div>
        <!-- nachname -->
        <div class="form-group">
          <label for="lastname">Nachname *</label>
          <input type="text" name="lastname" class="form-control" id="lastname"
                  value="<?php echo $lastname ?>"
                  placeholder="Geben Sie Ihren Nachnamen an"
                  maxlength="30"
                  required="true">
        </div>
        <!-- email -->
        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" name="email" class="form-control" id="email"
                  value="<?php echo $email ?>"
                  placeholder="Geben Sie Ihre Email-Adresse an."
                  maxlength="100"
                  required="true">
        </div>
        <!-- benutzername -->
        <div class="form-group">
          <label for="username">Benutzername *</label>
          <input type="text" name="username" class="form-control" id="username"
                  value="<?php echo $username ?>"
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
        <a href="login.php" class="btn btn-link" role="button">Login</a> <!-- Button link -->
      </form>
    </div>


	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>	


