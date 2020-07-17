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
   
   global $post, $settings, $userdata, $CORE_VIDEO;
   
   	// RATINGS
	$up 	= get_post_meta($post->ID, 'ratingup', true);
	$down 	= get_post_meta($post->ID, 'ratingdown', true);
	$total 	= get_post_meta($post->ID, 'rating_total', true);
	
	if(!is_numeric($up)){ $up = 0; }
    if(!is_numeric($down)){ $down = 0; }
   
    
   ?>
  
   
   
<div id="widget-maindetails">

<?php if($CORE_VIDEO->has_video_access()){ ?>
<?php echo do_shortcode('[VIDEO]'); ?> 

<?php }elseif(_ppt('videopreview_enable') == 1 && is_numeric(_ppt('videopreview_seconds')) ){ ?>
<?php echo do_shortcode('[VIDEO]'); ?> 
<div class="container p-3 border bg-secondary text-white" id="freepreviewbar" style="display:none;">
<div class="row">
<div class="col-12">

<strong><?php echo __("Free Preview","premiumpress") ?></strong>
</div>
<div class="col-12">

  <div class="progress mt-2" style=" height:40px;">
        <div class="progress-bar progress-bar-striped videotimeoutbar" style="min-width: 20px;"></div>
    </div>

</div>
</div>
</div>
 

<div class="container h-100 border px-md-5 bg-secondary text-white" id="upgrademessage" style="display:none;">
    <div class="row align-items-center h-100 my-md-5 py-5">
        <div class="col-8 mx-auto text-center my-lg-3">
<h3><?php echo __("Video Preview Ended!","premiumpress") ?></h3>
<p><?php echo wpautop(stripslashes(get_option('videopreview_message'))); ?></p>
<a href="<?php echo _ppt('listingaccess_redirect'); ?>" class="btn btn-primary btn-lg mt-4"><?php echo __("Upgrade Now","premiumpress") ?></a>      
        </div>
    </div>
</div>

<?php }else{ ?>

<div class="ppt_listing sh video mb-4">
   <figure>
      <a href="<?php echo _ppt('listingaccess_redirect'); ?>">
      <i class="fa fa-play-circle"></i>
      <?php echo do_shortcode('[IMAGE link=0]'); ?>
      </a>                            
      <span><i class="fa fa-clock-o"></i> <?php echo do_shortcode('[DURATION]'); ?></span>
   </figure>
</div>
<?php } ?>



<div class="widget" id="widget-rating-box" data-title="<?php echo __("Rating Box","premiumpress") ?>">


<div class="row">
<div class="col-md-4">
<div class="mt-2"><?php echo do_shortcode('[RATEBUTTON]'); ?></div>
<?php echo do_shortcode('[FAVS class="mt-3 btn btn-sm btn-outline-dark" icon=1]'); ?>
</div>
<div class="col-md-4">
 
</div>
<div class="col-md-4">


    <div class="small-rating-box">    
        <h4><?php echo do_shortcode('[HITS]'); ?> views</h4>
        <div class="progress">
          <div class="progress-bar bg-success rounded-0" role="progressbar" style="width: <?php echo do_shortcode('[SUCCESSRATE]'); ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row mt-2">
        <div class="col-4"><?php echo do_shortcode('[SUCCESSRATE]'); ?>%</div>
        <div class="col-4"> <i class="fa fa-thumbs-up"></i> <?php echo number_format($up); ?></div>
        <div class="col-4"> <i class="fa fa-thumbs-down"></i> <?php echo number_format($down); ?></div>
        </div>
	</div>


</div>
</div>

</div>







 
   <div class="widget-single mt-4">
   
   
<h1 class="h4 mb-3"><?php echo do_shortcode('[TITLE]'); ?></h1>

    
   
<script>
   jQuery( document ).ready(function() { 
   
   if(jQuery('.videosection').length < 1){
   jQuery('#videoseries-li').hide();
   }
   
   jQuery('#videocount').html(jQuery('.videosection').length); 
   
   });
</script>

   <div class="mt-1">
      <?php 
         $attributes = array();
         $attributes = get_post_meta($post->ID,"attributes",true);
         if(isset($attributes['title']) && $attributes['title'][0] != ""){
         ?>
         
         <div class="widget-title"> <h6><?php echo __("Series Videos","premiumpress") ?></h6> </div>
      
       
     
      <?php
         $i=0;
         foreach($attributes['title'] as $data){ 
         
         if(!isset($attributes['title'][$i]) || (isset($attributes['title'][$i]) && $attributes['title'][$i] == "") ){  $i++; continue; }
         ?>
      <div class="ppt_listing video mb-4 bg-light videosection">
         <div class="row">
            <div class="col-sm-3">
               <figure>
                  <a <?php if($CORE_VIDEO->has_video_access()){ ?>href="#videoplayer" class="cvid text-primary" data-video="<?php echo $attributes['video'][$i]; ?>"<?php }else{ ?>href="<?php echo _ppt(array('links','memberships')); ?>"<?php } ?>  class="cvid text-primary">
                  <i class="fa fa-play-circle"></i>
                  <img src="<?php echo $attributes['image'][$i]; ?>" class="img-fluid">
                  </a>                            
                  <span><?php echo gmdate("H:i:s",$attributes['time'][$i]); ?></span>                          
               </figure>
            </div>
            <div class="col-sm-9">
               <h3><a <?php if($CORE_VIDEO->has_video_access()){ ?>href="#videoplayer" class="cvid text-primary" data-video="<?php echo $attributes['video'][$i]; ?>" <?php }else{ ?>href="<?php echo _ppt(array('links','memberships')); ?>"<?php } ?>  class="cvid text-primary"><?php echo $attributes['title'][$i]; ?></a></h3>
               <p><?php echo $attributes['desc'][$i]; ?></p>
            </div>
         </div>
      </div>
      
      <?php $i++; } } ?>
   </div>
   <?php if($CORE_VIDEO->has_video_access()){ ?>
   <script>
      var done = false;
      var player;
      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      
      jQuery('.cvid').click(function (e) {
      
          var youTubeId = jQuery(this).data( "video" );
       
            player = new YT.Player('videoplayer', {
                height: '430',
                width: '730',
                videoId: youTubeId,
                events: {
                  'onReady': onPlayerReady,
                  'onStateChange': onPlayerStateChange
                }
             }); 
        
      });
      
      function onPlayerReady(event) {
      	event.target.playVideo();
      }
      function onPlayerStateChange(event) {
              if (event.data == YT.PlayerState.PLAYING && !done) {
                setTimeout(stopVideo, 6000);
                done = true;
              }
            }
      function stopVideo() {
              player.stopVideo();
      }
   </script> 
   <?php } ?>   
   
   
      <?php if(!isset($settings['show_desc']) || ( isset($settings['show_desc']) && $settings['show_desc'] == 1 ) ){ ?>
      <div class="widget-title">
      
          
         <h6><?php echo __("Description","premiumpress") ?></h6>
      </div>
      <div class="pb-3"><?php echo do_shortcode('[CONTENT media=0]'); ?></div>
      
      <?php echo do_shortcode('[FIELDS]'); ?>
      <?php echo do_shortcode('[TAGS class="mt-3 mb-4"]'); ?> 
      <?php } ?>
      <div class="mb-4">
      <?php echo do_shortcode('[SOCIAL]'); ?>
 	  </div> 
      
      
      
      <?php if(_ppt('comments') == 1){ ?>
       
      <?php get_template_part( 'widgets/widget-single', 'comments' );  ?> 
 	  </div> 
      <?php } ?>
      
      
      
      
      
   </div>
</div> 