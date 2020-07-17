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

// CHECK IF HOME PAGE IS SET
$HOMEPAGESET = $CORE->PAGEEXISTS('homepage');
 
// GET THE DEFAULT HOME PAGE OPTIONS
$homepageID = get_option('show_on_front');

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
  
?>
 
 


<ul id="innertabs" class="nav nav-tabs">

	<li class="active"><a href="#pagelayout1" data-toggle="tab">General</a></li>
    
   
    <li><a href="#pagelayout2" data-toggle="tab">Search Page</a></li>
    
    <li><a href="#pagelayout3" data-toggle="tab">Listing Page</a></li>
 
    
    <li><a href="#pagelayout4" data-toggle="tab">Other Pages</a></li>
        
</ul>
<div class="tab-content innertabs-content">  
 

<div class="tab-pane in active" id="pagelayout1">  
 
   
    
   

</div> 


<div class="tab-pane" id="pagelayout2"> 
    
	

</div> 


<div class="tab-pane" id="pagelayout3"> 
 
	<?php  get_template_part('framework/admin/templates/admin', 'pagelayout-listing' ); ?>

</div> 

<div class="tab-pane" id="pagelayout4"> 
    
    <?php  get_template_part('framework/admin/templates/admin', 'pagelayout-page' ); ?> 
 
 	<?php  get_template_part('framework/admin/templates/admin', 'pagelayout-print' ); ?>

	<?php  get_template_part('framework/admin/templates/admin', 'pagelayout-misc' ); ?>
    
</div> 

 


<?php if(defined('ADMIN_HIDE_HOMEPAGE')){ ?>

<div class="alert alert-error fade in">

<img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/icons/cross.png" width="60px" style="float:right;" />   

<p><b style="font-size:20px;">Child Theme Homepage Detected</b></p>

<p>Your child theme has its own _homepage.php file and therefore the core theme functions are disabled. </p>
<p> If you wish to use the core theme homepage functionality, please delete the _homepage.php file from your child theme.</p>
</div>

<hr />
<?php } ?> 








</div>
<script >

	jQuery("#edithome").click(function() {
   
		tb_show('', 'admin.php?page=1&tab=homepage&nolayoutbody=1&amp;TB_iframe=true');
		return false;
	});
                 
</script>  

 
