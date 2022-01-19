<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "Support & Enquiries";
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
    <div class="col-md-12 p-l-0 p-r-0">
     <h2 class="text-center pt-5 page-title"><?php echo $PageName; ?></h2>
    </div>
   </div>
  </section>

  <section class="container">
   <div class="row">
    <div class="col-md-12">
     <h2 class="text-center app-text">Submit your Enquiries</h2>
     <p class="text-center">Feel free to contact us for your queries.</p>
     <hr>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
     <div class="enquiry-box">
      <form action="../../controller/enquirycontroller.php" method="POST" enctype="multipart/form-data">
       <?php FormPrimaryInputs(true); ?>
       <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="FullName" class="form-control" required="">
       </div>
       <div class="form-group">
        <label>Phone Number</label>
        <input type="phone" name="PhoneNumber" class="form-control" required="">
       </div>
       <div class="form-group">
        <label>Subject</label>
        <input type="text" name="Subject" class="form-control" required="">
       </div>
       <div class="form-group">
        <label>Message</label>
        <textarea name="Message" id="editor" class="form-control"></textarea>
       </div>
       <?php UploadImageInput("EnquiryPhoto", "EnquiryPhoto", "image/*", true, ""); ?>
       <div class="form-group m-t-10">
        <button type="submit" name="SubmitEnquiry" class="btn btn-lg btn-success" value="Submit Enquiry">Send Enquiry</button>
       </div>
      </form>
     </div>
    </div>
   </div>
  </section>

  <?php include '../../include/web/footer.php'; ?>
  <?php include '../../include/web/footer_files.php'; ?>
 </body>

</html>