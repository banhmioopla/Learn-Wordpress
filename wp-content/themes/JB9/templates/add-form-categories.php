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

$data = array();
// CHECK IF WE ARE EDITING A LISTING
if(isset($_GET['eid']) && is_numeric($_GET['eid']) ){
 	
	// GET CATEGORY LIST FROM TERMS OBJEC
	$categories 	= wp_get_object_terms( $_GET['eid'], THEME_TAXONOMY );
 	
	// PUT BACK THE OLD CATS
	if(is_array($categories) && !empty($categories)){
	$lastCatID = "";
	foreach($categories as $cat){

	?>
  
    <script>
 	jQuery(document).ready(function() {
	
		setTimeout(function(){
		
		<?php if($cat->parent == 0){ ?>
	 	addToSelectedCats("<?php echo $cat->term_id; ?>", "<?php echo $cat->parent; ?>","<?php echo $cat->name; ?>","<?php echo get_term_link( $cat ); ?>","0" );
		
		<?php }elseif($cat->parent != 0 && $cat->parent != $lastCatID){ ?>
		setTimeout(function(){
		addToSelectedCats("<?php echo $cat->term_id; ?>", "<?php echo $cat->parent; ?>","<?php echo $cat->name; ?>","<?php echo get_term_link( $cat ); ?>","1" );
		} , 1000);
		<?php }else{ ?>
		setTimeout(function(){
		addToSelectedCats("<?php echo $cat->term_id; ?>", "<?php echo $cat->parent; ?>","<?php echo $cat->name; ?>","<?php echo get_term_link( $cat ); ?>","2" );
		} , 1500);
		<?php } ?>
		
		}, 1000); 
		
	 });
	</script>
    <?php 
	// SAVE FOR LATER
	if($cat->parent != 0){ $lastCatID =  $cat->term_id; }
	
	} }
 
	$data['cats'] 			=  $categories;
}

// SETUP MAX CATS
$maxCats = 10;

// COUNT HOW MANY CATEGORIES THERE ARE
// AND HIDE SETUP IF NON EXIST
$categories_count = wp_count_terms( 'listing' );
 
		 		
?>


  <div class="<?php if(defined('IS_MOBILEVIEW') ){ }else{?>card rounded-0<?php } ?>" <?php if($categories_count == 0){ ?>style="display:none"<?php } ?>>
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link btn-block text-left text-uppercase font-weight-bold text-dark collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         <?php echo __("Category","premiumpress"); ?> <span id="SelCountPre">( <span id="SelCatCount">0</span> / <span class="ppmaxcats">0</span>)</span>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="<?php if(defined('IS_MOBILEVIEW') ){ ?>mt-3<?php }else{?>card-body<?php } ?> add-listing-form">

<div id="categoryselectboxes">
   <div class="row">
      <div class="col" id="cat-box-1">
         <div class="catulbox">
            <ul class="list-unstyled box1">
               <?php  
                  echo wp_list_categories(array(
                      'walker'=> new Walker_CategorySelection, 
                      'taxonomy' => THEME_TAXONOMY, 
                      'show_count' => 1, 
                      'hide_empty' => 0, 
                      'echo' => 0, 
                      'parent_only' => 1,
                      'title_li' =>  "", 
                  'level' => 0) 
                  );  
                  ?>
            </ul>
         </div>
         <!-- end box -->
          
      </div>
      <div class="col-md-4 col-sm-12 hasnocats" id="cat-box-2">
         <div class="catulbox">
            <ul class="list-unstyled box2"></ul>
         </div>
         <!-- cat box -->
      </div>
      <div class="col-md-4 col-sm-12 hasnocats" id="cat-box-3">
         <div class="catulbox" >
            <ul class="list-unstyled box3"></ul>
         </div>
         <!-- cat box --> 
         <a href="javascript:void(0);" onclick="clearallcats();" class="btn btn-secondary float-right mt-3">
		 <?php echo __("Clear All","premiumpress"); ?></a>
      </div>
   </div>
</div>
<!-- end box -->
<div class="clearfix"></div>
<ul class="breadcrumb crumb clearfix mt-3" style="display:none;">
   <li class="breadcrumb-item active"><?php echo __("Selected:","premiumpress"); ?></li>
</ul>


</div></div></div>

<script>
 
function clearallcats(){

	jQuery('.form-cat').each(function(i, obj) {
	
		// REOVE FORM VALUE
		val = jQuery(obj).val();
		jQuery(obj).remove();
		
		// REMOVE SELECTED
		jQuery('.catid-'+val+'').removeClass('confirm');
		
		// CLEAR BREADCRUMNS
		jQuery('.breadcrumb .item-' + val + '').hide();
		
	});
	
	// REMOVE EXTRA PRICING
	jQuery('.price-extra').each(function(i, obj) {
	
		// REOVE FORM VALUE
		var name = jQuery(obj).attr('data-name');

		if( name  == "category"){		
			val = jQuery(obj).val();
			jQuery(obj).remove();		
		} 
		
	});
	
	// ADD BACK HIDE CLASSES
	jQuery('#cat-box-2').addClass('hasnocats');
	jQuery('#cat-box-3').addClass('hasnocats');
	
	// RESET TOTALS
	TotalPrice();

	// CLEAR BOXES
	jQuery('.box2').html('');
	jQuery('.box3').html('');

	// REDO COUNT
	jQuery('#SelCatCount').html(jQuery('.confirm').length); 
	jQuery('#totalcats').html(jQuery('.confirm').length); 
	
	

}

 
var lastloaded = ""; var maxcategories = <?php echo $maxCats; ?>;
function addToSelectedCats(catid, parentid, name, alink, level){

  
	if(jQuery('.catid-'+catid+'').hasClass('confirm') ){	

		// REMOVE BREADCRUMB
		jQuery('.breadcrumb .item-' + catid + '').hide();
		
		// REMOVE CLASS
		jQuery('.catid-'+catid+'').removeClass('confirm');
 
		//CLEAR NEXT BOX
		if( level == 0){
			jQuery('.box2 .catpid-'+catid+'').remove();
			
			jQuery('#cat-box-2').removeClass('hasnocats');
			
		}else if(level == 1){
			jQuery('.box3 .catpid-'+catid+'').remove();
			
			jQuery('#cat-box-3').removeClass('hasnocats');
			
		}else{
			//jQuery('.catpid-'+catid+'').remove();
		}
		
		// REMOVE FROM SELECTE CATS
		jQuery('#form-catid-'+catid+'').remove();
		
		// REDUCE SELECTED COUNTER	 
		jQuery('#SelCatCount').html(jQuery('.confirm').length); 	
		jQuery('#totalcats').html(jQuery('.confirm').length); 
			
	
	} else {
		
	 	// INCREASE SELECTED COUNTER
		jQuery('#SelCatCount').html(jQuery('.confirm').length); 
		jQuery('#totalcats').html(jQuery('.confirm').length);
		
		// GET MAX CATS FROM SPAN
		 
		maxcategories = parseFloat(jQuery('.ppmaxcats').html()); 
		 
		if( jQuery('.confirm').length >= maxcategories ){
		 
		 	jQuery('#SelCountPre').css( "background", "red" );
			jQuery('#SelCountPre').css( "color", "white" );
	
			return false;
		}
	
		// ADD BREADCRUMB
		jQuery('.breadcrumb').append('<li class="breadcrumb-item item-' + catid + '"><a href="'+ alink +'">'+name+'</a></li>');
	 
		// SETUP NEXT BOX	
		if( level == 0 && lastloaded != catid ){
		 
			ajax_load_categories(catid, '.box2','1');
			
			jQuery('#cat-box-2').removeClass('hasnocats');
			
		}else if(level == 1 && lastloaded != catid){
			 
			ajax_load_categories(catid, '.box3', '2');
			
			jQuery('#cat-box-3').removeClass('hasnocats');
			
		}else {
			// DO NOTHING			
		}
			
		// ADD CLASS
		jQuery('.catid-'+catid+'').addClass('confirm');	 
		 setTimeout(function(){
		 	jQuery('.catid-'+catid+'').addClass('confirm');	 
		}, 1000); 		
	
		// ADD TO SELECTED CATS
		jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+catid+'" name="form[category][]" class="form-cat" id="form-catid-'+catid+'" />');
		 
 	
		// SET VAR
		lastloaded = parentid;
		
		// REDO COUNT
		jQuery('#SelCatCount').html(jQuery('.confirm').length); 
		jQuery('#totalcats').html(jQuery('.confirm').length); 
		 
		// SHOW HIDE MAIN BUTTON
		checkCatCount(); // in add-form file
		
	}
	
	// SHOW CUSTOM FIELDS
	showcustomfields();


}

jQuery(document).ready(function() {


function CheckHasCats(){

 	//console.log(jQuery('#categoryselectboxes ul li').length+'<--');
	
	if ( jQuery('#categoryselectboxes ul li').length > 1 ) { }else{ jQuery('#catbar').hide(); jQuery('#catcountlist').hide(); }

}

function CheckExistingCatsForPrice(){

	jQuery('.confirm').each(function(i, obj) {
		 
		var catid = jQuery(obj).attr('data-catid');
  
		if (typeof jQuery(obj).attr('data-price') !== "undefined") {
	 	  
		// ADD IN FORM DATA
		jQuery('#SUBMISSION_FORM').append('<input type="hidden" value="'+jQuery('.catid-'+catid+'').attr('data-price')+'" name="" class="price-extra pextra-'+catid+'" data-name="category"  />');
		
		}
		
	});
			
	// RECHECK PRICE
	TotalPrice();
}

// WAIT FOR ALL CATS TO BE LOADED
setTimeout(function(){CheckExistingCatsForPrice(); CheckHasCats(); },1000);
});


function ajax_load_categories(pid, div, level){

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		data: {
            action: "load_categories",
			parent: pid,
			level: level,
		 
        },
        success: function(response) {
			
			jQuery(div).prepend(response);
			 
			
        },
        error: function(e) {
            alert("error "+e)
        }
    });

}
</script>  