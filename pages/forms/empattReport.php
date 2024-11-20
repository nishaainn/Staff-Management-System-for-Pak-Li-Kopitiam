<?php
// attendance_report.php

// Assuming you have a database connection established
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "paklikopitiam";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$output = ""; // Initialize output variable
$submitted = false; // Initialize submitted variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $submitted = true; // Form has been submitted

    // Retrieve form data
    $staffId = $_POST['staffId'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    // Fetch name and position of the staff
    $sqlStaffInfo = "SELECT staffName, position FROM staff WHERE staffId = '$staffId'";
    $resultStaffInfo = $conn->query($sqlStaffInfo);

    if ($resultStaffInfo->num_rows > 0) {
        $rowStaffInfo = $resultStaffInfo->fetch_assoc();
        $staffName = $rowStaffInfo['staffName'];
        $position = $rowStaffInfo['position'];

        // Calculate the total number of unique days attended
        $sqlDaysAttended = "SELECT COUNT(DISTINCT DATE(date)) AS daysAttended
                            FROM attendance
                            WHERE staffId = '$staffId'
                            AND MONTH(date) = '$month'
                            AND YEAR(date) = '$year'";
        $resultDaysAttended = $conn->query($sqlDaysAttended);

        if ($resultDaysAttended->num_rows > 0) {
            $rowDaysAttended = $resultDaysAttended->fetch_assoc();
            $daysAttended = $rowDaysAttended['daysAttended'];

            // Retrieve distinct dates staff attended in the selected month and year
            $sqlDistinctDates = "SELECT DISTINCT DATE_FORMAT(date, '%d-%m') AS attendanceDate
                                FROM attendance
                                WHERE staffId = '$staffId'
                                AND MONTH(date) = '$month'
                                AND YEAR(date) = '$year'";
            $resultDistinctDates = $conn->query($sqlDistinctDates);

            // Generate table output
            $output .= "<div class='report-container'>";
            $output .= "<h2>Attendance Report</h2>";
            $output .= "<div class='report-section'>";
            $output .= "<p><strong>Name:</strong> $staffName</p>";
            $output .= "<p><strong>Position:</strong> $position</p>";
            $output .= "</div>";
            $output .= "<div class='report-section'>";
            $output .= "<p><strong>Month:</strong> " . date("F", mktime(0, 0, 0, $month, 1, 2000)) . "</p>";
            $output .= "<p><strong>Year:</strong> $year</p>";
            $output .= "</div>";
            $output .= "<div class='report-section'>";
            $output .= "<p><strong>Days Attended:</strong> $daysAttended</p>";
            $output .= "</div>";

            if ($daysAttended > 0) {
                $output .= "<div class='report-section'>";
                $output .= "<h3>Attendance Records</h3>";
                $output .= "<table class='table'>";
                $output .= "<thead><tr><th>Date</th></tr></thead><tbody>";

                // Display attendance dates in a table
                while ($rowDate = $resultDistinctDates->fetch_assoc()) {
                    $attendanceDate = $rowDate['attendanceDate'];
                    $output .= "<tr><td>$attendanceDate</td></tr>";
                }

                $output .= "</tbody></table>";
                $output .= "</div>";
            } else {
                $output .= "<div class='report-section'>";
                $output .= "<p>No attendance records found for the specified month and year.</p>";
                $output .= "</div>";
            }

            $output .= "</div>";
        } else {
            $output = "<p>No attendance records found for the specified month and year.</p>";
        }
    } else {
        $output = "<p>Staff not found with the specified ID.</p>";
    }
}

$conn->close();
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

    <style>
        .report-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .report-section {
            margin-bottom: 20px;
        }

        h2, h3 {
            color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
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

		  <?php include "../../include/empsidebar.php";?>
		  
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
                                <h4 class="card-title">Staff Attendance</h4>
                                <form class="form-sample" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Staff Id</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="staffId"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Month</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="month" name="month" required>
                                                        <?php
                                                        // Generate options for months
                                                        for ($i = 1; $i <= 12; $i++) {
                                                            $monthValue = str_pad($i, 2, '0', STR_PAD_LEFT); // Add leading zero if needed
                                                            $monthName = date("F", mktime(0, 0, 0, $i, 1, 2000));
                                                            echo "<option value=\"$monthValue\">$monthName</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Year</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" id="year" name="year" value="<?php echo date('Y'); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <input type="hidden" name="purpose" value="addStaff" required>
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    </div>
                                </form>

                                <?php
                              
                                    echo $output;
                               
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
        let table2 = document.querySelector('#table2');
        let dataTable = new simpleDatatables.DataTable(table2);
    </script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>