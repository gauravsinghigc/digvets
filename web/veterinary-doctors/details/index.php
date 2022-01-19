<?php

//page varibale
$PageName  = "Veterinary Doctors";
$AccessLevel = "../../../";
$DirName = "web/veterinary-doctors/";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//request variables
$Requested_Doctorsid = Req_Data("viewdata", "GET", true, "dec");

//activity variables & page database access
$PageSqls = "SELECT * FROM doctors WHERE Doctorsid='" . $Requested_Doctorsid . "'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title>Dr.<?php echo GET_DATA("DoctorName"); ?> | <?php echo APP_NAME; ?></title>
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
            <li><a href="<?php echo DOMAIN; ?>/<?php echo $DirName; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo GET_DATA("DoctorName"); ?></a></li>
            <li><a href="<?php echo RUNNING_URL; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo GET_DATA("DoctorName"); ?></a></li>
          </ul>
        </div>

        <div class="col-md-12 m-t-7">
          <div class="bg-user-image">
            <img id="defaultimg" src="<?php echo STORAGE_URL_D; ?>/tool-img/bg-image.jpg" title="<?php echo GET_DATA("DoctorName"); ?>" alt="<?php echo GET_DATA("DoctorName"); ?>">
          </div>
        </div>
        <!-- data media files section -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="item-media-files">
            <img id="defaultimg" src="<?php echo DOMAIN; ?>/storage/doctors/images/profile/<?php echo GET_DATA("DoctorProfileImage"); ?>" title="<?php echo GET_DATA("DoctorName"); ?>" alt="<?php echo GET_DATA("DoctorName"); ?>">
          </div>
        </div>

        <!-- data details section -->
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
          <div class="item-brief">
            <h2>Dr. <?php echo GET_DATA("DoctorName"); ?></h2>
            <ul class="inline-list-view">
              <li><b><i class="fa fa-graduation-cap"></i></b> <?php echo GET_DATA("DoctorQualifications"); ?></li>
            </ul>

            <?php echo SECURE(GET_DATA("DoctorBio"), "d"); ?>
            <h4 class="text-color">More Information</h4>
            <table class="table-details-2 table table-striped">
              <tr>
                <th>Specilisation</th>
                <td><?php echo SECURE(GET_DATA("DoctorSpecilisation"), "d"); ?></td>
              </tr>
              <tr>
                <th>Expertise</th>
                <td><?php echo SECURE(GET_DATA("DoctorExpertiseInAnimals"), "d"); ?></td>
              </tr>
              <tr>
                <th>Qualifications</th>
                <td><?php echo GET_DATA("DoctorQualifications"); ?></td>
              </tr>
              <tr>
                <th>Experience</th>
                <td><?php echo GET_DATA("DoctorWorkExperience"); ?></td>
              </tr>
            </table>
            <h4 class="text-color">Fees & Charges</h4>
            <table class="table-details-2 table table-striped">
              <tr>
                <th>Home Visiting Fee</th>
                <td><span class="app-price-2">Rs.<?php echo GET_DATA("DoctorVisitingFee"); ?></span></td>
              </tr>
              <tr>
                <th>Clinic Visiting Fee</th>
                <td><span class="app-price-2">Rs.<?php echo GET_DATA("DoctorConsultanctFeeInClinic"); ?></span></td>
              </tr>
              <tr>
                <th>Phone Consultanting Fee</th>
                <td><span class="app-price-2">Rs.<?php echo GET_DATA("DoctorFeeForPhoneConsultaning"); ?></span></td>
              </tr>
            </table>

            <div class="row">
              <div class="col-md-12">
                <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
                  <h4 class="text-color">Contact Details & Address</h4>
                  <table class="table-details-2 table table-striped">
                    <tr>
                      <th>Name</th>
                      <td>Dr.<?php echo GET_DATA("DoctorName"); ?></td>
                    </tr>
                    <tr>
                      <th>Location </th>
                      <td>
                        <?php echo SECURE(GET_DATA("DoctorStreetAddress"), "d"); ?>
                        <?php echo SECURE(GET_DATA("DoctorAddressShopNo"), "d"); ?>
                        <?php echo GET_DATA("DoctorAddressCity"); ?>
                        <?php echo GET_DATA("DoctorAddressDistrict"); ?>
                        <?php echo GET_DATA("DoctorAddressState"); ?>
                        <?php echo GET_DATA("DoctorAddressPincode"); ?>
                      </td>
                    </tr>
                    <tr>
                      <th>Email </th>
                      <td><?php echo GET_DATA("DoctorEmailId"); ?></td>
                    </tr>
                  </table>
                  <div class="contact-buttons">
                    <a href="tel:<?php echo GET_DATA("DoctorMobileNumber"); ?>" class="btn btn-lg btn-primary"><i class="fa fa-phone"></i> <?php echo GET_DATA("DoctorMobileNumber"); ?></a>
                    <a href="http://api.whatsapp.com/send?phone=<?php echo GET_DATA("DoctorWhatsappNumber"); ?>" class="btn btn-lg btn-success rounded"><i class="fa fa-whatsapp"></i> <?php echo GET_DATA("DoctorWhatsappNumber"); ?></a>
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
          <h2 class="text-color">More Related Doctors</h2>
        </div>
        <?php
        $DoctorExpertiseInAnimals = GET_DATA("DoctorExpertiseInAnimals");
        $fetchdoctors = FetchConvertIntoArray("SELECT * FROM doctors where DoctorStatus='1' ORDER BY Doctorsid ASC limit 0, 4", true);
        if ($fetchdoctors != null) {
          foreach ($fetchdoctors as $data) {

        ?> <div class="col-md-3 col-lg-3 col-sm-3 col-6">
              <a href="<?php echo DOMAIN; ?>/web/veterinary-doctors/details/?viewdata=<?php echo SECURE($data->Doctorsid, "e"); ?>">
                <div class="cat-box">
                  <img src="<?php echo STORAGE_URL; ?>/doctors/images/bg/<?php echo $data->DoctorProfileBGImage; ?>" class="bg-image">
                  <div class="img-section">
                    <center>
                      <img src="<?php echo STORAGE_URL; ?>/doctors/images/profile/<?php echo $data->DoctorProfileImage; ?>" title="<?php echo $data->DoctorName; ?>" alt="<?php echo $data->DoctorName; ?>" class="w-100  m-l-7">
                    </center>
                  </div>
                  <h4 class="m-t-0 m-b-3 text-center">
                    <span>
                      <b><?php echo StatusView($data->DoctorStatus); ?> Dr. <?php echo $data->DoctorName; ?></b>
                    </span>
                  </h4>

                  <table class="table table-striped m-t-10 table-details m-b-5">
                    <tr>
                      <th>Specilisation</th>
                      <td><?php echo SECURE($data->DoctorSpecilisation, "d"); ?></td>
                    </tr>
                    <tr>
                      <th>Expertise</th>
                      <td><?php echo SECURE($data->DoctorExpertiseInAnimals, "d"); ?></td>
                    </tr>
                    <tr>
                      <th>Qualifications</th>
                      <td><?php echo $data->DoctorQualifications; ?></td>
                    </tr>
                    <tr>
                      <th>Experience</th>
                      <td><?php echo $data->DoctorWorkExperience; ?></td>
                    </tr>
                    <tr>
                      <th>Clinic Visit Fee</th>
                      <td><span class="app-price text-color"><i class="fa fa-medkit"></i> Rs.<?php echo $data->DoctorConsultanctFeeInClinic; ?></span>
                      </td>
                    </tr>
                    <tr>
                      <th>Home Visit Fee</th>
                      <td class="p-2"><span class="app-price text-color"><i class="fa fa-home"></i> Rs.<?php echo $data->DoctorVisitingFee; ?></span>
                      </td>
                    </tr>
                    <tr>
                      <th>Call Fee</th>
                      <td><span class="app-price text-color"><i class="fa fa-phone"></i> Rs.<?php echo $data->DoctorFeeForPhoneConsultaning; ?></span>
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
            <a href="<?php echo DOMAIN; ?>/web/veterinary-doctors/" class="text-color">View All <i class="fa fa-angle-double-right"></i></a>
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