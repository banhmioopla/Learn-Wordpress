<?php

global $settings;

	$i = 1; $shown=1;  $saveddata = array(); $savadata = array();
		
	$offset = 0;
	$show = 7;
	if(isset($settings['sampledata'])){ 	$sampledata = $settings['sampledata']; }else{ 
	
	$sampledata = array(
					  1 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-1.png", "icon" => ""), 
					  2 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-2.png", "icon" => ""), 
					  3 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-3.png", "icon" => ""), 
					  4 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-4.png", "icon" => ""), 
					  5 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-5.png", "icon" => ""), 
					  6 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-6.png", "icon" => ""), 
					  7 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-7.png", "icon" => ""), 
					  8 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-8.png", "icon" => ""),  
					  9 => array("name" => "", "img" => FRAMREWORK_URI."/elementor/img/item-9.png", "icon" => ""),  
	);
	
	}
	if(isset($settings['orderby'])){ 		$orderby = $settings['orderby']; }else{ $orderby = "count"; }
	if(isset($settings['order'])){ 			$order = $settings['order']; }else{ $order = "desc"; }
	if(isset($settings['show'])){ 			$show = 7; }
 

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
		$name = "";
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) && $sampledata[$i]['name'] != "" ){
		$name = $sampledata[$i]['name'];
		}elseif(isset($category->name)){
		$name = $category->name;
		}
		
		// ICON		
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) && $sampledata[$i]['icon'] != "" ){		
		$caticon = $sampledata[$i]['icon'];		
		}elseif(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){		
		$caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);		
		}else{
		$caticon = "fa fa-check";
		}
		
		// IMAGE
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) && !empty($sampledata[$i]) ){
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
		$savadata[$i]['count'] 	= $category->count;

$i++;
		
} // end foreach

 
    
?> 
<div class="ccat-6  <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
   <div class="row">
      <?php $c=1; while($c < 7){ ?>
      <div class="col-6 col-md-4 cat-item">      
          <a href="<?php echo $savadata[$c]['link']; ?>">
          <div class="cat-image">
          <img src="<?php echo $savadata[$c]['image']; ?>" class="img-fluid" alt="<?php echo $savadata[$c]['name']; ?>" />
          </div>         
         <div class="cat-text">         
            <h4 class="h4-lg txt-600"><?php echo $savadata[$c]['name']; ?></h4>            
            <span class="count">( <?php echo $savadata[$c]['count']; ?> )</span>            
         </div>
        </a>
      </div>
	 <?php $c++; } ?>
   </div>
</div>