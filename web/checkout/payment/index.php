<?php

//page varibale
$PageName  = "Payment";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//page actiti
if (isset($_POST['BillingAddress'])) {
  $_SESSION['BILLING_ADDRESS'] = SECURE($_POST['BillingAddress'], "e");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
</head>

<body>

  <body>

    <?php
    //header & loader
    include $AccessLevel . "include/web/header.php";
    include $AccessLevel . "include/web/navbar.php";
    ?>

    <section class="container section">
      <div class="row">
        <div class="col-md-12 header-bg">
          <h2 class="inline-list-view text-black p-t-10 p-b-10"><i class="fa fa-truck m-t-5 p-r-7 text-color"></i> <?php echo $PageName; ?></h2>
        </div>
      </div>
    </section>

    <section class="container m-t-10 section">
      <div class="row">
        <?php if (CartItems() == 0) {
          NoCartItems("Empty Cart") . "<br><br>";
        } else { ?>
          <div class="col-lg-5 col-md-5 col-sm-6 col-12 section-div p-r-20">
            <div class="row">
              <div class="col-md-12 m-b-15 header-bg">
                <h4 class="m-l-5"><i class="fa fa-map-marker"></i> Shipping Address</h4>
              </div>
              <div class="col-md-12">
                <div class="cat-box">
                  <?php echo SECURE($_SESSION['SHIPPING_ADDRESS'], "d"); ?><br><br>
                  <a href="../index.php" class="btn btn-sm btn-primary">Edit Address</a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 m-b-15 header-bg">
                <h4 class="m-l-5"><i class="fa fa-inr"></i> Billing Address</h4>
              </div>
              <div class="col-md-12">
                <div class="cat-box">
                  <?php echo SECURE($_SESSION['BILLING_ADDRESS'], "d"); ?><br><br>
                  <a href="../billing/" class="btn btn-sm btn-primary">Edit Address</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7 col-md-7 col-sm-6 col-12">
            <div class="row">
              <div class="col-md-12 header-bg m-b-10 m-l-10">
                <h4 class="m-l-5"><i class='fa fa-inr'></i> Payment Details</h4>
              </div>
            </div>
            <div class="row">
              <?php
              if (isset($_SESSION['LOGIN_CustomerId'])) {
                $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
                $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
              } else {
                $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId and cartitems.CartProductId=products.ProductId and cartitems.CartProductId=products.ProductId and cartitems.CartDeviceInfo='" . IP_ADDRESS . "'", true);
              }
              if ($CartItems ==  null) {
                NoCartItems("Empty Shopping Cart!");
              } else {
                foreach ($CartItems as $CartProducts) {
              ?>
                  <div class="col-md-3 col-lg-3 col-sm-4 col-4 m-b-10">
                    <div class="cat-box cat-box-2">
                      <span class="cartitemplus"><i class="fa fa-plus"></i></span>
                      <a href="<?php echo DOMAIN; ?>/web/store/details/?view=<?php echo SECURE($CartProducts->ProductId, "e"); ?>">
                        <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $CartProducts->ProductImage; ?>" alt="<?php echo $CartProducts->ProductName; ?>" title="<?php echo $CartProducts->ProductName; ?>" class="w-100 cart-item-image">
                      </a>
                      <h6 class="text-left lg-1-10"><b><?php echo $CartProducts->ProductName; ?></b></h6>
                      <p class="lh-1-4 fs-11">
                        <span class="text-grey"><?php echo $CartProducts->ProBrandName; ?></span>
                        <span class="flex-space-evenly">
                          <span><i class="fa fa-paw text-danger"></i> <?php echo $CartProducts->ProSubCategoryName; ?></span>
                          <span><i class="fa fa-shopping-basket text-info fs-13"></i> <?php echo $CartProducts->CartProductWeight; ?></span>
                        </span>
                        <span class="flex-space-between">
                          <span class="text-black">Rs.<?php echo $CartProducts->CartProductSellPrice; ?> </span>
                          <span class="text-black"> x
                            <?php echo $CartProducts->CartProductQty; ?>
                          </span>
                          <span class="text-danger">
                            = <span>Rs.<?php echo $CartProducts->CartFinalPrice; ?></span>
                          </span>
                        </span>
                      </p>
                    </div>
                  </div>
              <?php }
              }
              ?>
            </div>
            <div class="row">
              <table class="table">
                <tr align="right">
                  <td>
                    <span class="cart-details">Total Cart Amount</span>
                  </td>
                  <td>
                    <span class="cart-price">Rs.<?php echo $_SESSION['TOTAL_CART_AMOUNT']; ?></span>
                  </td>
                </tr>
                <tr align="right">
                  <td>
                    <span class="cart-details"><?php echo $_SESSION['DELIVERY_CHARGES_NAME'] ?></span>
                  </td>
                  <td>
                    <span class="cart-price"><?php ChargeDisplay("DELIVERY_CHARGES", "Free"); ?></span>
                  </td>
                </tr>
                <tr align="right">
                  <td>
                    <span class="cart-details">Total Cart Amount</span>
                  </td>
                  <td>
                    <span class="cart-price">Rs.<?php echo $_SESSION['NET_PAYABLE_AMOUNT']; ?></span>
                  </td>
                </tr>
              </table>
            </div>
            <div class="row">
              <div class="col-md-12 header-bg m-b-10 m-l-10">
                <h4 class="m-l-5"><i class="fa fa-exchange"></i> Payment Method</h4>
              </div>
              <div class="col-md-12 text-center">
                <form action="../../../controller/ordercontroller.php" method="POST">
                  <?php FormPrimaryInputs(true); ?>
                  <div class="row text-center">
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6 form-group shadow-lg" onclick="ChangeMethod('paymethod')">
                      <label for="cashpayment">
                        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/cash.jpg" class="w-100 br10" id="paymethod">
                      </label>
                      <input type="radio" name="PAYMENT_METHOD" required="" value="Cash On Delivery" id="cashpayment" hidden="">
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-6 form-group shadow-lg" onclick="ChangeMethod('onlinemethod')">
                      <label for="onlinepayment">
                        <img src="<?php echo STORAGE_URL_D; ?>/tool-img/online.jpg" class="w-100 br10" id="onlinemethod">
                      </label>
                      <input type="radio" name="PAYMENT_METHOD" required="" value="Online Payment" id="onlinepayment" hidden="">
                    </div>
                    <div class="col-md-12">
                      <span id="paymodemsg" class="text-danger"></span><br>
                      <button class="btn btn-lg btn-success" onclick="CheckMode()" name="CreateOrder">Continue <i class="fa fa-angle-double-right"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
    <script>
      function CheckMode() {
        var cashpayment = document.getElementById("cashpayment");
        var onlinepayment = document.getElementById("onlinepayment");
        if (cashpayment.checked == false || onlinepayment.checked == false) {
          document.getElementById("paymodemsg").innerHTML = "Please Select Pay Mode";
        } else {

        }
      }
    </script>
    <script>
      function ChangeMethod(data) {
        if (data === "paymethod") {
          document.getElementById("paymethod").classList.add("paymethod");
          document.getElementById("onlinemethod").classList.remove("paymethod");
        } else {
          document.getElementById("onlinemethod").classList.add("paymethod");
          document.getElementById("paymethod").classList.remove("paymethod");
        }
      }
    </script>
    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  </body>

</html>