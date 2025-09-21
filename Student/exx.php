<?php include 'request_header.php'; ?>
<div class="col-lg-12"><br></div>
              <div class="col-lg-3 mb-3 text-center">
                <input type="text" id="c_date" name="c_date" class="form-control fw-semibold text-center" readonly>
                <label for="c_date" class="form-label fw-semibold mt-1">Date</label>
              </div>
              <?php include 'date_request_script.php'; ?>
              <div class="col-lg-12"><br></div>
              <div class="col-lg-12">
                <label>
                  <strong>REQUEST FOR : </strong><spam>(Please Check)</spam>
                </label>
                <div class="row g-3 mt-2">
                  <div class="col-lg-3 col-md-6">
                    <div class="form-check">
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12"><br></div>
              <div class="col-lg-12"><br></div>
              <?php include 'student_currently_sign_in.php'; ?>
              <!-- Name field (label + input aligned) -->
              <div class="col-lg-6">
                <label for="full_name" class="form-label fw-semibold " >Full Name :</label>
                <input 
                  type="text" 
                  id="full_name" 
                  name="full_name" 
                  class="form-control shadow-sm rounded-3" 
                  value="<?php echo htmlspecialchars($full_name); ?>" 
                  readonly
                >
              </div>
              <!-- <div class="col-lg-2">
                <br>
              </div> -->
              <!-- Course & Year field (label + input aligned) -->
              <div class="col-lg-6">
                <label for="course_year" class="form-label fw-semibold " >Course & Year :</label>
                <input 
                  type="text" 
                  id="course_year" 
                  name="course_year" 
                  class="form-control shadow-sm rounded-3" 
                  value="<?php echo htmlspecialchars($course_year); ?>" 
                  readonly
                >
              </div>
              <div class="col-lg-12"><br></div>
              <div class="col-lg-12 mb-3">
                <label class="form-label fw-semibold">
                  Semester / Year Last Attended:
                </label>
                <div class="row g-3 mt-2">
                  <!-- 1st Sem -->
                  <div class="col-lg-3 col-md-6">
                    <div class="form-check">
                      <input class="form-check-input custom-checkbox" type="checkbox" id="sem1" name="semester[]" value="1st Semester">
                      <label class="form-check-label" for="sem1">1st Sem</label>
                    </div>
                  </div>

                  <!-- 2nd Sem -->
                  <div class="col-lg-3 col-md-6">
                    <div class="form-check">
                      <input class="form-check-input custom-checkbox" type="checkbox" id="sem2" name="semester[]" value="2nd Semester">
                      <label class="form-check-label" for="sem2">2nd Sem</label>
                    </div>
                  </div>

                  <!-- Summer -->
                  <div class="col-lg-3 col-md-6">
                    <div class="form-check">
                      <input class="form-check-input custom-checkbox" type="checkbox" id="summer" name="semester[]" value="Summer">
                      <label class="form-check-label" for="summer">Summer</label>
                    </div>
                  </div>

                  <!-- School Year -->
                  <?php include 'year_graduated.php'; ?>
                  <div class="col-lg-3 col-md-6 d-flex align-items-center">
                    <label for="year_graduated" class="form-label fw-semibold me-2 mb-0">School Year:</label>
                    <input 
                      type="text" 
                      id="year_graduated" 
                      name="year_graduated" 
                      class="form-control shadow-sm rounded-3" 
                      value="<?php echo htmlspecialchars($year_graduated); ?>" 
                      readonly
                      style="max-width: 150px;"
                    >
                  </div>
                </div>
              </div>
              <?php include 'sem_year_script.php'; ?>