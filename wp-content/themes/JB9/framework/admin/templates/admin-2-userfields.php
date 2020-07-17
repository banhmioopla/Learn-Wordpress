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

 
// SAVE CUSTOM FIELD DATE  
$regfields = get_option("regfields"); 
if(!is_array($regfields)){ $regfields = array(); }  
  
?> 
 

<script>
jQuery(document).ready(function() {	
    jQuery( "#regfield-list" ).sortable(); 

});
</script> 


<div class="tabheader mb-4">

<a href="javascript:void(0);" onClick="jQuery('#regfield-list-new').clone().prependTo('#regfield-list');" class="btn btn-sm btn-primary float-right">Add Field</a>	

         <h4><span>Registration Fields</span></h4>
      </div>



 
 
 
<ul id="regfield-list">
<?php if(is_array($regfields) && !empty($regfields) ){ $i=0; 

foreach($regfields['name'] as $data){ 

	if( strlen($regfields['name'][$i]) > 2 ){  ?>
    
    
<li class="cfielditem closed " id="rowid-<?php echo $i; ?>">
	
    <div class="heading">
      
     	<div class="showhide">
            <a href="javascript:void(0);" onclick="jQuery('.cf-<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>                                  
        </div>            

        <div class="name">
        
        <a href="javascript:void(0);" onClick="jQuery('#rowid-<?php echo $i; ?>').html('').hide();" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-primary btn-sm">
        <i class="fas fa-times" aria-hidden="true"></i>
        </a> 
        
        &nbsp; <strong><?php echo stripslashes($regfields['name'][$i]); ?></strong>   <small><?php echo $regfields['key'][$i]; ?></small>
        
        </div>
    
    </div>
    
    <div class="inside cf-<?php echo $i; ?>">  
         
        <label class="txt500">Title <span class="required">*</span></label>      
        
        <input type="text" name="regfields[name][]" id="title-<?php echo $i; ?>" value="<?php echo stripslashes($regfields['name'][$i]); ?>" class="form-control"  />
        
        <div class="row my-3">
        
        	<div class="col-md-12">
            
            <label class="txt500">Field Type</label>
            
              <select name="regfields[type][]" class="form-control" onchange="showvalue<?php echo $i; ?>(this.value,'#values-<?php echo $i; ?>')">
                  
                    <option value="input" <?php if($regfields['type'][$i] == "input"){ echo "selected=selected"; } ?> >Input Field</option>
                    <option value="textarea" <?php if($regfields['type'][$i] == "textarea"){ echo "selected=selected"; } ?>>Text Area</option>
                    <option value="checkbox" <?php if($regfields['type'][$i] == "checkbox"){ echo "selected=selected"; } ?>>Checkbox</option>
                    <option value="radio" <?php if($regfields['type'][$i] == "radio"){ echo "selected=selected"; } ?>>Radio Button</option> 
                    <option value="select" <?php if($regfields['type'][$i] == "select"){ echo "selected=selected"; } ?>>Selection Box</option>                                          
             	 	<option value="tax" <?php if($regfields['type'][$i] == "tax"){ echo "selected=selected"; } ?>>Taxonomy</option> 
                    <option value="post_type" <?php if($regfields['type'][$i] == "post_type"){ echo "selected=selected"; } ?>>Post Type</option> 
                    
                     
              </select>                 
            
            </div>
        
        	<div class="col-md-12 mt-3">
            
             <label class="txt500">Unique Database Key <span class="required">*</span> </label>
             
              <input type="text" name="regfields[key][]" id="key-<?php echo $i; ?>" value="<?php echo $regfields['key'][$i]; ?>" class="form-control"  />        
             
             <p class="text-muted py-2 mb-0 pb-0">No spaces or special characters.</p>
             
            </div>   
                 
        </div>
          
        <div style="display:none;" id="values-<?php echo $i; ?>">
      	<label class="txt500">Field Values (one per row) <span class="required">*</span></label>    		
        <textarea name="regfields[values][]" style="width:100%; height:100px;" class="form-control"><?php echo $regfields['values'][$i]; ?></textarea>
		</div> 
        
        
        
        
        
        
        <script>
		
		jQuery(document).ready(function(){
			showvalue('<?php echo $regfields['type'][$i]; ?>', '#values-<?php echo $i; ?>');
		});
		</script>
        
        <?php if($regfields['type'][$i] == "input" || $regfields['type'][$i] == "textarea"){ ?>
         <div class="row  my-3">
        
        	<div class="col-md-6">
            
            <label class="txt500">Required</label>
            
               <div>
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('rfield-equired-<?php echo $i; ?>').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('rfield-equired-<?php echo $i; ?>').value='1'">
                                      </label>
                                      <div class="toggle <?php if(isset($regfields['required'][$i]) && $regfields['required'][$i] == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
               </div> 
                                
                                 
                                 <input type="hidden" id="rfield-equired-<?php echo $i; ?>" name="regfields[required][]"
                                 value="<?php if(isset($regfields['required'][$i])){ echo $regfields['required'][$i]; } ?>">
           
           
           </div>
           
           </div>
      <?php }else{ ?>
        <input type="hidden" name="regfields[required][]" value="" />  
      <?php } ?>
      
      <div class="row">
      
      
      <?php if($regfields['type'][$i] == "tax"){  $taxs = get_taxonomies();  ?>
      <div class="col-12">
      
      <label class="txt500">Select Taxonomy</label>
      
         <select name="regfields[tax_name][]" class="form-control">
                        <?php
		
		
        $exclude = array('nav_menu', 'link_category', 'post_format','post_tag');
        foreach ($exclude as $ex) {
            if ( in_array( $ex, $taxs ) ) {
                unset( $taxs[$ex] );
            }
        }
		
		$taxonomy = $regfields['tax_name'][$i];
						
						
						
						$not_wanted = array('nav_menu','post_tag','post_format');									
                        foreach ($taxs as $tax) {
							if(in_array($tax,$not_wanted)){ continue; }
							if($tax == "category"){ $display_text = "Blog Category"; }elseif($tax == "listing"){ $display_text = "Listing Categories"; }else{ $display_text = $tax; }
							
                            printf( '<option value="%1$s"%2$s>%3$s</option>', $tax, selected( $taxonomy, $tax, false ), $display_text );
                        }
                        ?>
                    </select>
      
      </div>
       <?php }else{ ?>
        <input type="hidden" name="regfields[tax_name][]" value="" />  
      <?php } ?>
      
      
      
      
      
      <?php if($regfields['type'][$i] == "post_type"){  $taxs = get_taxonomies();  ?>
      <div class="col-6">
      
      <label class="txt500">Select Post Type</label>
      
         <select name="regfields[posttype_name][]" class="form-control">
        <?php
		
		
		$selected = $regfields['posttype_name'][$i];
		
		foreach ( get_post_types('', 'names') as $post_type ) {
							
			$display_text = $post_type;
							
       		printf( '<option value="%1$s"%2$s>%3$s</option>', $post_type, selected( $selected, $post_type, false ), $display_text );
       
	    }
       
	    ?>
       </select>
      
      </div>
       <?php }else{ ?>
        <input type="hidden" name="regfields[tax_name][]" value="" />  
      <?php } ?>
      
      
      
      
      
      </div><!-- end row -->
        
        
        
	</div>
    
</li>

 <?php $i++; } ?>    
    
<?php } ?>    

<?php } ?>  
</ul>

 
 
    
<script>

function showvalue(val, div){
	if(val == "checkbox" || val =="radio" || val =="select" ){
		jQuery(div).show();
	} else {
		jQuery(div).hide();
	}
}
 
function checknotblank(){
if(jQuery('#nfaqt1').val() == ""){  jQuery('#nfaqt1').val(' '); }
}
</script>