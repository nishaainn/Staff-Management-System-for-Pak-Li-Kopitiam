<?php



$sql = "SELECT * FROM staff WHERE staffEmail = '$user'" ;
$result= mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
while($row = $result->fetch_array(MYSQLI_BOTH)) { 
    $staffId = $row['staffId'];
    $staffName = $row['staffName'];
    $position = $row['position'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pak Li Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
  <li class="nav-item profile">
    <div class="profile-desc">
      <div class="profile-pic">
        <div class="count-indicator">
          <img class="img-xs rounded-circle " src="../../assets/images/faces/face15.jpg" alt="">
          <span class="count bg-success"></span>
        </div>
        <div class="profile-name">
          <h5 class="mb-0 font-weight-normal"><?php echo $staffName; ?></h5>
          <span><?php echo $position; ?></span>
        </div>
      </div>
      <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
      <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
        <a href="#" class="dropdown-item preview-item">
          <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
              <i class="mdi mdi-settings text-primary"></i>
            </div>
          </div>
          <div class="preview-item-content">
            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item preview-item">
          <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
              <i class="mdi mdi-onepassword  text-info"></i>
            </div>
          </div>
          <div class="preview-item-content">
            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item preview-item">
          <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
              <i class="mdi mdi-calendar-today text-success"></i>
            </div>
          </div>
          <div class="preview-item-content">
            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
          </div>
        </a>
      </div>
    </div>
  </li>
  <li class="nav-item nav-category">
    <span class="nav-link">Navigation</span>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" href="../../emp.php">
      <span class="menu-icon">
        <i class="mdi mdi-speedometer"></i>
      </span>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <span class="menu-icon">
        <i class="mdi mdi-account-card-details"></i>
      </span>
      <span class="menu-title">Staff</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
      <li class="nav-item"> <a class="nav-link" href="pages/forms/clockIn.php">Clock In Attendance</a></li>
      <li class="nav-item"> <a class="nav-link" href="clockOut.php">Clock Out Attendance</a></li>
        </ul>
    </div>
  </li>
  <li class="nav-item menu-items">
    <a class="nav-link" data-toggle="collapse" href="#ui-salary" aria-expanded="false" aria-controls="ui-salary">
        <span class="menu-icon">
            <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Salary</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-salary">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="../tables/empgeneratepayroll.php">Generate Payroll</a></li>
        </ul>
    </div>
  </li>

  <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>
</html>