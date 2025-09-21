<?php ?>
<aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="dashboard.php">
              <img src="assets/img/s.png" height="80" style="margin-top: 10px;">
            </a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard.php">
              <img src="assets/img/s.png" height="40">
            </a>
          </div>
          <ul class="sidebar-menu"><br>
            <li class="menu-header"><center>Dashboard</center></li>
            <li class=""><a class="nav-link" href="dashboard.php"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Department & Course</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="department.php">List of Department </a></li>
                <li><a class="nav-link" href="course.php">List of Course </a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-file-alt"></i> <span>Documents</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="list_documents.php">List of Documents</a></li>
                <!-- <li><a class="nav-link" href="tor.php"><i class="fa fa-file-alt"></i> TOR</a></li> -->
                <!-- <li><a class="nav-link" href="cog.php"><i class="fa fa-file-alt"></i> Certificate of Graduation</a></li> -->
                <!-- <li><a class="nav-link" href="#"> Denied Request</a></li> -->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i> <span>Request Documents</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="request.php">List of Request Documents</a></li>
                <li><a class="nav-link" href="list_request_release.php">List of Release Documents </a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="student.php"><i class="fas fa-users"></i> <span>List of Students</span></a></li>
            <!-- <li><a class="nav-link" href="cashier.php"><i class="fas fa-users"></i> <span>Cashier</span></a></li> -->
            <!-- <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Package</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="#">Package List</a></li>                
                <li><a class="nav-link" href="#">Inventory Package</a></li>                
                <li><a class="nav-link" href="#">Package Available</a></li>                
                <li><a class="nav-link" href="#">Package Unvailable</a></li>                
            </ul>
            </li> -->

            <li class="menu-header"><center>Reports</center></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Deparment & Course</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="d_reports.php">Department Reports</a></li>
                <li><a class="nav-link" href="c_reports.php">Course Reports</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="st_reports.php"><i class="far fa-file-alt"></i> <span>Students Reports</span></a></li>
            <!-- <li><a class="nav-link" href="#"><i class="far fa-file-alt"></i> <span>Package List</span></a></li> -->
            <!-- <li><a class="nav-link" href="#"><i class="far fa-file-alt"></i> <span>Sales Report</span></a></li> -->
          </ul>
      </aside>