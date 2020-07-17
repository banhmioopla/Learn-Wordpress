<?php global $CORE, $userdata, $wpdb, $settings; ?>
<div class="cpars3 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
   <div class="content-fluid">
      <div class="row">
         <div class="col-md-6">
            <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/700x500.png?text=PremiumPress+Themes<?php } ?>" alt="<?php echo $settings['txt1']; ?>" class="img-fluid rounded">
         </div>
         <div class="col-md-6">
            <div class="inner pl-lg-5">
               <h2><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{  ?>Headline<?php } ?></h2>
              
              
               <p class="my-4 lead">
			   <?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>
                  Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
                  <?php } ?>
               </p>
             
             
              <a href="<?php if(isset($settings['btn_link']) && $settings['btn_link'] != ""){ echo $settings['btn_link']; }else{ echo home_url()."/?s="; }?>" class="btn btn-lg rounded-0 btn-primary p-3 px-lg-5">
				 <?php if(isset($settings['btn_txt']) && $settings['btn_txt'] != ""){ echo $settings['btn_txt']; }else{  echo __("Learn More","premiumpress");  } ?>
                 </a> 
            </div>
         </div>
      </div>
   </div>
</div>