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
   
   global $CORE, $userdata, $post, $wp_query, $ADSEARCH; 
     
   if(!_ppt_checkfile("widget-search-filters.php")){
   
   // CHECK AND FORMAT THE SEARCH FILTERS
   $globalfilters = array();
   if(isset($_GET['ft']) && is_array($_GET['ft']) ){ 
	   foreach(array_reverse($_GET['ft']) as $key => $val ){     
	   	$globalfilters[$key] = $val;   
	   }  
   }
   
   if(is_array(_ppt('searchtax'))){
   $taxonomies = get_taxonomies(); 
   }
   
   // BUILD NEW SEARCH FOR GLOBAL RESULTS
   
   $gg = explode("LIMIT ",$wp_query->request);	
   
   $gg[0] = str_replace("".$wpdb->posts.".ID FROM", "".$wpdb->posts.".post_date,
   pm0.meta_value AS country, 		
   pm1.meta_value AS city, 		
   pm2.meta_value AS hits, 	
   
   ".$wpdb->posts.".post_content FROM", $gg[0]);
   	
   $gg[0] = str_replace("WHERE 1=1", 		
   "LEFT JOIN ".$wpdb->postmeta." pm0 ON (".$wpdb->posts.".ID = pm0.post_id AND pm0.meta_key ='map-country' AND pm0.meta_value !='' )		
   LEFT JOIN ".$wpdb->postmeta." pm1 ON (".$wpdb->posts.".ID = pm1.post_id AND pm1.meta_key ='map-city'  AND pm1.meta_value !='' ) 		
   LEFT JOIN ".$wpdb->postmeta." pm2 ON (".$wpdb->posts.".ID = pm2.post_id AND pm2.meta_key ='hits'  )		
   	
   WHERE 1=1", $gg[0]); 
   
   $gg[0] = str_replace("ORDER BY post_date", "ORDER BY ".$wpdb->posts.".post_date",$gg[0]);
   $gg[0] = str_replace("SELECT", "SELECT DISTINCT",$gg[0]);
   $gg[0] = str_replace("post_type = 'post'", "post_type =  'listing_type'",$gg[0]);		
   $gg[0] = str_replace("ORDER BY wp_postmeta.meta_value+0", "ORDER BY ".$wpdb->posts.".post_date",$gg[0]);
   $gg[0] = str_replace("ORDER BY wp_postmeta.meta_value", "ORDER BY ".$wpdb->posts.".post_date",$gg[0]);
   $gg[0] = str_replace(" AND post_status = 'publish'", " ", $gg[0]); 
   
   preg_match('/\{([^}]+)\}/', $gg[0], $match);
   if(isset($match[0])){
   $gg[0] = str_replace($match[0],"%", $gg[0]);
   }
   	
   $gg[0] = str_replace("".$wpdb->posts.".post_content FROM ".$wpdb->posts."", "".$wpdb->posts.".ID FROM ".$wpdb->posts."", $gg[0]); 
   	
   $SQL = $gg[0]." LIMIT 500";
   
   $mapdata = $wpdb->get_results($SQL, OBJECT);
   
   if( is_array($mapdata) ) {	
   			
   foreach($mapdata as $map){	
    
   // GET CATID
   $catID = "";
   $cat =  wp_get_object_terms( $map->ID , THEME_TAXONOMY );
   if(is_array($cat)){
   	foreach($cat as $k=>$v){
   		$catID .= "catid-".$v->term_id." ";					
   	}
   }
   
   
   // GET TAX 
   if(is_array(_ppt('searchtax'))){
   foreach ( $taxonomies as $taxonomy ) {  
   if(in_array($taxonomy, _ppt('searchtax'))){ 
   
   $tax = wp_get_post_terms( $map->ID, $taxonomy );
    if(is_array($tax)){
   foreach($tax as $k => $v){
   $catID .= $taxonomy."-".$v->term_id." ";					
   }
    }
   } 
   } 
   }
   
    
   // DATE INTO (A/B/C/)
   $vv = $CORE->date_timediff($map->post_date);	
   	
   if(isset($vv['date_array']["".__('Years',"premiumpress").""]) && $vv['date_array']["".__('Years',"premiumpress").""] > 0){
   $dID = "date-t5";
   
   }elseif(isset($vv['date_array']["".__('years',"premiumpress").""]) && $vv['date_array']["".__('years',"premiumpress").""] > 0){
   $dID = "date-t5";
     
   }elseif(isset($vv['date_array']["".__('Months',"premiumpress").""]) && $vv['date_array']["".__('Months',"premiumpress").""] > 0){
   $dID = "date-t4";
   
   }elseif(isset($vv['date_array']["".__('months',"premiumpress").""]) && $vv['date_array']["".__('months',"premiumpress").""] > 0){
   $dID = "date-t4";  
   
   }elseif(isset($vv['date_array']["".__('Days',"premiumpress").""]) &&  $vv['date_array']["".__('Days',"premiumpress").""] > 0){
   $dID = "date-t3";
   
   }elseif(isset($vv['date_array']["".__('days',"premiumpress").""]) &&  $vv['date_array']["".__('days',"premiumpress").""] > 0){
   $dID = "date-t3";
   
   }elseif(isset($vv['date_array']["".__('Hours',"premiumpress").""]) &&  $vv['date_array']["".__('Hours',"premiumpress").""] > 0){ 
   $dID = "date-t2";
   
   }elseif(isset($vv['date_array']["".__('hours',"premiumpress").""]) &&  $vv['date_array']["".__('hours',"premiumpress").""] > 0){ 
   $dID = "date-t2";
    
   
   }else{
   $dID = "date-t1";
   }
   
   // HITS
   if($map->hits > 10000){
   $hID = "p5";
   }elseif($map->hits > 1000){
   $hID = "p4";
   }elseif($map->hits > 100){
   $hID = "p3";	
   }elseif($map->hits > 10){
   $hID = "p2";		
   }else{
   $hID = "p1";
   }
   
   
   ?>
<div 
   class="addondata 
   <?php echo $catID; ?> 
   country-<?php echo $map->country; ?> 
   city-<?php echo $map->city; ?>
   hits-<?php echo $hID; ?>
   <?php echo $dID; ?> 
   "></div>
<?php
   }
   }
   
   /*
   <textarea style="width:100%; height:100px;"><?php echo $gg[0]; ?></textarea>
*/
?>  
 

<div class="btn-group btn-block mb-3" style="display:none;"  id="displayhidefilterbtn">
   <a href="javascript:void(0);" class="btn btn-outline-secondary rounded-0" onclick="switchfilters();"><i class="fa fa-sliders"></i> <?php echo __("Hide Filters","premiumpress") ?></a>
</div>
<div class="widget widget-mainsearchbox">

   <?php if($wp_query->found_posts > 0 && in_array(THEME_KEY, array('ct','mj','dt','rt','at')) && _ppt('google') == 1 ){ ?>
   <div class="searchmapbox mb-3 shadow-sm text-center">
      <img src="<?php echo FRAMREWORK_URI; ?>/img/mapicon.jpg" class="img-fluid"> 
      <a href="javascript:void(0);" class="btn btn-outline-light js-launchMap rounded-0" onclick="mapsearch(1);"><i class="fa fa-map-marker"></i> <?php echo __("View Map","premiumpress") ?></a>
   </div>
   <div class="clearfix"></div>
   <?php } ?>
   <form action="<?php echo get_home_url(); ?>/" method="get" name="mainsearchfilters" id="mainsearchfilters" class="clearfix" style="position:relative;">
      <?php 
         // ADD ON CORE KEYS
         $extrakeys = array('sold','refunds','power','verified','catid','subcatid','country','city','mapsearch','ship','pickup','new','used','featuredonly','favs','delivery1','delivery2','delivery3','delivery4','phone','bids','discount', 'beds',  'baths', 'ptype1', 'ptype2', 'ptype3', 'ptype4', 'ptype5', 'ptype6', 'ptype7', '1type1', '1type2','cp1','cp2','cp3','usedtoday', 'display','sr1','sr2','sr3','sr4','sr5','online','male','female', 'seekm', 'seekf','jobft','jobpt','jobcc','jobii','jobtt','level','type');
         foreach($extrakeys as $val){ if(isset($_GET[$val])){ ?>
      <input type="hidden" name="<?php echo esc_html($val); ?>" value="<?php echo esc_html($_GET[$val]); ?>" id="input-filter-<?php echo esc_html($val); ?>"/>
      <?php  
         } }
         
         // ADD ON SEARCH FILTERS
         $al = array();
         if(isset($_GET['ami']) && is_array($_GET['ami']) ){	 
         foreach($_GET['ami'] as $key => $val ){ ?>
      <input type="hidden" name="ami[]" id="input-ami-<?php echo trim($val); ?>" value="<?php echo $val; ?>" />
      <?php } } 
         // ADD ON SEARCH FILTERS
         $al = array();
         if(isset($_GET['ft']) && is_array($_GET['ft']) ){
         foreach($_GET['ft'] as $key => $val ){ if(in_array($val, $al)){ continue; } $al[] = $val; ?>
      <input type="hidden" name="ft[]" id="input-filter-<?php echo substr($val,0,2); ?>" value="<?php echo esc_html($val); ?>" />
      <?php } }  ?>
      <?php
         // get catid
         if(isset($GLOBALS['flag-taxonomy'])){
         $term = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
         if(isset($term->taxonomy) && $term->taxonomy == "listing"){?>
      <input type="hidden" name="catid" id="input-filter-taxid" value="<?php echo $term->term_id; ?>" />
      <?php } } ?>
      <?php
         if(is_array(_ppt('searchtax'))){
         $taxonomies = get_taxonomies(); 
         foreach ( $taxonomies as $taxonomy ) {
         if(in_array($taxonomy, _ppt('searchtax'))){  if(isset($_GET['tax-'.$taxonomy]) && is_numeric($_GET['tax-'.$taxonomy])){
         ?>    
      <input type="hidden" name="tax-<?php echo $taxonomy; ?>" id="input-tax-<?php echo $taxonomy; ?>" value="<?php  echo esc_html($_GET['tax-'.$taxonomy]); ?>" />
      <?php }  } }} ?>
      <?php if(isset($_GET['zipcode']) && $_GET['zipcode'] != ""){ ?>
      <input type="hidden" name="zipcode" id="input-filter-zip" value="<?php echo esc_html($_GET['zipcode']); ?>" />
      <?php } ?>
      <?php if(isset($_GET['radius']) && $_GET['radius'] != ""){ ?>
      <input type="hidden" name="radius" id="input-filter-radius" value="<?php echo esc_html($_GET['radius']); ?>" />
      <?php } ?>
      <div class="main-search-filter">
        
         
         
 
   
         
         
         
           <div class="card">
             
          <div class="p-3" id="basic_keysearch_wrap">
            <button type="submit" class="searchweb"><i class="fa fa-search float-right mt-1"></i> </button>
            <input  type="text" class="form-control" id="basic_keysearch" name="s" value="<?php if(isset($_GET['s']) && strlen($_GET['s']) > 1){ echo esc_html($_GET['s']); } ?>" placeholder="<?php echo __("Enter keyword...","premiumpress"); ?>" />
         </div>
         
          <?php if(in_array(THEME_KEY, array('dt', 'da','ct','jb','rt','at')) && _ppt('google') == 1){ ?>
         <div class="pl-3 pr-3 pb-3 pt-0" style="position:relative;">
            <button type="submit"  class="searchweb"><i class="fa fa-search float-right mt-1"></i> </button>
            <input type="text" class="form-control" id="zipcode" onchange="zipcodedo(this.value)" value="<?php if(isset($_GET['zipcode'])){ echo $_GET['zipcode']; } ?>" placeholder="<?php echo __("town, city, zipcode...","premiumpress"); ?>" />
         </div>
         <?php } ?>
         
         </div>
         
        
     
         
         
<div class="btn-group d-flex rounded-0 mb-3 shadow-sm" role="group" >
  <button type="button" class="btn btn-outlined-light rounded-0 <?php if(isset($_GET['display']) && $_GET['display'] == 2){ echo "bg-primary text-white"; } ?>" onclick="switchlayout(2);" style="cursor:pointer;     font-size: 11px;"><?php echo __("Full Width","premiumpress"); ?></button>
  <button type="button" class="btn btn-outlined-light <?php if(!isset($_GET['display']) && !in_array(THEME_KEY, array("da","at","rt","sp","mj","cm","vt")) || isset($_GET['display']) && $_GET['display'] == 1){ echo "bg-primary text-white"; } ?>" onclick="switchlayout(1);" style="cursor:pointer;font-size: 11px;">
  <i class="fas fa-list mr-2"></i> <?php echo __("List","premiumpress"); ?></button>
  <button type="button" class="btn btn-outlined-light rounded-0 <?php if(!isset($_GET['display']) && in_array(THEME_KEY, array("da","at","rt","sp","mj","cm","vt")) || isset($_GET['display']) && $_GET['display'] == 0){ echo "bg-primary text-white"; } ?>" onclick="switchlayout(0);"  style="cursor:pointer; font-size: 11px;" ><i class="far fa-square-full mr-2"></i> <?php echo __("Grid","premiumpress"); ?></button>
</div>     
        
         
         <?php if(in_array(THEME_KEY, array('da'))){ ?>
         <div class="card">
            <div class="card-header rounded-0"><?php echo __("Age Filter","premiumpress") ?></div>
            <ul class="list-group list-group-flush p-3">
               <?php
                  // FIND THE MAX PRICE OF ITEMS IN OUR DATABASE
                  							$SQL = "SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'daage' AND meta_value != '' ORDER BY CAST(meta_value as SIGNED INTEGER) DESC LIMIT 1"; 
                  							$result = $wpdb->get_results($SQL);
                  							if(empty($result)){
                  							$maxValue = "100";
                  							}else{
                  							$maxValue = $result[0]->meta_value;
                  							}
                  							
                  							$maxValue = hook_price(array($maxValue, true));
                  						 
                  							if(isset($_GET['a1']) && is_numeric($_GET['a1'])){ $price1 = esc_attr($_GET['a1']); }else{ $price1 = 0; }		
                  							if(isset($_GET['a2']) && is_numeric($_GET['a2']) && $_GET['a2'] > 0){ $price2 = esc_attr($_GET['a2']); }else{ $price2 = $maxValue; }	 
                  					 
                  					?>
               <input id="refine-price" data-slider-tooltip="hide" data-slider-min="0" data-slider-max="<?php echo $maxValue; ?>" data-slider-step="5" data-slider-value="[<?php echo $price1; ?>,<?php echo $price2; ?>]"/> 									
               <input type="hidden" name="a1" id="adsa1" value="<?php if(isset($_GET['a1']) && is_numeric($_GET['a1']) ){ echo esc_attr($_GET['a1']); } ?>">                    
               <input type="hidden" name="a2" id="adsa2" value="<?php if(isset($_GET['a2']) && is_numeric($_GET['a2']) ){ echo esc_attr($_GET['a2']); } ?>">               
               <script>
                  jQuery(document).ready(function() {
                  
                  setTimeout(function(){
                  
                  	if(jQuery('#refine-price').length != 0){
                  		  
                  		var $range = jQuery( "#refine-price" );
                  
                  		$range.ionRangeSlider({
                  			type: "double",	
                  			min: 0,
                  			max: <?php echo round(str_replace(",","",$maxValue),0); ?>,
                  			//values: [ <?php echo $price1; ?>,<?php echo $price2; ?> ],
                  			 <?php if(isset($_GET['a1']) && is_numeric($_GET['a1'])){ ?> from: <?php echo $price1; ?>,  to: <?php echo $price2; ?>, <?php } ?>
                  			
                  			 onFinish: function (data) {
                  			jQuery("#mainsearchfilters").submit();
                  			},
                  		});
                  		 
                  		
                  		$range.on("change", function () {
                  			var $this = jQuery(this),
                  				value = $this.prop("value").split(";");
                  				jQuery('#adsa1').val(value[0]);
                  				jQuery('#adsa2').val(value[1]);	
                  			 												 
                  		});
                  		
                  		 
                  	}
                  }, 1000);
                  
                  
                  });
               </script>
            </ul>
         </div>
         <?php } ?>
           
         <?php if(in_array(THEME_KEY, array('ct','mj','sp','rt','cm','at'))){ ?>
         <div class="card">
            <div class="card-header rounded-0"><?php echo __("Price Filter","premiumpress") ?></div>
            <ul class="list-group list-group-flush p-3">
               <?php
                  // FIND THE MAX PRICE OF ITEMS IN OUR DATABASE
                  							$SQL = "SELECT meta_value FROM ".$wpdb->prefix."postmeta WHERE meta_key = 'price' AND meta_value != '' ORDER BY CAST(meta_value as SIGNED INTEGER) DESC LIMIT 1"; 
                  							$result = $wpdb->get_results($SQL);
                  							if(empty($result)){
                  							$maxValue = "1000";
                  							}else{
                  							$maxValue = $result[0]->meta_value;
                  							}
                  							
                  							$maxValue = hook_price(array($maxValue, true));
                  						 
                  							if(isset($_GET['price1']) && is_numeric($_GET['price1'])){ $price1 = esc_attr($_GET['price1']); }else{ $price1 = 0; }		
                  							if(isset($_GET['price2']) && is_numeric($_GET['price2']) && $_GET['price2'] > 0){ $price2 = esc_attr($_GET['price2']); }else{ $price2 = $maxValue; }	 
                  					 
                  					?>
               <input id="refine-price" data-slider-tooltip="hide" data-slider-min="0" data-slider-max="<?php echo $maxValue; ?>" data-slider-step="5" data-slider-value="[<?php echo $price1; ?>,<?php echo $price2; ?>]"/> 									
               <input type="hidden" name="price1" id="adsprice1" value="<?php if(isset($_GET['price1']) && is_numeric($_GET['price1']) ){ echo esc_attr($_GET['price1']); } ?>">                    
               <input type="hidden" name="price2" id="adsprice2" value="<?php if(isset($_GET['price2']) && is_numeric($_GET['price2']) ){ echo esc_attr($_GET['price2']); } ?>">               
               <script>
                  jQuery(document).ready(function() {
                  
                  setTimeout(function(){
                  
                  	if(jQuery('#refine-price').length != 0){
                  		  
                  		var $range = jQuery( "#refine-price" );
                  
                  		$range.ionRangeSlider({
                  			type: "double",	
                  			min: 0,
                  			max: <?php echo round(str_replace(",","",$maxValue),0); ?>,
                  			//values: [ <?php echo $price1; ?>,<?php echo $price2; ?> ],
                  			 <?php if(isset($_GET['price1']) && is_numeric($_GET['price1'])){ ?> from: <?php echo $price1; ?>,  to: <?php echo $price2; ?>, <?php } ?>
                  			
                  			 onFinish: function (data) {
                  			jQuery("#mainsearchfilters").submit();
                  			},
                  		});
                  		 
                  		
                  		$range.on("change", function () {
                  			var $this = jQuery(this),
                  				value = $this.prop("value").split(";");
                  				jQuery('#adsprice1').val(value[0]);
                  				jQuery('#adsprice2').val(value[1]);	
                  			 												 
                  		});
                  		
                  		 // ADD ON PRICE TAG
                  		 jQuery('.irs-from').html('<?php echo _ppt(array('currency','symbol')); ?>'+jQuery('.irs-from').html());
                   jQuery('.irs-to').html('<?php echo _ppt(array('currency','symbol')); ?>'+jQuery('.irs-to').html());
                  
                  	}
                  }, 1000);
                  
                  
                  });
               </script>
            </ul>
         </div>
         <?php } ?>
         <script>
            function switchlayout(s){
			
            if(s == 1){
            
				jQuery('.listing-list-wrapper').addClass('big').removeClass('small');
			
			} else if(s == 2){
			
				MakeFullPageLay();
			
            }else{
            	jQuery('.listing-list-wrapper').addClass('small').removeClass('big');
            }
			 
            
            formid = "#mainsearchfilters"; 
                        		
                            	 
                           	// ADD NEW
                           	jQuery('<input>').attr({
                           		type: 'hidden',
                           		id: 'display',
                           		name: 'display',
                           		value: s,
                           	}).appendTo(formid);                  	 
                        	
                           	// SUBMIT
                           	jQuery(formid).submit();
            
            }
			
			function MakeFullPageLay(){
			
				jQuery('.pagemiddle').removeClass('col-12').removeClass('col-md-8').removeClass('col-lg-9').addClass('col-12 full-list');
				
				jQuery('aside').hide();
			
			}
			<?php
			if( ( !isset($_GET['display']) && in_array( THEME_KEY, array("sp","cm","mj")) ) || ( isset($_GET['display']) && $_GET['display'] == 2 ) ){ 
			?>
			jQuery(document).ready(function() {
			MakeFullPageLay();
			});
			<?php } ?>
         </script> 
         <div class="card showonlyb">
            <div class="card-header rounded-0">
            

  
               <?php echo __("Show Only","premiumpress"); ?>
            </div>
            <ul class="list-group list-group-flush addcheck">
               <?php if(THEME_KEY == "cp"){ ?>
               <li><i class="fa fa-tag text-dark mr-2 ml-1"></i> 
                  <?php echo __("Coupon Codes","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','cp1');" <?php if(isset($_GET['cp1'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <li><i class="fa fa-hand-stop-o text-dark mr-2 ml-1"></i> 
                  <?php echo __("Offers","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','cp2');" <?php if(isset($_GET['cp2'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               <li><i class="fa fa-print text-dark mr-2 ml-1"></i> 
                  <?php echo __("Printable Coupons","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','cp3');" <?php if(isset($_GET['cp3'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               <li><i class="fa fa-clock text-dark mr-2 ml-1"></i> 
                  <?php echo __("Used Today","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','usedtoday');" <?php if(isset($_GET['usedtoday'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               <?php } ?>
               <?php if($userdata->ID){ ?>
               <li><i class="fa fa-heart text-dark mr-2 ml-1"></i> <?php echo __("My Favorites","premiumpress") ?>               
               <label class="checkbox float-right">
               <input type="checkbox" data-toggle="checkbox" onChange="addnewfilter('1','favs');" <?php if(isset($_GET['favs'])){ ?>checked=checked<?php } ?>>
               </label>
               </li>
               <?php } ?>
               <?php if(in_array(THEME_KEY, array('at','ct','mj','dt','rt','da')) ){ ?>
               <li><i class="fa fa-check-circle text-success mr-2 ml-1"></i> <?php echo __("Verified Users","premiumpress"); ?>  
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','verified');" <?php if(isset($_GET['verified'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <?php } ?>
               <?php if(_ppt('powerseller_price') > 0){ ?>
               <li><img src="<?php echo get_template_directory_uri(); ?>/framework/img/medal.png" alt="" class="mr-2" /> <span class="mt-1"><?php echo __("Power Sellers","premiumpress") ?></span> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','power');" <?php if(isset($_GET['power'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <?php } ?>
               <li><i class="fal fa-award text-dark mr-2 ml-1"></i> 
                  <?php echo __("Featured","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','featuredonly');" <?php if(isset($_GET['featuredonly'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <?php  if(in_array(THEME_KEY, array('ct','at'))){ ?>
               <li><i class="fa fa-history text-dark mr-2 ml-1"></i> 
                  <?php echo __("Refunds Accepted","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','refunds');" <?php if(isset($_GET['refunds'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <li><i class="fa fa-dropbox text-dark mr-2 ml-1"></i> 
                  <?php echo __("Sold Items","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','sold');" <?php if(isset($_GET['sold'])){ ?>checked=checked<?php } ?>>
                  </label>                  
               </li>
               <li><i class="fa fa-handshake-o text-dark mr-2 ml-1"></i> 
                  <?php echo __("Pickup Only","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','pickup');" <?php if(isset($_GET['pickup'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <li><i class="fa fa-gift text-dark mr-2 ml-1"></i> 
                  <?php echo __("New Items","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','new');" <?php if(isset($_GET['new']) ){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <?php } ?>
               
               <?php if(THEME_KEY == "vt"){ ?>
               
               <li><i class="fa fa-refresh text-dark mr-2 ml-1"></i> 
                  <?php echo __("Video Series","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','type');" <?php if(isset($_GET['type']) ){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <li>
               <div class="mt-2 mx-2">
                        <select class="form-control form-control-sm" onChange="addnewfilter(this.value,'level');">
                              <option value="" <?php if( isset($_GET['level']) && $_GET['level'] == "" ){ ?>selected="selected"<?php } ?>> <?php echo __("All Levels","premiumpress") ?> </option>
                               <option value="1" <?php if( isset($_GET['level']) && $_GET['level'] == 1){ ?>selected="selected"<?php } ?>> <?php echo __("Beginner Videos","premiumpress") ?> </option>  
                               <option value="2" <?php if( isset($_GET['level']) && $_GET['level'] == 2){ ?>selected="selected"<?php } ?>> <?php echo __("Intermediate Videos","premiumpress") ?></option>  
                               <option value="3" <?php if( isset($_GET['level']) && $_GET['level'] == 3){ ?>selected="selected"<?php } ?>><?php echo __("Advanced Videos","premiumpress") ?> </option>  
                        </select>
                     </div>
               </li>
               
               <?php } ?>
               
               
               <?php if(THEME_KEY == "da"){ ?>
               <li><i class="fa fa-circle text-success  mr-2 ml-1"></i>
                  <?php echo __("Online Now","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','online');" <?php if(isset($_GET['online'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               <li><i class="fa fa-male mr-1 ml-1"></i>
                  <?php echo __("Men","premiumpress") ?> 
                  
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','male');" <?php if(isset($_GET['male'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               <li><i class="fa fa-female ml-1 mr-1"></i>
                  <?php echo __("Women","premiumpress") ?> 
                  
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','female');" <?php if(isset($_GET['female'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               <li><i class="far fa-mars  mr-2 ml-1"></i>
                  <?php echo __("Seeking Men","premiumpress") ?> 
                  
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','seekm');" <?php if(isset($_GET['seekm'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               <li><i class="far fa-venus  mr-2 ml-1"></i>
                  <?php echo __("Seeking Women","premiumpress") ?> 
                  
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','seekf');" <?php if(isset($_GET['seekf'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               <?php } ?>
               <?php if(THEME_KEY == "jb"){ ?>
               
              <li><i class="fa fa-angle-right mr-2 ml-1"></i>
                  <?php echo __("Full-time Jobs","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','jobft');" <?php if(isset($_GET['jobft'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
           	 <li><i class="fa fa-angle-right mr-2 ml-1"></i>
                  <?php echo __("Part-time Jobs","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','jobpt');" <?php if(isset($_GET['jobpt'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               
                <li><i class="fa fa-angle-right mr-2 ml-1"></i>
                  <?php echo __("Contract Jobs","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','jobcc');" <?php if(isset($_GET['jobcc'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
                <li><i class="fa fa-angle-right mr-2 ml-1"></i>
                  <?php echo __("Internship","premiumpress") ?> 
                  
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','jobii');" <?php if(isset($_GET['jobii'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
                <li><i class="fa fa-angle-right mr-2 ml-1"></i>
                  <?php echo __("Temporary Jobs","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','jobtt');" <?php if(isset($_GET['jobtt'])){ ?>checked=checked<?php } ?>>
                  </label>
                  
               </li>
               
           	
			<?php } ?>
               
               
               <?php if(THEME_KEY == "mj"){ ?>
               <li><i class="fa fa-bullhorn text-dark mr-2 ml-1"></i> 
                  <?php echo __("Sold Jobs","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','sold');" <?php if(isset($_GET['sold'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <?php } ?>
               <?php if(THEME_KEY == "dt"){ ?>
               <li><i class="fa fa-phone text-dark mr-2 ml-1"></i> 
                  <?php echo __("With Phone Number","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','phone');" <?php if(isset($_GET['phone'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <li class="ratingboxbit">
                  <input type="hidden" class="rating" data-filled="fa fa-star rating-rated" data-empty="far fa-star" data-fractions="1" value="<?php 
                     if(isset($_GET['sr1'])){ echo 1; }
                     elseif(isset($_GET['sr2'])){ echo 2; }
                     elseif(isset($_GET['sr3'])){ echo 3; }
                     elseif(isset($_GET['sr4'])){ echo 4; }
                     elseif(isset($_GET['sr5'])){ echo 5; } ?>" onchange="processstarratingchange(this.value)"/>
                  <script>
                     function processstarratingchange(r){
                     
                     	formid = "#mainsearchfilters";
                     	
                     	jQuery('#input-filter-sr1').remove();
                     	jQuery('#input-filter-sr2').remove();
                     	jQuery('#input-filter-sr3').remove();
                     	jQuery('#input-filter-sr4').remove();
                     	jQuery('#input-filter-sr5').remove();
                     	  
                     	jQuery('<input>').attr({
                                 			type: 'hidden',
                                 			id: 'sr'+r,
                                 			name: 'sr'+r,
                                 			value: 1,
                                 		}).appendTo(formid);
                     			 
                     
                     	// SUBMIT	 
                     				jQuery(formid).submit();
                     
                     }
                  </script> 
               </li>
               <?php } ?>
               <?php if(THEME_KEY == "at"){ ?>
               <li><i class="fa fa-hand-stop-o text-dark mr-2 ml-1"></i> 
                  <?php echo __("Has Bids","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','bids');" <?php if(isset($_GET['bids'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <?php } ?>
               <?php if(THEME_KEY == "sp"){ ?>
               <li><i class="fa fa-tag text-dark mr-2 ml-1"></i> 
                  <?php echo __("On Sale","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','discount');" <?php if(isset($_GET['discount'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <?php } ?>
               <?php if(THEME_KEY == "rt"){ ?>
               <li><i class="fa fa-money text-dark mr-2 ml-1"></i> 
                  <?php echo __("For Sale","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','1type1');" <?php if(isset($_GET['1type1'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <li><i class="fa fa-key text-dark mr-2 ml-1"></i> 
                  <?php echo __("For Rent","premiumpress") ?> 
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','1type2');" <?php if(isset($_GET['1type2'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <?php
                  $values = array(
                  1 => array("name" => __( 'Detached', 'premiumpress' ), "icon" => "fa-home"), 
                  2 => array("name" => __( 'Semi-Detached', 'premiumpress' ), "icon" => "fa-circle-o"),
                  3 => array("name" => __( 'Terraced', 'premiumpress' ), "icon" => "fa-circle-o"), 
                  4 => array("name" => __( 'Bungalow', 'premiumpress' ), "icon" => "fa-circle-o"), 
                  5 => array("name" => __( 'Land', 'premiumpress' ), "icon" => "fa-tree"), 
                  6 => array("name" => __( 'Apartment', 'premiumpress' ), "icon" => "fa-circle-o"), 
                  7 => array("name" => __( 'Office', 'premiumpress' ), "icon" => "fa-circle-o")
                  );
                  
                  ?>
               <?php foreach($values as $k => $v){ ?>
               <li><i class="fa <?php echo $v['icon']; ?> text-dark mr-2 ml-1"></i> 
                  <?php echo $v['name']; ?> <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','ptype<?php echo $k; ?>');" <?php if(isset($_GET['ptype'.$k])){ ?>checked=checked<?php } ?>>
               </li>
               <?php } ?>
               <li>
                  <div class="row py-1">
                     <div class="col-1">
                        <i class="fa fa-bed text-dark mr-1 ml-1 mt-2"></i> 
                     </div>
                     <div class="col-10 mr-0 pr-0">
                        <select class="form-control form-control-sm" onChange="addnewfilter(this.value,'beds');">
                           <option value="" <?php if(isset($_GET['beds']) && $_GET['beds'] == ""){ ?>selected=selected<?php } ?>><?php echo __("Any","premiumpress") ?></option>
                           <option value="1" <?php if(isset($_GET['beds']) && $_GET['beds'] == 1){ ?>selected=selected<?php } ?>>1 <?php echo __("Bedroom/ Studio","premiumpress") ?></option>
                           <option value="2" <?php if(isset($_GET['beds']) && $_GET['beds'] == 2){ ?>selected=selected<?php } ?>>2 <?php echo __("Bedrooms","premiumpress") ?></option>
                           <option value="3" <?php if(isset($_GET['beds']) && $_GET['beds'] == 3){ ?>selected=selected<?php } ?>>3 <?php echo __("Bedrooms","premiumpress") ?></option>
                           <option value="4" <?php if(isset($_GET['beds']) && $_GET['beds'] == 4){ ?>selected=selected<?php } ?>>4 <?php echo __("Bedrooms","premiumpress") ?></option>
                           <option value="5" <?php if(isset($_GET['beds']) && $_GET['beds'] == 5){ ?>selected=selected<?php } ?>>5 <?php echo __("Bedrooms","premiumpress") ?></option>
                           <option value="6" <?php if(isset($_GET['beds']) && $_GET['beds'] == 6){ ?>selected=selected<?php } ?>>6 <?php echo __("Bedrooms","premiumpress") ?></option>
                           <option value="7" <?php if(isset($_GET['beds']) && $_GET['beds'] == 7){ ?>selected=selected<?php } ?>>7 <?php echo __("Bedrooms","premiumpress") ?></option>
                           <option value="8" <?php if(isset($_GET['beds']) && $_GET['beds'] == 8){ ?>selected=selected<?php } ?>>8 <?php echo __("Bedrooms","premiumpress") ?></option>
                           <option value="9" <?php if(isset($_GET['beds']) && $_GET['beds'] == 9){ ?>selected=selected<?php } ?>>9 <?php echo __("Bedrooms","premiumpress") ?></option>
                           <option value="10" <?php if(isset($_GET['beds']) && $_GET['beds'] == 10){ ?>selected=selected<?php } ?>>10 <?php echo __("Bedrooms","premiumpress") ?></option>
                        </select>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="row py-1">
                     <div class="col-1">
                        <i class="fa fa-bath text-dark mr-1 ml-1 mt-2"></i> 
                     </div>
                     <div class="col-10 mr-0 pr-0">
                        <select class="form-control form-control-sm" onChange="addnewfilter(this.value,'baths');">
                           <option value="" <?php if(isset($_GET['baths']) && $_GET['baths'] == ""){ ?>selected=selected<?php } ?>><?php echo __("Any","premiumpress") ?></option>
                           <option value="1" <?php if(isset($_GET['baths']) && $_GET['baths'] == 1){ ?>selected=selected<?php } ?>>1 <?php echo __("Bathroom","premiumpress") ?></option>
                           <option value="2" <?php if(isset($_GET['baths']) && $_GET['baths'] == 2){ ?>selected=selected<?php } ?>>2 <?php echo __("Bathrooms","premiumpress") ?></option>
                           <option value="3" <?php if(isset($_GET['baths']) && $_GET['baths'] == 3){ ?>selected=selected<?php } ?>>3 <?php echo __("Bathrooms","premiumpress") ?></option>
                           <option value="4" <?php if(isset($_GET['baths']) && $_GET['baths'] == 4){ ?>selected=selected<?php } ?>>4 <?php echo __("Bathrooms","premiumpress") ?></option>
                           <option value="5" <?php if(isset($_GET['baths']) && $_GET['baths'] == 5){ ?>selected=selected<?php } ?>>5 <?php echo __("Bathrooms","premiumpress") ?></option>
                           <option value="6" <?php if(isset($_GET['baths']) && $_GET['baths'] == 6){ ?>selected=selected<?php } ?>>6 <?php echo __("Bathrooms","premiumpress") ?></option>
                           <option value="7" <?php if(isset($_GET['baths']) && $_GET['baths'] == 7){ ?>selected=selected<?php } ?>>7 <?php echo __("Bathrooms","premiumpress") ?></option>
                           <option value="8" <?php if(isset($_GET['baths']) && $_GET['baths'] == 8){ ?>selected=selected<?php } ?>>8 <?php echo __("Bathrooms","premiumpress") ?></option>
                           <option value="9" <?php if(isset($_GET['baths']) && $_GET['baths'] == 9){ ?>selected=selected<?php } ?>>9 <?php echo __("Bathrooms","premiumpress") ?></option>
                           <option value="10" <?php if(isset($_GET['baths']) && $_GET['baths'] == 10){ ?>selected=selected<?php } ?>>10 <?php echo __("Bathrooms","premiumpress") ?></option>
                        </select>
                     </div>
                  </div>
               </li>
               <?php } ?>
            </ul>
         </div>
         
<?php

echo $ADSEARCH->build_output_form();

?>
         
         
         <?php if(THEME_KEY == "dt" || THEME_KEY == "at" || THEME_KEY == "rt" ){ ?>
         <div class="card addcheck">
            <div class="card-header rounded-0"><?php if(THEME_KEY == "dt" || THEME_KEY == "rt" ){ echo __("Amenitites","premiumpress"); }else{ echo __("Features","premiumpress"); } ?></div>
            <ul class="list-group list-group-flush">
               <?php
                  $dtamenitites = get_option("dtamenitites"); 
                  if(is_array($dtamenitites)){ $i=0; $setKeys = array(); $selectedcatlist = array();
                  foreach($dtamenitites['name'] as $data){ if($dtamenitites['name'][$i] != "" ){ if($dtamenitites['search'][$i] != "yes"){ $i++; continue; }  ?>
               <li>
               <?php echo $dtamenitites['name'][$i]; ?>
               <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" 
                     value="<?php echo $dtamenitites['key'][$i]; ?>" 
                     <?php if(isset($_GET['ami']) && is_array($_GET['ami']) && in_array($dtamenitites['key'][$i], $_GET['ami'])){ ?> 
                     onChange="addnewfilter('<?php echo $dtamenitites['key'][$i]; ?>','removeami');"  checked=checked
                     <?php }else{ ?> onChange="addnewfilter('<?php echo $dtamenitites['key'][$i]; ?>','ami');" 
                     <?php } ?>>
                     </label>
               </li>
               <?php $i++; } }}  ?>  
            </ul>
         </div>
         <?php } ?> 
         <?php if(THEME_KEY == "mj"){ ?>
         <div class="card addcheck">
            <div class="card-header rounded-0"><?php echo __("Delivery Within;","premiumpress") ?></div>
            <ul class="list-group list-group-flush">
            
               <li><i class="fa fa-dropbox text-dark mr-2 ml-1"></i> 
                  <?php echo __("24/48 Hours","premiumpress") ?> 
                  
                  <label class="checkbox float-right">
                  <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','delivery1');" <?php if(isset($_GET['delivery1'])){ ?>checked=checked<?php } ?>>
                  </label>
               </li>
               <li><i class="fa fa-dropbox text-dark mr-2 ml-1"></i> 
                  <?php echo __("7 Days","premiumpress") ?> 
                  
                  <label class="checkbox float-right"><input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','delivery2');" <?php if(isset($_GET['delivery2'])){ ?>checked=checked<?php } ?>></label> </li>
               <li><i class="fa fa-dropbox text-dark mr-2 ml-1"></i>  <?php echo __("14 Days","premiumpress") ?> 
               <label class="checkbox float-right"> <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','delivery3');" <?php if(isset($_GET['delivery3'])){ ?>checked=checked<?php } ?>></label> </li>
               <li><i class="fa fa-dropbox text-dark mr-2 ml-1"></i>  <?php echo __("1 Month","premiumpress") ?>  
               <label class="checkbox float-right"> <input type="checkbox"  data-toggle="checkbox" onChange="addnewfilter('1','delivery4');" <?php if(isset($_GET['delivery4'])){ ?>checked=checked<?php } ?>></label> </li>
            </ul>
         </div>
         <?php } ?> 
         <?php
            $field = "map-country";
            $SQL = "SELECT DISTINCT ".$wpdb->postmeta.".meta_value FROM ".$wpdb->postmeta." 
            INNER JOIN ".$wpdb->posts." ON (".$wpdb->postmeta.".post_id = ".$wpdb->posts.".ID AND ".$wpdb->posts.".post_type = 'listing_type' AND ".$wpdb->posts.".post_status='publish'  )
            WHERE ".$wpdb->postmeta.".meta_key = ('".strip_tags($field)."') LIMIT 0,100";				 
            $query = $wpdb->get_results($SQL, OBJECT);
            if(!empty($query)){
            ?>
         <div class="card colapse">
            <div class="card-header rounded-0"><?php echo __("Location Filter","premiumpress") ?></div>
            <ul class="list-group list-group-flush addcount">
               <li class="top" id="filter-country0"><a href="javascript:void(0);" onclick="addnewfilter('removes','country');"><?php echo __("Any","premiumpress") ?></a></li>
               <?php foreach($query as $val){
                  $code = str_replace(" ","",$val->meta_value);
                  $country = "";
                  if(isset($GLOBALS['core_country_list'][$code]) ){ $country  = $GLOBALS['core_country_list'][$code]; }
                  if($country == ""){ continue; }
                  ?>
               <li id="filter-country<?php echo $code; ?>" data-type="country" data-value="<?php echo $code; ?>"  id="filter-country<?php echo $code; ?>">
                  <a href="javascript:void(0);" onclick="addnewfilter('<?php echo $code; ?>','country');"><?php echo $country; ?></a>
               </li>
               <?php if(isset($_GET['country']) && $_GET['country'] == $code){  $citites = $CORE->search_get_cities($_GET['country']);  
                  if(is_array($citites) && !empty($citites)){ foreach($citites as $city){
                  ?>
               <li  id="filter-c-<?php echo $city; ?>" data-type="city" data-value="<?php echo $city; ?>"  id="filter-city<?php echo $city; ?>">
                  <a href="javascript:void(0);" onclick="addnewfilter('<?php echo $city; ?>','city');"><i class="fa fa-angle-right"></i> <?php echo $city; ?></a>
               </li>
               <?php  } } ?>
               <?php } ?>
               <?php } ?>
            </ul>
         </div>
         <?php } ?>
         <?php
            if(is_array(_ppt('searchtax'))){
            $taxonomies = get_taxonomies(); 
            foreach ( $taxonomies as $taxonomy ) {
            if(in_array($taxonomy, _ppt('searchtax'))){ 
            ?>      
         <div class="card colapse">
            <div class="card-header rounded-0"><?php echo $taxonomy." ".__("Filter","premiumpress") ?></div>
            <ul class="list-group list-group-flush addcount catlistmain">
               <li class="top" id="filter-<?php echo $taxonomy; ?>all"><a href="javascript:void(0);" onclick="addtaxfilter('remove','<?php echo $taxonomy; ?>');"><?php echo __("Any","premiumpress") ?></a></li>
               <?php 
                  $categories = wp_list_categories( 
                  	array(
                  	'title_li'		=> '',
                  	'parent' 		=> 0,
                  	'taxonomy'  	=> $taxonomy, 
                  	'walker'		=> new walker_shortcode_filter_tax,
                  	//'child_of' 		=> '', 
                  	'hide_empty'	=> 1,
                  'fieldid' => ''
                  	) 
                  );
                  
                  echo $categories;
                  
                  ?>
               </li>
            </ul>
         </div>
         <?php } } } ?> 
         <?php if(THEME_KEY != "da"){ ?>
         <div class="card colapse">
            <div class="card-header rounded-0"><?php echo __("Category Filter","premiumpress") ?></div>
            <ul class="list-group list-group-flush addcount catlistmain">
               <li class="top" id="filter-catid0"><a href="javascript:void(0);" onclick="addnewfilter('removes','catid');"><?php echo __("Any","premiumpress") ?></a></li>
               <?php 
                  $categories = wp_list_categories( 
                  	array(
                  	'title_li'		=> '',
                  	'parent' 		=> 0,
                  	'taxonomy'  	=> 'listing', 
                  	'walker'		=> new walker_shortcode_filter_cats,
                  	//'child_of' 		=> '', 
                  	'hide_empty'	=> 1,
                  	) 
                  );
                  
                  
                  if(isset($_GET['catid'])){
                  
                  $categories = wp_list_categories( 
                  	array(
                  	'title_li'			=> '',
                  	'taxonomy'  	=> 'listing', 
                  	'walker'		=> new walker_shortcode_filter_cats,
                  	'hide_empty'	=> 0,
                  	'child_of' 		=> $_GET['catid']
                  	) 
                  );
                  
                  }
                  ?>
            </ul>
         </div>
         <?php } ?>
         <div class="card colapse">
            <div class="card-header rounded-0"><?php if(THEME_KEY == "da"){ echo __("Profile Added","premiumpress");  }else{ echo __("Date Added","premiumpress"); } ?></div>
            <ul class="list-group list-group-flush addcount">
               <li class="top" id="filter-t0"><a href="javascript:void(0);" onclick="addnewfilter('remove','t');"  ><?php echo __("Any","premiumpress") ?></a></li>
               <li data-type="date" data-value="t1" id="filter-t1"><a href="javascript:void(0);" onclick="addnewfilter('t1','t');"><?php echo __("Last Hour","premiumpress") ?></a></li>
               <li data-type="date" data-value="t2" id="filter-t2"><a href="javascript:void(0);" onclick="addnewfilter('t2','t');"><?php echo __("Today","premiumpress") ?></a></li>
               <li data-type="date" data-value="t3" id="filter-t3"><a href="javascript:void(0);" onclick="addnewfilter('t3','t');"><?php echo __("This Week","premiumpress") ?></a></li>
               <li data-type="date" data-value="t4" id="filter-t4"><a href="javascript:void(0);" onclick="addnewfilter('t4','t');"><?php echo __("This Month","premiumpress") ?></a></li>
            </ul>
         </div>
         <div class="card colapse">
            <div class="card-header rounded-0"><?php echo __("Popularity","premiumpress") ?></div>
            <ul class="list-group list-group-flush addcount">
               <li  class="top" id="filter-p0"><a href="javascript:void(0);" onclick="addnewfilter('remove','p');"><?php echo __("Any","premiumpress") ?></a></li>
               <li data-type="hits" data-value="p1" id="filter-p1"><a href="javascript:void(0);" onclick="addnewfilter('p1','p');"><?php echo __("< 10 Views","premiumpress") ?></a></li>
               <li data-type="hits" data-value="p2" id="filter-p2"><a href="javascript:void(0);" onclick="addnewfilter('p2','p');"><?php echo __("> 10 Views","premiumpress") ?></a></li>
               <li data-type="hits" data-value="p3" id="filter-p3"><a href="javascript:void(0);" onclick="addnewfilter('p3','p');"><?php echo __("> 100 Views","premiumpress") ?></a></li>
               <li data-type="hits" data-value="p4" id="filter-p4"><a href="javascript:void(0);" onclick="addnewfilter('p4','p');"><?php echo __("> 1000 Views","premiumpress") ?></a></li>
            </ul>
         </div>
         <?php /*
         <div class="card colapse">
            <div class="card-header rounded-0"><?php echo __("Sort Results By","premiumpress") ?></div>
            <ul class="list-group list-group-flush addradio">
               <li id="sortfilter-s4"><a href="javascript:void(0);" onclick="addnewfilter('s4','s');"><?php echo __("Featured Listings","premiumpress") ?> (<?php echo __("Top","premiumpress") ?>)</a></li>
               <li id="sortfilter-s1"><a href="javascript:void(0);" onclick="addnewfilter('s1','s');"><?php echo __("Title","premiumpress") ?> (A-z)</a></li>
               <li id="sortfilter-s1a"><a href="javascript:void(0);" onclick="addnewfilter('s1a','s');"><?php echo __("Title","premiumpress") ?> (Z-a)</a></li>
               <li id="sortfilter-s2"><a href="javascript:void(0);" onclick="addnewfilter('s2','s');"><?php echo __("Date Added","premiumpress") ?> (<?php echo __("Newest","premiumpress") ?>)</a></li>
               <li id="sortfilter-s2a"><a href="javascript:void(0);" onclick="addnewfilter('s2a','s');"><?php echo __("Date Added","premiumpress") ?> (<?php echo __("Oldest","premiumpress") ?>)</a></li>
               <li id="sortfilter-s3"><a href="javascript:void(0);" onclick="addnewfilter('s3','s');"><?php echo __("Popularity","premiumpress") ?> (<?php echo __("Most","premiumpress") ?>)</a></li>
               <li id="sortfilter-s3a"><a href="javascript:void(0);" onclick="addnewfilter('s3a','s');"><?php echo __("Popularity","premiumpress") ?> (<?php echo __("Least","premiumpress") ?>)</a></li>
               <?php if(in_array(THEME_KEY, array('ct','mj'))){ ?>
               <li id="sortfilter-s6"><a href="javascript:void(0);" onclick="addnewfilter('s6','s');"><?php echo __("Price","premiumpress") ?> (<?php echo __("Highest","premiumpress") ?>)</a>  </li>
               <li id="sortfilter-s6a"><a href="javascript:void(0);" onclick="addnewfilter('s6a','s');"><?php echo __("Price","premiumpress") ?> (<?php echo __("Lowest","premiumpress") ?>)</a>  </li>
               <?php } ?>
               
                    <!--<li><a href="javascript:void(0);" onclick="addnewfilter('s5','s');" id="sortfilter-s5"><?php echo __("Rating","premiumpress") ?></a>
               <li> -->
                  if(THEME_KEY == "at"){ ?>
               <li><a href="javascript:void(0);" onclick="addnewfilter('at1','s');" id="sortfilter-s7"><?php echo __("Auction Ending","premiumpress") ?></a></li>
               <li><a href="javascript:void(0);" onclick="addnewfilter('s6','s');" id="sortfilter-s6"><?php echo __("Price","premiumpress") ?></a></li>
               <?php }elseif(THEME_KEY == "cp"){ ?>
               <li><a href="javascript:void(0);" onclick="addnewfilter('cp1','s');" id="sortfilter-cp1"><?php echo __("Times Used","premiumpress") ?></a></li>
               <li><a href="javascript:void(0);" onclick="addnewfilter('cp2','s');" id="sortfilter-cp2"><?php echo __("Expiry Date","premiumpress") ?></a></li>
               <?php }else{ ?>
               <?php } 
                  
            </ul>
         </div>
         */ ?>
         <?php /*
            <?php if(defined('WLT_AUCTION')){ ?>
         <ul class="list-group">
            <li class="title"><?php echo __("Auction Ending","premiumpress") ?></li>
            <li  class="top"><a href="javascript:void(0);" onclick="addnewfilter('ae0','ae');" id="filter-ae0"><?php echo __("Any","premiumpress") ?></a></li>
            <li><a href="javascript:void(0);" onclick="addnewfilter('ae1','ae');" id="filter-ae1"><?php echo __("Next Hour","premiumpress") ?></a></li>
            <li><a href="javascript:void(0);" onclick="addnewfilter('ae5','ae');" id="filter-ae5"><?php echo __("Next Two Hour","premiumpress") ?></a></li>
            <li><a href="javascript:void(0);" onclick="addnewfilter('ae2','ae');" id="filter-ae2"><?php echo __("Today","premiumpress") ?></a></li>
            <li><a href="javascript:void(0);" onclick="addnewfilter('ae3','ae');" id="filter-ae3"><?php echo __("This Week","premiumpress") ?></a></li>
            <li><a href="javascript:void(0);" onclick="addnewfilter('ae4','ae');" id="filter-ae4"><?php echo __("This Month","premiumpress") ?></a></li>
         </ul>
         <?php }?>
         <?php if(defined('WLT_COUPON')){ ?>
         <div class="card">
            <div class="card-header rounded-0"><?php echo __("Time Remaining","premiumpress") ?></div>
            <ul class="list-group list-group-flush addcount">
               <li  class="top"  id="filter-ae0"><a href="javascript:void(0);" onclick="addnewfilter('remove','ae');"><?php echo __("Any","premiumpress") ?></a></li>
               <li id="filter-ae1"><a href="javascript:void(0);" onclick="addnewfilter('ae1','ae');" ><?php echo __("< 1 Hour","premiumpress") ?></a></li>
               <li id="filter-ae2"><a href="javascript:void(0);" onclick="addnewfilter('ae2','ae');"><?php echo __("< 1 Day","premiumpress") ?></a></li>
               <li id="filter-ae3"><a href="javascript:void(0);" onclick="addnewfilter('ae3','ae');" ><?php echo __("< 1 Week","premiumpress") ?></a></li>
               <li id="filter-ae4"><a href="javascript:void(0);" onclick="addnewfilter('ae4','ae');" ><?php echo __("< 1 Month","premiumpress") ?></a></li>
               <li id="filter-ae5"><a href="javascript:void(0);" onclick="addnewfilter('ae5','ae');" ><?php echo __("< 1 Year","premiumpress") ?></a></li>
            </ul>
         </div>
         <?php } */ ?>  
         <?php if(isset($_GET['s'])){ ?>
         <a href="<?php echo home_url(); ?>/?s=" class="btn btn-outline-secondary btn-block btn-sm mt-4 rounded-0 mb-5"><?php echo __("Reset Filters","premiumpress") ?></a> 
         <?php } ?>
      </div>
   </form>
</div>
<script>
   jQuery(document).ready(function() {
   
   // SET CLASS AND SYLES
   	jQuery('.main-search-filter ul li').addClass('list-group-item d-flex justify-content-between align-items-center notactive rounded-0');
   	
   	// ADDON COUNTERS
   	jQuery('.main-search-filter ul.addcount li').append('<span class="badge badge-pill badge-secondary novalue">0</span>');
   	
   	// ADDON RADIO BUTTONS
   	jQuery('.main-search-filter ul.addradio li').append('<input type="radio" class="float-right" disabled=disabled>');
    
   	// ADDON RADIO BUTTONS
   	jQuery('.main-search-filter .colapse .card-header').append('<i class="fa fa-angle-down float-right font-weight-bold" style="font-size: 20px;cursor:pointer;"></i>');
   
    	// LOOPS ALL KEYS AND SETS THE COUNT FOR THEM
   	jQuery('.main-search-filter ul li').each(function(){
   	
   		if(typeof jQuery(this).data('type') !== "undefined"){
   		
   			count = jQuery('.'+ jQuery(this).data('type') +'-'+jQuery(this).data('value')).length;
   		 
   			jQuery(this).find('.badge-pill').removeClass('badge-secondary').addClass( 'badge-secondary' ).html(  count  ); 
   			
   			
   			//console.log(jQuery(this).data('type') + ' - ' + count);
   			
   		} 
   	 
   	});
   	 
    
   	
   	<?php
      // CATEGORY
      	if(!isset($_GET['catid'])){
      ?>
   	 jQuery('#filter-catid0').addClass('bg-light');
   	<?php
      }elseif(isset($_GET['catid']) && is_numeric($_GET['catid']) ){  	
      ?>
   	jQuery('#filter-catidall').removeClass('bg-light');
   	jQuery('#filter-catid<?php echo $_GET['catid']; ?>').addClass('bg-light');		
   	<?php		 
      }
      
      // DATE ADDED
      if(in_array('t1',  $globalfilters) ){   ?> jQuery('#filter-t1').addClass('bg-light');<?php }
      if(in_array('t2',  $globalfilters) ){   ?> jQuery('#filter-t2').addClass('bg-light');<?php }
      if(in_array('t3',  $globalfilters) ){   ?> jQuery('#filter-t3').addClass('bg-light');<?php }
      if(in_array('t4',  $globalfilters) ){   ?> jQuery('#filter-t4').addClass('bg-light');<?php }
      if(in_array('t5',  $globalfilters) ){   ?> jQuery('#filter-t5').addClass('bg-light');<?php } 
      if(count(array_intersect(array('t1', 't2', 't3', 't4', 't5' ), $globalfilters)) == 0){
      ?>
   	 jQuery('#filter-t0').addClass('bg-light');
   	<?php
      }
      
      
      // POPULARITY
      if(in_array('p1',  $globalfilters) ){   ?> jQuery('#filter-p1').addClass('bg-light');<?php }
      if(in_array('p2',  $globalfilters) ){   ?> jQuery('#filter-p2').addClass('bg-light');<?php }
      if(in_array('p3',  $globalfilters) ){   ?> jQuery('#filter-p3').addClass('bg-light');<?php }
      if(in_array('p4',  $globalfilters) ){   ?> jQuery('#filter-p4').addClass('bg-light');<?php }
      if(in_array('p5',  $globalfilters) ){   ?> jQuery('#filter-p5').addClass('bg-light');<?php } 
      if(count(array_intersect(array('p1', 'p2', 'p3', 'p4', 'p5' ), $globalfilters)) == 0){
      ?>
   	 jQuery('#filter-p0').addClass('bg-light');
   	<?php
      }
      
      // show only
      if(in_array('z1',  $globalfilters) ){   ?> jQuery('#filter-z1').addClass('bg-light').find('input[type=check]').prop('checked', true);<?php }
      if(in_array('z2',  $globalfilters) ){   ?> jQuery('#filter-z2').addClass('bg-light');<?php }
      if(in_array('z3',  $globalfilters) ){   ?> jQuery('#filter-z3').addClass('bg-light');<?php }
      if(in_array('z4',  $globalfilters) ){   ?> jQuery('#filter-z4').addClass('bg-light');<?php }
      if(in_array('z5',  $globalfilters) ){   ?> jQuery('#filter-z5').addClass('bg-light');<?php } 
      if(count(array_intersect(array('z1', 'z2', 'z3', 'z4', 'z5' ), $globalfilters)) == 0){
      ?>
   	 jQuery('#filter-z0').addClass('bg-light');
   	<?php
      }
      
      
      // SORTBY
      if(in_array('s1',  $globalfilters) ){   ?> jQuery('#sortfilter-s1').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php }
      if(in_array('s1a',  $globalfilters) ){   ?> jQuery('#sortfilter-s1a').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php }
      if(in_array('s2',  $globalfilters) ){   ?> jQuery('#sortfilter-s2').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php }
      if(in_array('s2a',  $globalfilters) ){   ?> jQuery('#sortfilter-s2a').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php }
      if(in_array('s3',  $globalfilters) ){   ?> jQuery('#sortfilter-s3').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php }
      if(in_array('s3a',  $globalfilters) ){   ?> jQuery('#sortfilter-s3a').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php }
      if(in_array('s4',  $globalfilters) ){   ?> jQuery('#sortfilter-s4').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php }
      if(in_array('s5',  $globalfilters) ){   ?> jQuery('#sortfilter-s5').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php } 
      if(in_array('s6',  $globalfilters) ){   ?> jQuery('#sortfilter-s6').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php } 
      if(in_array('s6a',  $globalfilters) ){   ?> jQuery('#sortfilter-s6a').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php } 
      if(in_array('s7',  $globalfilters) ){   ?> jQuery('#sortfilter-s7').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php } 
      if(in_array('s8',  $globalfilters) ){   ?> jQuery('#sortfilter-s8').addClass('bg-light').find('input[type=radio]').prop('checked', true);<?php } 
      if(count(array_intersect(array('s1', 's1a', 's2', 's2a', 's3', 's3a', 's4', 's5','s6', 's6a', 's7','s8'), $globalfilters)) == 0){
      ?>
   	 jQuery('#sortfilter-s1').addClass('bg-light').find('input[type=radio]').prop('checked', true);
   	<?php
      }
      
      
      // COUNTRY
      if(!isset($_GET['country'])){
      ?>
   	 jQuery('#filter-country0').addClass('bg-light');
   	<?php
      }elseif(isset($_GET['country']) && $_GET['country'] != "" ){  	
      ?>
   	jQuery('#filter-countryall').removeClass('bg-light');
   	jQuery('#filter-country<?php echo $_GET['country']; ?>').addClass('bg-light');		
   	<?php		 
      }
      
      
      
      // TAXONOMY
      
      if(is_array(_ppt('searchtax'))){
      foreach ( $taxonomies as $taxonomy ) {  
      if(in_array($taxonomy, _ppt('searchtax'))){ 
      
      
      if(isset($_GET['tax-'.$taxonomy])){
      ?>
    	jQuery('#filter-<?php echo $taxonomy; ?>all').removeClass('bg-light');
   				jQuery('#filter-<?php echo $taxonomy; ?><?php echo $_GET['tax-'.$taxonomy]; ?>').addClass('bg-light');	
    <?php
      }
      
      } 
      } 
      }
      
        
        ?>
   	
   	
   	// FIANLLY LOOP ALL TOP VALUES AND SET THEM TO COUNT THE 
   	// TOTAL FOR THE SUB VALUES
   	jQuery('.main-search-filter ul').each(function(){	
    
    		count=0;
   		jQuery(this).find('li').each(function(){
   		
   			 t = parseFloat(jQuery(this).find('.badge-pill').html()); 
   			 if(!isNaN(t)){ 
   			 count = count + t;
   			 }
   			 
   		});
   		
   		jQuery(this).find('li.top .badge').html(count);  
   	});
   	
   	// CHANGE ICON FOR CAT FILTER
   	jQuery('.catlistmain .top').find('.badge-pill').html('<i class="fa fa-filter"></i>')
   	
   });
   
    
   
   /* =============================================================================
    SEARCH FILTERING SYSTEM
      ========================================================================== */
    
   	jQuery( ".card.colapse .card-header" ).click(function() {
   	 
   	   jQuery(this).parent().find('ul').slideToggle();
   	});
   
   /* =============================================================================
    MAP SEARCH OPTION
      ========================================================================== */
   
   function mapsearch(s){
   
   	// GET FORM ID
    formid = "#mainsearchfilters"; 
   
   	if(s == 2){
   	
   	jQuery('#mapsearch').remove();
   	
   	}else{
   	// ADD NEW
   	jQuery('<input>').attr({
   		type: 'hidden',
   		id: 'mapsearch',
   		name: 'mapsearch',
   		value: 1,
   	}).appendTo(formid);
   
   	
   	}
   	
   	// SUBMIT
   	jQuery(formid).submit();
   
   }
   
   
   
   /* =============================================================================
    SEARCH FILTERING SYSTEM
      ========================================================================== */
    
    function addtaxfilter(val, taxid){
   
   // GET FORM ID
   		 formid = "#mainsearchfilters";  
   
   if(val == "remove"){
   				
   			jQuery('#input-tax-'+taxid).remove(); 
   
   		}else{
   
   jQuery('#input-tax-'+taxid).remove(); 
   			
   jQuery('<input>').attr({
               			type: 'hidden',
               			id: 'input-tax-'+taxid,
               			name: 'tax-'+taxid,
               			value: val,
               		}).appendTo(formid);
   		}
   
   
   // SUBMIT	 
   			jQuery(formid).submit();
   
   
   }
   
    function zipcodedo(s){
               
     formid = "#mainsearchfilters"; 
               		
                   	 
                  	// ADD NEW
                  	jQuery('<input>').attr({
                  		type: 'hidden',
                  		id: 'zipcode',
                  		name: 'zipcode',
                  		value: s,
                  	}).appendTo(formid);
                  	jQuery('<input>').attr({
                  		type: 'hidden',
                  		id: 'radius',
                  		name: 'radius',
                  		value: 30,
                  	}).appendTo(formid);
               	
                  	// SUBMIT
                  	jQuery(formid).submit();
               	 
                  	
                  
                  }
   function addnewfilter(val, ids){
   
   		
   // GET FORM ID	
   		formid = "#mainsearchfilters";    
   		
   		// LOOP AND REMOVE EXISTING ONES
   		//jQuery('#input-filter-'+ids).each(function(){ 
   		//	jQuery('#input-filter-'+ids).remove();
   		//});      
         	
   		// CLEANUP POPULARITY
   		if(ids == "p"){
   			jQuery('#input-filter-p1').remove(); 
   			jQuery('#input-filter-p2').remove(); 
   			jQuery('#input-filter-p3').remove(); 
   			jQuery('#input-filter-p4').remove(); 
   			jQuery('#input-filter-p5').remove(); 
   		}		
   		// CLEANUP DATE
   		if(ids == "t"){
   			jQuery('#input-filter-t1').remove(); 
   			jQuery('#input-filter-t2').remove(); 
   			jQuery('#input-filter-t3').remove(); 
   			jQuery('#input-filter-t4').remove(); 
   			jQuery('#input-filter-t5').remove(); 
   		}		
   		// CLEANUP SORTBY
   		if(ids == "s"){
   			jQuery('#input-filter-s1').remove(); 
   			jQuery('#input-filter-s2').remove(); 
   			jQuery('#input-filter-s3').remove(); 
   			jQuery('#input-filter-s4').remove(); 
   			jQuery('#input-filter-s5').remove();
   			jQuery('#input-filter-s6').remove(); 
   			jQuery('#input-filter-s7').remove(); 
   			jQuery('#input-filter-s8').remove();			
   		}
   			
   		if(ids == "o"){
   			jQuery('#input-filter-o1').remove(); 
   			jQuery('#input-filter-o2').remove(); 
   		}
   				
   				
   		if(val == "remove"){
   				
   			jQuery('#input-filter-'+ids+'1').remove(); 
   			jQuery('#input-filter-'+ids+'2').remove(); 
   			jQuery('#input-filter-'+ids+'3').remove(); 
   			jQuery('#input-filter-'+ids+'4').remove(); 
   			jQuery('#input-filter-'+ids+'5').remove(); 
   			jQuery('#input-filter-'+ids+'6').remove(); 
   		 
   		 
   }else if(val == "removes"){
   				
   				jQuery('#input-filter-'+ids).remove(); 
   			
   		
   }else if(ids == "sold" || ids == "verified" || ids == "power" || ids == "refunds" || ids == "featuredonly" || ids == "new" || ids == "used" || ids == "pickup" || ids == "ship" || ids == "favs" ||  ids == "delivery1" ||  ids == "delivery2" ||  ids == "delivery3" ||  ids == "delivery4" ||  ids == "phone" ||  ids == "bids" ||  ids == "discount"  ||  ids == "beds" ||  ids == "baths" || ids == "ptype1" || ids == "ptype2" || ids == "ptype3" || ids == "ptype4" || ids == "ptype5" || ids == "ptype6" || ids == "ptype7"   || ids == "1type1" || ids == "1type2" || ids == "cp1" || ids == "cp2" || ids == "cp3" || ids == "usedtoday" || ids == "sr1" || ids == "sr2" || ids == "sr3" || ids == "sr4" || ids == "sr5" || ids == "online" || ids == "male" || ids == "female" || ids == "seekm" || ids == "seekf" || ids ==  "jobft" || ids ==  "jobpt" || ids ==  "jobii" || ids ==  "jobtt"  || ids ==  "jobcc"  || ids ==  "level" || ids ==  "type"  ){
            	
   	 		if(jQuery('#mainsearchfilters #input-filter-'+ids).length){
   			
   				jQuery('#input-filter-'+ids).remove(); 
   			
   			}else{
   
   				jQuery('<input>').attr({
               			type: 'hidden',
               			id: 'input-filter-'+ids,
               			name: ids,
               			value: val,
               		}).appendTo(formid);
   			}
   
    
    }else if(ids == "removeami"){
    
    jQuery('#input-ami-'+val).remove(); 
   
    }else if(ids == "ami"){
               	
               		// ADD NEW
               		jQuery('<input>').attr({
               			type: 'hidden',
               			id: 'input-ami-'+val,
               			name: 'ami[]',
               			value: val,
               		}).appendTo(formid);
               	
   						
            }else if(ids == "city" || ids == "catid" || ids == "country"){
               	
               		// ADD NEW
               		jQuery('<input>').attr({
               			type: 'hidden',
               			id: 'input-filter-'+ids,
               			name: ids,
               			value: val,
               		}).appendTo(formid);
               		
             }else{
               	 
               		// ADD NEW
               		jQuery('<input>').attr({
               			type: 'hidden',
               			id: 'input-filter-'+ids,
               			name: 'ft[]',
               			value: val,
               		}).appendTo(formid);
               		
               }
   			 
   				 
                // SUBMIT	 
   			jQuery(formid).submit();
   } 																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																													
   
   
   jQuery(document).ready(function() {
   ResizeChecks();
   
   }); 
   jQuery(window).on('resize', function(){
   
   ResizeChecks();
   }); 
   
   function ResizeChecks(){
   
   var win = jQuery(this); //this = window
   
   // Large devices (desktops, 992px and up)
   
   
      if (win.width() < 992) { 	  
   jQuery('#displayfilterbtn').show();
   jQuery('#main').addClass('expandbox');
   }
   
   
   if (win.width() < 576) { 	  
   jQuery('#main').addClass('expandsmall');
   }
   
   if (win.width() >= 992) { 
   jQuery('#displayfilterbtn').hide();
   jQuery('#main').removeClass('expandbox');	  
    }
   }
   
   
   
   
   
   /* =============================================================================
     SLIDER
      ========================================================================== */
   
   (function(f){"function"===typeof define&&define.amd?define(["jquery"],function(p){return f(p,document,window,navigator)}):"object"===typeof exports?f(require("jquery"),document,window,navigator):f(jQuery,document,window,navigator)})(function(f,p,h,t,q){var u=0,m=function(){var a=t.userAgent,b=/msie\s\d+/i;return 0<a.search(b)&&(a=b.exec(a).toString(),a=a.split(" ")[1],9>a)?(f("html").addClass("lt-ie9"),!0):!1}();Function.prototype.bind||(Function.prototype.bind=function(a){var b=this,d=[].slice;if("function"!=
   typeof b)throw new TypeError;var c=d.call(arguments,1),e=function(){if(this instanceof e){var g=function(){};g.prototype=b.prototype;var g=new g,l=b.apply(g,c.concat(d.call(arguments)));return Object(l)===l?l:g}return b.apply(a,c.concat(d.call(arguments)))};return e});Array.prototype.indexOf||(Array.prototype.indexOf=function(a,b){var d;if(null==this)throw new TypeError('"this" is null or not defined');var c=Object(this),e=c.length>>>0;if(0===e)return-1;d=+b||0;Infinity===Math.abs(d)&&(d=0);if(d>=
   e)return-1;for(d=Math.max(0<=d?d:e-Math.abs(d),0);d<e;){if(d in c&&c[d]===a)return d;d++}return-1});var r=function(a,b,d){this.VERSION="2.1.7";this.input=a;this.plugin_count=d;this.old_to=this.old_from=this.update_tm=this.calc_count=this.current_plugin=0;this.raf_id=this.old_min_interval=null;this.is_update=this.is_key=this.no_diapason=this.force_redraw=this.dragging=!1;this.is_start=!0;this.is_click=this.is_resize=this.is_active=this.is_finish=!1;b=b||{};this.$cache={win:f(h),body:f(p.body),input:f(a),
   cont:null,rs:null,min:null,max:null,from:null,to:null,single:null,bar:null,line:null,s_single:null,s_from:null,s_to:null,shad_single:null,shad_from:null,shad_to:null,edge:null,grid:null,grid_labels:[]};this.coords={x_gap:0,x_pointer:0,w_rs:0,w_rs_old:0,w_handle:0,p_gap:0,p_gap_left:0,p_gap_right:0,p_step:0,p_pointer:0,p_handle:0,p_single_fake:0,p_single_real:0,p_from_fake:0,p_from_real:0,p_to_fake:0,p_to_real:0,p_bar_x:0,p_bar_w:0,grid_gap:0,big_num:0,big:[],big_w:[],big_p:[],big_x:[]};this.labels=
   {w_min:0,w_max:0,w_from:0,w_to:0,w_single:0,p_min:0,p_max:0,p_from_fake:0,p_from_left:0,p_to_fake:0,p_to_left:0,p_single_fake:0,p_single_left:0};var c=this.$cache.input;a=c.prop("value");var e;d={type:"single",min:10,max:100,from:null,to:null,step:1,min_interval:0,max_interval:0,drag_interval:!1,values:[],p_values:[],from_fixed:!1,from_min:null,from_max:null,from_shadow:!1,to_fixed:!1,to_min:null,to_max:null,to_shadow:!1,prettify_enabled:!0,prettify_separator:" ",prettify:null,force_edges:!1,keyboard:!1,
   keyboard_step:5,grid:!1,grid_margin:!0,grid_num:4,grid_snap:!1,hide_min_max:!1,hide_from_to:!1,prefix:"",postfix:"",max_postfix:"",decorate_both:!0,values_separator:" \u2014 ",input_values_separator:";",disable:!1,onStart:null,onChange:null,onFinish:null,onUpdate:null};"INPUT"!==c[0].nodeName&&console&&console.warn&&console.warn("Base element should be <input>!",c[0]);c={type:c.data("type"),min:c.data("min"),max:c.data("max"),from:c.data("from"),to:c.data("to"),step:c.data("step"),min_interval:c.data("minInterval"),
   max_interval:c.data("maxInterval"),drag_interval:c.data("dragInterval"),values:c.data("values"),from_fixed:c.data("fromFixed"),from_min:c.data("fromMin"),from_max:c.data("fromMax"),from_shadow:c.data("fromShadow"),to_fixed:c.data("toFixed"),to_min:c.data("toMin"),to_max:c.data("toMax"),to_shadow:c.data("toShadow"),prettify_enabled:c.data("prettifyEnabled"),prettify_separator:c.data("prettifySeparator"),force_edges:c.data("forceEdges"),keyboard:c.data("keyboard"),keyboard_step:c.data("keyboardStep"),
   grid:c.data("grid"),grid_margin:c.data("gridMargin"),grid_num:c.data("gridNum"),grid_snap:c.data("gridSnap"),hide_min_max:c.data("hideMinMax"),hide_from_to:c.data("hideFromTo"),prefix:c.data("prefix"),postfix:c.data("postfix"),max_postfix:c.data("maxPostfix"),decorate_both:c.data("decorateBoth"),values_separator:c.data("valuesSeparator"),input_values_separator:c.data("inputValuesSeparator"),disable:c.data("disable")};c.values=c.values&&c.values.split(",");for(e in c)c.hasOwnProperty(e)&&(c[e]!==q&&
   ""!==c[e]||delete c[e]);a!==q&&""!==a&&(a=a.split(c.input_values_separator||b.input_values_separator||";"),a[0]&&a[0]==+a[0]&&(a[0]=+a[0]),a[1]&&a[1]==+a[1]&&(a[1]=+a[1]),b&&b.values&&b.values.length?(d.from=a[0]&&b.values.indexOf(a[0]),d.to=a[1]&&b.values.indexOf(a[1])):(d.from=a[0]&&+a[0],d.to=a[1]&&+a[1]));f.extend(d,b);f.extend(d,c);this.options=d;this.update_check={};this.validate();this.result={input:this.$cache.input,slider:null,min:this.options.min,max:this.options.max,from:this.options.from,
   from_percent:0,from_value:null,to:this.options.to,to_percent:0,to_value:null};this.init()};r.prototype={init:function(a){this.no_diapason=!1;this.coords.p_step=this.convertToPercent(this.options.step,!0);this.target="base";this.toggleInput();this.append();this.setMinMax();a?(this.force_redraw=!0,this.calc(!0),this.callOnUpdate()):(this.force_redraw=!0,this.calc(!0),this.callOnStart());this.updateScene()},append:function(){this.$cache.input.before('<span class="irs js-irs-'+this.plugin_count+'"></span>');
   this.$cache.input.prop("readonly",!0);this.$cache.cont=this.$cache.input.prev();this.result.slider=this.$cache.cont;this.$cache.cont.html('<span class="irs"><span class="irs-line" tabindex="-1"><span class="irs-line-left"></span><span class="irs-line-mid"></span><span class="irs-line-right"></span></span><span class="irs-min">0</span><span class="irs-max">1</span><span class="irs-from">0</span><span class="irs-to">0</span><span class="irs-single">0</span></span><span class="irs-grid"></span><span class="irs-bar"></span>');
   this.$cache.rs=this.$cache.cont.find(".irs");this.$cache.min=this.$cache.cont.find(".irs-min");this.$cache.max=this.$cache.cont.find(".irs-max");this.$cache.from=this.$cache.cont.find(".irs-from");this.$cache.to=this.$cache.cont.find(".irs-to");this.$cache.single=this.$cache.cont.find(".irs-single");this.$cache.bar=this.$cache.cont.find(".irs-bar");this.$cache.line=this.$cache.cont.find(".irs-line");this.$cache.grid=this.$cache.cont.find(".irs-grid");"single"===this.options.type?(this.$cache.cont.append('<span class="irs-bar-edge"></span><span class="irs-shadow shadow-single"></span><span class="irs-slider single"></span>'),
   this.$cache.edge=this.$cache.cont.find(".irs-bar-edge"),this.$cache.s_single=this.$cache.cont.find(".single"),this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.shad_single=this.$cache.cont.find(".shadow-single")):(this.$cache.cont.append('<span class="irs-shadow shadow-from"></span><span class="irs-shadow shadow-to"></span><span class="irs-slider from"></span><span class="irs-slider to"></span>'),this.$cache.s_from=this.$cache.cont.find(".from"),
   this.$cache.s_to=this.$cache.cont.find(".to"),this.$cache.shad_from=this.$cache.cont.find(".shadow-from"),this.$cache.shad_to=this.$cache.cont.find(".shadow-to"),this.setTopHandler());this.options.hide_from_to&&(this.$cache.from[0].style.display="none",this.$cache.to[0].style.display="none",this.$cache.single[0].style.display="none");this.appendGrid();this.options.disable?(this.appendDisableMask(),this.$cache.input[0].disabled=!0):(this.$cache.cont.removeClass("irs-disabled"),this.$cache.input[0].disabled=
   !1,this.bindEvents());this.options.drag_interval&&(this.$cache.bar[0].style.cursor="ew-resize")},setTopHandler:function(){var a=this.options.max,b=this.options.to;this.options.from>this.options.min&&b===a?this.$cache.s_from.addClass("type_last"):b<a&&this.$cache.s_to.addClass("type_last")},changeLevel:function(a){switch(a){case "single":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_single_fake);break;case "from":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_from_fake);
   this.$cache.s_from.addClass("state_hover");this.$cache.s_from.addClass("type_last");this.$cache.s_to.removeClass("type_last");break;case "to":this.coords.p_gap=this.toFixed(this.coords.p_pointer-this.coords.p_to_fake);this.$cache.s_to.addClass("state_hover");this.$cache.s_to.addClass("type_last");this.$cache.s_from.removeClass("type_last");break;case "both":this.coords.p_gap_left=this.toFixed(this.coords.p_pointer-this.coords.p_from_fake),this.coords.p_gap_right=this.toFixed(this.coords.p_to_fake-
   this.coords.p_pointer),this.$cache.s_to.removeClass("type_last"),this.$cache.s_from.removeClass("type_last")}},appendDisableMask:function(){this.$cache.cont.append('<span class="irs-disable-mask"></span>');this.$cache.cont.addClass("irs-disabled")},remove:function(){this.$cache.cont.remove();this.$cache.cont=null;this.$cache.line.off("keydown.irs_"+this.plugin_count);this.$cache.body.off("touchmove.irs_"+this.plugin_count);this.$cache.body.off("mousemove.irs_"+this.plugin_count);this.$cache.win.off("touchend.irs_"+
   this.plugin_count);this.$cache.win.off("mouseup.irs_"+this.plugin_count);m&&(this.$cache.body.off("mouseup.irs_"+this.plugin_count),this.$cache.body.off("mouseleave.irs_"+this.plugin_count));this.$cache.grid_labels=[];this.coords.big=[];this.coords.big_w=[];this.coords.big_p=[];this.coords.big_x=[];cancelAnimationFrame(this.raf_id)},bindEvents:function(){if(!this.no_diapason){this.$cache.body.on("touchmove.irs_"+this.plugin_count,this.pointerMove.bind(this));this.$cache.body.on("mousemove.irs_"+this.plugin_count,
   this.pointerMove.bind(this));this.$cache.win.on("touchend.irs_"+this.plugin_count,this.pointerUp.bind(this));this.$cache.win.on("mouseup.irs_"+this.plugin_count,this.pointerUp.bind(this));this.$cache.line.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"));this.$cache.line.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"));this.options.drag_interval&&"double"===this.options.type?(this.$cache.bar.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,
   "both")),this.$cache.bar.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"both"))):(this.$cache.bar.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.bar.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")));"single"===this.options.type?(this.$cache.single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.s_single.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),
   this.$cache.shad_single.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.s_single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"single")),this.$cache.edge.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_single.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click"))):(this.$cache.single.on("touchstart.irs_"+
   this.plugin_count,this.pointerDown.bind(this,null)),this.$cache.single.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,null)),this.$cache.from.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.s_from.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.to.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.s_to.on("touchstart.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),
   this.$cache.shad_from.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_to.on("touchstart.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.from.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.s_from.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"from")),this.$cache.to.on("mousedown.irs_"+this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.s_to.on("mousedown.irs_"+
   this.plugin_count,this.pointerDown.bind(this,"to")),this.$cache.shad_from.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")),this.$cache.shad_to.on("mousedown.irs_"+this.plugin_count,this.pointerClick.bind(this,"click")));if(this.options.keyboard)this.$cache.line.on("keydown.irs_"+this.plugin_count,this.key.bind(this,"keyboard"));m&&(this.$cache.body.on("mouseup.irs_"+this.plugin_count,this.pointerUp.bind(this)),this.$cache.body.on("mouseleave.irs_"+this.plugin_count,this.pointerUp.bind(this)))}},
   pointerMove:function(a){this.dragging&&(this.coords.x_pointer=(a.pageX||a.originalEvent.touches&&a.originalEvent.touches[0].pageX)-this.coords.x_gap,this.calc())},pointerUp:function(a){this.current_plugin===this.plugin_count&&this.is_active&&(this.is_active=!1,this.$cache.cont.find(".state_hover").removeClass("state_hover"),this.force_redraw=!0,m&&f("*").prop("unselectable",!1),this.updateScene(),this.restoreOriginalMinInterval(),(f.contains(this.$cache.cont[0],a.target)||this.dragging)&&this.callOnFinish(),
   this.dragging=!1)},pointerDown:function(a,b){b.preventDefault();var d=b.pageX||b.originalEvent.touches&&b.originalEvent.touches[0].pageX;2!==b.button&&("both"===a&&this.setTempMinInterval(),a||(a=this.target||"from"),this.current_plugin=this.plugin_count,this.target=a,this.dragging=this.is_active=!0,this.coords.x_gap=this.$cache.rs.offset().left,this.coords.x_pointer=d-this.coords.x_gap,this.calcPointerPercent(),this.changeLevel(a),m&&f("*").prop("unselectable",!0),this.$cache.line.trigger("focus"),
   this.updateScene())},pointerClick:function(a,b){b.preventDefault();var d=b.pageX||b.originalEvent.touches&&b.originalEvent.touches[0].pageX;2!==b.button&&(this.current_plugin=this.plugin_count,this.target=a,this.is_click=!0,this.coords.x_gap=this.$cache.rs.offset().left,this.coords.x_pointer=+(d-this.coords.x_gap).toFixed(),this.force_redraw=!0,this.calc(),this.$cache.line.trigger("focus"))},key:function(a,b){if(!(this.current_plugin!==this.plugin_count||b.altKey||b.ctrlKey||b.shiftKey||b.metaKey)){switch(b.which){case 83:case 65:case 40:case 37:b.preventDefault();
   this.moveByKey(!1);break;case 87:case 68:case 38:case 39:b.preventDefault(),this.moveByKey(!0)}return!0}},moveByKey:function(a){var b=this.coords.p_pointer,b=a?b+this.options.keyboard_step:b-this.options.keyboard_step;this.coords.x_pointer=this.toFixed(this.coords.w_rs/100*b);this.is_key=!0;this.calc()},setMinMax:function(){this.options&&(this.options.hide_min_max?(this.$cache.min[0].style.display="none",this.$cache.max[0].style.display="none"):(this.options.values.length?(this.$cache.min.html(this.decorate(this.options.p_values[this.options.min])),
   this.$cache.max.html(this.decorate(this.options.p_values[this.options.max]))):(this.$cache.min.html(this.decorate(this._prettify(this.options.min),this.options.min)),this.$cache.max.html(this.decorate(this._prettify(this.options.max),this.options.max))),this.labels.w_min=this.$cache.min.outerWidth(!1),this.labels.w_max=this.$cache.max.outerWidth(!1)))},setTempMinInterval:function(){var a=this.result.to-this.result.from;null===this.old_min_interval&&(this.old_min_interval=this.options.min_interval);
   this.options.min_interval=a},restoreOriginalMinInterval:function(){null!==this.old_min_interval&&(this.options.min_interval=this.old_min_interval,this.old_min_interval=null)},calc:function(a){if(this.options){this.calc_count++;if(10===this.calc_count||a)this.calc_count=0,this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.calcHandlePercent();if(this.coords.w_rs){this.calcPointerPercent();a=this.getHandleX();"both"===this.target&&(this.coords.p_gap=0,a=this.getHandleX());"click"===this.target&&(this.coords.p_gap=
   this.coords.p_handle/2,a=this.getHandleX(),this.target=this.options.drag_interval?"both_one":this.chooseHandle(a));switch(this.target){case "base":var b=(this.options.max-this.options.min)/100;a=(this.result.from-this.options.min)/b;b=(this.result.to-this.options.min)/b;this.coords.p_single_real=this.toFixed(a);this.coords.p_from_real=this.toFixed(a);this.coords.p_to_real=this.toFixed(b);this.coords.p_single_real=this.checkDiapason(this.coords.p_single_real,this.options.from_min,this.options.from_max);
   this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max);this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max);this.coords.p_single_fake=this.convertToFakePercent(this.coords.p_single_real);this.coords.p_from_fake=this.convertToFakePercent(this.coords.p_from_real);this.coords.p_to_fake=this.convertToFakePercent(this.coords.p_to_real);this.target=null;break;case "single":if(this.options.from_fixed)break;
   this.coords.p_single_real=this.convertToRealPercent(a);this.coords.p_single_real=this.calcWithStep(this.coords.p_single_real);this.coords.p_single_real=this.checkDiapason(this.coords.p_single_real,this.options.from_min,this.options.from_max);this.coords.p_single_fake=this.convertToFakePercent(this.coords.p_single_real);break;case "from":if(this.options.from_fixed)break;this.coords.p_from_real=this.convertToRealPercent(a);this.coords.p_from_real=this.calcWithStep(this.coords.p_from_real);this.coords.p_from_real>
   this.coords.p_to_real&&(this.coords.p_from_real=this.coords.p_to_real);this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max);this.coords.p_from_real=this.checkMinInterval(this.coords.p_from_real,this.coords.p_to_real,"from");this.coords.p_from_real=this.checkMaxInterval(this.coords.p_from_real,this.coords.p_to_real,"from");this.coords.p_from_fake=this.convertToFakePercent(this.coords.p_from_real);break;case "to":if(this.options.to_fixed)break;
   this.coords.p_to_real=this.convertToRealPercent(a);this.coords.p_to_real=this.calcWithStep(this.coords.p_to_real);this.coords.p_to_real<this.coords.p_from_real&&(this.coords.p_to_real=this.coords.p_from_real);this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max);this.coords.p_to_real=this.checkMinInterval(this.coords.p_to_real,this.coords.p_from_real,"to");this.coords.p_to_real=this.checkMaxInterval(this.coords.p_to_real,this.coords.p_from_real,"to");
   this.coords.p_to_fake=this.convertToFakePercent(this.coords.p_to_real);break;case "both":if(this.options.from_fixed||this.options.to_fixed)break;a=this.toFixed(a+.001*this.coords.p_handle);this.coords.p_from_real=this.convertToRealPercent(a)-this.coords.p_gap_left;this.coords.p_from_real=this.calcWithStep(this.coords.p_from_real);this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max);this.coords.p_from_real=this.checkMinInterval(this.coords.p_from_real,
   this.coords.p_to_real,"from");this.coords.p_from_fake=this.convertToFakePercent(this.coords.p_from_real);this.coords.p_to_real=this.convertToRealPercent(a)+this.coords.p_gap_right;this.coords.p_to_real=this.calcWithStep(this.coords.p_to_real);this.coords.p_to_real=this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max);this.coords.p_to_real=this.checkMinInterval(this.coords.p_to_real,this.coords.p_from_real,"to");this.coords.p_to_fake=this.convertToFakePercent(this.coords.p_to_real);
   break;case "both_one":if(!this.options.from_fixed&&!this.options.to_fixed){var d=this.convertToRealPercent(a);a=this.result.to_percent-this.result.from_percent;var c=a/2,b=d-c,d=d+c;0>b&&(b=0,d=b+a);100<d&&(d=100,b=d-a);this.coords.p_from_real=this.calcWithStep(b);this.coords.p_from_real=this.checkDiapason(this.coords.p_from_real,this.options.from_min,this.options.from_max);this.coords.p_from_fake=this.convertToFakePercent(this.coords.p_from_real);this.coords.p_to_real=this.calcWithStep(d);this.coords.p_to_real=
   this.checkDiapason(this.coords.p_to_real,this.options.to_min,this.options.to_max);this.coords.p_to_fake=this.convertToFakePercent(this.coords.p_to_real)}}"single"===this.options.type?(this.coords.p_bar_x=this.coords.p_handle/2,this.coords.p_bar_w=this.coords.p_single_fake,this.result.from_percent=this.coords.p_single_real,this.result.from=this.convertToValue(this.coords.p_single_real),this.options.values.length&&(this.result.from_value=this.options.values[this.result.from])):(this.coords.p_bar_x=
   this.toFixed(this.coords.p_from_fake+this.coords.p_handle/2),this.coords.p_bar_w=this.toFixed(this.coords.p_to_fake-this.coords.p_from_fake),this.result.from_percent=this.coords.p_from_real,this.result.from=this.convertToValue(this.coords.p_from_real),this.result.to_percent=this.coords.p_to_real,this.result.to=this.convertToValue(this.coords.p_to_real),this.options.values.length&&(this.result.from_value=this.options.values[this.result.from],this.result.to_value=this.options.values[this.result.to]));
   this.calcMinMax();this.calcLabels()}}},calcPointerPercent:function(){this.coords.w_rs?(0>this.coords.x_pointer||isNaN(this.coords.x_pointer)?this.coords.x_pointer=0:this.coords.x_pointer>this.coords.w_rs&&(this.coords.x_pointer=this.coords.w_rs),this.coords.p_pointer=this.toFixed(this.coords.x_pointer/this.coords.w_rs*100)):this.coords.p_pointer=0},convertToRealPercent:function(a){return a/(100-this.coords.p_handle)*100},convertToFakePercent:function(a){return a/100*(100-this.coords.p_handle)},getHandleX:function(){var a=
   100-this.coords.p_handle,b=this.toFixed(this.coords.p_pointer-this.coords.p_gap);0>b?b=0:b>a&&(b=a);return b},calcHandlePercent:function(){this.coords.w_handle="single"===this.options.type?this.$cache.s_single.outerWidth(!1):this.$cache.s_from.outerWidth(!1);this.coords.p_handle=this.toFixed(this.coords.w_handle/this.coords.w_rs*100)},chooseHandle:function(a){return"single"===this.options.type?"single":a>=this.coords.p_from_real+(this.coords.p_to_real-this.coords.p_from_real)/2?this.options.to_fixed?
   "from":"to":this.options.from_fixed?"to":"from"},calcMinMax:function(){this.coords.w_rs&&(this.labels.p_min=this.labels.w_min/this.coords.w_rs*100,this.labels.p_max=this.labels.w_max/this.coords.w_rs*100)},calcLabels:function(){this.coords.w_rs&&!this.options.hide_from_to&&("single"===this.options.type?(this.labels.w_single=this.$cache.single.outerWidth(!1),this.labels.p_single_fake=this.labels.w_single/this.coords.w_rs*100,this.labels.p_single_left=this.coords.p_single_fake+this.coords.p_handle/
   2-this.labels.p_single_fake/2):(this.labels.w_from=this.$cache.from.outerWidth(!1),this.labels.p_from_fake=this.labels.w_from/this.coords.w_rs*100,this.labels.p_from_left=this.coords.p_from_fake+this.coords.p_handle/2-this.labels.p_from_fake/2,this.labels.p_from_left=this.toFixed(this.labels.p_from_left),this.labels.p_from_left=this.checkEdges(this.labels.p_from_left,this.labels.p_from_fake),this.labels.w_to=this.$cache.to.outerWidth(!1),this.labels.p_to_fake=this.labels.w_to/this.coords.w_rs*100,
   this.labels.p_to_left=this.coords.p_to_fake+this.coords.p_handle/2-this.labels.p_to_fake/2,this.labels.p_to_left=this.toFixed(this.labels.p_to_left),this.labels.p_to_left=this.checkEdges(this.labels.p_to_left,this.labels.p_to_fake),this.labels.w_single=this.$cache.single.outerWidth(!1),this.labels.p_single_fake=this.labels.w_single/this.coords.w_rs*100,this.labels.p_single_left=(this.labels.p_from_left+this.labels.p_to_left+this.labels.p_to_fake)/2-this.labels.p_single_fake/2,this.labels.p_single_left=
   this.toFixed(this.labels.p_single_left)),this.labels.p_single_left=this.checkEdges(this.labels.p_single_left,this.labels.p_single_fake))},updateScene:function(){this.raf_id&&(cancelAnimationFrame(this.raf_id),this.raf_id=null);clearTimeout(this.update_tm);this.update_tm=null;this.options&&(this.drawHandles(),this.is_active?this.raf_id=requestAnimationFrame(this.updateScene.bind(this)):this.update_tm=setTimeout(this.updateScene.bind(this),300))},drawHandles:function(){this.coords.w_rs=this.$cache.rs.outerWidth(!1);
   if(this.coords.w_rs){this.coords.w_rs!==this.coords.w_rs_old&&(this.target="base",this.is_resize=!0);if(this.coords.w_rs!==this.coords.w_rs_old||this.force_redraw)this.setMinMax(),this.calc(!0),this.drawLabels(),this.options.grid&&(this.calcGridMargin(),this.calcGridLabels()),this.force_redraw=!0,this.coords.w_rs_old=this.coords.w_rs,this.drawShadow();if(this.coords.w_rs&&(this.dragging||this.force_redraw||this.is_key)){if(this.old_from!==this.result.from||this.old_to!==this.result.to||this.force_redraw||
   this.is_key){this.drawLabels();this.$cache.bar[0].style.left=this.coords.p_bar_x+"%";this.$cache.bar[0].style.width=this.coords.p_bar_w+"%";if("single"===this.options.type)this.$cache.s_single[0].style.left=this.coords.p_single_fake+"%";else{this.$cache.s_from[0].style.left=this.coords.p_from_fake+"%";this.$cache.s_to[0].style.left=this.coords.p_to_fake+"%";if(this.old_from!==this.result.from||this.force_redraw)this.$cache.from[0].style.left=this.labels.p_from_left+"%";if(this.old_to!==this.result.to||
   this.force_redraw)this.$cache.to[0].style.left=this.labels.p_to_left+"%"}this.$cache.single[0].style.left=this.labels.p_single_left+"%";this.writeToInput();this.old_from===this.result.from&&this.old_to===this.result.to||this.is_start||(this.$cache.input.trigger("change"),this.$cache.input.trigger("input"));this.old_from=this.result.from;this.old_to=this.result.to;this.is_resize||this.is_update||this.is_start||this.is_finish||this.callOnChange();if(this.is_key||this.is_click)this.is_click=this.is_key=
   !1,this.callOnFinish();this.is_finish=this.is_resize=this.is_update=!1}this.force_redraw=this.is_click=this.is_key=this.is_start=!1}}},drawLabels:function(){if(this.options){var a=this.options.values.length,b=this.options.p_values,d;if(!this.options.hide_from_to)if("single"===this.options.type)a=a?this.decorate(b[this.result.from]):this.decorate(this._prettify(this.result.from),this.result.from),this.$cache.single.html(a),this.calcLabels(),this.$cache.min[0].style.visibility=this.labels.p_single_left<
   this.labels.p_min+1?"hidden":"visible",this.$cache.max[0].style.visibility=this.labels.p_single_left+this.labels.p_single_fake>100-this.labels.p_max-1?"hidden":"visible";else{a?(this.options.decorate_both?(a=this.decorate(b[this.result.from]),a+=this.options.values_separator,a+=this.decorate(b[this.result.to])):a=this.decorate(b[this.result.from]+this.options.values_separator+b[this.result.to]),d=this.decorate(b[this.result.from]),b=this.decorate(b[this.result.to])):(this.options.decorate_both?(a=
   this.decorate(this._prettify(this.result.from),this.result.from),a+=this.options.values_separator,a+=this.decorate(this._prettify(this.result.to),this.result.to)):a=this.decorate(this._prettify(this.result.from)+this.options.values_separator+this._prettify(this.result.to),this.result.to),d=this.decorate(this._prettify(this.result.from),this.result.from),b=this.decorate(this._prettify(this.result.to),this.result.to));this.$cache.single.html(a);this.$cache.from.html(d);this.$cache.to.html(b);this.calcLabels();
   b=Math.min(this.labels.p_single_left,this.labels.p_from_left);a=this.labels.p_single_left+this.labels.p_single_fake;d=this.labels.p_to_left+this.labels.p_to_fake;var c=Math.max(a,d);this.labels.p_from_left+this.labels.p_from_fake>=this.labels.p_to_left?(this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.single[0].style.visibility="visible",this.result.from===this.result.to?("from"===this.target?this.$cache.from[0].style.visibility="visible":"to"===
   this.target?this.$cache.to[0].style.visibility="visible":this.target||(this.$cache.from[0].style.visibility="visible"),this.$cache.single[0].style.visibility="hidden",c=d):(this.$cache.from[0].style.visibility="hidden",this.$cache.to[0].style.visibility="hidden",this.$cache.single[0].style.visibility="visible",c=Math.max(a,d))):(this.$cache.from[0].style.visibility="visible",this.$cache.to[0].style.visibility="visible",this.$cache.single[0].style.visibility="hidden");this.$cache.min[0].style.visibility=
   b<this.labels.p_min+1?"hidden":"visible";this.$cache.max[0].style.visibility=c>100-this.labels.p_max-1?"hidden":"visible"}}},drawShadow:function(){var a=this.options,b=this.$cache,d="number"===typeof a.from_min&&!isNaN(a.from_min),c="number"===typeof a.from_max&&!isNaN(a.from_max),e="number"===typeof a.to_min&&!isNaN(a.to_min),g="number"===typeof a.to_max&&!isNaN(a.to_max);"single"===a.type?a.from_shadow&&(d||c)?(d=this.convertToPercent(d?a.from_min:a.min),c=this.convertToPercent(c?a.from_max:a.max)-
   d,d=this.toFixed(d-this.coords.p_handle/100*d),c=this.toFixed(c-this.coords.p_handle/100*c),d+=this.coords.p_handle/2,b.shad_single[0].style.display="block",b.shad_single[0].style.left=d+"%",b.shad_single[0].style.width=c+"%"):b.shad_single[0].style.display="none":(a.from_shadow&&(d||c)?(d=this.convertToPercent(d?a.from_min:a.min),c=this.convertToPercent(c?a.from_max:a.max)-d,d=this.toFixed(d-this.coords.p_handle/100*d),c=this.toFixed(c-this.coords.p_handle/100*c),d+=this.coords.p_handle/2,b.shad_from[0].style.display=
   "block",b.shad_from[0].style.left=d+"%",b.shad_from[0].style.width=c+"%"):b.shad_from[0].style.display="none",a.to_shadow&&(e||g)?(e=this.convertToPercent(e?a.to_min:a.min),a=this.convertToPercent(g?a.to_max:a.max)-e,e=this.toFixed(e-this.coords.p_handle/100*e),a=this.toFixed(a-this.coords.p_handle/100*a),e+=this.coords.p_handle/2,b.shad_to[0].style.display="block",b.shad_to[0].style.left=e+"%",b.shad_to[0].style.width=a+"%"):b.shad_to[0].style.display="none")},writeToInput:function(){"single"===
   this.options.type?(this.options.values.length?this.$cache.input.prop("value",this.result.from_value):this.$cache.input.prop("value",this.result.from),this.$cache.input.data("from",this.result.from)):(this.options.values.length?this.$cache.input.prop("value",this.result.from_value+this.options.input_values_separator+this.result.to_value):this.$cache.input.prop("value",this.result.from+this.options.input_values_separator+this.result.to),this.$cache.input.data("from",this.result.from),this.$cache.input.data("to",
   this.result.to))},callOnStart:function(){this.writeToInput();if(this.options.onStart&&"function"===typeof this.options.onStart)this.options.onStart(this.result)},callOnChange:function(){this.writeToInput();if(this.options.onChange&&"function"===typeof this.options.onChange)this.options.onChange(this.result)},callOnFinish:function(){this.writeToInput();if(this.options.onFinish&&"function"===typeof this.options.onFinish)this.options.onFinish(this.result)},callOnUpdate:function(){this.writeToInput();
   if(this.options.onUpdate&&"function"===typeof this.options.onUpdate)this.options.onUpdate(this.result)},toggleInput:function(){this.$cache.input.toggleClass("irs-hidden-input")},convertToPercent:function(a,b){var d=this.options.max-this.options.min;return d?this.toFixed((b?a:a-this.options.min)/(d/100)):(this.no_diapason=!0,0)},convertToValue:function(a){var b=this.options.min,d=this.options.max,c=b.toString().split(".")[1],e=d.toString().split(".")[1],g,l,f=0,k=0;if(0===a)return this.options.min;
   if(100===a)return this.options.max;c&&(f=g=c.length);e&&(f=l=e.length);g&&l&&(f=g>=l?g:l);0>b&&(k=Math.abs(b),b=+(b+k).toFixed(f),d=+(d+k).toFixed(f));a=(d-b)/100*a+b;(b=this.options.step.toString().split(".")[1])?a=+a.toFixed(b.length):(a/=this.options.step,a*=this.options.step,a=+a.toFixed(0));k&&(a-=k);k=b?+a.toFixed(b.length):this.toFixed(a);k<this.options.min?k=this.options.min:k>this.options.max&&(k=this.options.max);return k},calcWithStep:function(a){var b=Math.round(a/this.coords.p_step)*
   this.coords.p_step;100<b&&(b=100);100===a&&(b=100);return this.toFixed(b)},checkMinInterval:function(a,b,d){var c=this.options;if(!c.min_interval)return a;a=this.convertToValue(a);b=this.convertToValue(b);"from"===d?b-a<c.min_interval&&(a=b-c.min_interval):a-b<c.min_interval&&(a=b+c.min_interval);return this.convertToPercent(a)},checkMaxInterval:function(a,b,d){var c=this.options;if(!c.max_interval)return a;a=this.convertToValue(a);b=this.convertToValue(b);"from"===d?b-a>c.max_interval&&(a=b-c.max_interval):
   a-b>c.max_interval&&(a=b+c.max_interval);return this.convertToPercent(a)},checkDiapason:function(a,b,d){a=this.convertToValue(a);var c=this.options;"number"!==typeof b&&(b=c.min);"number"!==typeof d&&(d=c.max);a<b&&(a=b);a>d&&(a=d);return this.convertToPercent(a)},toFixed:function(a){a=a.toFixed(20);return+a},_prettify:function(a){return this.options.prettify_enabled?this.options.prettify&&"function"===typeof this.options.prettify?this.options.prettify(a):this.prettify(a):a},prettify:function(a){return a.toString().replace(/(\d{1,3}(?=(?:\d\d\d)+(?!\d)))/g,
   "$1"+this.options.prettify_separator)},checkEdges:function(a,b){if(!this.options.force_edges)return this.toFixed(a);0>a?a=0:a>100-b&&(a=100-b);return this.toFixed(a)},validate:function(){var a=this.options,b=this.result,d=a.values,c=d.length,e,g;"string"===typeof a.min&&(a.min=+a.min);"string"===typeof a.max&&(a.max=+a.max);"string"===typeof a.from&&(a.from=+a.from);"string"===typeof a.to&&(a.to=+a.to);"string"===typeof a.step&&(a.step=+a.step);"string"===typeof a.from_min&&(a.from_min=+a.from_min);
   "string"===typeof a.from_max&&(a.from_max=+a.from_max);"string"===typeof a.to_min&&(a.to_min=+a.to_min);"string"===typeof a.to_max&&(a.to_max=+a.to_max);"string"===typeof a.keyboard_step&&(a.keyboard_step=+a.keyboard_step);"string"===typeof a.grid_num&&(a.grid_num=+a.grid_num);a.max<a.min&&(a.max=a.min);if(c)for(a.p_values=[],a.min=0,a.max=c-1,a.step=1,a.grid_num=a.max,a.grid_snap=!0,g=0;g<c;g++)e=+d[g],isNaN(e)?e=d[g]:(d[g]=e,e=this._prettify(e)),a.p_values.push(e);if("number"!==typeof a.from||isNaN(a.from))a.from=
   a.min;if("number"!==typeof a.to||isNaN(a.to))a.to=a.max;"single"===a.type?(a.from<a.min&&(a.from=a.min),a.from>a.max&&(a.from=a.max)):(a.from<a.min&&(a.from=a.min),a.from>a.max&&(a.from=a.max),a.to<a.min&&(a.to=a.min),a.to>a.max&&(a.to=a.max),this.update_check.from&&(this.update_check.from!==a.from&&a.from>a.to&&(a.from=a.to),this.update_check.to!==a.to&&a.to<a.from&&(a.to=a.from)),a.from>a.to&&(a.from=a.to),a.to<a.from&&(a.to=a.from));if("number"!==typeof a.step||isNaN(a.step)||!a.step||0>a.step)a.step=
   1;if("number"!==typeof a.keyboard_step||isNaN(a.keyboard_step)||!a.keyboard_step||0>a.keyboard_step)a.keyboard_step=5;"number"===typeof a.from_min&&a.from<a.from_min&&(a.from=a.from_min);"number"===typeof a.from_max&&a.from>a.from_max&&(a.from=a.from_max);"number"===typeof a.to_min&&a.to<a.to_min&&(a.to=a.to_min);"number"===typeof a.to_max&&a.from>a.to_max&&(a.to=a.to_max);if(b){b.min!==a.min&&(b.min=a.min);b.max!==a.max&&(b.max=a.max);if(b.from<b.min||b.from>b.max)b.from=a.from;if(b.to<b.min||b.to>
   b.max)b.to=a.to}if("number"!==typeof a.min_interval||isNaN(a.min_interval)||!a.min_interval||0>a.min_interval)a.min_interval=0;if("number"!==typeof a.max_interval||isNaN(a.max_interval)||!a.max_interval||0>a.max_interval)a.max_interval=0;a.min_interval&&a.min_interval>a.max-a.min&&(a.min_interval=a.max-a.min);a.max_interval&&a.max_interval>a.max-a.min&&(a.max_interval=a.max-a.min)},decorate:function(a,b){var d="",c=this.options;c.prefix&&(d+=c.prefix);d+=a;c.max_postfix&&(c.values.length&&a===c.p_values[c.max]?
   (d+=c.max_postfix,c.postfix&&(d+=" ")):b===c.max&&(d+=c.max_postfix,c.postfix&&(d+=" ")));c.postfix&&(d+=c.postfix);return d},updateFrom:function(){this.result.from=this.options.from;this.result.from_percent=this.convertToPercent(this.result.from);this.options.values&&(this.result.from_value=this.options.values[this.result.from])},updateTo:function(){this.result.to=this.options.to;this.result.to_percent=this.convertToPercent(this.result.to);this.options.values&&(this.result.to_value=this.options.values[this.result.to])},
   updateResult:function(){this.result.min=this.options.min;this.result.max=this.options.max;this.updateFrom();this.updateTo()},appendGrid:function(){if(this.options.grid){var a=this.options,b,d;b=a.max-a.min;var c=a.grid_num,e,g,f=4,h,k,m,n="";this.calcGridMargin();a.grid_snap?50<b?(c=50/a.step,e=this.toFixed(a.step/.5)):(c=b/a.step,e=this.toFixed(a.step/(b/100))):e=this.toFixed(100/c);4<c&&(f=3);7<c&&(f=2);14<c&&(f=1);28<c&&(f=0);for(b=0;b<c+1;b++){h=f;g=this.toFixed(e*b);100<g&&(g=100,h-=2,0>h&&(h=
   0));this.coords.big[b]=g;k=(g-e*(b-1))/(h+1);for(d=1;d<=h&&0!==g;d++)m=this.toFixed(g-k*d),n+='<span class="irs-grid-pol small" style="left: '+m+'%"></span>';n+='<span class="irs-grid-pol" style="left: '+g+'%"></span>';d=this.convertToValue(g);d=a.values.length?a.p_values[d]:this._prettify(d);n+='<span class="irs-grid-text js-grid-text-'+b+'" style="left: '+g+'%">'+d+"</span>"}this.coords.big_num=Math.ceil(c+1);this.$cache.cont.addClass("irs-with-grid");this.$cache.grid.html(n);this.cacheGridLabels()}},
   cacheGridLabels:function(){var a,b,d=this.coords.big_num;for(b=0;b<d;b++)a=this.$cache.grid.find(".js-grid-text-"+b),this.$cache.grid_labels.push(a);this.calcGridLabels()},calcGridLabels:function(){var a,b;b=[];var d=[],c=this.coords.big_num;for(a=0;a<c;a++)this.coords.big_w[a]=this.$cache.grid_labels[a].outerWidth(!1),this.coords.big_p[a]=this.toFixed(this.coords.big_w[a]/this.coords.w_rs*100),this.coords.big_x[a]=this.toFixed(this.coords.big_p[a]/2),b[a]=this.toFixed(this.coords.big[a]-this.coords.big_x[a]),
   d[a]=this.toFixed(b[a]+this.coords.big_p[a]);this.options.force_edges&&(b[0]<-this.coords.grid_gap&&(b[0]=-this.coords.grid_gap,d[0]=this.toFixed(b[0]+this.coords.big_p[0]),this.coords.big_x[0]=this.coords.grid_gap),d[c-1]>100+this.coords.grid_gap&&(d[c-1]=100+this.coords.grid_gap,b[c-1]=this.toFixed(d[c-1]-this.coords.big_p[c-1]),this.coords.big_x[c-1]=this.toFixed(this.coords.big_p[c-1]-this.coords.grid_gap)));this.calcGridCollision(2,b,d);this.calcGridCollision(4,b,d);for(a=0;a<c;a++)b=this.$cache.grid_labels[a][0],
   this.coords.big_x[a]!==Number.POSITIVE_INFINITY&&(b.style.marginLeft=-this.coords.big_x[a]+"%")},calcGridCollision:function(a,b,d){var c,e,g,f=this.coords.big_num;for(c=0;c<f;c+=a){e=c+a/2;if(e>=f)break;g=this.$cache.grid_labels[e][0];g.style.visibility=d[c]<=b[e]?"visible":"hidden"}},calcGridMargin:function(){this.options.grid_margin&&(this.coords.w_rs=this.$cache.rs.outerWidth(!1),this.coords.w_rs&&(this.coords.w_handle="single"===this.options.type?this.$cache.s_single.outerWidth(!1):this.$cache.s_from.outerWidth(!1),
   this.coords.p_handle=this.toFixed(this.coords.w_handle/this.coords.w_rs*100),this.coords.grid_gap=this.toFixed(this.coords.p_handle/2-.1),this.$cache.grid[0].style.width=this.toFixed(100-this.coords.p_handle)+"%",this.$cache.grid[0].style.left=this.coords.grid_gap+"%"))},update:function(a){this.input&&(this.is_update=!0,this.options.from=this.result.from,this.options.to=this.result.to,this.update_check.from=this.result.from,this.update_check.to=this.result.to,this.options=f.extend(this.options,a),
   this.validate(),this.updateResult(a),this.toggleInput(),this.remove(),this.init(!0))},reset:function(){this.input&&(this.updateResult(),this.update())},destroy:function(){this.input&&(this.toggleInput(),this.$cache.input.prop("readonly",!1),f.data(this.input,"ionRangeSlider",null),this.remove(),this.options=this.input=null)}};f.fn.ionRangeSlider=function(a){return this.each(function(){f.data(this,"ionRangeSlider")||f.data(this,"ionRangeSlider",new r(this,a,u++))})};(function(){for(var a=0,b=["ms",
   "moz","webkit","o"],d=0;d<b.length&&!h.requestAnimationFrame;++d)h.requestAnimationFrame=h[b[d]+"RequestAnimationFrame"],h.cancelAnimationFrame=h[b[d]+"CancelAnimationFrame"]||h[b[d]+"CancelRequestAnimationFrame"];h.requestAnimationFrame||(h.requestAnimationFrame=function(b,d){var c=(new Date).getTime(),e=Math.max(0,16-(c-a)),f=h.setTimeout(function(){b(c+e)},e);a=c+e;return f});h.cancelAnimationFrame||(h.cancelAnimationFrame=function(a){clearTimeout(a)})})()});
</script>
<?php } ?>