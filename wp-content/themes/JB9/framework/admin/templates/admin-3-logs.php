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

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
  
?>

<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">




 
<div class="tabheader mb-4">
 <a href="javascript:void(0);" onclick="ajax_admin_delete_alllogs();" class="btn btn-outline-dark btn-sm float-right">Delete All Logs</a>

         <h4><span>Email Logs</span></h4>
      </div>
 
 
 


<?php

 // COUNT HOW MANY MESSAGES USER HAS UNREAD
$SQL = "SELECT * FROM ".$wpdb->prefix."core_log WHERE type='email' ORDER BY autoid DESC LIMIT 100";
$result = $wpdb->get_results($SQL); 

if(!empty($result)){
?> 

<script>

function ajax_admin_delete_log(logid){
 
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "admin_delete_log",
			'logid': logid,
        },
        success: function(response) {			
			  
			//jQuery('#logsbox').hide();
        },
        error: function(e) {
           
        }
    });
 
}

function ajax_admin_delete_alllogs(){
 
 
 	jQuery('#logbox').hide();
	
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "admin_delete_alllogs",
        },
        success: function(response) {			
			  
			
        },
        error: function(e) {
           
        }
    });
 
}
</script>
<table class="table table-bordered table-striped">
<thead>
              <tr>
                 <th>Date</th>
                <th>Log Entry Message</th>
                <th style="width:130px; text-align:center;">Actions</th>
              </tr>
            </thead>
            <tbody id="logbox">
 
<?php

foreach( $result as $log ) {
?> 
 <tr id="eedel<?php echo $log->autoid; ?>">
 
<td style="font-size:11px;">
 
 <?php echo hook_date($log->datetime); ?>
 
</td> 
<td style="font-size:12px;">


<?php
$logmessage = ""; $plink = ""; $ulink = "";
if($log->postid != ""){ 	$plink = get_permalink($log->postid); }
if($log->userid != ""){ $ulink = 'user-edit.php?user_id='.$log->userid; }

$logmessage .= str_replace("(plink)",$plink, str_replace("(ulink)",$ulink,$log->message));
echo $logmessage; ?>
</td>

<td>

<a href="javascript:void(0);" onclick="jQuery('#ee<?php echo $log->autoid; ?>').toggle(); jQuery('#ee<?php echo $log->autoid; ?> li:first-child a').tab('show');" class="btn btn-primary btn-sm" >view log</a>
<a href="javascript:void(0);" onclick="jQuery('#eedel<?php echo $log->autoid; ?>').hide(); ajax_admin_delete_log('<?php echo $log->autoid; ?>');" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>


</td> 

</tr>

<tr id="ee<?php echo $log->autoid; ?>" style="display:none;"><td colspan="3">
 

    <div class="tab-content innertabs-content" style="border:0px; min-height:auto !important;">   
    <ul class="nav nav-pills">
    
        <li class="nav-item  active"><a href="#e1<?php echo $log->autoid; ?>" data-toggle="tab" class="btn btn-outline-primary mr-3">Preview</a></li>
      
        <li class="nav-item "><a href="#e2<?php echo $log->autoid; ?>" data-toggle="tab" class="btn btn-outline-primary mr-3">Data</a></li>
            
    </ul>
    
        <div class="tab-pane in active" id="e1<?php echo $log->autoid; ?>"> 
        <table><tbody>
       	  
         <div class="p-5 border"> 
		  <?php echo stripslashes($log->data); ?>
          </div>
          
        </tbody>
        </table>
        </div>
        
        <div class="tab-pane" id="e2<?php echo $log->autoid; ?>"> 
        <textarea style="height:300px; width:100%; ">
        <?php echo $log->data; ?>
        </textarea>
        </div>
    
    </div>

</td></tr>



</tr>

<?php }  ?>
</tbody> </table> 

<?php }else{ ?>

<div class="card-body text-center">No activity recorded.</div>

<?php } ?>




</div></div>

<div class="col-lg-4">

 <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#settings]').tab('show');"  class="btn btn-primary mb-4 btn-lg btn-block text-left"><i class="fa fa-arrow-left mr-3"></i> Go Back</a>
    



  


</div>


</div>