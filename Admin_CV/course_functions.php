<?php
session_start();
include 'conn.php';

// Check if admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'You must be logged in to perform this action.',
            }).then(() => {
                window.location.href = 'index.php'; // Redirect to login page
            });
          </script>";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $d_id = mysqli_real_escape_string($conn, $_POST['d_id']);
    $course_name = mysqli_real_escape_string($conn, trim($_POST['course_name']));
    $course_status = mysqli_real_escape_string($conn, $_POST['course_status']);
    $a_id = $_SESSION['a_id']; // Get currently logged-in admin's ID

    // Check if the course already exists in the department
    $check_query = "SELECT * FROM course WHERE course_name = '$course_name' AND d_id = '$d_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Course already exists in the selected department
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Duplicate Entry',
                    text: 'The course already exists in this department!',
                }).then(() => {
                    window.location.href = 'courses.php'; // Redirect to courses page
                });
              </script>";
    } else {
        // Insert new course
        $sql = "INSERT INTO course (d_id, course_name, course_status, a_id) VALUES ('$d_id', '$course_name', '$course_status', '$a_id')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Course added successfully!',
                    }).then(() => {
                        window.location.href = 'courses.php'; // Redirect to courses page
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Database Error!',
                        text: 'An error occurred: " . mysqli_error($conn) . "',
                    }).then(() => {
                        window.location.href = 'courses.php'; // Redirect to courses page
                    });
                  </script>";
        }
    }

    // Close the connection
    mysqli_close($conn);
}
?>
