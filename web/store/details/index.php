<?php

//page varibale
$PageName  = "Store";
$AccessLevel = "../../../";
$DirName = "web/store/";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//request variables
if (isset($_GET['view'])) {
  $ViewItemsId = $_GET['view'];
  $_SESSION['ViewItemsId'] = $ViewItemsId;
} else {
  $ViewItemsId = $_SESSION['ViewItemsId'];
}
$Requested_ProductId = SECURE($ViewItemsId, "d");

//activity variables & page database access
$PageSqls = "SELECT * FROM products WHERE ProductId='" . $Requested_ProductId . "'";
$ProductCategoryId = GET_DATA("ProductCategoryId");
$ProductSubCategoryId = GET_DATA("ProductSubCategoryId");
$ProductBrandId = GET_DATA("ProductBrandId");

$ProBrandName = FETCH("SELECT * FROM pro_brands where ProBrandId='$ProductBrandId'", "ProBrandName");
$ProCategoryName = FETCH("SELECT * FROM pro_categories where ProCategoriesId='$ProductCategoryId'", "ProCategoryName");
$ProSubCategoryName = FETCH("SELECT * FROM pro_sub_categories where ProSubCategoriesId='$ProductSubCategoryId'", "ProSubCategoryName");

//package prices
if (isset($_GET['package'])) {
  if ($_GET['package'] == "default") {
    $ProductPackageSellPrice = GET_DATA("ProductSellPrice");
    $ProductPackageMrp = GET_DATA("ProductMrpPrice");
    $PackageWeight = GET_DATA("ProductWeight");
  } else {
    $ProductPackageId = SECURE($_GET['package'], "d");
    $ProductPackageSellPrice = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $Requested_ProductId . "'", "ProductPackageSellPrice");
    $ProductPackageMrp = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $Requested_ProductId . "'", "ProductPackageMrp");
    $PackageWeight = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $Requested_ProductId . "'", "ProductPackageName");
  }
} else {
  $ProductPackageSellPrice = GET_DATA("ProductSellPrice");
  $ProductPackageMrp = GET_DATA("ProductMrpPrice");
  $PackageWeight = GET_DATA("ProductWeight");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo GET_DATA("ProductName"); ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
</head>

<body>

  <body>

    <?php
    //header & loader
    include $AccessLevel . "include/web/header.php";
    include $AccessLevel . "include/web/navbar.php";
    ?>

    <section class="container-fluid section">
      <div class="row">
        <!-- page location -->
        <div class="col-md-12 header-bg">
          <ul class="inline-list-view">
            <li><a href="<?php echo DOMAIN; ?>"><i class="fa fa-home text-color"></i> Home</a></li>
            <li><a href="<?php echo DOMAIN; ?>/<?php echo $DirName; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo $PageName; ?></a></li>
            <li><a href="<?php echo DOMAIN; ?>/<?php echo $DirName; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo $ProBrandName; ?></a></li>
            <li><a href="<?php echo RUNNING_URL; ?>"><i class="fa fa-angle-double-right text-color"></i> <?php echo GET_DATA("ProductName"); ?></a></li>
          </ul>
        </div>

        <!-- data media files section -->
        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
          <div class="item-media-files">
            <img id="defaultimg" src="<?php echo DOMAIN; ?>/storage/products/pro-img/<?php echo GET_DATA("ProductImage"); ?>" title="<?php echo GET_DATA("ProductName"); ?>" alt="<?php echo GET_DATA("ProductName"); ?>">
          </div>
        </div>

        <!-- data details section -->
        <div class="col-lg-8 col-md-8 col-sm-6 col-12">
          <div class="item-brief">
            <h2><?php echo GET_DATA("ProductName"); ?></h2>
            <ul class="inline-list-view">
              <li><b>Animal <i class="fa fa-angle-double-right"></i></b> <?php echo $ProSubCategoryName; ?></li>
              <li><b>Brand <i class="fa fa-angle-double-right"></i></b> <?php echo $ProBrandName; ?></li>
              <li><b>Category <i class="fa fa-angle-double-right"></i></b> <?php echo $ProCategoryName; ?></li>
              <li><b>Weight <i class="fa fa-angle-double-right"></i></b> <?php echo $PackageWeight; ?></li>
            </ul>
            <p>
              <span class="app-price-2">Rs.<?php echo $ProductPackageSellPrice; ?></span>
              <span class="type fs-19"><strike>Rs.<?php echo $ProductPackageMrp; ?></strike></span>
            </p>
            <form action="" method="GET" class="add-to-cart-options">
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-4">
                  <label>Package Options</label>
                  <select class="form-control" onchange="form.submit()" name="package" required="">
                    <option value="default"><?php echo GET_DATA('ProductWeight'); ?></option>
                    <?php
                    $SelectPackages = FetchConvertIntoArray("SELECT * FROM product_packages WHERE ProductProId='" . $Requested_ProductId . "'", true);
                    if ($SelectPackages != null) {
                      foreach ($SelectPackages as $Package) {
                        if (isset($_GET['package'])) {
                          if ($Package->ProductPackageId == SECURE($_GET['package'], 'd')) {
                            echo '<option value="' . SECURE($Package->ProductPackageId, 'e') . '" selected>' . $Package->ProductPackageName . '</option>';
                          } else {
                            echo '<option value="' . SECURE($Package->ProductPackageId, 'e') . '">' . $Package->ProductPackageName . '</option>';
                          }
                        } else {
                          echo '<option value="' . SECURE($Package->ProductPackageId, 'e') . '">' . $Package->ProductPackageName . '</option>';
                        }
                      }
                    }
                    ?>
                  </select>
                </div>
            </form>
            <form action="../../../controller/ordercontroller.php" method="POST" class="add-to-cart-options">
              <?php FormPrimaryInputs(true); ?>
              <?php if (isset($_GET['package'])) { ?>
                <input type="text" name="package" value="<?php echo $_GET['package']; ?>" hidden>
              <?php } else { ?>
                <input type="text" name="package" value="default" hidden>
              <?php } ?>
              <div class="col-lg-3 col-md-3 col-sm-3 col-4">
                <label>Quantity</label>
                <select class="form-control" name="qty" required="">
                  <?php
                  $StartValue = MIN_ORDER_QTY;
                  while ($StartValue <= MAX_ORDER_QTY) { ?>
                    <option value="<?php echo $StartValue; ?>"><?php echo $StartValue; ?></option>
                  <?php $StartValue++;
                  } ?>
                </select>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-t-20">
                <button type="submit" name="AddtoCart" value="<?php echo $Requested_ProductId; ?>" class="btn btn-lg btn-success">Add to Cart <i class="fa fa-shopping-cart"></i></button>
              </div>
          </div>
          </form>
          <br>
          <?php echo SECURE(GET_DATA("ProductDescriptions"), "d"); ?>
          <hr>
          <h4 class="text-color">More Information</h4>
          <table class="table-details-2 table table-striped">
            <tr>
              <th>Category name</th>
              <td><?php echo $ProCategoryName; ?></td>
            </tr>
            <tr>
              <th>Animal name</th>
              <td><?php echo $ProSubCategoryName; ?></td>
            </tr>
            <tr>
              <th>Brand Name</th>
              <td><?php echo $ProBrandName; ?></td>
            </tr>
            <tr>
              <th>Package Details</th>
              <td><?php echo $PackageWeight; ?></td>
            </tr>
          </table>
        </div>
      </div>
      </div>
    </section>

    <section class="container-fluid section">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-color">Suggested Products</h2>
        </div>
        <?php
        $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId ORDER BY products.ProductId ASC limit 0, 4");
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
          <div class="col-md-3 col-lg-3 col-sm-3 col-6 m-b-10">
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
        <div class="col-md-12 text-right">
          <h4 class="m-t-0">
            <a href="<?php echo DOMAIN; ?>/web/store/" class="text-color">View All <i class="fa fa-angle-double-right"></i></a>
          </h4>
        </div>
      </div>
    </section>

    <script>
      function ChangeImage(data) {
        var GetImageSrc = document.getElementById("" + data + "").src;
        document.getElementById("defaultimg").src = GetImageSrc;
      }

      function DefaultImg() {
        var GetImageSrc = document.getElementById("" + data + "").src;
        document.getElementById("defaultimg").src = GetImageSrc;
      }
    </script>

    <script>
      function Increase() {
        var qtydata = document.getElementById("qty");
        results = +qtydata.value + 1;
        if (results == 5) {
          document.getElementById("qty").value = 5;
          alert("Quantity cannot be greater then 5");
        } else {
          document.getElementById("qty").value = results;
        }

        if (qtydata.value > 5) {
          document.getElementById("qty").value = 5;
        }
      }

      function Decrease() {
        var qtydata = document.getElementById("qty");
        results = +qtydata.value - 1;
        if (results == 0) {
          document.getElementById("qty").value = 1;
          alert("Quantity cannot be less then 1");
        } else {
          document.getElementById("qty").value = results;
        }

        if (qtydata.value < 0) {
          document.getElementById("qty").value = 1;
        }
      }
    </script>

    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  </body>

</html>