<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Animal Breeds";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
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
                  <div class="flex-s-b app-heading">
                    <h4 class="m-b-0 m-t-5">All Animal Breeds</h4>
                    <a href="#" onclick="Databar('Addcategories')" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Animal Breeds</a>
                  </div>
                </div>
                <div class="col-md-12">
                  <?php include 'common.php'; ?>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Sno</th>
                        <th>AnimalName</th>
                        <th>BreedName</th>
                        <th>CreatedAt</th>
                        <th>UpdatedAt</th>
                        <th>Status</th>
                        <th>Animals</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    $FetchAll = FetchConvertIntoArray("SELECT * FROM animalsname, animalbreeds where animalbreeds.AnimalId=animalsname.AnimalId ORDER BY animalsname.AnimalName ASC", true);
                    if ($FetchAll == 0) {
                      echo "<tr>
                      <td colspan='6' align='center'>No Data Found!</td>
                      </tr>";
                    } else {
                      $count = 0;
                      foreach ($FetchAll as $key => $Data) {
                        $count++;

                        $TotalAnimals = TOTAL("SELECT * FROM animals where RegAnimalBreed='" . $Data->AnimalBreedId . "'"); ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td>
                            <img src="<?php echo STORAGE_URL; ?>/animals/animal-name-img/<?php echo $Data->AnimalImage; ?>" class="w-10 list-icon">
                            <?php echo $Data->AnimalName; ?>
                          </td>
                          <td><?php echo $Data->BreedName; ?></td>
                          <td><?php echo $Data->BreedCreatedAt; ?></td>
                          <td><?php echo ReturnValue($Data->BreedUpdatedAt); ?></td>
                          <td><?php echo StatusViewWithText($Data->BreedStatus); ?></td>
                          <td><?php echo $TotalAnimals; ?> Animals</td>
                          <td>
                            <a href="#" onclick="Databar('edit_<?php echo $Data->AnimalBreedId; ?>')" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <?php if ($TotalAnimals == 0) { ?>
                              <a href="<?php echo DOMAIN; ?>/controller/animalcontroller.php?delete_breeds=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, 'e'); ?>&control_id=<?php echo SECURE($Data->AnimalBreedId, 'e'); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                          </td>
                        </tr>

                        <section class="add-section" id="edit_<?php echo $Data->AnimalBreedId; ?>">
                          <div class="add-data-form">
                            <form class="data-form" action="../../controller/animalcontroller.php" method="POST" enctype="multipart/form-data">
                              <?php FormPrimaryInputs(true); ?>
                              <div class="main-data">
                                <div class="main-data-header app-bg">
                                  <div class="flex-s-b app-heading">
                                    <h4 class="mt-0 mb-0">Add New Animal Breeds</h4>
                                    <a class="btn btn-sm btn-danger sqaure" onclick="Databar('edit_<?php echo $Data->AnimalBreedId; ?>')"><i class="fa fa-times fs-17"></i></a>
                                  </div>
                                </div>
                                <div class="main-data-body p-2">
                                  <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                                      <label>Select Animal</label>
                                      <select name="AnimalId" class="form-control-2" required="">
                                        <?php
                                        $FetchAll = FetchConvertIntoArray("SELECT * FROM animalsname ORDER BY AnimalName ASC",  true);
                                        if ($FetchAll == null) {
                                          echo "No Data Found!";
                                        } else {
                                          foreach ($FetchAll as $key => $fetcheddata) {
                                            if ($fetcheddata->AnimalId == $Data->AnimalId) {
                                              $selected = "selected";
                                            } else {
                                              $selected = "";
                                            }  ?>
                                            <option value="<?php echo $fetcheddata->AnimalId; ?>" <?php echo $selected; ?>><?php echo $fetcheddata->AnimalName; ?></option>
                                        <?php }
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                                      <label>Breed Status</label>
                                      <select class="form-control-2" name="BreedStatus" required="">
                                        <?php
                                        if ($Data->BreedStatus == 1) { ?>
                                          <option value="1" selected="">Active</option>
                                          <option value="2">Inactive</option>
                                        <?php } else { ?>
                                          <option value="1">Active</option>
                                          <option value="2" selected="">Inactive</option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                                      <label>Breed Name</label>
                                      <input type="text" name="BreedName" value="<?php echo $Data->BreedName; ?>" class="form-control-2" required="">
                                    </div>
                                  </div>
                                  <br><br><br><br><br><br>
                                </div>
                                <div class="main-data-footer">
                                  <button type="Submit" name="UpdateAnimalsBreeds" value="<?php echo SECURE($Data->AnimalBreedId, "e"); ?>" class="btn btn-md app-btn">Update Animals Breeds</button>
                                  <a onclick="Databar('edit_<?php echo $Data->AnimalBreedId; ?>')" class="btn btn-md btn-danger">Cancel</a>
                                </div>

                              </div>
                            </form>
                          </div>
                        </section>
                    <?php }
                    } ?>
                  </table>
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

    <!-- add section -->
    <section class="add-section" id="Addcategories">
      <div class="add-data-form">
        <form class="data-form" action="../../controller/animalcontroller.php" method="POST" enctype="multipart/form-data">
          <?php FormPrimaryInputs(true); ?>
          <div class="main-data">
            <div class="main-data-header app-bg">
              <div class="flex-s-b app-heading">
                <h4 class="mt-0 mb-0">Add New Animal Breeds</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addcategories')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                  <label>Select Animal</label>
                  <select name="AnimalId" class="form-control-2" required="">
                    <?php
                    $FetchAll = FetchConvertIntoArray("SELECT * FROM animalsname ORDER BY AnimalName ASC",  true);
                    if ($FetchAll == null) {
                      echo "No Data Found!";
                    } else {
                      foreach ($FetchAll as $key => $fetcheddata) {  ?>
                        <option value="<?php echo $fetcheddata->AnimalId; ?>"><?php echo $fetcheddata->AnimalName; ?></option>
                    <?php }
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                  <label>Breed Name</label>
                  <input type="text" name="BreedName" class="form-control-2" required="">
                </div>
              </div>
              <br><br><br><br><br><br>
            </div>
            <div class="main-data-footer">
              <button type="Submit" value="null" name="CreateAnimalsBreeds" class="btn btn-md app-btn">Create Animals Breeds</button>
              <a onclick="Databar('Addcategories')" class="btn btn-md btn-danger">Cancel</a>
            </div>

          </div>
        </form>
      </div>
    </section>
    <!-- end of add section -->

    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>