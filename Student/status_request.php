<?php
session_start(); // ✅ Start session
include 'conn.php';

if (!isset($_SESSION['s_id'])) {
    die("Access denied.");
}

if (isset($_GET['req_id'])) {
    $req_id = intval($_GET['req_id']);

    // ✅ Mark only payment notifications as read
    $stmt = $conn->prepare("UPDATE request SET rs_is_read = 1 WHERE req_id = ?");
    $stmt->bind_param("i", $req_id);
    $stmt->execute();
    $stmt->close();

    // ✅ Redirect to request.php
    header("Location: request.php");
    exit;
}
?>
