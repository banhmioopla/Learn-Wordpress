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



$args = array(
'post_type' 		=> 'wlt_invoices',
'posts_per_page' 	=> 100,
'post_status'		=> 'publish',
      	'meta_query' => array(
      		'relation'    => 'AND',												 
      									'invoice_status'    => array(
      										'key' => 'invoice_status',	
      										'type' 			=> 'NUMERIC',
      										'value' 		=> 0,
      										'compare' 		=> '=',								 					 			
      									),			 
      									'invoice_to'   => array(
      										'key'     => 'invoice_to',							
      										'type' 			=> 'NUMERIC',
      										'value' 		=> $userdata->ID,
      										'compare' 		=> '=',															
      									),		
      	),
 );					
$wp_query = new WP_Query($args); 
$tt = $wpdb->get_results($wp_query->request, OBJECT);
 
$i=1;
if(!empty($tt)){
	foreach($tt as $p){
	
	$post = get_post($p->ID);
	 
			   
?>
<div class="border p-4 bg-warning text-dark shadow-sm mb-4 invoicepaymentbox">
<div class="row">
	<div class="col-lg-8">    
    <h4><?php echo __("Invoice Overdue","premiumpress"); ?></h4>
    <p><?php echo $post->post_title; ?></p>    
    </div>
	<div class="col-lg-4 text-center">    
    <h3><?php echo hook_price(get_post_meta($post->ID,'invoice_amount',true)); ?></h3>    
	<a href="javascript:void(0)" onclick="ajax_powerseller_payment();" class="btn btn-dark" style="width:150px;"><?php echo __("Pay Now","premiumpress"); ?></a>
    </div> 
</div>
    
</div>
<textarea id="invoicetotal<?php echo $post->ID; ?>" style="display:none;"><?php
			   
			   
$cartdata = array(
	"uid" => $userdata->ID, 
	"amount" => get_post_meta($post->ID,'invoice_amount',true), 	
	"order_id" => "INVOICE-".$userdata->ID."-".$post->ID."-".date("Ymds"),
	"description" => "Overdue Invoice #".$post->ID,	
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
			details: jQuery('#invoicetotal<?php echo $post->ID; ?>').val(),
           },
           success: function(response) {
   			
   			jQuery('#ajax_invoicepayment').html(response).addClass('mb-4');
   			jQuery('.invoicepaymentbox').hide();
   			
           },
           error: function(e) {
               alert("error "+e)
           }
       });
   
   }
 
</script> 
<?php
} ?>

<div id="ajax_invoicepayment"></div>

<?php	} ?>