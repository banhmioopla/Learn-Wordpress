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

global $wpdb, $CORE; 


// sEARCH dEFAULTS
if(!isset($_POST['uk'])){ $_POST['uk'] = ""; }
if(!isset($_POST['uv'])){ $ff = explode(",","user_login,user_email"); }else{ $ff = explode(",", $_POST['uv']); }

// TOTAL COUNT QUERY
$count_args  = array(
    //'role'      => 'Subscriber',
	'search'         => $_POST['uk'],
    'fields'    => 'all_with_meta',
    'number'    => 999999      
);
 
$user_count_query = new WP_User_Query($count_args);
$user_count = $user_count_query->get_results();

// count the number of users found in the query
$TOTALITEMS = $user_count ? count($user_count) : 1;

// grab the current page number and set to 1 if no page number is set

$page = isset($_GET['cpage']) && is_numeric($_GET['cpage']) ? $_GET['cpage'] : 1;
 
 
 
// how many users to cpage per page
$ITEMSPERPAGE = isset($_GET['show']) && is_numeric($_GET['show']) ? $_GET['show'] : 20;

// calculate the total number of pages.
$TOTALPAGES = 1;
$offset = $ITEMSPERPAGE * ($page - 1);
$TOTALPAGES = ceil($TOTALITEMS / $ITEMSPERPAGE);

 

if(!isset($_GET['us'])){ $_GET['us'] = ""; }
if(!isset($_GET['orderby'])){ $_GET['orderby'] = "registered"; }
if(!isset($_GET['order'])){ $_GET['order'] = "desc"; }

if(isset($_GET['orderby']) && $_GET['orderby'] == "logincount"){

	$CUSTOMARRAY = array(
	
	"login_count" => 
		array( 
		"key" => "login_count", 
		"value" => "-1", 
		"compare" => ">"	
		) 
	);
	$_GET['orderby'] = "meta_value_num";

}

// main user query
$args  = array(
	'search'         => $_GET['us'],
    // search only for Authors role
    //'role'      => 'Subscriber',
    // order results by display_name
    'orderby'   => $_GET['orderby'],
    'order'   	=> $_GET['order'],
    'fields'    => 'all_with_meta',
    'number'    => $ITEMSPERPAGE,
    'offset'    => $offset // skip the number of users that we have per page  
);


if(isset($CUSTOMARRAY) && is_array($CUSTOMARRAY)){

$svals = array();
 
foreach($CUSTOMARRAY as $key => $val){
 
		if(!is_array($val)){ continue; }
		
		$svals = array( 'meta_query' => array( $key => array(
				'key'     => $val['key'],
				'value'   => $val['value'],
	 			'compare' => $val['compare']
		) ) );
}

$args = array_merge($svals,$args);
 
}
 
// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);

// Get the results
$authors = $wp_user_query->get_results();
 

?> 
 

 

<form action="users.php" method="get">
<input type="hidden" name="submitted" value="no">
<input type="hidden" name="page" value="users">
  


<div class="card mb-3">
    <div class="card-header">
    
    <button class="btn btn-primary btn-sm float-right" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button> 
 
 
    
    <span>
    <i class="fa fa-filter" aria-hidden="true"></i> Filter Results
    </span>
    </div>
    <div class="card-body"> 
    
    <div  class="row">
        <div class="col-md-4">
        
        <label>Search Keyword</label>
          
             <input name="us" class="form-control" value="<?php if(isset($_GET['s_k'])){ echo $_GET['s_k']; } ?>" />
             
        </div> 
    </div>
    
    
<div class="row margin-top1">

<div class="col-md-4">
 
 <label>Order By</label><br />
  <select class="form-control" name="orderby">
  <option value="">Any</option>
  
 
  
	<option value="ID" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "ID"){ echo "selected=selected"; } ?>>ID</option>  
	<option value="display_name" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "display_name"){ echo "selected=selected"; } ?>>Display Name</option>  
	<option value="name" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "name"){ echo "selected=selected"; } ?>>Username</option>  
    
  <option value="login" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "login"){ echo "selected=selected"; } ?>>Login ID</option>  
 
  <option value="email" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "email"){ echo "selected=selected"; } ?>>Email</option>  

  <option value="registered" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "registered"){ echo "selected=selected"; } ?>>Date Registered</option>
  <option value="post_count" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "post_count"){ echo "selected=selected"; } ?>>Post Count</option>
  <option value="logincount" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "logincount"){ echo "selected=selected"; } ?>>Login Count</option>

  </select>
</div>

<div class="col-md-4">
 
 <label>Order</label><br />
  <select class="form-control" name="order">
  <option value="asc">ASC</option>
  <option value="desc" <?php if(isset($_GET['order']) && $_GET['order'] == "desc"){ echo "selected=selected"; } ?>>DESC</option>  
  </select>
</div>

<div class="col-md-4">

 <label>Show</label><br />
  <select class="form-control" name="show">
 
  <option value="5" <?php if(isset($_GET['show']) && $_GET['show'] == "5"){ echo "selected=selected"; } ?>>5</option>  
  <option value="10" <?php if(isset($_GET['show']) && $_GET['show'] == "10"){ echo "selected=selected"; } ?>>10</option>  
  <option value="20" <?php if(!isset($_GET['show']) || isset($_GET['show']) && $_GET['show'] == "20"){ echo "selected=selected"; } ?>>20</option>  
  <option value="50" <?php if(isset($_GET['show']) && $_GET['show'] == "50"){ echo "selected=selected"; } ?>>50</option>  
  <option value="100" <?php if(isset($_GET['show']) && $_GET['show'] == "100"){ echo "selected=selected"; } ?>>100</option>  
  <option value="200" <?php if(isset($_GET['show']) && $_GET['show'] == "200"){ echo "selected=selected"; } ?>>200</option>   
  
  </select>

</div>


</div>
    
    
   
    </div>


</div><!-- end card -->

</form>













<div class="clearfix"></div>
 
<div class="card">
<div class="card-header">

<div id="ajax_response_msg" class="float-right" style="color:green;"></div><!-- ajax -->

<span>
Found <?php echo $TOTALITEMS; ?> items. (page <?php if(!isset($_GET['cpage'])){ echo 1; }else{ echo $_GET['cpage']; } ?> of <?php if($TOTALPAGES == 0){ echo 1; }else{ echo $TOTALPAGES; } ?>)
</span>
</div>
<div class="card-body1"> 



<style>

.image img { max-width:52px; max-height:52px; overflow: hidden; border:1px solid #ddd; padding:2px; }
.featured i { font-size:20px; color:#ccc; }
.featured i.fa-star { color: #ff8c52; text-shadow: 1px 1px #fff; }
.wlt_shortcode_category a { font-size:12px; }
.wlt_shortcode_category a:after {     content: "\f105"; font-family: FontAwesome; margin-left:5px;  }
.wlt_shortcode_category a:last-child::after {  content: ''; }
</style>

<table  class="responsive table table-striped table-bordered " >
            <thead>
            <tr>
             <th class="no_sort" style="text-align:center;">
                Photo
              </th>
             
              <th class="no_sort" >
               User Details
              </th> 
                <th class="no_sort" style="text-align:center;">
                <a href="users.php?page=users&credit=1">Credit</a>
              </th>
           
          <th class="no_sort" style="text-align:center;">
               Verified
              </th>
              
                 <th class="no_sort" style="text-align:center;">
               Logins
              </th>
             
              <th class="ms no_sort" style="text-align:center;">
                Actions
              </th>
            </tr>
            </thead>
            <tbody>

<script>
function update_field_title(id, title){
 
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/index.php',		
		data: {
            admin_action: "update_title",
			title: title,
			id, id
 
        },
        success: function(response) {
			jQuery('#ajax_response_msg').html(response);			
        },
        error: function(e) {
            alert("error "+e)
        }
    });



 
}
</script>
       
<?php 
 

 
if (!empty($authors)){
$tabin = 1;
foreach ($authors as $author)    { //die(print_r($author));   ?>

<tr id="postid-<?php echo $author->ID; ?>">
 
 <td style="text-align:center; width:80px;">
 
     <div class="image">
    <a href="<?php echo get_author_posts_url( $author->ID ); ?>" alt="" rel="tooltip" data-original-title="User ID: <?php echo $author->ID; ?>" data-placement="top">
    
	<?php echo str_replace("avatar ","avatar img-fluid ",get_avatar( $author->ID, 50 )); ?>
    
    </a>
     </div>
 
 </td> 

 
<td>

<div style="font-size:16px; font-weight:bold; margin-bottom:5px;">
<?php echo $CORE->user_display_name($author->ID); ?>
</div>

<a href="admin.php?page=3&tab=send&emailto=<?php echo $author->user_email; ?>" target="_blank"> <i class="fa fa-envelope-open-o" aria-hidden="true"></i> <?php echo $author->user_email; ?> </a> 

/ <a href="#" rel="tooltip" data-original-title="Registered: <?php echo hook_date($author->user_registered); ?>" data-placement="top">  <i class="fa fa-user-circle" aria-hidden="true"></i> <?php echo $author->user_login; ?> </a>

<?php 

// LAST LOGIN

$date1 = get_user_meta($author->ID, 'login_lastdate', true);
if($date1 == ""){
$date1 = '<i class="fa fa-close" aria-hidden="true"></i> user never logged in';
}else{
$date1 = "last login: ".hook_date($date1);
}
 
$ff = $CORE->date_timediff($date1,''); ?>

<div style="font-size:11px; margin-top:5px;">

<a href="#" rel="tooltip" data-original-title="Joined <?php echo hook_date($author->user_registered); ?>" data-placement="top" style="color:#666666;"><?php echo $date1; ?></a>

</div>
 


<?php if(isset($author->caps->administrator)){ ?><span class="tag tag-danger">Administrator</span><?php } ?>

  
        
</td>
 <td style="text-align:center; width:80px;">
 
    
<?php

$user_balance = get_user_meta($author->ID,'wlt_usercredit',true);
if($user_balance == ""){ $user_balance = 0; }

echo hook_price($user_balance); 

?>
 
 </td>
 
  <td style="text-align:center; width:80px;">


<?php

$user_verified = get_user_meta($author->ID,'wlt_verified',true);
if($user_verified != "yes"){ echo "-"; }else{ 

?>
 <div class="badge badge-success">Yes</div>
<?php } ?> 
    
 </td>
 
 
 <td style="text-align:center; width:80px;">


<a href="#" rel="tooltip" data-original-title="Joined <?php hook_date($author->user_registered); ?>" data-placement="top"> 
<?php

$lcount = get_user_meta($author->ID, 'login_count', true);
if(!is_numeric($lcount)){ echo 0; }else{ echo $lcount; } ?>

</a>
 
 
    
 </td>

 
              
<td class="ms" style="text-align:center; width:100px">

<div class="mt-1">

<a class="btn btn-primary btn-sm" href="user-edit.php?user_id=<?php echo $author->ID; ?>"  rel="tooltip" data-original-title="Edit" data-placement="top">
	<i class="fa fa-pencil"></i>
</a> 

<?php /*   
<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="ajax_load_media(<?php echo $post->ID; ?>);"  rel="tooltip" data-original-title="Manage Files" data-placement="top">
	<i class="fa fa-photo"></i>
</a> */ ?>


<a href="javascript:void(0);" onclick="ajax_delete_user(<?php echo $author->ID; ?>);" class="btn btn-danger btn-sm" rel="tooltip" data-placement="top" data-original-title="Delete">
	<i class="fa fa-trash"></i>
</a>      

</div>      
                
              </td>
            </tr>
            
<?php $tabin++; } // end foreach ?>
 

<?php } // end if ?>            
              
             
            </tbody>
            </table> 
 

       
            
</div><!-- end card block -->
</div><!-- end card -->

<div class="clearfix"></div>

<div class="mb-3 mt-3">


         
     
    <div class="mb-3"> Page <?php if(!isset($_GET['cpage'])){ echo 1; }else{ echo $_GET['cpage']; } ?> of <?php if($TOTALPAGES == 0){ echo 1; }else{ echo $TOTALPAGES; } ?></div> 
                
    <nav aria-label="Page navigation">
    <ul class="pagination">
    <?php
    $pages = new wlt_admin_paginator;
    $pages->items_total = $TOTALITEMS;
    $pages->items_per_page = $ITEMSPERPAGE;
    $pages->mid_range = $ITEMSPERPAGE/2;
    $pages->pagelink = home_url()."/wp-admin/users.php?page=users&".$_SERVER['QUERY_STRING'];
    $pages->paginate();
    echo $pages->display_pages();
    ?>
    </ul>
    </nav>


</div>
 