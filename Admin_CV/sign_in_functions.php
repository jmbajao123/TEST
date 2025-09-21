<?php
session_start();
include "conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['password'])) {
    function validate($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM ad_users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Store session variables
        $_SESSION['email'] = $row['email'];
        $_SESSION['a_id'] = $row['a_id'];
        $_SESSION['cash_id'] = $row['cash_id'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['ad_usertype'] = $row['ad_usertype'];

        // Check user type and redirect
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {";

        if ($row['ad_usertype'] === "Registrar Account") {
            echo "Swal.fire({
                    title: 'Sign in Success!',
                    text: 'Welcome Registrar to Credentials Verification Sibugay Technical Institute Inc.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'dashboard.php';
                });";
        } elseif ($row['ad_usertype'] === "Cashier Account") {
            echo "Swal.fire({
                    title: 'Sign in Success!',
                    text: 'Welcome Cashier to Credentials Verification Sibugay Technical Institute Inc.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = '../Cashier/dashboard.php';
                });";
        } else {
            echo "Swal.fire({
                    title: 'Access Denied!',
                    text: 'You are not authorized to access this page.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = 'index.php';
                });";
        }

        echo "});
        </script>";
    } else {
        // Login failed
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Login Failed!',
                    text: 'Incorrect Username or Password!',
                    icon: 'error',
                    confirmButtonText: 'Try Again'
                }).then(() => {
                    window.location = 'index.php';
                });
            });
        </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>
