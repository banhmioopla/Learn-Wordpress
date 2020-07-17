<?php

add_action('hook_new_install','_newinstall');
function _newinstall(){ global $CORE, $wpdb;
  
// WEBSITE URL
$GLOBALS['theme_defaults']['logo_url'] 			= get_template_directory_uri()."/_jobs/template/images/logo.png";
$GLOBALS['theme_defaults']['newsletter'] = 1;
$GLOBALS['theme_defaults']['google'] = 1;
$GLOBALS['theme_defaults']['comments'] = 1;
$GLOBALS['theme_defaults']['account_messages'] = 1;
$GLOBALS['theme_defaults']['default_listing_map'] = 1;



    			 
$GLOBALS['theme_defaults']['color_primary'] 			= "#3F4246";
$GLOBALS['theme_defaults']['color_secondary'] = "";
$GLOBALS['theme_defaults']['search_item_style'] = "2"; 
$GLOBALS['theme_defaults']['search_image_style'] = ""; 
$GLOBALS['theme_defaults']['search_image_bottom'] = ""; 
$GLOBALS['theme_defaults']['page_columns'] = "2"; 
$GLOBALS['theme_defaults']['page_layout'] = "0";      
$GLOBALS['theme_defaults']['search_item_style'] = "2";
$GLOBALS['theme_defaults']['header_hometransparent'] = "0";
$GLOBALS['theme_defaults']['header_topnav'] = ""; 
$GLOBALS['theme_defaults']['header_topnavstyle'] = "header-top1"; 
$GLOBALS['theme_defaults']['header_topnavhome'] 	= "0";
$GLOBALS['theme_defaults']['header_topnavbg'] 	= "default"; 
$GLOBALS['theme_defaults']['header_topnavborderbottom'] = "0";
$GLOBALS['theme_defaults']['header_style'] = "0"; 
$GLOBALS['theme_defaults']['header_shadow'] = "0"; 
$GLOBALS['theme_defaults']['header_bg'] 	= "default"; 
$GLOBALS['theme_defaults']['header_sep'] = "0";
$GLOBALS['theme_defaults']['header_button'] = "0";
$GLOBALS['theme_defaults']['header_buttontext'] = "Post Ad";        
$GLOBALS['theme_defaults']['headernav_bg'] = "default";         
$GLOBALS['theme_defaults']['breadcrumbs'] = "0";
$GLOBALS['theme_defaults']['breadcrumbs_style'] 	= "1";
$GLOBALS['theme_defaults']['footer_blockstyle'] = "0";
$GLOBALS['theme_defaults']['footer_bg'] = "default";


// 5. REINSTALL THE SAMPLE DATA CATEGORIES 
$new_cat_array = array("Accounting"	 ,"General Business"	 ,"Other"
,"Admin & Clerical"	 ,"General Labor"	 ,"Pharmaceutical"
,"Automotive"	 ,"Government"	 
,"Banking"	 ,"Grocery"	 ,"Purchasing" ,"Procurement"
,"Biotech"	 ,"Health Care"	 ,"QA" ,"Quality Control"
,"Broadcast" ,"Journalism"	 ,"Hotel" ,"Hospitality"	 ,"Real Estate"	 ,"Human Resources"	 ,"Research"
,"Construction"	   ,"Restaurant" ,"Food Service"
,"Consultant"	 ,"Installation" ,"Maint" ,"Repair"	 ,"Reta"
,"Customer Service"	 ,"Insurance"	 ,"Sales"
,"Design"	 ,"Inventory"	 ,"Science"
,"Distribution" ,"Shipping"	 ,"Legal"	 ,"Skilled Labor" ,"Trades"
,"Education" ,"Teachin"	 ,"Legal Admin"	 ,"Strategy" ,"Planning"
,"Engineering"	 ,"Management"	 ,"Supply Chain"
,"Entry Level" ,"New Grad"	 ,"Manufacturing" 
,"Executive"	 ,"Marketing"	 ,"Training"
,"Facilities"	 ,"Media" ,"Journalism" ,"Newspaper"	 ,"Transportation"
,"Finance"	 ,"Nonprofit" ,"Social Services"	 ,"Warehouse");
 
$saved_cats_array = array(); $ff=1;
foreach($new_cat_array as $cat){
	if ( term_exists( $cat , THEME_TAXONOMY ) ){	
		$term = get_term_by('slug', $cat, THEME_TAXONOMY);		 
		$nparent  = $term->term_id;
		$saved_cats_array[] = $term->term_id;	
	}else{
	
		$cat_id = wp_insert_term($cat, THEME_TAXONOMY, array('cat_name' => $cat ));
		if(!is_object($cat_id) && isset($cat_id['term_id'])){
		$saved_cats_array[] = $cat_id['term_id'];
		$nparent = $cat_id['term_id'];
		}else{
		$saved_cats_array[] = $cat_id->term_id;
		$nparent = $cat_id->term_id;
		}			
		// add in icon for this cat		
		//$GLOBALS['theme_defaults']['category_icon_'.$nparent] = THEME_URI."/templates/".$GLOBALS['theme_defaults']['template']."/img/c".$ff.".jpg";
		$ff++; 
	}
	 
}
// 6. INSTALL THE SAMPLE DATA LISTINGS
$posts_array = array(
"1" => array("name" =>"Deputy Manager","price" => "100", "bidcount" => "0", "hits" => "0", "author" => "1"),
"2" => array("name" =>"Legal Resourcer","price" => "130", "bidcount" => "0", "hits" => "0", "author" => "2"),
"3" => array("name" =>"Electrician / 17th Edition","price" => "150",  "bidcount" => "0", "hits" => "0", "author" => "3"),
"4" => array("name" =>"Door Supervisor","price" => "160",  "bidcount" => "0", "hits" => "0", "author" => "4"),
"5" => array("name" =>"Sales Manager","price" => "150", "bidcount" => "0", "hits" => "0", "author" => "5"),
"6" => array("name" =>"Sales Advisor","price" => "170", "bidcount" => "0", "hits" => "0", "author" => "6"),
"7" => array("name" =>"Support Assistant","price" => "200",  "bidcount" => "0", "hits" => "0", "author" => "7"),
"8" => array("name" =>"Web Developer","price" => "300",  "bidcount" => "0", "hits" => "0", "author" => "8"),
"9" => array("name" =>"Communications Manager","price" => "500", "bidcount" => "0", "hits" => "0", "author" => "9")

);

		$fields = array(
		"jobtype"			=> array('fulltime','parttime','contract','internship','temporary'),	 
		"displaytype" 		=> array(2,1),		 
		"pricetype" 		=> array(1,2,3,4),
		"price" 			=> array('10000','20000','30000','40000','50000','60000'),
 	
		);
		
		$sampletext = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>";
		
		
foreach($posts_array as $np){
 
	$my_post = array();
	$my_post['post_author'] 	= 1;
	$my_post['post_title'] 		= $np['name'];
	$my_post['post_content'] 	= $sampletext;
	$my_post['post_type'] 		= THEME_TAXONOMY."_type";
	$my_post['post_status'] 	= "publish";
	$my_post['post_category'] 	= "";
	$my_post['tags_input'] 		= "";
	$POSTID 					= wp_insert_post( $my_post );	
	
	add_post_meta($POSTID, "image", "http://localhost/_demoimages/job_c".$np['author'].".png");
	 
	 
	add_post_meta($POSTID, "responsibilities", $sampletext );
	add_post_meta($POSTID, "qualifications", $sampletext );	 
	add_post_meta($POSTID, "company", "John Doe Company" );
	add_post_meta($POSTID, "hours", rand(20,100) );
	add_post_meta($POSTID, "price", $np['price'] );
	add_post_meta($POSTID, "experience", rand(1,6) );
	 
	 
	 add_post_meta($POSTID, "map-location", "Express Newspapers, London EC3R, UK" );
	 add_post_meta($POSTID, "map-log", "-0.08400678634643555" );
	 add_post_meta($POSTID, "map-lat", "51.509049626274454" );
	 add_post_meta($POSTID, "map-city", "London" );
	 add_post_meta($POSTID, "map-area", "City of London" );
	 add_post_meta($POSTID, "map-country", "GB" );

		// FEATURED
		$strings = array('yes', 'no');
		$random_str = $strings[array_rand($strings)];
		add_post_meta($POSTID, "featured", $random_str );
	
	// ADD ON CUSTOM FIELDS
	foreach($fields as $k => $t){
		if(is_array($t)){		
		$ig = array_rand($t,1);
		add_post_meta($POSTID, $k, $t[$ig]);
		}else{
		add_post_meta($POSTID, $k, $t);
		}	
	}
	
	// UPDATE CAT LIST
	wp_set_post_terms( $POSTID, $saved_cats_array, THEME_TAXONOMY );		
} 

 


} 

?>