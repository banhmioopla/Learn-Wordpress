<?php
/*
Template Name: [BLANK PAGE]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE;

$GLOBALS['flag-page'] = true;

define('SIDEBAR-NONE', 1);
   
get_header($CORE->pageswitch()); get_template_part( 'page', 'top' );  ?>

	 
    
<?php if (have_posts()) : while (have_posts()) : the_post(); the_content(); endwhile; endif;   ?>
 
<?php get_template_part( 'page', 'bottom' );  get_footer($CORE->pageswitch()); ?>