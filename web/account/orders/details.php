<?php

//page varibale
$PageName  = "Order Details";
$AccessLevel = "../../../";

//include required files here
require $AccessLevel . "require/modules.php";
require $AccessLevel . "require/web-modules.php";

//page actiticity
$PageSqls = "SELECT * FROM customers where CustomerId='" . LOGIN_CustomerId . "'";
if (isset($_GET['orderid'])) {
  $_SESSION['ORDER_ID'] = $_GET['orderid'];
  $Orderid = SECURE($_SESSION['ORDER_ID'], "d");
} else {
  $Orderid = SECURE($_SESSION['ORDER_ID'], "d");;
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
  <title><?php echo GET_DATA("CustomerName") ?> | <?php echo APP_NAME; ?></title>
  <?php include $AccessLevel . "/include/web/header_files.php"; ?>
</head>

<body>

  <body>

    <?php
    //header & loader
    include $AccessLevel . "include/web/loader.php";
    include $AccessLevel . "include/web/header.php";
    include $AccessLevel . "include/web/navbar.php";
    ?>
    <section class="container">
      <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-6 col-12">
          <h3>
            <i class="fa fa-user text-color"></i> My Account
            <i class="fa fa-angle-double-right"></i> My Orders
            <i class="fa fa-angle-double-right"></i> 00<?php echo $Orderid; ?>
          </h3>
          <a href="<?php echo DOMAIN; ?>/web/account/orders" class="btn btn-md fs-16 text-primary"><i class="fa fa-angle-left"></i> Back to Orders</a>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-12">
          <div class="p-3">
            <?php SEARCH_FORM([
              "OrderId" => "Search by Order Id",
              "OrderDate" => "Order date",
              "OrderAmount" => "Order Amount"
            ]); ?>
          </div>
        </div>
      </div>
    </section>

    <section class="container section">
      <div class="row">
        <div class="col-md-12 header-bg p-l-5 m-l-5">
          <h4>Order Status</h4>
        </div>
        <div class="col-md-12 m-t-10">
          <div class="row rows-2">
            <?php $OrderStatusFetch = FetchConvertIntoArray("SELECT * FROM orderstatus where OrderStatusOrderId='$Orderid'", true);
            if ($OrderStatusFetch == null) {
              NoCartItems("No Status Available");
            } else {
              foreach ($OrderStatusFetch as $status) { ?>
                <div class="col">
                  <div class="delivery-box">
                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/arrow.png" class="del-img">
                    <h4 class="m-b-1 m-t-0"><i class="fa fa-check-circle-o text-success"></i> <?php echo $status->OrderStatus; ?></h4>
                    <p class="fs-13 m-b-0">
                      <span class="text-grey"><i class="fa fa-calendar"></i> <?php echo $status->OrderStatusCreatedAt; ?></span><br>
                      <span><?php echo $status->OrderStatusDescriptions; ?></span>
                    </p>
                  </div>
                </div>
            <?php }
            } ?>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-12">
          <div class="row">
            <div class="col-md-12 header-bg">
              <h4 class="p-1r">Item Details</h4>
            </div>
          </div>
          <div class="row m-t-15">
            <?php
            $fetchItems = FetchConvertIntoArray("SELECT * FROM ordered_products where OrderOrderId='$Orderid' ORDER BY OrderProductId ASC", true);
            if ($fetchItems == null) {
              NoCartItems("No Item Found!");
            } else {
              foreach ($fetchItems as $Items) { ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-b-10">
                  <div class="cat-box">
                    <div class="flex-space-between">
                      <div class="item-detail-img">
                        <img src="<?php echo STORAGE_URL; ?>/products/pro-img/<?php echo $Items->OrderProductImage; ?>" class="w-100">
                      </div>
                      <div class="item-details-data">
                        <h5><?php echo $Items->OrderProductName; ?></h5>
                        <p class="text-grey fs-14">
                          <span><?php echo $Items->OrderProductWeight; ?></span><br>
                          <span><?php echo $Items->OrderProductBrandName; ?></span><br>
                          <span><?php echo $Items->OrderProductCatName; ?> | <?php echo $Items->OrderProductSubCatName; ?></span>
                          <br>
                          <span class="text-black">Rs.<?php echo $Items->OrderProductSellPrice; ?> x <?php echo $Items->OrderProductQty; ?> = Rs.<?php echo $Items->OrderProductSellAmount; ?>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
            <?php }
            } ?>
            <div class="col-md-12 header-bg text-right">
              <table class="table text-right">
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details">Total Amount </span>
                  </td>
                  <td>
                    <span class="cart-price">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderAmount"); ?></span>
                  </td>
                </tr>
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details">Delivery Charges </span>
                  </td>
                  <td>
                    <span class="cart-price">
                      <?php if (FETCH("SELECT * FROM orders where OrderId='$Orderid'", "DeliveryCharges") == "Free") {
                        echo "Free";
                      } else {
                        echo "Rs." . FETCH("SELECT * FROM orders where OrderId='$Orderid'", "DeliveryCharges");
                      }; ?>
                    </span>
                  </td>
                </tr>
                <tr align="right">
                  <td align="right" class="">
                    <span class="cart-details text-success net-price">Net Payable </span>
                  </td>
                  <td>
                    <span class="cart-price text-success net-price">Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?></span>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-6 col-12">
          <div class="row">
            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4>Shipping & Billing Address</h4>
            </div>
            <div class="col-md-12 m-t-10">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <div class="cat-box fs-13">
                    <h5 class="m-b-0"><b>Shipping Address</b></h5>
                    <?php echo SECURE(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderShippingAddress"), "d"); ?>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <div class="cat-box fs-13">
                    <h5 class="m-b-0"><b>Billing Address</b></h5>
                    <?php echo SECURE(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderBillingAddress"), "d"); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4>Order Details</h4>
            </div>
            <div class="col-md-12">
              <table class="table">
                <tr>
                  <th>InvoiceNo</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "CustomOrderId"); ?></td>
                </tr>
                <tr>
                  <th>OrderRefId</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderReferenceid"); ?></td>
                </tr>
                <tr>
                  <th>Order Date</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderCreateDate"); ?></td>
                </tr>
                <tr>
                  <th>Last Update At</th>
                  <td><?php echo ReturnValue(FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderUpdateDate")); ?></td>
                </tr>
              </table>
            </div>

            <div class="col-md-12 header-bg p-l-5 m-l-5">
              <h4>Payment Details</h4>
            </div>
            <div class="col-md-12">
              <table class="table">
                <tr>
                  <th>Net Payable Amount</th>
                  <td>Rs.<?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "NetPayableAmount"); ?></td>
                </tr>
                <tr>
                  <th>Payment Mode</th>
                  <td><?php echo FETCH("SELECT * FROM orders where OrderId='$Orderid'", "OrderPaymentMode"); ?></td>
                </tr>
                <tr>
                  <th>Payment Refid</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentReferenceId"); ?></td>
                </tr>
                <tr>
                  <th>Payment Details</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentDetails"); ?></td>
                </tr>
                <tr>
                  <th>Payment Date</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentDate"); ?></td>
                </tr>
                <tr>
                  <th>Payment Status</th>
                  <td><?php echo FETCH("SELECT * FROM order_payments where OrderRefId='$Orderid'", "OrderPaymentStatus"); ?></td>
                </tr>

              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container section">
      <div class="row">
        <div class="col-md-12 text-center">
          <center>
            <a href="<?php echo DOMAIN; ?>/web/invoices/?orderid=<?php echo SECURE($Orderid, "e"); ?>" target="_blank" class="btn btn-md btn-primary"><i class="fa fa-file-pdf-o"></i> View Invoice</a>
            <a href="<?php echo DOMAIN; ?>/web/invoices/print.php?orderid=<?php echo SECURE($Orderid, "e"); ?>" target="_blank" class="btn btn-md btn-danger"><i class="fa fa-print"></i> Print Invoice</a>
            <a href="<?php echo DOMAIN; ?>/web/track/?orderid=<?php echo SECURE($Orderid, "e"); ?>" target="_blank" class="btn btn-md btn-success"><i class="fa fa-map-marker"></i> Track Order</a>
          </center>
        </div>
      </div>
    </section>

    <?php include $AccessLevel . "include/web/footer.php"; ?>
    <?php include $AccessLevel . "include/web/footer_files.php"; ?>
  </body>

</html>