<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<link rel="stylesheet" href="CSS/style.css">
	<title>Bearbeiten</title>
</head>
<body>

<?php
session_start();

include('Include/root_dbconnector.inc.php');

//verbindung zur Datenbank Auslagern
include('Include/root_dbconnector.inc.php');

if(isset($_SESSION['username']) && !empty($_SESSION['loggedIn'])){
	$username = $_SESSION['username'];
}

// Initialisierung
$error = $message =  '';
$username = $firstname = $lastname = '';

// Wurden Daten mit "POST" gesendet?
if($_SERVER['REQUEST_METHOD'] == "POST"){
  // Ausgabe des gesamten $_POST Arrays
  //echo "<pre>";
  //print_r($_POST);
  //echo "</pre>";

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
  


                 
  // kein fehler
	if(empty($error)){
		// query
		$query = "SELECT username from users where username = ?";
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
		$error .= "Ihr Benutzername entspricht nicht der korrekten Namenskonvention oder wird bereits verwendet";
			}
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
    //firstname, lastname, username, password
    $query = "Insert into users (firstname, lastname, username, password) values (?,?,?,?)";
    // query vorbereiten
    $stmt = $conn->prepare($query);
    if($stmt===false){
      $error .= 'prepare() failed '. $conn->error . '<br />';
    }
    // parameter an query binden
    if(!$stmt->bind_param('ssss', $firstname, $lastname, $username, $hashedPassword)){
      $error .= 'bind_param() failed '. $conn->error . '<br />';
    }

    // query ausführen
    if(!$stmt->execute()){
      $error .= 'execute() failed '. $conn->error . '<br />';
    }
    // kein Fehler!
    if(empty($error)){
      $message .= "Die Daten wurden erfolgreich in die Datenbank geschrieben<br/ >";
      // felder leeren > oder weiterleitung auf anderes script: z.B. Login!
      $username = $hashedPassword = $firstname = $lastname =  '';
      // verbindung schliessen
      $conn->close();
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
	<title>Benutzer erstellen</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">


	
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	 <a class="navbar-brand" href="home.php"><p>TO-DO</p></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  <ul class="nav navbar-nav"></ul>
	
	  <form class="navbar-form navbar-left">
		<div class="form-group">
		  <input type="text" class="form-control" placeholder="Search">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	  </form>
	  
	  <ul class="nav navbar-nav navbar-right">
		  <li><a href="admin.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
		  <li><a href="createCategory.php"><span class="glyphicon glyphicon-plus"></span> Kategorie erstellen</a></li>
		<li><a href="#">Angemeldet als: <?php echo $username;?></a></li>
		<li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Ausloggen</a></li>
	  </ul>
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
      <h1>Benutzer erstellen</h1>
      
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
        
        <!-- benutzername -->
        <div class="form-group">
          <label for="username">Benutzername *</label>
          <input type="text" name="username" class="form-control" id="username"
                  value="<?php echo $username ?>"
                  placeholder="Gross- und Keinbuchstaben, min 6 Zeichen."
                  maxlength="30" required="true"
                  pattern="(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}"
                  title="Gross- und Keinbuchstaben, min 6 Zeichen." >
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





	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>	
