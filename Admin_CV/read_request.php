<?php
include "conn.php";
session_start();

// ✅ Ensure admin is logged in
if (!isset($_SESSION['a_id'])) {
    echo "<script>alert('Unauthorized access. Please log in first.'); window.location.href='login.php';</script>";
    exit();
}

// ✅ Validate req_id
if (!isset($_GET['req_id']) || !is_numeric($_GET['req_id'])) {
    echo "<script>alert('Invalid request.'); window.history.back();</script>";
    exit();
}

$req_id = intval($_GET['req_id']);

// ✅ Update only admin read flag (r_is_read)
if ($stmt = $conn->prepare("UPDATE request SET r_is_read = 1 WHERE req_id = ?")) {
    $stmt->bind_param("i", $req_id);
    $stmt->execute();
    $stmt->close();
}

// ✅ Redirect to request details page
header("Location: request_info.php?req_id=" . $req_id);
exit();
?>
