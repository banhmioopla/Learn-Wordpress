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
   
    
   global $CORE, $userdata; $shown = 1;
     
   
   ?>


<?php if(_ppt('websitepackages') == 0 || THEME_KEY == "da"){ 

// TUN OFF DURATION FOR AUCTION THEME
  if(_ppt('auction_theme_usl') == 1){
  $DAYS = 0;
  }else{
  $DAYS = 365;
  }
  
  // GET THE MAX UPLOADS FROM MEMBERSHIP
  if(THEME_KEY == "da" && $userdata->ID ){ global $CORE_DATING;
  
  $sub = $CORE->get_subscription($userdata->ID);
	
	if(isset($sub['key'])){	
	  
		$hh = $CORE_DATING->da_user_susbcription_get($sub['key']);
		if(isset($hh['access_maxuploads']) && is_numeric($hh['access_maxuploads']) ){
		$maxuu = $hh['access_maxuploads'];
		}else{
		$maxuu = "1";
		}
	
	}else{
	$maxuu = "1";
	} 
  
  }else{
  $maxuu = "100";
  }

?>

 <script>
         package["99"] = {
         	name:"<?php echo __("Standard","premiumpress"); ?>", 
         	price:"0",
			html: 0, 			
			days:"<?php echo $DAYS; ?>", 
			files:"<?php echo $maxuu; ?>",	
			featured: 0,	
			youtube: 1,
 			cats: 30, 				
         };
		 jQuery(document).ready(function () {
		 processPackage('99');
		 });		 
      </script> 
<div style="display:none;">
<div id="pdaystext99"><span class="period">1 <?php echo __("Year","premiumpress"); ?></span><strong><?php echo __("FREE","premiumpress"); ?></strong></div>
</div>

<?php }else{ ?>

 

<section id="packagesbox" class="package-tab-content"><div class="container"><div class="row">



 
    
<?php $i=0; 
$paknames = array( __("Basic","premiumpress") , __("Standard","premiumpress") , __("Premium","premiumpress") , __("Premium","premiumpress") , __("Premium","premiumpress") , __("Premium","premiumpress"));

while($i < 7){ 
	
	// CHECK IF ENABLED
	if(  _ppt('pak'.$i.'_enable') == 0){ 
	$i++; continue;
	}
  
   // WORK OUR PRICE
   if(_ppt('pak'.$i.'_price') == 0){       
      $dprice = __("FREE","premiumpress");       
      $isfree = true;
    }else{
      $dprice = hook_price(_ppt('pak'.$i.'_price'));      	 
      $isfree = false;
    }
  
  // WORK OUR DAYS
  $DAYS = _ppt('pak'.$i.'_duration'); 
  
  // TUN OFF DURATION FOR AUCTION THEME
  if(_ppt('auction_theme_usl') == 1){
  $DAYS = 0;
  }
     
   switch($DAYS){				
      case "1": {
      $daytext = "24 ".__("Hours","premiumpress");
      } break;
      case "7": {
      $daytext = "1 ".__("Week","premiumpress");
      } break;
      case "30": {
      $daytext =  "1 ".__("Month","premiumpress");
      } break;
      case "365": {
      $daytext =  "1 ".__("Year","premiumpress");
      } break;
      default: { 
	  
	  if(is_numeric($DAYS) && $DAYS > 0){
      $daytext = $DAYS." ".__("Days","premiumpress");
	  }else{
	   $daytext = "";
	  }
      }
   }
?> 

   <div class="package-posts py-4 col-12 <?php if($shown%2){ ?><?php } ?>bg-light mb-4">
      <div class="row">
         <div class="col-md-3 box-price text-center">
            <div class="text-success text-center h1"><?php echo $dprice; ?></div>
            <div class="h6 text-center" id="pdaystext<?php echo $i; ?>"><?php echo $daytext; ?></div>
            <?php if(_ppt('pak'.$i.'_r') ==1){ ?> 
            <div><?php echo __("Subscription","premiumpress"); ?></div>
            <?php }else{ ?>
            <div><?php echo __("One-time Payment","premiumpress"); ?></div>
            <?php } ?>
         </div>
         <div class="col-md-6 text-left box-desc">
            <h5 class="mb-3"><?php if(_ppt('pak'.$i.'_name') == ""){ echo $paknames[$i]; }else{ echo _ppt('pak'.$i.'_name'); }  ?></h5>
            <?php if(strlen(_ppt('pak'.$i.'_desc')) > 1){ ?>
            <p class="mb-0 text-muted mt-4"><?php echo stripslashes(_ppt('pak'.$i.'_desc')); ?></p>
            <?php } ?>       
         </div>
         <div class="col-md-3 box-btn">
         
       <a <?php if($userdata->ID){ ?>
            href="javascript:void(0);" onclick="processPackage('<?php echo $i; ?>');"
            <?php }else{ ?>
            href="<?php echo wp_login_url(); ?>?redirect=<?php echo _ppt(array('links','add')); ?>"
            <?php } ?>
            
            class="btn btn-success text-uppercase btn-block font-weight-bold mt-2"><?php echo __("Select Package","premiumpress") ?></a>
             
         </div>
      </div>
   </div>
 
    
 <script>
         package["<?php echo $i; ?>"] = {
         	name:"<?php if(_ppt('pak'.$i.'_name') != ""){ echo _ppt('pak'.$i.'_name'); }else{ echo $paknames[$i]; } ?>",
         	price:"<?php if(_ppt('pak'.$i.'_price') == ""){ echo 0; }else{ echo _ppt('pak'.$i.'_price'); } ?>",
			html: <?php if(_ppt('pak'.$i.'_html') != 1){ echo 0; }else{ echo 1; } ?>, 			
			days:"<?php if(_ppt('pak'.$i.'_duration') == ""){ echo 10; }else{ echo _ppt('pak'.$i.'_duration'); } ?>", 
			files:"<?php if(_ppt('pak'.$i.'_uploads') == ""){ echo 0; }else{ echo _ppt('pak'.$i.'_uploads'); } ?>",	
			featured: <?php if(_ppt('pak'.$i.'_featured') != 1){ echo 0; }else{ echo 1; } ?>,	
			youtube: <?php if(_ppt('pak'.$i.'_youtube') != 1){ echo 0; }else{ echo 1; } ?>,
 			cats: <?php if(!is_numeric(_ppt('pak'.$i.'_cats'))){ echo 10; }else{ echo _ppt('pak'.$i.'_cats'); } ?>, 				
         };
      </script> 
<?php $i++; $shown++; } ?>


</div></div></section>
<?php } ?>






