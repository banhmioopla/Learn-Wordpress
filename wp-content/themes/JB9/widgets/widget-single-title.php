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
   
   global $post, $userdata, $CORE;	
   
   //$bgimg = "";
   // DT THEME
   //if(THEME_KEY == "at"){ 
  // $bgimg = do_shortcode('[CATEGORYIMAGE pathonly=1]');
  // }
   //if($bgimg == ""){
   $bgimg = do_shortcode('[IMAGE pathonly=1][/IMAGE]');
   //}
      
     $vv = $CORE->date_timediff(get_post_meta($post->ID,'lastviewed',true));	
  
   
   ?>
    
   
<div id="widget-single-hero" style="background:url('<?php echo $bgimg; ?>'); background-position:center center; background-size:cover;">

<?php if(isset($vv) && isset($vv['string-small']) && strlen($vv['string-small']) > 2 ){ ?>
          <div class="shadow-sm hide-mobile hide-ipad bg-danger" style="with:200px; background:red; color:white; position:absolute; top:30px; right:15px; padding:10px;">
          <i class="fad fa-flame mr-2"></i> <?php echo __("Last viewed","premiumpress") ?> <strong><?php echo $vv['string-small']; ?></strong> <?php echo __("ago","premiumpress") ?>
          </div>
<?php } ?>

   <div class="overlay">  
      <div class="wrap<?php if(THEME_KEY == "at"){ ?>1<?php } ?>">
         <div class="overlay2">
            <div class="container">
        
           
               <div class="row">
                  <div class="<?php if(THEME_KEY == "at"){ ?>col-md-10<?php }else{ ?>col-md-12<?php } ?> pl-4">
                     <h1 class="mb-3"><?php echo do_shortcode('[TITLE]'); ?></h1>
                     <div class="mb-4 subtitle-list">
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
                           
                           <?php if(in_array(THEME_KEY, array('at'))){ ?> 
                           <li><i class="fa fa-hand-paper"></i>  <?php echo do_shortcode('[BIDS]'); ?> <?php echo __("bids","premiumpress") ?>  </li>
                           
                           <?php } ?>
                           
                          
                           
                           <?php if(_ppt('google') == 1 && get_post_meta($post->ID,'map-country', true) != "" ){   ?> 
                           <li><a href="<?php echo home_url(); ?>/?s=&country=<?php echo get_post_meta($post->ID,'map-country', true); ?>" style="text-decoration:underline;"><?php echo do_shortcode('[COUNTRY]'); ?></a></li>
                           <li><a href="<?php echo home_url(); ?>/?s=&city=<?php echo get_post_meta($post->ID,'map-city', true); ?>" style="text-decoration:underline;"><?php echo do_shortcode('[CITY]'); ?></a></li>
                           <?php } ?>
                        </ul>
                     </div>                     
                     <?php if(THEME_KEY == "dt"){ ?>
                     <div class="mt-3 pb-4">
                        <?php echo do_shortcode('[RATING results=1]'); ?>
                     </div>
                     <?php } ?>
                  </div>
                  
                
                 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>