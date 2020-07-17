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
?>
<main id="main">
   <div class="container"> 
      <?php get_template_part( 'page', 'top' ); ?> 
      <?php the_content(); ?>
      <?php get_template_part( 'page', 'bottom' ); ?>  
   </div>
   <!-- end container -->
</main>
<!-- end main -->