<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

// LOAD IN OPTIONS FOR SORTING DATA
wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'jquery-ui-draggable' );
wp_enqueue_script( 'jquery-ui-droppable' );

// INCLUDE POP-UP MEDIA BOX
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_style('thickbox'); 


if( current_user_can('administrator') ){



if(isset($_POST['TransferFormMemberships']) ){
 
 if(strlen($_POST['to']) > 1){
 
 	$ores = $wpdb->get_results("SELECT user_id FROM ".$wpdb->usermeta." WHERE  meta_key = 'wlt_subscription' AND meta_value LIKE '%".$_POST['from']."%'");
	if(!empty($ores)){		
		foreach($ores as $h){		
		$f = get_user_meta($h->user_id, 'wlt_subscription',true);	
		$f['key'] = $_POST['to'];		 
		update_user_meta($h->user_id, 'wlt_subscription',$f);			
		}	
	}
	 
	 $GLOBALS['error_message'] = "Memberships Transfered Successfully";
	 
 }else{
 
 	$GLOBALS['error_message'] = "Memberships Not Updated";
 
 }
 
}

}

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1); ?>

 
<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>
         <?php get_template_part('framework/admin/templates/admin', '18-memberships' ); ?>
     <div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 
         <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>
 



 

<form id="TransferFormMembership" name="TransferFormMembership" method="post" action="">
<input type="hidden" name="TransferFormMemberships" id="go" />
<input type="hidden" name="from" id="fromM" value="" />
<input type="hidden" name="to" id="toM" value="" />
</form> 

 




<div style="display:none"><div id="regfield-list-new">

    <li class="cfielditem"> 
    
    <div class="heading">
    <div class="name">New Field</div>
    </div>
    <div class="inside">    
       
        <label>Title</label>
        <input type="text" name="regfields[name][]" value="" id="nfaqt" class="form-control" />  
        <input type="hidden" name="regfields[values][]" value="" />  
        <input type="hidden" name="regfields[required][]" value="" />  
        <input type="hidden" name="regfields[tax_name][]" value="" />  
        <input type="hidden" name="regfields[posttype_name][]" value="" />  
        <div class="row mt-1">
        
        	<div class="col-md-6">
            
            <label>Field Type</label>
            
              <select name="regfields[type][]" class="form-control">
                  
                    <option value="input">Input Field</option>
                    <option value="textarea">Text Area</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="radio">Radio Button</option> 
                    <option value="select">Selection Box</option>                                          
                      <option value="tax">Taxonomy</option>  
              </select>
     
            
            </div>
        
        	<div class="col-md-6">
            
             <label>Unique Key</label>
             
              <input type="text" name="regfields[key][]" value="field<?php echo rand(0,1000); ?>" class="form-control"  />        
             
            </div>   
                 
        </div> 
 
    
    <hr />
    <button class="btn btn-primary" type="submit" onclick="checknotblank()">Save</button>
    
    </div>
    
    </li>  
      
</div></div>













<div style="display:none"><div id="membership-list_new">

    <li class="cfielditem"> 
    
    <div class="heading">
    <div class="name">New Membership</div>
    </div>
    <div class="inside">    
       
        <label>Title <span class="required">*</span></label>
        <input type="text" name="cmemberships[name][]" value="" id="nfaqt" class="form-control" /> 
        
        
         <input type="hidden" name="cmemberships[tokens][]" value="0"   />    
        <input type="hidden" name="cmemberships[credit][]" value="0"   />   
         <input type="hidden" name="cmemberships[price][]" value="30"  />  
        <input type="hidden" name="cmemberships[key][]" value="mems<?php echo rand(0,1000); ?>"   /> 
         <input type="hidden" name="cmemberships[desc][]" value=""  />  
 
    
    <hr />
    <button class="btn btn-primary" type="submit" onclick="checknotblank()">Save</button>
    
    </div>
    
    </li>  
      
</div></div>







<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(1); ?>