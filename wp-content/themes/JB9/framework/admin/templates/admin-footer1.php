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
?>

</div>

<script>
jQuery(document).ready(function() {

	jQuery('.confirmdelete').click(function(e)
	{
		if(confirm("Are you sure?"))
		{
		   
		
		}
		else
		{
			 alert('Phew! That was close!');
			e.preventDefault();
		}
	});


		// CHECKBOXES
		jQuery(".checkbox-on, .radio-on").uniform();         
	 
		 jQuery(".chzn-select").chosen({    disable_search_threshold: 10,   width: "95%"    }); 
		
		jQuery(".tab-content") .hover(function(){
		
			jQuery(".chzn-container .chzn-drop") .css({"display":"block"});
			
		},function(){
		
			jQuery(".chzn-container .chzn-drop") .css({"display":"none"});
			
		});

 		// Toggle
		var off = false;

		var toggle = jQuery('.toggle');

		toggle.siblings().hide();
		toggle.show();
 
		jQuery('.formrow').on('click', '.toggle', function() {
			var self = jQuery(this);

			if (self.hasClass('on')) {
				self.siblings('.off').click();
				self.removeClass('on').addClass('off');
			} else {
				self.siblings('.on').click();
				self.removeClass('off').addClass('on');
			}
		}); 
		
		
		// SET THE CURRENT TAB
		jQuery('a[data-toggle="list"]').on('shown.bs.tab', function (e) { 	 
			var id = jQuery(this).attr('data-id');	 	
			jQuery('.ShowThisTab').val(id);	  
		});
	
		<?php if(isset($_POST['tab']) && $_POST['tab'] != ""){ ?>
		// SET DEFAULT TAB IN
		jQuery('#MainTabs a[href="#<?php echo $_POST['tab']; ?>"]').tab('show');		
		<?php }elseif(isset($_GET['tab']) && $_GET['tab'] != ""){ ?>
		// SET DEFAULT TAB IN
		jQuery('#MainTabs a[href="#<?php echo $_GET['tab']; ?>"]').tab('show');
		<?php } ?>

});

 
function showthispage(k){

	jQuery('.ShowThisTab').val(k);	
	jQuery('#buttonarea').toggle().html('<a href="javascript:void(0);" onclick="showthispage(\''+ k +'\');" class="btn btn-dark mt-5 btn-sm text-left"><i class="fa fa-arrow-left mr-3" aria-hidden="true"></i> Go Back</a>');
	jQuery('#logoarea').toggle();
	jQuery('#mainsection').toggle();
	jQuery('#'+k).toggle();

}

<?php if(isset($_POST['tab']) && $_POST['tab'] != ""){ ?>
showthispage("<?php echo $_POST['tab']; ?>");
<?php } ?>

</script>


<?php if(isset($_GET['page']) && $_GET['page'] != 3 && $_GET['page'] != "add"){ ?>
<!-- FILE UPLOAD FUNCTION --->
<input type="hidden" value="" name="imgIdblock" id="imgIdblock" />
<input type="hidden" value="" name="imgAID" id="imgAID" />
<input type="hidden" value="" name="imgPreviewID" id="imgPreviewID" />
<script >
function ChangeImgBlock(divname){
	document.getElementById("imgIdblock").value = divname;
}
function ChangeAIDBlock(divname){
	document.getElementById("imgAID").value = divname;
}
function ChangeImgPreviewBlock(divname){
	document.getElementById("imgPreviewID").value = divname;
}
jQuery(document).ready(function() {
 
	window.send_to_editor = function(html) {	
	var regex = /src="(.+?)"/;
    var rslt =html.match(regex);
 	 
	var imgrex = /wp-image-(.+?)"/;
    var imgid = html.match(imgrex);
 
    var imgurl = rslt[1];
	var imgaid = imgid[1];
	
	jQuery('#'+document.getElementById("imgIdblock").value).val(imgurl);
	jQuery('#'+document.getElementById("imgAID").value).val(imgaid);
	jQuery('#'+document.getElementById("imgPreviewID").value).attr("src", imgurl ); 
	 
	 tb_remove();
	 <?php if(isset($_GET['page']) && $_GET['page'] == 15){ ?>
	 document.admin_save_form.submit();
	 <?php } ?>
	 
	}
}); 
</script>
<!--- END FILE UPLOAD FUNCTION -->
<?php } ?>
<script> var ajax_site_url = "<?php echo home_url(); ?>/"; </script>