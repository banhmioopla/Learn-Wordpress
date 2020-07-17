<?php
 

/*
	this function performs the installation
*/
function premiumpress_install_and_reset(){ global $CORE, $userdata, $wpdb;

	// FIRST TIME INSTALLATION
	if(get_option("core_theme_defaults_loaded") == "" && isset($_POST['adminArray']['wlt_license_key']) ){			  
			
		// SAVE THE THEME NAME FOR LATER USE
		update_option('wlt_theme', $_POST['admin_values']['template']);
		
		// INSTALL THEME TABLES
		core_admin_2_themeinstall();	
					
		// SET LICENSE KEY
		update_option('wlt_license_key', $_POST['adminArray']['wlt_license_key'], true);
		
		// MAKE CHECKES
		if($CORE->UPDATE_CHECK() == "0.0.0"){
				header("location: ".get_home_url().'/wp-admin/admin.php?page=premiumpress');
				exit();
		}else{
				header("location: ".get_home_url().'/wp-admin/admin.php?page=2&firstinstall=1');
				exit();
		}// END IF
	
	}// END FIRST INSTALLATION
	
	// SYSTEM RESET
	if(isset($_POST['core_system_reset']) && $_POST['core_system_reset'] == "new"){		 	
			
			if(current_user_can( 'edit_user', $userdata->ID ) ){
			
			
				// [MYSQL] DROP ALL OF THE TABLES LINKED TO OUR THEMES
				$wpdb->query("delete a,b,c,d
							FROM ".$wpdb->prefix."posts a
							LEFT JOIN ".$wpdb->prefix."term_relationships b ON ( a.ID = b.object_id )
							LEFT JOIN ".$wpdb->prefix."postmeta c ON ( a.ID = c.post_id )
							LEFT JOIN ".$wpdb->prefix."term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
							LEFT JOIN ".$wpdb->prefix."terms e ON ( e.term_id = d.term_id )
							WHERE a.post_type ='".THEME_TAXONOMY."_type'");
				
				// 2. DELETE ALL CATEGORIES
				$terms = get_terms(THEME_TAXONOMY, 'orderby=count&hide_empty=0');	 
				$count = count($terms);
				if ( $count > 0 ){				
						foreach ( $terms as $term ) {
							wp_delete_term( $term->term_id, THEME_TAXONOMY );
						}
				}
			
				// RESET ALL CORE VALUES
				update_option('wlt_installed_theme','');
				update_option('wlt_license_key','');
				update_option('wlt_license_upgrade', '');
				update_option("core_theme_defaults_loaded","");
				update_option("core_admin_values","");
				// REDIRECT TO DASHBOARD
				header("location: ".get_home_url().'/wp-admin/index.php');
				exit();			
			}
			
	} // END SYSTEM RESET	

}

/*
FUNCTION USED WHEN OUR THEME IS DEACTIVATED
*/
function core_admin_01_theme_deactivated(){ }
   
  
function ppt_install_db_tables($droptable = true){ global $wpdb;

// [MYSQL] INSTALL MAILING LIST TABLE

 
if($droptable){
$wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."core_log`");
}
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_log` (
	`autoid` INT( 10 ) NOT NULL AUTO_INCREMENT ,
	`datetime` DATETIME NOT NULL ,
	`userid` INT( 10 ) NOT NULL ,
	`postid` INT( 10 ) NOT NULL ,
	`link` VARCHAR( 255 ) NOT NULL ,
	`message` VARCHAR( 255 ) NOT NULL ,
`type` varchar(10) NOT NULL,
`data` blob NOT NULL, PRIMARY KEY (  `autoid` ))");
if($droptable){
$wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."core_mailinglist`");
}
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
if($droptable){
$wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."core_orders`");
}
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
  
  
$wpdb->query("ALTER TABLE ".$wpdb->prefix."core_orders ADD order_description LONGTEXT NOT NULL AFTER payment_data");
$wpdb->query("ALTER TABLE ".$wpdb->prefix."core_orders ADD order_gatewayname LONGTEXT NOT NULL AFTER order_description"); 

  
$wpdb->query("ALTER TABLE ".$wpdb->prefix."core_orders CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

  // [MYSQL] INSTALL WITHDRAWAL TABLE
if($droptable){
$wpdb->query("DROP TABLE IF EXISTS `".$wpdb->prefix."core_withdrawal`");
}
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
if($droptable){
$wpdb->query("DROP TABLE IF EXISTS ".$wpdb->prefix."core_search");
}

$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_search` (`id` int(11) NOT NULL AUTO_INCREMENT,`label` text NULL,`description` varchar(100) NULL,`type` varchar(10) NULL,`operator` varchar(10) NULL,`compare` varchar(10) NULL,`values` text NULL,`key` varchar(20) NULL,`alias` varchar(20) NULL,`field_type` varchar(15) NULL,`order` smallint(2) NULL,`link` varchar(100),PRIMARY KEY (`id`));");

$wpdb->query("ALTER TABLE ".$wpdb->prefix."core_search CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"); 

// [MYSQL] INSTALL SESSION TABLE FOR CART
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_sessions` (
  `session_key` varchar(100) NOT NULL,
  `session_date` datetime NOT NULL,
  `session_userid` int(10) NOT NULL,
  `session_data` text NOT NULL,
  PRIMARY KEY (`session_key`));");

$wpdb->query("ALTER TABLE ".$wpdb->prefix."core_sessions CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
 
// [MYSQL] INSTALL SESSION TABLE FOR CART
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_app` (
`autoid` mediumint(10) NOT NULL AUTO_INCREMENT,
  `device_id` text NOT NULL,
  `userid` int(10) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`autoid`));");
  
if($droptable){  
$wpdb->query("DROP TABLE ".$wpdb->prefix."core_useronline");  
}
 
$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_useronline` (	 
			  `id` int(10) NOT NULL auto_increment, 
			  `user_id` int(10) NOT NULL, 
			  `session` char(100) NOT NULL default '',
			  `ip` varchar(15) NOT NULL default '', 
			  `timestamp` varchar(15) NOT NULL default '', 
			  PRIMARY KEY (`id`), 
			  UNIQUE KEY `id`(`id`) );");

}

 
function core_admin_2_themeinstall($test=false){ global $wpdb, $CORE; $CORE->taxonomies(); $GLOBALS['theme_defaults'] = array();

	// INSTALL DATABASE TABLES
	ppt_install_db_tables();
	
	// [WORDPRESS] DEFAULT MEDIA OPTIONS
	update_option('thumbnail_size_w', 300);
	update_option('thumbnail_size_h', 350);
	update_option('thumbnail_crop', 0);	 
	update_option('core_post_types', ''); 
	update_option('posts_per_page', '12');
	update_option('recent_searches','');
	
	// ADD IN NEW TAX ORDERING CHANGES
	wlt_orderby_activated(false);	
	
	// [PAGES] CREATE DEFAULT THEME PAGES
	$page_links = array();
	
	$theme_pages = array( 
	
	"My Account"	=> "templates/tpl-page-account.php", 
	"Blog" 			=> "templates/tpl-page-blog.php", 
	"Callback" 		=> "templates/tpl-callback.php", 
	"Contact" 		=> "templates/tpl-page-contact.php", 
	"About Us" 		=> "templates/tpl-page-aboutus.php", 
	"FAQ" 			=> "templates/tpl-page-faq.php", 
	"Advertising" 	=> "templates/tpl-page-sellspace.php", 
	
	"Terms &amp; Conditions" => "templates/tpl-page-terms.php", 
	"Privacy" 		=> "templates/tpl-page-privacy.php",  
 	"Add Listing" 	=> "templates/tpl-add.php",
	"Testimonials" 	=> "templates/tpl-page-testimonials.php", 
	"Memberships" 	=> "templates/tpl-page-memberships.php", 
 	
	"How it works" 	=> "templates/tpl-page-how.php", 
	"Top Listings" 	=> "templates/tpl-page-top.php", 
	
	 );
	 
	if(isset($_POST['admin_values']['template'])){
		switch($_POST['admin_values']['template']){
	
			case "micro": {
			$theme_pages = array_merge($theme_pages, array( "Work Desk" => "templates-microjobs/tpl-microjobs-workdesk.php"));
			} break;
			
			case "dating": {
			$theme_pages = array_merge($theme_pages, array( "Chatroom" => "templates-dating/tpl-chatroom.php"));
			} break;
			
			case "classifieds": {
			$theme_pages = array_merge($theme_pages, array( "Make Offer" => "templates-classifieds/tpl-offerspage.php"));
			} break;
			
			case "coupon": {
			$theme_pages = array_merge($theme_pages, array( "Deals" => "templates-coupon/tpl-page-coupon-deals.php", "Stores" => "templates-coupon/tpl-page-coupon-stores.php", "Cash Back" => "templates-coupon/tpl-page-coupon-cashback.php" ));
			} break; 
			
			case "jobs": {			
			$theme_pages = array_merge($theme_pages, array( "Apply" => "templates-jobs/tpl-apply.php", "Resume" => "templates-jobs/tpl-resume.php", "Register" => "templates/tpl-register.php" ) );	
			} break;
			
			case "photography": {
			
			$theme_pages = array_merge($theme_pages, array( "Checkout" => "templates-photography/tpl-shop-checkout.php", "Cart" => "templates-photography/tpl-shop-cart.php" ));
			
			} break;
			case "shop": {
			$theme_pages = array_merge($theme_pages, array( "Checkout" => "templates-shop/tpl-shop-checkout.php", "Cart" => "templates-shop/tpl-shop-cart.php" ));
			
			
			unset($theme_pages['Memberships']);
			unset($theme_pages['Add Listing']);
			
			
			} break;
			
			case "software": {
			$theme_pages = array_merge($theme_pages, array( "Checkout" => "templates-software/tpl-shop-checkout.php", "Cart" => "templates-software/tpl-shop-cart.php" ));
			} break;
			
			case "auction": {
			$theme_pages = array_merge($theme_pages, array( "Bids" => "templates-auction/tpl-bids.php" ));
			} break;
			
		}
	}
	 
 
	foreach($theme_pages as $ntitle => $nkey){
		
		if ( get_page_by_title( $ntitle ) == NULL ) {
		
		$page = array();
		$page['post_title'] 	= $ntitle;
		$page['post_content'] 	= '';
		$page['post_status'] 	= 'publish';
		$page['post_type'] 		= 'page';
		$page['post_author'] 	= 1;
		$page_id = wp_insert_post( $page );
		update_post_meta($page_id , 'pagecolumns', 3);
		update_post_meta($page_id , '_wp_page_template', $nkey);
		$page_links[$nkey] = get_permalink($page_id);
		
		update_post_meta($page_id,'sub-description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.');
 		
		
		}else{
			$pagep = get_page_by_title( $ntitle );
			$page_links[$nkey] = get_permalink($pagep->ID);
		}
	
	}
	
	// NOW ASSIGN PAGES
	
	if(is_array($page_links) && !empty($page_links)){
	$GLOBALS['theme_defaults']['links'] = array();
	$GLOBALS['theme_defaults']['links']['blog'] 		= $page_links['templates/tpl-page-blog.php'];
	//$GLOBALS['theme_defaults']['links']['events'] 		= $page_links['tpl-page-events.php'];
	$GLOBALS['theme_defaults']['links']['myaccount'] 	= $page_links['templates/tpl-page-account.php'];
	
	$GLOBALS['theme_defaults']['links']['callback'] 	= $page_links['templates/tpl-callback.php'];
	//$GLOBALS['theme_defaults']['links']['members'] 		= $page_links['tpl-page-members.php'];
	$GLOBALS['theme_defaults']['links']['contact'] 		= $page_links['templates/tpl-page-contact.php'];
	$GLOBALS['theme_defaults']['links']['sellspace'] 	= $page_links['templates/tpl-page-sellspace.php'];
	$GLOBALS['theme_defaults']['links']['aboutus'] 		= $page_links['templates/tpl-page-aboutus.php'];
	$GLOBALS['theme_defaults']['links']['terms'] 		= $page_links['templates/tpl-page-terms.php'];
	$GLOBALS['theme_defaults']['links']['privacy'] 		= $page_links['templates/tpl-page-privacy.php'];
	$GLOBALS['theme_defaults']['links']['faq'] 			= $page_links['templates/tpl-page-faq.php'];
 	$GLOBALS['theme_defaults']['links']['testimonials'] = $page_links['templates/tpl-page-testimonials.php'];
 	
	if($_POST['admin_values']['template'] != "shop"){
	$GLOBALS['theme_defaults']['links']['add'] 			= $page_links['templates/tpl-add.php'];
	$GLOBALS['theme_defaults']['links']['memberships'] 	= $page_links['templates/tpl-page-memberships.php'];
 	}
	
	$GLOBALS['theme_defaults']['links']['how'] = $page_links['templates/tpl-page-how.php'];
 	$GLOBALS['theme_defaults']['links']['top'] = $page_links['templates/tpl-page-top.php'];
 	
		
		// EXTRA FOR TEMPLATES
		if(isset($_POST['admin_values']['template'])){
			switch($_POST['admin_values']['template']){
			
			case "micro": {
				$GLOBALS['theme_defaults']['links']['workdesk'] 	= $page_links['templates-microjobs/tpl-microjobs-workdesk.php'];		
			} break;
			case "classifieds": {
				$GLOBALS['theme_defaults']['links']['offerpage'] 	= $page_links['templates-classifieds/tpl-offerspage.php'];		
			} break;			
			case "dating": {
				$GLOBALS['theme_defaults']['links']['chatroom'] 	= $page_links['templates-dating/tpl-chatroom.php'];		
			} break;
			case "jobs": {
				$GLOBALS['theme_defaults']['links']['apply'] 		= $page_links['templates-jobs/tpl-apply.php'];	
				$GLOBALS['theme_defaults']['links']['resume'] 		= $page_links['templates-jobs/tpl-resume.php'];	
				$GLOBALS['theme_defaults']['links']['register'] 	= $page_links['templates/tpl-register.php'];		
			} break;			
			case "coupon": {
				$GLOBALS['theme_defaults']['links']['deals'] 		= $page_links['templates-coupon/tpl-page-coupon-deals.php'];
				$GLOBALS['theme_defaults']['links']['stores'] 		= $page_links['templates-coupon/tpl-page-coupon-stores.php'];	
				$GLOBALS['theme_defaults']['links']['cashback'] 	= $page_links['templates-coupon/tpl-page-coupon-cashback.php'];	
			} break;
			case "photography": {
				$GLOBALS['theme_defaults']['links']['cart'] 		= $page_links['templates-photography/tpl-shop-cart.php'];
				$GLOBALS['theme_defaults']['links']['checkout'] 	= $page_links['templates-photography/tpl-shop-checkout.php'];
			} break;
			case "software":{
				$GLOBALS['theme_defaults']['links']['cart'] 		= $page_links['templates-software/tpl-shop-cart.php'];
				$GLOBALS['theme_defaults']['links']['checkout'] 	= $page_links['templates-software/tpl-shop-checkout.php'];				
			} break;
			case "shop": {				 
				$GLOBALS['theme_defaults']['links']['cart'] 		= $page_links['templates-shop/tpl-shop-cart.php'];
				$GLOBALS['theme_defaults']['links']['checkout'] 	= $page_links['templates-shop/tpl-shop-checkout.php'];						
			} break;
			case "auction": {				 
				$GLOBALS['theme_defaults']['links']['bids'] 		= $page_links['templates-auction/tpl-bids.php']; 					
			} break;
			}
		}// END SWITCH		 
	
	}

// SOCIAL
$GLOBALS['theme_defaults']['social'] = array("twitter" => "#", "facebook" => "#", "linkedin" => "#", "youtube" => "#", "skype" => "#", "dribbble" => "#");
 
// PAGE LAYOUT
$GLOBALS['theme_defaults']['pageassign'] = array("homepage" => "", "header" => "", "footer" => "");
$GLOBALS['theme_defaults']['header_style'] = "0"; 
$GLOBALS['theme_defaults']['footer_style'] = "0"; 
$GLOBALS['theme_defaults']['footer_blockstyle'] = "0";


if(isset($_POST['admin_values']['template']) && $_POST['admin_values']['template'] == "coupon"){
$GLOBALS['theme_defaults']['page_columns'] = "3";
}else{
$GLOBALS['theme_defaults']['page_columns'] = "2";
}

$GLOBALS['theme_defaults']['enable_memberships'] = "1";

$GLOBALS['theme_defaults']['comments'] = "1";

$GLOBALS['theme_defaults']['display_mapcolor_search'] = "grey";


update_option('show_on_front','page');
update_option('page_on_front', 0);
 
// DEFAULT MEMBERSHIP PACKAGES	
	
$cmems = array(

 
    "name" => array(
            "0" => "Free Membership",
            "1" => "Bronze Membership",
            "2" => "Silver Membership",
            "3" => "",
            "4" => "",			
	),

    "subtitle" => array("0" => "", "1" => "", "2" => "", "3" => "", "4" => ""),

    "desc" => array( 
	"0" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.", 
	"1" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.", 
	"2" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.", 
	"3" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue."
	),

    "price" => array("0" => "0", "1" => "20","2" => "40", "3" => "60","4" => "100"),

    "days" => array(
            "0" => "1",
            "1" => "7",
            "2" => "14",
            "3" => "30",
            "4" => "365",
        ),

    "recurring" => array(
            "0" => "0",
            "1" => "0",
            "2" => "0",
            "3" => "1",
            "4" => "0",
        ), 

    "key" => array(
            "0" => "mem1",
            "1" => "mem2",
            "2" => "mem3",
            "3" => "mem4",
            "4" => "mem5",
        ),
 

);

update_option('csubscriptions', $cmems);	
	
// SAMPLE PAYPAL GATEWAY
update_option('gateway_paypal', 'yes');
update_option('paypal_email', 'sample@paypal.com');	
update_option('paypal_currency', 'USD');	
 
	 
// WEBSITE FAQ
$cfaq = array(

"name" => array(

0 => "This is a sample FAQ for your website.",
1 => "This is a sample FAQ for your website.",
2 => "This is a sample FAQ for your website.",
3 => "This is a sample FAQ for your website.",
4 => "This is a sample FAQ for your website.",

),

"desc" => array(

0 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",

1 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",


2 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",


3 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",


4 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",

),

);

update_option('cfaq', $cfaq);	
	
	
 // WEBSITE TESTIMONIALS
$cfaq = array(

"name" => array(

0 => "John Doe",
1 => "Jane Doe",
2 => "Mark Brown", 
),

"name_title" => array(

0 => "CEO/ Manager",
1 => "General Manager",
3 => "Manager", 

),

"logo_url" => array(

0 => get_template_directory_uri()."/framework/img/user.png",
1 => get_template_directory_uri()."/framework/img/user.png",
2 => get_template_directory_uri()."/framework/img/user.png",
 
),

"date" => array(

0 => " " . date('Y-m-d H'),
1 => " " . date('Y-m-d H'),
2 => " " . date('Y-m-d H'),
 
),

"rating" => array(

0 => 5,
1 => 5,
 
),

"desc" => array(

0 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",

1 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",
 
2 => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget. \n\n\n Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.",

),

);

update_option('ctestimonial', $cfaq);  
	
	
	
// INSTALL 5 SAMPLE BLOG POSTS
$i=1;
while($i < 9){
 
	$my_post = array();
	$my_post['post_title'] 		= "Example Blog Post";
	$my_post['post_content'] 	= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p><small>Someone famous <cite title='Source Title'>Source Title</cite></small>
</blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><dl class='dl-horizontal'>
				<dt>Description lists</dt>
				<dd>A description list is perfect for defining terms.</dd>
				<dt>Euismod</dt>
				<dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
				<dd>Donec id elit non mi porta gravida at eget metus.</dd>
				<dt>Malesuada porta</dt>
				<dd>Etiam porta sem malesuada magna mollis euismod.</dd>
				<dt>Felis euismod semper eget lacinia</dt>
				<dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd>
			  </dl> https://www.youtube.com/watch?v=woYSTMgpHJ4";
	$my_post['post_type'] 		= "post";
	$my_post['post_status'] 	= "publish";
	$my_post['post_category'] 	= "";
	$my_post['tags_input'] 		= "";
	$POSTID 					= wp_insert_post( $my_post );
 
 	add_post_meta($POSTID, "image", "https://www.premiumpress.com/_demoimages/blog/blog".$i.".jpg");
 
	
	$i++;	
} 	
	
	
 

$GLOBALS['theme_defaults']['websitepackages'] = 1;
$GLOBALS['theme_defaults']['pak0_price'] = "0";
$GLOBALS['theme_defaults']['pak1_price'] = "10";
$GLOBALS['theme_defaults']['pak2_price'] = "50";

$GLOBALS['theme_defaults']['pak0_desc'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";
$GLOBALS['theme_defaults']['pak1_desc'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";
$GLOBALS['theme_defaults']['pak2_desc'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";
 

// CURRENY PARTS
$GLOBALS['theme_defaults']['currency']['symbol'] 	= "$";
$GLOBALS['theme_defaults']['currency']['code'] 		= "USD";
$GLOBALS['theme_defaults']['currency_menu'] 		= 1;

$GLOBALS['theme_defaults']['account_messages'] 		= 1;


$GLOBALS['theme_defaults']['headerstyle']['top'] 		= "0";
$GLOBALS['theme_defaults']['headerstyle']['main'] 		= "0";
$GLOBALS['theme_defaults']['headerstyle']['menu'] 		= "0";


$GLOBALS['theme_defaults']['account_userverify'] = 1;
 
 
$GLOBALS['theme_defaults']['social_twitter'] = 1;
$GLOBALS['theme_defaults']['social_twitter_key1'] = "SjkwUwMI8erqMwFkCtdxpkPMS";
$GLOBALS['theme_defaults']['social_twitter_key2'] = "BN3Fj1N17jMSHRs8YeIzBD5exwrsEcfqPkl2VMfA8Q5fDCP3dK";

$GLOBALS['theme_defaults']['social_facebook'] = 1;
$GLOBALS['theme_defaults']['social_facebook_key1'] = "410342113153865";
$GLOBALS['theme_defaults']['social_facebook_key2'] = "56e6b68ac9903504eaa72017d4d3ea21"; 

$GLOBALS['theme_defaults']['googlemap_apikey'] = "AIzaSyDFYUcblAUnKjKcEYz87zIFjCLQIdAi8Y0";

$GLOBALS['theme_defaults']['google_recap_sitekey'] = "6Lcsg6UUAAAAABlylD6vPkfL5prgySbkSEnn9jZS";
$GLOBALS['theme_defaults']['google_recap_secretkey'] = "6Lcsg6UUAAAAADQzhig-gSY9zC7e77ivivUDylVi";

$GLOBALS['theme_defaults']['google_trackingcode'] = "UA-140808886-1";



// MAILING LIST
$GLOBALS['theme_defaults']['mailinglist']		= array("confirmation_title" => "Mailing List Confirmation", 
		"confirmation_message" => "Thank you for joining our mailing list.<br><br>Please click the link below to confirm your email address is valid:<br><br>(link)<br><br>Kind Regards<br><br>Management");
	
 	
	// GET THEME NAME
	$theme_name = get_option('wlt_theme');
	// LOAD IN CORE RESET OPTIONS 
	if($_POST['admin_values']['template'] != "" && file_exists(THEME_PATH."/_".$theme_name."/template/_reset.php") ){	
 
		// INCLUDE CUSTOM DATA FROM RESET FILE
		include(THEME_PATH."/_".$theme_name."/template/_reset.php");
		
		// LETS THE RESET FUNCTION HAPPEN
		do_action('hook_new_install'); 
 		
		// UPDATE BASE THEME
		//update_option('wlt_base_theme',$GLOBALS['theme_defaults']['template']);
 		
	}// END IF	
	
	// FINALLY, SAVE IT ALL AND UPDATE DATABASE 		
	update_option( "core_admin_values",  array_merge((array)get_option("core_admin_values"), $GLOBALS['theme_defaults'])); 	
	
	// FINISH
	$GLOBALS['error_message'] = "Example Information Installed";
 		
	 
}// END FUNCTION
   
   
   
   
   
   
   
 



	function IsNumericOnly($input)
	{
		/*  NOTE: The PHP function "is_numeric()" evaluates "1e4" to true
		 *        and "is_int()" only evaluates actual integers, not 
		 *        numeric strings. */

		return preg_match("/^[0-9]*$/", $input);
	}

	function GetAsRed($string, $inBold=false)
	{
		return GetAsColor($string, 'FF0000', $inBold);
	}

	function GetAsGreen($string, $inBold=false)
	{
		return GetAsColor($string, '279B00', $inBold);
	} 
	function GetAsColor($string, $colorHex, $inBold)
	{
		$string = ($string === false || $string === 0) ? '0' : $string;
		if($inBold) $string = '<b>'.$string.'</b>';
		return '<span style="color:#'.$colorHex.'">'.$string.'</span>';
	}
	function IsExtensionInstalled($moduleName)
	{
		// The faster "less-reliable" alternative which is not used because
		// a module (or extension) names could be in different casing, so
		// 'Mysql' should be approved even though only 'mysql' is loaded		
		## return extension_loaded($moduleName);

		// Set the module name to lower case and get all loaded extensions 
		$moduleName = strtolower($moduleName);
		$extensions = get_loaded_extensions();
		foreach($extensions as $ext)
		{
			if($moduleName == strtolower($ext))
				return true;
		}

		return false;
	}
	function wlt_system_check($echo = false, $extras=false){
	
	
		$php_extentions = array(
		'title'       =>  'PHP Requirements',
		'enabled'     =>  $extras,
		'extensions'  =>  array(
							'mysql'  => 'MySQL Databases',
							'mcrypt' => 'Encryption',
							'zlib'   => 'ZIP Archives',
							'GD'   => 'Image Editing',
							'ffmpeg'   => 'Video thumbnail Service',
							'cURL'   => 'Client URL Library', 
							'exif'   => 'Exchangeable image information',							  
							'Filter'   => 'Data Filtering', 
							'FTP'   => 'File Transfer Protocol', 
							'Hash'   => 'HASH Message Digest Framework', 
							'iconv'   => 'iconv', 
							'JSON'   => 'JavaScript Object Notation', 
							'libxml'   => 'libxml', 
							'mbstring'   => 'Multibyte String', 
							'OpenSSL'   => 'OpenSSL', 
							'PCRE'   => 'Regular Expressions (Perl-Compatible)', 
							'SimpleXML'   => 'SimpleXML', 
							'Sockets'   => 'Sockets', 
							'SPL'   => 'Standard PHP Library (SPL)', 
							'Tokenizer'   => 'Tokenizer', 
							 
		)
		);
	
		$php_directives = array
		(
			// --- BOOLEAN SETTINGS : On/Off ---
			array('title'  => 'Running Safe Mode',
				  'inikey' => 'safe_mode',
				  'mustbe' => 'Off',
				),
			array('title'  => 'Register Globals',
				  'inikey' => 'register_globals',
				  'mustbe' => 'Off',
				),
			array('title'  => 'Magic Quotes Runtime',
				  'inikey' => 'magic_quotes_runtime',
				  'mustbe' => 'Off',
				),
			 array('title'  => 'Display PHP Errors',
			 	  'inikey' => 'display_errors',
			 	  'mustbe' => 'On',
			 	),
			 //array('title'  => 'Short Open Tags',
			 //	  'inikey' => 'short_open_tag',
			 //	  'mustbe' => 'On',
			 //	),
			array('title'  => 'Automatic Session Start',
				  'inikey' => 'session.auto_start',
				  'mustbe' => 'Off',
				),
			array('title'  => 'File Uploading',
				  'inikey' => 'file_uploads',
				  'mustbe' => 'On',
				),
	
			// --- NUMERIC SETTINGS : Ints ---
			array('title'    => 'Maximum Upload File Size',
				  'inikey'   => 'upload_max_filesize',
				  'orhigher' => '10M',
				),
				
			array('title'    => 'Maximum Input Time',
				  'inikey'   => 'max_input_time',
				  'orhigher' => '60',
				),
								
			array('title'    => 'Max Simultaneous Uploads',
				  'inikey'   => 'max_file_uploads',
				  'orhigher'  => '2', 
				),
			array('title'    => 'Max Execution Time',
				  'inikey'   => 'max_execution_time',
				  'orhigher' => '100',
				),			
			array('title'    => 'Memory Capacity Limit',
				  'inikey'   => 'memory_limit',
				  'orhigher' => '32M',
				),
			array('title'    => 'POST Form Maximum Size',
				  'inikey'   => 'post_max_size',
				  'orhigher' => '16M',
				),
		);
		
	$output_string = ""; $passed_checks = true;	
	
	if($php_extentions['enabled']){
	foreach($php_extentions['extensions'] as $extKey=>$extTitle){
	
						$output_string .= '<tr>';
						$output_string .= '<td><strong>'.$extTitle.'</strong><br /><small>'.$extKey.'</small></td>';
						$output_string .= '<td>On</td>';
						if(IsExtensionInstalled($extKey)){
							$output_string .= '<td>'.GetAsGreen('On', true).'</td>';								
						}else{
							$output_string .= '<td>'.GetAsRed('Off', true).'</td>'; 
						}
						$output_string .= '</tr>';
	}
	}				
	foreach($php_directives as $idx=>$directive) {
	 
	// Prepair variables
							$current = ini_get($directive['inikey']);
							$required = '';
							$icon = 'okayico';
	
							// If this directive must be equal to something, works
							// with booleans, strings and numeric values
							if(isset($directive['mustbe']))
							{
								$required = $directive['mustbe']; 
								if($required == 'On' || $required == 'Off')
								{
									// Requirements are met
									if($current == '1' && $required == 'On')
										$current = GetAsGreen('On', true);
									else if($current != '1' && $required == 'Off')
										$current = GetAsGreen('Off', true);
	
									// Current switch is not correct
									else if($current == '1')
									{
										$current = GetAsRed('On', true);
										$icon = 'failico';
										$passed_checks = false;
									}
									else 
									{
										$current = GetAsRed('Off', true);
										$icon = 'failico';
										$passed_checks = false;
									}
								}
	
								// Any other value MUST be equal!
								else if($current == $required)
									$current = GetAsGreen($current, true);
								else
								{
									$current = GetAsRed($current, true);
									$icon = 'failico';
									$passed_checks = false;
								}
							}
	
							// or Higher/Lower only works with numeric values
							else if(isset($directive['orhigher']) || isset($directive['orlower']))
							{
							
								$current = ($current === '') ? 0 : $current;
								  
								$required = (isset($directive['orhigher'])) ? $directive['orhigher'] : $directive['orlower'];
								$reqInt = $required;
								$curInt = $current;
								settype($reqInt, 'integer');
								settype($curInt, 'integer');
	
								if(isset($directive['orhigher']))
								{
									$required = $required.' <span style="font-size:11px; color:#838383;">or more</span>';
									if($curInt >= $reqInt || $current == 0){
										$current = GetAsGreen($current, true);
									}else{								
										$current = GetAsRed($current, true);									
										$icon = 'failico';
										$passed_checks = false;
									}
								}
								else if(isset($directive['orlower']))
								{
									$required = $required.' <span style="font-size:11px; color:#838383;">or less</span>';
									if($curInt <= $reqInt){
									
										$current = GetAsGreen($current, true);
										
									}else{
									
										$current = GetAsRed($current, true);
										$icon = 'failico';
										$passed_checks = false;
									}
								}
							}
					
	
							
							$output_string .= '<tr>';
							$output_string .= '<td style="font-size:12px;"><strong title="'.$directive['inikey'].'">'.$directive['title'].'</strong><br /><small>'.$directive['inikey'].'</small></td>';
							$output_string .= '<td>'.$required.'</td>';
							$output_string .= '<td>'.$current.'</td>';	
							$output_string .= '</tr>';
									
	}	
	
	if($echo){
		echo '<table class="table table-bordered" style="background:#fff;">';
		echo '<tr><td><strong>Directive Title</strong></td><td>Required</td><td><span style="color:#279B00"><b>Current</b></span></td></tr>';
		echo $output_string;
		echo '</table>';
		if(!$passed_checks){
		echo "<p class='alert alert-warning'><b>Your hosting setup needs adjusting</b><br>Contact your webserver support (hosting service) to get the necessary PHP settings fixed.</p>";
		}
	}else{
		if($passed_checks){
		return true;
		}else{
		return false;
		}
	}
	}

















?>