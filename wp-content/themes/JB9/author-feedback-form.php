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

global $CORE, $userdata, $authorID;

if($userdata->ID){

   $r1 = __("Quality","premiumpress");
   $r2 = __("Originality","premiumpress");
   $r3 = __("Creativity","premiumpress");
   $r4 = __("Overall","premiumpress");
 
?>
<form id="addfeedbackform<?php if(isset($_GET['pid'])){ echo $_GET['pid']; } ?>" name="addfeedbackform" method="post" action="" onsubmit="return CHECKFEEDBACK<?php if(isset($_GET['pid'])){ echo $_GET['pid']; } ?>();" style="display:none;" class="mb-4">
   <input type="hidden" name="action" value="addfeedback" />  
   
   <input type="hidden" name="replyid" value="" id="replyid" />  
   <?php if(isset($_GET['pid']) && is_numeric($_GET['pid']) ){ ?>
   <input type="hidden" name="pid" value="<?php echo $_GET['pid']; ?>" />  
   <?php } ?>
   <?php if(isset($_GET['orderid']) && is_numeric($_GET['orderid']) ){ ?>
   <input type="hidden" name="orderid" value="<?php echo $_GET['orderid']; ?>" />  
   <?php } ?>   
   <?php if(isset($_GET['extraid']) && is_numeric($_GET['extraid']) ){ ?>
   <input type="hidden" name="extraid" value="<?php echo $_GET['extraid']; ?>" />  
   <?php } ?>
   <?php if(isset($_GET['uid']) && is_numeric($_GET['uid']) ){ ?>
   <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>" />  
   <?php } ?>
     
   
   <div class="card">
      <div class="card-body">
         <div class="form-group">
            <label class="font-weight-bold text-secondary"><?php echo __("Short Description","premiumpress"); ?></label>
            <input type="text" name="subject" value="<?php if(isset($_POST['subject'])){ echo strip_tags(strip_tags($_POST['subject'])); } ?>" class="form-control sub" placeholder="A++ Very Good" >
         </div>
          
         <div class="form-group mt-4">
            <label class="font-weight-bold text-secondary"><?php echo __("Full Description","premiumpress"); ?></label>
            <textarea rows="3" class="form-control msg"  style="height:200px;" name="message"><?php if(isset($_POST['message'])){ echo strip_tags(strip_tags($_POST['message'])); } ?></textarea>               
         </div>
         
         
         
               <input type="hidden" name="nocaptcha" value="1" />
            <div class="ratingbox">
               <div class="row">
                  <div class="col-md-6 mb-3">
                     <label class="font-weight-bold text-secondary"><?php echo $r1; ?></label>
                     <div class="clearfix"></div>
                     <div class="rating-item1  mt-2"  style="cursor:pointer;">
                        <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" value="5" name="rating1"/>
                     </div>
                  </div>
                  <div class="col-md-6 mb-3">
                     <label class="font-weight-bold text-secondary"><?php echo $r2; ?></label>
                     <div class="clearfix"></div>
                     <div class="rating-item1 mt-2"  style="cursor:pointer;">
                        <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" value="5" name="rating2"/>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label class="font-weight-bold text-secondary"><?php echo $r3; ?></label>
                     <div class="clearfix"></div>
                     <div class="rating-item1 mt-2"  style="cursor:pointer;" >
                        <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" value="5" name="rating3"/>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label class="font-weight-bold text-secondary"><?php echo $r4; ?></label>
                     <div class="clearfix"></div>
                     <div class="rating-item1 mt-2" style="cursor:pointer;" >
                        <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="2" value="5" name="rating4"/>
                     </div>
                  </div>
               </div>
            </div>
         
          
         <div class="pt-3 border-top mt-3">
            <button class="btn btn-lg btn-dark rounded-0" type="submit"><?php echo __("Submit Feedback","premiumpress"); ?></button>
         </div>
         
      </div>
   </div>
</form>
<script> 
   function CHECKFEEDBACK<?php if(isset($_GET['pid'])){ echo $_GET['pid']; } ?>()
   { 
   	
   	var f1 	= jQuery("#addfeedbackform<?php if(isset($_GET['pid'])){ echo $_GET['pid']; } ?> .sub").val(); 
   	var f2 	= jQuery("#addfeedbackform<?php if(isset($_GET['pid'])){ echo $_GET['pid']; } ?> .msg").val(); 
   	   	
   	if(f1 == '')
   	{
   		alert('<?php echo __("Please complete all fields.","premiumpress"); ?>');
   		return false;
   	}
   	if(f2 == '')
   	{
   		alert('<?php echo __("Please complete all fields.","premiumpress"); ?>');
   		return false;
   	} 		   		
   	
   	return true;
   }
</script>
<?php } ?>