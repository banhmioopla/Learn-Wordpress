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

if(!_ppt_checkfile("payment-error.php")){

global $CORE, $payment_data; ?>
 

      <div class="container my-5">
         <div class="col-md-6 offset-md-3">
            <div class="card">
               <div class="card-header"><?php echo __("Payment Cancelled","premiumpress") ?></div>
               <div class="card-body">
                  <p><?php echo __("Sorry but there was an error during checkout.","premiumpress") ?></p>
                  <p class="margin-top3"><?php echo __("No money has been taken from your account.","premiumpress") ?></p>
               </div>
            </div>
            <?php hook_callback_error(); ?>  
         </div>
      </div>
 
<?php } ?>