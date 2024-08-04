<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Dashboard</title>
</head>
<body>
    <h2>Admin Dashboard</h2>
    <nav>
        <ul>
            <li><a href="view_employees.php">View Employees</a></li>
            <li><a href="add_employee.php">Add Employee</a></li>
        </ul>
    </nav>
    <a href="logout.php">Logout</a>
</body>
</html>
