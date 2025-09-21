<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Students</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="student.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label><h6>First Name</h6></label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Middle Name</h6></label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Enter Middle Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Last Name</h6></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Suffix Name</h6></label>
                                <select class="form-control" name="suffix_name" required>
                                    <option selected disabled>Choose a Suffix</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                    <option value="None">None</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Date of Birth</h6>
                                </label>
                                <input type="date" name="date_birth" id="date_birth" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Age</h6>
                                </label>
                                <input type="number" name="age" id="age" class="form-control" readonly>
                            </div>
                            <?php include 'date_age.php'; ?>
                            <div class="col-lg-3">
                                <label><h6>Gender</h6></label>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option selected disabled>Choose a Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Civil Status</h6></label>
                                <select class="form-control" name="civil_status" id="civil_status" required>
                                    <option selected disabled>Choose a Civil Status</option>
                                    <option value="Married">Married</option>
                                    <option value="Single">Single</option>
                                    <option value="Divorce">Divorce</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Province</h6>
                                </label>
                                <input type="text" name="province" id="province" class="form-control" placeholder="Input the Provice Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Municipality</h6>
                                </label>
                                <input type="text" name="municipality" id="province" class="form-control" placeholder="Input the Municipality Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Barangay</h6>
                                </label>
                                <input type="text" name="barangay" id="barangay" class="form-control" placeholder="Input the Barangay Name" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Street</h6>
                                </label>
                                <input type="text" name="street" id="street" class="form-control" placeholder="Input the Provice Name" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Place of Birth</h6>
                                </label>
                                <input type="text" name="b_place" id="b_place" class="form-control" placeholder="Input the Birth of Place" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Student Gmail</h6>
                                </label>
                                <input type="text" name="s_gmail" id="s_gmail" class="form-control" placeholder="Input the Student Gmail" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Password</h6>
                                </label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Input the Password" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Confirm Password</h6>
                                </label>
                                <input type="password" name="con_pass" id="con_pass" class="form-control" placeholder="Input the Confirm Password" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label><h6>Profile</h6></label>
                                <input type="file" name="profile" id="profile" class="form-control" required onchange="generateUniqueStudentDetails()">
                            </div>

                            <div class="col-lg-3">
                                <label><h6>Student ID</h6></label>
                                <input type="number" name="student_id" id="student_id" class="form-control" placeholder="Enter Student ID" readonly>
                            </div>

                            <div class="col-lg-3">
                                <label><h6>Student Credential Code</h6></label>
                                <input type="text" name="student_vcode" id="student_vcode" class="form-control" placeholder="Credential Code" readonly>
                            </div>

                            <script>
                                let generatedIds = new Set(); // To store unique Student IDs

                                function generateUniqueStudentDetails() {
                                    let studentIdField = document.getElementById("student_id");
                                    let vCodeField = document.getElementById("student_vcode");

                                    let studentId, verificationCode;

                                    // Generate unique 6-digit numeric Student ID
                                    do {
                                        studentId = Math.floor(100000 + Math.random() * 900000);
                                    } while (generatedIds.has(studentId));

                                    generatedIds.add(studentId);

                                    // Generate alphanumeric verification code (8 characters)
                                    verificationCode = generateAlphanumericCode(8);

                                    studentIdField.value = studentId;
                                    vCodeField.value = verificationCode;
                                }

                                // Function to generate alphanumeric string
                                function generateAlphanumericCode(length) {
                                    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                    let result = '';
                                    for (let i = 0; i < length; i++) {
                                        result += chars.charAt(Math.floor(Math.random() * chars.length));
                                    }
                                    return result;
                                }
                            </script>


                            <?php
                                include 'conn.php';
                                $deptQuery = "SELECT d_id, department_name FROM departments WHERE department_status = 'Active'";
                                $deptResult = mysqli_query($conn, $deptQuery);
                                
                                $courseQuery = "SELECT c_id, course_name, d_id FROM course WHERE course_status = 'Active'";
                                $courseResult = mysqli_query($conn, $courseQuery);
                                
                                $courses = [];
                                while ($row = mysqli_fetch_assoc($courseResult)) {
                                    $courses[$row['d_id']][] = [
                                        'c_id' => $row['c_id'],
                                        'course_name' => $row['course_name']
                                    ];
                                }
                                mysqli_close($conn);
                            ?>

                            <div class="col-lg-3">
                                <label><h6>Department Name</h6></label>
                                <select class="form-control" name="d_id" id="d_id" onchange="filterCourses()">
                                    <option selected disabled>Choose a Department</option>
                                    <?php while ($row = mysqli_fetch_assoc($deptResult)) { ?>
                                        <option value="<?= $row['d_id'] ?>"><?= htmlspecialchars($row['department_name']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label><h6>Course Name</h6></label>
                                <select class="form-control" name="c_id" id="c_id">
                                    <option selected disabled id="defaultOption">Choose a Course</option>
                                    <?php foreach ($courses as $d_id => $courseList) { ?>
                                        <?php foreach ($courseList as $course) { ?>
                                            <option value="<?= $course['c_id'] ?>" data-dept="<?= $d_id ?>" style="display: none;">
                                                <?= htmlspecialchars($course['course_name']) ?>
                                            </option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <script>
                                function filterCourses() {
                                    var selectedDept = document.getElementById("d_id").value;
                                    var courseDropdown = document.getElementById("c_id");
                                    var options = courseDropdown.getElementsByTagName("option");
                                    var defaultOption = document.getElementById("defaultOption");

                                    courseDropdown.value = "";
                                    defaultOption.style.display = "block";
                                    defaultOption.selected = true;

                                    for (var i = 1; i < options.length; i++) {
                                        if (options[i].getAttribute("data-dept") === selectedDept) {
                                            options[i].style.display = "block";
                                        } else {
                                            options[i].style.display = "none";
                                        }
                                    }
                                }
                            </script>
                            <div class="col-lg-3">
                                <label><h6>School Year Graduated</h6></label>
                                <input type="text" name="year_graduated" id="year_graduated" class="form-control" placeholder="Input the Year Graduated" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Date of  Graduation</h6></label>
                                <input type="date" name="date_graduation" id="date_graduation" class="form-control" placeholder="Input the Date of Graduation" required>
                            </div>
                            
                            <div class="col-lg-3">
                                <label>
                                    <h6>Honors</h6>
                                </label>
                                <input type="text" name="honors" id="honors" class="form-control" placeholder="Input the Honors Name" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-3">
                                <label>
                                    <h6>Certificate of Diploma</h6>
                                </label>
                                <input type="file" name="diploma" id="diploma" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Certificate of Graduation</h6>
                                </label>
                                <input type="file" name="graduation" id="graduation" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label>
                                    <h6>Transcipt of Records (TOR)</h6>
                                </label>
                                <input type="file" name="tor" id="tor" class="form-control" required>
                            </div>
                            <div class="col-lg-3">
                                <label><h6>Status</h6></label>
                                <select class="form-control" name="student_status">
                                    <option selected disabled>Select Status</option>
                                    <option value="Verified">Verified</option>
                                    <option value="Not Verified">Not Verified</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer mt-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary">Add now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>