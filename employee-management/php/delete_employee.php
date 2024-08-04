<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.html");
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Employee deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
header("Location: view_employees.php");
exit();
?>
