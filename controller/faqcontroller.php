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

//create faqs
if (isset($_POST['CreateFAQS'])) {
 $FAQsName = SECURE($_POST['FAQsName'], "e");
 $FAQSDescriptions = SECURE($_POST['FAQSDescriptions'], "e");
 $FAQsStatus = 1;
 $FAQsCreatedAt = date("d M, Y");
 $save = SAVE("faqs", ["FAQsName", "FAQSDescriptions", "FAQsStatus", "FAQsCreatedAt"]);
 RESPONSE($save, "FAQs " . SECURE($FAQsName, "d") . "is created successfully!", "unable to save faqs!");

 //
}
