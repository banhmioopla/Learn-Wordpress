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

global $wpdb, $CORE, $userdata, $CORE_ADMIN;

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
  
?> 
 
 
<div class="card">
<div class="card-header">
<span>
Additional Text
</span>
</div>
<div class="card-body">


<label>Add Listing Text</label><br />

<textarea style="height:140px;" class="form-control" name="admin_values[custom][add_text]"><?php echo stripslashes(_ppt(array('custom','add_text'))); ?></textarea> 

<p class="mt-1">Text you enter here will display under the header of the submission form when a user is creating a new listing.</p>

                  


<label>Edit Listing Text</label><br />

<textarea  style="height:140px;" class="form-control"  name="admin_values[custom][edit_text]"><?php echo stripslashes(_ppt(array('custom','edit_text'))); ?></textarea> 

<p class="mt-1">Text you enter here will display under the header of the submission form when a user is editing an existing listing.</p>


</div><!-- end block -->
</div><!-- end card --> 