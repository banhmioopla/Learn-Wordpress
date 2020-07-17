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
<div class="ppt-header header-1 header-logo4 <?php if(!isset($settings['sticky'])){ ?>no-sticky<?php } ?> <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
   <div class="container py-4">
      <div class="row">
         <div class="col-12 col-lg-7">
            <div class="logo text-left pl-0" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
               <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
               <?php echo hook_logo(0); ?>
               </a>
            </div>
         </div>
         <div class="col-12 col-lg-5">
            <?php if(THEME_KEY == "cp"){ ?>
            <form action="<?php echo get_home_url()."/"; ?>" method="get" name="searchform" id="searchform" class="mt-lg-3">
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
            <form action="<?php echo get_home_url(); ?>/" method="get" name="" <?php if(!isset($settings['searchformname'])){ ?>id="searchform1"<?php }else{ ?>name="<?php echo $settings['searchformname']; ?>" id="<?php echo $settings['searchformname']; ?>"<?php } ?>>
               <input type="hidden" name="catid" value="" id="searchform1_catid" />
               <div class="form-group mb-1">
                  <div class="input-group">
                     <div class="input-group-addon dropdown hidden-md-down">
                       
                       <?php if(!isset($settings['hide_categories'])){ ?>
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
                        <?php } ?>
                        
                     </div>
                     <input type="text" class="form-control typeahead" name="s" value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" placeholder="<?php echo __("Search keyword...","premiumpress"); ?>">
                     <button><i class="fa fa-search text-secondary"></i></button> 
                  </div>
               </div>
            </form>
            <?php } ?>
         </div>
      </div>
   </div>
   <div class="burger-menu mt-5">
      <div class="line-menu line-half first-line"></div>
      <div class="line-menu"></div>
      <div class="line-menu line-half last-line"></div>
   </div>
</div>