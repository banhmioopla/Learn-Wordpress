<?php

global $settings;

	if(isset($settings['offset'])){ 		$offset = $settings['offset']; }else{ $offset = 0; }
	if(isset($settings['sampledata'])){ 	$sampledata = $settings['sampledata']; }else{ $sampledata = array(); }
	if(isset($settings['orderby'])){ 		$orderby = $settings['orderby']; }else{ $orderby = "name"; }
	if(isset($settings['order'])){ 			$order = $settings['order']; }else{ $order = "desc"; }
	if(isset($settings['show'])){ 			$show = $settings['show']; }else{ $show = 8; }
	 
	 
?>
<div class="ccat-1 <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
<div class="row">
<?php
		$i = 1; $n = 1; $cat=1;  $shown=1; 
	  	
		$args = array(
			'taxonomy'     => THEME_TAXONOMY,
			'orderby'      => $orderby,
            'order'		 	=> $order,
			'offset'		=> $offset,
			'show_count'   => 0,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'title_li'     => '',
			'hide_empty'   => 0,
			 
		);
$categories = get_categories($args);
  			  
foreach ($categories as $category) { 

		// HIDE PARENT
		if($category->parent != 0 ){ $i++; continue; }
		
		// SHOW AMOUNT
		if($shown > $show ){ $i++;continue; }
		 
		// CHECK FOR OFFSET
		if($i < $offset){ $i++; continue; }	 
		
		$shown++;
	 	 
		
		// ICON		
		if(isset($sampledata[$n]) && strlen($sampledata[$n]['icon']) > 1 ){
			$caticon = $sampledata[$n]['icon'];
		}elseif(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
			$caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
		}else{
			$caticon = "fa fa-check";
		}
		  
		// LINK 
		$link = get_term_link($category);
		
		// NAME
		if(isset($sampledata[$n]) && strlen($sampledata[$n]['name']) > 1 && defined('WLT_DEMOMODE') ){
			$name = $sampledata[$n]['name'];
		}else{
			$name = $category->name;
		}
		
		
?> 

<div class="col-md-3 col-6 mb-3">
                  <div class="cat-item bg-primary p-3 p-lg-5">
                     <a href="<?php echo $link; ?>">
                        <div class="content text-center">
                        <div class="icon"> <i class="fa <?php echo $caticon; ?>"></i> </div>                        
                        <h6 class="text-uppercase text-center mt-3"><?php echo $name; ?></h6>
                        </div>
                     </a>
                  </div>
               </div>


<?php $i++; $n++; } ?>
</div>
</div>
