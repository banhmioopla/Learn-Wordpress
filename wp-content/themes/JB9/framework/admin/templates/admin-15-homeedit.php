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
   
   global $wpdb, $CORE; 
   
   
   // GET PAGES
$pages = get_pages();

// GET SAVED DATA
$p = _ppt('pageassign');


$elementorArray = array();
$args = array(
                   'post_type' 			=> 'elementor_library',
                   'posts_per_page' 	=> 12,
                    
               );
 $wp_query = new WP_Query($args);
 $tt = $wpdb->get_results($wp_query->request, OBJECT);

 if(!empty($tt)){ foreach($tt as $p){
 
 $elementorArray["elementor-".$p->ID] = get_the_title($p->ID);
 
 } }
   
   ?>
   
   
   
   
    

<div id="edithomepagewrap">
<?php
   $homedata = array();
   
   // HOME EDIT
   $homedata = hook_admin_2_homeedit($homedata);
    
   // HOOK FOR THEMES
   hook_admin_1_pagesetup();
   
   // GET THE CURRENT DATA
   $HDATA = _ppt('hdata_en_us');
    
   
   $LISTITEMS = ""; 
   $BODYITEMS = "";
   
   ?>
   
   
   <?php if(empty($homedata)){ ?>
   
   
    
<script>
jQuery(document).ready(function(){
	jQuery('#homepagecontentcard').hide();
});
</script>
   
   <!--
   <div class="text-center py-4">
   <?php if(defined('WLT_CHILDTHEME_ELEMENTOR')){ ?>
   <p>Please use the page builder tab and install the Elementor - child theme homepage design.</p>   
   <?php }else{ ?>
   <p>Please use the page builder to edit the home page layout. </p>
   <?php } ?>
   </div>
   -->
   
   <?php }else{ ?>
   
 
   <?php } ?>
  
   <?php
    
    
   // LOOK HOME DATA
   $i=1;
   foreach($homedata as $key => $data){ 
 
   
   // GET THE TITLE
   //ob_start();
   ?>
   
   
   
<div class="col-md-12 px-0">

<div id="item<?php echo $i; ?>">
   <div class="container ">
      <div class="row">
      
      <?php if(strlen($data['n']) > 0){ ?>
     
<div class="col-12 px-0">
      <div class="tabheader my-4">
<h4><span><?php echo $data['n']; ?></span></h4> 
</div>
 <?php if(isset($data['desc'])){  ?><p class="mt-3"><?php echo $data['desc']; ?></p> <?php  } ?>  
</div>       
      
               
       
      <?php } ?>
      

            
       <?php foreach($data['data'] as $key1 => $item){  if(!isset($item['type'])){ $item['type'] = ""; }  ?>
           
           
           <?php if($item['type'] == "seperator"){ ?>
            <hr  />
           <?php } ?>
			
			
         <div class="<?php if($item['type'] == "upload"){ echo "col-md-12 px-0";  }else{ echo "col-md-4"; } ?>">            
         <?php  if(isset($item['t'])){ ?><label class="text-uppercase small"><?php echo $item['t']; ?></label><?php } ?>
         
         <?php if(isset($item['desc'])){  ?><p><?php echo $item['desc']; ?></p> <?php  } ?>  
         
         </div>            
         <div class="<?php if($item['type'] == "upload"){ echo "col-md-12 px-0";  }else{ echo "col-md-8"; } ?>">
			
			 <?php  switch($item['type']){ 
			 
               case "yesno": {
               
               ob_start();
               ?>
            <div class="">
               <div class="mb-4">
                  <label class="radio off">
                  <input type="radio" name="toggle" 
                     value="off" onchange="document.getElementById('<?php echo $key; ?>_onoff').value='0'">
                  </label>
                  <label class="radio on">
                  <input type="radio" name="toggle"
                     value="on" onchange="document.getElementById('<?php echo $key; ?>_onoff').value='1'">
                  </label>
                  <div class="toggle <?php if(!isset($HDATA[$key][$key1])){ echo "on"; }elseif(isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == '1'){  ?>on<?php } ?>">
                     <div class="yes">ON</div>
                     <div class="switch"></div>
                     <div class="no">OFF</div>
                  </div>
               </div>
            </div>
            <input type="hidden" name="admin_values[hdata_en_us][<?php echo $key; ?>][<?php echo $key1; ?>]" id="<?php echo $key; ?>_onoff" value="<?php 
			
			if(!isset($HDATA[$key][$key1])){ echo "1"; }elseif(isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }elseif(isset($HDATA[$key][$key1])){ echo stripslashes($HDATA[$key][$key1]); } ?>">
            <?php 
             
			 echo ob_get_clean();
               
               } break;
               
               
               case "textarea": { 
               
               ob_start();
               
               ?>
            
            <textarea name="admin_values[hdata_en_us][<?php echo $key; ?>][<?php echo $key1; ?>]" style="height:150px !important; margin-bottom:20px !important; width:100%;" class="form-control"
               <?php $HDATA = _ppt('hdata_en_us'); ?>
               data-en_us="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"  
               <?php if(is_array(_ppt('languages') )){ foreach(_ppt('languages') as $lang){ $icon = explode("_",$lang); if(isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } ?>
               <?php $HDATA = _ppt('hdata_'.strtolower($lang)); ?>
               data-<?php echo strtolower($lang); ?>="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"
               <?php } } ?>
               /><?php  if(isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }elseif(isset($HDATA[$key][$key1])){ echo $HDATA[$key][$key1]; } ?></textarea>
            <?php 
              
			  echo ob_get_clean();
               
               } break;  
               
               
               
               case "seperator": { } break;
			   
			   case "old-seperator": { 
                
               ob_start();
               
               ?> 
            <div class="<?php echo $key; ?> <?php echo $key1; ?>">
               <?php echo $TEXT; ?>
               <?php echo $IMG; ?>
            </div>
            <?php $box_content = ob_get_clean(); ?>
            <?php  if(isset($item['t'])){ ?><label><?php echo $item['t']; ?></label><?php } ?>
            <div class="<?php echo $key; ?>-boxwrap"  >
               <ul class="nav nav-tabs flags mb-3  <?php echo $key; ?> 
                  <?php echo $key."".$key1; ?> mt-3" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" data-toggle="tab" data-language="en_us" href="#t1-<?php echo $key."".$key1; ?>" role="tab">
                        <div class="flag flag-us">&nbsp;</div>
                     </a>
                  </li>
                  <?php if(is_array(_ppt('languages') )){ foreach(_ppt('languages') as $lang){ $icon = explode("_",$lang); 
                     if(count(_ppt('languages')) > 1 && isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } 
                     
                     ?>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" data-language="<?php echo strtolower($lang); ?>" href="#<?php echo $key.$key1; ?>_<?php echo strtolower($lang); ?>" role="tab">
                        <div class="flag flag-<?php if(isset($icon[1])){ echo strtolower($icon[1]); }else{ echo $icon[0]; } ?>">&nbsp;</div>
                     </a>
                  </li>
                  <?php } } ?>
               </ul>
               <div class="tab-content" style="padding-top:0px;min-height:10px;border:0px; padding:0px; margin-top:20px;">
                  <div class="tab-pane active" data-language="en_us" id="t1-<?php echo $key.$key1; ?>" role="tabpanel" <?php if(_ppt('language_dropdown') == 0  ){ ?>style="display:block !important;"<?php } ?>> 
                     <?php echo $box_content; ?>    
                  </div>
                  <?php  
                     $done = array();
                     $canContinue = 1;
					 $lg = _ppt('languages'); 
                     if(_ppt('language_dropdown') == 1  &&   is_array($lg)   ){ 
                     
                     foreach(_ppt('languages') as $lang){ 
					 
                     	$icon = explode("_",$lang); 
						
                     	if(in_array($lang, $done)){ $canContinue = 0; }
                     
                    	if(isset($icon[1]) && strtolower($icon[1]) == "us"){ $canContinue =0; } 
                     
                     	$done[] = $lang;
                     
                     
					 if($canContinue){
                     ?>
                  <div class="tab-pane" data-language="<?php echo strtolower($lang); ?>" id="<?php echo $key.$key1; ?>_<?php echo strtolower($lang); ?>" role="tabpanel" <?php if(_ppt('language_dropdown') == 0 ){ ?>style="display:block !important;"<?php } ?>>
                     <?php echo str_replace("hdata_en_us","hdata_".strtolower($lang),$box_content); ?>
                  </div>
                  <?php 				  
				  }
				  
				  } 
				  
				  
				  }else{ ?> 
                  <script>
                     jQuery(document).ready(function(){ jQuery('.<?php echo $key; ?>-boxwrap .nav').hide(); });
                  </script>
                  <?php }  ?>
               </div>
            </div>
            <script>
               jQuery('.nav-tabs.<?php echo $key.$key1; ?> a').click(function (e) {
               
               	e.preventDefault();
                
               	clang = jQuery(this).data("language");
               
                 
                  jQuery(this).tab('show');
                 
               });
               
               
               jQuery(document).ready(function(){
               
               	jQuery('.nav a:first-child').tab('show');	
               
               	jQuery('. .tab-pane').each(function(i, obj) {
               	
               		var tab_lang = jQuery(obj).data("language");
                		var tab_id = jQuery(obj).attr("id");
                  
               		jQuery('#'+tab_id+' .form-control').each(function(i, obj1) {
                			
               			if(typeof jQuery(obj1).data(tab_lang) != 'undefined'  ){
                			jQuery(obj1).val(jQuery(obj1).data(tab_lang)); 
               			}
                
               		});
               		
               		jQuery('#'+tab_id+' .form-image-data').each(function(i, obj1) {
                			
               			 //console.log(tab_lang);
               			 
               			if(tab_lang != "" && typeof jQuery(obj1).data(tab_lang) != 'undefined'  ){
                			jQuery('#'+tab_id+' .form-image').attr('src', (jQuery(obj1).data(tab_lang)) ); 
                			}
               			
               		});
               		
               		
               		
                
               	});
               	
               });
            </script>
            <?php
               $TEXT 	= "";
               $IMG 	= ""; 
               
               
               } break; 
               
               
               case "upload": { 
               
               ob_start();
               
               ?> 
           
            <input type="hidden" 
               id="up_<?php echo $key."".$key1; ?>_hdata_en_us_aid" 
               name="admin_values[hdata_en_us][<?php echo $key; ?>][<?php echo $key1; ?>_aid]" 
               class="form-control"
               <?php $HDATA = _ppt('hdata_en_us'); ?>
               data-en_us="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"  
               <?php if(is_array(_ppt('languages') )){ foreach(_ppt('languages') as $lang){ $icon = explode("_",$lang); if(isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } ?>
               <?php $HDATA = _ppt('hdata_'.strtolower($lang)); ?>
               data-<?php echo strtolower($lang); ?>="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"
               <?php } } ?>
               value=""  />                
            <input 
               name="admin_values[hdata_en_us][<?php echo $key; ?>][<?php echo $key1; ?>]" 
               type="hidden" 
               id="up_<?php echo $key."".$key1; ?>_hdata_en_us" 
               value=""
               class="form-control form-image-data"
               <?php $HDATA = _ppt('hdata_en_us'); ?>
               data-en_us="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"  
               <?php if(is_array(_ppt('languages') )){ foreach(_ppt('languages') as $lang){ $icon = explode("_",$lang); if(isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } ?>
               <?php $HDATA = _ppt('hdata_'.strtolower($lang)); ?>
               data-<?php echo strtolower($lang); ?>="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"
               <?php } } ?>
               />
            <div class="pptselectbox mb-3 bg-dark p-5 text-center" style="padding:5px;">
               <img src="<?php echo $CORE->homeCotent($key, $key1); ?>" style="max-width:100%; max-height:300px;" class="form-image" id="<?php echo $key."".$key1; ?>_preview_hdata_en_us" />   
            </div>
            <div class="pptselectbtns mb-5 bg-light text-center py-2">
               <a href="<?php if(isset($HDATA[$key][$key1])){ echo $HDATA[$key][$key1]; } ?>" target="_blank" class="btn rounded-0 btn-secondary ml-4">View </a>
               <a href="javascript:void(0);"id="editImg<?php echo $key."".$key1; ?>_hdata_en_us" class="btn rounded-0 btn-info mr-3">Edit </a>  
               <a href="javascript:void(0);" id="upload_<?php echo $key."".$key1; ?>_hdata_en_us" class="btn rounded-0 btn-warning">Change </a>
               <a href="javascript:void(0);" onclick="jQuery('#up_<?php echo $key."".$key1; ?>_hdata_en_us').val('');document.admin_save_form.submit();" class="btn rounded-0 btn-danger">Delete</a>
            </div>
            <script >
               jQuery(document).ready(function () {
               
                   jQuery('#editImg<?php echo $key."".$key1; ?>_hdata_en_us').click(function() {           
                                
                       tb_show('', 'media.php?attachment_id=<?php if(isset($HDATA[$key][$key1."_aid"])){ echo $HDATA[$key][$key1."_aid"]; } ?>&action=edit&amp;TB_iframe=true');
                                    
                       return false;
                   });
                   
                   jQuery('#upload_<?php echo $key."".$key1; ?>_hdata_en_us').click(function() {           
                   
                       ChangeAIDBlock('up_<?php echo $key."".$key1; ?>_hdata_en_us_aid');
                       ChangeImgBlock('up_<?php echo $key."".$key1; ?>_hdata_en_us');		
                       ChangeImgPreviewBlock('<?php echo $key."".$key1; ?>_preview_hdata_en_us')
                       
                       formfield = jQuery('#up_<?php echo $key."".$key1; ?>_hdata_en_us').attr('name');
                    
                       tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                           return false;
                   });
                                   
               });	
            </script>
            <?php 
           
		   echo ob_get_clean();
			    
               
               } break; 
               
			   case "text": {
               
               ob_start();
                ?>    
          
            <div class="form-group">
               <input type="text" 
                  name="admin_values[hdata_en_us][<?php echo $key; ?>][<?php echo $key1; ?>]" 
                  value="" 
                  <?php $HDATA = _ppt('hdata_en_us'); ?>
                  data-en_us="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"  
                  <?php if(is_array(_ppt('languages') )){ foreach(_ppt('languages') as $lang){ $icon = explode("_",$lang); if(isset($icon[1]) && strtolower($icon[1]) == "us"){ continue; } ?>
                  <?php $HDATA = _ppt('hdata_'.strtolower($lang)); ?>
                  data-<?php echo strtolower($lang); ?>="<?php if(!isset($HDATA[$key][$key1]) || isset($HDATA[$key][$key1]) && $HDATA[$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($HDATA[$key][$key1]); } ?>"
                  <?php } } ?>
                  class="form-control">
            </div>
            <?php 
            
			echo ob_get_clean();
               
               }  
               
               
               
               
               } // end swiutch 
            
               
                ?> 
                
                </div>
                
            <?php } ?>  
         
      </div>
   </div>
</div></div>
<?php $i++; // LOOP 
 }   ?>




</div>
 
<script>
jQuery(document).ready(function(){
 
	 
		var tab_lang = "en_us";
 		 
		jQuery('#edithomepagewrap .form-control').each(function(i, obj1) {
 			
			if(typeof jQuery(obj1).data(tab_lang) != 'undefined'  ){
 			jQuery(obj1).val(jQuery(obj1).data(tab_lang)); 
			}
 
		});  
  
	
});
</script>