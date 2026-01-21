<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location:../controler/Login.html");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name        = $_POST['name'];
    $email       = $_POST['email'];
    $password    = $_POST['password'];
    $role        = $_POST['role'];
    $department  = $_POST['department'];
    $blood_group = $_POST['blood_group'];

    $sql_user = "INSERT INTO users (user_name,email,password,role,department,blood_group)
                 VALUES ('$name','$email','$password','$role','$department','$blood_group')";

    if (mysqli_query($conn, $sql_user)) {
        header("Location:viewusers.php");
        exit();
    } else {
        $error = "User Insert Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>

    <link rel="stylesheet" href="../view/createaccount.css">

    <script>
        function validateForm() {
            let name = document.forms["createForm"]["name"].value;
            let email = document.forms["createForm"]["email"].value;
            let password = document.forms["createForm"]["password"].value;
            let role = document.forms["createForm"]["role"].value;
            let department = document.forms["createForm"]["department"].value;
            let blood = document.forms["createForm"]["blood_group"].value;

            if (name === "" || email === "" || password === "" ||
                role === "" || department === "" || blood === "") {
                alert("All fields are required");
                return false;
            }

            if (!email.includes("@")) {
                alert("Invalid email address");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>

<div class="header">
    <h1>Create Account</h1>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <div class="card">

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form name="createForm" method="POST" onsubmit="return validateForm();">
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">

            <select name="role">
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="faculty">Faculty</option>
                <option value="student">Student</option>
            </select>

            <select name="department">
                <option value="">Select Department</option>
                <option value="CSE">CSE</option>
                <option value="EEE">EEE</option>
                <option value="BBA">BBA</option>
            </select>

            <select name="blood_group">
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>

            <button type="submit">Create User</button>
        </form>

        <a href="../controler/manageuser.php" class="back-btn">← Back to Manage Users</a>
    </div>
</div>

</body>
</html>
