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

//start activities
if (isset($_POST['CreateAnimals'])) {
 $AnimalName = $_POST['AnimalName'];
 $AnimalCreatedAt = date("d M, Y");
 $AnimalImage = UPLOAD_FILES("../storage/animals/animal-name-img", "AnimalImage", "$AnimalName", "name-entries", "AnimalImage");
 $AnimalStatus = 1;
 $Save = SAVE("animalsname", ["AnimalName", "AnimalCreatedAt", "AnimalStatus", "AnimalImage"]);
 RESPONSE($Save, "$AnimalName name is saved successfully", "Unable to save animal name!");

 //create animal attributes
} else if (isset($_POST['CreateAnimalsBreeds'])) {
 $AnimalId = $_POST['AnimalId'];
 $BreedName = $_POST['BreedName'];
 $BreedStatus = 1;
 $BreedCreatedAt = date("d M, Y");

 $SAVE = SAVE("animalbreeds", ["AnimalId", "BreedName", "BreedStatus", "BreedCreatedAt"]);
 RESPONSE($SAVE, "Animal breed are created successfully!", "Unable to create animal breed");

 //reg new animal
} else if (isset($_POST['RegistrerNewAnimals'])) {
 $RegAnimalCategory = $_POST['RegAnimalCategory'];
 $RegAnimalBreed = $_POST['RegAnimalBreed'];
 $RegAnimalTitle = $_POST['RegAnimalTitle'];
 $RegAnimalRegType = $_POST['RegAnimalRegType'];
 $RegAnimalPurpose = $_POST['RegAnimalPurpose'];
 $RegAnimalAge = $_POST['RegAnimalAge'];
 $RegAnimalTeeth = $_POST['RegAnimalTeeth'];

 if ($RegAnimalRegType == "Sell") {
  $RegAnimalPriceType = $_POST['RegAnimalPriceType'];
  $RegAnimalPrice = $_POST['RegAnimalPrice'];
 } else {
  $RegAnimalPriceType = "Not Available";
  $RegAnimalPrice = "Not Available";
 }

 if ($RegAnimalPurpose == "Milking") {
  $RegAnimalMilkQty = $_POST['RegAnimalMilkQty'];
  $RegAnimalMaxMilk = $_POST['RegAnimalMaxMilk'];
 } else {
  $RegAnimalMilkQty = "Not Available";
  $RegAnimalMaxMilk = "Not Available";
 }
 $RegAnimalCalving = $_POST['RegAnimalCalving'];
 $RegAnimalDetails = SECURE($_POST['RegAnimalDetails'], "e");

 if (isset($_SESSION['LOGIN_CustomerId'])) {
  $RegAnimalBy = $_SESSION['LOGIN_CustomerId'];
 } else {
  $RegAnimalBy = $_SESSION['LOGIN_USER_ID'];
 }

 $RegAnimalCreatedAt = date("d M, Y");
 $RegAnimalStatus = 1;
 $SaveAnimal = SAVE("animals", ["RegAnimalBy", "RegAnimalTitle", "RegAnimalRegType", "RegAnimalPurpose", "RegAnimalCategory", "RegAnimalBreed", "RegAnimalAge", "RegAnimalTeeth", "RegAnimalCalving", "RegAnimalMilkQty", "RegAnimalMaxMilk", "RegAnimalPriceType", "RegAnimalPrice", "RegAnimalDetails", "RegAnimalStatus", "RegAnimalCreatedAt"]);
 if ($SaveAnimal == true) {
  $AnimalId = FETCH("SELECT * FROM animals ORDER BY RegAnimalId DESC limit 0, 1", "RegAnimalId");
  $AnimalImage1 = UPLOAD_FILES("../storage/animals/$AnimalId/img", "AnimalImage1", "$RegAnimalTitle" . "_img1" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalImage1");
  $AnimalImage2 = UPLOAD_FILES("../storage/animals/$AnimalId/img", "AnimalImage2", "$RegAnimalTitle" . "_img2" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalImage2");
  $AnimalImage3 = UPLOAD_FILES("../storage/animals/$AnimalId/img", "AnimalImage3", "$RegAnimalTitle" . "_img3" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalImage3");
  $AnimalImage4 = UPLOAD_FILES("../storage/animals/$AnimalId/img", "AnimalImage4", "$RegAnimalTitle" . "_img4" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalImage4");
  $SaveImage = SAVE("animalimages", ["AnimalId", "AnimalImage1", "AnimalImage2", "AnimalImage3", "AnimalImage4"]);

  $AnimalVideo = UPLOAD_FILES("../storage/animals/$AnimalId/video", "AnimalVideo1", "$RegAnimalTitle" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalVideo1");
  $SaveVideo = SAVE("animalvideos", ["AnimalId", "AnimalVideo"]);
  RESPONSE($SaveVideo, "New Animal $RegAnimalTitle is registered successfully!", "Unable to registered new animal");
 } else {
  RESPONSE($SaveAnimal, "New Animal $RegAnimalTitle is registered successfully!", "Unable to registered new animal");
 }

 //update animals
} elseif (isset($_POST['UpdateRegAnimals'])) {
 $RegAnimalId  =  SECURE($_POST['UpdateRegAnimals'], "d");
 $RegAnimalCategory = $_POST['RegAnimalCategory'];
 $RegAnimalBreed = $_POST['RegAnimalBreed'];
 $RegAnimalTitle = $_POST['RegAnimalTitle'];
 $RegAnimalRegType = $_POST['RegAnimalRegType'];
 $RegAnimalPurpose = $_POST['RegAnimalPurpose'];
 $RegAnimalAge = $_POST['RegAnimalAge'];
 $RegAnimalTeeth = $_POST['RegAnimalTeeth'];

 if ($RegAnimalRegType == "Sell") {
  $RegAnimalPriceType = $_POST['RegAnimalPriceType'];
  $RegAnimalPrice = $_POST['RegAnimalPrice'];
 } else {
  $RegAnimalPriceType = "Not Available";
  $RegAnimalPrice = "Not Available";
 }

 if ($RegAnimalPurpose == "Milking") {
  $RegAnimalMilkQty = $_POST['RegAnimalMilkQty'];
  $RegAnimalMaxMilk = $_POST['RegAnimalMaxMilk'];
 } else {
  $RegAnimalMilkQty = "Not Available";
  $RegAnimalMaxMilk = "Not Available";
 }
 $RegAnimalCalving = $_POST['RegAnimalCalving'];
 $RegAnimalDetails = SECURE($_POST['RegAnimalDetails'], "e");

 if (isset($_SESSION['LOGIN_CustomerId'])) {
  $RegAnimalBy = $_SESSION['LOGIN_CustomerId'];
 } else {
  $RegAnimalBy = $_SESSION['LOGIN_USER_ID'];
 }

 $RegAnimalUpdatedAt = date("d M, Y");
 $RegAnimalStatus = $_POST['RegAnimalStatus'];
 $Update = UPDATE_TABLE("animals", ["RegAnimalBy", "RegAnimalTitle", "RegAnimalRegType", "RegAnimalPurpose", "RegAnimalCategory", "RegAnimalBreed", "RegAnimalAge", "RegAnimalTeeth", "RegAnimalCalving", "RegAnimalMilkQty", "RegAnimalMaxMilk", "RegAnimalPriceType", "RegAnimalPrice", "RegAnimalDetails", "RegAnimalStatus", "RegAnimalUpdatedAt"], "RegAnimalId='$RegAnimalId'");
 if ($Update == true) {
  $AnimalId = $RegAnimalId;

  if ($_FILES['AnimalImage1']['name'] ==  null || $_FILES['AnimalImage1']['name'] == "null" || $_FILES['AnimalImage1']['name'] == " " || $_FILES['AnimalImage1']['name'] == "") {
   $AnimalImage1 = SECURE($_POST['AnimalImage1_CURRENT'], "d");
  } else {
   $AnimalImage1 = UPLOAD_FILES("../storage/animals/$AnimalId/img", "AnimalImage1", "$RegAnimalTitle" . "_img1" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalImage1");
  }

  if ($_FILES['AnimalImage2']['name'] ==  null || $_FILES['AnimalImage2']['name'] == "null" || $_FILES['AnimalImage2']['name'] == " " || $_FILES['AnimalImage2']['name'] == "") {
   $AnimalImage2 = SECURE($_POST['AnimalImage2_CURRENT'], "d");
  } else {
   $AnimalImage2 = UPLOAD_FILES("../storage/animals/$AnimalId/img", "AnimalImage2", "$RegAnimalTitle" . "_img2" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalImage2");
  }

  if ($_FILES['AnimalImage3']['name'] ==  null || $_FILES['AnimalImage3']['name'] == "null" || $_FILES['AnimalImage3']['name'] == " " || $_FILES['AnimalImage3']['name'] == "") {
   $AnimalImage3 = SECURE($_POST['AnimalImage3_CURRENT'], "d");
  } else {
   $AnimalImage3 = UPLOAD_FILES("../storage/animals/$AnimalId/img", "AnimalImage3", "$RegAnimalTitle" . "_img3" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalImage3");
  }

  if ($_FILES['AnimalImage4']['name'] ==  null || $_FILES['AnimalImage4']['name'] == "null" || $_FILES['AnimalImage4']['name'] == " " || $_FILES['AnimalImage4']['name'] == "") {
   $AnimalImage4 = SECURE($_POST['AnimalImage4_CURRENT'], "d");
  } else {
   $AnimalImage4 = UPLOAD_FILES("../storage/animals/$AnimalId/img", "AnimalImage4", "$RegAnimalTitle" . "_img4" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalImage4");
  }

  if ($_FILES['AnimalVideo1']['name'] ==  null || $_FILES['AnimalVideo1']['name'] == "null" || $_FILES['AnimalVideo1']['name'] == " " || $_FILES['AnimalVideo1']['name'] == "") {
   $AnimalVideo = SECURE($_POST['AnimalVideo1_CURRENT'], "d");
  } else {
   $AnimalVideo = UPLOAD_FILES("../storage/animals/$AnimalId/video", "AnimalVideo1", "$RegAnimalTitle" . "_$RegAnimalCategory", "$RegAnimalBreed", "AnimalVideo1");
  }

  $UpdateVideo = UPDATE_TABLE("animalvideos", ["AnimalVideo"], "AnimalId='$AnimalId'");
  $UpdateImage = UPDATE_TABLE("animalimages", ["AnimalImage1", "AnimalImage2", "AnimalImage3", "AnimalImage4"], "AnimalId='$AnimalId'");

  RESPONSE($Update, "Animal $RegAnimalTitle is updated successfully!", "Unable to update animals");
 } else {
  RESPONSE($Update, "New Animal $RegAnimalTitle is registered successfully!", "Unable to update animals");
 }

 //delete animals
} elseif (isset($_GET['delete_animals'])) {
 $delete_animals = SECURE($_GET['delete_animals'], "d");
 $access_url = SECURE($_GET['access_url'], "d");

 if ($delete_animals == "true") {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("animals", "RegAnimalId='$control_id'");
  $delete = DELETE_FROM("animalimages", "AnimalId='$control_id'");
  $delete = DELETE_FROM("animalvideos", "AnimalId='$control_id'");
  RESPONSE($delete, "Animal is deleted successfully!", "Unable to delete animal");
 } else {
  RESPONSE(false, "", "Delete Request is not valid");
 }
} elseif (isset($_POST['UpdateAnimalsCategory'])) {
 $AnimalId = SECURE($_POST['UpdateAnimalsCategory'], "d");
 $AnimalName = $_POST['AnimalName'];
 $AnimalUpdatedAt = date("d M, Y");
 $AnimalStatus = $_POST['AnimalStatus'];

 if ($_FILES['AnimalImage']['name'] == null || $_FILES['AnimalImage']['name'] == "null" || $_FILES['AnimalImage']['name'] == " " || $_FILES['AnimalImage']['name'] == "") {
  $AnimalImage = SECURE($_POST['CurrentFile'], "d");
 } else {
  $AnimalImage = UPLOAD_FILES("../storage/animals/animal-name-img", "AnimalImage", "$AnimalName" . "_img", "", "AnimalImage");
 }

 $Update = UPDATE_TABLE("animalsname", ["AnimalName", "AnimalImage", "AnimalUpdatedAt", "AnimalStatus"], "AnimalId='$AnimalId'");
 RESPONSE($Update, "Animal $AnimalName is updated successfully!", "Unable to update animals");

 //delete animal category
} elseif (isset($_GET['delete_animal_category'])) {
 $delete_animal_category = SECURE($_GET['delete_animal_category'], "d");
 $access_url = SECURE($_GET['access_url'], "d");

 if ($delete_animal_category == "true") {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("animalsname", "AnimalId='$control_id'");
  RESPONSE($delete, "Animal Category is deleted successfully!", "Unable to delete animal category");
 } else {
  RESPONSE(false, "", "Delete Request is not valid");
 }

 //update animal breed
} elseif (isset($_POST['UpdateAnimalsBreeds'])) {
 $AnimalBreedId = SECURE($_POST['UpdateAnimalsBreeds'], "d");
 $AnimalId = $_POST['AnimalId'];
 $BreedName = $_POST['BreedName'];
 $BreedStatus = $_POST['BreedStatus'];
 $BreedUpdatedAt = date("d M, Y");

 $Update = UPDATE_TABLE("animalbreeds", ["BreedName", "AnimalId", "BreedUpdatedAt", "BreedStatus"], "AnimalBreedId='$AnimalBreedId'");
 RESPONSE($Update, "Animal Breed $BreedName is updated successfully!", "Unable to update animal breed");

 //delete breeds
} elseif (isset($_GET['delete_breeds'])) {
 $delete_breeds = SECURE($_GET['delete_breeds'], "d");
 $access_url = SECURE($_GET['access_url'], "d");

 if ($delete_breeds == "true") {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("animalbreeds", "AnimalBreedId='$control_id'");
  RESPONSE($delete, "Animal Breed is deleted successfully!", "Unable to delete animal breed");
 } else {
  RESPONSE(false, "", "Delete Request is not valid");
 }
 //unknown request is received
} else {
 LOCATION("warning", "Unknown request is received which is null in results", $access_url);
}
