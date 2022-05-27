<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ppl_data';

$conn = mysqli_connect($hostname,$username,$password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>