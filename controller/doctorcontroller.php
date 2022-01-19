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

//save doctors
if (isset($_POST['SaveNewDoctors'])) {
 $DoctorName = $_POST['DoctorName'];
 $DoctorMobileNumber = $_POST['DoctorMobileNumber'];
 $DoctorWhatsappNumber = $_POST['DoctorWhatsappNumber'];
 $DoctorTelegramNumber = $_POST['DoctorTelegramNumber'];
 $DoctorBio = SECURE($_POST['DoctorBio'], 'e');
 $DoctorStreetAddress = SECURE($_POST['DoctorStreetAddress'], "e");
 $DoctorAddressShopNo = SECURE($_POST['DoctorAddressShopNo'], "e");
 $DoctorAddressCity = $_POST['DoctorAddressCity'];
 $DoctorAddressDistrict = $_POST['DoctorAddressDistrict'];
 $DoctorAddressState = $_POST['DoctorAddressState'];
 $DoctorAddressPincode = $_POST['DoctorAddressPincode'];
 $DoctorQualifications = $_POST['DoctorQualifications'];
 $DoctorWorkExperience = $_POST['DoctorWorkExperience'];
 $DoctorExpertiseInAnimals = SECURE($_POST['DoctorExpertiseInAnimals'], "e");
 $DoctorSpecilisation = SECURE($_POST['DoctorSpecilisation'], "e");
 $DoctorConsultanctFeeInClinic = $_POST['DoctorConsultanctFeeInClinic'];
 $DoctorVisitingFee = $_POST['DoctorVisitingFee'];
 $DoctorFeeForPhoneConsultaning = $_POST['DoctorFeeForPhoneConsultaning'];
 $DoctorProfileImage = UPLOAD_FILES("../storage/doctors/images/profile", "DoctorProfileImage", "$DoctorName", "$DoctorMobileNumber", "DoctorProfileImage");
 $DoctorProfileBGImage = UPLOAD_FILES("../storage/doctors/images/bg", "DoctorProfileBGImage", "$DoctorName", "$DoctorMobileNumber", "DoctorProfileBGImage");
 $DoctorStatus = 1;
 $DoctorCreatedAt = date("d M, Y");
 if (isset($_SESSION['LOGIN_CustomerId'])) {
  $DoctorCreatedBy = $_SESSION['LOGIN_CustomerId'];
 } else {
  $DoctorCreatedBy = "Admin";
 }
 $DoctorEmailId = $_POST['DoctorEmailId'];

 $SaveDoctors = SAVE("doctors", ["DoctorName", "DoctorStreetAddress", "DoctorAddressShopNo", "DoctorAddressCity", "DoctorAddressDistrict", "DoctorAddressState", "DoctorAddressPincode", "DoctorMobileNumber", "DoctorWhatsappNumber", "DoctorTelegramNumber", "DoctorQualifications", "DoctorSpecilisation", "DoctorWorkExperience", "DoctorExpertiseInAnimals", "DoctorConsultanctFeeInClinic", "DoctorVisitingFee", "DoctorFeeForPhoneConsultaning", "DoctorProfileImage", "DoctorProfileBGImage", "DoctorBio", "DoctorStatus", "DoctorCreatedAt", "DoctorCreatedBy", "DoctorEmailId"]);
 RESPONSE($SaveDoctors, "New Doctor <b>Dr.$DoctorName</b> is saved succussfully!", "Unable to save new doctor");

 //update doctor profile
} else if (isset($_POST['UpdateDoctorProfile'])) {
 $Doctorsid = SECURE($_SESSION['VIEW_DOCTOR_ID'], "d");
 $DoctorName = $_POST['DoctorName'];
 $DoctorMobileNumber = $_POST['DoctorMobileNumber'];
 $DoctorWhatsappNumber = $_POST['DoctorWhatsappNumber'];
 $DoctorTelegramNumber = $_POST['DoctorTelegramNumber'];
 $DoctorBio = SECURE($_POST['DoctorBio'], 'e');
 $DoctorStreetAddress = SECURE($_POST['DoctorStreetAddress'], "e");
 $DoctorAddressShopNo = SECURE($_POST['DoctorAddressShopNo'], "e");
 $DoctorAddressCity = $_POST['DoctorAddressCity'];
 $DoctorAddressDistrict = $_POST['DoctorAddressDistrict'];
 $DoctorAddressState = $_POST['DoctorAddressState'];
 $DoctorAddressPincode = $_POST['DoctorAddressPincode'];
 $DoctorQualifications = $_POST['DoctorQualifications'];
 $DoctorWorkExperience = $_POST['DoctorWorkExperience'];
 $DoctorExpertiseInAnimals = SECURE($_POST['DoctorExpertiseInAnimals'], "e");
 $DoctorSpecilisation = SECURE($_POST['DoctorSpecilisation'], "e");
 $DoctorConsultanctFeeInClinic = $_POST['DoctorConsultanctFeeInClinic'];
 $DoctorVisitingFee = $_POST['DoctorVisitingFee'];
 $DoctorFeeForPhoneConsultaning = $_POST['DoctorFeeForPhoneConsultaning'];
 $DoctorStatus = $_POST['DoctorStatus'];
 $DoctorUpdatedAt = date("d M, Y");
 $DoctorEmailId = $_POST['DoctorEmailId'];

 if ($_FILES['DoctorProfileImage']['name'] ==  null || $_FILES['DoctorProfileImage']['name'] == "null" || $_FILES['DoctorProfileImage']['name'] == " " || $_FILES['DoctorProfileImage']['name'] == "") {
  $DoctorProfileImage = SECURE($_POST['DoctorProfileImage_CURRENT'], "d");
 } else {
  $DoctorProfileImage = UPLOAD_FILES("../storage/doctors/images/profile", "DoctorProfileImage", "$DoctorName", "$DoctorMobileNumber", "DoctorProfileImage");
 }

 if ($_FILES['DoctorProfileBGImage']['name'] ==  null || $_FILES['DoctorProfileBGImage']['name'] == "null" || $_FILES['DoctorProfileBGImage']['name'] == " " || $_FILES['DoctorProfileBGImage']['name'] == "") {
  $DoctorProfileBGImage = SECURE($_POST['DoctorProfileBGImage_CURRENT'], "d");
 } else {
  $DoctorProfileBGImage = UPLOAD_FILES("../storage/doctors/images/bg", "DoctorProfileBGImage", "$DoctorName", "$DoctorMobileNumber", "DoctorProfileBGImage");
 }

 $UpdateDoctorProfile = UPDATE_TABLE("doctors", ["DoctorName", "DoctorStreetAddress", "DoctorAddressShopNo", "DoctorAddressCity", "DoctorAddressDistrict", "DoctorAddressState", "DoctorAddressPincode", "DoctorMobileNumber", "DoctorWhatsappNumber", "DoctorTelegramNumber", "DoctorQualifications", "DoctorSpecilisation", "DoctorWorkExperience", "DoctorExpertiseInAnimals", "DoctorConsultanctFeeInClinic", "DoctorVisitingFee", "DoctorFeeForPhoneConsultaning", "DoctorProfileImage", "DoctorProfileBGImage", "DoctorBio", "DoctorStatus", "DoctorUpdatedAt", "DoctorEmailId"], "Doctorsid='$Doctorsid'");
 RESPONSE($UpdateDoctorProfile, "Doctor Profile Update Successfully!", "Unable to updte doctor at the moment");

 //delete doctors
} elseif (isset($_GET['delete_doctors'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_doctors = SECURE($_GET['delete_doctors'], "d");

 if ($delete_doctors == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $DeleteDoctors = DELETE_FROM("doctors", "Doctorsid='$control_id'");
  RESPONSE($DeleteDoctors, "Doctor profile is deleted successfully!", "Unable to delete doctors profile at the moment!");
 } else {
  LOCATION("danger", "Unable to validate activity request at the moment, please try again later or after some time", $access_url);
 }
 //for unknown requests
} else {
 LOCATION("warning", "Invalid Request of activity is received!", $access_url);
}
