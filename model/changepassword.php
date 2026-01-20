<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $user_id = $_POST['user_id'];
    $newpass = $_POST['newpass'];

    
    $sql = "SELECT * FROM users WHERE email='$email' AND user_id='$user_id'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "<script>alert('Database error.'); window.history.back();</script>";
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        
        $update = "UPDATE users SET password='$newpass' WHERE email='$email' AND user_id='$user_id'";
        if (mysqli_query($conn, $update)) {
            echo "<script>alert('Password updated successfully!'); window.location.href='Login.html';</script>";
        } else {
            echo "<script>alert('Failed to update password.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Wrong credentials!'); window.history.back();</script>";
    }
}
?>
