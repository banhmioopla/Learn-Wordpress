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
<nav class="elementor_header elementor_topmenu header-top1 style4 py-3 d-none d-md-block <?php if(isset($settings['class'])){ echo $settings['class']; } if(_ppt('header_topnavborderbottom') == 1 ){ ?> border-bottom <?php } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>
   <div class="container">
      <div class="row">
         <div class="col-lg-5">
            <ul class="clearfix mb-0">
               <li><span><?php echo __("Have any questions? ","premiumpress"); ?></span></li>
               <li class="ml-3"><span><?php echo _ppt(array('company','phone')); ?></span></li>
               <?php if(_ppt(array('links','contact')) != ""){ ?>
               <li><a href="<?php echo _ppt(array('links','contact')); ?>"><u><?php echo __("Contact  Us","premiumpress"); ?></u></a></li>
               <?php } ?>
            </ul>
         </div>
         <div class="col-lg-7 d-none d-lg-block">
            <div class="d-flex float-right">
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
                     <li class="dropdown"><span class="mr-2"><?php echo __("Currency","premiumpress"); ?>:</span> <span class="mr-3"><?php echo $CORE->_curreny_dropdown_menu(0); ?></span></li>
                     <?php } ?>
                  </ul>
               </div>
            </div>
      </div>
   </div>
</nav>