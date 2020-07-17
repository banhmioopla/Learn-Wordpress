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

global $post, $CORE, $userdata, $CORE_CART;

 
 
 
// CAN CONTNIUE FLAG
$canContinue = true; 

// CHECK FOR MIN.ORDER AMOUNTS
$qty = 100; $qty_min = 1;
if(get_post_meta($post->ID,'price-on',true) != 1){
	$qty = get_post_meta($post->ID,'qty',true);
}
 

// GET PRODUCT TYPE
$product_type = get_post_meta($post->ID,'type',true);

// GET PRICE
$price = get_post_meta($post->ID,'price',true);
 
// GET OLD PRICE
$oldprice = get_post_meta($post->ID,'old_price',true);
  
?>
 
<div class="card-buynow"><div class="wrap">
 
<div class="topbox">
	
    <div class="pricebox">
    
        <div id="wlt_listingpage_pricetag" class="pricetag">0</div> 
    
        <?php if(is_numeric($oldprice) && $oldprice > 0){ ?>
        
        <div class="oldprice">
        
            <strike><?php echo __("was","premiumpress"); ?> <?php echo hook_price($oldprice); ?></strike>
        
        </div> 
    
		<?php } ?>
   
   </div><!-- end pricebox -->
	
    <?php if(get_post_meta($post->ID, 'stock_remove', true) == 1){ ?>
    
    <div class="availability drow" id="item_availability">
    
        <?php echo __("Availability","premiumpress"); ?>: <span id="item_stock_count">0</span> <?php echo __("in stock","premiumpress"); ?>.
    
    </div>
    
    <?php } ?>
    
    <?php if(_ppt('starrating') == 1){ ?>
    
    <div class="rating">  
      
    	<?php echo do_shortcode('[RATING size=16 results=1]'); ?>
      
    </div>
    
    <?php } ?>
    

</div><!-- end top -->

 
<?php echo $CORE_CART->cart_buy_fields(); ?>  
 
<div id="item_buyarea">  

    <label><?php echo __("Quantity","premiumpress"); ?></label> 
          
    <div id="qtybox" class="clearfix">
    <input type="text" value="<?php echo $qty_min; ?>" onchange="checkqtyvalue(this.value);" id="qtyvalue">
    <a href="javascript:void(0);" class="btn button-minus qtyup"> <span><i class="fa fa-plus"></i></span> </a> 
    <a href="javascript:void(0);" class="btn button-plus qtydown"> <span><i class="fa fa-minus"></i></span> </a> 
    </div> 
     
	<?php if(get_post_meta($post->ID,'paypal-buynow',true) == 1){ ?>
     
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="float-xs-right" style="margin-top:10px;">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?php echo get_option('paypal_email'); ?>">
    <input type="hidden" name="lc" value="BM">
    <input type="hidden" name="item_name" value="<?php echo $post->post_title; ?>">
    <input type="hidden" name="amount" value="<?php echo get_post_meta($post->ID,'price', true); ?>">
    <input type="hidden" name="currency_code" value="<?php echo get_option('paypal_currency'); ?>">
    <input type="hidden" name="button_subtype" value="services">
    <input type="hidden" name="no_note" value="0">
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
    <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" border="0" name="submit">
    </form>
    
    <?php } ?> 
        
    <?php
    
     
    // SWITCH PRODUCT TYPE FOR DISPLAY
    switch($product_type){
                
                    case "1": { // DOWNLOAD PRODUCT
                    
                        if($price == 0){ // download button for free downloads				
                            if($userdata->ID){
                            echo  '<form method="post" action="'.get_permalink($post->ID).'" style="margin:0px;">
                            <input type="hidden" name="pid" value="'.$post->ID.'" />
                            <input type="hidden" name="free" value="1" />
                            <input type="hidden" name="downloadproduct" value="1" />';
                            echo  "<button type='submit' class='btn  btn-1' onclick=\"".$CORE_btn_add.";\">".__("Download Now","premiumpress")."</button>";
                            echo  '</form>'; 
                            }else{
                            echo  "<button type='button' class='btn  btn-1' onclick=\"alert('Members Only. Please login to download.');\">".__("Download Now","premiumpress")."</button>";
                            }
                        } 
                    
                    } break;
                    case "2": { // AFFILIATE PRODUCT
                    
                    echo hook_addcart_big("<a href='".get_home_url()."/out/".$post->ID."/buy_link/' id='single_addcart_btn' target='_blank' rel='nofollow' class='btn  btn-1'>".__("Add to cart","premiumpress")."</a>"); 
                        
                    } break;			
                    default: { // NORMAL PRODUCT
               
                    ?>                
                    
                    <button type='button' id='single_addcart_btn' class='btn btn-primary margin-top2'>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
					<?php echo __("Add to cart","premiumpress"); ?>
                    </button> 
                    
                    <script>				
                        jQuery(document).ready(function(){ 								
                            jQuery('#single_addcart_btn').click(function() {					
                                if(jQuery('#wlt_shop_required').val() == 1){
                                    
                                    // ADDD TO CART
                                    ajax_cart('add', jQuery('#qtyvalue').val(), '<?php echo $post->ID; ?>', '', 'yes');
                                    
                                    
                                }
                            });									
                        });				 
                        </script>
                        
                        <?php
                       
                    } break;	
                            
                }// end switch
    
    ?> 
    
    
    <div id="item_outofstockmsg" style="display:none;">
    	<?php echo get_post_meta($post->ID, 'stock_outofmsg', true); ?>
    </div>
    
</div> <!-- item box -->


</div></div><!-- end cart box -->

 

<script>	 
 

jQuery(document).ready(function(){

	// UPDATE CART PRICE
	ajax_cart_calculateprice();
 
	jQuery("a.qtyup").click(function(){
	
		var max_amount = 100;
		if(jQuery('#item_stock_count').length > 0){
		max_amount = parseFloat(jQuery('#item_stock_count').text());
		}
	
		if(jQuery('#qtyvalue').val() < max_amount){
		jQuery('#qtyvalue').val(parseFloat(jQuery('#qtyvalue').val())+1);
		ajax_cart_calculateprice();
		}
	}); 

	jQuery("a.qtydown").click(function(){
		if(jQuery('#qtyvalue').val() > 1){
		jQuery('#qtyvalue').val(parseFloat(jQuery('#qtyvalue').val())-1);
		ajax_cart_calculateprice();
		}
	});   
 
});
 
</script>