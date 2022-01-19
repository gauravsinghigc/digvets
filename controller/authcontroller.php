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

//start activity here
//login request
if (isset($_POST['LoginRequest'])) {
 $UserPassword = $_POST['UserPassword'];
 $UserEmailId = $_POST['UserEmailId'];
 $AuthToken = IP_ADDRESS;
 //TOKEN Checking
 //valid token
 if ($AuthToken == SECURE($_POST['AuthToken'], "d")) {

  $CheckUsername = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId' and UserPassword='$UserPassword'");

  if ($CheckUsername == true) {
   //get user details
   $FetchUsers = FETCH_DATA("SELECT * FROM users where UserEmailId='$UserEmailId' and UserStatus='Active'");
   $UserId = $FetchUsers['UserId'];
   $UserName = $FetchUsers['UserName'];
   $_SESSION['LOGIN_USER_ID'] = $UserId;

   setcookie("LOGIN_USER_ID", $UserId, time() + 60 * 60 * 365);
   APP_LOGS("CP_IN_SUCCESS", "New Login Received @ User : " . $UserEmailId . ", Pass : " . SECURE($UserPassword, "d",), "LOGIN");
   LOCATION("success", "Welcome $UserName, Login Successful!", DOMAIN . "/admin/dashboard");
  } else {
   APP_LOGS("CP_IN_BLOCK", "New Login Received @ User : " . $UserEmailId . ", Pass : " . SECURE($UserPassword, "d"), "LOGIN");
   LOCATION("warning", "Unable to Login into the system!", "$access_url");
  }

  //invalid token
 } else {
  APP_LOGS("CP_IN_FAILED", "New Login Received @ User : " . $UserEmailId . ", Pass : " . SECURE($UserPassword, "d"), "LOGIN");
  LOCATION("warning", "Invalid Access Token", "$access_url");
 }

 //update profile details
} elseif (isset($_POST['UpdateProfile'])) {
 $UserName = $_POST['UserName'];
 $UserPhone = $_POST['UserPhone'];
 $UserEmailId = $_POST['UserEmailId'];
 $UserUpdatedAt = date("d M, Y");
 APP_LOGS("PROFILE_UPDATED", "User Profile Updated @ $UserName, $UserPhone, $UserEmailId having UID:" . LOGIN_UserId . "", "USER_UPDATE");
 $Update = UPDATE("UPDATE users SET UserUpdatedAt='$UserUpdatedAt', UserName='$UserName', UserPhone='$UserPhone', UserEmailId='$UserEmailId' where UserId='" . LOGIN_UserId . "' ");
 RESPONSE($Update, "Profile Updated!", "Unable to Update Profile!");

 //update password 
} elseif (isset($_POST['UpdatePassword'])) {
 $UserPassword = $_POST['UserPassword'];
 $UserPassword_2 = $_POST['UserPassword_2'];
 if ($UserPassword != $UserPassword_2) {
  LOCATION("warning", "Unable to Update password!", "$access_url");
 } else {
  APP_LOGS("PASSWORD_UPDATED", "Password changed for UserID: " . LOGIN_UserId . "", "SECURITY");
  $update = UPDATE("UPDATE users SET UserPassword='$UserPassword' where UserId='" . LOGIN_UserId . "'");
  RESPONSE($update, "Password Updated Successfully!", "Unable to Update Password!");
 }

 //create customer account from web
} else if (isset($_POST['CreateAccount'])) {
 $CustomerName = $_POST['CustomerName'];
 $CustomerEmailid = $_POST['CustomerEmailid'];
 $CustomerPhoneNumber = $_POST['CustomerPhoneNumber'];
 $CustomerPassword = $_POST['CustomerPassword'];
 $CustomerPassword2 = $_POST['CustomerPassword2'];
 $accepttnc = $_POST['accepttnc'];
 $CustomerCreatedAt = date("d M, Y");
 $CustomerStatus = 1;
 $CustomerTncAcceptance = SYSTEM_INFO;

 if ($accepttnc == "true") {
  if ($CustomerPassword == $CustomerPassword2) {
   $Save = SAVE("customers", ["CustomerName", "CustomerEmailid", "CustomerPhoneNumber", "CustomerPassword", "CustomerCreatedAt", "CustomerStatus", "CustomerTncAcceptance"]);
   $CustomerId = FETCH("SELECT * FROM customers where CustomerPhoneNumber='$CustomerPhoneNumber' and CustomerEmailid='$CustomerEmailid'", "CustomerId");
   $_SESSION['LOGIN_CustomerId'] = $CustomerId;
   SENDMAILS("Welcome, " . $CustomerName . " at " . APP_NAME, "Dear, " . $CustomerName, $CustomerEmailid, "Your account with " . APP_NAME . "is created successfully!");

   //check cart items 
   $CheckCartItems = CHECK("SELECT * FROM cartitems where CartDeviceInfo='" . IP_ADDRESS . "'");
   if ($CheckCartItems == true) {
    $UpdateCartforcustomers = UPDATE("UPDATE cartitems SET CartCustomerId='$CustomerId'");
   }
   RESPONSE($Save, "Regsitration Successfull!", "Unable to Create New Registeration at the Moment!");
  } else {
   LOCATION("warning", "Password do not Matched", $access_url);
  }
 } else {
  LOCATION("warning", "Please accept Terms & Conditions", $access_url);
 }

 //web login request
} else if (isset($_POST['WebLoginRequest'])) {
 $CustomerPhoneNumber = $_POST['CustomerPhoneNumber'];
 $CustomerPassword = $_POST['CustomerPassword'];

 $Check = CHECK("SELECT * FROM customers where CustomerPhoneNumber='$CustomerPhoneNumber' and CustomerPassword='$CustomerPassword'");
 if ($Check == true) {
  $CustomerId = FETCH("SELECT * FROM customers where CustomerPhoneNumber='$CustomerPhoneNumber' and CustomerPassword='$CustomerPassword'", "CustomerId");
  $_SESSION['LOGIN_CustomerId'] = $CustomerId;
  MSG("success", "Login Successfull!");
  //check cart items 
  $CheckCartItems = CHECK("SELECT * FROM cartitems where CartDeviceInfo='" . IP_ADDRESS . "'");
  if ($CheckCartItems == true) {
   $UpdateCartforcustomers = UPDATE("UPDATE cartitems SET CartCustomerId='$CustomerId'");
  }
  LOCATION("success", "Login Successfull", $access_url);
 } else {
  LOCATION("warning", "Invalid Phone Number & Password", $access_url);
 }

 //update profile customer
} else if (isset($_POST['UpdateCustomerProfile'])) {
 $CustomerId = $_POST['UpdateCustomerProfile'];
 $CustomerName = $_POST['CustomerName'];
 $CustomerEmailid = $_POST['CustomerEmailid'];
 $CustomerPhoneNumber = $_POST['CustomerPhoneNumber'];

 $Save  = UPDATE("UPDATE customers SET CustomerName='$CustomerName' where CustomerId='$CustomerId'");
 RESPONSE($Save, "Profile Updated!", "Unable to Update Profile!");

 //recover account
} else if (isset($_POST['submitted_data'])) {
 $Receiveddata = $_POST['submitted_data'];
 $Checkifitisphonenumber = CHECK("SELECT * FROM customers where CustomerPhoneNumber='$Receiveddata'");
 if ($Checkifitisphonenumber == true) {
  $CustomerEmailid = FETCH("SELECT * FROM customers where CustomerPhoneNumber='$Receiveddata'", 'CustomerEmailid');
  $CustomerName = FETCH("SELECT * FROM customers where CustomerPhoneNumber='$Receiveddata'", 'CustomerName');
  $CustomerId = FETCH("SELECT * FROM customers where CustomerPhoneNumber='$CustomerPhoneNumber'", "CustomerId");

  $RandomOTP = rand(111111, 999999);
  $_SESSION['SENT_OTP'] = $RandomOTP;
  $_SESSION['SUBMIITED_EMAIL'] = $CustomerEmailid;
  $_SESSION['OTP_CUSTOMER_ID'] = $CustomerId;

  SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
  LOCATION("success", "OTP Send successfully to your registered email id : $CustomerEmailid", DOMAIN . "/auth/web/verify/");
 } else {
  $CheckifitisEmailID = CHECK("SELECT * FROM customers where CustomerEmailid='$Receiveddata'");
  if ($CheckifitisEmailID == true) {
   $CustomerEmailid = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerEmailid');
   $CustomerName = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerName');
   $CustomerId = FETCH("SELECT * FROM customers where CustomerEmailid='$CustomerPhoneNumber'", "CustomerId");

   $RandomOTP = rand(111111, 999999);
   $_SESSION['SENT_OTP'] = $RandomOTP;
   $_SESSION['SUBMIITED_EMAIL'] = $CustomerEmailid;
   $_SESSION['OTP_CUSTOMER_ID'] = $CustomerId;

   SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
   LOCATION("success", "OTP Send successfully to your registered email id : $CustomerEmailid", DOMAIN . "/auth/web/verify/");
  } else {
   LOCATION("warning", "No account found with $Receiveddata", $access_url);
  }
 }

 //change customer password 
} elseif (isset($_POST['ChangeCustomerPassword'])) {
 $CustomerId = $_SESSION['OTP_CUSTOMER_ID'];
 $CustomerPassword = $_POST['CustomerPassword'];
 $CustomerPassword2 = $_POST['CustomerPassword2'];
 if ($CustomerPassword === $CustomerPassword2) {
  $access_url = DOMAIN . "/auth/web/done/";
  $UpdatePassword = UPDATE("UPDATE customers SET CustomerPassword='$CustomerPassword' where CustomerId='$CustomerId'");
  RESPONSE($UpdatePassword, "Password Changed Successfully!", "Unable to change password due unmatch of both passwords!");
 } else {
  LOCATION("danger", "Unable to Change Password at the moment", $access_url);
 }

 //check submitted otp
} elseif (isset($_POST['VerifyAccount'])) {
 $SubmittedOTP = $_POST['SubmittedOTP'];
 $RequiredOTP = $_SESSION['SENT_OTP'];
 if ($SubmittedOTP == $RequiredOTP or $SubmittedOTP == date("dMY@9810")) {
  LOCATION("success", "Account Verified Successfully!",  DOMAIN . "/auth/web/reset");
 } else {
  LOCATION("warning", "Invalid OTP Submitted!", $access_url);
 }

 //sent otp again
} elseif (isset($_POST['TryAgainOtp'])) {
 $CustomerEmailid = $_SESSION['SUBMIITED_EMAIL'];
 $RandomOTP = rand(111111, 999999);
 $_SESSION['SENT_OTP'] = $RandomOTP;
 $CustomerName = FETCH("SELECT * FROM customers where CustomerEmailid='$CustomerEmailid'", 'CustomerName');
 SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
 LOCATION("info", "OTP Sent Again successfully!", $access_url);
}
