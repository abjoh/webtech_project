<?php
session_start();
require_once 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location:../controler/Login.html");
    exit();
}


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
        $error = "User Insert Failed: " . mysqli_error($conn);
        echo"error";
        echo"<a href=../controler/Login.html>Back to login</a>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        
        .header {
            background-color: #0077cc;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .header a:hover {
            text-decoration: underline;
        }

        
        .container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            padding: 40px 20px; 
        }

        .card {
            width: 100%;
            max-width: 450px;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            text-align: center;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 15px;
        }

        button {
            background-color: #0077cc;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #005fa3;
        }

        .back-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #555;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Create Account</h1>
    <a href="logout.php">Logout</a>
</div>


<div class="container">
    <div class="card">

        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <select name="role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="faculty">Faculty</option>
                <option value="student">Student</option>
            </select>

            <select name="department" required>
                <option value="">Select Department</option>
                <option value="CSE">CSE</option>
                <option value="EEE">EEE</option>
                <option value="BBA">BBA</option>
            </select>
            <select name="blodd_group" required>
                <option value="">Select Blood-group</option>
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
