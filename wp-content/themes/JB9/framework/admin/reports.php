<?php
   // CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   // SETUP GLOBALS
   global $wpdb, $CORE, $userdata;
   
   if(isset($_GET['deleteallactvity']) && $_GET['deleteallactvity'] == 1){
   
   	 // COUNT HOW MANY MESSAGES USER HAS UNREAD
   	$SQL = "TRUNCATE ".$wpdb->prefix."core_log";
   	$result = $wpdb->get_results($SQL); 
   	
   	$GLOBALS['error_message'] = "All Activity Deleted";
   
   }
   
   $count_posts 	= wp_count_posts(THEME_TAXONOMY.'_type'); 
   $count_users	= count_users();
   $order_total 	= $wpdb->get_row("SELECT sum(order_total) AS total FROM ".$wpdb->prefix."core_orders");
   
   
   
   function createDateRangeArray($strDateFrom,$strDateTo) {
   
    $aryRange=array();
   
     $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
     $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
   
     if ($iDateTo>=$iDateFrom) {
       array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
   
       while ($iDateFrom<$iDateTo) {
         $iDateFrom+=86400; // add 24 hours
         array_push($aryRange,date('Y-m-d',$iDateFrom));
       }
     }
     return $aryRange;
   }
    
   function wlt_chartdata($query=0,$return=false){ global $wpdb; $STRING = "";
   
   if(isset($_GET['df1'])){ 
   $day_offset = $_GET['df1']; 
    
   }else{ 
   $day_offset = 0; 
    
   }
   	 
   	$DATE1 = date("Y-m-d",mktime(0, 0, 0, date("m") , date("d")-($day_offset + 5), date("Y"))); // 
   	$DATE2 = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")-$day_offset, date("Y")));	
   	
   	//if(!isset($GLOBALS['dateset'])){
   	$date_output = date("jS \of F", strtotime($DATE1) )." - ".date("jS \of F", strtotime( $DATE2 ) );
   	//$GLOBALS['dateset']=1;
   	//}
   	$dates = createDateRangeArray($DATE1,$DATE2); 
   	$newdates = array();
   	foreach($dates as $date){	  
   	 $newdates[''.$date.''] = 0;
   	}
    
   	if($return){ return $newdates; }
    
   	// GET ALL DATA FOR THE LAST 31 DAYS
   	if($query == 0){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date from ".$wpdb->prefix."posts where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' GROUP BY ID";
   	}elseif($query == 1){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date,".$wpdb->prefix."postmeta.meta_value from ".$wpdb->prefix."posts LEFT JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."postmeta.meta_key = 'PackageID'  AND ".$wpdb->prefix."postmeta.meta_value='1' GROUP BY ID";
   	}elseif($query == 2){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date,".$wpdb->prefix."postmeta.meta_value from ".$wpdb->prefix."posts LEFT JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."postmeta.meta_key = 'PackageID'  AND ".$wpdb->prefix."postmeta.meta_value='2' GROUP BY ID";
   	}elseif($query == 3){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date,".$wpdb->prefix."postmeta.meta_value from ".$wpdb->prefix."posts LEFT JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."postmeta.meta_key = 'PackageID'  AND ".$wpdb->prefix."postmeta.meta_value='3' GROUP BY ID";
   	}elseif($query == 4){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date,".$wpdb->prefix."postmeta.meta_value from ".$wpdb->prefix."posts LEFT JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."postmeta.meta_key = 'PackageID'  AND ".$wpdb->prefix."postmeta.meta_value='4' GROUP BY ID";
   	}elseif($query == 5){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date,".$wpdb->prefix."postmeta.meta_value from ".$wpdb->prefix."posts LEFT JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."postmeta.meta_key = 'PackageID'  AND ".$wpdb->prefix."postmeta.meta_value='5' GROUP BY ID";
   	}elseif($query == 6){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date,".$wpdb->prefix."postmeta.meta_value from ".$wpdb->prefix."posts LEFT JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."postmeta.meta_key = 'PackageID'  AND ".$wpdb->prefix."postmeta.meta_value='6' GROUP BY ID";
   	}elseif($query == 7){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date,".$wpdb->prefix."postmeta.meta_value from ".$wpdb->prefix."posts LEFT JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."postmeta.meta_key = 'PackageID'  AND ".$wpdb->prefix."postmeta.meta_value='7' GROUP BY ID";
   	}elseif($query == 8){
   	$SQL1 = "select ".$wpdb->prefix."posts.post_date,".$wpdb->prefix."postmeta.meta_value from ".$wpdb->prefix."posts LEFT JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) where ".$wpdb->prefix."posts.post_date >= '".$DATE1."' and ".$wpdb->prefix."posts.post_date < '".$DATE2."' AND ".$wpdb->prefix."posts.post_type='".THEME_TAXONOMY."_type' AND ".$wpdb->prefix."postmeta.meta_key = 'PackageID'  AND ".$wpdb->prefix."postmeta.meta_value='8' GROUP BY ID";
   	
   	}elseif($query == 9){
   	$SQL1 = "SELECT order_date AS post_date FROM ".$wpdb->prefix."core_orders LEFT JOIN ".$wpdb->users." ON (".$wpdb->users.".ID = ".$wpdb->prefix."core_orders.user_id) WHERE ".$wpdb->prefix."core_orders.order_date >= '".$DATE1."' and ".$wpdb->prefix."core_orders.order_date <= '".$DATE2."'";
   	
   	}elseif($query == 10){
   	$SQL1 = "SELECT user_registered AS post_date FROM ".$wpdb->users." WHERE STR_TO_DATE( ".$wpdb->users.".user_registered,'%Y-%m-%d')  >= '".$DATE1."' and STR_TO_DATE( ".$wpdb->users.".user_registered,'%Y-%m-%d')  <= '".$DATE2."'";
   		
   	}
   	
    
     
   	$result = $wpdb->get_results($SQL1);
    	if(!$result){ return array("values" => "0,0,0,0,0,0", "labels" => '"Tue", "Wed", "Thu", "Fri", "Sat", "Sun"', "dates" => $date_output ); }
    
   	foreach($result as $value){	 
   	  $postDate = explode(" ",$value->post_date);	 
   		$newdates[$postDate[0]] ++;
   	}	
   	
   	  
   	// FORMAT RESULTS FOR CHART	
   	$i=1;  $LABELS = ""; $VALUES = "";
   	
   	 
   	foreach($newdates as $key=>$val){
   	 
   		$a = $key; 
   		if(!is_numeric($val)){$val=0; }
   		 	
   		$VALUES .= ''.$val.', '; //'.$i.',
   		$LABELS .= '"'.substr(date('l', strtotime($key)),0,3) .'", '; //'.$i.',
   		
   		
   		
   		$i++;		 
   	}
    
    
   	// RETURN DATA	
   	return array("values" => substr($VALUES,0, -2), "labels" => $LABELS, "dates" => $date_output );
    
   }
      
     
     // GET CHART DATA
     $a = wlt_chartdata(0);
     $b = wlt_chartdata(9);
     $c = wlt_chartdata(10);
     
   
     
     // GET NAV OFFSET
     if(!isset($_GET['df1'])){
     $offset_1 = 5;
     $offset_2 = 0;  
     }else{ 
     $offset_1 = $_GET['df1'] + 5;
     $offset_2 = $_GET['df1'] - 5;  
     }
   ?> 
<style>

   .ct-chart { padding-bottom:50px;     margin-left: -30px; margin-right:-30px; }
   .ct-legend {   margin: 0px;    z-index: 10;  position: absolute;    left: 50px;    bottom: 0px;  }
   .ct-legend li {   position: relative;        padding-left: 23px;        margin-bottom: 3px;   cursor:pointer;   }
   .ct-legend li:before { width: 12px;   height: 12px;  position: absolute;  left: 0;   content: '';   border: 3px solid transparent;  border-radius: 2px; margin-top: 8px; }
   .ct-legend li.inactive:before {        background: transparent; }
   .ct-legend-inside {        position: absolute;        top: 0;        right: 0;    }
   .ct-series-0:before {  background-color: green;  border-color: green; }
   .ct-series-a .ct-bar, .ct-series-a .ct-line, .ct-series-a .ct-point, .ct-series-a .ct-slice-donut {
   stroke: green;
   }
   .ct-series-1 { left:150px; bottom:25px; }
   .ct-series-2 { left:300px;bottom:50px;  }
   .ct-series-1:before {  background-color: #f05b4f;  border-color: #f05b4f; }
   .ct-series-2:before {  background-color: #f4c63d;  border-color: #f4c63d; }
   .cart-nav { position:absolute;  right:50px; top:50px; }
   .cart-nav  .nn {     padding: 0px;     width: 20px; height:20px;    text-align: center; margin-left: -45px;   }
   .cart-nav  .chart-pre {     float: right;    margin-top: -20px; margin-left:-10px; }
   .cart-nav  i {  color:#fff; }
</style>
<div class="row">
   <div class="col-xl-3 col-md-6 col-12 mb-3">
      <div class="dashbox bg-danger clearfix shadow">
         <div class="inner icon1">
            <span class="num"><?php echo $count_users['total_users']; ?></span>
            <div class="txt">Users</div>
         </div>
         <a href="users.php">
            <div class="top">View All Users</div>
         </a>
      </div>
      <!-- end dashbox 1-->
   </div>
   <div class="col-xl-3 col-md-6 col-12 mb-3">
      <div class="dashbox bg-warning clearfix shadow">
         <div class="inner icon2">
            <span class="num"><?php if(!isset($order_total->total)){ echo 0; }else{ if($order_total->total < 1){ echo "0"; }else{ echo hook_price(round($order_total->total,2)); } } ?></span>
            <div class="txt">Sales</div>
         </div>
         <a href="admin.php?page=6">
            <div class="top">View All Orders</div>
         </a>
      </div>
      <!-- end dashbox 2-->
   </div>
   <div class="col-xl-3 col-md-6 col-12 mb-3">
      <div class="dashbox bg-success clearfix shadow">
         <div class="inner icon3">
            <span class="num"><?php echo number_format($count_posts->publish+$count_posts->draft+$count_posts->pending+$count_posts->trash,0); ?></span>
            <div class="txt">Listings</div>
         </div>
         <a href="edit.php?post_type=listing_type">
            <div class="top">View All Listings</div>
         </a>
      </div>
      <!-- end dashbox 3 -->
   </div>
   <div class="col-xl-3 col-md-6 col-12 mb-3">
      <div class="dashbox bg-primary clearfix shadow">
         <div class="inner icon4">
            <span class="num"><?php 
               $saved_searches_array = get_option('recent_searches');
               if(!is_array($saved_searches_array)){ $saved_searches_array = array(); }
               echo number_format(count($saved_searches_array)); ?></span>
            <div class="txt">Searches</div>
         </div>
         <a href="#topsearches">
            <div class="top">View All Searches</div>
         </a>
      </div>
      <!-- end dashbox 3 -->
   </div>
</div>
<div class="mt-5">
<div class="row">
<div class="col-md-6 mb-4">
   <div class="bg-white shadow" style="border-radius: 7px;; min-height:600px; position:relative;">
      <div class="p-5 pb-2">
         <div class="row border-bottom mb-4">
            <div class="col-2">
               <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/11.png" class=" mb-4" width="48" />
            </div>
            <div class="col-10">
            
               <h4 class="mb-1">Activity Feed</h4>
               <p style="font-size:12px;" class="text-muted">Here you can see events triggered on your website.</p>
            </div>
         </div>
         <?php
		       
             // COUNT HOW MANY MESSAGES USER HAS UNREAD
            $SQL = "SELECT * FROM ".$wpdb->prefix."core_log WHERE type !='cron' ORDER BY autoid DESC LIMIT 100";
			 
            $result = $wpdb->get_results($SQL); 
		         
            // SET LAST VIEWED TIME
            update_option('ppt_activity_lastviewed', $CORE->DATETIME() );
            
            if(!empty($result)){
            ?> 
         <div style="height:400px; overflow-x:scroll; margin-right:-30px;">
            <?php
			
			
               foreach( $result as $log ) {
			   
			 
				   switch($log->type){
				   
				   case "newbid":
				   case "auctionre":
				   case "auctionwon":
				   case "auctionend": {
						
						 ?> 
            <div class="mb-4 clearfix" style="border-left:5px solid #4528a7;">
            <div class="pl-3">
                
                <div class="float-left"><h5><?php echo $log->message; ?></h5></div>
                <div class="text-muted small float-right pr-2"><?php echo hook_date($log->datetime); ?></div>
                
                <div class="clearfix"></div>
                
                <div class="mt-2 text-muted small">
               
                
               
               <?php if($log->type == "auctionre"){ ?>
               
               <a href="<?php echo get_permalink($log->postid); ?>"><?php echo $log->data; ?></a> was relisted because it did not sell.
               
                <?php }elseif($log->type == "newbid"){ ?>
               
               <?php echo hook_price($log->data); ?> on <a href="<?php echo get_permalink($log->postid); ?>"><?php echo get_the_title($log->postid); ?></a> 
               by <a href="user-edit.php?user_id=<?php echo $log->userid; ?>" target="_blank"><?php echo $CORE->user_display_name($log->userid); ?></a>  (<?php echo $log->link; ?>)
              
               
               <?php }else{ ?>               
               
               <a href="<?php echo get_permalink($log->postid); ?>"><?php echo $log->data; ?></a> - <?php echo $log->link; ?> 
               
               <?php } ?>
                
                </div>
              
            </div>
            </div>
            <?php
				   
			} break;
				   
						case "feedback": {
						
						 ?> 
            <div class="mb-4 clearfix" style="border-left:5px solid #29d676;">
            <div class="pl-3">
                
                <div class="float-left"><h5><?php echo $log->message; ?></h5></div>
                <div class="text-muted small float-right pr-2"><?php echo hook_date($log->datetime); ?></div>
                
                <div class="clearfix"></div>
                
                <div class="mt-2 text-muted small">
               
               by <a href="user-edit.php?user_id=<?php echo $log->userid; ?>" target="_blank"><?php echo $CORE->user_display_name($log->userid); ?></a> 
               <?php if( is_numeric($log->data) ){ ?>
               for user <a href="user-edit.php?user_id=<?php echo $log->data; ?>" target="_blank"><?php echo $CORE->user_display_name($log->data); ?></a> 
               <?php } ?> 
                
                </div>
              
            </div>
            </div>
            <?php
				   
			} break;
				   
						case "listing": {
						
						 ?> 
            <div class="mb-4 clearfix" style="border-left:5px solid #8829d6;">
            <div class="pl-3">
                
                <div class="float-left"><h5><?php echo $log->message; ?></h5></div>
                <div class="text-muted small float-right pr-2"><?php echo hook_date($log->datetime); ?></div>
                
                <div class="clearfix"></div>
                
                <div class="mt-2 text-muted small">
               
               <?php echo $log->link; ?>  by <a href="user-edit.php?user_id=<?php echo $log->userid; ?>" target="_blank"><?php echo $CORE->user_display_name($log->userid); ?></a> 
                
                
                </div>
              
            </div>
            </div>
            <?php
				   
			} break;				    
						case "account": {
						
						 ?> 
            <div class="mb-4 clearfix" style="border-left:5px solid #297dd6;">
            <div class="pl-3">
                
                <div class="float-left"><h5><?php echo $log->message; ?></h5></div>
                <div class="text-muted small float-right pr-2"><?php echo hook_date($log->datetime); ?></div>
                
                <div class="clearfix"></div>
                
                <div class="mt-2 text-muted small">
               
              <a href="user-edit.php?user_id=<?php echo $log->userid; ?>" target="_blank"><?php echo $CORE->user_display_name($log->userid); ?></a> logged into their account.
                
                
                </div>
              
            </div>
            </div>
            <?php
				   
			} break;
						case "sms":
						case "email": {
						
						 ?> 
            <div class="mb-4 clearfix" <?php if($log->type =="sms"){ ?>style="border-left:5px solid orange;"<?php  }elseif($log->link == "error"){ ?>style="background: #ececec;    padding: 10px;" <?php }else{ ?>style="border-left:5px solid green;"<?php } ?>>
            <div class="pl-3">
                
                <div class="float-left"><h5><?php echo $log->message; ?></h5></div>
                <div class="text-muted small float-right pr-2"><?php echo hook_date($log->datetime); ?></div>
                
                <div class="clearfix"></div>
                
                <div class="mt-2 text-muted small">
               
                <?php if($log->link == "error"){ ?>
                no email setup for  <a href="admin.php?page=3" target="_blank"><?php echo $log->data; ?></a>.
                <?php }else{ ?>
                <?php echo $log->link; ?>
                <?php } ?>
                </div>
              
            </div>
            </div>
            <?php
						} break;
						case "invoice":
						case "comission":
						case "comission1":
						case "order": {
						
						 ?> 
            <div class="mb-4 clearfix" style="border-left:5px solid #f4c63d;">
            <div class="pl-3">
                
                <div class="float-left"><h5><?php echo $log->message; ?></h5></div>
                <div class="text-muted small float-right pr-2"><?php echo hook_date($log->datetime); ?></div>
                
                <div class="clearfix"></div>
                
                <div class="mt-2 text-muted small">
                
                <?php echo hook_price($log->data); ?>
                
                <?php if($log->type == "comission1"){ ?>
                deducted from user account <a href="user-edit.php?user_id=<?php echo $log->userid; ?>" target="_blank"><?php echo $CORE->user_display_name($log->userid); ?></a>.
                <?php } ?>
                
                 <?php if($log->type == "comission"){ ?>
                credited to user account <a href="user-edit.php?user_id=<?php echo $log->userid; ?>" target="_blank"><?php echo $CORE->user_display_name($log->userid); ?></a>.
                <?php } ?>
                
                <?php if($log->type == "order"){ ?>
                - #<?php echo hook_orderid($log->link); ?> - <a href="<?php echo THEME_URI; ?>/_invoice.php?invoiceid=<?php echo $log->link; ?>" target="_blank">View Invoice</a>.
                <?php } ?>
                
                </div>
              
            </div>
            </div>
            <?php
				 
						} break;				
						default: {
						 
			   
               ?> 
            <div class="mb-3 p-2 clearfix">
               <div class="label bg-danger text-white float-left <?php echo $log->link; ?>" style="margin:-10px -10px;  width:25px; text-align:center; margin-right:20px;">
                  <?php echo $log->autoid; ?>
               </div>
               <div class="float-left" style="margin-top:-15px;"> 
                  <?php
                     $logmessage = ""; $plink = ""; $ulink = "";
                     if($log->postid != ""){ 	$plink = get_permalink($log->postid); }
                     if($log->userid != ""){ $ulink = 'user-edit.php?user_id='.$log->userid; }
                     
                     $logmessage .= str_replace("(plink)",$plink, str_replace("(ulink)",$ulink,$log->message));
                     echo "<span class='txt500'>".$logmessage."</span> <div style='font-size:11px;' class='text-muted'>".hook_date($log->datetime)."</div>"; ?>
               </div>
            </div>
            
            <?php
			
				} break;
				   
				   }
			?>
            
            <div class="clearfix"></div>
            <?php }  ?>
         </div>
         <?php }else{ ?>
         <div class="card-body text-center txt500">No activity recorded.</div>
         <?php } ?>
      </div>
      <div class="btnbox bg-light text-center p-3 py-4 border-top" style="border-bottom-left-radius: 7px; position:absolute; bottom:0; width:100%;">
            
              <a href="admin.php?page=13&tab=tab-a1&deleteallactvity=1" class="btn btn-dark">Reset Logs</a>
            
            </div>
   </div>
</div>
<div class="col-md-6">
   <div style="position:relative;  border-radius: 7px;overflow:hidden;" class="clearfix shadow">
   
   
      <div class="p-5 pb-2">
         <div class="row border-bottom mb-4">
            <div class="col-2">
               <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/10.png" class=" mb-4" width="48"  />
            </div>
            <div class="col-10">
            
               <h4 class="mb-1">Website Overview</h4>
               <p class="text-muted"><?php echo $c['dates']; ?></p>
            </div>
         </div>
   
      <div class="cart-nav float-right">
         <div class="nn chart-next"><a href="admin.php?page=13&df1=<?php echo $offset_1; ?>" class="btn btn-sm btn-dark m-r-1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></div>
         <div class="nn chart-pre"><a href="admin.php?page=13&df1=<?php echo $offset_2; ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></div>
      </div>
    
      <div class="ct-chart"></div>
   </div>
</div></div>
<!-- end col 6 -->  
<div class="col-6">


<div style="position:relative;  border-radius: 7px;overflow:hidden; min-height:300px;" class="clearfix shadow mt-5 p-5">
   
   <div class="row border-bottom mb-4">
      <div class="col-md-2">
         <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/12.png" class=" mb-4" width="48"  />
      </div>
      <div class="col-md-10">
         <h4 class="mb-1">New Members</h4>
         <p class="text-muted">The latest members who have joined your website.</p>
      </div>
   </div>
   <?php
      // Query for users based on the meta data
      $user_query = new WP_User_Query(
      	array(
      		'orderby'	  =>	'registered',
      		'order' => 'desc',
      	 	'number'    => 30,
      	)
      );
      
      // Get the results from the query, returning the first user
      $users = $user_query->get_results();
      
      if(!empty($users)){
      foreach($users as $user){
      
      
      ?>
   <div class="badge p-1 px-2 shadow-sm mb-3" style="border-radius:4px; margin-right:10px; border:1px solid #ccc;">
      <a href="user-edit.php?user_id=<?php echo $user->data->ID; ?>" rel="tooltip" data-original-title="User ID <?php echo $user->data->ID; ?>" data-placement="top" >
      <?php echo str_replace("avatar ","avatar img-fluid ",get_avatar( $user->data->ID, 25 )); ?>
      </a>
      <a href="user-edit.php?user_id=<?php echo $user->data->ID; ?>"  rel="tooltip"  data-original-title="Joined <?php echo hook_date($user->data->user_registered); ?>" data-placement="top" class="ml-2">
      <?php echo $CORE->user_display_name($user->data->ID); ?>
      </a>
   </div>
   <?php } } ?>  
</div>
</div>

<div class="col-6">

<div style="position:relative;  border-radius: 7px;overflow:hidden; min-height:300px;" class="clearfix shadow mt-5 p-5">

 
   <div class="row border-bottom mb-4" id="topsearches">
      <div class="col-md-2">
         <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/13.png" class=" mb-4" width="48"  />
      </div>
      <div class="col-md-10">
         <h4 class="mb-1">Top Searches</h4>
         <p class="text-muted">Top website search queries your members are using.</p>
      </div>
   </div>
   <?php
      $saved_searches_array = get_option('recent_searches');
      if(is_array($saved_searches_array) && !empty($saved_searches_array) ){ 
      
      $saved_searches_array = $CORE->multisort( $saved_searches_array, array('views') );
      $saved_searches_array = array_reverse($saved_searches_array, true);
      
      $f=1; 
      foreach($saved_searches_array  as $key=>$searchdata){
      if($f > 30){ continue; }      
          
          ?>
   <div class="badge p-1 px-2 shadow-sm mb-3" style="border-radius:4px; margin-right:10px; border:1px solid #ccc;">
      <a href="<?php echo get_home_url(); ?>/?s=<?php echo str_replace("_"," ",$key); ?>" target="_blank"><?php echo str_replace("_"," ",$key); ?></a>
      <span>(<?php echo $searchdata['views']; ?>)</span>
   </div>
   <?php  $f++; } } ?> 
</div>
</div>

<style>


.userphoto { max-width:20px; max-height:20px; }


   .ct-double-octave:after,.ct-major-eleventh:after,.ct-major-second:after,.ct-major-seventh:after,.ct-major-sixth:after,.ct-major-tenth:after,.ct-major-third:after,.ct-major-twelfth:after,.ct-minor-second:after,.ct-minor-seventh:after,.ct-minor-sixth:after,.ct-minor-third:after,.ct-octave:after,.ct-perfect-fifth:after,.ct-perfect-fourth:after,.ct-square:after{content:"";clear:both}.ct-label{ color:#666;font-size:.75rem;line-height:1}.ct-grid-background,.ct-line{fill:none}.ct-chart-bar .ct-label,.ct-chart-line .ct-label{display:block;display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-webkit-flex;display:flex}.ct-chart-donut .ct-label,.ct-chart-pie .ct-label{dominant-baseline:central}.ct-label.ct-horizontal.ct-start{-webkit-box-align:flex-end;-webkit-align-items:flex-end;-ms-flex-align:flex-end;align-items:flex-end;-webkit-box-pack:flex-start;-webkit-justify-content:flex-start;-ms-flex-pack:flex-start;justify-content:flex-start;text-align:left;text-anchor:start}.ct-label.ct-horizontal.ct-end{-webkit-box-align:flex-start;-webkit-align-items:flex-start;-ms-flex-align:flex-start;align-items:flex-start;-webkit-box-pack:flex-start;-webkit-justify-content:flex-start;-ms-flex-pack:flex-start;justify-content:flex-start;text-align:left;text-anchor:start}.ct-label.ct-vertical.ct-start{-webkit-box-align:flex-end;-webkit-align-items:flex-end;-ms-flex-align:flex-end;align-items:flex-end;-webkit-box-pack:flex-end;-webkit-justify-content:flex-end;-ms-flex-pack:flex-end;justify-content:flex-end;text-align:right;text-anchor:end}.ct-label.ct-vertical.ct-end{-webkit-box-align:flex-end;-webkit-align-items:flex-end;-ms-flex-align:flex-end;align-items:flex-end;-webkit-box-pack:flex-start;-webkit-justify-content:flex-start;-ms-flex-pack:flex-start;justify-content:flex-start;text-align:left;text-anchor:start}.ct-chart-bar .ct-label.ct-horizontal.ct-start{-webkit-box-align:flex-end;-webkit-align-items:flex-end;-ms-flex-align:flex-end;align-items:flex-end;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;text-align:center;text-anchor:start}.ct-chart-bar .ct-label.ct-horizontal.ct-end{-webkit-box-align:flex-start;-webkit-align-items:flex-start;-ms-flex-align:flex-start;align-items:flex-start;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;text-align:center;text-anchor:start}.ct-chart-bar.ct-horizontal-bars .ct-label.ct-horizontal.ct-start{-webkit-box-align:flex-end;-webkit-align-items:flex-end;-ms-flex-align:flex-end;align-items:flex-end;-webkit-box-pack:flex-start;-webkit-justify-content:flex-start;-ms-flex-pack:flex-start;justify-content:flex-start;text-align:left;text-anchor:start}.ct-chart-bar.ct-horizontal-bars .ct-label.ct-horizontal.ct-end{-webkit-box-align:flex-start;-webkit-align-items:flex-start;-ms-flex-align:flex-start;align-items:flex-start;-webkit-box-pack:flex-start;-webkit-justify-content:flex-start;-ms-flex-pack:flex-start;justify-content:flex-start;text-align:left;text-anchor:start}.ct-chart-bar.ct-horizontal-bars .ct-label.ct-vertical.ct-start{-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:flex-end;-webkit-justify-content:flex-end;-ms-flex-pack:flex-end;justify-content:flex-end;text-align:right;text-anchor:end}.ct-chart-bar.ct-horizontal-bars .ct-label.ct-vertical.ct-end{-webkit-box-align:center;-webkit-align-items:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:flex-start;-webkit-justify-content:flex-start;-ms-flex-pack:flex-start;justify-content:flex-start;text-align:left;text-anchor:end}.ct-grid{stroke:#ddd;stroke-width:1px;stroke-dasharray:2px}.ct-point{stroke-width:10px;stroke-linecap:round}.ct-line{stroke-width:4px}.ct-area{stroke:none;fill-opacity:.1}.ct-bar{fill:none;stroke-width:10px}.ct-slice-donut{fill:none;stroke-width:60px}.ct-series-a .ct-bar,.ct-series-a .ct-line,.ct-series-a .ct-point,.ct-series-a .ct-slice-donut{stroke:#d70206}.ct-series-a .ct-area,.ct-series-a .ct-slice-pie{fill:#d70206}.ct-series-b .ct-bar,.ct-series-b .ct-line,.ct-series-b .ct-point,.ct-series-b .ct-slice-donut{stroke:#f05b4f}.ct-series-b .ct-area,.ct-series-b .ct-slice-pie{fill:#f05b4f}.ct-series-c .ct-bar,.ct-series-c .ct-line,.ct-series-c .ct-point,.ct-series-c .ct-slice-donut{stroke:#f4c63d}.ct-series-c .ct-area,.ct-series-c .ct-slice-pie{fill:#f4c63d}.ct-series-d .ct-bar,.ct-series-d .ct-line,.ct-series-d .ct-point,.ct-series-d .ct-slice-donut{stroke:#d17905}.ct-series-d .ct-area,.ct-series-d .ct-slice-pie{fill:#d17905}.ct-series-e .ct-bar,.ct-series-e .ct-line,.ct-series-e .ct-point,.ct-series-e .ct-slice-donut{stroke:#453d3f}.ct-series-e .ct-area,.ct-series-e .ct-slice-pie{fill:#453d3f}.ct-series-f .ct-bar,.ct-series-f .ct-line,.ct-series-f .ct-point,.ct-series-f .ct-slice-donut{stroke:#59922b}.ct-series-f .ct-area,.ct-series-f .ct-slice-pie{fill:#59922b}.ct-series-g .ct-bar,.ct-series-g .ct-line,.ct-series-g .ct-point,.ct-series-g .ct-slice-donut{stroke:#0544d3}.ct-series-g .ct-area,.ct-series-g .ct-slice-pie{fill:#0544d3}.ct-series-h .ct-bar,.ct-series-h .ct-line,.ct-series-h .ct-point,.ct-series-h .ct-slice-donut{stroke:#6b0392}.ct-series-h .ct-area,.ct-series-h .ct-slice-pie{fill:#6b0392}.ct-series-i .ct-bar,.ct-series-i .ct-line,.ct-series-i .ct-point,.ct-series-i .ct-slice-donut{stroke:#f05b4f}.ct-series-i .ct-area,.ct-series-i .ct-slice-pie{fill:#f05b4f}.ct-series-j .ct-bar,.ct-series-j .ct-line,.ct-series-j .ct-point,.ct-series-j .ct-slice-donut{stroke:#dda458}.ct-series-j .ct-area,.ct-series-j .ct-slice-pie{fill:#dda458}.ct-series-k .ct-bar,.ct-series-k .ct-line,.ct-series-k .ct-point,.ct-series-k .ct-slice-donut{stroke:#eacf7d}.ct-series-k .ct-area,.ct-series-k .ct-slice-pie{fill:#eacf7d}.ct-series-l .ct-bar,.ct-series-l .ct-line,.ct-series-l .ct-point,.ct-series-l .ct-slice-donut{stroke:#86797d}.ct-series-l .ct-area,.ct-series-l .ct-slice-pie{fill:#86797d}.ct-series-m .ct-bar,.ct-series-m .ct-line,.ct-series-m .ct-point,.ct-series-m .ct-slice-donut{stroke:#b2c326}.ct-series-m .ct-area,.ct-series-m .ct-slice-pie{fill:#b2c326}.ct-series-n .ct-bar,.ct-series-n .ct-line,.ct-series-n .ct-point,.ct-series-n .ct-slice-donut{stroke:#6188e2}.ct-series-n .ct-area,.ct-series-n .ct-slice-pie{fill:#6188e2}.ct-series-o .ct-bar,.ct-series-o .ct-line,.ct-series-o .ct-point,.ct-series-o .ct-slice-donut{stroke:#a748ca}.ct-series-o .ct-area,.ct-series-o .ct-slice-pie{fill:#a748ca}.ct-square{display:block;position:relative;width:100%}.ct-square:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:100%}.ct-square:after{display:table}.ct-square>svg{display:block;position:absolute;top:0;left:0}.ct-minor-second{display:block;position:relative;width:100%}.ct-minor-second:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:93.75%}.ct-minor-second:after{display:table}.ct-minor-second>svg{display:block;position:absolute;top:0;left:0}.ct-major-second{display:block;position:relative;width:100%}.ct-major-second:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:88.8888888889%}.ct-major-second:after{display:table}.ct-major-second>svg{display:block;position:absolute;top:0;left:0}.ct-minor-third{display:block;position:relative;width:100%}.ct-minor-third:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:83.3333333333%}.ct-minor-third:after{display:table}.ct-minor-third>svg{display:block;position:absolute;top:0;left:0}.ct-major-third{display:block;position:relative;width:100%}.ct-major-third:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:80%}.ct-major-third:after{display:table}.ct-major-third>svg{display:block;position:absolute;top:0;left:0}.ct-perfect-fourth{display:block;position:relative;width:100%}.ct-perfect-fourth:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:75%}.ct-perfect-fourth:after{display:table}.ct-perfect-fourth>svg{display:block;position:absolute;top:0;left:0}.ct-perfect-fifth{display:block;position:relative;width:100%}.ct-perfect-fifth:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:66.6666666667%}.ct-perfect-fifth:after{display:table}.ct-perfect-fifth>svg{display:block;position:absolute;top:0;left:0}.ct-minor-sixth{display:block;position:relative;width:100%}.ct-minor-sixth:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:62.5%}.ct-minor-sixth:after{display:table}.ct-minor-sixth>svg{display:block;position:absolute;top:0;left:0}.ct-golden-section{display:block;position:relative;width:100%}.ct-golden-section:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:61.804697157%}.ct-golden-section:after{content:"";display:table;clear:both}.ct-golden-section>svg{display:block;position:absolute;top:0;left:0}.ct-major-sixth{display:block;position:relative;width:100%}.ct-major-sixth:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:60%}.ct-major-sixth:after{display:table}.ct-major-sixth>svg{display:block;position:absolute;top:0;left:0}.ct-minor-seventh{display:block;position:relative;width:100%}.ct-minor-seventh:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:56.25%}.ct-minor-seventh:after{display:table}.ct-minor-seventh>svg{display:block;position:absolute;top:0;left:0}.ct-major-seventh{display:block;position:relative;width:100%}.ct-major-seventh:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:53.3333333333%}.ct-major-seventh:after{display:table}.ct-major-seventh>svg{display:block;position:absolute;top:0;left:0}.ct-octave{display:block;position:relative;width:100%}.ct-octave:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:50%}.ct-octave:after{display:table}.ct-octave>svg{display:block;position:absolute;top:0;left:0}.ct-major-tenth{display:block;position:relative;width:100%}.ct-major-tenth:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:40%}.ct-major-tenth:after{display:table}.ct-major-tenth>svg{display:block;position:absolute;top:0;left:0}.ct-major-eleventh{display:block;position:relative;width:100%}.ct-major-eleventh:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:37.5%}.ct-major-eleventh:after{display:table}.ct-major-eleventh>svg{display:block;position:absolute;top:0;left:0}.ct-major-twelfth{display:block;position:relative;width:100%}.ct-major-twelfth:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:33.3333333333%}.ct-major-twelfth:after{display:table}.ct-major-twelfth>svg{display:block;position:absolute;top:0;left:0}.ct-double-octave{display:block;position:relative;width:100%}.ct-double-octave:before{display:block;float:left;content:"";width:0;height:0;padding-bottom:25%}.ct-double-octave:after{display:table}.ct-double-octave>svg{display:block;position:absolute;top:0;left:0}
   .ct-horizontal { display:none; }
   .ct-grid {
   stroke: #ddd;
   stroke-width: 1px;
    
   }
   
</style>
<script> 
   !function(a,b){"function"==typeof define&&define.amd?define([],function(){return a.Chartist=b()}):"object"==typeof exports?module.exports=b():a.Chartist=b()}(this,function(){var a={version:"0.9.8"};return function(a,b,c){"use strict";c.namespaces={svg:"http://www.w3.org/2000/svg",xmlns:"http://www.w3.org/2000/xmlns/",xhtml:"http://www.w3.org/1999/xhtml",xlink:"http://www.w3.org/1999/xlink",ct:"http://gionkunz.github.com/chartist-js/ct"},c.noop=function(a){return a},c.alphaNumerate=function(a){return String.fromCharCode(97+a%26)},c.extend=function(a){a=a||{};var b=Array.prototype.slice.call(arguments,1);return b.forEach(function(b){for(var d in b)"object"!=typeof b[d]||null===b[d]||b[d]instanceof Array?a[d]=b[d]:a[d]=c.extend({},a[d],b[d])}),a},c.replaceAll=function(a,b,c){return a.replace(new RegExp(b,"g"),c)},c.ensureUnit=function(a,b){return"number"==typeof a&&(a+=b),a},c.quantity=function(a){if("string"==typeof a){var b=/^(\d+)\s*(.*)$/g.exec(a);return{value:+b[1],unit:b[2]||void 0}}return{value:a}},c.querySelector=function(a){return a instanceof Node?a:b.querySelector(a)},c.times=function(a){return Array.apply(null,new Array(a))},c.sum=function(a,b){return a+(b?b:0)},c.mapMultiply=function(a){return function(b){return b*a}},c.mapAdd=function(a){return function(b){return b+a}},c.serialMap=function(a,b){var d=[],e=Math.max.apply(null,a.map(function(a){return a.length}));return c.times(e).forEach(function(c,e){var f=a.map(function(a){return a[e]});d[e]=b.apply(null,f)}),d},c.roundWithPrecision=function(a,b){var d=Math.pow(10,b||c.precision);return Math.round(a*d)/d},c.precision=8,c.escapingMap={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"},c.serialize=function(a){return null===a||void 0===a?a:("number"==typeof a?a=""+a:"object"==typeof a&&(a=JSON.stringify({data:a})),Object.keys(c.escapingMap).reduce(function(a,b){return c.replaceAll(a,b,c.escapingMap[b])},a))},c.deserialize=function(a){if("string"!=typeof a)return a;a=Object.keys(c.escapingMap).reduce(function(a,b){return c.replaceAll(a,c.escapingMap[b],b)},a);try{a=JSON.parse(a),a=void 0!==a.data?a.data:a}catch(b){}return a},c.createSvg=function(a,b,d,e){var f;return b=b||"100%",d=d||"100%",Array.prototype.slice.call(a.querySelectorAll("svg")).filter(function(a){return a.getAttributeNS(c.namespaces.xmlns,"ct")}).forEach(function(b){a.removeChild(b)}),f=new c.Svg("svg").attr({width:b,height:d}).addClass(e).attr({style:"width: "+b+"; height: "+d+";"}),a.appendChild(f._node),f},c.normalizeData=function(a){if(a=a||{series:[],labels:[]},a.series=a.series||[],a.labels=a.labels||[],a.series.length>0&&0===a.labels.length){var b,d=c.getDataArray(a);b=d.every(function(a){return a instanceof Array})?Math.max.apply(null,d.map(function(a){return a.length})):d.length,a.labels=c.times(b).map(function(){return""})}return a},c.reverseData=function(a){a.labels.reverse(),a.series.reverse();for(var b=0;b<a.series.length;b++)"object"==typeof a.series[b]&&void 0!==a.series[b].data?a.series[b].data.reverse():a.series[b]instanceof Array&&a.series[b].reverse()},c.getDataArray=function(a,b,d){function e(a){if(!c.isFalseyButZero(a)){if((a.data||a)instanceof Array)return(a.data||a).map(e);if(a.hasOwnProperty("value"))return e(a.value);if(d){var b={};return"string"==typeof d?b[d]=c.getNumberOrUndefined(a):b.y=c.getNumberOrUndefined(a),b.x=a.hasOwnProperty("x")?c.getNumberOrUndefined(a.x):b.x,b.y=a.hasOwnProperty("y")?c.getNumberOrUndefined(a.y):b.y,b}return c.getNumberOrUndefined(a)}}return(b&&!a.reversed||!b&&a.reversed)&&(c.reverseData(a),a.reversed=!a.reversed),a.series.map(e)},c.normalizePadding=function(a,b){return b=b||0,"number"==typeof a?{top:a,right:a,bottom:a,left:a}:{top:"number"==typeof a.top?a.top:b,right:"number"==typeof a.right?a.right:b,bottom:"number"==typeof a.bottom?a.bottom:b,left:"number"==typeof a.left?a.left:b}},c.getMetaData=function(a,b){var d=a.data?a.data[b]:a[b];return d?c.serialize(d.meta):void 0},c.orderOfMagnitude=function(a){return Math.floor(Math.log(Math.abs(a))/Math.LN10)},c.projectLength=function(a,b,c){return b/c.range*a},c.getAvailableHeight=function(a,b){return Math.max((c.quantity(b.height).value||a.height())-(b.chartPadding.top+b.chartPadding.bottom)-b.axisX.offset,0)},c.getHighLow=function(a,b,d){function e(a){if(void 0!==a)if(a instanceof Array)for(var b=0;b<a.length;b++)e(a[b]);else{var c=d?+a[d]:+a;g&&c>f.high&&(f.high=c),h&&c<f.low&&(f.low=c)}}b=c.extend({},b,d?b["axis"+d.toUpperCase()]:{});var f={high:void 0===b.high?-Number.MAX_VALUE:+b.high,low:void 0===b.low?Number.MAX_VALUE:+b.low},g=void 0===b.high,h=void 0===b.low;return(g||h)&&e(a),(b.referenceValue||0===b.referenceValue)&&(f.high=Math.max(b.referenceValue,f.high),f.low=Math.min(b.referenceValue,f.low)),f.high<=f.low&&(0===f.low?f.high=1:f.low<0?f.high=0:f.high>0?f.low=0:(f.high=1,f.low=0)),f},c.isNum=function(a){return!isNaN(a)&&isFinite(a)},c.isFalseyButZero=function(a){return!a&&0!==a},c.getNumberOrUndefined=function(a){return isNaN(+a)?void 0:+a},c.getMultiValue=function(a,b){return c.isNum(a)?+a:a?a[b||"y"]||0:0},c.rho=function(a){function b(a,c){return a%c===0?c:b(c,a%c)}function c(a){return a*a+1}if(1===a)return a;var d,e=2,f=2;if(a%2===0)return 2;do e=c(e)%a,f=c(c(f))%a,d=b(Math.abs(e-f),a);while(1===d);return d},c.getBounds=function(a,b,d,e){var f,g,h,i=0,j={high:b.high,low:b.low};j.valueRange=j.high-j.low,j.oom=c.orderOfMagnitude(j.valueRange),j.step=Math.pow(10,j.oom),j.min=Math.floor(j.low/j.step)*j.step,j.max=Math.ceil(j.high/j.step)*j.step,j.range=j.max-j.min,j.numberOfSteps=Math.round(j.range/j.step);var k=c.projectLength(a,j.step,j),l=k<d,m=e?c.rho(j.range):0;if(e&&c.projectLength(a,1,j)>=d)j.step=1;else if(e&&m<j.step&&c.projectLength(a,m,j)>=d)j.step=m;else for(;;){if(l&&c.projectLength(a,j.step,j)<=d)j.step*=2;else{if(l||!(c.projectLength(a,j.step/2,j)>=d))break;if(j.step/=2,e&&j.step%1!==0){j.step*=2;break}}if(i++>1e3)throw new Error("Exceeded maximum number of iterations while optimizing scale step!")}var n=2.221e-16;for(j.step=Math.max(j.step,n),g=j.min,h=j.max;g+j.step<=j.low;)g+=j.step;for(;h-j.step>=j.high;)h-=j.step;j.min=g,j.max=h,j.range=j.max-j.min;var o=[];for(f=j.min;f<=j.max;f+=j.step){var p=c.roundWithPrecision(f);p!==o[o.length-1]&&o.push(f)}return j.values=o,j},c.polarToCartesian=function(a,b,c,d){var e=(d-90)*Math.PI/180;return{x:a+c*Math.cos(e),y:b+c*Math.sin(e)}},c.createChartRect=function(a,b,d){var e=!(!b.axisX&&!b.axisY),f=e?b.axisY.offset:0,g=e?b.axisX.offset:0,h=a.width()||c.quantity(b.width).value||0,i=a.height()||c.quantity(b.height).value||0,j=c.normalizePadding(b.chartPadding,d);h=Math.max(h,f+j.left+j.right),i=Math.max(i,g+j.top+j.bottom);var k={padding:j,width:function(){return this.x2-this.x1},height:function(){return this.y1-this.y2}};return e?("start"===b.axisX.position?(k.y2=j.top+g,k.y1=Math.max(i-j.bottom,k.y2+1)):(k.y2=j.top,k.y1=Math.max(i-j.bottom-g,k.y2+1)),"start"===b.axisY.position?(k.x1=j.left+f,k.x2=Math.max(h-j.right,k.x1+1)):(k.x1=j.left,k.x2=Math.max(h-j.right-f,k.x1+1))):(k.x1=j.left,k.x2=Math.max(h-j.right,k.x1+1),k.y2=j.top,k.y1=Math.max(i-j.bottom,k.y2+1)),k},c.createGrid=function(a,b,d,e,f,g,h,i){var j={};j[d.units.pos+"1"]=a,j[d.units.pos+"2"]=a,j[d.counterUnits.pos+"1"]=e,j[d.counterUnits.pos+"2"]=e+f;var k=g.elem("line",j,h.join(" "));i.emit("draw",c.extend({type:"grid",axis:d,index:b,group:g,element:k},j))},c.createLabel=function(a,b,d,e,f,g,h,i,j,k,l){var m,n={};if(n[f.units.pos]=a+h[f.units.pos],n[f.counterUnits.pos]=h[f.counterUnits.pos],n[f.units.len]=b,n[f.counterUnits.len]=Math.max(0,g-10),k){var o='<span class="'+j.join(" ")+'" style="'+f.units.len+": "+Math.round(n[f.units.len])+"px; "+f.counterUnits.len+": "+Math.round(n[f.counterUnits.len])+'px">'+e[d]+"</span>";m=i.foreignObject(o,c.extend({style:"overflow: visible;"},n))}else m=i.elem("text",n,j.join(" ")).text(e[d]);l.emit("draw",c.extend({type:"label",axis:f,index:d,group:i,element:m,text:e[d]},n))},c.getSeriesOption=function(a,b,c){if(a.name&&b.series&&b.series[a.name]){var d=b.series[a.name];return d.hasOwnProperty(c)?d[c]:b[c]}return b[c]},c.optionsProvider=function(b,d,e){function f(b){var f=h;if(h=c.extend({},j),d)for(i=0;i<d.length;i++){var g=a.matchMedia(d[i][0]);g.matches&&(h=c.extend(h,d[i][1]))}e&&b&&e.emit("optionsChanged",{previousOptions:f,currentOptions:h})}function g(){k.forEach(function(a){a.removeListener(f)})}var h,i,j=c.extend({},b),k=[];if(!a.matchMedia)throw"window.matchMedia not found! Make sure you're using a polyfill.";if(d)for(i=0;i<d.length;i++){var l=a.matchMedia(d[i][0]);l.addListener(f),k.push(l)}return f(),{removeMediaQueryListeners:g,getCurrentOptions:function(){return c.extend({},h)}}},c.splitIntoSegments=function(a,b,d){var e={increasingX:!1,fillHoles:!1};d=c.extend({},e,d);for(var f=[],g=!0,h=0;h<a.length;h+=2)void 0===b[h/2].value?d.fillHoles||(g=!0):(d.increasingX&&h>=2&&a[h]<=a[h-2]&&(g=!0),g&&(f.push({pathCoordinates:[],valueData:[]}),g=!1),f[f.length-1].pathCoordinates.push(a[h],a[h+1]),f[f.length-1].valueData.push(b[h/2]));return f}}(window,document,a),function(a,b,c){"use strict";c.Interpolation={},c.Interpolation.none=function(a){var b={fillHoles:!1};return a=c.extend({},b,a),function(b,d){for(var e=new c.Svg.Path,f=!0,g=0;g<b.length;g+=2){var h=b[g],i=b[g+1],j=d[g/2];void 0!==j.value?(f?e.move(h,i,!1,j):e.line(h,i,!1,j),f=!1):a.fillHoles||(f=!0)}return e}},c.Interpolation.simple=function(a){var b={divisor:2,fillHoles:!1};a=c.extend({},b,a);var d=1/Math.max(1,a.divisor);return function(b,e){for(var f,g,h,i=new c.Svg.Path,j=0;j<b.length;j+=2){var k=b[j],l=b[j+1],m=(k-f)*d,n=e[j/2];void 0!==n.value?(void 0===h?i.move(k,l,!1,n):i.curve(f+m,g,k-m,l,k,l,!1,n),f=k,g=l,h=n):a.fillHoles||(f=k=h=void 0)}return i}},c.Interpolation.cardinal=function(a){var b={tension:1,fillHoles:!1};a=c.extend({},b,a);var d=Math.min(1,Math.max(0,a.tension)),e=1-d;return function f(b,g){var h=c.splitIntoSegments(b,g,{fillHoles:a.fillHoles});if(h.length){if(h.length>1){var i=[];return h.forEach(function(a){i.push(f(a.pathCoordinates,a.valueData))}),c.Svg.Path.join(i)}if(b=h[0].pathCoordinates,g=h[0].valueData,b.length<=4)return c.Interpolation.none()(b,g);for(var j,k=(new c.Svg.Path).move(b[0],b[1],!1,g[0]),l=0,m=b.length;m-2*!j>l;l+=2){var n=[{x:+b[l-2],y:+b[l-1]},{x:+b[l],y:+b[l+1]},{x:+b[l+2],y:+b[l+3]},{x:+b[l+4],y:+b[l+5]}];j?l?m-4===l?n[3]={x:+b[0],y:+b[1]}:m-2===l&&(n[2]={x:+b[0],y:+b[1]},n[3]={x:+b[2],y:+b[3]}):n[0]={x:+b[m-2],y:+b[m-1]}:m-4===l?n[3]=n[2]:l||(n[0]={x:+b[l],y:+b[l+1]}),k.curve(d*(-n[0].x+6*n[1].x+n[2].x)/6+e*n[2].x,d*(-n[0].y+6*n[1].y+n[2].y)/6+e*n[2].y,d*(n[1].x+6*n[2].x-n[3].x)/6+e*n[2].x,d*(n[1].y+6*n[2].y-n[3].y)/6+e*n[2].y,n[2].x,n[2].y,!1,g[(l+2)/2])}return k}return c.Interpolation.none()([])}},c.Interpolation.monotoneCubic=function(a){var b={fillHoles:!1};return a=c.extend({},b,a),function d(b,e){var f=c.splitIntoSegments(b,e,{fillHoles:a.fillHoles,increasingX:!0});if(f.length){if(f.length>1){var g=[];return f.forEach(function(a){g.push(d(a.pathCoordinates,a.valueData))}),c.Svg.Path.join(g)}if(b=f[0].pathCoordinates,e=f[0].valueData,b.length<=4)return c.Interpolation.none()(b,e);var h,i,j=[],k=[],l=b.length/2,m=[],n=[],o=[],p=[];for(h=0;h<l;h++)j[h]=b[2*h],k[h]=b[2*h+1];for(h=0;h<l-1;h++)o[h]=k[h+1]-k[h],p[h]=j[h+1]-j[h],n[h]=o[h]/p[h];for(m[0]=n[0],m[l-1]=n[l-2],h=1;h<l-1;h++)0===n[h]||0===n[h-1]||n[h-1]>0!=n[h]>0?m[h]=0:(m[h]=3*(p[h-1]+p[h])/((2*p[h]+p[h-1])/n[h-1]+(p[h]+2*p[h-1])/n[h]),isFinite(m[h])||(m[h]=0));for(i=(new c.Svg.Path).move(j[0],k[0],!1,e[0]),h=0;h<l-1;h++)i.curve(j[h]+p[h]/3,k[h]+m[h]*p[h]/3,j[h+1]-p[h]/3,k[h+1]-m[h+1]*p[h]/3,j[h+1],k[h+1],!1,e[h+1]);return i}return c.Interpolation.none()([])}},c.Interpolation.step=function(a){var b={postpone:!0,fillHoles:!1};return a=c.extend({},b,a),function(b,d){for(var e,f,g,h=new c.Svg.Path,i=0;i<b.length;i+=2){var j=b[i],k=b[i+1],l=d[i/2];void 0!==l.value?(void 0===g?h.move(j,k,!1,l):(a.postpone?h.line(j,f,!1,g):h.line(e,k,!1,l),h.line(j,k,!1,l)),e=j,f=k,g=l):a.fillHoles||(e=f=g=void 0)}return h}}}(window,document,a),function(a,b,c){"use strict";c.EventEmitter=function(){function a(a,b){d[a]=d[a]||[],d[a].push(b)}function b(a,b){d[a]&&(b?(d[a].splice(d[a].indexOf(b),1),0===d[a].length&&delete d[a]):delete d[a])}function c(a,b){d[a]&&d[a].forEach(function(a){a(b)}),d["*"]&&d["*"].forEach(function(c){c(a,b)})}var d=[];return{addEventHandler:a,removeEventHandler:b,emit:c}}}(window,document,a),function(a,b,c){"use strict";function d(a){var b=[];if(a.length)for(var c=0;c<a.length;c++)b.push(a[c]);return b}function e(a,b){var d=b||this.prototype||c.Class,e=Object.create(d);c.Class.cloneDefinitions(e,a);var f=function(){var a,b=e.constructor||function(){};return a=this===c?Object.create(e):this,b.apply(a,Array.prototype.slice.call(arguments,0)),a};return f.prototype=e,f["super"]=d,f.extend=this.extend,f}function f(){var a=d(arguments),b=a[0];return a.splice(1,a.length-1).forEach(function(a){Object.getOwnPropertyNames(a).forEach(function(c){delete b[c],Object.defineProperty(b,c,Object.getOwnPropertyDescriptor(a,c))})}),b}c.Class={extend:e,cloneDefinitions:f}}(window,document,a),function(a,b,c){"use strict";function d(a,b,d){return a&&(this.data=a,this.eventEmitter.emit("data",{type:"update",data:this.data})),b&&(this.options=c.extend({},d?this.options:this.defaultOptions,b),this.initializeTimeoutId||(this.optionsProvider.removeMediaQueryListeners(),this.optionsProvider=c.optionsProvider(this.options,this.responsiveOptions,this.eventEmitter))),this.initializeTimeoutId||this.createChart(this.optionsProvider.getCurrentOptions()),this}function e(){return this.initializeTimeoutId?a.clearTimeout(this.initializeTimeoutId):(a.removeEventListener("resize",this.resizeListener),this.optionsProvider.removeMediaQueryListeners()),this}function f(a,b){return this.eventEmitter.addEventHandler(a,b),this}function g(a,b){return this.eventEmitter.removeEventHandler(a,b),this}function h(){a.addEventListener("resize",this.resizeListener),this.optionsProvider=c.optionsProvider(this.options,this.responsiveOptions,this.eventEmitter),this.eventEmitter.addEventHandler("optionsChanged",function(){this.update()}.bind(this)),this.options.plugins&&this.options.plugins.forEach(function(a){a instanceof Array?a[0](this,a[1]):a(this)}.bind(this)),this.eventEmitter.emit("data",{type:"initial",data:this.data}),this.createChart(this.optionsProvider.getCurrentOptions()),this.initializeTimeoutId=void 0}function i(a,b,d,e,f){this.container=c.querySelector(a),this.data=b,this.defaultOptions=d,this.options=e,this.responsiveOptions=f,this.eventEmitter=c.EventEmitter(),this.supportsForeignObject=c.Svg.isSupported("Extensibility"),this.supportsAnimations=c.Svg.isSupported("AnimationEventsAttribute"),this.resizeListener=function(){this.update()}.bind(this),this.container&&(this.container.__chartist__&&this.container.__chartist__.detach(),this.container.__chartist__=this),this.initializeTimeoutId=setTimeout(h.bind(this),0)}c.Base=c.Class.extend({constructor:i,optionsProvider:void 0,container:void 0,svg:void 0,eventEmitter:void 0,createChart:function(){throw new Error("Base chart type can't be instantiated!")},update:d,detach:e,on:f,off:g,version:c.version,supportsForeignObject:!1})}(window,document,a),function(a,b,c){"use strict";function d(a,d,e,f,g){a instanceof Element?this._node=a:(this._node=b.createElementNS(c.namespaces.svg,a),"svg"===a&&this.attr({"xmlns:ct":c.namespaces.ct})),d&&this.attr(d),e&&this.addClass(e),f&&(g&&f._node.firstChild?f._node.insertBefore(this._node,f._node.firstChild):f._node.appendChild(this._node))}function e(a,b){return"string"==typeof a?b?this._node.getAttributeNS(b,a):this._node.getAttribute(a):(Object.keys(a).forEach(function(b){if(void 0!==a[b])if(b.indexOf(":")!==-1){var d=b.split(":");this._node.setAttributeNS(c.namespaces[d[0]],b,a[b])}else this._node.setAttribute(b,a[b])}.bind(this)),this)}function f(a,b,d,e){return new c.Svg(a,b,d,this,e)}function g(){return this._node.parentNode instanceof SVGElement?new c.Svg(this._node.parentNode):null}function h(){for(var a=this._node;"svg"!==a.nodeName;)a=a.parentNode;return new c.Svg(a)}function i(a){var b=this._node.querySelector(a);return b?new c.Svg(b):null}function j(a){var b=this._node.querySelectorAll(a);return b.length?new c.Svg.List(b):null}function k(a,d,e,f){if("string"==typeof a){var g=b.createElement("div");g.innerHTML=a,a=g.firstChild}a.setAttribute("xmlns",c.namespaces.xmlns);var h=this.elem("foreignObject",d,e,f);return h._node.appendChild(a),h}function l(a){return this._node.appendChild(b.createTextNode(a)),this}function m(){for(;this._node.firstChild;)this._node.removeChild(this._node.firstChild);return this}function n(){return this._node.parentNode.removeChild(this._node),this.parent()}function o(a){return this._node.parentNode.replaceChild(a._node,this._node),a}function p(a,b){return b&&this._node.firstChild?this._node.insertBefore(a._node,this._node.firstChild):this._node.appendChild(a._node),this}function q(){return this._node.getAttribute("class")?this._node.getAttribute("class").trim().split(/\s+/):[]}function r(a){return this._node.setAttribute("class",this.classes(this._node).concat(a.trim().split(/\s+/)).filter(function(a,b,c){return c.indexOf(a)===b}).join(" ")),this}function s(a){var b=a.trim().split(/\s+/);return this._node.setAttribute("class",this.classes(this._node).filter(function(a){return b.indexOf(a)===-1}).join(" ")),this}function t(){return this._node.setAttribute("class",""),this}function u(){return this._node.getBoundingClientRect().height}function v(){return this._node.getBoundingClientRect().width}function w(a,b,d){return void 0===b&&(b=!0),Object.keys(a).forEach(function(e){function f(a,b){var f,g,h,i={};a.easing&&(h=a.easing instanceof Array?a.easing:c.Svg.Easing[a.easing],delete a.easing),a.begin=c.ensureUnit(a.begin,"ms"),a.dur=c.ensureUnit(a.dur,"ms"),h&&(a.calcMode="spline",a.keySplines=h.join(" "),a.keyTimes="0;1"),b&&(a.fill="freeze",i[e]=a.from,this.attr(i),g=c.quantity(a.begin||0).value,a.begin="indefinite"),f=this.elem("animate",c.extend({attributeName:e},a)),b&&setTimeout(function(){try{f._node.beginElement()}catch(b){i[e]=a.to,this.attr(i),f.remove()}}.bind(this),g),d&&f._node.addEventListener("beginEvent",function(){d.emit("animationBegin",{element:this,animate:f._node,params:a})}.bind(this)),f._node.addEventListener("endEvent",function(){d&&d.emit("animationEnd",{element:this,animate:f._node,params:a}),b&&(i[e]=a.to,this.attr(i),f.remove())}.bind(this))}a[e]instanceof Array?a[e].forEach(function(a){f.bind(this)(a,!1)}.bind(this)):f.bind(this)(a[e],b)}.bind(this)),this}function x(a){var b=this;this.svgElements=[];for(var d=0;d<a.length;d++)this.svgElements.push(new c.Svg(a[d]));Object.keys(c.Svg.prototype).filter(function(a){return["constructor","parent","querySelector","querySelectorAll","replace","append","classes","height","width"].indexOf(a)===-1}).forEach(function(a){b[a]=function(){var d=Array.prototype.slice.call(arguments,0);return b.svgElements.forEach(function(b){c.Svg.prototype[a].apply(b,d)}),b}})}c.Svg=c.Class.extend({constructor:d,attr:e,elem:f,parent:g,root:h,querySelector:i,querySelectorAll:j,foreignObject:k,text:l,empty:m,remove:n,replace:o,append:p,classes:q,addClass:r,removeClass:s,removeAllClasses:t,height:u,width:v,animate:w}),c.Svg.isSupported=function(a){return b.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#"+a,"1.1")};var y={easeInSine:[.47,0,.745,.715],easeOutSine:[.39,.575,.565,1],easeInOutSine:[.445,.05,.55,.95],easeInQuad:[.55,.085,.68,.53],easeOutQuad:[.25,.46,.45,.94],easeInOutQuad:[.455,.03,.515,.955],easeInCubic:[.55,.055,.675,.19],easeOutCubic:[.215,.61,.355,1],easeInOutCubic:[.645,.045,.355,1],easeInQuart:[.895,.03,.685,.22],easeOutQuart:[.165,.84,.44,1],easeInOutQuart:[.77,0,.175,1],easeInQuint:[.755,.05,.855,.06],easeOutQuint:[.23,1,.32,1],easeInOutQuint:[.86,0,.07,1],easeInExpo:[.95,.05,.795,.035],easeOutExpo:[.19,1,.22,1],easeInOutExpo:[1,0,0,1],easeInCirc:[.6,.04,.98,.335],easeOutCirc:[.075,.82,.165,1],easeInOutCirc:[.785,.135,.15,.86],easeInBack:[.6,-.28,.735,.045],easeOutBack:[.175,.885,.32,1.275],easeInOutBack:[.68,-.55,.265,1.55]};c.Svg.Easing=y,c.Svg.List=c.Class.extend({constructor:x})}(window,document,a),function(a,b,c){"use strict";function d(a,b,d,e,f,g){var h=c.extend({command:f?a.toLowerCase():a.toUpperCase()},b,g?{data:g}:{});d.splice(e,0,h)}function e(a,b){a.forEach(function(c,d){u[c.command.toLowerCase()].forEach(function(e,f){b(c,e,d,f,a)})})}function f(a,b){this.pathElements=[],this.pos=0,this.close=a,this.options=c.extend({},v,b)}function g(a){return void 0!==a?(this.pos=Math.max(0,Math.min(this.pathElements.length,a)),this):this.pos}function h(a){return this.pathElements.splice(this.pos,a),this}function i(a,b,c,e){return d("M",{x:+a,y:+b},this.pathElements,this.pos++,c,e),this}function j(a,b,c,e){return d("L",{x:+a,y:+b},this.pathElements,this.pos++,c,e),this}function k(a,b,c,e,f,g,h,i){return d("C",{x1:+a,y1:+b,x2:+c,y2:+e,x:+f,y:+g},this.pathElements,this.pos++,h,i),this}function l(a,b,c,e,f,g,h,i,j){return d("A",{rx:+a,ry:+b,xAr:+c,lAf:+e,sf:+f,x:+g,y:+h},this.pathElements,this.pos++,i,j),this}function m(a){var b=a.replace(/([A-Za-z])([0-9])/g,"$1 $2").replace(/([0-9])([A-Za-z])/g,"$1 $2").split(/[\s,]+/).reduce(function(a,b){return b.match(/[A-Za-z]/)&&a.push([]),a[a.length-1].push(b),a},[]);"Z"===b[b.length-1][0].toUpperCase()&&b.pop();var d=b.map(function(a){var b=a.shift(),d=u[b.toLowerCase()];return c.extend({command:b},d.reduce(function(b,c,d){return b[c]=+a[d],b},{}))}),e=[this.pos,0];return Array.prototype.push.apply(e,d),Array.prototype.splice.apply(this.pathElements,e),this.pos+=d.length,this}function n(){var a=Math.pow(10,this.options.accuracy);return this.pathElements.reduce(function(b,c){var d=u[c.command.toLowerCase()].map(function(b){return this.options.accuracy?Math.round(c[b]*a)/a:c[b]}.bind(this));return b+c.command+d.join(",")}.bind(this),"")+(this.close?"Z":"")}function o(a,b){return e(this.pathElements,function(c,d){c[d]*="x"===d[0]?a:b}),this}function p(a,b){return e(this.pathElements,function(c,d){c[d]+="x"===d[0]?a:b}),this}function q(a){return e(this.pathElements,function(b,c,d,e,f){var g=a(b,c,d,e,f);(g||0===g)&&(b[c]=g)}),this}function r(a){var b=new c.Svg.Path(a||this.close);return b.pos=this.pos,b.pathElements=this.pathElements.slice().map(function(a){return c.extend({},a)}),b.options=c.extend({},this.options),b}function s(a){var b=[new c.Svg.Path];return this.pathElements.forEach(function(d){d.command===a.toUpperCase()&&0!==b[b.length-1].pathElements.length&&b.push(new c.Svg.Path),b[b.length-1].pathElements.push(d)}),b}function t(a,b,d){for(var e=new c.Svg.Path(b,d),f=0;f<a.length;f++)for(var g=a[f],h=0;h<g.pathElements.length;h++)e.pathElements.push(g.pathElements[h]);return e}var u={m:["x","y"],l:["x","y"],c:["x1","y1","x2","y2","x","y"],a:["rx","ry","xAr","lAf","sf","x","y"]},v={accuracy:3};c.Svg.Path=c.Class.extend({constructor:f,position:g,remove:h,move:i,line:j,curve:k,arc:l,scale:o,translate:p,transform:q,parse:m,stringify:n,clone:r,splitByCommand:s}),c.Svg.Path.elementDescriptions=u,c.Svg.Path.join=t}(window,document,a),function(a,b,c){"use strict";function d(a,b,c,d){this.units=a,this.counterUnits=a===f.x?f.y:f.x,this.chartRect=b,this.axisLength=b[a.rectEnd]-b[a.rectStart],this.gridOffset=b[a.rectOffset],this.ticks=c,this.options=d}function e(a,b,d,e,f){var g=e["axis"+this.units.pos.toUpperCase()],h=this.ticks.map(this.projectValue.bind(this)),i=this.ticks.map(g.labelInterpolationFnc);h.forEach(function(j,k){var l,m={x:0,y:0};l=h[k+1]?h[k+1]-j:Math.max(this.axisLength-j,30),c.isFalseyButZero(i[k])&&""!==i[k]||("x"===this.units.pos?(j=this.chartRect.x1+j,m.x=e.axisX.labelOffset.x,"start"===e.axisX.position?m.y=this.chartRect.padding.top+e.axisX.labelOffset.y+(d?5:20):m.y=this.chartRect.y1+e.axisX.labelOffset.y+(d?5:20)):(j=this.chartRect.y1-j,m.y=e.axisY.labelOffset.y-(d?l:0),"start"===e.axisY.position?m.x=d?this.chartRect.padding.left+e.axisY.labelOffset.x:this.chartRect.x1-10:m.x=this.chartRect.x2+e.axisY.labelOffset.x+10),g.showGrid&&c.createGrid(j,k,this,this.gridOffset,this.chartRect[this.counterUnits.len](),a,[e.classNames.grid,e.classNames[this.units.dir]],f),g.showLabel&&c.createLabel(j,l,k,i,this,g.offset,m,b,[e.classNames.label,e.classNames[this.units.dir],e.classNames[g.position]],d,f))}.bind(this))}var f={x:{pos:"x",len:"width",dir:"horizontal",rectStart:"x1",rectEnd:"x2",rectOffset:"y2"},y:{pos:"y",len:"height",dir:"vertical",rectStart:"y2",rectEnd:"y1",rectOffset:"x1"}};c.Axis=c.Class.extend({constructor:d,createGridAndLabels:e,projectValue:function(a,b,c){throw new Error("Base axis can't be instantiated!")}}),c.Axis.units=f}(window,document,a),function(a,b,c){"use strict";function d(a,b,d,e){var f=e.highLow||c.getHighLow(b.normalized,e,a.pos);this.bounds=c.getBounds(d[a.rectEnd]-d[a.rectStart],f,e.scaleMinSpace||20,e.onlyInteger),this.range={min:this.bounds.min,max:this.bounds.max},c.AutoScaleAxis["super"].constructor.call(this,a,d,this.bounds.values,e)}function e(a){return this.axisLength*(+c.getMultiValue(a,this.units.pos)-this.bounds.min)/this.bounds.range}c.AutoScaleAxis=c.Axis.extend({constructor:d,projectValue:e})}(window,document,a),function(a,b,c){"use strict";function d(a,b,d,e){var f=e.highLow||c.getHighLow(b.normalized,e,a.pos);this.divisor=e.divisor||1,this.ticks=e.ticks||c.times(this.divisor).map(function(a,b){return f.low+(f.high-f.low)/this.divisor*b}.bind(this)),this.ticks.sort(function(a,b){return a-b}),this.range={min:f.low,max:f.high},c.FixedScaleAxis["super"].constructor.call(this,a,d,this.ticks,e),this.stepLength=this.axisLength/this.divisor}function e(a){return this.axisLength*(+c.getMultiValue(a,this.units.pos)-this.range.min)/(this.range.max-this.range.min)}c.FixedScaleAxis=c.Axis.extend({constructor:d,projectValue:e})}(window,document,a),function(a,b,c){"use strict";function d(a,b,d,e){c.StepAxis["super"].constructor.call(this,a,d,e.ticks,e),this.stepLength=this.axisLength/(e.ticks.length-(e.stretch?1:0))}function e(a,b){return this.stepLength*b}c.StepAxis=c.Axis.extend({constructor:d,projectValue:e})}(window,document,a),function(a,b,c){"use strict";function d(a){this.data=c.normalizeData(this.data);var b={raw:this.data,normalized:c.getDataArray(this.data,a.reverseData,!0)};this.svg=c.createSvg(this.container,a.width,a.height,a.classNames.chart);var d,e,g=this.svg.elem("g").addClass(a.classNames.gridGroup),h=this.svg.elem("g"),i=this.svg.elem("g").addClass(a.classNames.labelGroup),j=c.createChartRect(this.svg,a,f.padding);d=void 0===a.axisX.type?new c.StepAxis(c.Axis.units.x,b,j,c.extend({},a.axisX,{ticks:b.raw.labels,stretch:a.fullWidth})):a.axisX.type.call(c,c.Axis.units.x,b,j,a.axisX),e=void 0===a.axisY.type?new c.AutoScaleAxis(c.Axis.units.y,b,j,c.extend({},a.axisY,{high:c.isNum(a.high)?a.high:a.axisY.high,low:c.isNum(a.low)?a.low:a.axisY.low})):a.axisY.type.call(c,c.Axis.units.y,b,j,a.axisY),d.createGridAndLabels(g,i,this.supportsForeignObject,a,this.eventEmitter),e.createGridAndLabels(g,i,this.supportsForeignObject,a,this.eventEmitter),b.raw.series.forEach(function(f,g){var i=h.elem("g");i.attr({"ct:series-name":f.name,"ct:meta":c.serialize(f.meta)}),i.addClass([a.classNames.series,f.className||a.classNames.series+"-"+c.alphaNumerate(g)].join(" "));var k=[],l=[];b.normalized[g].forEach(function(a,h){var i={x:j.x1+d.projectValue(a,h,b.normalized[g]),y:j.y1-e.projectValue(a,h,b.normalized[g])};k.push(i.x,i.y),l.push({value:a,valueIndex:h,meta:c.getMetaData(f,h)})}.bind(this));var m={lineSmooth:c.getSeriesOption(f,a,"lineSmooth"),showPoint:c.getSeriesOption(f,a,"showPoint"),showLine:c.getSeriesOption(f,a,"showLine"),showArea:c.getSeriesOption(f,a,"showArea"),areaBase:c.getSeriesOption(f,a,"areaBase")},n="function"==typeof m.lineSmooth?m.lineSmooth:m.lineSmooth?c.Interpolation.monotoneCubic():c.Interpolation.none(),o=n(k,l);if(m.showPoint&&o.pathElements.forEach(function(b){var h=i.elem("line",{x1:b.x,y1:b.y,x2:b.x+.01,y2:b.y},a.classNames.point).attr({"ct:value":[b.data.value.x,b.data.value.y].filter(c.isNum).join(","),"ct:meta":b.data.meta});this.eventEmitter.emit("draw",{type:"point",value:b.data.value,index:b.data.valueIndex,meta:b.data.meta,series:f,seriesIndex:g,axisX:d,axisY:e,group:i,element:h,x:b.x,y:b.y})}.bind(this)),m.showLine){var p=i.elem("path",{d:o.stringify()},a.classNames.line,!0);this.eventEmitter.emit("draw",{type:"line",values:b.normalized[g],path:o.clone(),chartRect:j,index:g,series:f,seriesIndex:g,axisX:d,axisY:e,group:i,element:p})}if(m.showArea&&e.range){var q=Math.max(Math.min(m.areaBase,e.range.max),e.range.min),r=j.y1-e.projectValue(q);o.splitByCommand("M").filter(function(a){return a.pathElements.length>1}).map(function(a){var b=a.pathElements[0],c=a.pathElements[a.pathElements.length-1];return a.clone(!0).position(0).remove(1).move(b.x,r).line(b.x,b.y).position(a.pathElements.length+1).line(c.x,r)}).forEach(function(c){var h=i.elem("path",{d:c.stringify()},a.classNames.area,!0);this.eventEmitter.emit("draw",{type:"area",values:b.normalized[g],path:c.clone(),series:f,seriesIndex:g,axisX:d,axisY:e,chartRect:j,index:g,group:i,element:h})}.bind(this))}}.bind(this)),this.eventEmitter.emit("created",{bounds:e.bounds,chartRect:j,axisX:d,axisY:e,svg:this.svg,options:a})}function e(a,b,d,e){c.Line["super"].constructor.call(this,a,b,f,c.extend({},f,d),e)}var f={axisX:{offset:30,position:"end",labelOffset:{x:0,y:0},showLabel:!0,showGrid:!0,labelInterpolationFnc:c.noop,type:void 0},axisY:{offset:40,position:"start",labelOffset:{x:0,y:0},showLabel:!0,showGrid:!0,labelInterpolationFnc:c.noop,type:void 0,scaleMinSpace:20,onlyInteger:!1},width:void 0,height:void 0,showLine:!0,showPoint:!0,showArea:!1,areaBase:0,lineSmooth:!0,low:void 0,high:void 0,chartPadding:{top:15,right:15,bottom:5,left:10},fullWidth:!1,reverseData:!1,classNames:{chart:"ct-chart-line",label:"ct-label",labelGroup:"ct-labels",series:"ct-series",line:"ct-line",point:"ct-point",area:"ct-area",grid:"ct-grid",gridGroup:"ct-grids",vertical:"ct-vertical",horizontal:"ct-horizontal",start:"ct-start",end:"ct-end"}};c.Line=c.Base.extend({constructor:e,createChart:d})}(window,document,a),function(a,b,c){"use strict";function d(a){this.data=c.normalizeData(this.data);var b,d={raw:this.data,normalized:a.distributeSeries?c.getDataArray(this.data,a.reverseData,a.horizontalBars?"x":"y").map(function(a){return[a]}):c.getDataArray(this.data,a.reverseData,a.horizontalBars?"x":"y")};this.svg=c.createSvg(this.container,a.width,a.height,a.classNames.chart+(a.horizontalBars?" "+a.classNames.horizontalBars:""));var e=this.svg.elem("g").addClass(a.classNames.gridGroup),g=this.svg.elem("g"),h=this.svg.elem("g").addClass(a.classNames.labelGroup);if(a.stackBars&&0!==d.normalized.length){var i=c.serialMap(d.normalized,function(){return Array.prototype.slice.call(arguments).map(function(a){return a}).reduce(function(a,b){return{x:a.x+(b&&b.x)||0,y:a.y+(b&&b.y)||0}},{x:0,y:0})});b=c.getHighLow([i],c.extend({},a,{referenceValue:0}),a.horizontalBars?"x":"y")}else b=c.getHighLow(d.normalized,c.extend({},a,{referenceValue:0}),a.horizontalBars?"x":"y");b.high=+a.high||(0===a.high?0:b.high),b.low=+a.low||(0===a.low?0:b.low);var j,k,l,m,n,o=c.createChartRect(this.svg,a,f.padding);k=a.distributeSeries&&a.stackBars?d.raw.labels.slice(0,1):d.raw.labels,a.horizontalBars?(j=m=void 0===a.axisX.type?new c.AutoScaleAxis(c.Axis.units.x,d,o,c.extend({},a.axisX,{highLow:b,referenceValue:0})):a.axisX.type.call(c,c.Axis.units.x,d,o,c.extend({},a.axisX,{highLow:b,referenceValue:0})),l=n=void 0===a.axisY.type?new c.StepAxis(c.Axis.units.y,d,o,{ticks:k}):a.axisY.type.call(c,c.Axis.units.y,d,o,a.axisY)):(l=m=void 0===a.axisX.type?new c.StepAxis(c.Axis.units.x,d,o,{ticks:k}):a.axisX.type.call(c,c.Axis.units.x,d,o,a.axisX),j=n=void 0===a.axisY.type?new c.AutoScaleAxis(c.Axis.units.y,d,o,c.extend({},a.axisY,{highLow:b,referenceValue:0})):a.axisY.type.call(c,c.Axis.units.y,d,o,c.extend({},a.axisY,{highLow:b,referenceValue:0})));var p=a.horizontalBars?o.x1+j.projectValue(0):o.y1-j.projectValue(0),q=[];
   l.createGridAndLabels(e,h,this.supportsForeignObject,a,this.eventEmitter),j.createGridAndLabels(e,h,this.supportsForeignObject,a,this.eventEmitter),d.raw.series.forEach(function(b,e){var f,h,i=e-(d.raw.series.length-1)/2;f=a.distributeSeries&&!a.stackBars?l.axisLength/d.normalized.length/2:a.distributeSeries&&a.stackBars?l.axisLength/2:l.axisLength/d.normalized[e].length/2,h=g.elem("g"),h.attr({"ct:series-name":b.name,"ct:meta":c.serialize(b.meta)}),h.addClass([a.classNames.series,b.className||a.classNames.series+"-"+c.alphaNumerate(e)].join(" ")),d.normalized[e].forEach(function(g,k){var r,s,t,u;if(u=a.distributeSeries&&!a.stackBars?e:a.distributeSeries&&a.stackBars?0:k,r=a.horizontalBars?{x:o.x1+j.projectValue(g&&g.x?g.x:0,k,d.normalized[e]),y:o.y1-l.projectValue(g&&g.y?g.y:0,u,d.normalized[e])}:{x:o.x1+l.projectValue(g&&g.x?g.x:0,u,d.normalized[e]),y:o.y1-j.projectValue(g&&g.y?g.y:0,k,d.normalized[e])},l instanceof c.StepAxis&&(l.options.stretch||(r[l.units.pos]+=f*(a.horizontalBars?-1:1)),r[l.units.pos]+=a.stackBars||a.distributeSeries?0:i*a.seriesBarDistance*(a.horizontalBars?-1:1)),t=q[k]||p,q[k]=t-(p-r[l.counterUnits.pos]),void 0!==g){var v={};v[l.units.pos+"1"]=r[l.units.pos],v[l.units.pos+"2"]=r[l.units.pos],!a.stackBars||"accumulate"!==a.stackMode&&a.stackMode?(v[l.counterUnits.pos+"1"]=p,v[l.counterUnits.pos+"2"]=r[l.counterUnits.pos]):(v[l.counterUnits.pos+"1"]=t,v[l.counterUnits.pos+"2"]=q[k]),v.x1=Math.min(Math.max(v.x1,o.x1),o.x2),v.x2=Math.min(Math.max(v.x2,o.x1),o.x2),v.y1=Math.min(Math.max(v.y1,o.y2),o.y1),v.y2=Math.min(Math.max(v.y2,o.y2),o.y1),s=h.elem("line",v,a.classNames.bar).attr({"ct:value":[g.x,g.y].filter(c.isNum).join(","),"ct:meta":c.getMetaData(b,k)}),this.eventEmitter.emit("draw",c.extend({type:"bar",value:g,index:k,meta:c.getMetaData(b,k),series:b,seriesIndex:e,axisX:m,axisY:n,chartRect:o,group:h,element:s},v))}}.bind(this))}.bind(this)),this.eventEmitter.emit("created",{bounds:j.bounds,chartRect:o,axisX:m,axisY:n,svg:this.svg,options:a})}function e(a,b,d,e){c.Bar["super"].constructor.call(this,a,b,f,c.extend({},f,d),e)}var f={axisX:{offset:30,position:"end",labelOffset:{x:0,y:0},showLabel:!0,showGrid:!0,labelInterpolationFnc:c.noop,scaleMinSpace:30,onlyInteger:!1},axisY:{offset:40,position:"start",labelOffset:{x:0,y:0},showLabel:!0,showGrid:!0,labelInterpolationFnc:c.noop,scaleMinSpace:20,onlyInteger:!1},width:void 0,height:void 0,high:void 0,low:void 0,chartPadding:{top:15,right:15,bottom:5,left:10},seriesBarDistance:15,stackBars:!1,stackMode:"accumulate",horizontalBars:!1,distributeSeries:!1,reverseData:!1,classNames:{chart:"ct-chart-bar",horizontalBars:"ct-horizontal-bars",label:"ct-label",labelGroup:"ct-labels",series:"ct-series",bar:"ct-bar",grid:"ct-grid",gridGroup:"ct-grids",vertical:"ct-vertical",horizontal:"ct-horizontal",start:"ct-start",end:"ct-end"}};c.Bar=c.Base.extend({constructor:e,createChart:d})}(window,document,a),function(a,b,c){"use strict";function d(a,b,c){var d=b.x>a.x;return d&&"explode"===c||!d&&"implode"===c?"start":d&&"implode"===c||!d&&"explode"===c?"end":"middle"}function e(a){this.data=c.normalizeData(this.data);var b,e,f,h,i,j=[],k=a.startAngle,l=c.getDataArray(this.data,a.reverseData);this.svg=c.createSvg(this.container,a.width,a.height,a.donut?a.classNames.chartDonut:a.classNames.chartPie),e=c.createChartRect(this.svg,a,g.padding),f=Math.min(e.width()/2,e.height()/2),i=a.total||l.reduce(function(a,b){return a+b},0);var m=c.quantity(a.donutWidth);"%"===m.unit&&(m.value*=f/100),f-=a.donut?m.value/2:0,h="outside"===a.labelPosition||a.donut?f:"center"===a.labelPosition?0:f/2,h+=a.labelOffset;var n={x:e.x1+e.width()/2,y:e.y2+e.height()/2},o=1===this.data.series.filter(function(a){return a.hasOwnProperty("value")?0!==a.value:0!==a}).length;a.showLabel&&(b=this.svg.elem("g",null,null,!0));for(var p=0;p<this.data.series.length;p++)if(0!==l[p]||!a.ignoreEmptyValues){var q=this.data.series[p];j[p]=this.svg.elem("g",null,null,!0),j[p].attr({"ct:series-name":q.name}),j[p].addClass([a.classNames.series,q.className||a.classNames.series+"-"+c.alphaNumerate(p)].join(" "));var r=k+l[p]/i*360,s=Math.max(0,k-(0===p||o?0:.2));r-s>=359.99&&(r=s+359.99);var t=c.polarToCartesian(n.x,n.y,f,s),u=c.polarToCartesian(n.x,n.y,f,r),v=new c.Svg.Path((!a.donut)).move(u.x,u.y).arc(f,f,0,r-k>180,0,t.x,t.y);a.donut||v.line(n.x,n.y);var w=j[p].elem("path",{d:v.stringify()},a.donut?a.classNames.sliceDonut:a.classNames.slicePie);if(w.attr({"ct:value":l[p],"ct:meta":c.serialize(q.meta)}),a.donut&&w.attr({style:"stroke-width: "+m.value+"px"}),this.eventEmitter.emit("draw",{type:"slice",value:l[p],totalDataSum:i,index:p,meta:q.meta,series:q,group:j[p],element:w,path:v.clone(),center:n,radius:f,startAngle:k,endAngle:r}),a.showLabel){var x=c.polarToCartesian(n.x,n.y,h,k+(r-k)/2),y=a.labelInterpolationFnc(this.data.labels&&!c.isFalseyButZero(this.data.labels[p])?this.data.labels[p]:l[p],p);if(y||0===y){var z=b.elem("text",{dx:x.x,dy:x.y,"text-anchor":d(n,x,a.labelDirection)},a.classNames.label).text(""+y);this.eventEmitter.emit("draw",{type:"label",index:p,group:b,element:z,text:""+y,x:x.x,y:x.y})}}k=r}this.eventEmitter.emit("created",{chartRect:e,svg:this.svg,options:a})}function f(a,b,d,e){c.Pie["super"].constructor.call(this,a,b,g,c.extend({},g,d),e)}var g={width:void 0,height:void 0,chartPadding:5,classNames:{chartPie:"ct-chart-pie",chartDonut:"ct-chart-donut",series:"ct-series",slicePie:"ct-slice-pie",sliceDonut:"ct-slice-donut",label:"ct-label"},startAngle:0,total:void 0,donut:!1,donutWidth:60,showLabel:!0,labelOffset:0,labelPosition:"inside",labelInterpolationFnc:c.noop,labelDirection:"neutral",reverseData:!1,ignoreEmptyValues:!1};c.Pie=c.Base.extend({constructor:f,createChart:e,determineAnchorPosition:d})}(window,document,a),a});/* uniform	 */					
   (function (root, factory) {
       if (typeof define === 'function' && define.amd) {
           // AMD. Register as an anonymous module.
           define(['chartist'], function (chartist) {
               return (root.returnExportsGlobal = factory(chartist));
           });
       } else if (typeof exports === 'object') {
           // Node. Does not work with strict CommonJS, but
           // only CommonJS-like enviroments that support module.exports,
           // like Node.
           module.exports = factory(require('chartist'));
       } else {
           root['Chartist.plugins.legend'] = factory(root.Chartist);
       }
   }(this, function (Chartist) {
       /**
        * This Chartist plugin creates a legend to show next to the chart.
        *
        */
       'use strict';
   
       var defaultOptions = {
           className: '',
           classNames: false,
           removeAll: false,
           legendNames: false,
           clickable: true,
           onClick: null,
           position: 'top'
       };
   
       Chartist.plugins = Chartist.plugins || {};
   
       Chartist.plugins.legend = function (options) {
   
           function compareNumbers(a, b) {
               return a - b;
           }
   
           // Catch invalid options
           if (options && options.position) {
              if (!(options.position === 'top' || options.position === 'bottom')) {
                 throw Error('The position you entered is not a valid position');
              }
           }
   
           options = Chartist.extend({}, defaultOptions, options);
   
           return function legend(chart) {
               var existingLegendElement = chart.container.querySelector('.ct-legend');
               if (existingLegendElement) {
                   // Clear legend if already existing.
                   existingLegendElement.parentNode.removeChild(existingLegendElement);
               }
   
               // Set a unique className for each series so that when a series is removed,
               // the other series still have the same color.
               if (options.clickable) {
                   var newSeries = chart.data.series.map(function (series, seriesIndex) {
                       if (typeof series !== 'object') {
                           series = {
                               value: series
                           };
                       }
   
                       series.className = series.className || chart.options.classNames.series + '-' + Chartist.alphaNumerate(seriesIndex);
                       return series;
                   });
                   chart.data.series = newSeries;
               }
   
               var legendElement = document.createElement('ul'),
                   isPieChart = chart instanceof Chartist.Pie;
               legendElement.className = 'ct-legend';
               if (chart instanceof Chartist.Pie) {
                   legendElement.classList.add('ct-legend-inside');
               }
               if (typeof options.className === 'string' && options.className.length > 0) {
                   legendElement.classList.add(options.className);
               }
   
               var removedSeries = [],
                   originalSeries = chart.data.series.slice(0);
   
               // Get the right array to use for generating the legend.
               var legendNames = chart.data.series,
                   useLabels = isPieChart && chart.data.labels;
               if (useLabels) {
                   var originalLabels = chart.data.labels.slice(0);
                   legendNames = chart.data.labels;
               }
               legendNames = options.legendNames || legendNames;
   
               // Check if given class names are viable to append to legends
               var classNamesViable = (Array.isArray(options.classNames) && (options.classNames.length === legendNames.length));
   
               // Loop through all legends to set each name in a list item.
               legendNames.forEach(function (legend, i) {
                  var li = document.createElement('li');
                  li.className = 'ct-series-' + i;
                  // Append specific class to a legend element, if viable classes are given
                  if (classNamesViable) {
                     li.className += ' ' + options.classNames[i];
                  }
                  li.setAttribute('data-legend', i);
                  li.textContent = legend.name || legend;
                  legendElement.appendChild(li);
               });
   
               chart.on('created', function (data) {
                  // Append the legend element to the DOM
                  switch (options.position) {
                     case 'top':
                        chart.container.insertBefore(legendElement, chart.container.childNodes[0]);
                        break;
   
                     case 'bottom':
                        chart.container.insertBefore(legendElement, null);
                        break;
                  }
               });
   
               if (options.clickable) {
                   legendElement.addEventListener('click', function (e) {
                       var li = e.target;
                       if (li.parentNode !== legendElement || !li.hasAttribute('data-legend'))
                           return;
                       e.preventDefault();
   
                       var seriesIndex = parseInt(li.getAttribute('data-legend')),
                           removedSeriesIndex = removedSeries.indexOf(seriesIndex);
   
                       if (removedSeriesIndex > -1) {
                           // Add to series again.
                           removedSeries.splice(removedSeriesIndex, 1);
                           li.classList.remove('inactive');
                       } else {
                           if (!options.removeAll) {
                                // Remove from series, only if a minimum of one series is still visible.
                             if ( chart.data.series.length > 1) {
                                removedSeries.push(seriesIndex);
                                li.classList.add('inactive');
                             }
                                // Set all series as active.
                             else {
                                removedSeries = [];
                                var seriesItems = Array.prototype.slice.call(legendElement.childNodes);
                                seriesItems.forEach(function (item) {
                                   item.classList.remove('inactive');
                                });
                             }
                          }
                          else {
                             // Remove series unaffected if it is the last or not
                             removedSeries.push(seriesIndex);
                             li.classList.add('inactive');
                          }
                       }
   
                       // Reset the series to original and remove each series that
                       // is still removed again, to remain index order.
                       var seriesCopy = originalSeries.slice(0);
                       if (useLabels) {
                           var labelsCopy = originalLabels.slice(0);
                       }
   
                       // Reverse sort the removedSeries to prevent removing the wrong index.
                       removedSeries.sort(compareNumbers).reverse();
   
                       removedSeries.forEach(function (series) {
                           seriesCopy.splice(series, 1);
                           if (useLabels) {
                               labelsCopy.splice(series, 1);
                           }
                       });
   
                       if (options.onClick) {
                           options.onClick(chart, e);
                       }
   
                       chart.data.series = seriesCopy;
                       if (useLabels) {
                           chart.data.labels = labelsCopy;
                       }
   
                       chart.update();
                   });
               }
   
           };
   
       };
   
       return Chartist.plugins.legend;
   
   }));
</script>
<script>
   new Chartist.Line('.ct-chart', {
   
     labels: [<?php echo $c['labels']; ?>],
    
     series: [
       [<?php  echo $a['values']; ?>],
       [<?php  echo $b['values']; ?>],
     [<?php  echo $c['values']; ?>],
     ]
   }, {
     fullWidth: true,
     height:"350px",
    
    onlyInteger: true,
    showArea: true,
    
     chartPadding: 15,
     plugins: [
          Chartist.plugins.legend({
   	    legendNames: ['New Listings', 'New Orders', 'New Users'],
   		position: "bottom",
   	   })
      ]
   });
   
    
</script>