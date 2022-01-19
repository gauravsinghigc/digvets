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
    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
     <h3><i class="fa fa-user text-color"></i> My Account <i class="fa fa-angle-double-right"></i> Animals</h3>
     <a href="<?php echo DOMAIN; ?>/web/account/" class="btn btn-md fs-16 text-primary"><i class="fa fa-angle-left"></i> Back to Account</a>
    </div>
    <div class="col-md-6 col-lg-6 col-sm-6 col-12">
     <div class="p-3">
      <?php SEARCH_FORM([
       "OrderId" => "Search by Order Id",
       "OrderDate" => "Order date",
       "OrderAmount" => "Order Amount"
      ]); ?>
     </div>
    </div>
   </div>
  </section>

  <section class="container">
   <div class="row">
    <div class="col-md-12">
    </div>
   </div>
  </section>

  <section class="container section">
   <div class="row">

    <?php
    $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
    $fetchAnimals = FetchConvertIntoArray("SELECT * FROM animals where RegAnimalBy='$LOGIN_CustomerId' ORDER BY RegAnimalId ASC", true);
    if ($fetchAnimals != null) {
     foreach ($fetchAnimals as $data) {
      $AnimalImage1 = FETCH("SELECT * from animalimages where AnimalId='" . $data->RegAnimalId . "'", "AnimalImage1");
      $AnimalName = FETCH("SELECT * FROM animalsname where AnimalId='" . $data->RegAnimalCategory . "'", "AnimalName");
      $BreedName = FETCH("SELECT * FROM animalbreeds where AnimalBreedId='" . $data->RegAnimalBreed . "'", "BreedName");
    ?> <div class="col-md-4 col-lg-4 col-sm-4 col-6">
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
          <a href="#" class="cart-button m-t-7">Edit Details</a>
        </div>
       </a>
      </div>
    <?php }
    } ?>


   </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
 </body>

</html>