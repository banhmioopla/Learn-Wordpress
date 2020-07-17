<?php
   /* 
   * Theme: PREMIUMPRESS CORE FRAMEWORK FILE
   * Url: www.premiumpress.com
   * Author: Mark Fail
   *
   * THIS FILE WILL BE UPDATED WITH EVERY UPDATE
   * IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
   *
   * http://codex.wordpress.org/Child_Themes
   */
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   global $CORE, $userdata, $settings, $post; 
   
   // DISPLAY AMOUNT
   $num = 20;
   if(isset($settings['num']) && is_numeric($settings['num']) && $settings['num'] > 0){
   $num = $settings['num'];
   }
   
   if(!_ppt_checkfile("widget-cateogires.php")){
   ?>
 
<div class="widget listings-featured shadow-sm">
   <div class="widget-wrap">
      <div class="widget-block">
      
  <?php if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>         
<div class="widget-title"><span><?php if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{ 

 		 
		 echo __("Popular Categories","premiumpress");
		 

} ?></span></div>
<?php } ?>
      
     
         <div class="widget-content"><div class="container"><div class="row">
         
         
         <div class="catlist">
            <?php
               $i = 1; $n = 1;
               $args = array(
               	  'taxonomy'     => THEME_TAXONOMY,
               	  'orderby'      => 'name',
               	  'order'		=> 'asc',
               	  'show_count'   => 0,
               	  'pad_counts'   => 1,
               	  'hierarchical' => 0,
               	  'title_li'     => '',
               	  'hide_empty'   => 0,
               	 
               );
               $categories = get_categories($args);
               
               $cat=1;
               foreach ($categories as $category) { 
               
               if($category->parent != 0){ continue; }
			   
			   if($i > $num){ continue; }
               
               $link = get_term_link($category);
			   
			   if(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
				$caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
				}else{
				$caticon = "fa-chevron-right";
				}
               
               ?>
            <a href="<?php echo $link; ?>"  class="text-dark" title="<?php echo $category->name; ?>"><i class="fa <?php echo $caticon; ?>"></i> <span><?php echo $category->name; ?></span></a>
            <?php $i++; } ?>
            </div>
            
            
         </div></div></div>
      </div>
   </div>
</div>
<?php } ?>