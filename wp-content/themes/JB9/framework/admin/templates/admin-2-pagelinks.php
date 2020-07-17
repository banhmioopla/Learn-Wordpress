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

global $CORE;


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
  
?> 

<div class="row">

<div class="col-lg-6">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">

 <a href="https://www.youtube.com/watch?v=zI6mwtyUP2M" class="btn btn-sm mb-4 btn-outline-dark float-right" target="_blank"><i class="fa fa-video-camera"></i> Video Tutorial</a>
 


         <h4><span>Template Pages</span></h4>
      </div>

 
 
            <?php
			
			$default_page_links = array(
			"myaccount" => array("name" => "My Account", "desc" => ""),
			"callback" => array("name" => "Callback", "desc" => ""),
			"add" => array("name" => "Add Listing", "desc" => ""),
			//"search" => array("name" => "Advanced Search", "desc" => ""),
			"blog" => array("name" => "Blog", "desc" => ""),			
			"sellspace" => array("name" => "Advertising Page", "desc" => ""),			
			//"events" => array("name" => "Events Page"),
			"aboutus" => array("name" => "About Us Page", "desc" => ""),			
			"memberships" => array("name" => "Memberships", "desc" => ""),
			"contact" => array("name" => "Contact Form", "desc" => ""),
			"terms" => array("name" => "Terms &amp; Conditions Page", "desc" => ""),
			"privacy" => array("name" => "Privacy Page", "desc" => ""),	
			
			"faq" => array("name" => "FAQ Page", "desc" => ""),	
			"testimonials" => array("name" => "Testimonials Page", "desc" => ""),	
			
			"how" => array("name" => "How it works"),
			"top" => array("name" => "Top Listings"),
			
					
			);
			
			// REMOVE LINKS
			if(THEME_KEY == "sp"){
			unset($default_page_links['sellspace']);
			unset($default_page_links['memberships']);
			}
			
			$default_page_links = hook_admin_1_tab1_subtab2_pagelist($default_page_links);
			
			$pages = get_pages();  $i=1; 
			
			
			?>
            <div class="row">
            <?php
			foreach($default_page_links as $k=>$v){ ?>         

   
      <div class="col-6 py-2">
         <label class="txt500"> <?php echo $v['name']; ?> 
         <?php if(_ppt(array('links',$k)) == ""){ ?>
         <i class="fa fa-flag red" style="color:red;"></i>
         <?php } ?> </label>
         <p class="text-muted"><?php if(!isset($v['desc']) || isset($v['desc']) && strlen($v['desc']) < 1){ ?>Select the cooresponding page.<?php } ?></p>
         
      </div>
      <div class="col-6">
         <div class=" mt-3">
         <select data-placeholder="Choose a page..." name="admin_values[links][<?php echo $k; ?>]" style="width:200px;" class="chzn-select">
            <option></option>
            <option value="">-----</option>
            <?php foreach ( $pages as $page ) {      
               $link = get_page_link( $page->ID );
               
               if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") { 
               $link = str_replace("http://","https://",$link);
               }
			   
			   
               $option = '<option value="'. $link.'"';
               if(isset($core_admin_values['links']) && $core_admin_values['links'][$k] == $link){ $option .= " selected=selected "; } 
               $option .= '>';
               $option .= $page->post_title;
               $option .= '</option>';
               echo $option; 
                } ?>
         </select>
      </div></div>
 
 
<?php if($i == 3){   $i =0; } $i++; } // end foreach  ?>
  </div>





 

</div></div>

<div class="col-lg-6">



<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4"> <h4><span>Additional Theme Pages</span></h4>
      </div>

 
            <?php
			
			$default_page_links = array(
	 
			"register" => array("name" => "Registration Page", "desc" => ""),
			"login" => array("name" => "Login Page", "desc" => ""),
			"password" => array("name" => "Lost Password Page", "desc" => ""),
			
			);
			 
			$pages = get_pages();  $i=1; foreach($default_page_links as $k=>$v){ ?>         


 
   <div class="row py-2">
      <div class="col-6">
         <label class="txt500"> <?php echo $v['name']; ?> 
         </label>
         <p class="text-muted"><?php if(!isset($v['desc']) == ""){ ?>Select the cooresponding page.<?php } ?></p>
      </div>
      <div class="col-6">
         <select data-placeholder="Choose a page..." name="admin_values[links][<?php echo $k; ?>]" style="width:200px;" class="chzn-select">
            <option></option>
            <option value="">-----</option>
            <?php foreach ( $pages as $page ) {      
               $link = get_page_link( $page->ID );
               
               if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") { 
               $link = str_replace("http://","https://",$link);
               }
               $option = '<option value="'. $link.'"';
               if(isset($core_admin_values['links']) && $core_admin_values['links'][$k] == $link){ $option .= " selected=selected "; } 
               $option .= '>';
               $option .= $page->post_title;
               $option .= '</option>';
               echo $option; 
                } ?>
         </select>
      </div>
   </div>
 
<?php if($i == 3){   $i =0; } $i++; } // end foreach  ?>

 
</div>

</div>


</div>


<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 