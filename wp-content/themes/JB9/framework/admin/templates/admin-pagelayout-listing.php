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
 
 
 
 
 
 
 
 <h4 class="ntitle">Page Display Options</h4> 
   
<div class="nblock">
 
          <div class="form-row control-group row-fluid">
                            <label class="control-label span6">Require Login To View
                            
             <span rel="tooltip" data-original-title="Turn ON to force visitors to login/register before they can view the listing page." data-placement="top">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span>
                            
                            </label>
                            <div class="controls span5">

                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('requirelogin').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('requirelogin').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['requirelogin'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" id="requirelogin" name="admin_values[requirelogin]" 
                             value="<?php echo $core_admin_values['requirelogin']; ?>">
            </div>
            
 
 
          <div class="form-row control-group row-fluid">
                            <label class="control-label span6">Auto Start Media (Video/Music)
                            
                              <span rel="tooltip" data-original-title="Turn ON to auto start video/music files on the listing page." data-placement="top">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span>
                                   
                            </label>
                            <div class="controls span5">

                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('media_autostart').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('media_autostart').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['media_autostart'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" id="media_autostart" name="admin_values[media_autostart]" 
                             value="<?php if(!isset($core_admin_values['media_autostart'])){ echo 1; }else{ echo $core_admin_values['media_autostart']; } ?>">
            </div>
 
            
</div>           
       
     
        
        
    <?php if(defined('WLT_DIRECTORY') || defined('WLT_BUSINESS') ){ ?>
         
  
               <div class="form-row control-group row-fluid">
                            <label class="control-label span6" rel="tooltip" data-original-title="Turn ON to display a claim listing button on all admin created listings." data-placement="top">Allow Claim Listings</label>
                            <div class="controls span4">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('visitor_claimme').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('visitor_claimme').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['visitor_claimme'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" id="visitor_claimme" name="admin_values[visitor_claimme]" 
                             value="<?php echo $core_admin_values['visitor_claimme']; ?>">
            </div>     
 
 
 
 <?php }else{ ?>
 <input type="hidden" id="visitor_claimme" name="admin_values[visitor_claimme]"  value="0">
 <?php } ?>
 
 


<input type="hidden" name="admin_values[customlisting_enable]" value="0">
<input type="hidden" name="admin_values[listingcode]" value=""> 
 
 <?php /*
 
<div class="nblock">

<h4 class="ntitle">Customized Display Code

   <span rel="tooltip" data-original-title="Here you can use your own combination of shortcodes and HTML to create your listing layout." data-placement="top">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span>
</h4>



          <div class="form-row control-group row-fluid">
                            <label > Enable Custom Display</label>
                            <div class="controls span5">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('customlisting_enable').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('customlisting_enable').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['customlisting_enable'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" id="customlisting_enable" name="admin_values[customlisting_enable]" 
                             value="<?php echo $core_admin_values['customlisting_enable']; ?>">
            </div>  
 
 <textarea class="row-fluid" id="listingcode" style="height:300px;background:#E8FDE9" name="admin_values[listingcode]"><?php echo stripslashes($core_admin_values['listingcode']); ?></textarea>
        


<a href="javascript:void(0);" class="btn btn-info" onclick="jQuery('#spbuts4').show();">Show Shortcodes</a>

</div>

       
          <input type="hidden" name="customlistingpage" id="customlistingpage" value="" />
          <?php if($core_admin_values['single_layout'] != "" && $core_admin_values['single_layout'] != "listing"){ ?>
        <a href="javascript:void(0);" onclick="document.getElementById('customlistingpage').value='content-single-<?php echo $core_admin_values['single_layout']; ?>';document.admin_save_form.submit();" class="btn btn-default" style="float:right; margin-top:-5px;">
       Get Codes from Default Layout
        </a> 
        <?php } ?>
      
     
           
           
<div style="display:none;" id="spbuts4">
<hr />
<a href="javascript:void(0);" onclick="jQuery('#spbuts4').hide();" class="label">Hide Shortcodes</a>
 <div class='well'>
			   <?php $btnArray = array(
               'ID' =>'post ID',
               'IMAGE' =>'display image',	
			   'IMAGES' =>'display image gallery', 
			   'TAB_IMAGES' =>'display image gallery within a tab', 
			   'FILES' =>'all media files', 
               'TITLE' =>'title with link to listing page',
               'TITLE-NOLINK' =>'title without link',
               'EXCERPT' =>'short',
               'BUTTON' =>'more info button',
               'DATE' =>' listing creation date',
               'AUTHOR' =>'author',
               'CATEGORY' =>'category',
               'LISTINGSTATUS' =>'listing status',
               'LOCATION' =>'listing location',
               'AUTHORIMAGE' =>'author image',
               'AUTHORIMAGE-CIRCLE' =>'author image with circular background',
               'TIMESINCE' =>'',
               'RATING' =>'star rating',
			   
			   'SOCIAL' =>'social buttons',
			   'GOOGLEMAP' =>'Google Map',
			   'RATING' =>'Star Rating',
			   'FAVS' =>'Add/Remove from favourites',
			   'FIELDS' =>'custom fields',
			   'TOOLBOX' =>'small box with a few items',
			   'TOOLBAR' =>'bar with category and tags',
			   'RELATED' =>'related items',
			   'CONTACT' =>'contact form',
			   'COMMENTS' =>'comments form',						     
				   
               ); 
			   
			 
			   
               foreach( $btnArray as $k => $b){
                echo "<a href='javascript:void(0);' onclick=\"AddthisShortC('".$k."','listingcode');\" class='btn' style='margin-right:10px; margin-bottom:5px;' rel='tooltip' data-original-title='".$b."' data-placement='bottom'>".$k."</a>";
               }
               
               ?>
</div>
</div>

*/ ?>
