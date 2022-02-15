<?php
session_start();
include('Include/Administrator_dbconnector.inc.php');

if(isset($_SESSION['username']) && !empty($_SESSION['loggedIn'])){
	$username = $_SESSION['username'];
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
	<title>Home</title>
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
	  <a class="navbar-brand" href="#"><p>TO-DO</p></a>
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

	  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"></span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="create.php">Hallo</a></li>
            <li><a href="admin.php">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
		  
		  <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
		<li><a href="#">Angemeldet als: <?php echo $username; ?> </a></li>
		<li><a href="index.php"> <span class="glyphicon glyphicon-log-out"></span> Ausloggen</a></li>
	
	  </ul>
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"> Zu erledigen</div>



<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Prioritaet</th>
      <th scope="col">Kategorie</th>
      <th scope="col">Aufgabe</th>
	  <th scope="col">erstellt</th>
	  <th scope="col">faellig</th>
	  <th scope="col">status</th>
	  <th scope="col">archiv</th>

	  <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Sit</td>
      <td>Amet</td>
      <td>Consectetur</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Adipisicing</td>
      <td>Elit</td>
      <td>Sint</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Hic</td>
      <td>Fugiat</td>
      <td>Temporibus</td>
    </tr>
  </tbody>

</table>


	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>