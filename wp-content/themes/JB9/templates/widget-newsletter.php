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

global $CORE, $userdata, $post; 

if(isset($GLOBALS['UNIQUE-NEWSLETTER-ID'])){
$GLOBALS['UNIQUE-NEWSLETTER-ID']= $GLOBALS['UNIQUE-NEWSLETTER-ID']+1;
}else{
$GLOBALS['UNIQUE-NEWSLETTER-ID'] = 1;
}

?>
 
<?php if(_ppt('newsletter') == 1){ ?>


<script>

function ajax_newsletter_signup(){

    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/',		
		dataType: 'json',
		data: {
            action: "newsletter_join",
			email: jQuery('#wlt_newsletter_mailme<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>').val(),	 
        },
        success: function(r) {
			
			if(r.status == "ok"){
				jQuery('#newsletterthankyou<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>').show();
				jQuery('#mailinglist-form<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>').html('');
			}else{
				jQuery('#mailinglist-form<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>').html("<?php echo __("Invalid Email Address","premiumpress") ?>");
			}
			
        },
        error: function(e) {
            //alert("error "+e)
        }
    });

}
</script>

<div id="newsletterthankyou<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>" style="display:none" class="newsletter-confirmation txt">
	<div class="h4"><?php echo __("Email confirmation sent.","premiumpress") ?></div>
	<p><?php echo __("Please check your email for a confirmation email.","premiumpress") ?></p>
	<p class="small"><?php echo __("Only once you've confirmed your email will you be subscribed to our newsletter.","premiumpress") ?></p>
</div>

<form id="mailinglist-form<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>" name="mailinglist-form<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>" method="post" onSubmit="return IsEmailMailinglist();" class="footer-newsletter">
    

<div class="input-group">										 
<input type="text" name="wlt_newsletter_mailme<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>" id="wlt_newsletter_mailme<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>" value="" placeholder="<?php echo __("Email Address Here..","premiumpress") ?>" class="form-control  rounded-0" /> 
<div class="input-group-append">
<button type="submit" class="btn btn-secondary rounded-0 font-weight-bold text-uppercase"><?php echo __("Join","premiumpress") ?></button>
</div>	

  					
</div>  

     
        
         
 </form>
<script>
		function IsEmailMailinglist(){
		var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
			var de4 	= document.getElementById("wlt_newsletter_mailme<?php echo $GLOBALS['UNIQUE-NEWSLETTER-ID']; ?>");
			
			if(de4.value == ''){
			alert("<?php echo __("Please enter your email.","premiumpress") ?>");
			de4.style.border = 'thin solid red';
			de4.focus();
			return false;
			}
			if( !pattern.test( de4.value ) ) {	
			alert("<?php echo __("Invalid Email Address","premiumpress") ?>");
			de4.style.border = 'thin solid blue';
			de4.focus();
			return false;
			}
			ajax_newsletter_signup();
		 
		  	return false;
		}		
 </script>
 
<?php }elseif(_ppt('newsletter') == 2){  ?> 


<form method="post" action="http://www.aweber.com/scripts/addlead.pl" id="AffSignup" name="AffSignup" target="_blank" class="footer-newsletter">

<input type="hidden" name="listname" value="<?php echo $GLOBALS['CORE_THEME']['aweber']['nid']; ?>" />
                <input type="hidden" name="redirect" value="<?php echo get_option('mailinglist_confirmation_thankyou'); ?>" />
                <input type="hidden" name="meta_adtracking" value="custom form" />
                <input type="hidden" name="meta_message" value="1" /> 
                <input type="hidden" name="meta_required" value="email" /> 
                <input type="hidden" name="meta_forward_vars" value="1" />   
                
                

<div class="input-group">										 
<input type="text" name="email" value="" placeholder="<?php echo __("Email Address Here..","premiumpress") ?>" class="form-control rounded-0"> 
<div class="input-group-append">
<button type="submit" class="btn btn-secondary font-weight-bold text-uppercase"><?php echo __("Join","premiumpress") ?></button>
</div>								
</div>
</form>
<?php }elseif( current_user_can( 'edit_user', $userdata->ID ) ){ ?>

<div class="p-2 border"><b>Admin Notice</b> The newsletter has been in the admin options.</div>
<?php } ?>