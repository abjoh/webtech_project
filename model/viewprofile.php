<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../controler/Login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT user_name, user_id, role, department FROM users WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    die("User not found");
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    
    <link rel="stylesheet" href="../view/viewprofile.css">
</head>

<body>
<header>
<div class="header">
    <h1>My Profile</h1>
    <a href="logout.php">Logout</a>
</div>
</header>
<div class="container">
    <h2>Profile Details</h2>

    <div class="profile-item">
        <span class="label">Name:</span>
        <span><?= $user['user_name'] ?></span>
    </div>

    <div class="profile-item">
        <span class="label">ID:</span>
        <span><?= $user['user_id'] ?></span>
    </div>

    <div class="profile-item">
        <span class="label">Designation:</span>
        <span><?= ucfirst($user['role']) ?></span>
    </div>

    <?php if ($user['role'] !== 'admin'): ?>
    <div class="profile-item">
        <span class="label">Department:</span>
        <span><?= $user['department'] ?></span>
    </div>
    <?php endif; ?>

    <a href="javascript:history.back()" class="back-btn">← Back</a>
</div>

</body>
</html>
