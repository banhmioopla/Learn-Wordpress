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


if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; } $core_admin_values = get_option("core_admin_values");
 function MakeField($type, $name, $value, $list="", $default=""){
if($value ==""){ $value = $default; }
	switch($type){	
		case "checkbox": { return  "<input type='checkbox' class='checkbox' name='".$name."' value='".$value."'> "; } break;	
		case "text": { return  "<input type='text' name='adminArray[".$name."]' value='".$value."' class='form-control'>"; } break;
		case "textarea": { return "<textarea name='adminArray[".$name."]' type='text' class='form-control'>".stripslashes($value)."</textarea>"; } break;
		case "listbox": { 
			$r ="<select name='adminArray[".$name."]' class='form-control'>";
			foreach($list as $key => $val){
				if($value==$key){ $sel="selected"; }else{ $sel=""; }
				$r .="<option value='".$key."' ".$sel.">".$val."</option>";
			}
			$r .="</select>";
			return $r;
		} break;
	}
}


?>

<div class="row">

<div class="col-lg-7">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">




<div class="tabheader mb-4">
 <a href="https://www.youtube.com/watch?v=AswScj5-ob4" class="btn btn-sm mb-4 btn-outline-dark float-right" target="_blank"><i class="fa fa-video-camera"></i> Video Tutorial</a>

         <h4><span>Payment Gateways</span></h4>
      </div>

 
 



<div id="accordion" style="border: 10px solid #f7f7f7;">                 
<?php 
 
$gatways = hook_payments_gateways($GLOBALS['core_gateways']);

$i=1;$p=1; if(is_array($gatways)){foreach($gatways as $Value){ ?>

   
    <div class="border shadow-sm" id="heading<?php echo $i; ?>" style="cursor:pointer;">
           <a class="p-3 py-4 btn-block"  data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
     
      
      <div class="float-right" style="margin-top:-10px;">
      
      <div class="border">
      
<?php if(strpos($Value['logo'], "http") === false){ ?>
<img src="https://www.premiumpress.com/_demoimages/gateways/<?php echo $Value['logo'] ?>"  style="max-width:100px; max-height:80px;">
<?php }else{ ?>
<img src="<?php echo $Value['logo'] ?>"  class="merchantlogo " style="max-width:100px; max-height:80px;">
<?php } ?>
    </div>
      
      </div>
      
 
           <h6 class="mb-0"><?php echo $Value['name'] ?> <?php if(get_option($Value['function']) == 'yes'){ ?><span class="badge badge-success txt300">Enabled</span> <?php } ?></h6>  
      
      </a>
    </div>
    <div id="collapse<?php echo $i; ?>" class=" collapse border" aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordion">
     

<div class="container">
   <div class="row border-bottom bg-success text-white" style="border-top:0px;">
      <div class="col-8 pt-4">
         <label class="txt500 text-white"> Enable Gateway: </label>
         <p class="py-2 text-white">Turn on/off the display of this gateway.</p>
      </div>
      <div class="col-4 pt-4">
         <label class="radio off">
         <input type="radio" name="toggle" 
            value="no" onchange="document.getElementById('<?php echo $Value['function']; ?>_on').value='no'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="yes" onchange="document.getElementById('<?php echo $Value['function']; ?>_on').value='yes'">
         </label>
         <div class="toggle <?php if(get_option($Value['function']) == 'yes'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="<?php echo $Value['function']; ?>_on" name="adminArray[<?php echo $Value['function']; ?>]" value="<?php echo get_option($Value['function']); ?>">
   </div>
</div>

<div class="p-4">

 
<div class="row mt-2">
   <?php foreach($Value['fields'] as $key => $field){ 
      if(!isset($field['list'])){ $field['list'] = ""; }
      if(!isset($field['default'])){ $field['default'] =""; }
      
      if($Value['function'] == $field['fieldname']){ continue; }
      
      ?>
   <div class="col-md-6 form-group py-2">
      <label class="txt500"><?php echo $field['name'] ?></label>   
      <?php echo MakeField($field['type'], $field['fieldname'],get_option($field['fieldname']),$field['list'], $field['default']) ?>
   </div>
   <?php } ?>
   <?php /*
   <hr />
   <div class="col-md-12">
      <div class="form-group">
         <label class="txt500">Display Text</label>
         <textarea name="adminArray[<?php echo $Value['function']; ?>_desc]" class="form-control" style="min-height:200px;"><?php  echo stripslashes(get_option($Value['function'].'_desc'));  ?></textarea>
      </div>
   </div>
 */ ?>
</div>
<?php if(isset($Value['notes']) && strlen($Value['notes']) > 1){ ?>

<div class="padding1 text-center mb-3">
   <?php echo $Value['notes']; ?>
</div>
<?php } ?> 
     
     
      </div>
 </div>    
 <?php $i++; } }  ?>  
 
</div>


 <div class="card1 mt-4 my-1 bg-light text-dark rounded-0 p-4 mb-4" style="height:110px;">
 
 <i class="fal fa-plug text-dark float-left mr-3" style="font-size:50px;" aria-hidden="true"></i>
 
    <a href="javascript:void(0);" onclick="showthispage('gateways');showthispage('plugins');" class="btn btn-outline-dark btn-sm float-right rounded-0">View All</a>
      <h4 class="text-dark">Payment Gateways</h4>
      <p class="text-dark" style="font-size:16px;">More payment plugins found here.</p>  
   </div>
 



<div class="tabheader mt-5 mb-4">

 <a data-toggle="modal" href="#CouponModal" class="btn btn-primary btn-sm float-right">Add New</a>


<h4><span>Coupon Codes</span></h4></div>









 
 <!-- ------------------------- -->
 
<div class="row">

    <div class="col-9">
    
        <label class="txt500">Enable coupon codes</label>
        
        <p class="text-muted">Turn on/off this feature.</p>
        
    </div>
    
    <div class="col-3">
    
 <div class="mt-4">
 
                            
                                          <label class="radio off" style="display: none;">
                                          <input type="radio" name="toggle" value="off" onchange="document.getElementById('couponcodes').value='0'">
                                          </label>
                                          <label class="radio on" style="display: none;">
                                          <input type="radio" name="toggle" value="on" onchange="document.getElementById('couponcodes').value='1'">
                                          </label>
                                          <div class="toggle <?php if($core_admin_values['couponcodes'] == '1'){  ?>on<?php } ?>" style="display: block;">
                                            <div class="yes">ON</div>
                                            <div class="switch"></div>
                                            <div class="no">OFF</div>
                                          </div>
                          </div>
                                    
    <input type="hidden" id="couponcodes" name="admin_values[couponcodes]" value="<?php echo _ppt('couponcodes'); ?>">                
    
</div>
</div>
 
 
 
 


 

 
 
 <?php 
		
		$wlt_coupons = get_option("wlt_coupons");
		 
		 // update_option("wlt_emails","");
		if(is_array($wlt_coupons) && count($wlt_coupons) > 0 ){  ?>
        
        
<table id="datatable_example" class="responsive table table-striped table-bordered mt-3">
            <thead>
            <tr>
              <th class="no_sort">Code</th>
                <th class="no_sort">Discount</th>
                <th class="no_sort">Uses</th>            
              <th class="no_sort" style="width:120px;text-align:center;">Actions</th>
              
            </thead>
            <tbody>
            
        <?php
 	  
		foreach($wlt_coupons as $key=>$field){ ?>
		<tr>
         <td><?php echo stripslashes($field['code']); ?></td>         
        <td style="width:50px; text-align:center"><?php 
		$discount = $field['discount_percentage'];
		if($discount != ""){
		
			echo $discount."%"; 
		
		}else{
			echo hook_price($field['discount_fixed']); 
		}
		
		 ?></td>         
        <td style="width:50px; text-align:center"><?php
		$ff = 0;
		if(isset($field['used'])){		$ff = $field['used']; }
		
		 
		echo $ff;
		 ?></td>         
        
         <td class="ms">
         <center>
                <div class="btn-group1">
                  <a class="btn btn-sm btn-primary" rel="tooltip" 
                  href="admin.php?page=2&tab=tab-coupons&edit_coupon=<?php echo $key; ?>"
                  data-placement="left" data-original-title=" edit "><i class="fa fa-pencil"></i></a>    
                                 
                  <a class="btn btn-danger btn-sm confirm" rel="tooltip" data-placement="bottom" 
                  data-original-title="Remove"
                  href="admin.php?page=2&tab=tab-coupons&delete_coupon=<?php echo $key; ?>"
                  ><i class="fa fa-trash"></i></a> 
                </div>
            </center>
            </td>
            </tr>
            <?php  }   ?> 
 
            </tbody>
            </table>
            
         <?php } ?> 


    
           
 







</div>













</div>

<div class="col-lg-5">

 


 
 
 
 
  



        <div class="bg-white shadow" style="border-radius: 7px;">
        	
            <div class="p-5 ">
            
            

            
            
            
            
 
                        
<div class="tabheader mb-4">
 
         <h4><span>Default Currency Setup</span></h4>
      </div>  
             
            
            
    <div class="row">

    <div class="col-6">
    
        <label class="txt500">Switch Button</label>
        
      
        
    </div>
    
    <div class="col-6">
    
    
 
                               
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('currency_dropdown').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('currency_dropdown').value='1'">
                                      </label>
                                      <div class="toggle <?php if(_ppt('currency_dropdown') == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
  
  
   <input type="hidden" id="currency_dropdown" name="admin_values[currency_dropdown]" value="<?php echo _ppt('currency_dropdown'); ?>">
    </div> 
    
</div>       

<p class="text-muted mt-2">Turn on/off the display of the currency switching drop down menu in the header.</p> 
             
        	 

<div class="row">
         <div class="col-md-6">
            <label class="small text-uppercase txt500">Symbol ($)</label>
            <div class="controls">
               <input type="text" name="admin_values[currency][symbol]" class="form-control" value="<?php echo _ppt(array('currency','symbol')); ?>">
            </div>
         </div>
         <div class="col-md-6">
            <label class="small text-uppercase txt500">Code (USD)</label>
            <div class="controls">
               <input type="text" name="admin_values[currency][code]" class="form-control" value="<?php echo _ppt(array('currency','code')); ?>">
            </div>
         </div>
         <div class="col-md-6 mt-3">
            <label class="small text-uppercase txt500">Positon</label><br />
            <select name="admin_values[currency][position]" class="form-control-sm btn-block">
               <option value="left" <?php if(_ppt(array('currency','position')) == "left"){ echo "selected=selected"; } ?>>Left (e.g $100) </option>
               <option value="right" <?php if(_ppt(array('currency','position')) == "right"){ echo "selected=selected"; } ?>>Right (e.g 100$)</option>
            </select>
         </div>
         <div class="col-md-6 mt-3">
            <label class="small text-uppercase txt500">Decimal Places</label><br />
            <select name="admin_values[currency][dec]" class="form-control-sm btn-block">
            
             <option value="0" <?php selected( _ppt(array('currency','dec')), 0 ); ?>>0 </option>
              <option value="1" <?php selected( _ppt(array('currency','dec')), 1 ); ?>>1 </option>
             
             
               <option value="" <?php selected( _ppt(array('currency','dec')), "" ); ?>>2 (default) </option>
               <option value="3" <?php selected( _ppt(array('currency','dec')), 3 ); ?>>3 </option>
               <option value="4" <?php selected( _ppt(array('currency','dec')), 4 ); ?>>4 </option>
               <option value="5" <?php selected( _ppt(array('currency','dec')), 5 ); ?>>5 </option>
            </select>
         </div>
          
      </div>





            
    <div class="row mt-5">

    <div class="col-6">
    
        <label class="txt500">jQuery Formatting</label>
      
        
    </div>
    
    <div class="col-6">
    
    
 
                               
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('currency_jquery').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('currency_jquery').value='1'">
                                      </label>
                                      <div class="toggle <?php if(_ppt('currency_jquery') == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
  
  
   <input type="hidden" id="currency_jquery" name="admin_values[currency_jquery]" value="<?php echo _ppt('currency_jquery'); ?>">
    </div> 
    
</div>  

  
        <p class="text-muted mt-2">Select this to display the prices formatted using jQuery.</p>
      
        
        </div>
  
 
 
 
 
</div>
 
 
 
<div class="bg-white shadow mt-4" style="border-radius: 7px;">       	
<div class="p-5 ">
            
            
<div class="tabheader mb-4">
 
         <h4><span>Currency Exchange Rates</span></h4>
      </div>  
             

 


 
    
     
    <?php 
	
	if(!isset($core_admin_values['cc']['symbol1'])){	
	
	$core_admin_values['cc']['symbol1'] = "&pound;";
	$core_admin_values['cc']['code1'] = "GBP";
	$core_admin_values['cc']['rate1'] = "1.6799";
	
	$core_admin_values['cc']['symbol2'] = "&euro;";
	$core_admin_values['cc']['code2'] = "EUR";
	$core_admin_values['cc']['rate2'] = "1.3849";
	
	$core_admin_values['cc']['symbol3'] = "C$";
	$core_admin_values['cc']['code3'] = "CAD";
	$core_admin_values['cc']['rate3'] = "0.9175";
	
	$core_admin_values['cc']['symbol4'] = "$";
	$core_admin_values['cc']['code4'] = "AUD";
	$core_admin_values['cc']['rate4'] = "0.9371";
	
	$core_admin_values['cc']['symbol5'] = "&yen;";
	$core_admin_values['cc']['code5'] = "JPY";
	$core_admin_values['cc']['rate5'] = "0.0098";
			
	}
	
	
	$i=1; while($i < 6){ ?>
    
	<div class="row mb-2">
    
    <div class="col-md-4">
     
        <label class="small text-uppercase txt500" for="normal-field" rel="tooltip" data-original-title="Example $" data-placement="top">Symbol</label>
        <div >
            <input type="text" name="admin_values[cc][symbol<?php echo $i; ?>]" class="form-control-sm btn-block" value="<?php echo $core_admin_values['cc']['symbol'.$i]; ?>">
        </div>
        
    </div>
    
    <div class="col-md-4">
        
        <label class="small text-uppercase txt500" for="normal-field">Code</label>
        <div >
            <input type="text" name="admin_values[cc][code<?php echo $i; ?>]" class="form-control-sm btn-block" value="<?php echo $core_admin_values['cc']['code'.$i]; ?>">
        </div>
     
    </div> 
    
    <div class="col-md-4">
    
        <label class="small text-uppercase txt500" for="normal-field">Rate</label>
        <div >
            <input type="text" name="admin_values[cc][rate<?php echo $i; ?>]" class="form-control-sm btn-block" value="<?php echo $core_admin_values['cc']['rate'.$i]; ?>">
        </div>
      
    </div>     
      
    </div>
    <?php $i++; } ?>
 
</div><!-- end card block -->
</div><!-- end card -->

 
<div class="well info mt-3">

<p>Please remember the base currency rate is always set to 1 therefore you should ensure your rates below reflect the price against your base currency.</p>

<p>For example, if your base currency is GBP. Then the USD rate would be compared against the GBP. Check the latest rates here: <a href="http://finance.yahoo.com/currency-converter/#from=GBP;to=USD;amt=1" target="_blank" style="text-decoration:underline;">here</a></p>
   
</div>
     









 

</div>


</div>




<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 