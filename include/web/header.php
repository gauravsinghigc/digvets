<header id="aa-header">
  <div class="aa-header-top">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-top-area">
            <div class="aa-header-top-left">
              <div class="cellphone">
                <a class="btn dropdown-toggle" href="<?php echo DOMAIN; ?>">
                  Welcome at <?php echo APP_NAME; ?>
                </a>
              </div>

              <div class="cellphone">
                <a class="btn dropdown-toggle" href="tel:<?php echo PRIMARY_PHONE; ?>">
                  <i class="fa fa-phone"></i> <?php echo PRIMARY_PHONE; ?>
                </a>
              </div>

              <div class="cellphone">
                <a class="btn dropdown-toggle" href="mailto:<?php echo PRIMARY_EMAIL; ?>">
                  <i class="fa fa-envelope"></i> <?php echo PRIMARY_EMAIL; ?>
                </a>
              </div>
            </div>

            <div class="aa-header-top-right">
              <div class="cellphone">
                <a class="btn dropdown-toggle" href="<?php echo DOMAIN; ?>/web/track/">
                  <i class="fa fa-map-marker text-success"></i> Track Order
                </a>
                <?php if (isset($_SESSION['LOGIN_CustomerId'])) { ?>
                  <a class="nav-list-option" href="#" onmouseover="Databar('account-options')">
                    <i class="fa fa-user"></i> <?php echo LOGIN_CustomerName; ?>
                  </a>
                  <div class="dropdown-bar" onmouseout="Databar('account-options')" id="account-options" style="display:none !important;">
                    <ul>
                      <?php include __DIR__ . '/account-nav.php'; ?>
                    </ul>
                  </div>
                <?php } else { ?>
                  <a class="btn dropdown-toggle" onmouseover="showform()" href="<?php echo DOMAIN; ?>/auth/web/login">
                    <i class="fa fa-sign-in text-danger"></i> Login & Register
                  </a>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="aa-header-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-bottom-area">
            <div class="aa-logo">
              <a href="<?php echo DOMAIN; ?>"><img src="<?php echo $MAIN_LOGO; ?>" alt="<?php echo APP_NAME; ?>" title="<?php echo APP_NAME; ?>" class="img-fluid"></a>
            </div>
            <div class="aa-cartbox">
              <a class="aa-cart-link" href="<?php echo DOMAIN; ?>/web/cart">
                <i class="cart-icon fa fa-shopping-cart text-color" style="color:#77933c !important;"></i>
                <span class="aa-cart-title">SHOPPING CART</span>
                <span class="aa-cart-notify">
                  <?php echo CartItems(); ?>
                </span>
              </a>

            </div>
            <!-- / cart box -->
            <!-- search box -->
            <div class="aa-search-box">
              <form action="">
                <input type="text" name="" id="" placeholder="Search here 'animal name' ">
                <button type="submit"><i class="fa fa-search"></i></button>
              </form>
            </div>
            <!-- / search box -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / header bottom  -->
</header>