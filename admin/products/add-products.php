<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "ADD Products";
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
              <form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
                <?php FormPrimaryInputs(true); ?>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="app-heading"><i class="fa fa-plus"></i> <?php echo $PageName; ?></h4>
                  </div>
                  <div class="col-md-12">
                    <div class="flex-s-b">
                      <?php include 'common.php'; ?>
                    </div>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Enter Product Name</label>
                    <input type="text" name="ProductName" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Select category</label>
                    <select name="ProductCategoryId" class="form-control-2 demo-chosen-select" required="">
                      <?php
                      $SqlProCategories2 = SELECT("SELECT * FROM pro_categories ORDER BY ProCategoryName ASC");
                      while ($FetchProCategories2 = mysqli_fetch_array($SqlProCategories2)) { ?>
                        <option value="<?php echo $FetchProCategories2['ProCategoriesId']; ?>"><?php echo $FetchProCategories2['ProCategoryName']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Select Sub Category</label>
                    <select name="ProductSubCategoryId" class="form-control-2 demo-chosen-select" required="">
                      <?php
                      $SqlSubcategory = SELECT("SELECT * FROM pro_sub_categories ORDER BY ProSubCategoryName ASC");
                      while ($fetchsubcategory = mysqli_fetch_array($SqlSubcategory)) { ?>
                        <option value="<?php echo $fetchsubcategory['ProSubCategoriesId']; ?>"><?php echo $fetchsubcategory['ProSubCategoryName']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Select Brands</label>
                    <select name="ProductBrandId" class="form-control-2 demo-chosen-select" required="">
                      <?php
                      $Sqlbrands = SELECT("SELECT * FROM pro_brands ORDER BY ProBrandName ASC");
                      while ($fetchbrands = mysqli_fetch_array($Sqlbrands)) { ?>
                        <option value="<?php echo $fetchbrands['ProBrandId']; ?>"><?php echo $fetchbrands['ProBrandName']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Enter Refrence No/HSN/ProductId/Barcode</label>
                    <input type="text" name="ProductRefernceCode" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Enter Sell Price</label>
                    <input type="text" name="ProductSellPrice" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Enter MRP</label>
                    <input type="text" name="ProductMrpPrice" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Enter Weight/Measurement Unit</label>
                    <input type="text" name="ProductWeight" class="form-control-2" required="" />
                  </div>
                  <div class="form-group col-lg-12 col-md-12 col-ms-12 col-12">
                    <label>Enter Product Descriptions</label>
                    <textarea type="text" id="editor" name="ProductDescriptions" style="height:100% !important;" row="3" class="form-control-2" required=""></textarea>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-ms-6 col-12">
                    <label>Upload Primary Image</label>
                    <input type="FILE" name="ProductImage" id="uploadimage" accept="image/png, image/gif, image/jpeg" class="form-control-2" required="" />
                  </div>
                  <div class="col-md-12">
                    <div class="flex-c mb-2-pr">
                      <img src="" id="ImgPreview">
                    </div>
                  </div>
                  <div class="col-md-12 m-t-20">
                    <button type="Submit" onclick="form.submit()" value="null" name="CreateProducts" class="btn btn-md app-btn">Save Products</button>
                    <a href="<?php echo DOMAIN; ?>/admin/products/" class="btn btn-md btn-danger">Cancel</a>
                  </div>
                </div>
            </div>
          </div>
          </form>
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