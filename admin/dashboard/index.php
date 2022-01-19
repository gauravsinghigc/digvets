<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Dashboard";
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
 <?php include '../../include/admin/header_files.php'; ?>

</head>

<body>
 <div id="container" class="effect navbar-fixed mainnav-fixed mainnav-lg">
  <?php include '../../include/admin/header.php'; ?>

  <div class="boxed">
   <!--CONTENT CONTAINER-->
   <!--===================================================-->
   <div id="content-container">
    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
     <div class="panel">
      <div class="panel-body">
       <div class="row">
        <div class="col-md-12">
         <h4 class="app-heading"><i class="fa fa-home"></i> Dashboard</h4>
        </div>
       </div>

       <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4 col-6 m-b-5">
         <div class="bg-primary text-white p-2r">
          <h2><?php echo TOTAL("SELECT * FROM doctors"); ?></h2>
          <p>Total Doctors</p>
         </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-6 m-b-5">
         <div class="bg-info text-white p-2r">
          <h2><?php echo TOTAL("SELECT * FROM animals"); ?></h2>
          <p>Total Animals</p>
         </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-6  m-b-5">
         <div class="bg-success text-white p-2r">
          <h2><?php echo TOTAL("SELECT * FROM aiworkers"); ?></h2>
          <p>Total AI Workers</p>
         </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-6  m-b-5">
         <div class="bg-info text-white p-2r">
          <h2><?php echo TOTAL("SELECT * FROM customers"); ?></h2>
          <p>Total Customers</p>
         </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-6  m-b-5">
         <div class="bg-dark text-white p-2r">
          <h2><?php echo TOTAL("SELECT * FROM orders"); ?></h2>
          <p>Total Orders</p>
         </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-6  m-b-5">
         <div class="bg-success text-white p-2r">
          <h2><?php
              $fetchpay2 = SELECT("SELECT * FROM order_payments");
              $TotalAMount = 0;
              while ($fetchpay = mysqli_fetch_array($fetchpay2)) {
               $TotalAMount += (int)$fetchpay['OrderPaymentAmount'];
              }
              echo $TotalAMount; ?></h2>
          <p>Total Order Amount</p>
         </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-6  m-b-5">
         <div class="bg-dark text-white p-2r">
          <h2><?php echo TOTAL("SELECT * FROM products"); ?></h2>
          <p>Total Products</p>
         </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-6  m-b-5">
         <div class="bg-success text-white p-2r">
          <h2><?php echo TOTAL("SELECT * FROM enquiries"); ?></h2>
          <p>Total Support Requests</p>
         </div>
        </div>


       </div>
      </div>
     </div>
    </div>
    <!--===================================================-->
    <!--End page content-->
   </div>

   <?php include '../../include/admin/sidebar.php'; ?>
  </div>
  <?php include '../../include/admin/footer.php'; ?>
 </div>

 <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>