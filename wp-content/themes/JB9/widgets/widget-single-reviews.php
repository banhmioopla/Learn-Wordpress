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
   
   global $CORE, $CORE_DIRECTORY, $post, $settings, $userdata;
   
   $r1 = __("Quality","premiumpress");
   $r2 = __("Originality","premiumpress");
   $r3 = __("Creativity","premiumpress");
   $r4 = __("Overall","premiumpress");   
   
   // STAR RATING
   $starrating = get_post_meta($post->ID, 'starrating', true);
   if(!is_numeric($starrating)){ $starrating = 0; }else{ $starrating = number_format($starrating,1); }
   
   $starreviews = get_post_meta($post->ID, 'starrating_votes', true);
   if(!is_numeric($starreviews)){ $starreviews = 1; }
   
   
   $srating = array(0,0,0,0,0,0);
   $spercent = array(0,0,0,0,0,0);
   $sextras = array(0,0,0,0,0,0);
   
   
   
// NOW LETS CHECK FOR A REPLY TO THIS FEEDBACK
		$args = array(
			'post_type' => 'wlt_feedback',
			'posts_per_page'	=> '150',
			'meta_query' => array(					 
					array(
						'key'		=> 'pid',
						'value' 	=> $post->ID,
						'compare' 		=> '=',
					),					 
				),		);
		// GET USER FEEDBACK
		$sub_query = new WP_Query($args); 
		$reply_query = $sub_query->posts;
		
		if(!empty($reply_query)){ 
		
			foreach($reply_query as $ratingdata){
			 
			   	// GET THE RATING VALUE FOR EACH COMMENT
				$crating = get_post_meta( $ratingdata->ID, 'ratingtotal', true );	
				if($crating == 5){
				$b=5;
				}elseif($crating > 3.9 && $crating < 5){
				$b=4;
				}elseif($crating > 2.9 && $crating < 4){
				$b=3;
				}elseif($crating > 1.9 && $crating < 3){
				$b=2;
				}elseif($crating < 2){
				$b=1;
				}
				$srating[$b] = $srating[$b]+1; 
				$spercent[$b] = $spercent[$b] + (1/$starreviews*100);
				
				// GET THE RATING VALUE FOR EACH COMMENT
				$i=1; while($i < 5){
					$crating = get_post_meta( $ratingdata->ID, 'rating'.$i, true );	
					//echo $crating."< (".$i.")--<br>";
					if(!is_numeric($crating)){ $crating = 5; }		
					$sextras[$i] = $sextras[$i] + $crating;
					$i++;
				}		
			
			}
		
		} 
   		
 
   // CLEAN UP FRACTIONS
   $i=1; while($i < 5){
   $sextras[$i] = $sextras[$i]/$starreviews;
   $i++;
   }
   
    
    
   ?>
   
<div id="widget-commentsbox" class="widget pb-0 bg-white" data-title="<?php echo __("Comemnts &amp; Reviews","premiumpress") ?>"><div class="pb-0" >
   <?php 
   
   // WIDGET OPTION
   // SHOW TITLE
   if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>
   <div class="widget-title">
      <i class="fa fa-comments float-right mt-1"></i>
      <h6><?php echo __("User Reviews","premiumpress") ?></h6>
   </div>
   <?php } ?>
   <div class="container  border-bottom pb-3 mb-5">
      <div class="row">
         <div class="col-md-4 border-right pr-3 text-center">
         
            <?php if($starrating > 0){ ?>
            <div class="ratingbignum clearfix"><?php echo $starrating; ?></div>
            <div class="ratingbigstars mt-sm-3 clearfix"><?php echo do_shortcode('[RATING]'); ?></div>
            <div class="ratingbigcount"><?php echo  sprintf( _n( '%s review', '%s reviews', $starreviews, 'premiumpress' ), $starreviews ); ?></div>
            <?php }else{ ?>      
            <div class="ratingnotxt"><?php echo __("Reviews can only be left by members who have paid for this item.","premiumpress") ?></div>
            <?php } ?>         
            
         </div>
         <div class="col-md-8 pl-5">
            <?php $i=1; $t=5; while($i < 6){ ?>
            <div class="row my-2">
               <div class="col-2 px-0">
                  <?php echo $t; ?> <i class="fa fa-star <?php if($spercent[$t] == 0){ ?>text-muted<?php }else{ ?>text-warning<?php } ?>" aria-hidden="true"></i>
               </div>
               <div class="col-9">
                  <div class="progress rounded-0">
                     <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $spercent[$t]; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
               </div>
               <div class="col-1 px-0"><?php if($starrating > 0){ ?>
                  <span class="text-muted"><?php echo $srating[$t]; ?></span>
                  <?php } ?>
               </div>
            </div>
            <?php $i++; $t--; } ?>
            <div class="row mt-3">
               <div class="col-6 col-sm-3 px-0 smallrate">
                  <label><?php echo $r1; ?></label>
                  <div class="clearfix"></div>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" value="<?php echo $sextras[1]; ?>" style="cursor:pointer;" disabled/>
                  </div>
               </div>
               <div class="col-6 col-sm-3  px-0 smallrate">
                  <label><?php echo $r2; ?></label>
                  <div class="clearfix"></div>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" value="<?php echo $sextras[2]; ?>" style="cursor:pointer;" disabled/>
                  </div>
               </div>
               <div class="col-6 col-sm-3 px-0 smallrate">
                  <label><?php echo $r3; ?></label>
                  <div class="clearfix"></div>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" value="<?php echo $sextras[3]; ?>" style="cursor:pointer;" disabled/>
                  </div>
               </div>
               <div class="col-6 col-sm-3  px-0 smallrate">
                  <label><?php echo $r4; ?></label>
                  <div class="clearfix"></div>
                  <div class="rating-item">
                     <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" value="<?php echo $sextras[4]; ?>" style="cursor:pointer;" disabled/>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   <?php
   
   // GET MY FEEDBACK
$args = array(
	'post_type' => 'wlt_feedback',
	'posts_per_page'	=> '150',
	'author' => $authorID,
	'meta_query' => array(
			 
			array(
				'key'		=> 'pid',			 
				'compare' 		=> '=',
				'value' => $post->ID
			),
			 
		),
);
$query1 = new WP_Query($args);
$posts1 = $query1->posts;
 
foreach($posts1 as $post){

	// DISPLAY FEEDBACK 
	get_template_part( 'content', 'feedback' );

} ?>
   
   
</div></div>
<script>
   jQuery(document).ready(function() {
   	
	// remove comment form
   	jQuery('.ppt-comment-form').html('');
	jQuery('.comment-reply-link').hide();
	
 });
</script>