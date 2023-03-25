<?php



// //$conn = mysqli_connect($sname, $unmae, $password, $db_name);
// $conn=new PDO(mysql:host=localhost;dbname=test_db;"root","");
// if (!$conn):
// 	echo "Connection failed!";

// else:
// 	echo "Connection Successful";
// endif;



$servername = "localhost";
$username = "root";
$password = "";

try {
	$conn = new PDO("mysql:host=$servername;dbname=test_db", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connected successfully";
  } catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
  }
?>