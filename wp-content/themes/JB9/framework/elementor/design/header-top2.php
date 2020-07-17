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
<nav class="header-top1 style2 d-none d-md-block">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
                
               <?php echo do_shortcode('[MAINMENU footer=1 class="clearfix mb-0"][/MAINMENU]'); ?>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
             
               <ul class="float-right clearfix mb-0">
                  <li><?php echo $CORE->_curreny_dropdown_menu(0); ?></li>
                  <?php if(_ppt('language_dropdown') == 1){ ?> 
                  <li><?php echo $CORE->_language_dropdown_menu(0); ?> </li>
                  <?php } ?>
                     <li>
                     <?php if(!$userdata->ID){ ?>
                     <a href="<?php echo wp_registration_url(); ?>">
                     <i class="fa fa-padlock"></i> &nbsp;  <?php echo __("Sign up/in","premiumpress"); ?>
                     </a>
                     <?php }else{ ?>
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>">
                     <i class="fa fa-user"></i> &nbsp; <?php echo __("My Account","premiumpress"); ?>
                     </a>
                     <?php } ?>
                  </li>
               </ul>
            </div>
         </div>
      </div>
</nav>