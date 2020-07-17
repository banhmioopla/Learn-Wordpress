<?php
   /* 
   * Theme: PREMIUMPRESS CORE FRAMEWORK FILE
   * Url: www.premiumpress.com
   * Author: Mark Fail
   *
   * THIS FILE WILL BE UPDATED WITH EVERY UPDATE
   * IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
   *
   * http://codex.wordpress.org/Child_Themes
   */
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   global $post, $settings, $CORE;
   
    
   ?>
<div id="widget-maindetails">
   <div class="widget-single">
      <?php if(in_array(THEME_KEY, array('dt')) && !isset($settings['show_photos']) || isset($settings['show_photos']) && $settings['show_photos'] == 1  ){ ?>
      <div id="photobox">
         <div class="widget-title">
            <i class="fa fa-photo float-right mt-1"></i>
            <h6><?php echo __("Photos","premiumpress") ?></h6>
         </div>
         <?php echo do_shortcode('[IMAGES]'); ?>
      </div>
      <?php } ?>
      <?php if( THEME_KEY == "cp" || isset($settings['show_title']) && $settings['show_title'] == 1 ){ ?>
      <h1 class="mb-3"><?php echo do_shortcode('[TITLE]'); ?></h1>
      <div class="mb-3 subtitle-list">
         <?php if(THEME_KEY == "dt"){ ?>
         <div class="mb-3 lead"> <i class="fa fa-map-marker" ></i> <?php echo get_post_meta($post->ID,'map-location',true); ?></div>
         <?php } ?>
         <ul class="d-flex list-unstyled">
            <li> <?php echo do_shortcode('[CATEGORYICON]'); ?>  <?php echo do_shortcode('[CATEGORY]'); ?> </li>
            <li><i class="fa fa-binoculars"></i> <?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?> </li>
            <?php if(in_array(THEME_KEY, array('mj'))){ ?> 
            <li><i class="fa fa-clock-o"></i>  <?php echo do_shortcode('[DAYS]'); ?> <?php echo __("days","premiumpress") ?>  </li>
            <li><i class="fa fa-bullhorn"></i> <?php echo do_shortcode('[SALES]'); ?> <?php echo __("sold","premiumpress") ?> </li>
            <?php } ?>
            <?php if(_ppt('google') == 1 && get_post_meta($post->ID,'map-country', true) != "" ){   ?> 
            <li><a href="<?php echo home_url(); ?>/?s=&country=<?php echo get_post_meta($post->ID,'map-country', true); ?>" style="text-decoration:underline;"><?php echo do_shortcode('[COUNTRY]'); ?></a></li>
            <li><a href="<?php echo home_url(); ?>/?s=&city=<?php echo get_post_meta($post->ID,'map-city', true); ?>" style="text-decoration:underline;"><?php echo do_shortcode('[CITY]'); ?></a></li>
            <?php } ?>
            <?php if(THEME_KEY == "cp"){
               // GET VALUE
               $date = get_post_meta($post->ID,'expiry_date',true);
               if($date == ""){
               	$date = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id =('".$post->ID."') AND meta_key=('expiry_date') LIMIT 1" );
               }
               $vv = $CORE->date_timediff($date);
               
               // LAST USED
               $lastused = get_post_meta($post->ID,'lastused', true);
               
                // COUNT USED
               $useage = do_shortcode('[USED pid="'.$post->ID.'"]');	
               			   
               			    ?>
            <li><i class="fa fa-bar-chart"></i>  <?php echo sprintf( _n( 'Used once', 'Used %s times', $useage, "premiumpress" ), do_shortcode('[USED pid="'.$post->ID.'"]') ); ?></li>
            
			<?php if($vv['expired'] == 1){ ?>
            
            <?php if(_ppt('disable_expiry')  ==1){ }else{ ?>
            <li><?php echo __("expired","premiumpress") ?></li>
            <?php } ?>
            
            <?php }elseif( $vv['days-left'] == 0){ ?>
            <li><span class="text-danger">
               <i class="fa fa-clock-o" aria-hidden="true"></i>
               <?php echo __("Expires Today!","premiumpress"); ?>
               </span>
            </li>
            <?php  }else{ ?>
            <li><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $vv['days-left']." ".__("Days left","premiumpress"); ?></li>
            <?php }?> 
            <?php if(isset($GLOBALS['flag-taxonomy'])){  ?>
            <li> <?php echo do_shortcode('[CATEGORY]'); ?> </li>
            <?php } ?> 
            <?php } ?>
         </ul>
      </div>
      <?php } ?>
      <?php if(THEME_KEY == "cp"){ ?>
      <div class="my-4">
         <?php get_template_part( '_coupon/widgets/widget', 'couponbox' );  ?>
      </div>
      <?php } ?>
      <?php if(!isset($settings['show_desc']) || ( isset($settings['show_desc']) && $settings['show_desc'] == 1 ) ){ ?>
      <div class="widget-title mt-md-2">
         <?php echo do_shortcode('[FAVS class="float-right btn btn-sm btn-outline-dark"]'); ?>
         <h6><?php echo __("Description","premiumpress") ?></h6>
      </div>
      <div class="pb-3"><?php echo do_shortcode('[CONTENT media=0]'); ?></div>
      <div id="amenitiesbox">
         <h6 class="font-weight-bold mb-4 "><?php if(THEME_KEY == "at"){ echo __("Item Features","premiumpress"); }else{ echo __("Amenities","premiumpress"); } ?></h6>
         <?php echo do_shortcode('[AMENITIES]'); ?>
      </div>
      <?php echo do_shortcode('[FIELDS]'); ?>
      <?php echo do_shortcode('[TAGS class="mt-3 mb-4"]'); ?> 
      <?php } ?>
      <div class="mb-4 mt-4">
         <?php echo do_shortcode('[SOCIAL]'); ?>
      </div>
      <?php 
         // AUCTION THEME	  
         if(in_array(THEME_KEY,array('at','ct'))  && !isset($settings['show_delivery']) || ( isset($settings['show_delivery']) && $settings['show_delivery'] == 1 ) ){ ?>
      <?php 
         // PICKUP ONLY
         if(get_post_meta($post->ID,'delivery', true) == 1){ ?>  
      <div class="p-4 card my-5 rounded-0 border-0 bg-light" style=" position:relative; overflow:hidden">
         <i class="fa fa-dropbox" aria-hidden="true" style="    font-size: 150px;    position: absolute;    right: -10px;    opacity: 0.1;"></i>
         <h5><?php echo __("This item is for pickup only!","premiumpress"); ?></h5>
         <p class="mt-2"><?php echo __("The seller requests you pick-up this item in person.","premiumpress"); ?></p>
         <p class="small"><?php echo str_replace("%a", do_shortcode('[CITY]') , str_replace("%b", do_shortcode('[COUNTRY]'), __("The item is located in %a, %b. Full address details are provided after purchase.","premiumpress"))); ?></p>
      </div>
      <?php }else{ ?>
      <div class="p-4 card my-5 rounded-0 border-0 bg-light" style="position:relative; overflow:hidden">
         <i class="fa fa-map-marker" aria-hidden="true" style="    font-size: 150px;    position: absolute;    right: -10px;    opacity: 0.1;"></i>
         <h5><?php echo __("This item can be shipped to you!","premiumpress"); ?></h5>
         <p class="mt-2"><?php echo __("The seller will ship this item to you once payment has been recieved.","premiumpress"); ?></p>
         <p class="small"><?php echo str_replace("%a", do_shortcode('[CITY]') , str_replace("%b", do_shortcode('[COUNTRY]'), __("The item will be shipped from %a, %b, shipping charges are dicussed between you and the seller.","premiumpress"))); ?></p>
      </div>
      <?php } ?>
      <?php } ?>
      <?php if(!isset($settings['show_video']) || ( isset($settings['show_video']) && $settings['show_video'] == 1 ) ){ ?>
      <div id="videobox">
         <div class="widget-title">
            <i class="fa fa-video float-right mt-1"></i>
            <h6><?php echo __("Video","premiumpress") ?></h6>
         </div>
         <div class="mb-4"><?php echo do_shortcode('[VIDEO]'); ?></div>
      </div>
      <?php } ?>
      <?php if(_ppt('google') == 1 && get_post_meta($post->ID,'map-country', true) != "" ){   ?> 
      <div class="widget-title">
         <i class="fa fa-map-marker float-right mt-1"></i>
         <h6><?php echo __("Map Location","premiumpress") ?></h6>
      </div>
      <div class="mb-4">
         <?php echo do_shortcode('[GOOGLEMAP zoom=15]'); ?>                       
      </div>
      <?php } ?> 
       
      
      
      <?php if(in_array(THEME_KEY, array('dt'))  && ( !isset($settings['show_comments']) || ( isset($settings['show_comments']) && $settings['show_comments'] == 1 ) ) ){ ?>
      
      <?php get_template_part( '_directory/widgets/widget', 'comments' );  ?>
      
      <?php }elseif( THEME_KEY != "mj" && ( !isset($settings['show_comments']) || ( isset($settings['show_comments']) && $settings['show_comments'] == 1 ) ) ){ ?>
      <?php get_template_part( 'widgets/widget-single', 'comments' );  ?>   
      <?php } ?> 
      
       
   </div>
</div>
<script>
   jQuery(document).ready(function() {
   
   // SHOW HIDE BOX IS NO CONTENT
   	if(jQuery('#amenitiesbox .amenities').height() < 30){ 
   		jQuery('#amenitiesbox').html('');
   	} 
    		
   	// SHOW HIDE BOX IS NO CONTENT
   	if(jQuery('#photobox').height() < 100){ 
   		jQuery('#photobox').html('');
   	}
   
   	// SHOW HIDE BOX IS NO CONTENT
   	if(jQuery('#videobox').height() < 500){ 
   		jQuery('#videobox').html('');
   	} 	
   
   }); 
</script>