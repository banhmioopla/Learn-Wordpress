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

if(!_ppt_checkfile("widget-social.php")){?>


<div class="btn-group d-flex mb-4">
  <a class="btn rounded-0 text-light py-3" style="background-color: #3b5998;" href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url=<?php echo $link; ?>&amp;pubid=ra-53d6f43f4725e784&amp;ct=1&amp;title=<?php echo $title; ?>&amp;pco=tbxnj-1.0" target="_blank"><i class="fa fab fa-facebook" aria-hidden="true"></i> Facebook</a>
  <a class="btn rounded-0 text-light py-3" style="background-color: #1DA1F2;" href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url=<?php echo $link; ?>&amp;pubid=ra-53d6f43f4725e784&amp;ct=1&amp;title=<?php echo $title; ?>&amp;pco=tbxnj-1.0" target="_blank"><i class="fa fab fa-twitter" aria-hidden="true"></i> Twitter</a>
  <a class="btn rounded-0 text-light py-3" style="background-color: #bd081c;" href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url=<?php echo $link; ?>&amp;pubid=ra-53d6f43f4725e784&amp;ct=1&amp;title=<?php echo $title; ?>&amp;pco=tbxnj-1.0" target="_blank"><i class="fa fab fa-linkedin" aria-hidden="true"></i> Linkedin</a>
</div>

<?php } ?>