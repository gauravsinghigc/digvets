  <section id="aa-slider" class="p-1r">
   <div class="aa-slider-area">
    <div id="sequence" class="seq">
     <div class="seq-screen">
      <ul class="seq-canvas">
       <?php
       $FetchSliders = FetchConvertIntoArray("SELECT * FROM sliders where SliderStatus='1' and SliderType='Website' and SliderLocations='HomePageWebsite' ORDER BY SliderId ASC", true);
       if ($FetchSliders != null) {
        foreach ($FetchSliders as $data) {
         if ($data->SliderOpenAt == "Same Page") {
          $target = "";
         } else {
          $target = "target='_blank'";
         } ?>
         <li>
          <a href="<?php echo $data->SliderTargetUrl; ?>">
           <div class="seq-model">
            <img data-seq src="<?php echo STORAGE_URL; ?>/sliders/<?php echo $data->SliderType; ?>/img/<?php echo $data->SliderImage; ?>" title="<?php echo $data->SliderName; ?>" alt="<?php echo $data->SliderName; ?>">
           </div>
           <div class="seq-title">
            <h3 data-seq><?php echo $data->SliderName; ?></h3>
            <p data-seq><?php echo SECURE($data->SliderDescriptions, "d"); ?></p>
           </div>
          </a>
         </li>
       <?php }
       } ?>
      </ul>
     </div>
     <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
      <a class="seq-prev" aria-label="Previous"><i class="fa fa-angle-left"></i></a> <a class="seq-next" aria-label="Next"><i class="fa fa-angle-right"></i></a>
     </fieldset>
    </div>
   </div>
  </section>
  <section class="container">
   <div class="row">
    <div class="col-md-12 p-1r text-center">
     <h2 class="web-title">View Latest</h2>
     <img src="<?php echo STORAGE_URL; ?>/default/tool-img/grass2.gif" class="web-title-img br10">
    </div>
   </div>
  </section>