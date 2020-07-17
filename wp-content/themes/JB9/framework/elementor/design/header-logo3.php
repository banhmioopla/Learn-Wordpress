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
global $CORE, $userdata, $wpdb, $settings;
 
?>
<div class="header-2 ppt-header header-1 header-logo3 <?php if(isset($settings['class'])){ echo $settings['class']; } ?> <?php if(!isset($settings['sticky'])){ ?>no-sticky<?php } ?>">
   <div class="center-menu-2"  id="header-logo">
      <div class="container py-md-4">
         <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
               <div class="logo text-left pl-0" data-mobile-logo="<?php echo $GLOBALS['CORE_THEME']['logo_url']; ?>" data-sticky-logo="<?php echo $GLOBALS['CORE_THEME']['logo_url']; ?>">
                  <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
                  <?php echo hook_logo(0); ?>
                  </a>
               </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
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
               <form action="<?php echo get_home_url(); ?>/" method="get" name="" id="searchform1">
                  <input type="hidden" name="catid" value="" id="searchform1_catid" />
                  <div class="form-group mb-1">
                     <div class="input-group">
                        <div class="input-group-addon dropdown hidden-md-down">
                           <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="searchform_title"><?php echo __("Categories","premiumpress") ?></a>
                           <div class="dropdown-menu" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut" id="catselect">
                              <?php
                                 echo wp_list_categories( array(
                                 								'taxonomy'  	=> 'listing',
                                 								'depth'         => 1,	
                                 								'hierarchical'  => 1,		
                                 								'hide_empty'    => 0,
                                 								'echo'			=> false,
                                 								'title_li' 		=> '',
                                 								'show_count' 	=> 0,
                                 								'orderby' 		=> 'term_order',
                                 								'walker'		=> new walker_dropdown_categories_form,
                                 								 
                                 								) );
                                 
                                 ?>
                           </div>
                        </div>
                        <input type="text" class="form-control typeahead" name="s" value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" placeholder="<?php echo __("Search keyword...","premiumpress"); ?>">
                        <button><i class="fa fa-search text-dark"></i></button> 
                     </div>
                  </div>
               </form>
               <?php } ?>
            </div>
            <div class="col-lg-3 d-none d-lg-block text-center">
               
               
<div class="btn-group btn-lg mt-lg-2">
 
  
<?php if(!$userdata->ID){ ?>                 
                     <a href="<?php echo wp_login_url(); ?>" class="btn btn-secondary txt-light">
                     <span class="iconsmall"><i class="fa fa-lock"></i></span>
                   
                     <span class="text2"><?php echo __("Sign up/in here","premiumpress"); ?></span>  
                               
                     </a>
<?php }else{ ?>
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>" class="btn btn-secondary txt-light">
                     <span class="iconsmall"><i class="fa fa-user-circle "></i></span>
                     
                     <span class="text2"><?php echo __("My Account","premiumpress"); ?></span>
                   
                                  
                     </a>
<?php } ?> 

<?php if(_ppt(array('links','add')) != ""){ ?>
                     <a href="<?php echo _ppt(array('links','add')); ?>" class="btn btn-secondary txt-light">
                     <span class="iconsmall"><i class="fa fa-tag "></i></span>
                     
                     <span class="text2"><?php if(isset($settings['btn_txt'])){ echo $settings['btn_txt']; }else{ echo __("Add Listing","premiumpress"); } ?></span>
                   
                                  
                     </a>
<?php } ?> 
 
</div>
               
            </div>
         </div>
      </div>
   </div>
      <div class="burger-menu mt-3">
      <div class="line-menu line-half first-line"></div>
      <div class="line-menu"></div>
      <div class="line-menu line-half last-line"></div>
   </div>
</div>