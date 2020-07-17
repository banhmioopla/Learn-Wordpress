<?php global $CORE, $userdata, $wpdb, $settings; ?>

<div class="cta1 content-fluid py-5 <?php if(isset($settings['class']) && $settings['class'] != ""){ echo $settings['class']; }else{ ?>bg-light<?php } ?>" <?php if(isset($settings['img']) && $settings['img'] != ""){?>style="background:url('<?php echo $settings['img']; ?>') no-repeat; background-size: cover; background-position: center top; position: relative;"<?php }?>>
<div class="row">

    <div class="col-md-7">
    
    <div class="pl-5">
    <h3><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>Your own title goes here.<?php } ?></h3>
    
    <p class="mt-3">
    
   <?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>
   
   Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu.
   
   <?php } ?>
    
    </p>
    </div>
    
    </div>
    <div class="col-md-2">
    
    </div>
    
    <div class="col-md-3 text-center px-5">
    
    <a href="<?php if(isset($settings['btn_link']) 
	&& $settings['btn_link'] != ""){ echo $settings['btn_link']; }else{ echo _ppt(array('links','contact')); } ?>" 
    class="<?php if(isset($settings['btn_class']) && $settings['btn_class'] != ""){ echo $settings['btn_class']; }else{ ?>btn btn-lg btn-primary mt-3 btn-block rounded-0<?php } ?>">
	
    <?php if(isset($settings['btn_txt']) && $settings['btn_txt'] != ""){ echo $settings['btn_txt']; }else{ ?><?php echo __("Contact Us","premiumpress"); ?><?php } ?>
    
    </a> 
    
    </div>

</div>
</div>