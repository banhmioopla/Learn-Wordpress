<?php global $CORE, $userdata, $wpdb, $settings;

?>
<nav class="header-nav1 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
  <div class="clearfix">
      <div class="container">
         <nav class="ppt-menu float-none separate-line submenu-scale text-left">
         <?php ob_start(); ?>
         
       
        
         <?php if(isset($settings['add_btn'])){ ?>
         
          <li class="float-lg-right">
            <a href="<?php if(!$userdata->ID){ ?><?php echo wp_login_url(); ?><?php }else{ ?><?php echo home_url(); ?>/?s=&favs=1<?php } ?>">
            <i class="fa fa-tag mr-2"></i>
            <?php if($settings['add_btn_txt']){ echo $settings['add_btn_txt']; }else{ echo __("Add Listing","premiumpress"); } ?>          
            </a> 
         </li>
         
         <?php } ?>
         
         <?php if(!isset($settings['hide_link_login'])){ ?>
         <li class="float-lg-right">
          
             <?php if(!$userdata->ID){ ?>
                     <a href="<?php echo wp_login_url(); ?>">
                     <i class="fa fa-user-circle mr-2"></i>
                     <?php echo __("Sign up/in","premiumpress"); ?>
                     </a>
                     <?php }else{ ?>
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>">
                     <i class="fa fa-user-circle mr-2"></i>
                     <?php echo __("My Account","premiumpress"); ?>
                     </a>
             <?php } ?>
                      
         </li>
         <?php } ?>
         
         <?php if(!isset($settings['hide_link_favs'])){ ?>
          <li class="float-lg-right">
            <a href="<?php if(!$userdata->ID){ ?><?php echo wp_login_url(); ?><?php }else{ ?><?php echo home_url(); ?>/?s=&favs=1<?php } ?>">
            <i class="fa fa-star mr-2"></i>
            <?php echo __("My Favorites","premiumpress"); ?>          
            </a> 
         </li>
         <?php } ?>
        
         
          <?php if( defined('WLT_CART') ){ ?>
          <li class="float-lg-right">
            <a href="<?php echo _ppt(array('links','cart')); ?>">
            <i class="fa fa-shopping-basket mr-2"></i>
            <?php echo __("Basket","premiumpress"); ?> (<span class="cart-basket-count"></span>)            
            </a> 
         </li>
          
          <?php } ?>
          
         
         
         <?php
            $addon = ob_get_clean();
                     ?>
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