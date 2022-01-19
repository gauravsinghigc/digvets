<?php
//require files
require '../require/modules.php';
require '../require/admin/sessionvariables.php';

//access_url 
if (isset($_REQUEST['access_url']) == null) {
 echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Root</a>";
 die();
} else {
 $access_url = $_REQUEST['access_url'];
}


//start actiivity here
if (isset($_POST['CreateProductCategories'])) {
 $ProCategoryName = $_POST['ProCategoryName'];
 $ProCategoryImage = UPLOAD_FILES("../storage/products/category", "ProCategoryImage", "Category_", "$ProCategoryName", "ProCategoryImage");
 $ProCategoryStatus = 1;
 $ProCategoryCreatedAt = date("d M, Y");

 $Save = SAVE("pro_categories", ["ProCategoryName", "ProCategoryImage", "ProCategoryStatus", "ProCategoryCreatedAt"]);
 RESPONSE($Save, "New Category: <b>$ProCategoryName</b> is created successfully!", "Unable to create new category");

 //product sub category
} elseif (isset($_POST['CreateProductSubCategories'])) {
 $ProSubCategoryName = $_POST['ProSubCategoryName'];
 $ProSubCategoryId = $_POST['ProSubCategoryId'];
 $ProSubCategoryImage = UPLOAD_FILES("../storage/products/subcategory", "ProSubCategoryImage", "subcategory", "$ProSubCategoryName", "ProSubCategoryImage");
 $ProSubCategoryStatus = 1;
 $ProSubCategoryCreatedAt = date("d M, Y");

 $save = SAVE("pro_sub_categories", ["ProSubCategoryName", "ProSubCategoryId", "ProSubCategoryImage", "ProSubCategoryStatus", "ProSubCategoryCreatedAt"]);
 RESPONSE($save, "New Sub category <b>$ProSubCategoryName</b> is created successfully!", "Unable to create new sub category!");

 //product brands
} elseif (isset($_POST['CreateProductbrands'])) {
 $ProBrandName = $_POST['ProBrandName'];
 $ProBrandImage = UPLOAD_FILES("../storage/products/brands", "ProBrandImage", "brands", "$ProBrandName", "ProBrandImage");
 $ProBrandStatus = 1;
 $ProBrandCreatedAt = date("d M, Y");

 $save = SAVE("pro_brands", ["ProBrandName", "ProBrandStatus", "ProBrandCreatedAt", "ProBrandImage"]);
 RESPONSE($save, "New $ProBrandName is created successfully!", "unable to create new brand name");

 //save products
} else if (isset($_POST['CreateProducts'])) {
 $ProductName = $_POST['ProductName'];
 $ProductRefernceCode = $_POST['ProductRefernceCode'];
 $ProductImage = UPLOAD_FILES("../storage/products/pro-img", "ProductImage", "$ProductName", "$ProductRefernceCode", "ProductImage");
 $ProductCategoryId = $_POST['ProductCategoryId'];
 $ProductSubCategoryId = $_POST['ProductSubCategoryId'];
 $ProductBrandId = $_POST['ProductBrandId'];
 $ProductSellPrice = $_POST['ProductSellPrice'];
 $ProductMrpPrice = $_POST['ProductMrpPrice'];
 $ProductDescriptions = SECURE($_POST['ProductDescriptions'], "e");
 $ProductWeight = $_POST['ProductWeight'];
 $ProductStatus = 1;
 $ProductCreatedAt = date("d M, Y");
 $ProductCreatedBy = LOGIN_UserId;

 $SaveProducts = SAVE("products", ["ProductName", "ProductRefernceCode", "ProductImage", "ProductCategoryId", "ProductSubCategoryId", "ProductBrandId", "ProductSellPrice", "ProductMrpPrice", "ProductDescriptions", "ProductWeight", "ProductStatus", "ProductCreatedAt", "ProductCreatedBy"]);
 RESPONSE($SaveProducts, "New product <b>$ProductName</b> is Saved successfully!", "Unable to save new product");

 //update products
} elseif (isset($_POST['UpdateProducts'])) {
 $ViewProductId = $_SESSION['VIEW_PRODUCT_ID'];
 $CurrentFile = SECURE($_POST['CurrentFile'], "d");

 if ($_FILES['ProductImage']['name'] == null || $_FILES['ProductImage']['name'] == "null" || $_FILES['ProductImage']['name'] == " " || $_FILES['ProductImage']['name'] == "") {
  $ProductImage = $CurrentFile;
 } else {
  $ProductImage = UPLOAD_FILES("../storage/products/pro-img", "ProductImage", "$ProductName", "$ProductRefernceCode", "ProductImage");
 }

 $ProductName = $_POST['ProductName'];
 $ProductCategoryId = $_POST['ProductCategoryId'];
 $ProductSubCategoryId = $_POST['ProductSubCategoryId'];
 $ProductBrandId = $_POST['ProductBrandId'];
 $ProductRefernceCode = $_POST['ProductRefernceCode'];
 $ProductSellPrice = $_POST['ProductSellPrice'];
 $ProductMrpPrice = $_POST['ProductMrpPrice'];
 $ProductWeight = $_POST['ProductWeight'];
 $ProductDescriptions = SECURE($_POST['ProductDescriptions'], "e");
 $ProductStatus = $_POST['ProductStatus'];
 $ProductUpdatedAt = date("d M, Y");

 $UpdateProducts = UPDATE_TABLE("products", ["ProductName", "ProductRefernceCode", "ProductImage", "ProductCategoryId", "ProductSubCategoryId", "ProductBrandId", "ProductSellPrice", "ProductMrpPrice", "ProductWeight", "ProductDescriptions", "ProductStatus", "ProductUpdatedAt"], "ProductId='$ViewProductId'");

 RESPONSE($UpdateProducts, "Product Details Updated!", "Unable to Update Product Details");

 //delete products
} elseif (isset($_POST['DeleteProducts'])) {
 $ProductId = $_SESSION['VIEW_PRODUCT_ID'];
 $ProductStatus = 3;
 $ProductUpdatedAt = date("d M, Y");

 $DeleteProducts = UPDATE_TABLE("products", ["ProductStatus", "ProductUpdatedAt"], "ProductId='$ProductId'");
 RESPONSE($DeleteProducts, "Product Deleted!", "Unable to Delete Product");

 //CreateNewPackages
} elseif (isset($_POST['CreateNewPackages'])) {
 $ProductProId = $_SESSION['VIEW_PRODUCT_ID'];
 $ProductPackageName = $_POST['ProductPackageName'];
 $ProductPackageDetails = POST("ProductPackageDetails");
 $ProductPackageSellPrice = $_POST['ProductPackageSellPrice'];
 $ProductPackageMrp = $_POST['ProductPackageMrp'];
 $ProductPackageRefNumber = $_POST['ProductPackageRefNumber'];

 $SaveProductPackage = SAVE("product_packages", ["ProductProId", "ProductPackageName", "ProductPackageDetails", "ProductPackageSellPrice", "ProductPackageMrp", "ProductPackageRefNumber"]);
 RESPONSE($SaveProductPackage, "New Package <b>$ProductPackageName</b> is created successfully!", "Unable to create new package");

 //delete products
} elseif (isset($_GET['delete_products'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_products = SECURE($_GET['delete_products'], "d");

 if ($delete_products == "true") {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete_products = DELETE_FROM("products", "ProductId='$control_id'");

  $DeleteProductPackages = DELETE_FROM("product_packages", "ProductProId='$control_id'");
  RESPONSE($delete_products, "Product Delete Permanently!", "Unable to Delete Product Permanently");
 } else {
  LOCATION("warning", "Invalid Activity Record!", $access_url);
 }

 //delete product packages
} elseif (isset($_GET['delete_product_packages'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_product_packages = SECURE($_GET['delete_product_packages'], "d");

 if ($delete_product_packages == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete_product_packages = DELETE_FROM("product_packages", "ProductPackageId='$control_id'");
  RESPONSE($delete_product_packages, "Package Delete Permanently!", "Unable to Delete Package Permanently");
 } else {
  LOCATION("warning", "Invalid Activity Record!", $access_url);
 }

 //restore products
} elseif (isset($_GET['restore_products'])) {
 $restore_products = SECURE($_GET['restore_products'], "d");
 $access_url = SECURE($_GET['access_url'], "d");

 if ($restore_products == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $ProductStatus = 1;
  $ProductUpdatedAt = date("d M, Y");
  $restore_products = UPDATE_TABLE("products", ["ProductStatus", "ProductUpdatedAt"], "ProductId='$control_id'");
  RESPONSE($restore_products, "Product Restore Successfully!", "Unable to Restore Product");
 } else {
  LOCATION("warning", "Invalid Activity Record!", $access_url);
 }

 //update package details
} else if (isset($_POST['UpdatePackageDetails'])) {
 $ProductPackageId = SECURE($_POST['UpdatePackageDetails'], "d");
 $ProductPackageName = $_POST['ProductPackageName'];
 $ProductPackageSellPrice = $_POST['ProductPackageSellPrice'];
 $ProductPackageMrp = $_POST['ProductPackageMrp'];
 $ProductPackageDetails = POST("ProductPackageDetails");
 $ProductPackageRefNumber = $_POST['ProductPackageRefNumber'];

 $UpdateProductPackages = UPDATE_TABLE("product_packages", ["ProductPackageName", "ProductPackageSellPrice", "ProductPackageMrp", "ProductPackageDetails", "ProductPackageRefNumber"], "ProductPackageId='$ProductPackageId'");
 RESPONSE($UpdateProductPackages, "Package Details Updated!", "Unable to Update Package Details");

 //update product categories
} elseif (isset($_POST['UpdateCategories'])) {
 $ProCategoriesId = SECURE($_POST['UpdateCategories'], "d");
 $ProCategoryName = $_POST['ProCategoryName'];
 $ProCategoryUpdatedAt = date("d M, Y");
 $ProCategoryStatus = $_POST['ProCategoryStatus'];

 if ($_FILES['ProCategoryImage']['name'] ==  null || $_FILES['ProCategoryImage']['name'] == "null" || $_FILES['ProCategoryImage']['name'] == " " || $_FILES['ProCategoryImage']['name'] == "") {
  $ProCategoryImage = SECURE($_POST['CurrentFile'], "d");
 } else {
  $ProCategoryImage = UPLOAD_FILES("../storage/products/category", "ProCategoryImage", "$ProCategoryName", "$ProCategoriesId", "ProCategoryImage");
 }
 $UpdateProductCategories = UPDATE_TABLE("pro_categories", ["ProCategoryName", "ProCategoryImage", "ProCategoryUpdatedAt", "ProCategoryStatus"], "ProCategoriesId='$ProCategoriesId'");
 RESPONSE($UpdateProductCategories, "Category Details Updated!", "Unable to Update Category Details");

 //delete product categories
} elseif (isset($_GET['delete_product_categories'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_product_categories = SECURE($_GET['delete_product_categories'], "d");

 if ($delete_product_categories == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete_product_categories = DELETE_FROM("pro_categories", "ProCategoriesId='$control_id'");
  RESPONSE($delete_product_categories, "Category Delete Permanently!", "Unable to Delete Category Permanently");
 } else {
  LOCATION("warning", "Invalid Activity Record!", $access_url);
 }

 //update product sub categories
} elseif (isset($_POST['UpdateSubCategories'])) {
 $ProSubCategoriesId = SECURE($_POST['UpdateSubCategories'], "d");
 $ProSubCategoryName = $_POST['ProSubCategoryName'];
 $ProSubCategoryUpdatedAt = date("d M, Y");
 $ProSubCategoryStatus = $_POST['ProSubCategoryStatus'];
 $ProSubCategoryId = $_POST['ProSubCategoryId'];

 if ($_FILES['ProSubCategoryImage']['name'] ==  null || $_FILES['ProSubCategoryImage']['name'] == "null" || $_FILES['ProSubCategoryImage']['name'] == " " || $_FILES['ProSubCategoryImage']['name'] == "") {
  $ProSubCategoryImage = SECURE($_POST['CurrentFile'], "d");
 } else {
  $ProSubCategoryImage = UPLOAD_FILES("../storage/products/subcategory", "ProSubCategoryImage", "$ProSubCategoryName", "$ProSubCategoriesId", "ProSubCategoryImage");
 }

 $UpdateProductSubCategories = UPDATE_TABLE("pro_sub_categories", ["ProSubCategoryName", "ProSubCategoryId", "ProSubCategoryImage", "ProSubCategoryStatus", "ProSubCategoryUpdatedAt"], "ProSubCategoriesId='$ProSubCategoriesId'");
 RESPONSE($UpdateProductSubCategories, "Sub Category Details Updated!", "Unable to Update Sub Category Details");

 //delete sub categories
} elseif (isset($_GET['delete_sub_categories'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_sub_categories = SECURE($_GET['delete_sub_categories'], "d");

 if ($delete_sub_categories == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete_sub_categories = DELETE_FROM("pro_sub_categories", "ProSubCategoriesId='$control_id'");
  RESPONSE($delete_sub_categories, "Sub Category Delete Permanently!", "Unable to Delete Sub Category Permanently");
 } else {
  LOCATION("warning", "Invalid Activity Record!", $access_url);
 }

 //update product brands
} elseif (isset($_POST['UpdateProductbrands'])) {
 $ProBrandId = SECURE($_POST['UpdateProductbrands'], "d");
 $ProBrandName = $_POST['ProBrandName'];
 $ProBrandUpdatedAt = date("d M, Y");
 $ProBrandStatus = $_POST['ProBrandStatus'];

 if ($_FILES['ProBrandImage']['name'] ==  null || $_FILES['ProBrandImage']['name'] == "null" || $_FILES['ProBrandImage']['name'] == " " || $_FILES['ProBrandImage']['name'] == "") {
  $ProBrandImage = SECURE($_POST['CurrentFile'], "d");
 } else {
  $ProBrandImage = UPLOAD_FILES("../storage/products/brands", "ProBrandImage", "$ProBrandName", "$ProBrandId", "ProBrandImage");
 }
 $UpdateBrands = UPDATE_TABLE("pro_brands", ["ProBrandName", "ProBrandImage", "ProBrandUpdatedAt", "ProBrandStatus"], "ProBrandId='$ProBrandId'");
 RESPONSE($UpdateBrands, "Brand Details Updated!", "Unable to Update Brand Details");
} elseif (isset($_GET['delete_brands'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $delete_brands = SECURE($_GET['delete_brands'], "d");

 if ($delete_brands == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete_brands = DELETE_FROM("pro_brands", "ProBrandId='$control_id'");
  RESPONSE($delete_brands, "Brand Delete Permanently!", "Unable to Delete Brand Permanently");
 } else {
  LOCATION("warning", "Invalid Activity Record!", $access_url);
 }
 //unknown request
 //unknown request found to this page and redirect to access denied page
} else {
 LOCATION("warning", "Unknown Product Request is received!", $access_url);
}
