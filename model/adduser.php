<?php
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$username=$_POST['username'];
	$email=$_POST['email'];
	$pass=$_POST['password'];
	$blood_group=$_POST['blood_group'];
	$role=$_POST['role'];
	$department=$_POST['department'];
	
    

	$sql="insert into users(user_name,email,password,role,blood_group,department)values('$username','$email','$pass','$role','$blood_group','$department')";
	$result=mysqli_query($conn,$sql);
	if ($result) {
      echo "Data inserted succesfully";
      echo"<br>";
       echo '<a href="../controler/adduser.html">Previous page</a>';	}
	else{
		die(mysqli_error($conn));
	}
}

?>
