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
$editID = "";
if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){

	$editID = $_GET['eid'];

}
?>
<div class="<?php if(defined('IS_MOBILEVIEW') ){ }else{?>card rounded-0<?php } ?>">
   <div class="card-header" id="headingOne">
      <h5 class="mb-0">
         <button class="btn btn-link btn-block text-left text-uppercase font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <?php echo __("Description","premiumpress"); ?>
         </button>
      </h5>
   </div>
   <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="<?php if(defined('IS_MOBILEVIEW') ){ ?>mt-3<?php }else{?>card-body<?php } ?>">
         <div class="row">

            <div class="col-md-12">
               <div id="form-row-rapper-post_title" class="form-group">    
                  <label class="text-uppercase font-weight-bold text-dark small"><?php 
				  
				  if(THEME_KEY == "da"){
				  echo __("Display Name/ Nickname","premiumpress");
				  }else{
				   echo __("Title","premiumpress");
				  }
				  
				  
				   ?><span class="red">*</span></label>    
                  <input type="input" name="form[post_title]" <?php if(THEME_KEY == "da"){ ?>maxlength="50" style="max-width:300px;"<?php } ?> class="form-control rounded-0 required" tabindex="1" value="<?php echo $CORE->get_edit_data('post_title', $editID); ?>">         
               </div>
            </div>
            <div class="col-md-12">
               <div id="form-row-rapper-post_content" class="form-group">
                  <div id="textarea_counter" class="float-right"><span></span></div>                                   
                  <input type="hidden" name="textarea_counter_hidden" value="<?php if(!is_numeric(_ppt('descmin')) || _ppt('descmin') == 0 ){ echo 1; }elseif(isset($_GET['eid']) && strlen(trim($CORE->get_edit_data('post_content', $editID))) > _ppt('descmin')){ echo 1; }else{ echo 0; } ?>" id="textarea_counter_hidden">                                    
                  <label class="text-uppercase font-weight-bold text-dark small"><?php echo __("Description","premiumpress"); ?> <span class="red">*</span>   </label>
                  <textarea name="form[post_content]" class="form-control rounded-0 required" tabindex="2" id="field-post_content" style="min-height:250px;"><?php 
				  
				  
				  echo preg_replace('#<div id="ppt_keywords">(.*?)</div>#', ' ', $CORE->get_edit_data('post_content', $editID));
				   
				  ?></textarea>
               </div>
            </div>
            
            
            <?php
               /*
                CUSTOM FIELDS
               */
               $o=0; $field = array();
               echo $CORE->BUILD_FIELDS(hook_add_fieldlist($field),'');				
               echo $CORE->SUBMISSION_FIELDS(false,true); // CUSTOM FIELDS
                           
               ?>
               
            <div class="col-md-12 mb-4 mt-4">
               <div class="bg-light p-3">
                  <div id="form-row-rapper-post_tags" class="form-group">
                     <p class="text-muted"><?php echo __("Keywords are very important for helping users find your listing, the better your keywords the more exposure your listing will receive. Seperate keywords with a comma.","premiumpress"); ?> </p>
                     <label class="text-uppercase font-weight-bold text-dark small"><?php echo __("Keywords","premiumpress"); ?></label>    
                     <input type="input" name="form[post_tags]" class="tokenfield" value="<?php echo $CORE->get_edit_data('post_tags', $editID); ?>"> 
                  </div>
               </div>
            </div>
            
               
            
         </div>
      </div>
   </div>
</div>