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
   
   global $CORE;
  
   $GLOBALS['flag-page'] = true;
     
   get_header($CORE->pageswitch());
   
   get_template_part( 'page', 'top' );
   
   if (have_posts()) : while (have_posts()) : the_post(); 
   
   get_template_part( 'page', 'content' ); 
   
   endwhile; endif;
   
   get_template_part( 'page', 'bottom' );
   
   get_footer($CORE->pageswitch()); 
   
   ?>