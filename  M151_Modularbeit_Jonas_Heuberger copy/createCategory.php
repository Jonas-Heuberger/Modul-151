<?php
session_start();

//verbindung zur Datenbank Auslagern
include('Include/root_dbconnector.inc.php');




if(isset($_SESSION['username']) && !empty($_SESSION['loggedIn'])){
	$username = $_SESSION['username'];
}

// Initialisierung
$error = $message =  '';
$categoryname = '';

// Wurden Daten mit "POST" gesendet?
if($_SERVER['REQUEST_METHOD'] == "POST"){
  // Ausgabe des gesamten $_POST Arrays
  //echo "<pre>";
  //print_r($_POST);
  //echo "</pre>";

  // vorname vorhanden, mindestens 1 Zeichen und maximal 30 Zeichen lang
  if(isset($_POST['categoryname']) && !empty(trim($_POST['categoryname'])) && strlen(trim($_POST['categoryname'])) <= 30){
    // Spezielle Zeichen Escapen > Script Injection verhindern
    $categoryname = htmlspecialchars(trim($_POST['categoryname']));
  } else {
    // Ausgabe Fehlermeldung
    $error .= "Geben Sie bitte eine korrekte Kategorie ein.<br />";
  }
       
  
	

  // wenn kein Fehler vorhanden ist, schreiben der Daten in die Datenbank
  if(empty($error)){
    //aufgabe, prioritaet, kategorie, faellig, status
    $query = "INSERT INTO Kategorien (name) VALUES (?)";
    // query vorbereiten
    $stmt = $conn->prepare($query);
    if($stmt===false){
      $error .= 'prepare() failed '. $conn->error . '<br />';
    }
    // parameter an query binden
    if(!$stmt->bind_param('s', $categoryname)){
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
		$categoryname = '';
		// verbindung schliessen
		$conn->close();
		// weiterleiten auf admin.php 
		header('Location: admin.php');
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
	<title>Kategorie erstellen</title>
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
      <h1>Kategorie erstellen</h1>
      
      <?php
        // Ausgabe der Fehlermeldungen
        if(!empty($error)){
          echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
        } else if (!empty($message)){
          echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
        }
      ?>
      <form action="" method="post">
        <!-- Kategorien Name -->
        <div class="form-group">
          <label for="categoryname">Kategorie *</label>
          <input type="text" name="categoryname" class="form-control" id="categoryname"
                  value="<?php echo $categoryname ?>"
                  placeholder="Geben Sie den Namen der Kategorie ein."
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


