<?php
require db.php;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$username=$_POST['user_name'];
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$blood_group=$_POST['blood_group'];
	$role=$_POST['role'];
	$status=$_POST['status'];



	$sql="insert into users(user_name,email,password,role,status,user_id,blood_group)values($username,$email,$pass,$role,$status,$blood_group)";
	$result=mysqli_query($conn,$sql);
	if ($result) {
      echo "Data inserted succesfully";
      echo"<br>";
      echo"<a href="../view/adduser.html">Prevvious page</a> ";
	}
	else{
		die(mysqli_error($conn));
	}
}
?>