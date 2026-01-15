<?php
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1. Get inputs
    $email = $_POST['email'];
    $user_name = $_POST['username'];
    $new_password = $_POST['newpass'];

    // 2. Find the user ID using email and username
    $sqlcp = "SELECT user_id FROM users WHERE email = '$email' AND user_name = '$user_name'";
    $resultcp = mysqli_query($conn, $sqlcp);

    if ($resultcp) {

        if (mysqli_num_rows($resultcp) > 0) {

            // 3. Get the user ID
            $row = mysqli_fetch_assoc($resultcp);
            $user_id = $row['user_id'];

            // 4. Update password using ID
            $update = "UPDATE users SET password = '$new_password' WHERE user_id = '$user_id'";
            if (mysqli_query($conn, $update)) {
                header("Location: ../controler/Login.html");
                exit();
            } else {
                echo "Password update failed: " . mysqli_error($conn);
            }

        } else {
            echo "Invalid email or username";
        }

    } else {
        echo "Query failed: " . mysqli_error($conn);
    }
}
?>
