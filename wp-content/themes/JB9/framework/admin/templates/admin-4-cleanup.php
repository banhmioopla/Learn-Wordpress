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

 
    
<div class="row">

<div class="col-lg-12">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">

       <h4><span>System Cleanup Tools</span></h4>
      </div>


 
 
            
<div class="well mb-4">	
<b>WP Customizer</b>	 
 <a href="admin.php?page=4&amp;task=resetcustomizer" class="alertme btn btn-info float-right" >Reset All</a> 
 
</div> 

<hr />

<div class="well mb-4">	
<b>Basic Design Changes</b>	 
 <a href="admin.php?page=4&amp;task=resetdesign" class="alertme btn btn-info float-right">Reset All</a> 
 
</div>  
 

<hr />  
<div class="well mb-4 mt-3">	
<b>Database Tables</b>	 
 <a href="admin.php?page=4&amp;task=retables" class="alertme btn btn-info float-right" >Reinstall </a> 
 
</div>
<hr />  

<div class="tabheader mb-4 mt-5">

       <h4><span>Listing Cleanup Tools</span></h4>
      </div>


                
<div class="well mb-2">	
<b>Set All Listings Featured</b>	 
 <a href="admin.php?page=4&amp;task=set1" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>

<hr />                
<div class="well mb-2">	
<b>Set All Listings Non-Featured</b>	 
 <a href="admin.php?page=4&amp;task=set2" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>


<hr />                
<div class="well mb-2">	
<b>Set All Listings Published</b>	 
 <a href="admin.php?page=4&amp;task=set9" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>


<?php if(defined('WLT_CART')){ ?>
<hr />                
<div class="well mb-2">	
<b>Set All Products Taxable</b>	 
 <a href="admin.php?page=4&amp;task=set3" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>

<hr />                
<div class="well mb-2">	
<b>Set All Products Non-Taxable</b>	 
 <a href="admin.php?page=4&amp;task=set4" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>

<hr />                
<div class="well mb-2">	
<b>Set All Products Shipable</b>	 
 <a href="admin.php?page=4&amp;task=set5" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>

<hr />                
<div class="well mb-2">	
<b>Set All Products Non-Shipable</b>	 
 <a href="admin.php?page=4&amp;task=set6" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>

<hr />                
<div class="well mb-2">	
<b>Set All Product Type (Normal Product)</b>	 
 <a href="admin.php?page=4&amp;task=set7" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>

<hr />                
<div class="well mb-2">	
<b>Set All Product Type (Affiliate Product)</b>	 
 <a href="admin.php?page=4&amp;task=set8" class="alertme btn btn-info float-right" >Update All Listings</a> 
<div class="clearfix"></div>
</div>
<?php } ?>


<div class="tabheader mb-4 mt-5">

       <h4><span>Reset Website</span></h4>
      </div>
      
               
<div class="well mb-2">	
<b>Reset Entire Website!</b>	 
<a  href="javascript:void(0);" onclick="jQuery('#UpdateModal').modal('show');" class="btn btn-danger float-right" >Delete Everything</a> 

<div class="clearfix"></div>
</div>

   

</div></div>

 

</div>
