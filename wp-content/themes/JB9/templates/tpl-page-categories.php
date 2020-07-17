<?php
/*
Template Name: [PAGE - CATEGORY LIST]
*/
 
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
global  $post; 
 
function _hook_extra_css($css){
ob_start();

?>
<style>
 .cat-item{background: #F9F9F9; line-height: 1.2; width: 100%; position: relative; border: 1px solid #F1F1F1; font-size: 13px; font-weight: 400; letter-spacing: 0.5px;}.cat-item > a{display: block; padding: 15px; font-weight: 400; position: relative;}@media (min-width: 992px){.cat-item{text-align:left;}.cat-item > a{padding-right: 30px;}.cat-item > a:after{font: normal normal normal 14px/1 FontAwesome; content: "\f105"; position: absolute; top: 25px; right: 0; color: #CCC; font-size: 15px; o-transition: all 0.3s ease-out; -ms-transition: all 0.3s ease-out; -moz-transition: all 0.3s ease-out; -webkit-transition: all 0.3s ease-out; display: block; margin-left: 10px; width: 25px;}}.cat-item > a:hover::after{padding-left: 5px; color: #292929;}.cat-item .icon{width: 50px; height: 50px; line-height: 48px; font-size: 20px; border-radius: 50%; text-align: center; display: inline-block; vertical-align: middle; margin-right: 10px;}.cat-item .image{width: 50px; height: 50px; border-radius: 50%; display: inline-block; vertical-align: middle; margin-right: 10px; -webkit-box-shadow: 0px 0px 8px -1px rgba(0, 0, 0, 0.3); -moz-box-shadow: 0px 0px 8px -1px rgba(0, 0, 0, 0.3); box-shadow: 0px 0px 8px -1px rgba(0, 0, 0, 0.3); border: 1px solid #FFF;}.cat-item .image img{border-radius: 50%;}.cat-item h6{margin: 2px 0 5px; line-height: 1.2; letter-spacing: 0.7px; -moz-transition: all 0.3s ease; -webkit-transition: all 0.3s ease-; transition: all 0.3s ease;max-width:100px;overflow:hidden; text-overflow: ellipsis; font-size:14px;}.cat-item .content{display: inline-block; vertical-align: middle;}.cat-item .content span{color: #A8A8A8}.cat-item:hover h4,.cat-item:hover h5,.cat-item:hover h6{color: #292929;}.cat-item a{text-decoration:none}
</style>

<?php
$newcss = ob_get_clean();
$newcss = str_replace("<style>","", str_replace("</style>","",$newcss)); 
$newcss = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $newcss)); 
return $css.$newcss;
}
add_action('hook_v9_extra_css','_hook_extra_css'); 


   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?>

 
 
 
 <div class="content-wrapper">
 
 <?php get_template_part('templates/page-top', 'text' ); ?>
 
   
                   
<div class="cat-item-wrapper mt-5">
<div class="row">
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
foreach ($categories as $category) { 

	  
		if(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
		$caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
		}else{
		$caticon = "fa fa-check";
		}
		
		// LINK 
		$link = get_term_link($category);
		
?> 
<div class="col-md-4 col-12">
    <div class="cat-item mb-4">
    
        <a href="<?php echo $link; ?>">
            <div class="icon bg-primary">
                <i class="text-white fa <?php echo $caticon; ?>"></i>
            </div>
            
            <div class="content">
                <h6 class="text-dark text-uppercase"><?php echo $category->name; ?></h6>
                <span><?php echo $category->count; ?> <?php echo __("listings","premiumpress"); ?></span>
            </div>
        </a>    
    </div>								
</div>
<?php $i++; } ?>
</div>
                   
  </div> </div>               
<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch());  ?>