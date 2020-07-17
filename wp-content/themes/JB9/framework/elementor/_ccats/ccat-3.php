<?php global $settings; 

	if(isset($settings['offset'])){ 		$offset = $settings['offset']; }else{ $offset = 0; }
	if(isset($settings['sampledata'])){ 	$sampledata = $settings['sampledata']; }else{ 
	
	$sampledata = array(
		1 => array( "image" => "https://premiumpress.com/_demoimages/elementor/_hero/cat1.jpg", "name" => "Example Category", "link" => ""),
		2 => array( "image" => "https://premiumpress.com/_demoimages/elementor/_hero/cat2.jpg", "name" => "Example Category", "link" => ""),
		3 => array( "image" => "https://premiumpress.com/_demoimages/elementor/_hero/cat3.jpg", "name" => "Example Category", "link" => ""),
		4 => array( "image" => "https://premiumpress.com/_demoimages/elementor/_hero/cat4.jpg", "name" => "Example Category", "link" => ""),
		5 => array( "image" => "https://premiumpress.com/_demoimages/elementor/_hero/cat5.jpg", "name" => "Example Category", "link" => ""),					  
	);
	
	}
	if(isset($settings['orderby'])){ 		$orderby = $settings['orderby']; }else{ $orderby = "name"; }
	if(isset($settings['order'])){ 			$order = $settings['order']; }else{ $order = "desc"; }
	if(isset($settings['show'])){ 			$show = $settings['show']; }else{ $show = 8; }
 
?>
<div class="ccat3 <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
            <div class="row">
               <?php
			 
				  
                  		$i = 1;  $cat=1;  $n = 1; $shown =1;
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
                  
                 
                  foreach ($categories as $category) { 
                  
                  		// HIDE PARENT
                  		if($category->parent != 0){ continue; }						
						 
						// SHOW AMOUNT
						if($shown > $show ){ $i++;continue; }
						 
						// CHECK FOR OFFSET
						if($i < $offset){ $i++; continue; }	 
						
						$shown++;
                  		 
						// IMAGE
						if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) ){
						$catimage = $sampledata[$n]['image'];
						}elseif(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_'.$category->term_id] != ""   ){
						$catimage = str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_'.$category->term_id]);
						}elseif(isset($sampledata[$n])){
						$catimage = $sampledata[$n]['image'];
						}
                  		
                  		// LINK 
                  		$link = get_term_link($category);
						
						// NAME
						$name = "";
						if(defined('WLT_DEMOMODE') && isset($sampledata[$n]) ){
						$name = $sampledata[$n]['name'];
						}elseif(isset($category->name)){
						$name = $category->name;
						}
                  		
                  ?>
               <div class="col-xl-3 col-md-4 col-12">
                  <div class="cat <?php if($settings['item_class'] != ""){ echo $settings['item_class']; } ?>">
                     <a href="<?php echo $link; ?>">
                        <div class="icon">
                           <img src="<?php echo $catimage; ?>" class="img-fluid" alt="<?php echo $name." ".$n; ?>" />
                        </div>
                        <div class="content text-center text-dark">
                           <h6><?php echo $name; ?></h6>
                           <span><?php echo $category->count; ?> <?php echo __("listings","premiumpress"); ?></span>
                        </div>
                     </a>
                  </div>
               </div>
               <?php $i++; $n++; } ?>
            </div>
         </div>