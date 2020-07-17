<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;

// LOAD IN OPTIONS FOR SORTING DATA
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );


// GET FIELDS
$cfields = get_option("cfields"); 
 
if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){

if(isset($_POST['TransferFormMemberships']) && is_numeric($_POST['from']) && is_numeric($_POST['to'])){
 
 if($_POST['from'] == "-2"){
 
 	$SQL = "SELECT mt1.ID FROM ".$wpdb->prefix."users AS mt1
	LEFT JOIN ".$wpdb->prefix."usermeta AS mt2 ON (mt1.ID = mt2.user_id AND mt2.meta_key = 'wlt_membership')
	WHERE mt2.meta_key IS NULL 
	GROUP BY mt1.ID";
	$result = mysql_query($SQL, $wpdb->dbh);					 
		if (mysql_num_rows($result) > 0) {
			while ($val = mysql_fetch_object($result)){
			update_user_meta($val->ID,'wlt_membership',$_POST['to']);
			}
		}
 
 }elseif($_POST['from'] == "-1"){
 $gg = explode(",",$_POST['all']); $ext = "";
 foreach($gg  as $gh){
 $ext .= "AND ".$wpdb->prefix."usermeta.meta_value != '".$gh."' ";
 }
 $SQL = "UPDATE ".$wpdb->prefix."usermeta SET ".$wpdb->prefix."usermeta.meta_value = '".$_POST['to']."' WHERE ".$wpdb->prefix."usermeta.meta_key = 'wlt_membership' AND ".$wpdb->prefix."usermeta.meta_value != '".$_POST['from']."' ". $ext;
 
 mysql_query($SQL);
 }else{
 $SQL = "UPDATE ".$wpdb->prefix."usermeta SET ".$wpdb->prefix."usermeta.meta_value = '".$_POST['to']."' WHERE ".$wpdb->prefix."usermeta.meta_key = 'wlt_membership' AND ".$wpdb->prefix."usermeta.meta_value = '".$_POST['from']."'";
 mysql_query($SQL);
 }
 
 $GLOBALS['error_message'] = "Memberships Transfered Successfully";
 
}


if(isset($_POST['TransferFormListings']) && is_numeric($_POST['from']) && is_numeric($_POST['to'])){
 
 if($_POST['from'] == "-2"){
 
 	$SQL = "SELECT ".$wpdb->prefix."posts.ID, mt2.meta_value FROM ".$wpdb->prefix."posts 
	LEFT JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND mt2.meta_key = 'packageID')
	WHERE ".$wpdb->prefix."posts.post_type = '".THEME_TAXONOMY."_type' 
	AND ( ".$wpdb->prefix."posts.post_status = 'draft' OR ".$wpdb->prefix."posts.post_status = 'publish' )  
	AND mt2.meta_key IS NULL 
	GROUP BY ".$wpdb->prefix."posts.ID";
	$result = mysql_query($SQL, $wpdb->dbh);					 
		if (mysql_num_rows($result) > 0) {
			while ($val = mysql_fetch_object($result)){
			update_post_meta($val->ID,'packageID',$_POST['to']);
			}
		}
 
 }elseif($_POST['from'] == "-1"){
 $gg = explode(",",$_POST['all']); $ext = "";
 foreach($gg  as $gh){
 $ext .= "AND ".$wpdb->prefix."postmeta.meta_value != '".$gh."' ";
 }
 $SQL = "UPDATE ".$wpdb->prefix."postmeta SET ".$wpdb->prefix."postmeta.meta_value = '".$_POST['to']."' WHERE ".$wpdb->prefix."postmeta.meta_key = 'packageID' AND ".$wpdb->prefix."postmeta.meta_value != '".$_POST['from']."' ". $ext;
 mysql_query($SQL);
 }else{
 $SQL = "UPDATE ".$wpdb->prefix."postmeta SET ".$wpdb->prefix."postmeta.meta_value = '".$_POST['to']."' WHERE ".$wpdb->prefix."postmeta.meta_key = 'packageID' AND ".$wpdb->prefix."postmeta.meta_value = '".$_POST['from']."'";
 mysql_query($SQL);
 }
 
 $GLOBALS['error_message'] = "Listing Transfered Successfully";
 
}

}

if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){
	// REMOVE PACKAGE FIELD
	if(isset($_POST['newsubmissionfield'])){
	
		// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
		$submissionfields = get_option("submissionfields");
		
	// FIX FOR TAX 	
	if($_POST['submissionfield']['fieldtype'] == "taxonomy"){
		$_POST['submissionfield']['key'] = "tax_".date('dmyhis');
	}
 
		if(!is_array($submissionfields)){ $submissionfields = array(); }
		// ADD ONE NEW FIELD 
		if(!isset($_POST['eid'])){
			$_POST['submissionfield']['ID'] = count($submissionfields);
			array_push($submissionfields, $_POST['submissionfield']);
			
			$GLOBALS['error_message'] = "Custom Field Added Successfully";
		}else{
			$submissionfields[$_POST['eid']] = $_POST['submissionfield'];
			
			$GLOBALS['error_message'] = "Custom Field Updated Successfully";
		}
		// SAVE ARRAY DATA		 
		update_option( "submissionfields", $submissionfields);
					
	}elseif(isset($_GET['delete_submission_field']) && is_numeric($_GET['delete_submission_field'] )){
	
		// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
		$submissionfields = get_option("submissionfields");
		if(!is_array($submissionfields)){ $submissionfields = array(); }	
		
		// DELETE SELECTED VALUE
		unset($submissionfields[$_GET['delete_submission_field']]);
		
		// SAVE ARRAY DATA
		update_option( "submissionfields", $submissionfields);
		
		$_POST['tab'] = "submission";
		$GLOBALS['error_message'] = "Custom Field Removed Successfully";
	

	}
}

// SORT TABBING
if(isset($_GET['edit_submission_field']) && is_numeric($_GET['edit_submission_field']) ){ 
$_POST['tab'] = "submission";
}





$core_admin_values = get_option("core_admin_values");
 
// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1);

?>
 
  
      	<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>
         <?php get_template_part('framework/admin/templates/admin', '5-overview' ); ?> 
     <div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 
         <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>
  


<form id="TransferFormListing" name="TransferFormListing" method="post" action="">
<input type="hidden" name="TransferFormListings" id="go" />
<input type="hidden" name="tab" id="ShowTab" value="packages">
<input type="hidden" name="from" id="fromL" value="" />
<input type="hidden" name="to" id="toL" value="" />
</form> 

<div style="display:none">
   <div id="customfieldlist_new">
      <li class="cfielditem">
         <div class="heading">
            <div class="name">New Custom Field</div>
         </div>
         <div class="inside">   
            <input type="hidden" name="cfield[values][]" value=""  />
            <input type="hidden" name="cfield[cat][]" value=""  />
            <input type="hidden" name="cfield[fieldtype][]" value="input"  />
            <input type="hidden" name="cfield[required][]" value="0"  />
            <label>Display Caption</label>
            <input type="text" name="cfield[name][]" value=""  style="width:100%;" class="form-control"  />  
            <input type="hidden" id="newcfieldkey" name="cfield[dbkey][]" value="custom-"  />
            <button class="btn btn-primary mt-2 " type="submit">Save</button>
         </div>
      </li>
   </div>
</div>
<script>
jQuery(document).ready(function() {
	jQuery('#newcfieldkey').val( "custom-" + ( jQuery('#customfieldlist li').length + 1 ) );
});

</script>

<div style="display:none">
   <div id="customfieldlist1_new">
      <li class="cfielditem">
         <div class="heading">
            <div class="name">New Enhancement</div>
         </div>
         <div class="inside">    
            <label>Display Caption</label>
            <input type="text" name="cenhancement[name][]" value=""  style="width:100%; font-size:11px;" class="form-control"  />  
            <button class="btn btn-primary margin-top1" type="submit">Save</button>
         </div>
      </li>
   </div>
</div>
<div style="display:none">
   <div id="package-list_new">
      <li class="cfielditem">
         <div class="heading">
            <div class="name">New Package</div>
         </div>
         <div class="inside">
            <label>Package Name <span class="required">*</span></label>
            <input type="text" name="cpackages[name][]" value="" id="nfaqt" class="form-control" />  
            <input type="hidden" name="cpackages[price][]" value="100"  />  
            <input type="hidden" name="cpackages[key][]" value="pack<?php echo rand(); ?>"   />    
            <input type="hidden" name="cpackages[html][]" value="0"   />    
            <input type="hidden" name="cpackages[recurring][]" value="0"   />    
            <input type="hidden" name="cpackages[files][]" value="100"   />    
            <input type="hidden" name="cpackages[cats][]" value="100"   />    
            <input type="hidden" name="cpackages[days][]" value="30"   />    
            <input type="hidden" name="cpackages[subtitle][]" value=""   />
            <input type="hidden" name="cpackages[stars][]" value="0"   />
            <input type="hidden" name="cpackages[icon][]" value="fa fa-star"   />
            <input type="hidden" name="cpackages[active][]" value="0"   />
            <hr />
            <button class="btn btn-primary" type="submit" onclick="checknotblank()">Save</button>
         </div>
      </li>
   </div>
</div>



 
<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(2); ?>