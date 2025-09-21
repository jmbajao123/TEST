<?php
include 'conn.php';
session_start();

// Check if the session variable 'a_id' is set
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Session expired. Please log in again.'); window.location.href='login.php';</script>";
    exit();
}

$a_id = $_SESSION['a_id']; // Logged-in admin ID

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (!isset($_POST['d_id'], $_POST['c_id'], $_POST['first_name'], $_POST['last_name'], $_POST['student_id'], $_POST['student_vcode'], $_POST['student_status'])) {
        echo "<script>alert('Missing required fields.'); window.history.back();</script>";
        exit();
    }

    // Sanitize and validate inputs
    $d_id = mysqli_real_escape_string($conn, $_POST['d_id']);
    $c_id = mysqli_real_escape_string($conn, $_POST['c_id']);
    $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
    $middle_name = isset($_POST['middle_name']) ? mysqli_real_escape_string($conn, trim($_POST['middle_name'])) : "";
    $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));
    $suffix_name = isset($_POST['suffix_name']) ? mysqli_real_escape_string($conn, $_POST['suffix_name']) : "";
    $student_id = mysqli_real_escape_string($conn, trim($_POST['student_id']));
    $student_vcode = mysqli_real_escape_string($conn, trim($_POST['student_vcode']));
    $student_status = mysqli_real_escape_string($conn, $_POST['student_status']);

    // Check if the selected course (c_id) belongs to the selected department (d_id)
    $courseQuery = "SELECT c_id FROM course WHERE c_id = '$c_id' AND d_id = '$d_id' AND course_status = 'Active'";
    $courseResult = mysqli_query($conn, $courseQuery);

    if (mysqli_num_rows($courseResult) == 0) {
        echo "<script>alert('Invalid course selection. Please choose a valid course for the selected department.'); window.history.back();</script>";
        exit();
    }

    // Insert student data into the database
    $sql = "INSERT INTO students (d_id, c_id, first_name, middle_name, last_name, suffix_name, student_id, student_vcode, student_status, a_id) 
            VALUES ('$d_id', '$c_id', '$first_name', '$middle_name', '$last_name', '$suffix_name', '$student_id', '$student_vcode', '$student_status', '$a_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Student added successfully!'); window.location.href='student.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.history.back();</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
}
