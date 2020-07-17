<?php

global $settings;

	if(isset($settings['offset'])){ 		$offset = $settings['offset']; }else{ $offset = 0; }
	if(isset($settings['sampledata'])){ 	$sampledata = $settings['sampledata']; }else{ $sampledata = array(); }
	if(isset($settings['orderby'])){ 		$orderby = $settings['orderby']; }else{ $orderby = "name"; }
	if(isset($settings['order'])){ 			$order = $settings['order']; }else{ $order = "desc"; }
	if(isset($settings['show'])){ 			$show = $settings['show']; }else{ $show = 8; }
?>
<div class="ccat2 <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?>">
            <div class="row">
               <?php
                  $i = 1; $n = 1; $shown=1;
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
                  
		// SHOW AMOUNT
		if($shown > $show ){ $i++;continue; }
		 
		// CHECK FOR OFFSET
		if($i < $offset){ $i++; continue; }	 
		
		$shown++;
  
                  // LINK 
                  $link = get_term_link($category);
				
                  ?>
               <div class="col-xl-3 col-md-4 col-12">
                  <div class="cat bg-white <?php if(isset($settings['item_class'])){ echo $settings['item_class']." "; } ?>">
                     <a href="<?php echo $link; ?>">
                        <div class="content">
                           <h6 class="text-dark "><span class="float-left"><?php echo $category->name; ?></span> <span class="float-right countb bg-primary text-light px-2"><?php echo $category->count; ?></span> </h6>
                        </div>
                     </a>
                  </div>
               </div>
               <?php $i++; } ?>
            </div>
</div>