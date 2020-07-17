<?php


function _processcontactform(){ global $CORE;
 
// RANDOM NUMBERS
if(isset($_POST['action']) && $_POST['action'] == "singlecontactform"){ 
 
  		
		if(	isset($_POST['form']['message']) && strlen($_POST['form']['message']) > 1 ){
		
		$canContinue = true;
	 	if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != "" ){
		 $canContinue = google_validate_recaptcha();
		}
		
		if($canContinue){
		
			$message = "<br> ".__("Name","premiumpress")." : " . strip_tags($_POST['form']['name']) . " ".strip_tags($_POST['form']['name1']). "
						<br> ".__("Phone","premiumpress")." : " . strip_tags($_POST['form']['phone']) . "
						<br> ".__("Email","premiumpress")." : " . strip_tags($_POST['form']['email']) . "
						<br> ".__("Message","premiumpress")." : " . strip_tags($_POST['form']['message']) . "
						<br> ".__("Website","premiumpress")." : " . home_url() . "";
		
						
			if(isset($_POST['report']) && is_numeric($_POST['report']) ){
			
				$the_post = get_post($_POST['report']);
			
				$message .= "<p> ".strip_tags($_POST['report'])."  <a href='" .get_permalink($_POST['report']) ."'>".$the_post->post_title."</a></p>";
			
			}
		
			// SEND EMAIL			 					 
			$CORE->email_send( get_option('admin_email') , __("Contact Form","premiumpress"), $message);
			 
			// ERROR MESSAGE
			$GLOBALS['error_type'] 	= "success"; //ok,warn,error,info
			$GLOBALS['error_message'] 	=  __("Message Sent. Thank You.","premiumpress"); 
		
		}
	 
				
		}else{

			$GLOBALS['error_type'] 	= "danger"; //ok,warn,error,info
			$GLOBALS['error_message'] 	= __("Please complete all required fields.","premiumpress");		
			
		}

 
}


}

function menuaddondata(){ global $settings, $userdata, $wpdb;
 
         
		  ob_start(); ?>   
         
         <?php // LOGINS FOR MOBILE MENU ?>
         <li class="menu-item myaccount d-block d-sm-none">
           <?php if(!$userdata->ID){ ?>
                  <a href="<?php echo wp_login_url(); ?>">
                   <span><?php echo __("Sign up/in","premiumpress"); ?></span>
                  </a>
                  <?php }else{ ?>
                  <a href="<?php echo _ppt(array('links','myaccount')); ?>">               
                   <span><?php echo __("My Account","premiumpress"); ?></span>
                  </a>
                  <?php } ?>         
         </li>  
         <?php //} ?>
                
		 <?php if(THEME_KEY == "sp" || _ppt('display_basket') == 1 ){ ?>
         
         <li class="menu-item fullsmall">          
         <a href="<?php echo _ppt(array('links','cart')); ?>">
         <span><i class="fa fa-shopping-basket"></i>  <strong class="pr-2 d-block d-sm-none" style="display:inline-block"><?php echo __("My Basket","premiumpress"); ?></strong> (<span class="cart-basket-count"></span>)</span>
         </a>
         </li> 
         
         <?php } ?>
         
		 <?php if(THEME_KEY == "jb" && _ppt(array('links','apply')) != "" ){ ?>
         <li class="menu-item fullsmall">          
         <a href="<?php echo _ppt(array('links','apply')); ?>">
         <span><i class="fa fa-bookmark-o mr-2"></i>  <?php echo __("Job Center","premiumpress"); ?></span>
         </a>
         </li> 
         <?php } ?>
         <?php if(THEME_KEY == "mj" && _ppt(array('links','workdesk')) != ""){ 
		 
		 
// COUNT OPEN JOBS
$count = 0;
if($userdata->ID){
 $args = array(
                        'post_type' 		=> 'ppt_jobs',
                        'posts_per_page' 	=> 12,
                        'paged' 			=> 1,
                     	'post_status'		=> 'publish',
						'meta_query' => array(	
						'relation'    => 'AND',					
							array(							
							'relation'    => 'OR',											 
							'user1'    => array(
								'key' => 'buyer_id',
								'compare' => '=',
								'value' => $userdata->ID,							 			
							),			 
							'user2'   => array(
								'key'     => 'seller_id',							
								'compare' => '=',
								'value' => $userdata->ID,	
												
							),						
						),	
						),
                     );					
                     $wp_query2 = new WP_Query($args); 
                     
                     // COUNT EXISTING ADVERTISERS	 
                     $open = $wpdb->get_results($wp_query2->request, OBJECT);
$count = count($open);

}
		 
		 ?>
          <li class="menu-item">
            <a 
               <?php if($userdata->ID){ ?>
               href="<?php echo _ppt(array('links','workdesk')); ?>" 
               <?php }else{ ?>
               href="<?php echo wp_login_url(); ?>"
               <?php } ?>
               data-toggle="tooltip" data-placement="bottom" title="<?php echo __("My Work Desk","premiumpress"); ?>">
            	<i class="fa fa-briefcase"></i>
            
             <?php if($count > 0){ ?><span class="badge badge-warning badge-pill" style="    position: absolute;    top: 10px;    left: 30px;"><?php echo $count; ?></span><?php } ?>
            </a>
         </li>
         <?php } ?>
         
         
         
          <?php 
		  
		  // HEADER BUTTON
		  if(_ppt('header_button') == 1){ ?>
           <li class="menu-item buttonaddon">
           
                               
                   <button onclick="javascript:window.location='<?php if(isset($settings['btn_link'])){ echo $settings['btn_link']; }else{ echo _ppt(array('links','add')); } ?>'" 
                   class="<?php if(isset($settings['btn_class'])){ echo $settings['btn_class']; }else{ ?>btn <?php if(strpos($settings['class'], "primary") === false){ echo "btn-primary"; }else{ echo "btn-secondary"; } ?> ml-4 px-lg-4 rounded-0<?php } ?>" 
                   style="margin-top: -10px;"><?php if(isset($settings['btn_txt'])){ echo $settings['btn_txt']; }else{ echo stripslashes(_ppt('header_buttontext'));  } ?></button>
                  
                           
         </li> 
         <?php } ?> 
         
         <?php
		 $addon = ob_get_clean();		 
		 return $addon;

}

function _ppt_pageaccess(){ global $CORE, $post, $userdata; $canContinue = true;
 
	/*
		Check if the admin has setup page access
		and if so check we can access this page
			
	*/
	$access = get_post_meta($post->ID,'pageaccess',true); 
 	
	if($access == ""){ // EVERYONE CAN ACCESS
	
	}else{
		
		// CHECK USER HAS BASIC ACCOUNT
		$CORE->Authorize();
		
		// GET USER SUBSCRIPTION
		$f = get_user_meta($userdata->ID, 'wlt_subscription',true);	
		 
		if($access == "subs"){ // any subscription thats active
		 			 
			if(is_array($f)){			 		
				$da = $CORE->date_timediff($f['date_expires'],'');
				if($da['expired'] == 0){				  
				}else{				
					$canContinue = false;
				}
			}
		
		}else{ // unique subscription
		
			$f = get_user_meta($userdata->ID, 'wlt_subscription',true);	
			
			if(!is_array($f) || ( is_array($f) && !isset($f['key']) ) ){
			
			$canContinue = false; 
			
			}elseif(is_array($f)){
				$da = $CORE->date_timediff($f['date_expires'],'');
				if($da['expired'] == 0 && $f['key'] == $access){				  
				}else{				
					$canContinue = false;
				}			
			}
		}
		
		// end if	
		
		if(!$canContinue){
		
		if(strlen(_ppt('listingaccess_redirect')) > 5){
			header("location: "._ppt('listingaccess_redirect')."?noaccess=1");
			exit();	
		}else{
			header("location: "._ppt(array('links','myaccount'))."?noaccess=1");
			exit();		
		}

		}
		
		
		
		
		
	}// end access

}

function google_validate_recaptcha(){

 		 
		$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
            'body' => array(
                'secret'   =>  stripslashes(_ppt('google_recap_secretkey')),
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            )
        ) );
	 	
		if (!is_wp_error($response) && ($response['response']['code'] == 200)){
		
			$response_body = json_decode( $response['body'] );
			
			if ( empty( $response_body->success ) || ! $response_body->success ) {
				return false;
			}
			
			return true;
		
		}else{
			return false;
		}
}
 
/*
	this function will stop wordpress showing 404 pages
*/
function _ppt_check_pagetemplate_request($c){
 
return $c;
}
add_filter( 'template_include',  '_ppt_check_pagetemplate_request'  );
function _ppt_checkfile($filename){
 
 
 	if(!defined('THEME_FOLDER') || ( defined('THEME_FOLDER') && THEME_FOLDER == "" ) ){
	
		 global $pagenow;
		 
		 if($pagenow == "wp-login.php"){
		 
		 defined('WLT_CUSTOMLOGINFORM');
		 return;
		 
		 }else{
		
			include(get_template_directory()."/framework/installation.php");
		}
		
		return true;
	} 

	if(defined('WLT_DEMOMODE') && isset($GLOBALS['childtemplate']) && file_exists(WP_CONTENT_DIR."/themes/".$GLOBALS['childtemplate']."/".$filename) ){
	
		include(WP_CONTENT_DIR."/themes/".$GLOBALS['childtemplate']."/".$filename);
		
		return true; 

	}elseif(defined('CHILD_THEME_NAME') &&  file_exists(get_stylesheet_directory()."/".$filename) ){	 	
	 
		include(get_stylesheet_directory()."/".$filename);
		
		return true; 
	
	}elseif(!defined('WLT_DEMOMODE') && !defined('CHILD_THEME_NAME') && defined('THEME_FOLDER') && file_exists(THEME_PATH."/".THEME_FOLDER."/template/".$filename) ){
	 
		include(THEME_PATH."/".THEME_FOLDER."/template/".$filename);
		
		return true;	
	
	}elseif(defined('WLT_DEMOMODE') && !isset($_SESSION['skin']) && !defined('CHILD_THEME_NAME') && defined('THEME_FOLDER') && file_exists(THEME_PATH."/".THEME_FOLDER."/template/".$filename) ){
	 
		include(THEME_PATH."/".THEME_FOLDER."/template/".$filename);
		
		return true;			
 	
	}elseif(defined('THEME_FOLDER') &&  file_exists(THEME_PATH."/".THEME_FOLDER."/".$filename) ){	 	
	 
		include(THEME_PATH."/".THEME_FOLDER."/".$filename);
		
		return true; 
	
	}elseif(defined('THEME_FOLDER') &&  file_exists(THEME_PATH."/".THEME_FOLDER."/template/".$filename) ){	

		include(THEME_PATH."/".THEME_FOLDER."/template/".$filename);
		
		return true; 
	}
	
	return false;

}
function _ppt_theme_part($c){ global $post;
 
	// MUST BE IN TWO PARTS
	// 1. PATHS / 2. NAME //3. FORCE ($c[2]
 
	if(defined('THEME_FOLDER') ){		
		// CHECK IF CHILD THEME HAS THIS FILE
		// OTHERWISE LET THEME USE DEFAULT		
		if(defined('CHILD_THEME_NAME') && file_exists(get_stylesheet_directory()."/".$c[0]."-".$c[1].".php") ){
			return $c[0];	
		}else{ 
			 
			return constant('THEME_FOLDER')."/".$c[0];
		}
	}
	return $c[0];
}
/*
	this function returns the folder path
	for the correct file, fallback to theme
	default is no child theme variation found
*/
function _ppt_theme_folder($c, $force = false){ global $post;
 
	// MUST BE IN TWO PARTS
	// 1. PATHS / 2. NAME //3. FORCE ($c[2]	
	
	
	 	
	if( ( !is_array($c)  || ( isset($post->post_type) && $post->post_type != "listing_type" ) ) && !isset($c[2]) ){ return $c[0]; }
	
	 

	if(defined('THEME_FOLDER') ){		
		// CHECK IF CHILD THEME HAS THIS FILE
		// OTHERWISE LET THEME USE DEFAULT	
		 
		if(defined('IS_MOBILEVIEW') && ( $c[0] == "content" || $c[0] == "comments" ) ){
		
		return "_mobile/".$c[0];	
		
		}elseif(defined('WLT_DEMOMODE') && isset($GLOBALS['childtemplate']) && file_exists(WP_CONTENT_DIR."/themes/".$GLOBALS['childtemplate']."/".$c[0]."-".$c[1].".php") ){
		
		return $c[0];	
 
		}elseif(defined('CHILD_THEME_NAME') && file_exists(get_stylesheet_directory()."/".$c[0]."-".$c[1].".php") ){
		
			return $c[0];	
		
		}elseif(file_exists(THEME_PATH."/templates/".$c[0]."-".$c[1].".php") ){ // CHECK OUR PARTS FOLDER
 
			return "templates/".$c[0];			
		
		}elseif(file_exists(THEME_PATH.constant('THEME_FOLDER')."/template/".$c[0]."-".$c[1].".php") ){ 
		 
			return constant('THEME_FOLDER')."/template/".$c[0];
			
		}else{ 
			 
			return constant('THEME_FOLDER')."/".$c[0];
		}
	}
	return $c[0];
}
function _ppt($a){
  
	//if(!isset($GLOBALS['CORE_THEME'])){
	//
	//}else{
	//$core_data = $GLOBALS['CORE_THEME']; //get_option("core_admin_values");
	//}
	
	$core_data = get_option("core_admin_values");
	 
	
	if(is_array($a)){
 	
		if( isset($core_data[$a[0]][$a[1]]) ){
		 	
			if(is_string($core_data[$a[0]][$a[1]])){						
				return stripslashes($core_data[$a[0]][$a[1]]);				
			}else{
				return $core_data[$a[0]][$a[1]];
			}
					
		}else{		
			return "";		
		}
	
	}else{
	
		// DEMO EXTRAS
		if(defined('WLT_DEMOMODE') && isset($GLOBALS['CORE_THEME'][$a] )){
		 		 
			return $GLOBALS['CORE_THEME'][$a];		
		
		}elseif(isset($core_data[$a]) ){
		 
			if(is_string($core_data[$a])){							
				return stripslashes($core_data[$a]);
			}else{
				return $core_data[$a];
			}
			
		}else{		
			return "";		
		}	
	}
		 
}
/*
	this function is used throughout
	plugins and core for adding
	term values to existing taxonomies
*/
function _ppt_term_add($name, $tax, $parent = 0){
	
	// VALIUDATE
	if($name == ""){ return false; }
	
	// REGISTER IF DOESNT EXIST
	if(!taxonomy_exists($tax)){
	register_taxonomy( $tax, 'listing_type', array( 'hierarchical' => true, 'labels' =>'', 'query_var' => true, 'rewrite' => true ) ); 
	}
	
	if ( term_exists( $name , $tax ) ){	
	
			$term = get_term_by('slug', $name, $tax );		 
			$nparent  = $term->term_id;
			$saved_cats_array[] = $term->term_id;
				
	}else{
		
		$cat_id = wp_insert_term($name, $tax, array('cat_name' => $name, 'parent' => $parent ));
	 	 
		if(!is_object($cat_id) && isset($cat_id['term_id'])){
		
			$saved_cats_array[] = $cat_id['term_id'];
			$nparent = $cat_id['term_id'];
			
		}else{
		
			$nparent = $cat_id->term_id;
			
		}	 // end if	
		 
	} 
	
	return $nparent;

}

/* =============================================================================
[FRAMEWORK] LIST OF ALL HOOKS AND FILTERS
========================================================================== */

	// EXPIRY FUNCTIONS
	function hook_expire_listing_action($c){ return  apply_filters('hook_expire_listing_action', $c);  } // $postid
	
	
	// RELIST FUNCTIONS
	function hook_relist_listing_action($c){ return  apply_filters('hook_relist_listing_action', $c);  } // $postid
	
	// AUTHOR TOOLBOX
	function hook_can_delete_listing($c){ return  apply_filters('hook_can_delete_listing', $c);  } // $postid (return "stop")
	
	// AUTHOR TOOLBOX
	function hook_orderid($c){ return  apply_filters('hook_orderid', $c);  } // $postid (return "stop")
 
	
	// CURRENY CODES
	function hook_currency_code($c){ return  apply_filters('hook_currency_code', $c);  }  // takes no input
	function hook_currency_symbol($c){ return  apply_filters('hook_currency_symbol', $c);  } // takes no input
	
	// CHANGING THEME FOLDERS
	function hook_theme_folder($c){ return  apply_filters('hook_theme_folder', $c);  } // takes no input
	
	// HOOK LINKS
	function hook_affiliate_link($c){ return  apply_filters('hook_affiliate_link', $c);  } // takes no input
	
	// HOOK LINKS
	function hook_comments_before(){ return  do_action('hook_comments_before');  } // takes no input
	
	// HOOK NO RESULTS
	function hook_noresults(){ return  do_action(' hook_noresults');  } // takes no input
	
	// HOOK FOR NEW SEARCH ARGS
	function hook_search_args($c){ return  apply_filters('hook_search_args', $c);  } // takes no input
	function hook_search_addons($c){ return  apply_filters('hook_search_addons', $c);  } // takes no input
 	
	// FOOTER HOOKS
	function ppt_footer_styles(){ return  do_action('ppt_footer_styles');  } // takes no input
	
	// ACCOUNT PAGE
	function hook_account_userfields_after(){ return  do_action('hook_account_userfields_after');  } // takes no input
 
		 
/* =============================================================================
[FRAMEWORK] CORE FUNCTIONS
========================================================================== */

class framework_functions {



	/*
		this function creates a new database entry
		for logging user events
	*/	
	function ADDLOG($message='',$userid='',$postid='',$link='label-success', $type = "", $data = ""){ global $wpdb;
	
	
		if(is_array($data)){
		$data = $this->flatten($data);
		}
		
		$sql = 'INSERT INTO  '.$wpdb->prefix.'core_log (`datetime` ,`userid` ,`postid` ,`link` ,`message`, type, data)
		VALUES ( "'.$this->DATETIME().'",  "'.$userid.'",  "'.$postid.'",  "'.esc_sql($link).'",  "'.esc_sql($message).'", "'.$type.'", "'.addslashes($data).'");';
		$wpdb->query($sql);
	
	}
	
	function flatten(array $array) {
    $return = array();
    array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
    return $return;
	}
	
	/*
		This function gets the difference between dates
		returns in different formats
	*/
	function date_timediff($end_date, $start_date = '' ){ global $CORE;
			
			if($end_date == ""){ $end_date = date("Y-m-d H:i:s", strtotime( current_time( 'mysql' ) . " - 1 days") ); } // default is expired
			if($start_date == ""){ $start_date = current_time( 'mysql' ); } // default is now
			
			// REQUIRE DATE DIFF
			if(!function_exists('date_diff')){
				//return $this->format_date($end_date);
				echo "This theme required PHP date_diff enabled. Please contact your hosting provider to enable it.";
				return;
			}
			 
			
			// MAKE SURE ITS A DATE STRING		
			$end_date = date( "Y-m-d H:i:s", strtotime( $end_date ) ); 
			 	 
			// GET DATE DIF PARTS
			$intervalo = date_diff(date_create($start_date), date_create($end_date));
		 
		   	// TRANSLATION
			$out = $intervalo->format(__("Years","premiumpress").":%Y,".__("Months","premiumpress").":%M,".__("Days","premiumpress").":%d,".__("Hours","premiumpress").":%H,".__("Minutes","premiumpress").":%i,".__("Seconds","premiumpress").":%s");
			
			$out_small = $intervalo->format(__("Yrs","premiumpress").":%Y,".__("months","premiumpress").":%M,".__("days","premiumpress").":%d,".__("hrs","premiumpress").":%H,".__("mins","premiumpress").":%i,".__("Seconds","premiumpress").":%s"); //,".__("s","premiumpress").":%s"
			
			// BUILD DATA
			$v1 = explode(',',$out); $a_out = array();   $lastValue = "";
			 
	 		
			// LOOP FOR PARTS
			foreach($v1 as $k){
				$g = explode(":",$k);
				$a_out[$g[0]] = $g[1];
			}			
		 
			// ELSE CREATE DISPLAY
			$string = "  "; $returnstring = "";
	 
			foreach($a_out as $key => $val){ 
				$canShow = true;			
				// SKIP FOR STRING
				if(is_array($returnstring) && !in_array($key, $returnstring)){ continue; }				 
				if($val != "00" && $val != ""){				  
					
					
					// CHOP OF SECONDS OF MINUTES IS SET				 
					if($key == __("Seconds","premiumpress") && $lastValue > 0){
					continue;
					}
					
					// LOOP SO LAST VALUE WOULD BE THE ONE BEFORE
					$lastValue = $val;				 
					
					$string .= "".str_replace("01","1", str_replace("02","2", str_replace("03","3", 
					str_replace("04","4", str_replace("05","5", str_replace("07","7", str_replace("08","8",
					str_replace("09","9",str_replace("06","6",$val)))))))))." ".$key." ";	
									
					 				
				}
			} 
			 
			
			// BUILD DATA
			$v1 = explode(',',$out_small); $b_out = array(); $daysleft = 0;  $lastValue = "";
	 		
			// LOOP FOR PARTS
			foreach($v1 as $k){
				$g = explode(":",$k);
				$b_out[$g[0]] = $g[1];
			}			
		 
			// ELSE CREATE DISPLAY
			$string_small = "  "; $returnstring = "";
	 		
			$i=1;
			foreach($b_out as $key => $val){ 
				$canShow = true;			
				 
					// DAYS
					if($i == 1){ // ASSUME LOOP 1 IS YEARS
					
					$daysleft += $val*365;
					}elseif($i == 2){ // 2 IS MONTHS
					$daysleft += $val*30;
					}elseif($i == 3){ // DAYS
					$daysleft += $val;
					}
					 
					$i++;
				
				
				// SKIP FOR STRING
				if(is_array($returnstring) && !in_array($key, $returnstring)){ continue; }				 
				if($val != "00" && $val != ""){			
				
					  
					// CHOP OF SECONDS OF MINUTES IS SET				 
					if($key == __("Seconds","premiumpress") && $lastValue > 0){
					continue;
					}
					
					if($key == __("mins","premiumpress") && $lastValue > 0){
					continue;
					}
					
					if($key == __("hrs","premiumpress") && $lastValue > 0){
					continue;
					}
					
					if($key == __("days","premiumpress") && $lastValue > 0){
					continue;
					}
					
					if($key == __("months","premiumpress") && $lastValue > 0){
					continue;
					}
					
					// LOOP SO LAST VALUE WOULD BE THE ONE BEFORE
					$lastValue = $val;			 
					
					$string_small .= "".str_replace("01","1", str_replace("02","2", str_replace("03","3", 
					str_replace("04","4", str_replace("05","5", str_replace("07","7", str_replace("08","8",
					str_replace("09","9",str_replace("06","6",$val)))))))))." ".$key." ";	
					 
									
				}
			} 
			 
			// BUILD DAYS STRING			
			//$days = $vv['date_array']['days']+($vv['date_array']['months']*30)+($vv['date_array']['years']*365);
			 
			 
			// CHECK IF EXPIRED
			if( strtotime($end_date) > strtotime(current_time( 'mysql' ))  ){			
				// ITS EXPIRED
				$expired = 0;
			}else{
				// NOT EXPIRED
				$expired = 1;
			} 
			
			// RETURN ARRAY OF PARTS
			$array = array_change_key_case($a_out, CASE_LOWER); 
			
			// CLEAN UP
			$string_small = str_replace("1 ".__("days","premiumpress"), "1 ".__("day","premiumpress"), $string_small);	
			$string_small = str_replace("1 ".__("mins","premiumpress"), "1 ".__("min","premiumpress"), $string_small);	
			$string_small = str_replace("1 ".__("hours","premiumpress"), "1 ".__("hour","premiumpress"), $string_small);	
			$string_small = str_replace("1 ".__("months","premiumpress"), "1 ".__("month","premiumpress"), $string_small);	
			
			
			// RETURN STRING
			return array(
			"string-small" => $string_small, 
			"string" => $string, 
			"expired" => $expired, 
			"date_array" => $array, 
			"test_start" => $start_date, 
			"test_end" => $end_date, 
			"days-left" => $daysleft 
			);
			
	}

















	/* =============================================================================
	  COUNT USER POSTS
	   ========================================================================== */
	
	function count_user_posts_by_type( $userid, $post_type = 'post', $EXTRA = "", $include_membershipdate = true ) {
		global $wpdb, $userdata;
	
		$where = get_posts_by_author_sql( $post_type, true, $userid );
		
		// CHECK IF USER IS ASSIGNED TO A MEMBERSHIP AND SO ONLY COUNT LISTINGS AFTER THEIR MEMBERSHIP WAS ASSIGNED
		if($userid == $userdata->ID && $include_membershipdate){
			
			$mem_startdate = get_user_meta($userid, 'wlt_membership_started', true);
			if(strlen($mem_startdate) > 1){
				$where .= " AND post_date > '".$mem_startdate."'";
			}
		
		}
		
		// ADD IN PENDING LISTINGS TOO
		
		$where = str_replace("post_status = 'publish'","post_status = 'publish' OR post_status = 'pending'", $where);
	 
		$count = $wpdb->get_var( "SELECT COUNT(*) FROM ".$wpdb->prefix."posts $where $EXTRA" );
		
	 
		return apply_filters( 'get_usernumposts', $count, $userid );
	}
	
	/* =============================================================================
	   COUNT USER META SYSTEM
	   ========================================================================== */
	function COUNTUSER($key,$val,$extra=true){ global $wpdb, $core, $userdata;
		if($key == ""){ return 0; }
		$SQL = "SELECT count(*) AS total FROM  $wpdb->usermeta AS mt2
		WHERE mt2.meta_key = '".$key."'";
		if(!is_array($val) && strlen($val) > 0){
			if($extra){
			$SQL .= "  AND mt2.meta_value = '".$val."'";
			}else{
			$SQL .= "  AND mt2.meta_value != '".$val."'";
			}
		}elseif(is_array($val)){
			foreach($val as $k){
			if($extra){
			$SQL .= "  AND mt2.meta_value = '".$k."'";
			}else{
			$SQL .= "  AND mt2.meta_value != '".$k."'";
			}
			}	
		} 
		 
		$result = $wpdb->get_results($SQL);
		return $result[0]->total;
	}
	/* =============================================================================
	   COUNT LISTING DATA SYSTEM
	   ========================================================================== */
	function COUNT($key,$val,$extra=true){ global $wpdb, $core, $wp_query, $userdata; $skey = "";	
		
		return 0;
	}
 
	
	/* =============================================================================
		 CURENT PAGE URL
		========================================================================== */	
	
	function curPageURL() { 
	
		$pageURL = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
		$pageURL .= $_SERVER['SERVER_PORT'] != '80' ? $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"] : $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	
		return htmlentities($pageURL);
	}	
	
	/* =============================================================================
		 DATE FORMATTING
		========================================================================== */
	
	function DATETIME($extratime = ""){
	 
		if($extratime !=""){
		return date('Y-m-d H:i:s', strtotime(current_time( 'mysql' ) . $extratime) );
		}else{
		return date('Y-m-d H:i:s', strtotime(current_time( 'mysql' )) );
		}
		
	}
	function DATE($date){
		global $wpdb;
		if($date == "" || is_array($date) ){return; }	
			
		$date_format = get_option('date_format') . ' ' . get_option('time_format');		
		 
		return mysql2date($date_format,$date);
	}
	

	/* =============================================================================
		 DATE FORMATTING
		========================================================================== */
	
	function format_date($date){
	return mysql2date(get_option('date_format') . ' ' . get_option('time_format'),  $date, false);
	}
	
	/* =============================================================================
	  Time Difference (now and date entered) / V7 / 25th Feb 
	   ========================================================================== */
	 

	
	/* =============================================================================
		GET CLIENT IP
		========================================================================== */
		
	function get_client_ip(){
			if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])){
				  return $_SERVER['HTTP_CLIENT_IP'];
			}
			if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				  return strtok($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
			}
			if (isset($_SERVER['HTTP_PROXY_USER']) && !empty($_SERVER['HTTP_PROXY_USER'])){
				  return $_SERVER['HTTP_PROXY_USER'];
			}
			if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])){
				  return $_SERVER['REMOTE_ADDR'];
			}else{
				  return "invalid";//"0.0.0.0";
			}
	}
	
/*
	this function sorts an array 
	by the required key
*/
function multisort($array, $sort_by) {
 
 		if(!is_array($array)){ return; }
		$estr = '';
		
		foreach ($array as $key => $value) {
			$estr = '';
			foreach ($sort_by as $sort_field) {
				if(isset($value[$sort_field])){
					$tmp[$sort_field][$key] = $value[$sort_field];	
					$estr .= '$tmp[\'' . $sort_field . '\'], ';
				}
			}
		}
		
		$estr .= '$array';
		$estr = 'array_multisort(' . $estr . ');';
		eval($estr);
	
		return $array;
}
function multisortkey($array, $skey, $svalue){

	if(!is_array($array)){ return; }
	foreach ($array as $key => $value) {
		if($svalue == $value[$skey]){
			return $key;
		} // end if
	}// end foreach
}
	 
	
}




class ppt_csv_import
{
  var $table_name; //where to import to
  var $file_name;  //where to import from
  var $use_csv_header; //use first line of file OR generated columns names
  var $field_separate_char; //character to separate fields
  var $field_enclose_char; //character to enclose fields, which contain separator char into content
  var $field_escape_char;  //char to escape special symbols
  var $error; //error message
  var $arr_csv_columns; //array of columns
  var $table_exists; //flag: does table for import exist
  var $encoding; //encoding table, used to parse the incoming file. Added in 1.5 version
  
  function __construct($file_name=""){
  $this->file_name = $file_name;
    $this->arr_csv_columns = array();
    $this->use_csv_header = false;
    $this->field_separate_char = ",";
    $this->field_enclose_char  = "\"";
    $this->field_escape_char   = "\\";
    $this->table_exists = false;
  }
  
   
  
  function countrows($table_and_query){ global $wpdb;
  
    $total = $wpdb->get_var("SELECT COUNT(*) FROM $table_and_query"); 

	if(empty($total)){
	return 0;
	} 
    return $total;  
  
  }  
  function cleanup($table_name){ global $wpdb; 
  	$wpdb->query("DELETE  FROM ".$table_name." WHERE post_title = '' OR post_title IS NULL OR CHAR_LENGTH(post_title) <= 5");   
  
  }
  
  function import_old(){
  
  	set_time_limit(0);
  
	// READ THE FILE
	$handle = fopen(mysql_escape_string($this->file_name), 'r');
	// GET TITLES
	$titles = fgetcsv($handle,1000,$delimiter);
	die(print_r($titles));
	  
  
  }
  function import()  { global $wpdb;
  
    if($this->table_name=="")
      $this->table_name = "temp_".date("d_m_Y_H_i_s");
	 
   
    $this->table_exists = false;
    $this->create_import_table();
	 
  
    if(empty($this->arr_csv_columns))
      $this->get_csv_header_fields();
    
    /* change start. Added in 1.5 version */
    if("" != $this->encoding && "default" != $this->encoding){
      $this->set_encoding();
	}
    /* change end */ 
 	
    if($this->table_exists)    {
	
	$wpdb->show_errors     = true;
        $wpdb->suppress_errors = false;
	
      $sql = "LOAD DATA LOCAL INFILE '".@mysql_escape_string($this->file_name).
             "' INTO TABLE `".$this->table_name.
             "` CHARACTER SET ".str_replace("-","",$this->encoding)." FIELDS TERMINATED BY '".@mysql_escape_string($this->field_separate_char).
             "' OPTIONALLY ENCLOSED BY '".@mysql_escape_string($this->field_enclose_char).
             "' ESCAPED BY '".@mysql_escape_string($this->field_escape_char).
             "' ".
             ($this->use_csv_header ? " IGNORE 1 LINES " : "")
             ."(`".implode("`,`", $this->arr_csv_columns)."`)";
			 
			 //die($sql);
    
	  	// RUN AND CHECK FOR ERRORS
	    if ($wpdb->query($sql) === FALSE) {
		  die('error=' . var_dump($wpdb->last_query) . ',' . var_dump($wpdb->error));
		}
	 
	 
    }
	$this->cleanup($this->table_name);
	
	// SAVE AN ENTRY FOR THE FILE NAME
	$csv_files = get_option("wlt_csv_filenames");
	if(!is_array($csv_files)){ $csv_files = array(); }
	$csv_files[$this->table_name] = array("name" => $_FILES['file_source']['name'], "location" => $this->file_name);
	update_option("wlt_csv_filenames", $csv_files);
	
	// RETURN
	return $this->table_name;
  }
  
  //returns array of CSV file columns
  function get_csv_header_fields()
  {
    $this->arr_csv_columns = array();
    $fpointer = fopen($this->file_name, "r");
    if ($fpointer)
    {
 
      $arr = fgetcsv($fpointer, 10*1024, $this->field_separate_char);
      if(is_array($arr) && !empty($arr))
      {
        if($this->use_csv_header)
        {
          foreach($arr as $val)
            if(trim($val)!="")
              $this->arr_csv_columns[] = $val;
        }
        else
        {
          $i = 1;
          foreach($arr as $val)
            if(trim($val)!="")
              $this->arr_csv_columns[] = "column".$i++;
        }
      }
      unset($arr);
      fclose($fpointer);
    }
    else
      $this->error = "file cannot be opened: ".(""==$this->file_name ? "[empty]" : @mysql_escape_string($this->file_name));
    return $this->arr_csv_columns;
  }
  
  function create_import_table() { global $wpdb;
  
    $sql = "CREATE TABLE IF NOT EXISTS ".$this->table_name." (";
    
    if(empty($this->arr_csv_columns))
      $this->get_csv_header_fields();
    
    if(!empty($this->arr_csv_columns))
    {
      $arr = array();
      for($i=0; $i<sizeof($this->arr_csv_columns); $i++)
          $arr[] = "`".$this->arr_csv_columns[$i]."` TEXT";
      $sql .= implode(",", $arr);
      $sql .= ")";
	  
	  //die($sql."<--reate_import_tab");
	  
	   $res = $wpdb->query($sql);

      $this->error = mysql_error();
      $this->table_exists = ""==mysql_error();
    }
 	
  }
  
  /* change start. Added in 1.5 version */
  //returns recordset with all encoding tables names, supported by your database
  function get_encodings()  { global $wpdb;
  
    $rez = array();
    $sql = "SHOW CHARACTER SET";
    $res = $wpdb->query($sql);
    if(mysql_num_rows($res) > 0)
    {
      while ($row = mysql_fetch_assoc ($res))
      {
        $rez[$row["Charset"]] = ("" != $row["Description"] ? $row["Description"] : $row["Charset"]); //some MySQL databases return empty Description field
      }
    }
    return $rez;
  }
  
  //defines the encoding of the server to parse to file
  function set_encoding($encoding="")  { global $wpdb;
    if("" == $encoding)
      $encoding = $this->encoding;
    $sql = "SET SESSION character_set_database = '" . $encoding."' "; //'character_set_database' MySQL server variable is [also] to parse file with rigth encoding
	$res = $wpdb->query($sql);
    return mysql_error();
  }
  /* change end */

}

// holds soem methods used for handling errors.
class data_export_error_handling {
	
	// mimics the errors from php, also shows the correct line numbers.
	protected function custom_error($msg){
		if (ini_get('display_errors') && error_reporting() > 0){
			$info		= next(debug_backtrace());
			$prepend	= ini_get('error_prepend_string');
			$append		= ini_get('error_append_string');
			
			if (empty($prepend) === false) echo $prepend;
			
			echo "Warning: {$msg} in {$info['file']} on line {$info['line']}";
			
			if (empty($append) === false) echo $append;
		}
	}
	
}
class ppt_csv_export extends data_export_error_handling {
	
	// holds the data to be exported.
	private $data				= null;
	
	// holds the value of the constant chosen from the below (defaults to csv).
	private $export_mode		= 4;
	
	// the available modes, because json may not be available.
	private $available_modes	= null;
	
	// these determine the export type.
	const EXPORT_AS_XML			= 0;
	const EXPORT_AS_JSON		= 1;
	const EXPORT_AS_SERIALIZE	= 2;
	const EXPORT_AS_CSV			= 3;
	const EXPORT_AS_EXCEL		= 4;
	
	// loads the data.
	public function __construct($data){
		if (is_object($data)){
			$this->data = get_object_vars($data);
		}else if (is_array($data)){
			$this->data = $data;
		}else{
			$this->custom_error('ppt_csv_export::__construct(): The supplied argument must be either an object or an array.');
		}
		
		$this->available_modes = array();
			
		$this->available_modes[] = self::EXPORT_AS_XML;
		
		if (is_callable('json_encode')){
			$this->available_modes[] = self::EXPORT_AS_JSON;
		}
		
		$this->available_modes[] = self::EXPORT_AS_SERIALIZE;
		$this->available_modes[] = self::EXPORT_AS_CSV;
		$this->available_modes[] = self::EXPORT_AS_EXCEL;
	}
	
	// gets an array of available export modes.
	public function get_available_export_modes(&$result){
		$result = $this->available_modes;
		
		return true;
	}
	
	// sets the export mode to one of the given constants.
	public function set_mode($mode){
		if (in_array($mode, $this->available_modes) === false){
			$this->custom_error('ppt_csv_export::set_mode(): The selected export mode is not available.');
			return false;
		}
		
		$this->export_mode = $mode;
		return true;
	}
	
	// exports the data as xml.
	private function export_as_xml(){
		$xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
		$xml .= "<document>\n";
		
		foreach ($this->data as $data){
			if (is_array($data)){
				$xml .= "\t<entry>\n";
				
				foreach ($data as $key => $val){
					while (is_array($val)){
						$val = $val[0];
					}
					
					$key = htmlspecialchars($key);
					$val = htmlspecialchars($val);
					
					$xml .= "\t\t<{$key}>{$val}</{$key}>\n";
				}
				
				$xml .= "\t</entry>\n";
			}else{
				$data = htmlspecialchars($data);
				$xml .= "\t<entry>{$data}</entry>\n";
			}
		}
		
		$xml .= '</document>';
		
		return $xml;
	}
	
	// exports the data as a json encoded string.
	private function export_as_json(){
		return json_encode($this->data);
	}
	
	// exports the data as serialized string.
	private function export_as_serialize(){
		return serialize($this->data);
	}
	
	// exports the data as csv.
	private function export_as_csv(){
		$headings = array_keys($this->data[0]);
		
		foreach ($headings as &$heading){
			$heading = str_replace('"', '""', trim($heading));
		}
		
		$csv = '"' . implode('","', $headings) . "\"\r\n";
		
		foreach ($this->data as $data){
			$data = (is_array($data)) ? array_values($data) : array($data);
			
			foreach ($data as &$entry){
				while (is_array($entry)){
					$entry = $entry[0];
				}
				
				if (is_numeric($entry) === false){
					$entry = '"' . str_replace('"', '""', trim($entry)) . '"';
				}
			}
			
			$csv .= implode(',', $data) . "\r\n";
		}
		
		return $csv;
	}
	
	// exports the data as excel xls format.
	private function export_as_excel(){
		$xls = pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
		
		$xls_data = array(array_keys($this->data[0]));
		
		foreach ($this->data as $data){
			$xls_data[] = (is_array($data)) ? array_values($data) : array($data);
		}
 
		foreach ($xls_data as $row => $data){
			foreach ($data as $col => $entry){
				if (is_numeric($entry)){
					$xls .= pack("sssss", 0x203, 14, $row, $col, 0x0);
					$xls .= pack("d", $entry);
				}else{
					$len = strlen($entry);
					
					$xls .= pack("ssssss", 0x204, 8 + $len, $row, $col, 0x0, $len);
					$xls .= $entry;
				}
			}
		}
		
		$xls .= pack("ss", 0x0A, 0x00);
		
		return $xls;
	}
	
	// calls the appropriate method to export the data.
	public function export(&$result){
		if (empty($this->data)){
			$this->custom_error('ppt_csv_export::export(): Data array cannot be empty.');
			return false;
		}
		
		if ($this->export_mode === self::EXPORT_AS_XML){
			$result = $this->export_as_xml();
		}else if ($this->export_mode === self::EXPORT_AS_JSON){
			$result = $this->export_as_json();
		}else if ($this->export_mode === self::EXPORT_AS_SERIALIZE){
			$result = $this->export_as_serialize();
		}else if ($this->export_mode === self::EXPORT_AS_CSV){
			$result = $this->export_as_csv();
		}else if ($this->export_mode === self::EXPORT_AS_EXCEL){
			$result = $this->export_as_excel();
		}else{
			$result = null;
			return false;
		}
		
		return true;
	}
}
function CSV_IMPORT_ENCODING() {
switch ( strtolower( DB_CHARSET ) ) {
                                case 'latin1':
                                        $encoding = 'ISO-8859-1';
                                        break;
                                case 'utf8':
                                case 'utf8mb4':
                                        $encoding = 'UTF8';
                                        break;
                                case 'cp866':
                                        $encoding = 'cp866';
                                        break;
                                case 'cp1251':
                                        $encoding = 'cp1251';
                                        break;
                                case 'koi8r':
                                        $encoding = 'KOI8-R';
                                        break;
                                case 'big5':
                                        $encoding = 'BIG5';
                                        break;
                                case 'gb2312':
                                        $encoding = 'GB2312';
                                        break;
                                case 'sjis':
                                        $encoding = 'Shift_JIS';
                                        break;
                                case 'ujis':
                                        $encoding = 'EUC-JP';
                                        break;
                                case 'macroman':
                                        $encoding = 'MacRoman';
                                        break;
                                default:
                                        $encoding = 'UTF8';                                        
                        }
             
                return $encoding;
}

function upload_massimport(){ global $wpdb; 
 
	if(isset($_FILES['core_attachments']) && !empty($_FILES['core_attachments']) ) {
	

		// Create post object
		$my_post = array(
		  'post_title'    => $_POST['title'],
		  'post_content'  => "",
		  'post_status'   => 'publish',
		  'post_type'	=> 'listing_type',
		  'post_author'   => 1,
		  'post_category' => '',
		);
		  
		// Insert the post into the database
		$postID = wp_insert_post( $my_post );
		
		// SAVE CATEGORIES
		if(strlen($_POST['cat']) > 0){		 
		wp_set_post_terms( $postID, explode(",",$_POST['cat']), 'listing' );
	  	}
	 
		// ADD IN CUSTOM FIELDS
		if(strlen($_POST['custom']) > 2){
		
			$ff = explode(",",$_POST['custom']); 	
	 		
			foreach($ff as $f){			
				$gg = explode("=",$f);							
				update_post_meta($postID, $gg[0],  $gg[1]);			
			}	
		
		}
		
		//die(print_r($_POST).$postID);
	  	$responce = hook_upload($postID, $_FILES['core_attachments'], false); 
		
		if(empty($responce)){
		
		die("INVALID FORMAT");
		}
		 
		// aid
		update_post_meta($postID, 'image', $responce[0]['url'] );	
		
		update_post_meta($postID, 'image_aid', $responce[0]['aid'] );	
		
		// extras		
		update_post_meta($postID, 'size',  $responce[0]['size']);	
		
		$image_attributes = wp_get_attachment_image_src( $responce[0]['aid'] , 'full' );
		if(isset($image_attributes[2])){
		update_post_meta($postID, 'dimentions',  $image_attributes[1] . 'x' .  $image_attributes[2] );	
		}
 
		echo json_encode($responce); 
		die();
	
	}
}

function CSV_IMPORT_FUNCTIONS(){ global $wpdb; 

 
	if(isset($_POST['savecompare'])){
	
	// GET LIST OF COMPARED TABLES
	$compared_tables = get_option('wlt_comparedtables');
	if(!is_array($compared_tables)){ $compared_tables = array(); }
	
	// CHECK IF IT EXISTS
	if(in_array($_POST['savecompare_table'], $compared_tables)){
		
		if(!$_POST['savecompare_value']){
			// LOOP THROUGH AND REMOVE ALL ENTRIES
			foreach($compared_tables as $k=>$v){
				if($v == $_POST['savecompare_table']){
				unset($compared_tables[$k]);
				} // end if
			}// end foreach		
		}
	
	}else{
		if($_POST['savecompare_value'] == 1){
			$compared_tables[] = $_POST['savecompare_table'];
		}	
	}
	// SAVE THE DATA
	update_option("wlt_comparedtables",$compared_tables);	
	//die(print_r($_POST).);
	}

	if(isset($_GET['autofix']) && strlen($_GET['autofix']) > 4){
	
	// GET LIST OF HEADERS
	$result = mysql_query("SELECT * FROM (".$_GET['autofix'].") LIMIT 1");
	$row = mysql_fetch_assoc( $result ); 
	foreach($row as $key=>$val){ if($key == ""){ continue; }
		//echo $key."<br>";
		// SWITCH AND ALTER
		switch(strtolower($key)){
			case "image":
			case "imageurl": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `image` TEXT");			
			} break;
			case "product name":
			case "title":
			case "name": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `post_title` TEXT");			
			} break;
			case "product description":
			case "description": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `post_content` TEXT");			
			} break;
			case "title2":
			case "shortdescription": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `post_excerpt` TEXT");			
			} break;
			case "merchantcategoryname": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `category1` TEXT");			
			} break;
			case "product category":
			case "tdcategoryname": 
			case "category": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `category` TEXT");			
			} break;	
			case "url":
			case "link":
			case "producturl": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `buy_link` TEXT");			
			} break;
			case "merchant_name":
			case "programname": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `store` TEXT");			
			} break;		
			case "provider_logo":	
			case "programlogopath": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `store_logo` TEXT");			
			} break;
			case "price": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `price` TEXT");			
			} break;
			case "previousprice": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `old_price` TEXT");			
			} break;	
			case "shippingcost": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `shipping` TEXT");			
			} break;
			
			case "country": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `map-country` TEXT");			
			} break;			
			case "city": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `map-city` TEXT");			
			} break;
			case "address": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `map-location` TEXT");			
			} break;
			case "zipcode":
			case "postcode": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `map-zip` TEXT");			
			} break;	
			case "longitude": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `map-log` TEXT");			
			} break;
			case "latitude": {	
				mysql_query("ALTER TABLE ".$_GET['autofix']." CHANGE  `".$key."`  `map-lat` TEXT");			
			} break;	
							
			
		} // end switch	
	} // end foreach
	
	// UPDATE MESSAGE
	$GLOBALS['error_message'] = "Table Updated Successfully";

	}elseif(isset($_GET['action']) && $_GET['action'] == "dome"){	
	
	if(($_GET['p']*100) > $_GET['t']){ ?>
	<div class="alert alert-success">
    <h3 style="color:#097f14;font-weight:bold;">Import Completed</h3>
    </div>	
	<?php }else{ 
	$perc = ($_GET['p']*100)/$_GET['t']*100;
	$time_remaining = round($_GET['t']/100-$_GET['p'],0);
	
	?>
    <div class="alert alert-info">
    <h3 style="color:#0F5375;font-weight:bold;">CSV Import Progress</h3>
    <p>Importing rows <?php echo ($_GET['p']*100); ?> - <?php echo ($_GET['p']*100)+100; ?> of <?php echo $_GET['t']; ?></p>
    <div class="progress progress-striped active">
      <div class="bar" style="width: <?php echo $perc; ?>%;"></div>
    </div>
    <p style="font-size:11px;">estimated time remaining: <?php if($time_remaining == 0){ $time_remaining = 2; } echo $time_remaining; ?> minutes - <b>do not close this window or your import will stop.</b></p>
    </div> 
	<?php
	}	
	die();
	}	
}

?>