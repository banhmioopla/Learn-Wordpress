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
   
   global $CORE, $userdata;
    
    ?>
<div class="<?php if(defined('IS_MOBILEVIEW') ){ }else{?>card rounded-0<?php } ?>">
   <div class="card-header" id="headingYouTube">
      <h5 class="mb-0">
         <button class="btn btn-link btn-block text-left text-uppercase font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseYouTube" aria-expanded="false" aria-controls="collapseYouTube">
         <?php echo __("Youtube Video","premiumpress"); ?>
         </button>
      </h5>
   </div>
   <div id="collapseYouTube" class="collapse" aria-labelledby="headingYouTube" data-parent="#accordion">
      <div class="<?php if(defined('IS_MOBILEVIEW') ){ ?>mt-3<?php }else{?>card-body<?php } ?>">
         <div class="row">
            <div class="col-md-6">
               <p class="lead"><?php echo __("Enhance your listing with a YouTube video and give your visitors something extra.","premiumpress") ?></p>
               <p><?php echo __("Simply enter the Youtube link into the box and we'll capture the video ID for you.","premiumpress") ?></p>
               <a href="http://www.youtube.com" class="btn btn-outline-secondary mt-3" target="_blank"><?php echo __("Search Youtube Now","premiumpress") ?> <i class="fa fa-angle-right ml-3"></i></a>
            </div>
            <div class="col-md-6">
               <label class="font-weight-bold text-uppercase"><?php echo __("Youtube Video ID","premiumpress") ?></label>
               <input type="text" class="form-control input-lg btn-block mb-3" name="youtube_id" id="youtubeId" value="<?php if(isset($_GET['eid'])){ echo get_post_meta($_GET['eid'], "youtube_id",true ); } ?>" />
               <div id="info" class="mb-3"></div>
               <iframe id="myIframe" width="100%" height="240" style="display:none;"></iframe>
               <?php if(isset($_GET['eid']) && get_post_meta($_GET['eid'], "youtube_id",true ) != ""){ ?>
               <div id="videoplayer"><iframe width="100%" height="240px" src="https://www.youtube.com/embed/<?php echo get_post_meta($_GET['eid'], "youtube_id",true ); ?>"></iframe></div>
               <?php }else{ ?>
               <div id="videopreview" class="bg-light btn-block text-center text-dark text-uppercase" style="min-height:300px; line-height:300px;"><?php echo __("Video Preview","premiumpress") ?></div>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   var delay = (function() {
     var timer = 0;
     return function(callback, ms) {
       clearTimeout(timer);
       timer = setTimeout(callback, ms);
     };
   })();
   
   jQuery("#youtubeId").keyup(function() {
     delay(function() {
       var videoID = jQuery('#youtubeId').val();
   	
   	$canContinue = true;
   	if(videoID.length != 11){
   	
   		var videoid = videoID.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
   		if(videoid != null) {
   		   videoID = videoid[1];
   		   jQuery('#youtubeId').val(videoID);
   		} else { 
   			alert("You have entered an invalid YouTube ID, it should be 11 characters total.");
   			$canContinue = false;
   		}		
   	}
   	
   	if($canContinue){
   		
   		jQuery("#myIframe").show();
   		jQuery("#videopreview").hide();
   		jQuery("#videoplayer").html('');
   	
   		var videos = "https://www.googleapis.com/youtube/v3/videos";
   		var apiKey = "AIzaSyDh7t4pTysqKzV-_5q4X7mK_waW_9Tmq64";
   		var fieldsTitle = "fields=items(snippet(title))";
   		var fieldsEmpty = "";
   		var part = "part=snippet";
   	
   		function getUrl(fields) {
   		  var url = videos + "?" + "key=" + apiKey + "&" + "id=" + videoID + "&" + fields + "&" + part;
   		  return url;
   		}
   	
   		jQuery.get(getUrl(fieldsEmpty), function(response) {
   		  var status = response.pageInfo.totalResults;
   		  var title;
   		  if (status) {
   			jQuery.get(getUrl(fieldsTitle), function(response) {
   			  title = response.items[0].snippet.title;
   			  jQuery('#info').text(title);
   			  var url = "https://www.youtube.com/embed/" + videoID;
   			  jQuery('#myIframe').attr('src', url)
   			})
   		  } else {
   			title = "Video doesn't exist";
   			jQuery('#info').text(title);
   			jQuery('#myIframe').attr('src', "");
   		  }
       });
   	
   	
   	}
   	
     }, 1000);
   });
</script>