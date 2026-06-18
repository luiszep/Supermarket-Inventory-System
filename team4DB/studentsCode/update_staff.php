<?php
session_start();
require_once('../config.php');
require_once('../validate_session.php');

if (!isset($_POST['id'])) {
    echo "No Staff ID received on update request.";
    exit;
}

$id = intval($_POST['id']);
$name = $_POST['name'];
$salary = $_POST['salary'];
$email = $_POST['email'];
$position = $_POST['position'];
$time_worked = $_POST['time_worked'];
$dob = $_POST['dob'];
$bname = $_POST['bname'];

$stmt = $conn->prepare("UPDATE Staff 
                        SET Name = ?, Salary = ?, Email = ?, Position = ?, `Time Worked` = ?, DOB = ?, BName = ?
                        WHERE ID = ?");

if ($stmt === false) {
    echo "Prepare failed: " . htmlspecialchars($conn->error);
    exit;
}

$stmt->bind_param("sssssssi", $name, $salary, $email, $position, $time_worked, $dob, $bname, $id);

if ($stmt->execute()) {
    header("Location: view_Staff.php");
    exit;
} else {
    echo "UPDATE FAILED: " . htmlspecialchars($stmt->error);
    exit;
}

$stmt->close();
$conn->close();
?>
