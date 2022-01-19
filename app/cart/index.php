<?php

//page varibale
$PageName  = "Shopping Cart";
$Pagename = $PageName;
$AccessLevel = "../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//page actiti
$Dcchargename = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "Dcchargename");
$dccartamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dccartamount");
$dcchargeamount = FETCH("SELECT * FROM deliverycharges where deliverychargesid='1'", "dcchargeamount");

//OrderReferenceid
$_SESSION['OrderReferenceid'] = date("d/m/y/") . rand(000000, 99999999);
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
  <?php include $AccessLevel . "/include/app/header_files.php"; ?>
</head>

<body>

  <body>

    <?php
    //header & loader
    include $AccessLevel . "include/app/header-nav.php";
    include $AccessLevel . "include/app/navbar.php";
    ?>

    <section class="container section">
      <div class="row">
        <div class="col-md-12">
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
                <div class="cat-box cat-box-3">
                  <span class="cartitemplus"><i class="fa fa-plus"></i></span>
                  <a href="<?php echo DOMAIN; ?>/web/store/details/?view=<?php echo SECURE($CartProducts->ProductId, "e"); ?>">
                    <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $CartProducts->ProductImage; ?>" alt="<?php echo $CartProducts->ProductName; ?>" title="<?php echo $CartProducts->ProductName; ?>" class="w-100 cart-item-image">
                  </a>
                  <h5 class="text-center lg-1-10"><b><?php echo $CartProducts->ProductName; ?></b></h5>
                  <p class="lh-1-5 fs-14">
                    <span class="text-grey"><?php echo $CartProducts->ProBrandName; ?></span>
                    <span class="flex-space-evenly">
                      <span><i class="fa fa-paw text-danger"></i> <?php echo $CartProducts->ProSubCategoryName; ?></span>
                      <span><i class="fa fa-shopping-basket text-info fs-13"></i> <?php echo $CartProducts->ProductWeight; ?></span>
                    </span>
                    <hr class="m-t-2 m-b-2">
                    <span class="flex-space-between">
                      <span class="text-black">Rs.<?php echo $CartProducts->ProductSellPrice; ?> </span>
                      <span class="text-black"> x
                        <?php echo $CartProducts->CartProductQty; ?>
                      </span>
                      <span class="text-danger">
                        = <span>Rs.<?php echo $CartProducts->CartFinalPrice; ?></span>
                      </span>
                    </span>
                  </p>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                      <form action="../../controller/ordercontroller.php" method="POST" class="add-to-cart-options">
                        <input type="text" name="CartItemsid" value="<?php echo $CartProducts->CartItemsid; ?>" hidden="">
                        <input type="text" name="CartProductSellPrice" value="<?php echo $CartProducts->CartProductSellPrice; ?>" hidden="">
                        <input type="text" name="UpdateCartQuantity" hidden="" value="<?php echo SECURE('true', 'e'); ?>">
                        <?php FormPrimaryInputs(true); ?>
                        <div class="flex-space-between">
                          <label class="p-1 qtypadinng">Qty</label>
                          <select name="CartProductQty" class="form-control" required="" onchange="form.submit()">
                            <?php
                            $StartValue = MIN_ORDER_QTY;
                            while ($StartValue <= MAX_ORDER_QTY) {
                              if ($StartValue == $CartProducts->CartProductQty) {
                                $selected = "selected=''";
                              } else {
                                $selected = '';
                              } ?>
                              <option value="<?php echo $StartValue; ?>" <?php echo $selected; ?>><?php echo $StartValue; ?></option>
                            <?php $StartValue++;
                            } ?>
                          </select>
                        </div>
                      </form>
                      <center>
                        <a onmouseover="Display()" href="<?php echo DOMAIN; ?>/controller/ordercontroller.php?deleteid=<?php echo SECURE($CartProducts->CartItemsid, 'e'); ?>&access_url=<?php echo SECURE(GET_URL(), "e"); ?>" class="btn btn-sm text-danger text-center"><i class="fa fa-times"></i> Remove</a>
                      </center>
                      <script>

                      </script>
                    </div>
                  </div>

                </div>
              </div>
            <?php }
            ?>
        </div>

        <div class="col-md-12 header-bg text-right">
          <table class="table text-right">
            <tr align="right">
              <td align="right" class="">
                <span class="cart-details">Cart Total </span>
                <span class="cart-price">Rs.<?php echo TotalCartPrice(); ?></span>
              </td>
            </tr>
            <tr align="right">
              <td align="right" class="">
                <span class="cart-details"><?php echo $Dcchargename; ?> </span>
                <span class="cart-price"><?php echo ChargesCartAmount($dccartamount, $dcchargeamount); ?></span>
              </td>
            </tr>
            <tr align="right">
              <td align="right" class="">
                <span class="cart-details text-success net-price">Net Payable </span>
                <span class="cart-price text-success net-price">Rs.<?php echo FinalCartAmount(); ?></span>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-md-12 text-right p-t-10">
          <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
            <form class="form bg-white" action="../../controller/ordercontroller.php" method="POST">
              <?php FormPrimaryInputs(true); ?>
              <input type="text" name="NetPayableAmount" value="<?php echo FinalCartAmount(); ?>" hidden="">
              <input type="text" name="TotalcartAmount" value="<?php echo TotalCartPrice(); ?>" hidden="">
              <input type="text" name="chargename" value="<?php echo $Dcchargename; ?>" hidden="">
              <input type="text" name="DeliveryCharges" value="<?php echo ChargesCartAmount($dccartamount, $dcchargeamount); ?>" hidden="">
              <button class="btn btn-lg btn-primary" name="checkoutbutton">Checkout</button>
            </form>
          <?php } else { ?>
            <a onclick="showform()" class="btn btn-lg btn-success">Login to Checkout</a>
          <?php } ?>
        </div>
      <?php } ?>
      </div>
    </section>

    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  </body>

</html>