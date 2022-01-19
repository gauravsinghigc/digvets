<?php

//require files
require '../require/modules.php';
require '../require/admin/sessionvariables.php';

//access_url 
if (isset($_REQUEST['access_url']) == null) {
 echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Root</a>";
 die();
} else {
 $access_url = $_REQUEST['access_url'];
}

//save new worker ai
if (isset($_POST['SaveNewAIWsorker'])) {
 $AIWorkerName = $_POST['AIWorkerName'];
 $AIWorkerMobileNumber = $_POST['AIWorkerMobileNumber'];
 $AIWorkerWhatsappNumber = $_POST['AIWorkerWhatsappNumber'];
 $AIWorkerTelegramNumber = $_POST['AIWorkerTelegramNumber'];
 $AIWorkerEmail = $_POST['AIWorkerEmail'];
 $AIWorkerDescriptions = SECURE($_POST['AIWorkerDescriptions'], "e");
 $AIWorkerStreetAddress = SECURE($_POST['AIWorkerStreetAddress'], "e");
 $AIWorkerArea = $_POST['AIWorkerArea'];
 $AIWorkerVillage = $_POST['AIWorkerVillage'];
 $AIWorkerTehsil = $_POST['AIWorkerTehsil'];
 $AIWorkerDistrict = $_POST['AIWorkerDistrict'];
 $AIWorkerCity = $_POST['AIWorkerCity'];
 $AIWorkerState = $_POST['AIWorkerState'];
 $AIWorkerPincode = $_POST['AIWorkerPincode'];
 $AIWorkerQualification = $_POST['AIWorkerQualification'];
 $AIWorkerExperience = $_POST['AIWorkerExperience'];
 $AIWorkerExpertiseIn = SECURE($_POST['AIWorkerExpertiseIn'], "e");
 $AIWorkerSpecilization = SECURE($_POST['AIWorkerSpecilization'], "e");
 $AIWorkerConsultaningFee = $_POST['AIWorkerConsultaningFee'];
 $AIWorkerProfile = UPLOAD_FILES("../storage/workers/images/profile", "AIWorkerProfile", "$AIWorkerName", "$AIWorkerMobileNumber", "AIWorkerProfile");
 $AIWorkerBGImage = UPLOAD_FILES("../storage/workers/images/bg", "AIWorkerBGImage", "$AIWorkerName", "$AIWorkerMobileNumber", "AIWorkerBGImage");
 $AIWorkerStatus = 1;
 $AIWorkerCreatedAt = date("d M, Y");
 if (isset($_SESSION['LOGIN_CustomerId'])) {
  $AIWorkerCreatedBy = $_SESSION['LOGIN_CustomerId'];
 } else {
  $AIWorkerCreatedBy = "Admin";
 }

 $Save = SAVE("aiworkers", ["AIWorkerName", "AIWorkerStreetAddress", "AIWorkerArea", "AIWorkerVillage", "AIWorkerTehsil", "AIWorkerCity", "AIWorkerDistrict", "AIWorkerMobileNumber", "AIWorkerWhatsappNumber", "AIWorkerTelegramNumber", "AIWorkerEmail", "AIWorkerQualification", "AIWorkerSpecilization", "AIWorkerExperience", "AIWorkerExpertiseIn", "AIWorkerConsultaningFee", "AIWorkerDescriptions", "AIWorkerProfile", "AIWorkerBGImage", "AIWorkerStatus", "AIWorkerCreatedAt", "AIWorkerState", "AIWorkerPincode", "AIWorkerCreatedBy"]);
 RESPONSE($Save, "New AI Worker $AIWorkerName is created successfully!", "unable to create ai worker!");

 //update ai workers
} elseif (isset($_POST['UpdateAIWsorker'])) {
 $Aiworkersid = SECURE($_POST['UpdateAIWsorker'], "d");
 $AIWorkerName = $_POST['AIWorkerName'];
 $AIWorkerMobileNumber = $_POST['AIWorkerMobileNumber'];
 $AIWorkerWhatsappNumber = $_POST['AIWorkerWhatsappNumber'];
 $AIWorkerTelegramNumber = $_POST['AIWorkerTelegramNumber'];
 $AIWorkerEmail = $_POST['AIWorkerEmail'];
 $AIWorkerDescriptions = SECURE($_POST['AIWorkerDescriptions'], "e");
 $AIWorkerStreetAddress = SECURE($_POST['AIWorkerStreetAddress'], "e");
 $AIWorkerArea = $_POST['AIWorkerArea'];
 $AIWorkerVillage = $_POST['AIWorkerVillage'];
 $AIWorkerTehsil = $_POST['AIWorkerTehsil'];
 $AIWorkerDistrict = $_POST['AIWorkerDistrict'];
 $AIWorkerCity = $_POST['AIWorkerCity'];
 $AIWorkerState = $_POST['AIWorkerState'];
 $AIWorkerPincode = $_POST['AIWorkerPincode'];
 $AIWorkerQualification = $_POST['AIWorkerQualification'];
 $AIWorkerExperience = $_POST['AIWorkerExperience'];
 $AIWorkerExpertiseIn = SECURE($_POST['AIWorkerExpertiseIn'], "e");
 $AIWorkerSpecilization = SECURE($_POST['AIWorkerSpecilization'], "e");
 $AIWorkerConsultaningFee = $_POST['AIWorkerConsultaningFee'];

 if ($_FILES['AIWorkerProfile']['name'] ==  null || $_FILES['AIWorkerProfile']['name'] == "null" || $_FILES['AIWorkerProfile']['name'] == " " || $_FILES['AIWorkerProfile']['name'] == "") {
  $AIWorkerProfile = SECURE($_POST['AIWorkerProfile_CURRENT'], "d");
 } else {
  $AIWorkerProfile = UPLOAD_FILES("../storage/workers/images/profile", "AIWorkerProfile", "$AIWorkerName", "$AIWorkerMobileNumber", "AIWorkerProfile");
 }

 if ($_FILES['AIWorkerBGImage']['name'] ==  null || $_FILES['AIWorkerBGImage']['name'] == "null" || $_FILES['AIWorkerBGImage']['name'] == " " || $_FILES['AIWorkerBGImage']['name'] == "") {
  $AIWorkerBGImage = SECURE($_POST['AIWorkerBGImage_CURRENT'], "d");
 } else {
  $AIWorkerBGImage = UPLOAD_FILES("../storage/workers/images/bg", "AIWorkerBGImage", "$AIWorkerName", "$AIWorkerMobileNumber", "AIWorkerBGImage");
 }

 $AIWorkerStatus = $_POST['AIWorkerStatus'];
 $AIWorkerUpdatedAt = date("d M, Y");

 $UpdateWorkers = UPDATE_TABLE("aiworkers", ["AIWorkerName", "AIWorkerStreetAddress", "AIWorkerArea", "AIWorkerVillage", "AIWorkerTehsil", "AIWorkerCity", "AIWorkerDistrict", "AIWorkerMobileNumber", "AIWorkerWhatsappNumber", "AIWorkerTelegramNumber", "AIWorkerEmail", "AIWorkerQualification", "AIWorkerSpecilization", "AIWorkerExperience", "AIWorkerExpertiseIn", "AIWorkerConsultaningFee", "AIWorkerDescriptions", "AIWorkerProfile", "AIWorkerBGImage", "AIWorkerStatus", "AIWorkerUpdatedAt", "AIWorkerState", "AIWorkerPincode"], "Aiworkersid='$Aiworkersid'");
 RESPONSE($UpdateWorkers, "AI Worker $AIWorkerName is updated successfully!", "unable to update ai worker!");

 //delete workers
} elseif (isset($_GET['delete_aiworkers'])) {
 $delete_aiworkers = SECURE($_GET['delete_aiworkers'], "d");
 $access_url = SECURE($_GET['access_url'], "d");

 if ($delete_aiworkers == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("aiworkers", "Aiworkersid='$control_id'");
  RESPONSE($delete, "AI Worker is deleted successfully!", "unable to delete ai worker!");
 } else {
  RESPONSE(false, "Invalid request!", "unable to delete ai worker!");
 }
 // invalid request for unknown activity
} else {
 LOCATION("warning", "Invalid request is received!", $access_url);
}
