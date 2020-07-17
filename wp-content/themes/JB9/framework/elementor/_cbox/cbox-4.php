<?php global $CORE, $userdata, $wpdb, $settings; ?>
 
<div class="cbox4 bg-light <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
          
        	<div class="inner">
        	 
            <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://www.premiumpress.com/_demoimages/microjob/4.jpg<?php } ?>" 
            alt="<?php if($settings['txt1'] != ""){ echo $settings['txt1']; }  ?>">
            
            <span>
                
                 <a href="<?php if(isset($settings['btn_link']) && $settings['btn_link'] != ""){ echo $settings['btn_link']; }else{ echo home_url()."/?s="; }?>" style="color:white; text-decoration:none;" class="ctitle_text">
				 <?php if(isset($settings['btn_link']) && $settings['btn_txt'] != ""){ echo $settings['btn_txt']; }else{ ?>Learn More<?php } ?>
                 </a>  
                
                </span>
            </div>
            <div class="cimage_link_content_content">
                <h4><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>Your Title Here<?php } ?></h4>
                <p><?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></p>
                
            </div>
</div> 