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
  
?><div class="row formrow py-4">
   <div class="col-md-6">
      <label>Disable token System</label>
      <div>
         <label class="radio off">
         <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('token_system').value='0'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('token_system').value='1'">
         </label>
         <div class="toggle <?php if(_ppt('token_system') == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="token_system" name="admin_values[token_system]" 
         value="<?php echo _ppt('token_system'); ?>">
   </div>
   <div class="col-md-6">
      <label>Exchange Rate ( <?php echo hook_currency_symbol(''); ?>1 = X tokens) </label>
      <br />
      <div class="input-group">
         <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fa fa-money"></i></span> </span>
         <input type="text"  name="admin_values[token_exchange]" value="<?php if(_ppt('token_exchange') == ""){ echo 1; }else{ echo _ppt('token_exchange'); } ?>" class="form-control">
      </div>
   </div>
</div>
<?php /*
<div class="row formrow py-4">
<div class="col-md-6">
   <label>Disable Credit System</label>
   <div>
      <label class="radio off">
      <input type="radio" name="toggle" 
         value="off" onchange="document.getElementById('credit_system').value='0'">
      </label>
      <label class="radio on">
      <input type="radio" name="toggle"
         value="on" onchange="document.getElementById('credit_system').value='1'">
      </label>
      <div class="toggle <?php if(_ppt('credit_system') == '1'){  ?>on<?php } ?>">
         <div class="yes">ON</div>
         <div class="switch"></div>
         <div class="no">OFF</div>
      </div>
   </div>
   <input type="hidden" id="credit_system" name="admin_values[credit_system]" 
      value="<?php echo _ppt('credit_system'); ?>">
</div>
<div class="col-md-6">
   <label>Exchange Rate (<?php echo hook_currency_symbol(''); ?>1 = <?php echo hook_currency_symbol(''); ?> credit)</label>
   <br />
   <div class="input-group">
      <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fal fa-award"></i></span></span>
      <input type="text"  name="admin_values[credit_exchange]" value="<?php if(_ppt('credit_exchange') == ""){ echo 1; }else{ echo _ppt('credit_exchange'); } ?>" class="form-control">
   </div>
</div>
*/ ?>