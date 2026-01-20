
<?php
$host="localhost";
$user="root";
$pass="";
$db="ums";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn){
	die("connection failed:".mysqli_connect_error());
}
?>