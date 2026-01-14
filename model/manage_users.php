<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    $_SESSION['admin'] = "Admin"; // just for demo
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy();
    echo "<script>window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #4a6485;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main Box */
        .dashboard {
            width: 500px;
            background: #f6f5edfa;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 25px;
        }

        /* Header */
        .dashboard-header {
            background: #2c3e50;
            color: #f8f4f4;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 10px;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Form Table */
        form table {
            width: 100%;
            border-collapse: collapse;
            
            
        }

        td {
            padding: 5px 5px;
            font-weight: bold;
            font-size: 16px;
            vertical-align:middle;
            
        }

        input[type="text"], input[type="email"], select {
            width: 100%;
            padding: 7px;
            border-radius: 6px;
            border: 1px solid #a29c9c;
            font-size: 13px;
            box-sizing: border-box;
        }

        /* Status checkboxes inline */
        .status-checkbox {
            display: flex;
            gap: 15px;
            margin-top: 5px;
        }

        /* Buttons */
        .btn {
    width: 100%;
    padding: 10px;
    font-size: 15px;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: #fff;
    margin: 10px auto 0 auto; /* top margin 10px, left/right auto */
    display: block;            /* make button a block element */
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

        .btn-add {
            background: #27ae60;
        }

        .btn-cancel {
            background: #e74c3c;
        }

        .btn-back {
            background: #21abeb;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        /* Footer Logout */
        .dashboard-footer {
            margin-top: 20px;
            text-align: right;
        }

        .logout {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .logout:hover {
            background: #491812;
        }
    </style>
</head>
<body>
<main class="dashboard">

    <!-- Header -->
    <div class="dashboard-header">
        Manage Users
    </div>

    <!-- Form -->
    <form method="post">
        <table>
            <tr>
    <td style="width: 25%;">Name  :</td> <!-- smaller width for label -->
    <td><input type="text" name="name" placeholder="Enter name"></td>
</tr>
            <tr>
                <td>Email :</td>
                <td><input type="email" name="email" placeholder="Enter email"></td>
            </tr>
            <tr>
                <td>Role    :</td>
                <td>
                    <select name="role">
                        <option value="" disabled selected>Select the role</option>
                        <option>Student</option>
                        <option>Faculty</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <div class="status-checkbox">
                        <label><input type="checkbox" name="status" value="Active" onclick="checkOnly(this)"> Active</label>
                        <label><input type="checkbox" name="status" value="Deactive" onclick="checkOnly(this)"> Deactive</label>
                    </div>
                </td>
            </tr>
        </table>

        <!-- Buttons -->
        <button type="submit" class="btn btn-add">Add User</button>
        <button type="button" class="btn btn-back" onclick="window.location='admin.php'">Back to Dashboard</button>
    </form>

    <!-- Footer Logout -->
    <div class="dashboard-footer">
        <form method="post">
            <button class="logout" name="logout">Logout</button>
        </form>
    </div>

</main>

<script>
    // Only one status checkbox can be selected
    function checkOnly(box) {
        const checkboxes = document.getElementsByName('status');
        checkboxes.forEach((cb) => {
            if(cb !== box) cb.checked = false;
        });
    }
</script>

</body>
</html>
