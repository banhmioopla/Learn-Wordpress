<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  


if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){
 
 // REMOVE FIELD
if(isset($_POST['newzone'])  && current_user_can( 'edit_user', $userdata->ID )){
			
	// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
	$wlt_zones = get_option("wlt_zones");
	if(!is_array($wlt_zones)){ $wlt_zones = array(); }
	// ADD ONE NEW FIELD 
	if(!isset($_POST['eid'])){
		$_POST['wlt_zone']['ID'] = count($wlt_zones);
		array_push($wlt_zones, $_POST['wlt_zone']);
		
		$GLOBALS['error_message'] = "zone Created Successfully";
	}else{
		$wlt_zones[$_POST['eid']] = $_POST['wlt_zone'];
		
		$GLOBALS['error_message'] = "zone Updated Successfully";
	}
	// SAVE ARRAY DATA		 
	update_option( "wlt_zones", $wlt_zones, true);
				
}elseif(isset($_GET['delete_zone']) && is_numeric($_GET['delete_zone'] )  && current_user_can('administrator')){

	// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
	$wlt_zones = get_option("wlt_zones");
	if(!is_array($wlt_zones)){ $wlt_zones = array(); }
	// LOOK AND SEARCH FOR DELETION
	foreach($wlt_zones as $key=>$pak){
		if($key == $_GET['delete_zone']){
			unset($wlt_zones[$key]);		 
		}
	}
	// SAVE ARRAY DATA
	update_option( "wlt_zones", $wlt_zones, true);

	$GLOBALS['error_message'] = "zone Deleted Successfully";
  
// REMOVE FIELD
}elseif(isset($_POST['newbanner'])  && current_user_can( 'edit_user', $userdata->ID )){
			
	// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
	$wlt_banners = get_option("wlt_banners");
	if(!is_array($wlt_banners)){ $wlt_banners = array(); }
	// ADD ONE NEW FIELD 
	if(!isset($_POST['eid'])){
		$_POST['wlt_banner']['ID'] = count($wlt_banners);
		array_push($wlt_banners, $_POST['wlt_banner']);
		
		$GLOBALS['error_message'] = "Banner Created Successfully";
	}else{
		$wlt_banners[$_POST['eid']] = $_POST['wlt_banner'];
		
		$GLOBALS['error_message'] = "Banner Updated Successfully";
	}
	// SAVE ARRAY DATA		 
	update_option( "wlt_banners", $wlt_banners, true);
				
}elseif(isset($_GET['delete_banner']) && is_numeric($_GET['delete_banner'] )  && current_user_can('administrator')){

	// GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
	$wlt_banners = get_option("wlt_banners");
	if(!is_array($wlt_banners)){ $wlt_banners = array(); }
	// LOOK AND SEARCH FOR DELETION
	foreach($wlt_banners as $key=>$pak){
		if($key == $_GET['delete_banner']){
			unset($wlt_banners[$key]);		 
		}
	}
	// SAVE ARRAY DATA
	update_option( "wlt_banners", $wlt_banners, true);

	$GLOBALS['error_message'] = "Banner Deleted Successfully";
}

}


// LOAD IN HEADER
echo $CORE_ADMIN->HEAD();
 
?>

 
<?php get_template_part('framework/admin/templates/admin', 'sidebar' ); ?> 
 
<div class="main-body-column">

<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?> 

<div class="tab-content ppt-wrap">

      <div class="tab-pane <?php if(!isset($_POST['tab']) || ( isset($_POST['tab']) && $_POST['tab'] =="" ) || ( isset($_POST['tab']) && $_POST['tab'] == "overview" ) ){ echo "active in"; } ?>" id="overview" >
         
			<div class="padding">    
             
			<?php get_template_part('framework/admin/templates/admin', '7-overview' ); ?> 
              
			</div>
        
        </div> 
        
        <!-- end overview -->
        
        <div class="tab-pane <?php if(isset($_POST['tab']) && $_POST['tab'] == "banners"){ echo "active in"; } ?>"  id="banners">
        
        <div class="padding">  
        
        <h4>Banners</h4>      	
            
        	<?php get_template_part('framework/admin/templates/admin', '7-banners' );  ?> 
            
            <div class="text-center savebtn"> <button class="btn btn-lg btn-secondary">Save Changes</button> </div>
        
        </div></div>
         
		<!-- end tab -->
        
        <div class="tab-pane <?php if(isset($_POST['tab']) && $_POST['tab'] == "bannerass"){ echo "active in"; } ?>"  id="bannerass">
        
        <div class="padding"> 
        
        <h4>Banner Assignment</h4>
            
        	<?php get_template_part('framework/admin/templates/admin', '7-bannerassign' );  ?>
            
            <div class="text-center savebtn"> <button class="btn btn-lg btn-secondary">Save Changes</button> </div>
        
        </div></div>
         
		<!-- end tab -->
        
 
        <div class="tab-pane <?php if(isset($_POST['tab']) && $_POST['tab'] == "sell"){ echo "active in"; } ?>"  id="sell">
        
        <div class="padding"> 
        
  		<h4>Sellspace Advertising</h4>
            
        	<?php get_template_part('framework/admin/templates/admin', '7-sellspace' );  ?> 
        
        	<div class="text-center savebtn"> <button class="btn btn-lg btn-secondary">Save Changes</button> </div> 
        
        </div></div>
         
 
    </div><!-- end container -->
    
    <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>

</div>









 <?php if(isset($_GET['edit_banner']) && is_numeric($_GET['edit_banner']) ){ 
$wlt_banners = get_option("wlt_banners");

?>
<script>
jQuery(document).ready(function () { loadSingleForm('#admin_banner_wrap'); })
</script>
<?php } ?>

<div id="admin_banner_wrap" style="display:none;">

<form method="post" name="admin_banner" id="admin_banner" action="admin.php?page=7">
<input type="hidden" name="newbanner" value="yes" />
<input type="hidden" name="tab" value="banners" />
<?php if(isset($_GET['edit_banner'])){ ?>
<input type="hidden" name="eid" value="<?php echo $_GET['edit_banner']; ?>" />
<input type="hidden" name="wlt_banner[views]" value="<?php if(isset($wlt_banners[$_GET['edit_banner']]['views'])){ echo $wlt_banners[$_GET['edit_banner']]['views']; } ?>" />
<input type="hidden" name="wlt_banner[ID]" value="<?php echo $wlt_banners[$_GET['edit_banner']]['ID']; ?>" />
<?php }

if(isset($_GET['edit_banner']) && isset($wlt_banners[$_GET['edit_banner']]['category'])){ $dcatid = $wlt_banners[$_GET['edit_banner']]['category']; }else{  $dcatid = 0; }
 ?>
 
 <h4 class="title">Add/Edit Banner
 
 <a href="#" onclick="hideSingleForm();" class="btn btn-goback btn-danger btn-sm float-right" > Go Back </a>
 
 </h4>

<div class="card">
<div class="card-header"><span>Add/Edit Banner</span></div>
<div class="card-body"> 

<div class="row">
<div class="col-6">

	<div class="form-group">
    
                <label class="control-label" for="normal-field"><b>Title</b></label>
               
                  <input type="text"  name="wlt_banner[subject]" class="form-control" value="<?php if(isset($_GET['edit_banner'])){ echo stripslashes($wlt_banners[$_GET['edit_banner']]['subject']); }?>">
                   
                
              </div> 
              
              
              <div class="">
                <label class="control-label" for="normal-field"><b>Display Category</b></label>
               
             
                    <select name="wlt_banner[category][]"  id="style" multiple="multiple" data-placeholder="" class="form-control" style="height:200px; overflow:scroll"> 
                    <option></option>                  
                   <?php echo $CORE->CategoryList(array($dcatid,false,0,THEME_TAXONOMY)); ?>                  
                  </select>  
                
                
              </div> 
              
           <div class="mt-3 font-size12">Leave blank to display on all pages/categories.</div>
              

</div>
<div class="col-6">
	
    <div class="">
                <label class="control-label " for="normal-field"><b>Banner Code</b></label>
                 
                  <textarea name="wlt_banner[code]" class="form-control" style="min-height:200px;" ><?php if(isset($_GET['edit_banner'])){ echo stripslashes($wlt_banners[$_GET['edit_banner']]['code']); }?></textarea>                  
                
              </div> 
              
</div>
</div>
                 
</div> 

<div class="text-center savebtn"> <button class="btn btn-lg btn-secondary">Save Changes</button> </div>
 

</div> 

</form>

</div> 










 


 <?php if(isset($_GET['edit_zone']) && is_numeric($_GET['edit_zone']) ){ 
$wlt_zones = get_option("wlt_zones");

?>
<script >
jQuery(document).ready(function () { jQuery('#zoneModal').modal('show'); })
</script>
<?php } ?>


<div id="admin_banner_zon_wrap" style="display:none;">


<form method="post" name="admin_zone" id="admin_zone" action="admin.php?page=7">
<input type="hidden" name="newzone" value="yes" />
<input type="hidden" name="tab" value="sell" />
<?php if(isset($_GET['edit_zone'])){ ?>
<input type="hidden" name="eid" value="<?php echo $_GET['edit_zone']; ?>" />
<input type="hidden" name="wlt_zone[views]" value="<?php echo $wlt_zones[$_GET['edit_zone']]['views']; ?>" />
<input type="hidden" name="wlt_zone[ID]" value="<?php echo $wlt_zones[$_GET['edit_zone']]['ID']; ?>" />
<?php }

if(isset($_GET['edit_zone']) && isset($wlt_zones[$_GET['edit_zone']]['category'])){ $dcatid = $wlt_zones[$_GET['edit_zone']]['category']; }else{  $dcatid = 0; }
 ?>

<h4>Zone Settings</h4>

<div class="card">
<div class="card-header"><span>Add/Edit Banner</span></div>
<div class="card-body"> 
               
          	 <div class="">
                <label class="control-label col-md-3" for="normal-field"><b>Zone Title</b></label>
                <div class="controls col-md-7">
                  <input type="text"  name="wlt_zone[subject]" class="form-control" value="<?php if(isset($_GET['edit_zone'])){ echo stripslashes($wlt_zones[$_GET['edit_zone']]['subject']); }?>">
                   
                </div>
              </div> 
              
          	 <div class="">
                <label class="control-label col-md-3" for="normal-field"><b>Price (per banner)</b></label>
                <div class="controls col-md-7">
                  <input type="text"  name="wlt_zone[price]" class="form-control" value="<?php if(isset($_GET['edit_zone'])){ echo stripslashes($wlt_zones[$_GET['edit_zone']]['price']); }?>">
                   
                </div>
              </div> 
              
              <div class="">
                <label class="control-label col-md-3" for="normal-field"><b>Banner Size</b></label>
                <div class="controls col-md-7">
                  <input type="text"  name="wlt_zone[price]" class="form-control" value="<?php if(isset($_GET['edit_zone'])){ echo stripslashes($wlt_zones[$_GET['edit_zone']]['price']); }?>">
                   
                </div>
              </div> 
              
          <div class="text-center savebtn"> <button class="btn btn-lg btn-secondary">Save Changes</button> </div>

</div></div>

</form>

</div>

<?php echo $CORE_ADMIN->FOOTER(); ?>