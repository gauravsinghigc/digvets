<form class="data-form" action="../../controller/productscontroller.php" method="POST" enctype="multipart/form-data">
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
    <div class="form-group col-md-4 col-lg-4 col-sm-4 col-12">
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
    <div class="col-md-12 m-t-10">
      <div class="flex-c mb-2-pr">
        <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo GET_DATA('ProductImage'); ?>" id="ImgPreview">
      </div>
    </div>
    <div class="col-md-12 m-t-10">
      <button type="Submit" value="null" name="UpdateProducts" class="btn btn-md app-btn">Update Products</button>
      <a href="<?php echo DOMAIN; ?>/admin/products/" class="btn btn-lg btn-danger">Cancel</a>
    </div>
  </div>
</form>