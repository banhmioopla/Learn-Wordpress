<?php

global $settings; 

	if(isset($settings['offset'])){ 		$offset = $settings['offset']; }else{ $offset = 0; }
	if(isset($settings['sampledata'])){ 	$sampledata = $settings['sampledata']; }else{ $sampledata = array(); }
	if(isset($settings['orderby'])){ 		$orderby = $settings['orderby']; }else{ $orderby = "name"; }
	if(isset($settings['order'])){ 			$order = $settings['order']; }else{ $order = "desc"; }
	if(isset($settings['show']) && is_numeric($settings['show'])){  $show = $settings['show']; }else{ $show = 8; }
	if(isset($settings['show_list']) && is_numeric($settings['show_list'])){  $show_list = $settings['show_list']; }else{  $show_list = 5; }
	
	

$categories = wp_list_categories( 
	array(
	'taxonomy'  	=> 'listing',
	'depth'         => 10,	
	'hierarchical'  => true,		
	'hide_empty'    => 0,
	'echo'			=> false,
	'title_li' 		=> '',
	'walker'		=> new walker_shortcode_dcats,
	'orderby'      => $orderby,
    'order'		 	=> $order,
	'offset'		=> $offset,
	'limit' 		=> $show,
	'limit_list' 	=> $show_list,
	'show_count'	=> 1,

	
	) 
); 
               
?>
<div class="ccat8 clearfix">
<ul class="list-unstyled m-0">
<?php echo $categories; ?>
</ul>
</div>