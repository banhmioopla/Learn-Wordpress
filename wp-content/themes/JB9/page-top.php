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

if(!_ppt_checkfile("page-top.php")){

global $CORE;

	// WORKOUT PAGE COLUMN LAYOUT
	$gg = "";
	if(is_page()){
	
	   $gg = get_post_meta($post->ID, 'pagecolumns', true);
	
		switch($gg){
			case "1": {
			define('PPTCOL-NONE', 1);
			} break;
			case "2": {
			define('PPTCOL-LEFT', 1);
			} break;
			case "3": {
			define('PPTCOL', 1);
			} break;
		}
	
	}
 
			 
	if($gg == "" && !isset($GLOBALS['flag-add']) && !isset($GLOBALS['flag-contact']) && !isset($GLOBALS['flag-account']) && !isset($GLOBALS['flag-aboutus']) ){
	
	
	switch(_ppt('page_columns')){
		case "1": {
			if(!defined('PPTCOL-NONE')){ define('PPTCOL-NONE', 1); }
		} break;
		case "2": {
			if(!defined('PPTCOL-LEFT')){ define('PPTCOL-LEFT', 1); }
		} break;
		case "3": {
			if(!defined('PPTCOL')){ define('PPTCOL', 1); }
		} break;
		default:{			
			// CHECK FOR THEME ADJUSTMENT
			if(defined('SIDEBAR-NONE')){			
				define('PPTCOL-NONE', 1);				
			}elseif(defined('SIDEBAR')){			
				define('PPTCOL', 1);
			}elseif(defined('SIDEBAR-LEFT')){			
				define('PPTCOL-LEFT', 1);
			}
			
		} break;
	}
 

}

?>   

 
<main id="main" class="py-4 py-md-5" <?php if( ( defined('PPTCOL-LEFT') || defined('PPTCOL') ) || defined('PPTCOL-NONE') ){ ?><?php } ?>>
 
   <div class="<?php if(defined('SEARCH-FLUID') && isset($GLOBALS['flag-search']) ){ ?>container-fluid<?php  }else{ ?>container<?php } ?>">   
   	 <?php 
	
	 
	 // NO PPTCOL
	 if(defined('PPTCOL-NONE')){
	 
	 ?>
     <div id="main-inner">
     <?php
	 
	 // LEFT PPTCOL
	 }elseif(defined('PPTCOL-LEFT')){ 
	  
		 get_template_part( 'sidebar', 'left-wrap-top-before' ); 
		 get_sidebar(); 
		 get_template_part( 'sidebar', 'left-wrap-top-after' ); 
	  
	 // RIGHT PPTCOL
	 }elseif(defined('PPTCOL')){ 
	 
	 	get_template_part( 'sidebar', 'wrap-top' ); 
	 
	 // EVERYHTING ELSE!
	 }else{
 	 	
		if(isset($GLOBALS['flag-search'])){
		
		// DO NOTHING
		 
		}else{
	 ?>

    <div class="page-content">
 
    <div class="page-content-body">
    <?php } ?>
    
    
<?php } ?>

<?php } ?>