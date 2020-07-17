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

 
	if(!defined('IS_MOBILEVIEW') && _ppt(array('pageassign','homepage')) != "" && _ppt(array('pageassign','homepage')) != "0"){ 
			
			get_header($CORE->pageswitch()); 
			if( substr(_ppt(array('pageassign','homepage')),0,9) == "elementor"){
			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','homepage')),10,100)."']");
			}else{
			$thispage = get_page( _ppt(array('pageassign','homepage'))  );
			echo do_shortcode( $thispage->post_content );
			}
			get_footer($CORE->pageswitch());
			
	
	}elseif(!defined('IS_MOBILEVIEW') && is_numeric(_ppt('template_home_id')) && _ppt('template_home_id') != 0 ){
 	
		if(!_ppt_checkfile("home-"._ppt('template_home_id').".php")){ 
		
			get_header($CORE->pageswitch()); 			
			echo "error loading custom home page ("._ppt('template_home_id').")";		
			get_footer($CORE->pageswitch());
		}
 
	}else{
 
		if(!_ppt_checkfile("home.php")){ 
		
			get_template_part( 'templates/homepage', 'default' ); 
		
		} 

	}
 
?>