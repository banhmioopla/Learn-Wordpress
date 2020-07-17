<?php global $CORE, $userdata, $wpdb, $settings; ?>
<div class="cbox2 text-center <?php if(isset($settings['class'])){ echo $settings['class']; } ?>"> 
 
  <a href="<?php echo $settings['btn_link']; ?>" class="cthumbnail">
            	<img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/350x250.png?text=PremiumPress+Themes<?php } ?>" alt="<?php echo $settings['txt1']; ?>" class="cimage img-fluid">
                </a>
  
  <h6  class="ctitle"><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></h6>
  
  <p class="ccontent" style="text-align:center;">
  
  <?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu.<?php } ?>
  
  
  
  </p>
  
<a href="<?php if(isset($settings['btn_link'])){ echo $settings['btn_link']; } ?>" class="cmore btn-primary"><?php if(isset($settings['btn_txt'])){ echo $settings['btn_txt']; }else{ ?>Read More<?php } ?></a>
</div>