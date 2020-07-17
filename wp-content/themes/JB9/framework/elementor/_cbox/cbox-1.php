<?php global $CORE, $userdata, $wpdb, $settings; ?>
<div class="cbox1 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">	
        <div class="cbox1_content" style="border-bottom:3px solid #090051;">
            <div class="cthumb">
            <?php if(isset($settings['btn_link'])){ ?><a href="<?php echo $settings['btn_link']; ?>"><?php } ?>
            	<img 
                src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/350x250.png?text=PremiumPress+Themes<?php } ?>" 
                alt="<?php echo $settings['txt1']; ?>" 
                class="img-fluid">
            <?php if(isset($settings['btn_link'])){ ?></a><?php } ?>
            </div>
            <div class="cdetails">
            	<div class="cdetails-icon"><i class="fa <?php if(isset($settings['icon']) && $settings['icon'] != ""){ echo $settings['icon']; }else{ ?>fa-music<?php } ?> text-dark"></i></div>
            	<h4><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></h4>
              <p><?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu.<?php } ?></p>
                <?php if(isset($settings['btn_link'])){ ?>
                <a href="<?php if(isset($settings['btn_link'])){ echo $settings['btn_link']; } ?>" class="btn btn-primary p-1 px-2"><?php if(isset($settings['btn_txt'])){ echo $settings['btn_txt']; }else{ ?><?php echo __("Read More","premiumpress"); ?><?php } ?></a>
                <?php } ?>
            </div>
        </div>
</div>