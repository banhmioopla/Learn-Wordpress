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

?><form action="" method="post" enctype="multipart/form-data">
   <input type="hidden" name="action" value="userupdatephoto" /> 
   <section class="p3 p-lg-5">
   <h5><?php echo __("Display Photo","premiumpress"); ?></h5>
   <hr class="dashed mb-3" />
 
      <?php // USER PHOTO INTEGRATION
         if(function_exists('userphoto')){ ?>
      <div class="col-md-12" style="margin-top:20px;">
         <style>#userphoto th { display:none; } .field-hint { font-size:11px; }</style>
         <?php 
            userphoto_display_selector_fieldset();
            userphoto_thumbnail($userdata->ID);	
            echo '<label><input type="checkbox" name="userphoto_delete" id="userphoto_delete" onclick="userphoto_onclick()">'.__("Delete photo","premiumpress").'</label> </div>';	
            
            }else{
            
            ?>      
         <?php echo get_avatar( $userdata->ID, 180 ); ?>
         <input type="file" name="wlt_userphoto" tabindex="12" />
         <?php } // end built in user photo ?>
 
 
    <div class="clearfix mt-4">
                     <input name="agreetc" type="checkbox" id="agreetc2" class="float-left mr-2 mt-1" onchange="UpdatePhotoTCA();" />
                     <span class="small float-left" > <?php echo sprintf(__( "Agree to <a href='%s'>terms &amp; conditions.</a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?></span>
                    </div>
 <script>					 
					 function UpdatePhotoTCA(){					 
					 if(jQuery('#agreetc2').is(':checked') ){                        	
                        jQuery('#btnPhotoUp').removeAttr("disabled");
                        }else{
							jQuery('#btnPhotoUp').attr("disabled", true);
                        	return false;
                        } 					 
					 }
					 </script>  
 
            <!-- SAVE BUTTON -->
            <div class="row mt-4">
            <div class="col-md-5">
            <button class="btn btn-primary mb-5 rounded-0 btn-block" type="submit" disabled id="btnPhotoUp"><?php echo __("Save Changes","premiumpress"); ?></button>
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