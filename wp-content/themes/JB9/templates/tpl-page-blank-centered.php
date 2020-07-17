<?php
/*
Template Name: [BLANK PAGE - CENTERED]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

define('SIDEBAR-NONE', 1);
 
global  $userdata, $CORE;
   
get_header($CORE->pageswitch()); get_template_part( 'page', 'top' );  ?>

	<?php hook_page_before(); ?>
    
    <?php if (have_posts()) : while (have_posts()) : the_post();  ?>    
         
      <?php the_content(); ?>
  
<?php hook_page_after(); ?>
	
<?php endwhile; endif; ?>

<?php get_template_part( 'page', 'bottom' );  get_footer($CORE->pageswitch()); ?>