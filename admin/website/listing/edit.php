<?php

//required files
require '../../../require/modules.php';
require '../../../require/admin/access-control.php';
require '../../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Main Listing Details";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $_SESSION['ViewId'] = $_GET['id'];
} else {
  $id = $_SESSION['ViewId'];
}
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
                <?php include '../common.php'; ?>
              </div>
            </div>
            <div class="panel-body">
              <div class="flex-s-b">
                <h4 class="m-b-0">Main Listings</h4>
                <a href="add-slider.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Sliders</a>
              </div>
              <div class="row m-t-10">
                <?php
                $FetchListings = FetchConvertIntoArray("SELECT * FROM mainlistings where MainListingId='$id' ORDER BY MainListingId ASC", true);
                if ($FetchListings != null) {
                  foreach ($FetchListings as $Fields) { ?>
                    <div class="col-md-3 col-lg-3 col-sm-6 col-6">
                      <div class="shadow-lg br10 p-1">
                        <img src="<?php echo STORAGE_URL; ?>/listing/<?php echo $Fields->MainListingImage; ?>" title="<?php echo $Fields->MainListingName; ?>" alt="<?php echo $Fields->MainListingName; ?>" class="listing-img w-100">

                        <form class="" action="../../../controller/mainlistingcontroller.php" method="POST" enctype="multipart/form-data">
                          <?php FormPrimaryInputs(true); ?>
                          <?php CurrentFile($Fields->MainListingImage); ?>
                          <input type="text" name="MainListingId" value="<?php echo $Fields->MainListingId; ?>" hidden="">
                          <input type="text" name="UpdateListingImage" hidden="">
                          <label for="Listingimage" class="uploadicon">
                            <i class="fa fa-upload"></i>
                          </label>
                          <input name="MainListingImage" id="Listingimage" type="FILE" class="form-control-2 hidden" required="" placeholder="Lisiting image" onchange="form.submit()">
                        </form>

                        <div class="details p-1r">
                          <h4 class="m-t-0 m-b-5"><?php echo StatusView($Fields->MainListingStatus); ?> <?php echo $Fields->MainListingName; ?></h4>
                          <form class="m-t-5" action="../../../controller/mainlistingcontroller.php" method="POST" enctype="multipart/form-data" id="Update_<?php echo $Fields->MainListingId; ?>">
                            <?php FormPrimaryInputs(true); ?>
                            <input type="text" name="MainListingId" value="<?php echo $Fields->MainListingId; ?>" hidden="">
                            <div class="form-group m-b-0">
                              <input name="MainListingName" type="text" class="form-control-2 text-black" required="" placeholder="Listing Name" value="<?php echo $Fields->MainListingName; ?>">
                            </div>
                            <div class="form-group m-b-0">
                              <select name="MainListingStatus" class="form-control-2" required="">
                                <?php SelectStatus($Fields->MainListingStatus); ?>
                              </select>
                            </div>
                            <div class="form-group m-b-0">
                              <button type="submit" name="UpdateListings" class="btn btn-sm app-bg">Update</button>
                            </div>
                          </form>
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