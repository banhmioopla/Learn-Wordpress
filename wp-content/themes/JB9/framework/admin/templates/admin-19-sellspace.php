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

$bannersizes = array(

"262x220" => array("name" => "Theme Sidebar Standard"),

"370x300" => array("name" => "Theme Sidebar Standard"),


"468x60" => array("name" => "Full banner"),
"234x60" => array("name" => "Half banner"),


"336x280" => array("name" => "Large rectangle"),
"180x150" => array("name" => "Rectangle"),
"300x100" => array("name" => "3:1 rectangle"),


"728x90" => array("name" => "Leaderboard"),

"720x300" => array("name" => "Pop-under"),
"120x240" => array("name" => "Vertical banner"),
"300x250" => array("name" => "Medium rectangle"),
"120x90" => array("name" => "Button 1"),
"120x60" => array("name" => "Button 2"),
"240x400" => array("name" => "Vertical rectangle"),
"250x250" => array("name" => "Square pop-up "),
"300x600" => array("name" => "Half-page ad"),
"160x600" => array("name" => "Wide skyscraper"),
"120x600" => array("name" => "Skyscraper"),

"125x125" => array("name" => "Square button"),

"350x350" => array("name" => "Large Square"),

);

if(THEME_KEY == "cp"){

unset($bannersizes['262x220']);
}else{

unset($bannersizes['370x300']);
}
 
?>




   
<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">



 <?php
$i=1;
$sellspacedata = _ppt('sellspace');			 
foreach($CORE->SELLSPACE(1) as $key => $ban){ ?>

<div <?php if(_ppt('sellspace_enable') != '1'){  ?>style="display:none;"<?php } ?>>
<div class="tabheader">
<h4><span><?php echo $ban['n']; ?> </span></h4> 
</div>

<div class="container py-2 bg-light  mb-4">
   <div class="row pt-3" style="border-top:0px;">

      
      <div class="col-3 pl-0">
       
         <div class="small text-muted">
         <input type="hidden" name="admin_values[sellspace][<?php echo $key; ?>]" value="0" />
         <input type="checkbox" name="admin_values[sellspace][<?php echo $key; ?>]" value="1" class="ml-3" <?php if( isset($sellspacedata[$key]) && $sellspacedata[$key] == 1){ ?>checked=checked<?php } ?> /> Enable Banner
         </div>
                                
        <div class="small text-muted mt-2">
         <input type="hidden" name="admin_values[sellspace][<?php echo $key; ?>_sample]" value="0" />
         <input type="checkbox" name="admin_values[sellspace][<?php echo $key; ?>_sample]" value="1" class="ml-3" <?php if( isset($sellspacedata[$key."_sample"]) && $sellspacedata[$key."_sample"] == 1){ ?>checked=checked<?php } ?> /> Show Sample
         </div>                                

                                
      </div>
      
      <div class="col-3">
      
      <ul class="small text-muted p-0" style="line-height: 20px; font-size: 14px;">
      <li><i class="fa fa-angle-right"></i> <em id="<?php echo $key; ?>pricebox"></em> per ad </li>
      <li><i class="fa fa-angle-right"></i> size: <em id="<?php echo $key; ?>sizebox"></em></li>
      </ul>
      
      </div>
      <div class="col-3">

<?php if(in_array($key, array('blog','search','listing','page'))){ ?>          
          <div class="small text-muted ">  
          
          <div>              
       <input type="radio" name="admin_values[sellspace][<?php echo $key; ?>_where]" value="top" <?php if( !isset($sellspacedata[$key."_where"]) || isset($sellspacedata[$key."_where"]) && $sellspacedata[$key."_where"] == "top" ){ ?>checked=checked<?php } ?> /> Top of sidebar 
       </div>
       <div class="mt-2">
        <input type="radio" name="admin_values[sellspace][<?php echo $key; ?>_where]" value="bottom" <?php if( isset($sellspacedata[$key."_where"]) && $sellspacedata[$key."_where"] == "bottom" ){ ?>checked=checked<?php } ?> /> Bottom of sidebar 
        </div>
             </div>            
         <?php }else{ ?>
          <input type="hidden" name="admin_values[sellspace][<?php echo $key; ?>_where]" value="top" />
        
         
         <?php } ?>
      </div>
      
       <div class="col-3 text-right">
         <a href="javascript:void(0);" onclick="jQuery('#bannerspace-<?php echo $i; ?>').toggle();" class="btn btn-dark rounded-0"><i class="fa fa-pencil"></i></a>
        
      </div>
      
   </div>
</div>

<?php if(isset($sellspacedata[$key]) && $sellspacedata[$key] == 1){  ?>
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th>Campaign</th>
    
    <th>User</th>
    <th>Views</th>               
    <th>Clicks</th> 
    <th>Time Left</th>
    <th style="text-align:center; width:100px;">Actions</th>
</tr>
         </thead>
         <tbody>
   

<?php

// args
$args = array(
	'posts_per_page' => 200, 
	'post_type' => 'wlt_campaign', 
	'orderby' => 'post_date', 
	'order' => 'desc',
	'meta_query' => array(
		array(
			'key'     => 'campaign',
			'value'   => $key,
			'compare' => '=',
		),
	),
);

$campaigns = new WP_Query( $args );
 
if(!empty($campaigns->posts)){  

foreach($campaigns->posts as $order){ 
 
	// BITS
	$bits = explode("-",$order->post_title); 
	 
	// TIME LEFT
	$timeleft = get_post_meta($order->ID, 'listing_expiry_date',true);
	
	// GET ACTIVE BANNER ID
	$activebannerID = get_post_meta($order->ID, 'bannerid', true);
									 
	//campaign name								 
	$campaignID = $order->ID;
	
	// USER
	$author_obj = get_user_by('id', $order->post_author);
?>


<tr style="font-size:14px; color:#333333;">
    <td>#<?php echo $campaignID; ?></td>
   
    <td><a href="users.php?id=<?php echo $order->post_author; ?>" target="_blank"><?php echo $author_obj->user_login; ?></a></td>
    <td><?php echo get_post_meta($order->ID, 'impressions', true); ?></td>               
    <td><?php echo get_post_meta($order->ID, 'clicks', true); ?></td> 
    <td> 
    <?php if($activebannerID != "" && $activebannerID != 0 ){?>
    <?php if($timeleft != ""){ echo do_shortcode('[TIMELEFT key="listing_expiry_date" postid="'.$order->ID.'"]'); } ?>
    <?php }else{ ?>
    <?php echo __("Pending","premiumpress"); ?>
    <?php } ?>
    </td> 
 <td style="text-align:center; width:100px;"> 
 
 <a href="post.php?post=<?php echo $campaignID; ?>&action=edit" target="_blank" class="btn btn-sm btn-dark rounded-0"><i class="fa fa-search"></i></a>
 <?php if(is_numeric($activebannerID) && $activebannerID > 0){ ?>
 <a href="post.php?post=<?php echo $activebannerID; ?>&action=edit" target="_blank" class="btn btn-sm btn-dark rounded-0"><i class="fa fa-pencil"></i></a>
 <?php } ?>
 </td>
 
</tr>

<?php } } ?>
 


</tbody>
</table>
<?php } ?>






<div id="bannerspace-<?php echo $i; ?>" style="display:none;">

<div class="shadow-sm border mb-5 p-5">


      <label class="mt-4 txt500">Display Title</label>
      
      <input type="text" name="admin_values[sellspace][<?php echo $key; ?>_name]" 
         
         value="<?php if(isset($sellspacedata[$key."_name"]) && $sellspacedata[$key."_name"] != ""){ echo $sellspacedata[$key."_name"]; }else{ echo $ban['n']; } ?>"
         
          class="form-control" />
          
          
     <label class="mt-4 txt500">Banner Size</label>
     
    <select name="admin_values[sellspace][<?php echo $key; ?>_size]" class="form-control mt-2">
    
    <option value="<?php echo $ban['sw']."x".$ban['sh']; ?>">Default: (<?php echo $ban['sw']."x".$ban['sh']; ?>)</option>
    
    <?php foreach($bannersizes as $bk => $size){ ?>
    <option value="<?php echo $bk; ?>" <?php if(isset($sellspacedata[$key."_size"]) && $sellspacedata[$key."_size"] == $bk ){ echo "selected=selected"; } ?>><?php echo $size['name']; ?> (<?php echo $bk; ?>)</option>
    <?php } ?>
    
    
    </select>
    
    
    <div class="btn-block mt-3"><p class="text-muted">The recommended size for this location is: <strong><?php echo $ban['sw']; ?> x <?php echo $ban['sh']; ?> px.</strong> </p></div>
          
          
          
      <label class="mt-2 txt500">Description</label>
      
      <textarea name="admin_values[sellspace][<?php echo $key; ?>_desc]" class="form-control" style="height:200px !important;" /><?php if(isset($sellspacedata[$key."_desc"]) && $sellspacedata[$key."_desc"] != ""){ echo $sellspacedata[$key."_desc"]; } ?></textarea>
     
        

<script>
jQuery(document).ready(function() {
<?php if(isset($sellspacedata[$key."_price"])){ ?>
jQuery('#<?php echo $key; ?>pricebox').html('<?php echo hook_price($sellspacedata[$key."_price"]); ?>');
jQuery('#<?php echo $key; ?>sizebox').html('<?php echo $sellspacedata[$key."_size"]; ?>');
<?php } ?>

});
</script>

<div class="container mt-4 px-0 mb-5">
<div class="row">

<div class="col-4">
<label class="txt500">Price per Ad</label>      

<div class="input-group">
                  <span class="input-group-prepend input-group-text"><?php echo hook_currency_symbol(''); ?></span>
<input type="text" name="admin_values[sellspace][<?php echo $key; ?>_price]" 
         
         value="<?php if(isset($sellspacedata[$key."_price"]) && $sellspacedata[$key."_price"] != ""){ echo $sellspacedata[$key."_price"]; }else{ echo 30; } ?>" class="form-control"/>
               </div>
        
</div>

<div class="col-4">

<label class="txt500">Space</label>

         <input type="text" name="admin_values[sellspace][<?php echo $key; ?>_max]" 
         
         value="<?php if(isset($sellspacedata[$key."_max"]) && $sellspacedata[$key."_max"] != ""){ echo $sellspacedata[$key."_max"]; }else{ echo 1; } ?>"
         
         class="form-control" />

</div>

<div class="col-4">

<label class="txt500">Days</label><br />
             
             <input type="text" name="admin_values[sellspace][<?php echo $key; ?>_days]" 
         
         value="<?php if(isset($sellspacedata[$key."_days"]) && $sellspacedata[$key."_days"] != ""){ echo $sellspacedata[$key."_days"]; }else{ echo 30; } ?>"
         
          class="form-control"/>

</div>

</div>
</div>
</div>
</div>





</div>
<?php $i++; } ?>  


<div class="tabheader mb-4">
 
         <h4><span>Global Header Banner</span></h4>
      </div>      
  
        <p class="text-muted">The code you enter here will display on the right side of the normal page header.</p> 
        
        <textarea style="height:200px !important; width:100%;" class="form-control" name="admin_values[advertising1]"><?php echo stripslashes(_ppt('advertising1')); ?></textarea>        
        
 
 

<?php if(strlen(stripslashes(_ppt('advertising1'))) > 2){ ?>

<div class="py-3 px-3 bg-light text-center my-3">

<?php echo stripslashes(str_replace("form","",_ppt('advertising1'))); ?>

</div>

<?php } ?>


 
    
<div class="tabheader my-4">
 
         <h4><span>Global Footer Banner</span></h4>
      </div>
    
    
        
        <p class="text-muted">The code here will be displayed at the bottom of your website.</p> 
        
        <textarea style="height:200px !important; width:100%;" class="form-control" name="admin_values[advertising2]"><?php echo stripslashes(_ppt('advertising2')); ?></textarea>        
        
   
 
 
<?php if(strlen(stripslashes(_ppt('advertising2'))) > 2){ ?>

<div class="py-3 px-3 bg-light text-center my-3">

<?php echo stripslashes(str_replace("form","",_ppt('advertising2'))); ?>

</div>

<?php } ?>   

 
 
 
</div></div>

<div class="col-lg-4">



<div class="container bg-light py-3 mb-4 p-4">
   <div class="row">

      <div class="col-4">
         <div class="">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('sellspace_enable').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('sellspace_enable').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('sellspace_enable') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
         </div>
         <input type="hidden" id="sellspace_enable" name="admin_values[sellspace_enable]" value="<?php echo _ppt('sellspace_enable'); ?>">
      </div>
      
      <div class="col-8 text-left">
         <h4 class="txt500">Enable Sellspace</h4>

      </div>
      
      <div class="col-12">
      
       <div class="text-muted py-3">Turn on/off to allow members to purchase advertising from you.</div>
      
      </div>
      
      
   </div>
   
    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 
     
</div>
 
 
 
 
 
 




 
 
 
 
 
<?php foreach($bannersizes as $bk => $size){ ?>
<div class="container bg-light py-3 mb-3 p-3">
<div class="row">
<div class="col-6">
<?php echo $size['name']; ?> <small>(<?php echo $bk; ?>)</small>
</div>

<div class="col-6">
<a href="javascript:void(0);" class="btn btn-sm btn-block btn-secondary rounded-0" onclick="jQuery('#<?php echo $bk; ?>_showsamplebanner').toggle();">Sample Banner</a>
 
</div>

</div> 

<div id="<?php echo $bk; ?>_showsamplebanner" style="display:none;">
 <div class="mt-4">
    <input type="hidden" 
               id="up_samplebanner_<?php echo $bk; ?>_aid" 
               name="admin_values[samplebanner_<?php echo $bk; ?>_aid]" 
               value="<?php if(isset($core_admin_values['samplebanner_'.$bk.'_aid'])){  echo stripslashes($core_admin_values['samplebanner_'.$bk.'_aid']); } ?>"  />                
            <input 
               name="admin_values[samplebanner_<?php echo $bk; ?>]" 
               type="hidden" 
               id="up_samplebanner_<?php echo $bk; ?>" 
               value="<?php if(isset($core_admin_values['samplebanner_'.$bk]) && $core_admin_values['samplebanner_'.$bk] != ""){  echo stripslashes($core_admin_values['samplebanner_'.$bk]); } ?>" />
            <?php if(isset($core_admin_values['samplebanner_'.$bk]) && substr($core_admin_values['samplebanner_'.$bk],0,4) == "http"){ ?>
            <div class="pptselectbox bg-light p-5 text-center  mb-2 border">
               <img src="<?php echo $core_admin_values['samplebanner_'.$bk]; ?>" style="max-width:100%; max-height:300px;" id="samplebanner_<?php echo $bk; ?>_preview" />   
            </div>
            <div class="pptselectbtns">
               <a href="<?php if(isset($core_admin_values['samplebanner_'.$bk])){ echo $core_admin_values['samplebanner_'.$bk]; } ?>" target="_blank" class="btn btn-secondary btn-sm rounded-0" style="font-size: 10px;">View </a>
               <a href="javascript:void(0);"id="editImg_samplebanner_<?php echo $bk; ?>" class="btn btn-secondary btn-sm rounded-0" style="font-size: 10px;">Edit </a>
               <a href="javascript:void(0);" id="upload_samplebanner_<?php echo $bk; ?>" class="btn btn-secondary btn-sm rounded-0" style="font-size: 10px;">Change </a>
               <a href="javascript:void(0);" onclick="jQuery('#up_samplebanner_<?php echo $bk; ?>').val('');document.admin_save_form.submit();" class="btn btn-secondary btn-sm rounded-0" style="font-size: 10px;">Delete</a>
            </div>
            <?php }else{ ?>
            <div class="pptselectbox bg-dark p-5 text-center  mb-2">
               <a href="javascript:void(0);" id="upload_samplebanner_<?php echo $bk; ?>" class="button">
                  <div>select image</div>
                  <div class=" text-white">.jpeg/ .png</div>
               </a>
            </div>
            <?php } ?>
            <script >
               jQuery(document).ready(function () {
               
               	jQuery('#editImg_samplebanner_<?php echo $bk; ?>').click(function() {           
               			   	 
               		tb_show('', 'media.php?attachment_id=<?php echo _ppt('samplebanner_'.$bk.'_aid'); ?>&action=edit&amp;TB_iframe=true');
               					 
               		return false;
               	});
               	
               	jQuery('#upload_samplebanner_<?php echo $bk; ?>').click(function() {           
               	
               		ChangeAIDBlock('up_samplebanner_<?php echo $bk; ?>_aid');
               		ChangeImgBlock('up_samplebanner_<?php echo $bk; ?>');		
               		ChangeImgPreviewBlock('samplebanner_<?php echo $bk; ?>_preview')
               		
               		formfield = jQuery('#up_samplebanner_<?php echo $bk; ?>').attr('name');
               	 
               		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
               			return false;
               	});
               					
               });	
            </script>
</div></div>
</div>        
<?php } ?> 
            
  


</div>
</div>