<?php

//page varibale
$PageName  = "My Account";
$AccessLevel = "../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

$PageSqls = "SELECT * FROM customers where CustomerId='" . $_SESSION['LOGIN_CustomerId'] . "'";
if (FETCH($PageSqls, "CustomerProfileImage") == null) {
 $CustomerProfileImage = $CommonUserImage;
} else {
 $CustomerProfileImage = "customers/img/profile/" . GET_DATA("CustomerProfileImage");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="">
 <meta name="keywords" content="">
 <title><?php echo GET_DATA("CustomerName") ?> | <?php echo APP_NAME; ?></title>
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
    <div class="col-md-12">
     <h3><i class="fa fa-user text-color"></i> My Account</h3>
    </div>
   </div>
  </section>

  <section class="container section">
   <div class="row">
    <div class="col-md-12">
     <div class="account-section">
      <div class="image-3">
       <img src="<?php echo STORAGE_URL; ?>/<?php echo $CustomerProfileImage; ?>">
      </div>
      <div class="details">
       <h5>
        <span><?php echo GET_DATA("CustomerName"); ?></span>
       </h5>
       <p>
        <span><i class="fa fa-phone text-success"></i> <?php echo GET_DATA("CustomerPhoneNumber"); ?></span><br>
        <span><i class="fa fa-envelope text-danger"></i> <?php echo GET_DATA("CustomerEmailid"); ?></span>
       </p>
      </div>
     </div>
    </div>

    <div class="col-md-12">
     <h4>More Information</h4>
    </div>

    <div class="col-md-4">
     <a href="<?php echo DOMAIN; ?>/web/account/orders">
      <div class="account-section">
       <div class="image">
        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/orders..png">
       </div>
       <div class="details">
        <h5>My Orders</h5>
        <p>View all orders, track and get invoices</p>
       </div>
      </div>
     </a>
    </div>

    <div class="col-md-4">
     <a href="<?php echo DOMAIN; ?>/web/account/animals">
      <div class="account-section">
       <div class="image">
        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/animal.png">
       </div>
       <div class="details">
        <h5>Animals</h5>
        <p>interested animals, viewed etc.</p>
       </div>
      </div>
     </a>
    </div>

    <div class="col-md-4">
     <a href="<?php echo DOMAIN; ?>/web/account/doctors">
      <div class="account-section">
       <div class="image">
        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/doctors.png">
       </div>
       <div class="details">
        <h5>Doctor Profile</h5>
        <p>edit your doctor profile</p>
       </div>
      </div>
     </a>
    </div>

    <div class="col-md-4">
     <a href="<?php echo DOMAIN; ?>/web/account/workers">
      <div class="account-section">
       <div class="image">
        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/workers.png">
       </div>
       <div class="details">
        <h5>AI Workers</h5>
        <p>contacted workers, viewed, saved</p>
       </div>
      </div>
     </a>
    </div>

    <div class="col-md-4">
     <a href="<?php echo DOMAIN; ?>/web/account/address">
      <div class="account-section">
       <div class="image">
        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/address.png">
       </div>
       <div class="details">
        <h5>My Address</h5>
        <p>add, view, updat, saved addresses</p>
       </div>
      </div>
     </a>
    </div>

    <div class="col-md-4">
     <a href="<?php echo DOMAIN; ?>/web/account/settings">
      <div class="account-section">
       <div class="image">
        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/settings.png">
       </div>
       <div class="details">
        <h5>Account Settings</h5>
        <p>name, phone, email, security update</p>
       </div>
      </div>
     </a>
    </div>

   </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
 </body>

</html>