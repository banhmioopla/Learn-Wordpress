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
    
   // GET PAGES
   $pages = get_pages();
   
   // GET SAVED DATA
   $p = _ppt('pageassign');
      
   ?>  
  
   
<div class="row">
<div class="col-md-8">



<div class="bg-white p-3 shadow" style="border-radius: 7px;">
<div class="accordion" id="accordionExample">


<?php if(!defined('NOHOMEPAGECONTENT')){ ?>
    <div class="card-header" id="headingZero">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseZero" aria-expanded="true" aria-controls="collapseZero">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/0.png" class="title-img">
          <div class="title">Homepage Content</div>
        </button>
      </h2>
    </div>    


    <div id="collapseZero" class="collapse" aria-labelledby="headingZero" data-parent="#accordionExample">
      <div class="card-body">
      
      
 <?php if(_ppt(array('pageassign','homepage')) != ""){ ?>
  <div class="alert alert-danger">
     
     <strong>Hold On!</strong> You've set your homepage to display your Elementor - options below will not display on your website.
     
     </div>
 
<?php } ?>

      
      <div class="alert alert-warning">
      
      <strong>Note:</strong> This area is designed to help you make basic changes to the existing homepage design. 
      
      If you want to fully customize the design, add/remove sections, please use the
      
      <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#pagebuilder]').tab('show');jQuery('.ShowThisTab').val('pagebuilder');jQuery('#savebutton123').hide();" style="font-weight:bold; color:blue;">Elementor page builder tool.</a>
      </div>
      
      <?php get_template_part('framework/admin/templates/admin', '15-homeedit' ); ?>
      
      
      </div>
   </div>
<?php } ?>




   
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/1.png" class="title-img">
          <div class="title">Logo &amp; Colors</div>
        </button>
      </h2>
    </div>    


    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      
      
      
      
      
      <div class="tabheader">      
         <h4><span>Logo Design</span></h4>        
      </div>
      <div class="row mt-4">
         <div class="col-lg-6 mb-4 mb-lg-0">
            <input type="hidden" 
               id="up_logo_url_aid" 
               name="admin_values[logo_url_aid]" 
               value="<?php if(isset($core_admin_values["logo_url_aid"])){  echo stripslashes($core_admin_values["logo_url_aid"]); } ?>"  />                
            <input 
               name="admin_values[logo_url]" 
               type="hidden" 
               id="up_logo_url" 
               value="<?php if(_ppt('logo_url') != ""){  echo stripslashes($core_admin_values['logo_url']); } ?>" />
            <?php if(substr(_ppt('logo_url'),0,4) == "http"){ ?>
            <div class="pptselectbox bg-light p-5 text-center  mb-2 border">
               <img src="<?php echo _ppt('logo_url'); ?>" style="max-width:100%; max-height:300px;" id="logo_url_preview" />   
            </div>
            <div class="pptselectbtns">
               <a href="<?php if(_ppt('logo_url') != ""){ echo $core_admin_values['logo_url']; } ?>" target="_blank" class="btn btn-secondary  rounded-0" style="font-size: 10px;">View </a>
               <a href="javascript:void(0);"id="editImg_logo_url" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Edit </a>
               <a href="javascript:void(0);" id="upload_logo_url" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Change </a>
               <a href="javascript:void(0);" onclick="jQuery('#up_logo_url').val('');document.admin_save_form.submit();" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Delete</a>
            </div>
            <?php }else{ ?>
            <div class="pptselectbox bg-dark p-5 text-center  mb-2">
               <a href="javascript:void(0);" id="upload_logo_url">
                  <div>select image</div>
                  <div>.jpeg/ .png</div>
               </a>
            </div>
            <?php } ?>
            <script >
               jQuery(document).ready(function () {
               
               	jQuery('#editImg_logo_url').click(function() {           
               			   	 
               		tb_show('', 'media.php?attachment_id=<?php echo _ppt("logo_url_aid"); ?>&action=edit&amp;TB_iframe=true');
               					 
               		return false;
               	});
               	
               	jQuery('#upload_logo_url').click(function() {           
               	
               		ChangeAIDBlock('up_logo_url_aid');
               		ChangeImgBlock('up_logo_url');		
               		ChangeImgPreviewBlock('logo_url_preview')
               		
               		formfield = jQuery('#up_logo_url').attr('name');
               	 
               		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
               			return false;
               	});
               					
               });	
            </script>         
         </div>
         <div class="col-lg-6 mb-4 mb-lg-0">
            <input type="hidden" 
               id="up_light_logo_url_aid" 
               name="admin_values[light_logo_url_aid]" 
               value="<?php if(isset($core_admin_values["light_logo_url_aid"])){  echo stripslashes($core_admin_values["light_logo_url_aid"]); } ?>"  />                
            <input 
               name="admin_values[light_logo_url]" 
               type="hidden" 
               id="up_light_logo_url" 
               value="<?php if(isset($core_admin_values['light_logo_url']) && $core_admin_values['light_logo_url'] != ""){  echo stripslashes($core_admin_values['light_logo_url']); } ?>" />
            <?php if(isset($core_admin_values['light_logo_url']) && substr($core_admin_values['light_logo_url'],0,4) == "http"){ ?>
            <div class="pptselectbox bg-dark p-5 text-center  mb-2">
               <img src="<?php echo $core_admin_values['light_logo_url']; ?>" style="max-width:100%; max-height:300px;" id="light_logo_url_preview" />   
            </div>
            <div class="pptselectbtns">
               <a href="<?php if(isset($core_admin_values['light_logo_url'])){ echo $core_admin_values['light_logo_url']; } ?>" target="_blank" class="btn btn-secondary  rounded-0" style="font-size: 10px;">View </a>
               <a href="javascript:void(0);"id="editImg_light_logo_url" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Edit </a>
               <a href="javascript:void(0);" id="upload_light_logo_url" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Change </a>
               <a href="javascript:void(0);" onclick="jQuery('#up_light_logo_url').val('');document.admin_save_form.submit();" class="btn btn-secondary  rounded-0" style="font-size: 10px;">Delete</a>
            </div>
            <?php }else{ ?>
            <div class="pptselectbox bg-dark p-5 text-center  mb-2">
               <a href="javascript:void(0);" id="upload_light_logo_url" class="btn">
                  <div>select image</div>
                  <div>.jpeg/ .png</div>
               </a>
            </div>
            <?php } ?>
            <script >
               jQuery(document).ready(function () {
               
               	jQuery('#editImg_light_logo_url').click(function() {           
               			   	 
               		tb_show('', 'media.php?attachment_id=<?php echo _ppt("light_logo_url_aid"); ?>&action=edit&amp;TB_iframe=true');
               					 
               		return false;
               	});
               	
               	jQuery('#upload_light_logo_url').click(function() {           
               	
               		ChangeAIDBlock('up_light_logo_url_aid');
               		ChangeImgBlock('up_light_logo_url');		
               		ChangeImgPreviewBlock('light_logo_url_preview')
               		
               		formfield = jQuery('#up_light_logo_url').attr('name');
               	 
               		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
               			return false;
               	});
               					
               });	
            </script>     
         </div>
      </div>
        
           
   <div class="tabheader mt-4">
         <h4><span>Main Colors</span></h4>
      </div>
      
      


  
   <script>
   jQuery(document).ready(function(){
		jQuery('.myColorPicker').colorPickerByGiro({
			preview: '.myColorPicker-preview'
		});
		 
	});
	</script>
<div class="row py-3">
<div class="col-6">

   <label class="txt500">Primary Color</label>
   
   <div class="input-group myColorPicker">
					  <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
					  <input type="text" class="form-control" name="admin_values[color_primary]" value="<?php echo _ppt('color_primary'); ?>">
					</div>
   
   

</div>
<div class="col-6">

<label class="txt500">Secondary Color</label>
  
  
   <div class="input-group myColorPicker">
					  <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
					  <input type="text" class="form-control" name="admin_values[color_secondary]" value="<?php echo _ppt('color_secondary'); ?>">
					</div>

</div>
</div> 
      
<?php if(THEME_KEY == "da"){ ?>  
<div class="row py-3 mt-4">
<div class="col-6">

   <label class="txt500">Male Profile Color</label>
   
   <div class="input-group myColorPicker">
					  <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
					  <input type="text" class="form-control" name="admin_values[color_male]" value="<?php echo _ppt('color_male'); ?>">
					</div>
   
   

</div>
<div class="col-6">

<label class="txt500">Female Profile Color</label>
  
  
   <div class="input-group myColorPicker">
					  <span class="input-group-addon myColorPicker-preview px-3 border mr-2">&nbsp;</span>
					  <input type="text" class="form-control" name="admin_values[color_female]" value="<?php echo _ppt('color_female'); ?>">
					</div>

</div>
</div> 
<?php } ?>           
      
      
      
      
      
      
      </div>
    </div>
    
    
    <div class="card-header" id="headingLayout">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseLayout" aria-expanded="false" aria-controls="collapseLayout">
          
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/2.png" class="title-img">
          <div class="title">Layout</div>
          
          
        </button>
      </h2>
    </div>
    
    
    <div id="collapseLayout" class="collapse" aria-labelledby="headingLayout" data-parent="#accordionExample">
      <div class="card-body">
      
         <!-- ------------------------- -->    
      <div class="tabheader mt-3">
         <h4><span>Page Layout</span></h4>
      </div>
      
        
      <?php $ha2 = array(
	  
         0 => array("id" => "1", "name" => "Boxed Layout", "icon" => "boxed.png" ),
         1 => array("id" => "2", "name" => "Fluid Layout", "icon" => "fluid.png"),
         
         ); ?>
      <style>
         #page_layout .shadow { border:2px solid #76bd70 !important;     box-shadow: none !important; }
      </style>
      <div class="row" id="page_layout">
         <?php foreach($ha2 as $key => $h){ ?>
         <div class="col-4 text-center offset-md-1">
            <div class="py-4">
               <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/<?php echo $h['icon']; ?>" style="cursor:pointer;" class="border mb-1 img-fluid <?php if(_ppt('page_layout') == $h['id']){ echo "shadow"; } ?>" onclick="jQuery('#page_layout img').removeClass('shadow');jQuery(this).addClass('shadow');jQuery('#header_page_layout').val('<?php echo $h['id']; ?>');" />
               <small class="text-muted text-uppercase" style="font-size:11px;"><?php echo $h['name']; ?></small>
            </div>
         </div>
         <?php } ?>
         <input 
            name="admin_values[page_layout]" 
            type="hidden" 
            id="header_page_layout" 
            value="<?php if(_ppt('page_layout') != ""){  echo stripslashes($core_admin_values['page_layout']); }else{ echo 0; } ?>" />
      </div>   
   
      
      
      </div>
    </div>
 
  
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/3.png" class="title-img">
          <div class="title">Header</div>
          
          
        </button>
      </h2>
    </div>
    
    
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
      
      
      
      
      
      
      
       <!-- ------------------------- -->    
      <div class="tabheader mt-3">
         <h4><span>Header Layout</span></h4>
      </div>
      
      <?php if( _ppt(array('pageassign','header')) != ""){  ?>
      <div class="alert alert-info p-3 rounded-0 mt-3">
      <strong>Elementor Template Selected.</strong>
      <div class="small">You've selected a header template under the page linking tab. <br />Some settings below may not work with your website design.</div>
      </div>
      <?php } ?>
      
      <?php $ha = array(
         0 => array("id" => "0", "name" => "Child Theme Design", "icon" => "h1.jpg"),
         
         
         1 => array("id" => "1", "name" => "Classic", "icon" => "h2.jpg"),
         2 => array("id" => "2", "name" => "Transparent", "icon" => "h3.jpg"),
         3 => array("id" => "3", "name" => "Magazine", "icon" => "h4.jpg"),
         
         
         4 => array("id" => "4", "name" => "Search Basic", "icon" => "h5.jpg"),
         5 => array("id" => "5", "name" => "Search + Favs", "icon" => "h6.jpg"),
         6 => array("id" => "6", "name" => "Search + Login", "icon" => "h7.jpg"),
         7 => array("id" => "7", "name" => "Search + Icons", "icon" => "h8.jpg"),
         
         8 => array("id" => "8", "name" => "Centered", "icon" => "h9.jpg"),
         9 => array("id" => "9", "name" => "Simple", "icon" => "h10.jpg"),	
         
         10 => array("id" => "10", "name" => "Creative", "icon" => "h11.jpg"),
         11 => array("id" => "11", "name" => "Creative - Right", "icon" => "h12.jpg"),
          
         ); ?>
      <style>
         #headerdesigins .shadow { border:2px solid #76bd70 !important;     box-shadow: none !important; }
      </style>
      <div class="row" id="headerdesigins">
         <?php foreach($ha as $key => $h){ ?>
         <div class="col-4 text-center">
            <div class="py-4">
               <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/<?php echo $h['icon']; ?>" style="cursor:pointer;" class="border mb-1 img-fluid <?php if(_ppt('header_style') == $h['id']){ echo "shadow"; } ?>" onclick="jQuery('#headerdesigins img').removeClass('shadow');jQuery(this).addClass('shadow');jQuery('#header_style').val('<?php echo $h['id']; ?>');" />
               <small class="text-muted text-uppercase" style="font-size:11px;"><?php echo $h['name']; ?></small>
            </div>
         </div>
         <?php } ?>
         <input 
            name="admin_values[header_style]" 
            type="hidden" 
            id="header_style" 
            value="<?php if(_ppt('header_style') != ""){  echo stripslashes($core_admin_values['header_style']); }else{ echo 0; } ?>" />
      </div>
      
      <div class="mt-3 p-3 text-white" style="background:#0259a5; ">
      <div class="row">
      <div class="col-9 ">
      <u>Transparent</u> Header on Homepage
      </div>
      
      <div class="col-3">
          <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('header_hometransparent').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('header_hometransparent').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('header_hometransparent') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no text-dark">OFF</div>
            </div>
      </div>        
   <input type="hidden" id="header_hometransparent" name="admin_values[header_hometransparent]" value="<?php if(_ppt('header_hometransparent') == ""){ echo 0; }else{ echo _ppt('header_hometransparent'); } ?>">
      
      
      </div> </div>
      
      
      
      
      
      <div class="tabheader mt-5">
         <h4><span>Top Navigation </span></h4>
      </div>
      
          <?php if(_ppt('header_style') == 0){ ?>
   <div class="alert alert-success rounded-0 small my-4">
   
   <b>Note</b> You've set the <u>header design</u> to 'Child Theme Design'. Top Navigation options may not work because the child theme may have it's own fixed settings.
   
   </div>  
   <?php } ?>
   
   <div class="row">
   <div class="col-md-6">
   
   <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/help1.png" class="img-fluid" />
   
   </div>
   <div class="col-md-6">
   
      <!-- -->
      <div class="row py-2 mt-4">
         <div class="col-md-6">
            <label class="small text-uppercase">Top Nav</label>
         </div>
         <div class="col-md-6">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('header_topnav').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('header_topnav').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('header_topnav') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
             
   <input type="hidden" id="header_topnav" name="admin_values[header_topnav]" value="<?php echo _ppt('header_topnav'); ?>">
         </div>
      </div>
      
     
      <!-- -->
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Top Nav - Style</label>
         </div>
         <div class="col-md-6">
            <select name="admin_values[header_topnavstyle]" class="chzn-select" style="width:100%;">
               <option value="header-top1" <?php if(_ppt('header_topnavstyle') == "header-top1"){ ?>selected=selected<?php } ?>>Style 1</option>
               <option value="header-top2" <?php if(_ppt('header_topnavstyle') == "header-top2"){ ?>selected=selected<?php } ?>>Style 2</option>
               <option value="header-top3" <?php if(_ppt('header_topnavstyle') == "header-top3"){ ?>selected=selected<?php } ?>>Style 3</option>
               <option value="header-top4" <?php if(_ppt('header_topnavstyle') == "header-top4"){ ?>selected=selected<?php } ?>>Style 4</option>
            </select>
            
          <div class="text-muted small mt-3">
         <input type="hidden" name="admin_values[header_topnavborderbottom]" value="0" />
         <input type="checkbox" name="admin_values[header_topnavborderbottom]" value="1" <?php if(_ppt('header_topnavborderbottom') == 1){ ?>checked=checked<?php } ?> /> Border Bottom
         </div>
          <div class="text-muted small">
          <input type="hidden" name="admin_values[header_topnavhome]" value="0" />
         <input type="checkbox" name="admin_values[header_topnavhome]" value="1" <?php if(_ppt('header_topnavhome') == 1){ ?>checked=checked<?php } ?> />  Show on Homepage        
         </div>
         
         </div>
      </div>
      
      <!-- -->
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Top Nav - Background</label>
         </div>
         <div class="col-md-6">
            <select name="admin_values[header_topnavbg]" class="chzn-select" style="width:100%;">
               <option value="default" <?php if(_ppt('header_topnavbg') == "default"){ ?>selected=selected<?php } ?>>default color</option>
               <option value="bg-dark" <?php if(_ppt('header_topnavbg') == "bg-dark"){ ?>selected=selected<?php } ?>>dark color</option>
               <option value="bg-light" <?php if(_ppt('header_topnavbg') == "bg-light"){ ?>selected=selected<?php } ?>>light color</option>
               <option value="bg-white" <?php if(_ppt('header_topnavbg') == "bg-white"){ ?>selected=selected<?php } ?>>white color</option>
               <option value="bg-primary" <?php if(_ppt('header_topnavbg') == "bg-primary"){ ?>selected=selected<?php } ?>>primary color</option>
               <option value="bg-secondary" <?php if(_ppt('header_topnavbg') == "bg-secondary"){ ?>selected=selected<?php } ?>>secondary color</option>
            </select>
         </div>
      </div>
    
    </div>
    </div>
      
      
      <!-- -->
      <div class="tabheader my-4">
         <h4><span>Main Navigation </span></h4>
      </div>
      <!-- -->
      
   <div class="row">
   <div class="col-md-6">
   
   <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/help2.png" class="img-fluid" />
   
   </div>
   <div class="col-md-6">
      
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Logo - Background</label>
         </div>
         <div class="col-md-6">
            <select class="chzn-select" style="width:100%;" name="admin_values[header_bg]">
               <option value="default" <?php if(_ppt('header_bg') == "default"){ ?>selected=selected<?php } ?>>default</option>
               <option value="bg-dark" <?php if(_ppt('header_bg') == "bg-dark"){ ?>selected=selected<?php } ?>>dark</option>
               <option value="bg-light" <?php if(_ppt('header_bg') == "bg-light"){ ?>selected=selected<?php } ?>>light</option>
               <option value="bg-white" <?php if(_ppt('header_bg') == "bg-white"){ ?>selected=selected<?php } ?>>white color</option>
               <option value="bg-primary" <?php if(_ppt('header_bg') == "bg-primary"){ ?>selected=selected<?php } ?>>primary color</option>
               <option value="bg-secondary" <?php if(_ppt('header_bg') == "bg-secondary"){ ?>selected=selected<?php } ?>>secondary color</option>
            </select>
         </div>
      </div>
      <!-- -->
      <!-- -->
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Logo - Styling</label>
         </div>
         <div class="col-md-6">
            <div class="text-muted small">
               <input type="hidden" name="admin_values[header_shadow]" value="0" />
               <input type="checkbox" name="admin_values[header_shadow]" value="1" <?php if(_ppt('header_shadow') == 1){ ?>checked=checked<?php } ?> /> Bottom Shadow     
            </div>
            <div class="text-muted small">
               <input type="hidden" name="admin_values[header_sep]" value="0" />
               <input type="checkbox" name="admin_values[header_sep]" value="1" <?php if(_ppt('header_sep') == 1){ ?>checked=checked<?php } ?> /> 
               Link Separator
            </div>
            <div class="text-muted small">
               <input type="hidden" name="admin_values[header_borderbottom]" value="0" />
               <input type="checkbox" name="admin_values[header_borderbottom]" value="1" <?php if(_ppt('header_borderbottom') == 1){ ?>checked=checked<?php } ?> /> Border Bottom
            </div>
            <div class="text-muted small">     
               <?php if(_ppt('header_style') == 1){ ?>    
               <input type="hidden" name="admin_values[header_borderbottom_home]" value="0" />
               <input type="checkbox" name="admin_values[header_borderbottom_home]" value="1" <?php if(_ppt('header_borderbottom_home') == 1){ ?>checked=checked<?php } ?> /> Border Bottom (home)
               <?php } ?>
            </div>
            
         </div>
      </div>
      <!-- -->
      <!-- -->
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Menu - Background</label>
         </div>
         <div class="col-md-6">
            <select class="chzn-select" style="width:100%;" name="admin_values[headernav_bg]">
               <option value="default" <?php if(_ppt('headernav_bg') == "default"){ ?>selected=selected<?php } ?>>default</option>
               <option value="bg-dark" <?php if(_ppt('headernav_bg') == "bg-dark"){ ?>selected=selected<?php } ?>>dark</option>
               <option value="bg-light" <?php if(_ppt('headernav_bg') == "bg-light"){ ?>selected=selected<?php } ?>>light</option>
               <option value="bg-white" <?php if(_ppt('headernav_bg') == "bg-white"){ ?>selected=selected<?php } ?>>white color</option>
               <option value="bg-primary" <?php if(_ppt('headernav_bg') == "bg-primary"){ ?>selected=selected<?php } ?>>primary color</option>
               <option value="bg-secondary" <?php if(_ppt('headernav_bg') == "bg-secondary"){ ?>selected=selected<?php } ?>>secondary color</option>
            </select>
         </div>
      </div>
      <!-- -->
      <!-- -->
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Menu - Button</label>
         </div>
         <div class="col-md-6">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('header_button').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('header_button').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('header_button') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
            <input type="hidden" id="header_button" name="admin_values[header_button]" 
               value="<?php if(_ppt('header_button') == ""){ echo 0; }else{ echo _ppt('header_button'); } ?>"> 
         </div>
      </div>
      <!-- -->
      <!-- -->
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Menu - Button Text</label>
         </div>
         <div class="col-md-6">
            <input type="text" class="form-control form-control-sm rounded-0" id="header_buttontext" name="admin_values[header_buttontext]"  value="<?php if(_ppt('header_buttontext') == ""){ echo "Post Ad"; }else{ echo stripslashes(_ppt('header_buttontext')); } ?>"> 
         </div>
      </div>
      
 
      
</div></div>    
      
      
      
      
      
      
      
      
      
      
      
      
      </div>
    </div>
    
    
    
    
    
    
<?php if(!in_array(THEME_KEY, array('ph','cp' )) ){ ?>
     <div class="card-header" id="headingSearch">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
         
           <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/4.png" class="title-img">
          <div class="title">Search</div>
          
         
        </button>
      </h2>
    </div>
    <div id="collapseSearch" class="collapse" aria-labelledby="headingSearch" data-parent="#accordionExample">
      <div class="card-body">
      
      
  <!-- ------------------------- -->    
<div class="tabheader mt-3">
	<h4><span>Search Box Display</span></h4>
    
</div>    
        
        
        
      <?php $ha1 = array(
	  
        0 => array("id" => "1", "name" => "Style 1", "icon" => "ss1.png" ),
        1 => array("id" => "2", "name" => "Style 2", "icon" => "ss2.png"),
        2 => array("id" => "3", "name" => "Style 3", "icon" => "ss3.png"),
       	3 => array("id" => "4", "name" => "Style 4", "icon" => "ss4.png"),
      
          
         ); ?>
      <style>
         #search_item_style .shadow { border:2px solid #76bd70 !important;     box-shadow: none !important; }
      </style>
      <div class="row" id="search_item_style">
         <?php foreach($ha1 as $key => $h){ ?>
         <div class="col-3 text-center">
            <div class="py-4">
               <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/<?php echo $h['icon']; ?>" style="cursor:pointer;" class="border mb-1 img-fluid <?php if(_ppt('search_item_style') == $h['id']){ echo "shadow"; } ?>" onclick="jQuery('#search_item_style img').removeClass('shadow');jQuery(this).addClass('shadow');jQuery('#header_search_item_style').val('<?php echo $h['id']; ?>');" />
               <small class="text-muted text-uppercase" style="font-size:11px;"><?php echo $h['name']; ?></small>
            </div>
         </div>
         <?php } ?>
         <input 
            name="admin_values[search_item_style]" 
            type="hidden" 
            id="header_search_item_style" 
            value="<?php if(_ppt('search_item_style') != ""){  echo stripslashes($core_admin_values['search_item_style']); }else{ echo 0; } ?>" />
      </div>
      
      
      
      <div class="tabheader mt-2">
         <h4><span>Grid View Settings</span></h4>
      </div>
 
   
   <div class="row">
   <div class="col-md-6">
   
   <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/help5.png" class="img-fluid" />
   
   </div>
   <div class="col-md-6">
   
   
          <!-- -->
      <div class="row py-2">
         <div class="col-12">
            <label class="small text-uppercase font-weight-bold">Hide Title</label>
            
         </div>
         <div class="col-12">
         <p>Turn on/off the title on the small list view.</p>
         </div>
         <div class="col-md-6">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('search_title').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('search_title').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('search_title') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
             
   <input type="hidden" id="search_title" name="admin_values[search_title]" value="<?php echo _ppt('search_title'); ?>">
         </div>
      </div>
      
      <!-- -->
      <div class="row py-2">
         <div class="col-12">
            <label class="small text-uppercase font-weight-bold">Portait Mode</label>
          
         </div>
         <div class="col-12">
           <p>Change the display setup to suit portait images.</p>
         </div>
         <div class="col-md-6">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('search_image_style').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('search_image_style').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('search_image_style') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
             
   <input type="hidden" id="search_image_style" name="admin_values[search_image_style]" value="<?php echo _ppt('search_image_style'); ?>">
         </div>
      </div>
      
      
       <!-- -->
      <div class="row py-2">
         <div class="col-12">
            <label class="small text-uppercase font-weight-bold">Hide Bottom Section</label>
            
         </div>
         <div class="col-12">
         <p>Turn on/off the bottom section.</p>
         </div>
         <div class="col-md-6">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('search_image_bottom').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('search_image_bottom').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('search_image_bottom') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
             
   <input type="hidden" id="search_image_bottom" name="admin_values[search_image_bottom]" value="<?php echo _ppt('search_image_bottom'); ?>">
         </div>
      </div>
      </div> </div> 
      
 </div>
 
 </div>     
      
<?php } ?>      
      
  
 
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
         
           <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/5.png" class="title-img">
          <div class="title">Footer</div>
          
         
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">



      
      <div class="tabheader mt-4">
         <h4><span>Footer Design</span></h4>
      </div>
      
        
         <?php if(_ppt('footer_blockstyle') == 0){ ?>
   <div class="alert alert-success rounded-0 small my-4">
   
   <b>Note</b> You've set the <u>footer design</u> to 'Child Theme Design'. Footer display options may not work with this option enabled.
   
   </div>   <?php } ?>
   
      <!-- ------------------------- -->
      <?php $ha1 = array(
         0 => array("id" => "0", "name" => "Child Theme Design", "icon" => "ft0.jpg"),
         1 => array("id" => "1", "name" => "Newsletter", "icon" => "ft2.jpg"),
         2 => array("id" => "2", "name" => "Links + Newsletter", "icon" => "ft3.jpg"),
         3 => array("id" => "3", "name" => "Text + Links", "icon" => "ft4.jpg"),
         4 => array("id" => "4", "name" => "Text + Newsletter", "icon" => "ft5.jpg"),
         5 => array("id" => "5", "name" => "None", "icon" => "ft1.jpg"),
         ); ?>
      <style>
         #footerbdesigins .shadow { border:2px solid #76bd70 !important;     box-shadow: none !important; }
      </style>
      
      <h6 class="mt-4">Content Area</h6>
      
    
  
      
      <div class="row" id="footerbdesigins">
         <?php foreach($ha1 as $key => $h){ ?>
         <div class="col-4 text-center">
            <div class="py-4 pb-0">
               <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/<?php echo $h['icon']; ?>" style="cursor:pointer;" class="border mb-1 img-fluid <?php if(_ppt('footer_blockstyle') == $h['id']){ echo "shadow"; } ?>" onclick="jQuery('#footerbdesigins img').removeClass('shadow');jQuery(this).addClass('shadow');jQuery('#footer_blockstyle').val('<?php echo $h['id']; ?>');" />
               <small class="text-muted"><?php echo $h['name']; ?></small>
            </div>
         </div>
         <?php } ?>
         <input 
            name="admin_values[footer_blockstyle]" 
            type="hidden" 
            id="footer_blockstyle" 
            value="<?php if(_ppt('footer_blockstyle') != ""){  echo stripslashes(_ppt('footer_blockstyle')); }else{ echo 0; } ?>" />
      </div>
      <?php $ha = array(
         //0 => array("id" => "0", "name" => "&copy; Default", "icon" => "f1.jpg"),
		 2 => array("id" => "2", "name" => "&copy; Basic", "icon" => "f3.jpg"),
         1 => array("id" => "1", "name" => "&copy; Centered", "icon" => "f2.jpg"),
         3 => array("id" => "3", "name" => "&copy; Card Icons", "icon" => "f3.jpg"),
         
         
         ); ?>
      <style>
         #footerdesigins .shadow { border:2px solid #76bd70 !important;     box-shadow: none !important; }
      </style>
      
      <h6>Copyright Area</h6>
      <div class="row" id="footerdesigins">
         <?php foreach($ha as $key => $h){ ?>
         <div class="col-4 text-center">
            <div class="py-4 pb-0">
               <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/<?php echo $h['icon']; ?>" style="cursor:pointer;" class="border mb-1 img-fluid <?php if(_ppt('footer_style') == $h['id']){ echo "shadow"; } ?>" onclick="jQuery('#footerdesigins img').removeClass('shadow');jQuery(this).addClass('shadow');jQuery('#footer_style').val('<?php echo $h['id']; ?>');" />
               <small class="text-muted"><?php echo $h['name']; ?></small>
            </div>
         </div>
         <?php } ?>
         <input 
            name="admin_values[footer_style]" 
            type="hidden" 
            id="footer_style" 
            value="<?php if(_ppt('footer_style') != ""){  echo stripslashes(_ppt('footer_style')); }else{ echo 0; } ?>" />
      </div>
      
      
        
      <?php if( _ppt(array('pageassign','footer')) != ""){  ?>
      <div class="alert alert-info p-3 rounded-0 mt-3">
      <strong>Elementor Template Selected.</strong>
      <div class="small">You've selected a footer template under the page linking tab. <br />Some settings below may not work with your website design.</div>
      </div>
      <?php } ?>
      
      
      
   <div class="row">
   <div class="col-md-6">
   
   <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/help3.png" class="img-fluid" />
   
   </div>
   <div class="col-md-6">
      
      <!-- -->
      <div class="row py-2 mt-4">
         <div class="col-md-12">
            <label class="small text-uppercase">Background Color</label>
         </div>
         <div class="col-md-12">
            <select class="form-control rounded-0" style="width:100%;" name="admin_values[footer_bg]">
               <option value="default" <?php if(_ppt('footer_bg') == "default"){ ?>selected=selected<?php } ?>>default</option>
               <option value="bg-dark" <?php if(_ppt('footer_bg') == "bg-dark"){ ?>selected=selected<?php } ?>>dark</option>
               <option value="bg-light" <?php if(_ppt('footer_bg') == "bg-light"){ ?>selected=selected<?php } ?>>light</option>
               <option value="bg-white" <?php if(_ppt('footer_bg') == "bg-white"){ ?>selected=selected<?php } ?>>white color</option>
               <option value="bg-primary" <?php if(_ppt('footer_bg') == "bg-primary"){ ?>selected=selected<?php } ?>>primary</option>
               <option value="bg-secondary" <?php if(_ppt('footer_bg') == "bg-secondary"){ ?>selected=selected<?php } ?>>secondary</option>
            </select>
         </div>
      </div>
      <!-- -->      
      
 </div>
    </div>

      </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    <div class="card-header" id="heading4">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
           <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/6.png" class="title-img">
          <div class="title">Sidebar</div>
          
         
        </button>
      </h2>
    </div>
    <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
      <div class="card-body">
    
    
    
    
  <!-- ------------------------- -->    
<div class="tabheader mt-3">
	<h4><span>Sidebar Position</span></h4>
    
</div>    
        
        
        
      <?php $ha = array(
	  
         0 => array("id" => "2", "name" => "Left Sidebar", "icon" => "h11.jpg"),
         1 => array("id" => "3", "name" => "Right Sidebar", "icon" => "h12.jpg"),
         2 => array("id" => "1", "name" => "No Sidebar", "icon" => "h1.jpg"),
      
          
         ); ?>
      <style>
         #page_columns .shadow { border:2px solid #76bd70 !important;     box-shadow: none !important; }
      </style>
      <div class="row" id="page_columns">
         <?php foreach($ha as $key => $h){ ?>
         <div class="col-4 text-center">
            <div class="py-4">
               <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/<?php echo $h['icon']; ?>" style="cursor:pointer;" class="border mb-1 img-fluid <?php if(_ppt('page_columns') == $h['id']){ echo "shadow"; } ?>" onclick="jQuery('#page_columns img').removeClass('shadow');jQuery(this).addClass('shadow');jQuery('#header_page_columns').val('<?php echo $h['id']; ?>');" />
               <small class="text-muted text-uppercase" style="font-size:11px;"><?php echo $h['name']; ?></small>
            </div>
         </div>
         <?php } ?>
         <input 
            name="admin_values[page_columns]" 
            type="hidden" 
            id="header_page_columns" 
            value="<?php if(_ppt('page_columns') != ""){  echo stripslashes(_ppt('page_columns')); }else{ echo 0; } ?>" />
      </div>        
          
    
    
    
    
    
    
      </div>
    </div>    
    
    
    
    
    <div class="card-header" id="heading5">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
           <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/7.png" class="title-img">
          <div class="title">Breadcrumbs</div>
          
        </button>
      </h2>
    </div>
    <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
      <div class="card-body">


  
      <!-- -->
      <div class="tabheader my-4">
         <h4><span>Breadcrumb Design</span></h4>
      </div>
      <!-- -->
      
   <div class="row">
   <div class="col-md-6">
   
   <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/help4.png" class="img-fluid" />
   
   </div>
   <div class="col-md-6">
      
      
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Breadcrumbs</label>
         </div>
         <div class="col-md-6">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('breadcrumbs').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('breadcrumbs').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('breadcrumbs') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
         </div>
      </div>
      <!-- -->
      <!-- -->
      <div class="row py-2">
         <div class="col-md-6">
            <label class="small text-uppercase">Breadcrumbs - Style</label>
         </div>
         <div class="col-md-6">
            <input type="hidden" id="breadcrumbs" name="admin_values[breadcrumbs]" 
               value="<?php if(_ppt('breadcrumbs') == ""){ echo 0; }else{ echo _ppt('breadcrumbs');} ?>">
            <select class="chzn-select" style="width:100%;" name="admin_values[breadcrumbs_style]">
               <option value="1" <?php if(_ppt('breadcrumbs_style') == "1"){ ?>selected=selected<?php } ?>>Style 1</option>
               <option value="2" <?php if(_ppt('breadcrumbs_style') == "2"){ ?>selected=selected<?php } ?>>Style 2</option>
               <option value="3" <?php if(_ppt('breadcrumbs_style') == "3"){ ?>selected=selected<?php } ?>>Style 3</option>
               <option value="4" <?php if(_ppt('breadcrumbs_style') == "4"){ ?>selected=selected<?php } ?>>Style 4</option>
            </select>
         </div>
      </div>    
     
     
      </div>
    </div>    
    
    
     </div>
    </div>    
    
    
    
    
    
    
    <div class="card-header" id="headingCss">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseCss" aria-expanded="false" aria-controls="collapseCss">
          
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/a/8.png" class="title-img">
          <div class="title">CSS &amp; JS</div>
          
          
        </button>
      </h2>
    </div>
    
    
    <div id="collapseCss" class="collapse" aria-labelledby="headingCss" data-parent="#accordionExample">
      <div class="card-body">
      
      
      <!-- -->
      <div class="row py-2 mt-4">
         <div class="col-md-6">
            <label class="text-uppercase txt500">Combine CSS Files</label>
         </div>
         <div class="col-md-6">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('css_combine').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('css_combine').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('css_combine') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
             
   <input type="hidden" id="css_combine" name="admin_values[css_combine]" value="<?php echo _ppt('css_combine'); ?>">
         </div>
         
         <div class="col-12 my-4">
         
         Turn ON this feature if you want to combine all CSS files into the header fo your website. This is useful for SEO and speed improvements. <strong>Note</strong> Not all hosting providers support this, if you get errors please disable it.
         </div>
      </div>
      
      <hr />
      
      
    
    	<label>Custom CSS Code</label>
        <p> Here you can enter your own custom CSS/meta data that will appear between your &lt;HEAD&gt; tags.</p>
 
<textarea class="form-control" style="height:200px !important;font-size:11px;" name="adminArray[custom_head]"><?php echo stripslashes(get_option('custom_head')); ?></textarea>
<small><strong>Note:</strong>  tags &lt;style&gt; are already included so do not enter them above.</small> 
        
        <label class="mt-4">Custom JS Code</label>
        <p> Here you can enter your own javascript code, this will be displayed in your website footer.</p>
 
        
        <textarea class="form-control" style="height:200px !important;font-size:11px;" name="adminArray[custom_js]"><?php echo stripslashes(get_option('custom_js')); ?></textarea>
<small><strong>Note:</strong>  tags &lt;style&gt; are already included so do not enter them above.</small> 
  
        
    
       </div>
    </div>   
    
    
    
    
    
    
    
  </div> 
</div>

 

</div>

<div class="col-md-4">



   <div class="card1 shadow mb-3 bg-danger text-center p-5 mt-0">
      
       <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/15.png" width="86" height="86" class="" style="margin-top:-20px;" />
   
      
      <p class="text-white mt-3" style="font-size:16px;">You can also use the <br /> WordPress Customizer Tool.</p>
      <a href="customize.php?return=%2FV9%2Fwp-admin%2Fadmin.php%3Fpage%3D15" class="btn btn-dark ">Launch WP Customizer</a>
   </div>
   
   
    
    
 
   
   <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#pagebuilder]').tab('show');jQuery('.ShowThisTab').val('pagebuilder');jQuery('#savebutton123').hide();">
    <div class="card1 shadow my-1 mt-4  bg-primary p-4" style="height:110px;">
     
    <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/14.png" width="64" height="64" class="fa fa-cog text-white float-left mr-3" />
   
      <h4 class="text-white h5">Elementor Templates</h4>
      <p class="text-white" style="font-size:16px;">Drag-n-drop page editing.</p>  
   </div>  
   </a>
   
  
   
 
   
   <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#pageassign]').tab('show');jQuery('.ShowThisTab').val('pageassign');">
     <div class="card1 shadow my-1 mt-4  bg-success p-4" style="height:110px;">
     
   <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/3.png" width="64" height="64" class="fa fa-cog text-white float-left mr-3" />
    
      <h4 class="text-white">Page Linking</h4>
      <p class="text-white" style="font-size:16px;">Set custom page designs.</p>  
   </div> 
   </a> 
   
   <a href="themes.php?page=premiumpresschildthemes">
        <div class="card1 shadow my-1 mt-4  bg-dark p-4" style="height:110px;">
     
   <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/childthemes.png" width="64" height="64" class="fa fa-cog text-white float-left mr-3" />
   
   
      <h4 class="text-white">Child Themes</h4>
      <p class="text-white" style="font-size:16px;">Extra child theme designs.</p> 
       
   </div> 
   </a>


</div>

</div>