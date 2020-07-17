jQuery(document).ready(function(){
	
	// SET BASKET COUNTER
	jQuery('.cart-basket-count').html(jQuery('#wlt_shop_total_items').val());

});

function ajax_cart_calculateprice(){

	// READS THE PAGE
	var totalprice = 0; var stock = 0;
	
	jQuery('.price-addon').each(function(i, obj) {
		 
		totalprice = totalprice + parseFloat(jQuery(obj).data('amount')); 		
		 
		if(jQuery(obj).data('stock') == ""){
			stock = jQuery('#item_stock_count').html();
		}else{
			stock = stock + parseFloat(jQuery(obj).data('stock'));
		}
	});
	
	// GET QTY AND UPDATE
	qty = jQuery('#qtyvalue').val();
 
	// MAKE DISPLAY
	jQuery('.wlt_listingpage_pricetag').html(totalprice * qty);
	
	// FORMAT CURRENCY 
	jQuery('.wlt_listingpage_pricetag').formatCurrency( { symbol: ''+jQuery('#wlt_shop_currency_symbol').val()+'' });
 	
	// UPDATE STOCK COUNTER
	jQuery('#item_stock_count').html(stock);
	 
	//HIDE BUY AREA OF STOCK IS 0
	if(stock < 1){
		jQuery('#item_buyarea').hide();
		jQuery('#item_outofstockmsg').show();	
	}else {
		jQuery('#item_outofstockmsg').hide();	
	}
	
 
}
function ajax_cart_handlechange(div, new_id){
	
	// GET ID OF CURRENT PRICE FIELD
	cid = jQuery('#'+div).val();
	jQuery('#'+cid).removeClass('price-addon');
	
	// CHANGE IT TO NEW ID  
	jQuery('#'+new_id).addClass('price-addon');
	jQuery('#'+div).val(new_id);
 	
	// UPDATE PRICE
	ajax_cart_calculateprice();
	
}

function ajax_cart(type, qty, id, innerid, popup){
	
	var custom = ""; var credit = 0;
	
	// READ ALL CUSTOM FIELD ATTRIBUTES
	// AND SAVE THE DATA
	jQuery('.field-attribute').each(function(i, obj) {
											 
		// GET VALUE
		hiddenVarID = jQuery(obj).val(); 
		 	 		
		// WE WANT TEXT AND AMOUNT		
		custom = custom + jQuery('#' + hiddenVarID).data('key') + '|' + jQuery(obj).attr('id').replace('attrid-','') + '|' + jQuery('#' + hiddenVarID).val() + '|' + jQuery('#'+hiddenVarID).data( "amount" ) + ',';
		
		//console.log(custom);
		 							  
	});	
	
	jQuery('.field-all-in-one').each(function(i, obj) {
											 
		// GET VALUE
		hiddenVarID = jQuery(obj).val();
		
		//console.log(hiddenVarID);
	 	 		
			// CHECK FOR CREDIT
			cc = jQuery('#'+hiddenVarID).data( "tokens" );
			 
			if(cc == 1){
			credit = 1;	
			}
			
			// WE WANT TEXT AND AMOUNT		
			custom = custom + jQuery('#' + hiddenVarID).data('key')+ '|' + 'priceon' + '|' + jQuery('#' + hiddenVarID).val() + '|' + jQuery('#'+hiddenVarID).data( "amount" ) + ',';
			
									  
	});	
	
	
	
	// READ ALL CUSTOM CHECKBOX ATTRIBUTES
	// AND SAVE THE DATA
	jQuery('.field-attribute-check').each(function(i, obj) {
		
		if (jQuery(obj).is(':checked')) {
			 
			// GET VALUE
			hiddenVarID = jQuery(obj).val();
			 
			// CHECK FOR CREDIT
			cc = jQuery('#'+hiddenVarID).data( "tokens" );
			 
			if(cc == 1){
			credit = 1;	
			}
			
			// WE WANT TEXT AND AMOUNT		
			custom = custom + jQuery('#' + hiddenVarID).data('key')+ '|' + 'priceon' + '|' + jQuery('#' + hiddenVarID).val() + '|' + jQuery('#'+hiddenVarID).data( "amount" ) + ',';
			
			//console.log(custom);
		  
			// jQuery(obj).attr('id').replace('attrid-','') 
		
		}	
									  
	});	
	 
 
    jQuery.ajax({
        type: "POST",
		url: ajax_site_url,	
        data: {
            'cart_action': "update",
            'pid': 		id,
			'innerid': 	innerid,
			'sid': 		jQuery('#wlt_shop_session').val(),
			'qty': 		qty,
			'type':		type,
			'custom':	custom,
			'tokens': credit,
		 
        },
        success: function(e) {
			
			jQuery('#wlt_shop_total_items').val( parseFloat( jQuery('#wlt_shop_total_items').val() ) +  parseFloat( qty ) )
			// UPDATE COUNTER
			jQuery('.cart-basket-count').html( parseFloat( jQuery('#wlt_shop_total_items').val() ) );
			
			// DISPLAY MESSAGE
			if(popup == "yes"){
				jQuery('#addedToCart').modal('show');
			}else if(popup == "refresh"){
					location.reload();
			}
        },
        error: function(e) {
			
			//alert("error updating cart");
             
        }
    });

}





// JavaScript Document
function addProduct(SessionID, siteurl, clickparts, go_to_link) {
// ASSIGN DEFAULTS
productextraprice = 0;
productprice = 0;
productqty   = 1;
productshipping =0;

// CHECK FOR EXTRAS
var productextras = jQuery("#wlt_shop_custom_data").val();				

// SPLIT THE INPUT DATA
prodparts 		= clickparts.split("|");			
productid 		= prodparts[0];
productprice 	= prodparts[1]; 
product_existing_id 	= prodparts[2]; 

// UPDATE THE CART TOTALS
current_amount_total = jQuery("#wlt_cart_total").text();
	current_amount_total = current_amount_total.replace(',', '');
	newtotal = parseFloat(current_amount_total)+ ( parseFloat(productprice) * parseFloat(productqty) + parseFloat(productextraprice) );
	newtotal = Math.round(newtotal*100)/100;
	newtotal = newtotal.toFixed(2);		
	// OUTPUT
	jQuery("#wlt_cart_total").text(newtotal);
	  
// UPDATE THE CART QTY VALUE
var FindQty = jQuery("#wlt_shop_qty_data").val();
if(FindQty != ""){ productqty = FindQty; }

	current_amount_qty = jQuery("#wlt_cart_qty").text();     
	newqty = parseFloat(current_amount_qty)+parseFloat(productqty);
	// OUTPUT
	jQuery("#wlt_cart_qty").text(newqty);

// SAVE CHANGES
jQuery.get(siteurl, {  sid: SessionID,  cart_action: "addproduct", id: productid, qty: productqty, ship:productshipping, extras:productextras, existingID:product_existing_id   } ); 
  
} // END FUNCTION
  
  
 
 function removeAll(SessionID,siteurl,productid, innerid, amounttoremove, go_to_link, qty) {
 	
	// UPDATE THE CART QTY DISPLAY
	varcartqty = jQuery("#wlt_cart_qty").text();

	newqty = parseFloat(varcartqty)-qty;	
	//protect against going below zero.
	if(newqty < 0) newqty = 0;	
	jQuery("#wlt_cart_qty").text(newqty);
	
	// UPDATE THE CART PRICE DISPLAY		
	var current_amount_total = jQuery("#wlt_cart_total").text();   
	newtotal =  parseFloat(current_amount_total) - parseFloat(amounttoremove);
	//protect against going below zero.
	if(parseFloat(newtotal) < 0) newtotal = 0;  
	jQuery("#wlt_cart_total").text(newtotal);
	
	// SAVE CHANGES
	jQuery.get(siteurl, { sid: SessionID, cart_action: "removeall", pid: productid, nid: innerid } ); 
	
	// REFRESH THE CHECKOUT PAGE
	setTimeout(function(){ rdirectmehere(go_to_link);}, 1000);
}  
function removeProduct(SessionID,siteurl,productid, innerid, amounttoremove, go_to_link) {
 	
	// UPDATE THE CART QTY DISPLAY
	varcartqty = jQuery("#wlt_cart_qty").text();

	newqty = parseFloat(varcartqty)-1;	
	//protect against going below zero.
	if(newqty < 0) newqty = 0;	
	jQuery("#wlt_cart_qty").text(newqty);
	
	// UPDATE THE CART PRICE DISPLAY		
	var current_amount_total = jQuery("#wlt_cart_total").text();   
	newtotal =  parseFloat(current_amount_total) - parseFloat(amounttoremove);
	//protect against going below zero.
	if(parseFloat(newtotal) < 0) newtotal = 0;  
	jQuery("#wlt_cart_total").text(newtotal);
	
	// SAVE CHANGES
	jQuery.get(siteurl, { sid: SessionID, cart_action: "removeproduct", pid: productid, nid: innerid } ); 
	
	// REFRESH THE CHECKOUT PAGE
	setTimeout(function(){ rdirectmehere(go_to_link);}, 1000);
} 

function rdirectmehere(go_to_link){	
window.location.href = go_to_link;
}  
  
  
/*
This function takes care of formatting the custom field values for
products and setting them ready for adding to basket
*/
var custom_totalprice = 0;
var custom_lastamount = 0;

 