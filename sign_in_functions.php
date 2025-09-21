<?php
session_start();
include 'conn.php'; // database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get inputs safely
    $s_gmail = isset($_POST['s_gmail']) ? trim($_POST['s_gmail']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check empty fields
    if (empty($s_gmail) || empty($password)) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <title>Please fill in all fields | Credentials Verifications</title>
            <link rel='shortcut icon' href='images/cv.png' type='image/x-icon'>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Please fill in all fields!',
            }).then(() => {
                window.history.back();
            });
        </script>
        </body>
        </html>";
        exit;
    }

    // Prepare statement
    $stmt = $conn->prepare("SELECT u_id, s_id, s_gmail, password FROM users WHERE s_gmail = ?");
    $stmt->bind_param("s", $s_gmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables (DO NOT store password!)
            $_SESSION['u_id'] = $user['u_id'];
            $_SESSION['s_id'] = $user['s_id'];
            $_SESSION['s_gmail'] = $user['s_gmail'];
            $_SESSION['password'] = $user['password'];

            // Fetch student full name
            $s_id = $user['s_id'];
            $stmt2 = $conn->prepare("SELECT first_name, middle_name, last_name, suffix_name FROM students WHERE s_id = ?");
            $stmt2->bind_param("i", $s_id);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows === 1) {
                $student = $result2->fetch_assoc();

                // Build full name
                $full_name = $student['first_name'];
                if (!empty($student['middle_name'])) {
                    $full_name .= ' ' . $student['middle_name'];
                }
                $full_name .= ' ' . $student['last_name'];
                if (!empty($student['suffix_name']) && strtolower($student['suffix_name']) !== 'none') {
                    $full_name .= ' ' . $student['suffix_name'];
                }
            } else {
                $full_name = "Student";
            }

            // SweetAlert success and redirect
            echo "<!DOCTYPE html>
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <title>Sign In Successful | Credentials Verifications</title>
                <link rel='shortcut icon' href='images/cv.png' type='image/x-icon'>
            </head>
            <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sign in Successful!',
                    html: '<b>Welcome back, " . addslashes(htmlspecialchars($full_name)) . "!</b>',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'Student/home.php';
                });
            </script>
            </body>
            </html>";
            exit;
        } else {
            // Incorrect password
            echo "<!DOCTYPE html>
            <html>
            <head>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <title>Incorrect Password | Credentials Verifications</title>
                <link rel='shortcut icon' href='images/cv.png' type='image/x-icon'>
            </head>
            <body>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect Password',
                    text: 'Please try again!',
                }).then(() => {
                    window.history.back();
                });
            </script>
            </body>
            </html>";
        }
    } else {
        // Email not found
        echo "<!DOCTYPE html>
        <html>
        <head>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <title>Email Not Found | Credentials Verifications</title>
            <link rel='shortcut icon' href='images/cv.png' type='image/x-icon'>
        </head>
        <body>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Email Not Found',
                text: 'Please check your email!',
            }).then(() => {
                window.history.back();
            });
        </script>
        </body>
        </html>";
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: ../index.php");
    exit;
}
?>
