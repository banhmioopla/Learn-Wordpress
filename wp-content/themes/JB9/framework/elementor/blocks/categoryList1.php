<?php

global $settings;

   
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
	'limit' 		=> $settings['show'],
	'count'	=> 1
	) 
); 
               
?>

<div class="wlt_shortcode_dcats categorylist-1">
    <ul class="mb-0 sf-menu sf-vertical">
        <?php echo $categories; ?>
    </ul>
</div>