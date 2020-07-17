<?php global $settings;  ?>
<style>
.ccat9 h6 { background:#efefef }
.ccat9 .cat-item {   line-height:30px; }
.ccat9 .cat-item a { text-decoration:underline;  }
</style>
<div class="ccat9 <?php if(isset($settings['class']) && $settings['class'] != ""){ echo $settings['class']; } ?>">
            <div class="row">
<?php

	if(isset($settings['offset'])){ 		$offset = $settings['offset']; }else{ $offset = 0; }
	if(isset($settings['sampledata'])){ 	$sampledata = $settings['sampledata']; }else{ $sampledata = array(); }
	if(isset($settings['orderby'])){ 		$orderby = $settings['orderby']; }else{ $orderby = "name"; }
	if(isset($settings['order'])){ 			$order = $settings['order']; }else{ $order = "desc"; }
	if(isset($settings['show'])){ 			$show = $settings['show']; }else{ $show = 8; }
			   
			   if(isset($settings['caticons']) && is_array($settings['caticons']) ){
			   	
				$imgDefaults = $settings['caticons'];
			   
			   }else{
                  $imgDefaults = array(
                  1 => "https://www.premiumpress.com/_demoimages/stocktheme/cat1.jpg",
                  2 => "https://www.premiumpress.com/_demoimages/stocktheme/cat2.jpg",
                  3 => "https://www.premiumpress.com/_demoimages/stocktheme/cat3.jpg",
                  4 => "https://www.premiumpress.com/_demoimages/stocktheme/cat4.jpg",
				  
				  5 => "https://www.premiumpress.com/_demoimages/stocktheme/cat1.jpg",
                  6 => "https://www.premiumpress.com/_demoimages/stocktheme/cat2.jpg",
                  7 => "https://www.premiumpress.com/_demoimages/stocktheme/cat3.jpg",
                  8 => "https://www.premiumpress.com/_demoimages/stocktheme/cat4.jpg",
				  
                  );
				  
				}  
				  
                  		$i = 1; $n = 1;
                  		$args = array(
                  			  'taxonomy'     => THEME_TAXONOMY,
                  			  'orderby'      => $orderby,
                  			  'order'		 => $order,
							  'offset'		 => $offset,
                  			  'show_count'   => 0,
                  			  'pad_counts'   => 1,
                  			  'hierarchical' => 0,
                  			  'title_li'     => '',
                  			  'hide_empty'   => 0,
                  			 
                  		);
                  $categories = get_categories($args);
                  
                  $cat=1;
                  foreach ($categories as $category) { 
                  
                  		// HIDE PARENT
                  		if($category->parent != 0){ continue; }
						 
                  		if($i > $show){ continue; } 
                  		
						if(defined('WLT_DEMOMODE') && isset($imgDefaults[$i]) ){
						
						$caticon = $imgDefaults[$i];
                  		}elseif(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_'.$category->term_id] != ""   ){
                  		$caticon = str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_'.$category->term_id]);
                  		}else{
                  		$caticon = $imgDefaults[$i];
                  		}
                  		
                  		// LINK 
                  		$link = get_term_link($category);
                  		
                  ?>
               <div class="col-xl-3 col-md-4 col-12">
                  <div class="cat <?php if(isset($settings['class_box']) && $settings['class_box'] != ""){ echo $settings['class_box']; } ?>">
                   
                   <figure><a href="<?php echo $link; ?>"><img src="<?php echo $caticon; ?>" class="img-fluid" alt="<?php echo $category->name; ?>" /></a></figure>
                   
                   <h6 class="bg-light p-2"><a href="<?php echo $link; ?>"> <?php echo $category->name; ?> </a></h6>
                     
                     
<?php
					 
$cat1 = wp_list_categories( 
	array(
	'taxonomy'  	=> 'listing',
	'depth'         => 10,	
	'hierarchical'  => true,		
	'hide_empty'    => 0,
	'echo'			=> false,
	'title_li' 		=> '',
	'orderby' 		=> 'term_order',
	'walker'		=> new walker_shortcode_dcats,
	'limit' 		=> 100,
	'child_of' => $category->term_id,
	) 
); 
?>
<ul class="list-unstyled m-0">
        <?php echo $cat1; ?>
</ul>                     
                  </div>
               </div>
               <?php $i++; } ?>
            </div>
         </div>