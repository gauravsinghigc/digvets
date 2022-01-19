<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
 <!--Brand logo & name-->
 <!--================================-->
 <div class="navbar-header">
  <a href="<?php echo DOMAIN; ?>/admin" class="navbar-brand app-bg">
   <img src="<?php echo $MAIN_LOGO; ?>" class="brand-icon">
   <div class="brand-title">
    <span class="brand-text"><?php echo APP_NAME; ?></span>
   </div>
  </a>
 </div>
 <div id="mainnav">
  <div id="mainnav-menu-wrap" class="mainnav-lg">
   <div class="nano">
    <div class="nano-content">
     <ul id="mainnav-menu" class="list-group">
      <li class="list-header">Home</li>
      <li> <a href="<?php echo DOMAIN; ?>/admin/dashboard/"> <i class="fa fa-home"></i> <span class="menu-title"> Dashboard </span> </a> </li>
      <li class="list-header">Orders</li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/orders">
        <i class="fa fa-shopping-cart"></i>
        <span class="menu-title">
         Orders
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/transactions">
        <i class="fa fa-exchange"></i>
        <span class="menu-title">
         Transactions
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/invoices">
        <i class="fa fa-file-pdf-o"></i>
        <span class="menu-title">
         Invoices
        </span>
       </a>
      </li>

      <li class="list-header">Stores</li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/products">
        <i class="fa fa-table"></i>
        <span class="menu-title">
         Products
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/animals">
        <i class="fa fa-paw"></i>
        <span class="menu-title">
         Animals
        </span>
       </a>
      </li>

      <li class="list-header">Users</li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/doctors">
        <i class="fa fa-medkit"></i>
        <span class="menu-title">
         Doctors
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/ai-workers">
        <i class="fa fa-briefcase"></i>
        <span class="menu-title">
         AI Workers
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/customers">
        <i class="fa fa-users"></i>
        <span class="menu-title">
         Customers
        </span>
       </a>
      </li>

      <li class="list-header">Advance Settings</li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/configurations">
        <i class="fa fa-edit"></i>
        <span class="menu-title">
         Configurations
        </span>
       </a>
      </li>

      <li class="list-header">Website</li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/website/">
        <i class="fa fa-globe"></i>
        <span class="menu-title">
         Website & App
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/website/faqs">
        <i class="fa fa-question-circle"></i>
        <span class="menu-title">
         F&Qs
        </span>
       </a>
      </li>

      <li class="list-header">Reports</li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/reports">
        <i class="fa fa-print"></i>
        <span class="menu-title">
         Reports
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/enquiries">
        <i class="fa fa-info-circle"></i>
        <span class="menu-title">
         Enquiries
        </span>
       </a>
      </li>
      <li class="list-header">Activity & Logs</li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/activities/">
        <i class="fa fa-list"></i>
        <span class="menu-title">
         Activity Logs
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/activities/logins.php">
        <i class="fa fa-list"></i>
        <span class="menu-title">
         Login Logs
        </span>
       </a>
      </li>

      <li class="list-header">Profile</li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/profile">
        <i class="fa fa-user"></i>
        <span class="menu-title">
         Profile
        </span>
       </a>
      </li>
      <li>
       <a href="<?php echo DOMAIN; ?>/admin/logout.php">
        <i class="fa fa-sign-out"></i>
        <span class="menu-title">
         Logout
        </span>
       </a>
      </li>
      <br><br><br><br><br><br>
     </ul>

    </div>
   </div>
  </div>
  <!--================================-->
  <!--End menu-->
 </div>
</nav>