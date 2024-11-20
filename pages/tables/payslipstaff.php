<?php
session_start();
require('../../config/database.php');
require('../../config/security.php');

// Validate and sanitize the 'id' parameter from the URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

// Your database connection code goes here (assuming you have a $con variable)

// Fetch data from staff table
$staffQuery = "SELECT * FROM staff WHERE staffId = '$id'";
$staffResult = mysqli_query($con, $staffQuery);
$staffData = mysqli_fetch_assoc($staffResult);

// Fetch data from payroll table
$payrollQuery = "SELECT * FROM payroll WHERE staffId = '$id'";
$payrollResult = mysqli_query($con, $payrollQuery);
$payrollData = mysqli_fetch_assoc($payrollResult);

// Fetch data from payroll table
$payrollQuery1 = "SELECT * FROM payroll WHERE staffId = '$id'";
$payrollResult1 = mysqli_query($con, $payrollQuery1);
$payrollData1 = mysqli_fetch_assoc($payrollResult1);


// Fetch data from attendance table
$attendanceQuery = "SELECT * FROM attendance WHERE staffId = '$id'";
$attendanceResult = mysqli_query($con, $attendanceQuery);
// Fetch all attendance data into an array
$attendanceData = array();
while ($attendanceRow = mysqli_fetch_assoc($attendanceResult)) {
    $attendanceData[] = $attendanceRow;
}

//calculation
$sql = "SELECT staff.staffId, staff.staffName, staff.staffPnum, staff.staffEmail, staff.position, attendance.status,
               MIN(attendance.clockIn) AS clockIn, MAX(attendance.clockOut) AS clockOut,
               COUNT(DISTINCT DATE(attendance.date)) AS totalDay,
               ROUND(SUM(TIMESTAMPDIFF(MINUTE, attendance.clockIn, attendance.clockOut) / 60 * 7), 2) AS totalSalary
        FROM staff
        LEFT JOIN attendance ON staff.staffId = attendance.staffId
        WHERE staff.staffId = '$id'
        GROUP BY staff.staffId";


$result = mysqli_query($con, $sql);

// Fetch the data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array(
        'staffId' => $row['staffId'],
        'staffName' => $row['staffName'],
        'staffPnum' => $row['staffPnum'],
        'staffEmail' => $row['staffEmail'],
        'position' => $row['position'],
        'status' => $row['status'],
        'clockIn' => $row['clockIn'],
        'clockOut' => $row['clockOut'],
        'totalDay' => $row['totalDay'],
        'totalSalary' => $row['totalSalary']
    );
}

// Automatically generate the current month and year
$desiredMonth = date('n'); // n represents the month without leading zeros
$desiredYear = date('Y');

// Generate a date for the first day of the specified month and year
$desiredDate = date("Y-m-d", mktime(0, 0, 0, $desiredMonth, 1, $desiredYear));


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>company invoice - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css" integrity="...">

<style type="text/css">
    	body{
    margin-top:20px;
    color: #484b51;
}
.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}
    </style>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<div class="page-content container">
<div class="page-header text-blue-d2">
<h1 class="page-title text-secondary-d1">
Pay Slip
<small class="page-info">
<i class="fa fa-angle-double-right text-80"></i>
ID: <?php echo $payrollData1['payrollId']; ?>

</small>
</h1>
<div class="page-tools">
</div>
</div>
<div class="container px-0">
<div class="row mt-4">
<div class="col-12 col-lg-12">
<div class="row">
<div class="col-12">
<div class="text-center text-150">
<i class="fas fa-utensils fa-2x text-success-m2 mr-1"></i>
<span class="text-default-d3">PAK LI KOPITIAM</span>
</div>
</div>
</div>

<hr class="row brc-default-l1 mx-n1 mb-4" />
<div class="row">
    <div class="col-sm-6">
        <div>
            <span class="text-sm text-grey-m2 align-middle">Name:</span>
            <span class="text-600 text-110 text-blue align-middle"><?php echo $staffData['staffName']; ?></span>
        </div>
        <div>
            <span class="text-sm text-grey-m2 align-middle">IC/Passport No:</span>
            <span class="text-600 text-110 text-blue align-middle"><?php echo $staffData['staffId']; ?></span>
        </div>
        <div>
            <span class="text-sm text-grey-m2 align-middle">Phone No:</span>
            <span class="text-600 text-110 text-blue align-middle"><?php echo $staffData['staffPnum']; ?></span>
        </div>
        <span class="text-sm text-grey-m2 align-middle">Address:</span>
        <div class="text-600 text-110 text-blue">
            <div class="my-1">
                <?php echo $staffData['address']; ?>, <?php echo $staffData['city']; ?>
            </div>
            <div class="my-1">
                <?php echo $staffData['postcode']; ?>, <?php echo $staffData['state']; ?>, <?php echo $staffData['country']; ?>
            </div>
    </div>
</div>

<div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
<hr class="d-sm-none" />
<div class="text-grey-m2">
<div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
Invoice
</div>
<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #<?php echo $payrollData1['payrollId']; ?></div>
<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> <?php echo $desiredDate; ?></div>
<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Bank:</span> <?php echo $payrollData1['bankName']; ?></div>
<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Account Number:</span> <?php echo $payrollData1['accountBank']; ?></div>
<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25"><?php echo $payrollData1['status']; ?></span></div>
</div>
</div>

</div>

<div class="mt-4">
    <div class="row text-600 text-white bgc-default-tp1 py-25">
        <div class="d-none d-sm-block col-1">#</div>
        <div class="col-9 col-sm-5">Position</div>
        <div class="d-none d-sm-block col-4 col-sm-2">Total day per month</div>
        <div class="d-none d-sm-block col-sm-2">Status</div>
        <div class="col-2">Amount</div>
    </div>

    <?php
    $rowNumber = 1; // Initialize row number
    foreach ($data as $row) {
    ?>
        <div class="row text-secondary-d2 py-25">
            <div class="d-none d-sm-block col-1"><?php echo $rowNumber++; ?></div>
            <div class="col-9 col-sm-5"><?php echo $row['position']; ?></div>
            <div class="d-none d-sm-block col-4 col-sm-2">28</div>
            <div class="d-none d-sm-block col-sm-2"><?php echo $row['status']; ?></div>
            <div class="col-2">2000</div>
        </div>
    <?php
    }
    ?>
</div>

<div class="row border-b-2 brc-default-l2"></div>


<div class="row mt-3">
<div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

</div>
<div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">


<div class="row my-2 align-items-center bgc-primary-l3 p-2">
<div class="col-7 text-right">
Total Amount
</div>
<div class="col-5">
<span class="text-150 text-success-d3 opacity-2">2000.00</span>
</div>
</div>
</div>
</div>
<hr/>

</div>
</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>