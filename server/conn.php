<?php 

$servername = "localhost";
$username = "root";
$password = "";
try {
      $conn = new PDO("mysql:host=$servername;dbname=jiofox", $username, $password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $Response['dbcon'] = "Connected successfully"; 
    }
catch(PDOException $e)
    {
		  $errors['dberr'] = "Connection failed: " . $e->getMessage();
    }
?>