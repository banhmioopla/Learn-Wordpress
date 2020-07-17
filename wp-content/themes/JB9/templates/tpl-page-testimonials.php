<?php
/*
Template Name: [PAGE - TESTIMONIALS]
*/

global $wpdb, $post, $wp_query;

if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

$GLOBALS['flag-testimonials'] = true;

if(_ppt(array('pageassign','testimonials')) != "" && _ppt(array('pageassign','testimonials')) != "0"){
			
			$GLOBALS['flag-nobreadcrumbs'] = 1;				
			
			get_header($CORE->pageswitch()); 
			if( substr(_ppt(array('pageassign','testimonials')),0,9) == "elementor"){
			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','testimonials')),10,100)."']");
			}else{
			$thispage = get_page( _ppt(array('pageassign','testimonials'))  );
			echo do_shortcode( $thispage->post_content );
			}
			get_footer($CORE->pageswitch());
	
}else{
 

	$tests = $CORE->testimonials(100);
	 
	function _hook_extra_css(){
	ob_start();
	?>
	<style>
	 
	.testimonials blockquote {    background: #f8f8f8 none repeat scroll 0 0;    border: medium none;    color: #666;    display: block;    font-size: 16px;    line-height: 30px;    padding: 15px;    position: relative;}
	.testimonials blockquote::before {    width: 0;     height: 0;	right: 0;	bottom: 0;	content: " "; 	display: block; 	position: absolute;    border-bottom: 20px solid #fff;  	border-right: 0 solid transparent;	border-left: 15px solid transparent;	border-left-style: inset; /*FF fixes*/	border-bottom-style: inset; /*FF fixes*/}
	.testimonials blockquote::after {    width: 0;    height: 0;    right: 0;    bottom: 0;    content: " ";    display: block;    position: absolute;    border-style: solid;    border-width: 20px 20px 0 0;    border-color: #e63f0c transparent transparent transparent;}
	.carousel-info img {    border: 1px solid #f5f5f5;    border-radius: 150px !important;    height: 75px;    padding: 3px;    width: 75px;}
	.carousel-info {    overflow: hidden; margin-top: 10px; }
	.carousel-info img {    margin-right: 15px;}
	.carousel-info span {    display: block;}
	.carousel-info .name {    color: #e6400c;    font-size: 16px;    font-weight: 300;    margin: 23px 0 7px;}
	.carousel-info .title {    color: #656565;    font-size: 12px;}
	</style>
	<?php
	echo str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', ob_get_clean())); 
	}
	
	add_action('wp_head','_hook_extra_css');


   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?>


<div class="content-wrapper">

 <?php get_template_part('templates/page-top', 'text' ); ?>
 
          
   
      <div class="row mt-5">
         <div class="col-md-12">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
            <?php the_content(); ?>   
            
            
              <?php if(_ppt(array('pageassign','test-section')) != "" && _ppt(array('pageassign','test-section')) != "0"){
   			
   		 	if( substr(_ppt(array('pageassign','test-section')),0,9) == "elementor"){
   			echo do_shortcode( "[premiumpress_elementor_template id='".substr(_ppt(array('pageassign','test-section')),10,100)."']");
   			}else{
   			$thispage = get_page( _ppt(array('pageassign','test-section'))  );
   			echo do_shortcode( $thispage->post_content );
   			}
   			 
   }else{ ?>
            
                     
            <?php if(!empty($tests)){ ?>
            <?php foreach($tests as $t){ ?>
            <div class="row  mb-4">
               <div class="col-md-3">
                  <div class="carousel-info">
                     <img alt="<?php echo $t['name']; ?>" src="<?php echo $t['userphoto']; ?>">            
                     <div class="clearfix">
                        <span class="name"><?php echo $t['name']; ?></span>
                        <span class="title"><?php echo $t['name_title']; ?></span>
                     </div>
                  </div>
               </div>
               <div class="col-md-9">
                  <div class="testimonials">
                     <div class="active item">
                        <blockquote>
                           <p><?php echo $t['desc']; ?></p>
                           <small><input type="hidden" class="rating"  data-filled="fa fa-star rating-rated" data-empty="far fa-star"  readonly value="<?php echo $t['rating']; ?>"/> -  <?php echo $t['date']; ?></small>
                        </blockquote>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end row -->               
            <?php  } ?>
            <?php } ?>
            
            <?php } ?>
            
            <?php endwhile; endif; ?>
         </div>
         <!-- end container -->
      </div>
 

</div>
<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch()); }  ?>