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
    
    <div style="padding:10px; border:1px solid #ddd; ">
    
    <div class="row">
    
    <div class="col-6">
    
     Un-confirmed Emails (<i class="fa fa-close"></i>) 
     
    </div>
    
    <div class="col-6 text-right">
    
          <a href="javascript:void(0);" onclick="jQuery('table .confirmed').hide();" style="text-decoration:underline;">Hide</a> / <a href="javascript:void(0);" onclick="jQuery('table .confirmed').show();" style="text-decoration:underline;">Show</a> Confirmed Emails <span class="label label-success"><i class="gicon-ok"></i></span>
          
    </div> 

     </div> 
    </div>
    
    <?php 
	
	$mailinglist = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_mailinglist" );  // WHERE email_confirmed=1
	 
	
	if ( $mailinglist ) { ?>
    
<div class="card">
<div class="card-header">
<span>
Newsletter Subscribers
</span>
</div>
<div class="card-body1"> 



    
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
                
</div><!-- end card block -->
</div><!-- end card -->
    
                
              <div class="mt-3">
              
             <a href="admin.php?page=22&delall=1" class="btn btn-danger confirm float-right">Delete All Emails</a>
             
              <a href="admin.php?page=22&exportall=1" class="btn btn-secondary">Export All Emails</a>
              
              </div>
             
            
              
    <?php }else{ ?>
    <div class="alert" style="margin-top:20px;">You have no confirmed users in your mailing list.</div>
    <?php } ?>
    