<?php
/*
Template Name: [PAGE - MEMBERSHIPS]
*/

global $wpdb, $post, $wp_query;

if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

if(!_ppt_checkfile("tpl-page-memberships.php")){
 	
   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?>


<div class="content-wrapper">
<?php get_template_part('templates/page-top', 'text' ); ?>   

<?php if(isset($_GET['expired'])){ ?>
<div class="alert alert-warning text-center">
   <h4 class="mb-3"><?php echo __("Membership Required","premiumpress"); ?></h4>
   <p><?php echo __("You must subscribe to one of our membership packages before you can add new listings.","premiumpress"); ?></p>
</div>
<?php } ?>


  
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>         
      <?php if(isset($_GET['noaccess'])){ ?>
      <div class="alert alert-info mb-5 rounded-0 text-center">
        <h4 class="font-weight-bold my-3 text-uppercase"><?php echo __("Whoops, Access Denied!","premiumpress"); ?></h4>
        <p class="lead"><?php echo __("Please upgrade to a different membership package.","premiumpress"); ?></p>        
      </div>
      <?php }else{ ?>         
      <?php } ?>         
         <?php if(strlen($post->post_content) > 3){ ?>
         
            <?php echo do_shortcode('[CONTENT]'); ?>
         
         <?php } ?>    
                   
         <?php get_template_part( hook_theme_folder( array('form', 'memberships', true) ) , 'memberships' ); ?>
         <?php endwhile; endif; ?> 
</div>
<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch());  } ?>