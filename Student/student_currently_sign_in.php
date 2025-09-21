<?php
include 'conn.php';

if (!isset($_SESSION['s_id'])) {
    die("Please log in first.");
}

$s_id = intval($_SESSION['s_id']);

// Query: join students -> course (table name `course`)
$sql = "
    SELECT 
      s.first_name, s.middle_name, s.last_name, s.suffix_name, s.sg,
      s.street, s.barangay, s.municipality, s.province,
      s.date_birth, s.civil_status, s.b_place,  -- Added b_place here
      c.course_name
    FROM students s
    LEFT JOIN course c ON s.c_id = c.c_id
    WHERE s.s_id = ?
";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $s_id);
$stmt->execute();
$result = $stmt->get_result();

$full_name = "";
$course_year = "";
$address = "";
$date_birth = "";
$civil_status = "";
$b_place = "";  // Declare a variable for birthplace

if ($row = $result->fetch_assoc()) {
    // Build full name
    $parts = [];
    if (!empty($row['first_name'])) $parts[] = $row['first_name'];
    if (!empty($row['middle_name'])) $parts[] = $row['middle_name'];
    if (!empty($row['last_name'])) $parts[] = $row['last_name'];
    // suffix only if not empty and not 'none'
    if (!empty($row['suffix_name']) && strtolower($row['suffix_name']) !== 'none') {
        $parts[] = $row['suffix_name'];
    }
    $full_name = implode(' ', $parts);

    // Build Course & Year string
    $course_parts = [];
    if (!empty($row['course_name'])) $course_parts[] = $row['course_name'];
    if (!empty($row['sg'])) $course_parts[] = $row['sg'];

    if (!empty($course_parts)) {
        $course_year = implode(' & ', $course_parts);
    } else {
        $course_year = "Not Assigned";
    }

    // Build Address string
    $address_parts = [];
    if (!empty($row['street'])) $address_parts[] = $row['street'];
    if (!empty($row['barangay'])) $address_parts[] = $row['barangay'];
    if (!empty($row['municipality'])) $address_parts[] = $row['municipality'];
    if (!empty($row['province'])) $address_parts[] = $row['province'];

    if (!empty($address_parts)) {
        $address = implode(', ', $address_parts);
    } else {
        $address = "Not Provided";
    }

    // Format Date of Birth
    if (!empty($row['date_birth'])) {
        $date_birth = date("F d, Y", strtotime($row['date_birth']));
    } else {
        $date_birth = "Not Provided";
    }

    // Civil Status
    if (!empty($row['civil_status'])) {
        $civil_status = $row['civil_status'];
    } else {
        $civil_status = "Not Provided";
    }

    // Birthplace
    if (!empty($row['b_place'])) {
        $b_place = $row['b_place'];
    } else {
        $b_place = "Not Provided";
    }
}

$stmt->close();
// you can close connection if desired: $conn->close();
?>
