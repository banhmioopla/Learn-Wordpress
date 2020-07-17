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
   
   
   // LOAD IN MAIN DEFAULTS 
   $core_admin_values = get_option("core_admin_values");  
     
   ?> 
<div class="row">
   <div class="col-lg-6">
      <div class="bg-white p-5 shadow" style="border-radius: 7px;">
         <div class="tabheader mb-4">
            <a href="https://www.youtube.com/watch?v=w_NKFPwvt0I" class="btn btn-sm mb-4 btn-outline-dark float-right" target="_blank"><i class="fa fa-video-camera"></i> Video Tutorial</a>
            <h4><span>Search Settings</span></h4>
         </div>
         <?php if(in_array(THEME_KEY, array("dt"))){ ?>
         <div class="container px-0">
            <div class="row py-2">
               <div class="col-9">
                  <label class="txt500">Enable Google Maps</label>
                  <p class="text-muted">This will display a map of search results at the top of the page.</p>
               </div>
               <div class="col-3">
                  <div>
                     <label class="radio off">
                     <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('search_maps').value='0'">
                     </label>
                     <label class="radio on">
                     <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('search_maps').value='1'">
                     </label>
                     <div class="toggle <?php if(_ppt('search_maps') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                     </div>
                  </div>
                  <input type="hidden" id="search_maps" name="admin_values[search_maps]" 
                     value="<?php if(_ppt('search_maps') == ""){ echo 1; }else{ echo _ppt('search_maps'); } ?>">
               </div>
            </div>
         </div>
         <?php } ?>   
         
         
          
         <div class="container px-0">
            <div class="row py-2">
               <div class="col-9">
                  <label class="txt500">Featured Ribbon</label>
                  <p class="text-muted">This will display a red ribbon on featured listings.</p>
               </div>
               <div class="col-3">
                  <div>
                     <label class="radio off">
                     <input type="radio" name="toggle" 
                        value="off" onchange="document.getElementById('search_ribbon').value='0'">
                     </label>
                     <label class="radio on">
                     <input type="radio" name="toggle"
                        value="on" onchange="document.getElementById('search_ribbon').value='1'">
                     </label>
                     <div class="toggle <?php if(_ppt('search_ribbon') == '1'){  ?>on<?php } ?>">
                        <div class="yes">ON</div>
                        <div class="switch"></div>
                        <div class="no">OFF</div>
                     </div>
                  </div>
                  <input type="hidden" id="search_ribbon" name="admin_values[search_ribbon]" 
                     value="<?php if(_ppt('search_ribbon') == ""){ echo 1; }else{ echo _ppt('search_ribbon'); } ?>">
               </div>
            </div>
         </div>
       
         
      
          <div class="container px-0">
            <div class="row py-2">
               <div class="col-6">
                  <label class="txt500">Default Order By</label>
                  <p class="text-muted">The order of items on your search results page.</p>
               </div>
            
             
               <div class="col-6">
         
           <select name="admin_values[search_orderby]" class="chzn-select" id="default_orderby" style="width:200px;">
        <option value=""></option>     
     
        <option value="date" <?php selected( _ppt('search_orderby'), "date" ); ?>>Date</option>
      
        <option value="title" <?php selected( _ppt('search_orderby'), "title" ); ?>>Title</option>
        
        <option value="ID" <?php selected( _ppt('search_orderby'), "ID" ); ?>>Wordpress ID</option>
        
        
         <?php if(in_array(THEME_KEY, array('ct','mj','at','rt','sp'))){ ?>
         <option value="price" <?php selected( _ppt('search_orderby'), "price" ); ?>>Price</option>
		 <?php } ?>
         
          <option value="hits" <?php selected( _ppt('search_orderby'), "hits" ); ?>>Popularity</option>
       
          <option value="featured" <?php selected( _ppt('search_orderby'), "featured" ); ?>>Featured</option>
         
         
        </select>
                  
        <select name="admin_values[search_order]" class="chzn-select" id="default_order" style="width:200px;">
        <option value="desc" <?php selected( _ppt('search_order'), "desc" ); ?>>Ascending Order</option>     
        <option value="asc" <?php selected( _ppt('search_order'), "asc" ); ?>>Descending Order</option>
    
                  </select>
                  
                         
               </div>
            </div>
         </div>        
         
         
                                
         <div class="container px-0">
            <div class="row py-2">
               <div class="col-6">
                  <label class="txt500">Results Per Page</label>
                  <p class="text-muted">The number of search results to show per page.</p>
               </div>
               <div class="col-6">
                  <div class="input-group">        
                     <input type="text"  name="adminArray[posts_per_page]" class="form-control" value="<?php echo get_option('posts_per_page'); ?>">
                     <span class="add-on input-group-prepend"><span class="input-group-text">#</span></span>        
                  </div>
               </div>
               <div class="col-6 mt-3">
                  <label class="txt500">Taxonomy Search</label>
                  <p class="text-muted">Select taxonomies to be displayed on your search page.</p>
               </div>
               <div class="col-6">
                  <?php
                     $taxonomies = get_taxonomies(); 
                     foreach ( $taxonomies as $taxonomy ) {
                     
                     if(in_array($taxonomy, array('category','post_tag','nav_menu','link_category','post_format','listing','elementor_library_type','elementor_library_category',''))){ continue; } 
                     ?>
                  <div>
                     <input type="checkbox"  value="<?php echo $taxonomy; ?>" name="admin_values[searchtax][]" <?php if(is_array(_ppt('searchtax')) && in_array($taxonomy, _ppt('searchtax'))){ echo "checked=checked"; } ?> /> <?php echo $taxonomy; ?>
                  </div>
                  <?php } ?>                 
               </div>
            </div>
         </div>
         
         
   
 
         
         
         
         
         
         
         
         
         
         <?php
            // GET SAVED DAT
            $tax = get_option('custom_taxonomy');  
              
            ?> 
         <div class="tabheader my-4">
            <a href="javascript:void(0);" onclick="jQuery('#showmoretax').toggle();" class="btn btn-primary rounded-0 btn-sm float-right">show more</a>
            <h4><span>Custom Taxonomies</span></h4>
         </div>
         <div class="row">
            <div class="col-md-6 ">
               <label>Taxonomy 1 Key</label>
               <input class="form-control" type="text" name="adminArray[custom_taxonomy][0]" value="<?php if(isset($tax[0])){ echo $tax[0]; } ?>" rel="tooltip" data-original-title="Must NOT contain spaces. 3+ characters and NO foreign characters." data-placement="right" />             
            </div>
            <!---- FIELD --->
            <div class="col-md-6 ">
               <label>Taxonomy 2 Key</label>
               <input class="form-control" type="text" name="adminArray[custom_taxonomy][1]" value="<?php if(isset($tax[1])){ echo $tax[1]; } ?>" rel="tooltip" data-original-title="Must NOT contain spaces. 3+ characters and NO foreign characters." data-placement="right" />             
            </div>
            <!---- FIELD --->
         </div>
         <div id="showmoretax" style="display:none;">
            <div class="row mt-3">
               <?php $g=1; $i=2; while($i < 20){ ?>
               <!---- FIELD --->
               <div class="col-md-6 ">
                  <label>Taxonomy <?php echo ($i)+1; ?> Key</label>
                  <input class="form-control" type="text" name="adminArray[custom_taxonomy][<?php echo $i; ?>]" value="<?php if(isset($tax[$i])){ echo $tax[$i]; } ?>" rel="tooltip" data-original-title="Must NOT contain spaces. 3+ characters and NO foreign characters." data-placement="right" /> 
               </div>
               <!---- FIELD --->
               <?php if($g == 2){ $g = 0; echo "</div><div class='row mt-3'> "; } ?>
               <?php $i++; $g++; } ?>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-6">
      <?php echo get_template_part('framework/admin/templates/admin', '2-searchfilters' ); ?>
   </div>
</div>
<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">
   <button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 
</div>