<?php global $CORE, $userdata, $wpdb, $settings; ?>
<div class="cbox3 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
	
    <div class="wcb_icon">
    	<i class="text-primary fa  <?php if(isset($settings['icon']) && $settings['icon'] != ""){ echo $settings['icon']; }else{ echo 'fa-camera-retro'; } ?>"></i>
    </div>
    
    <div class="wcb_title"><span><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></span></div>
    <div class="wcb_content">
    	<span><?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu.<?php } ?></span>
    </div>
      
</div>