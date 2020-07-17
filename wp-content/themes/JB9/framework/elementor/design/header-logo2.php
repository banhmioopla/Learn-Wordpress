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

// MY FAVOURITES
$c2 = 0;
if($userdata->ID){

	// MY FAVOURITES
	$c2 = $CORE->user_favs_count();
}

?>
<div class="header-2 ppt-header header-1 header-logo2 <?php if(isset($settings['class'])){ echo $settings['class']; } ?> <?php if(!isset($settings['sticky'])){ echo "no-sticky"; } ?>">
   <div class="center-menu-2"  id="header-logo">
      <div class="container py-4">
         <div class="row">
            <div class="col-md-3">
               <div class="logo text-left pl-0" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
                  <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
                  <?php echo hook_logo(0); ?>
                  </a>
               </div>
            </div>
            <div class="col-md-5 d-none d-lg-block">
               <?php if(THEME_KEY == "cp"){ ?>
               <form action="<?php echo get_home_url()."/"; ?>" method="get" name="searchform" id="searchform" >
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
            <div class="col-md-4 d-none d-lg-block">
               <div class="hicons row float-right mt-1">
                  <div class="phonebox">
                     <?php if(!$userdata->ID){ ?>                 
                     <a href="<?php echo wp_login_url(); ?>" class="text-dark">
                     <span class="iconsmall"><i class="fa fa-lock text-primary"></i></span>
                     <span class="content mr-3">
                     <span class="text1 mb-1"><?php echo __("members area","premiumpress"); ?></span>
                     <span class="text2"><?php echo __("Sign up/in here","premiumpress"); ?></span>  
                     </span>              
                     </a>
                     <?php }else{ ?>
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>" class="text-dark">
                     <span class="iconsmall"><i class="fa fa-user-circle text-primary"></i></span>
                     <span class="content mr-3">
                     <span class="text1 mb-1"><?php echo __("My Account","premiumpress"); ?></span>
                     <span class="text2"><?php echo __("view dashboard","premiumpress"); ?></span> 
                     </span>               
                     </a>
                     <?php } ?>  
                  </div>
                  <a href="<?php if($userdata->ID){ ?><?php echo home_url(); ?>/?s=&favs=1<?php }else{ ?><?php echo site_url('wp-login.php?action=login', 'login_post'); ?><?php } ?>" class="mx-4 text-dark">
                     <div class="icon icon1"> 
                        <span class="count bg-secondary"><?php echo $c2; ?></span> 
                     </div>
                     <div class="small text-uppercase"><?php echo __("favorites","premiumpress"); ?></div>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
      <div class="burger-menu mt-5">
      <div class="line-menu line-half first-line"></div>
      <div class="line-menu"></div>
      <div class="line-menu line-half last-line"></div>
   </div>
</div>