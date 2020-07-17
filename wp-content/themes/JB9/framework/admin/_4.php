<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
// LOAD IN MAIN DEFAULTS
$core_admin_values = get_option("core_admin_values"); 
 
// LOAD IN OPTIONS FOR SORTING DATA
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );

	 
// CREATE CHILD THEME
if(!defined('WLT_DEMOMODE') && current_user_can('administrator') && isset($_POST['dsample'])  ){
		 
		$uploads = wp_upload_dir();
		  	
		//1. INCLUDE ZIP FEATURE
		include(TEMPLATEPATH."/framework/new_class/class_pclzip.php");
		$uploads = wp_upload_dir();
		$template_name = "childtheme_".str_replace(" ","_",strip_tags($_POST['name']));		  
		  
		// 2. REMOVE OLD FILES
		if (file_exists($uploads['path']."/".$template_name.".zip")) {
			@unlink($uploads['path']."/".$template_name.".zip"); 
		}
		   
		// 3. CREATE NEW STYLE.CSS
		$cssContent = "/*
		Theme Name: ".strip_tags($_POST['name'])."
		Theme URI: http://www.premiumpress.com
		Description: PremiumPress Child Theme created on ".date('l jS \of F Y h:i:s A')."
		Author: ".get_option('admin_email')."
		Author URI: ".get_home_url()."
		Template: ".strtoupper(THEME_KEY)."9
		Version: 1.0
		*/
		";	
		  
		 //1. CHECK FOR CHILD THEME STYLES
		if($GLOBALS['CORE_THEME']['template'] != "" ){
			$core_css = file_get_contents(str_replace("functions/","",THEME_PATH)."/templates/".$GLOBALS['CORE_THEME']['template'].'/style.css');
			$cssContent .= $core_css;			
		}
			
		//2. ADD-ON CUSTOM STYLES		
		$cssContent .= stripslashes(get_option('custom_css')); 
			
		//3. SAVE THE NEW STYLE FILE		   
		$handle = fopen($uploads['path']."/style.css", "w");
		if (fwrite($handle, $cssContent) === FALSE) {
				echo "Cannot write to styles";
				die();
		} 		 
		fclose($handle);
		
		// 4. CHECK FOR LOGO
		if(is_numeric(_ppt('logo_url_aid'))){
		
		$logo_fullpath = get_attached_file(_ppt('logo_url_aid'), true);		
		$logo_name = str_replace($uploads['path'],"",$logo_fullpath); // INCLUDE SLASH AT BEGINNING
	
		$hh = wp_get_attachment_metadata(_ppt('logo_url_aid'));
			if(isset($hh['file']) && $hh['file'] != ""){			 
			$logofile = $logo_fullpath;
			}
		}
	   
		// 4. BUILD THE FUNCTIONS FILE
	
		
		$funContent = '<?php

// SET CHILD THEME FLAG
define("WLT_CHILDTHEME", 1);

$CHILDTHEME	= new childtheme_'.$template_name.';
 
class childtheme_'.$template_name.' {
	/*
	 Default child theme construct
	*/
	function __construct(){ 	
	 
		// INCLUDE LANGUAGE
		load_child_theme_textdomain( "premiumpress-childtheme", get_stylesheet_directory() . "/languages" );	
		
		// ACTIVATION
		add_action("after_switch_theme", array($this, "_after_switch_theme") );
		 
	}	
	/*
		this function holds all of the changes
		made to core when the child theme is activated
	*/
	function childtheme_v_changes(){
	
		$core = get_option("core_admin_values"); 
		
		$core["logo_url"] = home_url()."/wp-content/themes/'.$template_name.$logo_name.'";
		
		$core["color_primary"] 		= "'._ppt('color_primary').'";
		$core["color_secondary"] 	= "'._ppt('color_secondary').'";    
		$core["header_hometransparent"] = "'._ppt('header_hometransparent').'";
		$core["header_topnav"] = "'._ppt('header_topnav').'"; 
		$core["header_topnavstyle"] = "'._ppt('header_topnavstyle').'"; 
		$core["header_topnavhome"] 	= "'._ppt('header_topnavhome').'";
		$core["header_topnavbg"] 	= "'._ppt('header_topnavbg').'"; 
		$core["header_topnavborderbottom"] = "'._ppt('header_topnavborderbottom').'";
		$core["header_style"] = "'._ppt('header_style').'"; 
		$core["header_shadow"] = "'._ppt('header_shadow').'"; 
		$core["header_bg"] 	= "'._ppt('header_bg').'"; 
		$core["header_sep"] = "'._ppt('header_sep').'";
		$core["header_button"] = "'._ppt('header_button').'";
		$core["header_buttontext"] = "'._ppt('header_buttontext').'";        
		$core["headernav_bg"] = "'._ppt('headernav_bg').'";         
		$core["breadcrumbs"] = "'._ppt('breadcrumbs').'";
		$core["breadcrumbs_style"] 	= "'._ppt('breadcrumbs_style').'";
		$core["footer_blockstyle"] = "'._ppt('footer_blockstyle').'";
		$core["footer_bg"] = "'._ppt('footer_bg').'";
		
		// RETURN CORE
		return $core;		
	} 
	/*
		this function applies changes to core
		when the child theme is activated
	*/
	function _after_switch_theme(){
		// GET DESIGN FROM FUNCTION
		$core_admin_values = $this->childtheme_v_changes();
		// SAVE VALUES
		update_option("core_admin_values",$core_admin_values);
			
	}
	
} // END CHILD THEME

?>';	   
		   
		  // SAVE CONTENT TO FUNCTIONS FILE
		   $handle = fopen($uploads['path']."/functions.php", "w");
		   if (fwrite($handle, $funContent) === FALSE) {
				echo "Cannot write to functions file";
				die();
			  } 
			  fclose($handle);	
			  
			
		// ADD IN ALL FILES
		$addfiles = array();
		$addfiles[] = $uploads['path']."/style.css";
		$addfiles[] = $uploads['path']."/functions.php";
		 	
			if(isset($logofile)){
			$addfiles[] = $logofile;
			}
		
		// MAIN FOLDER
		$addfiles[] = TEMPLATEPATH."/framework/sampletheme/";	
				
		
		$addfiles1 = "";
		foreach($addfiles as $f){
		$addfiles1 .= $f.",";
		}
		
		// CLEAN STRING
		$addfiles1 = substr($addfiles1,0,-1);					  
 		 
		// 4. ZIP EVERYTHING TOGETHER
		$zip = new PclZip($uploads['path']."/".$template_name.".zip");
		
		$v_list = $zip->add(
		$addfiles1,
		PCLZIP_OPT_REMOVE_ALL_PATH, 
		PCLZIP_OPT_ADD_PATH, 
		$template_name);
		 
		 
		 
		   
		  if ($v_list == 0) {
			die("Error : ".$zip->errorInfo(true));
		  } 
	
		$file = $uploads['path']."/".$template_name.".zip";
		$file_download = $uploads['url']."/".$template_name.".zip";
		?>
        <h1>Download Ready</h1>
        <p>Use the link below to download your child theme.</p>
        <p><a href="<?php echo $file_download; ?>"><?php echo $file_download; ?></a>
        <?php 
		die(); 
		if(file_exists($file)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename='.basename($file));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
				exit;
		}else{
		die("Theme file unavailable.");
		} 	 
} 


if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){
 
 

/* =============================================================================
WALKER CLASSES
========================================================================== */

class Walker_CategorySelection2 extends Walker_Category {  

     function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) { global $CORE; 
	 	
		$GLOBALS['thiscatitemid'] = $item->term_id; 
		  
		// CHECK IF WE HAVE AN ICONS
		$image = "";		
		if(isset($GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]) && strlen($GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]) > 1){			
			$image = "<i class='fa ".$GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]."'></i>"; 
		}		 
		
        
		// CHECK IF PARENT CAT IS DISABLED
		$disableParent = "";
		if( $item->parent == 0 ){	
			$output .= "";
		}else{
				$output .= "-";
		}
  	
		// DISPLAY
		$output .= " ".esc_attr( $item->name )."\n";	 
		 
		
    }  

    function end_el(&$output, $item, $depth=0, $args=array(), $id = 0) {  
        $output .= "";  
    }  
	
	function start_lvl( &$output,  $depth = 0, $args = array(), $id = 0 ) { global $item;
 	 
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);		
		
 
	}
	
	function end_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent";
	}
	
	
} 

	if(isset($_GET['task']) && $_GET['task'] != "" && current_user_can('administrator')){

	switch($_GET['task']){
	
	
	case "resetdesign": {
	
	 
		// RESET LOGO
		$core = get_option("core_admin_values");	
		$core['logo_url'] = get_template_directory_uri()."/".THEME_FOLDER."/template/img/logo.png"; 
		 	
		$core['header_hometransparent'] = 0;
		
		$core['header_topnav'] = 1;		 
		$core['header_topnavstyle'] = 2; 
		$core['header_topnavbg'] = ""; 
		
		$core['header_style'] = 1;		 
		$core['header_shadow'] = 0; 
		$core['header_bg'] = ""; 
		$core['header_button'] = 0;	
		
		$core['breadcrumbs'] = 1;
		$core['breadcrumbs_style'] = 3;
		
		$core['pageassign'] = array();
		
		// GET THE CURRENT VALUES
		update_option( "core_admin_values", $core);
		
		$GLOBALS['error_message'] = "Design Changes Reset Successfully";
	
	} break;
 

		case "set1": {		
		$wpdb->query("UPDATE ".$wpdb->prefix."postmeta SET meta_value='yes' WHERE meta_key='featured'");		
		echo "<h4>Listings Updated</h4>";
		die();
		} break;
		
		case "set2": {		
		$wpdb->query("UPDATE ".$wpdb->prefix."postmeta SET meta_value='no' WHERE meta_key='featured'");		
		echo "<h4>Listings Updated</h4>";
		die();
		} break;	
		
		case "set3": {		
		
		$SQL = "SELECT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE ".$wpdb->posts.".post_type = ('".THEME_TAXONOMY."_type') LIMIT 0,200";			 
		$result = mysql_query($SQL, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);					 
		if (mysql_num_rows($result) > 0) {while ($val = mysql_fetch_object($result)){
			update_post_meta($val->ID,'tax_required',1);		
		} }
			
		echo "<h4>Products Updated</h4>";
		die();
		} break;
		
		case "set4": {		
		
		$SQL = "SELECT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE ".$wpdb->posts.".post_type = ('".THEME_TAXONOMY."_type') ORDER BY ".$wpdb->posts.".ID DESC LIMIT 0,600";		
		$posts = $wpdb->get_results($SQL);
		foreach($posts as $post){ 
			update_post_meta($post->ID,'tax_required',0);	
		}		
					
		echo "<h4>Products Updated</h4>";
		die();
		} break;	
		
		
		case "set5": {		
		
		$SQL = "SELECT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE ".$wpdb->posts.".post_type = ('".THEME_TAXONOMY."_type') ORDER BY ".$wpdb->posts.".ID DESC LIMIT 0,600";	
		$posts = $wpdb->get_results($SQL);
		foreach($posts as $post){ 
			update_post_meta($post->ID,'ship_required',1);	
		}		
					
		echo "<h4>Products Updated</h4>";
		die();
		} break;
		
		case "set6": {		
		
		$SQL = "SELECT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE ".$wpdb->posts.".post_type = ('".THEME_TAXONOMY."_type') LIMIT 0,200";			 
		$result = mysql_query($SQL, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);					 
		if (mysql_num_rows($result) > 0) {while ($val = mysql_fetch_object($result)){
			update_post_meta($val->ID,'ship_required',0);		
		} }
					
		echo "<h4>Products Updated</h4>";
		die();
		} break;

		case "set7": {		
		
		$SQL = "SELECT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE ".$wpdb->posts.".post_type = ('".THEME_TAXONOMY."_type') LIMIT 0,200";			 
		$result = mysql_query($SQL, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);					 
		if (mysql_num_rows($result) > 0) {while ($val = mysql_fetch_object($result)){
			update_post_meta($val->ID,'type',0);		
		} }
					
		echo "<h4>Products Updated</h4>";
		die();
		} break;		

		case "set8": {		
		
		$SQL = "SELECT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE ".$wpdb->posts.".post_type = ('".THEME_TAXONOMY."_type') LIMIT 0,200";			 
		$result = mysql_query($SQL, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);					 
		if (mysql_num_rows($result) > 0) {while ($val = mysql_fetch_object($result)){
			update_post_meta($val->ID,'type',2);		
		} }
					
		echo "<h4>Products Updated</h4>";
		die();
		} break;
		
		case "set9": {
		
		$SQL = "UPDATE ".$wpdb->posts." SET ".$wpdb->posts.".post_status = 'publish' WHERE ".$wpdb->posts.".post_status = 'draft' ";	
				 
		$result = mysql_query($SQL, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);
		
		echo "<h4>Listing Updated</h4>";
		die();
		
		} break;	
			
		case "delete2": { // DELETE CATEGORIES 
	 
		$terms = get_terms(THEME_TAXONOMY, 'orderby=count&hide_empty=0');	 
		$count = count($terms);
		if ( $count > 0 ){
		
			 foreach ( $terms as $term ) {
				wp_delete_term( $term->term_id, THEME_TAXONOMY );
				$_POST['admin_values']['category_icon_'.$term->term_id] = "";
			 }
		 }		  		
		// GET THE CURRENT VALUES
		$existing_values = get_option("core_admin_values");
		// MERGE WITH EXISTING VALUES
		$new_result = array_merge((array)$existing_values, (array)$_POST['admin_values']);
		// UPDATE DATABASE 		
		update_option( "core_admin_values", $new_result);
		  
		
		echo "<h4>Categories Deleted Successfull</h4>";
		die();
		} break;
		
		case "delete3": { 
	 
		$terms = get_terms('post_tag', 'orderby=count&hide_empty=0');	 
		$count = count($terms);
		if ( $count > 0 ){
		
			 foreach ( $terms as $term ) {
				wp_delete_term( $term->term_id, 'post_tag' );
			 }
		 }
		
		echo "<h4>Tags Deleted Successfull</h4>";
		die();
		} break;		
		
		case "delete4": { 
	 
		$wpdb->query("delete a,b,c,d
		FROM ".$wpdb->prefix."posts a
		LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
		LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
		LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
		LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
		WHERE a.post_type ='post'");
		
		echo "<h4>All Posts Successfull</h4>";
		die();
		} break;	
		
		
		case "delete5": { 
	 
		$wpdb->query("delete a,b,c,d
		FROM ".$wpdb->prefix."posts a
		LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
		LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
		LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
		LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
		WHERE a.post_type = 'revision'");
		
		echo "<h4>Action Successfull</h4>";
		die();
		} break;			
		
		case "delete6": { // PAGES 
	 
		$wpdb->query("delete a,b,c,d
		FROM ".$wpdb->prefix."posts a
		LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
		LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
		LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
		LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
		WHERE a.post_type = 'page'");
		
		echo "<h4>All Pages Successfull</h4>";
		die();
		} break;
		
		
		case "delete7": { 
	 
		$wpdb->query("delete a,b,c,d
		FROM ".$wpdb->prefix."posts a
		LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
		LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
		LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
		LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
		WHERE a.post_type = '".THEME_TAXONOMY."_type'");
		
		echo "<h4>All Listings Successfull</h4>";
		die();
		} break;	
		
		case "delete71": { 
	 
		$wpdb->query("delete a,b,c,d
		FROM ".$wpdb->prefix."posts a
		LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
		LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
		LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
		LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
		WHERE a.post_type = 'cproduct_type'");
		
		echo "<h4>All Listings Successfull</h4>";
		die();
		} break;
		
		case "delete8": { 
	 
		$wpdb->query("delete a,b,c,d
		FROM ".$wpdb->prefix."posts a
		LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
		LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
		LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
		LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
		WHERE a.post_type = 'faq_type'");
		
		echo "<h4>Action Successfull</h4>";
		die();
		} break;
		
		case "delete9": { 
	 
		$wpdb->query("delete a,b,c,d
		FROM ".$wpdb->prefix."posts a
		LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
		LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
		LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
		LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
		WHERE a.post_type = 'wlt_message'");
		
		echo "<h4>Action Successfull</h4>";
		die();
		} break;	
		
		case "delete10": { 
	 
		$wpdb->query("delete a,b,c,d
		FROM ".$wpdb->prefix."posts a
		LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
		LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
		LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
		LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
		WHERE a.post_type = 'alert_type'");
		
		echo "<h4>Action Successfull</h4>";
		die();
		} break;	
				
		case "delete11": { 
	 
		$wpdb->query("TRUNCATE TABLE ".$wpdb->prefix."core_orders");
		
		echo "<h4>Orders Deleted Successfull</h4>";
		die();
		} break;
		
		
		case "delete12": { // DELETE PACKAGES
			 
		update_option( "packagefields", "");
		echo "<h4>Packages Deleted Successfull</h4>";
		die();
		} break;
		
		case "delete13": { // DELETE MEMEBRSHIPS
	 
		 update_option( "membershipfields", "");
		echo "<h4>Memberships Deleted Successfull</h4>";
		die();
		} break;
		
		case "delete14": { // DELETE MEMEBRSHIPS
		$wpdb->query("TRUNCATE TABLE ".$wpdb->prefix."comments");
		 
		echo "<h4>Comments Deleted Successfull</h4>";
		die();
		} break;
		
		case "delete15": { // DELETE MEMEBRSHIPS
		update_option( "submissionfields", ""); 
		echo "<h4>Custom Fields Deleted Successfull</h4>";
		die();
		} break;
		
		case "delete15": { // DELETE REGISTRATION FIELDS
		update_option( "regfields", ""); 
		echo "<h4>Registration Fields Deleted Successfull</h4>";
		die();
		} break;
		
		case "resetcustomizer": { 
		$nc = new wlt_core_customerize;
		$nc->reset_customizer();
		 
		$GLOBALS['error_message'] = "Customizer Reset Successfully";
		} break;
		
		case "retables": {
		
// [MYSQL] INSTALL MAILING LIST TABLE
//ppt_install_db_tables($drop = false);
		

// TABLE ORDER

$wpdb->query("ALTER TABLE ".$wpdb->prefix."terms ADD `term_order` INT NULL DEFAULT '0'");
  
$wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."core_log`");
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_log` (
	`autoid` INT( 10 ) NOT NULL AUTO_INCREMENT ,
	`datetime` DATETIME NOT NULL ,
	`userid` INT( 10 ) NOT NULL ,
	`postid` INT( 10 ) NOT NULL ,
	`link` VARCHAR( 255 ) NOT NULL ,
	`message` VARCHAR( 255 ) NOT NULL ,
`type` varchar(10) NOT NULL,
`data` blob NOT NULL, PRIMARY KEY (  `autoid` ))");
 
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_mailinglist` (
 `autoid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `email_hash` varchar(50) NOT NULL,
  `email_ip` varchar(50) NOT NULL,
  `email_date` datetime NOT NULL,
  `email_firstname` varchar(150) NOT NULL,
  `email_lastname` varchar(150) NOT NULL,
  `email_confirmed` int(11) NOT NULL,
  PRIMARY KEY (`autoid`))");
// [MYSQL] INSTALL ORDERS TABLE
 
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_orders` (
  `autoid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `order_ip` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `order_data` longtext NOT NULL,
  `order_items` longtext NOT NULL,
  `order_email` varchar(255) NOT NULL,
  `order_shipping` varchar(10) NOT NULL,
  `order_tax` varchar(10) NOT NULL,
  `order_total` varchar(10) NOT NULL,
  `order_status` int(1) NOT NULL DEFAULT '0',
  `user_login_name` varchar(100) NOT NULL,
  `shipping_label` longtext NOT NULL,
  `payment_data` longtext NOT NULL,
  PRIMARY KEY (`autoid`));");
  
$wpdb->query("ALTER TABLE ".$wpdb->prefix."core_orders CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

  // [MYSQL] INSTALL WITHDRAWAL TABLE
 
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_withdrawal` (
  `autoid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(10) NOT NULL, 
  `user_ip` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `withdrawal_comments` longtext NOT NULL,
  `withdrawal_status` int(1) NOT NULL DEFAULT '0', 
  `withdrawal_total` varchar(10) NOT NULL,  
  PRIMARY KEY (`autoid`));");

// [MYSQL] INSTALL SEARCH TABLE
 
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_search` (`id` int(11) NOT NULL AUTO_INCREMENT,`label` varchar(50) NULL,`description` varchar(100) NULL,`type` varchar(10) NULL,`operator` varchar(10) NULL,`compare` varchar(10) NULL,`values` text NULL,`key` varchar(20) NULL,`alias` varchar(20) NULL,`field_type` varchar(15) NULL,`order` smallint(2) NULL,`link` varchar(100),PRIMARY KEY (`id`));");

$wpdb->query("ALTER TABLE ".$wpdb->prefix."core_search CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"); 

// [MYSQL] INSTALL SESSION TABLE FOR CART
 $wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_sessions` (
  `session_key` varchar(255) NOT NULL,
  `session_date` datetime NOT NULL,
  `session_userid` int(10) NOT NULL,
  `session_data` text NOT NULL,
  PRIMARY KEY (`session_key`));");
  
  
 
 
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_useronline` (	 
			  `id` int(10) NOT NULL auto_increment, 
			  `user_id` int(10) NOT NULL, 
			  `session` char(100) NOT NULL default '',
			  `ip` varchar(15) NOT NULL default '', 
			  `timestamp` varchar(15) NOT NULL default '', 
			  PRIMARY KEY (`id`), 
			  UNIQUE KEY `id`(`id`) );");
  
 
wlt_orderby_activated(false);
   
		
		echo "<h4>Tabled Reinstalled Successfull</h4>";
		die();
		
		} break;	
}
}
}

 

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1);



// CHECK IF THEME HAS BEEN INSTALLED CORRECTLY
if(get_option('wlt_theme') == ""){

		$HandlePath = TEMPLATEPATH; $TemplateString = "";
	    $count=1;
		if($handle1 = opendir($HandlePath)) {      
			while(false !== ($file = readdir($handle1))){	
			
				// GET LIST
				if(substr($file,0,1) == "_" && is_dir(TEMPLATEPATH."/".$file) && !isset($ThemeKeySet)){
					?>
                    <input type="hidden" name="adminArray[wlt_theme]" value="<?php echo str_replace("_","",$file); ?>" />
                    
                    <?php
					$ThemeKeySet = true;
				}
			
			 
			}
		}
}
?>



<?php get_template_part('framework/admin/templates/admin', '4-overview' ); ?> 

<div class="tab-pane  <?php if(isset($_POST['tab']) && $_POST['tab'] == "massimport"){ echo "active in"; } ?>" id="tab-massimport" style="display:none;"><div class="padding">
 
<?php get_template_part('framework/admin/templates/admin', '4-massimport' ); ?>
 

</div></div>



 

<div class="tab-pane  <?php if(isset($_POST['tab']) && $_POST['tab'] == "setuptools"){ echo "active in"; } ?>" id="setuptools" style="display:none;"><div class="padding">



 
    
<script language="javascript">
jQuery(window).load(function(){
jQuery('.alertme').click(function(e)
{
    if(confirm("Are you sure?"))
    {
       
	
    }
    else
    {
		 alert('Phew! That was close!');
        e.preventDefault();
    }
});
});
</script>     

       
<h5>System Cleanup Module</h5>

    
    <p>Using any of the options below will instantly delete from your website. <b>Please take care!</b> </p>
    
   

     
<hr />
<div class="well mb-2">	
<b>Listings Only</b>	 
<a href="admin.php?page=4&amp;task=delete7" class="alertme btn btn-info float-right" >Delete All Listings</a>
<div class="clearfix"></div>
</div>

<?php if(defined('WLT_COMPARISON')){ ?>
<div class="well mb-2">	
<b>Compared Products Only</b>	 
<a href="admin.php?page=4&amp;task=delete71" class="alertme btn btn-info float-right" >Delete All Listings</a>
<div class="clearfix"></div>
</div>
<?php } ?>

<div class="well mb-2">	
<b>Listing Categories Only</b>	 
<a href="admin.php?page=4&amp;task=delete2" class="alertme btn btn-info float-right" >Delete All Categories</a>
<div class="clearfix"></div>
</div>


<div class="well mb-2">	
<b>Tags Only</b> 
 <a href="admin.php?page=4&amp;task=delete3" class="alertme btn btn-info float-right" >Delete All Tags</a>
<div class="clearfix"></div>
</div>

<div class="well mb-2">	
<b>Posts Only</b> 
 <a href="admin.php?page=4&amp;task=delete4" class="alertme btn btn-info float-right" >Delete All Posts</a>
<div class="clearfix"></div>
</div>

<div class="well mb-2">	
<b>Comments Only</b>	 
 <a href="admin.php?page=4&amp;task=delete14" class="alertme btn btn-info float-right" >Delete All Comments</a> 
<div class="clearfix"></div>
</div>

 
<div class="well mb-2">	
<b>Pages Only</b> 
 <a href="admin.php?page=4&amp;task=delete6" class="alertme btn btn-info float-right" >Delete All Pages</a> 
<div class="clearfix"></div>
</div>

<div class="well mb-2">	
<b>Saved Revisions Only</b>	 
<a href="admin.php?page=4&amp;task=delete5" class="alertme btn btn-info float-right" >Delete All Revisions</a>
<div class="clearfix"></div>
</div>

<div class="well mb-2">	
<b>Orders Only</b>	 
 <a href="admin.php?page=4&amp;task=delete11" class="alertme btn btn-info float-right" >Delete All Orders</a> 
<div class="clearfix"></div>
</div>

<div class="well mb-2">	
<b>Listing Packages Only</b>	 
 <a href="admin.php?page=4&amp;task=delete12" class="alertme btn btn-info float-right" >Delete All Packages</a> 
<div class="clearfix"></div>
</div>

<div class="well mb-2">	
<b>Registration Fields Only</b>	 
 <a href="admin.php?page=4&amp;task=delete16" class="alertme btn btn-info float-right" >Delete All Fields</a> 
<div class="clearfix"></div>
</div>

<div class="well mb-2">	
<b>Memberships Only</b>	 
 <a href="admin.php?page=4&amp;task=delete13" class="alertme btn btn-info float-right" >Delete All Memberships</a> 
<div class="clearfix"></div>
</div>

<div class="well mb-2">	
<b>Custom Fields Only</b>	 
 <a href="admin.php?page=4&amp;task=delete15" class="alertme btn btn-info float-right" >Delete All Custom Fields</a> 
<div class="clearfix"></div>
</div>


<div class="well mb-2">	
<b>Notifications Only</b>	 
 <a href="admin.php?page=4&amp;task=delete9" class="alertme btn btn-info float-right" >Delete All Notifications</a> 
<div class="clearfix"></div>
</div>


  
 


</div></div>


		<div id="UpdateModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document"><div class="modal-content">
					  <div class="modal-header">                
						<h6>Website Reset</h6>
					  </div>
					  <div class="modal-body">                      
					    
                        <p style="font-weight:bold;">Would you like to reset your website to the default factory settings?</p>
                        
                        <p style="font-size:11px;"><b>Warning</b> resetting your website will delete all of your existing listing and admin changes.</p>
                         					             
					  </div>
                      <form method="post" action="">
                      <input type="hidden" name="submitted" value="yes" />
                      <input type="hidden" name="core_system_reset" id="core_system_reset" value="new" />
					  <div class="modal-footer">
						<a class="btn" data-dismiss="modal" aria-hidden="true">No Thanks!</a>                       
						<button type="submit" class="btn btn-primary">Yes, Reset Now</button>
                       
					  </div>
                      </form>
</div></div></div>












<div class="tab-pane <?php if(isset($_POST['tab']) && $_POST['tab'] == "csv"){ echo "active in"; } ?>" id="csv" style="display:none;"><div class="padding">

<h4>CSV Import Tool</h4>

<?php //get_template_part('framework/admin/templates/admin', '4-import' ); ?>    

</div></div>




<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(1); 
?>