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

global $CORE, $userdata, $post; 


if(is_single()){
	$link = get_permalink($post->ID);
	$title = $post->post_title;
}else{
	$link = home_url();
	$title = "";
}

$link  = str_replace("&","&amp;", $link );

if(!_ppt_checkfile("widget-like.php")){?>


<div class="widget p-0 m-0" style="background:none !important; box-shadow:none !important; border:0px !important;"  id="Sstatisticsbox" data-title="<?php echo __("Statistics","premiumpress") ?>">
 
 
<div class="btn-group d-flex mb-4" style="width:100%;">


<?php if(THEME_KEY == "at"){ ?>

<a href="javascript:void(0);" class="listing-btn" style="cursor:auto;">
      <span class="listing-btn-action listing-btn-comments"><i class="fa fa-search"></i> <?php echo __("Views","premiumpress") ?></span>
      <span class="listing-btn-count"><?php echo do_shortcode('[HITS]'); ?></span>
    </a>
<?php }elseif(THEME_KEY == "cp"){ ?>
<a href="javascript:void(0);" class="listing-btn" style="cursor:auto;">
      <span class="listing-btn-action listing-btn-comments"><i class="fa fa-smile"></i> <?php echo __("Used","premiumpress") ?></span>
      <span class="listing-btn-count"><?php echo do_shortcode('[USED]'); ?></span>
</a>    
<?php }else{ ?>
<a href="javascript:void(0);" class="listing-btn" style="cursor:auto;">
      <span class="listing-btn-action listing-btn-comments"><i class="fa fa-comment"></i> <?php echo __("Comments","premiumpress") ?></span>
      <span class="listing-btn-count"><?php echo get_comments_number($post->ID); ?></span>
</a>    
<?php } ?>


<?php if(THEME_KEY == "at"){ ?>
<a href="javascript:void(0);" class="listing-btn" style="cursor:auto;">
      <span class="listing-btn-action listing-btn-like"><i class="fa fa-hand-paper"></i> <?php echo __("Bids","premiumpress") ?></span>
      <span class="listing-btn-count"><?php echo do_shortcode('[BIDS]'); ?></span>
</a>
<?php }else{ ?>    
<a href="javascript:void(0);" class="listing-btn" style="cursor:auto;">
      <span class="listing-btn-action listing-btn-like"><i class="fa fa-search"></i> <?php echo __("Views","premiumpress") ?></span>
      <span class="listing-btn-count"><?php echo do_shortcode('[HITS]'); ?></span>
</a>
<?php } ?>
    
    <a href="javascript:void(0);" class="listing-btn" id="likemeplusone" onclick="ajax_likeme_add();">    
    <span id="likemebubble" class="shadow"><i class="fa fa-thumbs-up"></i></span>
    
      <span class="listing-btn-action listing-btn-plus"><i class="fa fa-thumbs-up"></i> <?php echo __("Likes","premiumpress") ?></span>
      <span class="listing-btn-count"><?php echo do_shortcode('[LIKES]'); ?></span>
    </a>
    
    
</div>

</div> 

<script>
function ajax_likeme_add(){
    
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
            action: "rating_likes",
			pid: "<?php echo $post->ID; ?>",
            value: "up",
           },
           success: function(response) {
   			
				if(response == "none"){
				  	
				}else{				
				
					jQuery('#likemeplusone').prop("onclick", null).off("click");
					
					jQuery('#likemebubble').addClass('bg-success');
					jQuery('#likemeplusone .listing-btn-count').html(response);	
					jQuery('#likemebubble').html("<i class='fa fa-check'></i>");				
					jQuery('.listing-btn-plus').addClass('listing-btn-thankyou');					
				}
				
           },
           error: function(e) {
               alert("error "+e)
           }
       });   
}

jQuery(document).ready(function () {
setTimeout(function(){ 

       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
            action: "rating_likes_check",
			pid: "<?php echo $post->ID; ?>",
            value: "up",
           },
           success: function(response) {
   			
				if(response == "none"){
				
					jQuery('#likemeplusone').prop("onclick", null).off("click");
					jQuery('#likemebubble').addClass('bg-success');
					jQuery('#likemebubble').html("<i class='fa fa-check'></i>");				
					jQuery('.listing-btn-plus').addClass('listing-btn-thankyou');			
				  	
				}else{
									
				}
				
           },
           error: function(e) {
               alert("error "+e)
           }
       });



}, 1000);		 
});
 
</script>

<?php } ?>