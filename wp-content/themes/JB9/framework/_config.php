<?php
/*
* @@ PremiumPress Framework Config
* @ Developed By Mark Fail
*
*
*
*
*
*
*
*
*
*
*
*
*
*
*
*/


	// CHECK FOR EMPTY CART
	if(isset($_GET['emptycart']) && !headers_sent() ){ 
	
		session_start(); 
		unset($_SESSION['wlt_cart']); 
 
		// DELETE STORED SESSION COOKIE
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
			);
		}
	
	} elseif( !isset($_SESSION) && !headers_sent()){ 
	
	session_start(); 
	
	}
  
// V8.3 + EVERYTHING IS NOW LISTING
define("THEME_TAXONOMY", "listing");

define('wlt_orderby_PATH',    get_template_directory()."/framework/orderby/");
define('wlt_orderby_URL',     get_template_directory_uri()."/framework/orderby/");
require_once TEMPLATEPATH ."/framework/orderby/main.php";
/*
*
=============================================================================
   LOAD IN FRAMEWORK
============================================================================*/ 
$GLOBALS['wlt_start_time'] = microtime(true);
require_once TEMPLATEPATH ."/framework/new_class/ppt_extra_colors.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_extra_install.php";
$nc = new wlt_core_customerize;	

/*=============================================================================
   LOAD IN THEME EXTRAS
============================================================================*/

$coretheme = get_option('wlt_theme');
if($coretheme != ""){
	if(file_exists(TEMPLATEPATH .'/_'.$coretheme.'/functions.php')){
		require_once TEMPLATEPATH .'/_'.$coretheme.'/functions.php';
	}
}

/*=============================================================================
   LOAD IN THEME EXTRAS
============================================================================*/


// FRAMEWORK FUNCTIONS [SEPERATED]
require_once TEMPLATEPATH ."/framework/new_class/ppt_1_functions.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_2_layout.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_3_media.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_4_orders.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_5_search.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_6_shortcodes.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_7_updates.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_8_email.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_9_ajax.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_10_geo.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_11_advertising.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_12_addlisting.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_13_user.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_14_mobile.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt.php";

// FRAMEWORK CLASSES [INDEPENDANT]
require_once TEMPLATEPATH ."/framework/new_class/ppt_extra_walkers.php";
require_once TEMPLATEPATH ."/framework/new_class/ppt_extra_widgets.php";


require_once TEMPLATEPATH ."/framework/new_class/ppt_core.php";
$CORE		= new white_label_themes;
 
require_once TEMPLATEPATH ."/framework/new_class/ppt_hooks_filters.php"; 
require_once TEMPLATEPATH ."/framework/new_class/ppt_adsearch.php";
$ADSEARCH	= new core_search;

require_once TEMPLATEPATH ."/framework/new_class/ppt_gateways.php";

if(defined('WLT_CART')){
require_once TEMPLATEPATH ."/framework/new_class/ppt_extra_cart.php";
$CORE_CART	= new framework_cart;
}


// ELEMENTOR PAGE BUILDER BLOCKS
if(defined('ELEMENTOR_VERSION') ){
require_once TEMPLATEPATH ."/framework/elementor/elementor.php";
}


/*=============================================================================
   LOAD IN ADMIN FRAMEWORK
============================================================================*/

if(is_admin()){
	require_once (TEMPLATEPATH ."/framework/new_class/class_admin_design.php");
	require_once (TEMPLATEPATH ."/framework/new_class/class_admin.php");
	
	$CORE_ADMIN	 			= new wlt_admin;
	 
	$WLT_ADMIN 				= $CORE_ADMIN;
	
	if(get_option('wlt_license_key') !="" && isset($_GET['page']) ){
	require_once TEMPLATEPATH ."/framework/new_class/class-tgm-plugin-activation.php";
	add_action( 'tgmpa_register', 'premiumpress_register_required_plugins' );
	}
	
}else{
	add_action('init', array( $CORE, 'INIT') );
}
 

 
function premiumpress_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			 'name' => __( 'Elementor', 'premiumpress' ),
              'slug' => 'elementor',
              'required' => false,              
		),
		
		array(
			 'name' => __( 'Text Editor/ Language Translation', 'premiumpress' ),
              'slug' => 'loco-translate',
              'required' => false,               
		),

	);
	
	// VIDEO ADDONS
	if(defined('THEME_KEY') && THEME_KEY == "vt"){ 

	$plugins_video = array(

		array(
			 'name' => __( 'YouTube Plugin', 'premiumpress' ),
              'slug' => 'v9_youtube',
              'required' => false,              
		),		 

	);
	
	$plugins = array_merge($plugins, $plugins_video);
	
	}
	
	// VIDEO ADDONS
	if(defined('THEME_KEY') && THEME_KEY == "cp"){ 

	$plugins_video = array(

		array(
			 'name' => __( 'iCodes Plugin', 'premiumpress' ),
              'slug' => 'v9_icodes',
              'required' => false,              
		),		 

	);
	
	$plugins = array_merge($plugins, $plugins_video);
	
	}

	
	$config = array(
		'id'           => 'premiumpress',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
 
	);

	tgmpa( $plugins, $config );
}




?>