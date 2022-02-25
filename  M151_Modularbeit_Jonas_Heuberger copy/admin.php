
<?php
session_start();
include('Include/root_dbconnector.inc.php');

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
	<title>Admin</title>
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





<div class="panel panel-default">
  <!-- Default panel contents -->
<div class="panel-heading">
  <a href="createUser.php"><span class="glyphicon glyphicon-plus"></span> Benutzer erstellen</a>
</div>
<div>

<?php
$sql = "SELECT * FROM Users WHERE role = 0;";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  echo "<table class='table'><tr><th>Benutzername</th><th>Vorname</th><th>Nachname</th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["username"]."</td><td>".$row["firstname"]."</td><td>".$row['lastname']."</td><td class='glyphicon glyphicon-pencil'></td><td class='glyphicon glyphicon-trash'></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
$conn->close();



?>


	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>




	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>	
