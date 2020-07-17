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

global $CORE, $userdata, $wpdb, $settings; ?>

<div class="elementor_header elementor_nav pptv9-header header-nav6 <?php if(isset($settings['no-sticky'])){ ?>no-sticky<?php } ?> <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>


   <div class="header-nav-inner center-menu-2"  id="header-menu">
   <div class="container" style=" position: relative;">
   
   	 
      <div class="block-nav-categori">
         <div class="block-title active">    
            <a href="javascript:void(0);" onclick="jQuery('.verticalmenu-content').toggle();" class="text-white">
            <i class="fa fa-bars mr-3"></i>        
            <span class="text"><?php echo __("Search By Category","premiumpress"); ?></span>
            </a>
         </div>
         <div class="verticalmenu-content">
            <?php
               $categories = wp_list_categories( array(
                       'taxonomy'  	=> 'listing',
                       'depth'         => 5,	
                       'hierarchical'  => true,		
                       'hide_empty'    => 0,
                       'echo'			=> false,
                       'title_li' 		=> '',
                        'orderby' 		=> 'term_order',
                        'walker'		=> new walker_shortcode_dcats,
                       'limit' 		=> 11,
                       ) ); 
               
               ?>
            <div class=" wlt_shortcode_dcats clearfix d-none d-md-block d-lg-block">
               <ul class="mb-0 sf-menu sf-vertical">
                  <?php echo $categories; ?>
               </ul>
            </div>
         </div>
      </div>
 
      <div class="box-header-nav">
         <nav class="pptv9-menu separate-line submenu-scale text-left">
         <?php ob_start(); ?>         
         <?php if(THEME_KEY == "sp" && _ppt('catalog_mode') != 1 ){ ?>
         <li class="float-right addon-btnend">
            <a href="<?php echo _ppt(array('links','cart')); ?>" class="btn rounded-0 mr-2 cartbtn">
            <?php echo __("Basket","premiumpress"); ?> (<span class="cart-basket-count"></span>)
            <span class="iconb"><i class="fa fa-shopping-basket  text-white"></i></span>
            </a> 
         </li>         
         <?php }elseif(THEME_KEY == "ct" && _ppt(array('links','add')) != "" ){ ?>
         <li class="float-right addon-btnend text-center">
            <a href="<?php echo _ppt(array('links','add')); ?>" class="btn rounded-0 mr-2">
            <i class="fa fa-map-pin mr-2"></i> <?php echo __("Post Advert","premiumpress"); ?>
            </a> 
         </li>    
         <?php }elseif( _ppt(array('links','add')) != "" ){ ?>
          <li class="float-right addon-btnend text-center">
            <a href="<?php echo _ppt(array('links','add')); ?>" class="btn rounded-0 mr-2">
            <i class="fa fa-tag mr-2"></i> <?php echo __("Add Listing","premiumpress"); ?>
            </a> 
         </li> 
         
         <?php } ?>
         <?php
            $addon = ob_get_clean();
         ?>
         <nav class="pptv9-menu  text-left">
            <?php 
               ob_start();	
               echo do_shortcode('[MAINMENU class="" style="1"]');
               $menu = ob_get_clean();                  
               echo str_replace("</ul>",  $addon."</ul>", $menu);
                
                ?>
         </nav>
      </div>
   </div>
</div>
</div>