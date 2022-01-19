<?php

//page varibale
$PageName  = "Order Placed";
$AccessLevel = "../../";

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
</head>

<body>

 <body>

  <?php
  //header & loader
  include $AccessLevel . "include/web/loader.php";
  include $AccessLevel . "include/web/header.php";
  include $AccessLevel . "include/web/navbar.php";
  ?>

  <section class="container section">
   <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center m-t-30">
     <img src="<?php echo STORAGE_URL_D; ?>/tool-img/verify.gif" class="w-pr-16 img-circle doneimg">
     <h3>Order Placed Successfully1</h3>
     <p>Your Order Having Order Ref Id : <?php echo $_SESSION['OrderReferenceid']; ?> is placed successfully. you can view order details in your my orders sections.</p>
     <a href="<?php echo DOMAIN; ?>/web/account/orders" class="btn btn-md btn-success"><i class="fa fa-shopping-cart"></i> View Orders</a>
    </div>
   </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
 </body>

</html>