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

global $CORE, $wpdb;

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
  $wlt_banners = get_option("wlt_banners");
?>

 
<div class="card">
<div class="card-header">

<a href="#" rel="tooltip" data-original-title="Decide where your created banner will feature on your website." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>
<span>
Banner Assignment
</span>
</div>
<div class="card-body1"> 



<?php

$default_banner_array = array(

//"header" => array('name' => 'Header',  'shortcodes' => '(468 x 60)', 'label'=>'label-success'),
//"footer" => array('name' => 'Footer',  'shortcodes' => '(any size)', 'label'=>'label-success'),

//"full_top" => array('name' => 'Full Wrapper Top',  'shortcodes' => '(1000 x any size)', 'label'=>'label-success'),


"search_page_top" => array('name' => 'Search Page Top',  'shortcodes' => '(650 x any size)', 'label'=>'label-success'),
"search_page_bot" => array('name' => 'Search Page Bottom',  'shortcodes' => '(650 x any size)', 'label'=>'label-success'),
 
/*
"n" => array('break' => 'Listing Expiry banners'),
	"reminder_30" => array('name' => '30 day renewal reminder',   'shortcodes' => 'title = (title) \n link = (link) \n excerpt = (post_excerpt) \n date = (post_date) \n expired = (expired)', 'label'=>'label-info'),
	"reminder_15" => array('name' => '15 day renewal reminder',   'shortcodes' => 'title = (title) \n link = (link) \n excerpt = (post_excerpt) \n date = (post_date) \n expired = (expired)', 'label'=>'label-info'),
	"reminder_1" => array('name' => '1 day renewal reminder',   'shortcodes' => 'title = (title) \n link = (link) \n excerpt = (post_excerpt) \n date = (post_date) \n expired = (expired)', 'label'=>'label-info'),
	"expired" => array('name' => 'Listing Expired',   'shortcodes' => 'title = (title) \n link = (link) \n excerpt = (post_excerpt) \n date = (post_date) \n expired = (expired)', 'label'=>'label-info'),
*/

 

);

$default_banner_array = hook_advertising_list_filter($default_banner_array);

?>
<?php if(is_array($default_banner_array)){ ?> 
        <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Action</th>
                <th>Assigned Banner</th>
              </tr>
            </thead>
            <tbody>
            
        
<!------------ FIELD -------------->      
<?php 
 
foreach($default_banner_array as $key1=>$val1){ 

 
if(isset($val1["break"])){ ?>
</tr> </tbody> </table>
<table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th rowspan="2"><?php echo $val1["break"]; ?></th>
              </tr>
            </thead>
            <tbody>
<?php }else{ ?>
<tr><td style="width:300px;">
<span class="label <?php echo $val1['label']; ?>"><?php echo $val1['name']; ?></span>
<br /><small><?php echo $val1['shortcodes']; ?></small> 
</td>
<td>

<select data-placeholder="Choose a an banner..." name="admin_values[banners][<?php echo $key1; ?>][]" multiple="multiple"  class="chzn-select" style="width:300px;">   
    <option value=""> ---- none ---- </option>
	<?php 
	if(is_array($wlt_banners)){ 
		foreach($wlt_banners as $key=>$field){ 
		
			if(isset($core_admin_values['banners']) && 
			is_array($core_admin_values['banners']) && 
			isset($core_admin_values['banners'][$key1]) && 
			is_array($core_admin_values['banners'][$key1]) && 			
			in_array("banner_".$key, $core_admin_values['banners'][$key1]) ){	
			
			$sel = " selected=selected ";	}else{ $sel = ""; }
			
			echo "<option value='banner_".$key."' ".$sel.">".stripslashes($field['subject'])."</option>"; 
		} 
	} 
	?> 
     
</select>  
</td></tr>    
<?php } ?>
<?php } ?>
</div>
<!------------ END FIELD -------------->  
 </tr> </tbody> </table>       
<?php } ?>
 </div><!-- end card block -->
</div><!-- end card -->
 