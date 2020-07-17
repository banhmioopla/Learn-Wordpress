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

// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $THEME_SHORTCODES, $CORE_ADMIN, $ADSEARCH;

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

?>


<div class="card">

<div class="card-header">
<a href="#" rel="tooltip" data-original-title="Here you can decide what is seen on the results page." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>
<span>
Search Settings
</span>
</div>
<div class="card-body"> 


  
 
<div class="row ">

<div class="col-md-3">

       <label>Results Per Page<span rel="tooltip" data-original-title="This is how many results are show on each page after the search has been made." data-placement="top">
      <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span></label>       
        <div class="input-group">        
        <input type="text"  name="adminArray[posts_per_page]" class="form-control" value="<?php echo get_option('posts_per_page'); ?>">
        <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>        
        </div>      

</div>

<div class="col-md-3">

 <div class="form-row control-group row-fluid">
                            <label> Show Advanved Search</label>
                            <div class="controls span5">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('advancedsearch').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('advancedsearch').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('advancedsearch') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" id="advancedsearch" name="admin_values[advancedsearch]" 
                             value="<?php echo _ppt('advancedsearch'); ?>">
            </div> 

</div>

</div>

</div>

</div>
 
 
  