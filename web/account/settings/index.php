<?php

//page varibale
$PageName  = "My Account";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

$PageSqls = "SELECT * FROM customers where CustomerId='" . LOGIN_CustomerId . "'";
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
    <div class="col-md-12 col-lg-12 col-sm-12 col-12">
     <h3><i class="fa fa-user text-color"></i> My Account <i class="fa fa-angle-double-right"></i> Account Settings</h3>
     <a href="<?php echo DOMAIN; ?>/web/account/" class="btn btn-md fs-16 text-primary"><i class="fa fa-angle-left"></i> Back to Account</a>
    </div>
   </div>
  </section>

  <section class="container section">
   <div class="row">
    <div class="col-md-6">
     <h4>Primary Details</h4>
     <hr>
     <form action="../../../controller/authcontroller.php" method="POST">
      <?php FormPrimaryInputs(true); ?>
      <table class="w-100">
       <tr>
        <th>Full name</th>
        <td>
         <input type="text" name="CustomerName" class="form-control" required="" value="<?php echo GET_DATA('CustomerName'); ?>">
        </td>
       </tr>
       <tr>
        <th>Email Id</th>
        <td>
         <input type="text" name="CustomerEmailid" class="form-control" readonly="" required="" value="<?php echo GET_DATA('CustomerEmailid'); ?>">
        </td>
       </tr>
       <tr>
        <th>Phone Number</th>
        <td>
         <input type="text" name="CustomerPhoneNumber" class="form-control" readonly="" required="" value="<?php echo GET_DATA('CustomerPhoneNumber'); ?>">
        </td>
       </tr>
       <tr>
        <td colspan="2">
         <button name="UpdateCustomerProfile" value="<?php echo LOGIN_CustomerId;  ?>" class="btn btn-md btn-primary">Update Profile</button>
        </td>
       </tr>
      </table>
     </form>
    </div>
    <div class="col-md-6">
     <h4>Security Details</h4>
     <hr>
     <form action="" method="POST">
      <?php FormPrimaryInputs(true); ?>
      <table class='w-100'>
       <tr>
        <th>Current Password</th>
        <td>
         <input type="password" name="CustomerName" class="form-control" required="" value="">
        </td>
       </tr>
       <tr>
        <th>New Passwords <span id="passmsg"></span></th>
        <td>
         <input type="password" name="CustomerEmailid" oninput="checkpass()" id="pass1" class="form-control" required="" value="">
        </td>
       </tr>
       <tr>
        <th>Re-Enter New Password</th>
        <td>
         <input type="password" name="CustomerPhoneNumber" oninput="checkpass()" id="pass2" class="form-control" required="" value="">
        </td>
       </tr>
       <tr>
        <td colspan="2">
         <button name="UpdatePasswords" class="btn btn-md btn-primary">Update Security</button>
        </td>
       </tr>
      </table>
     </form>
    </div>
   </div>
  </section>


  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
 </body>

</html>