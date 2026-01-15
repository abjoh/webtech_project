<?php
require "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Simple query (not safe for production)
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (isset($result)) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            // Login successful, redirect
            header("Location: ../view/Login.html");
            exit();
        } else {
            echo "Credentials don't match";
        }
    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
}
?>