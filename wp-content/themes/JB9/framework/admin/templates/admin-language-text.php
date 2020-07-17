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

global $CORE;
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
  
?> 


<div class="clearfix"></div>
 
<div class="row-fluid">
<div class="box gradient">
 

<div class="title">
 	
    <div style="float:right;width:320px;">
    <input type="text" id="searchtextquery" name="searchtextquery" class="blur" placeholder="Keyword.." style="height: 30px;margin-top: 3px;">
    <input type="button" value="Search Text" class="btn btn-info" onclick="jQuery('#searchtextquery1').val(jQuery('#searchtextquery').val());document.gosearchtext.submit();return false;" style="margin-top:-5px;">
    </div>	
    
    
    
    <h3> Text</h3>

</div>

<div class="content">
         
 

<div class="accordion" id="accordion5">
<?php  $CORE->Language(); $sl = get_option("core_language"); 

 
// GET ARRAY KEYS
$i=0; $STRING = ""; 
 

$titles = array(

 		"button" 		=> "Button Translations",
		"date" 			=> "Date &amp; Time Translations",
		"validate"		=> "Validation, Warning/Message Alert Translations",		
		
		"widgets" 		=> "Widget Text",
		"mobile" 		=> "Mobile Text",
		"order_status" 	=> "Order Status",		
		"head"			=> "Header (header.php) Translations ",	
		"homepage" 		=> "Home Page (index.php) Translations",
		"single" 		=> "Listing Page (single.php) Translations",
		"gallerypage" 	=> "Gallery Page (index.php) Translations",
		"add"			=> "Submission Page (tpl_add.php) Translations",
		"checkout"		=> "Checkout Page (tpl_checkout.php) Translations",	
		"account"		=> "<?php echo __("My Account","premiumpress"); ?>Page (tpl_account.php) Translations",
		"callback"		=> "Callback Page (tpl_callback.php) Translations", 
		"author" 		=> "Author Page (author.php)",
		"comment" 		=> "Comment Form Translations", 		
		"login" 		=> "Login Page Translations",		
		"listvalues"	=> "Listing Values",		
		"graphs"		=> "Graphs",
		"feedback"		=> "Feedback System",
		"mobile"		=> "New Mobile Website",		
		"coupons"		=> "Coupon Theme",
		"auction"		=> "Auction theme",
		"job"			=> "Job Board Theme",
		"dealer"		=> "Car Dealer Theme",
		"dating"		=> "Dating Theme",
		"software"		=> "Software Theme",
		"mjob"			=> "Mico Jobs Theme",
	 
);
 
// GET THE KEY NAME FROM THE LANGUAGE FILE
$dlang = array_keys($GLOBALS['_LANG']); 

$dlang = $dlang[1];

// LOOP ALL TITLES ABOVE
foreach($titles as $tkey => $tdesc){

if(!isset($GLOBALS['_LANG'][$dlang][$tkey])){ continue; }
  			
		$STRING .= '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle collapsed" data-toggle="collapse" href="#collapseOne'.$i.'">
		<span class="label label-success">'.$i.'</span> '.$tdesc.' </a></div>		
		 <div id="collapseOne'.$i.'" class="accordion-body collapse">';
		 
		$STRING .= '<div class="accordion-inner"><table width="100%" border="0"><th>Current Text</th><th>Your Translation Here</th>';
	 
		foreach($GLOBALS['_LANG'][$dlang][$tkey] as $key => $val){		 
		
			 if(isset($_GET['searchtextquery1']) && strlen($_GET['searchtextquery1']) > 1 && strpos(strtolower($val), strtolower($_GET['searchtextquery1']) ) !== false){ 
				$STRING = str_replace('id="collapseOne'.$i.'" class="accordion-body collapse"', 'id="collapseOne'.$i.'" class="accordion-body"', $STRING); 
				$bull = " "; 
				$rowhighlighted = "style='border:1px solid red;'"; 
			 }else{		 
				$bull = "";
				$rowhighlighted = "";
			 } 
		
		  	$STRING .=' <tr>
			<td>'.$bull.'<input name="" type="text" class="row-fluid" value="'.$val.'" style="background:#dfdfdf;" /></td>
			<td>'.$bull.'<input name="pplang['.$dlang.']['.$tkey.']['.$key.']" type="text" class="row-fluid"
			value="';
			if(isset($sl[$dlang][$tkey][$key])){ $STRING .= stripslashes($sl[$dlang][$tkey][$key]); }
			$STRING .='" '.$rowhighlighted.' /></td></tr>'; // style="width:350px;"
		
		}
		
		// clean up 
		$STRING = str_replace("activateme".$i,"", $STRING); 
		
		$STRING .= '</table></div></div>';
	 
	
		$STRING .= '</div>';
		$i++;
	
	
}// end foreach

 
echo $STRING; 
?>
 
  
</div></div> </div></div>






<div class="row-fluid ">

    <div class="span4">
    
    <label>Live Text Editor
    
<span rel="tooltip" data-original-title="Turn ON and you will be able to edit language file text live on the front end of the website. " data-placement="top">
        <i class="fa fa-info-circle" aria-hidden="true"></i>
        </span>
    
    
    </label>
    
    <div>                              
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('admin_liveeditor').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('admin_liveeditor').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['admin_liveeditor'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                 <input type="hidden" id="admin_liveeditor" name="admin_values[admin_liveeditor]" 
                             value="<?php echo $core_admin_values['admin_liveeditor']; ?>">
    
    </div>
    
</div>

<div class="clearfix"></div> 
 



<div class="ppthelp">
 
The live text editor is perfect for making small text changes when browsing your webiste as the admin. Turn it on and give it a try!

</div>



