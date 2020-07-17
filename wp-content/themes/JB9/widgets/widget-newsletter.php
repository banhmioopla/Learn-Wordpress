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

global $CORE, $userdata, $settings, $post; 

if(!_ppt_checkfile("widget-newsletter.php")){
 
?>



<div class="bg-primary p-4 text-light">

<i class="fas fa-envelope-open-text float-left" style="font-size: 45px;   margin-left:-10px; margin-right: 20px;"></i>


<?php if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>

<h4 class="text-uppercase font-weight-bold mb-3"> 
<?php if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{  echo __("Sign up for Newsletter","premiumpress"); } ?>
</h4>
 
<p style="font-size:12px;">
<?php if(isset($settings['desc']) && strlen($settings['desc']) > 1 ){ echo $settings['desc']; }else{ echo __("Sign up to get our latest exclusive updates, deals, offers and promotions.","premiumpress"); } ?>
</p> 

<?php } ?>
<?php get_template_part( 'templates/widget', 'newsletter' ); ?> 

</div>

<?php } ?>