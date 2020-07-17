<?php
/*
Template Name: [BLANK PAGE - SIDEBAR RIGHT]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE;

$GLOBALS['flag-page'] = true;

// SIDEBAR
if(!defined('SIDEBAR')){
define('SIDEBAR', true);
}

get_header($CORE->pageswitch()); get_template_part( 'page', 'top' ); ?>
    
    <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
     
	 <?php get_template_part( 'page', 'content' ); ?>   
 	
<?php endwhile; endif; ?>

<?php get_template_part( 'page', 'bottom' ); get_footer($CORE->pageswitch()); ?>