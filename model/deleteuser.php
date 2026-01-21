<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../controler/Login.html");
    exit();
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];

    $check = mysqli_query($conn, "SELECT role FROM users WHERE user_id='$user_id'");
    
    if ($check && mysqli_num_rows($check) > 0) {
        $user = mysqli_fetch_assoc($check);

        if ($user['role'] === 'admin' && $user['user_id']='a_1') {
            $error = "Cannot delete main admin!";
        } 

        else {
           
            $sql = "DELETE FROM users WHERE user_id='$user_id'";
            if (mysqli_query($conn, $sql)) {
                $success = "User deleted successfully!";
            } else {
                $error = "Error deleting user: " . mysqli_error($conn);
            }
        }
    } 

    else {
        $error = "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>
    
    <link rel="stylesheet" href="../view/deleteuser.css">
</head>

<body>

<header>
<div class="header">
    <h1>Delete User</h1>
    <a href="logout.php">Logout</a>
</div>
</header>

<div class="container">
    <div class="card">
        <?php if(!empty($error)) { ?>
            <div class="error"><?= $error ?></div>
        <?php } ?>

        <?php if(!empty($success)) { ?>
            <div class="success"><?= $success ?></div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="user_id" placeholder="Enter User ID to delete" >
            <button type="submit">Delete User</button>
        </form>

        <a href="../controler/admindashboard.php" class="back-btn">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>
