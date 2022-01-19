<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "FAQs";
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
                  <a href="<?php echo DOMAIN; ?>/admin/website/faqs/add.php" class="btn btn-sm btn-success square">ADD FAQs</a>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="flex-s-b">
                <h4 class="m-b-0">All <?php echo $PageName; ?></h4>
              </div>

              <div class="row m-t-10">
                <?php
                $FetchListings = FetchConvertIntoArray("SELECT * FROM faqs ORDER BY FaqsId ASC", true);
                if ($FetchListings != null) {
                  foreach ($FetchListings as $Fields) { ?>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
                      <div class="shadow-lg br10 p-1">
                        <a class="flex-s-b faqs-section" onclick="Databar('Faqs_<?php echo $Fields->FaqsId; ?>')">
                          <h4 class="faqs-title"><?php echo SECURE($Fields->FAQsName, "d"); ?></h4>
                          <i class="fa fa-angle-right"></i>
                        </a>
                        <div class="p-1" id="Faqs_<?php echo $Fields->FaqsId; ?>" style="display:none;">
                          <?php echo SECURE($Fields->FAQSDescriptions, "d"); ?>
                        </div>
                        <div class="details p-1r">
                          <a href="edit.php?id=<?php echo $Fields->FaqsId; ?>" class="btn btn-default btn-sm">Edit</a>
                        </div>
                      </div>
                    </div>
                <?php }
                }
                ?>
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