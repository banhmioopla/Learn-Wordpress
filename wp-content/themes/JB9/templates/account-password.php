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

?>
<form action="" method="post" onsubmit="return js_validate_fields('<?php echo __("Please completed required fields.","premiumpress") ?>')" enctype="multipart/form-data" id="passworddataform" name="passworddataform">
   <input type="hidden" name="action" value="userupdatepass" /> 
   <section class="p3 p-lg-5 bg-white ">
   <h5><?php echo __("Change Password","premiumpress"); ?></h5>
   <hr class="mb-3" />
 
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <label class="control-label"> <?php echo __("Password","premiumpress"); ?></label>
                  <div class="controls">
                     <input type="password" name="password" class="form-control" tabindex="13">
                  </div>
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label class="control-label"><?php echo __("Confirm Password","premiumpress"); ?></label>
                  <div class="controls">
                     <input type="password" name="password_r" class="form-control" tabindex="14">                        
                  </div>
               </div>
    
         <!-- end row -->
      </div>
   </div>
   
         
    <div class="clearfix mt-4">
                     <input name="agreetc" type="checkbox" id="agreetc3" class="float-left mr-2 mt-1" onchange="UpdatePassTCA();" />
                     <span class="small float-left" > <?php echo sprintf(__( "Agree to <a href='%s'>terms &amp; conditions.</a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?></span>
                    </div>
 <script>					 
					 function UpdatePassTCA(){					 
					 if(jQuery('#agreetc3').is(':checked') ){                        	
                        jQuery('#passwordBtn').removeAttr("disabled");
                        }else{
							jQuery('#passwordBtn').attr("disabled", true);
                        } 					 
					 }
					 </script>     
 
   
   
            <!-- SAVE BUTTON -->
            <div class="row mt-4">
            <div class="col-md-5">
            <button class="btn btn-primary mb-5 rounded-0 btn-block" type="submit" disabled id="passwordBtn"><?php echo __("Save Changes","premiumpress"); ?></button>
            </div>
            <div class="col-md-3 "></div>
            <div class="col-md-4  text-sm-right">
             <a onclick="SwitchPage('dashboard');" href="javascript:void(0);" class="btn btn-outline-secondary rounded-0 btn-block mb-5">
			 <?php echo __("Dashboard","premiumpress"); ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
             </a>
            </div>            
            </div>
            <!-- END SAVE BUTTON --> 
   
   
   
   </section>
</form>