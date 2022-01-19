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

//update listing
if (isset($_POST['UpdateListings'])) {
 $MainListingName = $_POST['MainListingName'];
 $MainListingStatus = $_POST['MainListingStatus'];
 $MainListingId = $_POST['MainListingId'];
 $Update = UPDATE("UPDATE mainlistings SET MainListingName='$MainListingName', MainListingStatus='$MainListingStatus' where MainListingId='$MainListingId'");
 RESPONSE($Update, "$MainListinName is updated successfully!", "Unable to Update Main Listing!");

 //update listing image
} else if (isset($_POST['UpdateListingImage'])) {
 $MainListingId = $_POST['MainListingId'];
 $CurrentFile = SECURE($_POST['CurrentFile'], "d");
 $MainListingImage = UPLOAD_FILES("../storage/listing", "$CurrentFile", "MainListing", "$MainListingId", "MainListingImage");
 $Update = UPDATE("UPDATE mainlistings SET MainListingImage='$MainListingImage' where MainListingId='$MainListingId'");
 RESPONSE($Update, "Listing Image is updated successfully!", "Unable to Update Listing Image!");
}
