<?php
include "conn.php";

if (isset($_GET['s_id'])) {
    $s_id = intval($_GET['s_id']);

    // Mark this notification as read
    $update = $conn->prepare("UPDATE students SET a_is_read = 1 WHERE s_id = ?");
    $update->bind_param("i", $s_id);
    $update->execute();

    // Redirect to student info page
    header("Location: students_info.php?s_id=" . $s_id);
    exit;
}
