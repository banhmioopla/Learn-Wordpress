<?php
 
class wlt_admin_design { 
 

 

/*
	this function sets up all of the custom boxes for pages
	within the admin area
*/
function _custom_metabox(){ 
 	
	// CUSTOM FIELDS
	if(defined('THEME_KEY') && ( THEME_KEY != "sp" && THEME_KEY != "cm" && THEME_KEY != "vt" ) ){
		$cfields = get_option("cfields"); 
		if($cfields != "" && is_array($cfields) && !empty($cfields) ){
		add_meta_box( 'custom_fields',  "Custom Fields", array($this, '_custom_fields' ), THEME_TAXONOMY.'_type', 'side', 'low'); 	
		}
	}
	
 	// ADDITONAL TEMPLATE DATA
	add_meta_box( 'box_event',"Event Details", array($this, '_box_event' ), 'event', 'side', 'high' );
	
	// ADDITONAL TEMPLATE DATA
	add_meta_box( 'box_payments',"Payment Details", array($this, '_box_payments' ), 'wlt_payments', 'side', 'high' );


	// INVOICES ADDONS
	add_meta_box( 'box_invoices',"Invoice Details", array($this, '_box_invoices' ), 'wlt_invoices', 'side', 'high' );
	
	// PAGE ACCESS
	if(defined('THEME_KEY') && ( THEME_KEY != "sp" ) ){
	add_meta_box( 'box_pageaccess',"Page Access", array($this, '_box_pageaccess' ), array('gallery','page', 'post','event','video'), 'side', 'low' );		
 	}
	
	// PAGE COLUMNS	
	add_meta_box( 'box_pageheader',"PPT - Page Header", array($this, '_box_pageheader' ), array('page'), 'side', 'low' );		
 	
	// PAGE COLUMNS	
	add_meta_box( 'box_pagecolumns',"PPT - Page Columns", array($this, '_box_pagecolumns' ), array('page'), 'side', 'low' );		
	
	
	// PAGE COLUMNS	
	if(_ppt('breadcrumbs') == 1){
	add_meta_box( 'box_page_breadcrumbs',"Breadcrumb Description", array($this, '_box_page_breadcrumbs' ), array('page'), 'normal', 'low' );		
  	}
	
	// MEDIA MANAGER
	if(defined('THEME_LISING_IMAGES') && THEME_LISING_IMAGES ){
	add_meta_box( 'box_media1',"File Attachments", array($this, '_box_media' ), array('listing_type'), 'normal', 'high' );
	}
	
	// MEDIA MANAGER
	if(defined('THEME_LISING_VIDEOS') && THEME_LISING_VIDEOS ){
	add_meta_box( 'box_media2',"Video Attachments", array($this, '_box_media' ), array('listing_type'), 'normal', 'high' );
	}
		
	 
	// MEDIA MANAGER
	if(_ppt('google') == 1 ){
	add_meta_box( 'box_map',"Map Location", array($this, '_box_map' ), array('deal_type' ), 'side', 'low' );
	}
 
	
	add_meta_box( 'box_media3',"General", array($this, '_box_testing' ), array('product','listing_type'), 'normal', 'high' );

			
  	
}

function _box_testing(){ global $CORE, $post;
?>

<script>

jQuery(document).ready(function(){
 
	jQuery(document).on( 'click', '#ppt_edit_menu .nav a', function() {
		jQuery('section').hide();
		jQuery('#'+jQuery(this).attr("data-id")).show();
		return false;
	});
	
});
</script>

<style>
#ppt_edit_menu .nav { width:150px; float:left; margin: -7px 0px -12px -19px; display: block; position: relative;  }
#ppt_edit_menu .nav a { width:100%; border: 0px; line-height: 40px;  border-top: 1px solid #e4e4e4;     border-right: 1px solid #ddd;  border-bottom: 1px solid #fff; display: block;    position: relative;  }
#ppt_edit_menu section {  margin-left: 180px; padding-top: 0px;}
#ppt_edit_menu .nav a i { float:left; margin-right:10px; margin-top: 10px; }
#ppt_edit_menu section .box-admin { padding: 5px 20px 5px 162px!important; min-height: 40px;    line-height: 40px;}
#ppt_edit_menu section .box-admin label { float: left;    width: 150px;   padding: 0;    margin: 0 0 0 -150px;}
#ppt_edit_menu section .box-admin em { float:right; }	
#ppt_edit_menu section .box-admin .input-group { width: 50%;    float: left; } 
#ppt_edit_menu section.box-admin .input-group input, #ppt_edit_menu section .box-admin .input-group select { width:100%; } 
#ppt_edit_menu section .box-admin .input-group input.hasaddon {   float: left; }
#ppt_edit_menu section .box-admin-textarea label { margin: 20px 0px; display: block; }

#ppt_edit_menu section .box-admin .add-on {    float: right !important; width:auto !important; }


/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) { 
 
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) and (max-width: 1199.98px) { 
 
#ppt_edit_menu .nav {    width: 120px; }
#ppt_edit_menu section {    margin-left: 140px; }
#ppt_edit_menu section .box-admin .input-group {    width: 100%;    float: none; }
#ppt_edit_menu section .box-admin label { float: none;  width: 100%; margin:0px !important; }
#ppt_edit_menu section .box-admin {  padding: 5px !important; border-bottom:0px; }
 
}
 
/* mobile */
@media (max-width: 991.98px) {
#ppt_edit_menu .nav a span { display:none; } 
#ppt_edit_menu .nav {    width: 20px; }
#ppt_edit_menu section {    margin-left: 40px; }
#ppt_edit_menu section .box-admin .input-group {    width: 100%;    float: none; }
#ppt_edit_menu section .box-admin label { float: none;  width: 100%; margin:0px !important; }
#ppt_edit_menu section .box-admin {  padding: 5px !important; border-bototm:0px; }

}
 
 
</style>
<div id="ppt_edit_menu">

<div class="nav">
 
	 
<?php if(defined('WLT_CART') && THEME_KEY != "ph"){  ?>

<a href="#" data-id="tab-price" class="nav-tab  nav-tab-active"> <i class="dashicons dashicons-admin-tools"></i> <span>General</span></a>
<a href="#" data-id="tab-tax" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-archive"></i>  <span>Shipping &amp; Tax</span></a>

<a href="#" data-id="tab-w" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-image-rotate-right"></i> <span>Shape &amp; Size</span></a>

<a href="#" data-id="tab-stock" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-controls-pause"></i> <span>Stock</span></a>
<a href="#" data-id="tab-color" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-image-filter"></i> <span>Color Attribute</span></a>
<a href="#" data-id="tab-size" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-editor-ol"></i> <span>Size Attribute</span></a>
<a href="#" data-id="tab-ids" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-editor-help"></i> <span>Product ID</span></a>

<a href="#" data-id="tab-paypal" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-cart"></i> <span>PayPal BuyNow</span></a>
<a href="#" data-id="tab-att" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-format-status"></i> <span>Custom Attributes</span></a>
 



<?php }else{ ?> 
 
<a href="#" data-id="tab-details" class="nav-tab  nav-tab-active"><i class="dashicons dashicons-admin-generic"></i> <span>General</span></a>
   
	<?php if(THEME_KEY == "mj"){ ?>
    <a href="#" data-id="tab-s1" class="nav-tab"> <i class="dashicons dashicons-media-default"></i> <span>Standard Gig</span></a>
    <a href="#" data-id="tab-s2" class="nav-tab"> <i class="dashicons dashicons-welcome-add-page"></i> <span>Premium Gig</span></a>
    <a href="#" data-id="tab-addons" class="nav-tab"> <i class="dashicons dashicons-editor-unlink"></i> <span>Addons</span></a>
    <?php } ?>
        
    <?php if(!in_array(THEME_KEY, array('ph'))){ ?>    
    <a href="#" data-id="tab-youtube" class="nav-tab mapmebox"> <i class="dashicons dashicons-format-video"></i> <span>YouTube</span></a> 
    <?php } ?> 
     
    <a href="#" data-id="tab-enhance" class="nav-tab"><i class="dashicons dashicons-admin-tools"></i> <span>Upgrades</span></a> 
    <a href="#" data-id="tab-access" class="nav-tab"> <i class="dashicons dashicons-lock"></i>  <span>Page Access</span></a>  
    <?php if(_ppt('google') == 1 ){ ?>
    <a href="#" data-id="tab-map" class="nav-tab" onclick="loadGoogleMapsApi();"> <i class="dashicons dashicons-location"></i> <span>Google Map</span></a>  
    <?php } ?>

<?php } ?>
 
</div>


<div id="sections"> 

<?php 

if(defined('WLT_CART') && THEME_KEY != "ph"){ 
get_template_part('/framework/admin/_edit_product', '' );  
}else{
?>
<section id="tab-details">
<?php do_action('hook_v9_admin_edit_options'); ?>
</section>
<?php } ?>

<?php if(THEME_KEY == "mj"){ ?>
<section id="tab-s1" style="display:none;">
    <div class="box-admin">
        <label>Name</label>
        <div class="input-group"> 
        <input class="form-control" name="custom[gig]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "gig", true); } ?>" />
        </div>
    </div>
    
    <div class="box-admin">
        <label>Price</label>
        <div class="input-group">
        <input class="form-control" id="price_current" placeholder="<?php echo hook_currency_symbol(''); ?>"  name="custom[price]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "price", true); } ?>" />
        </div>
    </div>
        
    <script>
	jQuery( "#price_current" ).change(function() {	   
		jQuery( "#price_current" ).val( jQuery( "#price_current" ).val().replace(',', '') );	  
	});
	</script>
    <?php
	
	// DAYS ARRAY
		$i=2; $gg = array("1" => "1 ".__("day","premiumpress")) ;
		while($i< 31){
		$gg[$i] = $i." ".__("days","premiumpress");
		$i++; 
		}
	
	?>
    
    
      <div class="box-admin">
        <label>Complete within;</label>
        <div class="input-group"> 
      <select name="custom[days]" class="form-control" style="width:100%">
        <?php
       
            $values = $gg         
            ?>
             
            <?php foreach($values as $k => $v){ ?>
            <option value="<?php echo $k; ?>" <?php if(isset($_GET['post']) && $CORE->get_edit_data('days', $_GET['post']) == $k ){ echo "selected=selected"; } ?>><?php echo $v; ?></option>
            <?php } ?>        
        </select>
      
        </div>
    </div>  
 
    <div class="box-admin">
        <label>Description</label>
        <div class="input-group"> 
        <input class="form-control" name="custom[desc]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "desc", true); } ?>" />
        </div>
    </div>

</section>
<section id="tab-s2" style="display:none;">


    <div class="box-admin">
        <label>Name</label>
        <div class="input-group"> 
        <input class="form-control" name="custom[gig-1]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "gig-1", true); } ?>" />
        </div>
    </div>
    
    <div class="box-admin">
        <label>Price</label>
        <div class="input-group">           
        <input class="form-control" placeholder="<?php echo hook_currency_symbol(''); ?>" id="price_current-1" name="custom[price-1]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "price-1", true); } ?>" />
        </div>
    </div>
        
    <script>
	jQuery( "#price_current-1" ).change(function() {	   
		jQuery( "#price_current-1" ).val( jQuery( "#price_current-1" ).val().replace(',', '') );	  
	});
	</script>
    <?php
	
	// DAYS ARRAY
		$i=2; $gg = array("1" => "1 ".__("day","premiumpress")) ;
		while($i< 31){
		$gg[$i] = $i." ".__("days","premiumpress");
		$i++; 
		}
	
	?>
    
    
      <div class="box-admin">
        <label>Complete within;</label>
        <div class="input-group"> 
      <select name="custom[days-1]" class="form-control" style="width:100%">
        <?php
       
            $values = $gg         
            ?>
             
            <?php foreach($values as $k => $v){ ?>
            <option value="<?php echo $k; ?>" <?php if(isset($_GET['post']) && $CORE->get_edit_data('days-1', $_GET['post']) == $k ){ echo "selected=selected"; } ?>><?php echo $v; ?></option>
            <?php } ?>        
        </select>
      
        </div>
    </div>  
 
    <div class="box-admin">
        <label>Description</label>
        <div class="input-group"> 
        <input class="form-control" name="custom[desc-1]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "desc-1", true); } ?>" />
        </div>
    </div>

</section>

<section id="tab-addons" style="display:none;">

<?php 
$current_data = get_post_meta($post->ID,'customextras', true);
$num=1; $i=0; while($i < 5){ ?>
<p style="font-weight:bold;">Addon Extras <?php echo $num; ?></p>


<div class="box-admin">
	<label>Name</label>
    <div class="input-group">
	<input class="form-control" name="customextras[name][]" value="<?php if( isset($current_data['name'][$i]) ){  echo $current_data['name'][$i]; } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Description</label>
    <div class="input-group">
	<input class="form-control" name="customextras[value][]" value="<?php if( isset($current_data['value'][$i]) ){  echo $current_data['value'][$i]; } ?>" />
    </div>
</div>


<div class="box-admin">
	<label>Price</label>
    <div class="input-group">
	<input class="form-control" placeholder="<?php echo hook_currency_symbol(''); ?>" name="customextras[price][]" value="<?php if( isset($current_data['price'][$i]) ){  echo $current_data['price'][$i]; } ?>" />
    </div>
</div>

<?php $i++; $num++; } ?>
</section>
<?php } ?>

 





<section id="tab-enhance" style="display:none;">

     <div class="box-admin">
        <label>Make Featured</label>
        <div class="input-group"> 
      <select name="custom[featured]" class="form-control" style="width:100%">
        <?php
       
            $values = array("no" => __( 'No', 'premiumpress' ), "yes" => __( 'Yes', 'premiumpress' ) );         
            ?>
             
            <?php foreach($values as $k => $v){ ?>
            <option value="<?php echo $k; ?>" <?php if(isset($_GET['post']) && $CORE->get_edit_data('featured', $_GET['post']) == $k ){ echo "selected=selected"; } ?>><?php echo $v; ?></option>
            <?php } ?>        
        </select>
      
        </div>
    </div>    
    
     <div class="box-admin">
        <label>Listing Package</label>
        <div class="input-group"> 
        <select name="custom[packageID]">
<option value=""></option>
<?php $i=0; 
$paknames = array('Basic','Standrad','Premium', 'Extra 1', 'Extra 2', 'Extra3', 'Extra4');
while($i < 7){ ?>
<option value="<?php echo $i; ?>" <?php if(isset($_GET['post']) && get_post_meta($_GET['post'],'packageID', true) == $i){ echo "selected=selected"; } ?>><?php if(_ppt('pak'.$i.'_name') == ""){ echo $paknames[$i]; }else{ echo _ppt('pak'.$i.'_name'); } ?> </option>
<?php $i++; } ?>
<option value="99" <?php if(isset($_GET['post']) && get_post_meta($_GET['post'],'packageID', true) == 99){ echo "selected=selected"; } ?>>Free Listing</option>
</select>
      
        </div>
    </div>    
    

    
    
</section>

<section id="tab-youtube" style="display:none;">

    <div class="box-admin">
        <label><?php echo __("Youtube Video Link","premiumpress"); ?></label>
 
 
        <input class="form-control" style="width:100%;" id="available_date" name="custom[Youtube_link]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "Youtube_link", true); } ?>"/>
    
    </div>
 
</section>





<?php if(_ppt('google') == 1 ){ ?>
<section id="tab-map" style="display:none;">
<?php get_template_part('/framework/admin/_edit_map', '' ); ?> 
</section>
<?php } ?>









<?php

	$status = array(
		"" => "Everyone",
		"1" => "Members Only",		
		"subs" => "Members With Subscriptions",
	 
	);
	
	// ADD ON SUBSCRIPTIONS
	$csubscriptions = get_option("csubscriptions"); 
	if(is_array($csubscriptions) && !empty($csubscriptions) ){ 
	 
		$i=0;	
		foreach($csubscriptions['name'] as $xxx){ 
			if(strlen($xxx) > 0){
			
			$status[$csubscriptions['key'][$i]] = $xxx;
			
			}
		$i++;
		}
		
	}
	
	
	$value = get_post_meta($post->ID,'pageaccess',true);
	
	?>
    
<section id="tab-access" style="display:none;">
     <div class="box-admin">
        <label>Page Access</label>
        <div class="input-group"> 
    	<select name="custom[pageaccess]" style="width:100%;">
		<?php foreach($status as $key => $club){ ?>
		<option value="<?php echo $key; ?>" <?php if($key == $value){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
		<?php } ?>
	</select>
        </div>
    </div> 

</section>
 

<div class="clear"></div>

</div>

<div class="clear"></div>
 
</div>

<?php

}


function _custom_fields(){ global $CORE, $post;
	
	if(isset($_GET['post'])){
	$_GET['eid'] = $_GET['post'];
	}
	
	echo str_replace("<select","<select style='width:100%;' ",str_replace("col-md-6","box-admin",str_replace("field_wrapper","input-group",$CORE->SUBMISSION_FIELDS())));
	
	if(isset($_GET['post'])){
	?>
    	<input name="save" type="submit" class="button button-primary button-large" value="Save Changes" style="margin-top:10px">
    <?php
	}

}


 
 

/*
	this function saves all the admin
	custom data
*/
function _custom_metabox_save($post_id){ global $pagename, $wpdb, $CORE;
 
	if(!is_numeric($post_id)){ return; }
	
	 
	if(isset($_POST['custom']) && is_array($_POST['custom'])){	
		foreach($_POST['custom'] as $k=>$v){		 	
			if($k == ""){ continue; }			
			update_post_meta($post_id, $k, $v);			
		}		 
	}// end if
	
	// ATTRIBUTES
	if( isset($_POST['attributes']) ){  
		update_post_meta($post_id,"attributes", $_POST['attributes'] );  		
	}
	
	// CHECK FOR GALLERY ITEMS  
	 
    if ( isset($_POST['gallery']) && is_array($_POST['gallery']) ) 
    {
        // Build array for saving post meta
        $gallery_data = array();
		$i=0; $order = 1;
		
		
		if(is_array($_POST['gallery']['image_aid'])){
        foreach($_POST['gallery']['image_aid'] as $img){ 
		
			if($_POST['gallery']['image_url'][ $i ] == ""){ $i++;  continue; }
			
			$dims = "";		 	
		 
			// IF AID IS 0, TRY AND GET IT FROM THE DATABASE DIRECTLY
			if($_POST['gallery']['image_aid'][ $i ] == 0  ){
		
				$SQL = "SELECT post_id AS post_id FROM ".$wpdb->prefix."postmeta WHERE meta_value LIKE '%".str_replace(" ","-", $_POST['gallery']['image_url'][ $i ])."%' LIMIT 1"; 				 			 		
				$p = $wpdb->get_results($SQL,ARRAY_A);
				
				if(empty($p)){
				
					$SQL = "SELECT ID as post_id FROM ".$wpdb->prefix."posts WHERE post_title LIKE '%".str_replace(" "," ", $_POST['gallery']['image_url'][ $i ])."%' LIMIT 1";
					$p = $wpdb->get_results($SQL,ARRAY_A);
				}
				
				if(isset($p[0]['post_id'])){				
					$_POST['gallery']['image_aid'][ $i ] = $p[0]['post_id']; 
				}		
			
			} 
			
			// DO NOT ADD FILES WITHOUT A VALID [AID]
			if($_POST['gallery']['image_aid'][ $i ] == 0 || $_POST['gallery']['image_aid'][ $i ] == ""){
			 
				$i++; continue;
			}
			
			// CHECK FILE TYPE
			$fullsize_path = get_attached_file( $_POST['gallery']['image_aid'][ $i ] );
			 
			// GET FILE TYPE
			$wp_filetype = wp_check_filetype( $fullsize_path, null );
			 
			// SWITCH BASED ON TYPE
			if(in_array($wp_filetype['type'], $CORE->allowed_image_types)){ 
				
				// GET IMAGE DATA
				$ad =  wp_get_attachment_metadata( $_POST['gallery']['image_aid'][ $i ] );		
				$awidth = $ad['width'];			
				$aheight = $ad['height'];	
				$dims = $ad['width']."x".$ad['height'];
			
			}elseif(in_array($wp_filetype['type'], $CORE->allowed_video_types)){ 
	 
			}elseif(in_array($wp_filetype['type'], $CORE->allowed_music_types)){ 
			 
			}elseif(in_array($wp_filetype['type'], $CORE->allowed_doc_types)){
			 
			}else{
			
				// UNKNOWN SO DONT ADD IT
				die($wp_filetype['type']." is an unsupported file type.");
			 	$i++; continue;
			} 
			
			// THUMBNAIL
			$thumb = "";
			if(get_the_post_thumbnail_url($file['id']) != ""){
			$thumb = wp_get_attachment_thumb_url( $_POST['gallery']['image_aid'][ $i ] );			
			}
			
			// THUMBNAIL FOR VIDEO
			if(isset($_POST['gallery']['thumbnail'][ $i ])){
			$thumb = $_POST['gallery']['thumbnail'][ $i ];
			}			 
			
			// GET FILESIZE
			$size = filesize( get_attached_file( $_POST['gallery']['image_aid'][ $i ] ) );	

			// BUILD ARRAY TO SAVE IMAGE INTO DATABASE
			$gallery_data[] = array(
						'name' 		=> "",
						'type'		=> $wp_filetype['type'],
						'postID'	=> $post_id,					 
						'src' 		=> $_POST['gallery']['image_url'][ $i ],						
						'thumbnail' => $thumb,						
						'filepath' 	=> addslashes( $_POST['gallery']['image_url'][ $i ]),
						'id'		=>  $_POST['gallery']['image_aid'][ $i ],
						'default' 	=> 0,
						'order'		=> $order,						
						'dimentions' => $dims,						
						'dpi' 		=> '300',
						'size' 		=> $size,
						
			);
		 	
			
			$i++;
			$order++;
				
        }// end if
		}
		
	     
	   // UPDATE DATA
       update_post_meta( $post_id, 'image_array', $gallery_data );
         
		 
    } 
    
	
}
 
/*
	this box adds a option to choose who can
	access the page from the front end.
*/

function _box_page_breadcrumbs(){ global $post;

?>
<textarea name="custom[sub-description]" style="width:100%; height:100px !important;"><?php echo stripslashes(get_post_meta($post->ID, 'sub-description', true)); ?></textarea>
<small style="margin-top:10px;">
Displayed only if breadcrumbs is enabled and set to style 3.
</small>
<?php 
}
 

function _box_pageheader(){ global $post 
 	
	?>     
    <div style="margin-bottom:10px; margin-top:10px; font-weight:bold; color:#666666; ">Page Header</div>
    
	<input name="custom[pageheader_title]" style="width:100%;" value="<?php echo get_post_meta($post->ID,'pageheader_title',true); ?>">
	
    <div style="margin-bottom:10px; margin-top:10px; font-weight:bold; color:#666666; ">Sub Title</div>
    
	<textarea style="height:100px; width:100%;" name="custom[pageheader_sub]"><?php echo stripslashes(get_post_meta($post->ID,'pageheader_sub',true)); ?></textarea>
	
    <div style="margin-bottom:10px; margin-top:10px; font-weight:bold; color:#666666; ">Description</div>
    
	<textarea style="height:100px; width:100%;" name="custom[pageheader_desc]"><?php echo stripslashes(get_post_meta($post->ID,'pageheader_desc',true)); ?></textarea>
	
     
    <?php 
}

function _box_pagecolumns(){ global $post, $CORE; 

	$columns = array(
		//"" => "Theme Default",
			"3" => "Sidebar right",	
		"1" => "Full Width",		
		"2" => "Sidebar Left",
	  
	);	
	
	$value = get_post_meta($post->ID,'pagecolumns',true);
	if($value  == ""){ $value  = 3; }
	
	?>     
	<select name="custom[pagecolumns]" style="width:100%;">
		<?php foreach($columns as $key => $club){ ?>
		<option value="<?php echo $key; ?>" <?php if($key == $value){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
		<?php } ?>
	</select>
    <?php 
}

function _box_pageaccess(){ global $post, $CORE; 

	$status = array(
		"" => "Everyone",
		"1" => "Members Only",		
		"subs" => "Members With Subscriptions",
	 
	);
	
	// ADD ON SUBSCRIPTIONS
	$csubscriptions = get_option("csubscriptions"); 
	if(is_array($csubscriptions) && !empty($csubscriptions) ){ 
	 
		$i=0;	
		foreach($csubscriptions['name'] as $xxx){ 
			if(strlen($xxx) > 0){
			
			$status[$csubscriptions['key'][$i]] = $xxx;
			
			}
		$i++;
		}
		
	}
	
	
	$value = get_post_meta($post->ID,'pageaccess',true);
	
	?>
    
    <small>Select which membership packages have access to this page.</small>
    
	<select name="custom[pageaccess]" style="width:100%;">
		<?php foreach($status as $key => $club){ ?>
		<option value="<?php echo $key; ?>" <?php if($key == $value){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
		<?php } ?>
	</select>
<?php
}


function _box_invoices(){ global $post, $CORE; 

?>

<div class="box-admin">
	<label>From User ID</label>
    <div class="input-group"> 
    <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>     
    <input class="form-control hasaddon" name="custom[invoice_from]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "invoice_from", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>To User ID</label>
    <div class="input-group"> 
    <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>     
    <input class="form-control hasaddon" name="custom[invoice_to]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "invoice_to", true); } ?>" />
    </div>
</div>
<div class="box-admin">
	<label>Amount Due</label>
    <div class="input-group"> 
    <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>     
    <input class="form-control hasaddon" name="custom[invoice_amount]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "invoice_amount", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Status</label>
    <div class="input-group">
 
<select  name="custom[invoice_status]"class="form-control" style="width:100%;">
<?php
$invoice_status = 0;
if( isset($_GET['post']) ){  
$invoice_status = get_post_meta($_GET['post'], "invoice_status", true);
}
// ORDER STATUS
$orderstatus = $CORE->order_get_status();
unset($orderstatus[8]);
foreach($orderstatus as $k => $n){
?>
<option value="<?php echo $k; ?>" <?php selected( $invoice_status, $k ); ?>><?php echo $n['name']; ?></option>
<?php } ?>
</select>
     
    </div>
</div>
<?php
}

function _box_payments(){ global $post, $CORE; 

?>

<div class="box-admin">
	<label>Buyer ID</label>
    <div class="input-group"> 
    <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>     
    <input class="form-control hasaddon" name="custom[buyer_id]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "buyer_id", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Seller ID</label>
    <div class="input-group"> 
    <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>     
    <input class="form-control hasaddon" name="custom[seller_id]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "seller_id", true); } ?>" />
    </div>
</div>
<div class="box-admin">
	<label>Amount Due</label>
    <div class="input-group"> 
    <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>     
    <input class="form-control hasaddon" name="custom[amount]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "amount", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Status</label>
    <div class="input-group">
	<select name="custom[status]" class="form-control" style="width:100%;">
	<option value="0" <?php if(isset($_GET['post']) && $CORE->get_edit_data('status', $_GET['post']) == 0){ ?>selected="selected"<?php } ?>>Waiting Payment</option>
	<option value="1" <?php if(isset($_GET['post']) && $CORE->get_edit_data('status', $_GET['post']) == 1){ ?>selected="selected"<?php } ?>>Paid</option>    
    <option value="2" <?php if(isset($_GET['post']) &&$CORE->get_edit_data('status', $_GET['post']) == 2){ ?>selected="selected"<?php } ?>>Refunded</option> 
    <option value="3" <?php if(isset($_GET['post']) &&$CORE->get_edit_data('status', $_GET['post']) == 3){ ?>selected="selected"<?php } ?>>Cancelled</option> 
     </select>
    </div>
</div>
<?php
}

function _box_event(){ global $post, $CORE; 

?> 
<script >
jQuery(document).ready(function($) {
	jQuery('#event-date').datetimepicker();
});
 
</script>
<div class="box-admin">
    <label>Event Date</label>  
    <div class="input-group">	
    <div id="event-date" data-date="<?php if(isset($_GET['post'])){ echo get_post_meta($_GET['post'],'date',true); } ?>" data-date-format="yyyy-MM-dd hh:mm:ss">    
    <input class="hasaddon form-control" name="custom[date]" value="<?php if(isset($_GET['post'])){  echo get_post_meta($_GET['post'],'date',true); } ?>" data-format="yyyy-MM-dd hh:mm:ss">
    <span class="add-on"><i class="dashicons dashicons-calendar-alt" style="cursor:pointer"></i></span>
    </div>
    </div>
</div>


<div class="box-admin">
	<label>Event Price</label>
    <div class="input-group"> 
    <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>     
    <input class="form-control hasaddon" name="custom[price]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "price", true); } ?>" />
    </div>
</div>
        
<div class="box-admin">
	<label>Event Location</label>
    <div class="input-group">
	<input class="form-control" style="width:100%;" name="custom[location]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($_GET['post'], "location", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Event Status</label>
    <div class="input-group">
	<select name="custom[status]" class="form-control" style="width:100%;">
	<option value="" <?php if(isset($_GET['post']) && $CORE->get_edit_data('status', $_GET['post']) == ""){ ?>selected="selected"<?php } ?>>Available</option>
	<option value="1" <?php if(isset($_GET['post']) && $CORE->get_edit_data('status', $_GET['post']) == 1){ ?>selected="selected"<?php } ?>>Fully Booked</option> 
    <option value="2" <?php if(isset($_GET['post']) &&$CORE->get_edit_data('status', $_GET['post']) == 2){ ?>selected="selected"<?php } ?>>Cancelled</option> 
            
    </select>
    </div>
</div>

<?php
}



function _box_map(){ global $post, $CORE; 


$MYLOCATION = "";
if(isset($_GET['post'])){
$MYLOCATION = get_post_meta($_GET['post'],'map-location',true);
}

?>


<div style="text-align:center; margin-top:10px;">

<?php if(strlen($MYLOCATION) > 1){ echo $MYLOCATION; }else{ ?>No Location Set<?php } ?>


<a href="javascript:void(0);" onclick="loadGoogleMapsApi();" class="button" style="display:block; margin-top:20px; margin-bottom:10px;">Change Location</a>

</div>
   

<div id="wlt_map_location"  style="width:100%;"></div>


<div id="map_formbox" style="display:none;">


<label class="small mt-2">Enter Location</label>

 <input type="text" onchange="getMapLocation(this.value);" style="width:100%; margin-bottom:30px;" name="custom[map-location]" id="form_map_location" class="long" tabindex="14" value="<?php echo $MYLOCATION; ?>">
 <input type="hidden" id="map-long" name="custom[map-log]" value="<?php echo get_post_meta($_GET['post'],'map-log',true); ?>">
 <input type="hidden" id="map-lat" name="custom[map-lat]"  value="<?php echo get_post_meta($_GET['post'],'map-lat',true); ?>"> 
 
 
<label class="small mt-2" style="float:left;">Country</label>
<input type="text" id="map-country" name="custom[map-country]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-country',true).'"'; } ?> class="form-control form-control-sm" style="float:right;">
<div class="clear"></div>

<label class="small mt-2" style="float:left;">State/County</label>
<input type="text" id="map-state" name="custom[map-state]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-state',true).'"'; } ?> class="form-control form-control-sm" style="float:right;">
<div class="clear"></div>

<label class="small mt-2" style="float:left;">City</label>
<input type="text" id="map-city" name="custom[map-city]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-city',true).'"'; } ?> class="form-control form-control-sm" style="float:right;">
<div class="clear"></div>
 
<label class="small mt-2" style="float:left;">Area</label>
<input type="text" id="map-area" name="custom[map-area]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-area',true).'"'; } ?> class="form-control form-control-sm" style="float:right;">
<div class="clear"></div>

<label class="small mt-2" style="float:left;">Route/Street</label>           
<input type="text" id="map-route" name="custom[map-route]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-route',true).'"'; } ?> class="form-control form-control-sm" style="float:right;">
<div class="clear"></div>
         
<label class="small mt-2" style="float:left;">Neighborhood</label>           
<input type="text" id="map-neighborhood" name="custom[map-neighborhood]" <?php if(isset($_GET['post'])){ echo 'value="'.get_post_meta($_GET['post'],'map-neighborhood',true).'"'; } ?> class="form-control form-control-sm" style="float:right;">
<div class="clear"></div>   
 
<label class="small mt-2" style="float:left;">Zipcode</label>   
  <input type="text" id="map-zip" name="custom[map-zip]"  value="<?php if(isset($_GET['post'])){ echo get_post_meta($_GET['post'],'map-zip',true); } ?>" class="form-control form-control-sm" style="float:right;">
<div class="clear"></div>  
 
 
 
 <input name="save" type="submit" class="button button-primary button-large" value="Save" style="margin-top:10px;">
 
</div>
 
<script > 
var geocoder;var map;var marker = '';   var markerArray = [];    

function loadGoogleMapsApi(){


 
 jQuery('#wlt_map_location').css('height', '300px');
 jQuery('#map_formbox').show();


    if(typeof googlemap === "undefined"){
        var script = document.createElement("script");
        script.src = "https://maps.google.com/maps/api/js?callback=loadWLTGoogleMapsApiReady&key=<?php echo _ppt('googlemap_apikey'); ?>";
        document.getElementsByTagName("head")[0].appendChild(script);				
    } else {
        loadWLTGoogleMapsApiReady();
    }
}
function loadWLTGoogleMapsApiReady(){ 
	jQuery("body").trigger("gmap_loaded"); 
}
jQuery("body").bind("gmap_loaded", function(){

			<?php if(isset($_GET['post']) && is_numeric($_GET['post']) && get_post_meta($_GET['post'],'map-log',true) !=""){ ?>
			
			var myLatlng = new google.maps.LatLng(<?php echo get_post_meta($_GET['post'],'map-lat',true); ?>,<?php echo get_post_meta($_GET['post'],'map-log',true); ?>);
			
			var myOptions = { zoom: <?php if(isset($_GET['post'])){ echo 16; }else{ echo 8; } ?>,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP}
			
			<?php }else{ ?>
			var myLatlng = new google.maps.LatLng(0,0);
			var myOptions = { zoom: 1,  center: myLatlng,  mapTypeId: google.maps.MapTypeId.ROADMAP}
			<?php } ?>
			 
			
            map = new google.maps.Map(document.getElementById("wlt_map_location"), myOptions);
			<?php if(isset($_GET['post']) && get_post_meta($_GET['post'],'map-log',true) !=""){ ?>
			var marker = new google.maps.Marker({
					position: myLatlng,
					map: map				 
				});
			markerArray.push(marker);
			<?php } ?>
			
			google.maps.event.addListener(map, 'click', function(event){			
				document.getElementById("map-long").value = event.latLng.lng();	
				document.getElementById("map-lat").value =  event.latLng.lat();
				getMyAddress(event.latLng);	
				addMarker(event.latLng);			
			});

});
function addMarker(location) {

	jQuery(markerArray).each(function(id, marker) {	
        marker.setVisible(false);
    });
	
	marker = new google.maps.Marker({	position: location, 	map: map,	});
	markerArray.push(marker);
	map.panTo(marker.position); 
	map.setCenter(location);  
}	
function getMapLocation(location){
 
			document.getElementById("map-state").value = "";
			var geocoder = new google.maps.Geocoder();if (geocoder) {	geocoder.geocode({"address": location}, function(results, status) {	if (status == google.maps.GeocoderStatus.OK) {
		 
			map.setCenter(results[0].geometry.location);
			addMarker(results[0].geometry.location);
			getMyAddress(results[0].geometry.location,"no");		
			document.getElementById("map-long").value = results[0].geometry.location.lng();	
			document.getElementById("map-lat").value =  results[0].geometry.location.lat();
			map.setZoom(9);		
			}});}
			
}
function getMyAddress(location){var geocoder = new google.maps.Geocoder();if (geocoder) {geocoder.geocode({"latLng": location}, function(results, status) { 

	if (status == google.maps.GeocoderStatus.OK) {
			 
				for (var i = 0; i < results[0].address_components.length; i++) {
				
                          var addr = results[0].address_components[i];
						   
						  switch (addr.types[0]){
						  	
								case "street_number": {
									//document.getElementById("map-address1").value = addr.long_name;
								} break;
								
								
								// area
								case "political": {
									document.getElementById("map-area").value = addr.long_name;
								} break;
								// neighborhood
								case "neighborhood": {
									document.getElementById("map-neighborhood").value = addr.long_name;
								} break;
								// street
								case "route": {
									document.getElementById("map-route").value = addr.long_name;
								} break;
								 
								
								case "locality": 
								case "postal_town": 
								{								 
									//document.getElementById("map-address3").value = addr.long_name;
									document.getElementById("map-city").value = addr.long_name;
								} break;
							
							case "postal_code": {
									document.getElementById("map-zip").value = addr.long_name;
								} break;
							case "administrative_area_level_1": {							
								document.getElementById("map-state").value = addr.long_name;
							} break;
							
							case "administrative_area_level_2": {							 
								document.getElementById("map-state").value = addr.long_name;
							} break;
							
							case "administrative_area_level_3": {						
								document.getElementById("map-state").value = document.getElementById("map-state").value + addr.long_name;
							} break;
							
							case "country": {
								document.getElementById("map-country").value = addr.short_name;	
							} break;						  
						  
						  } // end switch
						  
                } // end for
				 
			
			 document.getElementById("form_map_location").value = results[0].formatted_address;
			map.setCenter(results[0].geometry.location);
			}
});	}}

</script>







    <script >
 
        function add_map(obj) {
			
            var parent = jQuery(obj).parent().parent().parent().parent('div.field_row');
		 	 
            var inputField = jQuery(parent).find(".meta_image_url");

            tb_show('', 'admin.php?page=1');

            window.send_to_editor = function(html) {
			 
				var url = jQuery(html).attr('src');	 
				
				var imageid = jQuery(html).attr('class').replace(/\D/g,'');	
				 
                inputField.val(url);
				
                jQuery(parent).find("div.image_wrap").html('<img src="'+url+'" height="48" style="float:left; max-width:50px;" /><input type="hidden" name="gallery[image_aid][]" value="' + imageid +'">');

                // inputField.closest('p').prev('.awdMetaImage').html('<img height=120 width=120 src="'+url+'"/><p>URL: '+ url + '</p>'); 

                tb_remove();
            };

            return false;  
        }

        
    </script>



<?php

}

function _box_media(){ global $post, $CORE; 
 
 
    $gallery_data = get_post_meta( $post->ID, 'image_array', true );
 
?>
 
<ul id="mediaelements">
 
<?php  if ( is_array($gallery_data) && !empty($gallery_data) ) { foreach($gallery_data as $img){ ?>
        <li style="background:#fff; margin-bottom:15px; display:block; clear:both; min-height: 150px;"><div class="fileuploadbox">
    
    
     <div style="width:20%; float:left;">
     
     
     <div class="image_wrap" style="text-align:center">
     <?php if(in_array($img['type'],$CORE->allowed_image_types)){  ?>
     
     <img src="<?php esc_html_e( $img['src'] ); ?>" style="max-width:150px; max-height:150px;" />
     
     <?php }elseif(in_array($img['type'],$CORE->allowed_video_types)){ ?>
     
     <?php 	// CHECK FOR IMAGE ATTACHMENT
			if(get_the_post_thumbnail_url($img['id']) != "" ){
				
			?>
            
            <img src="<?php echo get_the_post_thumbnail_url($img['id']); ?>" class="img-fluid" style="max-width:150px; max-height:150px;">
				
            <?php }elseif(isset($img['thumbnail'])){ ?>
            
             
             <img src="<?php echo $img['thumbnail']; ?>" class="img-fluid" style="max-width:150px; max-height:150px;">
			  
                
			<?php }else{  ?>
			
            <img src="https://via.placeholder.com/150x100.png?text=No+Preview" style="max-width:150px; max-height:150px;" /> 
				
			<?php }	?>
     
     <?php }elseif(in_array($img['type'],$CORE->allowed_music_types)){ ?>
     
     <img src="https://via.placeholder.com/150x100.png?text=No+Preview" style="max-width:150px; max-height:150px;" />
     
     <?php }elseif(in_array($img['type'],$CORE->allowed_doc_types)){ ?>
     
     <img src="https://via.placeholder.com/150x100.png?text=No+Preview" style="max-width:150px; max-height:150px;" />
     
     <?php }else{ ?>
     
     Unknown file file
     
     <?php } ?>
     
     </div>
      
      </div>
      <div style="width:72%; float:left;">
      
        	<input value="<?php echo $img['id']; ?>" type="hidden" name="gallery[image_aid][]" class="imageidfield<?php echo $img['id']; ?>"   />            
          
            <label>Attached File ~ type: <?php echo $img['type']; ?> ~ size: <?php echo $CORE->_format_bytes($img['size']); ?></label>
            
            <div class="input-group" style="padding:10px; border:1px solid #ddd; margin-bottom:10px; margin-top:10px;"> 
                
            <input class="hasaddon meta_image_url" value="<?php esc_html_e( $img['src'] ); ?>" type="text" name="gallery[image_url][]" style="width:100%;" />
            
            </div>            
             
            <a href="javascript:void(0);" onclick="removeme('imageidfield<?php echo $img['id']; ?>');add_image(this)" class="button" >Update File</a> |
              
            <input class="button" type="button" value="Remove File" onclick="remove_field(this)"/>
             
            
            <?php if(in_array($img['type'],$CORE->allowed_video_types)){ ?>
            
            <hr class="mt-4" />
              
            <label>Video Image </label>
            
            <div class="input-group" style="padding:10px; border:1px solid #ddd; margin-bottom:10px; margin-top:10px;"> 
                
            <input class="hasaddon meta_image_thumbnail" value="<?php esc_html_e( $img['thumbnail'] ); ?>" type="text" name="gallery[thumbnail][]" style="width:100%;" />
            
            </div>
             
            <a href="javascript:void(0);" onclick="add_thumbnail(this)" class="button" >Update Image</a> 
             
            <?php } ?>
            
            
            
            
            
      
      </div> 
      
      
      </div> </li>
      
        <?php
        } // endif
    } // endforeach
    ?>
</ul>  

<div style="display:none" id="master-row">
<li style="background:#fff; border-bottom: 1px solid #ececec; margin-bottom:15px; display:block; clear:both; height: 150px;"><div class="fileuploadbox">
     
    
        <div style="width:14%; float:left;">
            <div class="image_wrap"  style="width:100px; height:100px;">&nbsp;</div>      
        </div>
        <div style="width:72%; float:left;">
              
                    <label>Attached File</label>
                    
                    <div class="input-group" style="padding:10px; border:1px solid #ddd; margin-bottom:10px; margin-top:10px;"> 
                        
                    <input class="hasaddon meta_image_url" value="" type="text" name="gallery[image_url][]" style="width:100%;" />
                    </div>
                    
                   <a href="javascript:void(0);" onclick="add_image(this)" class="addimg button">Update</a> | <input class="button" type="button" value="Remove" onclick="remove_field(this)"/> 
                    
        </div> 
    
  
</div></li>
</div>

<div class="clear clearfix"></div>

<div id="add_field_row" style="margin-top:30px;">

<!--
	<input name="save" type="submit" class="button button-primary button-large" value="Save" style="float:right;">
-->

	<input class="button" type="button" value="Add <?php if(THEME_KEY == "vt"){ ?>Video<?php }else{ ?>Image/Video<?php } ?>" onclick="add_field_row();" />
</div>
 

    <script >
	jQuery(document).ready(function() {	
	
	jQuery('#mediaelements').sortable();
	
	});	
	
	function removeme(id){	
 
			// REMOVE OLD ONE
			jQuery('.'+id).remove().html();
	}
	
	
    function add_thumbnail(obj) {
		 	
            var parent = jQuery(obj).parent().parent('div.fileuploadbox');		 	 
           
			var inputField = jQuery(parent).find(".meta_image_thumbnail");

            tb_show('Select File', 'media-upload.php?TB_iframe=true');

            window.send_to_editor = function(html) {
			 	 
			if(typeof jQuery(html).attr('rel') !== "undefined"){
				 
				$thisimage = jQuery(html).find("img");		 	
				var url 		= $thisimage[0]['src'];	 				 
				var imageid 	= $thisimage[0]['className'].replace(/\D/g,'');	
		   
			} else if(typeof jQuery(html).attr('src') !== "undefined"){	
					 
				var url = jQuery(html).attr('src');	 				 
				var imageid = jQuery(html).attr('class').replace(/\D/g,'');	
			
			} else if(typeof jQuery(html).attr('href') !== "undefined"){	
					 
				var url = jQuery(html).attr('href');	 				 
				var imageid = 0;	
			
				
			} else {
			
				var url 		= html;	 				 
				var imageid 	= 0;	
			}
			  
			// SAVE AND DISPLAY
			inputField.val(url); 
			
			// CLOSE WINDOW
			tb_remove();
            };

            return false;  
        }
	
	
        function add_image(obj) {
		 	
            var parent = jQuery(obj).parent().parent('div.fileuploadbox');		 	 
           
			var inputField = jQuery(parent).find(".meta_image_url");

            tb_show('Select File', 'media-upload.php?TB_iframe=true');

            window.send_to_editor = function(html) {
 			 
			if(typeof jQuery(html).attr('rel') !== "undefined"){
				 
				$thisimage = jQuery(html).find("img");		 	
				var url 		= $thisimage[0]['src'];	 				 
				var imageid 	= $thisimage[0]['className'].replace(/\D/g,'');	
		   
			} else if(typeof jQuery(html).attr('src') !== "undefined"){	
					 
				var url = jQuery(html).attr('src');	 				 
				var imageid = jQuery(html).attr('class').replace(/\D/g,'');	
			
			} else if(typeof jQuery(html).attr('href') !== "undefined"){	
					 
				var url = jQuery(html).attr('href');	 				 
				var imageid = 0;		
				
			} else {
			
				var url 		= html;	 				 
				var imageid 	= 0;	
			}
			  
			// SAVE AND DISPLAY
			inputField.val(url);	
			
			if(imageid == 0){
			jQuery(parent).find("div.image_wrap").html('<img src="https://via.placeholder.com/100x150.png?text=No%20Preview" style="max-width:150px; max-height:150px;" /><input type="hidden" name="gallery[image_aid][]" value="' + imageid +'">');
			} else {			
            jQuery(parent).find("div.image_wrap").html('<img src="'+url+'" style="max-width:150px; max-height:150px;" /><input type="hidden" name="gallery[image_aid][]" value="' + imageid +'">');
			}
			
			// CLOSE WINDOW
			tb_remove();
            };

            return false;  
        }

        function remove_field(obj) {
            var parent = jQuery(obj).parent().parent().parent();
            parent.remove();
        }
		
		function remove_thumbnail(obj) {
            var parent = jQuery(obj).parent().parent().parent();
            parent.remove();
        }		
		

        function add_field_row() {
            var row = jQuery('#master-row').html();            
			f = jQuery(row).appendTo('#mediaelements').find("a.addimg");			 	
			add_image(f);
        }
    </script>

<?php
}


 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
} // END CORE ADMIN CLASS

?>