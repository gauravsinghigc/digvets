<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Registered Animals";
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
                    <a href="add.php" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> Animals</a>
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
                        <th>AnimalName</th>
                        <th>Type</th>
                        <th>Purpose</th>
                        <th class="text-center">Price</th>
                        <th>Reg Date</th>
                        <th>UpdateAt</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <?php
                    $fetchAnimals = FetchConvertIntoArray("SELECT * FROM animals ORDER BY RegAnimalId ASC", true);
                    if ($fetchAnimals != null) {
                      $count = 0;
                      foreach ($fetchAnimals as $data) {
                        $count++;
                        $AnimalImage1 = FETCH("SELECT * from animalimages where AnimalId='" . $data->RegAnimalId . "'", "AnimalImage1");
                        $AnimalName = FETCH("SELECT * FROM animalsname where AnimalId='" . $data->RegAnimalCategory . "'", "AnimalName");
                        $BreedName = FETCH("SELECT * FROM animalbreeds where AnimalBreedId='" . $data->RegAnimalBreed . "'", "BreedName");
                    ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td>
                            <img src="<?php echo STORAGE_URL; ?>/animals/<?php echo $data->RegAnimalId; ?>/img/<?php echo $AnimalImage1; ?>" class="w-100 pro-img">
                          </td>
                          <td class="lh-1-0">
                            <a href="<?php echo DOMAIN; ?>/admin/animals/edit-animal.php?viewid=<?php echo SECURE($data->RegAnimalId, 'e'); ?>"> <span class="text-primary"><?php echo $data->RegAnimalTitle; ?></span> <br>
                              <span class="text-grey fs-12">
                                <i class="fa fa-hashtag"></i> <?php echo $data->RegAnimalTitle; ?> |
                                <?php echo $AnimalName; ?> |
                                <?php echo $BreedName; ?> |
                                <b>Calving: </b><?php echo $data->RegAnimalCalving; ?>
                              </span>
                            </a>
                          </td>
                          <td>
                            <?php echo $data->RegAnimalRegType; ?>
                          </td>
                          <td>
                            <?php echo $data->RegAnimalPurpose; ?>
                          </td>
                          <td>
                            <?php if ($data->RegAnimalRegType == "Sell") { ?>
                              <span class="fs-12 flex-s-b">
                                <span class="w-50 text-right"><span class='btn btn-success btn-sm rounded'>Rs.<?php echo $data->RegAnimalPrice; ?></span></span>
                              </span>
                            <?php } else { ?>
                              <span class="btn-warning btn-sm btn br20"><?php echo $data->RegAnimalRegType; ?></span>
                            <?php } ?>
                          </td>
                          <td>
                            <?php echo $data->RegAnimalCreatedAt; ?>
                          </td>
                          <td>
                            <?php echo ReturnValue($data->RegAnimalUpdatedAt); ?>
                          </td>
                          <td>
                            <?php echo StatusViewWithText($data->RegAnimalStatus); ?>
                          </td>
                          <td>
                            <a href="<?php echo DOMAIN; ?>/admin/animals/edit-animal.php?viewid=<?php echo SECURE($data->RegAnimalId, 'e'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                          </td>
                        </tr>

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


    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>