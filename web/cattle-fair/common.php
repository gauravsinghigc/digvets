<?php
if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
 <a href="<?php echo DOMAIN; ?>/web/cattle-fair/new/" onclick="showfrom()" class="btn btn-lg btn-success rounded add-button"><i class="fa fa-plus"></i> Register New Animals </a>
<?php } else { ?>
 <a href="#" onclick="showform()" class="btn btn-lg btn-primary rounded add-button"><i class="fa fa-lock"></i> Login to Register New Animal </a>
<?php } ?>