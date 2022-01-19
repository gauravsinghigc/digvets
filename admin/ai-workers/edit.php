<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "EDIT AI WORKER";
if (isset($_GET['viewid'])) {
  $Requested_Aiworkersid = $_GET['viewid'];
  $_SESSION['VIEW_WORKER_ID'] = $_GET['viewid'];
} else {
  $Requested_Aiworkersid = $_SESSION['VIEW_WORKER_ID'];
}

$Requested_Aiworkersid = SECURE($Requested_Aiworkersid, 'd');
$PageSqls = "SELECT * from aiworkers where Aiworkersid='$Requested_Aiworkersid'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo "Dr. " . GET_DATA("AIWorkerName"); ?> | <?php echo APP_NAME; ?></title>
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
                  <?php include '../../include/forms/edit-ai-worker-form.php'; ?>
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