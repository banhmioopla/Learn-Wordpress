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
<div class="card my-4 bg-light rounded-0">
   <div class="card-body">
      <div class="ratingboxborder">
         <div class="row">
            <div class="col-md-2 col-6 text-center">
               <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" class="userphoto">
               <?php echo get_avatar( $post->post_author, 200 ); ?>
               </a>
               <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" class="small mt-3 clearfix text-dark"><u><?php echo  $CORE->user_display_name($post->post_author); ?></u></a>
            </div>
            <div class="col-md-3 col-6">
               <div>
                  <span  class="h1"><?php echo $data['percentage']; ?>%</span>
               </div>
               <div class="rating-item rating-item-lg">
                  <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" data-readonly value="<?php echo $data['stars']; ?>"/>
               </div>
               <span class="small"><?php echo $data['votes']; ?> <?php echo __("feedback left","premiumpress") ?></span>
            </div>
            <div class="col-md-4 col-12 pl-md-0">
               <?php echo $CORE->user_verified($post->post_author, 1); ?>  <?php echo $CORE->user_online($post->post_author, 1); ?>
               <ul class="list-unstyled small mt-3">
                  <li><i class="fa fa-check-square" aria-hidden="true"></i> <?php echo do_shortcode('[USER-ITEMSOLD]'); ?> <?php echo __("Items Sold","premiumpress") ?></li>
                  <li><i class="fa fa-check-square" aria-hidden="true"></i> <?php echo __("Member since","premiumpress") ?> <?php echo do_shortcode('[USER-SINCE]'); ?></li>
                  <li><i class="fa fa-check-square" aria-hidden="true"></i> <?php echo __("Last online","premiumpress") ?> <?php echo do_shortcode('[USER-LASTONLINE]'); ?></li>
               </ul>
            </div>
            <div class="col-md-3">
               <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" class="btn btn-primary btn-block text-uppercase"><?php echo __("Visit Profile","premiumpress") ?></a>
               <div class="mt-2 text-center">
                  <u><a class="small" href="<?php echo home_url(); ?>/?s=&uid=<?php echo $post->post_author; ?>"><?php echo __("more items by this seller","premiumpress") ?></a></u>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>