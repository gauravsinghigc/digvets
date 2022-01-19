<div class="reg-form">
 <div class="" id="Authformlogo">
  <img src="<?php echo $MAIN_LOGO; ?>" class="w-pr-20">
  <a onclick="hideform()" class="btn btn-lg btn-danger rounded closed-fix-btn"><i class="fa fa-times"></i></a>
 </div>
 <div class="p-1" id="LoginArea">
  <form action="<?php echo DOMAIN; ?>/controller/authcontroller.php" method="POST">
   <?php FormPrimaryInputs(true); ?>
   <div class="row">
    <div class="col-md-12">
     <h3>Login into Account</h3>
    </div>
    <div class="form-group col-lg-8 col-md-8 col-12 text-left">
     <label class="text-left">Phone Number</label>
     <input type="phone" name="CustomerPhoneNumber" class="form-control p-2r" required="" placeholder="+91" value="">
    </div>
    <div class="form-group col-lg-8 col-md-8 col-12 text-left">
     <label class="text-left">Password</label>
     <input type="password" name="CustomerPassword" class="form-control p-2r" required="" placeholder="********" value="">
    </div>
   </div>
   <div class="row">
    <div class="form-group col-lg-4 col-md-4 col-12">
     <button class="btn btn-lg btn-success" name="WebLoginRequest"><i class="fa fa-lock text-white"></i> Secured Login</button>
    </div>
    <div class="form-group col-lg-4 col-md-4 col-12">
     <a href="<?php echo DOMAIN; ?>/auth/web/forget/" class="btn btn-lg text-grey">Forget Password?</a>
    </div>
   </div>
   <div class="row">
    <div class="col-md-12 text-center">
     <span class="btn btn-lg">Don't Have Account?</span> <a class="btn btn-lg btn-default" onclick="AuthAccess()">Create Account</a>
    </div>
   </div>
  </form>
 </div>
 <div class="p-1" id="SignupArea" style="display:none;">

  <form action="<?php echo DOMAIN; ?>/controller/authcontroller.php" method="POST">
   <?php FormPrimaryInputs(true); ?>
   <div class="row">
    <div class="col-md-12">
     <h3>Create An Account</h3>
    </div>
    <div class="col-md-12 text-left">
     <h5>Basic Information</h5>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-12 text-left">
     <label>Full Name</label>
     <input type="text" name="CustomerName" class="form-control" required="" placeholder="first last name" value="">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-12 text-left">
     <label>Email ID</label>
     <input type="email" name="CustomerEmailid" class="form-control" required="" placeholder="email@domain.ext" value="">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-12 text-left">
     <label>Phone Number</label>
     <input type="phone" name="CustomerPhoneNumber" class="form-control" required="" placeholder="+91" value="">
    </div>
   </div>
   <div class="row">
    <div class="col-md-12 text-left">
     <h5>Security <span id="passmsg"></span></h5>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-12 text-left">
     <label>Enter Password</label>
     <input type="password" name="CustomerPassword" oninput="checkpass()" id="pass1" class="form-control" required="" placeholder="*********" value="">
    </div>
    <div class="form-group col-lg-6 col-md-6 col-12 text-left">
     <label>Re-Enter Password</label>
     <input type="password" name="CustomerPassword2" oninput="checkpass()" id="pass2" class="form-control" required="" placeholder="*********" value="">
    </div>
    <div class="form-group col-lg-12 col-md-12 col-12 text-left">
     <input type="checkbox" name="accepttnc" value="true" required="">
     I agree <?php echo APP_NAME; ?>'s <a href="" class="text-primary">Terms & Conditions</a> and <a href="" class="text-primary">Privacy Policy</a>.
    </div>
    <div class="form-group col-lg-12 col-md-12 col-12 text-left">
     <button class="btn btn-lg btn-success disabled" id="passbtn" name="CreateAccount"><i class="fa fa-lock"></i> Create Account</button>
    </div>
   </div>
   <div class="row">
    <div class="col-md-12 text-center">
     <span class="btn btn-lg">Already Have an Account?</span> <a class="btn btn-lg btn-default" onclick="AuthAccess()">Login Now</a>
    </div>
   </div>
  </form>

 </div>
</div>