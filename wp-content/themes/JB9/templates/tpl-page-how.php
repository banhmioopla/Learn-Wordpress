<?php
/*
Template Name: [PAGE - HOW IT WORKS]
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
    
   global  $userdata, $CORE; 
    
   if(!_ppt_checkfile("tpl-how.php")){
   
   if(_ppt(array('pageassign','how')) != "" && _ppt(array('pageassign','how')) != "0"){
   			
   			$GLOBALS['flag-nobreadcrumbs'] = 1;				
   			
   			get_header($CORE->pageswitch()); 
   			if( substr(_ppt(array('pageassign','how')),0,9) == "elementor"){
   			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','how')),10,100)."']");
   			}else{
   			$thispage = get_page( _ppt(array('pageassign','how'))  );
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
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>    
<div class="content-wrapper">
   <?php get_template_part('templates/page-top', 'text' ); ?>
   
   <?php
   
   if(_ppt(array('pageassign','how-section')) != "" && _ppt(array('pageassign','how-section')) != "0"){
   			
   		 	if( substr(_ppt(array('pageassign','how-section')),0,9) == "elementor"){
   			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','how-section')),10,100)."']");
   			}else{
   			$thispage = get_page( _ppt(array('pageassign','how-section'))  );
   			echo do_shortcode( $thispage->post_content );
   			}
   			 
   }elseif($post->post_content == ""){ ?>
   
   <div class="row mt-5">
      <div class="col-md-5">
         <img src="https://premiumpress.com/_demoimages/elementor/how2.jpg" alt="aboutus" class="img-fluid shadow-sm"> 
      </div>
      <div class="col-md-7">
         <h4>1. Getting Started</h4>
         <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.</p>
      </div>
   </div>
   <div class="row mt-5 border-top pt-5">
      <div class="col-md-7">
         <h4>2. Register Free</h4>
         <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.</p>
      </div>
      <div class="col-md-5">
         <img src="https://premiumpress.com/_demoimages/elementor/how3.jpg" alt="aboutus" class="img-fluid shadow-sm"> 
      </div>
   </div>
   <div class="row mt-5 border-top pt-5">
      <div class="col-md-5">
         <img src="https://premiumpress.com/_demoimages/elementor/how4.jpg" alt="aboutus" class="img-fluid shadow-sm"> 
      </div>
      <div class="col-md-7">
         <h4>3. Member Benefits</h4>
         <p class="mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat.</p>
      </div>
   </div>
   <?php }else{ ?>
   <?php the_content(); ?>
   <?php } ?>
</div>
<?php endwhile; endif; ?>   
<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch()); } } ?>