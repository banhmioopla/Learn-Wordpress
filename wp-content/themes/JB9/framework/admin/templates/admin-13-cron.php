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

if(isset($_GET['deleteallactvity']) && $_GET['deleteallactvity'] == 1){

	 // COUNT HOW MANY MESSAGES USER HAS UNREAD
	$SQL = "TRUNCATE ".$wpdb->prefix."core_log";
	$result = $wpdb->get_results($SQL); 
	
	$GLOBALS['error_message'] = "All Activity Deleted";

}

 
 // COUNT HOW MANY MESSAGES USER HAS UNREAD
$SQL = "SELECT * FROM ".$wpdb->prefix."core_log WHERE type='cron' ORDER BY autoid DESC LIMIT 100";
$result = $wpdb->get_results($SQL); 
 
// SET LAST VIEWED TIME
update_option('ppt_activity_lastviewed', $CORE->DATETIME() );

if(!empty($result)){
?> 
<div class="card">
<div class="card-header">
 
<a href="admin.php?page=13&tab=activity&deleteallactvity=1" class="btn btn-sm btn-primary float-right">Delete All Activity</a>

<span>
Recent Website Activity
</span>

</div>
<div class="card-body1">

<table class="table table-bordered table-striped">
<thead>
              <tr>
              <th>#</th>
                <th>Log Entry Message</th>
              </tr>
            </thead>
            <tbody>
 
<?php

foreach( $result as $log ) {
?> 
 <tr>

 <td style="width:30px;">
<span class="label <?php echo $log->link; ?>"><?php echo $log->autoid; ?></span>

</td>
<td style="font-size:14px;">


<?php
$logmessage = ""; $plink = ""; $ulink = "";
if($log->postid != ""){ 	$plink = get_permalink($log->postid); }
if($log->userid != ""){ $ulink = 'user-edit.php?user_id='.$log->userid; }

$logmessage .= str_replace("(plink)",$plink, str_replace("(ulink)",$ulink,$log->message));
echo "<b>".$logmessage."</b> <span style='font-size:11px;'>(".hook_date($log->datetime).")</span>"; ?>
</td></tr>

<?php }  ?>
</tbody> </table> 
</div><!-- end block -->
</div><!-- end card --> 
<?php }else{ ?>
<div class="card-body text-center grey">No activity recorded.</div>
<?php } ?>




<div class="bg-light py-5 px-5 text-center">

<a href="admin.php?page=13&tab=cron&forcecron=1" class="btn btn-lg btn-outline-dark rounded-0">Force Hourly Cron</a>
</div>