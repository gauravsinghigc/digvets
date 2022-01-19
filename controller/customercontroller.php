<?php

//require files
require '../require/modules.php';

//access_url 
if (isset($_REQUEST['access_url']) == null) {
 echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Root</a>";
 die();
} else {
 $access_url = $_REQUEST['access_url'];
}


//new customer
if (isset($_POST['SaveNewCustomer'])) {
 $CustomerName = $_POST['CustomerName'];
 $CustomerEmailid = $_POST['CustomerEmailid'];
 $CustomerPhoneNumber = $_POST['CustomerPhoneNumber'];
 $CustomerPassword = $_POST['CustomerPassword'];
 $CustomerStreetAddress = SECURE($_POST['CustomerStreetAddress'], "e");
 $CustomerArea = $_POST['CustomerArea'];
 $CustomerVillageBlock = $_POST['CustomerVillageBlock'];
 $CustomerCity = $_POST['CustomerCity'];
 $CustomerState = $_POST['CustomerState'];
 $CustomerPincode = $_POST['CustomerPincode'];
 $CustomerStatus = 1;
 $CustomerCreatedAt = date("d M, Y");
 $CustomerProfileImage = UPLOAD_FILES("../storage/customers/img/profile", "CustomerProfileImage", "$CustomerName", "$CustomerPhoneNumber", "CustomerProfileImage");
 $Save = SAVE("customers", ["CustomerName", "CustomerEmailid", "CustomerPhoneNumber", "CustomerPassword", "CustomerStreetAddress", "CustomerArea", "CustomerVillageBlock", "CustomerCity", "CustomerState", "CustomerPincode", "CustomerStatus", "CustomerCreatedAt", "CustomerProfileImage"]);
 RESPONSE($Save, "New Customer $CustomerName is created successfully!", "Unable to save new customer");

 //delete address
} else if (isset($_GET['deleteaddress'])) {
 $CustomerAddressid = SECURE($_GET['deleteaddress'], "d");
 $access_url = SECURE($_GET['access_url'], "d");
 $delete = DELETE("DELETE FROM customeraddress where CustomerAddressid='$CustomerAddressid'");
 RESPONSE($delete, "Address Deleted Sucsessfully!", "Unable to delete Address!");

 //update address
} else if (isset($_POST['UpdateAddress'])) {
 $CustomerAddressContactPerson = $_POST['CustomerAddressContactPerson'];
 $CustomerAddressAltPhone = $_POST['CustomerAddressAltPhone'];
 $CustomerAddressStreetAddress = SECURE($_POST['CustomerAddressStreetAddress'], "e");
 $CustomerAddressArea = $_POST['CustomerAddressArea'];
 $CustomerAddressCity = $_POST['CustomerAddressCity'];
 $CustomerAddressState = $_POST['CustomerAddressState'];
 $CustomerAddressPincode = $_POST['CustomerAddressPincode'];
 $CustomerAddressType = $_POST['CustomerAddressType'];
 $CustomerAddressGSTNo = $_POST['CustomerAddressGSTNo'];
 $CustomerAddressCountry = $_POST['CustomerAddressCountry'];
 $CustomerAddressid = $_SESSION['ADDRESS_ID'];
 $Update = UPDATE("UPDATE customeraddress SET CustomerAddressContactPerson='$CustomerAddressContactPerson', CustomerAddressAltPhone='$CustomerAddressAltPhone', CustomerAddressArea='$CustomerAddressArea', CustomerAddressCity='$CustomerAddressCity', CustomerAddressState='$CustomerAddressState', CustomerAddressPincode='$CustomerAddressPincode', CustomerAddressCountry='$CustomerAddressCountry', CustomerAddressType='$CustomerAddressType', CustomerAddressGSTNo='$CustomerAddressGSTNo' where CustomerAddressid='$CustomerAddressid'");
 RESPONSE($Update, "Address Updated Sucsessfully!", "Unable to Update Address");

 //update customer profile
} elseif (isset($_POST['UpdateCustomerProfile'])) {
 $CustomerId = SECURE($_POST['UpdateCustomerProfile'], "d");
 $CustomerName = $_POST['CustomerName'];
 $CustomerEmailid = $_POST['CustomerEmailid'];
 $CustomerPhoneNumber = $_POST['CustomerPhoneNumber'];
 $CustomerStreetAddress = SECURE($_POST['CustomerStreetAddress'], "e");
 $CustomerArea = $_POST['CustomerArea'];
 $CustomerVillageBlock = $_POST['CustomerVillageBlock'];
 $CustomerCity = $_POST['CustomerCity'];
 $CustomerState = $_POST['CustomerState'];
 $CustomerPincode = $_POST['CustomerPincode'];
 $CustomerStatus = $_POST['CustomerStatus'];
 $CustomerUpdatedAt = date("d M, Y");

 if ($_FILES['CustomerProfileImage']['name'] ==  null || $_FILES['CustomerProfileImage']['name'] == "null" || $_FILES['CustomerProfileImage']['name'] == " " || $_FILES['CustomerProfileImage']['name'] == "") {
  $CustomerProfileImage = SECURE($_POST['CustomerProfileImage_CURRENT'], "d");
 } else {
  $CustomerProfileImage = UPLOAD_FILES("../storage/customers/img/profile", "CustomerProfileImage", "$CustomerName", "$CustomerPhoneNumber", "CustomerProfileImage");
 }

 $UpdateCustomerProfile = UPDATE_TABLE("customers", ["CustomerName", "CustomerProfileImage", "CustomerUpdatedAt", "CustomerStatus", "CustomerPincode", "CustomerState", "CustomerEmailid", "CustomerPhoneNumber", "CustomerStreetAddress", "CustomerArea", "CustomerVillageBlock", "CustomerCity"], "CustomerId='$CustomerId'");
 RESPONSE($UpdateCustomerProfile, "Customer Profile Updated Successfully!", "unable to update customer profile at the moment!");
}
