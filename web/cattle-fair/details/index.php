<?php
//page varibale
$PageName  = "Cattle Fair";
$AccessLevel = "../../../";
$DirName = "web/cattle-fair/";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//request variables
$Requested_RegAnimalId = Req_Data("view", "GET", true, "dec");

//activity variables & page database access
$PageSqls = "SELECT * FROM animals WHERE RegAnimalId='" . $Requested_RegAnimalId . "'";
$AnimalId = FETCH("SELECT * FROM animals, animalsname where animals.RegAnimalId='$Requested_RegAnimalId' and animalsname.AnimalId=animals.RegAnimalCategory", "AnimalId");
$AnimalName = FETCH("SELECT * FROM animalsname where AnimalId='$AnimalId'", "AnimalName");
$BreedName = FETCH("SELECT * FROM animalbreeds where AnimalId='$AnimalId'", "BreedName");
$AnimalBreedId = FETCH("SELECT * FROM animalbreeds where AnimalId='$AnimalId'", "AnimalBreedId");
$RegAnimalBy = FETCH("SELECT * FROM animals where RegAnimalId='$Requested_RegAnimalId'", "RegAnimalBy");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo GET_DATA("RegAnimalTitle"); ?> | <?php echo APP_NAME; ?></title>
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
            <li><a href="<?php echo DOMAIN; ?>/<?php echo $DirName; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo $AnimalName; ?></a></li>
            <li><a href="<?php echo RUNNING_URL; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo GET_DATA("RegAnimalTitle"); ?></a></li>
          </ul>
        </div>
        <!-- data media files section -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="item-media-files">
            <img id="defaultimg" src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Requested_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Requested_RegAnimalId'", "AnimalImage1"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>">
            <div class="more-media">
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-3 p-r-0 text-center">
                  <img onmouseover="ChangeImage('img1')" id="img1" onmouseout="DefaultImg()" src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Requested_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Requested_RegAnimalId'", "AnimalImage1"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>" class="w-100 more-img">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-3 p-l-0 p-r-0 text-center">
                  <img onmouseover="ChangeImage('img2')" id="img2" onmouseout="DefaultImg()" src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Requested_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Requested_RegAnimalId'", "AnimalImage2"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>" class="w-100 more-img">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-3 p-l-0 p-r-0 text-center">
                  <img onmouseover="ChangeImage('img3')" id="img3" onmouseout="DefaultImg()" src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Requested_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Requested_RegAnimalId'", "AnimalImage3"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>" class="w-100 more-img">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-3 p-l-0 text-center">
                  <img onmouseover="ChangeImage('img4')" id="img4" onmouseout="DefaultImg()" src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Requested_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Requested_RegAnimalId'", "AnimalImage4"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>" class="w-100 more-img">
                </div>
              </div>
            </div>
            <div class="video-section">
              <h4 classs="bold"><?php echo GET_DATA("RegAnimalTitle"); ?> Video</h4>
              <video controls class="video-frame">
                <source src=" <?php echo DOMAIN; ?>/storage/animals/<?php echo $Requested_RegAnimalId; ?>/video/<?php echo FETCH("SELECT * FROM animalvideos where AnimalId='$Requested_RegAnimalId'", "AnimalVideo"); ?>">
              </video>
            </div>
          </div>
        </div>

        <!-- data details section -->
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
          <div class="item-brief">
            <h2><?php echo GET_DATA("RegAnimalTitle"); ?></h2>
            <ul class="inline-list-view">
              <li><b>Animal Type <i class="fa fa-angle-double-right"></i></b> <?php echo $AnimalName; ?></li>
              <li><b>Breed Name <i class="fa fa-angle-double-right"></i></b> <?php echo $BreedName; ?></li>
              <li><b>Age <i class="fa fa-angle-double-right"></i></b> <?php echo GET_DATA("RegAnimalAge"); ?></li>
              <li><b>Purpose <i class="fa fa-angle-double-right"></i></b> <?php echo GET_DATA("RegAnimalPurpose"); ?></li>
              <li><span class="text-grey"><i class="fa fa-calendar"></i> <?php echo GET_DATA("RegAnimalCreatedAt"); ?></span></li>
            </ul>
            <p>
              <span class="app-price">Rs.<?php echo GET_DATA("RegAnimalPrice"); ?></span>
              <span class="type"><?php echo GET_DATA("RegAnimalPriceType"); ?></span>
            </p>
            <?php echo SECURE(GET_DATA("RegAnimalDetails"), "d"); ?>
            <h4 class="text-color">More Details</h4>
            <table class="table-details-2 table table-striped">
              <tr>
                <th>Selling Type</th>
                <td><?php echo GET_DATA("RegAnimalRegType"); ?></td>
              </tr>
              <tr>
                <th>Selling Purpose</th>
                <td><?php echo GET_DATA("RegAnimalPurpose"); ?></td>
              </tr>
              <tr>
                <th>Teeth Count</th>
                <td><?php echo GET_DATA("RegAnimalTeeth"); ?></td>
              </tr>
              <tr>
                <th>Calving</th>
                <td><?php echo GET_DATA("RegAnimalCalving"); ?></td>
              </tr>
              <?php if (GET_DATA("RegAnimalPurpose") == "Milking") { ?>
                <tr>
                  <th>Per Day Milk <span>(in Litre)</span></th>
                  <td><?php echo GET_DATA("RegAnimalMilkQty"); ?></td>
                </tr>
                <tr>
                  <th>Maximum Milk <span>(in Liter)</span></th>
                  <td><?php echo GET_DATA("RegAnimalMaxMilk"); ?></td>
                </tr>
              <?php } ?>
            </table>

            <div class="row">
              <div class="col-md-12">
                <?php if (isset($_SESSION['LOGIN_CustomerId'])) {
                  if ($RegAnimalBy == "null" || $RegAnimalBy == null) {
                    $RegCustomerName = APP_NAME;
                    $RegCustomerPhonenumber = PRIMARY_PHONE;
                    $RegCustomerEmail = PRIMARY_EMAIL;
                    $RegCustomerWhatsappNumber = PRIMARY_PHONE;
                    $RegCustomerArea = "";
                    $RegCustomerCity = "Anywhere";
                    $RegCustomerState = "within India";
                  } else {
                    $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
                    $RegCustomerName = FETCH("SELECT * FROM customers where CustomerId='$RegAnimalBy'", "CustomerName");
                    $RegCustomerPhonenumber = FETCH("SELECT * FROM customers where CustomerId='" . $RegAnimalBy . "'", "CustomerPhoneNumber");
                    $RegCustomerEmail = FETCH("SELECT * FROM customers where CustomerId='" . $RegAnimalBy . "'", "CustomerEmailid");
                    $RegCustomerWhatsappNumber = FETCH("SELECT * FROM customers where CustomerId='" . $RegAnimalBy . "'", "CustomerPhoneNumber");
                    $RegCustomerArea = FETCH("SELECT * FROM customers where CustomerId='" . $RegAnimalBy . "'", "CustomerArea");
                    $RegCustomerCity = FETCH("SELECT * FROM customers where CustomerId='" . $RegAnimalBy . "'", "CustomerCity");
                    $RegCustomerState = FETCH("SELECT * FROM customers where CustomerId='" . $RegAnimalBy . "'", "CustomerState");
                  } ?>
                  <h4 class="text-color">Contact Details</h4>
                  <table class="table-details-2 table table-striped">
                    <tr>
                      <th>Name </th>
                      <td><?php echo $RegCustomerName ?></td>
                    </tr>
                    <tr>
                      <th>Location </th>
                      <td><?php echo $RegCustomerArea ?> <?php echo $RegCustomerCity; ?> <?php echo $RegCustomerState; ?></td>
                    </tr>
                    <tr>
                      <th>Email </th>
                      <td><?php echo $RegCustomerEmail ?></td>
                    </tr>
                  </table>
                  <div class="contact-buttons">
                    <a href="tel:<?php echo $RegCustomerPhonenumber; ?>" class="btn btn-lg btn-primary"><i class="fa fa-phone"></i> <?php echo $RegCustomerPhonenumber; ?></a>
                    <a href="http://api.whatsapp.com/send?phone=<?php echo $RegCustomerWhatsappNumber; ?>" class="btn btn-lg btn-success rounded"><i class="fa fa-whatsapp"></i> <?php echo $RegCustomerWhatsappNumber; ?></a>
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
          <h2 class="text-color">More Related Animals</h2>
        </div>
        <?php
        $fetchAnimals = FetchConvertIntoArray("SELECT * FROM animals where RegAnimalCategory='$AnimalId' ORDER BY RegAnimalId ASC limit 0, 4", true);
        if ($fetchAnimals != null) {
          foreach ($fetchAnimals as $data) {
            $AnimalImage1 = FETCH("SELECT * from animalimages where AnimalId='" . $data->RegAnimalId . "'", "AnimalImage1");
            $AnimalName = FETCH("SELECT * FROM animalsname where AnimalId='" . $data->RegAnimalCategory . "'", "AnimalName");
            $BreedName = FETCH("SELECT * FROM animalbreeds where AnimalBreedId='" . $data->RegAnimalBreed . "'", "BreedName");
        ?> <div class="col-md-3 col-lg-3 col-sm-3 col-6">
              <a href="<?php echo DOMAIN; ?>/web/cattle-fair/details/?view=<?php echo SECURE($data->RegAnimalId, "e"); ?>">
                <div class="cat-box">
                  <img src="<?php echo STORAGE_URL; ?>/animals/<?php echo $data->RegAnimalId; ?>/img/<?php echo $AnimalImage1; ?>" class="w-100 br10">
                  <h4 class="text-center"><?php echo StatusView($data->RegAnimalStatus); ?> <b><?php echo $data->RegAnimalTitle; ?></b></h6>
                    <p class="fs-13">
                      <span class="flex-space-between">
                        <span class="w-50"><b>Type:</b> <?php echo $AnimalName; ?></span>
                        <span class="w-50"><b>Breed:</b> <?php echo $BreedName; ?></span>
                      </span>
                      <span class="flex-space-between">
                        <span class="w-50"><b>RegType: </b><?php echo $data->RegAnimalRegType; ?></span>
                        <span class="w-50"><b>Purpose: </b> <?php echo $data->RegAnimalPurpose; ?></span>
                      </span>
                      <span class="flex-space-between">
                        <span class="w-50"><b>Age:</b> <?php echo $data->RegAnimalAge; ?></span>
                        <span class="w-50"><b>Teeth:</b> <?php echo $data->RegAnimalTeeth; ?></span>
                      </span>
                      <?php if ($data->RegAnimalPurpose == "Milking") { ?>
                        <span class="flex-space-between">
                          <span class="w-50"><b>Milk :</b> <?php echo $data->RegAnimalMilkQty; ?>L/day</span>
                          <span class="w-50"><b>Max:</b> <?php echo $data->RegAnimalMaxMilk; ?>L</span>
                        </span>
                      <?php } ?>
                      <span><b>Calving: </b><?php echo $data->RegAnimalCalving; ?></span><br>
                    </p>
                    <span class="app-price m-1 d-block mx-auto text-success fs-16"><b>Rs.<?php echo $data->RegAnimalPrice; ?></b></span><br>
                    <a href="#" class="cart-button m-t-7">Know More</a>
                </div>
              </a>
            </div>
        <?php }
        } ?>
        <div class="col-md-12 text-right">
          <h4 class="m-t-0">
            <a href="<?php echo DOMAIN; ?>/web/cattle-fair/" class="text-color">View All <i class="fa fa-angle-double-right"></i></a>
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