<?php global $CORE, $userdata, $wpdb, $settings; ?>
<div class="elementor_header elementor_logo pptv9-header <?php 
if(isset($settings['transparent']) && $settings['transparent'] == 1){ ?> header-transparent-on <?php if(_ppt('header_borderbottom_home') == 1){ echo "border-bottom"; } ?> <?php }
elseif(isset($settings['class'])){ echo $settings['class']." "; }
else{ ?> header-light <?php }
if(_ppt('header_borderbottom') == 1 && !isset($settings['transparent']) ){ ?> border-bottom <?php }
if(isset($settings['shadow']) || _ppt('header_shadow') == 1 ){ ?> header-shadow <?php } ?> viewport-lg <?php  
?> no-sticky">
   <div class="container py-lg-3">
      <div class="pptv9-header-container">
         <div class="logo" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
            <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
            <?php if(isset($settings['transparent']) && $settings['transparent'] == 1){  echo hook_logo(array(0,1)); }else{ echo hook_logo(0); } ?>
            </a>
         </div>
         <div class="burger-menu">
            <div class="line-menu line-half first-line"></div>
            <div class="line-menu"></div>
            <div class="line-menu line-half last-line"></div>
         </div>
         <nav class="pptv9-menu menu-caret submenu-top-border <?php if(_ppt('header_sep') == 1){?>separate-line<?php } ?>">
            <?php 
			
			$addon = menuaddondata();
               ob_start();	
               echo do_shortcode('[MAINMENU class="" style="1"]');
               $image = ob_get_clean();
               	
               echo str_replace("</ul>",  $addon."</ul>", $image);
                
                ?> 
         </nav>
      </div>
   </div>
</div>
