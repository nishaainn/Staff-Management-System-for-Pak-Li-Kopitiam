<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: ../pages/login/loginStaff.php");
    exit();
}

$user = $_SESSION['staffEmail'];

require('../../config/database.php');

// Get the desired month (e.g., from a user input or a specific month)
$desiredMonth = isset($_GET['month']) ? $_GET['month'] : date('m');  // Default to the current month if not specified

// Ensure that the user is staff by using their email
$sqlStaffId = "SELECT staffId FROM staff WHERE staffEmail = ?";
$stmtStaffId = $con->prepare($sqlStaffId);
$stmtStaffId->bind_param("s", $user);
$stmtStaffId->execute();
$stmtStaffId->bind_result($staffId);
$stmtStaffId->fetch();
$stmtStaffId->close();

if (!$staffId) {
    echo "Invalid staff account.";
    exit();
}

$sql = "SELECT staff.staffId, staff.staffName, staff.staffPnum, staff.staffEmail, staff.position, 
               MIN(attendance.clockIn) AS clockIn, MAX(attendance.clockOut) AS clockOut,
               COUNT(DISTINCT DATE(attendance.date)) AS totalDay,
               ROUND(SUM(TIMESTAMPDIFF(MINUTE, attendance.clockIn, attendance.clockOut) / 60 * 7), 2) AS totalSalary
        FROM staff
        LEFT JOIN attendance ON staff.staffId = attendance.staffId
        WHERE MONTH(attendance.date) = '$desiredMonth' AND staff.staffId = '$staffId'
        GROUP BY staff.staffId";

$result = mysqli_query($con, $sql);

// Fetch the data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'staffId' => $row['staffId'],
        'staffName' => $row['staffName'],
        'position' => $row['position'],
        'totalDay' => $row['totalDay']
    );
}

$total = count($data);
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
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="index.html"><img src="../../assets/images/logo.png" alt="logo" /></a>
        <!--logo-->
        <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="../../assets/images/logomini.png"
            alt="logo" /></a>
      </div>
      <ul class="nav">
        <!--sidebar-->
        <?php include "../../include/empsidebar.php"; ?>

        <!--End Sidebar-->
      </ul>
    </nav>

      <div class="container-fluid page-body-wrapper">
      <?php include "../../include/empnavbar.php"; ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">List Of Staff</h4>
                    <div class="table-responsive">
                      <table class="table table-striped" id="table1">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Staff ID</th>
                            <th>Position</th>
                            <th>Month</th>
                            <th><center>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $counter = 1;
                          foreach ($data as $row) {
                              echo "<tr>";
                              echo "<td>" . $counter . "</td>";
                              echo "<td>" . $row['staffName'] . "</td>";
                              echo "<td>" . $row['staffId'] . "</td>";
                              echo "<td>" . $row['position'] . "</td>";
                              echo "<td>" . strftime('%B', strtotime("2022-$desiredMonth-01")) . "</td>";
                              echo "<td><center>
                                    <a target='_blank' href='payslipstaff.php?id={$row['staffId']}' class='btn btn-light'>
                                        <i class='mdi mdi-eye' aria-hidden='true'></i> View
                                    </a>
                                  </center></td>";
                              echo "</tr>";
                              $counter++;
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Container-scroller -->

<!-- Plugins:js -->
<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- End inject -->
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
<script>
    function viewFunction(staffId) {
        var payslipContainer = document.getElementById('payslip-' + staffId);
        payslipContainer.style.display = payslipContainer.style.display === 'none' ? 'block' : 'none';
    }
</script>
<!-- End inject -->
<!-- Custom js for this page -->
<!-- End custom js for this page -->
  </body>
</html>
