<?php



class framework extends framework_mobile {


function funs(){

	$config = array(
	
		"orders" => true,
	);	
	
	return hook_v9_corefuns($config); 

}


function _e($a){

print_r($a); 
 
}
 
	
	// START REMOVING WIDGETS FROM WP
	function unregister_widgets() {	 global $wpdb; 				 
		  
			register_widget( 'core_widgets_blank' );
			
			register_widget( 'core_widget_search' );
			register_widget( 'core_widget_blog_categories' );
			register_widget( 'core_widget_blog_recent' );
			register_widget( 'core_widget_single_contactform' );
			register_widget( 'core_widget_single_nearby' );
			
			
			
			// NEW SINGLE LISTING WIDGETS
			register_widget( 'core_widget_single_title' );
			register_widget( 'core_widget_single_images' );
			register_widget( 'core_widget_single_content' );
			register_widget( 'core_widget_single_likes' );
			
			if(defined('THEME_KEY') && THEME_KEY == "vt"){
			register_widget( 'core_widget_single_video' );
			}
			
			register_widget( 'core_widget_elementor' );
		   	register_widget( 'core_widget_social' );
		   	register_widget( 'core_widget_newsletter' );
			register_widget( 'core_widget_recent' );
			register_widget( 'core_widget_featured' );
			register_widget( 'core_widget_categories' );
			register_widget( 'core_widget_categorylist' );
			register_widget( 'core_widget_button' );
			
			// REMOVE
			unregister_widget('WP_Widget_Pages');
			unregister_widget('WP_Widget_Calendar');
			unregister_widget('WP_Widget_Archives');
			//unregister_widget('WP_Widget_Links');
			unregister_widget('WP_Widget_Meta');
			unregister_widget('WP_Widget_Search');
			unregister_widget('WP_Widget_Categories');
			unregister_widget('WP_Widget_Recent_Posts');
			unregister_widget('WP_Widget_Recent_Comments');
			unregister_widget('WP_Widget_Tag_Cloud');
			unregister_widget('WP_Widget_RSS');
			unregister_widget('WP_Widget_Akismet');
			unregister_widget('WP_Nav_Menu_Widget'); 
		 
	}	
	 
	// START TAXONOMIES
	function taxonomies(){
	   
			// CUSTOM SLUG
			if(strlen(get_option('premiumpress_custompermalink')) > 1){ $listing_slug_name = get_option('premiumpress_custompermalink'); }else{ $listing_slug_name = THEME_TAXONOMY; }	
		 
	 		if(strlen(get_option('premiumpress_customcategorypermalink')) > 1){ $cat_slug_name = get_option('premiumpress_customcategorypermalink'); }else{ $cat_slug_name = $listing_slug_name."-category"; }	
			
			// REGISTER MAIN LISTING TAXONOMY			
			$listing_title = $this->listingTitle();			
			
			// SHOW UI OPTIONS
			$showUI = true;
			if(get_option('wlt_license_key') == ""){ $showUI = false; }			
			
			// WP CODE TO REGISTER 			 
			register_taxonomy( THEME_TAXONOMY, THEME_TAXONOMY.'_type', array( 	
			 
			'labels' => array(
				'name' => 'Categories' ,
				'singular_name' =>  $listing_title.' Category',
				'search_listings' =>   'Search '.$listing_title.' Categorys' ,
				'popular_listings' =>  'Popular '.$listing_title.' Categorys' ,
				'all_listings' => 'All '.$listing_title.' Categorys' ,
				'parent_listing' => null,
				'parent_listing_colon' => null,
				'edit_listing' =>'Edit '.$listing_title.' Category' , 
				'update_listing' =>  'Update '.$listing_title.' Category' ,
				'add_new_listing' =>  'Add '.$listing_title.' Category' ,
				'new_listing_name' => 'New '.$listing_title.' Category Name' ,
				'separate_listings_with_commas' => 'Separate '.$listing_title.' Categorys with commas' ,
				'add_or_remove_listings' =>  'Add or remove '.$listing_title.' Categorys',
				'choose_from_most_used' =>  'Choose from the most used '.$listing_title.' Categorys' 
				) , 
					'hierarchical' => true,	
					'query_var' => true,
					'show_ui' => $showUI,
					'has_archive' => true, 
					'rewrite' => array('slug' => $cat_slug_name) ) ); 
	 
			// CORE LISTING POST TYPE			
			register_post_type( THEME_TAXONOMY.'_type',
				array(
				  'labels' 				=> array('name' => $listing_title, 'singular_name' => 'listings' ), 
				  'rewrite'				=>  array('slug' => $listing_slug_name ),
				  'public' 				=> true,
				  'publicly_queryable'  => true,
				  'supports' 			=> array ( 'title', 'editor','author', 'post-formats', 'comments','excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' ),
				  'taxonomies' => array('category', 'post_tag'),
				  'menu_icon' 			=> "dashicons-schedule", 
				  'show_ui'             => $showUI,
				  'menu_position'		=> 4,
				  'show_in_menu'        => true,
        		  'show_in_nav_menus'   => true,
				 				  
				)
			  );
			 
			// MESSAGES POST TYPE
			register_post_type( 'wlt_message', 
			array(
			'hierarchical' => true,	
			  'labels' => array('name' => 'Messages'),
			  'public' => false,
			  'query_var' => true,
			  'show_ui' => false,
			  'exclude_from_search' => true,
			  'menu_icon' 	=> "dashicons-format-chat",
			  'rewrite' => array('slug' => 'message'),
			  'supports' => array (  'custom-fields' ),	    
	 
			) );
			 
			 // MESSAGES POST TYPE
			register_post_type( 'wlt_payments', 
			array(
			'hierarchical' => true,	
			  'labels' => array('name' => 'Payments'),
			  'public' => false,
			  'query_var' => true,
			  'show_ui' => false,
			  'exclude_from_search' => true,
			  'menu_icon' 	=> "dashicons-money",
			  'rewrite' => array('slug' => 'payment'),
			  'supports' => array (  'title', 'editor', 'custom-fields' ),	    
	 
			) );
			
			// INVOICES
			register_post_type( 'wlt_invoices', 
			array(
			'hierarchical' => true,	
			  'labels' => array('name' => 'Invoices'),
			  'public' => false,
			  'query_var' => true,
			  'show_ui' => true,
			  'exclude_from_search' => true,
			  'menu_icon' 	=> "dashicons-money",
			  'rewrite' => array('slug' => 'invoice'),
			  'supports' => array (  'title', 'editor' ), //, 'custom-fields'	    
	 
			) );
			
		 
			if(_ppt('sellspace_enable') == 1){ $canShowAds = true; }else{  $canShowAds = false; }
			// MESSAGES POST TYPE
			register_post_type( 'wlt_banner', 
			array(
			'hierarchical' => true,	
			  'labels' => array('name' => 'Banners'),
			  'public' => false,
			  'query_var' => false,
			  'show_ui' => true,
			  'exclude_from_search' => true,
			  'menu_icon' 	=> "dashicons-groups",
			  'rewrite' => array('slug' => 'banner'),
			  'supports' => array (  'custom-fields','author' ),	    
	 
			) ); 
			
			
			register_post_type( 'wlt_campaign', 
			array(
			'hierarchical' => true,	
			  'labels' => array('name' => 'Campaigns'),
			  'public' => false,
			  'query_var' => false,
			  'show_ui' => true,
			  'menu_icon' 	=> "dashicons-megaphone",
			  'exclude_from_search' => true,
			  'rewrite' => array('slug' => 'campaign'),
			  'supports' => array (  'custom-fields','author'  ),	    
	 
			) );
		 
			
			// FEEDBACK POST TYPE
			 
			if(defined('THEME_KEY') && in_array(THEME_KEY,array('at','ct','mj'))){ $canShowAds = true; }else{  $canShowAds = false; }
			
			register_post_type( 'wlt_feedback', 
			array(
			'hierarchical' => true,	
			  'labels' => array('name' => 'User Feedback'),
			  'public' => false,
			  'query_var' => true,
			  'show_ui' => $canShowAds,
			  'menu_icon' 	=> "dashicons-heart",
			  'exclude_from_search' => true,
			  'rewrite' => array('slug' => 'feedback'),
			  'supports' => array (  'title', 'editor', 'author', 'custom-fields', 'comments' ),	    
	 
			) );
			
			/*			
			
			// EVENTS HERE
			register_post_type( 'event', 
			array(
			'taxonomies' => array('category', 'post_tag'),  
			'hierarchical' => true,	
			  'labels' => array('name' => 'Events'),
			  'public' 				=> true,
		'publicly_queryable'  => true,
			  'query_var' => true,
			  'show_ui' => true,
			  'exclude_from_search' => true,
			 'menu_icon' 	=> "dashicons-calendar-alt",
			  'rewrite' => array('slug' => 'event'),
			  'supports' 			=> array ( 'title', 'editor','author', 'post-formats', 'comments','excerpt', 'thumbnail', 'custom-fields', 'publicize', 'wpcom-markdown' ),
			
			'taxonomies' => array('category', 'post_tag'),  
	 
			) );
			
			register_taxonomy('events', 'event', array('hierarchical' => false,'show_ui' => true,'label' => 'Categories'));
		 */
 
	
	}
	 
	function custom_taxonomies(){
	
	
		global $wpdb;
		// GET SAVED DAT
		$tax = get_option('custom_taxonomy'); 
		 
		if(is_array($tax)){
			foreach($tax as $tt){
		 
			if($tt != "" && strlen($tt) > 2){
				
				$NewTax = strtolower(htmlspecialchars(str_replace(" ","-",str_replace("&","",str_replace("'","",str_replace('"',"",str_replace('/',"",str_replace('\\',"",strip_tags($tt)))))))));
				
				$labels = array(
				'name' =>  $tt ,
				'singular_name' =>  $tt ,
				'search_items' =>  __( 'Search '.$tt ),
				'all_items' => __( 'All '.$tt ),
				'parent_item' => __( 'Parent '.$tt ),
				'parent_item_colon' => __( 'Parent '.$tt.':' ),
				'edit_item' => __( 'Edit '.$tt ), 
				'update_item' => __( 'Update '.$tt ),
				'add_new_item' => __( 'Add New '.$tt ),
				'new_item_name' => __( 'New '.$tt ),
				'menu_name' => __( $tt ),	  ); 
				
				 register_taxonomy( $NewTax, THEME_TAXONOMY.'_type', array( 'hierarchical' => true, 'labels' => $labels, 'query_var' => true, 'rewrite' => true ) );  
			
				}
			
			}
		}
	}

	 
	 
	// REGISTER WIDGETS
	function register_widgets(){ global $pagenow, $page;
	  
 		 
		if ( function_exists('register_sidebar') ){		
		
 			$sidebars = array(
				"search" => array( "name" => "Search Page Sidebar"),
				"blog" => array( "name" => "Blog Sidebar"),
				"page" => array( "name" => "Pages Sidebar"),
				"listing" => array( "name" => "Listing Page"),				
				"category" => array( "name" => "Category Page"),
				"add" => array( "name" => "Add Listing Page"),				 
				
			);
			 
			if(defined('THEME_KEY') && THEME_KEY == "cp"){
			
				$sidebars['listing'] = array("name" => "Listing Page Sidebar");
			}
			
			if(defined('THEME_KEY') && THEME_KEY == "cp"){
			
				$sidebars['store'] = array("name" => "Store Page Sidebar");
			}
			
			foreach($sidebars as $key => $side){			
			
				register_sidebar(array('name'=> $side['name'],
					'before_widget' => '<div class="widget"><div class="widget-wrap"><div class="widget-block">',
					'after_widget' 	=> '<div class="clearfix"></div></div></div></div>',				
					'before_title' 	=> '<div class="widget-title"><div class="widget-content">',
					'after_title' 	=> '</div></div>',					
					'description' => '',
					'id'            => $key,
				));
			
			}
		
		
			// EXRA FOR FOOTER
			$sidebars = array(
			"footer1" => array( "name" => "Footer 1"),
			"footer2" => array( "name" => "Footer 2"),
			"footer3" => array( "name" => "Footer 3"),				
			);
		
			foreach($sidebars as $key => $side){		
				
				register_sidebar(array('name'=> $side['name'],
					'before_widget' => '<div class="footer-widget">',
					'after_widget' 	=> '</div>',				
					'before_title' 	=> '<h6 class="text-uppercase font-weight-bold mb-3">',
					'after_title' 	=> '</h6>',					
					'description' 	=> '',
					'id'            => $key,
					));
			}	  
					 
				
			// SET THE UNREGISTER WIDGET FLAG
			add_action( 'widgets_init', array($this, 'unregister_widgets' ) );	
		
		}	
	}
	
	/*
		this function loads in the header styles
	*/
	function ppt_wp_head(){  global $pagenow;
	
		$save_dir = wp_upload_dir();	
		
		// GET BODY CLASS
		$bb = get_body_class();
		if(!isset($bb[1])){ $bb[1] = ""; }
		if(!isset($bb[2])){ $bb[2] = ""; }
		
			// CORE GOOGLE FONT
			wp_enqueue_style( 'framework-fonts', 'https://fonts.googleapis.com/css?family=Maven+Pro:400,500,700', false ); 
		 
			// LOAD IN FRAMEWORK CSS
			$css 	= 	array();
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.bootstrap.css';
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.plugins.css';
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.styles.css';
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.menu.css';
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.shortcodes.css';
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.widgets.css';
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.search.css';						
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.responsive.css';
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.googlefonts.css'; 
			// ACCOUNT AREA
			if(isset($GLOBALS['flag-account']) || isset($GLOBALS['flag-author']) ){
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.account.css';
			}
			// SHOPPING CART
			if(defined('WLT_CART')){
			$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.cart.css';	
			}
			// LOAD IN CHILD THEME STYLES
			$css[] 	=	get_template_directory_uri()."/".THEME_FOLDER.'/css.global.css';		
		 	// CHILD THEME STYLES
			if(defined('CHILD_THEME_NAME') && !defined('WLT_DEMOMODE')){		
			$css['child'] 	=	get_bloginfo('stylesheet_url');
			}elseif(defined('WLT_DEMOMODE') && isset($GLOBALS['childtemplate'])){			
			$css['child'] 	=  WP_CONTENT_URL.'/themes/'.$GLOBALS['childtemplate'].'/style.css';		  
			}else{			
			$css['coretheme'] 	=  get_template_directory_uri().'/'.THEME_FOLDER.'/template/style.css';		
			}			
			// LISTING PAGE ADD-ON
			if(isset($GLOBALS['flag-single']) && file_exists(THEME_PATH.THEME_FOLDER."/template/style-listing.css")  ){
		 	$css[] 	=  	get_template_directory_uri().'/'.THEME_FOLDER.'/template/style-listing.css';
			}	
			
			   

		$i = 1; 	
		if( _ppt('css_combine') != 1 ) {
				
				foreach($css as $key => $file){						
					wp_register_style( 'framework'.$i, $file, array(), THEME_VERSION, false);	 
					wp_enqueue_style( 'framework'.$i );	
					$i++;
			   }
			   
		}else{
		   	$buffer = ""; $clean_output = "";
			foreach($css as $key => $file){
			  
				//if($this->check_file_exists_here($file)){
				$fp 			= file_get_contents($file,"wb");
				$clean_output 	= preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $fp);				
				$clean_output 	= str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $clean_output);
				$clean_output 	= str_replace("../../img/","../img/", $clean_output);	   
				$buffer .= $clean_output;
				//}
			}		
   
			// LOAD IN ANY EXTRA STYLES FROM THE PAGE ITSELF
			$buffer = hook_v9_extra_css($buffer);				  
			// Remove comments
			$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
			// sort images
			$buffer = str_replace('.../img/', get_template_directory_uri().'/'.THEME_FOLDER.'/template/img/', $buffer);
			$buffer = str_replace('../img/', get_template_directory_uri().'/framework/img/', $buffer);			
			$buffer = str_replace('[frameworkimg]', get_template_directory_uri().'/framework/img/', $buffer);			
			$buffer = str_replace('.../images/', get_template_directory_uri().'/'.THEME_FOLDER.'/template/images/', $buffer);			
			$buffer = str_replace('../images/', get_template_directory_uri().'/framework/images/', $buffer);			
			$buffer = str_replace('demoimages', 'demoxxx', $buffer);
			$buffer = str_replace('images/', get_template_directory_uri().'/'.THEME_FOLDER.'/template/images/', $buffer);			
			$buffer = str_replace('demoxxx', 'demoimages', $buffer);
			// Remove space after colons
			$buffer = str_replace(': ', ':', $buffer);
			// Remove whitespace
			$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);				
			echo "<style>".$buffer."</style>";
			   
			   
	} // end if 1 == 1
	 
		
		// RE-REGISTER JQUERY TO REMOVE JS MIGRATE
		if($pagenow != "wp-login.php"){
		wp_deregister_script( 'jquery' );   		
		}
		wp_enqueue_script('jquery', includes_url( '/js/jquery/jquery.js' ),false); 
 	  
		// LOAD IN FRAMEWORK
		wp_enqueue_script('bootstrap', FRAMREWORK_URI.'js/backup_js/js.bootstrap.js','', THEME_VERSION,true);
 		wp_enqueue_script('framework', FRAMREWORK_URI.'js/backup_js/js.framework.js','', THEME_VERSION ,true);	
		
		//wp_enqueue_script('framework', FRAMREWORK_URI.'js/js.premiumpress.js','', THEME_VERSION ,true);	
		wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/5381299f20.js','', THEME_VERSION ,true);	
		
	 	// REMOVE WP EMBED
		if(isset($GLOBALS['flag-single']) || isset($GLOBALS['flag-page']) ){
		
		}else{
		wp_deregister_script( 'wp-embed' );
		}
		
		 
	 
	 }	 
function check_file_exists_here($url){
   $result=get_headers($url);
   return stripos($result[0],"200 OK")?true:false; //check if $result[0] has 200 OK
}

 
   
 
/* ========================================================================
 PAGE NAVIGATION BUTTONS
========================================================================== */
function PAGENAV($return="", $numposts = "", $max_page = "") { global $wpdb, $wp_query; $return=""; $pages = "";  $backBtn = ""; $forwardBtn = "";

if (!is_single()) {

 	
		$request = $wp_query->request;	 
		$posts_per_page = intval(get_query_var('posts_per_page'));
		 
		$paged = intval(get_query_var('paged'));
	
		$pagenavi_options['pages_text'] = __("Page %CURRENT_PAGE% of %TOTAL_PAGES%","premiumpress");
		$pagenavi_options['current_text'] = "%PAGE_NUMBER%";
		$pagenavi_options['page_text'] = "%PAGE_NUMBER%";
		
		$pagenavi_options['first_text'] = __("<< First","premiumpress");
		$pagenavi_options['last_text'] = __("Last >>","premiumpress");
 
		$pagenavi_options['num_pages'] = "2";
		$backBtn = ""; $forwardBtn = "";
		
		if(!is_numeric($numposts)){
		$numposts = $wp_query->found_posts;
		}
		
		if(!is_numeric($max_page)){
		$max_page = $wp_query->max_num_pages;
		}
		 
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		if(isset($_GET['home_paged']) && is_numeric($_GET['home_paged'])){
		$paged = $_GET['home_paged'];
		}
		 
		// HIDE IF
		//die($numposts." == ".$posts_per_page);
		if($numposts  <= $posts_per_page){ return; }
		
		
		$pages_to_show = intval(5);
		$larger_page_to_show = intval(1);
		$larger_page_multiple = intval(1);
		$pages_to_show_minus_1 = $pages_to_show - 1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		
		
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		$larger_per_page = $larger_page_to_show*$larger_page_multiple;
		$larger_start_page_start = ($this->n_round($start_page, 10) + $larger_page_multiple) - $larger_per_page;
		$larger_start_page_end = $this->n_round($start_page, 10) + $larger_page_multiple;
		$larger_end_page_start = $this->n_round($end_page, 10) + $larger_page_multiple;
		$larger_end_page_end = $this->n_round($end_page, 10) + ($larger_per_page);
		if($larger_start_page_end - $larger_page_multiple == $start_page) {
			$larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
			$larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
		}
		if($larger_start_page_start <= 0) {
			$larger_start_page_start = $larger_page_multiple;
		}
		if($larger_start_page_end > $max_page) {
			$larger_start_page_end = $max_page;
		}
		if($larger_end_page_end > $max_page) {
			$larger_end_page_end = $max_page;
		}
		if($max_page > 1 || intval(1) == 1) {
		
		if($max_page == 0 && $paged > 0){ $max_page=1; }
			$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
			$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);	
  		
					// PAGES COUNT
					if(!empty($pages_text)) {
						$pages .= '<div class="pages"><span class="page-link">'.$pages_text.'</span></div>';
					}
					
					 
					 // PREVIOUS
					if($paged > 1 ){							
							 				
						if(isset($GLOBALS['flag-home'])){
							$link = get_home_url()."/?home_paged=".($paged-1);
						}else{
							$link = esc_url(get_pagenum_link($paged-1));
						}
															
						$backBtn .= '<li class="btn-right"><a href="'.$link.'" class="btn btn-secondary last"><i class="fa fa-angle-left"></i> <span class="hide-mobile">'.__("Previous","premiumpress").'</span></a></li>';
													
					}else{
					
						$backBtn .= '<li class="btn-right"><a href="javascript:void(0);" class="btn btn-secondary last disabled"><i class="fa fa-angle-left"></i>  <span class="hide-mobile">'.__("Previous","premiumpress").'</span></a></li>';	
					
					}
					
					
				  	//  NUMBERS
					for($i = $start_page; $i  <= $end_page; $i++) {	
						/*** get link for formatting ***/						
						if(isset($GLOBALS['flag-home'])){
						$link = get_home_url()."/?home_paged=".$i;
						}else{
						$link = esc_url(get_pagenum_link($i));
						}

						/*** build string ***/
						if($i == $paged) {
							$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
							$return .= '<li class="page-item"><a href="'.$link.'" class="btn btn-secondary num active" rel="nofollow">'.$current_page_text.'</a></li>';
						} else {
							$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
							$return .= '<li class="page-item"><a href="'.$link.'" class="btn btn-secondary num" rel="nofollow">'.$page_text.'</a></li>';
						}
					}
					 
			 		// FIRST BUTTON
					if($paged > 0 && $paged < $max_page){	
						/*** get link for formatting ***/						
						if(isset($GLOBALS['flag-home'])){
						$link = get_home_url()."/?home_paged=".($paged+1);
						}else{
						$link = esc_url(get_pagenum_link($paged+1));
						}
						 
						$forwardBtn = '<li class="float-sm-right"><a href="'.$link.'" class="btn btn-secondary next"><span class="hide-mobile">'.__("Next","premiumpress").' &nbsp;&nbsp;</span> <i class="fa fa-angle-right nomargin" aria-hidden="true"></i> </a></li>';	
										
					}else{
					
						$forwardBtn = '<li class="float-sm-right"><a href="javascript:void(0);" class="btn btn-secondary next disabled"> <span class="hide-mobile">'.__("Next","premiumpress").'  &nbsp;&nbsp;</span> <i class="fa fa-angle-right nomargin" aria-hidden="true"></i></a></li>';				
					
					}
		}
	}
	
	// ADD ON STYLE WRAPPER <div class="pager pull-right">'.$pages.'</div>
	$return = '
	<nav class="ppt-pnav clearfix my-4">
	<ul class="pagination justify-content-center">'.$backBtn.''.$return.''.$forwardBtn.'</ul>  </nav>';
	 
	// RETURN VALUE
	if($return){	return $return;	}else{	echo $return;	}
}
function n_round($num, $tonearest) {  return floor($num/$tonearest)*$tonearest;}









 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 
 
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 

 
 
 
 
 
 
 	 

}

?>