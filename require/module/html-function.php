<?php
//request variables
function Req_Data($req, $method, $sessional = false, $securitylevel = "enc")
{

 //get & post method data access
 if ($method === "GET") {
  $RequestedData = $_GET["$req"];
 } elseif ($method === "POST") {
  $RequestedData = $_POST["$req"];
 } else {
  $RequestedData = false;
 }

 //encrptionlevel
 if ($securitylevel == "enc") {
  $RequestedData = SECURE($RequestedData, "e");
 } else {
  $RequestedData =  SECURE($RequestedData, "d");
 }

 //sessional access
 if ($sessional == true) {
  $_SESSION["$req"] = $RequestedData;
 } else {
  $_SESSION["$req"] = false;
 }

 //reqturn value
 if ($RequestedData == false) {
  return false;
 } else {
  return $RequestedData;
 }
}

//price function display
function Price($price)
{
 echo "<span class='text-success'>Rs.$price</span>";
}

//mrp price function display
function MrpPrice($price)
{
 echo "<span class='text-danger'><strike>Rs.$price</strike></span>";
}

//payment status
function PayStatus($paystatus)
{
 if ($paystatus == "Un Paid") {
  echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Paid</span>";
 } else {
  echo "<span class='text-success'><i class='fa fa-check-circle-o'></i> Paid</span>";
 }
}

//enquiry status
function EnquiryStatus($enquiryno)
{
 if ($enquiryno == "0") {
  echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Read</span>";
 } elseif ($enquiryno == "1") {
  echo "<span class='text-warning'><i>Read</i></span>";
 } elseif ($enquiryno == "2") {
  echo "<span class='text-success'><i class='fa fa-check-circle-o'></i> Replied</span>";
 } elseif ($enquiryno == "3") {
  echo "<span class='text-info'><i class='fa fa-info-circle'></i> Closed</span>";
 } else {
  echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Read</span>";
 }
}
