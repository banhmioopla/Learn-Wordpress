 <?php
/*
Template Name: [PAGE - FAQ]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $userdata, $CORE, $CORE_CART; 
  
if(!_ppt_checkfile("tpl-page-faq.php")){


if(_ppt(array('pageassign','faq')) != "" && _ppt(array('pageassign','faq')) != "0"){
			
			$GLOBALS['flag-nobreadcrumbs'] = 1;				
			
			get_header($CORE->pageswitch()); 
			if( substr(_ppt(array('pageassign','faq')),0,9) == "elementor"){
			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','faq')),10,100)."']");
			}else{
			$thispage = get_page( _ppt(array('pageassign','faq'))  );
			echo do_shortcode( $thispage->post_content );
			}
			get_footer($CORE->pageswitch());
	
}else{
 

// GET FAQ DATA
$cfaq = get_option("cfaq"); 

   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?>
 
     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
<div class="content-wrapper">
<?php get_template_part('templates/page-top', 'text' ); ?> 


<?php if(_ppt(array('pageassign','faq-section')) != "" && _ppt(array('pageassign','faq-section')) != "0"){
   			
   		 	if( substr(_ppt(array('pageassign','faq-section')),0,9) == "elementor"){
   			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','faq-section')),10,100)."']");
   			}else{
   			$thispage = get_page( _ppt(array('pageassign','faq-section'))  );
   			echo do_shortcode( $thispage->post_content );
   			}
   			 
   }else{ ?>
                   
 <div id="accordion" class="mt-4">
<?php if(is_array($cfaq) && !empty($cfaq)){ $i=0; $c =1; foreach($cfaq['name'] as $data){  if($cfaq['name'][$i] != "" ){  ?>
                  <div class="card mb-3">
                     <div class="bg-light p-2" id="heading<?php echo $i; ?>">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>" style="cursor:pointer;">
                        <strong class="text-dark"><?php echo $cfaq['name'][$i]; ?></strong>
                        </button>
                     </div>
                     <div id="collapse<?php echo $i; ?>" class="collapse" aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordion">
                        <div class="card-body">
                           <?php echo $cfaq['desc'][$i]; ?>
                        </div>
                     </div>
                  </div>
                  <?php  } $i++; $c++; } } ?>
               </div>
               <?php } ?>    
 </div>                                    

<?php endwhile; endif; ?> 

<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch()); } } ?>