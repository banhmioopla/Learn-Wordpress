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
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }  global $wpdb, $CORE;   
 
 
// INCLUDE POP-UP MEDIA BOX
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_style('thickbox'); 
 
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values"); 

$links = array();

if(isset($GLOBALS['admin_page_title']) && strlen($GLOBALS['admin_page_title']) > 1 ){

	$title = $GLOBALS['admin_page_title'];
	$sub = "<h4>".$GLOBALS['admin_page_subtitle']."</h4>";
	

}else{

switch($_GET['page']){

	case "15": {
	
		$title = "<strong class='txt700'>Design</strong> Setup";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;

	case "2": {
	
		$title = "<strong class='txt700'>Theme</strong> Configuration";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	case "3": {
	
		$title = "<strong class='txt700'>Email</strong> &amp; SMS";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	case "4": {
	
		$title = "<strong class='txt700'>Tool</strong>Box";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	case "5": {
	
		if(THEME_KEY == "da"){ 
			$title = "<strong class='txt700'>Profile</strong> Setup";		 
		}else{
			$title = "<strong class='txt700'>Listing</strong> &amp; Packages";
		}
		
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;			
	case "6": {
	
		$title = "<strong class='txt700'>Website</strong> Orders";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	
	case "13": {
	
		$title = "<strong class='txt700'>Report</strong> Center";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	case "18": {
	
		$title = "<strong  class='txt700'>Membership</strong> Packages";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	case "19": {
	
		$title = "<strong  class='txt700'>Advertising</strong>";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	case "20": {
	
		$title = "<strong class='txt700'>Payment</strong> &amp; Currency";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	case "cart": {
	
		$title = "<strong class='txt700'>Tax</strong> &amp; Shipping";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
	case "22": {
	
		$title = "<strong class='txt700'>Newsletter</strong> System";
		$sub = "<a href='".home_url()."' target='_blank'>Visit Website</a>";
	
	} break;
		
	default: {

		$title = "Welcome to <strong class='txt700'>".THEME_NAME."</strong>";
		$sub = "<h4>Version ".THEME_VERSION."</h4> ";
	
	} break;

}

}
 

?>
<script src="https://kit.fontawesome.com/5381299f20.js"></script>


<link href="<?php echo get_bloginfo('template_url')."/framework/"; ?>css/backup_css/css.bootstrap.css" rel="stylesheet">  
<link href="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>css/premiumpress1.css" rel="stylesheet">

<script src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>js/admin.js"></script> 

<script src="<?php echo get_bloginfo('template_url')."/framework/js/backup_js/"; ?>js.bootstrap.js"></script> 

<script src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>js/ajax.js"></script>
<script src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>js/admin-global.js"></script>

 


<div class="container formrow" id="premiumpress-page">

<div class="row welcometop mb-4">   
    <div class="col-8">
    <div id="pagetitle">
    <h1><?php echo $title; ?></h1>
    <?php echo $sub; ?>
    </div>
    </div>
	<div class="col-4 text-right">
    <div id="buttonarea" style="display:none;"></div>
    <div id="logoarea" style="display:visible;">
    <a href="https://www.premiumpress.com/?ref=<?php echo home_url(); ?>" target="_blank">
    <img src="https://www.premiumpress.com/wp-content/themes/PREMIUMPRESS3/template/newone/img/layout/logo.png" class="mt-5" />
    </a>
    </div>

    </div>
</div>