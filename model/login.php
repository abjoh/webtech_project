<?php
session_start();
require_once 'db.php';

$error = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query users table
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Store session variables
        $_SESSION['user_id']   = $user['user_id'];   
        $_SESSION['role']      = $user['role'];      
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['email']     = $user['email'];

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: ../controler/admindashboard.php");
        } elseif ($user['role'] == 'faculty') {
            header("Location: ../controler/facultydashboard.php");
        } elseif ($user['role'] == 'student') {
            header("Location: studentdashboard.php");
        }
        exit();

    } else {
        $error = "Invalid email or password"; 
        echo $error;
        echo"<br>";
        echo"<a href=../controler/Login.html>login</a>";
    }
}
?>


