<?php global $CORE, $userdata, $wpdb, $settings; ?>

<div class="cpars1 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
<div class="content-fluid"><div class="row">

<div class="col-md-5">

<img class="scale-with-grid" src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/400x600.png?text=PremiumPress+Themes<?php } ?>" alt="<?php echo $settings['txt1']; ?>">

</div>
<div class="col-md-7">


<div class="inner px-5">
                                                <h6 class="small"><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>NEW OFFICIAL WEBSITE<?php } ?></h6>
                                                <h2><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>NEW OFFICIAL WEBSITE<?php } ?></h2>
                                                
                                               
                                                
                                                <hr class="no_line" style="margin: 0 auto 30px;">
                                                <p>
                                                   
                                                    <?php if(isset($settings['txt3']) && $settings['txt3'] != ""){ echo $settings['txt3']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?>
                                                </p>
                                                
                                                <?php if(isset($settings['txt4']) && $settings['txt4'] != ""){ ?>
                                                <hr class="no_line" style="margin: 0 auto 15px;">                                              
                                                <p>
                                                     <?php if(isset($settings['txt4']) && $settings['txt4'] != ""){ echo $settings['txt4']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?>
                                                </p>
                                                <?php } ?>
                                                 
                                                 
                                                 <a href="<?php if(isset($settings['btn_link']) && $settings['btn_link'] != ""){ echo $settings['btn_link']; }else{ echo home_url()."/?s="; }?>" class="btn btn-primary p-3 px-lg-5">
				 <?php if(isset($settings['btn_txt']) && $settings['btn_txt'] != ""){ echo $settings['btn_txt']; }else{  echo __("Learn More","premiumpress");  } ?>
                 </a> 
                 
                                                
                                            </div>

</div>

</div></div>
</div>