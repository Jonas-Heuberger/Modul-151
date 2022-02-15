<?php
session_start();

if(isset($_SESSION['username']) && !empty($_SESSION['loggedIn'])){
$username = $_SESSION['username'];
    
 echo "<h1>Guten Tag $username</h1>";
 echo "<h1>Das ist eine Session jaa.</h1>";

 echo "<h3><a href='logout.php' class='btn btn-link'>Log Out</a></h3>";
 //echo "<h3><a href'logout.php' class='btn btn-link' role='button'>Logout</a> <!-- Button link --></h3>";
}else{
    echo "<h1>Ihre Session ist abgelaufen. Sie sind erfolgreich ausgeloggt</h1>";
    echo "<h3><a href='login.php' class='btn btn-link'>Log In</a> <a href='index.php' class='btn btn-link'>New Account</a></h3>";
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Allstars</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
</body>
</html>

