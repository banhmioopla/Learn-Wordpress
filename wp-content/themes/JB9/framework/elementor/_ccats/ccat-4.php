<?php global $settings;  

	$i = 1; $n = 1; $shown=1; $offset = 0;
	 
		
		if(isset($settings['offset'])){ $offset = $settings['offset']; }
		if(isset($settings['sampledata'])){ $sampledata = $settings['sampledata']; }
		if(isset($settings['orderby'])){ $orderby = $settings['orderby']; }else{ $orderby = "count"; }
		if(isset($settings['order'])){ $order = $settings['order']; }else{  $order = "asc"; }
		if(isset($settings['show'])){ $show = $settings['show']; }else{  $show = 16; }
		
		
		if(isset($settings['boxcss'])){ $boxcss = $settings['boxcss']; }else{  $boxcss = "col-xl-3 col-md-4 col-12 px-0 px-md-2"; }

?> 
 

<div class="ccat4 <?php if(isset($settings['class']) && $settings['class'] != ""){ echo $settings['class']." "; } ?>">
<div class="container">
<div class="row">
<?php
	
 		$args = array(
			  'taxonomy'    => THEME_TAXONOMY,
			  'orderby' 	=> $orderby, 
			  'order' 		=> $order, 
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
                  		 
		if(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
		$caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
		}else{
		$caticon = "fa fa-check";
		}
		
		// LINK 
		$link = get_term_link($category);
		
?>
 
<div class="<?php echo $boxcss; ?>">
    <div class="cat <?php if(isset($settings['item_class']) && $settings['item_class'] != ""){ echo $settings['item_class']; } ?>">
    
        <a href="<?php echo $link; ?>">
            <div class="icon bg-primary">
                <i class="text-white fa <?php echo $caticon; ?>"></i>
            </div>
            
            <div class="content">
                <h6 class="text-dark"><?php echo $category->name; ?></h6>
                <span><?php echo $category->count; ?> <?php echo __("listings","premiumpress"); ?></span>
            </div>
        </a>    
    </div>								
</div>

<?php $i++; } ?>

</div>
</div>
</div>