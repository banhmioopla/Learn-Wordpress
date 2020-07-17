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
   
   global $CORE, $post, $userdata, $settings;
   
   ?><div id="widget-maindetails">
   <div class="widget-single">

<?php if(!isset($settings['show_desc']) || ( isset($settings['show_desc']) && $settings['show_desc'] == 1 ) ){ ?>
<div class="row">
<div class="col-md-9">
<h2 class="mb-4 h4 line"><?php echo __("Job Description","premiumpress") ?></h2>
</div>
<div class="col-md-3">
<div class="btn btn-info btn-block mb-2  rounded-0 float-right <?php echo get_post_meta($post->ID,'jobtype', true); ?>"><?php echo do_shortcode('[TYPE]'); ?></div>
</div>
</div>
<?php if( !isset($GLOBALS['flag-single']) ){ ?>
<div class="typography mb-5">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.
     Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>    
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.
     Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
</div>
<?php }else{ ?>
<div class="typography mb-5">
	<?php echo do_shortcode('[CONTENT media=0]'); ?>
    <?php echo do_shortcode('[FIELDS]'); ?>
    <?php echo do_shortcode('[TAGS class="mt-3"]'); ?>
</div>
<?php } ?>
<?php } ?>

<?php if(!isset($settings['show_r']) || ( isset($settings['show_r']) && $settings['show_r'] == 1 ) ){ ?>
<?php if(get_post_meta($post->ID,'responsibilities',true) != "" || defined('WLT_DEMOMODE')){ ?>
<h2 class="mb-4 h4 line"><?php echo __("Responsibilities","premiumpress") ?></h2>
<div class="typography mb-5">
 
    <?php if(defined('WLT_DEMOMODE') && $post->post_author == 1){ ?>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.
     Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>    
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.
     Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
    
    <?php }else{ ?>
    
    <?php echo wpautop(get_post_meta($post->ID,'responsibilities',true)); ?>
    
    <?php } ?>
</div>
<?php } ?>
<?php } ?>
<?php if(!isset($settings['show_q']) || ( isset($settings['show_q']) && $settings['show_q'] == 1 ) ){ ?>
<?php if(get_post_meta($post->ID,'qualifications',true) != "" || defined('WLT_DEMOMODE') ){ ?>
<h2 class="mb-4 h4 line"><?php echo __("Qualifications","premiumpress") ?></h2>
<div class="typography mb-5">

    <?php if(defined('WLT_DEMOMODE') && $post->post_author == 1){ ?>

    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.
     Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>    
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.
     Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
    
    <?php }else{ ?>
    
    <?php echo wpautop(get_post_meta($post->ID,'qualifications',true)); ?>
    
    <?php } ?>
</div>
<?php } ?>
<?php } ?>
<?php if(!isset($settings['show_l']) || ( isset($settings['show_l']) && $settings['show_l'] == 1 ) ){ ?>
<?php if(_ppt('google') == 1 && get_post_meta($post->ID,'map-country', true) != "" ){   ?>
<h2 class="mb-4 h4 line"><?php echo __("Location","premiumpress") ?></h2>
<?php echo do_shortcode('[GOOGLEMAP zoom=18]'); ?>
<p class="my-2 bg-white p-2 text-muted"><i class="fa fa-map-marker"></i> <?php echo do_shortcode('[LOCATION]'); ?></p>
<?php } ?> 
<?php } ?>


</div></div>
