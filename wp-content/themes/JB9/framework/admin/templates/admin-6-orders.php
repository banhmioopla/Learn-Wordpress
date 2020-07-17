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
 

// GET ITESM PER PAGE
if(isset($_GET['ipp']) && is_numeric($_GET['ipp']) && $_GET['tab'] == "home"){
	$ITEMSPERPAGE = $_GET['ipp'];
}elseif(isset($_GET['ipp']) && $_GET['ipp'] == "All" && $_GET['tab'] == "home"){
	$ITEMSPERPAGE = 500;
}else{
	$ITEMSPERPAGE = 20;
}

// GET ROWS
if(isset($_GET['cpage']) && $_GET['cpage'] > 1 && $_GET['tab'] == "home"){
	$pstop = $ITEMSPERPAGE;
	$pint = $_GET['cpage']-1;
	$pstart = ($ITEMSPERPAGE*$pint);
}else{
	$pstop = $ITEMSPERPAGE;
	$pstart =0;
}

// GET SEARCH RESULTS AND FILTERS
$SQL_WHERE = "";

 
if(isset($_GET['s_k']) && strlen($_GET['s_k']) > 1 && $_GET['tab'] == "home" ){

	$SQL_WHERE .= " WHERE ( user_login_name LIKE ('%".strip_tags($_GET['s_k'])."%') OR order_email LIKE ('%".strip_tags($_GET['s_k'])."%') OR order_id LIKE ('%".strip_tags($_GET['s_k'])."%') )";
}

if(isset($_GET['uid'])){

	$SQL_WHERE .= " WHERE ( user_id = '".strip_tags($_GET['uid'])."' )";
}


if(isset($_GET['s_d1']) && $_GET['s_d1'] > 1 && $_GET['tab'] == "tab-orders"){
	if($SQL_WHERE == ""){ $SQL_WHERE .= "WHERE "; }else{ $SQL_WHERE .= " AND "; }
	$SQL_WHERE .= "order_date >= '".$_GET['s_d1']."' AND order_date <= '".$_GET['s_d2']."' ";
}

if(isset($_GET['s_d3']) && $_GET['s_d3'] != ""){
	if($SQL_WHERE == ""){ $SQL_WHERE .= "WHERE "; }else{ $SQL_WHERE .= " AND "; }
	$SQL_WHERE .= "order_status = '".$_GET['s_d3']."' ";
}

if(isset($_GET['s_d4']) && is_numeric($_GET['s_d4']) ){
	if($SQL_WHERE == ""){ $SQL_WHERE .= "WHERE "; }else{ $SQL_WHERE .= " AND "; }
	$SQL_WHERE .= "order_total >= ".strip_tags($_GET['s_d4'])." AND order_total <= ".strip_tags($_GET['s_d5'])." ";
}

if(isset($_GET['s_d8']) && $_GET['s_d8'] != ""){
 
	if($SQL_WHERE == ""){ $SQL_WHERE .= "WHERE "; }else{ $SQL_WHERE .= " AND "; }
	$SQL_WHERE .= "order_id LIKE '%".$_GET['s_d8']."%' ";
}

// GET DATA
$sql = "SELECT * FROM ".$wpdb->prefix."core_orders ".$SQL_WHERE." ORDER BY autoid DESC LIMIT ".$pstart.",".$pstop."";
 
  
$ROWDATA = $wpdb->get_results($sql, OBJECT);

// GET TOTAL AMOUNT
$TOTALROWDATA = $wpdb->get_results("SELECT count(*) AS total, sum(order_total) AS order_total FROM ".$wpdb->prefix."core_orders ".$SQL_WHERE." ORDER BY autoid DESC", OBJECT);
$TOTALITEMS = $TOTALROWDATA[0]->total;
$TOTALORDERVALUE = $TOTALROWDATA[0]->order_total;
if(!is_numeric($TOTALORDERVALUE)){ $TOTALORDERVALUE = 0; }
// TOTAL PAGES
$TOTALPAGES = round($TOTALITEMS/$ITEMSPERPAGE);
 
?> 

<div class="row">

<div class="col-lg-9">


 


<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4"> <h4><span>Sales Total:  <?php echo hook_price($TOTALORDERVALUE); ?></span></h4> </div>



 

 
 

 
 
 
 
<?php if ($ROWDATA){  ?>
 
 
<table  class="responsive table table-striped table-bordered small" >
            <thead>
            <tr>
              <th class="no_sort" style="text-align:center;">
                ID
              </th>
                <th class="no_sort">
                Details
              </th>
              
               <th class="no_sort" style="text-align:center;">
                Type
              </th>
              
              <th class="no_sort" style="text-align:center;">
                Amount
              </th>
            
 		
              <th class="ms no_sort" style="text-align:center;">
                Actions
              </th>
            </tr>
            </thead>
            <tbody>
            
<?php 
 

foreach ($ROWDATA as $wd):

 
	$tt = "";
	if (strpos($wd->order_id, "SUB") !== false) {
		$tt = "<span class='label'> Subscription Payment </span><br />";
		
	}elseif (strpos($wd->order_id, "LST") !== false) {
		$tt = "<span class='label label-info'> New Listing </span><br />";
		
	}elseif (strpos($wd->order_id, "REW") !== false) {
		$tt = "<span class='label label-warning'> Renewal </span><br />";
	
	}elseif (strpos($wd->order_id, "MEM") !== false) {
		$tt = "<span class='label label-important'> Membership </span><br />";	
				
 	}elseif (strpos($wd->order_id, "BAN") !== false) {
		$tt = "<span class='label label-important'> Advertising </span><br />";			
 	}
 
 

?>
<tr class="<?php if(isset($wd->withdrawal_status) && $wd->withdrawal_status == 1){ ?>completed<?php } ?>">
 
 
 
<td style="text-align:center; width:110px;">

<a href="admin.php?page=6&tab=home&oid=<?php echo $wd->autoid; ?>" style="color:#000;">
 
#<?php echo hook_orderid($wd->autoid); ?>

</a>

</td>


<td>



 <div style="width: 130px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;">
<a href="<?php echo home_url(); ?>/wp-admin/user-edit.php?user_id=<?php echo $wd->user_id; ?>" style="color:#000;">
<i class="fa fa-user mr-2"></i>
</a>

<a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=6&uid=<?php echo $wd->user_id; ?>" style="color:#000;">

<?php echo $wd->user_login_name; ?>

</a>
</div>
 
    
<div class="mt-2"><?php echo hook_date($wd->order_date." ".$wd->order_time); ?></div>

   
    
</td>



<td style="text-align:center; width:110px;">

 <?php

// ORDER TYPE
$ordertype = $CORE->orders_get_type($wd->order_id);

?>

<div style="padding:8px; background:<?php echo $ordertype['color']; ?>; color:#fff; text-align:center; font-size:11px; text-transform:uppercase; width:100%;"><?php echo $ordertype['name']; ?></div>
<?php

 
// ORDER STATUS
$orderstatus = $CORE->order_get_status($wd->order_status);

 
?>

<div style=" background:<?php echo $orderstatus['color']; ?>; color:#222; margin-top:5px; text-align:center; font-size:11px; width:100%; float:right; text-transform:uppercase"><?php echo $orderstatus['name']; ?></div>

</td>

 
 
<td style="text-align:center; width:110px;"><b><?php echo hook_price($wd->order_total); ?></b> 
 

<?php if($wd->order_gatewayname != ""){ ?>
<br /><small><?php echo $wd->order_gatewayname; ?></small>
<?php } ?>
</td>







        
<td class="ms" style="text-align:center; width:150px">

                
<a href="admin.php?page=6&tab=home&oid=<?php echo $wd->autoid; ?>" class="btn btn-dark btn-sm" rel="tooltip" data-placement="top" data-original-title="View &amp; Edit Order"><i class="fa fa-search"></i></a>
                  
<a class="btn btn-dark btn-sm" href="<?php echo THEME_URI; ?>/_invoice.php?invoiceid=<?php echo $wd->autoid; ?>" target="_blank" rel="tooltip" data-original-title="Show Invoice" data-placement="top">
<i class="fa fa-file"></i></a> 
                  
<a href="admin.php?page=6&doid=<?php echo $wd->autoid; ?>" class="btn btn-danger btn-sm confirm" rel="tooltip" data-placement="top" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                  
             
                
                
              </td>
            </tr>
            
<?php endforeach; ?>
 

         

</tbody>
</table> 

<?php  }else{ ?>  

<div class="txt500 text-center p-4 bg-light">

No Orders Found

</div>

<?php  } ?>              
            
 <?php if ($ROWDATA){ ?>
 
<div class="mt-5 mb-3">
 
<p class="text-muted">Orders: <?php echo $TOTALITEMS; ?> / Page <?php if(!isset($_GET['cpage'])){ echo 1; }else{ echo $_GET['cpage']; } ?> of <?php if($TOTALPAGES == 0){ echo 1; }else{ echo $TOTALPAGES; } ?></p>
         
        
 
<nav aria-label="Page navigation">
<div class="float-left mr-2 small text-uppercase mt-1 font-weight-bold text-muted">Page:</div>
<ul class="pagination">
<?php
$pages = new wlt_admin_paginator;
$pages->items_total = $TOTALITEMS;
$pages->items_per_page = $ITEMSPERPAGE;
$pages->mid_range = $ITEMSPERPAGE/2;
$pages->pagelink = home_url()."/wp-admin/admin.php?tab=tab-orders&".$_SERVER['QUERY_STRING'];
$pages->paginate();
echo $pages->display_pages();
?>
</ul>
</nav>
<style>
.page-link { padding: 2px 5px; }
.page-link.current { background:#efefef; padding: 2px 5px; }
</style>
</div>
 <?php } ?>  
 

 
 
 
 
 
 
 
 
  


<?php

// GET SEARCH RESULTS AND FILTERS
$SQL_WHERE = "";
if(isset($_GET['s_k']) && strlen($_GET['s_k']) > 1 && (isset($_GET['tab']) && $_GET['tab'] == "widthdrawal")){
	$SQL_WHERE .= " WHERE ( user_name LIKE ('%".$_GET['s_k']."%') OR withdrawal_comments LIKE ('%".$_GET['s_k']."%') OR withdrawal_total LIKE ('%".$_GET['s_k']."%') )";
}

if(isset($_GET['s_d1']) && $_GET['s_d1'] > 1 && (isset($_GET['tab']) && $_GET['tab'] == "widthdrawal")){
	if($SQL_WHERE == ""){ $SQL_WHERE .= "WHERE "; }else{ $SQL_WHERE .= " AND "; }
	$SQL_WHERE .= "datetime >= '".$_GET['s_d1']."' AND datetime <= '".$_GET['s_d2']."' ";
}

// GET DATA
$sql = "SELECT * FROM ".$wpdb->prefix."core_withdrawal ".$SQL_WHERE." ORDER BY autoid DESC LIMIT ".$pstart.",".$pstop."";
$ROWDATA = $wpdb->get_results($sql, OBJECT);

// GET TOTAL AMOUNT
$TOTALROWDATA = $wpdb->get_results("SELECT count(*) AS total FROM ".$wpdb->prefix."core_withdrawal ".$SQL_WHERE." ORDER BY autoid DESC", OBJECT);
$TOTALITEMS = $TOTALROWDATA[0]->total;

// TOTAL PAGES
$TOTALPAGES = round($TOTALITEMS/$ITEMSPERPAGE);

?>









<div class="tabheader mb-4 mt-4">
 <h4><span>User Cash-out Requests</span></h4>
</div> 


<?php  if ($ROWDATA){  ?>
<table  class="responsive table table-striped table-bordered small" style="width:100%;margin-bottom:0; ">
            <thead>
            <tr>
              <th class="no_sort">               
              </th>
              
              <th class="no_sort">
                Username
              </th>
              <th class="no_sort" style="text-align:center;">
                Amount
              </th>
              <th class="no_sort">
                Date
              </th>
 			 <th class="ms no_sort " style="text-align:center;">
                Status
              </th>
              <th class="ms no_sort" style="text-align:center;">
                Actions
              </th>
            </tr>
            </thead>
            <tbody>
            
<?php  
if ($ROWDATA): 
foreach ($ROWDATA as $wd): ?>
<tr class="<?php if($wd->withdrawal_status == 1){ ?>completed<?php } ?>">
<td>
	#<?php echo $wd->autoid; ?>	 
</td>
 
<td>

 
	<a href="<?php echo home_url()."/wp-admin/"; ?>user-edit.php?user_id=<?php echo $wd->user_id; ?>" target="_blank"><small><?php echo $wd->user_name; ?></small></a>
</td>
<td style="text-align:center; ">
	<?php echo hook_price($wd->withdrawal_total); ?>          
</td>
<td style="font-size:11px;">
	<?php echo hook_date($wd->datetime); ?> 
</td>
<td>
<?php if($wd->withdrawal_status == 1){ ?>
<div style="padding:8px; background:green; color:#fff; text-align:center; font-size:11px; text-transform:uppercase">Paid</div>
<?php }else{ ?>   
<div style="padding:8px; background:red; color:#fff; text-align:center; font-size:11px; text-transform:uppercase">Pending</div>
<?php } ?> 
</td>              
<td class="ms" style="text-align:center;">
                <div class="btn-group1">
                  
                  <a href="admin.php?page=6&tab=tab-cashout&wid=<?php echo $wd->autoid; ?>" class="btn btn-sm btn-primary rounded-0" rel="tooltip" data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
                  
                  <a href="admin.php?page=6&tab=tab-cashout&dwid=<?php echo $wd->autoid; ?>" class="btn btn-sm btn-primary rounded-0" rel="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                  
                </div>
              </td>
            </tr>
            
<?php endforeach; ?>
 

<?php  endif; ?>            
              
             
            </tbody>
            </table>
 
<?php }else{ ?>

<div class="txt500 text-center p-4 bg-light">

No Requests Found

</div>
<?php } ?>
 
 
 
 
 
 
 <hr class="my-4" />
 
   <a href="admin.php?page=6&amp;exportall=2" class="btn btn-dark btn-sm">Export Order Data</a>
 
 
 
 
 
 
 
 
</div>



</div>

<div class="col-lg-3">





  
 <div class="bg-light p-4 mb-4" id="searchfilters">


<form action="" method="get">
<input type="hidden" name="submitted" value="no">
<input type="hidden" name="page" value="6">
<input type="hidden" name="tab" id="ShowTab" value="tab-orders">



 <script>jQuery(function(){ jQuery('#orders_date1').datetimepicker({pickTime: false}); jQuery('#orders_date2').datetimepicker({pickTime: false});}); </script>

   
<div class="row mb-1">
<div class="col-md-12">

<label class="small text-uppercase mt-3">Keyword</label>
  
	 <input name="s_k" class="form-control" />
     
 </div>
 
<div class="col-md-12">


<label class="small text-uppercase mt-3">Date (from) </label>
  
	 <div class="input-group" id="orders_date1" data-date-format="yyyy-MM-dd" style="cursor:pointer">
                    <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fal fa-calendar"></i></span></span>
                    <input type="text" name="s_d1" value="<?php if(!isset($_GET['s_d1'])){ echo date('Y-m-d' , strtotime('-365 days')); }else{ echo $_GET['s_d1']; } ?>" id="date1"  data-format="yyyy-MM-dd" class="form-control" style="font-size:12px;" />
     </div> 
      
</div>
 
<div class="col-md-12">


<label class="small text-uppercase mt-3">Date (to) </label>
  
  
 	<div class="input-group" id="orders_date2" data-date-format="yyyy-MM-dd" style="cursor:pointer">
                    <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fal fa-calendar"></i></span></span>
                    <input type="text" name="s_d2" value="<?php if(!isset($_GET['s_d2'])){ echo date('Y-m-d' , strtotime('+1 days'));  }else{ echo $_GET['s_d2']; } ?>" id="date2"  data-format="yyyy-MM-dd" class="form-control" style="font-size:12px;"  />
                    </div> 
 
 </div>

 


 

<div class="col-md-12">
<label class="small text-uppercase mt-3">Order Type</label><br />
  <select class="form-control" name="s_d8">
  <option></option>

<?php
// ORDER TYPE
if(!isset($_GET['s_d8'])){ $_GET['s_d8'] = ""; }
$ordertype = $CORE->orders_get_type();
foreach($ordertype as $k => $n){
?>
<option value="<?php echo $k; ?>" <?php selected( $_GET['s_d8'], $k ); ?>><?php echo $n['name']; ?></option>
<?php } ?>
</select>
</div>

<div class="col-md-12">
 
 <label class="small text-uppercase mt-3">Order Status</label><br />
  <select class="form-control" name="s_d3">
  <option></option>
  
<?php
// ORDER STATUS
if(!isset($_GET['s_d3'])){ $_GET['s_d3'] = ""; }
$orderstatus = $CORE->order_get_status();
foreach($orderstatus as $k => $n){
?>
<option value="<?php echo $k; ?>" <?php selected( $_GET['s_d3'], $k ); ?>><?php echo $n['name']; ?></option>
<?php } ?>
</select>
</div>

<div class="col-md-12">
 
 <label class="small text-uppercase mt-3">Min Amount</label><br />
<input placeholder="" name="s_d4" class="form-control" value="<?php if(isset($_GET['s_d4']) && is_numeric($_GET['s_d4'])){ echo $_GET['s_d4']; }else{ echo 0; }?>" />
</div>

<div class="col-md-12">
 
 <label class="small text-uppercase mt-3">Max Amount</label><br />
<input placeholder="" name="s_d5" class="form-control" value="<?php if(isset($_GET['s_d5']) && is_numeric($_GET['s_d5'])){ echo $_GET['s_d5']; }else{ echo 1000; }?>" />
</div>


 
 
<div class="col-md-12">
 
 <button class="btn btn-primary btn-block rounded-0 py-3 float-right px-3 mt-3" type="submit">Search Orders</button> 

</div></div>

 
</form>

</div> 

      

</div>
 
      
            
</div>

<script language="javascript">
jQuery(window).load(function(){
jQuery('.confirm').click(function(e)
{
    if(confirm("Are you sure?"))
    {
       
	
    }
    else
    {
		 alert('Phew! That was close!');
        e.preventDefault();
    }
});
});
</script>   