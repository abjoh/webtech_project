<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../controler/Login.html");
    exit();
}
$users = mysqli_query($conn, "SELECT user_id, user_name, email, role, department, status FROM users ORDER BY user_name ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Users</title>
    
    <link rel="stylesheet" href="../view/viewusers.css">
</head>

<body>

<div class="header">
    <h1>View Users</h1>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(mysqli_num_rows($users) > 0) { ?>
                <?php while($row = mysqli_fetch_assoc($users)) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['user_id']) ?></td>
                        <td><?= htmlspecialchars($row['user_name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['role']) ?></td>
                        <td><?= htmlspecialchars($row['department']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="6" style="text-align:center; font-weight:bold;">No users found</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="javascript:history.back()" class="back-btn">← Back</a>
</div>
</body>
</html>
