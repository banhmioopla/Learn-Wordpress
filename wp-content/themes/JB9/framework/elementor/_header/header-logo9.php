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

global $CORE, $userdata, $wpdb, $settings; ?>
<div class="elementor_header elementor_logo header-logo2 header-logo9 <?php if(!isset($settings['sticky'])){ ?>no-sticky<?php } ?> <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" <?php if(isset($settings['id'])){ echo "id='".$settings['id']."'"; } ?>>

   <div class="container py-3">
      <div class="row">
         <div class="col-md-3">
            <div class="logo text-left pl-0" data-mobile-logo="<?php echo hook_logo(array($linkOnly = 1, $whiteVersion = 0)); ?>" data-sticky-logo="<?php echo hook_logo(array($linkOnly = 1, $whiteVersion = 0)); ?>">
               <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
               <?php echo hook_logo(array(0,0)); ?>
               </a>
            </div>
         </div>
         
         <div class="col-md-9">
         
         <div class="row">
    
         
         <div class="col-md-6 d-none d-lg-block">
       <?php if(get_option('users_can_register') == 1){ ?>
            <div class="hicons row float-right">
               <div class="phonebox">
                  <?php if(!$userdata->ID){ ?>                 
                  <a href="<?php echo wp_login_url(); ?>">
                  <span class="iconsmall"><i class="fa fa-lock"></i></span>
                  <span class="content mr-3">
                  <span class="text1 mb-1"><?php echo __("members area","premiumpress"); ?></span>
                  <span class="text2"><?php echo __("Sign up/in here","premiumpress"); ?></span>  
                  </span>              
                  </a>
                  <?php }else{ ?>
                  <a href="<?php echo _ppt(array('links','myaccount')); ?>">
                  <span class="iconsmall"><i class="fa fa-user-circle"></i></span>
                  <span class="content mr-3">
                  <span class="text1"><?php echo __("My Account","premiumpress"); ?></span>
                  <span class="text2"><?php echo __("view dashboard","premiumpress"); ?></span> 
                  </span>               
                  </a>
                  <?php } ?>  
               </div>
               <?php if(THEME_KEY == "sp"){ ?>
               <a href="<?php echo _ppt(array('links','cart')); ?>" class="mx-4 mt-1">
                     <div class="icon faicon text-center"> 
                        <span class="count bg-secondary"><span class="cart-basket-count"></span></span> 
                     </div>
                     <div class="small text-uppercase"><?php echo __("cart","premiumpress"); ?></div>
                  </a>   
                  <?php } ?>            
            </div>
            <?php } ?>
             
           </div>
      
         <div class="col-lg-6 py-3 py-sm-0"> 
                  
         <?php if(THEME_KEY == "cp"){ ?>
            <form action="<?php echo get_home_url()."/"; ?>" method="get" name="searchform" id="searchform" class="mt-lg-3">
               <?php
                  // if($wp_query->found_posts > 0){ 
                   $al = array();
                  
                   if(isset($_GET['ft']) && is_array($_GET['ft']) ){
                   	foreach($_GET['ft'] as $key => $val ){ if(in_array($val, $al)){ continue; } $al[] = $val; ?>
               <input type="hidden" name="ft[]" id="input-filter-<?php echo substr($val,0,2); ?>" value="<?php echo $val; ?>" />
               <?php	
                  }
                  }                 
                  ?>
               <div class="form-group mb-1">
                  <div class="input-group">
                     <input type="hidden" value="" id="ctype" />
                     <input type="text" class="form-control typeahead" name="s"value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" placeholder="<?php echo __("Search stores &amp; coupons...","premiumpress"); ?>" >
                     <button><i class="fa fa-search "></i></button> 
                  </div>
               </div>
            </form>
            <?php }else{ ?>
            <form action="<?php echo get_home_url(); ?>/" method="get" name="searchform1" id="searchform1">
               <input type="hidden" name="catid" value="" id="searchform1_catid" />
               <div class="form-group mb-1 nocat">
              
                     <input type="text" class="form-control typeahead" name="s" value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" placeholder="<?php if(isset($settings['search_txt'])){ echo $settings['search_txt']; }else{  echo __("Search keyword...","premiumpress"); } ?>">
                     <button><i class="fa fa-search"></i></button> 
                   
               </div>
            </form>
            <?php } ?>
         </div>
         
         </div>
        </div>  
      </div></div>
</div> 

<script>					   
jQuery("#catselect").on("click", "a", function(){
   
   jQuery('#searchform1_catid').val(jQuery(this).data("catid"));
   jQuery('#searchform_title').html(jQuery(this).attr("data-name"));
   
});

<?php if(isset($_GET['catid']) && is_numeric($_GET['catid'])){ ?>
jQuery(document).ready(function() {

	jQuery("#catselect a").each(function(){
		if(jQuery(this).attr("data-catid") == "<?php echo $_GET['catid']; ?>"){
		jQuery('#searchform_title').html(jQuery(this).attr("data-name"));
		}
	});

});
<?php } ?>
 </script> 