<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Register New Doctors";
if (isset($_GET['viewid'])) {
  $Requested_Doctorsid = $_GET['viewid'];
  $_SESSION['VIEW_DOCTOR_ID'] = $_GET['viewid'];
} else {
  $Requested_Doctorsid = $_SESSION['VIEW_DOCTOR_ID'];
}

$Requested_Doctorsid = SECURE($Requested_Doctorsid, 'd');
$PageSqls = "SELECT * from doctors where Doctorsid='$Requested_Doctorsid'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo "Dr. " . GET_DATA("DoctorName"); ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div id="page-content">
          <!--====start content===============================================-->
          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="app-heading"><?php echo $PageName; ?></h3>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <?php include '../../include/forms/edit-doctor-form.php'; ?>
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

    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>