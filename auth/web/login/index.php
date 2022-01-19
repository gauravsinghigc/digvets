<?php

//page varibale
$PageName  = "Login & Signup";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";
require $AccessLevel . "require/web/sessionvariables.php";

//page activity
if (isset($_SESSION['LOGIN_CustomerId'])) {
 header("location: " . DOMAIN . "/web");
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
 <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
 <?php include $AccessLevel . "/include/web/header_files.php"; ?>
 <style>
  .pop-form {
   display: none !important;
  }

  #Authformlogo {
   display: none !important;
  }
 </style>
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
     <h2 class="m-t-20 m-b-2 text-center text-color"><i class="fa fa-lock text-primary fs-25"></i> Login into Your Account!</h2>
     <hr class="m-t-5">
    </div>
   </div>
  </section>

  <section class="container section">
   <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
     <div class="p-2r section-div">
      <img src="<?php echo $MAIN_LOGO; ?>" title="<?php echo APP_NAME; ?>" alt="<?php echo APP_NAME; ?>" class="w-100">
     </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
     <?php include '../../../include/web/auth-form.php'; ?>
    </div>
   </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
 </body>

</html>