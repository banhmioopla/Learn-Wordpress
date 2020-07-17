<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail1
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $userdata, $settings;

if(!_ppt_checkfile("header-menu.php")){  
	
	// DEFAULT HEADER DISPLAY
	$settings = array('class' => 'bg-dark' );
	get_template_part('framework/elementor/_header/header-top2'); 	
		
	$settings = array("class" 		=> "border-bottom border-top bg-white");	 
	get_template_part('framework/elementor/_header/header-logo1'); 

} ?>