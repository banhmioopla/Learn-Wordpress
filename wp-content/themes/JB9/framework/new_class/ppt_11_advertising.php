<?php


class framework_advertising extends framework_geo {


	// SELL SPACE AREAS
	public $sellspace = array(	
	
		"header" => array(		 
			"n" => "Header",
			"sw" => "468",
			"sh" => "60",
			"p"	=> "header",
			"min" => 1,
			"max" => 1,
		),
		
		"breadcrumbs" => array(		 
			"n" => "Breadcrumbs",
			"sw" => "468",
			"sh" => "60",
			"p"	=> "header",
			"min" => 1,
			"max" => 1,
		),
		"footer" => array(		 
			"n" => "Footer Area",
			"sw" => "468",
			"sh" => "60",
			"p"	=> "footer",
			"min" => 1,
			"max" => 1,
		),
		"blog" => array(		 
			"n" => "Blog Sidebar",
			"sw" => "250",
			"sh" => "200",
			"p"	=> "blog",
			"min" => 1,
			"max" => 3,
		),
		
		"search" => array(		 
			"n" => "Search Sidebar",
			"sw" => "250",
			"sh" => "200",
			"p"	=> "search",
			"min" => 1,
			"max" => 1,
		),	
		
		"page" => array(		 
			"n" => "Pages Sidebar",
			"sw" => "250",
			"sh" => "200",
			"p"	=> "page",
			"min" => 1,
			"max" => 3,
		),
		
		"listing" => array(		 
			"n" => "Listing Page",
			"sw" => "250",
			"sh" => "200",
			"p"	=> "single250",
			"min" => 1,
			"max" => 3,
		),
		
		"account" => array(		 
			"n" => "Members Area",
			"sw" => "468",
			"sh" => "60",
			"p"	=> "members",
			"min" => 1,
			"max" => 1,
		),
		
		
		
		/*
		"under728" => array(		 
			"n" => "Premium Leaderboard",
			"sw" => "728",
			"sh" => "90",
			"p" => "full_top",
			"min" => 1,
			"max" => 1,
		),
		
		"undermiddle728" => array(		 
			"n" => "Content Top Leaderboard",
			"sw" => "728",
			"sh" => "90",
			"p" => "middle_top",
			"min" => 1,
			"max" => 1,
		),
 
		"sidebarright125bot" => array(		 
			"n" => "Sidebar Right Bottom",
			"sw" => "125",
			"sh" => "125",
			"p" => "sidebar_right_bottom",
			"min" => 4,
			"max" => 4,
		),	
		
	 
		"sidebarleft125bot" => array(		 
			"n" => "Sidebar Left Bottom",
			"sw" => "125",
			"sh" => "125",
			"p" => "sidebar_left_bottom",
			"min" => 4,
			"max" => 4,
		),	
		
		"sidebarleft290100top" => array(		 
			"n" => "Sidebar Left Top",
			"sw" => "290",
			"sh" => "100",
			"p" => "sidebar_left_top",
			"min" => 1,
			"max" => 1,
		),
		
		"sidebarright290100top" => array(		 
			"n" => "Sidebar Right Top",
			"sw" => "290",
			"sh" => "100",
			"p" => "sidebar_right_top",
			"min" => 1,
			"max" => 1,
		),
				
		"sidebarright360bot" => array(		 
			"n" => "Sidebar Right Bottom",
			"sw" => "360",
			"sh" => "300",
			"p" => "sidebar_right_bottom",
			"min" => 1,
			"max" => 1,
		),	 	
		
		"sidebarleft360bot" => array(		 
			"n" => "Sidebar Left Bottom",
			"sw" => "360",
			"sh" => "300",
			"p" => "sidebar_left_bottom",
			"min" => 1,
			"max" => 1,
		),	
		
		"sidebarright290bot" => array(		 
			"n" => "Sidebar Right Bottom",
			"sw" => "290",
			"sh" => "100",
			"p" => "sidebar_right_bottom",
			"min" => 1,
			"max" => 1,
		),	
		
		"sidebarleft290bot" => array(		 
			"n" => "Sidebar Left Bottom",
			"sw" => "290",
			"sh" => "100",
			"p" => "sidebar_left_bottom",
			"min" => 1,
			"max" => 1,
		),*/
				
	);









	
/* =============================================================================
   SELL SPACE
   ========================================================================== */

function SELLSPACE($type=1, $userid="", $size=""){ global $wpdb;
	
	$esp = array();
	$spa = hook_sellspace($this->sellspace);

	switch($type){
	
	case "1": { return $spa; } break; // return array
	case "2": { 	
	
		$sellspacedata = _ppt('sellspace');
		foreach($spa as $key => $sp){
			if(isset($sellspacedata[$key]) && $sellspacedata[$key] == 1){
				$esp[$key] =  $sp;	
			}
		}	
	
		return $esp; 
		 
	} break; // return enabled array
	
	case "3": {  // return user banners
	
		$mybanners = array();
		
		if(is_array($size) && $size[0] != ""){		
		$SQL = "SELECT ".$wpdb->posts.".* FROM ".$wpdb->posts."
				INNER JOIN ".$wpdb->postmeta." AS t1 ON ( t1.post_id = ".$wpdb->posts.".ID AND t1.meta_key = 'width' AND t1.meta_value = '".$size[0]."')
				INNER JOIN ".$wpdb->postmeta." AS t2 ON ( t2.post_id = ".$wpdb->posts.".ID AND t2.meta_key = 'height' AND t2.meta_value = '".$size[1]."')
				WHERE ".$wpdb->posts.".post_status= 'publish' AND ".$wpdb->posts.".post_author = ".$userid."  LIMIT 0,50";	
 
		}else{
		$SQL = "SELECT * FROM ".$wpdb->prefix."posts WHERE post_type = 'wlt_banner' AND post_author = ".$userid." ORDER BY post_date DESC"; 
		}
	  
		$posts = $wpdb->get_results($SQL);	 
		foreach($posts as $post){ 
		$mybanners[] = array('id' => $post->ID, 'name' => $post->post_title, 'img' => $post->post_excerpt, 'w' => get_post_meta($post->ID, 'width', true), 'h' => get_post_meta($post->ID, 'height', true)  );
		}
	 
		return $mybanners;	
	
	} break;
	default: { } break;
	
	}

}
	
/* =============================================================================
	BANNER DISPLAY SYSTEM
	========================================================================== */
function BANNER($location, $styling = "", $where="top"){ 
 
 
global $wpdb, $wp_query, $CORE;

// RETUNR BLANK
if(isset($GLOBALS['banner_set_'.$where])){ return; }
 
 
$STRING = ""; $wlt_banners = get_option("wlt_banners"); $expired = array(); $bbb = 0;

if(_ppt('sellspace_enable') == 0){

	switch($location){
	
		case "header": {
			return _ppt('advertising1'); 
		} break;
		
		case "footer": {
			return _ppt('advertising2'); 
		} break;	
	}

}


// CHECK FOR SELLSPACE ADVERTISING
if(_ppt('sellspace_enable') == 1){


// GET DATA
$spa = hook_sellspace($this->sellspace);
 
$sellspacedata = _ppt('sellspace'); 

  
// LOOP 
foreach($spa as $key => $sp){ $bbb++;

 
	if($key == $location && isset($sellspacedata[$key]) && $sellspacedata[$key] == '1' && $sellspacedata[$key."_where"] == $where){ 

		
		$OUTPUTSTRING = "";
		$OUTINNER = "";
		// MIN COUNT
		$mindisplay = 0;
		
	
		
		// args
$args = array(
	'posts_per_page' => 200, 
	'post_type' => 'wlt_campaign', 
	'orderby' => 'post_date', 
	'order' => 'desc',
	'post_status'		=> 'publish',
	'meta_query' => array(
		array(
			'key'     => 'campaign',
			'value'   => $key,
			'compare' => '=',
		),
		
		array(
			'key'     => 'bannerid',
			'value'   => "0",
			'compare' => '!=',
		),
	),
);
	 
        $wp_query1 = new WP_Query($args); 
		$tt = $wpdb->get_results($wp_query1->request, OBJECT);
		if(!empty($tt)){
        
			foreach($tt as $p){
			
				$CAMPAIGNID = $p->ID;
				
				// get banner data
				$BANNERID = get_post_meta($CAMPAIGNID, 'bannerid', true);				
				if($BANNERID == ""){ continue; }
				
				// CHECK EXPIRED
				$vv = $CORE->date_timediff(get_post_meta($CAMPAIGNID, 'listing_expiry_date', true));				 
				if($vv['expired'] == 1){	
								
					$my_post = array();
					$my_post['ID'] 			= $CAMPAIGNID;
					$my_post['post_status'] = "draft";
					wp_update_post( $my_post );	
					
					continue;
				}
				
				$file = get_post_meta($BANNERID,'img',true);
			 	 
				// OUTPUT 
				if($file != ""){
				$OUTINNER .= "<a href='".home_url()."/out/".$CAMPAIGNID."/url/' rel='nofollow' target='_blank'><img src='".$file."' class='sellspace_banner' alt='cap-".$CAMPAIGNID."-ban-".$BANNERID."'></a>";
				
				// UPDATE STATSITICS
				update_post_meta($CAMPAIGNID, 'impressions', get_post_meta($CAMPAIGNID, 'impressions', true)+1);	
				}			 
				
				// COUNTER
				$mindisplay++;
				
			}
		
		}
	
	 
		// DISPLAY SAMPLE BANNERS IF REQUIRED
		if($sellspacedata[$key."_sample"] == '1' && $mindisplay < $sp['min']){
		
			while($mindisplay < $sp['min']){
				
				// CHECK FOR A CUSTOM LINK
				 
				$adlink = _ppt(array('links','sellspace'));
				
				$size = $sellspacedata[$key.'_size'];
				$size_parts = explode("x", $size);				
				$width = $size_parts[0];
				$heigth = $size_parts[1];
				
				// CHECK FOR SAMPLE BANNER
				if( _ppt('samplebanner_'.$width.'x'.$heigth) != "" && substr( _ppt('samplebanner_'.$width.'x'.$heigth) ,0,4) == "http"){ 
				
				$OUTINNER .= '<a href="'.$adlink.'?selladd=1&amp;ad='.$key.'"><img src="'._ppt('samplebanner_'.$width.'x'.$heigth).'" alt="samplebanner_'.$width.'_'.$heigth.' " class="sellspace_banner banner_'.$width.'_'.$heigth.' img-fluid" /></a>';
				
				}else{
				
				$OUTINNER .= '<a href="'.$adlink.'?selladd=1&amp;ad='.$key.'">
				<div class="sellspace_banner banner_'.$width.'_'.$heigth.' text-center hidden-xs hidden-sm" style="width:'.$width.'px; height:'.$heigth.'px; line-height:'.$heigth.'px">
				<div class="title">'.__("Advertise Here","premiumpress").'</div>';
				if($width > 300){ $OUTINNER .= '<div class="pricing">'.__("view pricing","premiumpress").'</div>'; }
				$OUTINNER .= '</div></a>';
				
				
				}
				
				
				 
			
				 
				$mindisplay++;
				 
			}
		}		
				
		$OUTPUTSTRING .= $OUTINNER;
		if($OUTINNER != ""){
		
		$GLOBALS['banner_set_'.$where] = 1;
		
		return "<div class='wlt_sellspace ".$location." ".$styling."'>".$OUTPUTSTRING."</div>";
		
		
		
		}
		 
	}
}
}


// SKIP FOR HOME PAGE
if($location == "middle_top" && isset($GLOBALS['flag-home']) ){ return; }

 
if(isset( $GLOBALS['CORE_THEME']['banners'][$location] ) && is_array($GLOBALS['CORE_THEME']['banners'][$location]) && !empty($GLOBALS['CORE_THEME']['banners'][$location]) ){

	// NOW WE HAVE A LIST OF BANNERS WE NEED TO FIND ONE THAT MATCHES THE CATEGORY WERE IN
	$category = $wp_query->get_queried_object(); $possible_banners = array();
 
	// LOOP THROUGH ALL BANNERS IN THIS LOCATION
	foreach($GLOBALS['CORE_THEME']['banners'][$location] as $k => $bannerID){
	 
	$bannerID = str_replace("banner_","",$bannerID);
	
		if(isset($wlt_banners[$bannerID]['category']) && is_array($wlt_banners[$bannerID]['category']) && !empty($wlt_banners[$bannerID]['category']) && $wlt_banners[$bannerID]['category'][0] != "" ){
	 
			foreach($wlt_banners[$bannerID]['category'] as $kg=>$kk){
				if(isset($category->term_id) && $kk == $category->term_id){
					$possible_banners = array_merge($possible_banners,array($bannerID));
				}			
			}
		}else{
		
		$possible_banners = array_merge($possible_banners,array($bannerID));
		
		}
	 
	}
	// NOW WE HAVE ALL POSSIBLE BANNERS, LETS SELECT A RANDOM ONE
	if(!empty($possible_banners)){
		$rk = array_rand($possible_banners, 1);
		$rk = $possible_banners[$rk];
		if(!isset($wlt_banners[$rk]['code'])){ $wlt_banners[$rk]['code'] = ""; }
		$STRING = do_shortcode(stripslashes($wlt_banners[$rk]['code']));
		// NOW LETS UPDATE THIS BANNER VIEWS
		$wlt_new_banners = $wlt_banners;
		if($wlt_new_banners[$rk]['views'] == ""){ $wlt_new_banners[$rk]['views'] = 0; }
		$wlt_new_banners[$rk]['views']++;
		 update_option("wlt_banners",$wlt_new_banners, true);  
	}
 
}

	if($STRING != ""){
	
		return "<div class='".$styling."'>".$STRING."</div>";
	
	}
	
	return $STRING;
}



	
}

?>