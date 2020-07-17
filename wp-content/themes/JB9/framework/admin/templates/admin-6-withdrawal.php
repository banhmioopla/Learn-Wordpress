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
 

// GET ITESM PER PAGE
if(isset($_GET['ipp']) && is_numeric($_GET['ipp']) && (isset($_GET['tab']) && $_GET['tab'] == "widthdrawal") ){
	$ITEMSPERPAGE = $_GET['ipp'];
}elseif(isset($_GET['ipp']) && $_GET['ipp'] == "All" && (isset($_GET['tab']) && $_GET['tab'] == "widthdrawal")){
	$ITEMSPERPAGE = 500;
}else{
	$ITEMSPERPAGE = 20;
}

// GET ROWS
if(isset($_GET['cpage']) && $_GET['cpage'] > 1 && (isset($_GET['tab']) && $_GET['tab'] == "widthdrawal")){
	$pstop = $ITEMSPERPAGE;
	$pint = $_GET['cpage']-1;
	$pstart = ($ITEMSPERPAGE*$pint);
}else{
	$pstop = $ITEMSPERPAGE;
	$pstart =0;
}

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

 

<div class="card rounded-0" style="border:0px;">

<div class="card-body"> 
<form action="" method="get" style="margin-bottom:0px; margin-top:10px;">
<input type="hidden" name="submitted" value="no">
<input type="hidden" name="page" value="6">
<input type="hidden" name="tab" id="ShowTab" value="tab-cashout">
 <script>jQuery(function(){ jQuery('#widthdraw_date1').datetimepicker({pickTime: false}); jQuery('#widthdraw_date2').datetimepicker({pickTime: false});}); </script>

   
<div class="row">
 
  <div class="col-md-4">
  
	 <input placeholder="Keyword.." name="s_k" class="form-control" />
     
 </div>
 
 <div class="col-md-4">
 
  <div class="input-group"  id="widthdraw_date1" data-date-format="yyyy-MM-dd" style="cursor:pointer">
                    <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fal fa-calendar"></i></span></span>
                  <input type="text" name="s_d1" value="<?php if(!isset($_GET['s_d1'])){ echo date('Y-m-d' , strtotime('-7 days')); }else{ echo $_GET['s_d1']; } ?>"  data-format="yyyy-MM-dd" class="form-control" />
     </div> 
     
  
 
 </div>
 <div class="col-md-4">
 
 
  <div class="input-group"  id="widthdraw_date2" data-date-format="yyyy-MM-dd" style="cursor:pointer">
                    <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fal fa-calendar"></i></span></span>
                 <input type="text" name="s_d2" value="<?php if(!isset($_GET['s_d2'])){ echo date('Y-m-d' , strtotime('+1 days'));  }else{ echo $_GET['s_d2']; } ?>"  data-format="yyyy-MM-dd" class="form-control"/>
     </div> 
  
 	 
 
 </div>
 
  <div class="col-md-12 mt-3">
  
  <button class="btn btn-dark px-3 rounded-0 mt-3" type="submit">Search Requests</button>
  
  </div> 
 
 </div>
 
 
 </form>
 
 </div></div>

<hr />

<table  class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
            <thead>
            <tr>
              <th class="no_sort">               
              </th>
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
	<a href="<?php echo home_url()."/wp-admin/"; ?>user-edit.php?user_id=<?php echo $wd->user_id; ?>" target="_blank"><?php echo get_avatar($wd->user_id); ?></a>
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

<div class="clearfix"></div>  

<hr /> 

<div class="pull-left"> 

<p><small>Total Items: <?php echo $TOTALITEMS; ?></small></p> <div class="clearfix"></div> 

Showing Page <?php if(!isset($_GET['cpage'])){ echo 1; }else{ echo $_GET['cpage']; } ?> of <?php if($TOTALPAGES == 0){ echo 1; }else{ echo $TOTALPAGES; } ?> 

</div>
           
        
<div class="pagination pull-right ">

<ul>
<?php
$pages = new wlt_admin_paginator;
$pages->items_total = $TOTALITEMS;
$pages->items_per_page = $ITEMSPERPAGE;
$pages->mid_range = 50;
$pages->pagelink = home_url()."/wp-admin/admin.php?tab=widthdrawal&".$_SERVER['QUERY_STRING'];
$pages->paginate();
echo $pages->display_pages();
?>
</ul>
</div>

<div class="clearfix"></div>
        
 