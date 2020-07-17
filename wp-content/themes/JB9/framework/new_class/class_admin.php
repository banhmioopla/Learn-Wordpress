<?php
 
class wlt_admin extends wlt_admin_design { 
 

	function __construct(){ global $pagenow, $CORE, $userdata;
	
 		
		// ADD IN TAXONOMY ORDERING FUNCTIONS
	 	add_action('admin_menu', 'wlt_orderby_PluginMenu', 99);
	
 	 
		// 0. SWITCHED THEME
		add_action('switch_theme', 			array($this,'_theme_deactivated') );
		add_action('after_switch_theme', 	array($this,'_theme_activated') );
 	 
		// 1. ADMIN STYLES IN HEADER/FOOTER
		add_action('admin_head', 	array($this, '_admin_head' ) );
		add_action('admin_footer', 	array($this, '_admin_footer') );
		add_action('admin_enqueue_scripts', array($this, '_admin_enqueue_scripts') );
		
		// REMOVE PASSWORD FROM ADMIN
		if( !current_user_can( 'edit_user', $userdata->ID ) ) {
			add_filter( 'show_password_fields', '__return_false' );			
		}
		
		// 2. LOAD IN ADMIN MENU
		add_action('admin_menu', 	array($this, '_admin_menu' ) ); 
		add_action('admin_menu', 	array($this, '_admin_menu_plugins' ) );
		// 3. MAIN INIT
		add_action('init',	array($this, '_init' ) );
		
		// 3. ADMIN INIT
		add_action('admin_init',	array($this, '_admin_init' ), 999);
		 
		//add_action('add_meta_boxes', array($this, '_add_meta_boxes' ) );
		//add_filter('tiny_mce_before_init', array( $this, 'myformatTinyMCE' ) );
		
		add_filter('wp_dropdown_users', array($this, '_wp_dropdown_users' ) );
 
		 
		// LISTING CATEGORY
		add_filter('edited_terms', array( $this, 'wlt_update_icon_field' )); 
	 	 
			
			// ADMIN USER FIELDS
			add_action('show_user_profile', array($this,'extra_user_profile_fields') );
			add_action('edit_user_profile', array($this,'extra_user_profile_fields') );
			add_action('personal_options_update', array($this,'save_extra_user_profile_fields') );
			add_action('edit_user_profile_update', array($this,'save_extra_user_profile_fields') );	
			add_filter('user_contactmethods', array($this,'userfields'),10,1);			
			
			// CUSTOMIZE - POSTS DISPLAY PAGE
			add_filter('manage_posts_columns', array( $this, '_admin_remove_columns' ));
			add_filter('manage_posts_columns', array( $this, '_admin_custom_columns' ) );	
			add_action('manage_posts_custom_column', array( $this, '_admin_custom_column_data' ), 10, 2);
			add_filter('manage_edit-listing_type_sortable_columns', array( $this, '_admin_column_register_sortable' ) );
			add_filter('request', array( $this, '_admin_column_orderby' ) ); 
		
			// CUSTOMIZE - USERS
			add_filter('manage_users_columns', array($this, 'contributes' ) );
			add_action('manage_users_custom_column', array($this, 'contributes_columns' ) , 10, 3);		
			add_filter( 'manage_users_sortable_columns', array($this, 'contributes_sortable_columns' ) );
			
			// CUSTOMIZE - PAYMENTS
			add_filter('manage_wlt_payments_posts_columns', array( $this, '_admin_remove_columns' ));			
			add_filter('manage_wlt_payments_posts_columns',  array( $this, '_admin_custom_columns' )  );	
			add_action('manage_wlt_payments_posts_custom_column',  array( $this, '_admin_custom_column_data') , 10, 3  );	
			
			// CUSTOMIZE - INVOICE
			add_filter('manage_wlt_invoices_posts_columns', array( $this, '_admin_remove_columns' ));			
			add_filter('manage_wlt_invoices_posts_columns',  array( $this, '_admin_custom_columns' )  );	
			add_action('manage_wlt_invoices_posts_custom_column',  array( $this, '_admin_custom_column_data') , 10, 3  );					
			
			// CUSTOMIZE - BANNERS
			add_filter('manage_wlt_banner_posts_columns', array( $this, '_admin_remove_columns' ));			
			add_filter('manage_wlt_banner_posts_columns',  array( $this, '_admin_custom_columns' )  );	
			add_action('manage_wlt_banner_posts_custom_column',  array( $this, '_admin_custom_column_data') , 10, 3  );	
		
			// CUSTOMIZE - CAMPAIGN
			add_filter('manage_edit-wlt_campaign_sortable_columns', array( $this, '_admin_column_register_sortable' ) );
			add_filter('manage_wlt_campaign_posts_columns', array( $this, '_admin_remove_columns' ));			
			add_filter('manage_wlt_campaign_posts_columns',  array( $this, '_admin_custom_columns' )  );	
			add_action('manage_wlt_campaign_posts_custom_column',  array( $this, '_admin_custom_column_data')  , 10, 3  );	
 			

			/*
				Here we allow saving of custom post_meta data
				so we dont need to keep declaring it
			*/
			add_action('admin_menu', array($this, 	'_custom_metabox' ) );		 	
			add_action('save_post', array($this, '_custom_metabox_save') );
			 
	
		// MASSS UPLOAD OPION
		add_action('init','upload_massimport');
 
	} 
	
	
 
	
	
 
	// THEME IS ACTIVATED 
	function _theme_activated(){
		 
		add_action('admin_footer', array($this, 'pointer_welcome' ) );
 
	}
	// THEME IS DEACTIBATED
	function _theme_deactivated(){
	
		//add_action('admin_footer', array($this, 'pointer_welcome' ) );
	
		core_admin_01_theme_deactivated();
	}
	// LOAD IN STYLES
	function _admin_enqueue_scripts(){ global $post;	
	  
		wp_register_style( 'wlt_admin_styles', FRAMREWORK_URI.'admin/css/wpglobal.css');
		wp_enqueue_style( 'wlt_admin_styles' ); 
 	
		wp_register_script( 'wlt_admin_script', FRAMREWORK_URI.'admin/js/admin-global.js');
		wp_enqueue_script( 'wlt_admin_script' ); 
		
		if( ( isset($_GET['post_type']) && $_GET['post_type'] == "listing_type" ) || (isset($post->post_type) && $post->post_type == "listing_type" ) ){
		
			// TOOLTIP
			wp_enqueue_script('jquery-ui-tooltip');
 	
			 
		}		
	
	}
	// THEME HEADER STYLES
	function _admin_head(){ global $pagenow, $CORE, $post;
 
 
		switch($pagenow){
			
 
			case "users.php": {
				
				// SET LAST VIEWED TIME
				update_option('ppt_users_lastviewed', $CORE->DATETIME() );

			} break;
			
			case "term.php": {
				if(isset($_GET['taxonomy']) &&  ($_GET['taxonomy'] == "listing")) { 
				wp_enqueue_style('wn-style', THEME_URI .'/framework/css/backup_css/css.framework.css', array(), '1.0');
				}
			} break;
			case "edit.php": {
				
				// FOR POP-UP EDITORS ON LISTING RESULTS SCREEN
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
				wp_enqueue_style('thickbox'); 
			
			} break;
			case "theme-install.php":
			case "themes.php": {		
				// ADD IN EXTRAS
				wp_register_script( 'ex1',  FRAMREWORK_URI.'admin/js/extra1.js');
				wp_enqueue_script( 'ex1' );
			} break;
			case "widgets.php": {
			
				wp_enqueue_script('wf_wn_common', THEME_URI .'/framework/widgets/js/wn-common.js', array(), '1.0');
				wp_enqueue_script('wf_wn_tipsy', THEME_URI .'/framework/widgets/js/jquery.tipsy.js', array(), '1.0');
				wp_enqueue_script('jquery-ui-dialog');
				
				wp_enqueue_style('wp-jquery-ui-dialog');
				wp_enqueue_style('wn-style', THEME_URI .'/framework/widgets/css/wn-style.css', array(), '1.0');
		
				// only for IE, no comment :(
				add_action('admin_head', array('wf_wn', 'admin_header'));
		
				// help content for tooltips
				add_action('admin_footer', array('wf_wn', 'admin_footer'));
				wp_register_style( 'extended-tags-widget', THEME_URI .'/framework/widgets/css/widget.css' );
				wp_enqueue_style( 'extended-tags-widget' );	 
				wp_enqueue_style( 'extended-tags-widget', THEME_URI .'/framework/widgets/css/widget-admin.css', false, 0.7, 'screen' );
				
			} break;
			
			default: {
			
  
	  		    // DISPLAY WELCOME POINTER
				if(isset($_GET['firstinstall'])){	
				//wp_enqueue_style( 'wp-pointer' );
				//wp_enqueue_script( 'jquery-ui' );
				//wp_enqueue_script( 'wp-pointer' );
				//wp_enqueue_script( 'utils' );
				//add_action('admin_footer', array($this, 'pointer_intro') );
				}
				 
		 
			} break;
			
		} // END SWITCH
		
		
		 echo "<script type='text/javascript'>
                  jQuery(document).ready(function(){
                      jQuery('#post').attr('enctype','multipart/form-data');
                  });
              </script>";
			  
			 
 
		
		// REMOVE INVALID TEXT FOR CHILD THEME UPLOADS
		if ( is_admin() && ( isset($_GET['action']) && $_GET['action'] == "upload-theme" )  && $pagenow == 'update.php'  ) { 	
			echo "<style>#wpbody-content p strong { display:none; }</style>";	
		}
		
		// ADD SHORTCODE FOR PAGE OPTIONS
		if( ( isset($_GET['post_type']) && $_GET['post_type'] == "page") || (isset($post->post_type) && $post->post_type == "page" ) ){?>
			
			
		<script language="javascript">
		function wltpopup(linka){
		tb_show("[WLT] Shortcode List",linka+"TB_iframe=true&height=600&width=900&modal=false", null);
					 return false;
		}
		 
		</script>	
	
		<?php }elseif( ( isset($_GET['post_type']) && $_GET['post_type'] == THEME_TAXONOMY."_type") || (isset($post->post_type) && $post->post_type == THEME_TAXONOMY."_type" ) ){
 
 
        ?>
	<script language="javascript">
    jQuery(function(){
 
    <?php if(isset($post->post_status) && $post->post_status == "pending" && !defined('WLT_CART') ){ $wlt_emails = get_option("wlt_emails"); ?>
    jQuery('#titlediv').before('<div id="message" class="updated below-h2" style="padding:10px;"><b style="font-size:18px;line-height:30px;">Listing Pending Approval</b><br /> If you are unhappy with this listing or require the user to provide more information, enter the reasons below;   <br><br><b>Comments:</b><br><textarea name="custom[pending_message]" style="width:100%;height:50px;padding:5px;"><?php echo addslashes(get_post_meta($post->ID,'pending_message',true)); ?></textarea><br> <input type="submit" name="save" id="save-post" value="Save as Pending" class="button" style="margin:20px 0px;"><br /><div class="clear"></div></div>');
    <?php } ?>
    
    });
    </script> 
     <?php }
			   
			  
	
	}
	// THEME FOOTER STYLES
	function _admin_footer(){ global $pagenow;
	
		if($pagenow == "options-permalink.php" ){  
		
			$default_perm = get_option('premiumpress_custompermalink');
			$default_perm1 = get_option('premiumpress_customcategorypermalink');
			if($default_perm == ""){
			$default_perm = THEME_TAXONOMY;
			}
			if($default_perm1 == ""){
			$default_perm1 = $default_perm."-category";
			}
		  
			echo "<script> 
			jQuery(document).ready(function(){
				jQuery('table.permalink-structure').prepend( '<tr><th><label><input type=\"hidden\" name=\"submitted\" value=\"yes\">PremiumPress Custom Slugs</label></th><td> <b> Listing Slug Name</b><br /><input name=\"adminArray[premiumpress_custompermalink]\" type=\"text\" value=\"".$default_perm."\" class=\"regular-text-r code\"><br><b> Category Slug Name</b><br /><input name=\"adminArray[premiumpress_customcategorypermalink]\" type=\"text\" value=\"".$default_perm1."\" class=\"regular-text-r code\"><p><p>IMPORTANT. This option will let you change the slug display name from /listing/ to your chosen value however doing so will change all of your existing listing permalinks. <br />This option is not recommend for established website as it will result in many 404 errors for existing listing.</p></td></tr>' );
			});
			</script>";		
			
			
			if(THEME_KEY == "cp"){
			
			$da = get_option('premiumpress_storeslug');	
			if($da == ""){
			$da = "store";
			}
			echo "<script> 
			jQuery(document).ready(function(){
				jQuery('table.permalink-structure').prepend( '<tr><th><label>PremiumPress Stores Slugs</label></th><td> <b> Slug Name</b><br /><input name=\"adminArray[premiumpress_storeslug]\" type=\"text\" value=\"".$da."\" class=\"regular-text-r code\"><br></td></tr>' );
			});
			</script>";	
			}

		
		}
	}

 
	
	function _admin_menu(){ global $wpdb, $user, $CORE, $menu, $submenu; $userdata = wp_get_current_user(); $license = get_option('wlt_license_key'); 

	
	// ADMIN DISPLAY OPTION
	$DEFAULT_STATUS = "edit_posts"; // <-- SET FOR PERMISSION
	
	if(defined('WLT_DEMOMODE')  && !user_can($userdata->ID, 'administrator') ){
		$DEFAULT_STATUS = "edit_posts";
		$this->_admin_remove_menus();
	}
	 
 	// CHANGE LABEL TO BLOG
    $menu[5][0] = 'Blog';
    $submenu['edit.php'][5][0] = 'All Blog Posts';
    $submenu['edit.php'][10][0] = 'Add Blog Post';	
	
	// HIDE IF THIS IS THE INITIAL SETUP
	if($license == ""){
		 
	add_menu_page('', "Installation", $DEFAULT_STATUS, 'premiumpress', array($this, '_admin_page_0' ), ''.get_bloginfo('template_url').'/framework/admin/images/install.png', 3); 
  
	}else{
	
	add_theme_page( 'Child Themes', 'Child Themes',  $DEFAULT_STATUS, 'premiumpresschildthemes', 'theme-install.php?browse=premiumpress', 12 );
 
  
 
		// SITE OVERVIEW	 
		add_menu_page('', "PremiumPress", 
		$DEFAULT_STATUS, 'premiumpress', array($this, '_admin_page_0' ), ''.get_bloginfo('template_url').'/framework/admin/images/premiumpress.png', '2'); 
	 
	 
	  	add_submenu_page('premiumpress', "PremiumPress Themes", 'Overview', 
		$DEFAULT_STATUS, 'premiumpress', array($this, '_admin_overview' ) );
		
		
		add_submenu_page('premiumpress', "PremiumPress Themes", 'Reports', 
		$DEFAULT_STATUS, '13', array($this, '_admin_page_13' ) );
 	 	
		
	 
	   // add_submenu_page('premiumpress', "PremiumPress Themes", 'Dashboard', 
		//$DEFAULT_STATUS, '0', array($this, '_admin_page_21' ) );
		
		if(THEME_KEY == "ph"){
		add_submenu_page(null, "PremiumPress Themes", 'Mass Import', 
		$DEFAULT_STATUS, 'massimport', array($this, '_admin_page_massimport') );
		}
		
		
		add_submenu_page('premiumpress', "PremiumPress Themes", 'Configuration', 
		$DEFAULT_STATUS, '2', array($this, '_admin_page_2' ) );		
		
		
		add_submenu_page('premiumpress', "PremiumPress Themes", 'Design Setup', 
		$DEFAULT_STATUS, '15', array($this, '_admin_page_15' ) );
		
		if(!defined('WLT_SHOP')){
		
			if(defined('THEME_KEY') && THEME_KEY != "cm"){ 
			
			
			if(THEME_KEY == "da"){ 
			$tt = "Profile Setup";
			}else{
			$tt = "Listings &amp; Packages";
			}
			add_submenu_page('premiumpress', "PremiumPress Themes", $tt, 
			$DEFAULT_STATUS, '5', array($this, '_admin_page_5') );
			
			add_submenu_page('premiumpress', "PremiumPress Themes", 'Memberships', 
			$DEFAULT_STATUS, '18', array($this, '_admin_page_18') );
			}
		
		}
 	 
		add_submenu_page('premiumpress', "PremiumPress Themes", ' Email &amp; SMS', 
		$DEFAULT_STATUS, '3', array($this, '_admin_page_3') );
		
		add_submenu_page('premiumpress', "PremiumPress Themes", 'Newsletter', 
		$DEFAULT_STATUS, '22', array($this, '_admin_page_22') ); 
		
		//add_submenu_page('premiumpress', "PremiumPress Themes", 'Payment &amp; Currency', 
		//$DEFAULT_STATUS, '20', array($this, '_admin_page_20') );
		
		if(defined('WLT_CART')){
		add_submenu_page('premiumpress', "PremiumPress Themes", 'Tax &amp; Shipping', 
		$DEFAULT_STATUS, 'cart', array($this, '_admin_page_cart') );
		}
		 
		add_submenu_page('premiumpress', "PremiumPress Themes", 'Order Manager', 
		$DEFAULT_STATUS, '6', array($this, '_admin_page_6') ); 		
		
		add_submenu_page('premiumpress', "PremiumPress Themes", 'Advertising', 
		$DEFAULT_STATUS, '19', array($this, '_admin_page_19') );
	   
	  
	 	add_submenu_page('premiumpress', "PremiumPress Themes", 'Toolbox', 
		$DEFAULT_STATUS, '4', array($this, '_admin_page_4') );
		
		if(!defined('WP_ALLOW_MULTISITE')){		
		add_submenu_page('premiumpress', "PremiumPress Themes", 'Plugins', 
		$DEFAULT_STATUS, '10', array($this, '_admin_page_10') );		 
		} 	
		 
 
	 
	
	/*
		MANAGE USERS
	*/

	//add_users_page('manage_users', 'Manage Users', 'read', 'users', array($this, '_admin_manage_users') );
	
	
	/*
		MANAGE PRODUCTS
	*/
	add_submenu_page(
        'edit.php?post_type=product',
        __( 'Manage Products', 'premiumpress' ),
        __( 'Manage Products', 'premiumpress' ),
        'manage_options',
        'manage&type=product',
        array($this, '_admin_page_manage')
    );	
		
		
	/*
		MANAGE CLUBS
	*/
	add_submenu_page(
        'edit.php?post_type=club',
        __( 'Manage Products', 'premiumpress' ),
        __( 'Manage Products', 'premiumpress' ),
        'manage_options',
        'manage&type=club',
        array($this, '_admin_page_manage')
    );			
		
		
	/*
		MANAGE VIDEOS
	*/
	add_submenu_page(
        'edit.php?post_type=video',
        __( 'Manage Video', 'premiumpress' ),
        __( 'Manage Videos', 'premiumpress' ),
        'manage_options',
        'manage&type=video',
        array($this, '_admin_page_manage')
    );		
	
	/*
		MANAGE VIDEOS
	*/
	add_submenu_page(
        'edit.php?post_type=gallery',
        __( 'Manage Galleries', 'premiumpress' ),
        __( 'Manage Galleries', 'premiumpress' ),
        'manage_options',
        'manage&type=gallery',
        array($this, '_admin_page_manage')
    );		
	
	 	
		
  
	} 
	
	}
	// EXTRA MENU ITEMS FROM PLUGINS
	function _admin_menu_plugins(){
 
		$DEFAULT_STATUS = "activate_plugins";
		// ADD-ON FOR NEW MENU ITEMS
		if(!defined('WLT_DEMOMODE') && isset($GLOBALS['new_admin_menu']) && is_array($GLOBALS['new_admin_menu']) ){
			$sk = 3.5;
		 
			foreach($GLOBALS['new_admin_menu'] as $newmenu){ 
				foreach($newmenu as $key=>$menu){
					add_menu_page('', $menu['title'], $DEFAULT_STATUS, $key, $menu['function'],'dashicons-none', ''.$sk.'' );
					$sk = $sk  + 0.1;
				}
			}
		}	
	}
	// TEMPLATE HEADER
	function HEAD($style = 0){
	
	if($style == 1){
	get_template_part('framework/admin/templates/admin', 'header1' );	
	}else{
	get_template_part('framework/admin/templates/admin', 'header' );	
	}
	
		
	}
	// LOAD IN TEMPLATE FOOTER	
	function FOOTER($style = 0){	
	if($style == 1){
	get_template_part('framework/admin/templates/admin', 'footer1' );
	}else{
	get_template_part('framework/admin/templates/admin', 'footer' );
	}
	}
	
	// TEMPLATE PAGES
	function _admin_overview() {  			include(TEMPLATEPATH . '/framework/admin/welcome.php');  }
	function _admin_page_0() 		{  			include(TEMPLATEPATH . '/framework/admin/_0.php');  }
	function _admin_page_1() 		{  			include(TEMPLATEPATH . '/framework/admin/_1.php');  }	
	function _admin_page_2() 		{  			include(TEMPLATEPATH . '/framework/admin/_2.php');  }	 
	function _admin_page_3() 		{  			include(TEMPLATEPATH . '/framework/admin/_3.php');  }
	function _admin_page_4() 		{  			include(TEMPLATEPATH . '/framework/admin/_4.php');  }
	function _admin_page_5() 		{  			include(TEMPLATEPATH . '/framework/admin/_5.php');  }
	function _admin_page_6() 		{  			include(TEMPLATEPATH . '/framework/admin/_6.php');  }
	function _admin_page_7() 		{  			include(TEMPLATEPATH . '/framework/admin/_7.php');  }
	function _admin_page_8() 		{  			include(TEMPLATEPATH . '/framework/admin/_8.php');  }
	function _admin_page_9() 		{  			include(TEMPLATEPATH . '/framework/admin/_9.php');  }
	function _admin_page_10() 		{  			include(TEMPLATEPATH . '/framework/admin/_10.php');  }
	function _admin_page_11() 		{  			include(TEMPLATEPATH . '/framework/admin/_11.php');  }	 
	function _admin_page_13() 		{  			include(TEMPLATEPATH . '/framework/admin/_13.php');  }
	function _admin_page_14() 		{  			include(TEMPLATEPATH . '/framework/admin/_14.php');  }
	function _admin_page_15() 		{  			include(TEMPLATEPATH . '/framework/admin/_15.php');  }
	function _admin_page_16() 		{  			include(TEMPLATEPATH . '/framework/admin/_16.php');  }
	function _admin_page_17() 		{  			include(TEMPLATEPATH . '/framework/admin/_17.php');  }
	function _admin_page_18() 		{  			include(TEMPLATEPATH . '/framework/admin/_18.php');  }
	function _admin_page_19() 		{  			include(TEMPLATEPATH . '/framework/admin/_19.php');  }
	function _admin_page_20() 		{  			include(TEMPLATEPATH . '/framework/admin/_20.php');  }
	function _admin_page_21() 		{  			include(TEMPLATEPATH . '/framework/admin/dashboard.php');  }
	function _admin_page_22() 		{  			include(TEMPLATEPATH . '/framework/admin/_22.php');  }
	function _admin_page_23() 		{  			include(TEMPLATEPATH . '/framework/admin/_23.php');  }
	function _admin_page_add() 		{  			include(TEMPLATEPATH . '/framework/admin/_add.php');  }
	function _admin_page_manage() 	{  			include(TEMPLATEPATH . '/framework/admin/_manage.php');  }
	function _admin_manage_users() 	{  			include(TEMPLATEPATH . '/framework/admin/_manage_users.php');  }
	
	function _admin_page_cart() 		{  		include(TEMPLATEPATH . '/framework/admin/_cart.php');  }
	function _admin_page_mobile() 		{  		include(TEMPLATEPATH . '/_mobile/admin/admin.php');  }
	function _admin_page_massimport() 	{  		include(TEMPLATEPATH . '/framework/admin/_massimport.php');  }
	
	
	// MAIN WORDPRESS INIT
	function _init(){	global $CORE, $userdata;
		
		// SWITCH PAGES		
		 
		if(isset($_GET['page']) && user_can($userdata->ID, 'administrator') ){
		
			switch($_GET['page']){
			
				case "premiumpresschildthemes": {
				header("location: ".home_url()."/wp-admin/theme-install.php?browse=premiumpress");
				exit();	
				}
				
				case "13": {
				 		
				if( isset($_POST['runreportnow']) && $_POST['runreportnow'] == "yes"){  $CORE->reports($_POST['date1'],$_POST['date2'],true); }			
				} break;
				
				case "supportcenter": {			
				header("location: https://www.premiumpress.com/forums/?theme="._ppt('template')."&key=".get_option('wlt_license_key'));
				exit();			
				} break; 
				
				case "videotutorials": {						
				header("location: https://www.premiumpress.com/videos/?theme="._ppt('template')."&key=".get_option('wlt_license_key'));
				exit();			
				} break;
				
				case "childthemes": {			
				header("location: http://childthemes.premiumpress.com/?responsive=1&theme="._ppt('template')."&key=".get_option('wlt_license_key'));
				exit();			
				} break;	
				
				case "customizeme": {			
				header("location: ". home_url().'/wp-admin/customize.php?url='. home_url().'/?s=');
				exit();			
				} break;		
			
			}	
		} // end switch
	}
	
 
	// ADMIN INIT
	function _admin_init(){ global $CORE, $wpdb, $userdata, $pagenow, $userdata, $wp_post_types; 
		
		
		// CHECK FOR THEME INSTALLATION
		premiumpress_install_and_reset();
		
		// ON THEME OVERVIEW PAGE		 
		if ( user_can($userdata->ID, 'administrator') && $pagenow == 'themes.php'  ) {
		$CORE->admin_update_child_theme();
		}
		
		// CUSTOM LABEL FOR BLOG
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Blog Manager';
        $labels->singular_name = 'Blog';
		$labels->menu_icon		= ''; 
        $labels->add_new = 'Add Blog';
        $labels->add_new_item = 'Add Blog';
        $labels->edit_item = 'Edit Blog';
        $labels->new_item = 'Blog';
        $labels->view_item = 'View Blog';
        $labels->search_items = 'Search Blog Post';
        $labels->not_found = 'No Blog Post found';
        $labels->not_found_in_trash = 'No Blog Post found in Trash';
		
		
		// FIX FOR ADMIN QUERY
		if (strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-admin') !== false && $userdata->ID )   { 
		 		
			if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
				
				if( !defined('WLT_DEMOMODE') ){
				
					wp_die(__('Oops! You do not have sufficient permissions to access this page.'));	
				 
					wp_redirect( home_url() );
					exit;
				
				}
			}
			
		}		
	
		// CUSTOM CATEGORY EDITS 
		if( isset($_GET['taxonomy']) && isset($_GET['post_type']) && ( $_GET['post_type'] == THEME_TAXONOMY."_type" ||  $_GET['post_type'] == "cproduct_type"  ) && $_GET['taxonomy'] != "post_tag" ){			
		
				// Load the pop-up for admin image uploads	
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
				wp_enqueue_style('thickbox');				
			 
				add_filter($_GET['taxonomy'].'_edit_form_fields', array( $this, 'my_category_fields'  ) );				 				
				add_filter( 'manage_edit-'.$_GET['taxonomy'].'_columns', array( $this, 'category_id_head' ) );
				add_filter( 'manage_'.$_GET['taxonomy'].'_custom_column', array( $this, 'category_id_row' ), 10, 3 );			
		} // end if
		

		
		
		
		if(isset($_GET['exportalllistings']) && is_numeric($_GET['exportalllistings']) ){
		 	 
			 global $wpdb;
			// GET ALL CUSTOM FIELDS
			$CFT = $wpdb->get_results("SELECT DISTINCT meta_key FROM ".$wpdb->prefix."postmeta",ARRAY_A);
			$FF = array();	
			foreach($CFT as $k=>$v){		 
				if(substr($v['meta_key'],0,1) == "_"){ // DONT INCLUDE FIELDS THAT BEGIN WITH _		
				}else{		
				$FF[$v['meta_key']] ="";		
				}
			}
			
			// START AND END
			if(isset($_GET['s'])){ $start = $_GET['s']; }else{ $start = 0; }
			if(isset($_GET['e'])){ $end = $_GET['e']; }else{ $end = 1000; }
			
			// GET ALL POSTS
			$allposts = array();
			$SQL = "SELECT * FROM $wpdb->posts WHERE post_type='".THEME_TAXONOMY."_type' LIMIT $start,$end ";
			$PPO = $wpdb->get_results($SQL,ARRAY_A);
			foreach ( $PPO as $dat ){
			
				// CLEAN ANY COLUMNS WE DONT WANT
				unset($dat['comment_count']);	
				unset($dat['post_mime_type']);
				unset($dat['menu_order']);	 
				unset($dat['post_date_gmt']);
				unset($dat['ping_status']);
				unset($dat['post_password']);
				unset($dat['post_name']);
				unset($dat['to_ping']);
				unset($dat['pinged']);
				unset($dat['post_modified']);
				unset($dat['post_modified_gmt']);
				unset($dat['post_content_filtered']);
				unset($dat['post_parent']);
				unset($dat['guid']);
				unset($dat['_edit_last']);
				unset($dat['_wp_page_template']);
				unset($dat['_edit_lock']);
				unset($dat['post_status']);
				unset($dat['comment_status']); 
			 
		
				// GET CATEGORY
				$cs = ""; 
				$categories = get_the_terms($dat['ID'], THEME_TAXONOMY);				
				if(is_array($categories)){foreach($categories as $cat){ $cs .= $cat->name. ","; } }
				$dat['category'] = substr($cs,0,-1); //$category[0]			
 				
				// GET ALL THE POST DATA FOR THIS LISTING
				$cf = get_post_custom($dat['ID']);
				
				 // LOOP THROUGH AND DELETE UNUSED ONES
				 if(is_array($cf)){
				 foreach($cf as $k=>$c){	 	 
					if(substr($k,0,1) == "_"){ unset($cf[$k]); }else{  } 
				  //if( == ""){  }	 // unset($dat[$k]);	 
				 } } 
			 
				 // CLEAN OUT DEFAULT CUSTOM FIELDS WHICH WE DONT WANT
				 unset($cf['_wp_page_template']);
				 unset($cf['_wp_attachment_metadata']);
				 unset($cf['_wp_attached_file']);
				 unset($cf['_wp_trash_meta_status']);
				 unset($cf['_wp_trash_meta_time']);
				 unset($cf['_edit_lock']);
				 unset($cf['_edit_last']);				 
				 unset($cf['post_title']);
				 unset($FF['post_title']);			
				 unset($cf['post_excerpt']);
				 unset($FF['post_excerpt']);				 
				 unset($cf['post_content']);
				 unset($FF['post_content']);
				 unset($cf['id']);
				 
				// ADD ON THE CUSTOM FIELDS TO THE OUTPUT DATA
				if(is_array($FF)){
					 foreach($FF as $key=>$val){
					 if($key == "post_id" || $key == "ID"){ continue; } 
						if(isset($cf[$key])){
						$dat[$key] = $cf[$key][0];
						}else{
						$dat[$key] = "";
						}
					 }
				 } 
				
				// ADD IN SKU
			 	if(!isset($dat['post_id'])){	$dat['post_id'] = $dat['ID'];	}	
		 
				//die(print_r($dat));
				// SAVE DATA INTO ARRAY
				if(strlen(trim($dat['post_title'])) > 2){
				$allposts[] = $dat; 
				}	
			
			}
   			if(is_array($allposts) && !empty($allposts)){
			header("Content-Type: text/csv");
			header("Content-Disposition: attachment; filename=CSV-".date('l jS \of F Y h:i:s A')." .csv"); 

			$export = new ppt_csv_export($allposts);
			$export->set_mode(ppt_csv_export::EXPORT_AS_CSV);
			$export->export($export);
			
			echo $export;
			die();
			}else{
			die("<h1>There is no data to export</h1>"."Query run: ".$SQL);
			}
			
		}
 
	 
	 	// EXPORT EMAIL ADDRESSES
		if(isset($_GET['exportall']) && is_numeric($_GET['exportall']) ){
				global $wpdb;
				$csv_output = ''; $ex  = ''; $dont_show_fields = array('autoid','payment_data','');
				
				if($_GET['exportall'] == 1){
					
					$file_name = "mailinglist";	
					$table = $wpdb->prefix."core_mailinglist";	  
					$RUNTHISSQL = "SELECT * FROM ". $wpdb->prefix."core_mailinglist";
				
				}elseif($_GET['exportall'] == 2){
							
					$file_name = "orderhistory";		
					$table = $wpdb->prefix."core_orders";	 
					$RUNTHISSQL = "SELECT * FROM ". $wpdb->prefix."core_orders GROUP BY order_id ORDER BY order_date";
				 
				}else{
					die("no table set");
				}			
		 
				// RUN QUERIES
				
				$headers = $wpdb->get_results("SHOW COLUMNS FROM ".$table."", ARRAY_A);
				$values = $wpdb->get_results($RUNTHISSQL, ARRAY_N);
				
				// GET HEADERS
				$csv_headers = array();
				if (!empty($headers)) {
					foreach($headers as $row){					
						$csv_headers[] =  $row['Field'];
					}				
				}
				
				// GET VALUES
				$csv_values = array();
				if (!empty($values)) {				
					foreach($values as $k => $row){				 			 
						$csv_values[] =  $row;					
					}				
				}			
				 
				// ADD-ON HEADERS
				foreach($csv_headers as $col_V){
					if(in_array($col_V,$dont_show_fields) ){ continue; }					 
					$csv_output .= str_replace("_"," ",$col_V).",";				 
				}
				
				// NEW LINE				
				$csv_output .= "\n";
				
				// ADD-ON VALUES
				foreach($csv_values as $vv){	
			 
					foreach($vv as $vk => $v){	
						if(in_array($csv_headers[$vk],$dont_show_fields)){ continue; }				 
						$csv_output .= $v.",";					
					}
					$csv_output .= "\n";
				}	 
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: private", false);
				header("Content-Type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"".$file_name.".csv\";" );
				header("Content-Transfer-Encoding: binary");
				echo $csv_output;
				die();
		}  
		
		if(defined('WLT_DEMOMODE')  && !user_can($userdata->ID, 'administrator') ){
		
		$GLOBALS['error_message'] = "Demo Mode - Changes not saved!";
		
		}else{
		
		// ADMIN ACTION
		if(isset($_POST['admin_action']) && strlen($_POST['admin_action']) > 1){		
		 
			switch($_POST['admin_action']){
			
				case "category_import": {
				
				if(strlen($_POST['cat_import']) > 5 ){ 
				
					// DELETE ALL CURRENT CATEGORIES
					if(isset($_POST['deleteall']) && $_POST['deleteall'] == 1){
					
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
					
					}
					
					// ADD NEW CATEGORIES
 
 					$cats = explode(PHP_EOL,$_POST['cat_import']);
			 
					if(is_array($cats)){
					
						$taxType = THEME_TAXONOMY; 
						foreach($cats as $catme){ 
						
							// CLEANUP
							$catme = trim($catme);
							
							// SKIP
							if($catme == ""){ continue; }
							
							// CHECK FOR PARENT
							$parent = 0; $isSub = false;  $isSubSub = false;
							if(substr($catme,0,1) == "-" && substr($catme,0,2) != "--" && is_numeric($taxID) ){
								$parent = $taxID;
								$isSub = true;
							}elseif(substr($catme,0,1) == "-" && substr($catme,0,2) == "--" && is_numeric($taxID) ){
								$parent = $lastTaxID;
								$isSubSub = true;
							} 
							
							// REMOVE SLASHES
							$catme = str_replace("-","",$catme);							
							
							// IMPORT
							$termid = _ppt_term_add($catme, 'listing', $parent);	 
							if(is_numeric($termid) ){
								
								if(!$isSub){
								$taxID = $termid;
								}
								if(!$isSubSub){							
								$lastTaxID = $termid;															
								}
								
							}
							
							 
							
						} //end foreach
					}// end if
					
					$GLOBALS['error_message'] = "Category Setup Complete";
				
				
				}
				
				} break;
			
				case "csv_import": {				
				
				set_time_limit(0); 		
			
				if($_POST['csv_key'] == ""){ die("database table missing"); }
				
				if($_POST['deleteall'] == 1){
				
					$wpdb->query("delete a,b,c,d
					FROM ".$wpdb->prefix."posts a
					LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
					LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
					LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
					LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
					WHERE a.post_type ='listing_type'");
				
				}
				
				// GET A LIST OF ALL TAXONOMIES
				$current_taxonomies = get_taxonomies(); 
				 
				$start_num = $_POST['csv_pagenumber'];
				if($start_num > 0){ $start_num = $start_num*100; }
				// STOP IF THE PAGE NUMBER IS GREATER THANK TOTAL
				if( $start_num > $_POST['csv_total']){ die("import completed (".$start_num." = ".$_POST['csv_total'].")"); }
				
					// POST FIELDS
					$post_fields = array('SKU','post_author','post_date','post_date_gmt','post_content','post_title','post_excerpt','post_status',
					'comment_status','ping_status','post_password','post_name','to_ping','pinged','post_modified','post_modified_gmt','post_content_filtered',
					'post_parent','guid','menu_order','post_type','post_mime_type','comment_count');	  
					
					// OK LETS LOOP THE TABLE X TIMES THEN 	
					if(isset($_POST['runall'])){
					$QUERYSTRING  = "SELECT * FROM ".$_POST['csv_key']."";
					}else{
					$QUERYSTRING  = "SELECT * FROM ".$_POST['csv_key']." LIMIT ".$start_num.",100";
					}	
					
					  
					$results = $wpdb->get_results($QUERYSTRING, OBJECT);
					if(is_array($results)){
					foreach($results as $new_post){
						
						// IMPORT NEW POST DATA
						$my_post = array(); $my_post['post_excerpt'] = ""; $customdata = array(); $catsarray = array(); $update=false; $category = "";
						
						foreach($new_post as $key=>$val){
							
							switch($key){
								case "ID":
								case "SKU":
								case "sku":
								case "post_id": { 
									// CHECK IF POST EXISTS
									if(!$update && $val != ""){
									
										if($key == "SKU" || $key == "sku"){
										$post_exists = $wpdb->get_row("SELECT ".$wpdb->prefix."postmeta.post_id AS ID FROM ".$wpdb->prefix."postmeta WHERE 
										( meta_value = '" . $val . "' AND meta_key='SKU' OR meta_value = '" . $val . "' AND meta_key='sku' )
										LIMIT 1", 'ARRAY_A');										
										}else{										
										$post_exists = $wpdb->get_row("SELECT ID FROM $wpdb->posts WHERE ID = '" . $val . "' LIMIT 1", 'ARRAY_A');	
										}
										 						 
										if(isset($post_exists['ID'])){
										  $my_post['ID'] = $post_exists['ID']; 
										  $update = true; 										   									  
										}elseif($key == "SKU"){										
											$customdata["SKU"] = $val; 
										}
									}
								 	$customdata["SKU"] = $val; 
								} break;								 
								case "post_author": { $my_post['post_author'] = $val; } break;
								//case "post_date": { $my_post['post_date'] = $val; } break;
								//case "post_date_gmt": { $my_post['post_date_gmt'] = $val; } break;
								case "post_content": { $my_post['post_content'] = $val; } break;
								case "post_title": { $my_post['post_title'] = $val;  } break;
								case "post_excerpt": { $my_post['post_excerpt'] = $val; } break;
								case "post_status": { $my_post['post_status'] = $val; } break;
								case "comment_status": { $my_post['comment_status'] = $val; } break;
								case "store_logo": { $my_post['store_logo'] = $val; } break;
								case "post_type": { if(strlen($val) > 2){$my_post['post_type'] = $val;}else { $my_post['post_type'] = THEME_TAXONOMY."_type"; } } break;
								case "category1":
								case "category": {
								
									$category = $val;
									
								} break;
								default: { 	
								
								if(in_array($key,$current_taxonomies)){
								
										$vals = explode("|",$val);										
										$catIDArray = array();
										foreach($vals as $val1){
										 	
											// TRIM VALUE
											$val1 = trim($val1);
											// CHECK IF THE CATEGORY ALREADY EXISTS
											if ( is_term( $val1, $key ) ){
												$term = get_term_by('name', str_replace("_"," ",$val1), $key);										 
												$catID = $term->term_id;												
											}else{										
												$args = array('cat_name' => str_replace("_"," ",$val1) ); 
												$term = wp_insert_term(str_replace("_"," ",$val1), $key, $args); 
																							
												if(is_array($term) && isset($term['term_id']) && !isset($term['errors'][0]) ){
													$catID = $term['term_id'];
												}elseif(isset($term->term_id)){
													$catID = $term->term_id;
												}					 
											}
											
											// SAVE ID
											if(is_numeric($catID)){
											$catIDArray[] = $catID;
											}										
										}
										 
										$taxarray[$key] = $catIDArray;
								
								}else{
									$customdata[$key] = $val;								
								}
								 
								
								 } break;
							
							}// end switch				
						}// end foreach
						
							
						// CHECK IF NOT SET
						if(!isset($my_post['post_type'])){
						$my_post['post_type'] 		= THEME_TAXONOMY."_type";
						}
						 
						
						// SET POST STATUS
						if(!isset($my_post['post_status'])){
						$my_post['post_status'] = "publish";
						}
						
						// WORK ON CUSTOM ENCODING						
						if(function_exists('utf8_encode')){ 
							$np = array();
							foreach($my_post as $key=>$val){
								if(is_string($val)){
									if(function_exists('mb_convert_encoding')){									
										$np[$key] = mb_convert_encoding($val, CSV_IMPORT_ENCODING(),'auto');
									}else{
										$np[$key] = utf8_encode($val);
									}								 
								}else{
									$np[$key] = $val;
								}
								
							}
							$my_post = $np;
						}
						
						// ADD OR UPDATE ISTING
						if($update){
						$POSTID = wp_update_post( $my_post );
						}else{
						$POSTID = wp_insert_post( $my_post );
						}
						
						// SAVE CATEGORY
						if(strlen($category) > 1 ){
							$cats = explode("|",$category);
							foreach($cats as $catname){
								$termid = _ppt_term_add($catname, 'listing');	 
								if(is_numeric($termid)){									 
									wp_set_post_terms( $POSTID, $termid, 'listing' );	
								}	
							}						
						}
						
						// SAVE ANY CUSTOM TAXONOMIES
						if(is_array($taxarray)){				 
							foreach($taxarray as $k=>$v){
								wp_set_post_terms( $POSTID, $v, $k, true);
							}
						} 
						
						// SET POST CATEGOIRY FOR POST TYPE
						if(is_array($catsarray) && !empty($catsarray)){
						wp_set_post_terms( $POSTID, $catsarray, THEME_TAXONOMY );
						}	
						 
										
						// NOW ADD IN THE CUSTOM FIELDS
						if(is_array($customdata)){
							foreach($customdata as $key=>$val){
								update_post_meta($POSTID,$key,$val);
							}
						}
						
						// EXTRA FOR STORE LOGO
						if (taxonomy_exists('store') && isset($taxarray['store'])){
						 
							$_POST['admin_values']['category_icon_'.$taxarray['store']] = $my_post['store_logo'];			
							// GET THE CURRENT VALUES
							$existing_values = get_option("core_admin_values");
							// MERGE WITH EXISTING VALUES
							$new_result = array_merge((array)$existing_values, (array)$_POST['admin_values']);
							// UPDATE DATABASE 		
							update_option( "core_admin_values", $new_result);
						}															 
							
					}// forwach loop
				}
				
				$GLOBALS['error_message'] = "Import Completed Successfully";
			
				} break;
				
				case "csv_savetables": {
				
					foreach($_POST['table1'] as $key=>$val){
	
						if($val != $_POST['table2'][$key]){
						
							$SQL = "ALTER TABLE ".$_POST['database_table']." CHANGE  `".$val."`  `".$_POST['table2'][$key]."` TEXT";
						 
							mysql_query($SQL); // CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL
						
							$GLOBALS['error_message'] = "Table Changes Completed";
						}
					}
				 
				} break;
			
				case "csv_upload": {
								
				
					  $csv = new ppt_csv_import();
					 
					  // UPLOAD THE FILE FIRST TO THE SERVER
					  $uploads = wp_upload_dir();  
					  copy($_FILES['file_source']['tmp_name'], $uploads['path']."/".$_FILES['file_source']['name']);
					
					  // IF ITS COMPRESSED, UNZIP IT
					  $lastthree = substr($_FILES['file_source']['name'],-3);
					  if($lastthree == ".gz" || $lastthree == "zip"){
							$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
							require $dir_path . "/wp-admin/includes/file.php";
							WP_Filesystem();
							$zipresult = unzip_file( $uploads['path']."/".$_FILES['file_source']['name'], $uploads['path']."/unzipped/" );
							if ( is_wp_error($zipresult)){
								echo "<h1>The file could not be extracted.</h1><hr>";
								print_r($zipresult);
								die();
							 }else{		 	
								// READ THE FOLDER TO GET THE FILENAME THEN REMOVE THE FOLDER
								if ($handle = opendir($uploads['path']."/unzipped/")) {
									while (false !== ($entry = readdir($handle))) {
										if ($entry != "." && $entry != ".." && ( substr($entry,-4) == ".csv" || substr($entry,-4) == ".txt") ) {
											$unzippedfilename = $entry;
										}
									}
									closedir($handle);
								}
								
								// CHECK WE FOUD IT
								if(!isset($unzippedfilename)){
								die("The file could not be extracted and found.");			
								}else{
								
									copy($uploads['path']."/unzipped/".$unzippedfilename, $uploads['path']."/".$unzippedfilename);				
									$csv->file_name = $uploads['path']."/".$unzippedfilename;
									// DELETE THE ZIP FOLDER AND FILE
									unlink($uploads['path']."/unzipped/".$unzippedfilename);
									unlink($uploads['path']."/".$_FILES['file_source']['name']);
									rmdir($uploads['path']."/unzipped/");				
								}			
							 
							 }		 
					  }else{
					  
						$csv->file_name 				= $uploads['path']."/".$_FILES['file_source']['name'];  
					  
					  }
					  
					  //optional parameters
					  $csv->use_csv_header 			= isset($_POST["use_csv_header"]);
					  $csv->field_separate_char 	= $_POST["field_separate_char"][0];
					  $csv->field_enclose_char 		= $_POST["field_enclose_char"][0];
					  $csv->field_escape_char 		= $_POST["field_escape_char"][0];
					  $csv->encoding 				= CSV_IMPORT_ENCODING();
					   
						//start import now
						$database = $csv->import();	
						$countrows = $csv->countrows($database);
					 
						$new_values = array();
						$new_values[$database] = $countrows;  
						// GET THE CURRENT VALUES
						$existing_values = get_option("ppt_csv");
						// MERGE WITH EXISTING VALUES
						$new_result = array_merge((array)$existing_values, (array)$new_values);
						// UPDATE DATABASE 		
						update_option( "ppt_csv", $new_result);
						// CLEAN UP
						@unlink($csv->file_name);
						// LEAVE FRIENDLY MESSAGE
						$GLOBALS['error_message'] = "CSV Uploaded Successfully";
	
				} break;
			
				case "csv_delete": {
			
								
					// GET THE CURRENT VALUES
					$existing_values = get_option("ppt_csv");
					unset($existing_values[$_POST['csvid']]);		
					// UPDATE DATABASE 		
					update_option( "ppt_csv", $existing_values);
					
					// REMOVE FILE NAME FROM LIST
					$csv_files = get_option("ppt_csv_filenames");
					if(!is_array($csv_files)){ $csv_files = array(); }
					unset($csv_files[$_POST['csvid']]);
					update_option("ppt_csv_filenames", $csv_files);
					
					// DELETE DATABASE TABLE
					$wpdb->query("DROP TABLE IF EXISTS ".$_POST['csvid']);	
	
					// LEAVE FRIENDLY MESSAGE
					$GLOBALS['error_message'] = "Deleted Successfully";
					
				} break;
			
			}// end switch		
		
		// SAVE ADMIN DATA
		}elseif(isset($_POST['submitted']) && $_POST['submitted'] == "yes"  ){
		
		  
				// GET OLD OPTIONS
				$existing_values = $CORE->ppt_core_settings;	
			
		 		if(isset($_POST['admin_values'])){	
				 
					// MERGE WITH EXISTING VALUES
					$new_result = array_merge((array)$existing_values, (array)$_POST['admin_values']);
					
					// CLEANUP ARRAY
					foreach($new_result as $c => $cc){
					
						if(is_numeric($c) || $cc == ""){
							unset($new_result[$c]);
						}
					}					 
					// UPDATE DATABASE 		
					update_option( "core_admin_values", $new_result, true);
					// LEAVE FRIENDLY MESSAGE
					$GLOBALS['error_message'] = "Changes Saved Successfully";
				} 
				
				// SAVE EXTRA DATA
				if(isset($_POST['adminArray'])){
		 
					$update_options = $_POST['adminArray']; 
					 
					foreach($update_options as $key => $value){
						if(is_array($value)){			 
							update_option( trim($key), $value, true);			 
						}else{ 		
							update_option( trim($key), trim($value), true);
						}		
					}
				
				}
				
				// NOW UPDATE THE OPTIONS
				$GLOBALS['CORE_THEME'] = $new_result;
				
				// NEW INSTALL REDIRECT
				if(isset($_POST['newinstall']) && $_POST['newinstall'] == "premiumpress"){				
				header("location: ".get_home_url().'/wp-admin/admin.php?page=premiumpress&newinstall=1');
				exit();
				} 
				 					
			}// END SAVE ADMIN OPTION	
			
			
	} // end if is admin demo mode	
			
				
	}	
	// ADDS ALL USERS TO THE EDIT BOX IN WORDPRESS WHEN EDITING LISTINGS
	function _wp_dropdown_users($output){
    global $post, $wpdb;
	
  
	 
	if(isset($post->post_type) && $post->post_type == "listing_type" && isset($_GET['action']) ){ 
		
		$result = count_users();
		if($result['total_users'] > 500){
		$wp_user_query =  new WP_User_Query( array(   'number' => 200, 'orderby' => 'display_name', 'order' => 'desc', 'count_total'  => true, 'role__not_in' => 'Subscriber' ) );
		}else{
		$wp_user_query =  new WP_User_Query( array(   'number' => 500, 'orderby' => 'display_name', 'order' => 'desc', 'count_total'  => true ) );
		}
		$users = $wp_user_query->get_results();		
 

		$output = "<select id=\"post_author_override\" name=\"post_author_override\" class=\"\">";
	
		//Leave the admin in the list
		if(isset($_GET['action']) && $_GET['action'] == "edit"){
		$output .= "<option value=\"".$post->post_author."\" selected=selected>User ID: ".$post->post_author." (".count_user_posts( $post->post_author , 'listing_type' )." listings)</option>";
		}
		if(is_array( $users )){
		foreach($users as $user)
		{
		
			$sel = ($post->post_author == $user->ID)?"selected='selected'":'';
			$output .= '<option value="'.$user->ID.'" '.$sel.'>'.$user->user_login.' ('.count_user_posts( $user->ID , 'listing_type' ).' listings)</option>';
		}
		}
		$output .= "</select>";
	
	}
	 
	
    return $output;	
	}	
	
	// REMOVE MENU ITEMS FROM ADMIN 
	function _admin_remove_menus() {
		global $menu;
			$restricted = array('Dashboard','Media','Links','Appearance','Tools','Settings','Comments','Plugins','Tools');
			end ($menu);
			while (prev($menu)){
				$value = explode(' ',$menu[key($menu)][0]);
				if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
			}
	}
	
	
	// POINTERS FOR INSTALLATION
	function pointer_welcome(){
			global $CORE_ADMIN;	
			
			wp_enqueue_script( 'jquery' );
 			wp_enqueue_style( 'wp-pointer' );
			wp_enqueue_script( 'jquery-ui' );
			wp_enqueue_script( 'wp-pointer' );
			wp_enqueue_script( 'utils' );
			 	
			if(defined('WLT_CHILDTHEME')){
			
			$id      = 'li.toplevel_page_premiumpress';
			$content = '<h3>' . 'Child Theme Activated' . '</h3>';
			$content .= '<p>' .  '<b>Awesome!</b> You\'ve just activated your new child theme. Now let\'s begin setting it up!' . '</p>';
			$opt_arr  = array(
						'content'  => $content,
						'position' => array( 'edge' => 'top', 'align' => 'center' )
					);
			$button2  =  "Begin Setup";
			
			if(defined('NOHOMEPAGECONTENT') || defined('WLT_ELEMENTOR_AUTO_INSTALL') ){
			$function = 'document.location="' . admin_url( 'admin.php?page=15&tab=tab-pagebuilder&autosetup=1' ) . '";';
			}else{
			$function = 'document.location="' . admin_url( 'admin.php?page=15' ) . '";';
			}
			}else{
		 		 
			$id      = 'li.toplevel_page_premiumpress';
			$content = '<h3>' . 'Congratulations!' . '</h3>';
			$content .= '<p>' .  'You\'ve just activated your PremiumPress theme.' . '</p>';
			$opt_arr  = array(
						'content'  => $content,
						'position' => array( 'edge' => 'top', 'align' => 'center' )
					);
			$button2  =  "Begin Setup";
			$function = 'document.location="' . admin_url( 'admin.php?page=premiumpress' ) . '";';
			
			}
			
			$this->print_scripts( $id, $opt_arr, "Close", $button2, $function );
			
	}
	function pointer_intro(){
			global $CORE_ADMIN;
			
			$id      = '#gotobtn';
			$content = '<h3>' .'Remember!'. '</h3>';
			$content .= '<p>' . 'Watch the video tutorial first then click here!' . '</p>';
			$opt_arr  = array(
						'content'  => $content,
						'position' => array( 'edge' => 'top', 'align' => 'center' )
					);
			$button2  = "123";
			$function = 'document.location="' . admin_url( 'admin.php?page=premiumpress' ) . '";';
	 
			
			$this->print_scripts( $id, $opt_arr, "Close", $button2, $function );
			
	}	
	function print_scripts( $selector, $options, $button1, $button2 = false, $button2_function = '', $button1_function = '' ) {
			?>
		<script >
			//<![CDATA[
			(function ($) {
				var premiumpress_pointer_options = <?php echo json_encode( $options ); ?>, setup;
	 
				premiumpress_pointer_options = $.extend(premiumpress_pointer_options, {
					buttons:function (event, t) {
						button = jQuery('<a id="pointer-close" style="margin-left:5px" class="button-secondary">' + '<?php echo $button1; ?>' + '</a>');
						button.bind('click.pointer', function () {
							t.element.pointer('close');
						});
						return button;
					},
					close:function () {
					}
				});
	
				setup = function () {
					$('<?php echo $selector; ?>').pointer(premiumpress_pointer_options).pointer('open');
					<?php if ( $button2 ) { ?>
						jQuery('#pointer-close').after('<a id="pointer-primary" class="button-primary">' + '<?php echo $button2; ?>' + '</a>');
						jQuery('#pointer-primary').click(function () {
							<?php echo $button2_function; ?>
						});
						jQuery('#pointer-close').click(function () {
							<?php if ( $button1_function == '' ) { ?>
								//premiumpress_setIgnore("tour", "wp-pointer-0", "<?php echo wp_create_nonce( 'premiumpress-ignore' ); ?>");
								<?php } else { ?>
								<?php echo $button1_function; ?>
								<?php } ?>
						});
						<?php } ?>
				};
	
				if (premiumpress_pointer_options.position && premiumpress_pointer_options.position.defer_loading)
					$(window).bind('load.wp-pointers', setup);
				else
					$(document).ready(setup);
			})(jQuery);
			//]]>
		</script>
		<?php
	}
 	
	
// FUNCTION CALLED WHEN SAVING THE ICON
	function wlt_update_icon_field($term_id) {
		
		if(isset($_POST['caticon'])){		   
		   
		    if(defined('WLT_COUPON') || defined('WLT_COMPARISON') ){
			 
		     $_POST['admin_values']['category_website_'.$term_id] = strip_tags($_POST['websitelink']);	
			 $_POST['admin_values']['category_website_afflink_'.$term_id] = strip_tags($_POST['websitelinkafflink']);
			  	
		    }
			
			 $_POST['admin_values']['storeimage_'.$term_id] = strip_tags($_POST['caticon4']);	
			
			
			$_POST['admin_values']['category_icon_'.$term_id] = strip_tags($_POST['caticon']);	
			$_POST['admin_values']['category_icon_small_'.$term_id] = strip_tags($_POST['caticon1']);
			
			if(isset($_POST['caticon2'])){
			$_POST['admin_values']['category_image_'.$term_id] = strip_tags($_POST['caticon2']);	
			}
			
			if(isset($_POST['caticon3'])){
			$_POST['admin_values']['category_image_mobile_'.$term_id] = strip_tags($_POST['caticon3']);			 
			}
			
			$_POST['admin_values']['category_description_'.$term_id] = stripslashes($_POST['cat_desc_big']);
			
			if(isset($_POST['category_hideresults_'.$term_id])){
			$_POST['admin_values']['category_hideresults_'.$term_id] = $_POST['category_hideresults_'.$term_id];
			$_POST['admin_values']['category_hidemobile_'.$term_id] = $_POST['category_hidemobile_'.$term_id];
			}
			
			// CAT TRANSLATIONS
			if(isset($_POST['category_translation'])){
			
				$na = array();
				
				$ct = _ppt('category_translation');			
				if(is_array($ct)){ 
					foreach($ct as $k => $v){
					
						foreach($v as $k1 => $v1){
						
							$na[$k][$k1] = $v1;
						}
						
					}
				}
				
				foreach($_POST['category_translation'] as $k => $v){
				
					foreach($v as $k1 => $v1){
					
						$na[$k][$k1] = $v1;
					}
					
				}
				
										 
				$_POST['admin_values']['category_translation'] = $na; 
			}
			
			 
			// GET THE CURRENT VALUES		 
			if(!isset($GLOBALS['CORE_THEME'])){
				$existing_values = get_option("core_admin_values");
			}else{
				$existing_values = $GLOBALS['CORE_THEME']; //get_option("core_admin_values");
			}
			// MERGE WITH EXISTING VALUES
			$new_result = array_merge((array)$existing_values, (array)$_POST['admin_values']);
			// UPDATE DATABASE 		
			update_option( "core_admin_values", $new_result, true);
			 
		} // end if
	}	
	
	// FUNCTION ADDS THE CATEGORY ICON TO THE ADMIN VIEW
	function category_id_head( $columns ) {		 
		//unset($columns['title']);	 
		unset($columns['description']);
		unset($columns['slug']);	
    	$columns['icon'] = 'Icon';		 
		$columns['id'] = 'ID';		 
    	return $columns;
		
	}	
	
	// FUNCTION ADDS IN AN EXTRA FIELD TO THE CATEGORY CREATION SO YOU CAN
	function category_id_row( $output, $column, $term_id ){
	
		global $wpdb; $icon ="";
 
		if( $column == 'id'){
		
			return $term_id;
		
		}elseif( $column == 'description'){
		
			return strip_tags(substr($output,0,100));
		
		}elseif( $column == 'icon'){	
			
			if(isset($GLOBALS['CORE_THEME']['category_icon_'.$term_id])){
			$imgPath = $GLOBALS['CORE_THEME']['category_icon_'.$term_id];
			}else{
			$imgPath = "";
			}
			
			if(strlen($imgPath) > 5){	 
			$icon = "<img src='".$imgPath."' style='max-width:50px; max-height:50px;' />";	
			}	 
			return $icon;
		
		}else{
		
			return $output;
		
		}
	 
	}
	function my_category_fields($tag) { global $wpdb;
	
		// LOAD IN MAIN DEFAULTS
		$core_admin_values = get_option("core_admin_values"); 
		
		?>
   
        
            <input type="hidden" value="" name="imgIdblock" id="imgIdblock" />
            
            <script >
			
			function changefaicon(faicon){
			
			jQuery('#caticon1').val(faicon);
			jQuery(this).css('border:1px solid red');
			
			}
			
			function ChangeImgBlock(divname){ document.getElementById("imgIdblock").value = divname; }

            function ChangeCatIcon(id){	
			
				window.send_to_editor = function(html) {
				
					var regex = /src="(.+?)"/;
					var rslt =html.match(regex);
					var imgurl = rslt[1];
				 
				 jQuery('#'+document.getElementById("imgIdblock").value).val(imgurl);
				 tb_remove();
				} 
			
				if(id == 2){
				
					ChangeImgBlock('caticon2');
					formfield = jQuery('#caticon2').attr('name');
					
				}else if(id == 3){
					ChangeImgBlock('caticon3');
					formfield = jQuery('#caticon3').attr('name');
				
				
				}else if(id == 4){
					ChangeImgBlock('caticon4');
					formfield = jQuery('#caticon4').attr('name');
				 
				} else {
					ChangeImgBlock('caticon');
					formfield = jQuery('#caticon').attr('name');
				}
				 
				 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				 return false;             
            }
			
			jQuery(document).ready(function() {			 
						
			jQuery('.term-description-wrap label').html('Small Description');
			
			});
            
            </script>
            
              <script> var ajax_site_url = "<?php echo home_url(); ?>/"; </script>
   
		
            <table class="form-table">
            
            
             <tr class="form-field">
             
             <th>
             <label>Big Description</label>
             
             </th>
             
             <td>
             <div>
        <?php                     
        // LOAD UP EDITOR
		if(isset( $core_admin_values['category_description_'.$_GET['tag_ID']])){
		$content = $core_admin_values['category_description_'.$_GET['tag_ID']];
		}else{
		$content = "";
		}
        
		$settings = array( 'media_buttons' => true, 'tinymce' => true, 'teeny' => true, "editor_height" => 300, 'textarea_name' => 'cat_desc_big' );
        wp_editor( $content, 'message', $settings ); 
        
        ?> 
        
        <p>This description is displayed when viewing the category top level page.</p>
        
        </div>
        
             </td>
             
             </tr>
             
             
<?php

	$catTrans = _ppt('category_translation');
	 
	if(is_array(_ppt('languages') )){ 
	?>
             <tr class="form-field">
             
             <th>
             <label>Translations</label>
             
             </th>
             
             <td>
             
 


	<?php 
	

	
		foreach(_ppt('languages') as $lang){
			
			$icon = explode("_",$lang); 
			
			if(isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
	
	 
	?>
 
 <div>
 
 <a href="javascript:void(0);" onclick="ajax_translate(jQuery('#name').val(),'en','<?php echo strtolower($lang); ?>','#cat_trans_<?php echo strtolower($lang); ?>');">
    <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?>">&nbsp;</div>
 </a>
    
    <input type="text" id="cat_trans_<?php echo strtolower($lang); ?>"
    name="category_translation[<?php echo strtolower($lang); ?>][<?php echo $_GET['tag_ID']; ?>]"
    value="<?php if(isset($catTrans[strtolower($lang)]) && isset($catTrans[strtolower($lang)][$_GET['tag_ID']]) ){ echo $catTrans[strtolower($lang)][$_GET['tag_ID']]; } ?>" />

</div>
	<?php }  ?>
    
             
             
             
             </td>
             
             </tr>
<?php } ?>

             
             <?php /*
             
             
            
             <tr class="form-field">
             
             <th>
             <label>Hide Results</label>
             
             </th>
             
             <td>
             
             <select name="category_hideresults_<?php echo $_GET['tag_ID']; ?>">
             <option value="0">Off</option>
             <option value="1" <?php if(isset($core_admin_values['category_hideresults_'.$_GET['tag_ID']]) && $core_admin_values['category_hideresults_'.$_GET['tag_ID']] == 1){ echo "selected=selected"; }?>>On</option>
             </select>
      
        
        <p>Turn this on if you want to display sub category images instead of the category results.</p>
        
             </td>
             
             </tr>
            
            <tr class="form-field">
                      <th scope="row" valign="top"><label>Category Image</label></th>
                        <td><input name="caticon2" id="caticon2" type="text" size="40" aria-required="false" value="<?php if(isset($core_admin_values['category_image_'.$_GET['tag_ID']])){ echo $core_admin_values['category_image_'.$_GET['tag_ID']]; } ?>" />                        
                       <input type="button" size="36" name="upload_caticon2" value="Select Image" onclick="ChangeCatIcon(2);" class="button" style="width:100px;"> 
                       
                       <p>This is displayed on the category overview page ONLY if you've enabled 'hide results' on the parent category.</p>               
                        
                        </td>
            <tr>
            
            
                 <?php if(isset($core_admin_values['category_image_'.$_GET['tag_ID']]) && $core_admin_values['category_image_'.$_GET['tag_ID']] != ""){ ?>
                    <tr>
                    <td colspan="2">
                    	 
                        
                        <img src="<?php echo $core_admin_values['category_image_'.$_GET['tag_ID']]; ?>" style="max-width:500px;"/>
                        
                        
                    </td>                    
                    </tr>
                    <?php } ?>
            
            <tr class="form-field">
                	<th scope="row" valign="top"><label>Category Image (home page)</label></th>
                    
                        <td><input name="caticon" id="caticon" type="text" size="40" aria-required="false" value="<?php if(isset($core_admin_values['category_icon_'.$_GET['tag_ID']])){ echo $core_admin_values['category_icon_'.$_GET['tag_ID']]; } ?>" />                        
                       <input type="button" size="36" name="upload_caticon" value="Select Image" onclick="ChangeCatIcon();" class="button" style="width:100px;"> 
                       
                       <p>This is displayed on the home page ONLY if the theme you are using includes category images.</p>               
                        
                        
                        </td>
         </tr>
         
                    
                    
                    <?php if(isset($core_admin_values['category_icon_'.$_GET['tag_ID']]) && $core_admin_values['category_icon_'.$_GET['tag_ID']] != ""){ ?>
                    <tr>
                    <td colspan="2">
                    	 
                        
                        <img src="<?php echo $core_admin_values['category_icon_'.$_GET['tag_ID']]; ?>" style="max-width:500px;"/>
                        
                        
                    </td>                    
                    </tr>
                    <?php } ?>
            
            
            
              <tr class="form-field">
                	<th scope="row" valign="top"><label>Category Image (mobile home page)</label></th>
                    
                        <td><input name="caticon3" id="caticon3" type="text" size="40" aria-required="false" value="<?php if(isset($core_admin_values['category_image_mobile_'.$_GET['tag_ID']])){ echo $core_admin_values['category_image_mobile_'.$_GET['tag_ID']]; } ?>" />                        
                       <input type="button" size="36" name="upload_caticon3" value="Select Image" onclick="ChangeCatIcon(3);" class="button" style="width:100px;"> 
                       
                       <p>This is displayed on the home page ONLY if viewed on a mobile device and showing the mobile web interface.</p>               
                        
                        
                        </td>
         </tr>
         
                    
                    
                    <?php if(isset($core_admin_values['category_icon_'.$_GET['tag_ID']]) && $core_admin_values['category_icon_'.$_GET['tag_ID']] != ""){ ?>
                    <tr>
                    <td colspan="2">
                    	 
                        
                        <img src="<?php echo $core_admin_values['category_icon_'.$_GET['tag_ID']]; ?>" style="max-width:500px;"/>
                        
                        
                    </td>                    
                    </tr>
                    <?php } ?>
            
                         <tr class="form-field">
             
             <th>
             <label>Hide Mobile (home page)</label>
             
             </th>
             
             <td>
             
             <select name="category_hidemobile_<?php echo $_GET['tag_ID']; ?>">
             <option value="0">Off</option>
             <option value="1" <?php if(isset($core_admin_values['category_hidemobile_'.$_GET['tag_ID']]) && $core_admin_values['category_hidemobile_'.$_GET['tag_ID']] == 1){ echo "selected=selected"; }?>>On</option>
             </select>
      
        
        <p>Turn this on if you want to hide the display of this category on the mobile home page.</p>
        
             </td>
             
             </tr>
          */ ?>  
            
            
            <tr class="form-field">
                    
                    <?php if(defined('WLT_COUPON') || defined('WLT_COMPARISON')){ ?>
                    
                       <th scope="row" valign="top"><label>Website Link</label></th>
                        <td><input name="websitelink" id="websitelink" type="text" size="40" style="width:300px;" aria-required="false" value="<?php if(isset($core_admin_values['category_website_'.$_GET['tag_ID']])){ echo $core_admin_values['category_website_'.$_GET['tag_ID']]; } ?>" />   
                        
                        <small class="clearfix">e.g: http://google.com</small>
                        
                        </td>
                    </tr>
                    
                    <th scope="row" valign="top"><label>Website Affiliate Link</label></th>
                        <td><input name="websitelinkafflink" id="websitelinkafflink" type="text" size="40" style="width:300px;" aria-required="false" value="<?php if(isset($core_admin_values['category_website_afflink_'.$_GET['tag_ID']])){ echo $core_admin_values['category_website_afflink_'.$_GET['tag_ID']]; } ?>" />   
                         
                         <small class="clearfix">e.g: http://google.com/?myaffiliatelink=123</small>
                         
                         </td>
                    </tr>
                    
                    <?php } ?>
                    
                       <th scope="row" valign="top"><label>Small Image </label></th>
                        <td><input name="caticon" id="caticon" type="text" size="40" aria-required="false" value="<?php echo _ppt('category_icon_'.$_GET['tag_ID']); ?>" />                        
                       <input type="button" size="36" name="upload_caticon" value="Upload Image" onclick="ChangeCatIcon();" class="button" style="width:100px;">  
                       
                       <p class="description">The image is not prominent by default; however, some themes may show it. <br /> This image is used in default category block widgets.</p>                 
                        
                        <?php if(_ppt('category_icon_'.$_GET['tag_ID']) != ""){ ?>
                        <div style="background:#efefef;border:1px solid #ddd; padding:20px; margin-top:20px;">
                       
                       
                       <img src="<?php echo _ppt('category_icon_'.$_GET['tag_ID']); ?>" class="img-fluid" style="max-width:500px; max-height:600px; " />
                        </div>
                        <?php } ?>
                        
                       </td>
                    </tr>
                    
                    
                         <th scope="row" valign="top"><label>Big Image </label></th>
                        <td><input name="caticon4" id="caticon4" type="text" size="40" aria-required="false" value="<?php echo _ppt('storeimage_'.$_GET['tag_ID']); ?>" />                        
                       <input type="button" size="36" name="upload_caticon4" value="Upload Image" onclick="ChangeCatIcon(4);" class="button" style="width:100px;"> 
                       
                       <p class="description">The image is not prominent by default; however, some themes may show it.</p>                   
                        
                        <?php if(_ppt('storeimage_'.$_GET['tag_ID']) != ""){ ?>
                        <div style="background:#efefef;border:1px solid #ddd; padding:20px; margin-top:20px;">
                       
                       
                       <img src="<?php echo _ppt('storeimage_'.$_GET['tag_ID']); ?>" class="img-fluid" style="max-width:500px; max-height:600px; "/>
                        </div>
                        <?php } ?>
                        
                       </td>
                    </tr>
                        
                    
                    
            
                    <tr class="form-field">
                    
                       <th scope="row" valign="top"><label>Text Icon</label> </th>
                        <td><input name="caticon1" id="caticon1" type="text" size="40" style="width:300px;" aria-required="false" value="<?php if(isset($core_admin_values['category_icon_small_'.$_GET['tag_ID']])){ echo $core_admin_values['category_icon_small_'.$_GET['tag_ID']]; } ?>" />     
                        <a href="javascript:void(0);" onclick="jQuery('#showfaicons').toggle();" class="button">View Icons</a>  
                        
                        <p class="description">The icon is not prominent by default; however, some themes may show it.</p> 
                        
                        <!--
                        <p style="margin-top:20px;">This icon is only used in the category widget list and only the icon name should be entered. e.g: fa-cogs</p> 
                        
                        <p>Full icon list is found here: <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">http://fortawesome.github.io/Font-Awesome/icons/</a> 
                        
                        -->    
                        
                        <div id="showfaicons" style="display:none;">
                        <hr />
                        
                    <link rel="stylesheet" href="<?php echo FRAMREWORK_URI; ?>css/backup_css/css.font-awesome.css" media="screen" />   
                        <?php
						
						$font_awesome_icons = array( 'fa-glass' => '\f000', 'fa-music' => '\f001', 'fa-search' => '\f002', 'fa-envelope-o' => '\f003', 'fa-heart' => '\f004', 'fa-star' => '\f005', 'fa-star-o' => '\f006', 'fa-user' => '\f007', 'fa-film' => '\f008', 'fa-th-large' => '\f009', 'fa-th' => '\f00a', 'fa-th-list' => '\f00b', 'fa-check' => '\f00c', 'fa-times' => '\f00d', 'fa-search-plus' => '\f00e', 'fa-search-minus' => '\f010', 'fa-power-off' => '\f011', 'fa-signal' => '\f012', 'fa-cog' => '\f013', 'fa-trash-o' => '\f014', 'fa-home' => '\f015', 'fa-file-o' => '\f016', 'fa-clock-o' => '\f017', 'fa-road' => '\f018', 'fa-download' => '\f019', 'fa-arrow-circle-o-down' => '\f01a', 'fa-arrow-circle-o-up' => '\f01b', 'fa-inbox' => '\f01c', 'fa-play-circle-o' => '\f01d', 'fa-repeat' => '\f01e', 'fa-refresh' => '\f021', 'fa-list-alt' => '\f022', 'fa-lock' => '\f023', 'fa-flag' => '\f024', 'fa-headphones' => '\f025', 'fa-volume-off' => '\f026', 'fa-volume-down' => '\f027', 'fa-volume-up' => '\f028', 'fa-qrcode' => '\f029', 'fa-barcode' => '\f02a', 'fa-tag' => '\f02b', 'fa-tags' => '\f02c', 'fa-book' => '\f02d', 'fa-bookmark' => '\f02e', 'fa-print' => '\f02f', 'fa-camera' => '\f030', 'fa-font' => '\f031', 'fa-bold' => '\f032', 'fa-italic' => '\f033', 'fa-text-height' => '\f034', 'fa-text-width' => '\f035', 'fa-align-left' => '\f036', 'fa-align-center' => '\f037', 'fa-align-right' => '\f038', 'fa-align-justify' => '\f039', 'fa-list' => '\f03a', 'fa-outdent' => '\f03b', 'fa-indent' => '\f03c', 'fa-video-camera' => '\f03d', 'fa-picture-o' => '\f03e', 'fa-pencil' => '\f040', 'fa-map-marker' => '\f041', 'fa-adjust' => '\f042', 'fa-tint' => '\f043', 'fa-pencil-square-o' => '\f044', 'fa-share-square-o' => '\f045', 'fa-check-square-o' => '\f046', 'fa-arrows' => '\f047', 'fa-step-backward' => '\f048', 'fa-fast-backward' => '\f049', 'fa-backward' => '\f04a', 'fa-play' => '\f04b', 'fa-pause' => '\f04c', 'fa-stop' => '\f04d', 'fa-forward' => '\f04e', 'fa-fast-forward' => '\f050', 'fa-step-forward' => '\f051', 'fa-eject' => '\f052', 'fa-chevron-left' => '\f053', 'fa-chevron-right' => '\f054', 'fa-plus-circle' => '\f055', 'fa-minus-circle' => '\f056', 'fa-times-circle' => '\f057', 'fa-check-circle' => '\f058', 'fa-question-circle' => '\f059', 'fa-info-circle' => '\f05a', 'fa-crosshairs' => '\f05b', 'fa-times-circle-o' => '\f05c', 'fa-check-circle-o' => '\f05d', 'fa-ban' => '\f05e', 'fa-arrow-left' => '\f060', 'fa-arrow-right' => '\f061', 'fa-arrow-up' => '\f062', 'fa-arrow-down' => '\f063', 'fa-share' => '\f064', 'fa-expand' => '\f065', 'fa-compress' => '\f066', 'fa-plus' => '\f067', 'fa-minus' => '\f068', 'fa-asterisk' => '\f069', 'fa-exclamation-circle' => '\f06a', 'fa-gift' => '\f06b', 'fa-leaf' => '\f06c', 'fa-fire' => '\f06d', 'fa-eye' => '\f06e', 'fa-eye-slash' => '\f070', 'fa-exclamation-triangle' => '\f071', 'fa-plane' => '\f072', 'fa-calendar' => '\f073', 'fa-random' => '\f074', 'fa-comment' => '\f075', 'fa-magnet' => '\f076', 'fa-chevron-up' => '\f077', 'fa-chevron-down' => '\f078', 'fa-retweet' => '\f079', 'fa-shopping-cart' => '\f07a', 'fa-folder' => '\f07b', 'fa-folder-open' => '\f07c', 'fa-arrows-v' => '\f07d', 'fa-arrows-h' => '\f07e', 'fa-bar-chart-o' => '\f080', 'fa-twitter-square' => '\f081', 'fa-facebook-square' => '\f082', 'fa-camera-retro' => '\f083', 'fa-key' => '\f084', 'fa-cogs' => '\f085', 'fa-comments' => '\f086', 'fa-thumbs-o-up' => '\f087', 'fa-thumbs-o-down' => '\f088', 'fa-star-half' => '\f089', 'fa-heart-o' => '\f08a', 'fa-sign-out' => '\f08b', 'fa-linkedin-square' => '\f08c', 'fa-thumb-tack' => '\f08d', 'fa-external-link' => '\f08e', 'fa-sign-in' => '\f090', 'fa-trophy' => '\f091', 'fa-github-square' => '\f092', 'fa-upload' => '\f093', 'fa-lemon-o' => '\f094', 'fa-phone' => '\f095', 'fa-square-o' => '\f096', 'fa-bookmark-o' => '\f097', 'fa-phone-square' => '\f098', 'fa-twitter' => '\f099', 'fa-facebook' => '\f09a', 'fa-github' => '\f09b', 'fa-unlock' => '\f09c', 'fa-credit-card' => '\f09d', 'fa-rss' => '\f09e', 'fa-hdd-o' => '\f0a0', 'fa-bullhorn' => '\f0a1', 'fa-bell' => '\f0f3', 'fa-certificate' => '\f0a3', 'fa-hand-o-right' => '\f0a4', 'fa-hand-o-left' => '\f0a5', 'fa-hand-o-up' => '\f0a6', 'fa-hand-o-down' => '\f0a7', 'fa-arrow-circle-left' => '\f0a8', 'fa-arrow-circle-right' => '\f0a9', 'fa-arrow-circle-up' => '\f0aa', 'fa-arrow-circle-down' => '\f0ab', 'fa-globe' => '\f0ac', 'fa-wrench' => '\f0ad', 'fa-tasks' => '\f0ae', 'fa-filter' => '\f0b0', 'fa-briefcase' => '\f0b1', 'fa-arrows-alt' => '\f0b2', 'fa-users' => '\f0c0', 'fa-link' => '\f0c1', 'fa-cloud' => '\f0c2', 'fa-flask' => '\f0c3', 'fa-scissors' => '\f0c4', 'fa-files-o' => '\f0c5', 'fa-paperclip' => '\f0c6', 'fa-floppy-o' => '\f0c7', 'fa-square' => '\f0c8', 'fa-bars' => '\f0c9', 'fa-list-ul' => '\f0ca', 'fa-list-ol' => '\f0cb', 'fa-strikethrough' => '\f0cc', 'fa-underline' => '\f0cd', 'fa-table' => '\f0ce', 'fa-magic' => '\f0d0', 'fa-truck' => '\f0d1', 'fa-pinterest' => '\f0d2', 'fa-pinterest-square' => '\f0d3', 'fa-google-plus-square' => '\f0d4', 'fa-google-plus' => '\f0d5', 'fa-money' => '\f0d6', 'fa-caret-down' => '\f0d7', 'fa-caret-up' => '\f0d8', 'fa-caret-left' => '\f0d9', 'fa-caret-right' => '\f0da', 'fa-columns' => '\f0db', 'fa-sort' => '\f0dc', 'fa-sort-desc' => '\f0dd', 'fa-sort-asc' => '\f0de', 'fa-envelope' => '\f0e0', 'fa-linkedin' => '\f0e1', 'fa-undo' => '\f0e2', 'fa-gavel' => '\f0e3', 'fa-tachometer' => '\f0e4', 'fa-comment-o' => '\f0e5', 'fa-comments-o' => '\f0e6', 'fa-bolt' => '\f0e7', 'fa-sitemap' => '\f0e8', 'fa-umbrella' => '\f0e9', 'fa-clipboard' => '\f0ea', 'fa-lightbulb-o' => '\f0eb', 'fa-exchange' => '\f0ec', 'fa-cloud-download' => '\f0ed', 'fa-cloud-upload' => '\f0ee', 'fa-user-md' => '\f0f0', 'fa-stethoscope' => '\f0f1', 'fa-suitcase' => '\f0f2', 'fa-bell-o' => '\f0a2', 'fa-coffee' => '\f0f4', 'fa-cutlery' => '\f0f5', 'fa-file-text-o' => '\f0f6', 'fa-building-o' => '\f0f7', 'fa-hospital-o' => '\f0f8', 'fa-ambulance' => '\f0f9', 'fa-medkit' => '\f0fa', 'fa-fighter-jet' => '\f0fb', 'fa-beer' => '\f0fc', 'fa-h-square' => '\f0fd', 'fa-plus-square' => '\f0fe', 'fa-angle-double-left' => '\f100', 'fa-angle-double-right' => '\f101', 'fa-angle-double-up' => '\f102', 'fa-angle-double-down' => '\f103', 'fa-angle-left' => '\f104', 'fa-angle-right' => '\f105', 'fa-angle-up' => '\f106', 'fa-angle-down' => '\f107', 'fa-desktop' => '\f108', 'fa-laptop' => '\f109', 'fa-tablet' => '\f10a', 'fa-mobile' => '\f10b', 'fa-circle-o' => '\f10c', 'fa-quote-left' => '\f10d', 'fa-quote-right' => '\f10e', 'fa-spinner' => '\f110', 'fa-circle' => '\f111', 'fa-reply' => '\f112', 'fa-github-alt' => '\f113', 'fa-folder-o' => '\f114', 'fa-folder-open-o' => '\f115', 'fa-smile-o' => '\f118', 'fa-frown-o' => '\f119', 'fa-meh-o' => '\f11a', 'fa-gamepad' => '\f11b', 'fa-keyboard-o' => '\f11c', 'fa-flag-o' => '\f11d', 'fa-flag-checkered' => '\f11e', 'fa-terminal' => '\f120', 'fa-code' => '\f121', 'fa-reply-all' => '\f122', 'fa-star-half-o' => '\f123', 'fa-location-arrow' => '\f124', 'fa-crop' => '\f125', 'fa-code-fork' => '\f126', 'fa-chain-broken' => '\f127', 'fa-question' => '\f128', 'fa-info' => '\f129', 'fa-exclamation' => '\f12a', 'fa-superscript' => '\f12b', 'fa-subscript' => '\f12c', 'fa-eraser' => '\f12d', 'fa-puzzle-piece' => '\f12e', 'fa-microphone' => '\f130', 'fa-microphone-slash' => '\f131', 'fa-shield' => '\f132', 'fa-calendar-o' => '\f133', 'fa-fire-extinguisher' => '\f134', 'fa-rocket' => '\f135', 'fa-maxcdn' => '\f136', 'fa-chevron-circle-left' => '\f137', 'fa-chevron-circle-right' => '\f138', 'fa-chevron-circle-up' => '\f139', 'fa-chevron-circle-down' => '\f13a', 'fa-html5' => '\f13b', 'fa-css3' => '\f13c', 'fa-anchor' => '\f13d', 'fa-unlock-alt' => '\f13e', 'fa-bullseye' => '\f140', 'fa-ellipsis-h' => '\f141', 'fa-ellipsis-v' => '\f142', 'fa-rss-square' => '\f143', 'fa-play-circle' => '\f144', 'fa-ticket' => '\f145', 'fa-minus-square' => '\f146', 'fa-minus-square-o' => '\f147', 'fa-level-up' => '\f148', 'fa-level-down' => '\f149', 'fa-check-square' => '\f14a', 'fa-pencil-square' => '\f14b', 'fa-external-link-square' => '\f14c', 'fa-share-square' => '\f14d', 'fa-compass' => '\f14e', 'fa-caret-square-o-down' => '\f150', 'fa-caret-square-o-up' => '\f151', 'fa-caret-square-o-right' => '\f152', 'fa-eur' => '\f153', 'fa-gbp' => '\f154', 'fa-usd' => '\f155', 'fa-inr' => '\f156', 'fa-jpy' => '\f157', 'fa-rub' => '\f158', 'fa-krw' => '\f159', 'fa-btc' => '\f15a', 'fa-file' => '\f15b', 'fa-file-text' => '\f15c', 'fa-sort-alpha-asc' => '\f15d', 'fa-sort-alpha-desc' => '\f15e', 'fa-sort-amount-asc' => '\f160', 'fa-sort-amount-desc' => '\f161', 'fa-sort-numeric-asc' => '\f162', 'fa-sort-numeric-desc' => '\f163', 'fa-thumbs-up' => '\f164', 'fa-thumbs-down' => '\f165', 'fa-youtube-square' => '\f166', 'fa-youtube' => '\f167', 'fa-xing' => '\f168', 'fa-xing-square' => '\f169', 'fa-youtube-play' => '\f16a', 'fa-dropbox' => '\f16b', 'fa-stack-overflow' => '\f16c', 'fa-instagram' => '\f16d', 'fa-flickr' => '\f16e', 'fa-adn' => '\f170', 'fa-bitbucket' => '\f171', 'fa-bitbucket-square' => '\f172', 'fa-tumblr' => '\f173', 'fa-tumblr-square' => '\f174', 'fa-long-arrow-down' => '\f175', 'fa-long-arrow-up' => '\f176', 'fa-long-arrow-left' => '\f177', 'fa-long-arrow-right' => '\f178', 'fa-apple' => '\f179', 'fa-windows' => '\f17a', 'fa-android' => '\f17b', 'fa-linux' => '\f17c', 'fa-dribbble' => '\f17d', 'fa-skype' => '\f17e', 'fa-foursquare' => '\f180', 'fa-trello' => '\f181', 'fa-female' => '\f182', 'fa-male' => '\f183', 'fa-gittip' => '\f184', 'fa-sun-o' => '\f185', 'fa-moon-o' => '\f186', 'fa-archive' => '\f187', 'fa-bug' => '\f188', 'fa-vk' => '\f189', 'fa-weibo' => '\f18a', 'fa-renren' => '\f18b', 'fa-pagelines' => '\f18c', 'fa-stack-exchange' => '\f18d', 'fa-arrow-circle-o-right' => '\f18e', 'fa-arrow-circle-o-left' => '\f190', 'fa-caret-square-o-left' => '\f191', 'fa-dot-circle-o' => '\f192', 'fa-wheelchair' => '\f193', 'fa-vimeo-square' => '\f194', 'fa-try' => '\f195', 'fa-plus-square-o' => '\f196', 'fa-space-shuttle' => '\f197', 'fa-slack' => '\f198', 'fa-envelope-square' => '\f199', 'fa-wordpress' => '\f19a', 'fa-openid' => '\f19b', 'fa-university' => '\f19c', 'fa-graduation-cap' => '\f19d', 'fa-yahoo' => '\f19e', 'fa-google' => '\f1a0', 'fa-reddit' => '\f1a1', 'fa-reddit-square' => '\f1a2', 'fa-stumbleupon-circle' => '\f1a3', 'fa-stumbleupon' => '\f1a4', 'fa-delicious' => '\f1a5', 'fa-digg' => '\f1a6', 'fa-pied-piper' => '\f1a7', 'fa-pied-piper-alt' => '\f1a8', 'fa-drupal' => '\f1a9', 'fa-joomla' => '\f1aa', 'fa-language' => '\f1ab', 'fa-fax' => '\f1ac', 'fa-building' => '\f1ad', 'fa-child' => '\f1ae', 'fa-paw' => '\f1b0', 'fa-spoon' => '\f1b1', 'fa-cube' => '\f1b2', 'fa-cubes' => '\f1b3', 'fa-behance' => '\f1b4', 'fa-behance-square' => '\f1b5', 'fa-steam' => '\f1b6', 'fa-steam-square' => '\f1b7', 'fa-recycle' => '\f1b8', 'fa-car' => '\f1b9', 'fa-taxi' => '\f1ba', 'fa-tree' => '\f1bb', 'fa-spotify' => '\f1bc', 'fa-deviantart' => '\f1bd', 'fa-soundcloud' => '\f1be', 'fa-database' => '\f1c0', 'fa-file-pdf-o' => '\f1c1', 'fa-file-word-o' => '\f1c2', 'fa-file-excel-o' => '\f1c3', 'fa-file-powerpoint-o' => '\f1c4', 'fa-file-image-o' => '\f1c5', 'fa-file-archive-o' => '\f1c6', 'fa-file-audio-o' => '\f1c7', 'fa-file-video-o' => '\f1c8', 'fa-file-code-o' => '\f1c9', 'fa-vine' => '\f1ca', 'fa-codepen' => '\f1cb', 'fa-jsfiddle' => '\f1cc', 'fa-life-ring' => '\f1cd', 'fa-circle-o-notch' => '\f1ce', 'fa-rebel' => '\f1d0', 'fa-empire' => '\f1d1', 'fa-git-square' => '\f1d2', 'fa-git' => '\f1d3', 'fa-hacker-news' => '\f1d4', 'fa-tencent-weibo' => '\f1d5', 'fa-qq' => '\f1d6', 'fa-weixin' => '\f1d7', 'fa-paper-plane' => '\f1d8', 'fa-paper-plane-o' => '\f1d9', 'fa-history' => '\f1da', 'fa-circle-thin' => '\f1db', 'fa-header' => '\f1dc', 'fa-paragraph' => '\f1dd', 'fa-sliders' => '\f1de', 'fa-share-alt' => '\f1e0', 'fa-share-alt-square' => '\f1e1', 'fa-bomb' => '\f1e2' );
						?>
                        
                       
                        
                        
                        <?php foreach($font_awesome_icons as $ficon => $fhex){ ?>
                        
                        <div style="float:left; padding:5px; background:#fff; border:1px solid #ddd; margin-right:10px; margin-bottom:10px; cursor:pointer; font-size:20px; padding-left:10px; padding-right:10px;" onclick="changefaicon('fa <?php echo $ficon; ?>');">
                        <span class="fa <?php echo $ficon; ?>"></span>
                        </div>
                        <?php } ?>
		
                        <div class="clearfix"></div>
                        </div>
               
                                       
                          </td>
                    </tr>
                     
                    
                    
                     
            </table>
		
		
                        
	<?php }	
	
 

 
 

/* =============================================================================
  [PREMIUMPRESS FRAMEWORK] DISPLAY EDIT FIELDS
   ========================================================================== */

// REMOVE OPTIONS WE DONT NEED
function _add_meta_boxes() {
		global $_wp_post_type_features;
		if (isset($_wp_post_type_features[THEME_TAXONOMY.'_type']['editor']) && $_wp_post_type_features[THEME_TAXONOMY.'_type']['editor']) {
			//unset($_wp_post_type_features[THEME_TAXONOMY.'_type']['editor']);	
			//remove_meta_box('postexcerpt', THEME_TAXONOMY.'_type', 'normal');
			remove_meta_box('trackbacksdiv', THEME_TAXONOMY.'_type', 'normal');
			//remove_meta_box('postcustom', THEME_TAXONOMY.'_type', 'normal');
			//remove_meta_box('commentstatusdiv', THEME_TAXONOMY.'_type', 'normal');
			//remove_meta_box('commentsdiv', THEME_TAXONOMY.'_type', 'normal');
			remove_meta_box('revisionsdiv', THEME_TAXONOMY.'_type', 'normal');
			//remove_meta_box('authordiv', THEME_TAXONOMY.'_type', 'normal');
			//remove_meta_box('sqpt-meta-tags', THEME_TAXONOMY.'_type', 'normal'); 
		} 
}
// STOP HTML BEING STRIPPED FROM THE EDITOR BOXES
function myformatTinyMCE($in) {$in['verify_html']=false; return $in; }



 















function buildadminfields($full_list_of_fields){ global $post, $CORE, $wpdb; $tabbedarea = 0; $core_admin_values = get_option("core_admin_values");   ?>
    
  
<?php $i= 0; $rowid=0; foreach($full_list_of_fields as $key=>$val){ $e_value = get_post_meta($_GET['eid'],$key,true); 
 
// CHECK FOR DEFAULT FIELD VALUE
if($e_value == "" && isset($val['default'])){ $e_value = $val['default']; }  

// CHECK IF THIS IS A NEW TAB
if(isset($val['tab'])){ $tabbedarea = $key; $i = 0; ?> 

<div class="clearfix"></div> 
</div></div>

<div class="card card-row-<?php echo $rowid; ?>"> <?php $rowid++; ?>
<div class="card-header"><?php echo $val['title']; ?></div>
<div class="card-body" style="padding:20px;">



<?php }else{ ?>

<div class="row">

<div class="form-group clearfix">
<div class="col-md-6">

   <label class="col-form-label"><?php echo $val['label']; ?></label>
   
</div>
<div class="col-md-6"> 
 
    <?php if(isset($val['combo'])){ ?>
 
    
  <input type="text" id="autocompleteme" style="width:300px;" placeholder="Enter product title here.." /> 
  
  <?php if($key != "related"){ ?>
  <!-- HERE WE GET AND SAVE THE OLD VALUES ENCASE THEY CHANGED -->
  <?php
	$options1 = get_post_meta($post->ID,$key,true); $oldIds = "";
	if(is_array($options1) && !empty($options1)){				
		foreach($options1 as $val1){
		$oldIds .= $val1.",";
		}			 				 
	}// end foreach
  ?>
   <input type="hidden" name="wlt_field[<?php echo $key; ?>_old]" value="<?php echo $oldIds; ?>" /> 
    <?php } ?>
	
	
	<?php } ?>
    
    
    <?php if(isset($val['values'])){ ?>
    <select name="custom[<?php echo $key; ?>]<?php if(isset($val['multi'])){ ?>[]<?php }?>" id="field_<?php echo $key; ?>" <?php if(isset($val['multi'])){ ?>multiple="multiple"<?php } ?> class="form-control">
    
    
     <?php if(isset($val['combo'])){  ?><option value=""> </option><?php } ?>
    <?php if($key == "packageID"){ ?><option value="">----- no package assigned -----</option><?php } ?>
    <?php 
	
	if($key == "related"){
		foreach($val['values'] as $k=>$val){ 			
			$val = trim($val);
			if(strlen($val) > 0 && is_numeric($val)){
			echo '<option value="'.$val.'" selected=selected>'.get_the_title($val).'</option>';	
			}		
		}
	}else{
		foreach($val['values'] as $k=>$o){ 
		
		if(is_array($e_value) && isset($val['multi']) && in_array($k, $e_value) ){ $f = "selected=selected"; }elseif($e_value != "" && $e_value == $k){ $f = "selected=selected"; }else{ $f=""; }?>
		
		<?php if(is_array($o) && $key == "packageID"){ $o = $o['name']; } 
		if($o == ""){ continue; }
		?>
		<option value="<?php echo $k; ?>" <?php echo $f; ?>><?php echo $o; ?></option>
		<?php }?>
    
    <?php } ?>
    
    </select>
    <?php }else{ ?>
    
    <?php 
	 
	if(isset($val['dateitem'])){ 
			 $db = explode(" ",$e_value);
			echo ' 
			<script>jQuery(function(){ jQuery(\'#reg_field_'.$key.'_date\').datetimepicker(); }); </script>
			
			 
			<div style="width:30%; float:left;">
			
			
			<div class="input-prepend date span6" id="reg_field_'.$key.'_date" data-date="'.$db[0].'" data-date-format="yyyy-MM-dd hh:mm:ss">
			<span class="add-on"><i class="dashicons dashicons-calendar-alt" style="cursor:pointer"></i></span>
				<input type="text" name="custom['.$key.']" value="'.$e_value.'" id="reg_field_'.$key.'"  data-format="yyyy-MM-dd hh:mm:ss" />
			 </div>
			 
			 
			 </div>';
		 
			 
	} ?>
    
     
    
    <?php if(!isset($val['dateitem'])){ ?>
    
    <div class="input-group date">
    <?php  if($key == "price" || $key == "old_price" || $key == "current_price" || $key == "reserve_price"    || isset($val['price'])){ ?>
            <span class="add-on input-group-prepend"> <span class="input-group-text"><?php echo _ppt(array('currency','symbol'));   ?></span></span>
     <?php } ?>
  
    
    <input type="text" name="custom[<?php echo $key; ?>]" value="<?php echo $e_value; ?>" id="<?php echo $key; ?>" class="form-control" /> 
    
      </div>
    <?php } ?>
    
    <?php } ?>
    
    <?php if($key == "listing_expiry_date"){ ?>
    <a href="javascript:void(0);" onclick="jQuery('#reg_field_listing_expiry_date').val('<?php echo date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($CORE->DATETIME()))); ?>');" style="float:right;margin-top:5px;" class="button">Set Date Now (+5 mins)</a>  
    <?php } ?>
    
    
<?php if($key == "download_path"){ ?>
  <a href="javascript:void(0);" class="button" id="upload_logo">Select File</a>


<input type="hidden" value="" name="imgIdblock" id="imgIdblock" />

<script >

 function ChangeImgBlock(divname){
	document.getElementById("imgIdblock").value = divname;
} 
 
	jQuery('#upload_logo').click(function() {	
	 
	window.send_to_editor = function(html) {	
	var regex = /src="(.+?)"/;
    var rslt =html.match(regex);
    var imgurl = rslt[1];
	 jQuery('#'+document.getElementById("imgIdblock").value).val(imgurl);
	 tb_remove();
	} 
	
	 ChangeImgBlock('download_path'); 
	 formfield = jQuery('#download_path').attr('name');
	 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
	 return false; 
	 }); 
</script>  
  



<?php  }// end if this field is a tab ?>
 
</div>
</div><!-- end form group -->
</div><!-- end col-md-6 -->

<?php if($i == 2){ ?><div class="clearfix"></div><div class=" mt-1"></div><?php $i = -1; } ?>

<?php $i++; }  }  ?>  
 


<script type="application/javascript">
jQuery(document).ready(function(){	

	jQuery( "#field_listing_status" ).change(function() {
		var sdt = jQuery( "#field_listing_status" ).val();
		if(sdt == 10){
			 jQuery( "#table_row_listing_status_msg" ).show(0);
		}else{
			 jQuery( "#table_row_listing_status_msg" ).hide(0);
		} 
	});	
	var sdt = jQuery( "#field_listing_status" ).val();
	if(sdt == 10){
		jQuery( "#table_row_listing_status_msg" ).show(0);
	}else{
		jQuery( "#table_row_listing_status_msg" ).hide(0);
	} 
	
});
</script>
<?php 
}

 

function _listing_details(){ global $post, $CORE; $core_admin_values = get_option("core_admin_values"); $packagefields = get_option("packagefields"); ?>

<script>

jQuery(document).ready(function(){

 jQuery( document ).tooltip({
  tooltipClass: "wlt_admin_tooltip",
      position: {
        my: "right-50 top-20",
        at: "right+5 top-5"
      },
      show: {
        duration: "fast"
      },
      hide: {
        effect: "hide"
      }
	  
    });
  

});


(function($) {
	
	$(document).on( 'click', '.nav-tab-wrapper a', function() {
		$('section').hide();
		$('#'+$(this).attr("data-id")).show();
		
		$('#wlt_admin_editmenu a').removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active');
		return false;
	})
	
})( jQuery ); 
</script>




 


 <div id="wlt_admin_editmenu_wrap">

<h2 class="nav-tab-wrapper" id="wlt_admin_editmenu">

	<a href="#" data-id="tab-details" class="nav-tab  nav-tab-active"> <span class="ticon icont2">Details</span> </a>
	<a href="#" data-id="tab-media" class="nav-tab"> <span class="ticon icont11">Media Files</span> </a> 
    
    <?php if(!defined('WLT_CART')){ ?>
    
     
	<a href="#" data-id="tab-expiry" class="nav-tab"> <span class="ticon icont3">Expiry Date</span> </a> 
    <a href="#" data-id="tab-timeout" class="nav-tab"> <span class="ticon icont4">Timeout</span> </a> 
    <a href="#" data-id="tab-access" class="nav-tab"> <span class="ticon icont5">Page Access</span> </a>  
     
    <?php if(defined('GOOGLE-MAPS') && _ppt('google') ==  1){ ?>
    <a href="#" data-id="tab-map" class="nav-tab" onclick="loadGoogleMapsApi();"><span class="ticon icont6">Map Location</span></a> 
 	<?php } ?>
    
    <?php }else{ ?>  
    
    <a href="#" data-id="tab-shop-attr" class="nav-tab"><span class="ticon icont7">Attributes</span></a>
    <a href="#" data-id="tab-shop-dis" class="nav-tab"><span class="ticon icont8">Discount</span></a>
    
    <?php } ?>
    
    <?php if(defined('WLT_MICROJOB')){ ?>
    <a href="#" data-id="tab-attr" class="nav-tab"><span class="ticon icont9">Add-Ons</span></a>
    <?php } ?>
    
    <!--<a href="#" data-id="tab-visitors" class="nav-tab mapmebox"><span class="ticon icont10">Visitor History</span></a>    -->

</h2>


<div id="sections" class="wlt_edit_section"> 


<section id="tab-details">

<?php get_template_part('/framework/admin/templates/admin', 'edit-tab-details' );  ?>
<?php if(!defined('WLT_CART')){ ?>
 <?php get_template_part('/framework/admin/templates/admin', 'edit-tab-enhance' );  ?>
 <?php } ?>
</section> 

<section id="tab-media" style="display:none;">

<?php get_template_part('/framework/admin/templates/admin', 'edit-tab-files' );   ?>
 
</section>   
 
<?php if(!defined('WLT_CART')){ ?>

    <section id="tab-expiry" style="display:none;">
    
    <?php get_template_part('/framework/admin/templates/admin', 'edit-tab-expiry' );  ?>
     
    </section>
    
    <?php if(defined('GOOGLE-MAPS') && _ppt('google') ==  1){ ?>
    <section id="tab-map" style="display:none;">
    
    <?php get_template_part('/framework/admin/templates/admin', 'edit-tab-map' );  ?>
     
    </section>
    <?php } ?> 

    <section id="tab-access" style="display:none;">
    
    <?php get_template_part('/framework/admin/templates/admin', 'edit-tab-access' );  ?>
     
    </section>
    
    <section id="tab-timeout" style="display:none;">
    
    <?php get_template_part('/framework/admin/templates/admin', 'edit-tab-timeout' );  ?>
     
    </section>

<?php } ?>

<?php if(defined('WLT_MICROJOB')){ ?>
<section id="tab-attr" style="display:none;">

<?php get_template_part('/framework/admin/templates/admin', 'edit-tab-micojob-attr' );  ?>
 
</section>
<?php } ?>


 
<?php if(defined('WLT_CART')){ ?>
<section id="tab-shop-attr" style="display:none;">

<?php get_template_part('/framework/admin/templates/admin', 'edit-tab-shop-attr' );  ?>
 
</section>

<section id="tab-shop-dis" style="display:none;">

<?php get_template_part('/framework/admin/templates/admin', 'edit-tab-shop-dis' );  ?>
 
</section>
<?php  } ?> 

<section id="tab-visitors" style="display:none;">

<?php //get_template_part('/framework/admin/templates/admin', 'edit-tab-visitors' );  ?>
 
</section>


<div class="clear"></div>
 
</div>

<div class="clear"></div>


</div>

<div style="padding:20px; padding-top:0px;">
<hr />

<input name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="Save Changes" style="margin-top:10px;">  
</div> 
<?php
}
		
 


 
/* =============================================================================
	USER DISPLAY PAGE CHANGES
	========================================================================== */
 
	function contributes_sortable_columns( $columns ) {
		$columns['c1'] = "Listings";
		$columns['c2'] = "Credit";
		if(THEME_KEY != "sp"){
		$columns['c3'] = "Membership";
		}
		
		return $columns;
	}
	function contributes($columns) {
			$columns['c1'] = "Listings";
			$columns['c2'] = "Credit";
			if(THEME_KEY != "sp"){
			$columns['c3'] = "Membership";
			}
			return $columns;
	}		
	function contributes_columns( $value, $column_name, $user_id ) { global $wp_query, $CORE;
			
			if ( 'c1' != $column_name && 'c2' != $column_name && 'c3' != $column_name ){ return $value; }
 			
			if($column_name == "c1"){
			
				$column_title = "Listings";
				$column_slug = THEME_TAXONOMY;
				$posts = query_posts('post_type='.$column_slug.'_type&author='.$user_id.'&order=ASC&posts_per_page=30');//Replace post_type=contribute with the post_type=yourCustomPostName
				$posts_count = "<a href='edit.php?post_type=".THEME_TAXONOMY."_type&author=".$user_id."' style='text-decoration:underline; font-weight:bold;'>".count($posts)."</a>";			 
				return $posts_count;
			
			}elseif($column_name == "c2"){
			
				$user_balance = get_user_meta($user_id,'wlt_usercredit',true);
				if($user_balance == ""){ $user_balance = 0; }
				return hook_price($user_balance);
			
			}elseif($column_name == "c3"){
			
				return $CORE->get_subscription_name($user_id);
			
			}
	}	
	function save_extra_user_profile_fields( $user_id ) {
	global $CORE, $wpdb;
	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
	
	
		
	 	// VERIFIED USER
		$SQL = "SELECT DISTINCT ID
		   FROM ".$wpdb->prefix."posts
		   WHERE ".$wpdb->prefix."posts.post_status = 'publish' 
		   AND ".$wpdb->prefix."posts.post_type = 'listing_type'
		   AND ".$wpdb->prefix."posts.post_author = '".$user_id."' ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT 30"; 		
		$results = $wpdb->get_results($SQL); 				 				 
		if(!empty($results) ){
	 
			foreach ($results as $val){		 
				if($_POST['verified'] == "yes"){
				update_post_meta($val->ID,'verified',1);
				}else{
				delete_post_meta($val->ID,'verified',1);
				}
				
				if($_POST['powerseller'] == "yes"){
				update_post_meta($val->ID,'powerseller',1);
				}else{
				delete_post_meta($val->ID,'powerseller',1);
				}
			}
		 }
		
		 
		update_user_meta( $user_id, 'wlt_verified',$_POST['verified']);		
		update_user_meta( $user_id, 'wlt_powerseller',$_POST['powerseller']);
	
		update_user_meta( $user_id, 'wlt_customtext',$_POST['customtext']);
		update_user_meta( $user_id, 'wlt_usercredit',$_POST['wlt_usercredit']);
		update_user_meta( $user_id, 'wlt_usertokens',$_POST['wlt_usertokens']);
		
		if(isset($_POST['mobile-prefix'])){
		update_user_meta( $user_id, 'mobile-prefix',$_POST['mobile-prefix']);
		update_user_meta( $user_id, 'mobile',$_POST['mobile']);
		}

		// CHECK EMAIL IS VALID			
		update_user_meta($user_id, 'url', strip_tags($_POST['url']));
		update_user_meta($user_id, 'phone', strip_tags($_POST['phone']));
		
		// ADDRESS
		update_user_meta($user_id, 'address1', strip_tags($_POST['address1']));
		update_user_meta($user_id, 'address2', strip_tags($_POST['address2']));
		update_user_meta($user_id, 'zip', strip_tags($_POST['zip']));
		
		// PAYPAL
		if(in_array(THEME_KEY, array('ct','mj','at'))){
		update_user_meta($user_id, 'payment_type', strip_tags($_POST['payment_type']) );
		update_user_meta($user_id, 'paypal', strip_tags($_POST['paypal']) );
		update_user_meta($user_id, 'bank', strip_tags($_POST['bank']) );
		update_user_meta($user_id, 'payaddresss', strip_tags($_POST['payaddresss']) );
		update_user_meta($user_id, 'stripeid', strip_tags($_POST['stripeid']) );
		}
		
			
		// SOCIAL
		update_user_meta($user_id, 'facebook', strip_tags($_POST['facebook']));
		update_user_meta($user_id, 'twitter', strip_tags($_POST['twitter']));
		update_user_meta($user_id, 'linkedin', strip_tags($_POST['linkedin']));
		update_user_meta($user_id, 'skype', strip_tags($_POST['skype']));
		
		// USER PHOTO		 
		if(isset($_FILES['wlt_userphoto']) && strlen($_FILES['wlt_userphoto']['name']) > 2 && in_array($_FILES['wlt_userphoto']['type'],$CORE->allowed_image_types) ){
				 
				// INCLUDE UPLOAD SCRIPTS
				if(!function_exists('wp_handle_upload')){
				$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
				require $dir_path . "/wp-admin/includes/file.php";
				}
				
				// GET WORDPRESS UPLOAD DATA
				$uploads = wp_upload_dir();
				
				// UPLOAD FILE 
				$file_array = array(
					'name' 		=> $_FILES['wlt_userphoto']['name'], //$userdata->ID."_userphoto",//
					'type'		=> $_FILES['wlt_userphoto']['type'],
					'tmp_name'	=> $_FILES['wlt_userphoto']['tmp_name'],
					'error'		=> $_FILES['wlt_userphoto']['error'],
					'size'		=> $_FILES['wlt_userphoto']['size'],
				);
				//die(print_r($file_array));
				$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));
	 	
				// CHECK FOR ERRORS
				if(isset($uploaded_file['error']) ){		
					$GLOBALS['error_message'] = $uploaded_file['error'];
				}else{
			 	 
				// NOW LETS SAVE THE NEW ONE	
				update_user_meta($user_id, "userphoto", array('img' => $uploads['url']."/".$file_array['name'], 'path' => $uploads['path']."/".$file_array['name'] ) );
				
				}
			}


	if(isset($_POST['clubID'])){
	update_user_meta($user_id, 'clubID', strip_tags($_POST['clubID']));
	}
	
	// SAVE USER MEMBERSHIP DATA
	if(isset($_POST['membership'])){ 
	
		// SAVE THE SUBSCRIPTION TO THE USERS ACCOUNT
		$au = get_user_meta( $user_id, 'wlt_subscription', true );
		update_user_meta( $user_id ,'wlt_subscription', 
				array(
					"key" => $_POST['membership'] , 
					"date_start" => $au['date_start'], 
					"date_expires" => $_POST['wlt_membership_expires'],
					"listings" => $_POST['wlt_membership_listings'],
					"flistings" => $_POST['wlt_membership_flistings'],
				)
			);
	
 	}
	
	// CUSTOM FIELDS
	if(isset($_POST['custom']) && is_array($_POST['custom']) && !empty($_POST['custom']) ){
		foreach($_POST['custom'] as $kk => $vv){
			 update_user_meta( $user_id, $kk, $vv);
		}
	}
	
	// CART DELIVERY DATA
	 if(defined('WLT_CART') && isset($_POST['delivery']) && is_array($_POST['delivery']) ){
		 foreach($_POST['delivery'] as $kk => $vv){
		 update_user_meta( $user_id, $kk, $vv);
		 }     
     }
	
	}
	// USER FIELDS FOR THE ADMIN TO EDIT
	function userfields( $contactmethods ) { global $wpdb, $CORE;
	
	$regfields = get_option("regfields");
	if(is_array($regfields)){
		//PUT IN CORRECT ORDER
		$regfields = $CORE->multisort( $regfields , array('order') );
		foreach($regfields as $field){
		
		if(!isset($field['key'])){ continue; }
		
			// EXIST IF KEY DOESNT EXIST
			if(  $field['key'] == ""  && $field['fieldtype'] !="taxonomy" ){ continue; }
			$contactmethods[$field['key']]             = $field['name'];
		}		
	}
    
    return $contactmethods;
   }
   
   function extra_user_profile_fields( $user ) { global $wpdb, $CORE; ?>
   
<style>

.regular-text-r { width:300px;; max-width:400px; }
</style> 
   
   
<?php

$u1 = get_user_meta($user->ID,'login_count',true);
$u2 = get_user_meta($user->ID,'login_lastdate',true);
$u3 = get_user_meta($user->ID,'login_ip',true);

?>


<div class="postbox" style="max-width:400px;">
<h2 class="hndle ui-sortable-handle" style="padding-left: 10px; padding-bottom: 10px;"><span>User Account</span></h2>
<div class="inside" style="font-size:16px;">
	<div class="main">
    
    
<div style="margin-top:20px; font-weight:bold; font-size:14px;">Verify Account</div>

<p>Enable if you've manually verified this user is real.</p>

	<select name="verified"> 
  	<option value="">No</option>
   
  	<option value="yes" <?php if(get_user_meta($user->ID,'wlt_verified',true) == "yes"){ echo "selected='selected'"; } ?>>Yes</option>
    
     
	</select>
   
   
   
   <div style="margin-top:20px; font-weight:bold; font-size:14px;">Power Seller</div>
   
   <p>Power sellers have better display exposure in search results.</p>
 
	<select name="powerseller" style="margin-bottom:30px;"> 
  	<option value="">No</option>
   
  	<option value="1" <?php if(get_user_meta($user->ID,'wlt_powerseller',true) == 1){ echo "selected='selected'"; } ?>>Yes</option>
    
     
	</select> <br />
    
    <div><b>Account Notice</b></div>
	<textarea name="customtext" style="width:100%; height:100px; margin-top:10px;"><?php echo stripslashes(get_user_meta($user->ID,'wlt_customtext',true)); ?></textarea>     
    <p style="margin-bottom:20px;">This text will appear on the users <a href="<?php echo _ppt(array('links','myaccount')); ?>" target="_blank">account area.</a></p>
    
  
      <b>User Credit</b>: <?php echo _ppt(array('currency','symbol')); ?> <input type="text" name="wlt_usercredit" id="field_expiry_date" value="<?php echo get_user_meta($user->ID,'wlt_usercredit',true); ?>" class="regular-text-r" style="width:100px;" /> 
      
       <div style="margin-top:20px;font-size:14px; margin-bottom:30px;">Here you can set an amount in monies that will be credited to the users account. If the value is negative, the users account will show payment options for them to pay you.</div>
    
      <!--
      <label for="text">Tokens</label>
      <input type="text" name="wlt_usertokens" value="<?php echo get_user_meta($user->ID,'wlt_usertokens',true); ?>" class="regular-text-r" style="width:100px;" /> 
 	-->
    
    
<table style="font-size:14px; text-align:left;">






    <tr>
    <th> Address 1 </th>
    <td>
    <input type="text" name="address1" value="<?php echo get_user_meta($user->ID,'address1',true); ?>" class="regular-text-r" />     
    </td>
    </tr> 


   <tr>
    <th> Address 2 </th>
    <td>
    <input type="text" name="address2" value="<?php echo get_user_meta($user->ID,'address2',true); ?>" class="regular-text-r" />     
    </td>
    </tr> 


   <tr>
    <th> Zip/Postal Code </th>
    <td>
    <input type="text" name="zip" value="<?php echo get_user_meta($user->ID,'zip',true); ?>" class="regular-text-r" />     
    </td>
    </tr> 



    <tr>
    <th> Phone </th>
    <td>
    <input type="text" name="phone" value="<?php echo get_user_meta($user->ID,'phone',true); ?>" class="regular-text-r" />     
    </td>
    </tr> 
    
    <tr>
    <th><label>Website </label></th>
    <td>
    <input type="text" name="url" value="<?php echo get_user_meta($user->ID,'url',true); ?>" class="regular-text-r" />     
    </td>
    </tr> 
    
    <tr>
    <th><label>Facebook</label></th>
    <td>
    <input type="text" name="facebook" value="<?php echo get_user_meta($user->ID,'facebook',true); ?>" class="regular-text-r" />     
    </td>
    </tr>  
    
    <tr>
    <th><label>Twitter</label></th>
    <td>
    <input type="text" name="twitter" value="<?php echo get_user_meta($user->ID,'twitter',true); ?>" class="regular-text-r" />     
    </td>
    </tr> 
    
    <tr>
    <th><label>LinkedIn</label></th>
    <td>
    <input type="text" name="linkedin" value="<?php echo get_user_meta($user->ID,'linkedin',true); ?>" class="regular-text-r" />     
    </td>
    </tr> 
    
    <tr>
    <th><label>Skype</label></th>
    <td>
    <input type="text" name="skype" value="<?php echo get_user_meta($user->ID,'skype',true); ?>" class="regular-text-r" />     
    </td>
    </tr> 
 
       
    
	</table>  
    
<?php echo str_replace('col-md-12"','" style="width: 50%; float: left;"', $CORE->user_fields($user->ID) ); ?>

<div class="clear"></div>

 
    
     <div style="margin-top:30px; margin-bottom:30px;"><b>Mobile Number</b></div>
  
	<table>
	<tr>
	<th><label>#</label></th>
	<td>
    <input name="mobile-prefix" value="<?php echo get_user_meta($user->ID,'mobile-prefix',true); ?>" class="regular-text-r" style="width:40px;" placeholder="+"> 
    
    <input name="mobile-num" value="<?php echo get_user_meta($user->ID,'mobile',true); ?>" class="regular-text-r" style="width:140px;">
	</td>
	</tr>
   
   	</table>
    
    
    
    
<?php if(in_array(THEME_KEY, array('ct','mj','at'))){ ?>  


     <div style="margin-top:30px; margin-bottom:30px;"><b>My Payment Information</b></div>

 <div class="bg-light border p-4">
               <div class="row">
                  <div class="col-md-6">
                     <label><?php echo __("My Payment Preference","premiumpress"); ?></label>
                     <select class="form-control" onchange="SwitchPP(this.value)" name="payment_type">
                     
                     <option value="paypal" <?php if(get_user_meta($user->ID,'payment_type',true) == "paypal"){ ?>selected=selected<?php } ?>><?php echo __("PayPal","premiumpress"); ?></option>
                     <?php if(get_option('v9_gateway_stripe_form') == "yes"){ ?>
                          <option value="stripe" <?php if(get_user_meta($user->ID,'payment_type',true) == "stripe"){ ?>selected=selected<?php } ?>><?php echo __("Stripe","premiumpress"); ?></option>
                      <?php } ?>
                          <option value="bank" <?php if(get_user_meta($user->ID,'payment_type',true) == "bank"){ ?>selected=selected<?php } ?>><?php echo __("Bank","premiumpress"); ?></option>
                        <option value="person" <?php if(get_user_meta($user->ID,'payment_type',true) == "person"){ ?>selected=selected<?php } ?>><?php echo __("In Person/On Collection","premiumpress"); ?></option>
                    
                   
                     </select>
                     <p class="small mt-3"><?php echo __("Tell us how you would like to receive payment from members for your products/services.","premiumpress"); ?></p>
                  </div>
                  <div class="col-md-6">
                  
                  
                     <div class="form-group payment_paypal">
                        <label class="control-label"> <?php echo __("PayPal Email","premiumpress"); ?></label>
                        <div class="controls">
                           <input type="text" name="paypal" class="form-control" style="width:100%;" value="<?php echo get_user_meta($user->ID,'paypal',true); ?>" tabindex="4">                       
                        </div>
                     </div>
                     
                     <div class="form-group payment_bank">
                        <label class="control-label"> <?php echo __("My Bank Details","premiumpress"); ?></label>
                        <div class="controls">
                           <textarea class="form-control" style="height:100px; width:100%;" name="bank"><?php echo stripslashes(get_user_meta($user->ID,'bank',true)); ?></textarea>                      
                        </div>
                     </div>
                      
                      <div class="form-group payment_person">
                        <label class="control-label"> <?php echo __("Address for collection","premiumpress"); ?></label>
                        <div class="controls">
                           <textarea class="form-control" style="height:100px; width:100%;" name="payaddresss"><?php echo stripslashes(get_user_meta($user->ID,'payaddresss',true)); ?></textarea>                      
                        </div>
                     </div> 
                     
                     
                     <div class="form-group payment_stripe">
                     
                     
<label class="control-label"><strong>Strip Payments</strong></label>  
           
<p><?php echo __("Join Stripe using our connection link to recieve payment for items sold.","premiumpress") ?></p>

<a href="<?php echo _ppt('auction_stripeconnect_link'); ?>" class=" btn px-4 btn-primary rounded-0 btn-block" target="_blank"><?php echo __("Join Now","premiumpress") ?></a>

<hr />

<p>Once you have joined Stripe you will be provided with an account ID. Please enter this into the box below;</p>
                     
                     
                     <label class="control-label">My Strip Account ID</label>
                     
                         <div class="controls">
                           <input type="text" name="stripeid" class="form-control" value="<?php echo get_user_meta($user->ID,'stripeid',true); ?>" tabindex="4">                       
                        </div>
                     </div> 
                      
                     
                  </div>
               </div>
            </div>
            <script>
			
			
               function SwitchPP(g){
			   
				   if(g == "paypal"){
				   
				    jQuery('.payment_paypal').show();
               		jQuery('.payment_bank').hide();
				    jQuery('.payment_person').hide();
					jQuery('.payment_stripe').hide();
				   
				   }else if(g == "bank"){
				   
				    jQuery('.payment_paypal').hide();
               		jQuery('.payment_bank').show();
				    jQuery('.payment_person').hide();
					jQuery('.payment_stripe').hide();
				   }else if(g == "person"){
				   
				    jQuery('.payment_paypal').hide();
               		jQuery('.payment_bank').hide();
					jQuery('.payment_person').show();					
					jQuery('.payment_stripe').hide();
				
					}else if(g == "stripe"){
					
				    jQuery('.payment_paypal').hide();
               		jQuery('.payment_bank').hide();
					jQuery('.payment_person').hide();					
					jQuery('.payment_stripe').show();
											
				   }else{
				   
				    jQuery('.payment_paypal').show();
               		jQuery('.payment_bank').hide();
					jQuery('.payment_person').hide();					
					jQuery('.payment_stripe').hide();
				   
				   }
              
               }
			   
			       jQuery(document).ready(function(){ 
				   <?php if(get_user_meta($user->ID,'payment_type',true) != ""){ ?>
				   SwitchPP('<?php echo get_user_meta($user->ID,'payment_type',true); ?>') 
				   <?php }else{ ?>
				   jQuery('.payment_paypal').show();
               		jQuery('.payment_bank').hide();
					jQuery('.payment_person').hide();					
					jQuery('.payment_stripe').hide();
				   <?php } ?>
				   });
			   
            </script> 
<?php } ?>
    
    
    
    
 

<div style="background:#f1f1f1; padding:10px; margin-top:40px; font-size:12px;">
	<ul>
	<li class="post-count">Login count: <span style="float:right; font-size:12px; color:#FFFFFF; background:black; padding: 0px 10px;"><?php if( $u1 == ""){ echo 0; }else{ echo $u1; } ?></span></li>
    <li class="page-count">Last Login Date <span style="float:right; font-size:12px; color:#FFFFFF; background:black; padding: 0px 10px;"><?php if( $u2 == ""){ echo "today"; }else{ echo $u2; } ?></span></li>
    <li class="comment-count">Last Login IP: <span style="float:right; font-size:12px; color:#FFFFFF; background:black; padding: 0px 10px;"><?php if( $u1 == ""){ echo "unknown"; }else{ echo $u3; } ?></span></li>
    </ul>  

</div>


 
     <div style="margin-top:30px;"><b>User Photo</b></div>
    <p>Users can upload and manage their photo via their members area. This section is for admins.</p>
	<?php echo get_avatar( $user->ID, 180 ); ?>
    <input type="file" name="wlt_userphoto" />
    
    <style>
	.avatar { max-width:100%; }
	</style>
 
 

    </div>
	</div>    
</div>
 
  
    
    
    <?php 
	$csubscriptions = get_option("csubscriptions");
	if(is_array($csubscriptions) && count($csubscriptions['name']) > 0 ){ 
	
	// USER DATA 
	$cmm = get_user_meta($user->ID,'wlt_subscription',true);
 
	?> 
<div class="postbox" style="max-width:400px;">
<h2 class="hndle ui-sortable-handle" style="padding-left: 10px; padding-bottom: 10px;"><span>Membership Information</span></h2>
<div class="inside" style="font-size:16px;">
	<div class="main">
 
<div style="margin-top:20px; font-weight:bold; font-size:14px;">Name</div>

	<select name="membership"> 
	<?php 
	$i=0;
	foreach($csubscriptions['name'] as $data){
		if($csubscriptions['name'][$i] != "" ){ 
			if( isset($cmm['key']) && $cmm['key'] == $csubscriptions['key'][$i]){ $sel = "selected='selected'"; }else{ $sel = ""; } 
	?>
	<option value="<?php echo stripslashes($csubscriptions['key'][$i]); ?>" <?php echo $sel; ?>><?php echo stripslashes($csubscriptions['name'][$i]); ?></option>
	<?php 
	} 
	$i++; 
	} 
	?>
    <option value="" <?php if(!isset($cmm['key'])){ echo "selected='selected'"; } ?>>------ no membership -------</option>
	</select>

<div style="margin-top:20px; font-weight:bold; font-size:14px;">Expiry Date</div>
    
    <input type="text" name="wlt_membership_expires" id="field_expiry_date1" value="<?php if(isset($cmm['date_expires'])){ echo $cmm['date_expires']; } ?>" class="regular-text-r" /> <a href="javascript:void(0);" onclick="jQuery('#field_expiry_date1').val('<?php echo date('Y-m-d H:i:s'); ?>');">Set</a>

    <div style="margin-top:10px; font-size:12px; color:#666666; ">Membership expiry date. Format: Y-m-d h:i:s</div>

<!--
<div style="margin-top:20px; font-weight:bold; font-size:14px;">Listing Remaining</div>
    
    <input type="text" name="wlt_membership_listings" value="<?php if(isset($cmm['listings'])){ echo $cmm['listings']; } ?>" class="regular-text-r" style="width:60px;" />  


<div style="margin-top:20px; font-weight:bold; font-size:14px;">Featured Listing Remaining</div>
     

  <input type="text" name="wlt_membership_flistings" value="<?php if(isset($cmm['flistings'])){ echo $cmm['flistings']; } ?>" class="regular-text-r" style="width:60px;" />     
-->


   
    </div>
	</div>
    
</div>  
    
    <?php } ?>
     

 
 
 
 	<script >
	var form = document.getElementById('your-profile');
	//form.enctype = "multipart/form-data"; //FireFox, Opera, et al
	form.encoding = "multipart/form-data"; //IE5.5
	form.setAttribute('enctype', 'multipart/form-data'); //required for IE6 (is interpreted into "encType")
	</script>

	<?php  }

 
 
 
 
 
 
 /* =============================================================================
  [PREMIUMPRESS FRAMEWORK] VIEW/EDIT LISTING DISPLAY SETUP
   ========================================================================== */
   
function _admin_remove_columns($defaults) {
	
	if(isset($_GET['post_type']) && ( $_GET['post_type'] == THEME_TAXONOMY."_type" ||  $_GET['post_type'] == "cproduct_type"  )  ){  
	unset($defaults['tags']); 
	unset($defaults['title']); 
	unset($defaults['author']);
	unset($defaults['comments']);
	unset($defaults['date']);
	}
	
	if($_GET['post_type'] == "wlt_payments"){
	//unset($defaults['title']);
	unset($defaults['date']);
	}
 
	return $defaults;
}
function _admin_column_register_sortable( $columns ) {
	$columns['price'] 		= 'Price'; 
	$columns['featured'] 	= 'Featured'; 
	$columns['hits'] 		= 'Views';  
	$columns['clicks'] 		= 'Clicks';
	$columns['qty'] 		= 'Quantity';
	$columns['expires'] 	= 'Expires';	
	$columns['impressions'] = 'Impressions';	
	return $columns;
}

function _admin_custom_columns($defaults) { global $post;

	if(isset($_GET['post_type']) && $_GET['post_type'] == "wlt_campaign"  ){	
	$defaults['clicks'] 		= 'Clicks';  
	$defaults['impressions'] 	= 'Impression';  	
	$defaults['expires'] 		= 'Expires';	
	}
	
	if(isset($_GET['post_type']) && $_GET['post_type'] == "wlt_banner"  ){
	$defaults['banner_img'] 		= 'Image';  
	}
	
	if(isset($_GET['post_type']) && $_GET['post_type'] == "wlt_message"  ){
	$defaults['author'] 		= 'Author';  
	}
	
	if(isset($_GET['post_type']) && $_GET['post_type'] == "wlt_invoices"  ){
	 
	$defaults['invoice_from'] 		= 'From'; 
	$defaults['invoice_to'] 		= 'To'; 
	$defaults['invoice_amount'] 	= 'Amount'; 
	$defaults['order_status']	 	= 'Status';   
	
	}
	
	if(isset($_GET['post_type']) && $_GET['post_type'] == "wlt_payments"  ){
	
	$defaults['order_id'] 			= 'Order ID';
	$defaults['order_system_id'] 	= '#'; 
	$defaults['order_amount'] 		= 'Amount'; 
	$defaults['order_status']	 	= 'Status';  
	$defaults['order_type']	 		= 'Type'; 
	$defaults['date'] 				= 'Date'; 	
	$defaults['order_progress'] 				= 'Progress'; 
	
	}
	
	if(isset($_GET['post_type']) && $_GET['post_type'] == THEME_TAXONOMY."_type"  ){ 		
	$defaults['image'] 		= '';  
	$defaults['title'] 		= 'Title';		 
	$defaults['hits'] 		= 'Page Views'; 
	$defaults['featured'] 	= 'Featured';	
	switch(THEME_KEY){
			case "cp": {			
			$defaults['clicks'] 	= 'Clicks';	
			} break;		
			case "ct": {			
			$defaults['price'] 		= 'Price';
			} break;
			case "at": {			
			$defaults['bids'] 		= 'Bids';
			$defaults['expires'] 	= '<i class="dashicons dashicons-backup ppttooltip"><span>Expires</span></i>';			
			} break;
			case "sp": {			
			$defaults['price'] 		= 'Price';			
			} break;
		} 
		
		 
		//DATE	
		if(in_array(THEME_KEY, array('sp') ) ){
		$defaults['date'] 		= 'Date';
		}else{
		$defaults['expires'] 	= 'Expires';
		}		
		
		//AUTHOR	
		$defaults['author'] 	= 'Author';
		
		// COMMENTS
		if(_ppt('comments') == 1){
		$defaults['comments'] 		= '<i class="dashicons dashicons-admin-comments ppttooltip"><span>Comments</span></i>';	
		}
		
	}
	
	return $defaults;
	
}


function _admin_custom_column_data($column_name, $post_id ) {
 
global $wpdb, $CORE, $post; 
 
  
	switch($column_name){ 
 	
	// INVOICE COLUMNS
	case "invoice_from": {
	
		if(!is_numeric(get_post_meta($post_id, "invoice_from", true))){ 
			echo "user not set"; 
		}else{
			$h =  get_user_by('ID', get_post_meta($post_id, "invoice_from", true)); 
			echo $h->user_login;
		}
	
	} break;
	case "invoice_to": {
		if(!is_numeric(get_post_meta($post_id, "invoice_to", true))){ 
			echo "user not set"; 
		}else{
			$h =  get_user_by('ID', get_post_meta($post_id, "invoice_to", true)); 
			echo $h->user_login;
		}
	} break;
	case "invoice_amount": {
		echo hook_price(get_post_meta($post_id, "invoice_amount", true));
	} break;
	case "order_status": {
		$h = $CORE->order_get_status(get_post_meta($post_id, "invoice_status", true));
		echo "<div style='background:".$h['color']."; text-align:center; font-weight:bold; padding:10px 20px; color:#222;'>".$h['name']."</div>";
	} break;
	
	//PAYMENTS
		
		case "order_amount": {
			$p = get_post_meta($post_id,"order_total",true);
			if($p == ""){
			echo "not set";
			}else{
			echo hook_price($p);
			}
		} break;
		
		case "order_type": {
		
		
		echo "<div style='padding:5px;background:green;color:white;text-align:center'>asdasdad</div>";
		
		} break;
		
		case "order_id": {			
			
			
			echo get_post_meta($post_id,"order_id",true); 
			
			//echo "#".$CORE->order_get_orderid($post_id);
			
		} break;
		case "order_system_id": {		
			
			echo "#".$CORE->order_get_orderid($post_id);
			
		} break;
		
		
		case "order_progress": {
			
			echo get_post_meta($post_id, 'order_total', true);
			
		} break;		
		
		case "order_status":{
			
			$status = get_post_meta($post_id,"status",true);
			if($status == 1){ ?>           
			   <span class="badge badge-success"><?php echo __("Paid","premiumpress"); ?><span>           
			   <?php }elseif($status == 2){ ?>
			   <span class="badge badge-danger"><?php echo __("Refunded","premiumpress"); ?><span>          
			   <?php }elseif($status == 3){ ?>           
			   <span class="badge badge-info"><?php echo __("Cancelled","premiumpress"); ?><span>  
			   <?php
			   }
			   
		} break;	
		case "banner_img": {
			$img = get_post_meta($post_id, 'img', true);
			if($img != ""){
			echo '<img src="'.$img.'" style="max-width:100%">';
			}
		} break;	
	
 		case "impressions": {
		$clicks = get_post_meta($post_id,"impressions",true);
		if($clicks == ""){ echo 0; }else{ echo $clicks; }
		} break;
		
		case "clicks": {
		$clicks = get_post_meta($post_id,"clicks",true);
		if($clicks == ""){ echo 0; }else{ echo $clicks; }
		} break;	
		
		case "bids": {
			$bidding_history = get_post_meta($post_id,'current_bid_data',true);
			if(is_array($bidding_history) && !empty($bidding_history) ){
				echo count($bidding_history);
			}else{
				echo 0;
			}
		} break;	
		case "qty": {
		echo get_post_meta($post_id,"qty",true);
		} break;	
		case "price": {
			$p = get_post_meta($post_id,"price",true);
			if($p == ""){
			echo "not set";
			}else{
			echo hook_price($p);
			}
		} break;
		
		case "expires": {
		 if(defined('WLT_COUPON')){
			$p = "expiry_date";
		}else{
			$p = "listing_expiry_date";
		}
		
		$dd = get_post_meta($post_id, $p, true);
		
		
		if($dd == ""){
		echo "never";
		}else{
		echo do_shortcode('[TIMELEFT postid="'.$post->ID.'" layout="2" text_before="" text_ended="Not Set" key="'.$p.'"]');
		} 
		 
		} break;
		case "featured": {
			$is_featured = get_post_meta($post_id,"featured",true);
		 
			echo "<span id='".$post_id."_yn'>";
				if($is_featured == "yes"){
				echo "<a href='javascript:void(0);' onclick=\"ajax_featured_listing('".$post_id."');\"><i class='dashicons dashicons-star-filled featured' style='color:orange'></i></a>";
				}else{
				echo "<a href='javascript:void(0);' onclick=\"ajax_featured_listing('".$post_id."');\"><i class='dashicons dashicons-star-empty featured' style='color:orange'></i></a>";
				}
			echo "</span>";
			
		} break;
		case "image": {
		 	
			if(THEME_KEY == "cp"){
			
			echo "<a href='post.php?post=".$post_id."&action=edit'>".do_shortcode('[COUPONIMAGE]')."</a>";
			
			}else{
				$img = do_shortcode('[MEDIA limit=1]');
				 
				if($img != ""){
			 
				echo "<a href='post.php?post=".$post_id."&action=edit'>".$img."</a>";
				}
			}
		 
		} break;		
		case "hits": {
		$hits = get_post_meta($post_id,"hits",true);	
		if($hits == "" || !is_numeric($hits)){ $hits =0; }	
		echo number_format($hits);
		}	 	
	}	 // end switch
} 


function _admin_column_orderby( $vars ) {

	if ( isset( $vars['orderby'] ) ) {	
		if('Views' == $vars['orderby'] ){		
			$vars = array_merge( $vars, array(	'meta_key' => 'hits','orderby' => 'meta_value_num',	'order' => $_GET['order']) );	
		}elseif ( 'Price' == $vars['orderby'] ){		
			$vars = array_merge( $vars, array(	'meta_key' => 'price', 'orderby' => 'meta_value', 'order' => $_GET['order']) );				
		}elseif ( 'Clicks' == $vars['orderby'] ){		
			$vars = array_merge( $vars, array(	'meta_key' => 'clicks', 'orderby' => 'meta_value', 'order' => $_GET['order']) );	
		}elseif ( 'impressions' == $vars['orderby'] ){		
			$vars = array_merge( $vars, array(	'meta_key' => 'impressions','orderby' => 'meta_value',	'order' => $_GET['order']) );
		}elseif ( 'Featured' == $vars['orderby'] ){		
			$vars = array_merge( $vars, array(	'meta_key' => 'featured','orderby' => 'meta_value',	'order' => $_GET['order']) );
		}elseif ( 'Quantity' == $vars['orderby'] ){		
			$vars = array_merge( $vars, array(	'meta_key' => 'qty','orderby' => 'meta_value_num',	'order' => $_GET['order']) );		
		}elseif ( 'Expires' == $vars['orderby'] ){	
			if(defined('WLT_COUPON')){
				$vars = array_merge( $vars, array(	'meta_key' => 'expiry_date','orderby' => 'meta_value',	'order' => $_GET['order']) );	
			}else{
				$vars = array_merge( $vars, array(	'meta_key' => 'listing_expiry_date','orderby' => 'meta_value',	'order' => $_GET['order']) );	
			}	
				
		}			
	}
 
	return $vars;
}	
	
 
	function _edit_listing_quick_add_script() { 
	  
	 // include globals for display elements
	 if(isset($_GET['post_type']) && $_GET['post_type'] == THEME_TAXONOMY."_type"){
	 $GLOBALS['wlt_packages'] = get_option("packagefields"); 
	 }
	 
	 ?>  
	<script src="<?php echo FRAMREWORK_URI; ?>admin/js/scripts.js" ></script>    
 	<script src="<?php echo FRAMREWORK_URI; ?>js/core.ajax.js" ></script>
		<script >
		jQuery(document).ready(function() {	
			jQuery('a.wlt_editpop').live('click', function() {
				 tb_show('', this.href+'&amp;TB_iframe=true');
				 return false;		   
			});
			
		});
		function WLTSaveAdminOp(postid,val,act,div){
		 
		CoreDo('<?php echo str_replace("https://","",str_replace("http://","",get_home_url())); ?>/wp-admin/edit.php?core_admin_aj=1&act='+act+'&pid='+postid+'&value='+val, div);
		}
		</script>
		
		<?php
	} 
 
	
} // END CORE ADMIN CLASS

?>