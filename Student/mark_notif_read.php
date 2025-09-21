<?php
session_start();
include 'conn.php';

if(isset($_POST['s_id'])){
    $s_id = intval($_POST['s_id']);
    $stmt = $conn->prepare("UPDATE students SET sc_is_read = 1 WHERE s_id = ?");
    $stmt->bind_param("i", $s_id);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
?>
