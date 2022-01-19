<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Animal Details";
if (isset($_GET['viewid'])) {
  $viewid = $_GET['viewid'];
  $_SESSION['viewid'] = $viewid;
} else {
  $viewid = $_SESSION['viewid'];
}
$Req_RegAnimalId = SECURE($viewid, "d");
$PageSqls = "SELECT * FROM animals WHERE RegAnimalId = '$Req_RegAnimalId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo GET_DATA("RegAnimalTitle"); ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-heading"><?php echo $PageName; ?></h4>
                  <a href="<?php echo DOMAIN; ?>/controller/animalcontroller.php?delete_animals=<?php echo SECURE("true", 'e'); ?>&access_url=<?php echo SECURE(DOMAIN . '/admin/animals/index.php', 'e'); ?>&control_id=<?php echo SECURE($Req_RegAnimalId, 'e'); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <form class="data-form row" action="" method="GET">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-12">
                      <label>Animal Type</label>
                      <select name="AnimalId" onchange="form.submit()" class="form-control-2" required="">
                        <option value="0">Select Animal</option>
                        <?php

                        $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalsname where AnimalStatus='1' ORDER BY AnimalName ASC", "AnimalName");
                        if ($FetchAnimalCategories == null) {
                          InputOptions(["Please Insert Categories First"]);
                        } else {
                          foreach ($FetchAnimalCategories as $RegAnimalCategory) {
                            if ($RegAnimalCategory->AnimalId == GET_DATA('RegAnimalCategory')) {
                              if (isset($_GET['AnimalId'])) {
                                if ($RegAnimalCategory->AnimalId == $_GET['AnimalId']) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                }
                              } else {
                                $selected = "selected";
                              }
                            } else {
                              if (isset($_GET['AnimalId'])) {
                                if ($RegAnimalCategory->AnimalId == $_GET['AnimalId']) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                }
                              } else {
                                $selected = "";
                              }
                            } ?>
                            <option value="<?php echo $RegAnimalCategory->AnimalId; ?>" <?php echo $selected; ?>><?php echo $RegAnimalCategory->AnimalName; ?></option>
                        <?php }
                        } ?>
                      </select>
                    </div>
                  </form>
                  <form class="data-form row" action="<?php echo DOMAIN; ?>/controller/animalcontroller.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <?php if (isset($_GET['AnimalId'])) { ?>
                      <input type="text" hidden="" name="RegAnimalCategory" value="<?php echo $_GET['AnimalId']; ?>">
                    <?php } else { ?>
                      <input type="text" hidden="" name="RegAnimalCategory" value="<?php echo GET_DATA("RegAnimalCategory"); ?>">
                    <?php  } ?>
                    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                      <label>Animal Breeds</label>
                      <?php
                      if (isset($_GET['AnimalId'])) {
                        $AnimalId = $_GET['AnimalId'];
                        $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalbreeds where AnimalId='$AnimalId' and BreedStatus='1' ORDER BY BreedName ASC", "BreedName");
                      } else {
                        $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalbreeds where BreedStatus='1' ORDER BY BreedName ASC", "BreedName");
                      }
                      if ($FetchAnimalCategories == null) { ?>
                        <select name="RegAnimalBreed" class="form-control-2" required="">
                          <?php InputOptions(["Please Insert Breed First"]); ?>
                        </select>
                      <?php } else { ?>
                        <select name="RegAnimalBreed" class="form-control-2" required="">
                          <?php foreach ($FetchAnimalCategories as $RegAnimalCategory) {
                            if ($RegAnimalCategory->AnimalBreedId == GET_DATA("RegAnimalBreed")) {
                              $selected = "selected";
                            } else {
                              if (isset($_GET['AnimalId'])) {
                                if ($RegAnimalCategory->AnimalBreedId == $_GET['AnimalId']) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                }
                              } else {
                                $selected = "";
                              }
                            } ?>
                            <option value="<?php echo $RegAnimalCategory->AnimalBreedId; ?>" <?php echo $selected; ?>><?php echo $RegAnimalCategory->BreedName; ?></option>
                          <?php } ?>
                        </select>
                      <?php } ?>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                      <label>Enter Animal Name/Title</label>
                      <input type="text" name="RegAnimalTitle" value="<?php echo GET_DATA("RegAnimalTitle"); ?>" class="form-control-2" required="" />
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                      <label>Registration Type</label>
                      <select name="RegAnimalRegType" onmouseover="PriceStatus()" onmouseout="PriceStatus()" id="RegType" class="form-control-2" required="">
                        <option value="<?php echo GET_DATA("RegAnimalRegType"); ?>" selected=""><?php echo GET_DATA("RegAnimalRegType"); ?></option>
                        <?php InputOptions(["Sell", "Adoptions"]) ?>
                      </select>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                      <label>Registration Purpose</label>
                      <select name="RegAnimalPurpose" onmouseover="MilkStatus()" onmouseout="MilkStatus()" id="MilkType" class="form-control-2" required="">
                        <option value="<?php echo GET_DATA("RegAnimalPurpose"); ?>" selected=""><?php echo GET_DATA("RegAnimalPurpose"); ?></option>
                        <?php InputOptions(["Milking", "Non Milking"]) ?>
                      </select>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                      <label>Animal Age (in Months)</label>
                      <input type="text" name="RegAnimalAge" value="<?php echo GET_DATA('RegAnimalAge'); ?>" placeholder="12 Months" class="form-control-2" required="" />
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                      <label>Animal Teeth</label>
                      <input type="text" name="RegAnimalTeeth" value="<?php echo GET_DATA('RegAnimalTeeth'); ?>" class="form-control-2" required="" />
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                      <label>Animal Calving</label>
                      <input type="text" name="RegAnimalCalving" value='<?php echo GET_DATA('RegAnimalCalving'); ?>' class="form-control-2" required="" />
                    </div>
                    <div id="milktab">
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Milk Per Days</label>
                        <input type="text" name="RegAnimalMilkQty" value="<?php echo GET_DATA('RegAnimalMilkQty'); ?>" placeholder="1 Litre" class="form-control-2" required="" />
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Maximum Milk</label>
                        <input type="text" name="RegAnimalMaxMilk" value="<?php echo GET_DATA('RegAnimalMaxMilk'); ?>" placeholder="10 Litre" class="form-control-2" required="" />
                      </div>
                    </div>
                    <div id="pricetab">
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Price Type</label>
                        <select name="RegAnimalPriceType" class="form-control-2" required="">
                          <option value="<?php echo GET_DATA('RegAnimalPriceType'); ?>" selected=''><?php echo GET_DATA('RegAnimalPriceType'); ?></option>
                          <?php InputOptions(["Fixed", "Negotiable"]); ?>
                        </select>
                      </div>
                      <div class="form-group col-lg-4 col-md-4 col-ms-4 col-12">
                        <label>Price</label>
                        <input type="text" name="RegAnimalPrice" value="<?php echo GET_DATA('RegAnimalPrice'); ?>" class="form-control-2" required="" />
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                      <label>Animal Listing Status</label>
                      <select class="form-control-2" name="RegAnimalStatus" required="">
                        <?php
                        if (GET_DATA("RegAnimalStatus") == 1) { ?>
                          <option value="1" selected="">Active</option>
                          <option value="2">Inactive</option>
                        <?php } else { ?>
                          <option value="1">Active</option>
                          <option value="2" selected="">Inactive</option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
                      <label>Animal Descriptions</label>
                      <textarea type="text" style="height:auto !important;" id="editor" name="RegAnimalDetails" rows="5" class="form-control-2"><?php echo html_entity_decode(SECURE(GET_DATA('RegAnimalDetails'), 'd')); ?></textarea>
                    </div>
                    <div class="col-md-12">
                      <h4 class="app-heading m-t-10">Select Images</h4>
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
                      <label for="AnimalImg1">1st Image</label>
                      <input type="FILE" name="AnimalImage1" id="U_img1" value="null" accept="image/*">
                      <input type="text" hidden="" name="AnimalImage1_CURRENT" value="<?php echo SECURE(FETCH("SELECT * FROM animalimages where AnimalId='$Req_RegAnimalId'", "AnimalImage1"), 'e'); ?>" accept="image/*">
                      <img src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Req_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Req_RegAnimalId'", "AnimalImage1"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>" id="img1" class="imgrpreview">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
                      <label for="AnimalImg2">2nd Image</label>
                      <input type="FILE" name="AnimalImage2" id="U_img2" value="null" accept="image/*">
                      <input type="text" hidden="" name="AnimalImage2_CURRENT" value="<?php echo SECURE(FETCH("SELECT * FROM animalimages where AnimalId='$Req_RegAnimalId'", "AnimalImage2"), 'e'); ?>" accept="image/*">
                      <img src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Req_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Req_RegAnimalId'", "AnimalImage2"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>" id="img2" class="imgrpreview">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
                      <label for="AnimalImg3">3rd Image</label>
                      <input type="FILE" name="AnimalImage3" id="U_img3" value="null" accept="image/*">
                      <input type="text" hidden="" name="AnimalImage3_CURRENT" value="<?php echo SECURE(FETCH("SELECT * FROM animalimages where AnimalId='$Req_RegAnimalId'", "AnimalImage3"), 'e'); ?>" accept="image/*">
                      <img src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Req_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Req_RegAnimalId'", "AnimalImage3"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>" id="img3" class="imgrpreview">
                    </div>

                    <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
                      <label for="AnimalImg4">4rth Image</label>
                      <input type="FILE" name="AnimalImage4" id="U_img4" value="null" accept="image/*">
                      <input type="text" hidden="" name="AnimalImage4_CURRENT" value="<?php echo SECURE(FETCH("SELECT * FROM animalimages where AnimalId='$Req_RegAnimalId'", "AnimalImage4"), 'e'); ?>" accept="image/*">
                      <img src="<?php echo DOMAIN; ?>/storage/animals/<?php echo $Req_RegAnimalId; ?>/img/<?php echo FETCH("SELECT * FROM animalimages where AnimalId='$Req_RegAnimalId'", "AnimalImage4"); ?>" title="<?php echo GET_DATA("RegAnimalTitle"); ?>" alt="<?php echo GET_DATA("RegAnimalTitle"); ?>" id="img4" class="imgrpreview">
                    </div>

                    <div class="col-md-12">
                      <h4 class="app-heading">Upload One Video</h4>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-ms-4 col-6">
                      <input type="FILE" name="AnimalVideo1" value="null" id="AnimalImg4" accept="video/mp4, video/x-m4v, video/*">
                      <input type="text" hidden="" name="AnimalVideo1_CURRENT" value="<?php echo SECURE(FETCH("SELECT * FROM animalvideos where AnimalId='$Req_RegAnimalId'", "AnimalVideo"), 'e'); ?>" accept="video/mp4,video/x-m4v,video/*">
                      <div class="video-section">
                        <video controls class="video-frame">
                          <source src=" <?php echo DOMAIN; ?>/storage/animals/<?php echo $Req_RegAnimalId; ?>/video/<?php echo FETCH("SELECT * FROM animalvideos where AnimalId='$Req_RegAnimalId'", "AnimalVideo"); ?>">
                        </video>
                      </div>
                    </div>
                    <div class="col-md-12 m-t-20">
                      <button type="Submit" value="<?php echo SECURE($Req_RegAnimalId, "e"); ?>" name="UpdateRegAnimals" class="btn app-btn">Update Animal Details</button>
                      <a href="index.php" class="btn btn-danger">Back to All</a>
                    </div>
                  </form>

                  <script>
                    function PriceStatus() {
                      var RegType = document.getElementById("RegType");
                      if (RegType.value === "Sell") {
                        document.getElementById("pricetab").style.display = "block";
                      } else {
                        document.getElementById("pricetab").style.display = "none";
                      }
                    }

                    function MilkStatus() {
                      var MilkType = document.getElementById("MilkType");
                      if (MilkType.value === "Milking") {
                        document.getElementById("milktab").style.display = "block";
                      } else {
                        document.getElementById("milktab").style.display = "none";
                      }
                    }
                  </script>
                </div>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../include/admin/footer.php'; ?>
    </div>

    <script>
      U_img1.onchange = evt => {
        const [file] = U_img1.files
        if (file) {
          img1.src = URL.createObjectURL(file);
        }
      }
    </script>

    <script>
      U_img2.onchange = evt => {
        const [file] = U_img2.files
        if (file) {
          img2.src = URL.createObjectURL(file);
        }
      }
    </script>

    <script>
      U_img3.onchange = evt => {
        const [file] = U_img3.files
        if (file) {
          img3.src = URL.createObjectURL(file);
        }
      }
    </script>

    <script>
      U_img4.onchange = evt => {
        const [file] = U_img4.files
        if (file) {
          img4.src = URL.createObjectURL(file);
        }
      }
    </script>
    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>