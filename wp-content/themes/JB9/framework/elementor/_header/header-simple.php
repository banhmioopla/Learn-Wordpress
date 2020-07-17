<?php
   /* 
   * Theme: PREMIUMPRESS CORE FRAMEWORK FILE
   * Url: www.premiumpress.com
   * Author: Mark Fail
   *
   * THIS FILE WILL BE UPDATED WITH EVERY UPDATE
   * IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
   *
   * http://codex.wordpress.org/Child_Themes
   */
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   global $CORE, $userdata, $wpdb, $settings; $addon = "";
   
   
   
 
   ?>
   

	<div class="pptv9-header-overlay overlay-center-menu">
		<div class="container">

			
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

			
                <nav class="pptv9-menu-overlay">
					
                	<?php 
               ob_start();	
               echo do_shortcode('[MAINMENU class="" style="1"]');
               $image = ob_get_clean();
               	
               echo str_replace("</ul>",  $addon."</ul>", $image);
                
                ?> 
			 

				</nav>

			</div>

		</div>
	</div>