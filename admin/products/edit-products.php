<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "Edit Product Details";

//page requests
if (isset($_GET['productid'])) {
  $ViewProductId = SECURE($_GET['productid'], "d");
  $_SESSION['VIEW_PRODUCT_ID'] = $ViewProductId;
} else {
  $ViewProductId = $_SESSION['VIEW_PRODUCT_ID'];
}

//product details
$PageSqls = "SELECT * FROM products where ProductId='$ViewProductId'";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo GET_DATA("ProductName"); ?> | <?php echo APP_NAME; ?></title>
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
                  <h4 class="app-sub-heading"><i class="fa fa-edit"></i> <?php echo $PageName; ?> : <?php echo GET_DATA("ProductName"); ?></h4>
                </div>
                <div class="col-md-12">
                  <div class="flex-s-b">
                    <?php include 'common.php'; ?>
                  </div>
                </div>
              </div>
              <div class="row shadow-lg br10 p-1r m-t-10">
                <div class="col-md-4 col-lg-4 col-sm-4 col-12 text-center">
                  <div class="product-image">
                    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA('ProductImage'); ?>" id="ImgPreview">
                  </div>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-8 col-12">
                  <table class="table table-striped">
                    <tr>
                      <th>Reference Code/HSN/ProductCode</th>
                      <td class="text-info"><i class="fa fa-hashtag"></i> <?php echo GET_DATA("ProductRefernceCode"); ?></td>
                    </tr>
                    <tr>
                      <th>Product Name</th>
                      <td><?php echo GET_DATA("ProductName"); ?></td>
                    </tr>
                    <tr>
                      <th>Product Category</th>
                      <td><?php echo FETCH("SELECT * FROM pro_categories where ProCategoriesId='" . GET_DATA("ProductCategoryId") . "'", "ProCategoryName"); ?></td>
                    </tr>
                    <tr>
                      <th>Product Sub Category</th>
                      <td><?php echo FETCH("SELECT * FROM pro_sub_categories where ProSubCategoriesId='" . GET_DATA("ProductSubCategoryId") . "'", "ProSubCategoryName"); ?></td>
                    </tr>
                    <tr>
                      <th>Product Brand</th>
                      <td><?php echo FETCH("SELECT * FROM pro_brands where ProBrandId='" . GET_DATA("ProductBrandId") . "'", "ProBrandName"); ?></td>
                    </tr>
                    <tr>
                      <th>Product Price</th>
                      <td><?php echo Price(GET_DATA("ProductSellPrice")); ?> / <strike class="text-danger"><span class="text-primary"><?php echo Price(GET_DATA("ProductMrpPrice")); ?></span></strike></td>
                    </tr>
                    <tr>
                      <th>Product Quantity</th>
                      <td><?php echo GET_DATA("ProductWeight"); ?></td>
                    </tr>
                    <tr>
                      <th>Product Description</th>
                      <td><?php echo html_entity_decode(SECURE(GET_DATA("ProductDescriptions"), "d")); ?></td>
                    </tr>
                  </table>
                  <div class="flex-s-b">
                    <a href="#" onclick="Databar('Editproducts')" class="btn btn-md btn-primary">Edit Details</a>
                    <?php if (GET_DATA("ProductStatus") == 3) { ?>
                      <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?delete_products=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($ViewProductId, "e"); ?>" class="btn-danger btn-sm btn"><i class="fa fa-trash"></i> Delete Permanent</a>
                      <a href="<?php echo DOMAIN; ?>/controller/productscontroller.php?restore_products=<?php echo SECURE('true', 'e'); ?>&access_url=<?php echo SECURE(DOMAIN . "/admin/products/edit-products.php", "e"); ?>&control_id=<?php echo SECURE($ViewProductId, "e"); ?>" class="btn-success btn-sm btn"><i class="fa fa-refresh"></i> Restore</a>
                    <?php } else { ?>
                      <form action="../../controller/productscontroller.php" method="POST">
                        <?php FormPrimaryInputs(true); ?>
                        <button type="submit" name="DeleteProducts" value="<?php SECURE($ViewProductId, "e"); ?>" class="btn btn-md btn-danger"><i class="fa fa-trash"></i> Delete</button>
                      </form>
                    <?php   } ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="flex-s-b app-sub-heading">
                    <h4 class="m-b-0">Available Packages</h4>
                    <a href="#" onclick="Databar('Addpackages')" class="btn btn-md btn-primary">Add Package</a>
                  </div>
                </div>
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>PackageID</th>
                        <th>PackageName</th>
                        <th>PackagePrice</th>
                        <th>PackageRefNo</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $GetPackages = FetchConvertIntoArray("SELECT * FROM product_packages where ProductProId='$ViewProductId'", true);
                      if ($GetPackages != 0) {
                        $count = 0;
                        foreach ($GetPackages as $GetPackage) {
                          $count++;
                      ?>
                          <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $GetPackage->ProductPackageName; ?></td>
                            <td><?php echo Price($GetPackage->ProductPackageSellPrice); ?> / <strike><?php echo MrpPrice($GetPackage->ProductPackageMrp); ?></strike></td>
                            <td><?php echo $GetPackage->ProductPackageRefNumber; ?></td>
                            <td>
                              <a href="#" onclick="Databar('Editpackages_<?php echo $GetPackage->ProductPackageId; ?>')" class="btn btn-sm btn-default">Edit</a>
                              <?php echo DELETE_BUTTON("productscontroller", "delete_product_packages", DOMAIN . "/admin/products/edit-products.php", $GetPackage->ProductPackageId);  ?>
                            </td>
                          </tr>

                          <section class="add-section" id="Editpackages_<?php echo $GetPackage->ProductPackageId; ?>">
                            <div class="add-data-form">
                              <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                                <?php FormPrimaryInputs(true); ?>
                                <div class="main-data">
                                  <div class="main-data-header app-bg">
                                    <div class="flex-s-b app-heading">
                                      <h4 class="mt-0 mb-0">Add New Package</h4>
                                      <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Editpackages_<?php echo $GetPackage->ProductPackageId; ?>')"><i class="fa fa-times fs-17"></i></a>
                                    </div>
                                  </div>
                                  <div class="main-data-body p-2">
                                    <div class="row">
                                      <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                                        <label>Product Package Name</label>
                                        <input type="text" name="ProductPackageName" value="<?php echo $GetPackage->ProductPackageName; ?>" class="form-control" placeholder="">
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                                        <label>Product Package Sell Price</label>
                                        <input type="text" name="ProductPackageSellPrice" value="<?php echo $GetPackage->ProductPackageSellPrice; ?>" class="form-control" placeholder="">
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                                        <label>Product Package Mrp</label>
                                        <input type="text" name="ProductPackageMrp" value="<?php echo $GetPackage->ProductPackageMrp; ?>" class="form-control" placeholder="">
                                      </div>
                                      <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                                        <label>Product Package Ref Number</label>
                                        <input type="text" name="ProductPackageRefNumber" value="<?php echo $GetPackage->ProductPackageRefNumber; ?>" class="form-control" placeholder="">
                                      </div>
                                      <div class="col-md-12 col-sm-12 col-12 form-group">
                                        <label>Package Description</label>
                                        <textarea name="ProductPackageDetails" rows="3" id="editor"><?php echo SECURE($GetPackage->ProductPackageDetails, "d"); ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="main-data-footer">
                                    <button type="Submit" name="UpdatePackageDetails" value="<?php echo SECURE($GetPackage->ProductPackageId, 'e'); ?>" class="btn btn-md app-btn">Update Packages</button>
                                    <a onclick="Databar('Editpackages_<?php echo $GetPackage->ProductPackageId; ?>')" class="btn btn-md btn-danger">Cancel</a>
                                  </div>
                              </form>
                            </div>
                          </section>
                      <?php
                        }
                      }
                      ?>
                    </tbody>
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

  <section class="add-section" id="Addpackages">
    <div class="add-data-form">
      <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
        <?php FormPrimaryInputs(true); ?>
        <div class="main-data">
          <div class="main-data-header app-bg">
            <div class="flex-s-b app-heading">
              <h4 class="mt-0 mb-0">Add New Package</h4>
              <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Addpackages')"><i class="fa fa-times fs-17"></i></a>
            </div>
          </div>
          <div class="main-data-body p-2">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                <label>Product Package Name</label>
                <input type="text" name="ProductPackageName" class="form-control" placeholder="">
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                <label>Product Package Sell Price</label>
                <input type="text" name="ProductPackageSellPrice" class="form-control" placeholder="">
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                <label>Product Package Mrp</label>
                <input type="text" name="ProductPackageMrp" class="form-control" placeholder="">
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6 col-12 form-group">
                <label>Product Package Ref Number</label>
                <input type="text" name="ProductPackageRefNumber" class="form-control" placeholder="">
              </div>
              <div class="col-md-12 col-sm-12 col-12 form-group">
                <label>Package Description</label>
                <textarea name="ProductPackageDetails" rows="3" id="editor"></textarea>
              </div>
            </div>
          </div>
          <div class="main-data-footer">
            <button type="Submit" value="null" name="CreateNewPackages" class="btn btn-md app-btn">Add Packages</button>
            <a onclick="Databar('Addpackages')" class="btn btn-md btn-danger">Cancel</a>
          </div>
      </form>
    </div>
  </section>

  <section class="add-section" id="Editproducts">
    <div class="add-data-form">
      <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
        <?php FormPrimaryInputs(true); ?>
        <div class="main-data">
          <div class="main-data-header app-bg">
            <div class="flex-s-b app-heading">
              <h4 class="mt-0 mb-0">Update Product Details</h4>
              <a class="btn btn-sm btn-danger sqaure" onclick="Databar('Editproducts')"><i class="fa fa-times fs-17"></i></a>
            </div>
          </div>
          <div class="main-data-body p-2">
            <div class="row">
              <?php CurrentFile(GET_DATA("ProductImage"));  ?>
              <?php FormPrimaryInputs(true); ?>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Enter Product Name</label>
                <input type="text" name="ProductName" value="<?php echo GET_DATA('ProductName'); ?>" class="form-control-2" required="" />
              </div>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Select category</label>
                <select name="ProductCategoryId" class="form-control-2" required="">
                  <?php
                  $ProductCategoryId = GET_DATA("ProductCategoryId");
                  $SqlProCategories2 = SELECT("SELECT * FROM pro_categories ORDER BY ProCategoryName ASC");
                  while ($FetchProCategories2 = mysqli_fetch_array($SqlProCategories2)) {
                    if ($FetchProCategories2['ProCategoriesId'] == $ProductCategoryId) {
                      $selected = "selected=''";
                    } else {
                      $selected = "";
                    } ?>
                    <option value="<?php echo $FetchProCategories2['ProCategoriesId']; ?>" <?php echo $selected; ?>><?php echo $FetchProCategories2['ProCategoryName']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Select Sub Category</label>
                <select name="ProductSubCategoryId" class="form-control-2" required="">
                  <?php
                  $ProductSubCategoryId = GET_DATA("ProductSubCategoryId");
                  $SqlSubcategory = SELECT("SELECT * FROM pro_sub_categories ORDER BY ProSubCategoryName ASC");
                  while ($fetchsubcategory = mysqli_fetch_array($SqlSubcategory)) {
                    if ($fetchsubcategory['ProSubCategoriesId'] == $ProductSubCategoryId) {
                      $selected = "selected=''";
                    } else {
                      $selected = "";
                    } ?>
                    <option value="<?php echo $fetchsubcategory['ProSubCategoriesId']; ?>" <?php echo $selected; ?>><?php echo $fetchsubcategory['ProSubCategoryName']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Select Brands</label>
                <select name="ProductBrandId" class="form-control-2" required="">
                  <?php
                  $ProductBrandId = GET_DATA("ProductBrandId");
                  $Sqlbrands = SELECT("SELECT * FROM pro_brands ORDER BY ProBrandName ASC");
                  while ($fetchbrands = mysqli_fetch_array($Sqlbrands)) {
                    if ($fetchbrands['ProBrandId'] == $ProductBrandId) {
                      $selected = "selected=''";
                    } else {
                      $selected = "";
                    } ?>
                    <option value="<?php echo $fetchbrands['ProBrandId']; ?>" <?php echo $selected; ?>><?php echo $fetchbrands['ProBrandName']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Enter Refrence No/HSN/ProductId/Barcode</label>
                <input type="text" name="ProductRefernceCode" value="<?php echo GET_DATA('ProductRefernceCode'); ?>" class="form-control-2" required="" />
              </div>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Enter Sell Price</label>
                <input type="text" name="ProductSellPrice" value="<?php echo GET_DATA('ProductSellPrice'); ?>" class="form-control-2" required="" />
              </div>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Enter MRP</label>
                <input type="text" name="ProductMrpPrice" value='<?php echo GET_DATA("ProductMrpPrice"); ?>' class="form-control-2" required="" />
              </div>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Enter Weight/Measurement Unit</label>
                <input type="text" name="ProductWeight" value="<?php echo GET_DATA('ProductWeight'); ?>" class="form-control-2" required="" />
              </div>
              <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
                <label>Enter Product Descriptions</label>
                <textarea type="text" id="editor" name="ProductDescriptions" style="height:100% !important;" row="3" class="form-control-2"><?php echo SECURE(GET_DATA("ProductDescriptions"), "d"); ?></textarea>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                <label>Upload New Primary Image</label>
                <input type="FILE" name="ProductImage" value="null" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" />
              </div>
              <div class="form-group col-md-6 col-lg-6 col-sm-6 col-12">
                <label>Product Status</label>
                <select class="form-control-2" name="ProductStatus" required="">
                  <?php
                  if (GET_DATA("ProductStatus") == 1) { ?>
                    <option value="1" selected="">Active</option>
                    <option value="2">Inactive</option>
                  <?php } else { ?>
                    <option value="1">Active</option>
                    <option value="2" selected="">Inactive</option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-12 m-t-10 m-b-100">
                <div class="flex-c mb-2-pr">
                  <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA('ProductImage'); ?>" id="ImgPreview">
                </div>
              </div>

              <br><br><br><br><br><br><br><br><br>
            </div>
            <div class="main-data-footer">
              <button type="Submit" value="null" name="UpdateProducts" class="btn btn-md app-btn">Update Details</button>
              <a onclick="Databar('Editproducts')" class="btn btn-md btn-danger">Cancel</a>
            </div>

          </div>
      </form>
    </div>
  </section>
  <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>