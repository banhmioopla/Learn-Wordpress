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

<div class="col-lg-6">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">
         <h4><span>Google Maps</span></h4>
      </div>

   
   
<div class="container px-0">
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500">Enable Maps</label>
         <p class="text-muted">Enable maps here for your website</p>
      </div>
      <div class="col-6">
         <div class="mt-3">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('google').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('google').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('google') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
         </div>
         <input type="hidden" id="google" name="admin_values[google]" 
            value="<?php echo _ppt('google'); ?>">
      </div>
   </div>
</div>
<!-- ------------------------- -->
<div class="container px-0">
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500">Google Maps API Key</label>
         <p class="text-muted">This is required by Google to use their Map and location services. <a href="https://console.developers.google.com/apis/dashboard" target="_blank" style="font-weight:bold;">Get your key here.</a></p>
      </div>
      <div class="col-6">
         <input name="admin_values[googlemap_apikey]" id="googlemap_apikey" type="<?php if(defined('WLT_DEMOMODE')){ echo "password"; }else{  echo "text"; } ?>" value="<?php if(_ppt('googlemap_apikey') == ""){ echo ""; }else{ echo trim(stripslashes(_ppt('googlemap_apikey'))); } ?>" class="form-control mt-4" <?php if(isset($_GET['enterkey'])){ ?>style="border:2px solid red;"<?php } ?>>
      </div>
   </div>
</div>
<!-- ------------------------- -->
<div class="container px-0">
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500">Distance Unit</label>
         <p class="text-muted">This is the distance display unit for your website. </p>
      </div>
      <div class="col-6">
         <select name="admin_values[geolocation_unit]" class="mt-4 form-control chzn-select" style="width: 200px;">
            <option value="" <?php if(_ppt('geolocation_unit') == ""){ echo "selected=selected"; } ?>>Miles</option>
            <option value="K" <?php if(_ppt('geolocation_unit') == "K"){ echo "selected=selected"; } ?>>Kilometers</option>
            <option value="N" <?php if(_ppt('geolocation_unit') == "N"){ echo "selected=selected"; } ?>>Nautical Miles</option>
         </select>
      </div>
   </div>
</div>
<!-- ------------------------- -->
<div class="container px-0">
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500">Map Marker Icon</label>
         <p class="text-muted">The display icon for your Google map</p>
      </div>
      <div class="col-6">
         <div class="input-append color input-group">
            <input name="admin_values[googlemap_icon]" id="googlemap_icon" type="text" value="<?php echo stripslashes(_ppt('googlemap_icon')); ?>" class="form-control">
            <span class="add-on" style="margin-right: -30px; cursor:pointer;" id="upload_googlemap_icon"><i class="fa fa-refresh"></i></span>                  
         </div>
         <?php if(strlen(_ppt('googlemap_icon')) > 10){ 
            echo '<img src="'._ppt('googlemap_icon').'" style="max-width:250px; max-height:250px;" /> '; 
            
            }else{
            
            echo '<img src="'.get_template_directory_uri().'/framework/img/map/icon.png" style="max-width:250px; max-height:250px;" /> ';   
            
            } ?>
         <script >
            jQuery('#upload_googlemap_icon').click(function() {
             ChangeImgBlock('googlemap_icon'); 
             formfield = jQuery('#googlemap_icon').attr('name');
             tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
             return false;
            });
             
         </script>   
      </div>
   </div>
</div>
<!-- ------------------------- -->
<?php 
   if(_ppt('google_region') == ""){ $core_admin_values['google_region'] = "us"; } 
   if(_ppt('google_lang') == ""){ $core_admin_values['google_lang'] = "en"; }
   ?>
<div class="container px-0">
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500">Region Code</label>
         <p class="text-muted">This is the Google maps region code, the full list is <a href="http://en.wikipedia.org/wiki/CcTLD" target="_blank" >here</a> </p>
      </div>
      <div class="col-6">
         <input type="text"  name="admin_values[google_region]" value="<?php echo $core_admin_values['google_region']; ?>" class="form-control">            
      </div>
   </div>
</div>
<!-- ------------------------- -->
<div class="container px-0">
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500">Language Code</label>
         <p class="text-muted">This is the Google maps region code, the full list is list found <a href="https://spreadsheets.google.com/pub?key=p9pdwsai2hDMsLkXsoM05KQ&gid=1" target="_blank">here</a> </p>
      </div>
      <div class="col-6">
         <input type="text"  name="admin_values[google_lang]" value="<?php echo $core_admin_values['google_lang']; ?>" class="form-control">         
      </div>
   </div>
</div>
<!-- ------------------------- -->
<div class="container px-0">
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500">Cluster Markers</label>
         <p class="text-muted">This will group icons if multiple exits in a similiar location.</p>
      </div>
      <div class="col-6">
         <div class="mt-4">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('googlemap_cluster').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('googlemap_cluster').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('googlemap_cluster') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
         </div>
         <input type="hidden" id="googlemap_cluster" name="admin_values[googlemap_cluster]" 
            value="<?php echo _ppt('googlemap_cluster'); ?>"> 
      </div>
   </div>
</div>
<!-- ------------------------- -->
<div class="container px-0">
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500">Google Map Color</label>
         <p class="text-muted">This will change the map color.</p>
      </div>
      <div class="col-6">
         <select name="admin_values[display_mapcolor_search]" id="display_mapcolor_search" class="form-control chzn-select" style="width: 200px;">
            <option value="" <?php selected( _ppt('display_mapcolor_search'), "" );  ?>>Default Color</option>
            <option value="grey" <?php selected( _ppt('display_mapcolor_search'), "grey" );  ?>>Grey</option>
            <option value="green" <?php selected( _ppt('display_mapcolor_search'), "green" );  ?>>Green</option>
            <option value="blue" <?php selected( _ppt('display_mapcolor_search'), "blue" );  ?>>Blue</option>
         </select>
      </div>
   </div>
</div>
<?php /*
   <div class="card">
   <div class="card-header">
   
   <a href="#" rel="tooltip" data-original-title="GEO location is where the system will try and get the visitors location so you can provide more accurate data to them." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>
    
   <span>
   GEO Location
   </span>
   </div>
   <div class="card-body"> 
   
       
    
   <div class="row ">
   
       <div class="col-md-4">
       
       <label>Enable GEO Location</label>
       
       <select name="admin_values[geolocation]" id="geo1">
   
             <option value="" <?php if(_ppt('geolocation') == ""){ echo "selected=selected"; } ?>>Disable</option>
<option value="1" <?php if(_ppt('geolocation') == "1"){ echo "selected=selected"; } ?>>Enable in Top Menu</option>
</select>
</div>
<div class="col-md-4">
   <label>Display GEO Flag </label>
   <select name="admin_values[geolocation_flag]" id="geo2">
   <?php
      $selected = _ppt('geolocation_flag');
       
                   foreach ($GLOBALS['core_country_list'] as $key=>$option) {				 				
                   	printf( '<option value="%1$s"%3$s>%2$s</option>', trim( $key  ), $option, selected( $selected, $key, false ) );
                   }
      
      ?> 
   </select>
</div>
</div> 
</div><!-- end card block -->
</div><!-- end card -->
<?php if(defined('GOOGLE-GEO')){ ?>
<?php } ?>
<div class="card">
   <div class="card-header">
      <span>
      Display Settings
      </span>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-md-3">
            <label>Show Map Open</label>
            <div>
               <label class="radio off">
               <input type="radio" name="toggle" 
                  value="off" onchange="document.getElementById('default_gallery_map').value='0'">
               </label>
               <label class="radio on">
               <input type="radio" name="toggle"
                  value="on" onchange="document.getElementById('default_gallery_map').value='1'">
               </label>
               <div class="toggle <?php if(_ppt('default_gallery_map') == '1'){  ?>on<?php } ?>">
                  <div class="yes">ON</div>
                  <div class="switch"></div>
                  <div class="no">OFF</div>
               </div>
            </div>
            <input type="hidden" id="default_gallery_map" name="admin_values[default_gallery_map]" 
               value="<?php echo _ppt('default_gallery_map'); ?>">
         </div>
         <div class="col-md-3">
            <label>Cluster Markers</label>
            <div>
               <label class="radio off">
               <input type="radio" name="toggle" 
                  value="off" onchange="document.getElementById('googlemap_cluster').value='0'">
               </label>
               <label class="radio on">
               <input type="radio" name="toggle"
                  value="on" onchange="document.getElementById('googlemap_cluster').value='1'">
               </label>
               <div class="toggle <?php if(_ppt('googlemap_cluster') == '1'){  ?>on<?php } ?>">
                  <div class="yes">ON</div>
                  <div class="switch"></div>
                  <div class="no">OFF</div>
               </div>
            </div>
            <input type="hidden" id="googlemap_cluster" name="admin_values[googlemap_cluster]" 
               value="<?php echo _ppt('googlemap_cluster'); ?>">
         </div>
         <?php /*
            <div class="col-md-3">
            
               <label>Google Map Position</label>
               
                    <select name="admin_values[display_search_map]" id="display_search_map">      
                      <option value="" <?php selected( _ppt('display_search_map'), "" );  ?>>Top of Page</option>
         <option value="1" <?php selected( _ppt('display_search_map'), "1" );  ?>>Left Sidebar</option>
         <option value="2" <?php selected( _ppt('display_search_map'), "2" );  ?>>Right Sidebar</option>
         <option value="3" <?php selected( _ppt('display_search_map'), "3" );  ?>>Above Search Results</option>
         </select>
      </div>
      <input type="hidden" id="googlemap_cluster" name="admin_values[display_search_map]"  value="">
   </div>
   <!-- end row -->                    
   <div class="clearfix"></div>
   <hr />
   <div class="row">
      <div class="col-md-3">
         <label>Default Map Zoom <br /><small>(0-20)</small> </label>
         <input type="text"  name="admin_values[google_zoom1]" value="<?php echo _ppt('google_zoom1'); ?>" class="form-control">
      </div>
      <div class="col-md-3">
         <label>Default Map Cords <br /><small>numeric values only</small></label>
         <input type="text"  name="admin_values[google_coords1]" value="<?php echo _ppt('google_coords1'); ?>" class="form-control">
         lat,long       
      </div>
   </div>
   <hr />
   <h5 class="mb-2 "> Listing Page Settings </h5>
   <div class="nblock">
      <div class="form-row control-group row-fluid">
         <label class="control-label span6" for="style">Map Color</label>
         <div class="controls span5">
            <select name="admin_values[display_mapcolor_listing]" id="display_mapcolor_listing">
               <option value="" <?php selected( _ppt('display_mapcolor_listing'), "" );  ?>>Default</option>
               <option value="grey" <?php selected( _ppt('display_mapcolor_listing'), "grey" );  ?>>Grey</option>
               <option value="green" <?php selected( _ppt('display_mapcolor_listing'), "green" );  ?>>Green</option>
               <option value="blue" <?php selected( _ppt('display_mapcolor_listing'), "blue" );  ?>>Blue</option>
            </select>
         </div>
      </div>
      <p>Set the color of the map displayed on the listing page.</p>
   </div>
</div>
</div><!-- end card block -->
</div><!-- end card -->
<?php if( defined('GOOGLE-SEARCH') ){ ?>
<?php } ?>
*/ ?>



</div></div>

<div class="col-lg-6">

 


<div class="bg-white p-5 shadow" style="border-radius: 7px;">
   


<div class="tabheader mb-4">
 
         <h4><span>Google Captcha</span></h4>
      </div>
      
      <p>This is to stop bots commenting. If turned OFF there will be no CAPTCHA security code.</p>
      
      

<!-- ------------------------- -->
<div class="container px-0">
   <div class="row py-2">
      <div class="col-8">
         <label class="txt500">Enable Basic Captcha</label>
        
      </div>
      <div class="col-4">
        
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('comment_captcha').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('comment_captcha').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('comment_captcha') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
        
         <input type="hidden" id="comment_captcha" name="admin_values[comment_captcha]" 
            value="<?php echo _ppt('comment_captcha'); ?>">
      </div>
   </div>
</div>

 

<!-- ------------------------- -->
<div class="container px-0">
   <div class="row">
      <div class="col-12">
         <label class="txt500">Google reCAPTCHA (v2)</label>
         <p class="text-muted">This will change the default Captcha display to use Google reCaptcha instead. You need a Google account to use this feature. You can find your keys <a href="https://www.google.com/recaptcha/admin#list" target="_blank">HERE</a> </p>
      </div>
      <div class="col-12">
      <div class="row">
      <div class="col-6">
         
         <label class="txt500">Site Key</label>
        <input type="text" name="admin_values[google_recap_sitekey]" class="form-control" value="<?php echo stripslashes(_ppt('google_recap_sitekey')); ?>">
     </div>
     <div class="col-6">
        <label  class="txt500">Secret Key</label>
        <input type="text" name="admin_values[google_recap_secretkey]" class="form-control" value="<?php echo stripslashes(_ppt('google_recap_secretkey')); ?>">
     </div>
     </div>
        </div>
      </div>
   </div>
</div>


















   <div class="bg-white p-5 mt-5 shadow" style="border-radius: 7px;">
   

 <div class="tabheader">
         <h4><span>Google Analytis</span></h4>
      </div>
    
<div class="container mt-4">
<div class="row">

    <div class="col-4">
    
    <label class="txt500">Enable</label>
    
    	<div class="mt-4">
        <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('google_tracking').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('google_tracking').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('google_tracking') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
       </div>
                            
                             
                             <input type="hidden" class="row-fluid" id="google_tracking" name="admin_values[google_tracking]" value="<?php echo _ppt('google_tracking'); ?>">
            
    
  </div>
    
    <div class="col-8">
    
                  <label class="txt500">Google Tracking ID</label><br />
                          

                        
                  <input type="text" class="form-control my-3" name="admin_values[google_trackingcode]" value="<?php echo stripslashes(_ppt('google_trackingcode')); ?>" placeholder="UA-XXXXXX-XX">
		 
  
<p>Your Google Tracking code can be found under the Admin -> Tracking Info -> Tracking Code section of your Google Analytics account.

<a href="https://www.google.com/analytics/" target="_blank" style="text-decoration:underline;">Visit Here</a>

</div>
</div>


</div>
</div>



 


</div>


</div>

<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 