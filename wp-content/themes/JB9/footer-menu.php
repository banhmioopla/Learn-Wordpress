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
if (!defined('THEME_VERSION')) {	footer('HTTP/1.0 403 Forbidden'); exit; }

global $CORE, $userdata, $settings;
 
if(!_ppt_checkfile("footer-menu.php")){ 
 
	// FOOTER MENU
	$settings = array("class" => "bg-primary"); 
	get_template_part('framework/elementor/_footer/footer-top2'); 
	 
	$settings = array("class" => "bg-dark text-light border-top"); 
	get_template_part('framework/elementor/_footer/footer-bot1'); 
	
} ?>