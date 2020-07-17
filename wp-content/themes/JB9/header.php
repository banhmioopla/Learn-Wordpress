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
if (!headers_sent()){ header('X-UA-Compatible: IE=edge'); }

  
global $CORE, $post, $userdata;  ?><!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!--[if lte IE 8 ]>
<html lang="en" class="ie ie8">
   <![endif]-->
   <!--[if IE 9 ]>
   <html lang="en" class="ie">
      <![endif]-->
      <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <!--[if IE]>
         <meta http-equiv="X-UA-Compatible" content="IE=edge" />
         <![endif]-->
         <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
         <?php wp_head();  ?> 
         <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
         <![endif]-->          
      </head>
      <body <?php body_class(); ?> <?php echo $CORE->ITEMSCOPE('webpage'); ?>>      
      
      	<?php do_action( "pptv9_after_body_open", $post ); ?>       
      
         <div id="ajax_page_top"></div>
         <div id="page">
        
         <?php do_action( "pptv9_after_inner_body_open", $post ); ?> 