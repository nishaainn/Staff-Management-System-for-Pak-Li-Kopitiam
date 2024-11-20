<?php

session_start();
require('config/database.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM staff WHERE status = 'active'" ;
$result= mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

$sql1 = "SELECT * FROM staff WHERE status = 'active'" ;
$result1 = mysqli_query($con, $sql1 );
$total1 = mysqli_num_rows($result1);
while($row = $result1 -> fetch_array (MYSQLI_BOTH)){
  $staffName[] = $row['staffName'];
  $position[] = $row['position'];
  $hireDate[] = $row['hireDate'];
}


$sql = "SELECT staff.staffId,staffName,staffEmail,position,date,clockIn,clockOut,attendance.status FROM staff INNER JOIN attendance ON staff.staffId = attendance.staffId  ";
$result = mysqli_query($con, $sql);
$total = mysqli_num_rows($result);

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

    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css">
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="index.html"><img src="assets/images/logo.png" alt="logo" /></a> <!--logo-->
          <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="assets/images/logomini.png" alt="logo" /></a>
        </div>
        <ul class="nav">
          <!--Sidebar-->
          <?php include "include/sidebar.php";?>
		 
          <!--end sidebar-->
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <?php include "include/navbar.php";?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0"><?php echo $total?></h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Staff</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h5 class="mb-0">RM30297.34</h5>
                          <p class="text-success ml-2 mb-0 font-weight-medium">+11%</p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Sales</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h4 class="mb-0">RM287.20</h4>
                          <p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Daily Earning</h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">39</h3>
                          <p class="text-success ml-2 mb-0 font-weight-medium">+3</p>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success ">
                          <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Receipts</h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Average Sales</h4>
                    <canvas id="transaction-history" class="transaction-chart"></canvas>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Daily Earning</h6>
                        <p class="text-muted mb-0">27 Dec 2023, 01:12PM</p>
                      </div>
                      <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">RM287.20</h6>
                      </div>
                    </div>
                    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Total Sales</h6>
                        <p class="text-muted mb-0">23 Dec 2023, 09:12AM</p>
                      </div>
                      <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">RM30297.34</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-row justify-content-between">
                <h4 class="card-title mb-1">Staff</h4>
                <p class="text-muted mb-1">Your data status</p>
            </div>
            <div class="row">
                <?php for ($a = 0; $a < $total1; $a++) : ?>
                    <?php if ($a % 2 == 0) : ?>
                        </div><div class="row">
                    <?php endif; ?>
                    <div class="col-12">
                        <div class="preview-list">
                            <div class="preview-item border-bottom">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark">
                                        <i class="mdi mdi-account"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content d-sm-flex flex-grow">
                                    <div class="flex-grow">
                                        <h6 class="preview-subject"><?php echo $staffName[$a]; ?></h6>
                                        <p class="text-muted mb-0"><?php echo $position[$a]; ?></p>
                                    </div>
                                    <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                        <p class="text-muted"><?php echo $hireDate[$a]; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="text-right mt-3">
                <a href="pages/tables/staff.php">View More..</a>
            </div>
        </div>
    </div>
</div>

              
            </div>
            
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Staff Attendance List</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Staff Name </th>
                            <th> Date </th>
                            <th> ClockIn </th>
                            <th> ClockOut </th>
                            <th> status </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $result->fetch_array(MYSQLI_BOTH)) { ?>
                          <tr>
                            <td>
                              <span class="pl-2"><?php echo $row['staffName']; ?></span>
                            </td>
                            <td> <?php echo $row['date']; ?> </td>
                            <td> <?php echo $row['clockIn']; ?> </td>
                            <td> <?php echo $row['clockOut']; ?> </td>
                            <td>
                                <?php if($row['status'] == 'attend'){ ?>
                                    <span class="badge bg-success"><b>Attend</b></span>
                                <?php } else { ?>
                                    <span class="badge bg-danger"><b>Missing</b></span>
                                <?php } ?>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
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