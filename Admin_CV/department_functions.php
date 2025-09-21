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
    $department_name = mysqli_real_escape_string($conn, $_POST['department_name']);
    $department_status = mysqli_real_escape_string($conn, $_POST['department_status']);
    $a_id = $_SESSION['a_id']; // Get currently logged-in admin's ID

    // Check if department already exists
    $check_query = "SELECT * FROM departments WHERE department_name = '$department_name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Department name already exists
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Duplicate Entry',
                    text: 'The department name already exists in the database!',
                }).then(() => {
                    window.location.href = 'department.php'; // Redirect to department page
                });
              </script>";
    } else {
        // Insert new department
        $sql = "INSERT INTO departments (department_name, department_status, a_id) VALUES ('$department_name', '$department_status', '$a_id')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Department added successfully!',
                    }).then(() => {
                        window.location.href = 'department.php'; // Redirect to department page
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Database Error!',
                        text: 'An error occurred: " . mysqli_error($conn) . "',
                    }).then(() => {
                        window.location.href = 'department.php'; // Redirect to department page
                    });
                  </script>";
        }
    }

    // Close the connection
    mysqli_close($conn);
}
?>