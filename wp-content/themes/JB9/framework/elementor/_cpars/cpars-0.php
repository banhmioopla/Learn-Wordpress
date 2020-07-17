<?php global $CORE, $userdata, $wpdb, $settings; ?>

<div class="cpars0 <?php if(isset($settings['class'])){ echo $settings['class']; } ?> bg-dark">
<div class="container py-5">
<div class="row">

<div class="col-lg-6 hide-mobile hide-ipad">



<img class="img-fluid" src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/400x600.png?text=PremiumPress+Themes<?php } ?>" alt="<?php echo $settings['txt1']; ?>">

</div>
<div class="col-lg-6">

<div class="row">
<div class="inner col-lg-11 px-lg-5 py-lg-5 text-white mt-4 mt-md-0">

<h6 class="text-muted"><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>SUBHEADING<?php } ?></h6>

<h2 class="h2-xl"><?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>Features &amp; Benefits<?php } ?></h2>

<p class="p-lg mt-4"><?php if(isset($settings['txt3']) && $settings['txt3'] != ""){ echo $settings['txt3']; }else{ ?>Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.<?php } ?></p>
                                                
                                                <?php if(isset($settings['txt4']) && $settings['txt4'] != ""){ ?>
                                                                                          
                                                <p>
                                                     <?php if(isset($settings['txt4']) && $settings['txt4'] != ""){ echo $settings['txt4']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?>
                                                </p>
                                                <?php } ?>

<a href="<?php if(isset($settings['btn_link']) && $settings['btn_link'] != ""){ echo $settings['btn_link']; }else{ echo home_url()."/?s="; }?>" class="btn btn-outline-light p-3 px-lg-5 mt-4">
				 <?php if(isset($settings['btn_txt']) && $settings['btn_txt'] != ""){ echo $settings['btn_txt']; }else{  echo __("Learn More","premiumpress");  } ?>
</a> 
                 
                                                
   </div>                                         </div>

</div>

</div></div>
</div>