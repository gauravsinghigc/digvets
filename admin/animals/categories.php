<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Animal Names & Types";
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
                    <h4 class="m-b-0 m-t-5"><?php echo $PageName; ?></h4>
                    <a href="#" onclick="Databar('Addcategories')" class="btn btn-sm btn-default">Add Animal Categories</a>
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
                        <th>SNo</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>CreatedAt</th>
                        <th>UpdatedAt</th>
                        <th>Status</th>
                        <th>Animals</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    $FetchAll = FetchConvertIntoArray("SELECT * FROM animalsname",  true);
                    if ($FetchAll == null) {
                      NoData("No Animals Name found!");
                    } else {
                      $Count = 0;
                      foreach ($FetchAll as $key => $fetcheddata) {
                        $Count++;
                        $CountAnimals = TOTAL("SELECT * FROM animals where RegAnimalCategory='" . $fetcheddata->AnimalId . "'"); ?>
                        <tr>
                          <td><?php echo $Count; ?></td>
                          <td>
                            <img src="<?php echo STORAGE_URL; ?>/animals/animal-name-img/<?php echo $fetcheddata->AnimalImage; ?>" class="pro-img">
                          </td>
                          <td>
                            <p class="lh-1-2 m-b-1 text-primary">
                              <span class="fs-15 bold"> <?php echo $fetcheddata->AnimalName; ?></span><br>
                            </p>
                          </td>
                          <td><?php echo $fetcheddata->AnimalCreatedAt; ?></td>
                          <td><?php echo ReturnValue($fetcheddata->AnimalUpdatedAt); ?></td>
                          <td><?php echo StatusViewWithText($fetcheddata->AnimalStatus); ?></td>
                          <td><?php echo $CountAnimals; ?> Animals</td>
                          <td>
                            <a href="#" onclick="Databar('edit_<?php echo $fetcheddata->AnimalId; ?>')" class="btn btn-sm btn-primary">Edit Details</a>
                            <?php if ($CountAnimals == 0) { ?>
                              <a href="<?php echo DOMAIN; ?>/controller/animalcontroller.php?delete_animal_category=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, 'e'); ?>&control_id=<?php echo SECURE($fetcheddata->AnimalId, 'e'); ?>" class="btn btn-sm btn-danger">Delete</a>
                            <?php } ?>
                          </td>
                        </tr>

                        <section class="add-section" id="edit_<?php echo $fetcheddata->AnimalId; ?>">
                          <div class="add-data-form">
                            <form class="data-form" action="../../controller/animalcontroller.php" method="POST" enctype="multipart/form-data">
                              <?php
                              FormPrimaryInputs(true);
                              CurrentFile($fetcheddata->AnimalImage); ?>
                              <div class="main-data">
                                <div class="main-data-header app-bg">
                                  <div class="flex-s-b app-heading">
                                    <h4 class="mt-0 mb-0">Update Details</h4>
                                    <a class="btn btn-sm btn-danger sqaure" onclick="Databar('edit_<?php echo $fetcheddata->AnimalId; ?>')"><i class="fa fa-times fs-17"></i></a>
                                  </div>
                                </div>
                                <div class="main-data-body p-2">
                                  <div class="row">
                                    <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                      <label>Update Name</label>
                                      <input type="text" name="AnimalName" value="<?php echo $fetcheddata->AnimalName; ?>" class="form-control-2" required="" />
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                                      <label>Category Status</label>
                                      <select class="form-control-2" name="AnimalStatus" required="">
                                        <?php
                                        if ($fetcheddata->AnimalStatus == 1) { ?>
                                          <option value="1" selected="">Active</option>
                                          <option value="2">Inactive</option>
                                        <?php } else { ?>
                                          <option value="1">Active</option>
                                          <option value="2" selected="">Inactive</option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                                      <label>Upload Image</label>
                                      <input type="FILE" name="AnimalImage" value="null" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
                                    </div>
                                    <div class="col-md-12 col-lg-12 text-center m-t-10">
                                      <img src="<?php echo STORAGE_URL; ?>/animals/animal-name-img/<?php echo $fetcheddata->AnimalImage; ?>" class="w-30 br10">
                                    </div>
                                  </div>
                                  <br><br><br><br><br><br>
                                </div>
                                <div class="main-data-footer">
                                  <button type="Submit" name="UpdateAnimalsCategory" value="<?php echo SECURE($fetcheddata->AnimalId, "e"); ?>" class="btn btn-md app-btn">Update Details</button>
                                  <a onclick="Databar('edit_<?php echo $fetcheddata->AnimalId; ?>')" class="btn btn-md btn-danger">Cancel</a>
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
                <h4 class="mt-0 mb-0">Add New Animal Name</h4>
                <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addcategories')"><i class="fa fa-times fs-17"></i></a>
              </div>
            </div>
            <div class="main-data-body p-2">
              <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                  <label>Enter New Animal Name</label>
                  <input type="text" name="AnimalName" class="form-control-2" required="" />
                </div>
                <?php UploadImageInput("AnimalImage", "animalImage", "image/png, image/gif, image/jpeg", true, "col-lg-6 col-md-6 col-sm-6 col-12"); ?>
              </div>
              <br><br><br><br><br><br>
            </div>
            <div class="main-data-footer">
              <button type="Submit" onclick="form.submit()" value="null" name="CreateAnimals" class="btn btn-md app-btn">Create Animals</button>
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