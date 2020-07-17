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

global $CORE, $userdata, $wpdb, $settings;
	
	// BANNER + LOGO
	$settings = array('class' => _ppt('header_bg')." py-lg-3" );
	get_template_part('framework/elementor/_header/header-logo5'); 
	
	// MAIN NAV
	$settings = array('class' => _ppt('headernav_bg')  );	
	get_template_part('framework/elementor/_header/header-nav1'); 

?>