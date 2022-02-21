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
