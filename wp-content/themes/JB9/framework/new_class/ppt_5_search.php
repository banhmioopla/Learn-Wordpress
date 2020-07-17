<?php


class framework_search extends framework_orders {
 
 
 
	/*
		This function gets the citties from a selected country
	*/
	function search_get_cities($country, $limit=10){	global $wpdb;
 
	$SQL = "SELECT DISTINCT t1.meta_value as city FROM ".$wpdb->postmeta." 

				INNER JOIN ".$wpdb->postmeta." AS t1 ON ( ".$wpdb->postmeta.".post_id = t1.post_id AND t1.meta_key = 'map-city')
			 
				WHERE ".$wpdb->postmeta.".meta_key = 'map-country' AND ".$wpdb->postmeta.".meta_value = '".$country."'  LIMIT ".$limit;	
 

	$cities = array();

	$posts = $wpdb->get_results($SQL);	 

	foreach($posts as $post){ 
	
		$cities[] = $post->city;

	} 
 
	return $cities;	 
 
	}
 
	/*
		This function displays the most
		popular searches with links
	*/
	function search_popular_searches($limit=10, $type = 1){ $STRING = "";
	
		$saved_searches_array = get_option('recent_searches');
		if(is_array($saved_searches_array) && !empty($saved_searches_array)){
		
		$ss = array_reverse( $this->multisort( $saved_searches_array, array('views') ), true );
		$i =0;
		foreach($ss  as $key => $searchdata){ 
		if($i > $limit){ continue; }
		
		$term = esc_attr(str_replace("_"," ",$key));
		
		
		if($type == 2){
		
		$STRING .= "<a href='" . home_url(). "/?s=&zipcode=" . $term . "&radius=40'>".substr($term,0,20)."</a>";
		
		}else{
		
		$STRING .= "<a href='" . home_url(). "/?s=" . $term . "'>".substr($term,0,20)."</a>";
		
		}
		
		$i ++;
		}
	}
	
	return $STRING;
	}
	
 

	/* =============================================================================
	   ORDER BY RESULTS FOR SEARCH PAGE
	   ========================================================================== */
	function format_webpath($extra){ global $post, $query;
	 $start_bit = "&"; $rr = $_SERVER["REQUEST_URI"]; $extra1 = str_replace("&","&amp;",$extra);
	 
	 if(substr($_SERVER["REQUEST_URI"],-1) == "/"){	
	 $start_bit = "?";
	 }	
	 
	 // CHECK IF WE CAN DO IT
	 if( has_term( '', THEME_TAXONOMY ) && is_category() ) {
	 
		 $term_list = wp_get_post_terms($post->ID, THEME_TAXONOMY, array("fields" => "all"));
		 if(isset($term_list[0])){
		 $link = get_term_link($term_list[0], THEME_TAXONOMY);
		 }
		 if(is_string($link)){
		 	$rr = $link;
			$start_bit = "?";
		 }
	 } 
	 
 
	 return str_replace($extra,"",$rr).$start_bit.$extra1; 
	
	}
	
	


/* =============================================================================
	 CORE ITEM DISPLAY SETTINGS
	========================================================================== */
 
 
	// LET USERS EDIT THEIR OWN POSTS
	function wlt_edit_own_caps() {  global $userdata;
 		
		 // ADD ON TAG SUPPORT
		register_taxonomy_for_object_type('post_tag', THEME_TAXONOMY.'_type');
			
		if(isset($userdata->ID) && $userdata->ID > 0){
			// gets the author role
			$role = get_role( 'subscriber' );
			$role->add_cap( 'edit_posts' ); 
			//upload_files ??
		}
	} 
	// SETS THE DEFAULT SEARCH QUERY TO POSATIVE IF NO SEARCH KEYWORD IS ENTERED
	function my_request_filter( $query_vars ) {
	 
	 	if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
			$query_vars['s'] = " ";
		}
		return $query_vars;
	}
	
	
	
	function get_db_key_ref($string,$key){
	
		$pix = "mt1";
	
		// CHECK IF THE VALUE IS FOUND IN THE STRING
		if(strpos($string,$key) !== false){
		
			$bits = explode("AND",$string);			
			//print_r($bits.$string);
			foreach($bits as $innerstr){
				
				if(strpos($innerstr,"'".$key."'") !== false){					
					$gg = explode(".",$innerstr);					 
					$pix = $gg[0]; 				
				}
			}		
		}
		
		return str_replace("(","",str_replace(")","",$pix));	
	}


 
	
	// CORE THEME SEARCH FILTER
	function _pre_get_posts($query) { global $userdata, $post, $wpdb; $canset = false;
 		 
		 
		 
		 //(isset($post->post_type) && $post->post_type == "listing_type"
		
		// SET 15 ITEMS IF USING FULL PAGE
		if( !is_admin() && isset($_GET['s']) && ( !isset($_GET['display']) && in_array(THEME_KEY,array("sp","cm","mj"))) || ( isset($_GET['display']) && $_GET['display'] == 2 ) ){ 	
		$query->set('posts_per_page', 15);
		}
	 
		// REDUCE WP QUERIES FOR HOMEPAGE SINCE WE DONT USE POST ELEMENTS
		if(is_home() && isset($query->request) ){		 
			
			if(strpos($query->request,"SELECT $wpdb->posts.*") === false){ $query->query_vars['no_found_rows'] = 1; 
			
			return $query; 
			
			}		
		}	
		
		if(isset($query->query['s']) && is_numeric($query->query['s'])){
		
			return $query; 
		
		// DONT DO ANYTHING WITH ADMIN QUERY
		}elseif(is_admin() || ! $query->is_main_query() ){ 	
		
		 	$addon = array();
			
			if(isset($_GET['memid']) ){			
			
				if($_GET['memid'] == "99"){				 
					$addon['new']   = array( 'key' => 'wlt_subscription' );				 
				}else{
					$addon['new']   = array(
						'key' 			=> 'wlt_subscription',					 
						'value' 		=> $_GET['memid'],
						'compare' 		=> 'LIKE',							 														 			
					);
				}				
				 
				// ADD QUERY
				$query->set( 'meta_query', $addon );
				 
			}
			
			if(isset($_GET['packageid']) && is_numeric($_GET['packageid'])){
			
			 				 
				if($_GET['packageid'] == "77"){	
							 
					 $addon['new']   = array( 'key' => 'packageID', 'type' => 'NUMERIC' );
					 
				}else{
					$addon['new']   = array(
							'key' 			=> 'packageID',
							'type' 			=> 'NUMERIC',
							'value' 		=> $_GET['packageid'],
							'compare' 		=> '=',							 														 			
					);
				}
				// ADD QUERY	
				$query->set( 'meta_query', $addon );	  
			
			}
		
			return $query; 
		
		// ADD-ON TAG SUPPORT IN 6.4+
		}elseif( is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {

			$post_types = get_post_types();
			$query->set( 'post_type', $post_types );
		
			return $query;
		
		}elseif ( ( $query->is_search ||  $query->is_archive ) && !$query->is_category && !is_admin() && !isset($query->query['post_type']) ) { 
		
			
			
			/*
				these are add-on search queries
			*/
			$addon = array();	
		
			/*
			////////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////			
			*/
			
			// DEFAULT FILTERING SYSTE,
			if(isset($_GET['ft']) && is_array($_GET['ft']) ){
			
			 
			foreach($_GET['ft'] as $key => $val ){
			
				switch($val){
					
					// TITLE
					case "s1": {
						$_GET['sort'] = "title";
						$_GET['order'] = "asc";
					} break;
					case "s1a": {					
						$_GET['sort'] = "title";					
						$_GET['order'] = "desc";
					} break;
					
					// DATE
					case "s2": {					
						$_GET['sort'] = "date";	
						$_GET['order'] = "desc";
					} break;
					case "s2a": {					
						$_GET['sort'] = "date";	
						$_GET['order'] = "asc";
					} break;					
					case "s3": {					
						$_GET['sort'] = "hits";					
						$_GET['order'] = "desc";						
					} break;
					case "s3a": {					
						$_GET['sort'] = "hits";					
						$_GET['order'] = "asc";
					} break;
					
					case "s4": {
					
						$_GET['sort'] = "featured";					
						$_GET['order'] = "desc";	
						
					} break;
					
					case "s5": {
					
						$_GET['sort'] = "ratingup";					
						$_GET['order'] = "desc";	
						
					} break;
					// PRICE
					case "s6": {					
						$_GET['sort'] = "price";					
						$_GET['order'] = "desc";
					} break;
					case "s6a": {					
						$_GET['sort'] = "price";					
						$_GET['order'] = "asc";
					} break;
					
					case "o1": {
					 			
						$_GET['order'] = "desc";	
						
					} break;	
					
					case "o2": {
					 			
						$_GET['order'] = "asc";	
						
					} break;	
					
					case "p1": {
					
						$addon['hits']   = array(						
						 
							'relation'    => 'OR',											 
								'rating'    => array(
									'key' => 'hits',
									'type' 			=> 'NUMERIC',							 					 			
								),			 
								'rating1'   => array(
									'key'     => 'hits',
									'type' 			=> 'NUMERIC',	
								),						
						 						 														 			
						);				
					
					} break;
					case "p2": {
					
						$addon['hits']   = array(
							'key' 			=> 'hits',
							'type' 			=> 'NUMERIC',
							'value' 		=> 10,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;	
					
					case "p3": {
					
						$addon['hits']   = array(
							'key' 			=> 'hits',
							'type' 			=> 'NUMERIC',
							'value' 		=> 100,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;	
					
					case "p4": {
					
						$addon['hits']   = array(
							'key' 			=> 'hits',
							'type' 			=> 'NUMERIC',
							'value' 		=> 1000,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					
					case "p5": {
					
						$addon['hits']   = array(
							'key' 			=> 'hits',
							'type' 			=> 'NUMERIC',
							'value' 		=> 10000,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					
					case "p4": {
					
						$addon['hits']   = array(
							'key' 			=> 'hits',
							'type' 			=> 'NUMERIC',
							'value' 		=> 100000,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
				
					case "r0": {
					
						$addon['ratingup']   = array(
											 
							'relation'    => 'OR',	
										 
								'rating'    => array(
									'key' => 'ratingup',								 					 			
								),			 
								'rating1'   => array(
									'key'     => 'ratingup',							
									'compare' => 'NOT EXISTS',
													
								),					
						 						 														 			
						);				
					
					} break;
					
					case "r1": {
					
						$addon['ratingup']   = array(
							'key' 			=> 'ratingup',
							'type' 			=> 'NUMERIC',
							'value' 		=> 10,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					
					case "r2": {
					
						$addon['ratingup']   = array(
							'key' 			=> 'ratingup',
							'type' 			=> 'NUMERIC',
							'value' 		=> 50,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					case "r3": {
					
						$addon['ratingup']   = array(
							'key' 			=> 'ratingup',
							'type' 			=> 'NUMERIC',
							'value' 		=> 100,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					case "r4": {
					
						$addon['ratingup']   = array(
							'key' 			=> 'ratingup',
							'type' 			=> 'NUMERIC',
							'value' 		=> 200,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					case "r4": {
					
						$addon['ratingup']   = array(
							'key' 			=> 'ratingup',
							'type' 			=> 'NUMERIC',
							'value' 		=> 500,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					case "cp1": {
					
						$addon['used']   = array(
							'key' 			=> 'used',
							'type' 			=> 'NUMERIC',
							//'value' 		=> 50,
							//'compare' 		=> '>=',							 														 			
						);	 	
					
					} break; 
					
					case "cp2": {
					  
					$_GET['sort'] = "expirydate";					
					$_GET['order'] = "desc";	
					
					} break; 
					
					case "at1": {
					  
					$_GET['sort'] = "listingexpirydate";					
					$_GET['order'] = "desc";	
					
					} break; 
					case "at2": {
					  
					$_GET['sort'] = "listingexpirydate";					
					$_GET['order'] = "asc";	
					
					} break; 
					
					case "da1": {
					  
					$_GET['sort'] = "dadob";					
					$_GET['order'] = "asc";	
					
					} break; 
					
					case "da2": {
					  
					$_GET['sort'] = "dadob";					
					$_GET['order'] = "desc";	
					
					} break; 
					
					case "sr0": { // STAR RATING
					
						$addon['ratingup']   = array(
						
						 
							'relation'    => 'OR',	
										 
								'rating'    => array(
									'key' => 'starrating_total',								 					 			
								),			 
								'rating1'   => array(
									'key'     => 'starrating_total',							
									'compare' => 'NOT EXISTS',
													
								),						
						 						 														 			
						);			
					
					} break;
					case "sr1": { // STAR RATING
					
						$addon['ratingup']   = array(
							'key' 			=> 'starrating_total',
							'type' 			=> 'NUMERIC',
							'value' 		=> 1,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					
					
					case "sr2": { // STAR RATING
					
						$addon['ratingup']   = array(
							'key' 			=> 'starrating_total',
							'type' 			=> 'NUMERIC',
							'value' 		=> 2,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					
					case "sr3": { // STAR RATING
					
						$addon['ratingup']   = array(
							'key' 			=> 'starrating_total',
							'type' 			=> 'NUMERIC',
							'value' 		=> 3,
							'compare' 		=> '>=',							 														 			
						);	
						 	 	
					
					} break;
					
					
					case "sr4": { // STAR RATING
					
						$addon['ratingup']   = array(
							'key' 			=> 'starrating_total',
							'type' 			=> 'NUMERIC',
							'value' 		=> 4,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					case "sr5": { // STAR RATING
					
						$addon['ratingup']   = array(
							'key' 			=> 'starrating_total',
							'type' 			=> 'NUMERIC',
							'value' 		=> 5,
							'compare' 		=> '>=',							 														 			
						);				
					
					} break;
					
					case "t0": {
					
					
					} break;
				
					case "t1": {
			 
						// TIME WITHIN 1 HOUR
						$date = date('H', strtotime('-2 hour'));
						 
						$query->set( 'date_query', 
							array(
								array(
									'hour'      => $date,
									'compare'   => '>=',
								),
								array(
									'hour'      => $date+2,
									'compare'   => '<=',
								),
								array(
									'year'  => date('Y'),
									'month' => date('m'),
									'day'   => date('d'),
								),
							)
						);
					
					} break;
					case "t2": {
					
						$query->set( 'date_query', 
							array(						
								array(
									'year'  => date('Y'),
									'month' => date('m'),
									'day'   => date('d'),
								),
							)
						);
					
					} break;
					case "t3": {
					
						$query->set( 'date_query', 
							array(						
								array(
									'year' => date( 'Y' ),
									'week' => date( 'W' ),
								),
							)
						);
						
					} break;					
					case "t4": {
					
						$query->set( 'date_query', 
							array(						
								array(
									'year' => date( 'Y' ),
									'month' => date( 'm' ),
								),
							)
						);
						
					} break;
					case "t5": {
					
						$query->set( 'date_query', 
							array(						
								array(
									'year' => date( 'Y' ),							 
								),
							)
						);
						
					} break;
					
					
					 
					
					// RELESTATE LTYPE SEARCH
					case "h1": {
					
						 $type = "ltype";
						 if(defined('WLT_COUPON')){
						 $type = "type";
						 }
					 
						 if(defined('WLT_COUPON')){
							$addon['ratingup']   = array(							 
								'relation'    => 'OR',												 
									'rating'    => array(
										'key' => $type,	
										'type' 			=> 'NUMERIC',
										'value' 		=> 1,
										'compare' 		=> '=',								 					 			
									),			 
									'rating1'   => array(
										'key'     => $type,							
										'compare' => 'NOT EXISTS',
														
									),																				
							);
						}else{
							$addon['ratingup']   = array(
								'key' 			=> $type,
								'type' 			=> 'NUMERIC',
								'value' 		=> 1,
								'compare' 		=> '=',							 														 			
							);
						}
						
					} break;	
					
					// RELESTATE LTYPE SEARCH
					case "h2": {
					$type = "ltype";
					 if(defined('WLT_COUPON')){
					 $type = "type";
					 }
						$addon['ratingup']   = array(
							'key' 			=> $type,
							'type' 			=> 'NUMERIC',
							'value' 		=> 2,
							'compare' 		=> '=',							 														 			
						);
						
						
					} break;	
					
					// RELESTATE LTYPE SEARCH
					case "h3": {
					$type = "ltype";
					 if(defined('WLT_COUPON')){
					 $type = "type";
					 }
						$addon['ratingup']   = array(
							'key' 			=> $type,
							'type' 			=> 'NUMERIC',
							'value' 		=> 3,
							'compare' 		=> '=',							 														 			
						);
						
						
					} break;
					 
					
				}
			
			}
			
			
				 
			}
			/////////////////////////////////////////////////////////////////
			
	 
			// GET SORT BY VALUE
			$sortby = isset( $_GET['sort'] ) ? esc_attr( $_GET['sort'] ) : _ppt('search_orderby');
			
			 
			// GET ORDER VALUE
			if(isset($_GET['order']) &&  in_array($_GET['order'], array("desc", "asc") ) ){
				$order 	= 	$_GET['order'];
			}else{
				$order 	=  	_ppt('search_order');
			} 
			 
			 
			// SETUP ARGS
			$args = array();
			
			switch($sortby){
			
				case "": {
				
				
				} break;
			
				case "ID": {
								
					$args['orderby'] 	= "ID";
					$args['order'] 		= $order;
					
				} break;
				
				case "post_title": 
				case "title": {
				
					$args['orderby'] 	= "title";
					$args['order'] 		= $order;
					
				} break;
				
				case "post_date":
				case "date": {
				
					$args['orderby'] 	= "date";
					$args['order'] 		= $order;
					
				} break;
				
				case "post_author":
				case "author": {

					$args['orderby'] 	= "post_author";
					$args['order'] 		= $order;
				
				} break;
				
				case "post_modified": {
				
					$args['orderby'] 	= "post_modified";
					$args['order'] 		= $order;
					
				} break;
				
				case "hits": {
				
					 $args['meta_query']   = array(	
					 				 
						'hits'    => array(
							'key' => 'hits',
							'type'    => 'NUMERIC',							 			
						),			 
					);
					
					$args['orderby'] 	= "hits";
					$args['order'] 		= $order;
				
				
				} break;				
				
				case "featured": {
				
					$args['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'featured'    => array(
								'key' => 'featured',
								'type'    => 'NUMERIC',								 			
							),			 
							'featured1'   => array(
								'key'     => 'featured',							
								'compare' => 'NOT EXISTS',
								'type'    => 'NUMERIC',	
												
							),						
						),	
					); 
					
					$args['orderby'] 	= "featured";
					$args['order'] 		= $order;
				
				
				} break; 
				
				case "ratingup": {		
									
					$args['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'rating'    => array(
								'key' => 'ratingup',							 			
							),			 
							'rating1'   => array(
								'key'     => 'ratingup',							
								'compare' => 'NOT EXISTS',
												
							),						
						),	
					); 
					
					$args['orderby'] 	= "ratingup";
					$args['order'] 		= $order;
				
				} break;
				
				case "rating": {		
									
					$args['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'rating'    => array(
								'key' => 'starrating',							 			
							),			 
							'rating1'   => array(
								'key'     => 'starrating',							
								'compare' => 'NOT EXISTS',
												
							),						
						),	
					); 
					
					$args['orderby'] 	= "rating";
					$args['order'] 		= $order;
				
				} break;
				
				case "price": {
				
				if(defined('WLT_AUCTION')){
				$hh = "price_current";
				}else{
				$hh = "price";
				}
				
					$args['meta_query']   = array(	
					
					'relation'    => 'AND',	
					
						array(
						 				 
							'price'    => array(
								'key'     => $hh,
								'type'    => 'NUMERIC',
								'compare' => 'EXISTS',
								//'value'   => ''				
							),			 
							 
						
						),		
					); 
					
					$args['orderby'] = 'price';
					$args['order'] 		= $order;					 
				
				} break;
				
				case "expires": {				
					 
					$args['orderby'] 	= "expirydate";
					$args['order'] 		= $order; 
				
				} break;
				
				case "expirydate": {
	 
					$args['meta_query']   = array(	
					 				 
						'expires'    => array(
							'key' => 'expiry_date',	
							'compare' => '>=',
							'value' => current_time( 'mysql' ),
							'type' => 'DATETIME'						 			
						),			 
					);
					
					$args['orderby'] 	= "expires";
					$args['order'] 		= $order; 
				
				} break;
				
				case "listingexpirydate": {
	 
					$args['meta_query']   = array(	
					 				 
						'expires'    => array(
							'key' => 'listing_expiry_date',	
							'compare' => '>=',
							'value' => current_time( 'mysql' ),
							'type' => 'DATETIME'						 			
						),			 
					);
					
					$args['orderby'] 	= "expires";
					$args['order'] 		= $order; 
				
				} break;
				
				case "dadob": {
	 
					$args['meta_query']   = array(	
					 				 
						'dadob'    => array(
							'key' => 'dadob',	
							'compare' => '<',
							'value' => current_time( 'mysql' ),
							'type' => 'DATETIME'						 			
						),			 
					);
					
					$args['orderby'] 	= "dadob";
					$args['order'] 		= $order; 
				
				} break;
				 
				
				case "newweek": {
						
					$args['date_query']= array(
						'date_query' => array(
							array(
								'year' => date( 'Y' ),
								'week' => date( 'W' ),
							),
						),
					);


				} break;
			}


			// ADVANCED SEARCH ADDON
			if ( $query->is_main_query() && isset( $_GET['advanced_search'] )) {
			 
				// GET FIELDS	
				$fields = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."core_search" );
				if ( $fields ) {				
				
					// PREPARE GET DATA
					$GET_VALUES_ARRAY = array();
					foreach($_GET as $key=>$val){
						$new_key = explode("--",$key);						 
						// CHECK IF IT EXISTS, IF SO ADD 1
						if (array_key_exists($new_key[0], $GET_VALUES_ARRAY)) {
							$GET_VALUES_ARRAY[$new_key[0]."-1"] = strip_tags($val); 
						}else{
							$GET_VALUES_ARRAY[$new_key[0]] = strip_tags($val); 
						} 
					}
					 
					foreach ($fields as $field) {
					
						$KEY = $field->key;
												 
						if($KEY != "" && isset($GET_VALUES_ARRAY[$KEY]) && $GET_VALUES_ARRAY[$KEY] != ""){
							$addon[$KEY] = array(
								'key' 		=> $KEY,
								'value' 	=> $GET_VALUES_ARRAY[$KEY],
								'type' 		=> $field->operator,
								'compare' 	=> $field->compare
							);
						 }
					 
									 
					}// end foreach	
					 	
				
				} 
			}// end if 
			  
			
			// FEATURED ONLY
			if(isset($_GET['featuredonly']) && is_numeric($_GET['featuredonly'])){				 
			 
				
				$addon['featuredonly']   = array(
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'featured'    => array(
								'key' 			=> 'featured',
								'type' 			=> 'NUMERIC',
								'value' 		=> 1,
								'compare' 		=> '=',								 			
							),			 
							'featured1'   => array(
								'key' 			=> 'featured',								
								'value' 		=> "yes",
								'compare' 		=> '=',	
												
							),						
						),	
					); 
						
			}
			
			
			// VERIFIED
			if(isset($_GET['verified']) && is_numeric($_GET['verified'])){				 
				$addon['verified']   = array(
					'key' 			=> 'verified',
					'type' 			=> 'NUMERIC',
					'value' 		=> 1,
					'compare' 		=> '=',							 														 			
				);			
			}
			
			// POWER SELLER
			if(isset($_GET['power']) && is_numeric($_GET['power'])){				 
				$addon['power']   = array(
					'key' 			=> 'powerseller',
					'type' 			=> 'NUMERIC',
					'value' 		=> 1,
					'compare' 		=> '=',							 														 			
				);			
			}	
			
			// NEW ITEMS
			if(isset($_GET['new']) && is_numeric($_GET['new'])){				 
				$addon['new']   = array(
					'key' 			=> 'condition',
					'type' 			=> 'NUMERIC',
					'value' 		=> 0,
					'compare' 		=> '=',							 														 			
				);			
			}
			
			// USED ITEMS
			if(isset($_GET['used']) && is_numeric($_GET['used'])){				 
				$addon['used']   = array(
					'key' 			=> 'condition',
					'type' 			=> 'NUMERIC',
					'value' 		=> 1,
					'compare' 		=> '=',							 														 			
				);			
			}
			
			// SHiP - DELIVERY
			if(isset($_GET['ship']) && is_numeric($_GET['ship'])){				 
				$addon['ship']   = array(
					'key' 			=> 'delivery',
					'type' 			=> 'NUMERIC',
					'value' 		=> 0,
					'compare' 		=> '=',							 														 			
				);			
			}
			
			// PUCKUP - DELIVERY
			if(isset($_GET['pickup']) && is_numeric($_GET['pickup'])){				 
				$addon['pickup']   = array(
					'key' 			=> 'delivery',
					'type' 			=> 'NUMERIC',
					'value' 		=> 1,
					'compare' 		=> '=',							 														 			
				);			
			} 
					
			// REFUNDS ONLY
			if(isset($_GET['refunds']) && is_numeric($_GET['refunds'])){				 
				$addon['refunds']   = array(
					'key' 			=> 'refunds',
					'type' 			=> 'NUMERIC',
					'value' 		=> 1,
					'compare' 		=> '=',							 														 			
				);			
			}		 
			
			// CITY	
			if(isset($_GET['country']) && strlen($_GET['country']) > 1 ){
			
				$addon["country"]   = array(							
					'key' => "map-country", 
					'value' => strip_tags($_GET['country']),
					'compare'=> 'LIKE'										
				);
			}
			// CITY	
			if(isset($_GET['city']) && strlen($_GET['city']) > 1 ){
			
				$addon["city"]   = array(							
					'key' => "map-city", 
					'value' => strip_tags($_GET['city']),
					'compare'=> 'LIKE'										
				);
			}
			if(isset($_GET['state']) && strlen($_GET['state']) > 1 ){
			
				$addon["state"]   = array(							
					'key' => "map-state", 
					'value' => strip_tags($_GET['state']),
					'compare'=> 'LIKE'										
				);
			}
			// CITY	
			if(isset($_GET['area']) && strlen($_GET['area']) > 1 ){
			
				$addon["area"]   = array(							
					'key' => "map-area", 
					'value' => strip_tags($_GET['area']),
					'compare'=> 'LIKE'										
				);
			}
			// CITY	
			if(isset($_GET['nei']) && strlen($_GET['nei']) > 1 ){
			
				$addon["nei"]   = array(							
					'key' => "map-neighborhood", 
					'value' => strip_tags($_GET['nei']),
					'compare'=> 'LIKE'										
				);
			}
			// DELIVERY WITHIN 24 HOURS	
			if(isset($_GET['delivery1'])  ){
			
				$addon["days"]   = array(							
					'key' 		=> "days", 
					'type' => 'NUMERIC',
					'value' 	=> 2,
					'compare'	=> '<'										
				);
			}
			if(isset($_GET['delivery2'])  ){
			
				$addon["days"]   = array(							
					'key' 		=> "days", 
					'type' => 'NUMERIC',
					'value' 	=> 7,
					'compare'	=> '<'										
				);
			}
			
			if(isset($_GET['delivery3'])  ){
			
				$addon["days"]   = array(							
					'key' 		=> "days", 
					'type' => 'NUMERIC',
					'value' 	=> 14,
					'compare'	=> '<'										
				);
			}
			
			if(isset($_GET['delivery4'])  ){
			
				$addon["days"]   = array(							
					'key' 		=> "days", 
					'type' => 'NUMERIC',
					'value' 	=> 30,
					'compare'	=> '<'										
				);
			}
			
			// SOLD ITEMS FOR MJ
			if(isset($_GET['sold']) && THEME_KEY == "mj"  ){
			
				$addon["sold"]   = array(							
					'key' 		=> "count_sold", 
					'type' => 'NUMERIC',
					'value' 	=> 0,
					'compare'	=> '>'										
				);
				
			}elseif(isset($_GET['sold']) && THEME_KEY == "at"  ){
			
				$addon["sold"]   = array(							
					'key' 		=> "auction_ended", 
					'value' 	=> "",
					'compare'	=> '!='										
				);
			}
			
			// BIDS FOR AUCTIO
			if(isset($_GET['bids'])  ){
			
				$addon["bids"]   = array(							
					'key' 		=> "bidstring", 					 
					'value' 	=> "",
					'compare'	=> '!='										
				);
			}
			
			// DISCOUNT
			if(isset($_GET['discount'])  ){
			
				$addon["discount"]   = array(							
					'key' 		=> "old_price", 					 
					'value' 	=> "0",
					'type' 		=> 'NUMERIC',
					'compare'	=> '>'										
				);
			}			
			
			// BEDROOMS
			if(isset($_GET['beds']) && is_numeric($_GET['beds']) ){			
				$addon["bed"]   = array(							
					'key' 		=> "bed", 					 
					'value' 	=> $_GET['beds'],
					'type' 		=> 'NUMERIC',
					'compare'	=> '='										
				);				
			}
			
			// BATHS
			if(isset($_GET['baths']) && is_numeric($_GET['baths']) ){			
				$addon["bbaths"]   = array(							
					'key' 		=> "baths", 					 
					'value' 	=> $_GET['baths'],
					'type' 		=> 'NUMERIC',
					'compare'	=> '='										
				);				
			}
			
			
			// TYPES FOR COUPON THEME
			if(THEME_KEY == "cp"){
			
				$ptypes = array();
				if(isset($_GET['cp1'])){			
				$ptypes[] = 1;
				}
				if(isset($_GET['cp2'])){			
				$ptypes[] = 2;
				}
				if(isset($_GET['cp3'])){			
				$ptypes[] = 3;
				}			 
			
				if(!empty($ptypes) && is_array($ptypes) ){				
						
					$addon["type"]   = array(							
						'key' 		=> "type", 					 
						'value' 	=> $ptypes,
						'type' 		=> 'NUMERIC',
						'compare'	=> 'IN'										
					);				
				}
				 

			
			}
			
			// TYPES FOR REAL ESTATE
			if(THEME_KEY == "rt"){
			
				$ptypes = array();
				if(isset($_GET['ptype1'])){			
				$ptypes[] = 1;
				}
				if(isset($_GET['ptype2'])){			
				$ptypes[] = 2;
				}
				if(isset($_GET['ptype3'])){			
				$ptypes[] = 3;
				}
				if(isset($_GET['ptype4'])){			
				$ptypes[] = 4;
				}
				if(isset($_GET['ptype5'])){			
				$ptypes[] = 5;
				}
				if(isset($_GET['ptype6'])){			
				$ptypes[] = 6;
				}
				if(isset($_GET['ptype7'])){			
				$ptypes[] = 7;
				}
			
				if(!empty($ptypes) && is_array($ptypes) ){				
						
					$addon["type"]   = array(							
						'key' 		=> "type", 					 
						'value' 	=> $ptypes,
						'type' 		=> 'NUMERIC',
						'compare'	=> 'IN'										
					);				
				}
			
			
				// TYPE FOR RT
				if(isset($_GET['1type1'])  ){				
					$addon["ltype"]   = array(							
						'key' 		=> "ltype",
						'value' 	=> "1",
						'compare'	=> '='										
					);
				}
				
				if(isset($_GET['1type2'])  ){				
					$addon["ltype"]   = array(							
						'key' 		=> "ltype",
						'value' 	=> "2",
						'compare'	=> '='										
					);
				}
			
			}
			 
			
			
			// PHONE FOR DT
			if(isset($_GET['phone'])  ){
			
				$addon["phone"]   = array(							
					'key' 		=> "phone",
					'value' 	=> "",
					'compare'	=> '!='										
				);
			}
			 
			
			// AMIENITITES
			if(isset($_GET['ami']) && is_array($_GET['ami']) ){
				foreach($_GET['ami'] as $j => $jj){
				$addon["ami"]   = array(							
					'key' => "amenities", 
					'value' => strip_tags($jj),
					'compare'=> 'LIKE'										
				);
				}
			}
			
			
			
			//orientation			 
			if(isset($_GET['orientation']) && is_numeric($_GET['orientation']) && THEME_KEY == "ph"  ){			
				$addon["orientation"]   = array(							
					'key' 		=> "orientation", 
					'type' 		=> 'NUMERIC',
					'value' 	=> $_GET['orientation'],
					'compare'	=> '='										
				);
			}
			
			if(isset($_GET['setup']) && is_numeric($_GET['setup']) && THEME_KEY == "ph"  ){			
				$addon["setup"]   = array(							
					'key' 		=> "setup", 
					'type' 		=> 'NUMERIC',
					'value' 	=> $_GET['setup'],
					'compare'	=> '='										
				);
			}
			if(isset($_GET['media']) && is_numeric($_GET['media']) && THEME_KEY == "ph"  ){		
			
				if($_GET['media'] == 2){
					
					$addon["media_type"]  = array(							
						'key' 		=> "media_type", 
						'type' 		=> 'NUMERIC',
						'value' 	=> $_GET['media'],
						'compare'	=> '='										
					);
					
				}else{			
				
					$addon["media_type"]  = array(							
						'key' 		=> "media_type", 
						'type' 		=> 'NUMERIC',
						'value' 	=> 2,
						'compare'	=> '!='										
					);
				}
				
			}
			
			
			// PRICE ADDON
			if(isset($_GET['type']) && is_numeric($_GET['type']) && $_GET['type'] > 0 ){
			
			 
	  			$addon["type-range"]   = array(							
										'key' => "type",
										'type' => 'NUMERIC',
										'value' => $_GET['type'],
										'compare'=> '='						
							);						 		
									
			}elseif(isset($_GET['type']) && is_array($_GET['type']) ){
			  
				$typeKey = "type";
			 
				$addon["type-range"]   = array(							
					'key' => $typeKey,
					'type' => 'NUMERIC',
					'value' => $_GET['type'],
					//'compare'=> 'LIKE'						
				);						 		
							
			}
			
			
			// PRICE ADDON
			if(isset($_GET['ltype']) && is_numeric($_GET['ltype']) && $_GET['ltype'] > 0 ){
	  			$addon["ltype"]   = array(							
										'key' => "ltype",
										'type' => 'NUMERIC',
										'value' => $_GET['ltype'],
										'compare'=> '='						
							);						 		
									
			}
			
			// PRICE ADDON
			if(isset($_GET['price']) && is_numeric($_GET['price']) && $_GET['price'] > 0 ){
				 
							$addon["price-single-range"]   = array(							
										'key' => "price",
										'type' => 'NUMERIC',
										'value' => array(0,$_GET['price']),
										'compare'=> 'BETWEEN'						
							);		
					 		 		
									
			}	// end if price search
			
			// PRICE ADDON
			if(isset($_GET['price1']) && is_numeric($_GET['price1'])  && isset($_GET['price2']) && is_numeric($_GET['price2']) && $_GET['price2'] > 0  ){
					if(!is_numeric($_GET['price2'])){ $_GET['price2'] = 100000; }
					
					if(THEME_KEY == "at"){ $key = "price_current"; }else{ $key = "price"; }
					
					 		$addon["price-range"]   = array(							
										'key' => $key,
										'type' => 'NUMERIC',
										'value' => array($_GET['price1'],$_GET['price2']),
										'compare'=> 'BETWEEN'						
							);
						 					 		
									
			}	// end if price search
			 
			// CUSTOM TAX QUERY FOR STORES AND CATEGORIES USING ID			 
			if(isset($_GET['catid']) && is_array($_GET['catid']) ){ 				 
					$args['tax_query'][] = array(
							'taxonomy' => "listing",
							'field' => 'term_id',
							'terms' => $_GET['catid'],
							'operator'=> 'IN'	,
							//'include_children' => true,						
					); 
					
			}elseif(isset($_GET['catid']) && is_numeric($_GET['catid']) ){ 	
						 
					$args['tax_query'][] = array(
							'taxonomy' => "listing",
							'field' => 'term_id',
							'terms' => array($_GET['catid']),
							'operator'=> 'IN'	,
							//'include_children' => true,						
					); 
			}
			
			// CUSTOM TAX QUERY FOR STORES AND CATEGORIES USING ID		 
			if(isset($_GET['stores']) && is_array($_GET['stores']) ){ 		
			 	 
					$args['tax_query'][] = array( 
							'taxonomy' => "store",
							'field' => 'term_id',
							'terms' => $_GET['stores'],
							'operator' => 'IN',
							//'include_children' => true,					
					);  
									 
			}
			
			// ADD-ON FOR CUSTOM CHECKBOXES 
			if(isset($_GET['color']) && is_array($_GET['color']) ){									 
				$args['tax_query'][] = array(
					'taxonomy' => 'color',											 
					'terms' => $_GET['color'],
					'operator' => 'IN'											 
				);							 			
			}
			// ONLINE
			if(isset($_GET['online'])){
				$addon['online']   = array(		 
					'online'    => array(
						'key' => 'online',	
						'type' => 'NUMERIC',
						'value' => 1,
						'compare' => '=',							 					 			
					),					 						 														 			
				);
			}
			
			// MAN LOOKING FOR MAN
			if(isset($_GET['seekm'])){
				$addon['seeking']   = array(		 
					'seeking'    => array(
						'key' => 'daseeking',	
						'type' => 'NUMERIC',
						'value' => 1,
						'compare' => '=',							 					 			
					),					 						 														 			
				);
			}
		 	if(isset($_GET['seekf'])){
				$addon['seeking']   = array(		 
					'seeking'    => array(
						'key' => 'daseeking',	
						'type' => 'NUMERIC',
						'value' => 2,
						'compare' => '=',							 					 			
					),					 						 														 			
				);
			}
			
			if(isset($_GET['gender']) && is_numeric($_GET['gender'])  ){
				if($_GET['gender'] != 0){
				$addon['gender']   = array(		 										 
				'gender'    => array(
					'key' => 'dagender',	
					'type' => 'NUMERIC',
					'value' => $_GET['gender'],
					'compare' => '=',							 					 			
				),					 						 														 			
				);
				}
			}
			
			if(isset($_GET['female'])   ){
				$addon['gender']   = array(		 										 
				'gender'    => array(
					'key' => 'dagender',	
					'type' => 'NUMERIC',
					'value' => 2,
					'compare' => '=',							 					 			
				),					 						 														 			
			);
			}
			if(isset($_GET['male'])   ){
				$addon['gender']   = array(		 										 
				'gender'    => array(
					'key' => 'dagender',	
					'type' => 'NUMERIC',
					'value' => 1,
					'compare' => '=',							 					 			
				),					 						 														 			
			);
			}
			
			// JOB TYPE			
			if(isset($_GET['jobft'])   ){
				$addon['jobtype']   = array(		 										 
				'jobtype'    	=> array(
					'key' 		=> 'jobtype',						 
					'value' 	=> "fulltime",
					'compare' 	=> '=',							 					 			
				),					 						 														 			
				);
			}
			if(isset($_GET['jobpt'])   ){
				$addon['jobtype']   = array(		 										 
				'jobtype'    	=> array(
					'key' 		=> 'jobtype',						 
					'value' 	=> "parttime",
					'compare' 	=> '=',							 					 			
				),					 						 														 			
				);
			}
			if(isset($_GET['jobcc'])   ){
				$addon['jobtype']   = array(		 										 
				'jobtype'    	=> array(
					'key' 		=> 'jobtype',						 
					'value' 	=> "contract",
					'compare' 	=> '=',							 					 			
				),					 						 														 			
				);
			}
			if(isset($_GET['jobii'])   ){
				$addon['jobtype']   = array(		 										 
				'jobtype'    	=> array(
					'key' 		=> 'jobtype',						 
					'value' 	=> "internship",
					'compare' 	=> '=',							 					 			
				),					 						 														 			
				);
			}
			if(isset($_GET['jobtt'])   ){
				$addon['jobtype']   = array(		 										 
				'jobtype'    	=> array(
					'key' 		=> 'jobtype',						 
					'value' 	=> "temporary",
					'compare' 	=> '=',							 					 			
				),					 						 														 			
				);
			}
			 
			// AGE
			if(isset($_GET['a1']) && is_numeric($_GET['a1']) && isset($_GET['a2']) && is_numeric($_GET['a2']) ){
			$addon['age']   = array(	 									 
				'age1'    => array(
					'key' => 'daage',	
					'type' => 'NUMERIC',
					'value' => array($_GET['a1'],$_GET['a2']),
					'compare' => 'BETWEEN',							 					 			
				),	 
				 );						
			}			 						 														 			
		
			
			// NEW STAR RATING ADDON
			if(isset($_GET['sr1'])  ){
				$addon['starrating1']   = array(
					'key' 			=> 'starrating',
					'type' 			=> 'NUMERIC',
					'value' 		=> 2,
					'compare' 		=> '<',							 														 			
				);		
		  	}
			if(isset($_GET['sr2'])  ){
				$addon['starrating2']   = array(											 
					'relation'    => 'AND',	
										 
						'rating2a'    => array(
							'key' 			=> 'starrating',
							'type' 			=> 'NUMERIC',
							'value' 		=> 2,
							'compare' 		=> '>=',								 					 			
						),			 
						'rating2b'   => array(
							'key' 			=> 'starrating',
							'type' 			=> 'NUMERIC',
							'value' 		=> 5,
							'compare' 		=> '<=',													
						),						 														 			
				);				
		  	}
			if(isset($_GET['sr3'])  ){
				$addon['starrating3']   = array(											 
					'relation'    => 'AND',	
										 
						'rating3a'    => array(
							'key' 			=> 'starrating',
							'type' 			=> 'NUMERIC',
							'value' 		=> 3,
							'compare' 		=> '>=',								 					 			
						),			 
						'rating3b'   => array(
							'key' 			=> 'starrating',
							'type' 			=> 'NUMERIC',
							'value' 		=> 5,
							'compare' 		=> '<=',													
						),						 														 			
				);				
		  	}
			if(isset($_GET['sr4'])  ){
				$addon['starrating4']   = array(											 
					'relation'    => 'AND',	
										 
						'rating4a'    => array(
							'key' 			=> 'starrating',
							'type' 			=> 'NUMERIC',
							'value' 		=> 4,
							'compare' 		=> '>=',								 					 			
						),			 
						'rating4b'   => array(
							'key' 			=> 'starrating',
							'type' 			=> 'NUMERIC',
							'value' 		=> 5,
							'compare' 		=> '<=',													
						),						 														 			
				);				
		  	}			 
			if(isset($_GET['sr5'])  ){
				$addon['starrating5']   = array(
					'key' 			=> 'starrating',
					'type' 			=> 'NUMERIC',
					'value' 		=> 4.9,
					'compare' 		=> '>',							 														 			
				);		
		  	}
			 
			
			// DO TAX QUERY			
			if(is_array(_ppt('searchtax'))){
			foreach($_GET as $k=>$h){
			if(substr($k,0,4) == "tax-"){
			 
					$args['tax_query'][] = array(
							'taxonomy' => substr($k,4),
							'field' => 'term_id',
							'terms' => array($_GET[$k]),
							'operator'=> 'IN'	,
							//'include_children' => true,						
					); 
			}
			}
			}
			 
			
			
		 
		 
		 /* NOTE TO SELF -REMOVED ADVANCED SEARCH CODE FROM HERE */
			
			
	
			// HOOK BOTH SETS OF DATA
			$args 	= hook_search_args($args);			
			$addon 	= hook_search_addons($addon); // NEED A LOOP?
			 
			// ATTACH TO MAIN QUERY
			if(!empty($addon)){
				
				if(!isset($args['meta_query']) || ( isset($args['meta_query'] ) && !is_array($args['meta_query']) )){ 
					$args['meta_query'] = array(); 
				}	
					
				$args['meta_query'] = array_merge($addon, $args['meta_query']);	
			
			}
			
			// ADD-ON FOR FAVORITES 
			if(isset($_GET['favs']) && is_numeric($_GET['favs']) ){ 
					
					$extn = "_list";
					if(defined('WP_ALLOW_MULTISITE')){
						$extn .= get_current_blog_id();
					}						 
					$my_list = get_user_meta($userdata->ID, 'favorite'.$extn,true);	
					
					if(is_array($my_list) && !empty($my_list)){			 
						$args['post_in'] =  $my_list;
					}else{
						$args['post_in'] =  array("99");
					}  
			}
			 
			// SHOW USER OSTS ONLY
			if(isset($_GET['uid']) && is_numeric($_GET['uid']) ){		
			 	  
				$query->set('author', $_GET['uid']);
				// SHOW ONLY PENDING ITEMS IF LOGGED IN AS THIS USER
				if(isset($userdata->ID) && $userdata->ID == $_GET['uid'] ){
					 $query->set('post_status', array("pending","publish","draft"));
					 $query->set( 'post_type', THEME_TAXONOMY.'_type' );
				}				 			
			}
			 
		  
			/////////////////////////////////////////////////////
			///////////////////////////////////////////////////// 
			 
			// SET SEARCH TYPES
			if(defined('WLT_COUPON') && isset($_GET['deals'])){
			$query->set( 'post_type', array("deal_type" ) ); 
			}else{
			$query->set( 'post_type', array("listing_type") ); 
			}
			 
			
			if ( isset($args['post_author'])  ) {
				$query->set('author', $args['post_author']);			
			}			 
			
			// CUSTOM POSTS IN
			if ( isset($args['post_in'])  ) {
				$query->set('post__in', $args['post_in']);			
			}
			 	
			// CHECK FOR META QUERY ARGS
			if(isset($args['meta_query'])){			
			$query->set( 'meta_query', $args['meta_query'] );
			} 
			
			// KEYWORD SEARCH ADD-ON
			/*			
			if(isset($_GET['s']) && !is_numeric($_GET['s']) && strlen($_GET['s']) > 1){
				$terms = explode(' ', $query->get('s') );			
				$args['tax_query'][] = array(
					'relation'=> 'OR',
					array(
						'taxonomy'=>'post_tag',
						'field'=>'slug',
						'terms'=> $terms
					)					
				);
			}*/
			 
			// CHECK FOR CUSTOM TAXONOMY
			if ( isset($args['tax_query'])  ) {
				$query->set( 'tax_query', $args['tax_query'] );
			}
			 
			// DATE QUERY
			if ( isset($args['date_query'])  ) {
				$query->set( 'date_query', $args['date_query'] );
			}
			
			 
			// CHECK FOR ORDERBY ARGS
			if(isset($args['orderby'])){			 
			$query->set( 'orderby',  $args['orderby'] );			
			}
			
			// CHECK FOR ORDER ARGS
			if(isset($args['order'])){				 
			$query->set( 'order',  $args['order'] );			
			}
			
			 
		}
		
		
	 	
		// RETURN MODIFIED QUERY
		return $query;
	}
	
	function distance_extra($orderby){
	
	if(isset($_GET['ft']) && is_array($_GET['ft']) && ( in_array("nm1", $_GET['ft']) || in_array("nm2", $_GET['ft']) ) ){ 
	 	
		if(in_array("nm1", $_GET['ft'])){ 	
		return "distance ASC";	
		}else{
		return "distance DESC";
		}	 
	}
	
	return $orderby;
	}
	
	
	// ADDITONAL SQL FOR QUERY
	function _distinct_sql( $val ) { global $wpdb;
	 
		// DEFAULTS
		if(isset($_SESSION['mylocation']['lat']) && strlen($_SESSION['mylocation']['lat']) > 0 && strlen($_SESSION['mylocation']['log']) > 0 ){				
			$lat = strip_tags($_SESSION['mylocation']['lat']);
			$log = strip_tags($_SESSION['mylocation']['log']);
		}else{				
			$lat = "0";
			$log = "0";
		}
		
		 return "DISTINCT $wpdb->posts.ID, IFNULL( 3956 * 2 * ASIN(SQRT( POWER(SIN((t1.meta_value - ".$lat." ) *  
		 pi()/180 / 2), 2) +COS(t1.meta_value * pi()/180) * COS(".$lat." * pi()/180) * POWER(SIN((t2.meta_value - ".$log.") * pi()/180 / 2), 2) )), 999999) as distance, ";
			
		//if(isset($_GET['zipcode']) && isset($_GET['radius']) && is_numeric($_GET['radius']) ){
		
		//return "DISTINCT"; 
		//}
		 
	 
		return $val;		
	}
	// WORDPRESS JOIN QUERY
	function query_join($arg) {
	global $wpdb, $query, $userdata; 
	  
		// ADD-ON BID APPLY
		if(isset($_GET['bidapply']) && $_GET['bidapply'] == 1){	
		$arg .= "INNER JOIN $wpdb->postmeta AS wlt1 ON (  $wpdb->posts.ID = wlt1.meta_value AND wlt1.meta_key = 'bida_".$userdata->ID."'  ) ";
		}	
		
		 
		// ADD-ON DISTANCE
		if(isset($_GET['ft']) && is_array($_GET['ft']) && ( in_array("nm1", $_GET['ft']) || in_array("nm2", $_GET['ft']) ) ){ 
 		
		 	// GET ZIPCODE
			if(isset($_SESSION['mylocation']) && isset($_SESSION['mylocation']['zip']) && strpos($_SESSION['mylocation']['zip'],"#") === false ){
			
			$thisZip = esc_attr($_SESSION['mylocation']['zip']);
			
			}elseif(isset($_GET['zipcode']) && strlen($_GET['zipcode']) > 1){
			
			$thisZip = esc_attr($_GET['zipcode']);
			
			}else{			
			// no code??			
			}
 			
			// SAVED ZIP DATA
			//$saved_searches = get_option('wlt_saved_zipcodes');
			
			//if(isset($saved_searches[$thisZip]) && strlen($saved_searches[$thisZip]['log']) < 1 && strlen($saved_searches[$thisZip]['lat']) < 1){			
					 		
			//}else{			 	
			 
				$arg .= "INNER JOIN $wpdb->postmeta AS wlt1 ON ( $wpdb->posts.ID = wlt1.post_id ) ";
				
				//if(isset($_GET['radius']) && is_numeric($_GET['radius']) && $_GET['radius'] > 0){
				//	$arg .= "INNER JOIN $wpdb->postmeta AS wlt2 ON ( $wpdb->posts.ID = wlt2.post_id ) ";
				//}	
			
			//} 
			
			// ADD-ON SWL
			$arg .= "INNER JOIN $wpdb->postmeta AS t1 ON ($wpdb->posts.ID = t1.post_id AND t1.meta_key = 'map-lat' ) ";
			$arg .= "INNER JOIN $wpdb->postmeta AS t2 ON ($wpdb->posts.ID = t2.post_id AND t2.meta_key = 'map-log') ";	
		}
		 
	return $arg; 	
	}
	
	// WORDPRESS WHERE QUERY
	function _posts_where($q){ global $wpdb; $GLOBALS['this_query_where'] = $q;	 $address = "";
 
		// DONT PERFORM ON ADMIN SEARCHES
		if(is_admin()){ return $q; }
		
		
	 	// SLOW QUERY REMOVE PRIVATE
		$q = str_replace("OR $wpdb->posts.post_status = 'private'","", $q);
				
		// THIS IS FOR THE KEYWORD / TAG SEARCH to WORK
		 
		//if(isset($_GET['s']) && !is_numeric($_GET['s']) && strlen($_GET['s']) > 1  ){ //&& strpos($mystring, $findme) === false
		//$q = str_replace("AND (("," AND (( $wpdb->posts.post_title NOT LIKE '' OR ", $q);
	   // } 
		 
		// FIX FOR LISTING WITH A SINGLE TITLE AND NOT FOUND IN SEARCH RESULTS
		$q = str_replace("$wpdb->posts.post_title LIKE '% %'","$wpdb->posts.post_title LIKE '%%'", $q);
		 
		
		// ADD-ON DISTANCE
		if(isset($_GET['ft']) && is_array($_GET['ft']) && ( in_array("nm1", $_GET['ft']) || in_array("nm2", $_GET['ft']) ) ){ 
	
				  $q .= " AND (   t1.post_id IS NULL   OR  t1.meta_key = 'map-lat' )"; 
				  $q .= " AND (   t2.post_id IS NULL   OR  t2.meta_key = 'map-log' )"; 		
		}
  
	 	// ADD-ON FOR AUTHOR SEARCHES
		if(isset($_GET['s']) && is_numeric($_GET['s']) ){
			$q .= " OR $wpdb->posts.ID ='".strip_tags($_GET['s'])."' 
			OR ( $wpdb->posts.post_author ='".strip_tags($_GET['s'])."' AND $wpdb->posts.post_type = '".THEME_TAXONOMY."_type' AND $wpdb->posts.post_status = 'publish' )";
		}
		
		 
		
		// ADD-ON FOR ZIPCODE SEARCHES
		if(isset($_GET['zipcode']) &&  strlen($_GET['zipcode']) > 2  ){  // && isset($_GET['radius']) && $_GET['radius'] > 0 
		
			// CLEANUP
			$thisZip = esc_attr($_GET['zipcode']);
			 
			// SAVED DATA
			$saved_searches = get_option('wlt_saved_zipcodes');
 			$range = 0; // range in KM	
			
			if(isset($_GET['radius']) && is_numeric($_GET['radius'])  && ( $_GET['radius'] > 0 )  ){  
			$range = $_GET['radius'];
			}
			
			if($range > 0){
						 
				if(isset($saved_searches[$thisZip]) && strlen($saved_searches[$thisZip]['log']) > 1 && strlen($saved_searches[$thisZip]['lat']) > 1){	
						
					$longitude 	= $saved_searches[$thisZip]['log'];
					$latitude 	= $saved_searches[$thisZip]['lat'];	
					if(isset($saved_searches[$thisZip]['address'])){
					$address 	= $saved_searches[$thisZip]['address'];	
					}
					
				}else{
					// INCLUDE COUNTRY IF AVAILABLE 
					$extra = "";
					if(isset($_GET['map-country'])){
					$extra = ", ".strip_tags($_GET['map-country']);
					}
					// REGION/LANGUAGE ADDONS
					$region = "us"; $lang = "en";
					if(isset($GLOBALS['CORE_THEME']['google_lang'])){
						$region = $GLOBALS['CORE_THEME']['google_region'];
						$lang = $GLOBALS['CORE_THEME']['google_lang'];
					}
					
					if($region != "us"){ $extra .= "+".$region; } 
					
					$geocode = wp_remote_fopen('https://maps.google.com/maps/api/geocode/json?address='. urlencode($thisZip.$extra) .'&sensor=false&region='.$region.'&language='.$lang.'&key='.trim(stripslashes(_ppt('googlemap_apikey'))));
					 
					$output = json_decode($geocode); 
					 
					 
					if(isset($output->error_message) && current_user_can('administrator')){	
					
						$GLOBALS['error_message'] = $output->error_message;
						
					}else{	
					
					if( isset($output->results[0]) ){
					
					$longitude =  $output->results[0]->geometry->location->lng;
					$latitude =  $output->results[0]->geometry->location->lat;
					$address =  $output->results[0]->formatted_address;
						
						// SAVE ONLY IF BOTH NOT EQUAL 0
						if($longitude == 0 && $latitude == 0){
						
						}else{ 		
						$saved_searches[$thisZip] = array("log" => $longitude, "lat" => $latitude, "address" => $address );		
						update_option('wlt_saved_zipcodes', $saved_searches);
						}
					
					}
					}
					
				}
				
				// save as globals
				$GLOBALS['search_google_lat'] 		= "";
				$GLOBALS['search_google_long'] 		= "";
				$GLOBALS['search_google_address'] 	= "";
				
				if(isset($latitude)){
				
				$GLOBALS['search_google_lat'] 		= $latitude;
				$GLOBALS['search_google_long'] 		= $longitude;
				$GLOBALS['search_google_address'] 	= $address;
				
				}
				 
				 
				/*** validate ***/
				if(isset($longitude) && is_numeric($longitude) && is_numeric($latitude)){				
					// Find Max - Min Lat / Long for Radius and zero point and query  
					$lat_range = $range/69.172;  
					 
					$lon_range = abs($range/(cos($latitude) * 69.172));  
					$min_lat = number_format($latitude - $lat_range, "4", ".", "");  
					$max_lat = number_format($latitude + $lat_range, "4", ".", "");  
					$min_lon = number_format($longitude - $lon_range, "4", ".", "");  
					$max_lon = number_format($longitude + $lon_range, "4", ".", "");  
					 
					//die("lat: ".$latitude." ($min_lat - $max_lat) / log:".$longitude." ($min_lon - $max_lon)");  
									
					$q .= "AND ( ( wlt1.meta_key = 'map-lat' AND wlt1.meta_value	BETWEEN  ".$min_lat." AND  ".$max_lat."	) ";					
					$q .= " AND ( wlt2.meta_key = 'map-log' AND wlt2.meta_value	BETWEEN  ".$min_lon." AND  ".$max_lon." ) ";
					$q .= " OR ( wlt2.meta_key = 'map-zip' AND wlt2.meta_value	= '".$thisZip."' 
					OR wlt2.meta_key =  'map-zip' AND wlt2.meta_value	= '".trim(chunk_split($thisZip, 3, ' '))."' ) ";			 
					$q .= " AND ( ( wlt2.post_id IS NULL OR wlt2.meta_key = 'map-zip' ) ) )";				 
				  		
					return $q;	
						
				}else{
				
				
					$q .= "AND (wlt1.meta_key = 'map-zip' AND wlt1.meta_value = ('".$thisZip."') 
					OR wlt2.meta_key = 'map-zip' AND wlt2.meta_value = ('".trim(chunk_split($thisZip, 4, ' '))."')	) ";
				 
				}
			
			}else{ // SAME ZIP ONLY
				$q .= "AND (wlt1.meta_key = 'map-zip' AND wlt1.meta_value = ('".$thisZip."') 
				OR wlt1.meta_key = 'map-zip' AND wlt1.meta_value = ('".trim(chunk_split($thisZip, 4, ' '))."')	) ";
			}
				
		} // end if	  		 
  

		return $q;	
	}
	

 
	
} // end class

?>