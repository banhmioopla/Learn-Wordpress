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
   
   global $CORE, $post, $settings, $userdata;
   
 
 if(_ppt('comments') == 1){ ?>
<div id="widget-commentsbox" class="p-lg-1">
   <?php 
   
   // WIDGET OPTION
   // SHOW TITLE
   if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>
   <div class="widget-title">
      <i class="fa fa-comments float-right mt-1"></i>
      <h6><?php echo __("Member Comments","premiumpress") ?></h6>
   </div>
   <?php } ?>


<?php echo do_shortcode('[COMMENTS]'); ?>

<?php if($userdata->ID){ ?>
<div class="p-3 bg-light border">
 <a href="<?php if($userdata->ID){ ?>javascript:void(0);<?php }else{ echo wp_login_url(); ?>?redirect=<?php echo get_permalink($post->ID); ?><?php } ?>" class="btn btn-block btn-primary font-weight-bold text-uppercase rounded-0 mt-2 <?php if($userdata->ID){ ?>btn-ajax-rating<?php } ?>" style="max-width:250px; margin:auto;">
 
 
 <i class="fa fa-comment" aria-hidden="true"></i> <?php echo __("Leave Comment","premiumpress") ?></a>
</div>

<?php } ?>
 
  
</div>






<div id="ajaxRatingModal" class="modal fade search-modal-wrapper" data-width="500" data-backdrop="static" data-keyboard="false" tabindex="-1" style="display: none;"></div>

<script>
   jQuery(document).ready(function() {
   	
	// remove comment form
   	jQuery('.ppt-comment-form').html('');
	jQuery('.comment-reply-link').hide();
	
	 
	var $modal1 = jQuery('#ajaxRatingModal');

	jQuery(document).on('click', '.btn-ajax-rating' ,function(){
		// create the backdrop and wait for next modal to be triggered
	  
		jQuery('body').modalmanager('loading');

		setTimeout(function(){
			 $modal1.load('<?php echo home_url(); ?>/?core_aj=1&action=ratingform&pid=<?php echo $post->ID; ?>', '', function(){
				$modal1.modal();
				 
			});
		}, 1000);		
	}); 
	 
	
 });
</script>
<?php } ?>