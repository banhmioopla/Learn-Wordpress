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
    
   ?><div class="bg-primary py-5">
<div class="container text-white">
    <div class="row">
        <div class="col-md-8">
            <h1 class="mb-3"><?php echo do_shortcode('[TITLE]'); ?></h1>
            <p><?php echo do_shortcode('[LOCATION]'); ?></p>
        </div>
        <div class="col-md-4 text-right">
        
        
        <?php if(get_post_meta($post->ID,'aff_link',true) != ""){ ?>
        
        <a href="<?php echo get_post_meta($post->ID,'aff_link',true); ?>" rel="nofollow" target="_blank" class="btn btn-lg btn-light btn-block rounded-0 mt-4">
		<?php echo __("Apply Now","premiumpress") ?>
        </a>

        <?php }else{ ?>
        
        <form method="post" action="<?php echo _ppt(array('links','apply')); ?>">
        <input type="hidden" name="jb_action" value="apply"> 
        <input type="hidden" name="jbid" value="<?php echo $post->ID; ?>">                         
        <input type="hidden" name="jbaid" value="<?php echo $post->post_author; ?>">        
        <button class="btn btn-lg btn-light btn-block rounded-0 mt-4"><?php echo __("Apply Now","premiumpress") ?></button>        
        </form>
        
        <?php } ?>
        
      
        </div>
    </div>
</div>
</div>