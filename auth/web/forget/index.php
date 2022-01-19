<?php

//page varibale
$PageName  = "Forget Password";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";
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
     <h2 class="m-t-20 m-b-2 text-center text-color"><i class="fa fa-edit text-primary fs-25"></i> <?php echo $PageName; ?></h2>
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
     <form action="../../../controller/authcontroller.php" method="POST" class="pb-4">
      <?php FormPrimaryInputs(true); ?>
      <div class="row">
       <div class="col-md-12">
        <h3>Recover Account</h3>
        <hr class="m-t-7 m-b-7">
       </div>
       <div class="col-lg-8 col-md-8 col-sm-8 col-12">
        <label>Enter Registered Phone or Email</label>
        <input type="text" name="submitted_data" placeholder="+91 or email@domain.ext" class="form-control" required="">
       </div>
       <div class="col-lg-6 col-md-6 col-sm-6 col-12 m-t-20">
        <button class="btn btn-md btn-success" name="RecoverAccount"><i class="fa fa-search"></i> Search Account</button>
       </div>
       <div class="col-md-12">
        <p class="m-t-10">
         if you are unable to find your account please contact us at <a href="mailto:<?php echo SUPPORT_MAIL; ?>" class="text-primary"><?php echo SUPPORT_MAIL; ?></a>
        </p>
       </div>

       <div class="col-md-12">
        Know Password? <a href="<?php echo DOMAIN; ?>/auth/web/login" onclick="showform()" class="btn btn-md btn-default">Login</a>
       </div>
      </div>
     </form>
    </div>
   </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
 </body>

</html>