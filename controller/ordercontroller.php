<?php

//require files
require '../require/modules.php';

//access_url 
if (isset($_REQUEST['access_url']) == null) {
 echo "<h1>ERROR</h1>
 <p>Invalid OUTPUT request is received!</p>
 <a href='../index.php'>Back to Root</a>";
 die();
} else {
 $access_url = $_REQUEST['access_url'];
}


//save item into cart
if (isset($_GET['id'])) {
 $CartProductId = SECURE($_GET['id'], "d");
 $CartProductSellPrice = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductSellPrice");
 $CartProductMrpPrice = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductMrpPrice");
 $CartProductWeight = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductWeight");
 $CartProductQty = 1;
 $CartDeviceInfo = IP_ADDRESS;
 $CartCreatedAt = date("d M, Y");
 $access_url = SECURE($_GET['access_url'], "d");
 $CartFinalPrice = (int)$CartProductSellPrice * (int)$CartProductQty;

 //if customer is login
 if (isset($_SESSION['LOGIN_CustomerId'])) {
  $CartCustomerId = $_SESSION['LOGIN_CustomerId'];
  //if customer is not login
 } else {
  $CartCustomerId = 0;
 }

 //save item into cart 
 $CheckIfItemsExits = CHECK("SELECT * FROM cartitems where CartDeviceInfo='$CartDeviceInfo' and CartCustomerId='$CartCustomerId' and CartProductId='$CartProductId'");
 if ($CheckIfItemsExits == true) {
  LOCATION("warning", "Item Already Exits", $access_url);
 } else {
  $SaveCartItems = SAVE("cartitems", ["CartFinalPrice", "CartProductId", "CartProductSellPrice", "CartProductMrpPrice", "CartProductWeight", "CartProductQty", "CartCustomerId", "CartDeviceInfo", "CartCreatedAt"]);
  RESPONSE($SaveCartItems, "Item Save into Cart Successfully!", "Unable to Save item into cart!");
 }

 //update cart quantity
} else if (isset($_POST['UpdateCartQuantity'])) {
 if ($_POST['UpdateCartQuantity'] == SECURE("true", "e")) {
  $CartItemsid = $_POST['CartItemsid'];
  $CartProductSellPrice = $_POST['CartProductSellPrice'];
  $CartProductQty = $_POST['CartProductQty'];
  $CartFinalPrice = (int)$CartProductSellPrice * (int)$CartProductQty;

  $save = UPDATE("UPDATE cartitems SET CartProductQty='$CartProductQty', CartFinalPrice='$CartFinalPrice' where CartItemsid='$CartItemsid'");
  RESPONSE($save, "Item quantity updated successfully!", "Unable to update quantity");
 } else {
  LOCATION("warning", "Unable to Update Product Quantity!", $access_url);
 }

 //delete cart
} else if (isset($_GET['deleteid'])) {
 $CartItemsid = SECURE($_GET['deleteid'], "d");
 $access_url  = SECURE($_GET['access_url'], "d");
 $Delete = DELETE("DELETE FROM cartitems where CartItemsid='$CartItemsid'");
 RESPONSE($Delete, "Item Deleted Successfully!", "Unable to delete cart items");

 //excute order from checkout and store value into the session
} elseif (isset($_POST['checkoutbutton'])) {
 $NetPayableAmount = $_POST['NetPayableAmount'];
 $TotalcartAmount = $_POST['TotalcartAmount'];
 $DeliveryCharges = $_POST['DeliveryCharges'];
 $chargename = $_POST['chargename'];

 //capture into session cart
 $_SESSION['NET_PAYABLE_AMOUNT'] = $NetPayableAmount;
 $_SESSION['TOTAL_CART_AMOUNT'] = $TotalcartAmount;
 $_SESSION['DELIVERY_CHARGES'] = $DeliveryCharges;
 $_SESSION['DELIVERY_CHARGES_NAME'] = $chargename;

 //url congrol
 $access_url = DOMAIN . "/web/checkout/";
 LOCATION("unknown", "Continue to checkout", $access_url);

 //save address
} elseif (isset($_POST['SaveAddress'])) {
 $CustomerAddressViewId = $_SESSION['LOGIN_CustomerId'];
 $CustomerAddressContactPerson = $_POST['CustomerAddressContactPerson'];
 $CustomerAddressAltPhone = $_POST['CustomerAddressAltPhone'];
 $CustomerAddressStreetAddress = SECURE($_POST['CustomerAddressStreetAddress'], "e");
 $CustomerAddressArea = $_POST['CustomerAddressArea'];
 $CustomerAddressCity = $_POST['CustomerAddressCity'];
 $CustomerAddressState = $_POST['CustomerAddressState'];
 $CustomerAddressPincode = $_POST['CustomerAddressPincode'];
 $CustomerAddressType = $_POST['CustomerAddressType'];
 $CustomerAddressGSTNo = $_POST['CustomerAddressGSTNo'];
 $CustomerAddressCountry = $_POST['CustomerAddressCountry'];

 $SaveAddress = SAVE("customeraddress", ["CustomerAddressCountry", "CustomerAddressViewId", "CustomerAddressStreetAddress", "CustomerAddressArea", "CustomerAddressCity", "CustomerAddressState", "CustomerAddressPincode", "CustomerAddressType", "CustomerAddressContactPerson", "CustomerAddressAltPhone", "CustomerAddressGSTNo"]);
 RESPONSE($SaveAddress, "Address Details Saved Successfully!", "Unable to save address details");

 //create order
} elseif (isset($_POST['CreateOrder'])) {
 //store common variable
 $_SESSION['PAYMENT_METHOD'] = $_POST['PAYMENT_METHOD'];
 $OrderPaymentMode = $_POST['PAYMENT_METHOD'];
 $OrderCreateDate = date("d M, Y");
 $OrderStatus = 1;
 $OrderPaymentAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
 $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
 $DeliveryCharges = $_SESSION['DELIVERY_CHARGES'];
 $NetPayableAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
 $OrderReferenceid = $_SESSION['OrderReferenceid'];
 $OrderBillingAddress = $_SESSION['BILLING_ADDRESS'];
 $OrderShippingAddress = $_SESSION['SHIPPING_ADDRESS'];
 $PaymentMode = $_POST['PAYMENT_METHOD'];

 //customer order id
 $FirstYear = date("Y");
 $LastYear = date("Y", strtotime("+1 Year"));
 $OrderNumber = (int)TOTAL("SELECT * FROM orders") + (int)1;
 $CustomOrderId = "$FirstYear-$LastYear/000$OrderNumber";

 //seprate payment type variables
 if ($PaymentMode == "Cash On Delivery") {
  $OrderPaymentName = "Cash On Delivery";
  $OrderPaymentDetails = "Cash";
  $OrderPaymentReferenceId = "Not Available";
  $OrderPaymentStatus = "Un Paid";
  $OrderPaymentDate = "Not Available";

  //create order for cash on delivery
  $CustomerId = $LOGIN_CustomerId;
  $OrderAmount = $_SESSION['TOTAL_CART_AMOUNT'];

  //order created
  $Save = SAVE("orders", ["OrderReferenceid", "OrderBillingAddress", "OrderShippingAddress", "CustomOrderId", "CustomerId", "OrderAmount", "DeliveryCharges", "NetPayableAmount", "OrderPaymentMode", "OrderCreateDate", "OrderStatus"]);
  $OrderId = FETCH("SELECT * FROM orders where CustomOrderId='$CustomOrderId'", "OrderId");
  $OrderRefId = $OrderId;

  //also store orders status
  $OrderStatusOrderId = $OrderId;
  $OrderStatus = "Order Placed";
  $OrderStatusCreatedAt = date("d M, Y");
  $OrderStatusDescriptions = "Order is Placed at $OrderCreateDate with Payment Mode: $OrderPaymentMode";
  $SaveDetails = SAVE("orderstatus", ["OrderStatusOrderId", "OrderStatus", "OrderStatusCreatedAt", "OrderStatusDescriptions"]);

  //payment stored
  $SavePaymentDetails = SAVE("order_payments", ["OrderRefId", "OrderPaymentName", "OrderPaymentAmount", "OrderPaymentMode", "OrderPaymentDetails", "OrderPaymentReferenceId", "OrderPaymentStatus", "OrderPaymentDate"]);

  //product saved into ordered products
  $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
  foreach ($CartItems as $Items) {
   $OrderOrderId = $OrderId;
   $OrderProProductId = $Items->CartProductId;
   $OrderProductName = $Items->ProductName;
   $OrderProductImage = $Items->ProductImage;
   $OrderProductCatName = $Items->ProCategoryName;
   $OrderProductSubCatName = $Items->ProSubCategoryName;
   $OrderProductBrandName = $Items->ProBrandName;
   $OrderProductSellPrice = $Items->CartProductSellPrice;
   $OrderProductMrpPrice = $Items->CartProductMrpPrice;
   $OrderProductQty = $Items->CartProductQty;
   $OrderProductSellAmount = $Items->CartFinalPrice;
   $OrderProductWeight = $Items->CartProductWeight;
   $OrderProductDescription = $Items->ProductDescriptions;
   $ProductRefernceCodes = $Items->ProductRefernceCode;
   $SaveItems = SAVE("ordered_products", ["ProductRefernceCodes", "OrderOrderId", "OrderProProductId", "OrderProductName", "OrderProductImage", "OrderProductCatName", "OrderProductSubCatName", "OrderProductBrandName", "OrderProductSellPrice", "OrderProductMrpPrice", "OrderProductQty", "OrderProductSellAmount", "OrderProductWeight", "OrderProductDescription"]);
  }

  //delete cart Items
  if ($SaveItems == true) {
   $DeleteItems = DELETE("DELETE from cartitems where CartCustomerId='$LOGIN_CustomerId'");
  }
  if ($DeleteItems == true) {
   $access_url = DOMAIN . "/web/done/";
  } else {
   $access_url = $access_url;
  }
  $CustomerEmailId = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerEmailid");
  $CustomerName = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerName");
  SENDMAILS("Order Placed #$CustomOrderId", "Dear $CustomerName", "$CustomerEmailId", "Your Order having Invoice No: $CustomOrderId and Order Amount Rs.$NetPayableAmount is placed successfully!<br>
  You can track, view invoice from here: 
  <br> Track Order :" . DOMAIN . "/web/track/?orderid=" . SECURE($OrderId, "e") . "<br>
  View Invoice :" . DOMAIN . "/web/invoices/?orderid=" . SECURE($OrderId, "e") . "<br>
  Print Invoice : " . DOMAIN . "/web/invoice/print.php?orderid=" . SECURE($OrderId, "e"));

  SENDMAILS("Order Received #$CustomOrderId", "Dear, " . APP_NAME, PRIMARY_EMAIL, "Order having Invoice No: $CustomOrderId and Order Amount Rs.$NetPayableAmount is Received!. Details are as follow.<br>
  You can track, view invoice from here: 
  <br> Track Order :" . DOMAIN . "/web/track/?orderid=" . SECURE($OrderId, "e") . "<br>
  View Invoice :" . DOMAIN . "/web/invoices/?orderid=" . SECURE($OrderId, "e") . "<br>
  Print Invoice : " . DOMAIN . "/web/invoice/print.php?orderid=" . SECURE($OrderId, "e"));

  RESPONSE($DeleteItems, "Order Placed Successfully!", "Unable to Process Order at the Moment");

  //online payment check
 } else if ($PaymentMode == "Online Payment") {

  //store variables
  $_SESSION['PAYMENT_METHOD'] = $_POST['PAYMENT_METHOD'];
  $OrderPaymentMode = $_POST['PAYMENT_METHOD'];
  $OrderCreateDate = date("d M, Y");
  $OrderStatus = 1;

  //customer order id
  $FirstYear = date("Y");
  $LastYear = date("Y", strtotime("+1 Year"));
  $OrderNumber = (int)TOTAL("SELECT * FROM orders") + (int)1;
  $CustomOrderId = "$FirstYear-$LastYear/000$OrderNumber";
  $CustomerPhone = FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerPhoneNumber");
  $CustomerEmailId = FETCH("SELECT * FROM customers where CustomerId='$LOGIN_CustomerId'", "CustomerEmailid");
  $CustomerName = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerName");

  //createon line session variable for online PAYMENT 
  $_SESSION['INITIATE_E_PAY'] = "Active";
  $_SESSION['CUSTOM_ORDER_ID'] = $CustomOrderId;
  $_SESSION['CUSTOMER_NAME'] = $CustomerName;
  $_SESSION['CUSTOMER_PHONE'] = $CustomerPhone;
  $_SESSION['CUSTOMER_EMAIL'] = $CustomerEmailId;
  $OrderPaymentAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
  $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
  $DeliveryCharges = $_SESSION['DELIVERY_CHARGES'];
  $NetPayableAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
  $OrderReferenceid = $_SESSION['OrderReferenceid'];
  $OrderBillingAddress = $_SESSION['BILLING_ADDRESS'];
  $OrderShippingAddress = $_SESSION['SHIPPING_ADDRESS'];

  header("location: ../web/checkout/payment/rzr-pay.php");
 }

 //save to cart
} elseif (isset($_POST['AddtoCart'])) {
 $CartProductId = $_POST['AddtoCart'];
 $package = $_POST['package'];

 if ($package == "default") {
  $CartProductSellPrice = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductSellPrice");
  $CartProductMrpPrice = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductMrpPrice");
  $CartProductWeight = FETCH("SELECT * FROM products where ProductId='$CartProductId'", "ProductWeight");
 } else {
  $ProductPackageId = SECURE($_POST['package'], "d");
  $CartProductSellPrice = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $CartProductId . "'", "ProductPackageSellPrice");
  $CartProductMrpPrice = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $CartProductId . "'", "ProductPackageMrp");
  $CartProductWeight = FETCH("SELECT * FROM product_packages where ProductPackageId='$ProductPackageId' and ProductProId='" . $CartProductId . "'", "ProductPackageName");
 }

 $CartProductQty = $_POST['qty'];
 $CartDeviceInfo = IP_ADDRESS;
 $CartCreatedAt = date("d M, Y");
 $CartFinalPrice = (int)$CartProductSellPrice * (int)$CartProductQty;

 //if customer is login
 if (isset($_SESSION['LOGIN_CustomerId'])) {
  $CartCustomerId = $_SESSION['LOGIN_CustomerId'];
  //if customer is not login
 } else {
  $CartCustomerId = 0;
 }

 //save item into cart 
 $CheckIfItemsExits = CHECK("SELECT * FROM cartitems where CartDeviceInfo='$CartDeviceInfo' and CartCustomerId='$CartCustomerId' and CartProductId='$CartProductId'");
 if ($CheckIfItemsExits == true) {
  LOCATION("warning", "Item Already Exits", $access_url);
 } else {
  $SaveCartItems = SAVE("cartitems", ["CartFinalPrice", "CartProductId", "CartProductSellPrice", "CartProductMrpPrice", "CartProductWeight", "CartProductQty", "CartCustomerId", "CartDeviceInfo", "CartCreatedAt"]);
  RESPONSE($SaveCartItems, "Item Save into Cart Successfully!", "Unable to Save item into cart!");
 }

 //update payment detailss
} else if (isset($_POST['updatepayments'])) {
 $OrderPayments = $_POST['OrderPayments'];
 $OrderId = $_SESSION['VIEW_ORDER_ID'];
 $OrderPayments = $_POST['OrderPayments'];
 $OrderPaymentName = $_POST['OrderPaymentName'];
 $OrderPaymentAmount = $_POST['OrderPaymentAmount'];
 $OrderPaymentMode = $_POST['OrderPaymentMode'];
 $OrderPaymentStatus = $_POST['OrderPaymentStatus'];
 $OrderPaymentDate = date("d M, Y", strtotime($_POST['OrderPaymentDate']));
 $OrderPaymentReferenceId = $_POST['OrderPaymentReferenceId'];
 $OrderPaymentDetails = $_POST['OrderPaymentDetails'];
 $OrderUpdateDate = date("d M, Y");

 $updatepayments = UPDATE("UPDATE order_payments SET OrderPaymentName='$OrderPaymentName', OrderPaymentAmount='$OrderPaymentAmount', OrderPaymentMode='$OrderPaymentMode', OrderPaymentDetails='$OrderPaymentDetails', OrderPaymentStatus='$OrderPaymentStatus', OrderPaymentReferenceId='$OrderPaymentReferenceId', OrderPaymentDate='$OrderPaymentDate' where OrderPayments='$OrderPayments'");
 $UpdateOrderds = UPDATE("UPDATE orders SET OrderUpdateDate='$OrderUpdateDate' where OrderId='$OrderId'");
 RESPONSE($UpdateOrderds, "Order Payment Details are updated Successully!", "Unable to Update Details");

 //update order status
} else if (isset($_GET['updateorder'])) {
 $updateorder = SECURE($_GET['updateorder'], "d");
 $status = (int)$_GET['status'];
 $status = $status++;
 $access_url = SECURE($_GET['access_url'], "d");
 $datetime = date("d M, Y h:m:a A");
 $OrderStatusCreatedAt = $datetime;
 $OrderUpdateDate = date("d M, Y");
 $inv = $_GET['inv'];
 $OrderStatusOrderId = $_SESSION['VIEW_ORDER_ID'];
 $OrderId = $OrderStatusOrderId;

 if ($status == 2) {
  $OrderStatus = "Accepted";
  $OrderStatus2 = 2;
  $OrderStatusDescriptions = "Order Accepted At $datetime having pay mode Cash on Delivery";
 } else if ($status == 3) {
  $OrderStatus = "Shipped";
  $OrderStatus2 = 3;
  $OrderStatusDescriptions = "Your Order having Invoice no: $inv is shipped today at $datetime";
 } else if ($status == 4) {
  $OrderStatus = "Out For Delivery";
  $OrderStatus2 = 4;
  $OrderStatusDescriptions = "Order Having Invoice No: $inv is Out for Delivery at $datetime, it will be at your door soon.";
 } else if ($status == 5) {
  $OrderStatus = "Delivered";
  $OrderStatus2 = 5;
  $OrderStatusDescriptions = "Your Order is Delivered today at $datetime";
 } else if ($status == 6) {
  $OrderStatus = "Cancelled";
  $OrderStatus2 = 6;
  $OrderStatusDescriptions = "Your order is Cancelled by the provider. to know more send your queries at " . PRIMARY_EMAIL;
 } else {
  LOCATION("info", "Order Already Delivered!", $access_url);
 }

 $Save = SAVE("orderstatus", ["OrderStatusOrderId", "OrderStatus", "OrderStatusCreatedAt", "OrderStatusDescriptions"]);
 $Update = UPDATE("UPDATE orders SET OrderStatus='$OrderStatus2', OrderUpdateDate='$OrderUpdateDate' where OrderId='$updateorder'");
 RESPONSE($Update, "Order Status Updated Successfully!", "Unable to Update Order Status");

 //create online payment orders
} else if (isset($_GET['checkpayment'])) {
 $OrderPaymentReferenceId = "<script>document.write(sessionStorage.getItem('TxnId'))</script>";
 $OrderPaymentName = "Online";
 $OrderPaymentDetails = "Online TxnID: $OrderPaymentReferenceId";
 $OrderPaymentReferenceId = "$OrderPaymentReferenceId";
 $OrderPaymentStatus = "Paid";
 $OrderPaymentDate = date("d M, Y");
 $OrderCreateDate = date("d M, Y");
 $OrderStatus = 1;
 $OrderPaymentAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
 $LOGIN_CustomerId = $_SESSION['LOGIN_CustomerId'];
 $DeliveryCharges = $_SESSION['DELIVERY_CHARGES'];
 $NetPayableAmount = $_SESSION['NET_PAYABLE_AMOUNT'];
 $OrderReferenceid = $_SESSION['OrderReferenceid'];
 $OrderBillingAddress = $_SESSION['BILLING_ADDRESS'];
 $OrderShippingAddress = $_SESSION['SHIPPING_ADDRESS'];
 $OrderPaymentMode = "Online";

 //create order for cash on delivery
 $CustomerId = $LOGIN_CustomerId;
 $OrderAmount = $_SESSION['TOTAL_CART_AMOUNT'];
 $CustomOrderId = $_SESSION['CUSTOM_ORDER_ID'];

 //order created
 $Save = SAVE("orders", ["OrderReferenceid", "OrderBillingAddress", "OrderShippingAddress", "CustomOrderId", "CustomerId", "OrderAmount", "DeliveryCharges", "NetPayableAmount", "OrderPaymentMode", "OrderCreateDate", "OrderStatus"]);
 $OrderId = FETCH("SELECT * FROM orders where CustomOrderId='$CustomOrderId'", "OrderId");
 $OrderRefId = $OrderId;

 //also store orders status
 $OrderStatusOrderId = $OrderId;
 $OrderStatus = "Order Placed";
 $OrderStatusCreatedAt = date("d M, Y");
 $OrderStatusDescriptions = "Order is Placed at $OrderCreateDate with Payment Mode: $OrderPaymentMode";
 $SaveDetails = SAVE("orderstatus", ["OrderStatusOrderId", "OrderStatus", "OrderStatusCreatedAt", "OrderStatusDescriptions"]);

 //payment stored
 $SavePaymentDetails = SAVE("order_payments", ["OrderRefId", "OrderPaymentName", "OrderPaymentAmount", "OrderPaymentMode", "OrderPaymentDetails", "OrderPaymentReferenceId", "OrderPaymentStatus", "OrderPaymentDate"]);

 //product saved into ordered products
 $CartItems = FetchConvertIntoArray("SELECT * FROM cartitems, products, pro_categories, pro_sub_categories, pro_brands where products.ProductCategoryId=pro_categories.ProCategoriesId and products.ProductSubCategoryId=pro_sub_categories.ProSubCategoriesId and products.ProductBrandId=ProBrandId and cartitems.CartProductId=products.ProductId and cartitems.CartCustomerId='$LOGIN_CustomerId'", true);
 foreach ($CartItems as $Items) {
  $OrderOrderId = $OrderId;
  $OrderProProductId = $Items->CartProductId;
  $OrderProductName = $Items->ProductName;
  $OrderProductImage = $Items->ProductImage;
  $OrderProductCatName = $Items->ProCategoryName;
  $OrderProductSubCatName = $Items->ProSubCategoryName;
  $OrderProductBrandName = $Items->ProBrandName;
  $OrderProductSellPrice = $Items->CartProductSellPrice;
  $OrderProductMrpPrice = $Items->CartProductMrpPrice;
  $OrderProductQty = $Items->CartProductQty;
  $OrderProductSellAmount = $Items->CartFinalPrice;
  $OrderProductWeight = $Items->CartProductWeight;
  $OrderProductDescription = $Items->ProductDescriptions;
  $ProductRefernceCodes = $Items->ProductRefernceCode;
  $SaveItems = SAVE("ordered_products", ["ProductRefernceCodes", "OrderOrderId", "OrderProProductId", "OrderProductName", "OrderProductImage", "OrderProductCatName", "OrderProductSubCatName", "OrderProductBrandName", "OrderProductSellPrice", "OrderProductMrpPrice", "OrderProductQty", "OrderProductSellAmount", "OrderProductWeight", "OrderProductDescription"]);
 }

 //delete cart Items
 if ($SaveItems == true) {
  $DeleteItems = DELETE("DELETE from cartitems where CartCustomerId='$LOGIN_CustomerId'");
 }
 if ($DeleteItems == true) {
  $access_url = DOMAIN . "/web/done/";
 } else {
  $access_url = $access_url;
 }
 $CustomerEmailId = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerEmailid");
 $CustomerName = FETCH("SELECT * FROM customers where CustomerId='$CustomerId'", "CustomerName");
 SENDMAILS("Order Placed #$CustomOrderId", "Dear $CustomerName", "$CustomerEmailId", "Your Order having Invoice No: $CustomOrderId and Order Amount Rs.$NetPayableAmount is placed successfully!<br>
  You can track, view invoice from here: 
  <br> Track Order :" . DOMAIN . "/web/track/?orderid=" . SECURE($OrderId, "e") . "<br>
  View Invoice :" . DOMAIN . "/web/invoices/?orderid=" . SECURE($OrderId, "e") . "<br>
  Print Invoice : " . DOMAIN . "/web/invoice/print.php?orderid=" . SECURE($OrderId, "e"));

 SENDMAILS("Order Received #$CustomOrderId", "Dear, " . APP_NAME, PRIMARY_EMAIL, "Order having Invoice No: $CustomOrderId and Order Amount Rs.$NetPayableAmount is Received!. Details are as follow.<br>
  You can track, view invoice from here: 
  <br> Track Order :" . DOMAIN . "/web/track/?orderid=" . SECURE($OrderId, "e") . "<br>
  View Invoice :" . DOMAIN . "/web/invoices/?orderid=" . SECURE($OrderId, "e") . "<br>
  Print Invoice : " . DOMAIN . "/web/invoices/print.php?orderid=" . SECURE($OrderId, "e"));

 RESPONSE($DeleteItems, "Order Placed Successfully!", "Unable to Process Order at the Moment");
}
