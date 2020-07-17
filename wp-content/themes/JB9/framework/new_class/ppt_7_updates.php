<?php


class framework_updates extends framework_shortcodes {
	
 
	
	// THIS FUNCTION IS USED TO UPDATE CHILD THEME STYLESHEET FILES
	function admin_update_child_theme(){ global $wpdb, $CORE;  $f = wp_get_theme(); $user_ip = $this->get_client_ip(); 
	 
		// DONT CHECK FOR LOCALHOST		 
		if(in_array($_SERVER['REMOTE_ADDR'], array(  '127.0.0.1', '::1')) ){ return; }
 		 
		$HandlePath = WP_CONTENT_DIR."/themes/";
		if($themes = opendir($HandlePath)) {      
			while(false !== ($theme = readdir($themes))){ 		
				if(strpos($theme,".") === false && substr($theme,0,9) == "template_" && file_exists($HandlePath.$theme."/style.css") ){	
				
					// OPEN THE CHILD THEME AND REPLACE THE THEME NAME WITH OUR SETUP ONE
					$file = $HandlePath.$theme."/style.css";				
					$file_contents = file_get_contents($file);			
					$fh = @fopen($file, "w");
					$file_contents = str_replace('[XXX]',$f->template,$file_contents);
					@fwrite($fh, $file_contents);
					@fclose($fh);				
				   
				}
			}			
		}
	
	} 
	
	function UPDATE_CHECK(){
		
		global $wpdb; $canContinue=true;	 
		
		
		// DONT CHECK FOR LOCALHOST		 
		if(in_array($_SERVER['REMOTE_ADDR'], array(  '127.0.0.1', '::1')) ){ return; }
		
			// CHECK FOR UPDATES
			if(defined('THEME_KEY')){
			$themekey=THEME_KEY;
			}else{
			$themekey="";
			}
			
			$updateserver = 'https://www.premiumpress.com/_themesv9/';
			$estr = '?t='.$themekey."&v=".THEME_VERSION."&l=".get_option("wlt_license_key")."&w=".get_site_url()."&e=".get_option('admin_email');
			 
			$response = wp_remote_get( $updateserver . 'version_check.php'.$estr );
				
			// CHECK RESPONSE
			if( !is_wp_error( $response ) ) {
					$newversion = $response['body'];
			} else {
				return false;
			}
			// SEE IF WE HAVE UPDATES AVAILABLE
			if($newversion == "0.0.0"){
				// FLUSH CACHE FOR FREE UPGRADE
				update_option("wlt_license_key","");
				update_option("wlt_license_upgrade","1");
				return "0.0.0";
			}				 
			// return
			return;	 
	} 
 	function check_for_theme_update($theme_data) { global $wp_version, $theme_version, $theme_base; $user_ip = $this->get_client_ip(); 
	 
		// DONT CHECK FOR LOCALHOST		 
		if(in_array($_SERVER['REMOTE_ADDR'], array(  '127.0.0.1', '::1')) ){ return; }
		
		if(empty($theme_data->checked)  ){ return $theme_data; } //|| $this->UPDATE_CHECK() == "0.0.0" || get_option('wlt_license_key') == ""
	 
		/*
		WE NEED TO WORK OUT THE CORE THEME KEY
		SO WE KNOW WHICH CHILD THEMES TO PRESENT TO THE USER
		*/
		$THEMEKEY = THEME_KEY;
		
		// NOW LOOP THROUGH ALL OUR THEMES TO CHECK FOR UPDATES
		if(is_array($theme_data->checked)){ 	
			
			// LOOP ALL THEMES
			foreach($theme_data->checked as $key => $version){
				
				// check theme name
				if(strlen($key) > 4 ){ continue; } 				
				 
				// build request				 
				$request = array(
						'slug' 		=> $key,
						'version' 	=> $version,
						"theme_key" => $THEMEKEY,
						'email' 	=>  get_option('admin_email'),
					);
				
				// Start checking for an update
				$send_for_check = array(
					'body' => array(
						'action' => 'theme_update', 
						'request' => serialize($request),
						'api-key' => md5(get_bloginfo('url'))
					),
					'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
				);
			 	
				// EXECUTE 
				$raw_response = wp_remote_post("https://www.premiumpress.com/_themesv9/", $send_for_check);
 				
				if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
					$response = unserialize($raw_response['body']);
			 
				// Feed the update data into WP updater
				if (isset($response['package'])){		 
					$theme_data->response[$key] = $response;
				}		
			
			} // end foreach
		}// end if 
		
		return $theme_data;
	}
	function check_for_plugin_update($plugin_data) { global $wp_version;
	
		return $plugin_data;
		// DISABLED IN 9.4.3	 
		
		// DONT CHECK FOR LOCALHOST
		if($this->get_client_ip() == "127.0.0.1"){ return; }
		
		
		/*
		WE NEED TO WORK OUT THE CORE THEME KEY
		SO WE KNOW WHICH CHILD THEMES TO PRESENT TO THE USER
		*/
		$THEMEKEY = THEME_KEY;
		
		//Comment out these two lines during testing.
		if (empty($plugin_data->checked)){ return $plugin_data; }
		
		// NOW LOOP THROUGH ALL OUR PLUGINS TO CHECK FOR UPDATES
		if(is_array($plugin_data->checked)){
			foreach($plugin_data->checked as $key => $version){
				// ONLY CHECK OUR PLUGINS FOR UPDATES
				if(substr($key,0,4) == "wlt_" || substr($key,0,3) == "v9_" ){
					
					$bits = explode("/",$key);		 
					$args = array(
						'slug' => $bits[0],
						'version' => $version,
						"theme_key" => $THEMEKEY,
					);
					$request_string = array(
							'body' => array(
								'action' => 'basic_check', 
								'request' => serialize($args),
								'api-key' => md5(get_bloginfo('url'))
							),
							'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
					);			 
					// SEND REQUEST TO OUR PLUGINS SERVER
					$raw_response = wp_remote_post("https://www.premiumpress.com/_plugins/", $request_string);				
			 
					if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)){
						$response = unserialize($raw_response['body']);	
						
						// Feed the update data into WP updater
						if (is_object($response) && !empty($response)){
							$plugin_data->response[$key] = $response;
						}				 
					}
					
				
				}// END IF	
			} // END FOREACH
		} // END IF	
		 
		return $plugin_data;
	}
 

	
	/* =============================================================================
	   CORE SYSTEM PLUGIN UPDATE TOOL
	   ========================================================================== */
	function themes_api_call($def, $action, $args) {
		global $theme_base, $api_url, $theme_version, $wp_version, $api_url;
		
		/*
		WE NEED TO WORK OUT THE CORE THEME KEY
		SO WE KNOW WHICH CHILD THEMES TO PRESENT TO THE USER
		*/
		
		if(!defined('THEME_KEY')){
		$THEMEKEY =  str_replace("9","",strtolower(get_option('template')));
		}else{
		$THEMEKEY = THEME_KEY;
		}
		
		if($THEMEKEY == ""){ $THEMEKEY = "dt"; }
		 	 
		if($action == "theme_information"){
	 
			 
			// SET SITE SO IT KNOWS WERE GOING TO UPDATE
			$plugin_info = get_site_transient('update_themes');
			  
			$request = array(
			'slug' => $args->slug,
			'version' => $theme_version,
			"theme_key" => $THEMEKEY,
			);
				 
			// BUILD STRING
			$request_string = array(
						'body' => array(
							'action' => $action, 
							'request' => serialize($request),
							'api-key' => md5(get_bloginfo('url')),
						),
						'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
					);				
				
			 
			// MAKE REQUEST
			$request = wp_remote_post("https://www.premiumpress.com/_childthemesv9/", $request_string);
	
			// PROCESS AND DISPLAY
			if (is_wp_error($request)) {
			
					$res = new WP_Error('themes_api_failed', 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>', 
					$request->get_error_message());
			
			} else {			
				
					$res = unserialize($request['body']);
					
					if ($res === false)
						$res = new WP_Error('themes_api_failed', 'An unknown error occurred', $request['body']);
			}
				
			return $res;
		
		
		}elseif($action == "query_themes"){
		
			if($args->browse == "premiumpress"){
			
			$pagenum = 0;
			if(isset($_POST['request']['page'])){
			$pagenum = $_POST['request']['page'];
			}
			
			// BUILD STRING
			$request_string = array(
						'body' => array(
							'action' => "query_themes",						
							'request' => serialize( array("theme_key" => $THEMEKEY, "theme" => THEME_KEY, "version" => THEME_VERSION, "pagenum" => $pagenum)),
							'api-key' => md5(get_bloginfo('url')),
						),
						'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
			);	
				  
			// MAKE REQUEST
			$request = wp_remote_post("https://www.premiumpress.com/_childthemesv9/", $request_string);
			   
			 // PROCESS AND DISPLAY
			if (is_wp_error($request)) {
					$res = new WP_Error('themes_api_failed', 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>', 
					$request->get_error_message());
			} else {
				
				$res = unserialize($request['body']);
					
				if ($res === false)
						$res = new WP_Error('themes_api_failed', 'An unknown error occurred', $request['body']);
				}
			 
				// RETURN DATA
				return $res;				
			}
		
		}	 
		
		// RETURN
		return $def;
	
	}  
	function plugin_api_call($def, $action, $args) {
		global  $wp_version;
		
		
		// RETURN IF INVALID		 
		if (!isset($args->slug)){ return false; } 
		if(substr($args->slug,0,4) != "wlt_" && substr($args->slug,0,3) != "v9_" ){ return $def; }
		// SET SITE SO IT KNOWS WERE GOING TO UPDATE
		$plugin_info = get_site_transient('update_plugins');
		// GET THE CURRENT VERSION 
		$current_version = $plugin_info->checked[$args->slug .'/'.$args->slug.'.php'];
		$args->version = $current_version;
		// BUILD STRING
		$request_string = array(
				'body' => array(
					'action' => $action, 
					'request' => serialize($args),
					'api-key' => md5(get_bloginfo('url'))
				),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
			);
		 // MAKE REQUEST
		$request = wp_remote_post("https://www.premiumpress.com/_plugins/", $request_string);
		// PROCESS AND DISPLAY
		if (is_wp_error($request)) {
			$res = new WP_Error('plugins_api_failed', 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>', $request->get_error_message());
		} else {
			$res = unserialize($request['body']);
			
			if ($res === false)
				$res = new WP_Error('plugins_api_failed', 'An unknown error occurred', $request['body']);
		}
		// RETURN
		return $res;
	} 
	
}

?>