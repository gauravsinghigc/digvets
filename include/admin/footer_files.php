<?php include(__DIR__ . "/message.php"); ?>

<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/jquery-2.1.1.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/fast-click/fastclick.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/switchery/switchery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/nanoscrollerjs/jquery.nanoscroller.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/metismenu/metismenu.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/scripts.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/parsley/parsley.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/jquery-steps/jquery-steps.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/masked-input/bootstrap-inputmask.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/bootstrap-validator/bootstrapValidator.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/moment-range/moment-range.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/screenfull/screenfull.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/demo/wizard.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/demo/form-wizard.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/toggler.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/tag-it/tag-it.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/demo/form-component.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin-assets/js/demo/tables-datatables.js"></script>
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
 tagger(document.querySelector('[name="options"]'), {});
</script>
<script>
 function EnableInputFields() {
  var feildtype = document.getElementById("feildtype");
  if (feildtype.value === "ShortText") {
   document.getElementById("shorttext2").classList.remove("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("url2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "LongText") {
   document.getElementById("longtext2").classList.remove("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("url2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "EmailID") {
   document.getElementById("emailid2").classList.remove("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("url2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "Number") {
   document.getElementById("number2").classList.remove("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("url2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "PhoneNumber") {
   document.getElementById("phonenumber2").classList.remove("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("url2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "Address") {
   document.getElementById("address2").classList.remove("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("url2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "Url") {
   document.getElementById("url2").classList.remove("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "Image") {
   document.getElementById("url2").classList.add("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("image2").classList.remove("hidden");
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "File") {
   document.getElementById("file2").classList.remove("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "MultipleOptions") {
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("options2").classList.remove("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "Date") {
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.remove("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "DateTime") {
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.remove("hidden");
   document.getElementById("time2").classList.add("hidden");
  } else if (feildtype.value === "Time") {
   document.getElementById("file2").classList.add("hidden");
   document.getElementById("number2").classList.add("hidden");
   document.getElementById("emailid2").classList.add("hidden");
   document.getElementById("longtext2").classList.add("hidden");
   document.getElementById("shorttext2").classList.add("hidden");
   document.getElementById("phonenumber2").classList.add("hidden");
   document.getElementById("address2").classList.add("hidden");
   document.getElementById("image2").classList.add("hidden");
   document.getElementById("options2").classList.add("hidden");
   document.getElementById("date2").classList.add("hidden");
   document.getElementById("datetime2").classList.add("hidden");
   document.getElementById("time2").classList.remove("hidden");
  }
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