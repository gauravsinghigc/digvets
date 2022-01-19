<?php
//require functions
require '../require/modules.php';
require '../require/app-modules.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Home | <?php echo APP_NAME; ?></title>
 <?php include '../include/app/header_files.php'; ?>
</head>

<body>
 <?php
 include '../include/app/header.php';
 include '../include/app/navbar.php';
 include '../include/app/slider.php'; ?>


 <section class="container-fluid">
  <div class="row">
   <?php
   $FetchListings = FetchConvertIntoArray("SELECT * FROM mainlistings ORDER BY MainListingId ASC", true);
   if ($FetchListings != null) {
    foreach ($FetchListings as $Fields) { ?>
     <a href="<?php echo DOMAIN; ?>/app/<?php echo $Fields->ListinUrl; ?>">
      <div class="col-sm-6 col-xs-6">
       <img src="<?php echo STORAGE_URL; ?>/listing/<?php echo $Fields->MainListingImage; ?>" title="<?php echo $Fields->MainListingName; ?>" alt="<?php echo $Fields->MainListingName; ?>" class="w-100 br10">
       <h3 class="text-center m-t-10 m-b-20"><?php echo $Fields->MainListingName; ?></h3>
      </div>
     </a>
   <?php }
   } ?>
  </div>
 </section>

 <section class="container">
  <div class="row">
   <div class="col-md-12 p-1r text-center">
    <h2 class="web-title"><?php echo APP_NAME; ?> Animal Utility Store</h2>
    <img src="<?php echo STORAGE_URL; ?>/default/tool-img/grass2.gif" class="web-title-img">
   </div>
  </div>
 </section>

 <section class="container-fluid section">
  <div class="row">
   <?php
   $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId ORDER BY products.ProductId ASC LIMIT 0, 8");
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
    <a href="<?php echo DOMAIN; ?>/app/cattle-fair">
     <div class="col-sm-6 col-xs-6 m-b-10">
      <div class="cat-box">
       <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" alt="<?php echo $ProductName; ?>" title="<?php echo $ProductName; ?>" class="w-100">
       <h5 class="text-center lg-1-10"><b><?php echo $ProductName; ?></b></h4>
        <p class="lh-1-10">
         <span class="flex-space-evenly text-grey m-t-20">
          <span><i class="fa fa-paw text-danger"></i> <?php echo $ProSubCategoryName; ?></span>
          <span><i class="fa fa-shopping-basket text-info"></i> <?php echo $ProductWeight; ?></span>
         </span>
         <span class="flex-space-between m-t-5">
          <span class="text-grey"><?php echo $ProBrandName; ?></span>
          <span class="text-success app-price"><b>Rs.<?php echo $ProductSellPrice; ?></b></span>
         </span>
        </p>
        <a href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?id=<?php echo SECURE($ProductId, "e"); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="cart-button">Add to Cart <i class="fa fa-shopping-cart"></i></a>
      </div>
     </div>
    </a>
   <?php } ?>
  </div>
  <div class="row">
   <div class="col-md-12 text-right">
    <h4 class="m-t-0">
     <a href="<?php echo DOMAIN; ?>/web/store/" class="text-color">View All Items <i class="fa fa-angle-double-right"></i></a>
    </h4>
   </div>
  </div>

 </section>

 <?php include '../include/app/footer_files.php'; ?>
</body>

</html>