<?php
session_start();

// Unset all session variables
$_SESSION = array();
session_unset();

// Destroy the session
session_destroy();

// Delete the session cookie (optional but recommended)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signing Out</title>
    <link href="assets/img/cv.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: "Signed Out!",
            html: "You have been signed out successfully.",
            icon: "success",
            showConfirmButton: false,
            timer: 2500, // Auto close after 2.5 seconds
            timerProgressBar: true
        }).then(() => {
            // Redirect to sign in page after SweetAlert
            window.location.href = "../sign_in.php";
        });
    </script>
</body>
</html>
