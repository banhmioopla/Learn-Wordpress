<?php global $CORE, $userdata, $wpdb, $settings;
   ?>
<div class="header-nav3 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
<div class="container">
   <div class="row">
      <div class="col-md-9 col-lg-10">
         <nav class="ppt-menu float-none text-left <?php if(isset($settings['nav_class'])){ echo $settings['nav_class']; } ?>">
            <?php echo do_shortcode('[MAINMENU class="" style="1"]'); ?>
         </nav>
      </div>
      <div class="col-md-3 col-lg-2 btn-end  d-none d-md-block">        
         <a href="<?php echo _ppt(array('links','add')); ?>" 
         class="<?php if(isset($settings['btn_class'])){ echo $settings['btn_class']; }else{ ?>btn font-weight-bold mt-2<?php } ?>">
		 <?php if(isset($settings['btn_txt'])){ echo $settings['btn_txt']; }else{ echo __("Add Listing","premiumpress"); } ?>
         </a>
      </div>
   </div>
</div>
</div>