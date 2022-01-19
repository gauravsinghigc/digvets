<?php
//page varibale
$PageName  = "Register as AI Worker";
$AccessLevel = "../../../";
$DirName = "web/ai-workers/";
$ActivityName = "Register as AI Workers";

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
            <li><a href="<?php echo DOMAIN; ?>/<?php echo $DirName; ?>/new"><i class="fa fa-angle-double-right text-color"></i> <?php echo $ActivityName; ?></a></li>
          </ul>
        </div>
      </div>
    </section>
    <section class="container m-b-20">
      <div class="row">
        <div class="col-md-12">
          <h2 class="m-t-0 text-color"><i class="fa fa-paw text-info"></i> <?php echo $PageName; ?></h4>
        </div>
      </div>
      <div class="col-md-12">
        <?php include '../../../include/forms/add-ai-worker-form.php'; ?>
      </div>
    </section>
    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  </body>

</html>