<?php
include 'conn.php';

if (!isset($_SESSION['s_id'])) {
    die("Please log in first.");
}

$s_id = $_SESSION['s_id'];

// Fetch student's year_graduated
$stmt = $conn->prepare("SELECT year_graduated FROM students WHERE s_id = ?");
$stmt->bind_param("i", $s_id);
$stmt->execute();
$result = $stmt->get_result();

$year_graduated = "";
if ($result->num_rows === 1) {
    $student = $result->fetch_assoc();
    $year_graduated = $student['year_graduated'];
}
$stmt->close();
?>