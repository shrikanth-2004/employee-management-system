<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.html");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO employees (name, email, position, department, salary) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssd", $name, $email, $position, $department, $salary);

    if ($stmt->execute()) {
        echo "Employee added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Employee</title>
</head>
<body>
    <h2>Add Employee</h2>
    <form action="add_employee.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="position">Position:</label>
        <input type="text" id="position" name="position">
        <label for="department">Department:</label>
        <input type="text" id="department" name="department">
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" step="0.01">
        <button type="submit">Add</button>
    </form>
</body>
</html>
