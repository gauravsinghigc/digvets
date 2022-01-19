<?php

//page varibale
$PageName  = "My Account";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//activity variables & page database access
$PageSqls = "SELECT * FROM doctors WHERE DoctorCreatedBy='" . $_SESSION['LOGIN_CustomerId'] . "'";
$_SESSION['VIEW_DOCTOR_ID'] = GET_DATA("Doctorsid");
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="">
 <meta name="keywords" content="">
 <title><?php echo GET_DATA("DoctorName") ?> | <?php echo APP_NAME; ?></title>
 <?php include $AccessLevel . "/include/web/header_files.php"; ?>
</head>

<body>

 <body>

  <?php
  //header & loader
  include $AccessLevel . "include/web/loader.php";
  include $AccessLevel . "include/web/header.php";
  include $AccessLevel . "include/web/navbar.php";
  ?>
  <section class="container">
   <div class="row">
    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
     <h3><i class="fa fa-user text-color"></i> My Account <i class="fa fa-angle-double-right"></i> Doctors</h3>
     <a href="<?php echo DOMAIN; ?>/web/account/" class="btn btn-md fs-16 text-primary"><i class="fa fa-angle-left"></i> Back to Account</a>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
     <div class="p-3">
      <?php SEARCH_FORM([
       "OrderId" => "Search by Order Id",
       "OrderDate" => "Order date",
       "OrderAmount" => "Order Amount"
      ]); ?>
     </div>
    </div>
   </div>
  </section>

  <section class="container">
   <div class="row">
    <div class="col-md-12">
    </div>
   </div>
  </section>

  <section class="container section">
   <div class="row">
    <div class="col-md-12">
     <?php include '../../../include/forms/edit-doctor-form.php'; ?>
    </div>
   </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
 </body>

</html>