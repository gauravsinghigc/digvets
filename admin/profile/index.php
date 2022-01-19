<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Profile";
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
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div class="pageheader hidden-xs">
          <h3><i class="fa fa-refresh"></i> <?php echo $PageName; ?> </h3>
          <div class="breadcrumb-wrapper">
            <span class="label">You are here:</span>
            <ol class="breadcrumb">
              <li> <a href="<?php echo DOMAIN; ?>/admin"> Home </a> </li>
              <li class="active"> <?php echo $PageName; ?> </li>
            </ol>
          </div>
        </div>
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-heading">
              <div class="flex-s-b">
                <h4 class="text-primary">Profile : <?php echo LOGIN_UserName; ?></h4>
              </div>
            </div>
            <div class="panel-body">
              <h4>Update Profile</h4>
              <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-7 col-12">
                  <form class="form" action="../../controller/authcontroller.php" method="POST">
                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <h4>Personal Details</h4>
                      </div>
                      <?php FormPrimaryInputs(true); ?>
                      <div class="form-group col-md-6 col-sm-6">
                        <label>Full Name</label>
                        <input type="text" name="UserName" value="<?php echo LOGIN_UserName; ?>" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6">
                        <label>Phone Number</label>
                        <input type="text" name="UserPhone" value="<?php echo LOGIN_UserPhone; ?>" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6">
                        <label>Email Id</label>
                        <input type="email" name="UserEmailId" value="<?php echo LOGIN_UserEmailId; ?>" class="form-control-2" required="">
                      </div>
                      <div class="col-md-12">
                        <button type="Submit" name="UpdateProfile" class="btn btn-md app-bg">Update Details</button>
                      </div>
                    </div>
                  </form>
                  <hr>
                  <form class="form" action="../../controller/authcontroller.php" method="POST">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="col-md-12 col-sm-12">
                        <h4>Update Password <span id="passmsg"></span></h4>
                      </div>
                      <div class="form-group col-md-6 col-sm-6">
                        <label>Enter New Password</label>
                        <input type="password" name="UserPassword" oninput="checkpass()" id="pass1" class="form-control-2" required="">
                      </div>
                      <div class="form-group col-md-6 col-sm-6">
                        <label>Re-Enter New Password</label>
                        <input type="password" name="UserPassword_2" oninput="checkpass()" id="pass2" class="form-control-2" required="">
                      </div>
                      <div class="col-md-12">
                        <button type="Submit" id="passbtn" name="UpdatePassword" class="btn btn-md app-bg disabled">Update Password</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-12">
                  <div class="shadow-lg br10 p-2 border-success">
                    <div class="br10 app-bg-light p-3 text-center">
                      <center>
                        <img src="<?php echo STORAGE_URL_U; ?>/img/profile/<?php echo LOGIN_UserProfileImage; ?>" class="w-25 mx-auto d-block rounded config-logo">
                      </center>
                      <form class="form m-t-3" action="../../controller/usercontroller.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="updateprofileimage" value="true" hidden="">
                        <input type="text" name="current_img" value="<?php echo SECURE(LOGIN_UserProfileImage, "e"); ?>" hidden="">
                        <?php FormPrimaryInputs(true); ?>
                        <label for="UploadProfileimg">
                          <img src="<?php echo STORAGE_URL_D; ?>/tool-img/img-upload.png" class="w-pr-10 upload-icon">
                        </label>
                        <input type="file" class="hidden" onchange="form.submit()" hidden="" name="UserProfileImage" id="UploadProfileimg" value="<?php echo APP_LOGO; ?>" accept="images/*">
                      </form>
                    </div>
                    <p class="m-t-10">
                      <span class="fs-20"> <?php echo LOGIN_UserName; ?></span><br>
                      <span><i class="fa fa-phone text-info"></i> <?php echo LOGIN_UserPhone; ?></span><br>
                      <span><i class="fa fa-envelope text-danger"></i> <?php echo LOGIN_UserEmailId; ?></span><br>
                      <span><i class="fa fa-user text-warning"></i> <?php echo LOGIN_UserRoles; ?></span><br>
                      <span><i class="fa fa-calendar text-primary"></i> CreatedAt: <?php echo LOGIN_UserCreatedAt; ?></span><br>
                      <span><i class="fa fa-calendar text-primary"></i> UpdatedAt: <?php echo LOGIN_UserUpdatedAt; ?></span><br>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../include/admin/footer.php'; ?>
    </div>
    <script>
      function checkpass() {
        var pass1 = document.getElementById("pass1");
        var pass2 = document.getElementById("pass2");
        if (pass1.value === pass2.value) {
          document.getElementById("passbtn").classList.remove("disabled");
          document.getElementById("passmsg").classList.add("text-success");
          document.getElementById("passmsg").classList.remove("text-danger");
          document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle-o'></i> Password Matched!";
        } else {
          document.getElementById("passmsg").classList.remove("text-success");
          document.getElementById("passmsg").classList.add("text-danger");
          document.getElementById("passbtn").classList.add("disabled");
          document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
        }
      }
    </script>
    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>