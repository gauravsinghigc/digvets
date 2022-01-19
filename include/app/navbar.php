<section class="bottom-fixed-bar">
  <div class="flex-s-b">
    <a href="<?php echo DOMAIN; ?>/app">
      <i class="fa fa-home"></i>
    </a>
    <a href="<?php echo DOMAIN; ?>/app/category/">
      <i class="fa fa-table"></i>
    </a>
    <a href="#" onclick="Databar('SearchBar')">
      <i class="fa fa-search"></i>
    </a>
    <a href="<?php echo DOMAIN; ?>/app/cart/">
      <i class="fa fa-shopping-basket"></i>
    </a>
    <a href="<?php echo DOMAIN; ?>/app/account">
      <i class="fa fa-user"></i>
    </a>
  </div>
</section>

<section class="searchbar" id="SearchBar">
  <section class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="flex-s-b">
          <h4 class="fs-23">Search Item</h4>
          <a href="#" onclick="Databar('SearchBar')">
            <i class="fa fa-times fs-23 text-danger m-t-10"></i>
          </a>
        </div>
      </div>
      <div class="col-md-12">
        <form action="">
          <input type="text" class="form-control search-input" tabindex="1" placeholder="Enter any category, item name...">
        </form>
      </div>
    </div>
  </section>
</section>