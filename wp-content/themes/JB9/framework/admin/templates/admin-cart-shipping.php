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

global $region_list;

 $current_country_ship_array = get_option('wlt_country_ship_price_array'); $current_amount_ship_array = get_option('wlt_amount_ship_price_array'); $current_free_shipping_array = get_option('wlt_free_shipping_array');
  
?> 







<div class="row mb-4" style="padding: 20px;    background: #ecf6ff;    margin: -2px;border:0px;">

    <div class="col-10">
    
        <h4>Force Shipping</h4>        
        <p class="text-muted mt-2">By default shipping charges are enabled per item.  Enable this option to turn shipping on for all items.</p>
        
    </div>
    
    <div class="col-2">
    
	<div class="mt-3">
                                    <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('system_shipping').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('system_shipping').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('system_shipping') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                           
                             
                             <input type="hidden" id="system_shipping" name="admin_values[system_shipping]" 
                             value="<?php echo _ppt('system_shipping'); ?>"> 
                             
                              
    
</div>
</div>


 
 
 
 <div class="row">

<div class="col-lg-6">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">
         <h4><span>Flat Rate Shipping</span></h4>
 
      </div>
 
  
 
 
 

<div class="row">

<div class="col-md-3">

    <label class="txt500">Enable</label>
  <div class="mt-3">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('basic_shipping_flatrate').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('basic_shipping_flatrate').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('basic_shipping_flatrate') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                           
                             
                             <input type="hidden" id="basic_shipping_flatrate" name="admin_values[basic_shipping_flatrate]" 
                             value="<?php echo _ppt('basic_shipping_flatrate'); ?>"> 
  

</div>

<div class="col-md-4">

	<label class="txt500">Flat Rate <br /><small> (fixed price)</small></label>
    <div class="input-group">
      <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
        <input type="text" name="admin_values[basic_shipping][flatrate]"  value="<?php echo _ppt(array('basic_shipping','flatrate')); ?>" class="form-control" >    
    </div>   
 
</div>

 

<div class="col-md-4">

	<label class="txt500">Flat Rate <br /><small>(percentage)</small></label>
    <div class="input-group">
     <span class="add-on input-group-prepend"><span class="input-group-text">%</span></span>
   <input type="text" name="admin_values[basic_shipping][flatrate_percent]" value="<?php echo _ppt(array('basic_shipping','flatrate_percent')); ?>" class="form-control" >   
    </div>   
 
</div>

</div> 

 
 
 
 
 
 
 
 
 </div>
  </div>
    
    <div class="col-lg-6">



<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">
         <h4><span>Free Shipping</span></h4>
 
      </div>
 
 
 
 

 

 

<div class="row">

<div class="col-md-3">

    <label>Enable</label>
  <div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('basic_free_shipping').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('basic_free_shipping').value='1'">
                                  </label>
                                  <div class="toggle <?php if(_ppt('basic_free_shipping') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                           
                             
                             <input type="hidden" id="basic_free_shipping" name="admin_values[basic_free_shipping]" 
                             value="<?php echo _ppt('basic_free_shipping'); ?>"> 
  

</div>

<div class="col-md-4">

  <label>Select Region
             
                </label>
               
                
                  <select data-placeholder="Choose a region..." class="form-control" name="basic_free_ship" id="freeship" style="width:100%;">
                
                    <option value="" title='<?php echo $current_free_shipping_array['default']; ?>'>All Regions</option>
                    
                    <?php
					
					$regions = _ppt('regions');
					if(is_array($regions)){ 
						$i=0; 
						if(isset($regions['regions']['name'])){
						while($i < count($regions['regions']['name']) ){
							if($regions['regions']['name'][$i] !=""){		
								
								$pp1 = "title='".$current_free_shipping_array[$regions['regions']['name'][$i]]."|'";				
								echo "<option value='".$regions['regions']['name'][$i]."' ".$pp1." id='".$i."'>".$regions['regions']['name'][$i]."</option>";	
								
							} // end if
							$i++;
						} // end foreach
					}// end if		
					}		 
					?>                    
                  </select>

</div>
      <script>
			jQuery(document).ready(function(){
				jQuery( "#freeship" ).change(function() {				 
					var sdt = jQuery("option:selected", this).attr("title");						 	 
					if(sdt != ""){	
					var exploded = sdt.split('|');
					 jQuery('#free_ship_price').val(exploded[0]);
					 
					}
				});		
			});
			</script> 

<div class="col-md-4">
	<label class="span4">Orders Over</label>
    <div class="input-group">
      <span class="add-on input-group-prepend"><span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span></span>
        <input type="text" class="form-control" name="free_ship_price" id="free_ship_price" value="<?php if(isset($current_free_shipping_array['default']) && $current_free_shipping_array['default'] > 0){ echo $current_free_shipping_array['default']; } ?>">    
    </div>  

</div>



</div><!-- end row -->



 
 
 
 
 




 
 <?php get_template_part('framework/admin/templates/admin', 'shipping-country' ); ?>
 
 

 <?php get_template_part('framework/admin/templates/admin', 'shipping-weight' ); ?>
 
 
 <?php get_template_part('framework/admin/templates/admin', 'shipping-methods' ); ?>
 
 
 
 </div></div></div>

<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 