<?php
//include required files here
require '../../require/modules.php';
require '../../require/web-modules.php';

//page varibale
$PageName  = APP_NAME . " Store";
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
            $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId ORDER BY products.ProductId ASC limit 0, 12");
            while ($fetchpro_brands = mysqli_fetch_array($SQLproducts)) {
              $ProductId = $fetchpro_brands['ProductId'];
              $ProductName = $fetchpro_brands['ProductName'];
              $ProBrandName = $fetchpro_brands['ProBrandName'];
              $ProCategoryName = $fetchpro_brands['ProCategoryName'];
              $ProSubCategoryName = $fetchpro_brands['ProSubCategoryName'];
              $ProductRefernceCode = $fetchpro_brands['ProductRefernceCode'];
              $ProductImage = $fetchpro_brands['ProductImage'];
              $ProductCategoryId = $fetchpro_brands['ProductCategoryId'];
              $ProductSubCategoryId = $fetchpro_brands['ProductSubCategoryId'];
              $ProductBrandId = $fetchpro_brands['ProductBrandId'];
              $ProductSellPrice = $fetchpro_brands['ProductSellPrice'];
              $ProductMrpPrice = $fetchpro_brands['ProductMrpPrice'];
              $ProductDescriptions = SECURE($fetchpro_brands['ProductDescriptions'], "e");
              $ProductWeight = $fetchpro_brands['ProductWeight'];
              $ProductStatus = StatusView($fetchpro_brands['ProductStatus']);
              $ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
              $ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
              $ProductCreatedBy = $fetchpro_brands['ProductCreatedBy']; ?>
              <div class="col-md-4 col-lg-4 col-sm-4 col-6 m-b-10">
                <a href="<?php echo DOMAIN; ?>/web/store/details/?view=<?php echo SECURE($ProductId, "e"); ?>">
                  <div class="cat-box">
                    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" alt="<?php echo $ProductName; ?>" title="<?php echo $ProductName; ?>" class="w-100">
                    <h5 class="text-center lg-1-10"><b><?php echo $ProductName; ?></b></h4>
                      <p class="lh-1-8">
                        <span class="flex-space-evenly text-grey">
                          <span><i class="fa fa-paw text-danger"></i> <?php echo $ProSubCategoryName; ?></span>
                          <span><i class="fa fa-shopping-basket text-info"></i> <?php echo $ProductWeight; ?></span>
                        </span>
                        <span class="flex-space-between">
                          <span class="text-grey"><?php echo $ProBrandName; ?></span>
                          <span class="text-success app-price"><b>Rs.<?php echo $ProductSellPrice; ?></b></span>
                        </span>
                      </p>
                      <a href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?id=<?php echo SECURE($ProductId, "e"); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="cart-button">Add to Cart <i class="fa fa-shopping-cart"></i></a>
                  </div>
                </a>
              </div>
            <?php } ?>
            <div class="col-md-12 flex-space-evenly">
              <?php if (!isset($_GET['page'])) {
                $disabled = "disabled";
              } else {
                $disabled = "";
              } ?>
              <a href="<?php echo DOMAIN; ?>/web/store/?page=2" class="<?php echo $disabled; ?>" disabled="">
                <h4 class="text-center text-color"><i class="fa fa-angle-double-left"></i> Previous Page</h4>
              </a>
              <a href="<?php echo DOMAIN; ?>/web/store/?page=2">
                <h4 class="text-center text-color">Next Page <i class="fa fa-angle-double-right"></i></h4>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include '../../include/web/footer.php'; ?>
    <?php include '../../include/web/footer_files.php'; ?>
  </body>

</html>