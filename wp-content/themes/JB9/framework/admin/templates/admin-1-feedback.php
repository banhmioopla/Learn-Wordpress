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

  <div class="card">
<div class="card-header">

<a href="#" rel="tooltip" data-original-title="The feedback system allows members to leave feedback about other members listings." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

<span>
 Feedback 
</span>
</div>
<div class="card-body">

 
 
             
             
 
<div class="row">
    <div class="col-md-3">
    
    	<label>Enable Feedback<span rel="tooltip" data-original-title="If turned ON, this will allows all users to send and receive feedback. If turned OFF, this option will not be available to all users." data-placement="top">
      <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span></label>
        
     	<div>
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('feedback_enable').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('feedback_enable').value='1'">
                                      </label>
                                      <div class="toggle <?php if(_ppt('feedback_enable') == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div> 
                                 
         <input type="hidden" id="feedback_enable" name="admin_values[feedback_enable]" value="<?php echo _ppt('feedback_enable'); ?>">
</div><!-- end col 3 -->
</div><!-- end row -->

</div><!-- end block -->
</div><!-- end card --> 