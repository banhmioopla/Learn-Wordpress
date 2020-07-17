<?php global $CORE, $userdata, $wpdb, $settings;
 
?>
 
<div class="cpars5 <?php if(isset($settings['class'])){ echo $settings['class']; }else{ ?>bg-light<?php } ?>">
<div class="container"><div class="row">
<div class="col-md-8">

    <div class="p-xl-5"><div class="p-3 p-xl-5">
    <?php if(isset($settings['num'])){ if($settings['num'] != ""){ echo "<h6>".$settings['num']."</h6>"; } }else{ ?><h6>01 -</h6><?php } ?>
    <h2 class="mb-2 mb-lg-5"><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>NEW OFFICIAL WEBSITE<?php } ?></h2>
    
    <p class="p-sm mb-2 mb-lg-5"><?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></p>
    
   <a href="<?php if(isset($settings['btn_link']) && $settings['btn_link'] != ""){ echo $settings['btn_link']; }else{ echo home_url()."/?s="; }?>" class="<?php if(isset($settings['btn_class'])){ echo $settings['btn_class']; }else{ ?>btn btn-primary mt-3<?php } ?>">
				 <?php if(isset($settings['btn_txt']) && $settings['btn_txt'] != ""){ echo $settings['btn_txt']; }else{  echo __("Learn More","premiumpress");  } ?>
                 </a> 
    </div></div>                              

</div>
<div class="col-md-4 p-0 m-0 d-none d-md-block">
<img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/366x500.png?text=PremiumPress+Themes<?php } ?>" alt="<?php echo $settings['txt1']; ?>" class="img-fluid">
</div>

</div></div>
</div>