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
   
   global $wpdb, $CORE, $userdata, $CORE_ADMIN;
   
   
   // GET EXISTING FIELDS THEN ADD-ON THE NEW ONE
   $packagefields = get_option("packagefields");
   if(!is_array($packagefields)){ $packagefields = array(); }
   
    
   // GET LIST OF CATEGORIES FOR SELECTION
   $categorylist = $CORE->CategoryList(array(0,false,0,THEME_TAXONOMY,0,0,true));
   $categorylistarray = get_terms(THEME_TAXONOMY,"orderby=count&order=desc&get=all");
   $new_categorylistarray = array();
   foreach($categorylistarray as $cad){
   $new_categorylistarray[$cad->term_id] = $cad;
   }
    
    
    
   
   // SAVE CUSTOM FIELD DATE
   if(isset($_POST['updatefields'])){
   
   	if(empty($_POST['cfield'])){ $_POST['cfield'] = array(); }
   	
   	update_option("cfields", $_POST['cfield']);
   
   }
   // GET FIELDS
   $cfields = get_option("cfields"); 
   
   // LOAD IN MAIN DEFAULTS 
   $core_admin_values = get_option("core_admin_values");  
     
   ?> 
<div class="row">
   <div class="col-lg-8">
      <div class="bg-white p-3 shadow" style="border-radius: 7px;">
      
      
      
<div class="accordion" id="accordionExample">

<?php if( THEME_KEY == "da"){ ?>
<?php }else{ ?> 
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/b/0.png" class="title-img">
          <div class="title">Packages <?php if(_ppt('websitepackages') == 0){ ?><span class="badge badge-danger ml-3 mt-2">disabled</span><?php } ?></div>
        </button>
      </h2>
    </div>    


    <div id="collapseOne" class="collapse <?php if(!isset($_POST['submitted'])){ ?>show<?php } ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body px-0">
      

<?php if(_ppt('websitepackages') == 0){ ?>

<div class="alert alert-danger">
<strong>Listing Packages Disabled</strong>

Your listing packages will not show and users will be able to create listings for free because you have disabled listing packages.

</div>
<?php } ?>
         
         
         
         <script>
            function doformcheck(a, div){
             
            	if(jQuery(a).prop('checked') ){	
            	jQuery('#'+div).val( 1 );
            	}else{
            	jQuery('#'+div).val( 0 );	
            	}
            
            }
         </script>
         <ul id="package-list">
            <?php $i=0; 
               $paknames = array('Basic','Standrad','Premium', 'Extra 1', 'Extra 2', 'Extra3', 'Extra4');
               
               while($i < 7){ ?>
            <li class="cfielditem closed " id="rowid-<?php echo $i; ?>">
               <div class="heading">
                  <div class="showhide">
                     <a href="#" onclick="jQuery('.pf-<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
                     <i class="fa fa-search" aria-hidden="true"></i>
                     </a>                                  
                  </div>
                  <div class="name">
                     <div class="txt500" style="font-size:18px;">
					 
					 <a href="#" onclick="jQuery('.pf-<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="text-dark">
					 <?php if(_ppt('pak'.$i.'_name') == ""){ echo $paknames[$i]; }else{ echo _ppt('pak'.$i.'_name'); } ?>
                     
                     </a>
                     
                     <?php if(_ppt('pak'.$i.'_enable') == 1){ echo "<span class='badge badge-success float-right mr-3 mt-2'>enabled</span>"; } ?>
                     
					 <?php if(_ppt('pak'.$i.'_r') == 1){ echo "<span class='badge badge-danger float-right mr-3 mt-2'>recurring</span>"; } ?>
                     
                     
                     
                     </div>
                  </div>
               </div>
               <div class="inside pf-<?php echo $i; ?>">
                  <div class="container px-0 border p-4 mb-4 relative bg-light" style="position:relative;" >
                  
                  
<div class="row border-bottom pb-3 mb-3">

    <div class="col-md-6">
    
     <label class="txt500 mb-2">Enable Package</label> 
    </div>
    <div class="col-md-6">
 		<div>
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('enablepak<?php echo $i; ?>').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('enablepak<?php echo $i; ?>').value='1'">
                                  </label>
                                  <div class="toggle <?php if(  _ppt('pak'.$i.'_enable') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                <input type="hidden" id="enablepak<?php echo $i; ?>" name="admin_values[pak<?php echo $i; ?>_enable]" 
                             value="<?php if(_ppt('pak'.$i.'_enable') == ""){ echo 1; }else{ echo _ppt('pak'.$i.'_enable'); } ?>">
 
</div> 
</div>  
                  
                  
                     <div class="row py-2">
                        <div class="col-12">
                           <label class="txt500 mb-2">Package Name</label>   
                           <input type="text" name="admin_values[pak<?php echo $i; ?>_name]" value="<?php if(_ppt('pak'.$i.'_name') == ""){ echo $paknames[$i]; }else{ echo _ppt('pak'.$i.'_name'); } ?>" class="form-control"> 
                        </div>
                     </div>
<!-- end row -->
<div class="mt-3 mb-3">
   <label class="txt500">Description</label>
   <textarea name="admin_values[pak<?php echo $i; ?>_desc]" class="form-control" style="height:100px !important;"><?php echo stripslashes(_ppt('pak'.$i.'_desc')); ?></textarea>
</div>
                     <div class="row text-muted small mt-2">
                        <div class="col-4">
                           <input type="checkbox"  value="yes" <?php if(_ppt('pak'.$i.'_featured') == 1){ echo 'checked=checked'; } ?> onChange="doformcheck(this, 'checkval1_<?php echo $i; ?>')" > Listing is Featured
                           <input type="hidden" name="admin_values[pak<?php echo $i; ?>_featured]" value="<?php if(_ppt('pak'.$i.'_featured') == ""){ echo 0; }else{ echo _ppt('pak'.$i.'_featured'); } ?>" id="checkval1_<?php echo $i; ?>">

                        </div>
                        
                        <div class="col-4">
                           <input type="checkbox" value="yes" <?php if(_ppt('pak'.$i.'_html') == 1){ echo 'checked=checked'; } ?> onChange="doformcheck(this, 'checkval2_<?php echo $i; ?>')" > HTML Editor
                           <input type="hidden" name="admin_values[pak<?php echo $i; ?>_html]" value="<?php if(_ppt('pak'.$i.'_html') == ""){ echo 0; }else{ echo _ppt('pak'.$i.'_html'); } ?>" id="checkval2_<?php echo $i; ?>">
                                                  
                           
                        </div>
                        
                        <div class="col-4">
                         <?php if(in_array(THEME_KEY, array('dt','rt','ct','at','mj','so'))){ ?>
                           <input type="checkbox"  value="yes" <?php if(_ppt('pak'.$i.'_youtube') == 1){ echo 'checked=checked'; } ?> onChange="doformcheck(this, 'checkval3_<?php echo $i; ?>')" > Includes Youtube Video
                           <input type="hidden" name="admin_values[pak<?php echo $i; ?>_youtube]" value="<?php if(_ppt('pak'.$i.'_youtube') == ""){ echo 0; }else{ echo _ppt('pak'.$i.'_youtube'); } ?>" id="checkval3_<?php echo $i; ?>">
                           <?php } ?>   
                        </div>
                        
                        
                     </div>
                     </p>
                     <div class="row py-2">
                        
                        <div class="col-4">
                           <label class="txt500 mb-2">Max. Files</label> 
                           <div class="input-group">
                              <span class="input-group-prepend input-group-text">#</span>
                              <input type="text" name="admin_values[pak<?php echo $i; ?>_uploads]"   class="form-control" value="<?php if(_ppt('pak'.$i.'_uploads') == ""){ echo 200; }else{ echo _ppt('pak'.$i.'_uploads'); } ?>">
                           </div>
                        </div>
                     
                        <div class="col-4">
                           <label class="txt500 mb-2">Max. Categories</label>   
                           <div class="input-group">
                              <span class="input-group-prepend input-group-text">#</span>
                              <input type="text" name="admin_values[pak<?php echo $i; ?>_cats]" value="<?php if(_ppt('pak'.$i.'_cats') == ""){ echo 200; }else{ echo _ppt('pak'.$i.'_cats'); } ?>" class="form-control">
                           </div>
                        </div>
                        <div class="col-4">
                           <label class="txt500 mb-2">Expires After (days)</label>    
                           <div class="input-group">
                              <?php if(in_array(_ppt('pak'.$i.'_duration'), array(1,2,7,30,365) )){ ?> 
                              <select name="admin_values[pak<?php echo $i; ?>_duration]" class="form-control">
                                 <option value="1" <?php if(_ppt('pak'.$i.'_duration') == "1"){ echo 'selected=selected'; } ?>>24 hours</option>
                                 <option value="2" <?php if(_ppt('pak'.$i.'_duration') == "2"){ echo 'selected=selected'; } ?>>48 hours</option>
                                 <option value="7" <?php if(_ppt('pak'.$i.'_duration') == "7"){ echo 'selected=selected'; } ?>>1 Week</option>
                                 <option value="30" <?php if(_ppt('pak'.$i.'_duration') == "30"){ echo 'selected=selected'; } ?>>1 Month</option>
                                 <option value="365" <?php if(_ppt('pak'.$i.'_duration') == "365"){ echo 'selected=selected'; } ?>>1 Year</option>
                                 <option value="99">Custom Duration</option>
                              </select>
                              <?php }else{ ?>
                              <input type="text" name="admin_values[pak<?php echo $i; ?>_duration]"   class="form-control" value="<?php echo _ppt('pak'.$i.'_duration'); ?>">
                              <?php } ?>
                           </div>
                           <small>0 = unlimited</small>
                        </div>
                     </div>
                     
                     <div class="row mt-1">
   <div class="col-md-4">
      <label class="txt500">Price <span class="required">*</span></label>
      <div class="input-group">
         <span class="input-group-prepend input-group-text"><?php echo hook_currency_symbol(''); ?></span>
            <input type="text" name="admin_values[pak<?php echo $i; ?>_price]" value="<?php if(_ppt('pak'.$i.'_price') == ""){ echo 0; }else{ echo _ppt('pak'.$i.'_price'); } ?>" class="form-control"> 
      </div>
   </div>
   <div class="col-md-4">
   
   
      <label class="txt500">Renewal Frequency</label>
      
       <?php if( in_array(_ppt('pak'.$i.'_rdays') , array("", 1,7,30,365) )){ ?>
      <select class="form-control" name="admin_values[pak<?php echo $i; ?>_rdays]">
      <option value="" <?php if( _ppt('pak'.$i.'_rdays') == ""){ echo "selected=selected"; } ?>>--</option>
      
      <option value="1" <?php if( _ppt('pak'.$i.'_rdays') == 1){ echo "selected=selected"; } ?>>Daily</option>
      <option value="7" <?php if( _ppt('pak'.$i.'_rdays')  == 7){ echo "selected=selected"; } ?>>Weekly</option>
      <option value="30" <?php if(_ppt('pak'.$i.'_rdays') == 30){ echo "selected=selected"; } ?>>Monthly</option>
      <option value="365" <?php if(_ppt('pak'.$i.'_rdays')  == 365){ echo "selected=selected"; } ?>>Yearly</option>
      <option value="99">Custom Frequency</option>
      </select>
      <?php }else{ ?>
      <input type="text" name="admin_values[pak<?php echo $i; ?>_rdays]" class="form-control" value="<?php echo _ppt('pak'.$i.'_rdays'); ?>">
      <?php } ?>
      
   </div>
   
   
   <div class="col-md-4">
      <label class="txt500">Recurring Payment</label>
      <div style="margin-top: 5px;">
         <label class="radio off">
         <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('pak<?php echo $i; ?>_r').value='0'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('pak<?php echo $i; ?>_r').value='1'">
         </label>
         <div class="toggle <?php if( _ppt('pak'.$i.'_r') == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="pak<?php echo $i; ?>_r" name="admin_values[pak<?php echo $i; ?>_r]" value="<?php echo _ppt('pak'.$i.'_r'); ?>">
   </div>
</div>
                     
                     
                  </div>
               </div>
            </li>
            <?php $i++; } ?>
         </ul>
        
         
      </div>
    </div>
    <?php } ?>   
      
 
 
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/b/1.png" class="title-img">
          <div class="title">Custom Fields</div>
        </button>
      </h2>
    </div>    


    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body px-0">




  
         <div class="tabheader ">
            <a href="javascript:void(0);" onClick="jQuery('#customfieldlist_new').clone().prependTo('#customfieldlist');addUpdateFieldKey();" class="btn btn-sm btn-primary float-right">Add Field</a>	
           
           
            <h4><span>&nbsp;</span></h4>
         </div>
         <div style="float:right"><span id="catlistboxright">&nbsp;</span></div>
         <div class="clear"></div>
         <div  class=" meta-box-sortables ui-sortable">
            <ul id="customfieldlist">
               <?php
                  if(is_array($cfields) && !empty($cfields) ){ $i=0; $setKeys = array(); $selectedcatlist = array();
                  
                  foreach($cfields['name'] as $data){ 
                  
                  	if($cfields['dbkey'][$i] !="" && $cfields['name'][$i] != "" ){ 
                  	
                  	// ADJUST KEY IF IS DUPLICATE
                  	if(in_array($cfields['dbkey'][$i], $setKeys) ){  $cfields['dbkey'][$i] = $cfields['dbkey'][$i]."".$i; }
                  	
                  	// ADD TO ALREADY DONE LIST
                  	$setKeys[] = $cfields['dbkey'][$i];	
                  	
                  	// WORK OUT CATEGORY LIST
                  	$displaycategorylist = $categorylist;
                  	$cat_class_list = ""; $dname = "";
                  	if(isset($cfields['cat'][$i]) && is_array($cfields['cat'][$i])){
                  		foreach($cfields['cat'][$i] as $c){
                  			$selectedcatlist[] = $c;
                  			$displaycategorylist = str_replace('"'.$c.'"', '"'.$c.'" selected=selected', $displaycategorylist);
                  			$cat_class_list .= " catid-".$c;
                  			//$dname .= $new_categorylistarray[$c]->name." ";
                  		}
                  	}
                  	
                  	
                  	?>
               <li class="closed <?php echo $cat_class_list; ?>" id="field<?php echo $i; ?>">
                  <div class="cfielditem">
                     <div class="heading">
                        <div class="showhide">
                           <a href="javascript:void(0);" onclick="addUpdateFieldKey();jQuery('.cf-<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </a>                                  
                        </div>
                        <div class="name">
                           <a href="javascript:void(0);" onClick="addUpdateFieldKey();jQuery('#dbkey-<?php echo $i; ?>').val('');jQuery('#field<?php echo $i; ?>').html('');" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-primary btn-sm">
                           <i class="fas fa-times" aria-hidden="true"></i>
                           </a>
                           &nbsp; <strong><?php echo $cfields['name'][$i]; ?></strong> <small> <?php echo $cfields['dbkey'][$i]; ?></small> 
                        </div>
                     </div>
                     <div class="inside cf-<?php echo $i; ?>">
                        <div class="row">
                           <div class="col-md-6"> 
                              <label>Display Text <span class="required">*</span></label>      
                              <input type="text" name="cfield[name][]" id="ftitle-<?php echo $i; ?>" value="<?php echo $cfields['name'][$i]; ?>" class="form-control"  />  
                           </div>
                           <div class="col-md-6">        
                              <label>Database Key <span class="required">*</span></label>  
                              <input type="text"  name="cfield[dbkey][]" id="dbkey-<?php echo $i; ?>"  onchange="removeWhitespace('dbkey-<?php echo $i; ?>');" class="form-control" value="<?php echo $cfields['dbkey'][$i]; ?>">
                           </div>
                        </div>
                        <!-- end row -->
                        <div class="row formrow mt-3">
                           <div class="col-md-12">
                              <label>Display Category <span class="required">*</span></label>
                              <p class="text-muted">Select which categories to display this field under.</p>
                              <div class="clearfix">
                                 <select name="cfield[cat][<?php echo $i; ?>][]" multiple="multiple" style="height:300px; width:430px; overflow:scroll" class="chzn-select" >
                                    <option value="0" <?php if(isset($cfields['cat'][$i][0]) && $cfields['cat'][$i][0] == ""){ echo "selected=selected"; } ?>>Display In All Categories</option>
                                    <?php echo $displaycategorylist; ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <!-- end row -->
                        <?php /*
                           <label>Assign to Package <span class="required">*</span></label>              
                           <select name="cfield[package][<?php echo $i; ?>][]" id="assign_package_id" class="chzn-select" multiple="">
                        <option value="">All Packages</option>
                        <?php
                           $selected_packages = $cfields['package'][$i];
                           
                           foreach($packagefields as $field){
                           
                           $ee = "";
                           if(!empty($selected_packages) && in_array($field['ID'], $selected_packages) ){
                           	
                           $ee = "selected=selected";
                           }
                           
                           echo "<option value='".$field['ID']."' ".$ee.">".$field['name']."</option>";
                           
                           }
                           
                           ?>                    
                        </select>
                        */ ?>
                        <div class="row formrow mt-3">
                           <div class="col-md-12">
                              <label class="mt-1">Help Text/ Description (optional)</label>
                              <p class="text-muted">This is displayed under the field to help direct the user as to what data to input.</p>
                              <input type="text"  name="cfield[help][]" class="form-control" value="<?php if(isset($cfields['help'][$i])){ echo stripslashes($cfields['help'][$i]); } ?>">
                           </div>
                        </div>
                        <div class="row mt-3">
                           <div class="col-md-12">
                              <label class="bold">Field Type <span class="required">*</span></label> 
                              <p class="text-muted">Select the type of field to display to the user.</p>
                           </div>
                           <div class="col-md-12">
                              <select name="cfield[fieldtype][]" class="field_type form-control"   onchange="showhideextrafield('field<?php echo $i; ?>')">
                                 <option value="input" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "input"){echo "selected=selected"; } ?>>Input Field</option>
                                 <option value="textarea" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "textarea"){echo "selected=selected"; } ?>>Text Area</option>
                                 <option value="checkbox" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "checkbox"){echo "selected=selected"; } ?>>Checkbox</option>
                                 <option value="radio" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "radio"){echo "selected=selected"; } ?>>Radio Button</option>
                                 <option value="select" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "select"){echo "selected=selected"; } ?>>Selection</option>
                                 <option value="taxonomy" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "taxonomy"){echo "selected=selected"; } ?>>Taxonomy</option>
                                 <option value="date" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "date"){echo "selected=selected"; } ?>>Date</option>
                                 <option value="title" <?php  if(isset($cfields['fieldtype'][$i]) && $cfields['fieldtype'][$i] == "title"){echo "selected=selected"; } ?>>Display Caption (Title Only)</option>
                              </select>
                           </div>
                        </div>
                        <div class="extra_values" style="display:none">
                           <label class="mt-1">Field Values <span class="required">*</span></label>        
                           <textarea class="form-control"  name="cfield[values][]" placeholder="One value per line" style="border:1px solid orange;height:100px !important;"><?php if(isset($cfields['values'][$i])){ echo stripslashes($cfields['values'][$i]); } ?></textarea>
                        </div>
                        <div class="tax_values" style="display:none">
                           <div class="row">
                              <div class="col-md-6">
                                 <label class="mt-1">Taxonomy <span class="required">*</span></label>        
                                 <select name="cfield[taxonomy][]" class="form-control" id="ttval">
                                 <?php
                                    $select_tax = "";
                                    if(isset($cfields['taxonomy'][$i])){
                                    $select_tax = $cfields['taxonomy'][$i];
                                    }
                                    
                                    $taxs = get_taxonomies();
                                    $not_wanted = array('nav_menu','post_tag','post_format');
                                                      foreach ($taxs as $tax) {
                                    	if(in_array($tax,$not_wanted)){ continue; }
                                    	if($tax == "category"){ $display_text = "Blog Category"; }elseif($tax == "listing"){ $display_text = "Listing Categories"; }else{ $display_text = $tax; }
                                    	
                                                          printf( '<option value="%1$s"%2$s>%3$s</option>', $tax, selected( $select_tax , $tax, false ), $display_text );
                                                      }
                                     
                                                      ?>
                                 </select>         
                              </div>
                              <div class="col-md-6">
                                 <label class="mt-1">Linked With: <span class="required">*</span></label>
                                 <select name="cfield[taxonomy_link][]" class="form-control" id="ttval">
                                    <option value="0">Not Linked</option>
                                    <?php
                                       $select_tax = "";
                                       if(isset($cfields['taxonomy_link'][$i])){
                                       $select_tax = $cfields['taxonomy_link'][$i];
                                       }
                                       
                                       $taxs = get_taxonomies();
                                       $not_wanted = array('nav_menu','post_tag','post_format');
                                                        foreach ($taxs as $tax) {
                                       if(in_array($tax,$not_wanted)){ continue; }
                                       if($tax == "category"){ $display_text = "Blog Category"; }elseif($tax == "listing"){ $display_text = "Listing Categories"; }else{ $display_text = $tax; }
                                       
                                                            printf( '<option value="%1$s"%2$s>%3$s</option>', $tax, selected( $select_tax , $tax, false ), $display_text );
                                                        }
                                                        ?>
                                 </select>
                              </div>
                           </div>
                           <!-- end row -->
                           <hr />
                           <div class="extrafields">
                              <label class="checkbox">
                              <input type="checkbox" onchange="ChangeTickValue1(<?php echo $i; ?>);" <?php if(isset($cfields['required'][$i]) && $cfields['required'][$i] == "yes"){echo "checked=checked"; } ?>> <b>Required Field</b> - <small> The user will be prompted to select/enter a value.</small>
                              </label>
                              <input type="hidden" name="cfield[required][]" class="checkvalue<?php echo $i; ?>" value="<?php if(isset($cfields['required'][$i]) && $cfields['required'][$i] == "yes"){echo "yes"; }else{ echo "no";}?>" />
                           </div>
                           <!-- end extra field -->
                        </div>
                        <!-- end well -->
                        <script> jQuery(document).ready(function() { showhideextrafield('field<?php echo $i; ?>'); }); </script>
                        <div class="clear"></div>
                     </div>
                  </div>
               </li>
               <?php }  $i++; } }else{ ?>
               <div class="p-4 bg-light text-center txt500">
                  No Fields Created
               </div>
               <?php } ?>
            </ul>
         </div>
         <?php if(!empty($selectedcatlist)){ ?>
         <hr />
         <div id="filterbycatbox" style="float:right;">
            <select onchange="FilterByCategory(this.value);" class="my-2">
               <option value="0">Show All</option>
               <?php 
                  foreach(array_unique($selectedcatlist) as $ck){
                  
                  	foreach($categorylistarray as $cad){
                  	
                  		if($ck == $cad->term_id){
                  		?>
               <option value="catid-<?php echo $cad->term_id; ?>"><?php echo $cad->name; ?></option>
               <?php
                  }	
                  }
                  }
                  ?>
            </select>
         </div>
         <?php } ?>
         <script>
            function addUpdateFieldKey(){
            
            
            // ADD NEW
                        		jQuery('<input>').attr({
                        			type: 'hidden',            			
                        			name: 'updatefields',
                        			value: 1,
                        		}).appendTo('#customfieldlist');
            }
            
            
            
            jQuery(document).ready(function() {	
                jQuery( "#customfieldlist" ).sortable({
                   revert       : true,
                   connectWith  : ".sortable",
                   stop         : function(event,ui){ 	jQuery('<input>').attr({
                        			type: 'hidden',            			
                        			name: 'updatefields',
                        			value: 1,
                        		}).appendTo('#customfieldlist'); }
                }); 
            
            });
            jQuery('#catlistboxright').html(jQuery('#filterbycatbox').html());
            
            function showhideextrafield(div){
            			
            	val = jQuery('#'+div+' .field_type').val();
             
            			
            	if(val == "title" ){
            	 
            	}else if(val == "checkbox" || val =="radio" || val =="select" ){
            		jQuery('#'+div+' .extra_values').show();
            		jQuery('#'+div+' .tax_values').hide();
            		jQuery('#'+div+' .tax_link').hide(); 
            	}else if(val == "taxonomy" ){
            		jQuery('#'+div+' .extra_values').hide();
            		jQuery('#'+div+' .tax_values').show();
            		jQuery('#'+div+' .tax_link').show();
            	}else{
            		jQuery('#'+div+' .extra_values').hide();
            		jQuery('#'+div+' .tax_values').hide();
            		jQuery('#'+div+' .tax_link').hide();	
            	}	
            }
            
            function FilterByCategory(catid){
            
            	if(catid == 0){
            	jQuery('#customfieldlist li').show();
            	}else{
            	jQuery('#customfieldlist li').hide();
            	jQuery('#customfieldlist li.'+catid+'').show();
            	}
            }
            function ChangeTickValue1(id){ 
             
            	 if(jQuery('.checkvalue'+id+'').val() == "no"){
            	 jQuery('.checkvalue'+id+'').val("yes");
            	 }else{
            	 jQuery('.checkvalue'+id+'').val("no");
            	 } 
            } 
            function changeboxme(id){
            
             var v = jQuery("#"+id).val();
             if(v == 1){
             jQuery("#"+id).val('0');
             }else{
             jQuery("#"+id).val('1');
             }
             
            }
         </script>
         
         











      </div>
    </div>
      
      
      
       
 
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/b/2.png" class="title-img">
          <div class="title">Settings</div>
        </button>
      </h2>
    </div>    


    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body bg-light">
      
      
           <!-- ------------------------- -->
 
         <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
               <div class="col-md-7">
                  <label class="txt500">How Many?</label>
                  <p class="text-muted">How many listings can each member create?</p>
               </div>
               <div class="col-md-5">
                  
                     <select name="admin_values[onelistingonly]" class="mt-2" style="width:100%">
                        <option value="0" <?php if(_ppt('onelistingonly') == "0"){ echo "selected=selected"; } ?>>Unlimited Listings</option>
                        <option value="1" <?php if(_ppt('onelistingonly') == "1"){ echo "selected=selected"; } ?>>One Listing Only</option>
                         <option value="2" <?php if(_ppt('onelistingonly') == "2"){ echo "selected=selected"; } ?>>One Listing Then Membership</option>
                       
                        
                     </select>
                  
               </div>
            </div>
         </div> 
      
      
           <!-- ------------------------- -->
         <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
               <div class="col-md-7">
                  <label class="txt500">Requires Admin Approval?</label>
                  <p class="text-muted">What happens when a listing has been created or edited?</p>
               </div>
               <div class="col-md-5">
                  
                     <select name="admin_values[default_listing_status]" class="mt-2" style="width:100%">
                        <option value="publish" <?php if(_ppt('default_listing_status') == "publish"){ echo "selected=selected"; } ?>>No - Go live straight away</option>
                        <option value="pending" <?php if(_ppt('default_listing_status') == "pending"){ echo "selected=selected"; } ?>>Yes - Admin approval</option>
                     </select>
                  
               </div>
            </div>
         </div>

 
         <?php  if(THEME_KEY != "da"){ ?> 
         <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
               <div class="col-md-10 pr-lg-5">
                  <label class="txt500">Membership Required?</label>
                  <p class="text-muted">Force users to subscribe to a membership before they can submit a listing.</p>
               </div>
               <div class="col-md-2">
                  <div  class="mt-4">
                     <label class="radio off">
                     <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('requiremembership').value='0'">
                     </label>
                     <label class="radio on">
                     <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('requiremembership').value='1'">
                     </label>
                     <div class="toggle <?php if(_ppt('requiremembership') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                     </div>
                  </div>
                  <input type="hidden" id="requiremembership" name="admin_values[requiremembership]" value="<?php echo _ppt('requiremembership'); ?>">
               </div>
            </div>
         </div>
         

         
         <?php }else{ ?>
         
         
         <input type="hidden" id="requiremembership" name="admin_values[requiremembership]" value="0">
         <?php } ?>
         
         
         
         <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
               <div class="col-md-10 pr-lg-5">
                  <label class="txt500">Login To View Page?</label>
                  <p class="text-muted">Turn on/off if you want users to login before they can view listing pages.</p>
               </div>
               <div class="col-md-2">
                  <div class="mt-4">
                     <label class="radio off">
                     <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('requirelogin_listings').value='0'">
                     </label>
                     <label class="radio on">
                     <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('requirelogin_listings').value='1'">
                     </label>
                     <div class="toggle <?php if(_ppt('requirelogin_listings') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                     </div>
                  </div>
                  <input type="hidden" id="requirelogin_listings" name="admin_values[requirelogin_listings]" value="<?php echo _ppt('requirelogin_listings'); ?>">
               </div>
            </div>
         </div>
        
        
     
         
         
         <?php if(defined('GOOGLE-MAPS')){ ?>
         <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
               <div class="col-md-10 pr-lg-5">
                  <label class="txt500">Enable Google Maps?</label>
                  <p class="text-muted">Turn on to allow the user to enter their location.</p>
               </div>
               <div class="col-md-2">
                  <div  class="mt-4">
                     <label class="radio off">
                     <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_listing_map').value='0'">
                     </label>
                     <label class="radio on">
                     <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_listing_map').value='1'">
                     </label>
                     <div class="toggle <?php if(_ppt('default_listing_map') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                     </div>
                  </div>
                  <input type="hidden" id="default_listing_map" name="admin_values[default_listing_map]" value="<?php echo _ppt('default_listing_map'); ?>">
               </div>
            </div>
         </div>
         <?php } ?>
         <!-- ------------------------- -->
         <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
               <div class="col-md-10 pr-lg-5">
                  <label class="txt500">Min. Description Length</label>
                  <p class="text-muted">Here you can set the min amount of details a user must enter.</p>
               </div>
               <div class="col-md-2">
                  <div class="input-group mt-4" style="width:80px;">
                     <span class="input-group-prepend input-group-text">#</span>
                     <input type="text" name="admin_values[descmin]" class="form-control" value="<?php if(_ppt('descmin') == ""){ echo 200; }else{ echo _ppt('descmin'); } ?>">
                  </div>
               </div>
            </div>
         </div>
   
       
         
         <?php if(in_array(THEME_KEY,array('at','da') )){ ?>
         <input type="hidden" id="disable_expiry" name="admin_values[disable_expiry]" value="0">
         <?php }else{ ?>
         <div class="container px-0 mt-3 ">
            <div class="row py-2 ">
               <div class="col-md-10 pr-lg-5">
                  <label class="txt500">Disable Expiry Action  </label>
                  <p class="text-muted">Turn on if you want to stop the system from automatically expiring listings when their expiry date is reached.</p>
               </div>
               <div class="col-md-2">
                  <div>
                     <label class="radio off">
                     <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('disable_expiry').value='0'">
                     </label>
                     <label class="radio on">
                     <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('disable_expiry').value='1'">
                     </label>
                     <div class="toggle <?php if(_ppt('disable_expiry') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                     </div>
                  </div>
                  <input type="hidden" id="disable_expiry" name="admin_values[disable_expiry]" value="<?php echo _ppt('disable_expiry'); ?>">
               </div>
            </div>
         </div>
         
         <?php } ?>

 
      </div>
    </div>
      
      
<?php if( THEME_KEY != "da"){ ?>
 
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/b/4.png" class="title-img">
          <div class="title">Category</div>
        </button>
      </h2>
    </div>    


    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body bg-light">


<!-- ------------------------- -->
         <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
               <div class="col-md-10">
                  <label class="txt500">Category Required</label>
                  <p class="text-muted">Turn on to force the user to select a category.</p>
               </div>
               <div class="col-md-2">
                  <div  class="mt-4">
                     <label class="radio off">
                     <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_listing_require_cat').value='0'">
                     </label>
                     <label class="radio on">
                     <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_listing_require_cat').value='1'">
                     </label>
                     <div class="toggle <?php if(_ppt('default_listing_require_cat') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                     </div>
                  </div>
                  <input type="hidden" id="default_listing_require_cat" name="admin_values[default_listing_require_cat]" value="<?php echo _ppt('default_listing_require_cat'); ?>">
               </div>
            </div>
         </div>
         
         
         
         <!-- ------------------------- -->
         <div class="container px-0">
            <div class="row py-2">
               <div class="col-md-10">
                  <label class="txt500">Extra Category Price</label>
                  <p class="text-muted">Here you can set the min amount of details a user must enter.</p>
               </div>
               <div class="col-12">
                  <select multiple="multiple" style="height:200px; width:100%; overflow:scroll;" onclick="jQuery('#updatedcatalert').html('');jQuery('#catid').val(this.value); WLTCatPrice('<?php echo str_replace("http://","",get_home_url()); ?>', this.value, 'currentpricebox');jQuery('#showcate').show();">
                  <?php echo $CORE->CategoryList(array(0,false,0,THEME_TAXONOMY,0,0,true)); ?>
                  </select>
                  <div class="row mt-4" id="showcate" style="display:none;">
                     <div class="col-8">
                         <div class="input-group">
                           <span class="input-group-text"><?php echo hook_currency_symbol(''); ?></span>
                           <span id="currentpricebox"><input type="text" name="catprice" class="form-control" id="catprice"></span>
                           <input type="hidden" name="catid" value="" id="catid"> 
                        </div>
                     </div>
                     <div class="col-md-2">
                        <a href="javascript:void(0);" onclick="SaveCatPrice();" class="btn btn-primary">save</a>
                     </div>
                  </div>
                  <!-- end row -->
                  <script>
                     function SaveCatPrice(){
                     var catid = jQuery('#catid').val();
                     var price = jQuery('#catprice').val();
                     
                         jQuery.ajax({
                             type: "POST",
                             url: '<?php echo home_url(); ?>/index.php',		
                     		data: {
                                 admin_action: "listing_catprice",
                     			amount: price,
                     			cid: catid,
                      
                             },
                             success: function(response) {
                     			
                     			 
                     			jQuery('#credit-payment-form').show();
                     			
                             },
                             error: function(e) {
                                 alert("error "+e)
                             }
                         });
                     
                     alert('Price Updated');
                     
                      
                     }
                  </script>
               </div>
            </div>
         </div>

    </div>
    </div>
    
<?php } ?>    
         
     <div class="card-header" id="headingFive">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/b/5.png" class="title-img">
          <div class="title">Media</div>
        </button>
      </h2>
    </div>    


    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
      <div class="card-body bg-light">

 <!-- ------------------------- -->
         <div class="container px-0 border-bottom mb-3">
            <div class="row py-2">
               <div class="col-md-10">
                  <label class="txt500">Image Required</label>
                  <p class="text-muted">Turn on to force the user to upload an image.</p>
               </div>
               <div class="col-md-2">
                  <div  class="mt-4">
                     <label class="radio off">
                     <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('default_listing_require_image').value='0'">
                     </label>
                     <label class="radio on">
                     <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('default_listing_require_image').value='1'">
                     </label>
                     <div class="toggle <?php if(_ppt('default_listing_require_image') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                     </div>
                  </div>
                  <input type="hidden" id="default_listing_require_image" name="admin_values[default_listing_require_image]" value="<?php echo _ppt('default_listing_require_image'); ?>">
               </div>
            </div>
         </div>
         
  <div class="row mt-4">
      <div class="col-lg-6 mb-4 mb-lg-0">
<label class="txt500">Fallback Image</label>
                  <p class="text-muted">This is the image that will be displayed when no other image is assigned to the listing.</p>
                  
                  <p class="text-muted">Recommended size: 1024x748px</p>
      
      </div>
         <div class="col-lg-6 mb-4 mb-lg-0">
            <input type="hidden" 
               id="up_fallback_image_aid" 
               name="admin_values[fallback_image_aid]" 
               value="<?php if(isset($core_admin_values["fallback_image_aid"])){  echo stripslashes($core_admin_values["fallback_image_aid"]); } ?>"  />                
            <input 
               name="admin_values[fallback_image]" 
               type="hidden" 
               id="up_fallback_image" 
               value="<?php if(_ppt('fallback_image') != ""){  echo stripslashes($core_admin_values['fallback_image']); } ?>" />
            <?php if(isset($core_admin_values['fallback_image']) && substr($core_admin_values['fallback_image'],0,4) == "http"){ ?>
            <div class="pptselectbox bg-light p-5 text-center  mb-2 border">
               <img src="<?php echo $core_admin_values['fallback_image']; ?>" style="max-width:100%; max-height:300px;" id="fallback_image_preview" />   
            </div>
            <div class="pptselectbtns">
               <a href="<?php if(isset($core_admin_values['fallback_image'])){ echo $core_admin_values['fallback_image']; } ?>" target="_blank" class="btn btn-secondary  rounded-0" style="font-size: 10px;">View </a>
               <a href="javascript:void(0);"id="editImg_fallback_image" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Edit </a>
               <a href="javascript:void(0);" id="upload_fallback_image" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Change </a>
               <a href="javascript:void(0);" onclick="jQuery('#up_fallback_image').val('');document.admin_save_form.submit();" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Delete</a>
            </div>
            <?php }else{ ?>
            <div class="pptselectbox bg-dark p-5 text-center  mb-2">
               <a href="javascript:void(0);" id="upload_fallback_image" >
                  <div>select image</div>
                  <div>.jpeg/ .png</div>
               </a>
            </div>            
            <?php } ?>
      </div></div>      
            <script >
               jQuery(document).ready(function () {
               
               	jQuery('#editImg_fallback_image').click(function() {           
               			   	 
               		tb_show('', 'media.php?attachment_id=<?php echo _ppt("fallback_image_aid"); ?>&action=edit&amp;TB_iframe=true');
               					 
               		return false;
               	});
               	
               	jQuery('#upload_fallback_image').click(function() {           
               	
               		ChangeAIDBlock('up_fallback_image_aid');
               		ChangeImgBlock('up_fallback_image');		
               		ChangeImgPreviewBlock('fallback_image_preview')
               		
               		formfield = jQuery('#up_fallback_image').attr('name');
               	 
               		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
					
					
               			return false;
               	});
               					
               });	
            </script>    


    </div>
    </div>
         
           
      
</div>     
      
      
      
             
         
         
      
    
 
         
         
         
         
         
         
         
         
         
         
        
      </div>
   </div>
   <div class="col-lg-4">
   
      <?php if( THEME_KEY == "da"){ ?>
      <input type="hidden" id="websitepackages" name="admin_values[websitepackages]" value="0">
      <?php }else{ ?> 
      <div class="container bg-light py-3 mb-4 p-4">
         <div class="row">
            <div class="col-4">
               <div class="">
                  <label class="radio off">
                  <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('websitepackages').value='0'">
                  </label>
                  <label class="radio on">
                  <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('websitepackages').value='1'">
                  </label>
                  <div class="toggle <?php if(_ppt('websitepackages') == '1'){  ?>on<?php } ?>">
                     <div class="yes">ON</div>
                     <div class="switch"></div>
                     <div class="no">OFF</div>
                  </div>
               </div>
               <input type="hidden" id="websitepackages" name="admin_values[websitepackages]" value="<?php echo _ppt('websitepackages'); ?>">
            </div>
            <div class="col-8 text-left">
               <h4 class="txt500">Listing Packages</h4>
            </div>
            <div class="col-12">
               <div class="text-muted py-3">Turn off if you want users to create listings for free.</div>
            </div>
         </div>
         <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 
      </div>
      <?php } ?>
       
      
      
      <?php if( THEME_KEY == "da"){ }else{?>
      <div class="bg-light p-3 mt-5">
         <div class="tabheader mt-2">
            <h4><span><i class="fa fa-bar-chart float-right text-primary mr-2"></i> Listing Statistics</span></h4>
         </div>
         <?php $ores = $wpdb->get_results("SELECT count(*) as total FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'packageID'  ");
            ?>
         <div class="p-3 border-bottom mb-2">
            All With Packages <span class="float-right"><a href="edit.php?post_type=listing_type&packageid=77" target="_blank"><?php if(isset($ores[0])){ echo $ores[0]->total; }else{ echo 0; } ?></a></span>
         </div>
         <?php $i=0; 
            $paknames = array('Basic','Standrad','Premium');
            
            while($i < 3){ 
            
            $ores = $wpdb->get_results("SELECT count(*) as total FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'packageID' AND meta_value = '".$i."'");
            	 
            ?>
         <div class="p-3 border-bottom mb-2">
            <i class="fa fa-angle-right" aria-hidden="true"></i> <?php if(_ppt('pak'.$i.'_name') == ""){ echo $paknames[$i]; }else{ echo _ppt('pak'.$i.'_name'); } ?> 
            <span class="float-right"><a href="edit.php?post_type=listing_type&packageid=<?php echo $i; ?>" target="_blank"><?php if(isset($ores[0])){ echo $ores[0]->total; }else{ echo 0; } ?></a></span>
         </div>
         <?php $i++; } ?>
         <?php $ores = $wpdb->get_results("SELECT count(*) as total FROM ".$wpdb->prefix."postmeta WHERE  meta_key = 'packageID' AND meta_value = '99'");
            ?>
         <div class="p-3 border-bottom mb-2">
            <i class="fa fa-angle-right" aria-hidden="true"></i> Free Listings <span class="float-right"><a href="edit.php?post_type=listing_type&packageid=99" target="_blank"><?php if(isset($ores[0])){ echo $ores[0]->total; }else{ echo 0; } ?></a></span>
         </div>
      </div>
      <?php } ?>
   </div>
</div>