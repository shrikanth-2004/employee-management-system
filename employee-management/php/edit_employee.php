<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.html");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];

    $sql = "UPDATE employees SET name = ?, email = ?, position = ?, department = ?, salary = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdi", $name, $email, $position, $department, $salary, $id);

    if ($stmt->execute()) {
        echo "Employee updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $employee = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit Employee</title>
</head>
<body>
    <h2>Edit Employee</h2>
    <form action="edit_employee.php" method="post">
        <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $employee['email']; ?>" required>
        <label for="position">Position:</label>
        <input type="text" id="position" name="position" value="<?php echo $employee['position']; ?>">
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" value="<?php echo $employee['department']; ?>">
        <label for="salary">Salary:</label>
        <input type="number" id="salary" name="salary" value="<?php echo $employee['salary']; ?>" step="0.01">
        <button type="submit">Update</button>
    </form>
</body>
</html>
