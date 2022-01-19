<?php
//include required files here
require '../require/modules.php';
require '../require/web-modules.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | <?php echo APP_NAME; ?></title>
  <?php include '../include/web/header_files.php'; ?>
</head>

<body>

  <?php
  //header & loader
  include '../include/web/loader.php';
  include '../include/web/header.php';
  include '../include/web/navbar.php';
  ?>

  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <?php
            $FetchSliders = FetchConvertIntoArray("SELECT * FROM sliders where SliderStatus='1' and SliderType='Website' and SliderLocations='HomePageWebsite' ORDER BY SliderId ASC", true);
            if ($FetchSliders != null) {
              foreach ($FetchSliders as $data) {
                if ($data->SliderOpenAt == "Same Page") {
                  $target = "";
                } else {
                  $target = "target='_blank'";
                } ?>
                <li>
                  <div class="seq-model"><img data-seq src="<?php echo STORAGE_URL; ?>/sliders/<?php echo $data->SliderType; ?>/img/<?php echo $data->SliderImage; ?>" title="<?php echo $data->SliderName; ?>" alt="<?php echo $data->SliderName; ?>"></div>
                  <div class="seq-title"><span data-seq><?php echo $data->SliderOfferText; ?></span>
                    <h2 data-seq><?php echo $data->SliderName; ?></h2>
                    <p data-seq><?php echo SECURE($data->SliderDescriptions, "d"); ?></p>
                    <a data-seq href="<?php echo $data->SliderTargetUrl; ?>" <?php echo $target; ?> class="aa-shop-now-btn aa-secondary-btn">SHOP NOW</a>
                  </div>
                </li>
            <?php }
            } ?>
          </ul>
        </div>
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a class="seq-prev" aria-label="Previous"><i class="fa fa-angle-left"></i></a> <a class="seq-next" aria-label="Next"><i class="fa fa-angle-right"></i></a>
        </fieldset>
      </div>
    </div>
  </section>

  <section class="container">
    <div class="row">
      <div class="col-md-12 p-1r text-center">
        <h2 class="web-title">View Latest</h2>
        <img src="<?php echo STORAGE_URL; ?>/default/tool-img/grass2.gif" class="web-title-img br10">
      </div>
    </div>
  </section>

  <section class="container-fluid section">
    <div class="row">
      <?php
      $FetchListings = FetchConvertIntoArray("SELECT * FROM mainlistings ORDER BY MainListingId ASC", true);
      if ($FetchListings != null) {
        foreach ($FetchListings as $Fields) { ?>
          <div class="col-md-3 col-lg-3 col-sm-4 col-6">
            <a href="<?php echo DOMAIN; ?>/web/<?php echo $Fields->ListinUrl; ?>">
              <div class="cat-box">
                <img src="<?php echo STORAGE_URL; ?>/listing/<?php echo $Fields->MainListingImage; ?>" title="<?php echo $Fields->MainListingName; ?>" alt="<?php echo $Fields->MainListingName; ?>" class="w-100 br10">
                <h3 class="text-center"><?php echo $Fields->MainListingName; ?></h3>
              </div>
            </a>
          </div>
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
        <div class="col-md-3 col-lg-3 col-sm-4 col-6 m-b-10">
          <a href="<?php echo DOMAIN; ?>/web/cattle-fair">
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
          <a href="<?php echo DOMAIN; ?>/web/store/" class="text-color">View All Items <i class="fa fa-angle-double-right"></i></a>
        </h4>
      </div>

    </div>
  </section>


  <section class="container">
    <div class="row">
      <div class="col-md-12 p-1r text-center">
        <h2 class="web-title">Veterinary Doctors</h2>
        <img src="<?php echo STORAGE_URL; ?>/default/tool-img/grass2.gif" class="web-title-img">
      </div>
    </div>
  </section>

  <section class="container-fluid section">
    <div class="row">

      <?php
      $fetchdoctors = FetchConvertIntoArray("SELECT * FROM doctors where DoctorStatus='1' ORDER BY Doctorsid ASC LIMIT 0, 4", true);
      if ($fetchdoctors != null) {
        foreach ($fetchdoctors as $data) {
      ?> <div class="col-md-3 col-lg-3 col-sm-4 col-6">
            <a href="<?php echo DOMAIN; ?>/web/veterinary-doctors/details/?viewdata=<?php echo SECURE($data->Doctorsid); ?>">
              <div class="cat-box">

                <img src="<?php echo STORAGE_URL; ?>/doctors/images/profile/<?php echo $data->DoctorProfileImage; ?>" title="<?php echo $data->DoctorName; ?>" alt="<?php echo $data->DoctorName; ?>" class="w-100">

                <h4 class="m-t-0 m-b-3 text-center">
                  <span>
                    <b><?php echo StatusView($data->DoctorStatus); ?> Dr. <?php echo $data->DoctorName; ?></b>
                  </span>
                </h4>

                <table class="table table-striped m-t-10 table-details m-b-5 fs-12">
                  <tr>
                    <th>Specilisation</th>
                    <td><?php echo SECURE($data->DoctorSpecilisation, "d"); ?></td>
                  </tr>
                  <tr>
                    <th>Expertise</th>
                    <td><?php echo SECURE($data->DoctorExpertiseInAnimals, "d"); ?></td>
                  </tr>
                  <tr>
                    <th>Qualifications</th>
                    <td><?php echo $data->DoctorQualifications; ?></td>
                  </tr>
                  <tr>
                    <th>Experience</th>
                    <td><?php echo $data->DoctorWorkExperience; ?></td>
                  </tr>
                  <tr>
                    <th>Clinic Visit Fee</th>
                    <td><span class="app-price text-color"><i class="fa fa-medkit"></i> Rs.<?php echo $data->DoctorConsultanctFeeInClinic; ?></span>
                    </td>
                  </tr>
                  <tr>
                    <th>Home Visit Fee</th>
                    <td class="p-2"><span class="app-price text-color"><i class="fa fa-home"></i> Rs.<?php echo $data->DoctorVisitingFee; ?></span>
                    </td>
                  </tr>
                  <tr>
                    <th>Call Fee</th>
                    <td><span class="app-price text-color"><i class="fa fa-phone"></i> Rs.<?php echo $data->DoctorFeeForPhoneConsultaning; ?></span>
                    </td>
                  </tr>
                </table>
                <a href="#" class="cart-button"><i class="fa fa-info-circle"></i> GET CONTACT INFO</a>
              </div>
            </a>
          </div>
      <?php }
      } ?>
      <div class="col-md-12 text-right">
        <h4 class="m-t-0">
          <a href="<?php echo DOMAIN; ?>/web/veterinary-doctors/" class="text-color">View All Doctors <i class="fa fa-angle-double-right"></i></a>
        </h4>
      </div>
    </div>
  </section>

  <section class="container">
    <div class="row">
      <div class="col-md-12 p-1r text-center">
        <h2 class="web-title">AI Workers</h2>
        <img src="<?php echo STORAGE_URL; ?>/default/tool-img/grass2.gif" class="web-title-img">
      </div>
    </div>
  </section>

  <section class="container-fluid section">
    <div class="row">

      <?php
      $fetchaiworkers = FetchConvertIntoArray("SELECT * FROM aiworkers ORDER BY Aiworkersid ASC LIMIT 0, 4", true);
      if ($fetchaiworkers != null) {
        foreach ($fetchaiworkers as $data) {
      ?>
          <div class="col-md-3 col-lg-3 col-sm-4 col-6">
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
                <a href="#" class="cart-button"><i class="fa fa-info-circle"></i> GET CONTACT INFO</a>
              </div>
            </a>
          </div>
      <?php }
      } ?>
      <div class="col-md-12 text-right">
        <h4 class="m-t-0">
          <a href="<?php echo DOMAIN; ?>/web/ai-workers/" class="text-color">View All Workers <i class="fa fa-angle-double-right"></i></a>
        </h4>
      </div>
    </div>
  </section>

  <?php include '../include/web/footer.php'; ?>
  <?php include '../include/web/footer_files.php'; ?>
</body>

</html>