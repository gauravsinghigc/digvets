<?php
//require 
require '../../../require/modules.php';
require '../../../require/web/sessionvariables.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Response | <?php echo APP_NAME; ?></title>
</head>

<body>
 <script>
  if (sessionStorage.getItem("PAY_STATUS") == "Paid") {
   window.location.href = "<?php echo DOMAIN; ?>/controller/ordercontroller.php?checkpayment=true&access_url=false";
  } else {
   window.location.href = "<?php echo DOMAIN; ?>/web/checkout/payment/";
  }
 </script>
</body>

</html>