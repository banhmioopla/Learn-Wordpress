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
   
   global $settings; 
   
   if(!_ppt_checkfile("widget-elementor.php")){
     
   if(isset($settings['element_id']) && is_numeric($settings['element_id']) ){
   
	   //if(isset($_GET['post']) && isset($_GET['action'])){
	   
	   //echo "Preview Unavailable";
	   
	   //}else{
	   
	   echo do_shortcode( "[premiumpress_elementor_template id='".$settings['element_id']."']");
	   
	   //}
   
   }
   
 
   ?>
   
 
   
<?php } ?>