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


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

 

  
?> 
 
 
 
 

<div class="row">  
 
 

<div class="col-md-8">

<div class="alert alert-info p-lg-4">
<img src="<?php echo get_bloginfo('template_url')."/framework/admin/images/"; ?>f1.png" class="infoimg" style="float:left; padding-right:20px;">

<h1 style="color:#206E94;font-weight:bold;">Create Child Theme</h1>

 
<p class="lead mt-3">This tool will turn your current settings into a WordPress child theme.</p>
 
<p class="lead">Learn more about child themes in our - getting started <a href="https://www.premiumpress.com/gettingstarted/" style="color:blue; text-decoration:underline;" target="_blank">video tutorials.</a>

</p>
</div>


</div>
 
<div class=" col-md-4">




<div class="bg-white p-5 shadow" style="border-radius: 7px;">



 
        <form method="post" action="">
        <input type="hidden" name="dsample" value="123" />     
            
                 
           <label class="txt500">Child Theme Name</label><br />
          
          <input type="text"  name="name" value="My New Child Theme" class="form-control">
            
            <hr />
             
            <!------------ FIELD --------------> 
            <div style="text-align:center;"><button type="submit" class="btn btn-primary btn-lg">Download Child Theme</button></div>
            
            </form>

</div>

</div>


<div class="p-2">
<a href="javascript:void(0);" onclick="jQuery('#debugtt').toggle();">show debug code</a>
</div>
<textarea style="width:100%; height:400px; display:none;" id="debugtt">    			 
$core['color_primary'] 			= "<?php echo _ppt('color_primary'); ?>";
$core['color_secondary'] = "<?php echo _ppt('color_secondary'); ?>";
<?php if(THEME_KEY == "da"){ ?>  
$core['color_male'] = "<?php echo _ppt('color_male'); ?>";
$core['color_female'] = "<?php echo _ppt('color_female'); ?>";
<?php } ?>
$core['search_item_style'] = "<?php echo _ppt('search_item_style'); ?>"; 
$core['search_image_style'] = "<?php echo _ppt('search_image_style'); ?>"; 
$core['search_image_bottom'] = "<?php echo _ppt('search_image_bottom'); ?>"; 
$core['page_columns'] = "<?php echo _ppt('page_columns'); ?>"; 
$core['page_layout'] = "<?php echo _ppt('page_layout'); ?>";      
$core['search_item_style'] = "<?php echo _ppt('search_item_style'); ?>";
$core['header_hometransparent'] = "<?php echo _ppt('header_hometransparent'); ?>";
$core['header_topnav'] = "<?php echo _ppt('header_topnav'); ?>"; 
$core['header_topnavstyle'] = "<?php echo _ppt('header_topnavstyle'); ?>"; 
$core['header_topnavhome'] 	= "<?php echo _ppt('header_topnavhome'); ?>";
$core['header_topnavbg'] 	= "<?php echo _ppt('header_topnavbg'); ?>"; 
$core['header_topnavborderbottom'] = "<?php echo _ppt('header_topnavborderbottom'); ?>";
$core['header_style'] = "<?php echo _ppt('header_style'); ?>"; 
$core['header_shadow'] = "<?php echo _ppt('header_shadow'); ?>"; 
$core['header_bg'] 	= "<?php echo _ppt('header_bg'); ?>"; 
$core['header_sep'] = "<?php echo _ppt('header_sep'); ?>";
$core['header_button'] = "<?php echo _ppt('header_button'); ?>";
$core['header_buttontext'] = "<?php echo _ppt('header_buttontext'); ?>";        
$core['headernav_bg'] = "<?php echo _ppt('headernav_bg'); ?>";         
$core['breadcrumbs'] = "<?php echo _ppt('breadcrumbs'); ?>";
$core['breadcrumbs_style'] 	= "<?php echo _ppt('breadcrumbs_style'); ?>";
$core['footer_blockstyle'] = "<?php echo _ppt('footer_blockstyle'); ?>";
$core['footer_bg'] = "<?php echo _ppt('footer_bg'); ?>";</textarea>
 