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
    <style>
        body { font-family: Arial, sans-serif; margin:0; background:#f4f4f4; }
        .header { background:#0077cc; color:white; padding:20px 40px; display:flex; justify-content:space-between; align-items:center; }
        .header a { color:white; text-decoration:none; font-weight:bold; }
        .container { max-width:500px; margin:50px auto; background:white; padding:30px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.15); }
        h2 { text-align:center; margin-bottom:25px; }
        .profile-item { margin-bottom:15px; }
        .label { font-weight:bold; margin-right:10px; }
        .back-btn { display:inline-block; padding:10px 20px; background:#0077cc; color:white; text-decoration:none; border-radius:6px; margin-top:20px; }
        .back-btn:hover { background:#005fa3; }
    </style>
</head>
<body>

<div class="header">
    <h1>My Profile</h1>
    <a href="logout.php">Logout</a>
</div>

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
