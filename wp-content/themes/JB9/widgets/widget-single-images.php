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
   
   global $post, $CORE, $settings;
   
   $vv = $CORE->date_timediff(get_post_meta($post->ID,'lastviewed',true));	
    
   ?>
   
<div class="widget" id="widget-single-images" data-title="<?php echo __("Photos","premiumpress") ?>">

<?php if(THEME_KEY == "ct" && get_post_meta($post->ID,'status', true) == 1){ ?>
      <div class="sold-ribbon bg-danger text-light"> <?php echo __("Item Sold","premiumpress"); ?> </div>

<?php }elseif(_ppt('search_ribbon') == 1 &&  ( get_post_meta($post->ID,'featured', true) == 1 || get_post_meta($post->ID,'featured', true) == "yes" )){ ?>
      <div class="listing-list-featured hide-mobile hide-mobile">
         <?php echo __("Featured","premiumpress"); ?>
      </div>
<?php }elseif(isset($vv) && isset($vv['string-small']) && strlen($vv['string-small']) > 2 ){ ?>
          <div class="shadow-sm hide-mobile hide-ipad bg-danger" style="with:200px; background:red; color:white; position:absolute; top:30px; right:-5px; padding:10px;">
          <i class="fad fa-flame mr-2"></i> <?php echo __("Last viewed","premiumpress") ?> <strong><?php echo $vv['string-small']; ?></strong> <?php echo __("ago","premiumpress") ?>
          </div>
<?php } ?>


<div class="widget-heading"><h1 class="mb-3 h1-md"><?php echo do_shortcode('[TITLE]'); ?></h1></div>

<div class="mb-3 subtitle-list">
<ul class="d-flex list-unstyled">
    <li> <?php echo do_shortcode('[CATEGORYICON]'); ?> <?php echo do_shortcode('[CATEGORY]'); ?> </li>
    <li ><i class="fa fa-eye"></i> <?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress"); ?></li>
 
 
  	<?php if(in_array(THEME_KEY, array('mj'))){ ?> 
    <li><i class="fa fa-dashboard"></i>  <?php echo do_shortcode('[WAITING]'); ?> <?php echo __("Orders in Queue","premiumpress") ?>  </li>
    
    <li><i class="fa fa-bullhorn"></i> <?php echo do_shortcode('[SALES]'); ?> <?php echo __("Jobs Sold","premiumpress") ?> </li>
    
    <?php } ?>
    
    
  	<?php if(in_array(THEME_KEY, array('so'))){ ?> 
    <li><i class="fa fa-download"></i>  <?php echo do_shortcode('[DOWNLOADS]'); ?> <?php echo __("Downloads","premiumpress") ?>  </li>
    
    <?php } ?>
                           
    <?php if(_ppt('google') == 1 && get_post_meta($post->ID,'map-country', true) != "" ){   ?> 
    <li class="hide-ipad hide-mobile"><i class="fa fa-globe"></i> <?php echo do_shortcode('[COUNTRY link=1]'); ?></li>      
    <li><i class="fa fa-map-marker"></i> <?php echo do_shortcode('[CITY link=1]'); ?></li>
    <?php } ?>
</ul>
</div>

                
<div class="widget-body">
<?php echo do_shortcode('[GALLERY]'); ?>
</div>


  	<?php if(in_array(THEME_KEY, array('so'))){ ?> 
   <div class="bg-light text-center p-3">
   
   <a href="" class="btn btn-primary btn-lg rounded-0 mr-2">Live Demo</a> <a href="" class="btn btn-primary btn-lg rounded-0">Visit Website</a>
   
   </div>
   
    
    <?php } ?>

</div>




<?php if( THEME_KEY == "ph"){ ?>
<h4 class="py-3 h6 font-weight-bold bg-primary text-white pl-3 mt-3"><?php echo __("Related Images","premiumpress"); ?></h4>

<div id="relatedimages" class="owl-carousel"  data-items="5" data-autoplay="1">
<?php echo str_replace("listing-grid-item1","",do_shortcode('[LISTINGS dataonly=1 show=12 custom="category" carousel=1  small=1 ]')); ?> 
</div>
 <?php } ?>