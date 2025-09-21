<div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>First Name</h6>
                </label>
                <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($row['first_name'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Middle Name</h6>
                </label>
                <input type="text" name="middle_name" class="form-control" value="<?php echo htmlspecialchars($row['middle_name'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Last Name</h6>
                </label>
                <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($row['last_name'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Suffix Name</h6>
                </label>
                <select class="form-control" name="suffix_name" disabled>
                    <option value="">Choose a Suffix Name</option>
                    <option value="Jr" <?php echo ($row['suffix_name'] ?? '' == 'Jr') ? 'selected' : ''; ?>>Jr</option>
                    <option value="Sr" <?php echo ($row['suffix_name'] ?? '' == 'Sr') ? 'selected' : ''; ?>>Sr</option>
                    <option value="III" <?php echo ($row['suffix_name'] ?? '' == 'III') ? 'selected' : ''; ?>>III</option>
                    <option value="IV" <?php echo ($row['suffix_name'] ?? '' == 'IV') ? 'selected' : ''; ?>>IV</option>
                    <option value="V" <?php echo ($row['suffix_name'] ?? '' == 'V') ? 'selected' : ''; ?>>V</option>
                    <option value="None" <?php echo ($row['suffix_name'] ?? '' == 'None') ? 'selected' : ''; ?>>None</option>
                </select>
            </div>

            

            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Birthdate</h6>
                </label>
                <input type="text" name="date_birth" class="form-control" value="<?php echo htmlspecialchars($row['date_birth'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Age</h6>
                </label>
                <input type="text" name="age" class="form-control" value="<?php echo htmlspecialchars($row['age'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Gender</h6>
                </label>
                <input type="text" name="gender" class="form-control" value="<?php echo htmlspecialchars($row['gender'] ?? ''); ?>" readonly>
                
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Civil Status</h6>
                </label>
                <input type="text" name="civil_status" class="form-control" value="<?php echo htmlspecialchars($row['civil_status'] ?? ''); ?>" readonly>
            </div>

            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Province</h6>
                </label>
                <input type="text" name="province" class="form-control" value="<?php echo htmlspecialchars($row['province'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Municipality</h6>
                </label>
                <input type="text" name="municipality" class="form-control" value="<?php echo htmlspecialchars($row['municipality'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Barangay</h6>
                </label>
                <input type="text" name="barangay" class="form-control" value="<?php echo htmlspecialchars($row['barangay'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Purok/Street</h6>
                </label>
                <input type="text" name="street" class="form-control" value="<?php echo htmlspecialchars($row['street'] ?? ''); ?>" readonly>
            </div>

            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Student ID</h6>
                </label>
                <input type="text" name="student_id" class="form-control" value="<?php echo htmlspecialchars($row['student_id'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Student Verification Code</h6>
                </label>
                <input type="text" name="student_vcode" class="form-control" value="<?php echo htmlspecialchars($row['student_vcode'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>School Year Graduated</h6>
                </label>
                <input type="text" name="year_graduated" class="form-control" value="<?php echo htmlspecialchars($row['year_graduated'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Date of Graduation</h6>
                </label>
                <input type="text" name="date_graduation" class="form-control" value="<?php echo htmlspecialchars($row['date_graduation'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-12">
              <br>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Honors</h6>
                </label>
                <input type="text" name="honors" class="form-control" value="<?php echo htmlspecialchars($row['honors'] ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Department</h6>
                </label>
                <input type="text" name="department_name" class="form-control" value="<?php echo htmlspecialchars($department_name ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Course</h6>
                </label>
                <input type="text" name="course_name" class="form-control" value="<?php echo htmlspecialchars($course_name ?? ''); ?>" readonly>
            </div>
            <div class="col-lg-3">
                <label>
                    <h6>Status</h6>
                </label>
                <select class="form-control" name="status" disabled>
                    <option value="Verified" <?php echo ($row['status'] ?? '' == 'Verified') ? 'selected' : ''; ?>>Verified</option>
                    <option value="Not Verified" <?php echo ($row['status'] ?? '' == 'Not Verified') ? 'selected' : ''; ?>>Not Verified</option>
                </select>
            </div>
            <div class="col-lg-12">
              <br>
            </div>
            <div class="col-lg-4">
                <label>
                    <h6>Certificate of Diploma</h6>
                </label><br>
                <img src="<?php echo $row['diploma'] ?? ''; ?>" alt="Certificate of Diploma" class="rounded-circle" width="200" height="200">
            </div>
            <div class="col-lg-4">
                <label>
                    <h6>Certificate of Graduation</h6>
                </label><br>
                <img src="<?php echo $row['graduation'] ?? ''; ?>" alt="Certificate of Graduation" class="rounded-circle" width="200" height="200">
            </div>
            <div class="col-lg-4">
                <label>
                    <h6>Transcipt of Records (TOR)</h6>
                </label><br>
                <img src="<?php echo $row['tor'] ?? ''; ?>" alt="Transcipt of Records (TOR" class="rounded-circle" width="200" height="200">
            </div>
            <div class="col-lg-12">
                <br>
            </div>
            <div class="col-lg-12">
                <a href="student.php" class="btn btn-outline-secondary">Back</a>
                <a href="up_students.php?s_id=<?php echo htmlspecialchars($row['s_id']); ?>" class="btn btn-outline-primary" style="float: right;">Update</a>
            </div>