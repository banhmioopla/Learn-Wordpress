<?php

global $settings;

	$i = 1; $shown=1;  $saveddata = array();
		
	$offset = 0;
	$show = 5;
	if(isset($settings['sampledata'])){ 	$sampledata = $settings['sampledata']; }else{ 
	
	$sampledata = array(
					  1 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat1.jpg", "icon" => ""), 
					  2 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat2.jpg", "icon" => ""), 
					  3 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat3.jpg", "icon" => ""), 
					  4 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat4.jpg", "icon" => ""), 
					  5 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat5.jpg", "icon" => ""), 
					  6 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat6.jpg", "icon" => ""), 
					  7 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat7.jpg", "icon" => ""), 
					  8 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat8.jpg", "icon" => ""),   
	);
	
	}
	if(isset($settings['orderby'])){ 		$orderby = $settings['orderby']; }else{ $orderby = "name"; }
	if(isset($settings['order'])){ 			$order = $settings['order']; }else{ $order = "desc"; }
	if(isset($settings['show'])){ 			$show = 5; }
 

	$args = array(
			'taxonomy'     	=> THEME_TAXONOMY,
			'orderby' 		=> $orderby, 
			'order' 		=> $order, 
			'offset'		=> $offset,
			   
			'show_count'   	=> 0,
			'pad_counts'   	=> 1,
			'hierarchical' 	=> 0,
			'title_li'     	=> '',
			'hide_empty'   	=> 0,
	);
	
	$categories = get_categories($args);
 			  
foreach ($categories as $category) { 

		// HIDE PARENT
		if($category->parent != 0 ){   continue; }
		
		// LIMIT DATA TO X
		if($shown > $show ){ continue; }
		 
		// CHECK FOR OFFSET
		if($i < $offset){ continue; }	 
		
		$shown++;
		
		
		// NAME
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) && $sampledata[$i]['name'] != "" ){
		$name = $sampledata[$i]['name'];
		}else{
		$name = $category->name;
		}		 
		
		// ICON		
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) ){		
		$caticon = $sampledata[$i]['icon'];		
		}elseif(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){		
		$caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);		
		}else{
		$caticon = "fa fa-check";
		}
		
		// IMAGE
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) ){
		$catimage = $sampledata[$i]['img'];
		}elseif(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_'.$category->term_id] != ""   ){
        $catimage = str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_'.$category->term_id]);
        }elseif(isset($sampledata[$i])){
        $catimage = $sampledata[$i]['img'];
        }
	  
		// BUILD DATA
		$savadata[$i]['ID'] 	= $category->term_id;		
		$savadata[$i]['name'] 	= $name;
		$savadata[$i]['link'] 	= get_term_link($category);
		$savadata[$i]['image'] 	= $catimage;
		$savadata[$i]['icon'] 	= $caticon;

$i++;
		
} // end foreach
 
    
?>
<div class="ccat-7 <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
   <div class="row">
      <div  class="col-12 col-sm-6 col-md-8 cat-item">
         <div style="background-image: url('<?php echo $savadata[1]['image']; ?>');" class="cat-image">
            <a href="<?php echo $savadata[1]['link']; ?>" class="cover-wrapper"><?php echo $savadata[1]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 cat-item">
         <div style="background-image: url('<?php echo $savadata[2]['image']; ?>');" class="cat-image">
            <a href="<?php echo $savadata[2]['link']; ?>" class="cover-wrapper"><?php echo $savadata[2]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 cat-item">
         <div style="background-image: url('<?php echo $savadata[3]['image']; ?>');" class="cat-image">
            <a href="<?php echo $savadata[3]['link']; ?>" class="cover-wrapper"><?php echo $savadata[3]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 cat-item">
         <div style="background-image: url('<?php echo $savadata[4]['image']; ?>');" class="cat-image">
            <a href="<?php echo $savadata[4]['link']; ?>" class="cover-wrapper"><?php echo $savadata[4]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 cat-item">
         <div style="background-image: url('<?php echo $savadata[5]['image']; ?>');" class="cat-image">
            <a href="<?php echo $savadata[5]['link']; ?>" class="cover-wrapper"><?php echo $savadata[5]['name']; ?></a>
         </div>
      </div>
   </div>
</div>