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
   
   global $CORE, $post, $userdata;
   
   $desc = get_the_author_meta( 'description', $post->post_author);
    
   ?>
<div class="widget p-0" id="widget-companydetails" data-title="<?php echo __("Company Details","premiumpress") ?>">
   <div class="bg-dark p-3 text-center text-light shadow-sm">
      <i class="fa fa-mortar-board fa-2x my-2"></i>
      <h6><?php echo __("Company Details","premiumpress"); ?></h6>
   </div>
   <div class="widget-wrap">
      <div class="widget-block">
         <div class="widget-content p-5 text-center">
            <div class="text-center"> 
               <?php echo do_shortcode('[IMAGE link=0]'); ?>
            </div>
            <p class="my-4">
               <?php if(defined('WLT_DEMOMODE') && $desc == ""){ ?>
               Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. 
               <?php }else{ ?>
               <?php echo wpautop($desc); ?>
               <?php } ?>
            </p>
            <a href="<?php echo _ppt(array('links','myaccount')); ?>?u=<?php echo $post->post_author; ?>" class="btn btn-primary btn-block rounded-0 mt-4"><?php echo __("Contact Employer","premiumpress"); ?></a>
         </div>
      </div>
   </div>
</div>