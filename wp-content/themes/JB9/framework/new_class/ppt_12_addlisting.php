<?php


class framework_addlisting extends framework_advertising {


function get_listing_package_name($packageID){
	
	
	if($packageID == 99){
	
	return  __("Free Listing","premiumpress");
	}
	$i=0; 
	$paknames = array('Basic','Standrad','Premium');
	
	while($i < 3){ 		
	
		if($packageID == $i){ 
		
			if(_ppt('pak'.$i.'_name') == ""){ 
			return  $paknames[$i]; 
			}else{ 
			return  _ppt('pak'.$i.'_name'); 
			}  
		}
		
		$i++; 
	
	}
	
	return "";

}

function error_display(){

if(!isset($GLOBALS['error_message'])){ return; }
if(!isset($GLOBALS['error_type'])){ $GLOBALS['error_type'] = "success"; }

switch($GLOBALS['error_type']){

	case "success": {
		
		$css = "alert alert-success";
		
	} break;

	case "error": {
	
		$css = "alert alert-danger";
	
	} break;
	
	case "warning": {
	
		$css = "alert alert-warning";
	
	} break;	
	default: {
	
	$css = "alert alert-success";
	
	}
	
}
 
?>
<div class="<?php echo $css; ?>">
	<?php if(isset($GLOBALS['error_title'])){ ?><h4 class="alert-heading"><?php echo $GLOBALS['error_title']; ?></h4><?php } ?>    
    <p class="mb-0"><?php echo $GLOBALS['error_message']; ?></p>
</div>
<?php 
 
}


/*
	this function gets the date left for the listing expiry

*/
function get_listing_expirydate($postid){

	
	$date_expires = get_post_meta($postid, 'listing_expiry_date', true);
	if($date_expires == ""){	
	return 0; // NEVER EXPIRES	
	}else{
	return $date_expires;	
	}

}

/*
	functon turns true/false if a listing has expired
*/
function has_expired($postid){

	$expires = $this->get_listing_expirydate($postid);
	
	if($expires == ""){ 
		return 0;
	}
	
	$ff = $this->date_timediff($expires,'');
	 
	if($ff['expired'] == 1) { 
		return 1;
	}
	
	return 0;

}



	/*
		this function gets the data for a listing
	*/
	function get_edit_data($field, $postid){ global $userdata;
	
		// CHECK IF WE ARE EDITING A LISTING
		if(is_numeric($postid) ){
		
			// GET POST DATA	
			$edit_data = get_post($postid);
			
			// CHECK WE ARE THE AUTHOR
			if($edit_data->post_author != $userdata->ID && !current_user_can('administrator') ){
			die("Not your post!");
			}
		
			// GET CUSTM FIELD DATA 
			$editdata = array();
			$custom_fields 	= get_post_custom($postid);
			foreach ( $custom_fields as $key => $value ){	
				$editdata[$key] =  $value[0];	
			}
			// STORE DATA IN ARRAY TO BE PASSED TO OUR CORE FUNCTIONS
			$editdata['post_title'] 	=  $edit_data->post_title;
			$editdata['post_excerpt'] 	=  $edit_data->post_excerpt;
			$editdata['post_content'] 	=  preg_replace("/<div style='display:none'>(.*?)<\/div>/", "", $edit_data->post_content);
			$editdata['post_status'] 	=  $edit_data->post_status;
			 
			// CHECK FOR FIELD VALUES
			
			$tfs = wp_get_post_tags($postid);
			 
			$ftags = "";
			if(!empty($tfs)){
				foreach($tfs as $ta){ $ftags .= $ta->name.", "; }
			}			
			$editdata['post_tags'] 	= $ftags;	
			 
		}
		
		if(isset($editdata[$field])){
			return $editdata[$field];
		}else{
			return "";
		}
	}





	/*
		this function counts how many packages
		there are
	*/
	function packages_count(){
	
		$cpackages = get_option("cpackages"); 
		if(!is_array($cpackages)){ return 0; }  
		
		$counter = 0;
		if(is_array($cpackages) && !empty($cpackages) ){ $i=0; 

		foreach($cpackages['name'] as $data){  
		
			if($cpackages['name'][$i] != "" ){ 
				$counter ++;			
			} 
			$i++; 
			} 
		}
		
		return $counter;
		 
	}
	
	
/*
function packages_get($key){

	$data = array();

	$cpackages = get_option("cpackages"); 
	if(is_array($cpackages) && !empty($cpackages) ){ 
	 
		$i=0;	
		foreach($cpackages['name'] as $xxx){ 
		 	
			if($cpackages['key'][$i] == $key){						 
				 
				return array(
				"key" => $cpackages['key'][$i], 
				"name" =>  $cpackages['name'][$i],
				"subtitle" =>  $cpackages['subtitle'][$i],
				"price" =>  $cpackages['price'][$i],
				
				"days" =>  $cpackages['days'][$i],
				
				"cats" =>  $cpackages['cats'][$i],
				"files" =>  $cpackages['files'][$i], 
				
				);				 
				
			}	
			
			$i++;			
		}
	}// end if has subscription	
	return $data;
}


	function packages_array(){
	
		$cpackages = get_option("cpackages"); 
		if(!is_array($cpackages)){ return 0; }  
		
		$counter = 0; $newArray = array();
		if(is_array($cpackages) && !empty($cpackages) ){ $i=0; 

		foreach($cpackages['name'] as $data){  
		
			if($cpackages['name'][$i] != "" ){ 
				$newArray[]	= array(
				"key" => $cpackages['key'][$i], 
				"name" =>  $cpackages['name'][$i],
				"subtitle" =>  $cpackages['subtitle'][$i],
				"price" =>  $cpackages['price'][$i],
				
				"days" =>  $cpackages['days'][$i],
				
				"cats" =>  $cpackages['cats'][$i],
				"files" =>  $cpackages['files'][$i], 
				
				);		
			} 
			$i++; 
			} 
		}
		
		return $newArray;
		 
	}


function listing_enhancements($postid){ global $CORE, $userdata;

	$cenhancement = get_option("cenhancement"); 
	if(is_array($cenhancement)){ $i=0; 
	
	?>
    <div id="ehancements-wrapper">
    <?php
	
	foreach($cenhancement['name'] as $data){ 
	
		if($cenhancement['name'][$i] != "" ){ 
		
		if($cenhancement['price'][$i] == 0 ){ $i++; continue; }
		
		$fk = get_post_meta($postid, $cenhancement['key'][$i], true); 
	
		// check listing to see if this key already eists
		$canContinue = true;
		if(isset($cenhancement['key'][$i])){ 
		
			$fk = get_post_meta($postid, $cenhancement['key'][$i], true); 
			
			if($fk == "yes"){
				$canContinue = false;
			}
			
		}
		
		
		?> 
		<div class="payment-item enhancement clearfix margin-bottom2"> 
        <div class="row">
        
			<div class="col-md-7">
            <b><?php echo stripslashes($cenhancement['name'][$i]); ?></b>
            <div class="desc"> <?php echo stripslashes($cenhancement['desc'][$i]); ?></div>
            </div>
            
            
            <?php if(!$canContinue){ ?>
            <div class="col-md-4 text-right">
            	<div><?php echo __("Active","premiumpress"); ?></div>
            </div>
            <?php } ?>
            
            <?php if($canContinue){ ?>
            
			<div class="col-md-2 text-center"> 
				<span class="price bold size18"><?php echo hook_price($cenhancement['price'][$i]); ?></span> 
			</div>  
			<div class="col-md-2"> 
            
            
				<button class="btn btn-primary" onclick="ajax_load_enhancement_payment(<?php echo $i; ?>, '<?php echo $cenhancement['price'][$i]; ?>','<?php echo stripslashes($cenhancement['name'][$i]); ?>')">
                
                <?php echo __("Upgrade","premiumpress"); ?>
                
                </button>
                
                
<input type="hidden" id="ppt_orderdata_upgrade<?php echo $i; ?>" value="<?php 

echo $CORE->order_encode(array(

	"uid" => $userdata->ID, 
	
	"amount" => $cenhancement['price'][$i], 
 
	"order_id" => "UPGRADE-".$postid."-".$i."-".rand(),
	 
	"description" => stripslashes($cenhancement['name'][$i]),
	
	"recurring" => 0,

								
) ); 
 		
?>" />
                
            
              <?php } ?>
			</div>
            
		</div>
        </div>
		
	<?php $i++; } ?>     
        
    <?php }// end foreach ?>
    
    <div class="clearfix"></div>
    </div>
    
    <script>

	function ajax_load_enhancement_payment(id){
	
	jQuery('.payment-item').hide();
	
		jQuery.ajax({
			type: "POST",
			url: '<?php echo home_url(); ?>/',		
			data: {
				action: "load_new_payment_form",
				details: jQuery('#ppt_orderdata_upgrade'+id).val(),
			
			},
			success: function(response) {			
				jQuery('#ehancements-wrapper').html(response);
				
			},
			error: function(e) {
				//alert("error "+e)
			}
		});
	
	}
	</script>
    
    <?php }// end is array
	
}
*/
/* this function calculates how much the
relist price is for a listing */

function relist_price($postid){ global $wpdb; 

	// GET THE PRICE FROM THE SAVED DATA
	$price =  get_post_meta($postid,'listing_price_paid',true);
	if($price == ""){ $price = 0; }
	
	$days = get_post_meta($postid, 'listing_expiry_days', true);
	if($days == ""){ $days = 0; }
	
	$hours = get_post_meta($postid, 'listing_expiry_hours', true);
	if($hours == ""){ $hours = 0; }
	
	$minutes = get_post_meta($postid, 'listing_expiry_minutes', true);
	if($minutes == ""){ $minutes = 0; }
	
	// CHECK AGAIN PACKAGES
	$packageID =  get_post_meta($postid,'packageID',true);
	if(is_numeric($packageID)){
		$packagefields = get_option("packagefields");
		if(isset($packagefields[$packageID]['expires']) && is_numeric($packagefields[$packageID]['expires']) ){	
		$days = $packagefields[$packageID]['expires'];	
		}
	}
	

	return array("price" => $price, "days" => $days, "hours" => $hours, "minutes" => $minutes);
}

/*
	this function will reset the listing
	expiry days and do the checks
*/
function reset_listing_expirydate($postid){
	
	// STOP DOUBLE TAKES
	//if(isset($GLOBALS['reset_listing_expirydate_done'])){ return; }
	//$GLOBALS['reset_listing_expirydate_done'] = 1;
	
	// GET DATA
	$ar = $this->relist_price($postid);	
 
	// DEFAULTS
	$rdays 		= $ar['days'];
	$rhours 	= $ar['hours'];
	$rminutes 	= $ar['minutes'];
	//$pprice = $ar['price'];
 
	if($rdays == 0 && $rhours == 0 && $rminutes == 0 ){ $rdays = 30; }	
	 			
	//2. UPDATE TIMER
	$expiry_date = get_post_meta($postid,'listing_expiry_date',true);
	if($expiry_date == "" || ( strtotime($expiry_date) < strtotime(current_time( 'mysql' )) )  ){
		$expiry_date = current_time( 'mysql' );
	}	
	
	
	//die($expiry_date."--".$postid);
	
 
	// SET EXPIRY DATE
	if($rminutes != 0 ){ 
	$expiry_date = date("Y-m-d H:i:s", strtotime( $expiry_date . " + ".$rminutes." minutes") );
	}
	if($rhours != 0 ){ 
	$expiry_date = date("Y-m-d H:i:s", strtotime( $expiry_date . " + ".$rhours." hours") );
	}
	if($rdays != 0 ){
	$expiry_date = date("Y-m-d H:i:s", strtotime( $expiry_date . " + ".$rdays." days") );
	}
	//die(print_r($ar). $expiry_date."< --".current_time( 'mysql' )." post ID: ".$postid);
	// UPDATE AND SAVE	
	update_post_meta($postid,'listing_expiry_date', $expiry_date );

}

/*
this function loops thourgh all listings which
need to be expired
*/
function handle_listings_expire(){

	if(_ppt('disable_expiry') == '1'){ return; }
	
	
	$args = array('posts_per_page' => 100, 
			'post_type' => 'listing_type', 'orderby' => 'meta_value', 'order' => 'asc', 'fields' => 'ID', 
			'meta_query' => array (
					array( 
						'key' => 'listing_expiry_date',																
						'orderby' => 'meta_value',						 
						'compare' => '<',
						'value' => date('Y-m-d H:i:s'),
						'type' => 'DATETIME'							 
					),
				  ) 
	);	
	
	$found = query_posts($args);	
	if(!empty($found)){
		foreach($found as $p){		
			$this->expire_listing($p->ID);
		}	
	}
	 

}

/*
	this function handles the listing expiry
*/

function expire_listing($postid){ global $CORE, $post; 

 
	if(_ppt('disable_expiry') == '1'){ return ; }
	
	// NO NEED FOR SOME THEMES
	if(in_array(THEME_KEY, array('sp'))){ return; }
	
	// VALIDATE
	if(!is_numeric($postid)){ return; }
	
	// GET THE LISTING EXPIRY DATE	 
	$expires = get_post_meta($postid, 'listing_expiry_date',true);	
	if($expires == ""){ return; }
	

	// CHECK IF THIS IS A SUBSCRIPTION
	$is_subscription = get_post_meta($postid,'subscription',true);
	if($is_subscription == "yes"){ return; } 
		
	// GET ARRAY OF DATE/TIME VALUES
	$ff = $this->date_timediff($expires,'');	
	  
 	// SEND OUT EMAILS TO USER
	if($ff['expired'] != 1 && isset($ff['date_array']['days'])){
			// LINE UP 30 DAY EMAIL REMINDER (GIVE 2 DAYS JUST ENCASE CRON ISNT WORKING)
			if( ( $ff['date_array']['days'] == 30 || $ff['date_array']['days'] == 29 ) && $ff['date_array']['months'] == "00" && get_post_meta($postid,'email_sent_30dayreminder',true) == ""){ // 
				$CORE->SENDEMAIL($post->post_author,'reminder_30');
				update_post_meta($postid,'email_sent_30dayreminder',current_time( 'mysql' ));
				
			}
			// LINE UP 15 DAY EMAIL REMINDER (GIVE 2 DAYS JUST ENCASE CRON ISNT WORKING)			
			if( ( $ff['date_array']['days'] == 15 || $ff['date_array']['days'] == 14 ) && $ff['date_array']['months'] == "00" && get_post_meta($postid,'email_sent_15dayreminder',true) == ""){ //
				$CORE->SENDEMAIL($post->post_author,'reminder_15');
				update_post_meta($postid,'email_sent_15dayreminder',current_time( 'mysql' ));
			}	
			
			// LINE UP 1 DAY EMAIL REMINDER (GIVE 2 DAYS JUST ENCASE CRON ISNT WORKING)
			if( ( $ff['date_array']['days'] == 02 || $ff['date_array']['days'] == 01 || $ff['date_array']['days'] == 00 ) && $ff['date_array']['months'] == "00" && get_post_meta($postid,'email_sent_1dayreminder',true) == ""){	// 	 
				$CORE->SENDEMAIL($post->post_author,'reminder_1');
				update_post_meta($postid,'email_sent_1dayreminder',current_time( 'mysql' ));
			}	
	} // end if date
 	
	// CHECK IF IT HAS EXPIRED
	if($ff['expired'] == 1) { 
	
			
			// HOOK FOR THEME USE
		 	$finish_early = hook_expire_listing_action($postid); 
			
			//die(print_r($ff).$finish_early);
	
			// CHECK FOR AUTO RELISTING
			if( _ppt('autolist') == 1 && THEME_KEY == "at"){
				
				global $CORE_AUCTION;
				
				$CORE_AUCTION->_relist_auction($postid, 0);
				
				// FINISH
				return;
				
			}elseif( _ppt('autolist') == 1){
				
				$this->reset_listing_expirydate($postid);
				
				// FINISH
				return;
			}
		 	
			// CHECK FOR STOPAGE
			if($finish_early == "stop"){ return; }
  	 	 
		 	// INCLUDE PACKAGE OPTIONS FOR CUSTOM MOVES
			$packagefields = get_option("packagefields");
			if(!is_array($packagefields)){ $packagefields = array(); }
			$packageID = get_post_meta($postid, 'packageID',true); 
			
			// CHECK IF THE PACKAGE ID HAS A CUSTOM MOVE
			if(isset($packagefields[$packageID]['action']) && strlen($packagefields[$packageID]['action']) > 0){
			
			switch($packagefields[$packageID]['action']){
			
				case "0": { // DO NOTHING
					return; 
				} break;
				case "1": { // SET TO DRAFT
					$my_post['ID'] 			= $postid;
					$my_post['post_status'] = "draft";
					wp_update_post( $my_post );	
				} break;
				case "2": { // DELETE
					wp_delete_post( $postid, true ); return true; 
				} break;
				case "3": { // SET TO PENDING
					$my_post['ID'] 			= $postid;
					$my_post['post_status'] = "pending";
					wp_update_post( $my_post );	
				} break;
				default: { // CHECK FOR CUSTOM MOVE				
					$df = explode("move-",$packagefields[$packageID]['action']);
					if(is_numeric($df[1])){ // MOVE TO CUSTOM PACKAGE
						update_post_meta($postid,'packageID',$df[1]);						
						// CLEAR EXPIRY DATE 
						update_post_meta($postid,'listing_expiry_date', '');
						
					}				
				}// end default			
			}// end switch			
			
			}else{
				// DEFAULT 
				$my_post['ID'] 			= $postid;
				$my_post['post_status'] = "draft";
				wp_update_post( $my_post );	
						
			}
 			
			// SEND EMAIL ONLY IF PAYPAL RECURRING PAYMENTS INST SET
			$last_sent = get_post_meta($postid,'email_sent_expired',true);
			//$last_sent_date = date('Y-m-d H:i:s',strtotime($last_sent . "+2 days"));
			// || ( strtotime(current_time( 'mysql' )) > strtotime($last_sent_date) )
			if( $last_sent == ""  ){ 
			
				// NOW REMOVE ALL THE FEATURE ENHANCEMENTS
				update_post_meta($postid, 'featured', 'no'); // featured
				update_post_meta($postid, 'html', 'no'); // html content
				update_post_meta($postid, 'visitorcounter', 'no'); // visitor counter
				update_post_meta($postid, 'topcategory', 	'no'); // visitor counter
				update_post_meta($postid, 'showgooglemap', 'no'); // visitor counter
						 
				$CORE->SENDEMAIL($post->post_author,'expired');			 
				update_post_meta($postid,'email_sent_expired',current_time( 'mysql' ));			 
			} 
			
			// ADD LOG ENTRY			 
			$CORE->ADDLOG("Listing Expired", 0, $postid, $post->post_title, "listing", "" );	
	
	} 
	
	return;

}
 
 
	/* =============================================================================
	   COUNT LISTING DATA SYSTEM
	   ========================================================================== */
	function COUNT($key,$val,$extra=true, $taxid = "", $taxname = "store"){ global $wpdb, $core, $userdata, $wp_query; $skey = "";
	 	
		if(is_array($val)){
		$args = array(
			'post_type'  => 'listing_type',
			'post_status' => array( 'publish' ),
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key'     => $key,
					'value'   => $val,
					//'compare' => '=',
				),
			),
		);
		}else{
		
		$args = array(
			'post_type'  => 'listing_type',
			'post_status' => array( 'publish' ),
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key'     => $key,
					'value'   => $val,
					'compare' => '=',
				),
			),
		);
		}
		 
				
		if(THEME_KEY == "cp" && _ppt('coupon_showexpired') != 1 ){
			$args['meta_query']["expirydate"]   = array(							
				'key' => "expiry_date",
				'compare' => '>=',
				'value' => date('Y-m-d H:i:s'),
				'type' => 'DATETIME'					
			);
		}
		
		if(isset($GLOBALS['flag-taxonomy'])){
		
			$term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			 
			
			$args['tax_query'][] = array( 
					'taxonomy' => $term->taxonomy,
					'field' => 'term_id',
					'terms' => $term->term_id,
					'operator' => 'IN',
					//'include_children' => true,					
			); 	
				
		}elseif(is_numeric($taxid)){
			
			$args['tax_query'][] = array( 
					'taxonomy' => $taxname,
					'field' => 'term_id',
					'terms' => $taxid,
					'operator' => 'IN',
					//'include_children' => true,					
			); 
		
		}
		
		if(isset($_GET['s'])){		
		$args['s'] = esc_html($_GET['s']);
		}
		
		 
		 
		$allsearch = new WP_Query($args); 
		$count = $allsearch->post_count;
		 
		return $count;		
	}

	
/* =============================================================================
	  REGISTER /LISTING FIELDS
	========================================================================== */
function BUILD_FIELDS($fields,$data=""){

global $wpdb, $CORE, $userdata;  $i = 0; $FIELDVALUE = ""; $STRING = ""; $EXTRA = ""; $FIELDVALUE="";  $VALIDATION = ""; $show_count = 0; $hideempty = 0;

	if(isset($_GET['eid'])){ $_GET['eid'] = strip_tags($_GET['eid']); }
	// TABBING ORDER
	if(!isset($GLOBALS['TABORDER'])){$GLOBALS['TABORDER'] = 12;	}
	// IF NOT ARRAY, RETURN
	if(!is_array($fields)){ return; }	
	
	// LOOP THROUGH THE FIELDS AND BUILD DISPLAY
	foreach($fields as $field){	
 
		// SPAN SIZES
		if(isset($field['ontop'])){
			$spans1 = "col-md-12";
			$spans2 = "col-md-12";
		}else{
			$spans1 = "col-md-12";
			$spans2 = "col-md-12";
		}
		
		// ADD IN VALIDATE CODE
		if(isset($field['required']) && $field['required'] == "yes" &&  !in_array($field['name'], array('post_title','post_content', 'category') )  && $field['type'] != "image"  ){
			 
			if(isset($field['taxonomy']) && strlen($field['taxonomy']) > 2){
			$eth = "_tax";
			}else{
			$eth = "";
			} 
			 	
		}

		 
		// BUILD OUTPUT - DONT SHOW FOR HIDDEN FIELDS		
		if($field['type'] == "title"){
		
		$STRING .= '<div class="form-group clearfix customfield py-4 bg-light"><h4 class="fieldtitle">'.stripslashes($field['title']).'</h4><div>';
		
		}elseif($field['type'] == "post_content"){
		
		$STRING .= '<div class="form-group clearfix col-md-12  form-group" id="form-row-rapper-'.$field['name'].'"><label class="text-uppercase font-weight-bold text-dark small">';
		$STRING .= stripslashes($field['title']);
		$STRING .= ' <span class="red">*</span></label><div class="field_wrapper">';
		
		}elseif($field['type'] !="hidden"  && $field['type'] != "category" ){
		
		if(isset($field['fullspan'])){
		$colg = "col-md-12 fullspanbox";
		}else{
		$colg = "col-md-6";
		}
		 				
			$STRING .= '<div class="'.$colg.' clearfix form-group" id="form-row-rapper-'.$field['name'].'">
			
			<label class="text-uppercase font-weight-bold text-dark small">';
			
			$STRING .= stripslashes($field['title']);
			// IS IT REQUIRED?
			if(isset($field['required']) && $field['required'] == "yes"){
			$STRING .= " <span class='red'>*</span>";
			}
			$STRING .= '</label>
			
			<div class="field_wrapper">';
		}
		
		// CHECK FOR FIELD VALUES
	 
		
		// GET THE FIELD VALUE
		$FIELDVALUE = "";
		if(isset($field['name']) && $field['name'] == "post_tags" && isset($_GET['eid']) ){
			$FIELDVALUE = "";
			$tfs = wp_get_post_tags($_GET['eid']);
			if(!empty($tfs)){
			foreach($tfs as $ta){ $FIELDVALUE .= $ta->name.", "; }
			}
		}elseif(isset($field['name']) && isset($_GET['eid'])){
				$FIELDVALUE = get_post_meta($_GET['eid'],$field['name'],true);
		}
		
		// not set
		if(!isset($field['required'])){ $field['required'] = false; }
	 	
		// DISPLAY FIELD TYPES
		switch($field['type']){
			
			case "title":{
			 
			} break;
			case "map": {
			} break;
			case "tags": {
			} break;
			case "upload": {
			} break;
 
			case "hidden": {
			$STRING .= '<input class="form-control" type="hidden" name="custom['.$field['name'].']" id="form_'.$field['name'].'" value="'.$field['values'].'"  '.$EXTRA.'/>';	
			} break;
			case "price": {	 
			 
			$STRING .=  $this->fieldtype("price", $field['name'], $field['defaultvalue'], $GLOBALS['TABORDER'], $FIELDVALUE, $field['required']); 			
						
			} break;
			case "longtext": 
			case "text": {			
			$STRING .=  $this->fieldtype("input", $field['name'], '', $GLOBALS['TABORDER'], $FIELDVALUE, 0); 			
					
			} break;
			case "post_content":
			case "textarea": { 
			
			$STRING .=  $this->fieldtype("textarea", $field['name'], '', $GLOBALS['TABORDER'], $FIELDVALUE, 0); 
 
 	
			} break;					
			case "select": {
						   
				$STRING .=  $this->fieldtype("select", $field['name'], $field['listvalues'], $GLOBALS['TABORDER'], $FIELDVALUE, 0); 			  
				  
			} break;	
			case "taxonomy": {
			   
			 	// FORMAT VALUES SO WE CAN CHECK IF THEY ARE SELECTED
				//if(is_array($value)){
				//$selected_array = array();
				//foreach($value as $vv){ $selected_array[] = $vv->term_id; }
				//}
				
				// GET SELECTED VALUE
				if(isset($_GET['eid'])){	 
				$selected_array = wp_get_post_terms($_GET['eid'], $field['taxonomy'], array("fields" => "ids"));					 
				}
					
			 	// START BUILDING THE LIST
				$terms = get_terms($field['taxonomy'],'hide_empty=0&parent=0');
				$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';		 
				$count = count($terms);	
				if($count > 0){		 
						 
					// ADD ON CODE FOR LINKAGE
					$ex = ""; $taxlink = false;
					if(isset($field['taxonomy_link']) && strlen($field['taxonomy_link']) > 2 && $field['taxonomy_link'] != "store"){
						$taxlink = true;
						
						if(isset($GLOBALS['tpl-add'])){
						$canAdd = 1;
						}else{
						$canAdd = 0;
						}
						$ex = "onChange=\"ChangeSearchValues('".str_replace("https://","",str_replace("http://","",get_home_url()))."',this.value,'".$field['taxonomy_link']."__".$field['taxonomy']."','tx_".$field['taxonomy_link']."[]','-1','".$canAdd."', 'reg_field_tax_".$field['taxonomy_link']."')\"";
					}
					 
					
					$STRING .= '<div class="input-group">';
					
					/*
					$STRING .= '<span class="input-group-prepend"><span class="input-group-text">';					
					$STRING .= "<a href='#step4' onclick=\"TaxNewValue('reg_field_tax_".$field['taxonomy']."', '".__("Enter a value below to create a new option.","premiumpress")."')\"> <i class='fa fa-plus-square'></i> </a> </span></span>"; 
					*/
					
					$STRING .= '<select name="tax['.$field['taxonomy'].']" class="'.$field['class'].'" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_tax_'.$field['taxonomy'].'" '.$ex.'>';
					$STRING .="<option value=''></option>";
					
					
					foreach ( $terms as $term ) {
						
						// SETUP VALUE FOR LISTBOX
						if($taxlink){ $tvg = $term->term_id;  }else{ $tvg = $term->term_id; }
						
						// SETUP SELECTED VALUE						
					 	if(isset($selected_array) && is_array($selected_array) && in_array($term->term_id,$selected_array)){ $a = "selected=selected"; }else{ $a= ""; }
						
						// SPACING
						if($term->parent == 0){ $spp = ""; }else{ $spp = "&nbsp;&nbsp;&nbsp;"; }
						
						// OUTPUT
						$STRING .="<option value='".$tvg."' ".$a.">" . $spp . $term->name . " (".$term->count.") </option>";
						
						 
						// GET INNER CHILD ITEMS
						/*
						$terms_inner = get_terms($field['taxonomy'],'hide_empty=0&child_of='.$term->term_id);
						if(count($terms_inner) > 0){
						
							foreach ( $terms_inner as $term_inn ) {
							
								// SETUP VALUE FOR LISTBOX
								if($taxlink){ $tvg1 = $term_inn->term_id; }else{ $tvg1 = $term_inn->term_id; }
								
								// SETUP SELECTED VALUE
								if(is_array($selected_array) && in_array($tvg1,$selected_array)){ $b = "selected=selected"; }else{ $b= ""; }
								
								$STRING .= "<option value='".$tvg1."' ".$b."> -- " . $term_inn->name . " (".$term_inn->count.") </option>";
							}
						}	
						*/				 		   
													   				
					 }
					 
					$STRING .= '</select>';
					
					
					$STRING .= '</span></div>';
					
					
					 
				}
				
			} break;
			
 			case "time": { 
			
				$STRING .=  $this->fieldtype("time", $field['name'],"", $GLOBALS['TABORDER'], $FIELDVALUE, 0); 			
			
			} break;
			 
			case "date": { 
			
				$STRING .=  $this->fieldtype("date", $field['name'],"", $GLOBALS['TABORDER'], $FIELDVALUE, 0); 			
			
			} break;
			
			case "checkbox": {
			
				$STRING .=  $this->fieldtype("checkbox", $field['name'], $field['listvalues'], $GLOBALS['TABORDER'], $FIELDVALUE, 0); 	
			} break;
			
			case "businesshours": { 
			
			$bh = array();
			if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){
			$bh = get_post_meta($_GET['eid'],'businesshours',true);
			}
			
			?>
            <div class="col-md-12"><div class="form-group clearfix">
            <label class="text-uppercase font-weight-bold text-dark small"><?php echo __("Working Hours","premiumpress"); ?></label>
            <div id="businessHoursContainer3"></div>
            </div></div>
            <script>
			
			jQuery(document).ready(function() {
			
			<?php if(is_array($bh) && !empty($bh) ){ ?>
			var operationTime = [
			{"isActive":<?php echo $bh['active'][0]; ?>,"timeFrom":'<?php echo $bh['start'][0]; ?>',"timeTill":'<?php echo $bh['end'][0]; ?>'},
			{"isActive":<?php echo $bh['active'][1]; ?>,"timeFrom":'<?php echo $bh['start'][1]; ?>',"timeTill":'<?php echo $bh['end'][1]; ?>'},
			{"isActive":<?php echo $bh['active'][2]; ?>,"timeFrom":'<?php echo $bh['start'][2]; ?>',"timeTill":'<?php echo $bh['end'][2]; ?>'},
			{"isActive":<?php echo $bh['active'][3]; ?>,"timeFrom":'<?php echo $bh['start'][3]; ?>',"timeTill":'<?php echo $bh['end'][3]; ?>'},
			{"isActive":<?php echo $bh['active'][4]; ?>,"timeFrom":'<?php echo $bh['start'][4]; ?>',"timeTill":'<?php echo $bh['end'][4]; ?>'},
			{"isActive":<?php echo $bh['active'][5]; ?>,"timeFrom":'<?php echo $bh['start'][5]; ?>',"timeTill":'<?php echo $bh['end'][5]; ?>'},
			{"isActive":<?php echo $bh['active'][6]; ?>,"timeFrom":'<?php echo $bh['start'][6]; ?>',"timeTill":'<?php echo $bh['end'][6]; ?>'},
			];
			<?php }else{ ?>
			var operationTime;
			<?php } ?>
			
			 jQuery("#businessHoursContainer3").businessHours({
			 
			 		operationTime: operationTime,
                    postInit:function(){
                         jQuery('.operationTimeFrom, .operationTimeTill').timepicker({
                            'timeFormat': 'H:i',
                            'step': 15
                            });
                    },
					 
                    dayTmpl:'<div class="dayContainer" style="width: 80px;"> <input type="hidden" class="isActive form-control" name="isActive" value="1"> ' +
                        '<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"></div>' +
                        '<div class="weekday"></div>' +
                        '<div class="operationDayTimeContaine">' +
                        '<div class="input-group"><div class="operationTime  input-group-prepend"><span class="input-group-addon input-group-text"><i class="fa fa-sun-o"></i></span><input type="text" name="startTime" class="startTime mini-time form-control rounded-0 operationTimeFrom" value=""></div></div>' +
                        '<div class="input-group"><div class="operationTime input-group input-group-prepend"><span class="input-group-addon input-group-text"><i class="fa fa-moon-o"></i></span><input type="text" name="endTime" class="endTime mini-time form-control rounded-0 operationTimeTill" value=""></div></div>' +
                        '</div></div> '
                });
				
			});
			</script>
            
            
            <?php } break;
			
			default:{
			 
			$STRING .= hook_core_fields_switch($field);
			
			} break;
					
		}	
		
		if(isset($field['help']) && strlen($field['help']) > 1){
			$STRING .= "<small class='description'>".stripslashes($field['help'])."</small>";
		}
		// DONT SHOW FOR HIDDEN FIELDS
		if($field['type'] !="hidden"  && $field['type'] != "category" ){ 
			$STRING .= '</div></div>';
		}
			
		// INCREMENT TAB ORDER
		$GLOBALS['TABORDER']++;
		
	}// end foreach
	
	return hook_add_build_field($STRING);


}



function SUBMISSION_FIELDS($show=false,$addlisting = false){

	global $wpdb, $CORE, $userdata; $STRING = ""; $packageID = ""; $GLOBALS['TABORDER'] = 3; $VALIDATION = '<script > function ValidateCoreRegFields(){ ';
	
	if(isset($GLOBALS['core_theme_validation_listing'])){ $VALIDATION .= $GLOBALS['core_theme_validation_listing']; }
  
	// GET THE DATA
	$cdata = get_option("cfields");
 
	// CHECK HAS VALUES
 	if(is_array($cdata)){
 		 
		$i = 0; $completedArray = array(); 
		if(isset($cdata['name']) && is_array($cdata['name'])){
		foreach($cdata['name'] as $xxxxxxx){
		 
			// CHECK KEY HAS A DATABASE KEY FOR SAVING
			if(!isset($cdata['dbkey'][$i]) || ( isset($cdata['dbkey'][$i]) && $cdata['dbkey'][$i] == "" ) ){ $i++; continue; }
			
			if($cdata['name'][$i] == ""){ continue; }	 
		  	
			
			$show = true;
			if($show){	
			
			
		  	////////////////////////////////////////////////////
			// GET EXISTING DATA
			////////////////////////////////////////////////////
			if(isset($_GET['eid']) && isset($cdata['fieldtype'][$i]) && $cdata['fieldtype'][$i] == "taxonomy"){					
				$value = get_the_terms( $_GET['eid'], $cdata['taxonomy'][$i] );
			}elseif(isset($_GET['eid']) ){
				$value = get_post_meta($_GET['eid'], $cdata['dbkey'][$i], true);		 
			}else{
				$value = "";
			}
		 	
			
		  	////////////////////////////////////////////////////
			// BUILD HTML OUTPUT
			////////////////////////////////////////////////////
			if(isset($cdata['fieldtype'][$i]) && $cdata['fieldtype'][$i] == "title" ){	
			
				if(is_admin()){
					$STRING .= '<div><div><b>'.stripslashes($cdata['name'][$i]).'</b><hr>';
				}else{				 
					$STRING .= '<div class="col-md-12"><div class="bg-light py-3 my-4 text-center"><h4 class="fieldtitle">'.stripslashes($cdata['name'][$i]).'</h4><div></div>';
				}
				
			}else{
			
				// GET THE CATIDS FOR THIS FIELD					
				$dcats = ""; $hide = false;
				if(isset($cdata['cat'][$i]) && !empty($cdata['cat'][$i]) ){
						$hide = true;
						foreach($cdata['cat'][$i] as $h){
						
						if($h == ""){ $h = 0; } // ALL CATS
						
						$dcats .= "customid-".$h." ";
						}
				}else{	$dcats .= "customid-0 "; }	
								
				$hs = "style=''";
				if($hide){
					$hs = "style='display:none;'";
				}				 
				
			 
				
					$STRING .= '<div class="col-md-6 clearfix customfield mb-4 '.$dcats.'" '.$hs.' id="fkey'.$cdata['dbkey'][$i].'">
					
					<label class="text-uppercase font-weight-bold text-dark small">'.stripslashes($cdata['name'][$i]);
					
					  if(isset($cdata['required'][$i]) && $cdata['required'][$i] == "yes"){ $STRING .= ' <span class="red">*</span>'; }
					  
					$STRING .= '</label>
					
					<div class="field_wrapper">';
			 
				
				
			} // END ELSE IF IS TITLE
			
 			 
		  	////////////////////////////////////////////////////
			// SWITCH TYPES
			////////////////////////////////////////////////////
			//echo $cdata['fieldtype'][$i]."<--";
			if(isset($cdata['fieldtype'][$i])){
			switch($cdata['fieldtype'][$i]){ 
			
			case "input": { 	
			
				if($cdata['dbkey'][$i] == "price"){
				
					$STRING .='<div class="input-group date col-md-4">
					<input type="text" name="custom['.$cdata['dbkey'][$i].']" value="'.$value.'"  tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_'.$cdata['dbkey'][$i].'" class="form-control rounded-0" />
					<span class="input-group-prepend"><span class="input-group-text">'.hook_currency_symbol('').'</span></span>
				  </div> <div class="clearfix"></div> ';
				  
				  $STRING .= "<script>jQuery('#reg_field_".$cdata['name'][$i]."').change(function(e) { 
				  if(!isNaN(jQuery('#reg_field_".$cdata['name']."').val())){ }else{ jQuery('#reg_field_".$cdata['name'][$i]."').val(''); } }); </script>";
				  
				}else{
				$STRING .='<input type="text" name="custom['.$cdata['dbkey'][$i].']" value="'.$value.'" id="reg_field_'.$cdata['dbkey'][$i].'" tabindex="'.$GLOBALS['TABORDER'].'" class="form-control rounded-0" />';	
				}
			  
						
			} break;
			case "textarea": { 
				$extra = "";
				if(is_admin()){
					$extra = "style='width:100%; height:100px !important;'";
				}
			
				$STRING .= '<textarea '.$extra.' name="custom['.$cdata['dbkey'][$i].']" class="form-control rounded-0" id="reg_field_'.$cdata['dbkey'][$i].'" tabindex="'.$GLOBALS['TABORDER'].'">'.$value.'</textarea>';
			} break;

			case "select": {
			
			 			
			 $options = explode( PHP_EOL, $cdata['values'][$i] );			 
			 $STRING .= '<select name="custom['.$cdata['dbkey'][$i].']" class="form-control rounded-0" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_'.$cdata['dbkey'][$i].'">';					
				foreach($options as $val){
					
					$val = trim($val);
					
					if($value == $val){
							$STRING .= '<option value="'.$val.'" selected=selected>'.$val.'</option>';
					}else{
							$STRING .= '<option value="'.$val.'">'.$val.'</option>';
					}
				}// end foreach
			$STRING .= '</select>';
			} break;
			
			case "date": { 
			
			$STRING .=  $this->fieldtype("date", $cdata['dbkey'][$i], $value , $GLOBALS['TABORDER'], $value, 0); 
			
			
			} break;
						
			case "taxonomy": {
			 
		 	if($cdata['taxonomy'][$i] != ""){
			
			 	// FORMAT VALUES SO WE CAN CHECK IF THEY ARE SELECTED
				if(is_array($value)){
				$selected_array = array();
				foreach($value as $vv){ $selected_array[] = $vv->term_id; }
				}
				
			 	// START BUILDING THE LIST 
				 
				$terms = get_terms($cdata['taxonomy'][$i],"orderby=count&order=desc&get=all");
	 
				$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';		 
				$count = count($terms);	
				if($count > 0){		 
						 
					// ADD ON CODE FOR LINKAGE
					$ex = ""; $taxlink = false;
					if(isset($cdata['taxonomy_link'][$i]) && strlen($cdata['taxonomy_link'][$i]) > 2 && $cdata['taxonomy_link'][$i] != "store"){
						$taxlink = true;
						if(isset($GLOBALS['tpl-add'])){
						$canAdd = 1;
						}else{
						$canAdd = 0;
						}
						$ex = "onChange=\"ChangeSearchValues('".str_replace("http://","",get_home_url())."',this.value,'".$cdata['taxonomy_link'][$i]."__".$cdata['taxonomy'][$i]."','tx_".$cdata['taxonomy_link'][$i]."[]','-1','".$canAdd."','reg_field_tax_".$cdata['taxonomy_link'][$i]."')\"";
					}
						 
					$STRING .= '<select name="tax['.$cdata['taxonomy'][$i].']" class="form-control rounded-0" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_tax_'.$cdata['taxonomy'][$i].'" '.$ex.'>';
					
					$STRING .="<option value=''></option>";
					 
					
					// COUNT TERMS AND					
					foreach ( $terms as $term ) {					
						
						// SETUP VALUE FOR LISTBOX
						if($taxlink){ $tvg = $term->term_id;  }else{ $tvg = $term->term_id; }
						
						// SETUP SELECTED VALUE						
					 	if(isset($selected_array) && is_array($selected_array) && in_array($term->term_id,$selected_array)){ $a = "selected=selected"; }else{ $a= ""; }						
						
						// SPACING
						if($term->parent == 0){ $spp = ""; }else{ $spp = "&nbsp;&nbsp;&nbsp;"; }
						
						// OUTPUT
						$STRING .="<option value='".$tvg."' ".$a.">" . $spp . $term->name . " (".$term->count.") </option>";						
						 	 		   
													   				
					 }
					 
					 
					$STRING .= '</select>';
				}
				
				} // end if blank
				
				if(isset($cdata['taxonomy_link'][$i]) && strlen($cdata['taxonomy_link'][$i]) > 2 && $cdata['taxonomy_link'][$i] != "store"){
				?>
                <script>jQuery(document).ready(function(){ jQuery('#reg_field_tax_<?php echo $cdata['taxonomy_link'][$i]; ?>').prop('disabled', true); }); </script>
                
                <?php
				}
				
			} break;	
							
			case "checkbox": { 
			 $options = explode( PHP_EOL, $cdata['values'][$i] ); $bb ="";
			 	
				$hasSetValue = false;
				foreach($options as $val){ 
					$val = trim($val);				 		
					if((is_array($value) && in_array($val,$value)) || $value == $val ){
							$bb = 'checked=checked';
							$hasSetValue = true;
					}else{
							$bb = '';
					}
					
					$extra = "";
					if(is_admin()){
					$extra = "style='width:18px;'";
					}
					$STRING .= '
					<div class="form-check pl-0">
					<label class="checkbox" >
					 
					<input '.$extra.' type="checkbox" '.$bb.' name="custom['.$cdata['dbkey'][$i].'][]" data-toggle="checkbox" class="form-control" value="'.$val.'" tabindex="'.$GLOBALS['TABORDER'].'" />
					&nbsp; &nbsp; '.$val.'
					
					</label>
					</div>';
				}// end foreach
				// THIS EXTRA VALUE WAS ADDED SO THAT THE FORM DATA WILL COMPLETE WITHOUT ANY VALUES CHECKED
				// OTHERWISE IT WOULD NOT SAVE
				$STRING .= '<input type="hidden"  name="custom['.$cdata['dbkey'][$i].'][]" class="form-control"  value="--" />';
				
				if(isset($cdata['required'][$i]) && $cdata['required'][$i] == "yes"){
				
					// FORM NAME
					if(isset($GLOBALS['flag-myaccount'])){ $formname = "#myaccountdataform"; }else{ $formname = "form"; }
					
					
					$STRING .= "<script>
					 jQuery(document).ready(function(){ 
					 ";
					 
					 
					if(!isset($_GET['eid'])){  if(!$hasSetValue){ 
					$STRING .= " jQuery('".$formname." .btn-primary').attr('disabled', true); ";
					} }
					 
					$STRING .= " jQuery('".$formname." .reg_form_".$cdata['dbkey'][$i]."').on('change', function (e) {
					
						isChecked = false; 						
						jQuery('".$formname." .reg_form_".$cdata['dbkey'][$i]."').each(function(){				 
							 
							if(jQuery(this).is(\":checked\")){
								isChecked = true;							
							}													
						});
						
						if(isChecked){
						jQuery('".$formname." .btn-primary').attr('disabled', false);
						}else{
						jQuery('".$formname." .btn-primary').attr('disabled', true);
						}
						"; 
						
					$STRING .= "}); });</script>";
					
				}
				
			} break;	
					
			case "radio": { 
			 $options = explode( PHP_EOL, $cdata['values'][$i] ); $bb =""; $rc = 0;
				foreach($options as $val){		$val = trim($val);		 		
					if( $value == $val || ( $value =="" && $rc==0 ) ){
							$bb = 'checked=checked';
					}else{
							$bb = '';
					}
					
					$STRING .= '<div class="form-check">
					<label class="form-check-label">
					<input type="radio" class="form-check-input" '.$bb.' name="custom['.$cdata['dbkey'][$i].']" id="reg_form_'.$cdata['dbkey'][$i].'" value="'.$val.'" tabindex="'.$GLOBALS['TABORDER'].'" />
					
					&nbsp; &nbsp; '.$val.
					'</label>
					</div>';
					
					$rc++;
				}// end foreach			
			} break;	
			
			} } // end switch iffset				
			
			}
			$GLOBALS['TABORDER']++;
			
			if(isset($cdata['help'][$i]) && strlen($cdata['help'][$i]) > 1 && !is_admin()){
			$STRING .= "<small class='description'>".$cdata['help'][$i]."</small>";
			}
			
			
			 $STRING .= '</div></div>';	
		 
			
			
			
			
			
		  	////////////////////////////////////////////////////
			// REQUIRED FIELDS
			////////////////////////////////////////////////////
			if(isset($cdata['required'][$i]) && $cdata['required'][$i] == "yes" && $cdata['fieldtype'][$i] != "checkbox" && $cdata['fieldtype'][$i] != "radio"){
			 
			if(isset($cdata['taxonomy'][$i]) && strlen($cdata['taxonomy'][$i]) > 2){
			$eth = "_tax";
			}else{
			$eth = "";
			}
			
			if($eth != "_tax"){
			
			$VALIDATION .= " 
			
				if( jQuery('#fkey".$cdata['dbkey'][$i]."').css('display') != 'none' ){ 
				
				
					var cus".$GLOBALS['TABORDER']." = document.getElementById(\"reg_field".$eth."_".trim($cdata['dbkey'][$i])."\");
				 
						 if(cus".$GLOBALS['TABORDER'].".value == '-------'){
							alert('".__("Please complete all required fields.","premiumpress")."');
							cus".$GLOBALS['TABORDER'].".style.border = 'thin solid red';
							cus".$GLOBALS['TABORDER'].".focus();
							XXX
							return false;
						}
						if(cus".$GLOBALS['TABORDER'].".value == ''){
							alert('".__("Please complete all required fields.","premiumpress")."');
							cus".$GLOBALS['TABORDER'].".style.border = 'thin solid red';
							cus".$GLOBALS['TABORDER'].".focus();
							XXX
							return false;
						}
				}
					";
			}
			
				
			$VALIDATION = str_replace("XXX", "colAll(); tsf.goto(2); jQuery('.stepblock5').collapse('show');", $VALIDATION);
				
			
			}
			
			 
			
			
			
			
		$i++; // NEXT FIELD	
		 		
		} }	// end foreach			
		
	}// end if
 
 
	
	$VALIDATION .= ' }</script>';
 
	return $STRING.$VALIDATION;

}   









function CORE_FIELDS($show=false,$addlisting=false){

	global $wpdb, $CORE, $userdata; $STRING = ""; $packageID = ""; $VALIDATION = '<script > function ValidateCoreRegFields(){ ';
	
	if(isset($GLOBALS['core_theme_validation_listing'])){ $VALIDATION .= $GLOBALS['core_theme_validation_listing']; }
	
	// CHECK FOR PACKAGE ID // IF WERE ADDING A NEW LISTING
	if(isset($_POST['packageID']) && is_numeric($_POST['packageID']) ){
	//$packagefields = get_option("packagefields");
	//$packageID = $packagefields[$_POST['packageID']]['ID'];
	$packageID = $_POST['packageID'];
	}
	// TABBING ORDER
	if(!isset($GLOBALS['TABORDER'])){$GLOBALS['TABORDER'] = 3;	}
	// WHICH SET OF FIELDS TO DISPLAy
	if($addlisting){
	$regfields = get_option("submissionfields");
	}else{
	$regfields = get_option("regfields");
	}
	
	// ADD ON BASIC FIELDS FOR REGISTRATION
	if(!$addlisting && !isset($GLOBALS['flag-myaccount']) ){
	
	$VALIDATION .= "var b1 = document.getElementById(\"user_login\");if(b1.value == ''){alert('".str_replace("'","",__("Please complete all required fields.","premiumpress"))."');b1.style.border = 'thin solid red';b1.focus();return false;};";
	$VALIDATION .= "var b2 = document.getElementById(\"user_email\");if(b2.value == ''){alert('".str_replace("'","",__("Please complete all required fields.","premiumpress"))."');b2.style.border = 'thin solid red';b2.focus();return false;};";
	$VALIDATION .= "if( !isValidEmail( b2.value ) ) { alert('".str_replace("'","",__("You have entered and invalid email address.","premiumpress"))."'); b2.style.border = 'thin solid red'; b2.focus(); return false; }";
	}
	
	
	if(isset($GLOBALS['CORE_THEME']['show_mem_registraion']) && $GLOBALS['CORE_THEME']['show_mem_registraion'] == '1' && !isset($GLOBALS['tpl-add']) && $GLOBALS['nosidebar-right'] == true && $GLOBALS['nosidebar-left'] == true){
	$VALIDATION .= "var mm1 = document.getElementById(\"membershipID\"); if(mm1.value == ''){alert('".str_replace("'","",__("Please select a membership package.","premiumpress"))."'); return false;};";
	}
	
 	if(is_array($regfields)){
	
		//PUT IN CORRECT ORDER
		$regfields = $this->multisort( $regfields , array('order') );
		$regfields = hook_custom_fields_filter($regfields);
		foreach($regfields as $field){
		
		 
			// EXIST IF KEY DOESNT EXIST
			if($field['fieldtype'] == "taxonomy" && is_admin() ){ continue; }
			if($field['key'] == "" && ( $field['fieldtype'] != "taxonomy" && $field['fieldtype'] != "title" ) ){ continue; }
	 
			$canContinue = false;
			// CHECK MEMBERSIP HAS ACCESS TO THIS FIELD
			if(isset($field['membership']) && is_array($field['membership']) && count($field['membership']) > 0){
				if( isset($GLOBALS['current_membership']) && in_array($GLOBALS['current_membership'], $field['membership'])  ){
				$canContinue = true; 
				}else{
				$canContinue = false;
				}
			}else{
			$canContinue = true; 
			}
			 
			// CHECK PACKAGE HAS ACCESS TO THIS FIELD
			if(isset($field['package']) && is_array($field['package']) && count($field['package']) > 0){
				if(is_numeric($packageID) && in_array($packageID, $field['package']) ){ 
				$canContinue = true;
				}else{
				$canContinue = false;
				}
			}else{
			/** add an extra check because the membersips might return false above ***/
			if($canContinue){
				$canContinue = true;
			} 
			}
			
			// NOW GET THE RESULT
			if(!$canContinue && !is_admin()){ continue; } // 
			 
			
			// CHECK IF WE ARE GETTING VALUES
			if($show){				
				// CAN WE DISPLAY THIS ON OUR PROFILE??
				if(isset($field['display_profile']) && $field['display_profile'] == "no"){ continue; } // SKIP FIELD
				
				if($addlisting){				
					if($field['fieldtype'] == "taxonomy"){					
					$value = get_the_terms( $_GET['eid'], $field['taxonomy'] );
					}else{
					$value = get_post_meta($_GET['eid'], $field['key'], true);
					}				
				}else{
				$value = get_user_meta($userdata->ID, $field['key'], true);
				}
				
			}else{
				if(isset($_POST['custom'][$field['key']])){
					// GET THE POST DATA AFTER FORM WAS SUBMITTED
					if(is_array($_POST['custom'][$field['key']])){
					$value = $_POST['custom'][$field['key']];
					}else{
					$value = esc_attr($_POST['custom'][$field['key']]);
					}				
				}else{
					// GET LISTING DATA
					if($addlisting && isset($_GET['eid']) && $field['fieldtype'] == "taxonomy"){					
					$value = get_the_terms( $_GET['eid'], $field['taxonomy'] );
					}elseif($addlisting && isset($_GET['eid']) ){
					$value = get_post_meta($_GET['eid'], $field['key'], true);
					}else{
					$value = "";
					}				
				}
			}
			
			
			if($field['fieldtype'] == "title" ){
			
				if(is_admin()){
				$STRING .= '<b>'.stripslashes($field['name']).'</b><hr/>';
				}else{
				$STRING .= '<div class="form-group clearfix customfield"><h4 class="fieldtitle">'.stripslashes($field['name']).'</h4><div>';
				}
			
			
			}else{
			
					// GET THE CATIDS FOR THIS FIELD
					
					$dcats = ""; $hide = false;
					if(isset($field['cat']) && !empty($field['cat']) ){
						$hide = true;
						foreach($field['cat'] as $h){
						$dcats .= "customid-".$h." ";
						}
					}else{
					$dcats .= "customid-0 ";
					}
					
					$hs = "";
					if($hide){
					$hs = "style='display:none;'";
					}
				  	
				
					$STRING .= '<div class="form-group clearfix customfield '.$dcats.'" '.$hs.'>
					
					
					  <label class="control-label col-md-4">'.stripslashes($field['name']);
					  if(isset($field['required']) && $field['required'] == "yes"){ $STRING .= ' <span class="required">*</span>'; }
					$STRING .= '</label><div class="field_wrapper col-md-8">';
			 
				
				
			}
			
			// ADD IN VALIDATE CODE
			if(isset($field['required']) && $field['required'] == "yes" && $field['fieldtype'] != "checkbox" && $field['fieldtype'] != "radio"){
			 
			if(isset($field['taxonomy']) && strlen($field['taxonomy']) > 2){
			$eth = "_tax";
			}else{
			$eth = "";
			}
			
			if($eth != "_tax"){
			
			$VALIDATION .= " var cus".$GLOBALS['TABORDER']." = document.getElementById(\"reg_field".$eth."_".trim($field['key'])."\");
					 if(cus".$GLOBALS['TABORDER'].".value == '-------'){
						alert('".__("Please complete all required fields.","premiumpress")."');
						cus".$GLOBALS['TABORDER'].".style.border = 'thin solid red';
						cus".$GLOBALS['TABORDER'].".focus();
						XXX
						return false;
					}
					if(cus".$GLOBALS['TABORDER'].".value == ''){
						alert('".__("Please complete all required fields.","premiumpress")."');
						cus".$GLOBALS['TABORDER'].".style.border = 'thin solid red';
						cus".$GLOBALS['TABORDER'].".focus();
						XXX
						return false;
					}";
			}
			
				if(isset($GLOBALS['tpl-add'])){
					$VALIDATION = str_replace("XXX", "colAll(); jQuery('.stepblock5').collapse('show');", $VALIDATION);
				}else{
					$VALIDATION = str_replace("XXX", "", $VALIDATION);
				}
			
			}
			
			
			if($field['key'] == "country"){
						 		 
				$STRING .= sprintf( '<select class="form-control rounded-0" name="custom['.$field['key'].']" id="reg_field_'.$field['key'].'">', "" );
                foreach ($GLOBALS['core_country_list'] as $key=>$option) {				 				
                	$STRING .= sprintf( '<option value="%1$s"%3$s>%2$s</option>', trim( $key  ), $option, selected( $value, $key, false ) );
                }
                $STRING .= '</select>';
				
			}elseif($field['key'] == "state"){
				
				// SELECT AND STRING				
                $selected = isset( $_GET['custom']['state'] ) ? $_GET['custom']['state'] : '';				 
				
					$STRING .= sprintf( '<select class="form-control rounded-0" name="custom['.trim($field['key']).']" id="reg_field_'.trim($field['key']).'">', "" );
					foreach ($GLOBALS['core_country_list'] as $key=>$option) {				 				
						$STRING .= sprintf( '<option value="%1$s" disabled id="'.$key.'_key">%2$s</option>', trim( $key  ), $option);
					 
						if(isset($GLOBALS['core_state_list'][$key])){						
							$state_list = explode("|",$GLOBALS['core_state_list'][$key]);						 
							foreach($state_list as $state){							
									$STRING .= sprintf( '<option value="%1$s"%3$s>-- %2$s</option>', trim( $state  ), $state, selected( $value, $state, false ) );
							} // end foreach					
						}// end if			
					} // end foreach
                	$STRING .= '</select>';
                	$STRING .=  '<script> jQuery(\'#core_country_dropdown1\').change(function() { jQuery(\'#core_state_dropdown1\').val(this.value); } ); </script>';	
			
			}else{
			 
			// SWITCH TYPES
			switch($field['fieldtype']){ 
			
			case "input": { 	
			
			if($field['key'] == "price"){
			
				$STRING .='<div class="input-group date col-md-4">
				<input type="text" name="custom['.$field['key'].']" value="'.$value.'"  tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_'.$field['key'].'" class="form-control rounded-0" />
				<span class="input-group-prepend"><span class="input-group-text">'.hook_currency_symbol('').'</div></span>
			  </div> <div class="clearfix"></div> ';
			  
			  $STRING .= "<script>jQuery('#reg_field_".$field['name']."').change(function(e) { 
			  if(!isNaN(jQuery('#reg_field_".$field['name']."').val())){ }else{ jQuery('#reg_field_".$field['name']."').val(''); } }); </script>";
			  
			}else{
			$STRING .='<input type="text" name="custom['.$field['key'].']" value="'.$value.'" id="reg_field_'.$field['key'].'" tabindex="'.$GLOBALS['TABORDER'].'" class="form-control rounded-0" />';	
			}
			  
						
			} break;
			case "textarea": { 
				$STRING .= '<textarea name="custom['.$field['key'].']" class="form-control rounded-0" id="reg_field_'.$field['key'].'" tabindex="'.$GLOBALS['TABORDER'].'">'.$value.'</textarea>';
			} break;

			case "select": {
			
			 			
			 $options = explode( PHP_EOL, $field['values'] );			 
			 $STRING .= '<select name="custom['.$field['key'].']" class="form-control rounded-0" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_'.$field['key'].'">';					
				foreach($options as $val){
					
					$val = trim($val);
					
					if($value == $val){
							$STRING .= '<option value="'.$val.'" selected=selected>'.$val.'</option>';
					}else{
							$STRING .= '<option value="'.$val.'">'.$val.'</option>';
					}
				}// end foreach
			$STRING .= '</select>';
			} break;
			case "date": {
			 $db = explode(" ",$value);
			 
			 if(is_admin()){
			 $calbtnclass = "dashicons-before dashicons-admin-post";
			 }else{
			 $calbtnclass = "glyphicon glyphicon-calendar fal fa-calendar";
			 }
			 
			$STRING .= '123<script>jQuery(function(){ jQuery(\'#reg_field_'.$field['key'].'_date\').datetimepicker(); }); </script>
			
			 <div class="input-group date col-md-6" id="reg_field_'.$field['key'].'_date" data-date="'.$db[0].'" data-date-format="yyyy-MM-dd hh:mm:ss">
			<span class="add-on input-group-prepend"><span class="input-group-text"><i class="'.$calbtnclass.'"></i></span></span>
				<input type="text" class="form-control rounded-0" name="custom['.$field['key'].']" value="'.$value.'" id="reg_field_'.$field['key'].'" tabindex="'.$GLOBALS['TABORDER'].'" data-format="yyyy-MM-dd hh:mm:ss" />
				
			  </div>
			<div class="clearfix"></div>';	
			
			} break;			
			case "taxonomy": {
			 
		 
			 	// FORMAT VALUES SO WE CAN CHECK IF THEY ARE SELECTED
				if(is_array($value)){
				$selected_array = array();
				foreach($value as $vv){ $selected_array[] = $vv->term_id; }
				}
				
			 	// START BUILDING THE LIST 
				 
				$terms = get_terms($field['taxonomy'],"orderby=count&order=desc&get=all");
			 
				$selec = (isset( $_GET['pr'] )) ? $_GET['pr'] : '';		 
				$count = count($terms);	
				if($count > 0){		 
						 
					// ADD ON CODE FOR LINKAGE
					$ex = ""; $taxlink = false;
					if(isset($field['taxonomy_link']) && strlen($field['taxonomy_link']) > 2 && $field['taxonomy_link'] != "store"){
						$taxlink = true;
						if(isset($GLOBALS['tpl-add'])){
						$canAdd = 1;
						}else{
						$canAdd = 0;
						}
						$ex = "onChange=\"ChangeSearchValues('".str_replace("http://","",get_home_url())."',this.value,'".$field['taxonomy_link']."__".$field['taxonomy']."','tx_".$field['taxonomy_link']."[]','-1','".$canAdd."','reg_field_tax_".$field['taxonomy_link']."')\"";
					}
						 
					$STRING .= '<select name="tax['.$field['taxonomy'].']" class="form-control rounded-0" tabindex="'.$GLOBALS['TABORDER'].'" id="reg_field_tax_'.$field['taxonomy'].'" '.$ex.'>';
					
					$STRING .="<option value=''></option>";
					 
					
					// COUNT TERMS AND					
					foreach ( $terms as $term ) {					
						
						// SETUP VALUE FOR LISTBOX
						if($taxlink){ $tvg = $term->term_id;  }else{ $tvg = $term->term_id; }
						
						// SETUP SELECTED VALUE						
					 	if(is_array($selected_array) && in_array($term->term_id,$selected_array)){ $a = "selected=selected"; }else{ $a= ""; }						
						
						// SPACING
						if($term->parent == 0){ $spp = ""; }else{ $spp = "&nbsp;&nbsp;&nbsp;"; }
						
						// OUTPUT
						$STRING .="<option value='".$tvg."' ".$a.">" . $spp . $term->name . " (".$term->count.") </option>";
						
						// GET INNER CHILD ITEMS
						/*
						$terms_inner = get_terms($field['taxonomy'],'hide_empty=0&child_of='.$term->term_id);
						if(count($terms_inner) > 0){						
						
							foreach ( $terms_inner as $term_inn ) {
							
								// SETUP VALUE FOR LISTBOX
								if($taxlink){ $tvg1 = $term_inn->term_id; }else{ $tvg1 = $term_inn->term_id; }
								
								// SETUP SELECTED VALUE
								if(is_array($selected_array) && in_array($tvg1,$selected_array)){ $b = "selected=selected"; }else{ $b= ""; }
								
								$STRING .= "<option value='".$tvg1."' ".$b."> -- " . $term_inn->name . " (".$term_inn->count.") </option>";
							}
						} 		
						*/		 		   
													   				
					 }
					 
					 
					$STRING .= '</select>';
				}
				
			} break;					
			case "checkbox": { 
			 $options = explode( PHP_EOL, $field['values'] ); $bb ="";
			 	
				$hasSetValue = false;
				foreach($options as $val){ $val = trim($val);				 		
					if((is_array($value) && in_array($val,$value)) || $value == $val ){
							$bb = 'checked=checked';
							$hasSetValue = true;
					}else{
							$bb = '';
					}
					$STRING .= '<label class="checkbox"> <input type="checkbox" 
					'.$bb.' name="custom['.$field['key'].'][]" class="reg_form_'.$field['key'].' form-control" value="'.$val.'" tabindex="'.$GLOBALS['TABORDER'].'" />'.$val.'</label>';
				}// end foreach
				// THIS EXTRA VALUE WAS ADDED SO THAT THE FORM DATA WILL COMPLETE WITHOUT ANY VALUES CHECKED
				// OTHERWISE IT WOULD NOT SAVE
				$STRING .= '<input type="hidden"  name="custom['.$field['key'].'][]"  value="--" class="form-control" />';
				
				if(isset($field['required']) && $field['required'] == "yes"){
				
					// FORM NAME
					if(isset($GLOBALS['flag-myaccount'])){ $formname = "#myaccountdataform"; }else{ $formname = "form"; }
					
					
					$STRING .= "<script>
					 jQuery(document).ready(function(){ 
					 ";
					 
					 
					if(!isset($_GET['eid'])){  if(!$hasSetValue){ 
					$STRING .= " jQuery('".$formname." .btn-primary').attr('disabled', true); ";
					} }
					 
					$STRING .= " jQuery('".$formname." .reg_form_".$field['key']."').on('change', function (e) {
					
						isChecked = false; 						
						jQuery('".$formname." .reg_form_".$field['key']."').each(function(){				 
							 
							if(jQuery(this).is(\":checked\")){
								isChecked = true;							
							}													
						});
						
						if(isChecked){
						jQuery('".$formname." .btn-primary').attr('disabled', false);
						}else{
						jQuery('".$formname." .btn-primary').attr('disabled', true);
						}
						"; 
						
					$STRING .= "}); });</script>";
					
				}
				
			} break;			
			case "radio": { 
			 $options = explode( PHP_EOL, $field['values'] ); $bb =""; $rc = 0;
				foreach($options as $val){		$val = trim($val);		 		
					if( $value == $val || ( $value =="" && $rc==0 ) ){
							$bb = 'checked=checked';
					}else{
							$bb = '';
					}
					$STRING .= '<label class="radio"><input type="radio" 
					'.$bb.' name="custom['.$field['key'].']" id="reg_form_'.$field['key'].'" value="'.$val.'" tabindex="'.$GLOBALS['TABORDER'].'" />'.$val.'</label>';
					$rc++;
				}// end foreach			
			} break;	
			
			} // end if is country/state					
			
			}	
			$GLOBALS['TABORDER']++;
			
			if(isset($field['help']) && strlen($field['help']) > 1 && !is_admin()){
			$STRING .= "<p class='description'>".$field['help']."</p>";
			}
			
			
		 
				$STRING .= '</div></div>';	
			 
			
			
		}	// end foreach	
	}// end if
	
	if(isset($GLOBALS['CORE_THEME']['visitor_password']) && $GLOBALS['CORE_THEME']['visitor_password'] == '1' && !isset($GLOBALS['tpl-add']) && !isset($GLOBALS['flag-myaccount']) ){
	
	$VALIDATION .= "var pass1 = document.getElementById(\"pass1\"); var pass2 = document.getElementById(\"pass2\");
					if(pass1.value == ''){
						alert('".__("Please complete all required fields.","premiumpress")."');
						pass1.style.border = 'thin solid red';
						pass1.focus();
						return false;
					}
					if(pass2.value == ''){
						alert('".__("Please complete all required fields.","premiumpress")."');
						pass2.style.border = 'thin solid red';
						pass2.focus();
						return false;
					}
					if(pass2.value != pass1.value){
						alert('".__("Please complete all required fields.","premiumpress")."');
						pass1.style.border = 'thin solid red';
						pass2.style.border = 'thin solid red';
						pass2.focus();
						return false;
					}
					";
					
					// ADD ON MEMBERSHIP REQUIRMENT
					//if($GLOBALS['CORE_THEME']['show_mem_registraion'] == '1'){
					//	$VALIDATION .= "var mem = document.getElementById(\"membershipID\");
					//	if(mem.value == ''){
					//		alert('".$CORE->_e(array('validate','31'))."');							
					//		return false;
					//	}";					
					//}
	}
 
	
	$VALIDATION .= ' }</script>';
 
 	
	return $STRING.$VALIDATION;

}   
	
}

?>