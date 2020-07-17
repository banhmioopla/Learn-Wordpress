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

// COUNT HOW MANY MESSAGES USER HAS UNREAD
$SQL = "SELECT * FROM ".$wpdb->prefix."core_orders ORDER BY autoid DESC LIMIT 8";
$result = $wpdb->get_results($SQL);

if(!empty($result)){  
?> 

<table class="table table-bordered table-striped">
<thead>
              <tr>
                <th>ID</th>
                <th>Date/Time</th>
                <th>Amount</th>
                <th style="width:50px; text-align:center"></th>
              </tr>
            </thead>
            <tbody>
 
<?php

foreach( $result as $wd ) {
?> 
 <tr>
 
<td>
<a href="admin.php?page=6&tab=home&oid=<?php echo $wd->autoid; ?>" class="alink">#<?php echo $wd->autoid; ?></a>
</td> 

<td>
<?php echo $wd->order_date." @ ".$wd->order_time; ?> 
</td> 

<td>
 <?php echo hook_price($wd->order_total); ?> 

</td> 

<td style="width:50px; text-align:center">
<a href="admin.php?page=6&tab=home&oid=<?php echo $wd->autoid; ?>">
    
<i class="fa fa-search"></i>
    
    </a>
</td> 

</tr>

<?php }  ?>
</tbody> </table>
 

<?php }else{ ?>
<div class="card-body text-center">No order data recorded.</div>
<?php } ?>