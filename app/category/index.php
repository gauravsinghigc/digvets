<?php
//require functions
require '../../require/modules.php';
require '../../require/app-modules.php';
$Pagename = "View All Categories";

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Home | <?php echo APP_NAME; ?></title>
 <?php include '../../include/app/header_files.php'; ?>
</head>

<body>
 <?php
 include '../../include/app/header-nav.php';
 include '../../include/app/navbar.php'; ?>


 <section class="container-fluid">
  <div class="row">
   <?php
   $FetchListings = FetchConvertIntoArray("SELECT * FROM mainlistings ORDER BY MainListingId ASC", true);
   if ($FetchListings != null) {
    foreach ($FetchListings as $Fields) { ?>
     <a href="<?php echo DOMAIN; ?>/app/<?php echo $Fields->ListinUrl; ?>">
      <div class="col-sm-6 col-xs-6">
       <img src="<?php echo STORAGE_URL; ?>/listing/<?php echo $Fields->MainListingImage; ?>" title="<?php echo $Fields->MainListingName; ?>" alt="<?php echo $Fields->MainListingName; ?>" class="w-100 br10">
       <h3 class="text-center m-t-10 m-b-20"><?php echo $Fields->MainListingName; ?></h3>
      </div>
     </a>
   <?php }
   } ?>
  </div>
 </section>



 <?php include '../../include/app/footer_files.php'; ?>
</body>

</html>