<?php global $comment, $settings, $args, $post_authorID; 

if(!is_array($args)){ $args = array(); }

// GET COMMENT SCORE
if(isset($comment->comment_ID)){
$score = get_post_meta($comment->comment_ID, 'score', true);
}else{
$score =0;
}


   if(in_array( THEME_KEY, array("sp","cm","ct"))){
   
   $r1 = __("Delivery","premiumpress");
   $r2 = __("Packaging","premiumpress");
   $r3 = __("Quality","premiumpress");
   $r4 = __("Value","premiumpress");
   
   }elseif(THEME_KEY == "ph"){
   
   $r1 = __("Quality","premiumpress");
   $r2 = __("Originality","premiumpress");
   $r3 = __("Creativity","premiumpress");
   $r4 = __("Overall","premiumpress");
  
   }else{
   
   $r1 = __("Location","premiumpress");
   $r2 = __("Service","premiumpress");
   $r3 = __("Staff","premiumpress");
   $r4 = __("Value","premiumpress");
   
   }		


?>


<div class="comment-wrapper mb-4 border-bottom pb-4">

<div class="row">
<div class="<?php if(get_comment_meta( $comment->comment_ID, 'rating1', true ) != ""){   ?>col-md-8<?php }else{ ?>col-12<?php } ?>">

    <div class="row">
    
        <div class="col-2 pr-0">
            <div class="image">
              <a href="<?php echo get_author_posts_url( $post_authorID ); ?>">
              <?php echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?>
              </a>
           </div>
        </div>
        
        <div class="col-10">
        <?php if(isset($comment->comment_ID)){ ?>
              <div class="comment-author text-uppercase font-weight-bold float-left"><?php comment_author(); ?></div>
              
              <div class="comment-date text-muted float-right small mr-lg-4"><?php if(isset($comment->comment_ID)){ echo get_comment_date(); } ?></div>
              
              <div class="clearfix"></div>
              
              <?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'depth' => 1,   'max_depth' => 5)), $comment->comment_ID) ?> 
               
              <?php /* if(isset($authora->ID) && $authora->ID == $post_authorID){ ?>
              <span class="badge badge-success float-right"><?php echo __("Author","premiumpress"); ?></span>					
              <?php } */ ?>
              
              <div class="desc mt-4" style="border-left: 3px solid #e1e2e2;    padding-left: 20px;"> <?php comment_text() ?>  </div>
               
              <?php if ($comment->comment_approved == '0') : ?>
              <p class="alert alert-info">Your comment is awaiting moderation.</p>
              <?php endif; ?>
              
              <?php  edit_comment_link(__("Edit Comment","premiumpress"),'',''); ?>
         <?php } ?>
        </div>
    </div>
</div>
<?php if(isset($comment->comment_ID) && get_comment_meta( $comment->comment_ID, 'rating1', true ) != ""){   ?>
<div class="col-md-4 pl-0">
   
      <div class="ratingboxes p-2 bg-light shadow-sm smallrate">
         
            <div class="row">
               <div class="col-6 rating-wrapper mt-2">
                  <span class="review-label-top text-muted font-weight-bold small text-uppercase"><?php echo $r1; ?></span>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" 
                        data-readonly value="<?php echo get_comment_meta( $comment->comment_ID, 'rating1', true ); ?>"/>
                  </div>
               </div>
               <div class="col-6 rating-wrapper mt-2">
                  <span class="review-label-top text-muted font-weight-bold small text-uppercase"><?php echo $r2; ?></span>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" 
                        data-readonly value="<?php echo get_comment_meta( $comment->comment_ID, 'rating2', true ); ?>"/>
                  </div>
               </div>
               <div class="col-6 rating-wrapper mt-2">
                  <span class="review-label-top text-muted font-weight-bold small text-uppercase"><?php echo $r3; ?></span>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" 
                        data-readonly value="<?php echo get_comment_meta( $comment->comment_ID, 'rating3', true ); ?>"/>
                  </div>
               </div>
               <div class="col-6 rating-wrapper mt-2">
                  <span class="review-label-top text-muted font-weight-bold small text-uppercase"><?php echo $r4; ?></span>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" 

                        data-readonly value="<?php echo get_comment_meta( $comment->comment_ID, 'rating4', true ); ?>"/>
                  </div>
               </div>
             
         </div>
      </div>      
</div>
<?php } ?> 
</div>
</div>