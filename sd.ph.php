<?php
include 'conn.php';

// Retrieve student verification code from GET request
$student_vcode = $_GET['student_vcode'] ?? '';

// Default values
$default_values = [
    'student_status' => 'Unverified', 'full_name' => 'N/A', 'date_graduation' => 'N/A',
    'date_birth' => 'N/A', 'age' => 'N/A', 'gender' => 'N/A', 'honors' => 'N/A',
    'civil_status' => 'N/A', 'd_id' => '', 'c_id' => '', 'department_name' => 'N/A',
    'course_name' => 'N/A', 'address' => 'N/A', 'date' => 'N/A', 'profile' => 'default.png', 'diploma' => 'default.png', 'graduation' => 'default.png', 'tor' => 'default.png'
];

extract($default_values);

if (!empty(trim($student_vcode))) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_vcode = ?");
    $stmt->bind_param("s", $student_vcode);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        foreach ($default_values as $key => $default) {
            $$key = htmlspecialchars($row[$key] ?? $default);
        }

        // Construct full name
        $full_name = trim(
            htmlspecialchars($row['first_name'] ?? '') . ' ' .
            htmlspecialchars($row['middle_name'] ?? '') . ' ' .
            htmlspecialchars($row['last_name'] ?? '') .
            (!empty($row['suffix_name']) && $row['suffix_name'] !== 'None' ? ' ' . htmlspecialchars($row['suffix_name']) : '')
        );

        // Construct address
        $address = implode(', ', array_filter([
            htmlspecialchars($row['street'] ?? ''),
            htmlspecialchars($row['barangay'] ?? ''),
            htmlspecialchars($row['municipality'] ?? ''),
            htmlspecialchars($row['province'] ?? '')
        ]));

        // Profile image handling
        $profile = !empty($row['profile']) ? 'uploads/' . htmlspecialchars($row['profile']) : 'uploads/default.png';
        $diploma = !empty($row['diploma']) ? 'diploma/' . htmlspecialchars($row['diploma']) : 'diploma/default.png';
        $tor = !empty($row['tor']) ? 'TOR/' . htmlspecialchars($row['tor']) : 'TOR/default.png';
        $graduation = !empty($row['graduation']) ? 'Credentials/' . htmlspecialchars($row['graduation']) : 'Credentials/default.png';
    }
    $stmt->close();

    // Fetch department name
    if (!empty($d_id)) {
        $stmt = $conn->prepare("SELECT department_name FROM departments WHERE d_id = ?");
        $stmt->bind_param("s", $d_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $department_name = htmlspecialchars($row['department_name']);
        }
        $stmt->close();
    }

    // Fetch course name
    if (!empty($c_id)) {
        $stmt = $conn->prepare("SELECT course_name FROM course WHERE c_id = ?");
        $stmt->bind_param("s", $c_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $course_name = htmlspecialchars($row['course_name']);
        }
        $stmt->close();
    }
}
?>

<!-- Display Student Information -->
<form>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <h5 class="mb-2">Credentials Code</h5>
                <span><?php echo htmlspecialchars($student_vcode); ?></span>
            </div>
            <div class="col-lg-6">
                <h6 class="mb-2"><?php echo $student_status; ?></h6>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        <i class="bi bi-person"></i>
        <label>Student Information</label>
        <div class="col-lg-12"><br></div>
        <div class="row">
            <div class="col-lg-12">
                <center>
                    <label><h6 class="mb-2">Profile</h6></label>
                <br>
                <img src="<?php echo $profile; ?>" 
                     alt="Profile Picture" width="250" height="300" >
                </center>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Full Name</h6></label><br>
                <span><?php echo $full_name; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Graduation Date</h6></label><br>
                <span><?php echo !empty($date_graduation) ? date("F j, Y", strtotime($date_graduation)) : 'N/A'; ?></span>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Birthdate</h6></label><br>
                <span><?php echo !empty($date_birth) ? date("F j, Y", strtotime($date_birth)) : 'N/A'; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Department</h6></label><br>
                <span><?php echo $department_name; ?></span>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Age</h6></label><br>
                <span><?php echo $age; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Course</h6></label><br>
                <span><?php echo $course_name; ?></span>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Gender</h6></label><br>
                <span><?php echo $gender; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Honors</h6></label><br>
                <span><?php echo $honors; ?></span>
            </div>
            <div class="col-lg-12"><br></div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Civil Status</h6></label><br>
                <span><?php echo $civil_status; ?></span>
            </div>
            <div class="col-lg-6">
                <label><h6 class="mb-2">Address</h6></label><br>
                <span><?php echo $address; ?></span>
            </div>
        </div>
        <div class="col-lg-12"><br></div>
        <i class="bi bi-calendar"></i>
        <label>Issued Date :</label>
        <span><?php echo !empty($date) ? date("F j, Y", strtotime($date)) : 'N/A'; ?></span>
        <div class="col-lg-12"><br></div>
        <div class="col-lg-12">
            <center>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed d-flex justify-content-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <span class="w-100 text-center">See More Credentials</span>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form method="get" action="student_info.php" class="custom-form mt-4 pt-2 mb-lg-0 mb-5" role="search">
                                                <div class="input-group input-group-lg shadow-sm">
                                                    <span class="input-group-text bg-primary text-white">
                                                        <i class="bi bi-search"></i>
                                                    </span>
                                                    <input name="student_id" type="search" class="form-control border-primary" id="student_id" placeholder="Enter the Credentials Code" aria-label="Search" oninput="validateNumberInput(this)">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-12"><br> </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label><h6 class="mb-2">Certificate of Diploma</h6></label>
                                                <br>
                                                <img src="<?php echo $diploma; ?>" 
                                                     alt="Profile Picture" width="250" height="300" >
                                            </div>
                                            
                                            <div class="col-lg-6">
                                                    <label><h6 class="mb-2">Certificate of Graduation</h6></label>
                                                <br>
                                                <img src="<?php echo $graduation; ?>" 
                                                     alt="Profile Picture" width="250" height="300" >
                                            </div>
                                            <div class="col-lg-12"><br> </div>
                                            <div class="col-lg-12"><br> </div>
                                            <div class="col-lg-6">
                                                    <label><h6 class="mb-2">Transcript of Record (TOR)</h6></label>
                                                <br>
                                                <img src="<?php echo $tor; ?>" 
                                                     alt="Profile Picture" width="250" height="300" >
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php include 'scripts.php'; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </center>

        </div>
    </div>
</form>