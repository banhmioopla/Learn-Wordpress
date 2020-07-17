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

// GET USERS EXISTING SUBSCRIPTION
$f = get_user_meta($userdata->ID, 'wlt_subscription',true);

if(is_array($f)){

$da = $CORE->date_timediff($f['date_expires'],'');
if($da['expired'] == 0){
					 
$subdata = $CORE->get_subscription_data($f['key']);
 
 
?>
<section class="p3 p-lg-5">
 
<h5 class="mb-3"><?php echo __("Current Membership","premiumpress"); ?></h5>
 
<ul class="payment-right large list-unstyled ">
   <li>
      <div id="package-type" class="left">
         <?php echo __("Name","premiumpress"); ?>
      </div>
      <div class="right">
         <?php echo $CORE->get_subscription_name($userdata->ID); ?>
      </div>
      <div class="clearfix"></div>
   </li>
   <li>
      <div class="left"><?php echo __("Expires","premiumpress"); ?>:</div>
      <div class="right">
         <?php echo hook_date($f['date_expires']); ?>
      </div>
      <div class="clearfix"></div>
   </li>
   <li>
      <div class="left"><?php echo __("Time Left","premiumpress"); ?>:</div>
      <div class="right">
         <?php
            $da = $CORE->date_timediff($f['date_expires'],'');
            if($da['expired'] == 0){
             
            	echo $da['string'];
            	
            }else{
            
            	echo __("has expired!","premiumpress");
            
            }
            
            ?> 
      </div>
      <div class="clearfix"></div>
   </li>
   
   
   <?php if(THEME_KEY != "da"){ ?>
    
   <li>
      <div class="left"><?php echo __("Listings Included","premiumpress"); ?>:</div>
      <div class="right">
         <?php if(isset( $subdata['listings'])){ echo $subdata['listings']." (".$CORE->get_listing_package_name($subdata['listings_pak']).")"; }else{ echo 0; } ?>
      </div>
      <div class="clearfix"></div>
   </li>
   <li>
      <div class="left"><?php echo __("Listings Remaining","premiumpress"); ?>:</div>
      <div class="right">
         <?php if(isset( $subdata['listings_left'])){ echo $subdata['listings_left']; }else{ echo 0; } ?>
      </div>
      <div class="clearfix"></div>
   </li>
   <?php } ?>
   
   
   
   
   
    <?php if(THEME_KEY == "da"){ 
	
 
// PACKAGE /MEMEBERSHIP DATA
$i = 0; $b = 0;
$csubscriptions = get_option("csubscriptions"); 
foreach($csubscriptions['key'] as $k){
 
	if($k == $f['key']){
	$i = $b;
	}
	$b++;
}
 
	 
	?> <li><div class="left"><?php echo __("Send Virtual Gifts","premiumpress"); ?></div><div class="right"> <?php if(isset($csubscriptions['access_gift'][$i]) && $csubscriptions['access_gift'][$i] == 1){ echo __("Yes","premiumpress"); }else{ echo __("No","premiumpress"); } ?> </div></li>
               
               
               <li><div class="left"><?php echo __("Send &amp; Receive Messages","premiumpress"); ?></div><div class="right"> <?php if(isset($csubscriptions['access_messages'][$i]) && $csubscriptions['access_messages'][$i] == 1){ echo __("Yes","premiumpress"); }else{ echo __("No","premiumpress"); }?> 
               </div></li>
               
			      
               <li style="border-top:0px;"><div class="left"><?php echo __("Chatroom Access","premiumpress"); ?></div><div class="right"><?php if(isset($csubscriptions['access_chatroom'][$i]) && $csubscriptions['access_chatroom'][$i] == 1){ echo __("Yes","premiumpress"); }else{ echo __("No","premiumpress"); } ?> 
               </div></li>
               
               <li style="border-top:0px;"><div class="left"><?php echo __("Featured Profile","premiumpress"); ?></div><div class="right"><?php if(isset($csubscriptions['access_featured'][$i]) && $csubscriptions['access_featured'][$i] == 1){ echo __("Yes","premiumpress"); }else{ echo __("No","premiumpress"); } ?> 
               </div></li>
   
   <?php } ?>
 
</ul>


<a href="javascript:void(0);" class="btn btn-warning mt-4 rounded-0" onclick="ajax_cancel_membership();"><?php echo __("Cancel My Membership","premiumpress"); ?></a>
</section>

<script>
   function ajax_cancel_membership(){
   
   if (window.confirm("<?php echo __("Are you sure? This action cannot be undone.","premiumpress"); ?>")) {
          
		
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
            action: "cancel_membership",
   			uid: "<?php echo $userdata->ID; ?>",
   			
           },
           success: function(response) {
   			
   			  location.href = "<?php echo _ppt(array('links','myaccount')); ?>";        
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   }
   }
</script>

<?php }else{ ?>
<section class="p3 p-lg-5 bg-white text-center">
      <h4 class="my-5"><?php echo __("You have no active membership.","premiumpress"); ?></h4>      
      <a href="<?php echo _ppt(array('links','memberships')); ?>" class="btn btn-primary px-5 text-uppercase font-weight-bold"><?php echo __("View Memberships","premiumpress"); ?></a>
</section>
<?php } ?>
<?php }else{ ?>
<section class="p3 p-lg-5 bg-white text-center">
      <h4 class="my-5"><?php echo __("You have no active membership.","premiumpress"); ?></h4>      
      <a href="<?php echo _ppt(array('links','memberships')); ?>" class="btn btn-primary px-5 text-uppercase font-weight-bold"><?php echo __("View Memberships","premiumpress"); ?></a>
</section>
<?php } ?>