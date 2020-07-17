<?php global $CORE, $userdata, $wpdb, $settings;
 
?>
    <div class="page-content-block py-3 mb-4 border-bottom">
       <div class="page-content-title">
          <div class="container">
             <div class="row">
                <div class="col-md-7">
                   <h5><?php if(is_404()){ echo __("WHOOPS!","premiumpress"); }elseif(is_category()){ single_cat_title(); }else{ the_title(); } ?></h5>
                   <?php
                      if(isset($post)){ 
                      $subd = get_post_meta($post->ID,'sub-description',true);
                      if(strlen($subd) > 0){
                      ?>
                   <p><?php echo $subd; ?></p>
                   <?php } } ?>
                   <?php echo $CORE->BREADCRUMBS(); ?>
                </div>
                <div class="col-md-5 text-right">
                    <?php echo $CORE->BANNER('breadcrumbs'); ?>               
                </div>
             </div>
          </div>
       </div>
    </div>