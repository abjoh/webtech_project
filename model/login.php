<?php
session_start();
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Simple query (not safe for production)
    $sqll = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $resultl = mysqli_query($conn, $sqll);

    if ($resultl) {
        $num = mysqli_num_rows($resultl);

        if ($num > 0) {
            $user = mysqli_fetch_assoc($resultl);

            // Store user info in session
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['role']      = $user['role'];
            $_SESSION['user_name'] = $user['user_name'];

            // Redirect based on role
            if ($user['role'] == 'admin') {
                header("Location: ../controler/admindashboard.html");
            } 
            else if ($user['role'] == 'faculty') {
                header("Location: ../controler/facultydashboard.html");
            } 
            else if ($user['role'] == 'student') {
                header("Location: ../controler/studentdashboard.html");
            }

            exit();
        } 
        else {
            echo "Invalid email or password";
        }
    } 
    else {
        echo "Query failed: " . mysqli_error($conn);
    }
}
?>
