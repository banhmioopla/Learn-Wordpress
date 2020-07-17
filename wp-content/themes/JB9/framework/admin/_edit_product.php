<?php
/* =============================================================================
   USER ACTIONS
   ========================================================================== */
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


global $post, $CORE;

?>


<script>
jQuery(document).ready(function(){ 
    
  var allPanels = jQuery('.accordion > dd').hide();
    
  jQuery('.accordion > dt > a').click(function() {
    allPanels.slideUp();
	jQuery(this).parent().next().toggle();
   // jQuery(this).parent().next().slideDown();
    return false;
  }); 
	
});

</script>


<section id="tab-price" >
 

<?php do_action('hook_v9_admin_edit_options'); ?>
 


<div class="box-admin">
	<label>Price</label>
    <em>Value in <?php echo hook_currency_code(''); ?></em>
    <div class="input-group">    
	<input class="form-control" placeholder="<?php echo hook_currency_symbol(''); ?>" name="custom[price]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "price", true); } ?>" />
    
    </div>
</div>


<div class="box-admin">
	<label>Old Price</label>
    <div class="input-group">   
	<input class="form-control" placeholder="<?php echo hook_currency_symbol(''); ?>" name="custom[old_price]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "old_price", true); } ?>" />
    </div>
</div>
<!--
<div class="box-admin">
	<label>Members Price</label>
    <div class="input-group">
    <span class="add-on input-group-prepend"><?php echo hook_currency_symbol(''); ?></span>  
	<input class="form-control hasaddon" name="custom[members_price]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "members_price", true); } ?>" />
    </div>
</div>
 --> 
 
 <div class="box-admin">
	<label>Type</label>
    <div class="input-group">
    
<select name="custom[type]" class="form-control" style="width:100%;">
<option value="">Normal Product</option>
<option value="2" <?php if(isset($_GET['post']) && get_post_meta($_GET['post'],'type', true) == 2){ echo "selected=selected"; } ?>>Affiliate Product</option>
 
</select>
    
    </div>
</div>


<div class="box-admin">
	<label>Affiliate Link</label>
    <div class="input-group"> 
	<input class="form-control" name="custom[buy_link]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "buy_link", true); } ?>" />
    </div>
</div>
 

</section> 

<section id="tab-w" style="display:none;">
  


<div class="box-admin">
	<label>Weight</label>
    <div class="input-group"> 
	<input class="form-control" name="custom[weight]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "weight", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Weight Type</label>
    <div class="input-group">
	<select name="custom[weight_class]" id="field_price-on" class="form-control" style="width:100%;">
	<option value="0" <?php if($CORE->get_edit_data('weight_class', $post->ID) == 0){ ?>selected="selected"<?php } ?>>Kilogram</option>
	<option value="1" <?php if($CORE->get_edit_data('weight_class', $post->ID) == 1){ ?>selected="selected"<?php } ?>>Gram</option> 
    <option value="2" <?php if($CORE->get_edit_data('weight_class', $post->ID) == 2){ ?>selected="selected"<?php } ?>>Pound</option>   
    <option value="3" <?php if($CORE->get_edit_data('weight_class', $post->ID) == 2){ ?>selected="selected"<?php } ?>>Ounce</option>              
    </select>
    </div>
</div> 
<div class="box-admin">
	<label>Weight Category</label>
    <div class="input-group">
	<select name="custom[weight_type]" id="field_price-on" class="form-control" style="width:100%;">
	<option value="0" <?php if($CORE->get_edit_data('weight_type', $post->ID) == 0){ ?>selected="selected"<?php } ?>>Light</option>
	<option value="1" <?php if($CORE->get_edit_data('weight_type', $post->ID) == 1){ ?>selected="selected"<?php } ?>>Medium</option> 
    <option value="2" <?php if($CORE->get_edit_data('weight_type', $post->ID) == 2){ ?>selected="selected"<?php } ?>>Heavy</option> 
    <option value="3" <?php if($CORE->get_edit_data('weight_type', $post->ID) == 3){ ?>selected="selected"<?php } ?>>Very Heavy</option>             
    </select>    
    </div>
</div>
 
<div class="box-admin">
	<label>Dimensions (Length)</label>
    <div class="input-group">
	<input class="form-control" name="custom[size_l]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "size_l", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Dimensions (Width)</label>
    <div class="input-group"> 
	<input class="form-control" name="custom[size_w]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "size_w", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Dimensions (Height)</label>
    <div class="input-group">
	<input class="form-control" name="custom[size_h]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "size_h", true); } ?>" />
    </div>
</div> 

<div class="box-admin">
	<label>Length Type</label>
    <div class="input-group">
	<select name="custom[length_class]" id="field_price-on" class="form-control" style="width:100%;">
	<option value="0" <?php if($CORE->get_edit_data('length_class', $post->ID) == 0){ ?>selected="selected"<?php } ?>>Centimeter</option>
	<option value="1" <?php if($CORE->get_edit_data('length_class', $post->ID) == 1){ ?>selected="selected"<?php } ?>>Millimeter</option> 
    <option value="2" <?php if($CORE->get_edit_data('length_class', $post->ID) == 2){ ?>selected="selected"<?php } ?>>Inch</option>           
    </select>
    </div>
</div> 


</section> 

<section id="tab-stock" style="display:none;">
 


 
<div class="box-admin">
	<label>Quantity</label>
  
      <div class="input-group"> 
      
        <input type="input" name="custom[qty]" class="form-control" value="<?php echo $CORE->get_edit_data('qty', $post->ID); ?>">
        </div>
  
</div>
    
<div class="box-admin">
	<label>Subtrack Stock</label>
    <div class="input-group">
	<select name="custom[stock_remove]" id="field_stock_remove" class="form-control" style="width:100%;">
	<option value="0" <?php if($CORE->get_edit_data('stock_remove', $post->ID) == 0){ ?>selected="selected"<?php } ?>>no</option>
	<option value="1" <?php if($CORE->get_edit_data('stock_remove', $post->ID) == 1){ ?>selected="selected"<?php } ?>>yes</option>         
    </select>
    </div>
</div>
<div class="box-admin">
	<label>Out of stock message</label>
    <div class="input-group">
	<input type="input" name="custom[stock_outofmsg]" class="form-control" value="<?php echo $CORE->get_edit_data('stock_outofmsg', $post->ID); ?>" placeholder="Out of stock">
    </div>
</div>



</section> 

<section id="tab-color" style="display:none;">
 


<?php

$colordata = get_post_meta($post->ID, 'colordata', true);
if(!is_array($colordata)){ $colordata = array(); }
?>


 
<div class="box-admin">
	<label>Enable</label>
    <div class="input-group">
	<select name="custom[colordata][on]" id="field_color" class="form-control" style="width:100%;">
	<option value="0" <?php if(isset($colordata['on']) && $colordata['on'] == 0){ ?>selected="selected"<?php } ?>>no</option>
	<option value="1" <?php if(isset($colordata['on']) && $colordata['on'] == 1){ ?>selected="selected"<?php } ?>>yes</option>         
    </select>
    </div>
</div>
 


<?php $i = 1; while($i < 12) { ?>
<div style="margin-bottom:10px; margin-top:10px; <?php if($i%2){ ?>background:#efefef;<?php } ?>">
<div class="box-admin">
	<label>Color Code</label>
    <div class="input-group">
<input type="input" name="custom[colordata][data][<?php echo $i; ?>-name]" class="form-control" value="<?php if(isset($colordata['data'][$i."-name"])){ echo $colordata['data'][$i."-name"]; }; ?>" placeholder="e.g red or #ff0000">
    </div>
</div>

<div class="box-admin">
	<label>Price</label>
    <div class="input-group">
<input type="text" placeholder="<?php echo hook_currency_symbol(''); ?>" name="custom[colordata][data][<?php echo $i; ?>-price]" 
class="form-control" style="margin-top:5px;" value="<?php if(isset($colordata['data'][$i."-price"])){ echo $colordata['data'][$i."-price"]; }else{ echo 0; }; ?>">

    </div>
</div>
</div>
 
<?php /*
<div class="input-group">
	<span class="add-on input-group-prepend">#</span>     
	<input type="input" name="custom[colordata][data][<?php echo $i; ?>-stock]" class="form-control hasaddon required" tabindex="3" value="<?php if(isset($colordata['data'][$i."-stock"])){ echo $colordata['data'][$i."-stock"]; }; ?>" placeholder="# in stock">
</div>
*/ ?>


<?php $i++; } ?>
 

</section> 
<section id="tab-size" style="display:none;">
 
  
<div class="box-admin">
	<label>Enable</label>
    <div class="input-group">
	<select name="custom[price-on]" id="field_price-on" class="form-control" style="width:100%;">
	<option value="0" <?php if($CORE->get_edit_data('price-on', $post->ID) == 0){ ?>selected="selected"<?php } ?>>no</option>
	<option value="1" <?php if($CORE->get_edit_data('price-on', $post->ID) == 1){ ?>selected="selected"<?php } ?>>yes</option>         
    </select>
    </div>
</div>
 


<?php 


$i = 1; 

 
 $df = array("","Extra Small","Small","Medium","Large","Extra Large");
 while($i < 6) { ?>

<div style="margin-bottom:10px; margin-top:10px; <?php if($i%2){ ?>background:#efefef;<?php } ?>">
 
 
<div class="box-admin">
	<label>Display</label>
    <div class="input-group">
<input type="input" name="custom[price-<?php echo $i; ?>-name]" class="form-control" value="<?php echo $CORE->get_edit_data('price-'.$i.'-name', $post->ID); ?>" placeholder="e.g <?php echo $df[$i]; ?>">
    </div>
</div> 
 
<div class="box-admin">
	<label>Price</label>
    <div class="input-group">
<input type="text" name="custom[price-<?php echo $i; ?>-price]" class="form-control" value="<?php echo $CORE->get_edit_data('price-'.$i.'-price', $post->ID); ?>">
    </div>
</div>
 
<div class="box-admin">
	<label># In Stock</label>
    <div class="input-group">
<input type="input" name="custom[price-<?php echo $i; ?>-stock]" class="form-control required" value="<?php echo $CORE->get_edit_data('price-'.$i.'-stock', $post->ID); ?>" placeholder="# in stock">
    </div>
</div>

 
</div>
 
<?php $i++; } ?>

</section> 
<section id="tab-ids" style="display:none;">
 
 
<div class="box-admin">
	<label>SKU</label>
    <div class="input-group">
	<input class="form-control" name="custom[sku]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "sku", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>UPC</label>
    <div class="input-group">   
	<input class="form-control" name="custom[upc]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "upc", true); } ?>" />
    </div>
</div>

<div class="box-admin">
	<label>Model ID</label>
    <div class="input-group">
	<input class="form-control" name="custom[modelid]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "modelid", true); } ?>" />
    </div>
</div>

 
</section> 
</section> 
<section id="tab-tax" style="display:none;">


 
<div class="box-admin">
	<label>Enable Shipping</label>
    <div class="input-group">
	<select name="custom[ship_required]" class="form-control" style="width:100%;">
	<option value="0" <?php if($CORE->get_edit_data('ship_required', $post->ID) == 0){ ?>selected="selected"<?php } ?>>no</option>
	<option value="1" <?php if($CORE->get_edit_data('ship_required', $post->ID) == 1){ ?>selected="selected"<?php } ?>>yes</option>         
    </select>
    </div>
</div>

<div class="box-admin">
	<label>Estimated Delivery Days</label>
    <div class="input-group"> 
	<input class="form-control" name="custom[shipping_days]" value="<?php if( isset($_GET['post']) ){  echo get_post_meta($post->ID, "shipping_days", true); } ?>" />
    </div>
</div>


<div class="box-admin">
	<label>Tax Shipping</label>
    <div class="input-group">
	<select name="custom[tax_required]" class="form-control" style="width:100%;">
	<option value="0" <?php if($CORE->get_edit_data('tax_required', $post->ID) == 0){ ?>selected="selected"<?php } ?>>no</option>
	<option value="1" <?php if($CORE->get_edit_data('tax_required', $post->ID) == 1){ ?>selected="selected"<?php } ?>>yes</option>         
    </select>
    </div>
</div>


</section> 
<section id="tab-paypal" style="display:none;">


 
 
<div class="box-admin">
	<label>Enable</label>
    <div class="input-group">
	<select name="custom[paypal-buynow]"  class="form-control" style="width:100%;">
	<option value="0" <?php if($CORE->get_edit_data('paypal-buynow', $post->ID) == 0){ ?>selected="selected"<?php } ?>>no</option>
	<option value="1" <?php if($CORE->get_edit_data('paypal-buynow', $post->ID) == 1){ ?>selected="selected"<?php } ?>>yes</option>         
    </select>
    </div>
</div>

</section> 






<section id="tab-att" style="display:none;">


<?php



$attributes = array();

$attributes = get_post_meta($post->ID,"attributes",true); 
if(isset($_GET['eid'])){}
 
?>

 <a href="javascript:void(0);" onClick="jQuery('#price-attribute-new').clone().prependTo('#customfieldlist');" class="button">Add Field</a>

 
<ul id="customfieldlist">
<?php if(is_array($attributes) && isset($attributes['name']) && is_array($attributes['name']) ){ $i=0; $setKeys = array(); $selectedcatlist = array();
 
foreach($attributes['name'] as $data){ 

	if($attributes['name'][$i] != "" ){  ?>
    
    
<li class="cfielditem closed " id="rowid-<?php echo $i; ?>">
	
    <div class="heading">
      
    
            <a href="javascript:void(0);" onclick="jQuery('.cf-<?php echo $i; ?>').fadeToggle();" style="    display: inline;    color: black;    font-weight: bold;    text-decoration: none;  ">
            <strong><?php echo $attributes['name'][$i]; ?></strong>  
            </a>                                  
      
        
        <a href="javascript:void(0);" onClick="jQuery('#rowid-<?php echo $i; ?>').html('').hide();" style="    display: inline;    color: black;    font-weight: bold;    text-decoration: none;    float: right;">
        <i class="fas fa-times" aria-hidden="true"></i> delete
        </a> 
       
    
    </div>
    
    <div class="inside1 cf-<?php echo $i; ?>" style="display:none; background:#f2f2f2; margin:0px -10px; padding: 10px;">  
         
      <div class="box-admin">
        <label>Field Caption</label>
        <input type="text" name="attributes[name][]" value="<?php echo $attributes['name'][$i]; ?>" class="form-control" placeholder="e.g Product Color" />    
        </div>
        
    <div class="box-admin">
        <label>Unique ID </label>
         <input type="text" name="attributes[id][]" value="<?php echo $attributes['id'][$i]; ?>"  class="form-control" />    
     </div>
        
        
         <?php $h =1; while($h < 5){ ?>
        
            <div class="box-admin">            
            <label class="mt-1">Option <?php echo $h; ?> </label>
           	<div class="input-group"> 
             <input type="text" name="attributes[option-<?php echo $h; ?>][]" value="<?php echo $attributes['option-'.$h][$i]; ?>"  class="form-control" />  
           </div>
            </div>
              
              <div class="box-admin">
              <label>Price</label>
              	<div class="input-group">
              <input type="text" name="attributes[price-<?php echo $h; ?>][]" class="form-control" value="<?php echo $attributes['price-'.$h][$i]; ?>">
              </div>
              </div>
            
        <?php $h++; } ?>
	</div>
    
</li>
 <?php $i++; } ?>    
    
<?php } ?>    

<?php } ?>  
</ul>
</section> 



 

<div style="display:none"><div id="price-attribute-new">

    <li class="cfielditem"> 
   
    <div class="inside1">    
    
     <input type="hidden" name="attributes[id][]" value="attrid-<?php echo rand(1,40000); ?>"/>       
       	
        <div class="row">
        <div class="col-md-6">
        
        <div class="box-admin">
        <label>Field Caption</label>
        <input type="text" name="attributes[name][]" value=""  class="form-control form-attribute-title" placeholder="e.g Product Color" />          
        </div>
      
      
        
        
         <?php $h =1; while($h < 5){ ?>
         
        <div class="row">        
            <div class="col-md-6">
             <div class="box-admin">
            <label class="mt-1">Option Caption</label>
            <input type="text" name="attributes[option-<?php echo $h; ?>][]" value="" id="nfaqt" class="form-control" />  
            </div>
            </div>   
                  
            <div class="col-md-6">    
            <div class="box-admin">        
            <label class="mt-1">Option Value</label> 
           	<div class="input-group"> 
               
                    <input type="text" name="attributes[price-<?php echo $h; ?>][]" class="form-control" placeholder="10.99">
            </div>           
        
        	</div>
        </div>
        <?php $h++; } ?>
        
    <hr />
    <button class="btn btn-primary" type="submit" onclick="checknotblank()">Save</button>
    
    </div>
    
    </li>  
      
</div></div>
