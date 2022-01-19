<footer id="aa-footer">
 <!-- footer bottom -->
 <div class="aa-footer-top">
  <div class="container">
   <div class="row">
    <div class="col-md-12">
     <div class="aa-footer-top-area">
      <div class="row">
       <div class="col-md-3 col-sm-6">
        <div class="aa-footer-widget">
         <h3>Main Menu</h3>
         <ul class="aa-footer-nav">
          <li><a href="<?php echo DOMAIN; ?>/web/">Home</a></li>
          <li><a href="<?php echo DOMAIN; ?>/web/cattle-fair">Cattle fair</a></li>
          <li><a href="<?php echo DOMAIN; ?>/web/veterinary-doctors">Veterinary Doctors</a></li>
          <li><a href="<?php echo DOMAIN; ?>/web/ai-workers">AI Workers</a></li>
          <li><a href="<?php echo DOMAIN; ?>/web/store">Web Store</a></li>
         </ul>
        </div>
       </div>
       <div class="col-md-3 col-sm-6">
        <div class="aa-footer-widget">
         <div class="aa-footer-widget">
          <h3>Knowledge Base</h3>
          <ul class="aa-footer-nav">
           <li><a href="<?php echo DOMAIN; ?>/web/track">Track Orders</a></li>
           <li><a href="<?php echo DOMAIN; ?>/web/cart">My Shopping Cart</a></li>
           <li><a href="<?php echo DOMAIN; ?>/web/account">My Account</a></li>
           <li><a href="<?php echo DOMAIN; ?>/web/have-an-enquiry">Have an Enquiry</a></li>
           <li><a href="<?php echo DOMAIN; ?>/web/faqs">FAQs</a></li>
          </ul>
         </div>
        </div>
       </div>
       <div class="col-md-3 col-sm-6">
        <div class="aa-footer-widget">
         <div class="aa-footer-widget">
          <h3>Useful Links</h3>
          <ul class="aa-footer-nav">
           <li><a href="<?php echo DOMAIN; ?>/web/about-us">About Us</a></li>
           <li><a href="<?php echo DOMAIN; ?>/web/terms-and-conditions">Terms & Conditions</a></li>
           <li><a href="<?php echo DOMAIN; ?>/web/refund-and-cancellation">Refund & Cancellation</a></li>
           <li><a href="<?php echo DOMAIN; ?>/web/privacy-policy">Privacy Policy</a></li>
           <li><a href="<?php echo DOMAIN; ?>/web/contact-us">Contact Us</a></li>
          </ul>
         </div>
        </div>
       </div>
       <div class="col-md-3 col-sm-6">
        <div class="aa-footer-widget">
         <div class="aa-footer-widget">
          <h3>Contact Us</h3>
          <address>
           <p><?php echo SECURE(PRIMARY_ADDRESS, "d"); ?></p>
           <p><i class="fa fa-phone"></i> <?php echo PRIMARY_PHONE; ?></p>
           <p><i class="fa fa-envelope"></i> <?php echo PRIMARY_EMAIL; ?></p>
          </address>
          <div class="aa-footer-social">
           <a href="https://www.facebook.com/DigVetS" target="_blank"><i class="fa fa-facebook"></i></a>
           <a href="https://www.instagram.com/digvets" target="_blank"><i class="fa fa-instagram"></i></a>
           <a href="https://youtube.com/channel/UCX3nhnOx66U6L3wx0WgXefQ" target="_blank"><i class="fa fa-youtube"></i></a>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
 <!-- footer-bottom -->
 <div class="aa-footer-bottom">
  <div class="container">
   <div class="row">
    <div class="col-md-12">
     <div class="aa-footer-bottom-area">
      <p>Copyrighted &copy; <?php echo date("Y"); ?> By <?php echo APP_NAME; ?> | Developed & Managed by <a href="<?php echo DEVELOPER_URL; ?>" target="_blank"><?php echo DEVELOPED_BY; ?></a></p>
      <div class="aa-footer-payment">
       <i class="fa fa-cc-mastercard"></i>
       <i class="fa fa-cc-visa"></i>
       <i class="fa fa-paypal"></i>
       <i class="fa fa-cc-discover"></i>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</footer>
<!-- / footer -->

<?php if (!isset($_SESSION['LOGIN_CustomerId'])) { ?>
 <!-- signup form -->
 <section class="pop-form" id="ViewForm2" style="display:none;">
  <center>
   <?php include __DIR__ . "/auth-form.php"; ?>
  </center>
 </section>

<?php } ?>