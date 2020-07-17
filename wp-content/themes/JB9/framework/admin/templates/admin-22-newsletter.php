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

global $CORE, $wpdb;

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

?>


<div class="row mb-4">
<div class="col-md-4">
 <div class="card1 shadow my-1  bg-primary p-4" style="height:110px;">
 <i class="fal fa-edit text-white float-left mr-3 mt-1" style="font-size:22px;" aria-hidden="true"></i>
 
    <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#newslettertab2]').tab('show');" class="btn btn-dark float-right">View</a>
      <h4 class="text-white">Sign-up Email</h4>
      <p class="text-white" style="font-size:16px;">Sent to users when they join.</p>  
   </div>
        
</div>   
<div class="col-md-4">       
        
  <div class="card1 shadow my-1  bg-danger p-4" style="height:110px;">
  
   <i class="fal fa-user text-white float-left mr-3 mt-1" style="font-size:22px;" aria-hidden="true"></i>
 
    <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#newslettertab3]').tab('show');" class="btn btn-dark float-right">Import</a>
      <h4 class="text-white">Import Users</h4>
      <p class="text-white" style="font-size:16px;">Add users to your mailing list.</p>  
   </div>       
        
</div>   
<div class="col-md-4">  
       
   <div class="card1 shadow my-1  bg-success p-4" style="height:110px;">
   
    <i class="fal fa-envelope-open text-white float-left mr-3 mt-1" style="font-size:22px;" aria-hidden="true"></i>
 
   
    <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#newslettertab4]').tab('show');" class="btn btn-dark float-right">Send</a>
      <h4 class="text-white">Send Newsletter</h4>
      <p class="text-white" style="font-size:16px;">Send to your subscribers.</p>  
   </div>  
   
</div>
</div> 
     

<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow mb-5" style="border-radius: 7px;">


<div class="tabheader mb-4">

<a href="https://www.youtube.com/watch?v=aFQeC6ecPeA" class="btn btn-sm mb-4 btn-outline-dark float-right" target="_blank"><i class="fa fa-video-camera"></i> Video Tutorial</a>
 
  
         <h4>Newsletter Subscribers</h4>
      </div>
      



 

 <?php 
	
	$mailinglist = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_mailinglist" );  // WHERE email_confirmed=1
	 
	
	if ( $mailinglist ) { ?>


    
     <table class="responsive table table-striped table-bordered">
                  <thead>
                    <tr>
                    
                      <th>Email</th>
                      <th>Date</th>
                      <th>Name</th>
                        <th> </th>
                    </tr>
                  </thead>
                  <tbody>              
    <?php  foreach ( $mailinglist as $maild ) {  ?>
                    <tr class="<?php if($maild->email_confirmed == 1){ echo "confirmed"; }else{ echo "unconfirmed"; } ?>">
                     
                      <td><?php echo $maild->email." "; if($maild->email_confirmed == 1){ echo '<span class="label label-success"><i class="fa fa-close"></i></span>'; }else{ echo '<i class="fa fa-trash"></i>'; } ?></td>
                      <td><?php echo $CORE->format_date($maild->email_date);?></td>
                      <td><?php echo $maild->email_firstname." ".$maild->email_lastname;?></td>
                      <td class="text-center"><a href="admin.php?page=22&delm=<?php echo $maild->autoid;?>" class="btn btn-sm btn-danger" style="color:#fff;"><i class="fa fa-trash"></i></a></td>
                      
                      
                    </tr> 
    <?php }   ?>
                  </tbody>
                </table> 


              <div class="mt-3">
              
             <a href="admin.php?page=22&delall=1" class="btn btn-danger confirm float-right">Delete All Emails</a>
             
              <a href="admin.php?page=22&exportall=1" class="btn btn-secondary">Export All Emails</a>
              
              </div>
             
            
              
    <?php }else{ ?>
    <div class="text-center txt500 my-5 p-5 bg-light">You have no confirmed users in your mailing list.</div>
    <?php } ?>



 




</div></div>

<div class="col-lg-4">

     
     
      
 <?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>

<div class="container bg-light py-3 mb-4 p-4">
   <div class="row">

      <div class="col-4">
         <div class="">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('newsletter').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('newsletter').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('newsletter') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
         </div>
         <input type="hidden" id="newsletter" name="admin_values[newsletter]" value="<?php echo _ppt('newsletter'); ?>">
      </div>
      
      <div class="col-8 text-left">
         <h4 class="txt500">Newsletters</h4>

      </div>
      
      <div class="col-12">
      
       <div class="text-muted py-3">Turn on/off to enable the built-in newsletter system.</div>
      
      </div>
      
      
   </div>
   
    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 
     
</div>
  <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>
 
 
 



   
      




</div>


</div>

