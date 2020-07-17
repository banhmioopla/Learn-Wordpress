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
   
   global $CORE, $post; 
   
   ?>
<div class="card mb-4 bg-light" style="border:3px solid #fff;">
   <a href="<?php the_permalink(); ?>">
      <div class="social-card-header align-middle text-center" style="position:relative;">
         <div style=" height:150px; overflow:hidden;">
         
         <?php if(THEME_KEY == "cp"){ ?>
         <?php echo do_shortcode('[COUPONIMAGE link=0]'); ?>
         <?php }else{ ?>
         <?php echo do_shortcode('[IMAGE link=0]'); ?>
         <?php } ?>
            
         </div>
         <div class="content" style="position:absolute; top:120px; overflow:hidden; height:40px;  line-height:40px; color:#fff; width:100%; text-align:left; font-weight:bold; text-transform:uppercase; font-size:14px; background:#000;">
            <span class="pl-3"><?php the_title(); ?></span>
         </div>
      </div>
   </a>
   <div class="card-body text-center">
      <div class="row">
         <div class="col border-right">
            <span class="text-muted"><?php echo __("Views","premiumpress"); ?></span>
            <div class="font-weight-bold"><?php echo do_shortcode('[HITS]'); ?></div>
         </div>
         <div class="col">
            <span class="text-muted"><?php echo __("Likes","premiumpress"); ?></span>
            <div class="font-weight-bold"><?php echo do_shortcode('[LIKES]'); ?></div>
         </div>
      </div>
   </div>
</div>