<?php
/*
Template Name: [PAGE - CONTACT US]
*/

if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global  $userdata, $CORE; 

$GLOBALS['flag-contact'] = true; 

if(_ppt(array('pageassign','contact')) != "" && _ppt(array('pageassign','contact')) != "0"){
			
			$GLOBALS['flag-nobreadcrumbs'] = 1;				
			
			get_header($CORE->pageswitch()); 
			if( substr(_ppt(array('pageassign','contact')),0,9) == "elementor"){
			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','contact')),10,100)."']");
			}else{
			$thispage = get_page( _ppt(array('pageassign','contact'))  );
			echo do_shortcode( $thispage->post_content );
			}
			get_footer($CORE->pageswitch());
	
}else{
 

function NoFollowIndex(){

	echo '<META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW"><META NAME="ROBOTS" CONTENT="INDEX, NOFOLLOW"><META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';

}

// no index for report page
if(isset($_GET['report'])){add_filter('wp_head','NoFollowIndex');}


if(!_ppt_checkfile("tpl-page-contact.php")){
	
	// + ADD IN CAPECHA
	function _hook_head(){
	?>
	 <script src='https://www.google.com/recaptcha/api.js'></script>
	<?php }
	if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != "" ){
	add_action('wp_head','_hook_head');
	} 
	// + GOOGLE MAPS
	wp_register_script( 'googlemap',  $CORE->googlelink());
	wp_enqueue_script( 'googlemap' ); 
	 
   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?> 
 
    <div class="content-wrapper">
    <?php get_template_part('templates/page-top', 'text' ); ?>
    
    <?php if(_ppt(array('pageassign','contact-section')) != "" && _ppt(array('pageassign','contact-section')) != "0"){
   			
   		 	if( substr(_ppt(array('pageassign','contact-section')),0,9) == "elementor"){
   			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','contact-section')),10,100)."']");
   			}else{
   			$thispage = get_page( _ppt(array('pageassign','contact-section'))  );
   			echo do_shortcode( $thispage->post_content );
   			}
   			 
   }else{
    
 get_template_part('framework/elementor/_contact/contact2');  
 
 }
 
  ?>               
    </div>    
        
    <?php 
    
    // + PAGE BOTTOM
    get_template_part( 'page', 'bottom' ); 
    
    // + GLOBAL FOOTER
    get_footer($CORE->pageswitch()); } } ?>