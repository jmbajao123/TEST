<?php
include "conn.php";

if (!isset($_GET['req_id'])) {
    die("Invalid request.");
}

$req_id = intval($_GET['req_id']);

// Update request notification as read
$stmt = $conn->prepare("UPDATE request SET r_is_read = 1 WHERE req_id = ?");
$stmt->bind_param("i", $req_id);
$stmt->execute();
$stmt->close();

// Redirect to the request details page
header("Location: request.php?req_id=" . $req_id);
exit();
?>
