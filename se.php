<?php
include 'conn.php';

// Check if student_vcode is provided in GET request
$student_vcode = isset($_GET['student_vcode']) ? trim($_GET['student_vcode']) : '';

// Default values
$student_status = 'Unverified';
$full_name = 'N/A';

if (!empty($student_vcode)) {
    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT student_status, first_name, middle_name, last_name, suffix_name FROM students WHERE student_vcode = ?");
    $stmt->bind_param("s", $student_vcode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $student_status = htmlspecialchars($row['student_status'] ?? 'Unverified');
        
        // Construct full name
        $first_name = htmlspecialchars($row['first_name'] ?? '');
        $middle_name = htmlspecialchars($row['middle_name'] ?? '');
        $last_name = htmlspecialchars($row['last_name'] ?? '');
        $suffix_name = htmlspecialchars($row['suffix_name'] ?? '');
        
        // Exclude suffix_name if it is "None"
        $full_name = trim("$first_name $middle_name $last_name" . ($suffix_name !== 'None' ? " $suffix_name" : ""));
    }
    $stmt->close();
}
?>

<!-- Display Student Information -->
<form>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="mb-2">Credentials Code</h5>
                <span class="mb-2"><?php echo htmlspecialchars($student_vcode); ?></span>
            </div>
            <div class="col-lg-6">
                <h6 class="mb-2"><?php echo $student_status; ?></h6>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-12"><br></div>
        <i class="bi bi-person"></i>
        <label>Student Information</label>
        <div class="col-lg-12"><br></div>
        <div class="row">
            <div class="col-lg-6">
                <label><h6 class="mb-2">Full Name</h6></label><br>
                <span><?php echo $full_name; ?></span>
            </div>
        </div>
    </div>
</form>