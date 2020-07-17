<?php

 

class framework_mobile extends framework_user {

 
	
	
	function ppt_mobile_wp_head(){ global $pagenow;
	
	
		// LOAD IN FRAMEWORK CSS
		$css 	= array();
		$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.bootstrap.css';	
		//$css[] 	=  	FRAMREWORK_URI.'css/backup_css/css.typography.css';		 
		$css[] 	=	get_template_directory_uri()."/".THEME_FOLDER.'/css.global.css';	
		
		$i = 1; $buffer = "";
		foreach($css as $file){
			//wp_register_style( 'framework'.$i, $file);	 
	 		//wp_enqueue_style( 'framework'.$i );  
			$i++;
			$buffer .= file_get_contents($file);
		}
		
		// LOAD IN ANY EXTRA STYLES FROM THE PAGE ITSELF
		$buffer = hook_v9_extra_css_mobile($buffer);				  
		// Remove comments
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		// sort images
		$buffer = str_replace('.../img/', get_template_directory_uri().'/'.THEME_FOLDER.'/template/img/', $buffer);
		// sort images
		$buffer = str_replace('../img/', get_template_directory_uri().'/framework/img/', $buffer);
		// Remove space after colons
		$buffer = str_replace(': ', ':', $buffer);
		// Remove whitespace
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
			
		echo "<style>".$buffer."</style>";
		
		
		
		wp_enqueue_script('jquery', includes_url( '/js/jquery/jquery.js' ),false);		
		
		// LOAD IN FRAMEWORK
		wp_enqueue_script('bootstrap', FRAMREWORK_URI.'js/backup_js/js.bootstrap.js','','',true);
 		wp_enqueue_script('framework', FRAMREWORK_URI.'js/backup_js/js.framework.js','','',true);
		 
	
	}
	
	function ppt_mobile_wp_footer(){ global $pagenow;
	
	
	}
	
	function isMobileDevice(){ global $userdata;
	
	 	// DEBUG MODE
		if(defined('WLT_DEBUG_MOBILE')){
			define('IS_MOBILEVIEW', true);
			return true;
		}


		// GET THE BROWSER AGENTS
        $agent = $_SERVER["HTTP_USER_AGENT"]; 
		   
		// CHECK FOR MOBILE DEVICE
		if (strpos(strtolower($agent), "facebook") === false) { }else{ return false;}	
		 
        $mobile = false;
        $agents = array("Alcatel", "Blackberry", "HTC",  "LG", "Motorola", "Nokia", "Palm", "Samsung", "SonyEricsson", "ZTE", "iPhone", "iPod", "Mini", "Playstation", "DoCoMo", "Benq", "Vodafone", "Sharp", "Kindle", "Nexus", "Windows Phone", "Mobile",'mobile');
        foreach($agents as $a){
		 
            if(stripos($agent, $a) !== false){
			 
				// SET CONSTANT
				if(!defined('IS_MOBILE_DEVICE')){
				//define('IS_MOBILE_DEVICE', true); 
				}
            }
        } 
		
	 
		// DEBUG
		if(!defined('IS_MOBILEVIEW') && defined('IS_MOBILE_DEVICE') && _ppt('mobileweb') == 1 && !isset($_SESSION['desktopiew']) ){		 
			//define('IS_MOBILEVIEW', true);
			return true; 
		}
		 
		// MOBILE VIEW VIA SESSION
		if(!defined('IS_MOBILEVIEW') && defined('IS_MOBILE_DEVICE') && _ppt('mobileweb') == 1 && ( isset($_SESSION['mobileview']) || isset( $_GET['emptycart']) )  ){
			//define('IS_MOBILEVIEW', true);
			return true; 
		} 
		
        return false;
	}	
	
	
	function pageswitch(){
	
		if(defined('IS_MOBILEVIEW')){
		 
			return 'mobile';
		}	
	} 
	
}
 
?>