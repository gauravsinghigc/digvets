<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = "AI Workers";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/web/header_files.php'; ?>
</head>

<body>

  <body>

    <?php
    //header & loader
    include '../../include/web/loader.php';
    include '../../include/web/header.php';
    include '../../include/web/navbar.php'; ?>

    <section class="container-fluid section">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-12 m-t-7">
          <div class="section-div p-l-5 p-r-10">
            <h4 class="m-b-3"><b>Filter Listing as per Requirements</b></h4>
            <hr class="m-b-8 w-pr-99">
            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Registration Type</b></h5>
              <div class="filter-field">
                <input type="radio" name="RegAnimalRegType" value="Sell"> <span>Sell</span>
              </div>
              <div class="filter-field">
                <input type="radio" name="RegAnimalRegType" value="Adoptions"> Adoptions
              </div>
            </form>

            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Registration Purpose</b></h5>
              <div class="filter-field">
                <input type="radio" name="RegAnimalRegType" value="Sell"> Milking
              </div>
              <div class="filter-field">
                <input type="radio" name="RegAnimalRegType" value="Adoptions"> Non Milking
              </div>
            </form>

            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Animal Age</b></h5>
              <?php
              $QueryAge = SELECT("SELECT * FROM animals GROUP BY RegAnimalAge ASC");
              while ($fetchage = mysqli_fetch_array($QueryAge)) { ?>
                <div class="filter-field">
                  <input type="radio" name="AnimalAge" value="<?php echo $fetchage['RegAnimalAge']; ?>"> <?php echo $fetchage['RegAnimalAge']; ?>
                </div>
              <?php } ?>
            </form>

            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Animal Teeth</b></h5>
              <?php
              $QueryAge = SELECT("SELECT * FROM animals GROUP BY RegAnimalTeeth ASC");
              while ($fetchage = mysqli_fetch_array($QueryAge)) { ?>
                <div class="filter-field">
                  <input type="radio" name="AnimalAge" value="<?php echo $fetchage['RegAnimalTeeth']; ?>"> <?php echo $fetchage['RegAnimalTeeth']; ?>
                </div>
              <?php } ?>
            </form>

            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Milk Per Day <span class="text-grey"> in Liter</span></b></h5>
              <?php
              $QueryAge = SELECT("SELECT * FROM animals GROUP BY RegAnimalMilkQty ASC");
              while ($fetchage = mysqli_fetch_array($QueryAge)) { ?>
                <div class="filter-field">
                  <input type="radio" name="AnimalAge" value="<?php echo $fetchage['RegAnimalMilkQty']; ?>"> <?php echo $fetchage['RegAnimalMilkQty']; ?>
                </div>
              <?php } ?>
            </form>

            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Maximum Milk Capacity <span class="text-grey"> in Liter</span></b></h5>
              <?php
              $QueryAge = SELECT("SELECT * FROM animals GROUP BY RegAnimalMaxMilk ASC");
              while ($fetchage = mysqli_fetch_array($QueryAge)) { ?>
                <div class="filter-field">
                  <input type="radio" name="AnimalAge" value="<?php echo $fetchage['RegAnimalMaxMilk']; ?>"> <?php echo $fetchage['RegAnimalMaxMilk']; ?>
                </div>
              <?php } ?>
            </form>

            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Price Type</b></h5>
              <?php
              $QueryAge = SELECT("SELECT * FROM animals GROUP BY RegAnimalPriceType ASC");
              while ($fetchage = mysqli_fetch_array($QueryAge)) { ?>
                <div class="filter-field">
                  <input type="radio" name="AnimalAge" value="<?php echo $fetchage['RegAnimalPriceType']; ?>"> <?php echo $fetchage['RegAnimalPriceType']; ?>
                </div>
              <?php } ?>
            </form>
            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Available Prices</b></h5>
              <?php
              $QueryAge = SELECT("SELECT * FROM animals GROUP BY RegAnimalPrice ASC");
              while ($fetchage = mysqli_fetch_array($QueryAge)) { ?>
                <div class="filter-field">
                  <input type="radio" name="AnimalAge" value="<?php echo $fetchage['RegAnimalPrice']; ?>"> Rs.<?php echo $fetchage['RegAnimalPrice']; ?>
                </div>
              <?php } ?>
            </form>
            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Price Range</b></h5>
              <div class="filter-field p-pr-1 flex-space-between w-100">
                <input type="number" placeholder="Min" class="w-50 m-r-10 form-control" name="AnimalAge" min="500" value="500">
                <input type="number" placeholder="Max" class="w-50 m-l-10 form-control" name="AnimalAge" min="1000" value="1000">
              </div>
            </form>

            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Animal Categories</b></h5>
              <select class="form-control fs-16" name="">
                <option value="0">Select Animal</option>
                <?php
                $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalsname where AnimalStatus='1' ORDER BY AnimalName ASC", "AnimalName");
                if ($FetchAnimalCategories == null) {
                  InputOptions(["Please Insert Categories First"]);
                } else {
                  foreach ($FetchAnimalCategories as $RegAnimalCategory) { ?>
                    <option value="<?php echo $RegAnimalCategory->AnimalId; ?>"><?php echo $RegAnimalCategory->AnimalName; ?></option>
                <?php }
                } ?>
              </select>
            </form>

            <form action="" method="GET">
              <h5 class="m-b-0 text-color"><b>Animal Breed</b></h5>
              <?php
              if (isset($_GET['AnimalId'])) {
                $AnimalId = $_GET['AnimalId'];
                $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalbreeds where AnimalId='$AnimalId' and BreedStatus='1' ORDER BY BreedName ASC", "BreedName");
              } else {
                $FetchAnimalCategories = FetchConvertIntoArray("SELECT * FROM animalbreeds where BreedStatus='1' ORDER BY BreedName ASC", "BreedName");
              }
              if ($FetchAnimalCategories == null) { ?>
                <select name="RegAnimalBreed" class="form-control fs-16" required="">
                  <?php InputOptions(["Please Insert Breed First"]); ?>
                </select>
              <?php } else { ?>
                <select name="RegAnimalBreed" class="form-control fs-16" required="">
                  <?php foreach ($FetchAnimalCategories as $RegAnimalCategory) { ?>
                    <option value="<?php echo $RegAnimalCategory->AnimalBreedId; ?>"><?php echo $RegAnimalCategory->BreedName; ?></option>
                  <?php } ?>
                </select>
              <?php } ?>
            </form>
          </div>
        </div>

        <div class="col-lg-9 col-md-9 col-sm-8 col-12 m-t-7">
          <div class="row">
            <div class="col-md-12">
              <div class="flex-space-between">
                <div>
                  <h3 class="text-color m-t-5 m-b-0"><b><?php echo $PageName; ?></b></h3>
                </div>
                <div>
                  <div class="flex-space-between">
                    <label class="p-1r sort-by">Sort By</label>
                    <form action="" method="GET" class="flex-space-between">
                      <select class="form-control m-r-5 w-px-200" name="sortby">
                        <option value="animals.RegAnimalTitle">Registered name</option>
                        <option value="animals.RegAnimalRegType">Registered Type</option>
                        <option value="animals.RegAnimalCategory">Animal Category</option>
                        <option value="animals.RegAnimalBreed">Animal Breeds</option>
                        <option value="animals.RegAnimalAge">Animal Age</option>
                        <option value="animals.RegAnimalTeeth">Animal Teeth</option>
                        <option value="animals.RegAnimalMilkQty">Per Day Milk</option>
                        <option value="animals.RegAnimalMaxMilk">Maximum Milk</option>
                        <option value="animals.RegAnimalPrice">Price</option>
                      </select>
                      <select class="form-control m-l-5" name="orderby">
                        <option value="ASC">Sort By</option>
                        <option value="ASC">ASC</option>
                        <option value="ASC">DESC</option>
                      </select>
                    </form>
                  </div>
                </div>
              </div>
              <hr class="m-t-10">
            </div>
            <?php
            $fetchaiworkers = FetchConvertIntoArray("SELECT * FROM aiworkers ORDER BY Aiworkersid ASC", true);
            if ($fetchaiworkers != null) {
              foreach ($fetchaiworkers as $data) {
            ?>
                <div class="col-md-4 col-lg-4 col-sm-4 col-6">
                  <a href="<?php echo DOMAIN; ?>/web/ai-workers/details/?view=<?php echo SECURE($data->Aiworkersid, "e"); ?>">
                    <div class="cat-box">
                      <img src="<?php echo STORAGE_URL; ?>/workers/images/profile/<?php echo $data->AIWorkerProfile; ?>" title="<?php echo $data->AIWorkerName; ?>" alt="<?php echo $data->AIWorkerName; ?>" class="w-100">
                      <h4 class="m-t-0 m-b-3 text-center">
                        <span>
                          <b><?php echo StatusView($data->AIWorkerStatus); ?> <?php echo $data->AIWorkerName; ?></b>
                        </span>
                      </h4>

                      <table class="table table-striped m-t-10 table-details m-b-5">
                        <tr>
                          <th>Specilisation</th>
                          <td><?php echo SECURE($data->AIWorkerSpecilization, "d"); ?></td>
                        </tr>
                        <tr>
                          <th>Expertise</th>
                          <td><?php echo SECURE($data->AIWorkerExpertiseIn, "d"); ?></td>
                        </tr>
                        <tr>
                          <th>Qualifications</th>
                          <td><?php echo $data->AIWorkerQualification; ?></td>
                        </tr>
                        <tr>
                          <th>Experience</th>
                          <td><?php echo $data->AIWorkerExperience; ?></td>
                        </tr>
                        <tr>
                          <th>Fee</th>
                          <td><span class="app-price text-color"><i class="fa fa-phone"></i> Rs.<?php echo $data->AIWorkerConsultaningFee; ?></span>
                          </td>
                        </tr>
                      </table>
                      <a href="<?php echo DOMAIN; ?>/web/ai-workers/details/?view=<?php echo SECURE($data->Aiworkersid, "e"); ?>" class="cart-button"><i class="fa fa-info-circle"></i> GET CONTACT INFO</a>
                    </div>
                  </a>
                </div>
            <?php }
            } ?>
          </div>
        </div>
      </div>
    </section>
    <?php include 'common.php'; ?>
    <?php include '../../include/web/footer.php'; ?>
    <?php include '../../include/web/footer_files.php'; ?>
  </body>

</html>