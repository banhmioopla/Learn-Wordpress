<?php
/*
Template Name: [PAGE - PAYMENT CALLBACK]
*/


// DISABLE SIDEBAR
define('PPTCOL-NONE', true);

get_header($CORE->pageswitch()); get_template_part( 'page', 'top' ); ?>

<?php 
	
	switch($payment_status){ 
	
		case "success": { 
		
			get_template_part( 'payment', 'thankyou' );
		
		} break;
		
		default: {
		
		 get_template_part( 'payment', 'error' );
		 
		} 
	
	}
?>    
		
<?php get_template_part( 'page', 'bottom' ); get_footer($CORE->pageswitch()); ?>