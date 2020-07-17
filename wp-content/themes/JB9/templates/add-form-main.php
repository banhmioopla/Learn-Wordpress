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
   
   global $CORE, $userdata;
   
   $editID = "";
   if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){
   
   	$editID = $_GET['eid'];
   	
   	// LOAD IN OPTIONS FOR SORTING DATA
   	wp_enqueue_script( 'jquery-ui-sortable' );
   	wp_enqueue_script( 'jquery-ui-draggable' );
   	wp_enqueue_script( 'jquery-ui-droppable' );
   }
   
   // USER MEMBERSHIP INCLUDED IN PRICE
   $freeListingMembership = false;
  
    
   /* =============================================================================
      GET ALL SETUP OPTIONS
      ========================================================================== */ 
    
   	// COUNT PACKAGES
   	$total_packages = $CORE->packages_count();
   	
   	// CHECK IF LISTING IS PAID, IF SO REMOVE ALL EDITING OPTIONS
   	$canEdit = true;
    
   	if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ 
   		if(get_post_meta($_GET['eid'],'paid_date',true) != ""){
   		$canEdit = false;
   		}
   		
   		global $canEdit;
   	}
    
   $o=0;
   
   ?>
<!-- SAVING SPINNER -->
<div id="core_saving_wrapper" style="display:none;">
  
      <div class="alert alert-success clearfix p-4 rounded-0" style="background:#eefff2">
         <img src="<?php echo THEME_URI; ?>/framework/img/loading.gif" class="float-right mt-2" style="max-height:60px; margin-right:20px;" />
         <h4 class="mb-3"><?php echo __("Saving Your Changes","premiumpress"); ?></h4>
         <p><?php echo __("This may take a few minutes, please wait...","premiumpress"); ?></p>
         <div class="clearfix"></div>
      </div>
    
</div>
<!-- setup package array for jquery -->
<script>var package = [];</script>


<section id="step-packages" class="mb-5">
   <?php get_template_part('templates/add', 'form-packages' ); ?> 
</section>

<?php if($userdata->ID){ ?>
<div id="step-content"  style="display:none;">


 

   <div  id="MAINCONTAINER">
  
            <div id="accordion">
               <?php get_template_part('templates/add', 'form-media' ); ?>   
               <?php get_template_part('templates/add', 'form-details' ); ?>  
                <?php if(THEME_KEY == "mj"){ ?>
               <?php get_template_part('_micro/micro', 'form-addons' ); ?> 
               <?php } ?>
               <?php get_template_part('templates/add', 'form-categories' ); ?>  
               <?php if(defined('GOOGLE-MAPS') && _ppt('default_listing_map') == 1 ){ ?>
               <?php get_template_part('templates/add', 'form-location' ); ?> 
               <?php } ?>              
               <?php if(in_array(THEME_KEY, array('dt','rt','ct','at','mj','so'))){ ?>
               <?php get_template_part('templates/add', 'form-youtube' ); ?>  
               <?php } ?> 
               
            </div>
            <!-- MAIN ACCORDIAN -->
            <!-- DO NOT REMOVED -->
            <input type="hidden" id="input-filelimit" value="<?php echo _ppt('default_listing_uploads'); ?>" />
            <form  method="post" enctype="multipart/form-data" onsubmit="VALIDATE_FORM_DATA(); return false;" id="SUBMISSION_FORM">
               <input type="hidden" name="packageID" id="packageID" value="<?php if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ echo get_post_meta($_GET['eid'],'packageID',true); }else{ echo ""; } ?>" />
               <?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ ?>
               <input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>" />
               <?php }elseif(isset($_POST['eid']) && is_numeric($_POST['eid']) ){ ?>
               <input type="hidden" name="eid" value="<?php echo $_POST['eid']; ?>" />
               <?php } ?>
               <?php if(isset($_GET['adminedit']) && is_numeric($_GET['adminedit']) ){ ?>
               <input type="hidden" name="adminedit" value="1" />
               <?php } ?>
               <?php if(isset($_GET['upgradepakid']) && is_numeric($_GET['upgradepakid']) ){ ?>
               <input type="hidden" name="upgradepakid" value="<?php echo $_GET['upgradepakid']; ?>" />
               <?php } ?>
               <?php if($freeListingMembership){ ?>
               <input type="hidden" name="freelistingmembership" value="1" />
               <?php } ?>
               
               
             <div class="<?php if(defined('IS_MOBILEVIEW') ){ ?>text-center<?php }else{?>text-left mt-3<?php } ?> ">
                  <div class="bg-light p-3"> 
                     <input name="agreetc" type="checkbox" id="agreetc" onchange="UpdateTCA()" /> <?php echo sprintf(__( "Agree to <a href=\"%s\">terms &amp; conditions.</a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?>
                  </div>
                  <div class="clearfix"></div>
                  <script>					 
                     function UpdateTCA(){					 
                     if(jQuery('#agreetc').is(':checked') ){                        	
                                       jQuery('#mainSaveBtn').removeAttr("disabled");
                                       }else{
                     jQuery('#mainSaveBtn').attr("disabled", true);                       
                                       } 					 
                     }
                  </script> 
                  
                  <button class="btn btn-primary btn-lg mt-4 px-5 rounded-0 mb-5"  id="mainSaveBtn" style="cursor:pointer;" disabled>
                  <i class="fa fa-check-circle" aria-hidden="true"></i> <?php echo __("Save Changes","premiumpress"); ?>
                  </button> 
               </div>
            </form>
         </div>
</div>


<? /*

FORM DISPLAYED WHEN PAYMENT IS REQUIRED DIRECTLY AFTER 
THE LISTING IS MADE

*/ ?>
<div id="step-payment" style="display:none">

 

   <div class="col-md-12 px-0">
      <div class="row">
         <div class="col-md-8">
            <div class="bg-light">
               <div id="ajax_payment_form"></div>
            </div>
         </div>
         <div class="col-md-4">
             
            <div class="widget packagedetailsbox">
               <ul class="payment-right small list-unstyled" >
                  <li style="border-top:0px;">
                     <div id="package-type" class="left font-weight-bold">
                        <?php echo __("Package","premiumpress"); ?>
                     </div>
                     <div class="right">
                        <span class="ppname"></span>
                     </div>
                     <div class="clearfix"></div>
                  </li>
                  
                  <li class="pptime-wrap">
                     <div class="left"><?php echo __("Period","premiumpress"); ?>:</div>
                     <div class="right">
                        <span class="pptime">xxx</span>
                     </div>
                     <div class="clearfix"></div>
                  </li>
                  
                  <li>
                     <div class="left"><strong><?php echo __("Total","premiumpress"); ?>:</strong></div>
                     <div class="right">	
                      
                        <span class="ppprice">xxx</span>
					 
                     </div>
                     <div class="clearfix"></div>
                  </li>
               </ul>
               <?php if(isset($_GET['eid'])){ ?>
               <a href="<?php echo get_permalink($_GET['eid']); ?>" class="btn btn-secondary btn-block btn-lg mt-4 rounded-0" target="_blank" id="vlistingbutton"><?php echo __("View Listing","premiumpress"); ?></a>
               <?php } ?>
            </div>
            <!-- end widget -->
         </div>
      </div>
   </div>
</div>

<?php } // IF USER IS LOGGED IN ?>

<? /*

-- end

FORM DISPLAYED WHEN PAYMENT IS REQUIRED DIRECTLY AFTER 
THE LISTING IS MADE

*/ ?>
<script src="<?php echo FRAMREWORK_URI.'js/backup_js/js.submissioneditor.js'; ?>"></script>
<script>  

var area1, htmlenabled, selectedpackageid;


jQuery(document).ready(function () {
                        
   // IMAGE UPLOADS
   <?php if(_ppt('default_listing_require_image') == 1 && !isset($_GET['eid']) ){ ?>
   jQuery('.card-header button').prop("disabled",true);							 
   <?php } ?>
                          
   // SETUP CUSTOM FIELDS
   showcustomfields();   	
   
   <?php if(_ppt('websitepackages') == 0 || isset($_GET['eid']) ){ ?>
   jQuery('.stepbox').hide();
   ChangeSteps(2);    
   jQuery('.step1 a').attr('onclick','').unbind('click');
   jQuery('.step3 a').attr('onclick','').unbind('click');
   <?php } ?>					
   
   <?php if(isset($_GET['eid'])){   
 
   $MyPackageId = 1; // default
   if(isset($_GET['eid']) && is_numeric($_GET['eid'])){ $MyPackageId = get_post_meta($_GET['eid'],'packageID',true); }
   if(!is_numeric($MyPackageId)){ $MyPackageId = 1; }   
   ?>
   processPackage(<?php echo $MyPackageId; ?>);
   <?php } ?> 
   
   <?php if(_ppt('websitepackages') == 0){ ?>
   jQuery('.packagedetailsbox').hide();
   jQuery('.contactusbtn').removeClass('mt-3');
   <?php } ?>
   
    var foundfields = 0;
    jQuery('#detailsbox input').each(function(i, obj) { foundfields = foundfields + 1; });
    
	if(foundfields == 0){ jQuery('#detailsbox').hide(); }
  
    // TEXT AREA LIMIT
	textarealimit();
                           
});


function toggleHTML(remove) {

<?php if(_ppt('websitepackages') == 1){ ?>

	if(!area1) {
 
		
		area1 = new nicEditor({ buttonList : ['bold','italic', 'underline', 'left', 'center', 'right', 'justify', 'ol', 'ul', 'strikethrough', 'removeformat', 'indent','outdent', 'hr', 'image', 
		'forecolor', 'bgcolor', 'link', 'unlink', 'fontSize', 'fontFamily', 'fontFormat']}).panelInstance('field-post_content',{hasPanel : true});		
		htmlenabled = true;
		
		jQuery('#textarea_counter').hide();
		jQuery('#field-post_content').removeClass('required');
		
		var html = jQuery("#field-post_content").text();
		var div1 = document.createElement("div");
			
	 
		 
    } else  {
            // REMOVE
			area1.removeInstance('field-post_content');
            area1 = null;
						
			// STRIP HTML TAGS
			var html = jQuery("#field-post_content").text();
			var div = document.createElement("div");
			jQuery("#field-post_content").innerHTML = div;
			
			jQuery('#textarea_counter').show();
			jQuery('#field-post_content').addClass('required');
		
						
    }


	if(remove && area1){
	  // REMOVE
				area1.removeInstance('field-post_content');
				area1 = null;
							
				// STRIP HTML TAGS
				var html = jQuery("#field-post_content").text();
				var div = document.createElement("div");
				jQuery("#field-post_content").innerHTML = div;
	}

	<?php } ?> 

}  
	

	
	// EDIT BOUND TO CLICK SO IT REOPENS
	jQuery( "#headingOne" ).click(function() {	 
	 
	
	  if(jQuery('#htmleditor').val() == 1){	  
		setTimeout(function(){ 
		if(package[selectedpackageid]['html'] == 1){
		toggleHTML(0);
		}else{
		toggleHTML(1);
		} 
		
		}, 2000);
	  }  
	});

   function processPackage(mid){
   
        
		// PROCESS
		if (typeof package[mid] !== "undefined") {
 		
			selectedpackageid = mid;
		
			// SET PACKAGE ID
      		jQuery('#packageID').val(mid);      	
	 	
      		jQuery('.ppname').html(package[mid]['name']);
      		jQuery('.ppprice').html(package[mid]['price']);
			jQuery('.uploadspace').html(package[mid]['files']);	
			
			
			
			if (typeof jQuery('#pdaystext'+mid+' .period').html() !== "undefined") {
			jQuery('.pptime-wrap').show();
			jQuery('.pptime').html(jQuery('#pdaystext'+mid+' .period').html());
			}else{
			jQuery('.pptime-wrap').hide();
			}
			
			
      		
   			jQuery('.ppprice').html(jQuery('#pdaystext'+mid+' strong').html());
			jQuery('.ppmaxcats').html(package[mid]['cats']);
			
			
			<?php if(THEME_KEY != "cp" && THEME_KEY != "at"){ ?> 
			if(package[mid]['days'] > 0){			
			jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+package[mid]['days']+'" name="custom[listing_expiry_days]" class="form-control" />');			
			}
			<?php } ?>
			
			// IMAGE UPLOADS 			 
			if(package[mid]['files'] == 0){
			jQuery('#headingFiles').hide();
			jQuery('#collapseOne').collapse('show');
			}else{
			jQuery('#headingFiles').show();
			jQuery('#collapseFour').collapse('show');
			jQuery('#collapseOne').collapse('hide');
			}
			
			// YOUTUBE 
			if(package[mid]['youtube'] == 1){
			jQuery('#headingYouTube').show();
			}else{
			jQuery('#headingYouTube').hide();
			}
			
			// HTML EDITOR			
			if(package[mid]['html'] == 1){
			jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="1" name="htmleditor" class="form-control" id="htmleditor" />');				
			}else{
			jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="0" name="htmleditor" class="form-control" id="htmleditor" />');
			toggleHTML(1);
			}
			
			<?php if(isset($_GET['eid'])){ ?>
			  if(jQuery('#htmleditor').val() == 1){	  
				setTimeout(function(){ 
				if(package[mid]['html'] == 1){
				toggleHTML(0);
				}else{
				toggleHTML(1);
				} 
				
				}, 2000);
			  }  
		   <?php } ?>
			
			// WORKOUT PRICES	
			TotalPrice();
   			
			// CHANGE STEPS
      	 	ChangeSteps(2); 
   		
		} else {
		
		//console.log('Package selection error ('+mid+')');
		jQuery('.packagedetailsbox').hide();
		<?php if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){ ?>
		jQuery('#packageID').val(99);
		<?php } ?>
		//ChangeSteps(1); 
		
		}
   	
      
   }
   function ChangeSteps(step){
   
   
   
   	if(step == 1){
   		
   		jQuery('.step2').removeClass('active');
   		jQuery('.step3').removeClass('active');
   		jQuery('.step1').addClass('active');   		 
   		jQuery('#step-packages').show();		
   		jQuery('#step-content').hide();		
   		jQuery('#step-payment').hide();		
		jQuery('.step2 .progress').removeClass('bg-success');
		jQuery('#pagetitletop').show();
		jQuery('.stepbox').hide();
		jQuery('.packagedetailsbox').hide();
   		
   	}else if(step == 2){
   		
   		//jQuery('.step1').removeClass('active');
   		jQuery('.step3').removeClass('active');
   		jQuery('.step2').addClass('active');   		
   		jQuery('#step-packages').hide();		
   		jQuery('#step-content').show();		
   		jQuery('#step-payment').hide();		
		jQuery('.step2 .progress').addClass('bg-success');
		jQuery('#pagetitletop').hide();
		jQuery('.stepbox').show();
    	jQuery('.packagedetailsbox').show();
   	
   	}else if(step == 3){
   	
   		jQuery('.step1').addClass('active');
   		jQuery('.step2').addClass('active');
   		jQuery('.step3').addClass('active');   			
   		jQuery('#step-packages').hide();		
   		jQuery('#step-content').hide();		
   		jQuery('#step-payment').show();   		
   		jQuery('.step1 a').attr('onclick','').unbind('click');
   		jQuery('.step2 a').attr('onclick','').unbind('click'); 
		jQuery('.step2 .progress').addClass('bg-success');
		jQuery('.step3 .progress').addClass('bg-success');
		jQuery('#pagetitletop').hide();    
		jQuery('.stepbox').show();
		jQuery('.packagedetailsbox').show();
		
   	} 
}                         


function VALIDATE_FORM_DATA(){ canContinue = true;
	// BUSINESS HOURS PLUGIN
	jQuery('.startTime').attr('name', 'startTime[]');
	jQuery('.endTime').attr('name', 'endTime[]');
	jQuery('.isActive').attr('name', 'isActive[]');
	if(jQuery('#agreetc').is(':checked') ){
		jQuery('#mainSaveBtn').removeAttr("disable");
	}else{
		jQuery('#mainSaveBtn').attr("disabled", true);
		alert("<?php echo __("Please agree to the website terms and conditions.","premiumpress"); ?>");
		return false;
	}
	 
	<?php if(_ppt('default_listing_require_image') == 1){ ?>
	if(jQuery('.preview').length == 0){
	jQuery('#collapseOne').collapse();
	jQuery('#collapseTwo').collapse();
	jQuery('#collapseThree').collapse();
	setTimeout(function(){
	jQuery('#collapseFour').collapse('show');
	}, 1000); 
	alert("<?php echo __("Please upload an image.","premiumpress"); ?>");
	return false;
	}
	<?php } ?>
	
	<?php if(defined('GOOGLE-MAPS') && _ppt('default_listing_map') == 1 ){ ?>
	if(jQuery('#form_zipbox').val() == ""){
	jQuery('#collapseOne').collapse();
	jQuery('#collapseTwo').collapse();
	jQuery('#collapseFour').collapse();
	setTimeout(function(){
	jQuery('#collapseThree').collapse('show');
	}, 1000);								
	}
	<?php } ?>
	
	<?php if(_ppt('default_listing_require_cat') == 1){ ?>
	// REQUIRE CATEGORY							 
	if (typeof jQuery(".form-cat").val() !== "undefined") {
	}else{
	alert("<?php echo __("Please enter select a category.","premiumpress"); ?>");
	return false;
	}
	<?php } ?>
	
	<?php if(is_numeric(_ppt('descmin')) && _ppt('descmin') > 0){ ?>							
	// CHECK IF VALUE IS ON
	if( !area1 && jQuery('#textarea_counter_hidden').val() == 0){							
	//alert("<?php echo __("Please enter a bigger description.","premiumpress"); ?>");
	// return false;
	}							
	<?php } ?>
	
	// FIRE DEFAULT VALIDATION
	canContinue = js_validate_fields("<?php echo __("Please completed all required fields.","premiumpress"); ?>");
	
	// SHOW SPINNER
	if(canContinue){
	jQuery('#MAINCONTAINER').hide();
	jQuery('#core_saving_wrapper').show();
	
	// CUSTOM CHECKBOX JAVASCRIPT
	jQuery('.checkbox.checked input').each(function(){								
	jQuery(this).addClass('form-control');								 	
	}); 
	
	// MOVE ALL FORM DATA INTO PLACE
	jQuery('.form-control').each(function(){	 
	
		//ADDON CODE		 
		if(jQuery(this).attr('id') == "field-post_content" && jQuery('#htmleditor').val() == 1 ){ //
		 
		// ADD NEW
        jQuery('<input>').attr({
             type: 'hidden',
             id: 'field-post_content',
             name: 'form[post_content]',
             value: jQuery(".nicEdit-main").html(),
        }).appendTo('#SUBMISSION_FORM');
 
		}else{
		
		jQuery('#SUBMISSION_FORM').append(this); 
		
		}
		
											
	});
 
// SAVE THE DATA
jQuery.ajax({
	type: "POST",
	url: '<?php echo home_url(); ?>/',		
	data: {
	action: "savelisting",
	data: jQuery('#SUBMISSION_FORM').serialize(), // serialize the form's data
},
success: function(response) {
 
if(response == 0){ // ERROR

	alert('There was an error.');
	ChangeSteps(2);

}else{// process
 
	if(response.toLowerCase().indexOf("http") == -1){
	
		jQuery.ajax({
			type: "POST",
			url: '<?php echo home_url(); ?>/',		
			data: {
			action: "load_new_payment_form",
			details: response, 
		},
			success: function(r) {
			// STOP SPINNER
			jQuery('#core_saving_wrapper').hide();
			// LOAD PAYMENT
			ChangeSteps(3);		
			// SHOW PAYMENT FORM
			jQuery('#ajax_payment_form').html(r); 
			},
			error: function(e) {
			alert("error "+e)
			}
		});											 
		}else{ 
			// REDIRECT TO LISTING
			window.location.replace(response);
		}
	}
	return false;		 
},
error: function(e) {
	return false;
}
});
}
return canContinue;
}

function TotalPrice(){

	var total_price = 0;
	total_price += get_package_data('price');
	 
	// THEN CHECK FOR ADD-ONS	
	// ONLY CHANGE PRICE DISPLAY IF NEEDED
	// OTHERWISE DONT - ITS ALREADY SET IN PROCESSPACKAGE()
	if(jQuery('.price-extra').length){
	
		jQuery('.price-extra').each(function(i, obj) {
			if(jQuery(obj).val() != ""){
				total_price = parseFloat(total_price) +  parseFloat(jQuery(obj).val());
			}
		});
	 
		jQuery('.ppprice').html(parseFloat(total_price));
	
	} 	
	
	// UPDATE FORM PRICE
	if(jQuery('.total-price-field').length > 0 ){	
		jQuery('.total-price-field').val(total_price);
	}else{
		<?php if(!isset($_GET['eid'])){ ?>
		jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+total_price+'" name="form[totalprice]" class="total-price-field" id="total-price-field" />');	
		<?php } ?>	 
	}
	
	// CHECK IMG UPLOAD SPACE
	files = get_package_data('files');	
	jQuery('#img-upload-space').html(files);	
	jQuery('#input-filelimit').val(files);
	
	var ff = 0;
	jQuery('.newupload').show();
	jQuery('.newupload').each(function(i, obj) {        
	if(ff >= files ){
		jQuery(obj).hide();
	}
	ff = ff +1;
	}); 
	if(files == 1){
		jQuery('.imagespacetext').hide();
		jQuery('.newupload').addClass('singleimage');
	}
}
function get_package_data(key){

	mypackage = jQuery('#packageID').val();
	if (typeof package[mypackage] !== "undefined") {
		return  package[mypackage][key];
	} else if ( typeof package[0] !== "undefined") {
		return  package[0][key];
	} else {
		return 0;
	}
}
function checkCatCount(){
	if(jQuery('.confirm').length > 0){
		jQuery('.next').show();
	}else{
		jQuery('.next').hide();
	}
}
function showcustomfields(){
// TURN ALL OFF FIRST THEN TURN BACK ON
jQuery('.customfield').hide();
var sList = "";
jQuery('.form-cat').each(function(i, obj) {
// GET CATID
catid = jQuery(obj).val();
// SHOW FIELDS WITH THIS ID
jQuery('.customid-' + catid).show();         	   
});	
// SHOW ALL ALLOWED
jQuery('.customid-0').show(); 
}
function addExtraPrice(total, id, name){
// CHECK IF ALREADY ADDED AND NOW WANTS REMOVING
if(jQuery('.pextra-'+id+'').length > 0 ){	
// REMOVE CLASS
jQuery('.pextra-'+id).remove();
} else {
// ADD IN FORM DATA
jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+total+'" name="" class="price-extra pextra-'+id+'" data-name="' + name + '"  />');
}
// NOW RECALCULATE TOTOAL
TotalPrice();
// SETUP CUSTOM FIELDS
showcustomfields();
}

 

 
   function textarealimit(){
   
   if(area1) {
   return;
   }
   
     text_max = <?php if(!is_numeric(_ppt('descmin'))){ echo 255; }else{ echo _ppt('descmin'); } ?>;
     if(text_max == 0 || text_max == ""){
   	  jQuery('#textarea_counter').hide();
	  jQuery('#textarea_counter_hidden').val('1');
   	  return;
     }
     var text_length = jQuery('#field-post_content').val().length;
     var text_remaining = text_max - text_length;
     if(text_remaining < 0){
     jQuery('#textarea_counter').hide();
     }
   
     jQuery('#textarea_counter span').html( '<b>' + text_remaining + '</b> <?php echo __("characters remaining","premiumpress"); ?>');
   
      jQuery('#field-post_content').keyup(function() {
   	
           var text_length = jQuery('#field-post_content').val().length;
           var text_remaining = text_max - text_length; 
   
           jQuery('#textarea_counter span').html( '<b>' + text_remaining + '</b> <?php echo __("characters remaining","premiumpress"); ?>');
   		
   		if(text_remaining < 0){
   			jQuery('#textarea_counter').hide();
			 jQuery('#textarea_counter_hidden').val('1');
   		}else{
   			jQuery('#textarea_counter').show();
			 jQuery('#textarea_counter_hidden').val('0');
   		}
   		
      });
   	
   };
      

 

<?php if(in_array(THEME_KEY, array('dt'))){ ?>
(function($) {
    $.fn.businessHours = function(opts) {
        var defaults = {
            preInit: function() {
            },
            postInit: function() {
            },
            inputDisabled: false,
            checkedColorClass: "WorkingDayState",
            uncheckedColorClass: "RestDayState",
            colorBoxValContainerClass: "colorBoxContainer",
            weekdays: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            operationTime: [
                {},
                {},
                {},
                {},
                {},
                {isActive: false},
                {isActive: false}
            ],
            defaultOperationTimeFrom: '9:00',
            defaultOperationTimeTill: '18:00',
            defaultActive: true,
            //labelOn: "Working day",
            //labelOff: "Day off",
            //labelTimeFrom: "from:",
            //labelTimeTill: "till:",
            containerTmpl: '<div class="clean"/>',
            dayTmpl: '<div class="dayContainer">' +
            '<div data-original-title="" class="colorBox"><input type="checkbox" class="invisible operationState"/></div>' +
            '<div class="weekday"></div>' +
            '<div class="operationDayTimeContainer">' +
            '<div class="operationTime"><input type="text" name="startTime" class="mini-time operationTimeFrom" value=""/></div>' +
            '<div class="operationTime"><input type="text" name="endTime" class="mini-time operationTimeTill" value=""/></div>' +
            '</div></div>'
        };

        var container = $(this);

        function initTimeBox(timeBoxSelector, time, isInputDisabled) {
            timeBoxSelector.val(time);

            if(isInputDisabled) {
                timeBoxSelector.prop('readonly', true);
            }
        }

        var methods = {
            getValueOrDefault: function(val, defaultVal) {
                return (jQuery.type(val) === "undefined" || val == null) ? defaultVal : val;
            },
            init: function(opts) {
                this.options = $.extend(defaults, opts);
                container.html("");

                if(typeof this.options.preInit === "function") {
                    this.options.preInit();
                }

                this.initView(this.options);

                if(typeof this.options.postInit === "function") {
                    //$('.operationTimeFrom, .operationTimeTill').timepicker(options.timepickerOptions);
                    this.options.postInit();
                }

                return {
                    serialize: function() {
                        var data = [];

                        container.find(".operationState").each(function(num, item) {
                            var isWorkingDay = $(item).prop("checked");
                            var dayContainer = $(item).parents(".dayContainer");

                            data.push({
                                isActive: isWorkingDay,
                                timeFrom: isWorkingDay ? dayContainer.find("[name='startTime']").val() : null,
                                timeTill: isWorkingDay ? dayContainer.find("[name='endTime']").val() : null
                            });
                        });

                        return data;
                    }
                };
            },
            initView: function(options) {
                var stateClasses = [options.checkedColorClass, options.uncheckedColorClass];
                var subContainer = container.append($(options.containerTmpl));
                var $this = this;

                for(var i = 0; i < options.weekdays.length; i++) {
                    subContainer.append(options.dayTmpl);
                }

                $.each(options.weekdays, function(pos, weekday) {
                    // populate form
                    var day = options.operationTime[pos];
                    var operationDayNode = container.find(".dayContainer").eq(pos);
                    operationDayNode.find('.weekday').html(weekday);

                    var isWorkingDay = $this.getValueOrDefault(day.isActive, options.defaultActive);
                    operationDayNode.find('.operationState').prop('checked', isWorkingDay);

                    var timeFrom = $this.getValueOrDefault(day.timeFrom, options.defaultOperationTimeFrom);
                    initTimeBox(operationDayNode.find('[name="startTime"]'), timeFrom, options.inputDisabled);

                    var endTime = $this.getValueOrDefault(day.timeTill, options.defaultOperationTimeTill);
                    initTimeBox(operationDayNode.find('[name="endTime"]'), endTime, options.inputDisabled);
                });

                container.find(".operationState").change(function() {
                    var checkbox = $(this);
                    var boxClass = options.checkedColorClass;
                    var timeControlDisabled = false;
					
					
					checkbox.parents(".dayContainer").find(".isActive").val(1);
					
                    if(!checkbox.prop("checked")) {
                        // disabled
                        boxClass = options.uncheckedColorClass;
                        timeControlDisabled = true;
						
						checkbox.parents(".dayContainer").find(".isActive").val(0);
                    }

                    checkbox.parents(".colorBox").removeClass(stateClasses.join(' ')).addClass(boxClass);
                    checkbox.parents(".dayContainer").find(".operationTime").toggle(!timeControlDisabled);
                }).trigger("change");

                if(!options.inputDisabled) {
                    container.find(".colorBox").on("click", function() {
                        var checkbox = $(this).find(".operationState");
                        checkbox.prop("checked", !checkbox.prop('checked')).trigger("change");
                    });
                }
            }
        };

        return methods.init(opts);
    };
})(jQuery);
<?php } ?>
</script>