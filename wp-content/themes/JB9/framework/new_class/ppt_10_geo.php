<?php


class framework_geo extends framework_ajax {


/*

*/
function _featured_keycount($key, $mapkey ="map-city"){ global $wpdb;


	$SQL = "SELECT count(".$wpdb->posts.".ID) as total FROM ".$wpdb->posts."

				INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID AND t1.meta_key = '".$mapkey."' AND t1.meta_value = ('".$key."') )

				WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_type='listing_type'";	
 
	$posts = $wpdb->get_results($SQL);	
 
	return $posts[0]->total; 

}
function _featured_locations($limit = "5", $mapkey = "map-city"){ global $wpdb;
 
	$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID, t1.meta_value as city, t2.meta_value as country FROM ".$wpdb->posts."

				INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID AND t1.meta_key = '".$mapkey."' AND t1.meta_value != '')
				
				INNER JOIN ".$wpdb->postmeta." AS t2 ON ( t2.post_id = ".$wpdb->posts.".ID AND t2.meta_key = 'map-country')
				
				WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_type='listing_type' GROUP BY city ORDER BY t1.meta_key LIMIT ".$limit;	

	 

	$images = array();

	$posts = $wpdb->get_results($SQL);	 

	foreach($posts as $post){ 
	
	$images[] = array('id' => $post->ID, 'city' => $post->city, 'country' => $post->country, 'images' => $this->media_get($post->ID,"image"), 'count' => $this->_featured_keycount($post->city, $mapkey)   );

	} 
 
	return $images;	 

}

	/*
		this function displays the active
		language for the website
	*/
	function _language_current($lowercase = false){
	
		if(isset($_SESSION['language'])){		 
			$name = $_SESSION['language'];
		}else{
			$name = "en_US";
		}
		
		if($lowercase){
			return strtolower($name);
		}else{
			return $name;
		}
	
	}
	/*
		this function displays the drop down
		menu for available languages
	*/
	function _language_dropdown_menu($text = false){ global $post, $wpdb;
	
	if(_ppt('language_dropdown') != 1){ return; }
	
	 
	//if(isset($GLOBALS['FLAGSARESET'])){ return; }
	//$GLOBALS['FLAGSARESET'] = 1;
	
	// DEFAULT ICONS
	$defaultflagicon = _ppt('flagicon');
	if($defaultflagicon == ""){
		$defaulticon = "gb";
	}else{	
		$dd = explode("_",$defaultflagicon);
		$defaulticon = $dd[0];
		if($defaulticon == "en"){ $defaulticon = strtolower($dd[1]); }  
	}

  
	// CHECK FOR WPML FIRST
	if(function_exists('icl_get_languages')){
	
	  
	 $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=KEY&order=asc&link_empty_to=str' );
	 
 
	/*
	[en] => Array
			(
				[code] => en
				[id] => 1
				[native_name] => English
				[major] => 1
				[active] => 0
				[default_locale] => en_US
				[encode_url] => 0
				[tag] => en
				[translated_name] => 
				[url] => http://localhost/WP
				[country_flag_url] => http://localhost/WP/wp-content/plugins/sitepress-multilingual-cms/res/flags/en.png
				[language_code] => en
		  )
	*/
	 
	ob_start();
	
	?>    
     
     <div class="dropdown languagelist<?php echo microtime(true); ?> wpml-language">
     
     <?php foreach($languages as $l){ if($l['active'] != 1){ continue; } ?>
    	<a href="#" class="dropdown-toggle noafter" data-toggle="dropdown" data-hover="dropdown" data-close-others="false" data-delay="500">
				<img src="<?php echo $l['country_flag_url']; ?>"> <?php echo $l['native_name']; ?>
				 <b class="caret"></b>
			</a>
    <?php } ?>
            
        <div class="dropdown-menu" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
        
            <?php foreach($languages as $l){ if($l['active'] == 1){ continue; } ?>
             
                <a href="<?php echo $l['url']; ?>" class="dropdown-item">
                    <img src="<?php echo $l['country_flag_url']; ?>"> <?php echo $l['native_name']; ?>
                </a>
         
            <?php } ?>
        </div>
    
  </div>
  
   <?php 
   
	return ob_get_clean(); 
	
	
	}elseif(_ppt('languages') != "" && is_array(_ppt('languages')) ){ 

 
  
ob_start();

?>
<div class="btn-group languagelist">

  	<a href="#" data-toggle="dropdown" role="button" aria-expanded="false"> 
    
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] != "" && $_SESSION['language'] != "en_US"){ 
	
	$icon = explode("_", $_SESSION['language']); ?>
 
    <div class="flag flag-<?php if(strlen($_SESSION['language']) > 2){ echo str_replace("_","",substr(strtolower($_SESSION['language']),2)); }else{ echo $_SESSION['language']; } ?>">&nbsp;</div>
    
    <?php }else{ 	
	
	?>
    
    <div class="flag flag-<?php echo $defaulticon; ?>">&nbsp;</div> 
    
    <?php } ?>  
    
    </a>    
 
  <div class="dropdown-menu">
  
  <?php
  if(isset($_SESSION['language']) && $_SESSION['language'] != "" && $_SESSION['language'] != "en_US"){ 
  ?>
  <a href="<?php echo home_url(); ?>/?l=en_US" class="dropdown-item" rel="nofollow">
            <div class="flag flag-<?php echo $defaulticon; ?>">&nbsp; </div>			 
            </a>
  <?php } ?>
 

	<?php foreach(_ppt('languages') as $lang){
	 
		$icon = explode("_",$lang);
		 
            ?>
            <a href="<?php echo home_url(); ?>/?l=<?php echo $lang; ?>" class="dropdown-item" rel="nofollow">
            <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?>">&nbsp; </div>			 
            </a>
    <?php } ?>



  </div>
</div>
 

<?php

return ob_get_clean();
	
	
	}
	
	return "";
 }




























	/*
		this function returns the Google maps
		API path URL with included data
	*/
	function googlelink(){
	
	$region = "us"; $lang = "en"; $extra = "";
	if(isset($GLOBALS['CORE_THEME']['google_lang'])){
		$region = $GLOBALS['CORE_THEME']['google_region'];
		$lang = $GLOBALS['CORE_THEME']['google_lang'];
	}
	if(isset($GLOBALS['tpl-add'])){
	$extra = "&v=3.exp&libraries=places";
	}
	
	return 'https://maps.googleapis.com/maps/api/js?language='.$lang.'&amp;region='.$region.$extra."&key=".trim(stripslashes(_ppt('googlemap_apikey')));

	}


/* =============================================================================
  GOOGLE MAP DISPLAY FUNCTION FOR SEARCH RESULTS PAGE
   ========================================================================== */

function get_radius_unit(){

	// GET THE UNIT
	$unit = strtoupper(_ppt('geolocation_unit'));			
	if ($unit == "K") {			 
		$rt = __("kilometers","premiumpress");
	} else if ($unit == "N") {
		$rt = __("nautical miles","premiumpress");	
	} else {
		$rt = __("miles","premiumpress");    
	}
	
	return $rt;
}
function MilesToMeters($num){
if($num == "" || $num == 0){ return 0; }
 
	$unit = strtoupper(_ppt('geolocation_unit'));
	
	if ($unit == "K") {	
		return $num/0.001;  // 1 meters = 0.001 KM;
	} else {
		return $num/0.00062137119; // 1 meters = 0.00062137119 miles; 
	}

} 
function wlt_google_getradius(){

if(!isset($_GET['zipcode'])){ return; }

$saved_searches = get_option('wlt_saved_zipcodes');

$longitude 	= $saved_searches[$_GET['zipcode']]['log'];
$latitude 	= $saved_searches[$_GET['zipcode']]['lat'];
$radius = 1;
if(isset($_GET['radius']) && is_numeric($_GET['radius']) ){
$radius = $_GET['radius'];
}

return array("zip" => $_GET['zipcode'], "long"  => $longitude, "lat"  => $latitude, "dis" => $this->MilesToMeters($radius) );

} 
function wlt_google_getdefaults(){	
	
	// REGION
	$region = "us"; $lang = "en"; 
	if(isset($GLOBALS['CORE_THEME']['google_lang'])){
		$region = $GLOBALS['CORE_THEME']['google_region'];
		$lang = $GLOBALS['CORE_THEME']['google_lang'];
	}

	// GET DEFAULT ROOM AND COORDS FROM ADMIN
	if(isset($GLOBALS['CORE_THEME']['google_coords1']) && $GLOBALS['CORE_THEME']['google_coords1'] != ""){ 
		$ff = explode(",",$GLOBALS['CORE_THEME']['google_coords1']);
		$latitude =  $ff[1];
		$longitude = $ff[0];
	}
	if(isset($GLOBALS['CORE_THEME']['google_zoom1'])){ $default_zoom = $GLOBALS['CORE_THEME']['google_zoom1']; }
	
	
	// CHECK IF THIS IS A ZIPODE SEARCH
	if(isset($_GET['zipcode']) && ( strlen($_GET['zipcode']) > 2 && strlen($_GET['zipcode']) < 9 ) ){
	
		$saved_searches = get_option('wlt_saved_zipcodes');
		
		if(isset($saved_searches[$_GET['zipcode']]['log'])){
		$longitude 	= $saved_searches[$_GET['zipcode']]['log'];
		}else{ $longitude =0; }
		
		if(isset($saved_searches[$_GET['zipcode']]['lat'])){
		$latitude 	= $saved_searches[$_GET['zipcode']]['lat'];
		}else{ $latitude =0; }	 
			
	}
	
	// SET COORDS TO USERS LOCATION IF ORDERING BY DISTANCE
	if(isset($_SESSION['mylocation']['lat']) && strlen($_SESSION['mylocation']['lat']) > 0 && strlen($_SESSION['mylocation']['log']) > 0 && isset($GLOBALS['CORE_THEME']['geolocation']) && $GLOBALS['CORE_THEME']['geolocation'] != ""){

		$latitude =  strip_tags($_SESSION['mylocation']['lat']);
		$longitude = strip_tags($_SESSION['mylocation']['log']);
	}
	
	// CHECK AND VALDATE
	if(!isset($longitude) || ( isset($longitude) && $longitude == "" ) ){ $longitude = 0; }
	if(!isset($latitude) || ( isset($latitude) && $latitude == "" ) ){ $latitude = 0; }
	
	$default_zoom = 7;
	
	return array("region" => $region, "lang" => $lang, "zoom" => $default_zoom, "long" => $longitude, "lat" => $latitude  );
}

 

 
function wlt_googlemap_data($output = false){ $g=0; $HasIconArray = array();  $json = array();
 
 global $wpdb, $wp_query, $CORE;
 
 
	if( isset($wp_query->request) && isset($_GET['mapsearch']) ){ 
 	 
		$gg = explode("LIMIT ",$wp_query->request);	
		 
		$gg[0] = str_replace("".$wpdb->posts.".ID FROM", "".$wpdb->posts.".ID,
		".$wpdb->posts.".post_title, 
		".$wpdb->posts.".guid AS plink,		 		
		pm0.meta_value AS lat, 
		pm0.meta_key AS lat_key,
		pm1.meta_value AS log, 
		pm1.meta_key AS log_key, 		
		pm2.meta_value AS pic, 
		pm2.meta_key AS pic_key, 		
		b.guid AS photo,
		".$wpdb->posts.".post_content FROM", $gg[0]);
				
		$gg[0] = str_replace("WHERE 1=1", 		
		"INNER JOIN ".$wpdb->postmeta." pm0 ON (".$wpdb->posts.".ID = pm0.post_id AND pm0.meta_key ='map-lat' AND pm0.meta_value !='' )		
		INNER JOIN ".$wpdb->postmeta." pm1 ON (".$wpdb->posts.".ID = pm1.post_id AND pm1.meta_key ='map-log'  AND pm1.meta_value !='' ) 		
		LEFT JOIN ".$wpdb->postmeta." pm2 ON (".$wpdb->posts.".ID = pm2.post_id AND pm2.meta_key ='_thumbnail_id'  )		
		LEFT JOIN (SELECT t1.* FROM ".$wpdb->posts." AS t1 WHERE t1.post_type='attachment' LIMIT 1 ) AS b ON b.ID = pm2.meta_value 		
		WHERE 1=1", $gg[0]); 
		
		$gg[0] = str_replace("ORDER BY post_date", "ORDER BY ".$wpdb->posts.".post_date",$gg[0]);
		$gg[0] = str_replace("SELECT", "SELECT DISTINCT",$gg[0]);
		$gg[0] = str_replace("post_type = 'post'", "post_type =  'listing_type'",$gg[0]);		
		$gg[0] = str_replace("ORDER BY wp_postmeta.meta_value+0", "ORDER BY ".$wpdb->posts.".post_date",$gg[0]);
		$gg[0] = str_replace("ORDER BY wp_postmeta.meta_value", "ORDER BY ".$wpdb->posts.".post_date",$gg[0]);
		$gg[0] = str_replace(" AND post_status = 'publish'", " ", $gg[0]);
		 
		$mapdata = $wpdb->get_results($gg[0]." LIMIT 500" , OBJECT);
	 	
		$SETUP = 1;	
 
 		 
	}else{
	 
		$args = array(
		'post_type' => THEME_TAXONOMY.'_type',
		'orderby' => 'ID',
		'order' => 'desc',
		'no_found_rows' => true,
		'posts_per_page' => 490,
			'meta_query' => array (
				array (
				'key' => 'map-lat',
				'value' => '',
				 'compare' => '!='
				)		 
			),
		); 
		
		if ( WLT_CACHING == false ||  ( $mapdata = get_transient( 'googlemapdata_query_results1' ) ) === false  ) {
		 
			$my_query = new WP_Query($args); 
			$mapdata = $my_query->posts; 
		 	set_transient( 'googlemapdata_query_results1', $mapdata, 24 * HOUR_IN_SECONDS );
		}
		
		$SETUP = 2;
	}
	 
  
	if( is_array($mapdata) ) {	
						
		foreach($mapdata as $map){
		 
			 if($SETUP == 1){
			 
			 	$permalink 	= $map->plink;
				$long 		= $map->log;
				$lat 		= $map->lat;
				$image 		= $map->photo;
				$catID 		= 0;	
				$catName 	= "";
				
				if($image == ""){
					// GET IMAGE
					
					$ib = $this->media_get($map->ID,"image");				 	
					$image = $ib[0]['thumbnail'];					
					
				}
			 
			 }elseif($SETUP == 2){
			 
				// GET CATEGORY ID
				 $catID = 0; $catName = "none";
				$cat =  wp_get_object_terms( $map->ID , THEME_TAXONOMY );
				if(isset($cat[0])){
					$catID = $cat[0]->term_id;
					$catName = $cat[0]->name;		
				}		
			  
				// GET LISTING DATA
				$permalink 	= get_permalink($map->ID);
				$long 		= get_post_meta($map->ID,'map-log',true);	
				$lat 		= get_post_meta($map->ID,'map-lat',true);					
				
				// GET IMAGE
				$ib = $this->media_get($map->ID,"image");				 	
				$image = $ib[0]['thumbnail'];	 
				
			}
			
			// THEME EXTRAS
			$extra1 = "";
			$extra2 = "";
			if(THEME_FOLDER == "_realestate"){
				$extra1 = get_post_meta($map->ID,'map-city',true);
				
				if(get_post_meta($map->ID,'map-area',true) != ""){
					$extra1 .= ", ".get_post_meta($map->ID,'map-area',true);
				}
				
				$extra2 = hook_price(get_post_meta($map->ID,'price',true));
					if( get_post_meta($map->ID,'ltype',true) == 2){
					$extra2 .= " <small>".__("monthly","premiumpress")."</small>";		
					}
			}
			
			// SETUP JASON DATA
			$json[] = array(	
			"id"	=> $map->ID,	
			"lat" 	=> $lat,
			"long" 	=> $long, 
			"url"  	=> $permalink,
			"title" => esc_html(str_replace("'","",substr(strip_tags($map->post_title),0,28))),
			"desc" 	=> "", //esc_html(str_replace("'","",substr(strip_tags($map->post_content),0,110))),
			"img" 	=> $image,
			"catid" => $catID,	
			"catname" => $catName,				
			"extra1" =>  $extra1,
			"extra2" => $extra2,
			);	
		}
 
	}  
 
	// RETURN JASON OUTPUT
	if($output){
		if(empty($json)){ return ""; }else{ return json_encode($json);  }
	}else{
		if(empty($json)){ return ""; }else{ return $json; }
	}
}

 

	
 
	

	
}

?>