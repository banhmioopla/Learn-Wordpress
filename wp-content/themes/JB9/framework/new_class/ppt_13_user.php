<?php

/*

FUNCTION LIST
1. user_posts()

*/
use Hybridauth\Hybridauth; 

class framework_user extends framework_addlisting {



 	/* =============================================================================
	Check if user is online
	========================================================================== */
	
	function user_online($uid, $showbadge=1){ global $wpdb, $CORE, $post, $userdata;
			
		if(!is_numeric($uid)){ return false; }
		
		// DATAING ONLINE CHECK
		if(THEME_KEY == "da" && isset($post->ID) ){
		
			$online = get_post_meta($post->ID,'online',true);
			if($online){
				$online = true;
			}else{
				$online = false;
			}
		}else{	 
		
			// CHECK IF THE USER EXISTS OTHERWISE ADD THEM
			$result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_useronline WHERE user_id= ('".$uid."') LIMIT 1");
			
			if(empty($result)){
				 $online = false;
			}else{
				 $online = true;
			}
		}
		
		
		if(!$showbadge){
		return $oneline;
		}
		
		if($online){
		return '<span class="onlinebadge online text-dark badge border px-2 bg-white"><i class="fa fa-circle text-success"></i> '.__("Online","premiumpress").'</span>';
		}
		
		return '<span class="onlinebadge offline text-dark badge border px-2 bg-white"><i class="fa fa-circle text-dark"></i> '.__("Offline","premiumpress").'</span>';
			
	}
	
function user_online_tables(){ global $wpdb, $CORE, $userdata;
	
	 		
		if(!isset($userdata->ID)){ return; }
	
		
		// INSTALL TABLES
		if(get_option("datingtabledinstalled1") == ""){
		
			 $wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_useronline` (	 
			  `id` int(10) NOT NULL auto_increment, 
			  `user_id` int(10) NOT NULL, 
			  `session` char(100) NOT NULL default '',
			  `ip` varchar(15) NOT NULL default '', 
			  `timestamp` varchar(15) NOT NULL default '', 
			  PRIMARY KEY (`id`), 
			  UNIQUE KEY `id`(`id`) );"); 
		}
		 
		 // USER SESSION
		$session = session_id();		 
		  
		 // CHECK IF THE USER EXISTS OTHERWISE ADD THEM
		 $result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_useronline WHERE session='".$session."' LIMIT 1");
		  
		 if(empty($result)){
		  
			$wpdb->query("INSERT INTO  ".$wpdb->prefix."core_useronline (`user_id` ,`session` ,`ip` ,`timestamp`) 
			VALUES ( '".$userdata->ID."',  '".$session."',  '".$this->get_client_ip()."',  '".date('Y-m-d H:i:s')."');");	
			
			// UPDATE PROFILE
			if(defined('THEME_KEY') && THEME_KEY == "da"){
			
				$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('".$userdata->ID."') LIMIT 1";				 
				$query = $wpdb->get_results($SQL, OBJECT);
				
				if(!empty($query)){
					update_post_meta($query[0]->ID, 'online', 1);					
				}			
			}		 
			
		}else{
		
			$wpdb->query("UPDATE ".$wpdb->prefix."core_useronline SET timestamp='".date('Y-m-d H:i:s')."', user_id='".$userdata->ID."' WHERE session='".$session."' LIMIT 1");
				
		}
		
		// DELETE USERS AFTER 10 MINUTES 
		$wpdb->query("DELETE FROM ".$wpdb->prefix."core_useronline WHERE timestamp < '".date('Y-m-d H:i:s', strtotime("-10 minutes"))."' ");
   		
		
}	
	
	
	
	
 	/* =============================================================================
	Membership functions
	========================================================================== */

function get_subscription($uid){

	$f = get_user_meta($uid, 'wlt_subscription',true);
	
	return $f;

}
function get_subscription_name($uid){ global $userdata;
	
	$subs 		= get_option("csubscriptions");
	$cm			= get_user_meta($uid,'wlt_subscription',true);
		
	if(is_array($subs)){
			$i=0;
			foreach($subs['key'] as $key => $val){			
				if(isset($cm['key']) && $val == $cm['key']){				 
					return $subs['name'][$i];				
				}				
				$i++;			
			}
	}		
	return __("No Membership","premiumpress");
}
function get_subscription_data($key){ global $userdata, $wpdb; //user_susbcription_get

	$data = array();
	 
	$csubscriptions = get_option("csubscriptions"); 
	if(is_array($csubscriptions) && !empty($csubscriptions) ){ 
	 
		$i=0;	
		foreach($csubscriptions['name'] as $xxx){ 
		 	
			if($csubscriptions['key'][$i] == $key){						 
				 
				 if(!isset( $csubscriptions['listings'][$i])){  $csubscriptions['listings'][$i] = 0; }
				 if(!isset($csubscriptions['listings_pak'][$i])){ $csubscriptions['listings_pak'][$i] = ""; }
				 
				$data = array(
				
				// BASIC DATA
				"key" => $csubscriptions['key'][$i], 
				"name" =>  $csubscriptions['name'][$i],				 
				"price" =>  $csubscriptions['price'][$i],				
				"days" =>  $csubscriptions['days'][$i],
				"recurring" =>  $csubscriptions['recurring'][$i],
				
				"listings" =>  $csubscriptions['listings'][$i],
				"listings_pak" =>  $csubscriptions['listings_pak'][$i],
			 
				
				);
			 	
				// CHECK AND COMPARE
				if(isset($userdata) && $userdata->ID){				
					$f = get_user_meta($userdata->ID, 'wlt_subscription',true);	 
					if(is_array($f)){
				 
					$SQL = "SELECT count(*) as total 
					 FROM ".$wpdb->prefix."posts
					 WHERE ".$wpdb->prefix."posts.post_status = 'publish' 
					 AND CAST(".$wpdb->prefix."posts.post_date AS DATETIME) >= '".$f['date_start']."'"; 						 
					$results = $wpdb->get_results($SQL); 
					 	 
					if(!empty($results) ){
						$data['listings_left'] = ( $data['listings'] - $results[0]->total );						 
					}
					  
					
					}
				}
				 								
				return $data;
			}	
			
			$i++;			
		}
	}// end if has subscription	
	return $data;
}
	
	
	
	
 	/* =============================================================================
	Verified
	========================================================================== */

	function user_verified($uid, $echo = 0){
	
		if(_ppt('account_userverify') != 1){ return; }
		
		
		$user_verified = get_user_meta($uid,'wlt_verified',true);
		
		if($echo == 0){
		
			if($user_verified == "yes"){ return true; }else{ return false; }
			
		}else{
			
			if($user_verified == "yes"){ 
			
			return '<span class="badge badge-success"><i class="fa fa-check-circle" aria-hidden="true"></i> '.__("verified user","premiumpress").'</span>';
			
			}else{
			
			return '<span class="badge badge-dark"><i class="fa fa-frown-o" aria-hidden="true"></i> '.__("unverified user","premiumpress").'</span>';
			
			}			
			
		}
		
		
	}
 	/* =============================================================================
	[USER-LASTONLINE] - SHORTCODE
	========================================================================== */
	function ppt_shortcode_user_lastonline(){ global $post, $CORE; 
		
		$date = get_user_meta($post->post_author, 'login_lastdate', true);		
		$xp = $CORE->date_timediff($date);
		
		if($xp['date_array'][__("days","premiumpress")] == 0){
		
		return __("today","premiumpress");
		
		}
		  
		return ($xp['date_array'][__("days","premiumpress")]+($xp['date_array'][__("months","premiumpress")]*30))." ".__("days ago","premiumpress");	

	}
 	/* =============================================================================
	[USER-SINCE] - SHORTCODE
	========================================================================== */
	function ppt_shortcode_user_since(){ global $post; 
		
		$user_info = get_userdata($post->post_author);
		
		$date_format = get_option('date_format');		
		 
		return mysql2date($date_format, $user_info->user_registered);
	 	

	}
 	/* =============================================================================
	[USER-COUNTRY] - SHORTCODE
	========================================================================== */
	function ppt_shortcode_user_country(){ global $post; 
	
		$country = get_user_meta($post->post_author,'country',true);
		if(isset($GLOBALS['core_country_list'][$country])){		  
			return $GLOBALS['core_country_list'][$country];			
		} 		
		return $country;	
	}

	
function MEMBERSHIPACCESS($post_id){	
	global $wpdb, $userdata, $post;	
		$current_access = get_post_meta($post_id, "access", true);	
		if(!is_array($current_access)){ return true; }		
		if(isset($userdata) && $userdata->ID){		
			$current_membership	= get_user_meta($userdata->ID,'wlt_membership',true);
			
			if(in_array($current_membership,$current_access) || in_array(99,$current_access) ){ return true; }		
			
			if(isset($post->post_author) && $post->post_author == $userdata->ID){ return true; }
			
			return false;
		
		}else{		
			if(in_array(99,$current_access)){ return true; }else{ return false; }		
		}		
}


function get_user_credit($userid){


	$credit = get_user_meta($userid,'wlt_usercredit',true);
	
	if($credit == ""){
	$credit = 0;
	}
	
	return hook_price($credit);

}

/* =============================================================================
	SOCIAL LOGIN
	========================================================================= */
	

function sociallogin(){ global $CORE;

if( isset($_GET['sociallogin']) && $_GET['sociallogin'] && in_array($_GET['sociallogin'] ,array("Facebook","Twitter","Linkedin","Google") ) ) { 

 			 
			$pp = trim($_GET['sociallogin']); 
	 
			// LOAD DEFAULT
			$core_admin_values = get_option("core_admin_values");
			
			// CHECK TO MAKE SURE ITS ENABLED
			if($core_admin_values['allow_socialbuttons'] != 1){
			die('social login disabled');
			}		
		 	 
			require_once( TEMPLATEPATH."/framework/Hybridauth/autoload.php" );
			
			//First step is to build a configuration array to pass to `Hybridauth\Hybridauth`
			$config = [
				//Location where to redirect users once they authenticate with a provider
				'callback' => home_url().'/?sociallogin='.$_GET['sociallogin'],
			
				//Providers specifics
				'providers' => [
					'Twitter' => [ 
						'enabled' => true,     //Optional: indicates whether to enable or disable Twitter adapter. Defaults to false
						'keys' => [ 
							'key'    => _ppt('social_twitter_key1'), //Required: your Twitter consumer key
							'secret' => _ppt('social_twitter_key2')  //Required: your Twitter consumer secret
						]
					],
					
					'Google'   => [
						'enabled' => true, 
						'keys' => [ 
						'id'  =>  _ppt('social_google_key1'), 
						'secret' => _ppt('social_google_key2'), ] 
					], 
					
					'Facebook' => [
						'enabled' => true, 
						'keys' => [ 
							'id'  =>  _ppt('social_facebook_key1'), 
							'secret' => _ppt('social_facebook_key2'), 
						] 
					],
					
					'Linkedin' => [
						'enabled' => true, 
						'keys' => [ 
							'id'  =>  _ppt('social_linkedin_key1'), 
							'secret' => _ppt('social_linkedin_key2'), 
						] 
					],	
									
				] 				
			];
			
			if($pp == "Twitter"){
			$config['callback'] = home_url().'?sociallogin='.$_GET['sociallogin'];
			}
			 
			try{
				//Feed configuration array to Hybridauth
				$hybridauth = new Hybridauth($config);
			 
				//Attempt to authenticate users with a provider by name
				$adapter = $hybridauth->authenticate( $_GET['sociallogin'] ); 
				 
				//Returns a boolean of whether the user is connected with Twitter
				$isConnected = $adapter->isConnected();
			 
				//Retrieve the user's profile
				$userProfile = $adapter->getUserProfile();
				
				//Disconnect the adapter 
				$adapter->disconnect();
				
				$fname = $userProfile->firstName;
				$lname = $userProfile->lastName;
				$dname = $userProfile->displayName;
				$email = $userProfile->email;
				$photo = $userProfile->photoURL;
				$identifier = $userProfile->identifier;
				 
				
				if($email == ""){
				die("Could not get your email address. Please register using the standard registration form.");
				}
				
				// DISPLAY NAME
				if($dname == ""){
					$gg = explode("@", $email);
					$newusername = $gg[0].date('s');
				}else{
					$newusername = $dname;
				}
				
				// CHECK IF USERNAME EXISTS
				if ( username_exists( $newusername ) ){
				$newusername = $newusername."1";
				}
				
				$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
				$_POST['password'] = $random_password;
						
						
					// CHECK FOR RE-LOGIN 
					if ( email_exists( $email ) ){							
								 
							$huser = get_user_by( 'email', $email );							
							$pass1 = get_user_meta($huser->data->ID,'socialpass',true);								 
							$ff = $this->USER_LOGIN($huser->data->user_login, $pass1 );
							
							// REDIRECT
							header("location: ". _ppt(array('links','myaccount')) );
							exit();							
					}else{
						
						// CREATE NEW USER
						$errors = $CORE->USER_REGISTER($newusername, $random_password, $email, 1, 0, 0 );						
					} 
						 
					// IF HAS ERRORS					 
					if ( is_wp_error($errors) ) {
							echo '<h4>' . $errors->get_error_message() . '</h4>';
							die();	
					} 
						
					// SAVE SOCIAL LOGIN PASS
					update_user_meta($errors->data->ID, 'socialpass', $random_password);
						
					// UPDATE USER DATA
					if(strlen($photo) > 1){
						update_user_meta($errors->data->ID, 'wlt_userphoto',$photo);
					}
					
					// SETUP DEFAULT MEMBERSHIP
					if(_ppt('regmembership') != "" & strlen(_ppt('regmembership')) > 1){					
						$sd = $CORE->get_subscription_data(_ppt('regmembership'));						
						if(is_array($sd)){
						update_user_meta( $errors->data->ID ,'wlt_subscription', 
							array(
								"key" => _ppt('regmembership'), 
								"date_start" => date("Y-m-d H:i:s"), 
								"date_expires" => date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$sd['days']." days")),
								"listings" => 0,
								"flistings" => 0,
							)
						);
						}
					}
				 	
					// EXTRA
					$data['ID'] 				= $errors->data->ID;
					$data['first_name'] 		= strip_tags($fname);
					$data['last_name'] 			= strip_tags($lname);							
					wp_update_user( $data );
						
					// REDIRECT
					header("location: ". _ppt(array('links','myaccount')) );
					exit();
			 
			
				
			}
			catch(\Exception $e){
				echo '<h4>' . $e->getMessage() . '</h4>';
				die();
			}
		 
		 	
		
	}

}
 



 

/*
this function gets the testimonals
added via the admin area
*/

function testimonials($num = 5){

	$data = "";

	$ctestimonial = get_option("ctestimonial"); 
	if(is_array($ctestimonial)){
	
		$data = array();
		
		$i=0; $f=0;
		foreach($ctestimonial['name'] as $xx){ 
			if($ctestimonial['name'][$i] != "" ){
			
			if($f >= $num){ $i++; continue; }
			
			$data[$f]['name'] 		= stripslashes($ctestimonial['name'][$i]);
			 
			$data[$f]['name_title'] = @stripslashes($ctestimonial['name_title'][$i]);
			$data[$f]['date'] 		= @$ctestimonial['date'][$i];
			$data[$f]['rating'] 	= @$ctestimonial['rating'][$i];
			$data[$f]['desc'] 		= @stripslashes($ctestimonial['desc'][$i]);
			$data[$f]['userphoto'] 	= @$ctestimonial['logo_url'][$i];
			
			$f++;
			
			}
			$i++;
		} 
	
	
	}
	
	return $data;

}

/*
	this function displays the 
	registration fields for users
*/
function user_fields($userid = ""){ $taborder = 5; $string = "";

	$regfields = get_option("regfields");
	if(is_array($regfields) && !empty($regfields)){
		
		$i = 0;
		if(!is_array($regfields['name'])){
		return;
		}
		foreach($regfields['name'] as $data){  
			if(isset($regfields['name'][$i]) && strlen($regfields['name'][$i]) > 2 ){
			
			// IF IS USER GET VALUE
			$value = "";
			if(is_numeric($userid)){
			$value = get_user_meta($userid, $regfields['key'][$i], true);			
			}
			 
			// COL BREASK
			$col0 = "col-xs-12 col-md-12 form-group";
			$col1 = "col-md-12";
			$col2 = "col-md-12";
			
			if(isset($GLOBALS['flag-account'])){
			$col0 = "col-md-6 form-group";
			$col1 = "";
			$col2 = "";
			}
			
			// REQUIRED
			if(!isset($regfields['required'][$i])){ $regfields['required'][$i] = 0; }
			
			// SWITCH FOR TAXONOMY
			if($regfields['type'][$i] == "tax"){
			$regfields['values'][$i] = $regfields['tax_name'][$i];
			
			}elseif($regfields['type'][$i] == "post_type"){
			$regfields['values'][$i] = $regfields['posttype_name'][$i];
			}
			
			
			
			if(defined('IS_MOBILEVIEW') && isset($GLOBALS['flag-register']) ){
			ob_start();
			?>
             <?php echo  $this->fieldtype($regfields['type'][$i], $regfields['key'][$i], $regfields['values'][$i], stripslashes($regfields['name'][$i]), $value, $regfields['required'][$i]); ?>
                    
            <?php
			$string .= ob_get_clean();
			}else{		 
				
				ob_start();
				?>
                <div class="<?php echo $col0; ?> ">
                
                <?php if(!isset($GLOBALS['flag-account'])){ ?><div class="row"><?php } ?>
             	
                    <div class="<?php echo $col1; ?>">
                    
                        <label class="col-form-label">
                        
                            <?php echo stripslashes($regfields['name'][$i]); ?>
                            
                            <?php if($regfields['required'][$i] == 1){ ?>
                            <span class="red">*</span>
                            <?php } ?>
                        
                        </label>                 
                    
                    </div>
                    
                    <div class="<?php echo $col2; ?>">
            	     
                    <?php echo  $this->fieldtype($regfields['type'][$i], $regfields['key'][$i], $regfields['values'][$i], $taborder, $value, $regfields['required'][$i]); ?>
                    
                    </div> 
                    
                    <?php if(!isset($GLOBALS['flag-account'])){ ?></div><?php } ?>                   
              
                </div>
                <?php
		 		$string .= ob_get_clean(); 
				
				}
				
				$taborder++;		
		
		
			} // is blank name			
		$i++; 
		} // end foreach
	
	} // end is array	
	
	return $string;
	
}

function fieldtype($type, $key, $value = "", $taborder = 1, $user_value = "", $required = 0 ){ global $wpdb, $userdata;
	
	// IF REQUIRED ADD ON EXTRA CLASS
	$eclass = "";

	if($required != 0 && ( $required == 1 || $required == "yes" ) ){
	$eclass = "required";
	}
	
	// DEFAULT VALUE
	if($user_value == "" && $value != "" && !isset($_GET['eid']) ){
	$user_value = $value;
	}
 	
	ob_start();
	switch($type){
	
	
	 	case "time": { 
		if($user_value == ""){ $user_value = date('Y-m-d H:i:s'); }
		$db = explode(" ",$user_value);			
		
		?>
         
 
<script >
    jQuery(document).ready(function() {  jQuery('#field-<?php echo $key; ?>-date').datetimepicker({format: 'hh:ii', fontAwesome: 1,  todayBtn: true, pickerPosition: "bottom-right"}); });
</script>    
 
		<div class="row">
        <div class="col-md-12">
            <div class="input-group date">
            <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fal fa-calendar"></i></span></span>            
            <input type="text"        
            name="custom[<?php echo $key; ?>]" 
            tabindex="<?php echo $taborder; ?>"  
            value="<?php echo esc_attr( $user_value ); ?>"  
            class="form-control rounded-0 <?php echo $eclass; ?>"  
            id="field-<?php echo $key; ?>-date">
            </div>
		</div>
        </div> 
        
		<?php 
		} break;
	
	
		case "date": { 
		if($user_value == ""){ $user_value = date('Y-m-d H:i:s'); }
		$db = explode(" ",$user_value);			
		
		?>
         
 
<script >
    jQuery(document).ready(function() {  jQuery('#field-<?php echo $key; ?>-date1').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss', fontAwesome: 1}); });
</script>    
 
 
 
		<div class="row" <?php if(is_admin()){ ?>style="margin:-5px;"<?php } ?>>
        <div class="col-md-12">
            <div class="input-group  date" id="field-<?php echo $key; ?>-date1">
            <?php if(!is_admin()){ ?>
            <span class="input-group-prepend input-group-addon"><span class="input-group-text add-on"><i class="icon-calendar fal fa-calendar"></i></span></span> 
            <?php } ?>
         
  
            <input type="text"        
            name="custom[<?php echo $key; ?>]" 
            tabindex="<?php echo $taborder; ?>"  
            value="<?php echo esc_attr( $user_value ); ?>"  
            class="form-control <?php if(is_admin()){ ?>hasaddon<?php }else{ ?>rounded-0 <?php echo $eclass; ?> <?php } ?>"  
            id="field-<?php echo $key; ?>-date">
            
            <?php if(is_admin()){ ?>
             <span class="add-on"><i class="dashicons dashicons-calendar" style="cursor:pointer"></i></span>
            <?php } ?>
            </div>
		</div>
        </div> 
        
		<?php 
		} break;
		
		case "post_type": {
		 
	   
		   $SQL = "SELECT DISTINCT ID, post_title 
		   FROM ".$wpdb->prefix."posts
		   WHERE ".$wpdb->prefix."posts.post_status = 'publish' 
		   AND ".$wpdb->prefix."posts.post_type = '".$value."'
		   ORDER BY ".$wpdb->prefix."posts.post_title ASC
		   LIMIT 100"; 
			 
			$results = $wpdb->get_results($SQL); 
				 				 
			if(count($results) > 0 && !empty($results) ){
			?>
            <select class="form-control rounded-0 <?php echo $eclass; ?>" name="custom[<?php echo $key; ?>]" tabindex="<?php echo $taborder; ?>">
        	<option></option>
			<?php foreach ($results as $val){
				
				// SETUP SELECTED VALUE
               if($user_value == $val->ID){ $b = "selected=selected"; }else{ $b= ""; }
			
			?>			
            <option value="<?php echo $val->ID; ?>" <?php echo $b; ?>><?php echo $val->post_title; ?></option>
            <?php } ?>
            
	    	</select>
            
            <?php } ?>
            
        
        <?php		
		} break;
		
		case "tax": {
 
		
			$terms = get_terms($value,'hide_empty=0&parent=0');
			$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';		 
			$count = count($terms);	
			if($count > 0){	
		?>
        
        <select class="form-control rounded-0 <?php echo $eclass; ?>" name="custom[<?php echo $key; ?>]" tabindex="<?php echo $taborder; ?>">
        <option></option>
		<?php  
		foreach ( $terms as $term_inn ) {
              
			   // SETUP SELECTED VALUE
               if($user_value == $term_inn->term_id){ $b = "selected=selected"; }else{ $b= ""; }
                                    
                 echo "<option value='".$term_inn->term_id."' ".$b."> " . $term_inn->name . " (".$term_inn->count.") </option>";
				 
		}
         ?>
         
        </select>
        
        <?php } ?>
        
        <?php	
			
		} break;
		
		case "price": { ?>	
        	
		<div class="row">
        <div class="col-md-12">
            <div class="input-group">
            	<span class="input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
                <input type="text" name="custom[<?php echo $key; ?>]" maxlength="255"  class="form-control rounded-0 val-numeric <?php echo $eclass; ?>" tabindex="<?php echo $taborder; ?>"  value="<?php echo esc_attr( $user_value ); ?>" id="field-<?php echo $key; ?>" />                
            </div>
		</div>
        </div> 
        
         <script>
		jQuery( "#field-<?php echo $key; ?>" ).change(function() {	   
			jQuery( "#field-<?php echo $key; ?>" ).val( jQuery( "#field-<?php echo $key; ?>" ).val().replace(',', '') );	  
		});
		</script>
        
		<?php 
		} break;
	
		case "input": { 
		?>
        
        <?php if(defined('IS_MOBILEVIEW') && isset($GLOBALS['flag-register']) ){ ?>
        <div class="page-login-field bottom-10">
				<i class="fa fa-angle-right"></i>
				<input type="input" name="custom[<?php echo $key; ?>]" class="<?php echo $eclass; ?>" placeholder="<?php echo $taborder; ?>" value="<?php echo esc_attr( $user_value ); ?>"  id="field-<?php echo $key; ?>" />
				<em>(required)</em>
			</div>
        
        <?php }else{ ?>
        
        <input type="input" name="custom[<?php echo $key; ?>]" class="form-control rounded-0 <?php echo $eclass; ?>" tabindex="<?php echo $taborder; ?>" value="<?php echo esc_attr( $user_value ); ?>"  id="field-<?php echo $key; ?>" />
        <?php } ?>
        
        
		
        <?php
		} break;
		
		case "textarea": { 
		?>
        <textarea name="custom[<?php echo $key; ?>]" rows="10" class="form-control rounded-0 <?php echo $eclass; ?>" tabindex="<?php echo $taborder; ?>" id="field-<?php echo $key; ?>"><?php echo esc_textarea($user_value); ?></textarea>
		<?php
        } break;	
		
		case "select": {
		
		if(is_array($value)){
		$options = $value;
		}else{
		$options = explode( PHP_EOL, $value );
		}
		 
		?> 
        <?php if(defined('IS_MOBILEVIEW') && isset($GLOBALS['flag-register']) ){ ?>
        <div class=" bottom-10">
        <i class="fa fa-angle-right"></i>
        <em><?php echo $taborder; ?></em>
        <?php } ?>
        
        
		<select name="custom[<?php echo $key; ?>]" class="form-control rounded-0" tabindex="<?php echo $taborder; ?>"  id="field-<?php echo $key; ?>">				
		<?php if(is_array($options)){ foreach($options as $key => $val){
					
					$val = trim($val);
					
					if($user_value == $key){?>
					<option value="<?php echo $key; ?>" selected=selected><?php echo $val; ?></option>
                    <?php }else{ ?>
					<option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                    <?php 
					}
			} }// end foreach
		?>
		</select>
        
        <?php if(defined('IS_MOBILEVIEW') && isset($GLOBALS['flag-register']) ){ ?>
        </div>
        <?php } ?>
        
        <?php 
		} break;
		case "checkbox":
		case "radio": { 
		
		if(is_array($value)){
		$options = $value;
		}else{
		$options = explode( PHP_EOL, $value );
		}
 		 
		?>
        <div class="container">
        <div class="row">
        <?php
		if(is_array($options)){ foreach($options as $k => $val){
				 
					$val = trim($val);
		 			
					
					if($k != "" && !is_numeric($k) ){
					
						if(is_array($user_value) && in_array($k, $user_value)){?> 
						<label class="<?php echo $type; ?> col-md-6">
						<input type="<?php echo $type; ?>" class="form-control" data-toggle="<?php echo $type; ?>" name="custom[<?php echo $key; ?>][]" value="<?php echo $k; ?>" checked=checked><?php echo $val; ?>
						</label>
						<?php }else{ ?>
						<label class="<?php echo $type; ?> col-md-6">
						<input type="<?php echo $type; ?>" class="form-control" data-toggle="<?php echo $type; ?>" name="custom[<?php echo $key; ?>][]" value="<?php echo $k; ?>"><?php echo $val; ?>
						</label>				 
						<?php
						}

					 
					}else{
					
						if(is_array($user_value) && in_array($val, $user_value)){?> 
						<label class="<?php echo $type; ?> col-md-6">
						<input type="<?php echo $type; ?>" class="form-control" data-toggle="<?php echo $type; ?>" name="custom[<?php echo $key; ?>][]" value="<?php echo $val; ?>" checked=checked><?php echo $val; ?>
						</label>
						<?php }else{ ?>
						<label class="<?php echo $type; ?> col-md-6">
						<input type="<?php echo $type; ?>" class="form-control" data-toggle="<?php echo $type; ?>" name="custom[<?php echo $key; ?>][]" value="<?php echo $val; ?>"><?php echo $val; ?>
						</label>				 
						<?php
						}
					
					}
			} }// end foreach
 		?>
        </div>
        </div>
        <?php
		} break;
	
	}
	return ob_get_clean(); 
}



	function user_display_name($userid){ global $userdata;
	
		if(!is_numeric($userid)){ return "invalid user id"; }
	
		// BUILD DISPLAY NAME
		$name = get_the_author_meta( 'first_name', $userid)." ".get_the_author_meta( 'last_name', $userid);
		
		// FALLBACK
		if($name == " "){
		$name = get_the_author_meta( 'display_name', $userid);
		}
		 
		return $name;
	
	}

	/*
		This function gets a the user
		star rating box with feedback
	
	*/
	function user_feedback_score($userid = "1" ){ global $wpdb;
 
		$total_score = 0;
		$total_found = 0;
	
		$args = array(
			'post_type' => 'wlt_feedback',
			'posts_per_page'	=> '150',
			'meta_query' => array(					 
					array(
						'key'		=> 'uid',
						'value' 	=> $userid,
						'compare' 	=> '=',
					),					 
				),		);
		// GET USER FEEDBACK
		$sub_query = new WP_Query($args); 
		$reply_query = $sub_query->posts;		 
		if(!empty($reply_query)){ 
		
		$total_found = $sub_query->found_posts;
		
			foreach($reply_query as $ratingdata){
		 
				$total_score = $total_score + get_post_meta( $ratingdata->ID, 'ratingtotal', true );
				
			}
		
		} 	
	
	// PERCENTAGE
	$percentage = 0;
	if($sub_query->found_posts > 0 && $total_score > 0){	
	$percentage = $total_score /  $sub_query->found_posts;	
	}
 	
	$score = round(($total_score / $total_found),2);
	
	return array(
	"score" =>  $score,
	"votes" => $total_found, 
	"stars" => $score, 
	"percentage" => 0, //<-- not used now
	); 
 		
	}
	/*
		this function gets the users
		feedback rating and vote count
	*/
	 


	/*
	this function counts the users
	posts with/without membership
	*/
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
	
 

	/*
	
	this records the user hit on each listing
	
	*/
	function user_hitcounter(){ global $post, $wpdb;
	
		if(isset($GLOBALS['done_savehits'])){ return;}
		$GLOBALS['done_savehits'] = true;
		 	
		if(!isset($post->ID) && isset($post->ID) && $post->post_type != "listing_type"){ return; }
  
		// CHECK KEY EXISTS IN THE DATABASE
		$hits = get_post_meta($post->ID,'hits',true);
		if(!is_numeric($hits)){  $hits = 0; } 
		$newhits  = $hits+1;			
		update_post_meta($post->ID,'hits', $newhits);		 
	 
		return; 
		
	}



	// NEEDS REDOING
	function user_feedback_exists($postid, $userid){ global $wpdb;
	
		if(!is_numeric($postid)){ return false; }
	
		// CHECK IF WE HAVE ALREADY LEFT FEEDBACK FOR THIS USER + ITEM
		$SQL = "SELECT ".$wpdb->postmeta.".post_id, ".$wpdb->posts.".post_author, ".$wpdb->postmeta.".meta_value FROM ".$wpdb->postmeta." 
					INNER JOIN ".$wpdb->posts." ON ( ".$wpdb->postmeta.".post_id = ".$wpdb->posts.".ID  AND ".$wpdb->posts.".post_author='".$userid."' )
					WHERE ".$wpdb->postmeta.".meta_key = 'pid' AND ".$wpdb->postmeta.".meta_value= ('".$postid."') AND ".$wpdb->posts.".post_type = 'wlt_feedback' LIMIT 0,100";
	 
		$result = $wpdb->get_results($SQL);
		 
		if(empty($result)){
			return false;
		}else{
			return true;
		}
			 
	}
	
 
	/*
		This function gets the users membership
		name for the icon
	
	*/
	function user_membership_name($userid){ global $userdata;
	
		 
		$cm	 = get_user_meta($userid,'wlt_subscription',true);			 
		
		if(is_array($cm) && !empty($cm['key']) ){
		
		return $this->get_subscription_name($userid)." ".__("membership","premiumpress");
			
		}else{
			return __("Member","premiumpress");
		} 
	
	}
	/*
		This function gets the users favorties list
		data
	
	*/
	function user_favs($userid = ""){ global $CORE, $userdata, $wpdb; 
	
	$extn = "_list";
	if(defined('WP_ALLOW_MULTISITE')){
		$extn .= get_current_blog_id();
	}						 
	$my_list = get_user_meta($userid, 'favorite'.$extn,true);	
	if(!is_array($my_list)){ $my_list = array(); }
	return $my_list;
						
						
	}
	
	/*
		This function counts the amount of favs
		a user has on thier account
	*/
	function user_favs_count(){ global $userdata; 
	
	if(!$userdata->ID){ return 0; }
	
	$extn = "_list";
	if(defined('WP_ALLOW_MULTISITE')){
		$extn .= get_current_blog_id();
	}	
	
	$my_list = get_user_meta($userdata->ID, 'favorite'.$extn,true);
	if(!is_array($my_list)){ $my_list = array(); }
	foreach($my_list as $hk => $hh){ if($hh == 0 || $hh == ""){ unset($my_list[$hk]); } }
	
	if(empty($my_list)){ return 0; }
	
	return count($my_list);   
	   
	}

	/*
		This function gets a list of recently viewed posts
		and updated the users recently viewed list
	
	*/
	function user_recentlyviewed($userid = "", $postid = "", $get = false){ global $post, $userdata, $wpdb;
	
		if(isset($GLOBALS['done_recentlyviewed'])){ return;}
		$GLOBALS['done_recentlyviewed'] = true;
	 
		$recent = get_user_meta($userid, "recentlyviewed",true);		
		
		if(!is_array($recent)){ $recent = array(); } 
		
		// REMOVE DUPLICATES
		$recent = array_unique($recent);
		 
		if($get){
		  
			return $recent ;
		  
		}else{
			
			// RESET
			if(count($recent) > 20){
			update_user_meta($userid, "recentlyviewed", "");
			}
			
			$recent[$post->ID] 	= $post->ID;		
			 
			update_user_meta($userid, "recentlyviewed", $recent);		
		}
	
	}

	/*
		This function gets a list of posts
		by a single user.	
	*/
	function user_posts($userid = "1", $limit = 100, $status = "publish"){ global $wpdb;
	
	
		if(!is_numeric($userid)){ return false; }
 
		$SQL = "SELECT ".$wpdb->posts.".* FROM ".$wpdb->posts." 
		WHERE ".$wpdb->posts.".post_author='".$userid."' 
		AND ".$wpdb->posts.".post_type = 'listing_type' 
		AND ".$wpdb->posts.".post_status = '".$status."' 
		ORDER BY ".$wpdb->posts.".post_date 
		DESC LIMIT ". $limit;
	 
		$result = $wpdb->get_results($SQL);
	 
		 
		if(empty($result)){
			return false;
		}else{
			return $result;
		}	
	
	}
	
	/*
		This function gets a set number of images
		from a users account
	*/
	function user_images($userid = 1, $limit = 5, $status = "publish"){ global $wpdb;
	
	
		if(!is_numeric($userid)){ return false; }  	
		
		$SQL = "SELECT mt1.* FROM ".$wpdb->prefix."posts
		INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON ( ".$wpdb->prefix."posts.ID = mt1.post_id AND ( mt1.meta_key = '_wp_attached_file' OR mt1.meta_key = 'image_array' ) ) 
		WHERE ".$wpdb->prefix."posts.post_author='".$userid."' 
		ORDER BY ".$wpdb->prefix."posts.post_date DESC LIMIT ". $limit;
		 
		$result = $wpdb->get_results($SQL, ARRAY_A); 
		 
		if(empty($result)){
			return false;
		}else{
			return $result;
		}	
	
	} 



/* =============================================================================
   MESSAGES
   ========================================================================== */
   

function MESSAGECOUNT($userlogin){ global $wpdb, $core, $userdata;

	if($userlogin == ""){ return 0; }
	
	$SQL = "SELECT count(*) AS total FROM ".$wpdb->prefix."posts 
	INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id) 
	INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id) 
	WHERE 1=1 
	AND mt1.meta_key = 'username' AND mt1.meta_value = ('".$userlogin."')
	AND mt2.meta_key = 'status' AND mt2.meta_value = 'unread'
	AND ".$wpdb->prefix."posts.post_status = 'publish'	";
	
	/*
	$EXISTINGDATA = get_option('wlt_system_counts');
	if(!is_array($EXISTINGDATA)){ $EXISTINGDATA = array(); }
		
 	if(  ( !isset($EXISTINGDATA['msgcount']['date']) || ( isset($EXISTINGDATA['msgcount']['date']) && strtotime($EXISTINGDATA['msgcount']['date']) < strtotime(current_time( 'mysql' )) ) ) ) {
	
		
	
	}else{
	
		return $EXISTINGDATA['msgcount']['count'];
		
	}*/
	$result = $wpdb->get_results($SQL);	
		$EXISTINGDATA['msgcount'] = array("date" => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). "+10 minutes")), "count" => $result[0]->total );		
		update_option("wlt_system_counts", $EXISTINGDATA , true);		
		return $result[0]->total;
	
}
 

	/* =============================================================================
	  PAGE ACCESS
	   ========================================================================== */
	
	function Authorize() {
	 
		global $wpdb, $post;
	
		$user = wp_get_current_user();
		if ( $user->ID == 0 ) {
			nocache_headers();
			
			if(_ppt(array('links','login')) != ""){
			wp_redirect(hook_redirectlink(_ppt(array('links','login')) . '?noaccess=1&redirect_to=' . urlencode($_SERVER['REQUEST_URI'])));
			}else{
			wp_redirect(hook_redirectlink(get_option('siteurl') . '/wp-login.php?noaccess=1&redirect_to=' . urlencode($_SERVER['REQUEST_URI'])));
			}
			
			exit();
		}
	}


	/* =============================================================================
		  LOGIN FUNCTION 
		========================================================================== */
		
	function LOGIN() { global $pagenow;
	
		
	// FIX FOR ELEMENTOR STYLES NOT SHOWING
	if(defined('ELEMENTOR_VERSION') && _ppt(array('pageassign','header')) != ""){ 
	
		if( substr(_ppt(array('pageassign','header')),0,9) == "elementor"){
		 
		wp_register_style( 'e1', home_url().'/wp-content/uploads/elementor/css/global.css');	 
		wp_enqueue_style( 'e1' );
		
		if(defined('ELEMENTOR_PRO_VERSION')){
		wp_register_style( 'e2', home_url().'/wp-content/plugins/elementor-pro/assets/css/frontend.min.css');	 
		wp_enqueue_style( 'e2' );
		}
		
		//wp_register_style( 'e11', home_url().'/wp-content/uploads/elementor/css/post-759.css');	 
		//wp_enqueue_style( 'e11' );
	 
		 
		}	
	}
	 
	  
		if(!isset($_GET["action"])){ $_GET["action"] =""; }
	 
		switch($_GET["action"]) {
				case 'lostpassword' :
				case 'retrievepassword' :
					$GLOBALS['flag-password'] = true;
					$this->_show_password(); 
					break;
				case 'register': {
					$GLOBALS['flag-register'] = true;			
					$this->_show_register();
				} break;
				case 'resetpass':
				case 'rp': {
					$GLOBALS['flag-resetpassword'] = true;
					$this->_show_resetpass();
				} break;
				case 'membership': {				 
					$GLOBALS['flag-membership'] = true;			
					$this->_show_membership();				
				} break;
				case 'login':
				default: {
					$GLOBALS['flag-login'] = true;			
					$this->_show_login();				
				} break;
				
				
		}
		die();
	} // END LOGIN	
	
	
	function _show_membership(){
	
		// LOAD IN PAGE TEMPLATE
		get_template_part( 'page', 'membership' );
	
	}
	
	function _show_resetpass(){
	
	global $CORE, $wp_error; $string = ""; 
 
		$user = check_password_reset_key($_GET['key'], $_GET['login']); 
	
		if ( is_wp_error($user) ) {
			wp_redirect( site_url('wp-login.php?action=lostpassword&amp;error=invalidkey') );
			exit;
		}
	
		$errors = new WP_Error();
	
		if ( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] )
			$errors->add( 'password_reset_mismatch', 'The passwords do not match.'  );
	
		do_action( 'validate_password_reset', $errors, $user );
	
		if ( ( ! $errors->get_error_code() ) && isset( $_POST['pass1'] ) && !empty( $_POST['pass1'] ) ) {
			reset_password($user, $_POST['pass1']);
			wp_redirect( site_url('wp-login.php?action=login') );
			exit;
		}
	
		wp_enqueue_script('utils');
		wp_enqueue_script('user-profile');
		
		// CHECK FOR ERRORS		
		if(isset($_POST['pass1'])){
		$string .= $this->_show_errors($errors);
		} 
		
		// LOAD IN PAGE TEMPLATE
		get_template_part( 'page', 'reset' );
	 
	}
	
	function _show_password(){ global $CORE, $errortext, $wpdb;
	
		if ( isset($_POST['user_login']) && $_POST['user_login'] ) {
			 	
			$errors = new WP_Error();
		 	 
			if(!function_exists('retrieve_password')){
			//include(str_replace("wp-content","",WP_CONTENT_DIR)."/wp-includes/user.php");
			$errors = $this->retrieve_password1();	
			}else{
			$errors = retrieve_password();	
			}
		 
			 
			// ADD LOG ENTRY AND REDIRECT USER
			if ( !is_wp_error($errors) ) {
				
				// ADD LOG	
				$CORE->ADDLOG("User Forgot Password", 0, 0, $_POST['user_login'], "account", "" );
				
				// CONFIRM
				wp_redirect('wp-login.php?checkemail=confirm');
				exit();
			}
			
			do_action('lostpassword_post');
			
		}
		
		// CHECK FOR ERRORS
		if ( isset($_GET['error']) && $_GET['error'] == 'invalidkey'   ){
			$errors = new WP_Error();
			$errors->add('invalidkey', __("Sorry, that key does not appear to be valid.","premiumpress"),'cp');
			$errors->add('registermsg', __("Please enter your username or e-mail address. You will receive a new password via e-mail.","premiumpress"), 'message');
		}
	 
		if(!isset($_POST['user_login'])){ $_POST['user_login']=""; }
		
		if(!isset($errors)){ $errors=""; }
	 
		if(isset($_POST['user_login'])){ $errortext = $this->_show_errors($errors); }	
		
		// LOAD IN PAGE TEMPLATE
		get_template_part( 'page', 'forgottenpassword' );
	
	} 
	
	
	function retrieve_password1() {
    $errors = new WP_Error();
 
    if ( empty( $_POST['user_login'] ) || ! is_string( $_POST['user_login'] ) ) {
        $errors->add( 'empty_username', __( '<strong>ERROR</strong>: Enter a username or email address.' ) );
    } elseif ( strpos( $_POST['user_login'], '@' ) ) {
        $user_data = get_user_by( 'email', trim( wp_unslash( $_POST['user_login'] ) ) );
        if ( empty( $user_data ) ) {
            $errors->add( 'invalid_email', __( '<strong>ERROR</strong>: There is no account with that username or email address.' ) );
        }
    } else {
        $login     = trim( $_POST['user_login'] );
        $user_data = get_user_by( 'login', $login );
    }
 
    /**
     * Fires before errors are returned from a password reset request.
     *
     * @since 2.1.0
     * @since 4.4.0 Added the `$errors` parameter.
     *
     * @param WP_Error $errors A WP_Error object containing any errors generated
     *                         by using invalid credentials.
     */
    do_action( 'lostpassword_post', $errors );
 
    if ( $errors->has_errors() ) {
        return $errors;
    }
 
    if ( ! $user_data ) {
        $errors->add( 'invalidcombo', __( '<strong>ERROR</strong>: There is no account with that username or email address.' ) );
        return $errors;
    }
 
    // Redefining user_login ensures we return the right case in the email.
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $key        = get_password_reset_key( $user_data );
 
    if ( is_wp_error( $key ) ) {
        return $key;
    }
 
    if ( is_multisite() ) {
        $site_name = get_network()->site_name;
    } else {
        /*
         * The blogname option is escaped with esc_html on the way into the database
         * in sanitize_option we want to reverse this for the plain text arena of emails.
         */
        $site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
    }
 
    $message = __( 'Someone has requested a password reset for the following account:' ) . "\r\n\r\n";
    /* translators: %s: site name */
    $message .= sprintf( __( 'Site Name: %s' ), $site_name ) . "\r\n\r\n";
    /* translators: %s: user login */
    $message .= sprintf( __( 'Username: %s' ), $user_login ) . "\r\n\r\n";
    $message .= __( 'If this was a mistake, just ignore this email and nothing will happen.' ) . "\r\n\r\n";
    $message .= __( 'To reset your password, visit the following address:' ) . "\r\n\r\n";
    $message .= '<' . network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' ) . ">\r\n";
 
    /* translators: Password reset email subject. %s: Site name */
    $title = sprintf( __( '[%s] Password Reset' ), $site_name );
 
    /**
     * Filters the subject of the password reset email.
     *
     * @since 2.8.0
     * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
     *
     * @param string  $title      Default email title.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     */
    $title = apply_filters( 'retrieve_password_title', $title, $user_login, $user_data );
 
    /**
     * Filters the message body of the password reset mail.
     *
     * If the filtered message is empty, the password reset email will not be sent.
     *
     * @since 2.8.0
     * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
     *
     * @param string  $message    Default mail message.
     * @param string  $key        The activation key.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     */
    $message = apply_filters( 'retrieve_password_message', $message, $key, $user_login, $user_data );
 
    if ( $message && ! wp_mail( $user_email, wp_specialchars_decode( $title ), $message ) ) {
        wp_die( __( 'The email could not be sent.' ) . "<br />\n" . __( 'Possible reason: your host may have disabled the mail() function.' ) );
    }
 
    return true;
}
	
	function USER_LOGIN($username, $pass, $return = 0){ global $user, $CORE, $errortext; 
	
			$creds = array();
			$creds['user_login'] 	= $username;
			$creds['user_password'] = $pass;
			$creds['remember'] 		= true;
			
			// CHECK FOR SECURE LOGINS
			if ( is_ssl() && force_ssl_login() && !force_ssl_admin() 
			&& ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) ){
				$secure_cookie = false;
			}else{
				$secure_cookie = '';
			}
			
			// CHECK FOR EMAIL LOGIN
			if(strpos($creds['user_login'],"@") !== false){
			
				$e = get_user_by( 'email', $creds['user_login'] );
				if(is_object($e) && isset($e->data->user_login)){
				$creds['user_login'] = $e->data->user_login;
				}			 
			}
	 
			$user = wp_signon($creds, $secure_cookie);
			
			 
			// SEE IF LOGIN WAS SUCCESSFULL
			if ( !is_wp_error($user) ) {
			
			
				//CHECK FOR USER MEMBERSHIP DATA, IF ITS EXPIRED ASK THEM TO PAY AGAIN
				$membership_payment_due = get_user_meta($user->ID, 'wlt_membership_due', true);
			 
				if(is_numeric($membership_payment_due) && $membership_payment_due > 0){
					
					// LOG USER OUT
					wp_logout();
					
					// REDIRECT TO PAYMENT
					if($return){
					return home_url()."/wp-login.php?action=membership&uid=".$user->ID;
				 
					}else{
					header("location: ".home_url()."/wp-login.php?action=membership&uid=".$user->ID);
					exit();
					}
					
				}
				
			
				// UPDATE LAST LOGINS
				$llg = get_user_meta($user->ID, 'login_last', true);
				if($llg == ""){ $llg = current_time( 'mysql' ); }
				
				update_user_meta($user->ID, 'login_last', current_time( 'mysql' ));
				
				update_user_meta($user->ID, 'login_lastdate', $llg );
				
				// LOGIN IP
				update_user_meta($user->ID, 'login_ip', $this->get_client_ip());
				
				// UPDATE LOGIN COUNT
				$ll = get_user_meta($user->ID, 'login_count', true);
				if($ll == ""){ $ll = 1; }else{ $ll++; }
				update_user_meta($user->ID, 'login_count', $ll);
				
				// CLEAN-UP FAVS LIST
				$extn = "_list";
				if(defined('WP_ALLOW_MULTISITE')){
					$extn .= get_current_blog_id();
				}	
				$my_list = get_user_meta($user->ID, 'favorite'.$extn,true);
			 
				if(!is_array($my_list)){ $my_list = array(); }
				foreach($my_list as $hk => $hh){ if($hh == 0 || $hh == ""){ unset($my_list[$hk]); }elseif ( get_post_status ( $hh ) != 'publish'  && get_post_type( $hh ) != THEME_TAXONOMY."_type" ) {  unset($my_list[$hk]); } }			  
				update_user_meta($user->ID, 'favorite'.$extn, $my_list);			
				
				// ADMIN LINK
				$admin_link =  admin_url();
				
				// CHECK FOR EMAIL
				$data = array(				 		
				"username" => $this->user_display_name($user->ID),			 
				); 		
				$this->email_system($user->ID, 'login', $data);
				
				
				
				// REDIRECT USER TO ACCOUNT PAGE
				if(isset($_POST['redirect_to']) && strlen($_POST['redirect_to']) > 1 ){
									
					$redirect_to 		= $_POST['redirect_to'];
					
				}elseif( user_can($user->ID, 'administrator') || user_can($user->ID, 'contributor') ){	
				
					//if(user_can($user->ID, 'administrator')){
					$redirect_to = $admin_link."admin.php?page=premiumpress";
					//}else{
					//$redirect_to = $admin_link."";
					//}
						 
					 
				}else{			
					$redirect_to 		= _ppt(array('links','myaccount'));
				}
				 
				if($redirect_to == ""){ $redirect_to = get_home_url(); }
				 	
				// ADD LOG					
				$CORE->ADDLOG("User Logged In!", $user->data->ID, 0,$user->data->user_nicename, "account", "" );
				 
			 	
				if($return){
				return $redirect_to;
				}else{
				header("location: ".$redirect_to);
				exit();
				}
				
			}else{ 
			 	
				return $user;
			}
			
	}
	function USER_REGISTER($user, $pass, $email, $autosignin = 0, $redirectout = 1, $redirecturl = ""){
 
		global $CORE, $wpdb;
		
		// REGISTER THE NEW USER			 
		$errors = wp_create_user( $user, $pass, $email );  
		 
		// CHECK FOR ERRORS	 
		if ( is_wp_error($errors) ) {
		
			return $errors;
		
		}else{
				 
					// REGISTER ANY NEW CUSTOM REGISTRATION FIELDS
					if(isset($_POST['custom'])){ 
						foreach($_POST['custom'] as $key=>$val){
							if(!is_array($val)){
							add_user_meta( $errors, $key, esc_html(strip_tags($val)), true);
							}else{
							add_user_meta( $errors, $key, esc_html($val), true);
							}							
						} 
					}
					
					// ADD-ON FIRST / LAST NAME				 
					if(isset($_POST["first_name"]) && $_POST["first_name"] != "" ){
							$data = array();
							$data['ID'] 			= $errors;
							$data['first_name'] 	= esc_html(strip_tags($_POST["first_name"]));						 	
							wp_update_user( $data );
					}
							
					if(isset($_POST["last_name"]) && $_POST["last_name"] != "" ){
							$data = array();
							$data['ID'] 		= $errors;
							$data['last_name'] 	= esc_html(strip_tags($_POST["last_name"]));						 	
							wp_update_user( $data );
					}
					
					// SETUP DEFAULT MEMBERSHIP
					if(_ppt('regmembership') != "" & strlen(_ppt('regmembership')) > 1){
					
						$sd = $CORE->get_subscription_data(_ppt('regmembership'));
						
						if(is_array($sd)){
						update_user_meta( $errors ,'wlt_subscription', 
							array(
								"key" => _ppt('regmembership'), 
								"date_start" => date("Y-m-d H:i:s"), 
								"date_expires" => date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " + ".$sd['days']." days")),
								"listings" => 0,
								"flistings" => 0,
							)
						);
						}				
					
					}
					
					
					 
					$_POST['username'] = $user;
					$_POST['user_login'] = $user;
					// SEND WELCOME EMAIL
					global $CORE;
					 
					
					// SEND WELCOME EMAIL
					$data = array(				 		
					"username" => $user,
					"password" => $pass,
					"email" => $email			 
					); 		
					$this->email_system($errors, 'welcome', $data);
					$this->email_system('admin', 'admin_welcome', $data);
					 						
					// SEND THE NEW USER THEIR LOGIN DETAILS
					if(_ppt('wordpress_welcomeemail') == '1'){
					wp_new_user_notification( $errors, $pass );	
					}
					// ADD LOG ENTRY
					
					// ADD LOG					
					$CORE->ADDLOG("New User Joined!", $errors, 0,$user, "account", "" );
				 
					// AUTO LOGIN NEW USER IF THEY SETUP A PASSWORD
					if($autosignin == 1){	
						$creds = array();
						$creds['user_login'] 	= $user;
						$creds['user_password'] = $pass;
						$creds['remember'] 		= true;
						$user = wp_signon( $creds, false );
					}
					 
					
				// REDIRECT USER TO ACCOUNT PAGE	
				if($redirectout == 1){
					
					if($redirecturl != ""){	
								
						$redirect_to 		= $redirecturl;
						
					}elseif(isset($_POST['redirect_to']) ){					
						 
							$redirect_to 		= $_POST['redirect_to'];	
											
					}else{
							$redirect_to = site_url('wp-login.php?fr=1', 'login_post'); // NEW ACCOUNTS
					}	
								 
					header("location: ".$redirect_to);
					exit();
				
				}else{
			
					return $user;
				
				}
					
			}// no errors
					
		
	}
	
	function _show_register(){
	
		global $CORE, $errortext, $errorStyle; $user_login = ''; $user_email = ''; 
		
		$errorStyle = "alert-danger";
		
		
		// CHECK IF REGISTRATION IS ENABLED
		if ( !get_option('users_can_register') && !defined('WLT_DEMOMODE') ) {
			wp_redirect(get_bloginfo('wpurl').'/wp-login.php?registration=disabled');
			exit();
		} 
		
		// LOAD IN ERRORS
		$errors = new WP_Error(); 
		
		// PERFORM ACTION AFTER USER SUBMISSION
		if ( isset($_POST['ppt_spam_hash']) && isset($_POST['user_login']) && strlen($_POST['user_login']) > 2 && empty($errors->errors) ) { 
	 		 
			// CLEAN UP USER INPUT
			$sanitized_user_login = sanitize_user( $_POST['user_login'] );
			$user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );
			 
	 
			// BASIC FORM VALIDATION			
			if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != "" && _ppt('google_recap_secretkey') != "" ){
			 $canContinue = google_validate_recaptcha();
			 if(!$canContinue){
			  
				$errors->add('registered', __("The security question answer is incorrect.","premiumpress"), 'error');
			 
			 }
			}elseif( _ppt('comment_captcha') == 1 && ( $_POST['reg1'] + $_POST['reg2'] ) != $_POST['reg_val'] ){		
			$errors->add('registered', __("The security question answer is incorrect.","premiumpress"), 'error');		
			}
			
			if(_ppt('register_mobilenum') == 1 && strlen($_POST['custom']['mobile-num']) < 8){
			 
			$errors->add('registered', __("Please enter a valid mobile number.","premiumpress"), 'error');	
			}
			
			if(isset($_POST['first_name']) && $_POST['first_name'] == $_POST['last_name'] ){
			$errors->add('registered', __("Your first &amp; last names cannot be the same.","premiumpress"), 'error');	
			}
			 
			
			if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
			$errors->add('registered', __("The email address provided is invalid.","premiumpress"), 'error');	
			}
			
			if(_ppt('visitor_password') == 1 &&  ( isset($_POST['pass1']) && $_POST['pass1'] == "" ) || ( isset($_POST['pass1']) && strlen($_POST['pass1']) < 5 ) ){
			 
			$errors->add('registered', __("The password cannot be blank or less than 5 characters.","premiumpress"), 'error');	
			}
			
			
			if( _ppt('visitor_password') == 1 && (  $_POST['pass1']  != $_POST['pass2'] )  ){		
			$errors->add('registered', __("The passwords don't match.","premiumpress"), 'error');		
			}		
			
			
			// CHECK FOR PLUGIN ERRORS
			$errors = apply_filters( 'registration_errors', $errors, $sanitized_user_login, $user_email );
		 
			// CONTINUE ONTO STEP 1
			if ( $errors->get_error_code() ) {
			
			}else{
						 
				// GENERATE PASSWORD
				if(_ppt('visitor_password') == '1' && $_POST['pass2'] !=""){			
					$_POST['password'] = strip_tags($_POST['pass2']);			
				}else{
					$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
					$_POST['password'] = $random_password;	
				}
				
				// CREATE NEW USER
				$errors = $this->USER_REGISTER($sanitized_user_login, $_POST['password'], $user_email, _ppt('visitor_password'));	
				 
			} // END ERROR CHECK 1	
			
				
		}// END PERFORM ACTION
	
		// CHECK FOR ERRORS 
		if(isset($sanitized_user_login)){
		$errortext = $this->_show_errors($errors);
		}
		
		// LOAD IN PAGE TEMPLATE
		get_template_part( 'page', 'register' );
	
	}
	function _show_login() {
	

	
	
		global $CORE, $errortext, $errorStyle;  $errors = new WP_Error();
		
		$errorStyle = "alert-danger";
		
		if	( isset($_GET['fr']) && _ppt('visitor_password') == '1'  ){
		
			$errors->add('loggedout', __("Registration complete, you can now login.","premiumpress"), 'message'); 
			$errorStyle = "alert-success";
			
		}elseif(isset($_GET['fr'])){	
		
			$errors->add('loggedout', __("Check your e-mail for the confirmation link.","premiumpress"), 'message');
			
			$errorStyle = "alert-info"; 
		}
	
		// PERFORM LOGIN CHECKS // ACCESS DETAILS
		if(isset($_GET['noaccess'])){
		
			$errors->add('loggedout', __("Please login to access this page.","premiumpress"), 'message');
		
		}elseif(isset($_GET['socialloginerror'])){
		
			$errors->add('loggedout', __("Not enough information from your social profile could be found. Please use the register page to create a new profile on our website.","premiumpress"), 'message');
		
		}elseif	( isset($_GET['loggedout']) && TRUE == $_GET['loggedout'] ){
		
			$errors->add('loggedout', __("You are now logged out.","premiumpress"), 'message');
			$errorStyle = "alert-info";
		
		}elseif	( isset($_GET['registration']) && 'disabled' == $_GET['registration'] ){
			
			$errors->add('registerdisabled',  "".__("User registration is currently not allowed.","premiumpress") );
		
		}elseif	( isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail'] ){
			
			$errors->add('confirm', __("Check your e-mail for the confirmation link.","premiumpress"), 'message');
			$errorStyle = "alert-info";
		
		}elseif	( isset($_GET['checkemail']) && 'newpass' == $_GET['checkemail'] )	{
		
			$errors->add('newpass',  __("Check your e-mail for your new password.","premiumpress"), 'message');
			$errorStyle = "alert-info";
		
		}elseif	( isset($_GET['checkemail']) && 'registered' == $_GET['checkemail'] ){
			
			$errors->add('registered', __("Registration complete.","premiumpress"), 'message'); 
			$errorStyle = "alert-success";
		}
		
		// CHECK FOR PLUGIN ERRORS 
		if(isset($_POST['log']) && strlen($_POST['log']) > 1 ){
			$plugin_error = apply_filters('login_errors','');
			 if(strlen($plugin_error) > 5){
				$errors->add('registered', $plugin_error, 'error');
			 }
		}
		 
		// CHECK FOR BASIC ERRORS AND THAT THE FORUM HAS BEEN PRESSED
		if ( empty($errors->errors) && isset($_POST['log'])  ) {
	 
			// CHECK FOR SECURE LOGINS
			if ( is_ssl() && force_ssl_login() && !force_ssl_admin() 
			&& ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) ){
				$secure_cookie = false;
			}else{
				$secure_cookie = '';
			}
			
			// LOGIN USER
			$errors = $this->USER_LOGIN($_POST['log'], $_POST['pwd']);		
	 
		
		} // end basic validation		
	
		// CHECK FOR ERRORS	
		$errortext = $this->_show_errors($errors);
		
		// LOAD IN REGISTER PAGE TEMPLATE
		get_template_part( 'page', 'login' );
		
	}
	function _show_errors($wp_error) {
	
		global $error, $CORE;
		
		if ( !empty( $error ) ) {
			$wp_error->add('error', $error);
			unset($error);
		}
	
		if ( !empty($wp_error) ) {
			if ( $wp_error->get_error_code() ) {
				$errors = '';
				$messages = '';
				
				foreach ( $wp_error->get_error_codes() as $code ) {			
				
					$severity = $wp_error->get_error_data($code);
					
					
					if($code == "incorrect_password" || $code == "invalid_username"){
						return __("The login credentials you entered were incorrect.","premiumpress");
					}else{
							// disable default WP error message
						foreach ( $wp_error->get_error_messages($code) as $error ) {
							if ( 'message' == $severity )
	
								$messages .= $error ;
							else
								$errors .= $error;
						}
					}
				}
				if ( !empty($errors) )
					//echo $COREDesign->GL_ALERT( $errors ,"error");
					return $errors;
				if ( !empty($messages) ) 	
					//echo $COREDesign->GL_ALERT( $messages ,"success");
					return $messages;
			}
		}
	}
 	 
	
}

?>