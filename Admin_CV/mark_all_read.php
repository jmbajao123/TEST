<?php
include "conn.php";

// Mark all notifications as read
$conn->query("UPDATE students SET a_is_read = 1");

header("Location: dashboard.php");
exit;
