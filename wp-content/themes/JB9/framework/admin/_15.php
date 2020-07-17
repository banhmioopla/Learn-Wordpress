<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $ADSEARCH, $CORE_ADMIN;

$existing_values = get_option("core_admin_values");



function include_thickbox_scripts()    
{
    // include the javascript    
    wp_enqueue_script('thickbox', null, array('jquery'));

    // include the thickbox styles    
    wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');

}

add_action('wp_enqueue_scripts', 'include_thickbox_scripts');
 
// TABS
wp_enqueue_script( 'jquery-ui-tabs' );

if(isset($_GET['nid']) && is_numeric($_GET['nid']) ){

$GLOBALS['error_message'] = "<h4>Template Created Successfully</h4><div class='mt-3' style='font-weight:normal !important'> Click here to <a href='".home_url()."/wp-admin/post.php?post=".$_GET['nid']."&action=elementor"."' target='_blank'> <u>edit the template </u></a>"; 

}

if(defined('WLT_CHILDTHEME') && isset($_POST) && isset($_POST['doinstallelementor']) ){

global $CHILDTHEME;
 
		// GET TEMPLATES		 
		$templates = $CHILDTHEME->_elementor_templates(array());
		
		
		// LOAD IN WORDPRESS FILE UPLOAOD CLASSES
		if(!empty($templates)){
		$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
		if(!function_exists('get_file_description')){
		if(!defined('ABSPATH')){
		require $dir_path . "/wp-load.php";
		}
		require $dir_path . "/wp-admin/includes/file.php";
		require $dir_path . "/wp-admin/includes/media.php";	
		}
		if(!function_exists('wp_generate_attachment_metadata') ){
		require $dir_path . "/wp-admin/includes/image.php";
		}
		}
		 
		if(!empty($templates)){ foreach($templates as $key => $t){	
		 			
			$elementor_file = $t['file'];	
			
			if(!file_exists($elementor_file)){ continue; }
		 		 	
			$elementor_importer = new PremiumPress_Elementor_Importer();
			$id = $elementor_importer->import_elementor_file( $elementor_file, $t['name'] );
			
			// SET CANVUS
			update_post_meta($id, '_wp_page_template', 'elementor_canvas');
			 
			if(is_numeric($id)){
			 
				if(isset($t['header'])  ){
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['header'] =  "elementor-".$id;					
					update_option( "core_admin_values", $existing_values);
				
				}elseif(isset($t['footer']) ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['footer'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'faqpage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['faq'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'contactpage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['contact'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'howpage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['how'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'testimonialspage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['testimonials'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'aboutuspage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['aboutus'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'listingpage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['defaultlisting'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
			  	
				}elseif(isset($t['homepage']) ){
				
				
					// NOW WE HAVE TO CREATE A BLANK PAGE AND ASSIGN THIS A SHORTCODE
					$page = array();
					$page['post_title'] 	= "Elementor - Homepage {".date('l jS \of F Y h:i:s A')."}";
					$page['post_content'] 	= '[premiumpress_elementor_template id="'.$id.'"]';
					$page['post_status'] 	= 'publish';
					$page['post_type'] 		= 'page';
					$page['post_author'] 	= 1;
					$page_id = wp_insert_post( $page );
					
					update_post_meta($page_id, '_wp_page_template', 'elementor_header_footer');	
							
					// UPDATE WP HOMEPAGE					
					update_option('show_on_front', 'page');
					update_option('page_on_front', $page_id);
				 
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['homepage'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);				
				
				}else{				
				 	
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign'][$key] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
				}			
		
			}else{
						 
				die("Ops! There was an error creating one of the templates.");
				
			}
			
			// SAVE DATA FOR HISTORY
			$data = get_option('premiumpress_elemetor_templates');
			if(!is_array($data)){ $data = array(); }			
			$data[$key] = array(
				"date" => date('Y-m-d H:i:s'),
				"template_id" => $id,
				"page_id" => $page_id,
			);			
			update_option('premiumpress_elemetor_templates', $data);
		 
		 }}
		 
		 
 
}elseif(defined('WLT_CHILDTHEME') && isset($_POST) && isset($_POST['admin_values']['pageassign']) ){

  
	if($_POST['admin_values']['pageassign']['homepage'] != "" && $_POST['admin_values']['pageassign']['homepage'] != "0"){
	
	 		
		// NUMERIC = PAGE TEMPLATE
		if(is_numeric($_POST['admin_values']['pageassign']['homepage'])){		
		
			update_option('show_on_front', 'page');
			update_option('page_on_front', $_POST['admin_values']['pageassign']['homepage']);
	
		}elseif( substr($_POST['admin_values']['pageassign']['homepage'],0,9) == "elementor" ){
		
			if(get_option('homepageautocreate') != substr($_POST['admin_values']['pageassign']['homepage'],10,100) ){
		
			// NOW WE HAVE TO CREATE A BLANK PAGE AND ASSIGN THIS A SHORTCODE
			$page = array();
			$page['post_title'] 	= "Homepage - {auto create} ";
			$page['post_content'] 	= '[premiumpress_elementor_template id="'.substr($_POST['admin_values']['pageassign']['homepage'],10,100).'"]';
			$page['post_status'] 	= 'publish';
			$page['post_type'] 		= 'page';
			$page['post_author'] 	= 1;
			$page_id 				= wp_insert_post( $page );	 	 
			 
			update_post_meta($page_id, '_wp_page_template', 'elementor_header_footer');		
		
			update_option('show_on_front', 'page');
			update_option('page_on_front', $page_id);
			
			update_option('homepageautocreate', substr($_POST['admin_values']['pageassign']['homepage'],10,100));
			
			}
		
		}
	
	}else{
		update_option('show_on_front', 'page');
		update_option('page_on_front', 0);
	}


}elseif(isset($_GET['sethomepagesingle']) && is_numeric($_GET['sethomepagesingle'])  && !defined('WLT_DEMOMODE') ){
 
			// NOW WE HAVE TO CREATE A BLANK PAGE AND ASSIGN THIS A SHORTCODE
			$page = array();
			$page['post_title'] 	= "Homepage - ".date('l jS \of F Y h:i:s A');
			$page['post_content'] 	= '[premiumpress_elementor_template id="'.$_GET['sethomepagesingle'].'"]';
			$page['post_status'] 	= 'publish';
			$page['post_type'] 		= 'page';
			$page['post_author'] 	= 1;
			$page_id 				= wp_insert_post( $page );	 	 
			 
			update_post_meta($page_id, '_wp_page_template', 'elementor_header_footer');		
		
			update_option('show_on_front', 'page');
			update_option('page_on_front', $page_id);	
	
			// UPDATE CORE SETTINGS
			$existing_values = get_option("core_admin_values");	
			$existing_values['pageassign']['homepage'] =  "elementor-".$_GET['sethomepagesingle'];
			update_option( "core_admin_values", $existing_values);	
			 
			$GLOBALS['error_message'] = "New homepage updated - <a href='".home_url()."' target='_blank'><u>click here to view</u></a>";

// SET CUSTOM HOMEPAGE
}elseif(isset($_GET['sethomepage']) && is_numeric($_GET['sethomepage']) && !defined('WLT_DEMOMODE') ){
 
 	update_option('show_on_front', 'page');
	update_option('page_on_front', $_GET['sethomepage']);
	
	// GET THE CURRENT VALUES
	$existing_values = get_option("core_admin_values");	
	$existing_values['pageassign']['homepage'] =  $_GET['sethomepage'];	
	// MERGE WITH EXISTING VALUES
	$new_result = array_merge((array)$existing_values, $existing_values);
	// UPDATE DATABASE 		
	update_option( "core_admin_values", $new_result);
	
	$GLOBALS['error_message'] = "New homepage updated - <a href='".home_url()."' target='_blank'><u>click here to view</u></a>";

}elseif(isset($_GET['setheader']) && is_numeric($_GET['setheader']) && !defined('WLT_DEMOMODE') ){
 
 	
	// GET THE CURRENT VALUES
	$existing_values = get_option("core_admin_values");	
	$existing_values['pageassign']['header'] =  $_GET['setheader'];	
	// MERGE WITH EXISTING VALUES
	$new_result = array_merge((array)$existing_values, $existing_values);
	// UPDATE DATABASE 		
	update_option( "core_admin_values", $new_result);
	
	$GLOBALS['error_message'] = "New header updated - <a href='".home_url()."' target='_blank'><u>click here to view</u></a>";

}elseif(isset($_GET['setfooter']) && is_numeric($_GET['setfooter']) && !defined('WLT_DEMOMODE') ){
  	
	
	// GET THE CURRENT VALUES
	$existing_values = get_option("core_admin_values");	
	$existing_values['pageassign']['footer'] =  $_GET['setfooter'];	
	// MERGE WITH EXISTING VALUES
	$new_result = array_merge((array)$existing_values, $existing_values);
	// UPDATE DATABASE 		
	update_option( "core_admin_values", $new_result);
	
	$GLOBALS['error_message'] = "New footer updated - <a href='".home_url()."' target='_blank'><u>click here to view</u></a>";
}

// INSTALL ELEMENTOR TEMPLATE
if(isset($_GET['install_e_t']) && !defined('WLT_DEMOMODE') ){

	// GET TEMPLATES
	$templates = hook_v9_admin_elementor_templates(array()); 
	
	 
	if(!empty($templates)){ foreach($templates as $key => $t){
		
		if($key ==  $_GET['install_e_t']){		 	
			$elementor_file = $t['file'];			 	
			$elementor_importer = new PremiumPress_Elementor_Importer();
			$id = $elementor_importer->import_elementor_file( $elementor_file, $t['name'] );
			
 			// SET CANVUS
			update_post_meta($id, '_wp_page_template', 'elementor_canvas');
			
			if(is_numeric($id)){
			
				if(isset($t['header'])  ){					
					 
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['header'] =  "elementor-".$id;					
					update_option( "core_admin_values", $existing_values);
				
				}elseif(isset($t['footer']) ){				
				 
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['footer'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'faqpage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['faq'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'contactpage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['contact'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'howpage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['how'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'testimonialspage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['testimonials'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
					
				}elseif( $key == 'aboutuspage' ){				
					
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['aboutus'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
				
				}elseif(isset($t['homepage']) ){				
				
					// NOW WE HAVE TO CREATE A BLANK PAGE AND ASSIGN THIS A SHORTCODE
					$page = array();
					$page['post_title'] 	= "Elementor - Homepage {".date('l jS \of F Y h:i:s A')."}";
					$page['post_content'] 	= '[premiumpress_elementor_template id="'.$id.'"]';
					$page['post_status'] 	= 'publish';
					$page['post_type'] 		= 'page';
					$page['post_author'] 	= 1;
					$page_id = wp_insert_post( $page );	
					
					update_post_meta($page_id, '_wp_page_template', 'elementor_header_footer');	
							
					// UPDATE WP HOMEPAGE					
					update_option('show_on_front', 'page');
					update_option('page_on_front', $page_id);
				 
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign']['homepage'] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);				
				
				}else{
				
				
					// UPDATE CORE SETTINGS
					$existing_values = get_option("core_admin_values");	
					$existing_values['pageassign'][$key] =  "elementor-".$id;
					update_option( "core_admin_values", $existing_values);
				
				}	
			 
			$GLOBALS['refreshpage'] = $id;
			
			
			}else{
			$GLOBALS['error_message'] = "Ops! There was an error creating this template.";
			}
			
			if(!isset($page_id)){ $page_id = $id; }
			
			// SAVE DATA FOR HISTORY
			$data = get_option('premiumpress_elemetor_templates');
			if(!is_array($data)){ $data = array(); }			
			$data[$key] = array(
				"date" => date('Y-m-d H:i:s'),
				"template_id" => $id,
				"page_id" => $page_id,
			);			
			update_option('premiumpress_elemetor_templates', $data);
			
 			
		}
	
	}}
}

 

// LOAD IN OPTIONS FOR ADVANCED SEARCH
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );


if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){

if(isset($_GET['resethomepage'])){
	
	$myfile = '';
	
	// CHECK FOR HOME TEMPLATE FILE
 	if(!defined('WLT_CHILDTHEME') && defined('THEME_FOLDER') && file_exists(THEME_PATH."/".THEME_FOLDER."/template/home-template.txt") ){
	 
	 	$myfile 	= file_get_contents(THEME_PATH."/".THEME_FOLDER."/template/home-template.txt");
	 
 	
	}elseif(defined('THEME_FOLDER') &&  file_exists(THEME_PATH."/".THEME_FOLDER."/home-template.txt") ){
	 
		$myfile 	= file_get_contents(THEME_PATH."/".THEME_FOLDER."/home-template.txt");			
		 
	}
	 
	// CREATE A BLANK PAGE
	$page = array();
	$page['post_title'] 	= "Home Page";
	$page['post_content'] 	= $myfile;
	$page['post_status'] 	= 'publish';
	$page['post_type'] 		= 'page';
	$page['post_author'] 	= 1;
	$page_id = wp_insert_post( $page ); 
 	
	update_option('show_on_front','page');
	update_option('page_on_front', $page_id); 
	
	$GLOBALS['error_message'] = "Homepage Template Restored"; 
	$_GET['tab'] = "pagebuilder";
}

}
  
 		 
// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1); ?>

<div class="projects"></div>


<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>

<?php get_template_part('framework/admin/templates/admin', '15-overview' ); ?> 


<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;" id="savebutton123">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div>

<?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>


<?php if(isset($GLOBALS['refreshpage'])){ ?>
<script>
jQuery(document).ready(function(){
window.location.href="admin.php?page=15&nid=<?php echo $GLOBALS['refreshpage']; ?>";
});
</script>
<?php } ?>    
<?php echo $CORE_ADMIN->FOOTER(1); ?>