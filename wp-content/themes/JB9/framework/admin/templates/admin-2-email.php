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
 
         <h4><span>Email Settings</span></h4>
      </div>



<div class="container px-0">
<div class="row py-2">

    <div class="col-4">
    
        <label class="txt500">Company Email</label>
        
       
    </div>
    
    <div class="col-8">
    
    <input type="text"  name="adminArray[admin_email]" class="form-control"  value="<?php echo get_option('admin_email'); ?>">  
 
    
	</div>
    
</div>
</div>     

 <p class="text-muted">This is the email address that will show up on emails sent from this website. </p>
         
           
<!-- ------------------------- -->
 
<div class="container px-0">
<div class="row py-2">

    <div class="col-4">
    
        <label class="txt500">From Name</label>
        
         
    </div>
    
    <div class="col-8">
    
    
 <input type="text"  name="adminArray[emailfrom]" class="form-control"  value="<?php echo get_option('emailfrom'); ?>"> 
    
	</div>
    
</div>
</div>   
<p class="text-muted">The name that appears on emails sent from this website.</p>
       
 


 
<div class="row py-2">
<div class="col-md-12">
<label class="txt500">Email Header (applied to all emails)</label> 
<?php echo wp_editor( stripslashes(get_option('ppt_email_header')), 'ppt_email_header1', array( 'textarea_name' => 'adminArray[ppt_email_header]', 'editor_height' => '200px') );  ?>     
</div>
</div><!-- end row -->

<div class="row py-2">
<hr />
<div class="col-md-12">
<label class="txt500">Email Footer (applied to all emails)</label> 
<?php echo wp_editor( stripslashes(get_option('ppt_email_footer')), 'ppt_email_footer', array( 'textarea_name' => 'adminArray[ppt_email_footer]', 'editor_height' => '200px') );  ?>     
</div>
</div><!-- end row -->




<div class="row py-2 mt-4">

    <div class="col-md-6">
    
    <label  rel="tooltip" data-original-title="Turn off if you dont want WordPress to add paragraphs to your emails." data-placement="top" class="txt500">Disable Auto-Paragraphs</label>
     <div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('wordpress_autopdisable').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('wordpress_autopdisable').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('wordpress_autopdisable') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                           
                             
                             <input type="hidden" id="wordpress_autopdisable" name="admin_values[wordpress_autopdisable]" 
                             value="<?php echo _ppt('wordpress_autopdisable'); ?>">
    </div>
    
    <div class="col-md-6">
    
    <label   rel="tooltip" data-original-title="Turn off if you dont want WordPress to send new users a welcome email." data-placement="top" class="txt500">Send Registration Email</label>
         <div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('wordpress_welcomeemail').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('wordpress_welcomeemail').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('wordpress_welcomeemail') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                              
                             
                             <input type="hidden" id="wordpress_welcomeemail" name="admin_values[wordpress_welcomeemail]" 
                             value="<?php echo _ppt('wordpress_welcomeemail'); ?>">
    </div>

</div>


   
    


</div></div>

<div class="col-lg-6">

 


<div class="bg-white p-5 shadow" style="border-radius: 7px;">
   

 

<div class="tabheader mb-4">
 
         <h4><span>SMS Settings</span></h4>
      </div>

 <p>We have integrated the NEXMO SMS API which allows you to send SMS alerts to user mobile phones. You will need an account with credit to use this feature.</p>

<p>More info: <a href="https://www.nexmo.com/" target="_blank">https://www.nexmo.com/</a> Area Code:  <a href="https://en.wikipedia.org/wiki/List_of_mobile_phone_number_series_by_country" target="_blank" style="text-decoration:underline; color:blue;">full list here</a> </p>



<div class="container px-0">
<div class="row">

    <div class="col-md-8 py-2"> 
     <label class="txt500">Enable SMS Feature</label>     
    <p class="mb-4 text-muted">Turn on/off this feature here.</p>    
    </div>
    <div class="col-md-4 py-2">        
                                <div >
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('wlt_email_alert_sendsms').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('wlt_email_alert_sendsms').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('wlt_email_alert_sendsms') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                
                           
                             
                             <input type="hidden" id="wlt_email_alert_sendsms" name="admin_values[wlt_email_alert_sendsms]" 
                             value="<?php echo _ppt('wlt_email_alert_sendsms'); ?>">        
    </div>

</div>
</div> 


<div class="container px-0">
<div class="row">

    <div class="col-md-8 py-2"> 
     <label class="txt500">NEXMO API Key</label>     
    <p class="mb-4 text-muted">This can be found in your Nexmo account here.</p>    
    </div>
    <div class="col-md-4 py-2">        
   <input type="text" name="admin_values[wlt_nexmo_api]" class="form-control"  value="<?php echo _ppt('wlt_nexmo_api'); ?>">             
    </div>

</div>
</div> 


<div class="container px-0">
<div class="row">

    <div class="col-md-8 py-2">  
     <label class="txt500">NEXMO API Secret Key</label>     
    <p class="mb-4 text-muted">This can be found in your Nexmo account here.</p>   
    </div>
    <div class="col-md-4 py-2">         
   <input name="admin_values[wlt_nexmo_se]" class="form-control" type="password"  value="<?php echo _ppt('wlt_nexmo_se'); ?>">           
    </div>

</div>
</div> 


<div class="container px-0">
<div class="row">

    <div class="col-md-8 py-2"> 
     <label class="txt500">SMS From Name</label>     
    <p class="mb-4 text-muted">This will appear as the name of the person who sent the SMS. <b>Note</b> Must NOT contain spaces, less than 10 characters.</p>
    
    </div>
    <div class="col-md-4 py-2">        
   <input type="text" name="admin_values[wlt_nexmo_from]" class="form-control" onchange="jQuery(this).val(jQuery(this).val().replace(/ +?/g, ''));" maxlength="10"  value="<?php if(_ppt('wlt_nexmo_from') == ""){ echo "MYWEBSITE"; }else{ echo _ppt('wlt_nexmo_from'); } ?>">           
    </div>

</div>
</div> 


 
<div class="container px-0">
<div class="row">

    <div class="col-md-8 py-2"> 
     <label class="txt500">Admin Copy</label>     
    <p class="mb-4 text-muted">This will send a copy of all SMS messages to the admin SMS numbers you set below.</p>    
    </div>
    <div class="col-md-4 py-2">        
    <div >
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('wlt_nexmo_admincopy').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('wlt_nexmo_admincopy').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('wlt_nexmo_admincopy') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                
                           
                             
                             <input type="hidden" id="wlt_nexmo_admincopy" name="admin_values[wlt_nexmo_admincopy]" 
                             value="<?php echo _ppt('wlt_nexmo_admincopy'); ?>">     
    </div>

</div>
</div> 




 
        
 
        

<div class="container px-0">
<div class="row">

 
            
            <div class="col-md-4">
            
            </div>
            
       <div class="col-md-4">
            Country Prefix
            </div>
            
       <div class="col-md-4">
            Mobile Number
            </div>


</div><!-- end card block -->
</div><!-- end card -->

<?php $i=1; while($i < 6){ ?>
   
<div class="container px-0">
<div class="row">
            
            <div class="col-md-4">
              <label class="txt500">Admin Mobile (<?php echo $i; ?>) </label>
            </div>
            
            <div class="col-md-2">
            <div class="input-group">            
            <span class="input-group-prepend">+</span>            
			<input type="text"  name="admin_values[wlt_nexmo_prefix_<?php echo $i; ?>]" class="form-control"  value="<?php echo _ppt('wlt_nexmo_prefix_'.$i); ?>">               
            </div>
            
            </div>
            
            <div class="col-md-5">
             <input type="text"  name="admin_values[wlt_nexmo_num_<?php echo $i; ?>]"  class="form-control"  value="<?php echo _ppt('wlt_nexmo_num_'.$i); ?>">   
             </div>
             <div class="col-md-1">
             <?php if(strlen(_ppt('wlt_nexmo_num_'.$i)) > 5){ ?>
        <button type="button" class="btn btn-primary" onclick="ajax_test_sms('<?php echo _ppt('wlt_nexmo_prefix_'.$i); ?><?php echo _ppt('wlt_nexmo_num_'.$i); ?>','testing 123');" rel="tooltip" data-original-title="send a test message" data-placement="top"><i class="fa fa-mobile" aria-hidden="true"></i></button>  
        <?php } ?>    
            </div>
            
            </div>
            
            
        </div>
        
<?php $i++; } ?>    
      
        
 





 

<script>
function ajax_test_sms(tnum, tmsg){

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "sms_test",
			num: tnum,
			msg: tmsg,
 
        },
        success: function(response) {
		alert(response);
			
        },
        error: function(e) {
            alert("error saving session: "+e)
        }
    });

}
</script>
 


</div>
</div>


</div>

<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 
