<?php
//date formates
function DATE_FORMATE($format, $date)
{
 $newdateformate = date("$format", strtotime($_REQUEST["$date"]));
 return $newdateformate;
}

//date formates
function DATE_FORMATE2($format, $date)
{
 $newdateformate = date("$format", strtotime($date));
 if ($date == null  or $date == "") {
  $newdateformate = "";
 } else {
  $newdateformate = $newdateformate;
 }
 return $newdateformate;
}
