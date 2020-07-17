<?php
/*
Template Name: [PAGE - ABOUT US]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE, $CORE_CART; wp_get_current_user(); 

$GLOBALS['flag-aboutus'] = 1;

if(!_ppt_checkfile("tpl-aboutus.php")){

 
if(_ppt(array('pageassign','aboutus')) != "" && _ppt(array('pageassign','aboutus')) != "0"){
			
			$GLOBALS['flag-nobreadcrumbs'] = 1;				
			
			get_header($CORE->pageswitch()); 
			if( substr(_ppt(array('pageassign','aboutus')),0,9) == "elementor"){
			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','aboutus')),10,100)."']");
			}else{
			$thispage = get_page( _ppt(array('pageassign','aboutus'))  );
			echo do_shortcode( $thispage->post_content );
			}
			get_footer($CORE->pageswitch());
	
}else{


   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?>

<div class="content-wrapper">

<?php get_template_part('templates/page-top', 'text' ); ?>
 
 
<?php if(_ppt(array('pageassign','about-section')) != "" && _ppt(array('pageassign','about-section')) != "0"){
   			
   		 	if( substr(_ppt(array('pageassign','about-section')),0,9) == "elementor"){
   			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','about-section')),10,100)."']");
   			}else{
   			$thispage = get_page( _ppt(array('pageassign','about-section'))  );
   			echo do_shortcode( $thispage->post_content );
   			}
   			 
   }elseif($post->post_content == ""){ ?>
 <p>To edit this text, simply enter your own text into the content area when editing this page.</p>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
  <?php } ?>
                    
</div>
 
<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch()); } } ?>