<?php

global $settings;

	if(isset($settings['offset'])){ 		$offset = $settings['offset']; }else{ $offset = 0; }
	if(isset($settings['sampledata'])){ 	$sampledata = $settings['sampledata']; }else{ $sampledata = array(); }
	if(isset($settings['orderby'])){ 		$orderby = $settings['orderby']; }else{ $orderby = "name"; }
	if(isset($settings['order'])){ 			$order = $settings['order']; }else{ $order = "desc"; }
	if(isset($settings['show'])){ 			$show = $settings['show']; }else{ $show = 8; }
	 
$categories = wp_list_categories( 
	array(
	'taxonomy'  	=> 'listing',
	'depth'         => 5,	
	'hierarchical'  => true,		
	'hide_empty'    => 0,
	'echo'			=> false,
	'title_li' 		=> '',
	'orderby' 		=> 'term_order',
	'walker'		=> new walker_shortcode_dcats,
	'limit' 		=> $show,
	'offset'		=> $offset,
	'count'	=> 1
	) 
); 
               
?>
<div class="wlt_shortcode_dcats categorylist-1">
    <ul class="mb-0 sf-menu sf-vertical">
        <?php echo $categories; ?>
    </ul>
</div>