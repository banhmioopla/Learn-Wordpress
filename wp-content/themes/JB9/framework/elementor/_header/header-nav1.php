<?php global $CORE, $userdata, $wpdb, $settings; ?>
<div class="elementor_header elementor_nav pptv9-header header-nav1 <?php 
if(isset($settings['transparent']) && $settings['transparent'] == 1){ ?> header-transparent-on <?php }
elseif(isset($settings['class'])){ echo $settings['class']." "; }
else{ ?> header-light <?php }
if(_ppt('header_borderbottom') == 1 ){ ?> border-bottom <?php }


if(isset($settings['shadow']) || _ppt('header_shadow') == 1 ){ ?> header-shadow <?php } ?> viewport-lg <?php 
?> no-sticky">
 
  <div class="clearfix">
      <div class="container">
      
         <nav class="pptv9-menu float-none text-left <?php if(_ppt('header_sep') == 1){?> separate-line<?php } ?>">
            <?php 
			$addon = menuaddondata();
               ob_start();	
               echo do_shortcode('[MAINMENU class="" style="1"]');
               $menu = ob_get_clean();                  
               echo str_replace("</ul>",  $addon."</ul>", $menu);
                
                ?>
         </nav>
         
        
				<div class="burger-menu">
					<div class="line-menu line-half first-line"></div>
					<div class="line-menu"></div>
					<div class="line-menu line-half last-line"></div>
				</div>
         
      </div> 
	</div>
    
 
</div>