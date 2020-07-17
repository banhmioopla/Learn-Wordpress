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
    
   global $post, $CORE, $userdata;
   
   $data = $CORE->user_feedback_score($post->post_author); if($data['percentage'] == 0){ $data['percentage'] = 100; $data['score'] = 5; } ?>
   
<div class="widget listings-featured shadow-sm" id="widget-sellerbox" data-title="<?php echo __("Seller","premiumpress") ?>">
   <div class="widget-wrap">
      <div class="widget-block">  
   
   <span class="float-right"><?php echo $CORE->user_verified($post->post_author, 1); ?>  <?php echo $CORE->user_online($post->post_author, 1); ?></span>
   
 
         <div class="widget-title"><span><?php echo  $CORE->user_display_name($post->post_author); ?></span></div>
   
         
         
         
         
         <div class="row">
            <div class="col-md-3 text-center">
               <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" class="userphoto">
               <?php echo get_avatar( $post->post_author, 200 ); ?>
               </a>
              
            </div>
            <div class="col-md-5 pr-0">
               <div>
                  <span  class="h1"><?php echo $data['percentage']; ?>%</span>
               </div>
               <div class="rating-item rating-item-lg">
                  <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" data-readonly value="<?php echo $data['stars']; ?>"/>
               </div>
               <div class="small mt-1 text-muted"><?php echo $data['votes']; ?> <?php echo __("feedback left","premiumpress") ?></div>
            </div>
            <div class="col-4 px-0">
            
            
             <ul class="list-unstyled small mt-1">
                 <?php /* <li><i class="fa fa-check-square" aria-hidden="true"></i> <?php echo do_shortcode('[USER-ITEMSOLD]'); ?> <?php echo __("Items Sold","premiumpress") ?></li>*/ ?>
                  <li><i class="fa fa-check-square" aria-hidden="true"></i> <strong><?php echo __("Member since","premiumpress") ?></strong> <br /><?php echo do_shortcode('[USER-SINCE]'); ?></li>
                  <li class="mt-2"><i class="fa fa-check-square" aria-hidden="true"></i> <strong><?php echo __("Last online","premiumpress") ?></strong> <br /><?php echo do_shortcode('[USER-LASTONLINE]'); ?></li>
               </ul>
            
            
            </div>
         
         
         
   
      </div>
   </div>
</div>   
