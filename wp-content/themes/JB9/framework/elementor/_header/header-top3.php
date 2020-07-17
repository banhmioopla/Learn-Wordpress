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
<nav class="elementor_header elementor_topmenu header-top1 style3 d-none d-md-block <?php if(isset($settings['class'])){ echo $settings['class']; } if(_ppt('header_topnavborderbottom') == 1 ){ ?> border-bottom <?php } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>
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
               <form action="<?php echo get_home_url(); ?>/" method="get" name="searchform" id="searchform">
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
            <div class="col-lg-9 d-none d-lg-block pr-lg-0 text-right">
             <?php echo do_shortcode('[MAINMENU topnav=1 class="clearfix mb-0 float-right pt-2 mt-1 seperator"][/MAINMENU]'); ?>               
            </div>
         </div>
      </div>
</nav>