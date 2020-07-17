<?php

global $settings;
 
?><div class="cbanner1 row">
      <div class="col-md-6 col-sm-12 item-left">
         <div class="banner-boder-zoom">
            <a href="<?php if(isset($settings['link1']) && $settings['link1'] != ""){ echo $settings['link1']; } ?>">
            <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ 
			echo $settings['img1']; }else{ ?>https://via.placeholder.com/570x185.png?text=PremiumPress+Themes<?php } ?>" alt="banner" class="img-fluid">
            </a>   
         </div>
      </div>
      <div class="col-md-6 col-sm-12 item-right">
         <div class="banner-boder-zoom">
            <a href="<?php if(isset($settings['link2']) && $settings['link2'] != ""){ echo $settings['link2']; } ?>"> 
            <img src="<?php if(isset($settings['img2']) && $settings['img2'] != ""){ 
			echo $settings['img2']; }else{ ?>https://via.placeholder.com/570x185.png?text=PremiumPress+Themes<?php } ?>" alt="banner" class="img-fluid">
            </a>    
         </div>
      </div>
   </div>
  
