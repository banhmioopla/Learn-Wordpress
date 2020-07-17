<?php
/*
Template Name: [PAGE - MY ACCOUNT]
*/

global $userdata, $CORE; $CORE->Authorize();

$GLOBALS['flag-account'] = 1;

// DISABLE SIDEBAR
define('SIDEBAR-NONE', true);

$GLOBALS['flag-nobreadcrumbs'] = 1;

$user_info = get_userdata($userdata->ID);

if(isset($_POST['action']) && $_POST['action'] == "cashoutform"){ 
 			
			       
			$message = "<br> ".__("Name","premiumpress")." : " . $user_info->user_login . "
						<br> ".__("User ID","premiumpress")." : " . $user_info->ID . "
						<br> ".__("Email","premiumpress")." : " . $user_info->user_email . "
						<br> ".__("Message","premiumpress")." : " . strip_tags($_POST['cashout-message']) . "
						<br> ".__("Amount","premiumpress")." : " . strip_tags($_POST['cashout-amount']) . "";
						
			// SAVE A COPY TO THE DATABASE			
			$SQL = "INSERT INTO `".$wpdb->prefix."core_withdrawal` (
			`user_id` ,
			`user_ip` ,
			`user_name` ,
			`datetime` ,
			`withdrawal_comments` ,
			`withdrawal_status` ,
			`withdrawal_total`
			)
			VALUES ('".$userdata->ID."',  '".$CORE->get_client_ip()."',  '".$userdata->user_login."',  '".date('Y-m-d H:i:s') ."',  '".strip_tags($_POST['cashout-message'])."',  '0',  '".strip_tags($_POST['cashout-amount'])."')";
			
			$wpdb->query($SQL);
		 
 			// SEND EMAIL		
			wp_mail(get_option('admin_email'), "CashOut Request", stripslashes($message)); 
			 
			// ERROR MESSAGE
			$GLOBALS['error_type'] 	= "success"; //ok,warn,error,info
			$GLOBALS['error_message'] 	=  __("Request Sent. Thank You.","premiumpress"); 
	  
}


$mc = $CORE->MESSAGECOUNT($userdata->user_login);
if($mc == ""){ $mc = 0; }

$msdisplay = "";
if($mc>0){ $msdisplay = " <span class='badge badge-success small'>(".$mc.")</span>"; } 

// USER BALANCE
$user_balance = get_user_meta($userdata->ID,'wlt_usercredit',true);

// LISTING COUNT
$listingcount = "";
$lc = $CORE->count_user_posts_by_type($userdata->ID, 'listing_type');
if($lc > 0){
$listingcount  = " <span class='badge badge-success small'>(".$lc.")</span>"; 
}


 
// BUILD ACCOUNT PAGE ITEMS
$accountitems = array(

"dashboard" => array(

	"name" => __("Dashboard","premiumpress"),
	"desc" => __("This is the overview page of your account area.","premiumpress"),
	"link" => _ppt(array('links','account')),
	"icon" => "fa-tachometer-alt-slow",

),

"details" => array(
	"name" => __("My Details","premiumpress"),
	"desc" => __("This is where you can edit your profile details.","premiumpress"),
	"path" => array(hook_theme_folder( array('account', 'details', true) ),'details'),
	"icon" => "fa-user",
	"link" => "",
),

"photo" => array(

	"name" => __("Display Photo","premiumpress"),
	"desc" => __("Here you can change your account display photo.","premiumpress"),
	"link" => "",
	"icon" => "fa-camera",
	"path" => array(hook_theme_folder( array('account', 'photo', true) ),'photo'),	
),

"messages" => array(

	"name" => __("My Messages".$msdisplay,"premiumpress"),
	"desc" => __("Here you can view and send messages to other users.","premiumpress"),
	"link" => "",
	"icon" => "fa-envelope",
	"path" => array(hook_theme_folder( array('account', 'messages', true) ),'messages'),
),

"orders" => array(

	"name" => __("My Orders","premiumpress"),
	"desc" => __("Here you can view orders and download invoices.","premiumpress"),
	"link" => "",
	"icon" => "fa-credit-card",
	"path" => array(hook_theme_folder( array('account', 'orders', true) ),'orders'),

),
"membership" => array(

	"name" => __("My Membership","premiumpress"),
	"desc" => __("Here you can view your membership details.","premiumpress"),
	"link" => "",
	"icon" => "fa-bullhorn",
	"path" => array(hook_theme_folder( array('account', 'mymembership', true) ),'mymembership'),

),

"add" => array(

	"name" => __("Add Listing" ,"premiumpress"),
	"desc" => __("Here you can create a new listing on our website.","premiumpress"),
	"link" => _ppt(array('links','add')),
	"icon" => "fa-pencil",
	"path" => "",

),

"listings" => array(

	"name" => __("My Listings","premiumpress").$listingcount,
	"desc" => __("Here you can view all the listings you have created.","premiumpress"),
	"link" => home_url()."?s=&uid=".$userdata->ID,
	"icon" => "fa-credit-card",
	"path" => "",

),

"favs" => array(

	"name" => __("My Favorites","premiumpress"),
	"desc" => __("Here you can view all your favorite listings.","premiumpress"),
	"link" => home_url()."?s=&favs=".$userdata->ID,
	"icon" => "fa-star",
	"path" => "",

),


"password" => array(

	"name" => __("Change Password","premiumpress"),
	"desc" => __("Here you can change your account password.","premiumpress"),
	"link" => "",
	"icon" => "fa-lock",
	"path" => array(hook_theme_folder( array('account', 'password', true) ),'password'),	

),


"cashout" => array(

	"name" => __("Cashout <span class='badge badge-primary'>".hook_price($user_balance)."</span>","premiumpress"),
	"desc" => __("Here you can request to cashout some of your balance.","premiumpress"),
	"link" => "",
	"icon" => "fa-money",
	"path" => array(hook_theme_folder( array('account', 'cashout', true) ),'cashout'),

),

/*
 

"feedback" => array(

	"name" => __("My Feedback","premiumpress"),
	"desc" => __("Here you can view feedback left for and by you.","premiumpress"),
	"link" => "",
	"icon" => "fa-comment",
	"path" => array(hook_theme_folder( array('account', 'feedback', true) ),'feedback'),

),

*/

"sellspace" => array(

	"name" => __("Advertising","premiumpress"),
	"desc" => __("Here you can view our website advertising opportunities.","premiumpress"),
	"link" => _ppt(array('links','sellspace')),
	"icon" => "fa-bullhorn",
	"path" => "",

),




);


// CAPTION CHANGES
if(defined('THEME_LISING_CAPTION') && !defined('LOCO_LANG_DIR')){
$caption = THEME_LISING_CAPTION;

$accountitems['add']['name'] = str_replace("Listing",THEME_LISING_CAPTION,$accountitems['add']['name']);
$accountitems['favs']['desc'] = str_replace("listings",THEME_LISING_CAPTION,$accountitems['favs']['desc']);
$accountitems['listings']['name'] = str_replace("Listings",THEME_LISING_CAPTION,$accountitems['listings']['name']);

}



if(THEME_KEY == "at"){
	$addg = "";
	$uaddress = get_user_meta($userdata->ID,'address1',true);
	if($uaddress == ""){ 
	$accountitems['details']['alert'] = true;
	} 
}


if(_ppt(array('links','add')) == "" || in_array(THEME_KEY,array('da','sp')) ){
unset($accountitems['add']);
}

if(_ppt('sellspace_enable') != 1){
unset($accountitems['sellspace']);
}

// REMOVE CASHOUT BOX IF HAS NONE
if(get_user_meta($userdata->ID,'wlt_usercredit',true) < 1){
unset($accountitems['cashout']);
}

if(_ppt('enable_memberships') == 0){
unset($accountitems['membership']);
}

if(_ppt('account_messages') == 0){ 
unset($accountitems['messages']);
}

 
// HOOK ITEMS FOR CHILD THEMES
$accountitems = hook_v9_account_options($accountitems);

?>

<?php get_header($CORE->pageswitch()); ?>

<?php if(defined('IS_MOBILEVIEW')){ ?>

<?php get_template_part( '_mobile/page' , 'account' ); ?>

<?php }else{ ?>
<div class="user-header page-content-block bg-white text-dark">
   <div class="page-content-title content-top border-bottom">
      <div class="container">
         <div class="image">
            <a href="<?php if(THEME_KEY == "da"){ 
			
				$SQL = "SELECT DISTINCT ".$wpdb->posts.".ID FROM ".$wpdb->posts." WHERE post_type = 'listing_type' AND post_status = 'publish' AND post_author = ('".$userdata->ID."') LIMIT 1";				 
				$query = $wpdb->get_results($SQL, OBJECT);
				if(!empty($query)){
				echo get_permalink($query[0]->ID);
				}else{
				echo "#";
				}
				
				}elseif(_ppt('allow_profile') == 0){ echo "#"; }else{ echo get_author_posts_url( $userdata->ID ); } ?>">
            <?php echo get_avatar( $userdata->ID, 180 ); ?>
            </a>
         </div>
         <div class="user-details text-center text-md-left ">
            <div class="row">
               <div class="col-lg-5 col-12">
                  <span class="username"><?php echo __("Welcome back","premiumpress"); ?>, <?php echo  $CORE->user_display_name($userdata->ID); ?>!</span> 
                  
                  <div class="clearfix mt-4"></div>
                  
                  <?php if(_ppt('account_userverify') == 1){ ?> 
                  <?php echo $CORE->user_verified($userdata->ID, 1); ?>                   
                  <span class="mx-lg-1" style="opacity:0.5">&bull;</span>
                  <?php } ?>
                  
                  <?php if(_ppt('enable_memberships') == 1){ ?>     
                  <a onclick="SwitchPage('membership');" href="javascript:void(0);">
                  <?php $cm  = get_user_meta($userdata->ID,'wlt_subscription',true); if(is_array($cm) && !empty($cm['key']) ){ ?>
                  <span class="badge badge-success"><i class="fa fa-user mr-1"></i> <?php echo $CORE->get_subscription_name($userdata->ID); ?></span> 
                  <?php }else{ ?>
                  <span class="badge badge-info"><i class="fa fa-user mr-1"></i> <?php echo __("no membership","premiumpress"); ?></span>                 
                  <?php } ?>
                  </a>                  
                  <span class="mx-lg-1" style="opacity:0.5">&bull;</span>
                  <?php } ?>
                  
                  <?php echo $CORE->user_online($userdata->ID, 1); ?>                  
                  
                  <div class="my-3 small">
                     <i class="fa fa-user-circle" aria-hidden="true"></i> <?php echo __("Joined","premiumpress") ?> <?php  echo hook_date($user_info->user_registered); ?>
                  </div>                  
               
               </div>
               <div class="col-lg-7 col-12 d-none d-lg-block  text-right">
                  <?php echo $CORE->BANNER('account',''); ?> 
               </div>
            </div>
         </div>
      </div>
   </div>				 
</div>

<main id="main"  class="py-4 py-md-5" >
   <div class="container">
      <div class="row">
      <?php if(!defined('MYACCOUNT-NOMENU')){ ?>
         <div class="col-lg-3 col-md-4 col-12">         
            <ul class="accountmenu  d-none d-md-block">
               <?php $i=1; foreach($accountitems as $k => $i){ ?>	
               <li <?php if($i == 1){ ?>class="active"<?php } ?>> 
                  <a <?php if($i['link'] != ""){ ?>href="<?php echo $i['link']; ?>"<?php }else{ ?>onclick="SwitchPage('<?php echo $k; ?>');" href="javascript:void(0);"<?php } ?> class="text-dark"><i class="fa fa-angle-right"></i>  <?php echo $i['name'] ?></a>
               </li>
               <?php $i++; } ?> 
            </ul>
            
<?php
if(defined('WLT_CREDITSYSTEM') && _ppt('token_system') != 1 ){
//$userCredit = get_user_meta($userdata->ID, 'wlt_usercredit', true);
$userTokens = get_user_meta($userdata->ID, 'wlt_usertokens', true);
?>      
<div class="btn-block text-right">
<a onclick="SwitchPage('deposit');" href="#top" class="text-uppercase small"><u><?php echo __("Manage","premiumpress"); ?></u></a>
</div>
<ul class="list-group mb-3">
<?php /* if(_ppt('credit_system') != 1){ ?>
  <li class="list-group-item font-weight-bold text-uppercase small"><i class="fal fa-award"></i> <?php echo __("Credit","premiumpress"); ?> <span class="float-right"><?php echo hook_price($userCredit); ?></span> </li>
<?php } */ ?>
<?php if(_ppt('token_system') != 1){ ?>
  <li class="list-group-item font-weight-bold text-uppercase small"><i class="fa fa-money"></i> <?php echo __("Tokens","premiumpress"); ?> <span class="float-right"><?php echo $userTokens; ?></span> </li>
<?php } ?>
</ul>
<?php } ?>

<div class="col-12 p-lg-0">
<a href="<?php echo wp_logout_url(); ?>" class="btn btn-block btn-secondary rounded-0 mb-4"><?php echo __("Logout","premiumpress"); ?></a>
</div>


         </div>
   
   <?php }// no menu ?>
         <div class="<?php if(!defined('MYACCOUNT-NOMENU')){ ?>col-lg-9 col-md-8<?php } ?> col-12">         
         
            <div id="dashboard">
            
      <?php if(isset($_GET['noaccess'])){ ?>      
      <div class="alert alert-info mb-4 mx-2">
         <i class="fas fa-times"></i> <?php echo __("You do not have access to this page.","premiumpress"); ?>
      </div>
      <?php } ?>
      
      <?php if(strlen(get_user_meta($userdata->ID,'wlt_customtext', true)) > 1){  ?>
      <div class="p-4 bg-light mb-4 mx-2"><?php echo get_user_meta($userdata->ID,'wlt_customtext', true); ?></div>      
      <?php } ?>
            
               <?php
                  /*
                  	CHECK FOR USER CREDIT AMOUNTS
                  	IF THEY OWN MONEY THEN REQUEST
                  	PAYMENT 
                  */
                  $userCredit = get_user_meta($userdata->ID, 'wlt_usercredit', true);
                  if( $userCredit < 0  ){
                  
                  	// REMOVE MINUS SIGN
                  	$userCredit = str_replace("-","",$userCredit);
                  ?>
                  <div class="container nopadding">
                  
               <div class="alert alert-danger">
                  <b><span class="label label-danger"><?php echo __("Negative Amount Balance","premiumpress"); ?></span></b> 
                  <button class="btn btn-danger float-right mt-2" onclick="ajax_load_payment();"><?php echo __("Pay Now","premiumpress"); ?></button>
                  <br /><small>
                  <?php printf( __( 'Amount due %s. Please make payment as soon as possible.', 'premiumpress' ), '<span>' . hook_price($userCredit) . '</span>' );  ?> 
                  </small>
                  <div class="clearfix"></div>
               </div> 
                
                <div id="ajax_payment_form_account_overdue" class="mb-4"></div>
                
                </div>
                               
<script> 
   
   function ajax_load_payment(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
               action: "load_new_payment_form",
   			details:jQuery('#ppt_orderdata').val(),
           },
           success: function(response) {			
   			jQuery('#ajax_payment_form_account_overdue').html(response);
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   
   }
</script>

<input type="hidden" id="ppt_orderdata" value="<?php 

	$payment_due = round($userCredit,2);

   $couponcode = "";
   if(isset($_POST['couponcode'])){
   $couponcode = esc_attr($_POST['couponcode']);
   }
   
   echo $CORE->order_encode(array(
   
   	"uid" => $userdata->ID, 
   	"amount" => $payment_due, 
   	
   	"local_currency_amount" => $CORE->price_format_display( $payment_due ),
   	"local_currency_code" => $CORE->_currency_get_code(),
   	
   	"order_id" => "CREDIT-".$post->ID."-".rand(),
   	 
   	"description" => "Account Overdue Payment",
   	
   	"recurring" => 0,
   	
   	"couponcode" => 0,
   
   								
   ) ); 
    		
   ?>" />
                           
                
               <?php } ?>
               <div class="container nopadding">
                  <?php echo $CORE->ERRORCLASS(); ?>
                  
                  
                  
                  
                  
              
              
              
  <?php get_template_part( hook_theme_folder( array('account', 'invoices', true) ), "invoices" ); ?>             
              
              
                  
                
                 
                 
<?php
// POWER SELLER ADD-ON
if(is_numeric(_ppt('powerseller_price')) && _ppt('powerseller_price') > 0 &&  get_user_meta($userdata->ID,'wlt_powerseller', true) != 1 ){
?>                
<div class="p-4 mb-4 rounded-0" style="background: #fff9ee !important; position:relative; overflow:hidden;     border: 1px solid #f4e6ca;" id="powersellerform">
 
<img src="<?php echo get_template_directory_uri(); ?>/framework/img/medalbig.png"  class="mr-2" style=" top: 10px;   position: absolute;    right: -10px;    opacity: 0.1;" />

<h5><img src="<?php echo get_template_directory_uri(); ?>/framework/img/medal.png" alt="" class="mr-2" /> <?php echo __("Upgrade to Power Seller today!","premiumpress"); ?></h5>

<p class="mt-2"><?php echo __("Improved search exposure and account credibility with this one-time payment of","premiumpress"); ?> <?php echo hook_price(_ppt('powerseller_price')); ?></p>

<a href="javascript:void(0)" onclick="ajax_powerseller_payment();" class="btn btn-warning btn-sm" style="width:150px;"><?php echo __("Upgrade Now","premiumpress"); ?></a>
 

</div> 
<div id="ajax_powersellerpayment"></div>
<textarea id="powerselleraddonprice" style="display:none;"><?php
			   
			   
$cartdata = array(
	"uid" => $userdata->ID, 
	"amount" => _ppt('powerseller_price'), 	
	"local_currency_amount" => $CORE->price_format_display(array(_ppt('powerseller_price'), false ) ),
	"local_currency_code" => $CORE->_currency_get_code(),	
	"order_id" => "POWERSELLER-".$userdata->ID."-".date("Ymds"),
	"description" => "Payment for powersell add-on.",	
	"recurring" => 0,								
);
echo $CORE->order_encode($cartdata); ?></textarea> 
<script>
function ajax_powerseller_payment(){
   
       jQuery.ajax({
           type: "POST",
           url: '<?php echo home_url(); ?>/',		
   		data: {
            action: "load_new_payment_form",
			details: jQuery('#powerselleraddonprice').val(),
           },
           success: function(response) {
   			
   			jQuery('#ajax_powersellerpayment').html(response).addClass('mb-4');
   			jQuery('#powersellerform').hide();
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   
   }
 
</script> 
<?php }elseif(is_numeric(_ppt('powerseller_price')) && _ppt('powerseller_price') > 0 &&  get_user_meta($userdata->ID,'wlt_powerseller', true) == 1 ){ ?>
<div class="p-3 mb-4 rounded-0" style="background: #fff9ee !important; position:relative; overflow:hidden;     border: 1px solid #f4e6ca;" id="powersellerform"> 
<p class="pb-0 mb-0 font-weight-bold" style="color: #c78d04;text-shadow: 1px 1px #fff;"><img src="<?php echo get_template_directory_uri(); ?>/framework/img/medal.png" alt="" class="mr-2" /> <?php echo __("Power Seller status enabled!","premiumpress"); ?></p>
</div> 
<?php } ?>


   
                  
                 <?php hook_v9_account_top(); ?>
                
                  
                  <div class="row text-center">
                     <?php $i=1; foreach($accountitems as $k => $i){ 
					 
					 if(isset($i['hidebox'])){ continue; }
					 
					 ?>    
                     <div class="col-lg-4 col-md-6">
                        <a <?php if($i['link'] != ""){ ?>href="<?php echo $i['link']; ?>"<?php }else{ ?>onclick="SwitchPage('<?php echo $k; ?>');" href="javascript:void(0);"<?php } ?> class="accountlink" style="text-decoration:none;">
                           <div class="card shadow-sm rounded-0 mb-5 <?php if(isset($i['alert'])){ ?>text-danger<?php } ?>" <?php if(isset($i['alert'])){ ?>style="border:1px dashed #dd3243"<?php } ?>>
                              <div class="card-header bg-white text-left"><i class="fa <?php echo $i['icon'] ?> float-right mt-1 text-muted"></i> <span class=""><?php echo $i['name'] ?></span> </div>
                              <div class="card-body text-muted">
                                 <p><?php echo $i['desc'] ?></p>
                              </div>
                           </div>
                        </a>
                     </div>
                     <?php $i++; } ?>     
                  </div>
               </div>  
            </div>
            <div>
               <?php $i=1; foreach($accountitems as $k => $i){ if(!isset($i['path']) || ( isset($i['path']) && !is_array($i['path']) ) ){ continue; } ?>    
               <div class="content" id="<?php echo $k; ?>" style="display:none">
                  <div class="page-content account-block"> 
                     <?php get_template_part( $i['path'][0], $i['path'][1] ); ?>
                  </div>
               </div>
               <?php $i++; } ?>  
               
               
                <div class="content" id="deposit" style="display:none">
                  <div class="page-content account-block"> 
                     <?php get_template_part( hook_theme_folder( array('account', 'deposit', true) ), "deposit" ); ?>
                  </div>
               </div>
               
               
               
            </div>
            <script>
               jQuery( ".accountmenu a" ).click(function() {
               	jQuery('.accountmenu li').removeClass('active');
               	jQuery(this).parent('li').addClass('active');
               });
               
               function SwitchPage(apage){
               	
               	jQuery('#dashboard').hide();
               	jQuery('#'+apage).show();
               	if(jQuery('#activeTabLink').val() != apage ){	
               		jQuery('#'+jQuery('#activeTabLink').val()).hide();	
               	}	
               	jQuery('#activeTabLink').val(apage);
               
               }
               
            </script>  
            <input type="hidden" id="activeTabLink" />   
            <?php if(isset($_POST['action']) && $_POST['action'] == "userupdate"){ ?>
            <script>
               jQuery(document).ready(function(){ 
               
               jQuery('.nav-tabs a[href="#t2"]').tab('show');
               
               });
            </script>
            <?php } ?>                       
         </div>
      </div>
   </div>
</main>
<?php } // end mobile ?>

<?php get_footer($CORE->pageswitch()); ?>