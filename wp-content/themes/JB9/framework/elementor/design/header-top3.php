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
<nav class="header-top1 style3 d-none d-md-block <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>
      <div class="container">
         <div class="row">
            <div class="col-lg-3">
                 <?php if(THEME_KEY == "cp"){ ?>
               <form action="<?php echo get_home_url()."/"; ?>" method="get" name="searchform" id="searchform" class="mt-md-5 mt-lg-2">
                  <?php
                     // if($wp_query->found_posts > 0){ 
                      $al = array();
                     
                      if(isset($_GET['ft']) && is_array($_GET['ft']) ){
                      	foreach($_GET['ft'] as $key => $val ){ if(in_array($val, $al)){ continue; } $al[] = $val; ?>
                  <input type="hidden" name="ft[]" id="input-filter-<?php echo substr($val,0,2); ?>" value="<?php echo $val; ?>" />
                  <?php	
                     }
                     }                 
                     ?>
                  <div class="form-group mb-1">
                     <div class="input-group">
                        <input type="hidden" value="" id="ctype" />
                        <input type="text" class="form-control typeahead" name="s"value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" placeholder="<?php echo __("Search stores &amp; coupons...","premiumpress"); ?>" >
                        <button><i class="fa fa-search text-secondary"></i></button> 
                     </div>
                  </div>
               </form>
               <?php }else{ ?>
               <form action="<?php echo get_home_url(); ?>/" method="get" name="" id="searchform">
                  <input type="hidden" name="catid" value="" id="searchform1_catid" />
                  <div class="form-group mb-1">
                     <div class="input-group">
                    
                        <input type="text" class="form-control typeahead" name="s" value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" placeholder="<?php echo __("Search keyword...","premiumpress"); ?>">
                        <button><i class="fa fa-search text-dark"></i></button> 
                     </div>
                  </div>
               </form>
               <?php } ?>
            </div>
            <div class="col-lg-9 d-none d-lg-block  pr-lg-0">
              <ul class="float-right clearfix mb-0">
                  <li><?php echo $CORE->_curreny_dropdown_menu(0); ?></li>
                  <?php if(_ppt('language_dropdown') == 1){ ?> 
                  <li><?php echo $CORE->_language_dropdown_menu(0); ?> </li>
                  <?php } ?>
                     <li>
                     <?php if(!$userdata->ID){ ?>
                     <a href="<?php echo wp_registration_url(); ?>">
                     <?php echo __("Sign up/in","premiumpress"); ?>
                     </a>
                     <?php }else{ ?>
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>">
                    <?php echo __("My Account","premiumpress"); ?>
                     </a>
                     <?php } ?>
                  </li>
                  
                   <?php if(THEME_KEY == "sp" || ( isset($settings['basket']) && $settings['basket'] == 1 ) ){ ?>
         
         <li>        
         <a href="<?php echo _ppt(array('links','cart')); ?>">
        <?php echo __("Cart","premiumpress"); ?>
         </a>
         </li> 
         
         <li>        
         <a href="<?php echo _ppt(array('links','checkout')); ?>">
        <?php echo __("Checkout","premiumpress"); ?>
         </a>
         </li> 
         
         <?php } ?>
         <li>        
         <a href="<?php echo _ppt(array('links','contact')); ?>">
        <?php echo __("Contact Us","premiumpress"); ?>
         </a>
         </li> 
         
               </ul>
               
            </div>
         </div>
      </div>
</nav>