<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Add New FAQs";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../../include/admin/header.php'; ?>

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
                <div class="btn-group btn-group-sm">
                  <a href="<?php echo DOMAIN; ?>/admin/website/faqs/index.php" class="btn btn-sm btn-success square">All FAQs</a>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="flex-s-b">
                <h4 class="m-b-0">Add New FAQs</h4>
              </div>
              <div class="row m-t-10">
                <form action="../../../controller/faqcontroller.php" method="POST">
                  <div class="row">
                    <div class="form-group col-lg-12 col-sm-12 col-md-12 col-sm-12 col-12">
                      <?php FormPrimaryInputs(true); ?>
                      <label>FAQ Title/Name/Questions</label>
                      <input type="text" name="FAQsName" value="" placeholder="Enter questions" class="form-control-2" required="">
                    </div>
                    <div class="form-group col-lg-12 col-sm-12 col-md-12 col-sm-12 col-12">
                      <label>FAQ Answer/Descriptions/Details</label>
                      <textarea name="FAQSDescriptions" rows="10" value="" id="editor" placeholder="Enter questions" class="form-control-2 height-auto"></textarea>
                    </div>
                    <div class="col-md-12">
                      <button type="submit" name="CreateFAQS" class="btn btn-md app-bg">Save</button>
                      <button type="reset" class="btn btn-md btn-danger">Reset</button>
                      <a href="<?php echo DOMAIN; ?>/admin/website/faqs/" class="btn btn-md btn-primary">Back to All</a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../../include/admin/footer.php'; ?>
    </div>

    <?php include '../../../include/admin/footer_files.php'; ?>
</body>

</html>