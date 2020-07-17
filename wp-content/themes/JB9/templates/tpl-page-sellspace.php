<?php
   /*
   Template Name: [PAGE - ADVERTISING]
   */
   
   global $wpdb, $post, $wp_query, $userdata; $shown= 1;
   
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   if(!_ppt_checkfile("tpl-page-sellspace.php")){
   
   // GET DATA
   $sellspace = $CORE->SELLSPACE(2);  $sellspacedata = _ppt('sellspace');
               
   $mybanners = $CORE->SELLSPACE(3, $userdata->ID);
               
   $sellspacedata = _ppt('sellspace');
   
   $campaigns = new WP_Query( array('posts_per_page' => 200, 'post_type' => 'wlt_campaign', 'orderby' => 'post_date', 'order' => 'desc', 'author' => $userdata->ID  ) );
    
   $showcart = false; 
   
   // + DEFAULT SIDEBAR
   if(get_post_meta($post->ID,'pagecolumns',true) == ""){ define('PPTCOL', 1);  }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
   // + PAGE TOP
   get_template_part( 'page', 'top' ); ?>
   
<div class="content-wrapper">
   <?php get_template_part('templates/page-top', 'text' ); ?>
   
   
   <?php if(empty($sellspace)){ ?>
   
   <div class="bg-light mt-4 p-4 text-center h6">
   <?php echo __("Sold Out!","premiumpress"); ?>
   </div>
   <?php }elseif(is_array($sellspace) && !empty($sellspace)){ ?>
<div id="packagesbox">
   <div class="col-md-12 px-0">
      <script>var banner = [];</script>
      <div class="package-tab-content">
         
         <?php foreach($sellspace as $key => $sp){ 
            // GET PRICE
            $price = stripslashes($sellspacedata[$key."_price"]);
            if(!is_numeric($price)){ $price = 10; }
            
            // COUNT EXISTING ADVERTISERS
            $SQL = "SELECT COUNT(*) AS total FROM `".$wpdb->prefix."posts` WHERE post_type='wlt_campaign' AND post_status='publish' AND post_title LIKE ('%". $key ."%') "; 
            $tt = $wpdb->get_results($SQL, OBJECT);
            
            // COUNT TOTAL LEFT
            $spaceleft = (stripslashes($sellspacedata[$key."_max"]) - $tt[0]->total );
            
            ?>
         <div class="package-posts py-4 col-12 <?php if($shown%2){ ?><?php } ?>bg-light">
            <div class="row">
               <div class="col-md-3 box-price text-center">
                  <div class="text-success h1"><?php echo hook_price($price); ?></div>
                  <p><?php echo __("for","premiumpress"); ?> <?php echo stripslashes($sellspacedata[$key."_days"]); ?> <?php echo __("days","premiumpress"); ?></p>
               </div>
               <div class="col-md-6 text-left box-desc">
                  <h5 class="mt-2"><?php echo stripslashes($sellspacedata[$key."_name"]); ?></h5>
                  <p><?php echo stripslashes($sellspacedata[$key."_desc"]); ?></p>
                  <p class="small"><?php echo __("Size","premiumpress"); ?>: <?php 
                     echo $sellspacedata[$key."_size"]; ?> <?php if($sellspacedata[$key."_max"] > $sellspace[$key]["max"] ){ ?>(<?php echo __("banner will rotate","premiumpress"); ?>)<?php } ?></p>
               </div>
               <div class="col-md-3 box-btn">
                  <?php if($spaceleft < 1){ ?>
                  <div class="btn btn-info text-uppercase btn-block font-weight-bold mt-4"><?php echo __("Sold Out","premiumpress"); ?></div>
                  <?php }elseif($spaceleft > 0){ ?>
                  <a class="btn btn-success text-uppercase btn-block font-weight-bold mt-4"  <?php if($userdata->ID){ ?> href="javascript:void(0);" onclick="processBanner('<?php echo $key; ?>','<?php 
                     echo  $CORE->order_encode(array(               
                     "uid" => $userdata->ID,                
                     "amount" => $price,                
                     "order_id" => "BAN-".$key."-".$userdata->ID."-".rand(),                 
                     "description" => "".stripslashes($sellspacedata[$key."_desc"])."",								
                     ) 								
                     ); 
                     ?>');"<?php }else{ ?>href="<?php echo site_url('wp-login.php?action=login', 'login_post'); ?>"<?php } ?>>
                  <?php echo __("Select Space","premiumpress") ?>
                  </a>            
                  <?php } ?>
                  <div class="mt-3 text-center"><?php echo $spaceleft; ?> / <?php echo stripslashes($sellspacedata[$key."_max"]); ?> <?php echo __("available","premiumpress"); ?> </div>
               </div>
            </div>
         </div>
         <script>
            banner['<?php echo $key; ?>'] = {
            	name:"<?php echo stripslashes($sellspacedata[$key."_name"]); ?>", 
            	price:"<?php echo $price; ?>", 
            	time:"<?php echo $sellspacedata[$key."_days"]; ?> <?php echo __("days","premiumpress"); ?>",  
            expirydate:"<?php echo hook_date(date( 'd.m.Y H:i:s', strtotime("+ ".$sellspacedata[$key."_days"]." days"))); ?>",
            };
         </script> 
         <?php } ?>
      </div>
   </div>
   
</div>
<!-- end packages block -->
<?php } ?>

<div id="confirmpage"  class=" mt-5" style="display:none">
   <div class="col-12 px-0">
      <p class="pb-2"><?php echo __("All transactions are secure and encrypted. Credit card information is never stored.","premiumpress"); ?></p>
      <div class="row">
         <div class="col-md-12">
            <div id="ajax_payment_form"></div>
            <p class="small mt-3"><?php echo __("By clicking \"Pay Now\" you agree to our","premiumpress"); ?> <a href='<?php echo _ppt(array('links','terms')); ?>'><?php echo __("Terms &amp; Conditions","premiumpress"); ?></a></p>
         </div>
         <div class="col-md-12">
            <ul class="payment-right p-0">
               <li>
                  <div id="package-type" class="left">
                     <?php echo __("Name","premiumpress"); ?>
                  </div>
                  <div class="right">
                     <span id="ppname">xxx</span>
                  </div>
                  <div class="clearfix"></div>
               </li>
               <li>
                  <div class="left"><?php echo __("Time Period","premiumpress"); ?>:</div>
                  <div class="right">
                     <span id="pptime">xxx</span>
                  </div>
                  <div class="clearfix"></div>
               </li>
               <li>
                  <div class="left"><?php echo __("Expiry Date","premiumpress"); ?>:</div>
                  <div class="right">
                     <span id="ppexpirydate">xxx</span> days
                  </div>
                  <div class="clearfix"></div>
               </li>
               <li>
                  <div class="left"><strong><?php echo __("Total","premiumpress"); ?>:</strong></div>
                  <div class="right">	
                     <span id="ppprice">xxx</span>
                  </div>
                  <div class="clearfix"></div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- end confirm box --> 
<div class="container py-5" id="mybanners" style="display:none;">
   <?php if($userdata->ID){ ?>
   <div class="col-12 px-0">
      <div class="row">
         <div class="col-md-12 pr-lg-5">
            <div class="my-3">
               <a href="javascript:void(0);" onclick="ChangeSteps(1);"><u><i class="fa fa-arrow-left"></i> <?php echo __("Buy more banners","premiumpress"); ?></u></a>
            </div>
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th><?php echo __("Location","premiumpress"); ?></th>
                     <th><?php echo __("Banner Size","premiumpress"); ?></th>
                     <th><?php echo __("Views","premiumpress"); ?></th>
                     <th><?php echo __("Clicks","premiumpress"); ?></th>
                     <th><?php echo __("Time Left","premiumpress"); ?></th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <?php if(!empty($campaigns->posts)){  
                        foreach($campaigns->posts as $order){ 
                                                         // BITS
                                                         $bits = explode("-",$order->post_title);
                                                         
                                                         // TIME LEFT
                                                         $timeleft = get_post_meta($order->ID, 'listing_expiry_date',true);
                                                         
                                                         // GET ACTIVE BANNER ID
                                                         $activebannerID = get_post_meta($order->ID, 'bannerid', true);
                        								 
                        								 //campaign name								 
                        								 $campaignID = get_post_meta($order->ID, 'campaign', true);
                        								 
                        								 // BANNER SIZE
                        								 $size = $sellspacedata[$campaignID.'_size'];
                        								 $size_parts = explode("x", $size);								 
                        								  
                                                         // AVAILABLE BANNERS
                                                         $avibanner = $CORE->SELLSPACE(3, $userdata->ID, array($size_parts[0], $size_parts[1]) );
                                                        
                        								  
                                                         
                        ?>
                  <tr>
                     <td>#<?php echo $order->ID; ?></td>
                     <td><?php echo $campaignID; ?></td>
                     <td><?php echo $size; ?></td>
                     <td><?php echo get_post_meta($order->ID, 'impressions', true); ?></td>
                     <td><?php echo get_post_meta($order->ID, 'clicks', true); ?></td>
                     <td> <?php if($activebannerID != "" && $activebannerID != 0 ){?>
                        <?php if($timeleft != ""){ echo do_shortcode('[TIMELEFT key="listing_expiry_date" postid="'.$order->ID.'"]'); } ?>
                        <?php }else{ ?>
                        <?php echo __("Pending","premiumpress"); ?>
                        <?php } ?>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="6" style="text-align:center">
                        <?php  if(is_array($avibanner) && !empty($avibanner) ){ ?>
                        <form action="" method="post" class="p-0 m-0">
                           <input type="hidden" name="action" value="sellspace_set" />
                           <input type="hidden" name="cid" value="<?php echo $order->ID; ?>" />
                           <div class="row">
                              <div class="col-md-5">
                                 <select name="bannerid"  class="form-control form-control-sm">
                                    <?php if($activebannerID != "" && $activebannerID != 0 ){ }else{ ?>                                    
                                    <option><?php echo __("Select Banner","premiumpress"); ?></option>
                                    <?php } ?>
                                    <?php 
                                       foreach( $avibanner as $kh){ ?>
                                    <option value="<?php echo $kh['id']; ?>" <?php selected( $activebannerID, $kh['id'] ); ?>> <?php echo $kh['name']; ?> </option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <div class="col-md-5">
                                 <input type="input" name="camurl" value="<?php echo get_post_meta($order->ID, 'url', true); ?>" placeholder="http://..." class="form-control form-control-sm" />
                              </div>
                              <div class="col-md-2">
                                 <button class="btn btn-success btn-sm pull-right rounded-0 btn-block text-uppercase"><?php echo __("save","premiumpress"); ?></button>   
                              </div>
                           </div>
                        </form>
                        <?php }else{ ?>
                        <i class=" fa fa-warning"></i> <?php echo __("Please upload a banner size","premiumpress"); ?>:  <?php echo $size_parts[0]; ?>px / <?php echo $size_parts[1]; ?>px
                        <?php } ?>
                     </td>
                  </tr>
                  <?php } } ?>
                  <?php if(empty($campaigns->posts)){   ?>
                  <td colspan="6">
                     <div class="text-center"><?php echo __("No Advertising Purchased","premiumpress"); ?></div>
                  </td>
                  <?php } ?>
                  </tr>
               </tbody>
            </table>
            <h5 class="mt-5"><?php echo __("Upload Banner","premiumpress"); ?></h5>
            <hr />
            <div class="bg-light p-3 mb-4">
               <form action="" method="post" class="p-3 bg-light" enctype="multipart/form-data"  id="bupload">
                  <input type="hidden" name="action" value="sellspace" />
                  <input type="file" name="wlt_banner[]" onfocus="jQuery('#savemb').show();" />
                  <button type="submit" class="btn btn-success rounded-0 float-right" id="savemb" style="display:none;"><?php echo __("Upload Banner","premiumpress"); ?></button>   
               </form>
            </div>
            <?php if(!empty($mybanners)){	?>
            <div class="row">
               <?php foreach($mybanners as $k=> $ban){  ?>
               <div class="col-6">
                  <div class="border p-2 mb-4">
                     <div class="text-center">
                        <a href="<?php echo $ban['img']; ?>" target="_blank" class="frame"><img src="<?php echo $ban['img']; ?>" class="img-fluid"></a>
                     </div>
                     <div class="container">
                        <div class="row mt-2 border-top pt-2">
                           <div class="col-md-10">
                              <div class="mt-1 small"><?php echo $ban['name']." (".$ban['w']; ?> X <?php echo $ban['h'].")"; ?> </div>
                           </div>
                           <div class="col-md-2 text-right">
                              <form action="" method="post" >
                                 <input type="hidden" name="action" value="sellspace_delete" />
                                 <input type="hidden" name="delid" value="<?php echo $ban['id']; ?>" />
                                 <button class="btn btn-sm btn-danger rounded-0 text-uppercase float-right"><i class="fa fa-trash"></i></button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php } ?>
            </div>
            <?php }else{ ?>
            <div class="text-muted"><?php echo __("No banners found","premiumpress"); ?></div>
            <?php } ?>       
            <?php if( $showcart ){ ?>
            <script  src="https://www.google.com/jsapi"></script>
            <?php } ?>
         </div>
      </div>
   </div>
   <?php } ?>
</div>
</div>
<script>
   function processBanner(mid, sid){
      
      	jQuery('#ppname').html(banner[mid]['name']);
      	jQuery('#ppprice').html(banner[mid]['price']);
      	jQuery('#pptime').html(banner[mid]['time']);
   	jQuery('#ppexpirydate').html(banner[mid]['expirydate']);
   	
      
          jQuery.ajax({
              type: "POST",
              url: '<?php echo home_url(); ?>/',		
      		data: {
                  action: "load_new_payment_form",
      			details: sid, 
              },
              success: function(response) {
   		   
   		   	ChangeSteps(2);
      			jQuery('#confirmpage').show();
      			jQuery('#packagesbox').hide();
      			jQuery('#ajax_payment_form').html(response);			 
      			
              },
              error: function(e) {
                  alert("error "+e)
              }
          });
      
   }
   function ChangeSteps(step){
  
   	if(step == 1){
   
   jQuery('.section-title').show();
   		
   		jQuery('.step2').removeClass('active');
   		jQuery('.step3').removeClass('active');
   		jQuery('.step1').addClass('active');
   		 
   		jQuery('#mybanners').hide();		
   		jQuery('#confirmpage').hide();		
   		jQuery('#packagesbox').show();
   
   jQuery('.step3 .progress').removeClass('bg-success');			
   jQuery('.step2 .progress').removeClass('bg-success');
     		
   	}else if(step == 2){
   
   jQuery('.section-title').hide();
   		
   		//jQuery('.step1').removeClass('active');
   		jQuery('.step3').removeClass('active');
   		jQuery('.step2').addClass('active');
   		
   		jQuery('#mybanners').hide();		
   		jQuery('#confirmpage').show();		
   		jQuery('#packagesbox').hide();
   	 
   jQuery('.step2 .progress').addClass('bg-success');
   jQuery('.step1 .progress').addClass('bg-success');
   
   	}else if(step == 3){
   		
   		//jQuery('.step1').removeClass('active');
   		jQuery('.step2').addClass('active');
   		jQuery('.step3').addClass('active');
   		
   		jQuery('#mybanners').show();		
   		jQuery('#confirmpage').hide();		
   		jQuery('#packagesbox').hide();
   jQuery('.stepbox').hide();
   
   
   jQuery('.step2 .progress').addClass('bg-success');
   jQuery('.step1 .progress').addClass('bg-success');
   	 	jQuery('.step3 .progress').addClass('bg-success');
   	 	
   	} 
   }
   
   <?php if($userdata->ID && !empty($campaigns->posts)){ ?>
   jQuery(document).ready(function() {	
   ChangeSteps(3);
   });
   <?php } ?>
   
   
</script>
<?php 
   // + PAGE BOTTOM
   get_template_part( 'page', 'bottom' ); 
   
   // + GLOBAL FOOTER
   get_footer($CORE->pageswitch()); }   ?>