<?php
//view msg
include(__DIR__ . "/message.php");
BacktoPrevious($access = true); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/web/js/jquery.smartmenus.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/web/js/jquery.smartmenus.bootstrap.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/sequence.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/sequence-theme.modern-slide-in.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/web/js/jquery.simpleGallery.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/web/js/jquery.simpleLens.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/web/js/slick.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/web/js/nouislider.js"></script>
<script src="<?php echo ASSETS_URL; ?>/web/js/custom.js"></script>
<script>
 //scroll acitivity
 window.onscroll = function() {
  myFunction();
 };
 var header2 = document.getElementById("header2");
 var sticky = header2.offsetTop;

 function myFunction() {
  if (window.pageYOffset > sticky) {
   header2.classList.add("fixed-top");
  } else {
   header2.classList.remove("fixed-top");
  }
 }
</script>
<script>
 function Databar(data) {
  databar = document.getElementById("" + data + "");
  if (databar.style.display === "block") {
   databar.style.display = "none";
  } else {
   databar.style.display = "block";
  }
 }
</script>

<script>
 function AuthAccess() {
  var SignupArea = document.getElementById("SignupArea");
  var LoginArea = document.getElementById("LoginArea");
  if (LoginArea.style.display === "none") {
   LoginArea.style.display = "block";
   SignupArea.style.display = "none";
  } else {
   LoginArea.style.display = "none";
   SignupArea.style.display = "block";
  }
 }
</script>
<script>
 function checkpass() {
  var pass1 = document.getElementById("pass1");
  var pass2 = document.getElementById("pass2");
  if (pass1.value === "") {

  } else {
   if (pass1.value === pass2.value) {
    document.getElementById("passbtn").classList.remove("disabled");
    document.getElementById("passmsg").classList.add("text-success");
    document.getElementById("passmsg").classList.remove("text-danger");
    document.getElementById("passmsg").innerHTML = "<i class='fa fa-check-circle-o'></i> Password Matched!";
   } else {
    document.getElementById("passmsg").classList.remove("text-success");
    document.getElementById("passmsg").classList.add("text-danger");
    document.getElementById("passbtn").classList.add("disabled");
    document.getElementById("passmsg").innerHTML = "<i class='fa fa-warning'></i> Password do not matched!";
   }
  }
 }
</script>
<script>
 window.addEventListener("load", function() {
  var formviewstatus = sessionStorage.getItem("formstatus");
  if (formviewstatus === "true") {
   document.getElementById("ViewForm2").style.display = "none";
   document.getElementById("Authformlogo").style.display = "none";
  } else {
   document.getElementById("ViewForm2").style.display = "block";
   document.getElementById("Authformlogo").style.display = "block";
  }
 });
</script>
<script>
 function hideform() {
  document.getElementById("ViewForm2").style.display = "none";
  document.getElementById("Authformlogo").style.display = "none";
  sessionStorage.setItem("formstatus", "true");
 }

 function showform() {
  document.getElementById("ViewForm2").style.display = "block";
  document.getElementById("Authformlogo").style.display = "block";
  sessionStorage.setItem("formstatus", "false");
 }
</script>
<script>
 uploadimage.onchange = evt => {
  const [file] = uploadimage.files
  if (file) {
   ImgPreview.src = URL.createObjectURL(file);
  }
 }
</script>

<script>
 uploadfile.onchange = evt => {
  const [file] = uploadfile.files
  if (file) {
   FilePreview.src = URL.createObjectURL(file);
  }
 }
</script>