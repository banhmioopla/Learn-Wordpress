<?php
   /*
   Template Name: [PAGE - ADD LISTING]
    
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
   
   global $CORE, $userdata, $CORE; 
   
   // REDIRECT FOR LOGIN
   if(_ppt('websitepackages') == 0 || THEME_KEY == "da" ){
   $CORE->Authorize();
   }
   
   // SETUP PAGE GLOBALS 
   $GLOBALS['flag-add'] = 1;
     
   // ADD ON STYLES
   wp_enqueue_style('addform', FRAMREWORK_URI.'css/backup_css/css.framework-addform.css');
   wp_enqueue_style('addform');
   
   wp_register_script( 'googlemap',  $CORE->googlelink());
   wp_enqueue_script( 'googlemap' ); 
   
   // CHECK WE HAVE A PROFILE ALREADY
   // IF SO LINK DIRECTLY TOO IT
   if(THEME_KEY == "da" && !isset($_GET['eid']) ){
   	$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('".$userdata->ID."') LIMIT 1";				 
   	$query = $wpdb->get_results($SQL, OBJECT);
   	if(!empty($query)){
   	$link =  _ppt(array('links','add'))."/?eid=".$query[0]->ID;
   	header("location: ".$link);
   	exit();
   	}
   }   
   
// CHECK FOR 1 LISTING ONLY, IF SO REDIRECT
if( ( _ppt('onelistingonly') == 1 || _ppt('onelistingonly') == 2) && $userdata->ID && !isset($_GET['eid']) && !isset($_POST['action']) ){

	// SEE IF WE HAVE ANY OTHER LISTINGS ALREADY
	$SQL = "SELECT ID FROM ".$wpdb->prefix."posts WHERE post_type='".THEME_TAXONOMY."_type' and post_status='publish' AND post_author='".$userdata->ID."' ORDER BY ID DESC LIMIT 1";	
	$result = $wpdb->get_results($SQL);
	if(!empty($result)){
		
		if(_ppt('onelistingonly') == 1){
			header("location: "._ppt(array('links','add'))."/?eid=".$result[0]->ID);
			exit();			
		}else{
			header("location: "._ppt(array('links','memberships'))."/?noaccess=1&noedit=1");
			exit();			
		}
		

	}
	
}
   
   
   
   // GET USER MEMBERSHIP
   $cm = get_user_meta($userdata->ID, 'wlt_subscription',true);
   if(is_array($cm)){
   	
		// GET USER MEMBERSHIP DATA
		$memdata = $CORE->get_subscription_data($cm['key']);
 
 		// CHECK IF MEMBERSHIP HAS EXPIRED
   		$da = $CORE->date_timediff($cm['date_expires'],'');
		if(_ppt('requiremembership') == '1' && $da['expired'] == 1 && !isset($_GET['eid']) && THEME_KEY != "da" ){			
			wp_safe_redirect( _ppt(array('links','memberships'))."?expired=1", 302 );
			exit;			
		}		
		
		// CHECK IF WE HAVE ACCESS TO SUBMIT FREE LISTING
		if( $da['expired'] == 0 && $memdata['listings_left'] > 0 ){   
			$FREELISTING = $memdata['listings_pak'];
		}  
		
   }
   
   // DATING THEME DOESNT HAVE STEPS
   if(THEME_KEY == "da"){
	$FREELISTING = 99;
   }
   
   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
     
   //DISPLAY HEADER
   get_header($CORE->pageswitch());   
   
   // DISPLAY PAGE TOP
   get_template_part( 'page', 'top' );
   
   // HOOK PACKAGES BEFORE
   hook_packages_before();
   
   ?> 
 
 
 <div class="content-wrapper">
 

 <?php get_template_part('templates/page-top', 'text' ); ?>
 
 

   <?php if(!isset($FREELISTING)){ ?>
   
                 
   
   <div class="stepbox row m-0 py-3 mb-5" style="width:100%;display:none;">
      <div class="col-4 stepbox-step active step1">
         <div class="text-center stepbox-stepnum"><?php echo __("Select Package","premiumpress"); ?></div>
         <div class="progress bg-success">
            <div class="progress-bar"></div>
         </div>
         <a href="javascript:void(0);" <?php if(_ppt('websitepackages') == 1){ ?>onclick="ChangeSteps(1);"<?php } ?> class="stepbox-dot bg-dark"></a>
      </div>
      <div class="col-4 stepbox-step step2">
         <div class="text-center stepbox-stepnum"><?php echo __("Enter Details","premiumpress"); ?></div>
         <div class="progress">
            <div class="progress-bar"></div>
         </div>
         <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a>
      </div>
      <div class="col-4 stepbox-step step3">
         <div class="text-center stepbox-stepnum"> 
            <?php echo __("Payment","premiumpress"); ?>    
         </div>
         <div class="progress">
            <div class="progress-bar"></div>
         </div>
         <a href="javascript:void(0);" class="stepbox-dot bg-dark"></a>  
      </div>
   </div>
	
	<?php }else{ ?>   
	<script> 
    jQuery(document).ready(function() {	
		jQuery('#package-tab-content').hide();
		jQuery('#step-content').show();
		processPackage('<?php echo $FREELISTING; ?>');			
		jQuery('.ppprice').html('<?php echo __("FREE","premiumpress"); ?> ');
		jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="1" name="freelisting" />');
    });
    </script>
   <?php } ?>
      
  
   <script> 
    jQuery(document).ready(function() {
	
	jQuery('#package-outter-wrapper').show();
    
	
    });
    </script>
 
   
   <?php get_template_part('templates/add', 'form-main' ); ?>

                   
                                   
</div>

<script src="<?php echo FRAMREWORK_URI.'js/backup_js/js.submissionupload.js'; ?>"></script>
<?php 

// + PAGE BOTTOM
get_template_part( 'page', 'bottom' ); 

// + GLOBAL FOOTER
get_footer($CORE->pageswitch());  ?>