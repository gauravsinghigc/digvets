<?php

//page varibale
$PageName  = "AI Workers";
$AccessLevel = "../../../";
$DirName = "web/ai-workers/";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//request variables
$Requested_Aiworkersid = Req_Data("view", "GET", true, "dec");

//activity variables & page database access
$PageSqls = "SELECT * FROM aiworkers WHERE Aiworkersid='" . $Requested_Aiworkersid . "'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo GET_DATA("AIWorkerName"); ?> | <?php echo APP_NAME; ?></title>
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

    <section class="container-fluid section">
      <div class="row">
        <!-- page location -->
        <div class="col-md-12 header-bg">
          <ul class="inline-list-view">
            <li><a href="<?php echo DOMAIN; ?>"><i class="fa fa-home text-color"></i> Home</a></li>
            <li><a href="<?php echo DOMAIN; ?>/<?php echo $DirName; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo $PageName; ?></a></li>
            <li><a href="<?php echo DOMAIN; ?>/<?php echo $DirName; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo GET_DATA("AIWorkerName"); ?></a></li>
            <li><a href="<?php echo RUNNING_URL; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo GET_DATA("AIWorkerName"); ?></a></li>
          </ul>
        </div>

        <div class="col-md-12 m-t-7">
          <div class="bg-user-image">
            <img id="defaultimg" src="<?php echo STORAGE_URL_D; ?>/tool-img/bg-image.jpg" title="<?php echo GET_DATA("AIWorkerName"); ?>" alt="<?php echo GET_DATA("AIWorkerName"); ?>">
          </div>
        </div>
        <!-- data media files section -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="item-media-files">
            <img id="defaultimg" src="<?php echo DOMAIN; ?>/storage/workers/images/profile/<?php echo GET_DATA("AIWorkerProfile"); ?>" title="<?php echo GET_DATA("AIWorkerName"); ?>" alt="<?php echo GET_DATA("AIWorkerName"); ?>">
          </div>
        </div>

        <!-- data details section -->
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
          <div class="item-brief">
            <h2><?php echo GET_DATA("AIWorkerName"); ?></h2>
            <ul class="inline-list-view">
              <li><b><i class="fa fa-graduation-cap"></i></b> <?php echo GET_DATA("AIWorkerQualification"); ?></li>
            </ul>

            <?php echo SECURE(GET_DATA("AIWorkerDescriptions"), "d"); ?>
            <h4 class="text-color">More Information</h4>
            <table class="table-details-2 table table-striped">
              <tr>
                <th>Specilisation</th>
                <td><?php echo SECURE(GET_DATA("AIWorkerSpecilization"), "d"); ?></td>
              </tr>
              <tr>
                <th>Expertise</th>
                <td><?php echo SECURE(GET_DATA("AIWorkerExpertiseIn"), "d"); ?></td>
              </tr>
              <tr>
                <th>Qualifications</th>
                <td><?php echo GET_DATA("AIWorkerQualification"); ?></td>
              </tr>
              <tr>
                <th>Work Experience</th>
                <td><?php echo GET_DATA("AIWorkerExperience"); ?></td>
              </tr>
            </table>
            <h4 class="text-color">Fees & Charges</h4>
            <table class="table-details-2 table table-striped">
              <tr>
                <th>Consultanct Fee</th>
                <td><span class="app-price-2">Rs.<?php echo GET_DATA("AIWorkerConsultaningFee"); ?></span></td>
              </tr>
            </table>

            <div class="row">
              <div class="col-md-12">
                <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
                  <h4 class="text-color">Contact Details & Address</h4>
                  <table class="table-details-2 table table-striped">
                    <tr>
                      <th>Name</th>
                      <td><?php echo GET_DATA("AIWorkerName"); ?></td>
                    </tr>
                    <tr>
                      <th>Location </th>
                      <td>
                        <?php echo SECURE(GET_DATA("AIWorkerStreetAddress"), "d"); ?>
                        <?php echo GET_DATA("AIWorkerArea"); ?>
                        <?php echo GET_DATA("AIWorkerVillage"); ?>
                        <?php echo GET_DATA("AIWorkerTehsil"); ?>
                        <?php echo GET_DATA("AIWorkerCity"); ?>
                        <?php echo GET_DATA("AIWorkerDistrict"); ?>
                      </td>
                    </tr>
                    <tr>
                      <th>Email </th>
                      <td><?php echo GET_DATA("AIWorkerEmail"); ?></td>
                    </tr>
                  </table>
                  <div class="contact-buttons">
                    <a href="tel:<?php echo GET_DATA("AIWorkerMobileNumber"); ?>" class="btn btn-lg btn-primary"><i class="fa fa-phone"></i> <?php echo GET_DATA("AIWorkerMobileNumber"); ?></a>
                    <a href="http://api.whatsapp.com/send?phone=<?php echo GET_DATA("AIWorkerWhatsappNumber"); ?>" class="btn btn-lg btn-success rounded"><i class="fa fa-whatsapp"></i> <?php echo GET_DATA("AIWorkerWhatsappNumber"); ?></a>
                  </div>
                <?php  } else { ?>
                  <a href="#" onclick="showform()" class="btn btn-lg btn-primary"><i class="fa fa-lock"></i> Login to View Contact Details</a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container-fluid section">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-color">More Related AI Workers</h2>
        </div>
        <?php
        $AIWorkerExpertiseIn = GET_DATA("AIWorkerExpertiseIn");
        $fetchaiworkers = FetchConvertIntoArray("SELECT * FROM aiworkers ORDER BY Aiworkersid ASC LIMIT 0, 4", true);
        if ($fetchaiworkers != null) {
          foreach ($fetchaiworkers as $data) {
        ?>
            <div class="col-md-3 col-lg-3 col-sm-4 col-6">
              <a href="<?php echo DOMAIN; ?>/web/ai-workers/details/?view=<?php echo SECURE($data->Aiworkersid, "e"); ?>">
                <div class="cat-box">
                  <img src="<?php echo STORAGE_URL; ?>/workers/images/bg/<?php echo $data->AIWorkerBGImage; ?>" class="br50 bg-image">
                  <div class="img-section">
                    <center>
                      <img src="<?php echo STORAGE_URL; ?>/workers/images/profile/<?php echo $data->AIWorkerProfile; ?>" title="<?php echo $data->AIWorkerName; ?>" alt="<?php echo $data->AIWorkerName; ?>" class="w-100 m-l-7">
                    </center>
                  </div>
                  <h4 class="m-t-0 m-b-3 text-center">
                    <span>
                      <b><?php echo StatusView($data->AIWorkerStatus); ?> <?php echo $data->AIWorkerName; ?></b>
                    </span>
                  </h4>

                  <table class="table table-striped m-t-10 table-details m-b-5">
                    <tr>
                      <th>Specilisation</th>
                      <td><?php echo SECURE($data->AIWorkerSpecilization, "d"); ?></td>
                    </tr>
                    <tr>
                      <th>Expertise</th>
                      <td><?php echo SECURE($data->AIWorkerExpertiseIn, "d"); ?></td>
                    </tr>
                    <tr>
                      <th>Qualifications</th>
                      <td><?php echo $data->AIWorkerQualification; ?></td>
                    </tr>
                    <tr>
                      <th>Experience</th>
                      <td><?php echo $data->AIWorkerExperience; ?></td>
                    </tr>
                    <tr>
                      <th>Fee</th>
                      <td><span class="app-price text-color"><i class="fa fa-phone"></i> Rs.<?php echo $data->AIWorkerConsultaningFee; ?></span>
                      </td>
                    </tr>
                  </table>
                  <a href="#" class="cart-button"><i class="fa fa-info-circle"></i> GET CONTACT INFO</a>
                </div>
              </a>
            </div>
        <?php }
        } ?>
        <div class="col-md-12 text-right">
          <h4 class="m-t-0">
            <a href="<?php echo DOMAIN; ?>/web/ai-workers/" class="text-color">View All <i class="fa fa-angle-double-right"></i></a>
          </h4>
        </div>
      </div>
    </section>

    <script>
      function ChangeImage(data) {
        var GetImageSrc = document.getElementById("" + data + "").src;
        document.getElementById("defaultimg").src = GetImageSrc;
      }

      function DefaultImg() {
        var GetImageSrc = document.getElementById("" + data + "").src;
        document.getElementById("defaultimg").src = GetImageSrc;
      }
    </script>
    <?php include '../common.php'; ?>
    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  </body>

</html>