<?php

function footerChoices($style){

if($style){

 $ha = array(
	
    0 => array("id" => "0", "name" => "None", "icon" => "ft1.jpg"),
    1 => array("id" => "1", "name" => "Newsletter", "icon" => "ft2.jpg"),
    2 => array("id" => "2", "name" => "Links + Newsletter", "icon" => "ft3.jpg"),
    3 => array("id" => "3", "name" => "Text + Links", "icon" => "ft4.jpg"),
    4 => array("id" => "4", "name" => "Text + Newsletter", "icon" => "ft5.jpg"),
	 
); 

}else{

 $ha = array(
	
	0 => array("id" => "0", "name" => "&copy; Default", "icon" => "f1.jpg"),
    1 => array("id" => "1", "name" => "&copy; Centered", "icon" => "f2.jpg"),
    2 => array("id" => "2", "name" => "&copy; Basic", "icon" => "f3.jpg"),
); 

}


$choices = array();
	foreach($ha as $k => $h){
		$choices[$k] = array(
			"label" 	=> $h['name'],
			"css_class" => "",
			"image" 	=> get_template_directory_uri()."/framework/admin/images/".$h['icon'],
			"video_src" => "",
		);
	}
return $choices;
}

function footerChoices1($style){

	if($style == 1){
	
		$ha = array(	
			0 => "None", 
			1 => "Newsletter", 
			2 => "Links + Newsletter", 
			3 => "Text + Links", 
			4 => "Text + Newsletter",	 
		); 
	
	}else{
	
		$ha = array(	
			0 => "Child Theme Default",
			1 => "&copy; Centered", 
			2 => "&copy; Basic",
		); 
	
	}

	return $ha;
}


function headerChoices(){

 $ha = array(

	0 => array("id" => "0", "name" => "Child Theme Default", "icon" => "h1.jpg"),
	
	
	1 => array("id" => "1", "name" => "Classic", "icon" => "h2.jpg"),
	2 => array("id" => "2", "name" => "Transparent", "icon" => "h3.jpg"),
	3 => array("id" => "3", "name" => "Magazine", "icon" => "h4.jpg"),
	
	
	4 => array("id" => "4", "name" => "Search Basic", "icon" => "h5.jpg"),
	5 => array("id" => "5", "name" => "Search + Favs", "icon" => "h6.jpg"),
	6 => array("id" => "6", "name" => "Search + Login", "icon" => "h7.jpg"),
	7 => array("id" => "7", "name" => "Search + Icons", "icon" => "h8.jpg"),
	
	8 => array("id" => "8", "name" => "Centered", "icon" => "h9.jpg"),
	9 => array("id" => "9", "name" => "Simple", "icon" => "h10.jpg"),	
	
	10 => array("id" => "10", "name" => "Creative", "icon" => "h11.jpg"),
	11 => array("id" => "11", "name" => "Creative - Right", "icon" => "h12.jpg"),
	 
); 
$choices = array();
	foreach($ha as $k => $h){
		$choices[$k] = array(
			"label" 	=> $h['name'],
			"css_class" => "",
			"image" 	=> get_template_directory_uri()."/framework/admin/images/".$h['icon'],
			"video_src" => "",
		);
	}
return $choices;
}

function headerChoices1(){

	 return array( 
		 0 => "Child Theme Default", 
		 1 => "Classic", 
		 2 => "Transparent", 
		 3 => "Magazine",
		 4 => "Search Basic",
		 5 => "Search + Favs",
		 6 => "Search + Login",
		 7 => "Search + Icons",
		 8 => "Centered",
		 9 => "Simple",
		 10 => "Creative",
		 11 => "Creative - Right",	 
	);
}

function wlt_core_customerize_settings(){

global $wp_query, $wpdb; $fontlist = array(); $pageoptions = array();


$fonts = wlt_core_customerize_fonts();


foreach ($fonts as $key => $k){
	$fontlist[$key] = $k['code'];
}

if(is_customize_preview()){
	// GET PAGES
	$p = _ppt('pageassign');
	// BUILD PAGE OPTIONS
	$elementorArray = array();
	$args = array(
		'post_type' 		=> 'elementor_library',
		'posts_per_page' 	=> 50,
	);
	$wp_query = new WP_Query($args);
	$tt = $wpdb->get_results($wp_query->request, OBJECT);
	if(!empty($tt)){ foreach($tt as $p){
	$elementorArray["elementor-".$p->ID] = get_the_title($p->ID);
	} }
	$pageoptions = array('0' => '----- disabled ------');
	 
	foreach ( $elementorArray as $key => $title ) {
	$pageoptions[substr($key,10,100)] =  $title;
	} 

}

$maincolorarray = array(
 
"header"	=> array(
	"title" => "Theme - Header",
	"desc" => "asdad",
	"sections" => array(
	
		"Header Setup" => array(			
			"settings" => array(
			
				 /*
					"h0" => array(
					"title" 	=> "Override Header Template", 
					"description" => "Enable it to replace header section with an Elementor template.	<hr>",					
					"d" 		=> "select", 
					"type" 		=> "pageassign", 
					"div" 		=> "header", 
					"default" 	=> "0",
					"choices" 	=> $pageoptions,
					),		
				 */
				 
					"h0" => array(
					"title" 	=> "Header Style", 
					"d" 		=> "select", //imageselect 
					"type" 		=> "custom", 
					"div" 		=> "header_style", 
					"default" 	=> "0",
					"description" => "<b>Note:</b> Custom changes will <u>not display</u> if your child theme design is set.<hr>" ,
					"choices" => headerChoices1(),						
					
					),
					
					
					"h2" => array(
					"title" 	=> "Header Background", 
					"d" 		=> "select", 
					"type" 		=> "custom", 
					"div" 		=> "header_bg", 
					"default" 	=> "default",
					"description" => "" ,
					"choices" => array( "default" => "Default", "bg-dark" => "Dark" , "bg-light" => "Light", "bg-white" => "White", "bg-primary" => "Primary", "bg-secondary" => "Secondary"),							
					 
					),
					
					
					"h5a" => array(
					"title" 	=> "Menu Color (design dependant)", 
					"d" 		=> "select", 
					"type" 		=> "custom", 
					"div" 		=> "headernav_bg", 
					"default" 	=> "default",
					"description" => "" ,
					"choices" => array( "default" => "Default", "bg-dark" => "Dark" , "bg-light" => "Light", "bg-white" => "White", "bg-primary" => "Primary", "bg-secondary" => "Secondary"),							
					 
					),
					
					"h1" => array(
					"title" 	=> "Transparent Header on Homepage", 
					"d" 		=> "switch", 
					"type" 		=> "custom", 
					"div" 		=> "header_hometransparent", 
					"default" 	=> _ppt('header_hometransparent'),
					
					"description" => "" ,
					"choices" => array( "0" => "OFF", "1" => "ON" ),						
					 
					),
					
					
					
			
		
		),
		),
	

		"Top Navigation Bar" => array(			
			"settings" => array(
			
			
							
					"t0" => array(
					"title" 	=> "Enable Top Nav Bar", 
					"d" 		=> "switch", 
					"type" 		=> "custom", 
					"div" 		=> "header_topnav", 
					"default" 	=> "1",
					
					"description" => "" ,
					"choices" => array( "0" => "OFF", "1" => "ON" ),						
					 
					),
					
					"t1" => array(
					"title" 	=> "Nav Bar - Homepage", 
					"d" 		=> "switch", 
					"type" 		=> "custom", 
					"div" 		=> "header_topnavhome", 
					"default" 	=> "1",					
					"description" => "" ,
					"choices" => array( "0" => "OFF", "1" => "ON" ),
					),
					
					"t2" => array(
					"title" 	=> "Nav Bar - Style", 
					"d" 		=> "select", 
					"type" 		=> "custom", 
					"div" 		=> "header_topnavstyle", 
					"default" 	=> "header-top2",
					
					"description" => "" ,
					"choices" => array( "header-top1" => "Style 1", "header-top2" => "Style 2" , "header-top3" => "Style 3", "header-top4" => "Style 4"),						
					 
					),
					
					"t3" => array(
					"title" 	=> "Nav Bar - Color", 
					"d" 		=> "select", 
					"type" 		=> "custom", 
					"div" 		=> "header_topnavbg", 
					"default" 	=> "bg-dark",					
					"description" => "" ,
					"choices" => array( "default" => "Default", "bg-dark" => "Dark" , "bg-light" => "Light", "bg-white" => "White", "bg-primary" => "Primary", "bg-secondary" => "Secondary"),						
					),	
					
					
					"t4" => array(
					"title" 	=> "Nav Bar - Border Bottom", 
					"d" 		=> "switch", 
					"type" 		=> "custom", 
					"div" 		=> "header_topnavborderbottom", 
					"default" 	=> "0",					
					"description" => "" ,
					"choices" => array( "0" => "OFF", "1" => "ON" ),
					),  	
		
		),
		
		),
	 
		"Main Menu" => array(			
			"settings" => array(
			 
			 		
				
	 				
					
					
					"h3" => array(
					"title" 	=> "Header - Bottom Shadow", 
					"d" 		=> "switch", 
					"type" 		=> "custom", 
					"div" 		=> "header_shadow", 
					"default" 	=> "1",					
					"description" => "" ,
					"choices" => array( "0" => "OFF", "1" => "ON" ),
					),
					
					"h4" => array(
					"title" 	=> "Header - Link Seperator", 
					"d" 		=> "switch", 
					"type" 		=> "custom", 
					"div" 		=> "header_sep", 
					"default" 	=> "1",					
					"description" => "" ,
					"choices" => array( "0" => "OFF", "1" => "ON" ),
					),					
					
					"h5" => array(
					"title" 	=> "Header - Border Bottom", 
					"d" 		=> "switch", 
					"type" 		=> "custom", 
					"div" 		=> "header_borderbottom", 
					"default" 	=> "1",					
					"description" => "" ,
					"choices" => array( "0" => "OFF", "1" => "ON" ),
					),	
					 
					
										
				 
			),
		),
		
		
	
	"Breadcrumbs" => array(			
			"settings" => array(
					
					
					"c1" => array(
					"title" 	=> "Enable Breadcrumbs", 
					"d" 		=> "switch", 
					"type" 		=> "custom", 
					"div" 		=> "breadcrumbs", 
					"default" 	=> "0",
					"description" => "" ,
					"choices" => array( "0" => "OFF", "1" => "ON" ),	
					),
	
					"c2" => array(
					"title" 	=> "Enable Breadcrumbs", 
					"d" 		=> "select", 
					"type" 		=> "custom", 
					"div" 		=> "breadcrumbs_style", 
					"default" 	=> "3",
					"description" => "" ,
					"choices" => array( "1" => "Style 1", "2" => "Style 2", "3" => "Style 3", "4" => "Style 4" ),	
					),
	
	
		),
	
	),
		
		
	
		"Logo" => array(			
			"settings" => array(			
				
				"l1" => array(
					"title" => "Logo - Dark Version", 
					"d" => 3, 
					"type" => "logoimg", 
					"div" => "logo_url", 
					"default" => _ppt('logo_url'), 
					"description" => "Select your logo image file.<hr>"  
				),
		
				"l2" => array(
					"title" => "Logo - Light Version (optional) ", 
					"d" => 3, 
					"type" => "logoimg1", 
					"div" => "light_logo_url", 
					"default" => _ppt('light_logo_url'), 
					"description" => "This is only used on some child theme designs and not all themes.<hr>"  
				),
 
				
			),
		),
		
		
		
	),
	
),



"footer"	=> array(
	"title" => "Theme - Footer",
	"desc" => "asdad",
	"sections" => array(
	
		"Footer Section" => array(			
			"settings" => array(
			
			/*
				"f1" => array(
					"title" 	=> "Override Footer Template", 
					"description" => "Enable it to replace footer section with an Elementor template.	<hr>",					
					"d" 		=> "select", 
					"type" 		=> "pageassign",
					"div" 		=> "footer", 
					"default" 	=> "0",
					"choices" 	=> $pageoptions,
					),	
			 */
			
			"f2" => array(
					"title" 	=> "Content Section", 
					"d" 		=> "select", //imageselect
					"type" 		=> "custom", 
					"div" 		=> "footer_blockstyle", 
					"default" 	=> "1",
					"description" => "" ,
					"choices" => footerChoices1(1),						
					
				),
			
				"f3" => array(
					"title" 	=> "Copyright Section", 
					"d" 		=> "select", //imageselect 
					"type" 		=> "custom", 
					"div" 		=> "footer_style", 
					"default" 	=> "1",
					"description" => "" ,
					"choices" => footerChoices1(2),						
					
				), 
					
					
			),
		),
	 
	 
	 
	 
	),		
),
 

"global"	=> array(
	"title" => "Theme - Colors",
	"desc" => "asdad",
	"sections" => array(
	
		"Main Colors" => array(
			"settings" => array(
				
				"color_primary" => array("title" => "Primary Global Color {} ", "d" => "color", 
				"type" => "color_primary", "div" => "", "default" => _ppt('color_primary'), "description" => "" ),	
				
				
		 		"color_secondary" => array("title" => "Secondary Global Color {} ", "d" => "color", 
				"type" => "color_secondary", "div" => "", "default" => _ppt('color_secondary'), "description" => "" ),	
				
			),
			),
	 
			"Theme - Background Colors" => array(
			"settings" => array(
				
				"g0" => array("title" => "Website Background {} ", "d" => "color", "type" => "", "div" => "body", "default" =>  "", "description" => "" ),	
					
				"glight" => array("title" => "<hr>Light Background {} ", "d" => "color", "type" => "", "div" => ".bg-light", "default" =>  "#f8f9fa"),		
				"gdark" => array("title" => "Dark Background {} ", "d" => "color", "type" => "", "div" => ".bg-dark", "default" =>  "#343a40"),		
					
				"g1" => array("title" => "<hr>Primary Color Background {} ", "d" => "color", "type" => "", "div" => ".bg-primary", "default" =>  "", "description" => "" ),	
				"g2" => array("title" => "Secondary Color Background {} ", "d" => "color", "type" => "", "div" => ".bg-secondary", "default" =>  "#6c757d"),	
				
				
				"g3" => array("title" => "<hr>Red Background {} ", "d" => "color", "type" => "", "div" => ".bg-danger", "default" =>  "#dc3545"),		
				"g4" => array("title" => "Orange Background {} ", "d" => "color", "type" => "", "div" => ".bg-warning", "default" =>  "#ffc107"),		
				"g5" => array("title" => "Blue Background {} ", "d" => "color", "type" => "", "div" => ".bg-info", "default" =>  "#17a2b8"),		
				"g6" => array("title" => "Green Background {} ", "d" => "color", "type" => "", "div" => ".bg-success", "default" =>  "#28a745"),		
				
				
			),
			),
			 
			"Theme - Text Colors" => array(
				"settings" => array(
					
					"ga1" => array("title" => "Main Text {} ", "d" => "color", "type" => "txt", "div" => "body", "default" =>  ""),	
					
					"ga10" => array("title" => "<hr>Text Muted (grey) {} ", "d" => "color", "type" => "txt", "div" => ".text-muted", "default" =>  "#343a40"), 
					
					"ga9" => array("title" => "<hr>Primary Text {} ", "d" => "color", "type" => "txt", "div" => ".text-primary", "default" =>  ""),			
					
					"ga2" => array("title" => "Secondary Text {} ", "d" => "color", "type" => "txt", "div" => ".text-secondary", "default" =>  "#6c757d"),			
					"ga3" => array("title" => "<hr>Red Text {} ", "d" => "color", "type" => "txt", "div" => ".text-danger", "default" =>  "#dc3545"),		
					"ga4" => array("title" => "Orange Text {} ", "d" => "color", "type" => "txt", "div" => ".text-warning", "default" =>  "#ffc107"),		
					"ga5" => array("title" => "Blue Text {} ", "d" => "color", "type" => "txt", "div" => ".text-info", "default" =>  "#17a2b8"),		
					"ga6" => array("title" => "Green Text {} ", "d" => "color", "type" => "txt", "div" => ".text-success", "default" =>  "#28a745"), 		
					"ga7" => array("title" => "White Text {} ", "d" => "color", "type" => "txt", "div" => ".text-white", "default" =>  "#ffffff"), 
					"ga8" => array("title" => "Dark Text {} ", "d" => "color", "type" => "txt", "div" => ".text-dark", "default" =>  "#343a40"), 
					
					
				),
			),
			
			
		"Theme - Button Colors" => array(
			"settings" => array(
				
				1 => array("title" => "Primary Button {} ", "d" => "color", "type" => "btn", "div" => ".btn-primary, .btn-primary.disabled, .btn-primary:disabled", "default" =>  ""),	
				2 => array("title" => "Primary Button (border color)", "d" => "color", "type" => "bdc", "div" => ".btn-primary,.btn-outline-primary"),	
				3 => array("title" => "Primary Button (text color)", "d" => "color", "type" => "txt", "div" => ".btn-primary,.btn-outline-primary:hover", "default" =>  "#ffffff"  ),
				 
				4 => array("title" => "Secondary Button {} ", "d" => "color", "type" => "btn", "div" => ".btn-secondary,.btn-outline-secondary:hover", "description" => "<hr>"),	
				5 => array("title" => "Secondary Button (border color)", "d" => "color", "type" => "bdc", "div" => ".btn-secondary,.btn-outline-secondary", "default" =>  "#6c757d"),	
				6 => array("title" => "Secondary Button (text color)", "d" => "color", "type" => "txt", "div" => ".btn-secondary,.btn-outline-secondary:hover", "default" =>  "#ffffff" ),
				
				7 => array("title" => "Warning Button {} ", "d" => "color", "type" => "btn", "div" => ".btn-warning,.btn-outline-warning:hover" , "description" => "<hr>" ),	
				8 => array("title" => "Warning Button (border color)", "d" => "color", "type" => "bdc", "div" => ".btn-warning,.btn-outline-warning", "default" =>  "#ffc107"),	
				9 => array("title" => "Warning Button (text color)", "d" => "color", "type" => "txt", "div" => ".btn-warning,.btn-outline-warning:hover", "default" =>  "#ffffff"),
						
				10 => array("title" => "Info Button {} ", "d" => "color", "type" => "btn", "div" => ".btn-info,.btn-outline-info:hover" , "description" => "<hr>" ),	
				11 => array("title" => "Info Button (border color)", "d" => "color", "type" => "bdc", "div" => ".btn-info,.btn-outline-info", "default" =>  "#17a2b8"),	
				12 => array("title" => "Info Button (text color)", "d" => "color", "type" => "txt", "div" => ".btn-info,.btn-outline-info:hover", "default" =>  "#ffffff"  ),
						
				13 => array("title" => "Danger Button {} ", "d" => "color", "type" => "btn", "div" => ".btn-danger,.btn-outline-danger:hover", "description" => "<hr>"),	
				14 => array("title" => "Danger Button (border color)", "d" => "color", "type" => "bdc", "div" => ".btn-danger,.btn-outline-danger", "default" =>  "#dc3545"),	
				15 => array("title" => "Danger Button (text color)", "d" => "color", "type" => "txt", "div" => ".btn-danger,.btn-outline-danger:hover", "default" =>  "#ffffff" ),
						
			),
		),
			
			
		
	),
),


);


 
return $maincolorarray;
 

}


function wlt_core_customerize_fonts($val = ""){

$fontsA = array(); 
$fontsA["none"] = array( "google" => 0, "code" => 'Default System Font'); 
 
$fontsA["anton"] = array( "google" => 1, "code" => '"Anton", arial, serif');

$fontsA["arial"] = array( "google" => 0, "code" => 'Arial, "Helvetica Neue", Helvetica, sans-serif'); 

$fontsA["arial_black"] = array( "google" => 0, "code" => '"Arial Black", "Arial Bold", Arial, sans-serif');	 

$fontsA["arial_narrow"] = array( "google" => 0, "code" => '"Arial Narrow", Arial, "Helvetica Neue", Helvetica, sans-serif'); 
 
$fontsA["cabin"] = array( "google" => 1, "code" => 'Cabin, Arial, Verdana, sans-serif' ); 


$fontsA["cantarell"] = array( "google" => 1, "code" => 'Cantarell, Candara, Verdana, sans-serif'); 

$fontsA["cardo"] = array( "google" => 1, "code" => 'Cardo, "Times New Roman", Times, serif'); 
 
$fontsA["courier_new"] = array( "google" => 0, "code" => 'Courier, Verdana, sans-serif'); 


$fontsA["crimson_text"] = array( "google" => 1, "code" => '"Crimson Text", "Times New Roman", Times, serif'); 
 
$fontsA["cuprum"] = array( "google" => 1, "code" => '"Cuprum", arial, serif'); 
 
$fontsA["dancing_script"] = array( "google" => 1, "code" => '"Dancing Script", arial, serif'); 
 
$fontsA["droid_sans"] = array( "google" => 1, "code" => '"Droid Sans", "Lucida Grande", Tahoma, sans-serif'); 



$fontsA["droid_mono"] = array( "google" => 1, "code" => '"Droid Sans Mono", Consolas, Monaco, Courier, sans-serif'); 



$fontsA["droid_serif"] = array( "google" => 1, "code" => '"Droid Serif", Calibri, "Times New Roman", serif'); 

$fontsA["georgia"] = array( "google" => 0, "code" => 'Georgia, "Times New Roman", Times, serif'); 

$fontsA["im_fell_dw_pica"] = array( "google" => 1, "code" => '"IM Fell DW Pica", "Times New Roman", serif');

 

$fontsA["im_fell_english"] = array( "google" => 1, "code" => '"IM Fell English", "Times New Roman", serif');
 

$fontsA["inconsolata"] = array( "google" => 1, "code" => '"Inconsolata", Consolas, Monaco, Courier, sans-serif');
 
$fontsA["inconsolata"] = array( "google" => 1, "code" => '"Josefin Sans Std Light", "Century Gothic", Verdana, sans-serif');
 

$fontsA["kreon"] = array( "google" => 1, "code" => 'kreon, georgia,serif'); 

$fontsA["lato"] = array( "google" => 1, "code" => '"Lato", arial, serif'); 


$fontsA["lobster"] = array( "google" => 1, "code" => 'Lobster, Arial, sans-serif'); 

$fontsA["lora"] = array( "google" => 1, "code" => '"Lora", georgia, serif'); 

$fontsA["merriweather"] = array( "google" => 1, "code" => 'Merriweather, georgia, times, serif'); 

$fontsA["molengo"] = array( "google" => 1, "code" => 'Molengo, "Trebuchet MS", Corbel, Arial, sans-serif');	 

$fontsA["nobile"] = array( "google" => 1, "code" => 'Nobile, Corbel, Arial, sans-serif');

$fontsA["ofl_sorts_mill_goudy"] = array( "google" => 1, "code" => '"OFL Sorts Mill Goudy TT", Georgia, serif'); 

$fontsA["old_standard"] = array( "google" => 1, "code" => '"Old Standard TT", "Times New Roman", Times, serif');
 

$fontsA["reenie_beanie"] = array( "google" => 1, "code" => '"Reenie Beanie", Arial, sans-serif'); 

$fontsA["tangerine"] = array( "google" => 1, "code" => 'Tangerine, "Times New Roman", Times, serif'); 

$fontsA["times_new_roman"] = array( "google" => 1, "code" => '"Times New Roman", Times, Georgia, serif'); 

$fontsA["trebuchet_ms"] = array( "google" => 1, "code" => '"Trebuchet MS", "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", Arial, sans-serif'); 

$fontsA["verdana"] = array( "google" => 1, "code" => 'Verdana, sans-serif'); 

$fontsA["vollkorn"] = array( "google" => 1, "code" => 'Vollkorn, Georgia, serif'); 

$fontsA["yanone"] = array( "google" => 1, "code" => '"Yanone Kaffeesatz", Arial, sans-serif'); 
 

$fontsA["american_typewriter"] = array( "google" => 0, "code" => '"American Typewriter", Georgia, serif'); 

$fontsA["andale"] = array( "google" => 1, "code" => '"Andale Mono", Consolas, Monaco, Courier, "Courier New", Verdana, sans-serif'); 

$fontsA["baskerville"] = array( "google" => 1, "code" => 'Baskerville, "Times New Roman", Times, serif'); 


$fontsA["bookman_old_style"] = array( "google" => 1, "code" => '"Bookman Old Style", Georgia, "Times New Roman", Times, serif'); 


$fontsA["calibri"] = array( "google" => 1, "code" => 'Calibri, "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif'); 


$fontsA["cambria"] = array( "google" => 0, "code" => 'Cambria, Georgia, "Times New Roman", Times, serif'); 

$fontsA["candara"] = array( "google" => 0, "code" => 'Candara, Verdana, sans-serif'); 


$fontsA["century_gothic"] = array( "google" => 0, "code" => '"Century Gothic", "Apple Gothic", Verdana, sans-serif'); 

$fontsA["century_schoolbook"] = array( "google" => 0, "code" => '"Century Schoolbook", Georgia, "Times New Roman", Times, serif'); 

$fontsA["consolas"] = array( "google" => 0, "code" => 'Consolas, "Andale Mono", Monaco, Courier, "Courier New", Verdana, sans-serif'); 

$fontsA["constantia"] = array( "google" => 0, "code" => 'Constantia, Georgia, "Times New Roman", Times, serif'); 

$fontsA["Corbel"] = array( "google" => 0, "code" => 'Corbel, "Lucida Grande", "Lucida Sans Unicode", Arial, sans-serif'); ; 

$fontsA["franklin_gothic"] = array( "google" => 0, "code" => '"Franklin Gothic Medium", Arial, sans-serif'); 

$fontsA["garamond"] = array( "google" => 0, "code" => 'Garamond, "Hoefler Text", "Times New Roman", Times, serif'); 

$fontsA["gill_sans"] = array( "google" => 0, "code" => '"Gill Sans MT", "Gill Sans", Calibri, "Trebuchet MS", sans-serif'); 

$fontsA["helvetica"] = array( "google" => 0, "code" => '"Helvetica Neue", Helvetica, Arial, sans-serif'); 

$fontsA["hoefler"] = array( "google" => 0, "code" => '"Hoefler Text", Garamond, "Times New Roman", Times, sans-serif');  

$fontsA["lucida_bright"] = array( "google" => 0, "code" => '"Lucida Bright", Cambria, Georgia, "Times New Roman", Times, serif');  

$fontsA["lucida_grande"] = array( "google" => 0, "code" => '"Lucida Grande", "Lucida Sans", "Lucida Sans Unicode", sans-serif');  

$fontsA["palatino"] = array( "google" => 0, "code" => '"Palatino Linotype", Palatino, Georgia, "Times New Roman", Times, serif');  

$fontsA["rockwell"] = array( "google" => 0, "code" => 'Rockwell, "Arial Black", "Arial Bold", Arial, sans-serif');  

$fontsA["tahoma"] = array( "google" => 0, "code" => 'Tahoma, Geneva, Verdana, sans-serif'); 

if($val != ""){
return $fontsA[$val];
}else{
return $fontsA;
}

}




if(class_exists('WP_Customize_Control')){
class WP_Customize_Switch_Control extends WP_Customize_Control {
		 
 
    /**
     * Control type
     *
     * @var string
     */
    public $type = 'radio_switch';

    /**
     * Control Presets
     *
     * @var array
     */
    public $presets = array();

    /**
     * Don't render the control content from PHP, as it's rendered via JS on load.
     */
    public function render_content() {
        $data_device = isset( $this->device ) ? 'data-device="' . esc_attr( $this->device ) . '"' : '';
    ?>
        <label <?php echo $data_device; ?>>
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif;
            if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>

<style>
.onoffswitch {
    position: relative; width: 90px; margin-top:10px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white;   font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    padding-left: 10px;
    background-color: #008ec2; color: #FFFFFF;
}
.onoffswitch-inner:after {
    content: "OFF";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: -1px; height:20px; bottom: 0;
    right: 56px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}
</style>
 
<div class="onoffswitch">
    <input type="checkbox"  name="<?php echo $this->id; ?>"  <?php $this->link(); ?> class="onoffswitch-checkbox" id="myonoffswitch<?php echo $this->id; ?>" <?php if($this->value()){ ?>checked<?php } ?> style="position: absolute;    top: -100000px !important;">
    <label class="onoffswitch-label" for="myonoffswitch<?php echo $this->id; ?>" onclick="Change<?php echo $this->id; ?>();">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>
</label>
 
         
		    <?php
    }
     
}
 
class WP_Customize_RadioImage1_Control extends WP_Customize_Control {
		 
 
    /**
     * Control type
     *
     * @var string
     */
    public $type = 'radio_image';

    /**
     * Control Presets
     *
     * @var array
     */
    public $presets = array();

    /**
     * Don't render the control content from PHP, as it's rendered via JS on load.
     */
    public function render_content() {
        $data_device = isset( $this->device ) ? 'data-device="' . esc_attr( $this->device ) . '"' : '';
    ?>
        <label <?php echo $data_device; ?>>
            <?php if ( ! empty( $this->label ) ) : ?>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <?php endif;
            if ( ! empty( $this->description ) ) : ?>
                <span class="description customize-control-description"><?php echo $this->description; ?></span>
            <?php endif; ?>

            <select class="radio_image_select show-labels show-html" <?php $this->link(); ?>>
                <?php
                $presets = array();

                foreach ( $this->choices as $choice_id => $choice_info ){

                    //$data_class  = isset( $choice_info['css_class'] ) && ! empty( $choice_info['css_class'] ) ? 'data-class="'. esc_attr( $choice_info['css_class'] ).'"' : '';
                    $data_symbol = ! empty( $choice_info['image'] ) ? 'data-img-src="'. esc_attr( $choice_info['image'] ).'"' : '';
                    $data_label  = ! empty( $choice_info['label'] ) ? 'data-img-label="'. esc_attr( $choice_info['label'] ).'"' : '';
				  

                    echo sprintf( '<option value="%s" %s %s %s>%s</option>', esc_attr( $choice_id ),
                        selected( $this->value(), $choice_id, false ) ,
                       $data_label,  $data_symbol, esc_html( $choice_info['label'] )
                    );
                }

                // Define the presets if was defined
                if( ! empty( $presets ) ){
                    $this->presets = $presets;
                }
                ?>
            </select>
        </label>
       
		    <?php
    }
     
}
}
 
 
class wlt_core_customerize {


    function __construct(){
		
		add_action( 'customize_register'                , array( $this, 'customize_register') );
		add_action( 'customize_controls_print_styles'   , array( $this, 'controls_style'    ) );
        add_action( 'customize_controls_enqueue_scripts', array( $this, 'controls_script'   ) );
		if(!defined('WLT_DEMOMODE')){		
		add_action( 'wp_head' , array( $this, 'header_output' ) ); 
		}
		 	
    }
	function controls_style(){
		wp_enqueue_style( 'auxin-customizer',  FRAMREWORK_URI.'admin/css/admin-customizer.css', NULL, THEME_VERSION, 'all' );
	
	}
	function controls_script(){
		wp_enqueue_script( 'premiumpress-customizer', FRAMREWORK_URI.'admin/js/admin-customizer.js' , array( 'jquery' ), THEME_VERSION, true );
	
	}

 
	function customize_register ( WP_Customize_Manager $wp_customize  ) {
	
	 $wp_customize->remove_control("header_image"); 
	 $wp_customize->remove_section("colors");
	 $wp_customize->remove_section("background_image");
	 $wp_customize->remove_section("static_front_page");
	 
 
  
		foreach(wlt_core_customerize_settings() as $ck => $c){
		
		 
				$wp_customize->add_panel( 'premiumpress_'.$ck , array(
					'title'    		=> $c['title'],
					'description'   => $c['desc'],
					'priority' 		=> 10,					
					//'active_callback' => 'is_front_page',
				) ); 
				
				foreach($c['sections'] as $pk => $p){	
					
					// CREATE UNIQUE ID FOR THIS SECTION
					$SectionID = 'section_'.$ck."_".str_replace(" ","",strtolower($pk));
					 
					$wp_customize->add_section( $SectionID, array(					 
					  'title'           => $pk,
					  'panel'  			=> 'premiumpress_'.$ck,
					  'priority'        => 10,
					) );
			 	
				foreach($p['settings'] as $fk => $f){
				 	
					// CREATE UNIQUE ID FOR THIS SETTING
					$SettingsID = "settings_".$ck."_".$fk."_".str_replace(" ","",strtolower($pk));
					
					// setuipo
					if(!isset($f['default'])){ $f['default'] = ""; }
					 
					$wp_customize->add_setting( $SettingsID , array(
						'default'   => $f['default'],
						'transport' => 'refresh',
					) );
					
					// SWITCH DISPLAY TYPE
					switch($f['d']){
					
						case "imageselect":{
						
						$wp_customize->add_control( 						
							new WP_Customize_RadioImage1_Control( 
							$wp_customize, 
							$ck."_".$fk  . '_control', 
							array(
								'label'    => $f['title'],
								'section'  =>  $SectionID,
								'settings' => $SettingsID,
								'type'     => 'radio_image',
								'description' => $f['description'],
								'choices' => $f['choices'],							 
							))						 
						);
						
						} break;
						
						case "switch":{
						
						$wp_customize->add_control( 						
							new WP_Customize_Switch_Control( 
							$wp_customize, 
							$ck."_".$fk  . '_control', 
							array(
								'label'    => $f['title'],
								'section'  =>  $SectionID,
								'settings' => $SettingsID,
								'type'     => 'radio_switch',
								'description' => $f['description'],
								'choices' => $f['choices'],							 
							))						 
						);
						
						} break;
						
						
						
						case "radio":  { 
						   
						   
						$wp_customize->add_control( $ck."_".$fk  . '_control' , array(
							'label'    => $f['title'] ,
							'section'  =>  $SectionID,
							'settings' => $SettingsID,
							'type'     => 'radio',
							'description' => $f['description'],
							'choices' => $f['choices'],	
						) );
												
						
						} break;
						
						case "text":
						case "5": {
						
						$wp_customize->add_control( $ck."_".$fk  . '_control' , array(
							'label'    => $f['title'] ,
							'section'  =>  $SectionID,
							'settings' => $SettingsID,
							'type'     => 'text',
							'description' => $f['description'],
							 
						) );
						
						} break;
						
						case "select": 
						case "4": {
						
						if(!isset($f['description'])){ $f['description'] = ""; }
						if(!isset($f['choices'])){ $f['choices'] = array(); }
						 
						$wp_customize->add_control( $ck."_".$fk  . '_control'   , array(
							'label'    => $f['title'] ,
							'section'  =>  $SectionID,
							'settings' => $SettingsID,
							'type'     => 'select',
							'choices'  => $f['choices'],
							'description' => $f['description'],
						) );
												
						
						} break;
						
						
						
					
						case "image":
						case "3": {
						
						if(!isset($f['description'])){ $f['description'] = ""; }
						
						$wp_customize->add_control(
							   new WP_Customize_Image_Control(
								   $wp_customize,
								    $ck."_".$fk  . '_control',
								   array(
									'label'    => $f['title'] ,
									'section'  =>  $SectionID,
									'settings' => $SettingsID,
									//'context'    => 'your_setting_context' 
									'description' => $f['description'],
								 
								   )
							   )
						   );
							
						} break;
						case "2": {
						
						if(!isset($f['description'])){ $f['description'] = ""; }
						
							$wp_customize->add_control( $ck."_".$fk  . '_control' , array(
								'type'        => 'range',				
								'label'    => $f['title'] ,
								'section'  =>  $SectionID,
									'max'   => 60,
								'description' => $f['description'],
								'input_attrs' => array(
									'min'   => 10,
									'step'  => 1, 
									 
								),
							) );
							
						} break;
					
						case "color": {
						
						if(!isset($f['description'])){ $f['description'] = ""; }
						
							$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $ck."_".$fk  . '_control' , array(
									'label'    => $f['title'] ,
									'section'  =>  $SectionID,
									'settings' => $SettingsID,
									'description' => $f['description'],
							) ) );
						}
						
					}
					
				
				}// end foreach	
				
				}// end foreach
				
		} // end foreach
			
	}
	
	
	public static function reset_customizer() {  
	
	 remove_theme_mods();
	
	}
	
   public static function header_output() { global $CORE; $STRING = "";
   
   $fonts = wlt_core_customerize_fonts();
   
   foreach(wlt_core_customerize_settings() as $ck => $c){
   
   foreach($c['sections'] as $pk => $p){
   
   
   		foreach($p['settings'] as $fk => $f){ 
			
			// GET SAVED SETTING		
		   $mod = get_theme_mod("settings_".$ck."_".$fk."_".str_replace(" ","",strtolower($pk))); 
		   
		   // FIX FOR SWITCH VALUES
		   if($f['d'] == "switch" && $mod == ""){
		   $mod = "0";
		   }elseif($f['d'] == "switch"){
		   $mod = "1";
		   }
		   
		   // SKIP
		   if($mod == "" || $mod == "#123456" || $mod == "none"){ continue; }
		   
		   //echo $f['div']." = ". $mod."<br>";
		    
		   //echo "settings_".$ck."_".$fk."_".str_replace(" ","",strtolower($pk))." == ".$mod." (".$f['type'].")<br>";	 
 		   
		   // SKIP DISPLAY IF SET TO DEFAULT
		   
		   switch($f['type']){

			case "font": {
		 	
			$fd =  wlt_core_customerize_fonts($mod);
			 
			if(is_array($fd) && $fd['google'] == 1){
			$FName = explode(",",$fd['code']);
			$STRING .= " @import url('http://fonts.googleapis.com/css?v2&family=".str_replace('"',"",str_replace(' ',"+",$FName[0]))."'); ";			
			} 
			
			$STRING .= $f['div']."{ font-family:".$fd['code']." !important; }";
				
			} break;
			case "txtsize": {
			$STRING .= $f['div']."{ font-size:".$mod."px !important; }";	
			} break;
			case "txt": {
			$STRING .= $f['div']."{ color:".$mod." !important; text-shadow:none !important; }";		
			} break;
			case "bdc": {
			$STRING .= $f['div']."{border-color:".$mod." !important; }";		
			} break;	
			case "bgc": {
			$STRING .= $f['div']."{ background-color:".$mod." !important; }";		
			} break;
			case "bgi": {
			$STRING .= $f['div']."{ background-image: url(".$mod.") }";		
			} break;			
			case "btn": {
			$STRING .= $f['div']."{ background-color:".$mod." !important; border-color:".$mod." !important; }";	
			} break;
			case "bodybgc": {
			$STRING .= $f['div']."{ background:none; background-color:".$mod.";  }";		
			} break;
			case "bodybgi": {
			$STRING .= $f['div']."{background:none; background-image: url(".$mod.") }";		
			} break;
			case "color_primary": {
				
				$STRING .= $CORE->CUSTOMMETA_PRIMARY_COLOR($mod);			
			
				$GLOBALS['CORE_THEME']['color_primary'] = $mod;
			
				// GET THE CURRENT VALUES
				if(is_customize_preview()){
					$existing_values = get_option("core_admin_values");	
					$existing_values['color_primary'] =  $mod;	
					$new_result = array_merge((array)$existing_values, $existing_values);
					update_option( "core_admin_values", $new_result);
				}
			
			} break;
			case "color_secondary": {
			
				$STRING .= $CORE->CUSTOMMETA_SECONDARY_COLOR($mod);			
			
				$GLOBALS['CORE_THEME']['color_secondary'] = $mod;			
			
				// GET THE CURRENT VALUES
				if(is_customize_preview()){
				 
					$existing_values = get_option("core_admin_values");	
					$existing_values['color_secondary'] =  $mod;	
					$new_result = array_merge((array)$existing_values, $existing_values);
					update_option( "core_admin_values", $new_result);
				}
			
			
			} break;			
			case "logoimg": {			
		  	
				// GET THE CURRENT VALUES
				if(is_customize_preview()){
				 
					$existing_values = get_option("core_admin_values");	
					$existing_values['logo_url'] =  $mod;	
					$new_result = array_merge((array)$existing_values, $existing_values);
					update_option( "core_admin_values", $new_result);
				}
			
			} break;
			
			case "logoimg1": {		
			
				// GET THE CURRENT VALUES
				if(is_customize_preview()){
				 
					$existing_values = get_option("core_admin_values");	
					$existing_values['light_logo_url'] =  $mod;	
					$new_result = array_merge((array)$existing_values, $existing_values);
					update_option( "core_admin_values", $new_result);
				} 
			
			} break;
			
			case "pageassign": {
			
				$GLOBALS['CORE_THEME']['pageassign'][$f['div']] = $mod;
			  
			} break;
			  
			case "custom": {
				
				if(isset($GLOBALS['CORE_THEME'][$f['div']])){
				
				$GLOBALS['CORE_THEME'][$f['div']] = $mod;	
				
				// SAVE ADMIN CHANGES
				if(is_customize_preview()){
					$existing_values = get_option("core_admin_values");	
					$existing_values[$f['div']] =  $mod;
					update_option( "core_admin_values", $existing_values);
				}
				}
			
			 	 
			} break;
			 
			default: {	
			 	   
				$STRING .= $f['div']."{ background:".$mod." !important; }";					
				   
			}
			
		   }		
   
		}
	}
	} 

     // OUTPUT
		if(strlen($STRING) > 2){
			echo "<style>".$STRING."</style>";
		}
   }
 
   
}

?>