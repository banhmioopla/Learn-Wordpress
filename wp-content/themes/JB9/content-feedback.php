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

if(!_ppt_checkfile("content-feedback.php")){

global $CORE, $post;

   $r1 = __("Quality","premiumpress");
   $r2 = __("Originality","premiumpress");
   $r3 = __("Creativity","premiumpress");
   $r4 = __("Overall","premiumpress");
   
   
// GET LISTING ID
$listingid = get_post_meta($post->ID,'pid',true);		 
$listing_link = "";
if(!isset($GLOBALS['flag-single']) && is_numeric($listingid)){		
	$listing_link = '<div class="mt-3"><a href="'.get_permalink($listingid).'">'.get_the_title($listingid).'</a></div>';
}
   

?>


<div class="comment-wrapper mb-4 border-bottom pb-4">


<div class="col-12">

    <div class="row">
    
        <div class="col-md-1 pr-0">
            <div class="image">
              <a href="<?php echo get_author_posts_url(  $post->post_author); ?>">
              <?php echo get_avatar( $post->post_author, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?>
              </a>  
           </div>
        </div>
        
        <div class="col-md-7 pl-lg-3">
      
              <div class="comment-author text-uppercase font-weight-bold float-left"><?php the_author(); ?></div>
              
              <div class="comment-date text-muted float-right small mr-lg-4"><?php echo hook_date($post->post_date); ?></div>
              
              <div class="clearfix"></div>
           
              <div class="desc mt-4" style="border-left: 3px solid #e1e2e2; padding-left: 20px;"> <?php echo $post->post_content; ?>  </div>
              
              <?php echo $listing_link; ?>
 
        
    </div>

<div class="col-md-4 px-0">
   
      <div class="ratingboxes p-2 bg-light shadow-sm smallrate">
         
            <div class="row">
               <div class="col-6 rating-wrapper mt-2">
                  <span class="review-label-top text-muted font-weight-bold small text-uppercase"><?php echo $r1; ?></span>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" 
                        data-readonly value="<?php echo get_post_meta( $post->ID, 'rating1', true ); ?>"/>
                  </div>
               </div>
               <div class="col-6 rating-wrapper mt-2">
                  <span class="review-label-top text-muted font-weight-bold small text-uppercase"><?php echo $r2; ?></span>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" 
                        data-readonly value="<?php echo get_post_meta( $post->ID, 'rating2', true ); ?>"/>
                  </div>
               </div>
               <div class="col-6 rating-wrapper mt-2">
                  <span class="review-label-top text-muted font-weight-bold small text-uppercase"><?php echo $r3; ?></span>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" 
                        data-readonly value="<?php echo get_post_meta( $post->ID, 'rating3', true ); ?>"/>
                  </div>
               </div>
               <div class="col-6 rating-wrapper mt-2">
                  <span class="review-label-top text-muted font-weight-bold small text-uppercase"><?php echo $r4; ?></span>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" 

                        data-readonly value="<?php echo get_post_meta( $post->ID, 'rating4', true ); ?>"/>
                  </div>
               </div>
             
         </div>
        </div></div></div></div>   
</div>

<?php } ?>