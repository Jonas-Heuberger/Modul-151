<?php
// Verbindung zur DB
include('Include/Administrator_dbconnector.inc.php');

// Initialisierung
$error = $message =  '';
$username = $firstname = $lastname = '';










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
<div class="create">

<!-- Navbar -->

<div>
<h1>Aufgabe</h1>
</div>

<div>
<form action="" method="post">
	<p>Aufgabe:</p>
<textarea name="" id="" cols="50" rows="3"></textarea>
</div>

<div>
<p>Priorität:</p>
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
  		<input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 4
	</label>
	<label class="radio-inline">
  		<input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 5
	</label>
</div>

<div>
Kategorie:
	<select>
	<option>1</option>
	<option>2</option>
	<option>3</option>
	<option>4</option>
	<option>5</option>
	</select>

</div>

<div>
	<p>Bis wann muss die Aufgabe erledigt sein?</p>
	<input type="date" name="Datum" id="">
</div>


<div>
  <p>Status in %:</p>
  <input type="number" min="0" max="100"/>
</div>


<div>
	<span><input type="submit" value="submit"></span>
	<span><input type="reset" value="löschen"></span>
</div>

</form>
</div>





	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</div>
</body>
</html>	
