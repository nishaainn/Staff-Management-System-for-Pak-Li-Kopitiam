<?php

session_start();
require('../../config/database.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql = "SELECT staffId, date,clockIn,clockOut,status FROM attendance";
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
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <!--Datatables-->
    <link rel="stylesheet" href="../../assets/vendors/simple-datatables/style.css">
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo" href="index.html"><img src="../../assets/images/logo.png" alt="logo" /></a> <!--logo-->
          <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="../../assets/images/logomini.png" alt="logo" /></a>
        </div>
        <ul class="nav">
          <!--sidebar-->
          <?php include "../../include/sidebar.php";?>
		  
          <!--End Sidebar-->
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- navbar -->
        <?php include "../../include/navbar.php";?>
        <!-- end navbar -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Staff Attendance </h4>
                      <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                            <tr>
                                <th> Staff Id </th>
                                <th> Date </th>
                                <th> Clock In </th>
                                <th> Clock Out  </th>
                                <th> Status </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = $result->fetch_array(MYSQLI_BOTH)) { ?>
                                <tr>
                                    <td> <?php echo $row['staffId']; ?> </td>
                                    <td> <?php echo $row['position']; ?> </td>
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
          <!-- partial:../../partials/_footer.html -->
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="../../assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>