<?php
if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
 <a href="<?php echo DOMAIN; ?>/web/ai-workers/new/" onclick="showfrom()" class="btn btn-lg btn-success rounded add-button"><i class="fa fa-plus"></i> Register As AI Worker </a>
<?php } else { ?>
 <a href="#" onclick="showfrom()" class="btn btn-lg btn-primary rounded add-button"><i class="fa fa-lock"></i> Login to Register </a>
<?php } ?>