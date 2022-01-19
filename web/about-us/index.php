<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "About Us";
$PageAccess = "AboutUs";
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
 <?php include '../../include/web/header_files.php'; ?>
</head>

<body>

 <body>

  <?php
  //header & loader
  include '../../include/web/loader.php';
  include '../../include/web/header.php';
  include '../../include/web/navbar.php'; ?>

  <section class="container-fluid section">
   <div class="row">
    <div class="col-md-12" style="background-image:url(<?php echo STORAGE_URL; ?>/pages/<?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageFeatureImage"); ?>); background-size:cover;">
     <h2 class="text-center pt-5 page-title"><?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageDisplayName"); ?></h2>
    </div>
   </div>
  </section>
  <section class="container section">
   <div class="row">
    <div class="col-md-12">
     <h3 class="m-t-4"><b><?php echo FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageDisplayName"); ?> @ <?php echo APP_NAME; ?></b></h3>
     <?php echo SECURE(FETCH("SELECT * FROM pages where PageName='$PageAccess'", "PageContent"), "d"); ?>
    </div>
   </div>
  </section>

  <?php include '../../include/web/footer.php'; ?>
  <?php include '../../include/web/footer_files.php'; ?>
 </body>

</html>