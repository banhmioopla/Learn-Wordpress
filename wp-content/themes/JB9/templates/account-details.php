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

global $CORE, $userdata;
	
	// USER COUNTRY
	$selected_country = get_user_meta($userdata->ID,'country',true);
	if($selected_country == ""){
		$selected_country = _ppt('account_usercountry');
	}

?><?php
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
   
   global $CORE, $userdata;
   	
   	// USER COUNTRY
   	$selected_country = get_user_meta($userdata->ID,'country',true);
   	if($selected_country == ""){
   		$selected_country = _ppt('account_usercountry');
   	}
   
   ?>
<?php if($CORE->user_verified($userdata->ID) == 0){ ?>
<div class="p-4 card bg-success mb-3" style="background: #f0fff3 !important; position:relative; overflow:hidden">
   <i class="fa fa-smile-o" aria-hidden="true" style="    font-size: 200px;    position: absolute;    right: -10px;    opacity: 0.1;"></i>
   <h4><?php echo __("Account Verification","premiumpress"); ?></h4>
   <p><?php echo __("One of our team will review your account details shortly.","premiumpress"); ?></p>
   <p class="small"><?php echo __("Please ensure you fill in all the fields below with as much detail as possible. Thank You.","premiumpress"); ?></p>
</div>
<?php } ?>
<form action="" method="post" onsubmit="return js_validate_fields('<?php echo __("Please completed required fields.","premiumpress") ?>')" enctype="multipart/form-data" id="myaccountdataform" name="myaccountdataform">
   <input type="hidden" name="action" value="userupdate" /> 
   <div class="row">
      <div class="col-md-12">
         <section class="p3 p-lg-5">
            <h5><?php echo __("My Details","premiumpress"); ?></h5>
            <hr class="dashed mb-3" />
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"> <?php echo __("First Name","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="text" name="fname" class="form-control required" value="<?php echo $userdata->first_name ?>" tabindex="1">                         
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"> <?php echo __("Last Name","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="text" name="lname" class="form-control required"  value="<?php echo $userdata->last_name ?>" tabindex="2">                         
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"> <?php echo __("Email","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="text" name="email" class="form-control" value="<?php echo $userdata->user_email; ?>" disabled="disabled" tabindex="3">                         
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"> <?php echo __("Website","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="text" name="url" class="form-control" value="<?php echo get_user_meta($userdata->ID,'url',true); ?>" tabindex="4">                       
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12">
                           <label class="col-form-label"><?php echo __("Mobile Number","premiumpress"); ?></label>
                        </div>
                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-4">
                                 <input name="custom[mobile-prefix]" type="text" class="form-control" id="mobileprefix-input" placeholder="+" 
                                    value="<?php echo get_user_meta($userdata->ID,'mobile-prefix',true); ?>" />            
                              </div>
                              <div class="col-8">
                                 <input name="custom[mobile]" type="text" class="form-control" id="mobilenum-input"
                                    value="<?php echo get_user_meta($userdata->ID,'mobile',true); ?>" />        
                              </div>
                           </div>
                           <!-- end row -->      
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"><?php echo __("Phone","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="text" name="phone" class="form-control" value="<?php echo get_user_meta($userdata->ID,'phone',true); ?>" tabindex="5">                        
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label class="control-label"><i class="icon-comment"></i> <?php echo __("My Description","premiumpress"); ?></label>
                     <textarea style="height:120px;" class="form-control" name="description" tabindex="6"><?php echo stripslashes($userdata->description); ?></textarea>                     
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="row">         
                     <?php echo $CORE->user_fields($userdata->ID); ?>
                  </div>
               </div>
            </div>
            <?php if(THEME_KEY != "da"){ ?>
            <h5 class="mt-4"><?php echo __("My Address","premiumpress"); ?></h5>
            <hr class="dashed mb-3" />
            <!-- end row -->           
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"> <?php echo __("Address Line 1","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="text" name="address1" class="form-control <?php if(THEME_KEY == "at" && get_user_meta($userdata->ID,'address1',true) == ""){ echo "bg-danger"; } ?>" value="<?php echo get_user_meta($userdata->ID,'address1',true); ?>" tabindex="4">                       
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"> <?php echo __("Address Line 2","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="text" name="address2" class="form-control" value="<?php echo get_user_meta($userdata->ID,'address2',true); ?>" tabindex="4">                       
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"><?php echo __("My Country","premiumpress"); ?></label>
                     <div class="controls">
                        <select name="country" class="form-control" tabindex="6" id="user-country">
                        <?php 
                           foreach($GLOBALS['core_country_list'] as $key=>$value){
                                   if(isset($selected_country) && $selected_country == $key){ $sel ="selected=selected"; }else{ $sel =""; }
                                   echo "<option ".$sel." value='".$key."'>".$value."</option>";} ?>
                        </select>                       
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"><?php echo __("City/State","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="hidden"  value="<?php echo get_user_meta($userdata->ID,'city',true); ?>" id="user-city"  /> 
                        <select class="form-control" id="user-city-select" name="city"  tabindex="7" >
                        </select>                     
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="control-label"> <?php echo __("Postal/ Zipcode","premiumpress"); ?></label>
                     <div class="controls">
                        <input type="text" name="zip" class="form-control" value="<?php echo get_user_meta($userdata->ID,'zip',true); ?>" tabindex="4">                       
                     </div>
                  </div>
               </div>
               <?php echo hook_account_mydetails_after(); ?>
            </div>
            <!-- end row -->       
            <script type="application/javascript">
               jQuery(document).ready(function(){
               
               	jQuery('#user-country').on('change', function(e){
               	
               		 ajax_update_citylist();
               	
               	});	
               	 	
               	 ajax_update_citylist(); 
               	
               });
               
               function ajax_update_citylist(){
               
               	// COUNTRY VALUE
               	var countryid = jQuery('#user-country').val();
               	if(countryid == ""){
               	countryid = jQuery('#user-country option:first').val();
               	}
                
               	// SET VALUE
               	jQuery('#user-city').val(countryid);
               
                   jQuery.ajax({
                       type: "POST",
                       url: ajax_site_url,	 	
               		data: {
                           action: "get_location_states",
               			country_id: countryid,
                 			state_id: '<?php echo get_user_meta($userdata->ID,'city',true); ?>',
                       },
                       success: function(response) {
               		 console.log(response);
               			jQuery("#user-city-select").html(response);
                       },
                       error: function(e) {
                            
                       }
                   });
               }
               
            </script>
            <?php } ?>      
             
            
            <?php if(in_array(THEME_KEY, array('ct','mj','at'))){ ?>  
            <h5 class="mt-4"><?php echo __("My Payment Information","premiumpress"); ?></h5>
            <hr class="dashed mb-3" />
            <div class="bg-light border p-4">
               <div class="row">
                  <div class="col-md-6">
                     <label><?php echo __("My Payment Preference","premiumpress"); ?></label>
                     <select class="form-control" onchange="SwitchPP(this.value)" name="payment_type">
                     
                     <option value="paypal" <?php if(get_user_meta($userdata->ID,'payment_type',true) == "paypal"){ ?>selected=selected<?php } ?>><?php echo __("PayPal","premiumpress"); ?></option>
                     <?php if(get_option('v9_gateway_stripe_form') == "yes"){ ?>
                          <option value="stripe" <?php if(get_user_meta($userdata->ID,'payment_type',true) == "stripe"){ ?>selected=selected<?php } ?>><?php echo __("Stripe","premiumpress"); ?></option>
                      <?php } ?>
                          <option value="bank" <?php if(get_user_meta($userdata->ID,'payment_type',true) == "bank"){ ?>selected=selected<?php } ?>><?php echo __("Bank","premiumpress"); ?></option>
                        <option value="person" <?php if(get_user_meta($userdata->ID,'payment_type',true) == "person"){ ?>selected=selected<?php } ?>><?php echo __("In Person/On Collection","premiumpress"); ?></option>
                    
                   
                     </select>
                     <p class="small mt-3"><?php echo __("Tell us how you would like to receive payment from members for your products/services.","premiumpress"); ?></p>
                  </div>
                  <div class="col-md-6">
                  
                  
                     <div class="form-group payment_paypal">
                        <label class="control-label"> <?php echo __("PayPal Email","premiumpress"); ?></label>
                        <div class="controls">
                           <input type="text" name="paypal" class="form-control" value="<?php echo get_user_meta($userdata->ID,'paypal',true); ?>" tabindex="4">                       
                        </div>
                     </div>
                     
                     <div class="form-group payment_bank">
                        <label class="control-label"> <?php echo __("My Bank Details","premiumpress"); ?></label>
                        <div class="controls">
                           <textarea class="form-control" style="height:100px;" name="bank"><?php echo stripslashes(get_user_meta($userdata->ID,'bank',true)); ?></textarea>                      
                        </div>
                     </div>
                      
                      <div class="form-group payment_person">
                        <label class="control-label"> <?php echo __("Address for collection","premiumpress"); ?></label>
                        <div class="controls">
                           <textarea class="form-control" style="height:100px;" name="payaddresss"><?php echo stripslashes(get_user_meta($userdata->ID,'payaddresss',true)); ?></textarea>                      
                        </div>
                     </div> 
                     
                     
                     <div class="form-group payment_stripe">
                     
                     
<label class="control-label"><strong>Strip Payments</strong></label>  
           
<p><?php echo __("Join Stripe using our connection link to recieve payment for items sold.","premiumpress") ?></p>

<a href="<?php echo _ppt('auction_stripeconnect_link'); ?>" class=" btn px-4 btn-primary rounded-0 btn-block" target="_blank"><?php echo __("Join Now","premiumpress") ?></a>

<hr />

<p>Once you have joined Stripe you will be provided with an account ID. Please enter this into the box below;</p>
                     
                     
                     <label class="control-label">My Strip Account ID</label>
                     
                         <div class="controls">
                           <input type="text" name="stripeid" class="form-control" value="<?php echo get_user_meta($userdata->ID,'stripeid',true); ?>" tabindex="4">                       
                        </div>
                     </div> 
                      
                     
                  </div>
               </div>
            </div>
            <script>
			
			
               function SwitchPP(g){
			   
				   if(g == "paypal"){
				   
				    jQuery('.payment_paypal').show();
               		jQuery('.payment_bank').hide();
				    jQuery('.payment_person').hide();
					jQuery('.payment_stripe').hide();
				   
				   }else if(g == "bank"){
				   
				    jQuery('.payment_paypal').hide();
               		jQuery('.payment_bank').show();
				    jQuery('.payment_person').hide();
					jQuery('.payment_stripe').hide();
				   }else if(g == "person"){
				   
				    jQuery('.payment_paypal').hide();
               		jQuery('.payment_bank').hide();
					jQuery('.payment_person').show();					
					jQuery('.payment_stripe').hide();
				
					}else if(g == "stripe"){
					
				    jQuery('.payment_paypal').hide();
               		jQuery('.payment_bank').hide();
					jQuery('.payment_person').hide();					
					jQuery('.payment_stripe').show();
											
				   }else{
				   
				    jQuery('.payment_paypal').show();
               		jQuery('.payment_bank').hide();
					jQuery('.payment_person').hide();					
					jQuery('.payment_stripe').hide();
				   
				   }
              
               }
			   
			       jQuery(document).ready(function(){ 
				   <?php if(get_user_meta($userdata->ID,'payment_type',true) != ""){ ?>
				   SwitchPP('<?php echo get_user_meta($userdata->ID,'payment_type',true); ?>') 
				   <?php }else{ ?>
				   jQuery('.payment_paypal').show();
               		jQuery('.payment_bank').hide();
					jQuery('.payment_person').hide();					
					jQuery('.payment_stripe').hide();
				   <?php } ?>
				   });
			   
            </script>
            <?php } ?>
            <hr class="dashed mb-3" />
            <h5 class="mt-4"><?php echo __("Social Media","premiumpress"); ?></h5>
            <hr class="dashed mb-3" />
            <div class="row">
               <div class="col-md-3">
                  <label class="control-label"><i class="icon-comment"></i> Facebook</label>     
                  <input type="text" name="facebook" class="form-control" value="<?php echo get_user_meta($userdata->ID,'facebook',true); ?>" tabindex="7">                   
               </div>
               <div class="col-md-3">
                  <label class="control-label"><i class="icon-comment"></i> Twitter</label>
                  <input type="text" name="twitter" class="form-control" value="<?php echo get_user_meta($userdata->ID,'twitter',true); ?>" tabindex="8">                   
               </div>
               <div class="col-md-3">
                  <label class="control-label"><i class="icon-comment"></i> LinkedIn</label>
                  <input type="text" name="linkedin" class="form-control" value="<?php echo get_user_meta($userdata->ID,'linkedin',true); ?>" tabindex="9">                   
               </div>
               <div class="col-md-3">
                  <label class="control-label"><i class="icon-comment"></i> Skype</label>
                  <input type="text" name="skype" class="form-control" value="<?php echo get_user_meta($userdata->ID,'skype',true); ?>" tabindex="10">                   
               </div>
            </div>
            <?php /* 
               <h5 class="mt-5"><?php echo __("Additional Details","premiumpress"); ?></h5>
            <hr class="dashed mb-3" />
            <div class="box-grey clearfix">
               <div class="box-grey-wrap"> 
                  <?php hook_account_userfields_after(); ?>
               </div>
            </div>
            <!-- end box wrap -->
            */ ?>
            <div class="clearfix mt-4">
               <input name="agreetc" type="checkbox" id="agreetc1" class="float-left mr-2 mt-1" onchange="UpdateDetailsTCA();" />
               <span class="small float-left" > <?php echo sprintf(__( "Agree to <a href='%s'>terms &amp; conditions.</a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?></span>
            </div>
            <script>					 
               function UpdateDetailsTCA(){					 
               if(jQuery('#agreetc1').is(':checked') ){                        	
                                 jQuery('#detailsBtn').removeAttr("disabled");
                                 }else{
               	jQuery('#detailsBtn').attr("disabled", true);
                                 	alert('<?php echo __("Please agree to the website terms and conditions.","premiumpress"); ?>');
                                 	return false;
                                 } 					 
               }
            </script>       
            <div> 
            
            <!-- SAVE BUTTON -->
            <div class="row mt-4">
            <div class="col-md-5">
            <button class="btn btn-primary mb-5 rounded-0 btn-block" type="submit" disabled id="detailsBtn"><?php echo __("Save Changes","premiumpress"); ?></button>
            </div>
            <div class="col-md-3 "></div>
            <div class="col-md-4  text-sm-right">
             <a onclick="SwitchPage('dashboard');" href="javascript:void(0);" class="btn btn-outline-secondary rounded-0 btn-block mb-5">
			 <?php echo __("Dashboard","premiumpress"); ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
             </a>
            </div>            
            </div>
            <!-- END SAVE BUTTON -->
          
            
            
            
               
            </div>
         </section>
      </div>
   </div>
   <!-- end row -->
</form>