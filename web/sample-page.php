<?php

//page varibale
$PageName  = "Data Details";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="">
 <meta name="keywords" content="">
 <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
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
    <div class="col-md-12" style="background-image:url(<?php echo STORAGE_URL; ?>/faqs/faq-banner.jpg); background-size:cover;">
     <h2 class="text-center pt-5 page-title"><?php echo $PageName; ?></h2>
    </div>
   </div>
  </section>

  <section class="container section">
   <div class="row">
    <div class="col-md-12">
     <form action="" class="col-md-12" method="GET">
      <div class="flex-space-between">
       <input type="text" class="form-control faq-fields" name="search" placeholder="Enter Question">
       <button class="btn btn-md btn-md" type="submit">Search <i class="fa fa-search"></i></button>
      </div>
     </form>
    </div>
    <div class="col-md-12">
     <h3>Frequently Questions</h3>
     <hr>
    </div>
    <?php
    if (isset($_GET['search'])) {
     $seaarchvalues = $_GET['search'];
     $FetchListings = FetchConvertIntoArray("SELECT * FROM faqs where FAQSDescriptions like '%" . SECURE($seaarchvalues, "d") . "%' ORDER BY FaqsId ASC", true);
    } else {
     $FetchListings = FetchConvertIntoArray("SELECT * FROM faqs ORDER BY FaqsId ASC", true);
    }
    if ($FetchListings != null) {
     foreach ($FetchListings as $Fields) { ?>
      <div class="col-md-6 col-lg-6 col-sm-6 col-12">
       <div class="shadow-lg br10 p-1 m-b-10 faqs-details">
        <a class="flex-space-between faqs-section faqs-sections-2" onclick="Databar('Faqs_<?php echo $Fields->FaqsId; ?>')">
         <h1 class="faqs-title"><?php echo SECURE($Fields->FAQsName, "d"); ?></h1>
         <i class="fa fa-angle-right"></i>
        </a>
        <div class="p-3" id="Faqs_<?php echo $Fields->FaqsId; ?>" style="display:none;">
         <div class="p-2" style="padding:2rem">
          <?php echo SECURE($Fields->FAQSDescriptions, "d"); ?>
         </div>
        </div>
       </div>
      </div>
    <?php }
    }
    ?>
   </div>
  </section>

  <?php include $AccessLevel . "include/web/footer.php"; ?>
  <?php include $AccessLevel . "include/web/footer_files.php"; ?>
 </body>

</html>