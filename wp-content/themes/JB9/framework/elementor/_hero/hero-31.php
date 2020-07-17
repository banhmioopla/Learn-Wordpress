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
 
global $CORE, $post, $userdata, $settings;

?>
<div class="hero31 text-white <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" style="background:url('<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero20.jpg<?php } ?>'); background-size: cover; position:relative;">
 
 
   <div class="container py-4">
      <div class="row">
         <div class="col-md-8 offset-md-2 text-center py-5">
            <div class="wrap py-md-5 my-lg- py-md-5 my-lg-5">
               
               <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>Awesome Title Here<?php } ?></h1>
               
               <p class="my-3 pb-md-4 lead"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. 
            <?php } ?></p>
            <div class="formwrap mt-5">
               <form action="<?php echo home_url(); ?>/" method="get" name="searchform" id="searchform">
                  <div class="input-group">
                  
                  <?php if(THEME_KEY == "da"){ ?>
                  
                  
                  <input type="hidden" name="s" value="" />
                   <select class="form-control" name="se">
                                 <?php
			$values = array(
			"1" => array("name" => __("I'm looking for Guys","premiumpress"), "icon" => "fa fa-male"),
			"2" => array("name" => __("I'm looking for Girls","premiumpress"), "icon" => "fa fa-female"),
			"3" => array("name" => __("I'm looking for Couples","premiumpress"), "icon" => "fa fa-users"),
			);
			if(_ppt('hide_couples') == 1){ unset($values["3"]); }
								 ?>
                                  <?php foreach($values as $k => $v){ ?>
                                 <option data-icon="<?php echo $v['icon']; ?>" value="<?php echo $k; ?>" <?php if(isset($_GET['se']) && $_GET['se'] == $k){ echo "selected=selected"; } ?>><?php echo $v['name']; ?></option>
                                 <?php } ?>
                        </select>
                        
                   
                     <?php if(_ppt('google') == 1){ ?>
                      <input type="hidden" name="radius" value="30" />
                     <input type="text" name="zipcode" placeholder="<?php echo __("town, city or zipcode...","premiumpress"); ?>" class="form-control">   
                     <?php } ?>
                     
                     <div class="input-group-prepend" style="position:relative;">
                      <button class="btn btn-primary px-5"><?php echo __("Search","premiumpress") ?></button>
                     </div> 
                  
                  
                  
                  <?php }else{ ?>
                  
                  <input type="text" name="s" placeholder="<?php echo __("I'm looking for...","premiumpress") ?>" class="form-control">  
                     <?php if(in_array(THEME_KEY, array('dt','rt')) && _ppt('google') == 1){ ?>
                      <input type="hidden" name="radius" value="100" />
                     <input type="text" name="zipcode" placeholder="<?php echo __("town, city or zipcode...","premiumpress"); ?>" class="form-control">   
                     <?php } ?>
                     
                     <div class="input-group-prepend" style="position:relative;">
                      <button class="btn btn-primary px-5"><?php echo __("Search","premiumpress") ?></button>
                     </div> 
                     
                 <?php } ?>
                     
                  </div>
               </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>