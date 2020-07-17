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
   
   global $CORE, $userdata, $wpdb, $settings;   ?>
<nav class="elementor_header elementor_topmenu header-top1 d-none d-sm-block <?php if(isset($settings['class'])){ echo $settings['class']; } 
   if(_ppt('header_topnavborderbottom') == 1 ){ ?> border-bottom <?php } 
   ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>
   <div class="container">
      <div class="row">
         <div class="<?php if(defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1){ ?>col-xl-7 col-lg-7 col-sm-6 col-7 d-sm-none d-lg-block<?php }else{ ?>col-12<?php } ?>">
            <div class="d-flex">
               <div class="clearfix d-sm-none d-md-block">
                  <div class="socials pr-3 border-right ">
                     <?php if(_ppt(array('social','twitter')) != ""){ ?>
                     <a class="social" target="_blank" href="<?php echo _ppt(array('social','twitter')); ?>" title="Twitter"><i class="fa fab <?php echo _ppt(array('social','twitter_icon')); ?>"></i></a>
                     <?php } ?>
                     <?php if(_ppt(array('social','facebook')) != ""){ ?>
                     <a class="social" target="_blank" href="<?php echo _ppt(array('social','facebook')); ?>" title="Facebook"><i class="fa fab <?php echo _ppt(array('social','facebook_icon')); ?>"></i></a>
                     <?php } ?>
                     <?php if(_ppt(array('social','dribbble')) != ""){ ?>
                     <a class="social" target="_blank" href="<?php echo _ppt(array('social','dribbble')); ?>" title="Google plus"><i class="fa fab <?php echo _ppt(array('social','dribbble_icon')); ?>"></i></a> 
                     <?php } ?>
                     <?php if(_ppt(array('social','linkedin')) != ""){ ?>
                     <a class="social" target="_blank" href="<?php echo _ppt(array('social','linkedin')); ?>" title="Dribbble"><i class="fa fab <?php echo _ppt(array('social','linkedin_icon')); ?>"></i></a>
                     <?php } ?>
                     <?php if(_ppt(array('social','skype')) != ""){ ?>
                     <a class="social" target="_blank" href="<?php echo _ppt(array('social','skype')); ?>" title="Skype"><i class="fa fab <?php echo _ppt(array('social','skype_icon')); ?>"></i></a>
                     <?php } ?>
                     <?php if(_ppt(array('social','youtube')) != ""){ ?>
                     <a class="social" target="_blank" href="<?php echo _ppt(array('social','youtube')); ?>" title="Skype"><i class="fa fab <?php echo _ppt(array('social','youtube_icon')); ?>"></i></a>  
                     <?php } ?>
                  </div>
               </div>
               <div class="clearfix">
                  <ul class="pl-3 border-left">
                     <?php if(_ppt('language_dropdown') == 1){ ?> 
                     <li class="select-country mr-2 border-right"><span class="mr-2"><?php echo __("Language","premiumpress"); ?>:</span> <span class="mr-3"><?php echo $CORE->_language_dropdown_menu(0); ?></span> </li>
                     <?php } ?>
                     <?php if(_ppt('currency_dropdown') == 1){ ?> 
                     <li class="dropdown mr-2 border-right"><span class="mr-2"><?php echo __("Currency","premiumpress"); ?>:</span> <span class="mr-3"><?php echo $CORE->_curreny_dropdown_menu(0); ?></span></li>
                     <?php } ?>
                  </ul>
               </div>
            </div>
         </div>
         <?php if(defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1){ ?>
         <div class="col-xl-5 col-lg-5 col-sm-12 col-5">
         
            <ul class="d-flex mb-0 float-right">
               <?php if(!$userdata->ID){ ?>
               <li class="mr-3 border-right pr-3"><a href="<?php echo wp_login_url(); ?>"><i class="fa fa-user mr-2"></i> <?php echo __("Login","premiumpress"); ?></a></li>
               <li class="mr-3">
                  <a href="<?php echo wp_registration_url(); ?>"><i class="fa fa-sign-in mr-2"></i> <?php echo __("Register","premiumpress"); ?></a>  
               </li>
               <?php if(_ppt('social_facebook') != 1){ ?>
               <li class="mr-3 border-left pl-2 d-sm-none d-md-block">
                  <a href="<?php echo wp_login_url(); ?>">
                  <img src="<?php echo get_template_directory_uri(); ?>/framework/img/facebooklogin.png" alt="facebook login" /> 
                  </a>
               </li>
               <?php } ?>
               <?php }else{ ?>
               <li class="dropdown">
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
               </li>
               <?php } ?> 
            </ul>
            
         </div>
         <?php } ?>
      </div>
   </div>
</nav>