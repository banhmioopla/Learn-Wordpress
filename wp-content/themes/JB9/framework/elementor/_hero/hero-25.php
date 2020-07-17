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
<style>
.hero25 {   } 
.hero25 .homensearch .top { font-size:16px; color:#fff; margin-bottom:15px; padding-bottom:10px; border-bottom:1px solid #fff;  }
.hero25 .homensearch label { color:#fff; }	
.hero25 .homensearch select, .hero25 .homensearch input { border-radius:0px;  }
.hero25 button { position:absolute;right:10px; top:5px;color:#000; z-index:1000000; background:none;border:0px;cursor:pointer;font-size:26px;}
.hero25 .homensearch ::-webkit-input-placeholder  { color:#000; }
.hero25 .form-control {min-height: 60px;  }
.hero25::after {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.6);
	content: ""
}
.hero25 .wrap { z-index:10000; position:relative; }
 
</style>


 <div class="hero25 text-white
 <?php if(_ppt('header_hometransparent') == 1){ echo "pt-100"; } ?>
  <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" style="background:url('<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero25.jpg<?php } ?>'); background-size: cover; position:relative;">
 
 
   <div class="container py-4">
      <div class="row">
         <div class="col-md-8 offset-md-2 text-center py-5">
            <div class="wrap py-5 my-5">
               
               <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>Awesome Title Here<?php } ?></h1>
               
               <p class="my-3 pb-4 lead"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. 
            <?php } ?></p>
            
               <form action="<?php echo home_url(); ?>/" method="get" name="searchform" id="searchform" class="homensearch clearfix mt-3">
                  <div class="input-group">
                     
                     <button type="submit"><i class="fa fa-search"></i> </button>
                     <input type="text" name="s" placeholder="<?php echo __("I'm looking for...","premiumpress") ?>" class="form-control">   
                     <?php if(constant('THEME_KEY') != "ph"){ ?>
                     <div class="input-group-prepend" style="position:relative;">
                        <select class="form-control"  name="catid">
                           <option><?php echo __("All Categories","premiumpress") ?></option>
                           <?php echo $CORE->CategoryList(array(0,false,0,'listing')); ?>
                        </select>
                     </div> 
                     <?php } ?>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>