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


   
  
?>



<input type="hidden"  name="admin_values[rating_type]" value="1" />


<div class="card">
<div class="card-header">
<a href="#" rel="tooltip" data-original-title="This gives users the opportunity to rate the products from 0-5 stars." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

<a href="admin.php?page=1&delrating=1" class="btn btn-primary btn-sm float-right">Delete All Rating Data</a>

<span>
Star Ratings
</span>
</div>
<div class="card-body">
 

<div class="row">

    <div class="col-md-3">
    
    	<label>Enable Star Rating<span rel="tooltip" data-original-title="If turned ON, users will be able to rate your products and services from 0-5 starts. If turned OFF the star ratings will not be available to users." data-placement="top">
      <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span></label>
        
 		<div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('starrating').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('starrating').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('starrating') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="starrating" name="admin_values[starrating]" 
                             value="<?php echo _ppt('starrating'); ?>">
 

</div>


<div class="col-md-3">


<label>Show in Search<span rel="tooltip" data-original-title="If turned ON, the star rating will show in the advanced search widget. If turned OFF, it will not show in the advanced search widget." data-placement="top">
      <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span></label>

  <div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('rating_as').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('rating_as').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('rating_as') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                             <input type="hidden" id="rating_as" name="admin_values[rating_as]" 
                             value="<?php echo _ppt('rating_as'); ?>">

</div> 

</div>


</div><!-- end block -->
</div><!-- end card --> 
 

 
<div class="clearfix"></div>
 
 

