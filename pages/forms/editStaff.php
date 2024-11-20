<?php

session_start();
require('../../config/database.php');

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

$sql = "SELECT * FROM staff  WHERE staffId = '$id' ";
$result= mysqli_query($con, $sql);
$total = mysqli_num_rows($result);
while($row = $result->fetch_array(MYSQLI_BOTH)) { 
    $staffId = $row['staffId'];
    $staffName = $row['staffName'];
    $staffPnum = $row['staffPnum'];
    $staffEmail = $row['staffEmail'];
    $position = $row['position'];
    $hireDate = $row['hireDate'];
    $gender = $row['gender'];
    $dob = $row['dob'];
    $address = $row['address'];
    $state = $row['state'];
    $city = $row['city'];
    $postcode = $row['postcode'];
    $country = $row['country'];
    $password = $row['password'];
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
        select[readonly] {
            background-color: #f2f2f2; /* Change background color for readonly */
            cursor: not-allowed; /* Change cursor for readonly */
        }
        input[readonly] {
            background-color: #f2f2f2; /* Change background color for readonly */
            cursor: not-allowed; /* Change cursor for readonly */
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
            <div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New Staff</h4>
                    <form class="form-sample" action = "../../process/update.php" method = "POST">
                      <p class="card-description"> Personal info </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Full Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="staffName" value="<?php echo $staffName;?>"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">IC Number</label>
                            <div class="col-sm-9">
                              <input style ="color:#343a40;" type="text" class="form-control" name="staffId" value="<?php echo $staffId;?>" readonly/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                            <select class="form-control" id ="gender" name="gender" id="gender" readonly>
                                <option value="Male" <?php if($gender == 'Male'){echo "selected";}?> >Male</option>
                                <option value="Female" <?php if($gender == 'Female'){echo "selected";}?> >Female</option>
                            </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9 text-dark">
                              <input style ="color:#343a40;" class="form-control" placeholder="dd/mm/yyyy" type="date" name="dob" value="<?php echo $dob;?>" readonly/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Phone No</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="staffPnum" value="<?php echo $staffPnum;?>"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="staffEmail" value="<?php echo $staffEmail;?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class = "card-description">Job</p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Position</label>
                          <div class="col-sm-9">
                              <select class="form-control" name="position">
                                <option value="waiter" <?php if($position == 'waiter'){echo "selected";}?>>waiter</option>
                                <option  value="Cashier" <?php if($position == 'Cashier'){echo "selected";}?>>Cashier</option>
                                <option  value="Chef" <?php if($position == 'Chef'){echo "selected";}?>>Chef</option>
                                <option  value="Barista" <?php if($position == 'Barista'){echo "selected";}?>>Barista</option>
                                <option  value="Dishwasher" <?php if($position == 'Dishwasher'){echo "selected";}?>>Dishwasher</option>
                                <option  value="Kitchen Lead" <?php if($position == 'Kitchen Lead'){echo "selected";}?>>Kitchen Lead</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Hire Date</label>
                            <div class="col-sm-9">
                              <input class="form-control" placeholder="dd/mm/yyyy" type="date" name="hireDate" value="<?php echo $hireDate;?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="card-description"> Address </p>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="address" value="<?php echo $address;?>"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">State</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="state" value="<?php echo $state;?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Postcode</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="postcode" value="<?php echo $postcode;?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">City</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="city" value="<?php echo $city;?>"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Country</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="country" value="<?php echo $country;?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                              <input style ="color:#343a40;" type="password" class="form-control" value="<?php echo $password;?>" readonly/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 d-flex justify-content-end">
                        <input type="hidden" name="staffId" value="<?php echo $staffId; ?>" required>
                            <input type="hidden" name="purpose" value="editStaff" required>
                          <button type="submit"
                              class="btn btn-primary me-1 mb-1">Submit</button>
                      </div>
                    </form>
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
    <script>
        // Disable the select element when the page loads
        document.getElementById('gender').disabled = true;

        // Optionally, you can prevent right-clicking on the select element to access the context menu
        document.getElementById('gender').addEventListener('contextmenu', function (e) {
            e.preventDefault();
        });
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<?php if(isset($_SESSION['result']) && $_SESSION['result'] != ""){?> <!-- isset = check ada atau tak & name mesti tak kosong -->
		<script>
		Swal.fire({
				title: '<?php echo $_SESSION['result']; ?>',
				text: '<?php echo $_SESSION['message']; ?>',
				icon: '<?php echo $_SESSION['icon']; ?>'
			})
		</script>
		<?php unset($_SESSION['result']); }?> <!--tak keluar result banyak kali-->
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
  </body>
</html>