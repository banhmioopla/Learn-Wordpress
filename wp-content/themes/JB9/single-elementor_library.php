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

 
define('NOHEADERFOOTER', true);
  
get_header($CORE->pageswitch()); ?>
 
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
         
        <?php hook_single_before(); ?>
          
            <?php the_content(); ?> 
         
        <?php hook_single_after(); ?>
        
    <?php endwhile; endif; ?>
	 
<?php get_footer($CORE->pageswitch()); ?>