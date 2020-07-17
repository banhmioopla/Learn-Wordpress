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
   
   if(!_ppt_checkfile("widget-search.php")){
   ?>
 
<div class="widget shadow-sm" id="widget-search">
   <div class="widget-wrap">
      <div class="widget-block">
         <?php  if(!isset($settings['show_title']) || ( isset($settings['show_title']) && $settings['show_title'] != 0) ){ ?>
         <div class="widget-title"><span><?php 
		 
		 if(isset($settings['title']) && strlen($settings['title']) > 1 ){ echo $settings['title']; }else{ echo __("Quick Search","premiumpress"); }
		  
		  ?></span></div>
         <?php } ?>
         <div class="widget-content">
         
         <form action="<?php echo get_home_url(); ?>/?s=" method="get">
 
<div class="mb-3">
<label><?php echo __("Keywords","premiumpress") ?></label>         
<input type="text" class="form-control" id="basic_keysearch" name="s" value="<?php if(isset($_GET['s']) && strlen($_GET['s']) > 1){ echo esc_html($_GET['s']); } ?>" />
</div>   
<?php  if(!isset($settings['show_cats']) || ( isset($settings['show_cats']) && $settings['show_cats'] != 0) ){ ?>
<div class="mb-3">
    <label><?php echo __("Category","premiumpress") ?></label>         
    <select class="form-control"  name="catid">
    <option><?php echo __("All Categories","premiumpress") ?></option>
    <?php 
	$catid = "";
	if(isset($_GET['catid']) && is_numeric($_GET['catid']) ){ $catid = $_GET['catid']; }	
	echo $CORE->CategoryList(array($catid,false,0,'listing')); ?>
    </select>
</div>   
<?php } ?>

<button type="submit" class="btn btn-primary rounded-0 btn-block"><?php echo __("Search","premiumpress") ?></button>

</form> 
         
         
          
            
       </div>
      </div>
   </div>
</div>
<?php } ?>