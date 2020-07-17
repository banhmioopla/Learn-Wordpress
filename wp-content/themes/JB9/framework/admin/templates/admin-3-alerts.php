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

global $CORE;

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
  
?>


<div class="pptinfo">
 

</div>

 
<div class="card">
<div class="card-header">
<a href="#" rel="tooltip" data-original-title="Email alerts are emails or SMS messages sent to the website admins when a user event happens, such as a new user joining your website." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>
<span>
Email Alerts
</span>
</div>
<div class="card-body1"> 



 
         <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
            <thead>
            <tr>
              <th class="no_sort">Event Description</th>
                            
              <th class="no_sort" style="width:110px;text-align:center;">Send Alert</th>
              
            </thead>
            <tbody>
            
        <?php foreach($CORE->wlt_emails_alerts as $key=>$field){ ?>
		<tr>
         <td><?php echo stripslashes($field['n']); ?></td>         
        
         <td class="ms ">
                          <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('<?php echo $key; ?>').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('<?php echo $key; ?>').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt($key) == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" id="<?php echo $key; ?>" name="admin_values[<?php echo $key; ?>]" 
                             value="<?php echo _ppt($key); ?>">
            </td>
            </tr>
            <?php  }   ?> 
 
            </tbody>
            </table>
            
</div><!-- end card block -->
</div><!-- end card -->


 



<div class="card">
<div class="card-header">
<a href="#" rel="tooltip" data-original-title="Fill the information out about where to receive your alerts." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>
<span>
Alert Settings
</span>
</div>
<div class="card-body"> 

<div class="row">

    <div class="col-md-6">
    
<label>Send alerts via email<span rel="tooltip" data-original-title="If turned ON, admin will receive alerts via email. If turned OFF admin will not receive any alerts." data-placement="top">
      <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span>;</label>
 
 
                                <div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('wlt_email_alert_sendemail').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('wlt_email_alert_sendemail').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('wlt_email_alert_sendemail') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                          
                           
                             
                             <input type="hidden" id="wlt_email_alert_sendemail" name="admin_values[wlt_email_alert_sendemail]" 
                             value="<?php echo _ppt('wlt_email_alert_sendemail'); ?>">
    
    </div>
    
    <div class="col-md-6">
    
     <label>My email address: </label>
     
      <input type="text"  name="admin_values[wlt_email_alert_email]" class="row-fluid"  value="<?php if(_ppt('wlt_email_alert_email') == ""){ echo get_option('admin_email'); }else{ echo _ppt('wlt_email_alert_email'); } ?>">     
    </div>

</div>


</div><!-- end card block -->
</div><!-- end card -->
          
  
 
            
