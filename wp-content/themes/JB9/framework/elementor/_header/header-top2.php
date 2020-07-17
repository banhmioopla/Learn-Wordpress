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
<nav class="elementor_header elementor_topmenu header-top1 py-3 style2 d-none d-sm-block <?php if(isset($settings['class'])){ echo $settings['class']; } if(_ppt('header_topnavborderbottom') == 1 ){ ?> border-bottom <?php } ?>">
   <div class="container">
      <div class="row">
         <div class="col-12 <?php if(defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1){ ?>col-lg-6<?php } ?> px-0">                
            <?php echo do_shortcode('[MAINMENU topnav=1 class="clearfix mb-0 seperator"][/MAINMENU]'); ?>
         </div>
         <?php if(defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1){ ?>
         <div class="col-lg-6 d-none d-lg-block pr-0">
         
            <ul class="float-right clearfix mb-0">
            <?php if(_ppt('language_dropdown') == 1){ ?> 
               <li class="border-right px-3"><?php echo $CORE->_language_dropdown_menu(0); ?> </li>
               <?php } ?>
               <?php if(_ppt('currency_dropdown') == 1){ ?> 
                  <li class="border-right px-3"><?php echo $CORE->_curreny_dropdown_menu(0); ?></li>
                  <?php } ?>            
               <li class="px-3">
                  <?php if(!$userdata->ID){ ?>
                  <?php echo __("Welcome, Guest","premiumpress"); ?> ( <a href="<?php echo wp_login_url(); ?>"><u><?php echo __("Login","premiumpress"); ?></u></a> | 
                  <a href="<?php echo wp_registration_url(); ?>"><u><?php echo __("Register","premiumpress"); ?></u></a> )
                  <?php if(_ppt('social_facebook') == 1){ ?>
                  <a href="<?php echo wp_login_url(); ?>">
                  <img src="<?php echo get_template_directory_uri(); ?>/framework/img/facebooklogin.png" alt="facebook login" /> 
                  </a>
                  <?php } ?>
                  <?php }else{ ?>
                   
                  <a href="#" data-toggle="dropdown"><i class="fa fa-home mr-1"></i><span> <?php echo __("My Account","premiumpress"); ?></span></a> 
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> 
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>" class="dropdown-item"> <i class="fa fa-dashboard mr-3"></i> <?php echo __("My Dashboard","premiumpress"); ?></a>
                     <a href="<?php if(THEME_KEY == "da"){ 
                        $SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('".$userdata->ID."') LIMIT 1";				 
                        $query = $wpdb->get_results($SQL, OBJECT);
                        if(!empty($query)){
                        echo get_permalink($query[0]->ID);
                        }else{
                        echo "#";
                        }
                        
                        }elseif(_ppt('allow_profile') == 0){ echo "#"; }else{ echo get_author_posts_url( $userdata->ID ); } ?>" class="dropdown-item">
                     <i class="fa fa-user mr-3"></i> 
                     <span class="pr-2"><?php echo __("My Profile","premiumpress"); ?></span></a> 
                     <a class="dropdown-item" href="<?php echo _ppt(array('links','messages')); ?>?tab=msg&show=1"><i class="fa fa-inbox mr-3"></i>  <span class="pr-2"><?php echo __("My Messages","premiumpress"); ?></span></a> 
                     <a class="dropdown-item" href="<?php echo wp_logout_url(); ?>"><i class="fa fa-sign-out mr-3"></i>  <span class="pr-2"><?php echo __("Log out","premiumpress"); ?></span></a> 
                  </div>
               
                  <?php } ?> 
               </li>
            </ul>
           
         </div>
          <?php } ?>
      </div>
   </div>
</nav>