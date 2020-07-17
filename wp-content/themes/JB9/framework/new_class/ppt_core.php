<?php
/* =============================================================================
   THIS FILE SHOULD NOT BE EDITED
   ========================================================================== */ 
class white_label_themes extends framework { 

 	public $ppt_core_settings = array(); // STORES ALL THE CORE THEME SETTINGS
	
	// HOOKS EVERYTHING TOGETHER
	function __construct(){ global $wpdb;  	  
		
		// FIX FOR NUM SEARCHES
		if(!is_admin() && isset($_GET['s']) && strlen($_GET['s']) < 3 && is_numeric($_GET['s'])){
		header('location: '.home_url()."/?s=&uid=".$_GET['s']);
		exit();
		}
 
		// LOAD IN CONFIG AND CORE WORDPRESS FUNCTIONALITY				
		$this->constants();
		$this->globals();
		$this->functions();
		$this->theme_support();	
		$this->register_widgets();
		$this->taxonomies();
		$this->default_actions(); 	
		$this->default_shortcodes();
		$this->default_session();
		 
	}
	
	// START CONSTANTANTS	 
	function constants(){  global  $userdata;	
		
		$f = wp_get_theme();	
		
		// GET CURRENT USER
		$userdata = wp_get_current_user(); 
		// THEME VERSION 
		define("THEME_VERSION", "9.4.3");		
		// RELEASE DATE
		define("THEME_VERSION_DATE", "18th Feb, 2020");		
		// THEME INSTALL LINK
		define("THEME_URI", get_template_directory_uri() );		
		// THEME INSTALL PATH
		define("THEME_PATH", TEMPLATEPATH."/");	  
		// FRAMEWORK LINKS	 
		define("FRAMREWORK_URI", get_template_directory_uri()."/framework/" );
		// PREMIUMPRESS ELEMENTOR PARTNER ID
		if ( ! defined( 'ELEMENTOR_PARTNER_ID' ) ) {
			define( 'ELEMENTOR_PARTNER_ID', 2310 );
		}
 
		// CHECK FOR MOBILE VIEW 
		if(_ppt('mobileweb') == 1 && $this->isMobileDevice() ){
			if(!defined('IS_MOBILEVIEW')){ define('IS_MOBILEVIEW', true); }
		}
		
		// CHILD THEME NAME	
		if($f->stylesheet != _ppt('template') && strlen($f->stylesheet) > 3 && $f->stylesheet != "WLTHEMES"){		
		  
			define("CHILD_THEME_NAME", $f->stylesheet);				
			define("CHILD_THEME_PATH_URL", get_home_url().'/wp-content/themes/'.CHILD_THEME_NAME.'/');
			define("CHILD_THEME_PATH_IMG", get_home_url().'/wp-content/themes/'.CHILD_THEME_NAME.'/img/');
			define("CHILD_THEME_PATH_JS", get_home_url().'/wp-content/themes/'.CHILD_THEME_NAME.'/js/');
			define("CHILD_THEME_PATH_CSS", get_home_url().'/wp-content/themes/'.CHILD_THEME_NAME.'/css/');		
			define("CHILD_THEME_APTH", get_home_url().'/wp-content/themes/'.CHILD_THEME_NAME.'/css/');	
			 	 
		}
 	 
	 	// CORE PATHS FOR EASY ACCESS
		if(defined('THEME_FOLDER')){
		define("CORE_PATH_URL", get_template_directory_uri()."/".THEME_FOLDER."/template/");
		define("CORE_PATH_IMG", get_template_directory_uri()."/".THEME_FOLDER."/template/img/");
		define("CORE_PATH_JS", get_template_directory_uri()."/".THEME_FOLDER."/template/js/");
		define("CORE_PATH_CSS", get_template_directory_uri()."/".THEME_FOLDER."/template/css/");	
		}
  
		
	}
	  

 	// SUPPORT MINE TYPES
	function my_myme_types($mime_types){
			$mime_types['flv'] 	= 'video/x-flv';
			$mime_types['mp4'] 	= 'video/mp4';
			$mime_types['webm'] = 'video/webm';
			$mime_types['mpeg'] = 'audio/mpeg';
			$mime_types['mp3'] 	= 'audio/mp3';				
			$mime_types['ogg'] 	= 'video/ogg';
			$mime_types['pdf'] 	= 'application/pdf';	
			$mime_types['zip']  = 'application/octet-stream';			
			$mime_types['doc']  = 'application/msword';					 		
			//unset($mime_types['flv']); //Removing the pdf extension		
			return $mime_types;
	}
	
	// START GLOBALS
	function globals() {
	
		// SETUP CORE THEME SETTINGS
		$this->ppt_core_settings = get_option("core_admin_values"); 
	 
		// GET THE MAIN THEME SETTINGS
		if(!isset($GLOBALS['CORE_THEME'])){
		$GLOBALS['CORE_THEME'] = $this->ppt_core_settings;
		}
 		
		// DEMO OPTIONS FOR DEVELOPERS
		if(defined('WLT_DEMOMODE')){
	   
			// DEMO THEME SETUP
			if(isset($_REQUEST['skin'])){	
				$_SESSION['skin']	= $_REQUEST['skin'];
				$GLOBALS['childtemplate'] 			= "childtheme_".strip_tags($_REQUEST['skin']);
			}elseif(isset($_SESSION['skin'])){
				$GLOBALS['childtemplate'] 			= "childtheme_".strip_tags($_SESSION['skin']);
			}					
						 
		}	// end if	
			 
	}
	// START FUNCTION CALLS
	function functions() {
  	
		// BRING IN GLOBALS
		//$this->globals(); 
		$f = wp_get_theme(); 
		
		if(!defined('THEME_FOLDER')){ define('THEME_FOLDER',''); }
		 
		// CHECK FOR A THEME FUNCTION FILE		
		//if(_ppt('template') != "" ){	
		
	  	if(defined('WLT_DEMOMODE') && isset($GLOBALS['childtemplate']) && file_exists(WP_CONTENT_DIR."/themes/".$GLOBALS['childtemplate']."/functions.php")){	
				
				if(!function_exists('childtheme_v_changes')){		
		 
				include(WP_CONTENT_DIR."/themes/".$GLOBALS['childtemplate']."/functions.php");
				}
	  
			// FIRST CHECK CHILD THEME FUNCTIONS
			
		}elseif(!defined('WLT_DEMOMODE') && defined('CHILD_THEME_NAME') && file_exists(WP_CONTENT_DIR."/themes/".CHILD_THEME_NAME."/_functions.php")){	
	 	
				include(WP_CONTENT_DIR."/themes/".CHILD_THEME_NAME."/_functions.php");
				
				
			// NOW CHECK THE CORE THEME
		}elseif(!defined('CHILD_THEME_NAME') && file_exists(THEME_PATH.THEME_FOLDER."/template/_functions.php") ){		
	 
				include(THEME_PATH.THEME_FOLDER."/template/_functions.php");						
		}// end if		 
 			 	 
		//}  

	} 
	function clean_script_tag($input) {
	  $input = str_replace("type='text/javascript' ", '', $input);
	  return str_replace("'", '"', $input);
	}
		
	function default_session(){
		if ( !isset($_SESSION['language'] ) && !isset($_REQUEST['l']) ){
		//$_SESSION['language'] = $GLOBALS['CORE_THEME']['language'];		
		}else{		
			if (isset($_REQUEST['l'])){ 
			unset($_SESSION['language']);
			}
			if (isset($_SESSION['language']) && !isset($_REQUEST['l'])){
			}elseif (isset($_SESSION['language'] ) && isset($_REQUEST['l'])){
			unset($_SESSION['language']);
			$_SESSION['language'] = $_REQUEST['l'];  
			}else{
			$_SESSION['language'] = $_REQUEST['l'];			 
			}		
		} 
	}
	function _locale($locale) {
		if(isset($_SESSION['language']) && $_SESSION['language'] != ""){
		  $locale = $_SESSION['language'];
		} 	 
		return $locale;
	}
	// START THEME SUPPORT	
	function theme_support() { 	
	 
		// MENU
		add_theme_support('nav_menus');
		
		// DEFAULT MENU
		register_nav_menus( array('topmenu_en_US' => 'Top Links (en_US)' ) );
		register_nav_menus( array('mainmenu_en_US' => 'Main Navigation (en_US)' ) );	
		register_nav_menu( 'footermenu_en_US', 'Footer Links (en_US)' );	
		
		register_nav_menus( array('mobilemenu_en_US' => 'Mobile Device Menu (en_US)' ) );	
		
		// REGISTER NEW NAVS FOR DIFFERENT LANGUAGES
		if( is_array(_ppt('languages')) ){
			foreach(_ppt('languages') as $lang){
				if($lang == "en_US"){ continue; }
				register_nav_menus( array('topmenu_'.$lang => 'Top Links ('.$lang.')' ) );			
				register_nav_menus( array('mainmenu_'.$lang => 'Main Navigation ('.$lang.')' ) );	
				register_nav_menu( 'footermenu_'.$lang, 'Footer Links ('.$lang.')' );			
			}
		}
		
		// THUMBNAILS
		add_theme_support( 'post-thumbnails', array( 'post','page' ) );
					 
		// CUSTOM BACKGROUNDS 
		//add_theme_support( 'custom-background' );	
		//add_theme_support( 'custom-header' );		 
		// GLOBAL SUPPORT FOR SELECTIVE WIDGET MENUS
		add_action('init', array('wf_wn', 'init')); 
		// MEMBERSHIPS ON REGISTRATION PAGE
		 
		if(!is_admin() ){
		add_filter('script_loader_tag', array($this, 'clean_script_tag') );	
		}
 	
	}
 
 

	/*
		this function changes the display of listing
		to that of the active theme
	*/
	function listingTitle(){
		
		$listing_title = "Listing";
		if(defined('THEME_LISING_CAPTION')){
		return  THEME_LISING_CAPTION;
		}			
		return $listing_title;
	}
	
	/*
		this function sets up all the theme
		shortcodes
	*/
	function default_shortcodes(){
	 		
			// HOME URL
			add_shortcode( 'HOME_URL', array($this,'pptv9_shortcode_url') );	
			
			// LISTING PAGE
			add_shortcode( 'ID',  array($this, 'pptv9_shortcode_postid' ) );			
			add_shortcode( 'TITLE', array($this,'pptv9_shortcode_title') );	
			add_shortcode( 'EXCERPT',  array($this, 'pptv9_shortcode_excerpt' ) );
			add_shortcode( 'CONTENT',  array($this, 'pptv9_shortcode_content' ) );
			add_shortcode( 'TAGS',  array($this, 'pptv9_shortcode_tags' ) );
			add_shortcode( 'IMAGE', array($this,	'pptv9_shortcode_image' ) );
			add_shortcode( 'IMAGES', array($this,	'pptv9_shortcode_images' ) );	
			add_shortcode( 'GALLERY', array($this,	'pptv9_shortcode_gallery' ) );
			add_shortcode( 'VIDEO',  array($this, 	'pptv9_shortcode_video' ) );
			add_shortcode( 'VIDEOS',  array($this, 	'pptv9_shortcode_videos' ) );
			add_shortcode( 'CATEGORY',  array($this, 'pptv9_shortcode_cats' ) );
			add_shortcode( 'COMMENTS',  array($this, 'pptv9_shortcode_comments' ) );
			add_shortcode( 'CUSTOMFIELD',  array($this, 'pptv9_shortcode_customfield' ) );
			add_shortcode( 'CATEGORYIMAGE',  array($this, 'pptv9_shortcode_categoryimage' ) ); 
			add_shortcode( 'CATEGORYICON',  array($this, 'pptv9_shortcode_categoryicon' ) ); 
			
			
			add_shortcode( 'LIKES',  array($this, 'wlt_shortcode_likes' ) );
			
			// V9 EXTRAS
			add_shortcode( 'AMENITIES',  array($this, 'pptv9_shortcode_amenities' ) );
			
			
			// V9 LAYOUT SHORTCODES
			add_shortcode( 'MAINMENU', array($this,'ppt_shortcode_mainmenu') );	
			
			 
			add_shortcode( 'HITS',  array($this, 'ppt_shortcode_hits' ) );			
			
			
			add_shortcode( 'USER-COUNTRY', array($this,'ppt_shortcode_user_country') );
			add_shortcode( 'USER-SINCE', array($this,'ppt_shortcode_user_since') );
			add_shortcode( 'USER-LASTONLINE', array($this,'ppt_shortcode_user_lastonline') );
			
			
			
			add_shortcode( 'RIBBON',  array($this, 'ppt_shortcode_ribbon' ) );
			
			
						
		 	add_shortcode( 'FIELDS', array($this,'wlt_shortcode_fields') );
						
			
			// MEDIA SHORTCODES (clas_media.php)
			  		
 			
			add_shortcode( 'MEDIA',  array($this, 	'wlt_shortcode_media' ) );
		  
			// LOOP SHORTCODES			
			add_shortcode( 'RATING', array($this,'wlt_shortcode_rating') );
	 		
			add_shortcode( 'LOCATION',  array($this, 'wlt_shortcode_location' ) );
			 
			add_shortcode( 'TIMELEFT', array($this,'wlt_shortcode_timeleft') );			
			add_shortcode( 'TIMESINCE', array($this,'wlt_shortcode_timesince') );
		 	 
			
			add_shortcode( 'VISITORCHART', array($this,'wlt_shortcode_visitorchart') );
						
		 		
			add_shortcode( 'USERID',  array($this, 'wlt_shortcode_userid' ) );
			add_shortcode( 'CONTACT',  array($this, 'wlt_shortcode_contact' ) );
			
			add_shortcode( 'FAVS',  array($this, 'wlt_shortcode_favs' ) );
			 			
			add_shortcode( 'IMAGEAUTHOR',  array($this, 'wlt_shortcode_author' ) ); 	 
		 
			// NORMAL PAGES
			add_shortcode( 'LISTINGS', array($this,'wlt_page_listings') );			
			add_shortcode( 'ADVANCEDSEARCH', array($this,'wlt_shortcode_advancedsearch') );	
			 
		 
			add_shortcode( 'CATEGORIES', array($this,'wlt_page_categories') );
			add_shortcode( 'MEMBERSHIP', array($this,'wlt_membership_filter') );
						
			
			// BETA		 
	 
			add_shortcode( 'DISTANCE', array($this, 'wlt_distance' ) );	 
			add_shortcode( 'COUNTRY',  array($this, 'wlt_shortcode_country' ) );
			add_shortcode( 'CITY',  array($this, 'wlt_shortcode_city' ) );
			
			add_shortcode( 'SELLSPACE',  array($this, 'wlt_shortcode_advertising' ) );			
			
			// BETA DISPLAY
			add_shortcode( 'D_CATEGORIES',  array($this, 'wlt_shortcode_dcats' ) ); 
		  
			 
			add_shortcode( 'D_SOCIAL',  array($this, 'wlt_shortcode_socialbtns' ) );	
			add_shortcode( 'SOCIAL',  array($this, 'wlt_shortcode_socialbtns' ) );		 
			add_shortcode( 'FLAG',  array($this, 'wlt_shortcode_flag' ) );			
			 		
			add_shortcode( 'SCREENSHOT',  array($this, 'wlt_shortcode_screenshot' ) );			
						
			add_shortcode( 'HITCOUNTER',  array($this, 'wlt_shortcode_hitcounter' ) );
		 
			add_shortcode( 'GOOGLEMAP', array($this, 'wlt_google_maps_display' ) );			
			
			add_filter('tiny_mce_before_init', array($this, 'tinymce_init' ));			
			
			// PROTECT AGAINST SPAM
			add_action('register_form', array($this, 'spam_registration' )); 
			//add_filter('preprocess_comment', array($this, 'span_filter_comments' )  );
			add_action('user_registration_email',  array($this, 'span_filter_email' ) );	
	}
	
	
	function span_filter_email($user_email = ''){ global $errors;
 
		if(trim($_POST['ppt_spam_hash']) != hash('sha256', "premiumpress-spam-".date("Ymd"))){		
			
				wp_die("<p class=\"error\">".__("Spam bot detected.","premiumpress")."</p>");
			 	
		}
		
		return $user_email;
	
	}
	function span_filter_comments($commentdata){ global $errors;
 
		if(trim($_POST['ppt_spam_hash']) != hash('sha256', "premiumpress-spam-".date("Ymd"))){		
			
				wp_die("<p class=\"error\">".__("Spam bot detected.","premiumpress")."</p>");
			 	
		} 
		
		return $commentdata; 
	
	}
	function spam_registration(){ ?>
	<input type="hidden" name="ppt_spam_hash" value="<?php echo hash('sha256', "premiumpress-spam-".date("Ymd")); ?>" />
	<?php
	
	}
	

	/*
	this function stops the editor in wordpress
	from removing the tags we need
	*/
	function tinymce_init( $init ) {
	
		if(isset($init['extended_valid_elements'])){
		$init['extended_valid_elements'] .= ', span[style|id|nam|class|lang|pre]';
		}else{
		$init['extended_valid_elements'] = ', span[style|id|nam|class|lang|pre]';
		}
		
		$init['verify_html'] = false;
		return $init;
	}
	
	/*
	this functions sets up all the core
	theme filters
	*/
	function default_actions() { 
	 
	  
		// PERFORM ALL THE SITE ACTIONS
		add_action('init', array($this, '_ajax_actions' ) );
 	
		// USER ONLINE
		add_action('init', array($this, 'user_online_tables' ) );
		
		// SETUP LANGUAGE SUPPORT	 
		add_filter('locale', array($this,  '_locale') ,10);  
		add_action('after_setup_theme', array($this, 'set_theme_languages' ));
		
		//REMOVE HEADER DISPLAYS
		remove_action( 'wp_head', 'feed_links_extra', 3 ); //Extra feeds such as category feeds
		remove_action( 'wp_head', 'feed_links', 2 ); // General feeds: Post and Comment Feed
		remove_action( 'admin_enqueue_scripts', 'wp_auth_check_load' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wp_generator');
		remove_action( 'wp_head', 'start_post_rel_link' ,10, 0 );
		remove_action( 'wp_head', 'adjacent_posts_rel_link' ,10, 0 );
		remove_action( 'wp_head', 'wlwmanifest_link' );		
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
		remove_action( 'wp_print_styles', 'print_emoji_styles' );		
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);		
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); //  WooCommerce	
		remove_action( 'wp_head', 'wp_resource_hints', 2 );
		// ADD ON AJAX CALLS
		add_action( 'init', array($this, '_ajax_calls' )  );
		// HOOK UPLOAD AND PRICE FOR AJAX CALLS
		add_action( 'hook_custom_queries', array($this, 'CUSTOMQUERY') );
	 
   		add_action( 'hook_upload', array($this, 'UPLOAD') );
 		add_action( 'hook_price', array($this, 'price_format_display') );
	 
 		add_action( 'hook_date', array($this, 'DATE') );
		add_action( 'hook_logo', array($this, 'Logo') );	
		add_action( 'hook_currency_code', array($this, '_currency_get_code') );
		add_action( 'hook_currency_symbol', array($this, '_currency_get_symbol') );
		
		// ORDER SYSTEM
		add_action('hook_orderid', array($this, 'order_get_orderid') );
		
		// PRIMARY SECONDARY COLORS
		add_filter( 'hook_primary_color_css', array($this, 'CUSTOMMETA_PRIMARY_COLOR') );
		add_filter( 'hook_secondary_color_css', array($this, 'CUSTOMMETA_SECONDARY_COLOR') );
 		
		// EMAIL SETTINGS
		add_filter('wp_mail_from_name', array($this, '_fromname' ));
		add_filter('wp_mail_from', array($this, '_fromemail' ));
		
		add_filter('wp', '_processcontactform');
		
		// COMMENTS PROCESSING
		add_action('wp_insert_comment',  array($this, 'insert_comment_extra') ); 
		add_filter('comment_post_redirect', array( $this, 'redirect_after_comment' ) );
		add_filter( 'preprocess_comment', array($this, '_preprocess_comment' ) );	
		// DELETE COMMENT EXTRAS IN 9.4.3
		add_action('delete_comment', array($this, 'delete_comment_extra' ) );
		//add_action('trash_comment', array($this, 'delete_comment_extra' ) );
		
		// PRESS THIS TYPE
		add_filter('shortcut_link', array($this, 'press_this_ptype') , 11);		
		// HIDE ADMIN
		if(isset($_GET['hideadminbar'])){
		add_filter( 'show_admin_bar', '__return_false' );
		}
		// FIX TEXT WIDGET TITLE;
		add_filter( 'widget_title', array($this, 'widget_title_link' ) );

		// Take over the Plugin info screen
		add_filter('plugins_api', array($this, 'plugin_api_call' ), 10, 3);			 	
 		add_filter('themes_api', array($this, 'themes_api_call' ), 10, 3);
		// ADD ON MENU EDITOR 
		add_action('admin_bar_menu', array($this, 'wlt_adminbar_menu_items' ),  999);
  
		// PAGE TITLE FILTER
		add_filter( 'wp_title', array( $this, 'TITLE' ), 10, 2 );
		add_filter('wpseo_title', array( $this, 'TITLE' ), 10, 2 );
		// DEBUG EMAIL
		add_filter('wp_mail', array($this,'debug_wpmail') ); 
		// CUSTOM MIME TYPES
		add_filter('upload_mimes', array($this, 'my_myme_types')  );		
		// REMOVE ADMIN BAR FROM NON-ADMINS
		if(!current_user_can('administrator')){
		add_filter( 'show_admin_bar', '__return_false' );
		}	
		
		// ONLY INCLUDE POSTS IN YOUR SEARCH RESULTS 
		add_filter( 'pre_get_posts', array($this, '_pre_get_posts'),999 );
		
		// DISTANCE ADD-ON
		if(isset($_GET['ft']) && is_array($_GET['ft']) && ( in_array("nm1", $_GET['ft']) || in_array("nm2", $_GET['ft']) ) ){ 		
		add_filter( 'posts_orderby',array($this, 'distance_extra' ) );
		add_filter( 'posts_distinct', array($this, '_distinct_sql'),  20 );
	 	}
 
		// FIX QUERIES 
		add_action( 'posts_request', array($this, 'fix_queries_2' ) );		
		// EXTRA SEARCH QUERY	
		
		add_filter( 'posts_where', array($this, '_posts_where') ); 
 	
		add_filter( 'posts_join', array($this, 'query_join') );
		add_filter( 'request', array($this, 'my_request_filter' ) );		
		// SETUP FOR EDITING POSTS
		add_action( 'init', array($this, 'wlt_edit_own_caps') );
		// CUSTOM TAXONOMIES
		add_action('init', array($this, 'custom_taxonomies') );	
				
		add_action('init', array($this, 'watermark_create') );			
				
		// CURRENY
		add_action('init',array($this, '_currency_setup') ); 
		add_action('hook_price_filter',array($this, '_currency'), 2);	
			
		// Disables Kses only for textarea saves
		foreach (array('pre_term_description', 'pre_link_description', 'pre_link_notes') as $filter) {
			remove_filter($filter, 'wp_filter_kses');
		}
		// Disables Kses only for textarea admin displays
		foreach (array('term_description', 'link_description', 'link_notes') as $filter) {
			remove_filter($filter, 'wp_kses_data');
		}
		// ADJUST BODY CLASS
		add_filter('body_class', array($this, 'BODYCLASS' ));
	 	
		// IMAGE WATERMARK
		add_filter('hook_image_display', array($this, 'watermark') ); 
		
		// REMOVES MEDIA HEIGHT/WIDTHS
		add_filter( 'post_thumbnail_html',  array($this,  'remove_thumbnail_dimensions' ), 10, 3 );
 	
	// SOCIAL LOGIN
	add_filter('wp', array($this, 	'sociallogin') );
	
	// TEMPLATE ADJUSTMENTS
	add_filter('page_template', array($this, 	'handle_page_template') );
	add_filter('single_template', array($this,	'handle_post_type_template') );
	add_filter('home_template', array($this,	'handle_home_template') );
	add_filter('search_template', array($this, 	'handle_search_template') );
	add_filter('archive_template', array($this, 'handle_search_template') );
	add_filter('taxonomy_template', array($this, 'handle_search_template') );
	add_filter('author_template', array($this, 'handle_author_template') );
  	 
	  
		// LOGIN PAGE 
		add_action('login_form', array($this, 'login_form' ) );
 	
		// SEARCH RESULTS PAGE
		add_filter('hook_gallerypage_results_title', array($this, 'gallerypage_results_title' ) );		 
		add_action('hook_items_before', array($this, 'gallerypage_results_top' ) );		
		
		// TPL-CALLBACK PAGE
		add_action('hook_callback_success',array($this,'_hook_callback_success') );
		
		 	
		// IMAGE ADJUSTMENTS
		add_filter( 'get_avatar' , array($this, 'image_avatar' ) , 1 , 4 );
 		add_filter( 'get_avatar', array($this, 'avatar_remove_dimensions' ), 10 );
		
		// MAP INS EARCH RESULTS
		add_action('hook_core_columns_right_top', array($this, 'hook_map_display' ) );
		add_action('hook_core_columns_left_top', array($this, 'hook_map_display1' ) );
	
		// SELLSPACE ADVERTING HOOKS
		add_action('hook_core_columns_right_bottom', array($this, 'hook_sidebar_bottom' ) );
		add_action('hook_core_columns_left_bottom', array($this, 'hook_sidebar_bottom1' ) );
		
		
			// MEDIA
			add_filter( 'wp_calculate_image_srcset', array($this, 'meks_disable_srcset' ) );
			
			// REMOVE GALLERT FROM PAGES
			add_shortcode('gallery', '__return_false');
 			
			// Take over the update check
			add_filter('pre_set_site_transient_update_plugins', array($this,'check_for_plugin_update' ));
			add_filter('pre_set_site_transient_update_themes', array($this,'check_for_theme_update' ));	
		
				
		 	// THIS CHANGES THE ACTIVE DIRECTORY FOR THEME FILES
			add_action( 'hook_theme_folder', '_ppt_theme_folder' );
			
			
		// HANDLE NEW PAYMENTS
		add_filter('hook_v9_order_process', array($this, '_hook_v9_order_process' ) );
		 
		 
		 
		 ///////////////////////// VERSION 9.3+ ////////////////////
		 add_action( 'pptv9_after_inner_body_open', '_pptv9_after_inner_body_open' ); // header.php
		 add_action( 'pptv9_before_inner_body_close', '_pptv9_before_inner_body_close' ); // footer.php
		 add_action( 'pptv9_after_body_close', '_pptv9_after_body_close' ); // footer.php
		 add_action( 'pptv9_after_wp_footer', '_pptv9_after_wp_footer' ); // footer.php
 		 
		 //DEFAULT HOMEPAGE CUSTOMIZATION 
		 if(!defined('WLT_CHILDTHEME')){
		 	add_action('hook_admin_2_homeedit', array($this, '_hook_admin_2_defaut_homepage_edit' ) );		 	
			if(is_admin()){
			add_filter('hook_v9_admin_elementor_templates', array($this, '_hook_admin_2_defaut_homepage_template'),10 );
			}
		 }
		 
		if(is_admin()){
			add_filter('hook_v9_admin_elementor_templates', array($this, '_hook_admin_2_defaut_extrapages'),10 );
		}
		
	}
	
	function _hook_admin_2_defaut_extrapages($c){
		 
		
		$c['faqpage'] = array(
			//"image" 		=> get_template_directory_uri()."/".THEME_FOLDER.'/template/screenshot.png',
			"name" 			=> "FAQ Page",
			"description" 	=> "Here you can install the FAQ page design using the Elementor page builder plugin.",
			"video" 		=> "",
			"file" 			=> 	$path = TEMPLATEPATH ."/framework/elementor/elementor-faq-default.json",
		
			"page_template"	=> "elementor_header_footer",
			"noview" 		=> true,
		);	
		
		$c['aboutuspage'] = array(
			//"image" 		=> get_template_directory_uri()."/".THEME_FOLDER.'/template/screenshot.png',
			"name" 			=> "About Us Page",
			"description" 	=> "Here you can install the home page design using the Elementor page builder plugin.",
			"video" 		=> "",
			"file" 			=> 	$path = TEMPLATEPATH ."/framework/elementor/elementor-aboutus-default.json",
			
			"page_template"	=> "elementor_header_footer",
			"noview" 		=> true,
		);
		
		$c['contactpage'] = array(
			//"image" 		=> get_template_directory_uri()."/".THEME_FOLDER.'/template/screenshot.png',
			"name" 			=> "Contact Page",
			"description" 	=> "Here you can install the home page design using the Elementor page builder plugin.",
			"video" 		=> "",
			"file" 			=> 	$path = TEMPLATEPATH ."/framework/elementor/elementor-contact-default.json",
		
			"page_template"	=> "elementor_header_footer",
			"noview" 		=> true,
		);
		
		$c['testimonialspage'] = array(
			//"image" 		=> get_template_directory_uri()."/".THEME_FOLDER.'/template/screenshot.png',
			"name" 			=> "Testimonials Page",
			"description" 	=> "Here you can install the home page design using the Elementor page builder plugin.",
			"video" 		=> "",
			"file" 			=> 	$path = TEMPLATEPATH ."/framework/elementor/elementor-test-default.json",
		
			"page_template"	=> "elementor_header_footer",
			"noview" 		=> true,
		);
		
		$c['howpage'] = array(
			//"image" 		=> get_template_directory_uri()."/".THEME_FOLDER.'/template/screenshot.png',
			"name" 			=> "How It Works Page",
			"description" 	=> "Here you can install the home page design using the Elementor page builder plugin.",
			"video" 		=> "",
			"file" 			=> 	$path = TEMPLATEPATH ."/framework/elementor/elementor-how-default.json",
		
			"page_template"	=> "elementor_header_footer",
			"noview" 		=> true,
		);
		
		
		return $c;
	}
	
	function _hook_admin_2_defaut_homepage_template($c){
		
		
		if(THEME_KEY == "sp"){
		$path = TEMPLATEPATH ."/_shop/elementor/elementor-shop-home.json";
		}elseif(THEME_KEY == "cp"){
		$path = TEMPLATEPATH ."/_coupon/elementor/elementor-coupon-home.json";
		}elseif(THEME_KEY == "vt"){
		$path = TEMPLATEPATH ."/_video/elementor/elementor-video-home.json";
		}elseif(THEME_KEY == "dt"){
		$path = TEMPLATEPATH ."/_directory/elementor/elementor-directory-home.json";		
		}else{
		$path = TEMPLATEPATH ."/framework/elementor/elementor-homepage-default.json";
		}
 		
		
		$c['homepage'] = array(
			//"image" 		=> get_template_directory_uri()."/".THEME_FOLDER.'/template/screenshot.png',
			"name" 			=> "Home Page",
			"description" 	=> "Here you can install the home page design using the Elementor page builder plugin.",
			"video" 		=> "",
			"file" 			=> $path,
			"listingpage"	=> true,
			"page_template"	=> "elementor_header_footer",
			"noview" 		=> true,
		);
		
		
		
		return $c;
	}
 	function _hook_admin_2_defaut_homepage_edit($c){
	 
	 
	 	if( in_array(THEME_KEY, array('cp')) ){
		$txt1 = "Latest Deals";
		$txt2 = "Popular Stores";
		}else{
		$txt1 = "Popular Categories";
		$txt2 = "Featured Listings";
		}
		 
		if(THEME_KEY == "sp"){
		
				$new = array(		 
	 
			'hero' => array(		
				"n" => "Hero Image", 
				"desc" => "This image is used for the hero background.",
				"data" => array(
				
					"img1" 		=> array( "t" => "Big Image 1 (825x425 pixels)","type" => "upload", "d" => "https://www.premiumpress.com/_demoimages/shopv9/shopbanner.jpg" ), 					
					"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Summer Sale" ), 
				 	"txt2" 	=> array( "t" => "Subtitle Text","type" => "text", "d" => "Upto 50% Off Home Wear"  ), 
				 	"txt3" 	=> array( "t" => "Description","type" => "textarea", "d" => "Thank you for your purchase, we hope you enjoy this theme. You can add/edit this text and images via the <a href='".home_url()."/wp-admin/admin.php?page=15&tab=content'><u> admin area here.</u></a>"  ), 
				 	 
					
				),		 	
			),
			
				'banner' => array(
				"n" => "Image Banners", 
					"data" => array(
					
					"img1" 		=> array( "t" => "Big Image 1 (580px/190px pixels)","type" => "upload", "d" => "https://www.premiumpress.com/_demoimages/shopv9/shopbanner2.jpg" ), 					
				 	
					"img2" 		=> array( "t" => "Big Image 2 (580px/190px pixels)","type" => "upload", "d" => "https://www.premiumpress.com/_demoimages/shopv9/shopbanner3.jpg" ), 					
				 
							 
					),			
				),
			
			
		);
		
		}elseif(THEME_KEY == "cp"){

		$new = array(		 
	 
			'hero' => array(		
				"n" => "Hero Image", 
				"desc" => "This image is used for the hero background.",
				"data" => array(
				
					"img1" 		=> array( "t" => "Big Image 1 (825x425 pixels)","type" => "upload", "d" =>  "https://www.premiumpress.com/_demoimages/2020/hero_".THEME_KEY.".png"  ), 					
					"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Save Upto 50% Online Now" ), 
				 	"txt2" 	=> array( "t" => "Subtitle Text","type" => "text", "d" => "We bring you the latest deals and offers for popular online stores!"  ), 
			 
				 	 
					
				),		 	
			),
			
				 
			
		);

		
		}else{
		
		$new = array(
		
		
		
	'img1' => array(
				"n" => "Flip Box 1", 
					"data" => array(
						"img" 	=> array( "t" => "Image (285 x 400 pixels)","type" => "upload", "d" => "https://www.premiumpress.com/_demoimages/2020/vt_home1.jpg" ),
						"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Cooking" ),
						"txt2" 	=> array( "t" => "Description Text","type" => "textarea", "d" => "This is some sample text, you can change this text and replace it with your own. This is some sample text, you can change this text and replace it with your own" ),
						"btnlink" 	=> array( "t" => "Link (http://)","type" => "text", "d" => home_url()."/?s=" ),		
						"btntxt" 	=> array( "t" => "Button Texr","type" => "text", "d" => "Search Videos" ),
					),			

				),

			'img2' => array(
				"n" => "Flip Box 2",
					"data" => array(
						"img" 	=> array( "t" => "Image (285 x 400 pixels)","type" => "upload", "d" => "https://www.premiumpress.com/_demoimages/2020/vt_home2.jpg"  ),
						"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Business" ),
						"txt2" 	=> array( "t" => "Description Text","type" => "textarea", "d" => "This is some sample text, you can change this text and replace it with your own. This is some sample text, you can change this text and replace it with your own" ),
						"btnlink" 	=> array( "t" => "Link (http://)","type" => "text", "d" => home_url()."/?s=" ),	
						"btntxt" 	=> array( "t" => "Button Texr","type" => "text", "d" => "Search Videos" ),
					),

				),	 		 

			'img3' => array(
				"n" => "Flip Box 3", 
					"data" => array(
						"img" 	=> array( "t" => "Image (285 x 400 pixels)","type" => "upload", "d" => "https://www.premiumpress.com/_demoimages/2020/vt_home3.jpg"  ),
						"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Craft" ),
						"txt2" 	=> array( "t" => "Description Text","type" => "textarea", "d" => "This is some sample text, you can change this text and replace it with your own. This is some sample text, you can change this text and replace it with your own" ),	
						"btnlink" 	=> array( "t" => "Link (http://)","type" => "text", "d" => home_url()."/?s=" ),	
						"btntxt" 	=> array( "t" => "Button Texr","type" => "text", "d" => "Search Videos" ),
					),			

				),
			'img4' => array(
				"n" => "Flip Box 4", 
					"data" => array(
						"img" 	=> array( "t" => "Image (285 x 400 pixels)","type" => "upload", "d" => "https://www.premiumpress.com/_demoimages/2020/vt_home4.jpg" ),
						"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Photography" ),
						"txt2" 	=> array( "t" => "Description Text","type" => "textarea", "d" => "This is some sample text, you can change this text and replace it with your own. This is some sample text, you can change this text and replace it with your own" ),	
						"btnlink" 	=> array( "t" => "Link (http://)","type" => "text", "d" => home_url()."/?s=" ),	
						"btntxt" 	=> array( "t" => "Button Texr","type" => "text", "d" => "Search Videos" ),
					),			

				),			
		
		 
		 
		'hero' => array(
			"n" => "Hero Image (570x570 pixels)",
			"desc" => "This is the image at the top of your website.", 
			"data" => array(			
				"img1" 		=> array( "type" => "upload", "d" =>  "https://www.premiumpress.com/_demoimages/2020/hero_".THEME_KEY.".png" ), //get_bloginfo('template_url')."/_auction/template/images/hero.png"			 
				"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => THEME_NAME  ), 
				"txt2" 	=> array( "t" => "Subtitle Text ","type" => "text", "d" => THEME_NAME ." Online Demo Website"  ), 
				"txt3" 	=> array( "t" => "Description","type" => "textarea", "d" => "This is a test website to show you some of the awesome features found within our ".THEME_NAME.". Layout, text and images can easily be changed via the admin area."  ),  
				
				"img1_btntxt" 	=> array( "t" => "Button Text ","type" => "text", "d" => "Search Website"  ), 				 	 
				"img1_btnlink" 	=> array( "t" => "Button Link","type" => "text", "d" => home_url()."/?s="  ), 
				 		
			),
		),		
		
		'ctitle1' => array(
				"n" => "Featured Listings", 
					"data" => array(
						"yesno1" 	=> array( "t" => "Display Section","type" => "yesno", "d" => "1"  ), 
						"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Featured" ),
						 
					),			
				),
				
				
			
	 
		'box1' => array(
			"n" => "Middle Content Area (600 x 400 pixels)",
			"desc" => "This is the content area in the middle of your website.", 
			"data" => array(				
				
				"img1" 		=> array( "type" => "upload", "d" => "https://www.premiumpress.com/_demoimages/2020/home_".THEME_KEY.".jpg"  ),	
				"yesno1" 	=> array( "t" => "Display Section","type" => "yesno", "d" => "1"  ), 
					 
				"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Hello &amp; Welcome!"  ), 
				"txt2" 	=> array( "t" => "Subtitle Text ","type" => "text", "d" => "This is a great place to enter your website description - tell visitors more about your website, explain the benefits or joining and why they should use your service.</p><p>Text and images can easily be changed via the admin area."  ), 
				
				
				"btn_txt" 	=> array( "t" => "Button Text ","type" => "text", "d" => "Sign-up Now!"  ), 				 	 
				"btn_link" 	=> array( "t" => "Button Link","type" => "text", "d" => _ppt(array('links','add'))  ), 
				
				
			),			
		),
		
		
		'ctitle2' => array(
				"n" => "Newly Added Listings", 
					"data" => array(
						"yesno1" 	=> array( "t" => "Display Section","type" => "yesno", "d" => "1"  ), 
						"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Newly Added" ),
						 
					),			
				),
				
				
		'ctitle3' => array(
				"n" => "Popular Categories", 
					"data" => array(
						"yesno1" 	=> array( "t" => "Display Section","type" => "yesno", "d" => "1"  ), 
						"txt1" 	=> array( "t" => "Title Text","type" => "text", "d" => "Popular Categories" ),
						 
					),			
				),
	 
				
		); 
		
		
		}
 	 
	
	// NEW HERO FOR VIDEO THEME
	if(!in_array(THEME_KEY , array('vt'))){
	unset($new['img1']);
	unset($new['img2']);
	unset($new['img3']);
	unset($new['img4']);
	}else{
	unset($new['hero']);
	}
	
	if(in_array(THEME_KEY , array('dt'))){
	$new['hero']["n"] = "Hero Image (1920x1280 pixels)";
	unset($new['hero']['data']["txt2"]);
	unset($new['hero']['data']["img1_btntxt"]);
	unset($new['hero']['data']["img1_btnlink"]);
	}
	
	// REMOVE CATEGORY SECTION FOR NONE THEMES 
 	if(in_array(THEME_KEY , array('da','rt'))){
	unset($new['ctitle3']);
	}
	
	 
	
 	return array_merge($c,$new); 
	}

	
 	// REMOVE UNWANTED QUERIES
	function fix_queries_2( $query ) { global $wpdb;
	 
		if ( is_home() && strpos($query,"SELECT $wpdb->posts.*") !== false){
		 
			$query = false;
		} 
		return $query;
	}
 
	/*
		this function assigns the language file
		for the entire theme and text domain prefix
	*/
	function set_theme_languages(){	
 	
		load_theme_textdomain('premiumpress', get_template_directory() . '/languages/');
		 
	}
	 
	
	// PRESS THIS CHANGE
	function press_this_ptype($link) {		
		$link = str_replace('press-this.php', "post-new.php?post_type=".THEME_TAXONOMY."_type", $link);
		$link = str_replace('?u=', '&u=', $link);	
		return $link;
	}
	
	function CUSTOMFIELD_LIST($field,$selected="",$isTranslation=1){ global $wpdb, $CORE; $STRING = ""; $in_array = array(); $statesArray = array();	
 						
				$SQL = "SELECT DISTINCT ".$wpdb->postmeta.".meta_value FROM ".$wpdb->postmeta." 
				INNER JOIN ".$wpdb->posts." ON (".$wpdb->postmeta.".post_id = ".$wpdb->posts.".ID AND ".$wpdb->posts.".post_type = 'listing_type' AND ".$wpdb->posts.".post_status='publish'  )
				WHERE ".$wpdb->postmeta.".meta_key = ('".strip_tags($field)."') LIMIT 0,100";				 
				 
				//if ( WLT_CACHING == false || ( $query = get_transient( 'customfieldlist_query2_'.$field) ) === false   ) {
 
					$query = $wpdb->get_results($SQL, OBJECT);
					//set_transient( 'customfieldlist_query2_'.$field, $query, 24 * HOUR_IN_SECONDS );
				//}
				
				if(!empty($query)){
				
					// LOOK DATA
					foreach($query as $val){
				 
							// ADD TO ARRAY
							$in_array[] 	= $val->meta_value;
							$statesArray[] .= $val->meta_value; 
					}				 						  
					
					// NOW RE-ORDER AND DISPLAY				
					asort($statesArray);					 
					foreach($statesArray as $state){ 
							if(strlen($state) < 2){ continue; }
							if($isTranslation != 1){ $label = $CORE->_e(array($isTranslation,$state)); }else{ $label = $state; }
							
							if($field == "map-country" && isset($GLOBALS['core_country_list'][$state]) ){ $label = $GLOBALS['core_country_list'][$state]; }
							
							if($selected != "" &&  strtolower($state) == strtolower($selected) ){							
								$STRING .= "<option value='".$state."' selected=selected>". $label."</option>";
							}else{
								$STRING .= "<option value='".$state."'>". $label."</option>";
							} // end if	
					}					
					
				}
				
				return $STRING;	
	
	}
		
 


	

	

	
	

 	

	
	function CUSTOMLIST($key,$selected){ global $wpdb, $CORE;
	
		$selected = $_GET['sel']; $in_array = array();	$STRING = "";			
		$SQL = "SELECT DISTINCT ".$wpdb->postmeta.".meta_value FROM ".$wpdb->postmeta." 
				INNER JOIN ".$wpdb->posts." ON ( ".$wpdb->postmeta.".post_id = ".$wpdb->posts.".ID AND ".$wpdb->posts.".post_status='publish')
				WHERE ".$wpdb->postmeta.".meta_key = ('".strip_tags($key)."') LIMIT 0,100";
		$result = mysql_query($SQL, $wpdb->dbh) or die(mysql_error().' on line: '.__LINE__);					 
		if (mysql_num_rows($result) > 0) {
			while ($val = mysql_fetch_object($result)){
				
				$txt = $val->meta_value;
				$value = $val->meta_value;
				
				if($key == "map-country"){
					$c_text = $GLOBALS['core_country_list'][$val->meta_value];
					if($c_text == ""){ continue; }
					$txt = $c_text;
				}				
				
				if($selected != "" &&  $val == $selected){
					$STRING .= "<option value='".$value."' selected=selected>".$txt."</option>";
				}else{
					$STRING .= "<option value='".$value."'>".$txt."</option>";
				} // end if	
			} // end while
		} // end if
	return $STRING;
	}

/* ========================================================================
 [WLT FRAMEWORK] - HEADER
========================================================================== */ 
function make_stylesheet_alt( $tag ) {
 
 $tag = preg_replace( "/='stylesheet' id='__/", "='stylesheet alternate' id='X1", $tag );
 $tag = str_replace("X1", "' title='", $tag );
 $tag = str_replace("id=''", "", $tag );
 $tag = str_replace("__X2-css'", "'", $tag );
 return $tag;
 
}
function CUSTOMMETA_PRIMARY_COLOR($color){
ob_start(); ?><style>
.bg-primary, .ppt-home-block-1 .owl-slider .owl-buttons div, .listing-small .wrap .btn-quickview, footer .socials .social, .section-title::before, .owl-buttons div { background:<?php echo $color; ?> !important; } .btn-primary, .btn-primary:hover { color: #fff; background-color: <?php echo $color; ?> !important; border-color: <?php echo $color; ?> !important; } 
.hero0::after { background:<?php echo $color; ?>f2 !important; } 
.ctitle1 { border-right: 3px solid <?php echo $color; ?>;}
.text-primary { color: <?php echo $color; ?> !important; }
</style><?php $d = ob_get_clean(); return hook_color_primary_css(strip_tags($d));
}
function CUSTOMMETA_SECONDARY_COLOR($color){
ob_start();?><style>.bg-secondary { background:<?php echo $color; ?> !important; } .text-secondary { color: <?php echo $color; ?> !important; }</style><?php $d = ob_get_clean(); return hook_color_secondary_css(strip_tags($d));
}
/* ========================================================================
 [WLT FRAMEWORK] - META TAGS
========================================================================== */ 
function CUSTOMMETA(){ global $wpdb, $CORE; $STRING = "";
 	
	// DISPLAY CUSTOM HEADER CODE
	$custom_head_data = get_option('custom_head');
	if(strlen($custom_head_data) > 1){
		echo "<style>".stripslashes($custom_head_data)."</style>";
	} 
 	
	// DISPLAY MISSING BACKGROUND IMAGE FOR LOGIN PAGES
	if(isset($GLOBALS['flag-register']) || isset($GLOBALS['flag-login']) || isset($GLOBALS['flag-password'])){
	echo _custom_background_cb();
	}
	
	// CUSTOM HEADER IMAGE
	$cheader = get_custom_header();
	if(strlen($cheader->url) > 1){
	ob_start();
	?>
    <style>
	 .overlay { background:url('<?php echo $cheader->url; ?>'); background-size:cover; }
	</style>
	<?php 
	echo ob_get_clean(); 
	}
	 	
	// ADDITIONAL MAP ICON STYLES
	if(strlen(_ppt('googlemap_icon')) > 10){ 	
	ob_start();
	?>
    <style>
	 .map-icon { background:url('<?php echo _ppt('googlemap_icon'); ?>') !important; }
	</style>
	<?php 
	echo ob_get_clean(); 
	}
	
	// PRIMARY AND SECONDARY COLOR SETUP
	if(defined('WLT_DEMOMODE') && isset($GLOBALS['CORE_THEME']['color_primary'])){
	ob_start();
	?>
    <style><?php echo $this->CUSTOMMETA_PRIMARY_COLOR($GLOBALS['CORE_THEME']['color_primary']); ?></style>
	<?php 
	echo ob_get_clean(); 
	}elseif(_ppt('color_primary') != "" && strlen(_ppt('color_primary')) > 2 ){ 	
	ob_start();
	?>
    <style><?php echo $this->CUSTOMMETA_PRIMARY_COLOR(_ppt('color_primary')); ?></style>
	<?php 
	echo ob_get_clean(); 
	}
	// PRIMARY AND SECONDARY COLOR SETUP
	if(_ppt('color_secondary') != "" && strlen(_ppt('color_secondary')) > 2 ){ 	
	ob_start();
	?>
    <style><?php echo $this->CUSTOMMETA_SECONDARY_COLOR(_ppt('color_secondary')); ?></style>
	<?php 
	echo ob_get_clean(); 
	}
	
	
	if(is_single()){
	// CUSTOM IMAGE SRC FOR SOCIAL BUTTONS
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail', true);
	 
		if(isset($thumb_url[0]) && $thumb_url[0] != ""){
		echo '<link rel="image_src" href="'.$thumb_url[0].'" />';
		}
	}
	
	if(isset($_GET['mediaonly'])){
	echo "<style>#main-searchbox, .bs-callout, #steps_left_column, #wpadminbar, #core_header_wrapper, #core_main_breadcrumbs_wrapper, #core_footer_wrapper, #core_menu_wrapper, #core_left_column, #core_right_column, #core_new_header_wrapper, header { display:none; }</style>";	
	}
	
	// COMMENT FORM
    if(isset($_GET['newcomment'])){	
	$GLOBALS['error_message'] = __("Your comments has been saved!","premiumpress");		
	$GLOBALS['newcomment'] = true;
	
	}
}
 
 
/* ========================================================================
 [WORDPRESS INIT] - LOADS WHEN THE PAGE LOADS
========================================================================== */ 
function INIT(){	
		global $wpdb, $CORE, $post, $userdata, $pagenow;
		
		 		
		// DELETE MEDIA OPTIONS	
		if(isset($_POST['core_delete_attachment']) && $_POST['core_delete_attachment'] == "gogo"){	 
			$CORE->UPLOAD_DELETE($_POST['attachement_id']);
			die();		
		} 
		
		//UPLOAD MEDIA UPLOADS
		if(isset($_FILES['core_attachments']) && !empty($_FILES['core_attachments']) && isset($_POST['value']) && is_numeric($_POST['value']) ){ 	 
			$responce = hook_upload($_POST['value'], $_FILES['core_attachments'], false);		 
			echo json_encode($responce); 
			die();				
		}	 

		
		// LOAD IN NEW PAGE SETUP FOR LOGIN SYSTEM
		if(!defined('WLT_CUSTOMLOGINFORM') && !isset($_GET['reauth'])  ){			
			if($pagenow == "wp-login.php" ){
			
				if(!isset($_GET['action'])){ $act = "login"; }else{ $act = strip_tags($_GET['action']); }
				 
				if(in_array($act,array('login','register', 'lostpassword','resetpass','rp', 'membership'))){
				add_action('init', array( $CORE, 'LOGIN' ) , 98); 	
				}
					
			}		
		}		
		
		 
		// LOAD IN CUSTOM STYLES		
		add_action('wp_head',array($CORE, 'ppt_wp_head'), 1 );
		add_action('wp_head',array($CORE, 'CUSTOMMETA') );
			 
		 
		// APPLY COUPON CODE
		if(defined('WLT_CART')){
		global $CORE_CART;
		$CORE_CART->cart_apply_couponcode();		
 		}
		
		// SAVE CUSTOM SEARCHES
		$savekeyword = "";
		if(isset($_GET['zipcode'])){
			$savekeyword = $_GET['zipcode'];
		}elseif(isset($_GET['s'])){
			$savekeyword = $_GET['s'];
		}
		if(strlen($savekeyword) > 3 && strlen($savekeyword) < 30){
		
		$saved_searches_array = get_option('recent_searches');
		
		if(!is_array($saved_searches_array)){ $saved_searches_array = array(); }
	 	
			// STOP HEAVY DATA QUERY
			if(count($saved_searches_array) > 100){
				$saved_searches_array = array();
			}
		
			if(isset($saved_searches_array[strip_tags(str_replace(" ","_",$savekeyword))])){ 
				
				$views = $saved_searches_array[strip_tags(str_replace(" ","_",$savekeyword))]['views'];
				$views++;
				$saved_searches_array[strip_tags(str_replace(" ","_",$savekeyword))] = 
				array(
				"views" => $views, 
				//"first_view" => $saved_searches_array[strip_tags(str_replace(" ","_",$savekeyword))]['first_view'], 
				//"last_view" => date('Y-m-d H:i:s') 
				); 
			
			}else{ 
			
				$saved_searches_array[strip_tags(str_replace(" ","_",$savekeyword))] = 
				array(
				"views" => 1, 
				//"first_view" => date('Y-m-d H:i:s'), 
				//"last_view" => ""
				);			
			}
					 
		update_option('recent_searches',$saved_searches_array);
		}
 
				
	} // END FUN 









/* =============================================================================
	GALLERY PAGE
	========================================================================== */
 
function ValidateCSS($tag){ 
	if(strpos($tag, "http") !== false){	return " url(".$tag.")";}else{	return $tag;}
}
 
/* =============================================================================
	 FEATURED
	========================================================================== */



/* =============================================================================
	 USEFUL BLANK ME FUNCTION
	========================================================================== */

function BLANK($c=""){
return "";
}


 
/* =============================================================================
	 OBJECT EXTRAS
	========================================================================== */
function _custom_query_selection($key){ $STRING = "";

$g = array(
"meta_key=featured&meta_value=yes" => "Only Featured Listings", 
 
"orderby=IDorder=desc" => "Latest Listings", 
"orderby=rand" => "Random Listings",

);

$STRING .= '<select onchange="jQuery(\'#'.$key.'\').val(this.value);"><option value="">--- sample query strings ---</option>';
foreach($g as $k=>$v){
$STRING .= "<option value='".$k."'>".$v."</option>";
}
$STRING .= "</select>";
return $STRING;
}	


function TIMEOUTACCESS($post_id){ global $userdata;

	/// CHECK FOR TIMEOUT ACCESS
	$current_access = get_post_meta($post_id, "timeaccess", true);
	if(!is_array($current_access)){ return true; }

	if(isset($userdata) && $userdata->ID){
	
		$current_membership	= get_user_meta($userdata->ID,'wlt_membership',true);
		
		// 100 is member access id
		if($current_membership == ""){
			$current_membership = "100";
		}
		
		// CHECK
		if(isset($current_access[$current_membership]) ){		
			$time = $current_access[$current_membership]['time'];
			$redirect = $current_access[$current_membership]['link'];		
		}
	
	}else{
		
		// CHECK FOR GUESS ACCESS ID: 99
		if(isset($current_access[99]) ){		
			$time = $current_access[99]['time'];
			$redirect = $current_access[99]['link'];		
		}
	
	}	

	if(isset($time) && is_numeric($time) ){
	
	//CUSTOMIZE REDIRECT
	$GLOBALS['wlt_timeoutacess_redirect'] = str_replace("[ID]",$post_id,$redirect);
	$GLOBALS['wlt_timeoutacess_time'] = $time;
	
	// HOOK META AND REDIRECT	 
	add_action('wp_head',array($this, 'rrddff'));

	}	
	
}

function rrddff(){ echo '<meta http-equiv="refresh" content="'.$GLOBALS['wlt_timeoutacess_time'].'; url='.$GLOBALS['wlt_timeoutacess_redirect'].'">'; }








 
/* ========================================================================
 CONVERTS QUERY STRING INTO ARRAY
========================================================================== */
function CUSTOMQUERY($c){
 
	if(is_string($c)){
		$tt = explode("&",$c); $nArray = array();
		foreach($tt as $g){
			$ff = explode("=",$g);
			if(isset($ff[1])){
				$nArray[str_replace("amp;","",$ff[0])] = $ff[1];
			}
		}
		if(is_array($nArray) && !empty($nArray)){
		
		// add in core search hook
		hook_wlt_core_search();
		
		if(isset($nArray['taxonomy']) && isset($nArray['terms'])){
		
			$nArray['tax_query'][] =  array( 'taxonomy' => $nArray['taxonomy'], 'field' => 'term_id', 'terms' => $nArray['terms'], 'operator'=> 'IN'  );
			// CLEAN UP	
			unset($nArray['taxonomy']);
			unset($nArray['terms']);		 
		}
		
		// CHECK IF CUSTOM FILTERS EXIST
		if(isset($GLOBALS['custom']) && is_array($GLOBALS['custom'])){
			$subArray = array(); $keystack = array(); 
			foreach($GLOBALS['custom'] as $j){
				if(isset($j['key']) && !in_array($j['key'],$keystack)){
				$subArray[]	= $j;
				array_push($keystack,$j['key']);
				}
			}
			if(is_array($subArray) && !empty($subArray)){
			$nArray['meta_query'] =	 $subArray;
			}
		}
		
		$c = $nArray;
		}
	}
		 
	return $c;
}









 

/* =============================================================================
	SCHEMA DATA
========================================================================== */
function ITEMSCOPE($type = "", $val = ""){
	
	if(!isset($GLOBALS['noschema']) && isset($GLOBALS['CORE_THEME']['itemscope']) && $GLOBALS['CORE_THEME']['itemscope'] == '1'){
		
			switch($type){
				
				case "webpage": {
				
				return 'itemscope itemtype="http://schema.org/WebPage"';
				
				} break;
				
				case "itemprop": {
				
				return "itemprop='".$val."'";
				
				} break;				
			
				case "itemtype": {
				
					if(defined('WLT_CART') || defined('WLT_AUCTION') || defined('WLT_AUCTION') ){
					
					return 'itemscope itemtype="http://schema.org/Product"';
					
					}else{
				
					return 'itemscope itemtype="http://schema.org/LocalBusiness"';
					
					}
					
				} break;
			
			}// end switch
	}// end if		
}



 
	

/* =============================================================================
  SORT FUNCTION USED TO RE-ORDER FIELD/PACKAGES
  ========================================================================== */


 
function PAGEEXISTS($page){
return;
$page_exists = false; $core_admin_values = get_option("core_admin_values");  

switch($page){
	
	case "home":
	case "homepage": {
	
		if(file_exists(str_replace("functions/","",THEME_PATH)."/templates/".$core_admin_values['template']."/_homepage.php") 
		
		|| ( defined('CHILD_THEME_NAME') && file_exists(WP_CONTENT_DIR."/themes/".CHILD_THEME_NAME."/_homepage.php") ) ){
		
		return true;
		
		}
		
		if(file_exists(str_replace("functions/","",THEME_PATH)."/templates/".$core_admin_values['template']."/home.php") 
		
		|| ( defined('CHILD_THEME_NAME') && file_exists(WP_CONTENT_DIR."/themes/".CHILD_THEME_NAME."/home.php") ) ){
		
		return true;
		
		}
	
	
	} break;

}


return $page_exists;

}
 


/* =============================================================================
   DISPLAY CATEGORIES
   ========================================================================== */

function CategoryList($data){  global $CORE;

if(!is_array($data)){ return $data; }
 

$id				=$data[0];
$showAll		=$data[1];
$showExtraPrice	=$data[2]; 
$TaxType		=$data[3];
if(isset($data[4])){ $ChildOf	= $data[4];  }else{$ChildOf="";  }
if(isset($data[5])){ $hideExCats	= $data[5];  }else{ $hideExCats=""; }
if(isset($data[6])){$ShowCatPrice	= $data[6];   }else{ $ShowCatPrice	= "";  }

 
global $wpdb; $exclueMe=array(); $extra = ""; $count=0; $limit = 200; $STRING = ""; $ShowCatCount = get_option("display_categories_count");	$exCats=0;  $largelistme = false; $opgset = false;

// IF WE ARE GOING TO SHOW THE CATPRICE, LETS INCLUDE THE CAT PRICE ARRAY
if($ShowCatPrice){ $current_catprices = get_option('wlt_catprices'); }


 
// WHICH TYPE OF CATEGORY LIST TO DISPLAY?
if($showAll == "toponly"){
		
		if($TaxType == "category"){
			$args = array(
			'taxonomy'              => $TaxType,
			'child_of'              => $ChildOf,
			'hide_empty'            => $largelistme,
			'hierarchical'          => 0,
			'use_desc_for_title'	=> 1,
			'pad_counts'			=> 1,
			'exclude'               => $exCats,
			);			
		}else{
			$args = array(
			'taxonomy'              => $TaxType,
			'child_of'              => $ChildOf,
			'hide_empty'            => $largelistme,
			'hierarchical'          => 0,
			'use_desc_for_title'	=> 1,
			'pad_counts'			=> 1,
			);			
		}
		 
			$categories = get_categories($args);  
			
		 	if(is_array($categories)){
			foreach($categories as $category) {
			 	// SKIP	
				if ($category->parent > 0 && $ChildOf == 0) { continue; }
				if($ChildOf > 0 && $ChildOf != $category->parent){ continue; }				
				// BUILD DISPLAY				
				$STRING .= '<option value="'.$category->cat_ID.'" ';
				if( ( is_array($id) && in_array($category->cat_ID,$id) ) ||  ( !is_array($id) && $id == $category->cat_ID ) ){
				$STRING .= 'selected=selected';
				}
				$STRING .= '>';
				
				
				$STRING .= $category->cat_name;
				
				
				// SHOW PRICE
				if($ShowCatPrice && isset($current_catprices[$category->cat_ID]) 
				&& ( isset($current_catprices[$category->cat_ID]) && is_numeric($current_catprices[$category->cat_ID]) && $current_catprices[$category->cat_ID] > 0 ) ){ 
				 	$STRING .= " (".hook_price($current_catprices[$category->cat_ID]).')'; 
				}
				// SHOW COUNT
				if($ShowCatCount =="yes"){ $STRING .= " (".$category->count.')'; }			 
				$STRING .= '</option>';
		
			}			
			}
			return $STRING;	
		
/* =============================================================================
   DISPLAY ALL CATEGORIES
   ========================================================================== */
		
		}else{
 		
		$args = array(
		'taxonomy'                 => $TaxType,
		'child_of'                 => $ChildOf,
		'hide_empty'               => $largelistme,
		'hierarchical'             => true,
		'exclude'                  => $exCats);
 	
		$cats  = get_categories( $args );
 
		$newcatarray = array(); $addedAlready = array(); $opgset = false;
		
		// SHOW OPTGROUP
		if(isset($GLOBALS['tpl-add']) && isset($GLOBALS['CORE_THEME']['disablecategory']) && $GLOBALS['CORE_THEME']['disablecategory'] == 1){
		$showopg = true;
		}else{
		$showopg = false;
		}
	
		// NOW WE BUILD A CLEAN ARRAY OF VALUES
		foreach($cats as $cat){	
		 
			if($cat->parent != 0){ continue; }		
			$newcatarray[$cat->term_id]['term_id'] 	=  $cat->term_id;
			
			
			
		// CHECK FOR CATEGORY TRANSLATIONS
		$catTrans = _ppt('category_translation');
		$lang = $CORE->_language_current();
		
		$cat_name = $cat->cat_name;
		
		if($catTrans != "" && $lang != "en_US"){ 
			if(isset($catTrans[strtolower($lang)]) && isset($catTrans[strtolower($lang)][$cat->term_id]) ){			
				$cat_name = $catTrans[strtolower($lang)][$cat->term_id];			
			}		
		}
			
			
		$newcatarray[$cat->term_id]['name'] 	=  $cat_name;
			
			
			
			
			
			
			
			// SHOW PRICE
			if($ShowCatPrice && isset($current_catprices[$cat->term_id]) 
				&& ( isset($current_catprices[$cat->term_id]) && is_numeric($current_catprices[$cat->term_id]) && $current_catprices[$cat->term_id] > 0 ) ){ 
				 	$newcatarray[$cat->term_id]['name'] .= " (".hook_price($current_catprices[$cat->term_id]).')'; 
			}
			$newcatarray[$cat->term_id]['parent'] 	=  $cat->parent;
			$newcatarray[$cat->term_id]['slug'] 	=  $cat->slug;
			$newcatarray[$cat->term_id]['count'] 	=  $cat->count;
		}
		// SECOND LOOP TO GET CHILDREN
		foreach($cats as $cat){
	 
			if($cat->parent == 0){ continue; }		
			$newcatarray[$cat->parent]['child'][] = $cat;		 
		}
 		 // NOW BUILD THE MAIN ARRAY
		foreach($newcatarray as $cat){
		  	
			if(!isset($cat['term_id'])){ continue; }
			
			// CHECK IF THIS IS SELECTED
			if( ( is_array($id) && in_array($cat['term_id'],$id) ) ||  ( !is_array($id) && $id == $cat['term_id'] ) ){ $EX1 = 'selected=selected'; }else{ $EX1 = ""; }
						
			if(!$showopg && !in_array($cat['term_id'], $addedAlready) && $cat['name'] !=""){ 	 
			
			$STRING .= '<option value="'.$cat['term_id'].'" '.$EX1.'>'.$cat['name'].'</option>';
			
			}elseif($showopg && !in_array($cat['term_id'], $addedAlready) && $cat['name'] !=""){ 			
					if(isset($opgset)){ $STRING .= '</optgroup>'; }
					$opgset = true;					
					$STRING .= '<optgroup data-parent="optiongroup" label="'.$cat['name'].'">';
			}
			
			
			$addedAlready[] = $cat['term_id'];
			 	
			if(!empty($cat['child'])){	
				foreach($cat['child'] as $sub1){ 
				 			
							// CHECK IF THIS IS SELECTED
							if( ( is_array($id) && in_array($sub1->term_id,$id) ) ||  ( !is_array($id) && $id == $sub1->term_id ) ){ $EX2 = 'selected=selected'; }else{ $EX2 = ""; }
							
							// SHOW PRICE
							if($ShowCatPrice && isset($current_catprices[$sub1->term_id]) 
								&& ( isset($current_catprices[$sub1->term_id]) && is_numeric($current_catprices[$sub1->term_id]) && $current_catprices[$sub1->term_id] > 0 ) ){ 
									$sub1->name .= " (".hook_price($current_catprices[$sub1->term_id]).')'; 
							}
														
							// OUTPUT
							if(!in_array($sub1->term_id, $addedAlready)){ 
							$STRING .= '<option value="'.$sub1->term_id.'" '.$EX2.'> -- '.$sub1->name.'</option>';
							}
							$addedAlready[] = $sub1->term_id;
							 
							// CHECK FOR SUB CATS LEVEL 2
							if(!empty($newcatarray[$sub1->term_id]['child'])){  
							 
								foreach($newcatarray[$sub1->term_id]['child'] as $sub2){
									
									// CHECK IF THIS IS SELECTED
									if( ( is_array($id) && in_array($sub2->term_id,$id) ) ||  ( !is_array($id) && $id == $sub2->term_id ) ){ $EX3 = 'selected=selected'; }else{ $EX3 = ""; }
																		
									// OUTPUT
									if(!in_array($sub2->term_id, $addedAlready)){ 
									$STRING .= '<option value="'.$sub2->term_id.'" '.$EX3.'> ---- '.$sub2->name.'</option>';	
									}
									$addedAlready[] = $sub2->term_id;						
									 
									// CHECK FOR SUB CATS LEVEL 2
								 
									if(!empty($newcatarray[$sub2->term_id]['child'])){ 
										foreach($newcatarray[$sub2->term_id]['child'] as $sub3){
									
											// CHECK IF THIS IS SELECTED
											if( ( is_array($id) && in_array($sub3->term_id,$id) ) ||  ( !is_array($id) && $id == $sub3->term_id ) ){ $EX4 = 'selected=selected'; }else{ $EX4 = ""; }
																						
											// OUTPUT
											if(!in_array($sub3->term_id, $addedAlready)){ 
											$STRING .= '<option value="'.$sub3->term_id.'" '.$EX4.'> ------ '.$sub3->name.'</option>';	
											}
											$addedAlready[] = $sub3->term_id;	
											
											
											// CHECK FOR SUB CATS LEVEL 2
											if(!empty($newcatarray[$sub3->term_id]['child'])){ 
												foreach($newcatarray[$sub3->term_id]['child'] as $sub4){										
										
													// CHECK IF THIS IS SELECTED
													if( ( is_array($id) && in_array($sub4->term_id,$id) ) ||  ( !is_array($id) && $id == $sub4->term_id ) ){ $EX4 = 'selected=selected'; }else{ $EX4 = ""; }
												
													
													// OUTPUT
													if(!in_array($sub4->term_id, $addedAlready)){ 
													$STRING .= '<option value="'.$sub4->term_id.'" '.$EX4.'> ------ '.$sub4->name.'</option>';	
													}
													$addedAlready[] = $sub4->term_id;	
																							
												}
											} 
										 									
										}										
									}
									
								}
						}
							
				}
			}
			 	
		
		} // end foreach
		
		if($opgset){ $STRING .= '</optgroup>'; }
  	
		return $STRING;		

	}
}

 /* =============================================================================
   CUSTOM FIELD DISPLAY FUNCTION
   ========================================================================== */

function CUSTOMFIELDLIST($value1="", $key="meta_key"){
	
		global $wpdb; $STRING = ""; $STRING1 = ""; $cleanArray = array(); $removeValues = array('map-country','map-state','map-city');		
		
				 	
		$SQL = "SELECT DISTINCT ".$key." FROM $wpdb->postmeta LIMIT 200";
			 
		$last_posts = (array)$wpdb->get_results($SQL);
		$savestring = array();
		foreach($last_posts as $value){			
			$savestring[] = $value->meta_key;		
		}
			
		asort($savestring);		 
		
		foreach($savestring as $k => $value){
		
			//CLEAN UP
			if(substr($value,0,1) == "_"){ continue; }
				 	
			if(is_array($value1) && in_array($value,$value1)){
					$STRING .= "<option value='".$value."' selected>".$value."</option>";
			}elseif(!is_array($value1) && $value1 == $value){
					$STRING .= "<option value='".$value."' selected>".$value."</option>";
			}else{
					$STRING .= "<option value='".$value."'>".$value."</option>";
			}
		}
		
		return $STRING;
	 
}








 
/* =============================================================================
  PAGE ACCESS
   ========================================================================== */

 
 
// RETUNS A COUNT FOR HOW MANY PACKAGES ARE VISIBLE (NOT HIDDEN)
function _PACKNOTHIDDEN($c){ $count = 0;
if(is_array($c) && !empty($c) ){
	foreach($c as $v){
		if( ( !isset($v['hidden']) ) || ( isset($v['hidden']) && $v['hidden'] != "yes" )){
		$count++;
		}
	}
}
return $count;
} 

 
// FIX BLANK TEXT WIDGET TITLES
function widget_title_link( $title ) {
	return $title."&nbsp;";
}
 


function reports($date1, $date2, $runnow=false, $returnSQL=false){ global $wpdb, $CORE, $userdata; $SQL = array(); $core_admin_values = get_option("core_admin_values");

	// IF ITS A CRON, MAKE SURE THE USER HAS ENABLED THE REPORT AND EMAIL
	if(!$runnow){
		if(!isset($core_admin_values['wlt_report']) || isset($core_admin_values['wlt_report']['email']) && $core_admin_values['wlt_report']['email'] == ""  ){
		return "";
		}
	}
 		
 	// DEFAULTS FOR DATES
	if($date1 == ""){ $date1 = date('Y-m-d', strtotime('-7 days')); }
	if($date2 == ""){ $date2 = date('Y-m-d'); }
	 	
		// TOP 10 RECENT LISTINGS
		if(_ppt(array('wlt_report','f1')) == 1 || $returnSQL == true){
			 
			$SQL[] = array(
					"sql" => "SELECT ID, post_title, post_date FROM ".$wpdb->posts." 
					WHERE ".$wpdb->posts.".post_status='publish'
					AND ".$wpdb->posts.".post_type='".THEME_TAXONOMY."_type'
					AND ".$wpdb->posts.".post_date >= '" .$date1. "' AND ".$wpdb->posts.".post_date < '".$date2."'
					ORDER BY ".$wpdb->posts.".ID DESC
					LIMIT 0,10", 
			"title" => "10 MOST RECENT LISTINGS",
			"date" => true,					
			);		
		 
		}// end f1
				
		// TOP 10 POPULAR LISTING
		if(_ppt(array('wlt_report','f2')) == 1 || $returnSQL == true){
				
			$SQL[] = array(
					"sql" => "SELECT ".$wpdb->posts.".ID, ".$wpdb->posts.".post_title, ".$wpdb->postmeta.".meta_value FROM ".$wpdb->posts." 
					INNER JOIN ".$wpdb->postmeta." ON ( ".$wpdb->postmeta.".post_id = ".$wpdb->posts.".ID AND ".$wpdb->posts.".post_status='publish' AND ".$wpdb->posts.".post_type='".THEME_TAXONOMY."_type')
					WHERE ".$wpdb->postmeta.".meta_key = ('hits')
					AND ".$wpdb->posts.".post_date >= '" . $date1 . "' AND ".$wpdb->posts.".post_date < '".$date2."'
					ORDER BY ".$wpdb->postmeta.".meta_value+0 DESC
					LIMIT 0,10",
			"title" => "10 MOST POPULAR LISTINGS",
			"hits" => true,
			);	
				
		} // end f2
				
		// TOP 10 USER RATED LISTINGS
		if(_ppt(array('wlt_report','f3')) == 1 || $returnSQL == true){
				
			$SQL[] = array(
					"sql" => "SELECT ".$wpdb->posts.".ID, ".$wpdb->posts.".post_title, ".$wpdb->postmeta.".meta_value FROM ".$wpdb->posts." 
					INNER JOIN ".$wpdb->postmeta." ON ( ".$wpdb->postmeta.".post_id = ".$wpdb->posts.".ID AND ".$wpdb->posts.".post_status='publish' AND ".$wpdb->posts.".post_type='".THEME_TAXONOMY."_type')
					WHERE ".$wpdb->postmeta.".meta_key = ('starrating_votes')
					AND ".$wpdb->posts.".post_date >= '" . $date1 . "' AND ".$wpdb->posts.".post_date < '".$date2."'
					ORDER BY ".$wpdb->postmeta.".meta_value+0 DESC
					LIMIT 0,10",
			"title" => "10 MOST RATED LISTINGS",
			"rating" => true,
			);	
				
		} // end f3
				
		// TOP 10 ORDERS
		if(_ppt(array('wlt_report','f4')) == 1 || $returnSQL == true){
				
			$SQL[] = array(
					"sql" => "SELECT order_id as post_title, order_total as meta_value, autoid as meta_value1 FROM `".$wpdb->prefix."core_orders`
					WHERE ".$wpdb->prefix."core_orders.order_date >= '" . $date1 . "' AND ".$wpdb->prefix."core_orders.order_date < '".$date2."'
					ORDER BY ".$wpdb->prefix."core_orders.autoid DESC LIMIT 0,10",
			"title" => "10 MOST RECENT ORDERS",
			"orders" => true,
			); 
				
		} // end f4
				
		// TOP 10 SEARCH TERMS
		if(_ppt(array('wlt_report','f5')) == 1 || $returnSQL == true){
				
			$saved_searches_array = get_option('recent_searches');
			if(is_array($saved_searches_array) && !empty($saved_searches_array) ){ 
						 
						$saved_searches_array = $CORE->multisort( $saved_searches_array, array('views') ); $jj = array(); $i =0;
						foreach($saved_searches_array  as $key=>$searchdata){ if($i > 11){ continue; }
						
							if(strtotime($searchdata['first_view']) >= strtotime( date('Y-m-d H:i:s', strtotime('-7 days')) ) ){							
								$jj[$i]['post_title'] = str_replace("_"," ",$key);
								$jj[$i]['views'] = $searchdata['views'];
								$i++;
							}
						} // foreach
						
						$SQL[] = array(
						"sql" => "none",
						"title" => "10 MOST SEARCHED KEYWORDS",
						"array" => $jj
						);
											
			}
				
		} // end f5
 								
		// TOP 10 COMMENTS
		if(_ppt(array('wlt_report','f6')) == 1 || $returnSQL == true){
				
			$SQL[] = array(
				 	
				"sql" => "SELECT DISTINCT ".$wpdb->comments.".comment_ID, ".$wpdb->comments.".comment_content AS post_title  
					FROM ".$wpdb->comments."
					LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) 
					WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' AND ".$wpdb->comments.".comment_date >= '" . $date1 . "' AND ".$wpdb->comments.".comment_date < '".$date2."'
					ORDER BY comment_date_gmt DESC LIMIT 10",
				"title" => "10 LATEST COMMENTS"
				); 
				 
			} // end f6
				
		// TOP 10 AUTHORS
		if(_ppt(array('wlt_report','f7')) == 1 || $returnSQL == true){
			 
			$SQL[] = array(
					"sql" => "SELECT count(".$wpdb->posts.".ID) AS meta_value, ".$wpdb->users.".user_nicename AS post_title, ".$wpdb->posts.".post_author FROM ".$wpdb->posts." 
					INNER JOIN ".$wpdb->users." ON ( ".$wpdb->posts.".post_author = ".$wpdb->users.".ID )
					WHERE ".$wpdb->posts.".post_date >= '" . $date1 . "' AND ".$wpdb->posts.".post_date < '".$date2."'
					AND ".$wpdb->posts.".post_status='publish' AND ".$wpdb->posts.".post_type='".THEME_TAXONOMY."_type' 
					GROUP BY ".$wpdb->users.".user_nicename
					LIMIT 0,10",
				"title" => "10 MOST ACTIVE AUTHORS",
				"users" => true,
				); 
					 	 
		}// end f1
		
		if($returnSQL){ return $SQL; };
	 	
		// LOOP THROUGH AND RUN THE SQL QUERIES
		if(is_array($SQL)){ $STRING = "";
			
			foreach($SQL as $querystr){
				 
				if($querystr['sql'] == "none"){
						
							$STRING .= "<h4>".$querystr['title']."</h4><hr />";						
							$STRING .= '<div id="tb1" style="padding:20px; background:#fafafa"><table>';
								foreach ( $querystr['array'] as $r ) {									 
									$STRING .= "<tr>
										<td>".$r['post_title']."</td>
										<td>".$r['views']." Searches</td>
										<td><a href='".get_home_url().'/?s='.$r['post_title']."' style='text-decoration:none;background-color:#CC0000;color:#fff;padding:5px;'>Link</a><br></td>
									  </tr>";
								} // end foreach		
							$STRING .= "</table></div>";
						
										
				}else{ 
					$results = $wpdb->get_results($querystr['sql']);						
					$STRING .= "<h4>".$querystr['title']."</h4>";	
					if(!empty($results)){						
							$STRING .= '<div id="tb1"><table>';
								foreach ( $results as $r ) {
									 $hits = "";
									if(isset($querystr['hits'])){
										$hits = get_post_meta($r->ID,'hits',true);
										if($hits == ""){ $hits = "0 views"; }else{ $hits = $hits." views"; }
									}
									if(isset($querystr['date'])){
										$hits = hook_date($r->post_date);
									}
									if(isset($querystr['rating'])){
										$hits = $r->meta_value ." votes";
									}
									if(isset($querystr['users']) ){
										$hits = $r->meta_value ." listings";
										$link = get_home_url()."/?s=&uid=".$r->post_author;
									}elseif($querystr['orders']){
										$hits = hook_currency_symbol('')."".$r->meta_value ."";
										$link = get_home_url()."/wp-admin/admin.php?page=6&id=".$r->meta_value;
									}else{
										$link = get_permalink($r->ID);
									}
									
									$STRING .= "<tr>
										<td>".$r->post_title."</td>
										<td>".$hits."</td>
										<td><a href='".$link."' style='text-decoration:none;background-color:#CC0000;color:#fff;padding:5px;'>Link</a><br></td>
									  </tr>";
								} // end foreach		
							$STRING .= "</table></div>";	
					}else{
					$STRING .= "No record found";
					}		
				} // end if	
			}// end foreach	
		 	
				
		} // end if 
	
	} // end report function 
 
/* =============================================================================
ADMIN MENU BAR EXTRAS
========================================================================== */

	// CUSTOM EDIT BAR OPTIONS
	function wlt_adminbar_menu_items($wp_admin_bar){ global $post;
 
 			if(is_single()){
 			//$wp_admin_bar->remove_node( 'edit' );
			}
			$wp_admin_bar->remove_node( 'new-post' );
    		$wp_admin_bar->remove_node( 'new-link' );
    		$wp_admin_bar->remove_node( 'new-media' );
 
 			/*
 			$wp_admin_bar->add_node(array(
			'id' => 'wlt_adminbar_theme-editor',
			'title' => '<i class="dashicons dashicons-admin-appearance" style="font-family: dashicons; font-size:18px;"></i>  Theme Customize',
			'meta'  => array( 'class' => 'admin-toolbar-editor' ),
			'href' => home_url().'/wp-admin/admin.php?page=15',
			));
			*/
			
		 
			
			return $wp_admin_bar;
		  
	
		
	}
	

	


 
 	
	
}// END CLASS










































/* =============================================================================
CRON JOBS
========================================================================== */

function premiumpress_hourly_event_hook_do(){ global $CORE, $wpdb;

	// PERFORM LISTING EXPIRY
	$CORE->handle_listings_expire();
	
	// DELETE TEMP POSTS
	$SQL = "SELECT DISTINCT ID FROM $wpdb->posts WHERE post_title='temp post' LIMIT 100";			 
	$fp = $wpdb->get_results($SQL, ARRAY_A);
	if(is_array($fp) && !empty($fp)){
		foreach($fp as $d){
			wp_delete_post( $d['ID'], true );
			$CORE->ADDLOG("Deleted Temp Post (".$d['ID'].")", 0 ,0, 'label-info', "cron", "");
		}
	} 
	
	// OLINE FLAG
	delete_post_meta_by_key( 'online' );   	
	
	// ADD LOG
	$CORE->ADDLOG("Hourly Cron Finished", 0 ,0, 'label-info', "cron", "");
	
	 
}
function premiumpress_twicedaily_event_hook_do(){ global $CORE;

	// ADD LOG
	$CORE->ADDLOG("Twice Daily Cron Finished", 0 ,0, 'label-info', "cron", "");

}
function premiumpress_daily_event_hook_do(){ global $CORE;
	
	// EMAIL THE REPORT DAILY
	$CORE->reports(date('Y-m-d H:i:s'),date('Y-m-d H:i:s' , strtotime('-2 days')),false);
	
	// PERFORM SUBSCRIPTIONS
	$CORE->orders_cron_subscriptions();
 	
	// PERFORM EMAIL TASKS
	$CORE->cron_emails();
	
	// ADD LOG
	$CORE->ADDLOG("Daily Cron Finished", 0 ,0, 'label-info', "cron", "");
 
}



add_action( 'wp', 'premiumpress_cron_activation' );
add_action( 'premiumpress_hourly_event_hook', 'premiumpress_hourly_event_hook_do' );
add_action( 'premiumpress_twicedaily_event_hook', 'premiumpress_twicedaily_event_hook_do' );
add_action( 'premiumpress_daily_event_hook', 'premiumpress_daily_event_hook_do' ); 

function premiumpress_cron_activation() {
    if ( !wp_next_scheduled( 'premiumpress_hourly_event_hook' ) ) {
        wp_schedule_event( time(), 'hourly', 'premiumpress_hourly_event_hook' );
    }
	
    if ( !wp_next_scheduled( 'premiumpress_twicedaily_event_hook' ) ) {
        wp_schedule_event( time(), 'twicedaily', 'premiumpress_twicedaily_event_hook' );
    }
	
    if ( !wp_next_scheduled( 'premiumpress_daily_event_hook' ) ) {
        wp_schedule_event( time(), 'daily', 'premiumpress_daily_event_hook' );
    }
}

 
?>