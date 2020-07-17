<?php
/*
Template Name: [PAGE - TOP 10]
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
 
 
<h5 class="mb-3"><?php echo __("Featured","premiumpress"); ?></h5>
<hr />
 
<div class="owl-carousel small-list p-0" id="nearby" data-autoPlay="1" data-items="<?php if(in_array(THEME_KEY, array('mj','da','cm'))){ echo 3; }else{ echo 4; } ?>" data-stagePadding="10">
 <?php  echo do_shortcode('[LISTINGS dataonly=1 show=10 extrasmall=1 carousel=1 custom="featured" orderby="hits" order="desc"]'); ?> 
</div>

<?php
		$i = 1; $n = 1;
		$args = array(
			'taxonomy'     => 'listing',
			'orderby' 	=> 'menu_order', 
			'order' 	=> 'asc', 
			 'show_count'   => 0,
			 'pad_counts'   => 1,
			 'hierarchical' => 0,
			 'title_li'     => '',
			 'hide_empty'   => 0,
			 
		);
$categories = get_categories($args);

$cat=1;
foreach ($categories as $category) { if($category->count < 1){ continue; } ?>

<a href="<?php echo home_url(); ?>/?s=&catid=<?php echo $category->term_id; ?>" class="btn btn-primary btn-sm float-right">View All</a>
<h5 class="mb-3"><?php echo $category->name; ?></h5>
<hr />
 
<div class="owl-carousel small-list p-0" id="nearby" data-autoPlay="1" data-items="<?php if(in_array(THEME_KEY, array('mj','cm'))){ echo 3; }else{ echo 4; } ?>" data-stagePadding="10">
 <?php  echo do_shortcode('[LISTINGS dataonly=1 show=10 extrasmall=1 carousel=1 cat='.$category->term_id.' orderby="hits" order="desc"]'); ?> 
</div>

<?php } ?>
 
 
</div>

<?php endwhile; endif; ?>
  
<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch()); } } ?>