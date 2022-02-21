<?php

session_start();




// Verbindung zur DB
include('Include/root_dbconnector.inc.php');

// Initialisierung
$error = $message =  '';
$aufgabe = $prioritaet = $kategorie = $faellig = $status =  '';

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(isset($_POST['aufgabe']) && !empty(trim($_POST['aufgabe'])) && strlen(trim($_POST['aufgabe'])) <= 45){
		
		$aufgabe = htmlspecialchars(trim($_POST['aufgabe']));
	  } else {
		// Ausgabe Fehlermeldung
		$error .= "Es gab einen Fehler.<br />";
	  }
	  if (isset($_POST['prioritaet']) && empty($_POST['prioritaet'])) {
		  $prioritaet = htmlspecialchars($_POST['prioritaet']);
	  } else {
		  $error .= "Es gab einen Fehler. <br />";
	  }

	  if(isset($_POST['kategorie']) && !empty($_POST['kategorie'])) {
		  $kategorie = htmlspecialchars(trim($_POST['kategorie']));
	  } else  {
		  $error .= "Es gab einen Fehler <br />";
	  }

	  if(isset($_POST['faellig']) && !empty($_POST['faellig'])) {
		  $faellig = htmlspecialchars($_POST['faellig']);
	  } else {
		$error .= "Es gab einen Fehler <br />";
	  }

	  if(isset($_POST['status']) &&!empty($_POST['status'])) {
		  $status = htmlspecialchars($_POST['status']);
	  } else {
		$error .= "Es gab einen Fehler <br />";
	  }
}

if(empty($error)){
    //aufgabe, prioritaet, kategorie, faellig, status
    $query = "INSERT INTO Todos (prioritaet, kategorie, aufgabe, faellig, status) VALUES (?,?,?,?,?)";
    // query vorbereiten
    $stmt = $conn->prepare($query);
    if($stmt===false){
      $error .= 'prepare() failed '. $conn->error . '<br />';
    }
    // parameter an query binden
    if(!$stmt->bind_param('isssi', $prioritaet, $kategorie, $aufgabe, $faellig, $status)){
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
		$prioritaet = $kategorie = $aufgabe = $faellig = $status = '';
		// verbindung schliessen
		$conn->close();
		// weiterleiten auf home.php 
		header('Location: home.php');
	  }
	}





?>





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
	<title>Erstellen</title>
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
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div>
<h1>Aufgabe</h1>
</div>

<div>
<form action="" method="post">
	<h3>Aufgabe:</h3>

	<input type="text" class="form-control" placeholder="Beschreibung">
</div>

<div>
<h3>Priorität:</h3>



<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 1
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 2
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 3
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4"> 4
</label>
<label class="radio-inline">
  <input type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5"> 5
</label>

</div>

<div>
<h3>Kategorie:</h3> 
<select class="form-control">
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>

</div>

<div>
	<h3>Bis wann muss die Aufgabe erledigt sein?</h3>
	<input type="date" name="Datum" id="">
</div>


<div>
  <h3>Status in %:</h3>
  <input type="number" class="form-control" min="0" max="100" placeholder="Status in %">
</div>


<div>
<input class="btn btn-default" type="submit" value="Senden">
<input class="btn btn-default" type="reset" value="löschen">
</div>

</form>






	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</div>
</body>
</html>	
