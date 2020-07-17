<?php global $CORE, $userdata, $wpdb, $settings; $addon = "";

?>
<nav class="header-nav1 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>
  <div class="clearfix">
      <div class="container">
         <nav class="ppt-menu float-none separate-line submenu-scale text-left">
        
         <nav class="ppt-menu float-none  text-left">
            <?php 
               ob_start();	
               echo do_shortcode('[MAINMENU class="" style="1"]');
               $menu = ob_get_clean();                  
               echo str_replace("</ul>",  $addon."</ul>", $menu);
                
                ?>
         </nav>
      </div> 
	</div>
</nav>