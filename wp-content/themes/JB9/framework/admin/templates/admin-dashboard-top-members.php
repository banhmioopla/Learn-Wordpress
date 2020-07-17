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

?> 
 
<table class="table table-bordered table-striped table-userimg">
<thead>
              <tr>
                
                <th>User</th>
           		<th style="width:100px; text-align:center;">Count</th>
                
                <th style="width:50px; text-align:center"></th>
              </tr>
            </thead>
            <tbody>
 
 <?php

	// Query for users based on the meta data
	$user_query = new WP_User_Query(
		array(
			'orderby'	  =>	'meta_value_num',		  
			'order' => 'desc',
		 	'number'    => 6,
			'meta_query' => array( 
				'login_count' => array(
				'key'     => 'login_count',
				'value'   => '0',
	 			'compare' => '>' 
				),
			),
		)
	);

	// Get the results from the query, returning the first user
	$users = $user_query->get_results();
	
	if(!empty($users)){
	foreach($users as $user){

?>
 
 <tr>
 
 
 
<td>


    <a href="user-edit.php?user_id=<?php echo $user->data->ID; ?>" rel="tooltip" data-original-title="User ID <?php echo $user->data->ID; ?>" data-placement="top" style="float:left; margin-right:8px;">
    
	<?php echo str_replace("avatar ","avatar img-fluid ",get_avatar( $user->data->ID, 25 )); ?>
    
    </a> 
	
<a href="user-edit.php?user_id=<?php echo $user->data->ID; ?>"  rel="tooltip" data-original-title="Edit" data-placement="right">
	<?php echo $CORE->user_display_name($user->data->ID); ?>
    </a>

</td> 

<td style="width:100px; text-align:center;">
 
<a href="#" rel="tooltip" data-original-title="Last login <?php echo hook_date(get_user_meta($user->data->ID, 'login_lastdate', true)); ?>" data-placement="top"> 
<?php echo get_user_meta($user->data->ID,'login_count',true); ?>
</a>

</td> 


<td style="width:50px; text-align:center">
<a href="user-edit.php?user_id=<?php echo $user->data->ID; ?>" rel="tooltip" data-original-title="User ID <?php echo $user->data->ID; ?>" data-placement="top" >
    
<i class="fa fa-search"></i>
    
    </a>
</td> 

</tr>
    
 
<?php } } ?> 

    
</tbody> </table>