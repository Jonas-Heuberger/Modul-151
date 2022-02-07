<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Font Roboto from Google-->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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
	  <a class="navbar-brand" href="#"><img width="50" src="data:image/jpeg;base64,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"></a>
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
		  <li><a href="home.php"></a><span class="glyphicon glyphicon-home"> Home</span></li>
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

	

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>