<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.html");
    exit();
}
include 'db.php';

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>View Employees</title>
</head>
<body>
    <h2>Employee List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td><?php echo $row['department']; ?></td>
                <td><?php echo $row['salary']; ?></td>
                <td>
                    <a href="edit_employee.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete_employee.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
