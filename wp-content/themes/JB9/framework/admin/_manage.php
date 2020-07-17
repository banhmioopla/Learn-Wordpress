<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;



// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");


// SET LAST VIEWED TIME
if(isset($_GET['new'])){
update_option('ppt_listings_lastviewed', $CORE->DATETIME() );
}
 
// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(); ?>
</form>

 
<div class="row"> 
   <div class="col-md-12">
      <div class="tab-content">
         <?php get_template_part('framework/admin/templates/admin', 'manage' ); ?> 
      </div>
   </div>
</div>
 
<script>

function ajax_load_media(id){

tb_show('', 'admin.php?page=add&eid='+id+'&action=edit&mediaonly&amp;TB_iframe=true');
return false;

}

function ajax_featured_listing(id){

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "listing_featured",
			pid: id,
        },
        success: function(response) {
					
			if(response.current == "yes"){
					
				// CHANGE ICON
				jQuery('#postid-'+id+' .featured .fa').addClass('fa-star').removeClass('fa-star-o');					 
  		 	
			}else{		
				
				// CHANGE ICON
				jQuery('#postid-'+id+' .featured .fa').addClass('fa-star-o').removeClass('fa-star');					 
  		 		
			}	
			
			
			jQuery('#ajax_response_msg').html("Listing Updated");		
        },
        error: function(e) {
            alert("error "+e)
        }
    });
}

function ajax_delete_listing(id){

// RESET
jQuery('#ajax_response_msg').html("");	


jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',	
		dataType: 'json',	
		data: {
            action: "listing_delete",
			pid: id,
        },
        success: function(response) {			
			if(response.status == "ok"){
					
				// HIDE ROW
				jQuery('#postid-'+id).hide();	
				
				// LEAVE MESSAGE				
				jQuery('#ajax_response_msg').html("Listing deleted successfully");	
				 
  		 	
			}else{			
				jQuery('#ajax_response_msg').html("Error trying to delete.");			
			}			
        },
        error: function(e) {
            alert("error "+e)
        }
    });
	
}// end are you sure

 
jQuery(document).ready(function() {
	jQuery('.card-footer').hide(); 
});

</script>

<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(); ?>