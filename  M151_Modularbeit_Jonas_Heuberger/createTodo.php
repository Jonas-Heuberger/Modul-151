<?php

session_start();

// Verbindung zur DB
include('Include/root_dbconnector.inc.php');

if(isset($_SESSION['username']) && !empty($_SESSION['loggedIn'])){
	$username = $_SESSION['username'];
}

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
	<title>Aufgabe erstellen</title>
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
		  <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
		  <li><a href="archiv.php"><span class="glyphicon glyphicon-folder-open"></span> Archiv</a></li>
		<li><a href="#">Angemeldet als: <?php echo $username;?></a></li>
		<li><a href="index.php"><span class="glyphicon glyphicon-log-out"></span> Ausloggen</a></li>
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

	<input type="text" class="form-control" placeholder="Beschreibung" required>
</div>

<div>
<h3>Priorität:</h3>

<label class="radio-inline" required>
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

<?php

$sql = "SELECT name FROM Kategorien";
$kategorien = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Name</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
	  echo "<select name='categoryname class='form-control' required>";
    echo "<tr><td>".$row["name"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
	
  }
  echo "</table>";
}


$query_category = "SELECT name from Kategorien where name = ?";
$result = $conn->query($query_category);

echo "<select name='kategorie' id='kategorie' class='form-control' required>";
                foreach ($kategorien as $kategorie) {
                    $kategorie_id = $kategorie['tbl_kategorien_kategorie_id'];
                    $kategories = $kategorie['kategorie'];
                echo "<option value='$kategorie_id' class='form-control'>$kategories</option>";
}
echo "</select>";

?>

<select class="form-control" required>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>

</div>

<div>
	<h3>Bis wann muss die Aufgabe erledigt sein?</h3>
	<input type="date" name="Datum" id="" required>
</div>


<div>
  <h3>Status in %:</h3>
  <input type="number" class="form-control" min="0" max="100" placeholder="Status in %" required>
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
