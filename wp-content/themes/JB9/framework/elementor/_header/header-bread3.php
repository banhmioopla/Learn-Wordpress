<?php global $CORE, $userdata, $wpdb, $settings;
 
?>
<div class="elementor_breadcrumbs bg-light header-bread3 small border-bottom"><div class="wrap  py-3">
  
      <div class="container py-lg-5">
         <div class="row py-2">
            <div class="col-7 pr-lg-5">
           
           
                 <h3><?php 
				 if(isset($GLOBALS['flag-taxonomy'])){
				 
				 $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				 
				 echo  $term->name;
				 
				 
				 }elseif(is_404()){ echo __("WHOOPS!","premiumpress"); }elseif(is_category()){ single_cat_title(); }else{ the_title(); } ?></h3>
                   <?php
                      if(isset($post)){ 
                      $subd = get_post_meta($post->ID,'sub-description',true);
                      if(strlen($subd) > 0){
                      ?>
                   <p><?php echo $subd; ?></p>
                   <?php } } ?>
                   
            </div>
            <div class="col-5 text-right">
            	
				   <?php echo $CORE->BANNER('breadcrumbs'); ?>  
                  
            </div>
         </div>
      </div>
</div>
</div>