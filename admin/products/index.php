<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Products";
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
              <div class="row m-t-10">
                <div class="col-md-12">
                  <h4 class="app-heading"><i class="fa fa-list-ul"></i> <?php echo $PageName; ?></h4>
                </div>
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <?php include 'common.php'; ?>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Measure</th>
                          <th>SellPrice</th>
                          <th>CreatedAt</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <?php
                      $SQLproducts = SELECT("SELECT * FROM products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId  ORDER BY products.ProductStatus DESC");
                      while ($fetchpro_brands = mysqli_fetch_array($SQLproducts)) {
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
                        $ProductStatus = StatusViewWithText($fetchpro_brands['ProductStatus']);
                        $ProductCreatedAt = $fetchpro_brands['ProductCreatedAt'];
                        $ProductUpdatedAt = ReturnValue($fetchpro_brands['ProductUpdatedAt']);
                        $ProductCreatedBy = $fetchpro_brands['ProductCreatedBy'];
                        $ProductId = $fetchpro_brands['ProductId'];
                        $ProductAvailibility = $fetchpro_brands['ProductStatus']; ?>
                        <tr>
                          <td>
                            <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $ProductImage; ?>" alt="<?php echo $ProductName; ?>" title="<?php echo $ProductName; ?>" class="w-10 pro-img">
                          </td>
                          <td class="lh-1-1 p-t-2">
                            <a href="<?php echo DOMAIN; ?>/admin/products/edit-products.php?productid=<?php echo SECURE($ProductId, "e"); ?>" class="p-t-2"><span class="text-primary"><?php echo $ProductName; ?></span><br>
                              <span class="text-grey fs-12">
                                <i class="fa fa-hashtag"></i> <?php echo $ProCategoryName; ?> |
                                <?php echo $ProSubCategoryName; ?> |
                                <?php echo $ProBrandName; ?>
                              </span>
                            </a>
                          </td>
                          <td>
                            <?php echo $ProductWeight; ?>
                          </td>
                          <td>
                            <?php echo Price($ProductSellPrice); ?> / <?php echo MrpPrice($ProductMrpPrice); ?>
                          </td>
                          <td>
                            <?php echo $ProductCreatedAt; ?>
                          </td>
                          <td>
                            <?php if ($ProductAvailibility == 3) { ?>
                              <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?delete_products=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($ProductId, "e"); ?>" class="btn-danger btn-sm btn"><i class="fa fa-trash"></i> Delete</a>
                              <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?restore_products=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(DOMAIN . "/admin/products", "e"); ?>&control_id=<?php echo SECURE($ProductId, "e"); ?>" class="btn-success btn-sm btn"><i class="fa fa-refresh"></i> Restore</a>
                            <?php } else {
                              echo $ProductStatus;
                            } ?>
                          </td>
                        </tr>
                      <?php } ?>
                    </table>
                  </div>
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