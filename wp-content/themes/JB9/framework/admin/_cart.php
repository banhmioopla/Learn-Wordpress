<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN, $region_list;


// LOAD IN OPTIONS FOR ADVANCED SEARCH
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );


// MAKE REGIONS LIST
$regions 		= _ppt('regions');
$region_list = "";  $c=0;
if(is_array( $regions )){ 
	while($c < count($regions['name']) ){
		if($regions['name'][$c] !="" ){							 
		$region_list .= "<option value='".$regions['key'][$c]."' id='".$c."'>".$regions['name'][$c]."</option>";									
		} // end if
	$c++;
	} // end foreach
}// end if
 

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

 $current_country_tax_array = get_option('wlt_country_tax_price_array');  $current_wlt_tax_exemp_array = get_option('wlt_tax_exemp_array');


 
if(isset($_POST['admin_values']['basic_tax'])){

	// SET CUSTOM ARRAY FOR COUTNRIES SINCE THERE ARE ALOT OF THEM
	if( ( isset($_POST['basic_tax_country_price']) && is_numeric($_POST['basic_tax_country_price']) ) || ( isset($_POST['basic_tax_country_percentage']) && is_numeric($_POST['basic_tax_country_percentage']) )  ){
		$new_country_tax_array = array();	
		if(!is_array($current_country_tax_array)){ $current_country_tax_array = array(); }
		if(isset($_POST['basic_country_tax']) && !empty($_POST['basic_country_tax'])){
			foreach($_POST['basic_country_tax'] as $country){
				$new_country_tax_array[$country]['price'] 		= $_POST['basic_tax_country_price'];
				$new_country_tax_array[$country]['percent'] 	= $_POST['basic_tax_country_percentage'];
				//$new_country_tax_array[$country]['excemption'] 	= $_POST['basic_tax_country_excemption'];
				
			}// end foreach	
			update_option("wlt_country_tax_price_array",array_merge($current_country_tax_array,$new_country_tax_array), true);
			$current_country_tax_array = get_option('wlt_country_tax_price_array');
			
		}// end if
	}// end if 
	
} // end if
 
$current_country_ship_array = get_option('wlt_country_ship_price_array'); $current_amount_ship_array = get_option('wlt_amount_ship_price_array'); $current_free_shipping_array = get_option('wlt_free_shipping_array');
 
if(isset($_POST['admin_values']['basic_shipping'])){

	// SET CUSTOM ARRAY FOR COUTNRIES SINCE THERE ARE ALOT OF THEM
	if(isset($_POST['basic_shipping_country_price']) && is_array($_POST['basic_shipping_country_price'])){
		
		if(!is_array($current_country_ship_array)){ $current_country_ship_array = array(); }
		
		
		if(isset($_POST['basic_country']) && !empty($_POST['basic_country'])){
			foreach($_POST['basic_country'] as $country){
				$current_country_ship_array[$_POST['basic_country_shipping_methods']][$country] = $_POST['basic_shipping_country_price'];
			}// end foreach	
			 
			update_option("wlt_country_ship_price_array",$current_country_ship_array, true);
			$current_country_ship_array = get_option('wlt_country_ship_price_array');
		}// end if
	}// end if 
	
} // end if



if(isset($_POST['free_ship_price']) && strlen($_POST['free_ship_price']) > 0){

	// SET CUSTOM ARRAY FOR COUTNRIES SINCE THERE ARE ALOT OF THEM	 
	if($_POST['basic_free_ship'] == ""){ $_POST['basic_free_ship'] = "default"; }
	
	
	
	$current_free_shipping_array[$_POST['basic_free_ship']] = $_POST['free_ship_price'];		
	 	 
	update_option("wlt_free_shipping_array",$current_free_shipping_array, true);
	$current_free_shipping_array = get_option('wlt_free_shipping_array'); 
 
	
} // end if


// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1); ?>

  <?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>
 
 
 		<?php get_template_part('framework/admin/templates/admin', 'cart-overview' ); ?>    
 
 <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>
 
<?php echo $CORE_ADMIN->FOOTER(1); ?>



<div style="display:none"><div id="wlt_weightbox">

    <li class="cfielditem"> 
    
 
    <div class="inside bg-white">    
       
 

        <div class="row">
        <div class="col-md-6">
           <label>Select Region</label>
        </div>
        <div class="col-md-6">
        <select name="admin_values[weightship][region][]" class="form-control">
          <?php echo $region_list; ?>
        </select>
        </div>
        </div>

        <div class="row">
        <div class="col-md-6">
            <label>Weight (greater than)</label>
        </div>
        <div class="col-md-6">
             <div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>
                <input type="text" name="admin_values[weightship][pricea][]" class="form-control"/> 
            </div>  
        </div>
        </div>        
        
         <div class="row">
        <div class="col-md-6">
            <label>Weight (less than)</label>
        </div>
        <div class="col-md-6">
             <div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>
                <input type="text" name="admin_values[weightship][priceb][]" class="form-control"/>
            </div>  
        </div>
        </div>

         <div class="row">
        <div class="col-md-6">
            <label> Price Per Item</label>
        </div>
        <div class="col-md-6">
             <div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
                 <input type="text" name="admin_values[weightship][pricec][]" class="form-control" />
            </div>  
        </div>
        </div>


     
    <hr />
    <button class="btn btn-primary" type="submit" >Save</button>
    
    </div>
    
    </li>  
      
</div> 

 
</div> 
<!-- DEFAULT BOX CODE --->




<div style="display:none"><div id="ppt_shipping_country_box">

    <li class="cfielditem">
    <div class="inside bg-white"> 
       
	 	
        <div class="row">
        <div class="col-md-6">
            <label>Display Caption</label>
        </div>
        <div class="col-md-6">
             <input type="text" name="admin_values[countryship][name][]" value="" class="form-control" />
        </div>
        </div>
        
        <div class="row">
        <div class="col-md-6">
            <label>Select Region</label>
        </div>
        <div class="col-md-6">
            <select name="admin_values[countryship][region][]" id="wship1" class="form-control">
             <?php echo $region_list; ?>
            </select>
        </div>
        </div>
        
        <?php $types = array("0"=>"Light", "1"=>"Medium", "2" => "Heavy", "3" => "Very Heavy" );
        foreach($types as $key=>$tt){
        ?>
         
        <div class="row">
        <div class="col-md-6">
            <label><?php echo $tt; ?> Items</label>
        </div>
        <div class="col-md-6">
            <div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
                <input type="text" name="admin_values[countryship][<?php echo $key; ?>][]"  value="" class="form-control">    
            </div>   
        </div>
        </div>
        
        <?php } ?> 
     
    <hr />
    <button class="btn btn-primary" type="submit" >Save</button>
    
    </div>
    
    </li>  
      
</div> 

 
</div> 
<!-- DEFAULT BOX CODE --->




<div style="display:none"><div id="ppt_custom_methods_box">

    <li class="cfielditem">     
 
    <div class="inside bg-white"> 
       
    	
        <div class="row">
        <div class="col-md-6">
            <label>Display Caption</label>
        </div>
        <div class="col-md-6">
             <input type="text" name="admin_values[custommethods][name][]" value="" class="form-control" placeholder="e.g. Cash on colletion" />
        </div>
        </div>
        
        <div class="row mt-4">
        <div class="col-md-6">
            <label>Select Region</label>
        </div>
        <div class="col-md-6">
            <select name="admin_values[custommethods][region][]" id="wship1" class="form-control">
             <?php echo $region_list; ?>
            </select>
        </div>
        </div>
        
        
        <div class="row mt-4">
        <div class="col-md-6">
            <label>Price</label>
        </div>
        <div class="col-md-6">
               	<div class="input-group">
              <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
                 <input type="text" name="admin_values[custommethods][price][]" class="form-control" />
                 <input type="hidden" name="admin_values[custommethods][key][]" value="cm-<?php echo rand(1000,99999); ?>" />
            </div> 
        </div>
        </div> 
    
    <hr />
    <button class="btn btn-primary" type="submit">Save</button>
    
    </div>
    
    </li>  
      
</div> 

 
</div> 
<!-- DEFAULT BOX CODE --->

<?php if(strlen($region_list) < 5){ ?>
<script>
jQuery(document).ready(function(){
	
	jQuery('#basic_shipping .btn-primary').hide();	
	jQuery('#wlt_weightbased_shpping, #ppt_shipping_methods, #ppt_shipping_country').html('Please setup a region first.').addClass('text-center h6');
});

</script>
<?php } ?>

<?php if(isset($GLOBALS['savemeform'])){ ?>
<script>
jQuery(document).ready(function(){
	
	jQuery( "#admin_save_form" ).submit();
});

</script>
<?php } ?>