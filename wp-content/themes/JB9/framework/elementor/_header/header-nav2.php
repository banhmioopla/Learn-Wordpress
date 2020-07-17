<?php global $CORE, $userdata, $wpdb, $settings;
   ?>
<nav class="elementor_header elementor_nav header-nav2 pptv9-header <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>
<div class="container">
   <div class="row">
      <div class="col-md-8">
         <nav class="pptv9-menu float-none text-left<?php if(isset($settings['nav_class'])){ echo $settings['nav_class']; } ?>">
            <?php echo do_shortcode('[MAINMENU class="mmnu" style="1"]'); ?>
         </nav>
      </div>
      <div class="col-12 col-lg-4">
         <?php if(THEME_KEY == "cp"){ ?>
         <form action="<?php echo get_home_url()."/"; ?>" method="get" name="searchform" id="searchform">
            <?php
               // if($wp_query->found_posts > 0){ 
                $al = array();
               
                if(isset($_GET['ft']) && is_array($_GET['ft']) ){
                	foreach($_GET['ft'] as $key => $val ){ if(in_array($val, $al)){ continue; } $al[] = $val; ?>
            <input type="hidden" name="ft[]" id="input-filter-<?php echo substr($val,0,2); ?>" value="<?php echo $val; ?>" />
            <?php	
               }
               }                 
               ?>
            <div class="form-group mb-1">
               <div class="input-group">
                  <input type="hidden" value="" id="ctype" />
                  <input type="text" class="form-control typeahead" name="s"value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" placeholder="<?php echo __("Search stores &amp; coupons...","premiumpress"); ?>" >
                  <button><i class="fa fa-search text-secondary"></i></button> 
               </div>
            </div>
         </form>
         <?php }else{ ?>
         <form action="<?php echo get_home_url(); ?>/" method="get" name="searchform1" id="searchform1">
            <input type="hidden" name="catid" value="" id="searchform1_catid" />
            <div class="form-group mb-1">
               <div class="input-group">
                  <div class="input-group-addon dropdown hidden-md-down">
                     <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="searchform_title"><?php echo __("Categories","premiumpress") ?></a>
                     <div class="dropdown-menu" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut" id="catselect">
                        <?php
                           echo wp_list_categories( array(
                           								'taxonomy'  	=> 'listing',
                           								'depth'         => 1,	
                           								'hierarchical'  => 1,		
                           								'hide_empty'    => 0,
                           								'echo'			=> false,
                           								'title_li' 		=> '',
                           								'show_count' 	=> 0,
                           								'orderby' 		=> 'term_order',
                           								'walker'		=> new walker_dropdown_categories_form,
                           								 
                           								) );
                           
                           ?>
                     </div>
                  </div>
                  <input type="text" class="form-control" name="s" value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" >
                  <button><i class="fa fa-search text-dark"></i></button> 
               </div>
            </div>
         </form>
         <?php } ?>
      </div>
   </div>
</div>
</nav>