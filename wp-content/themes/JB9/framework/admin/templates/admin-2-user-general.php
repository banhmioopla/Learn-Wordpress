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

<div class="col-lg-7">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">
         <h4><span>User Settings</span></h4>
      </div>



<!-- ------------------------- -->
 <?php if(!defined('WP_ALLOW_MULTISITE')){ ?> 
<div class="container px-0">
<div class="row py-2">

    <div class="col-10">
    
        <label class="txt500">Allow Registrations</label>
        
        <p class="text-muted">Here you can set a global subscription access for all listing pages. </p>
        
    </div>
    
    <div class="col-2">
    
 				 <div class="mt-4">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('can_reg').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('can_reg').value='1'">
                                  </label>
                                  <div class="toggle <?php if(get_option('users_can_register') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                
                                <input type="hidden" id="can_reg" name="adminArray[users_can_register]" 
                             value="<?php echo get_option('users_can_register'); ?>">
        
    
   
 
    
</div>
</div>
</div>

<?php }else{ ?>
    
    <input type="hidden" id="can_reg" name="adminArray[users_can_register]"  value="1">
    
<?php } ?>






<!-- ------------------------- -->


<div class="container px-0">
<div class="row py-2">

    <div class="col-10">
    
        <label class="txt500">User Sets Password</label>
        
        <p class="text-muted">Let users create their own password instead of the system emailing them one. </p>
        
    </div>
    
    <div class="col-2">
    

         <div class="mt-4">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('visitor_password').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('visitor_password').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('visitor_password') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="visitor_password" name="admin_values[visitor_password]" 
                             value="<?php echo _ppt('visitor_password'); ?>"> 
 
    
</div>
</div>
</div>

<!-- ------------------------- -->


<div class="container px-0">
<div class="row py-2">

    <div class="col-10">
    
        <label class="txt500">User Mobile Number</label>
        
        <p class="text-muted">Let users add their mobile number during registration. </p>
        
    </div>
    
    <div class="col-2">
    

         <div class="mt-4">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('register_mobilenum_basic').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('register_mobilenum_basic').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('register_mobilenum_basic') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="register_mobilenum_basic" name="admin_values[register_mobilenum_basic]" 
                             value="<?php echo _ppt('register_mobilenum_basic'); ?>"> 
 
    
</div>
</div>
</div>









<!-- ------------------------- -->
 
 <?php if(!defined('WLT_DATING') && THEME_KEY != "sp"){ ?>
<div class="container px-0">
<div class="row py-2">

    <div class="col-10">
    
        <label class="txt500">Author Pages</label>
        
        <p class="text-muted">Turn OFF to prevent users from accessing the WordPress author page. </p>
        
    </div>
    
    <div class="col-2">
 
 
                                    <div class="pull-left mt-4">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('allow_profile').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('allow_profile').value='1'">
                                      </label>
                                      <div class="toggle <?php if(_ppt('allow_profile') == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div>
                                    
    				<input type="hidden" id="allow_profile" name="admin_values[allow_profile]" 
                                 value="<?php if(_ppt('allow_profile') == ""){ echo 1; }else{ echo _ppt('allow_profile'); } ?>">
    
</div>
</div>
</div>
<?php }else{ ?>
<input type="hidden" name="admin_values[allow_profile]" value="0"  />
<?php } ?>

<!-- ------------------------- -->


<div class="container px-0">
<div class="row py-2">

    <div class="col-10">
    
        <label class="txt500">User Verification</label>
        
        <p class="text-muted">Turn on/off the user verification system.</p>
        
    </div>
    
    <div class="col-2">
    

         <div class="mt-4">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('account_userverify').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('account_userverify').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('account_userverify') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="account_userverify" name="admin_values[account_userverify]" 
                             value="<?php echo _ppt('account_userverify'); ?>"> 
 
    
</div>
</div>
</div>
 





<div class="container px-0">
<div class="row py-2">

    <div class="col-12">
    
        <label class="txt500">Default User Country</label>
        
        <p class="text-muted">Let users create their own password instead of the system emailing them one. </p>
        
    </div>
    
    <div class="col-12">
 
<select name="admin_values[account_usercountry]" id="ul1" class="chzn-select mt-4" style="width:350px;">

         <?php
		 
		  $selected = _ppt('account_usercountry');
				 
                 foreach ($GLOBALS['core_country_list'] as $key=>$option) {				 				
                 	printf( '<option value="%1$s"%3$s>%2$s</option>', trim( $key  ), $option, selected( $selected, $key, false ) );
                 }
		 
		 ?> 
</select>
    
    
</div>
</div>
</div>






<?php if(in_array(THEME_KEY, array('at','ct','mj'))){ ?>
<!-- ------------------------- -->
<div class="container px-0">
   <div class="row py-2">
      <div class="col-10">
         <label class="txt500">Power Seller</label>
         <p class="text-muted">This options allows users to pay a single price for their account to display the power seller badge. <img src="<?php echo get_template_directory_uri(); ?>/framework/img/medal.png" alt="" class="mr-2" /></p>
      </div>
      <div class="col-2 px-0">
         
               <label class="txt500">Price</label>
               <div class="input-group">
                  <span class="input-group-prepend input-group-text"><?php echo hook_currency_symbol(''); ?></span>
                  <input type="text" name="admin_values[powerseller_price]"    value="<?php if(_ppt('powerseller_price') == ""){ echo 0; }else{ echo _ppt('powerseller_price'); } ?>" class="form-control">  
               </div>
        
   </div>
</div>
</div>
<?php } ?>




 


<div class="container px-0">
<div class="row py-2">

    <div class="col-10">
    
        <label class="txt500">Message System</label>
        
        <p class="text-muted">Here you can turn on/off the private message system within user account. </p>
        
    </div>
    
    <div class="col-2">
    

         <div class="mt-4">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('account_messages').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('account_messages').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('account_messages') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="account_messages" name="admin_values[account_messages]" 
                             value="<?php echo _ppt('account_messages'); ?>"> 
 
    
</div>
</div>
</div>


 <!-- ------------------------- -->
<div class="container px-0">
   <div class="row">
      <div class="col-10">
         <label class="txt500">Comments</label>
         <p class="text-muted">Turn on/off blog and website comments.</p>
      </div>
      <div class="col-2">
         <div class="mt-4">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('comments').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('comments').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('comments') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
         </div>
         <input type="hidden" id="comments" name="admin_values[comments]" 
            value="<?php echo _ppt('comments'); ?>">
      </div>
   </div>
</div>



<?php /*


<div class="card">
<div class="card-header">

<a href="#" rel="tooltip" data-original-title="If enabled the user will be sent a activation code to their mobile phone before they can register." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

<span>SMS User Registration</span>
</div>

<div class="card-body"> 

<div class="row">


<div class="col-2">


    	<label class="txt500">Enable    </label>
        
		<div>
                                    <div class="pull-left">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('register_mobilenum').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('register_mobilenum').value='1'">
                                      </label>
                                      <div class="toggle <?php if(_ppt('register_mobilenum') == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div>
                                    
    				<input type="hidden" id="register_mobilenum" name="admin_values[register_mobilenum]" 
                                 value="<?php if(_ppt('register_mobilenum') == ""){ echo 1; }else{ echo _ppt('register_mobilenum'); } ?>">

</div>

</div>
<div class="col-md-8">

<p class="mt-3">If enabled, an activation code will be sent to the user and they will need to enter this before they can contiune with registration. </p>

<p class="text-muted">Please setup the SMS details under system under general settings.</p>

</div>


</div><!-- end row -->

</div><!-- end card block -->
</div><!-- end card -->

*/ ?>

</div>
</div>
<div class="col-lg-5">

 

<div class="bg-white p-5 shadow" style="border-radius: 7px;">

    <?php get_template_part('framework/admin/templates/admin', '2-userfields' ); ?>
    
    </div>
    

 </div>
</div>
<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 