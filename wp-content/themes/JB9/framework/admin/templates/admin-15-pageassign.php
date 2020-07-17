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


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  

// GET PAGES
$pages = get_pages();

// GET SAVED DATA
$p = _ppt('pageassign');




$elementorArray = array();
$args = array(
                   'post_type' 			=> 'elementor_library',
                   'posts_per_page' 	=> 12,
                    
               );
 $wp_query = new WP_Query($args);
 $tt = $wpdb->get_results($wp_query->request, OBJECT);

 if(!empty($tt)){ foreach($tt as $p){
 
 $elementorArray["elementor-".$p->ID] = get_the_title($p->ID);
 
 } }
 
 
 
?> 
 


<div class="row">
<div class="col-md-6">




<div class="bg-white p-5 shadow">


<div class="tabheader my-4">
<img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/elementor.png" class="border ml-2 float-right" />
<h4><span>Full Page Changes</span></h4> 
<p class="text-muted lead">Select an elementor template below to replace the entire page with your newly selected design.</p>

</div>



<?php

$ppg = array(

 	10 => array("id" => "homepage", "name" => "Home Page"),

	//0 => array("id" => "0", "name" => "Search Page", "soon" => 1),
	1 => array("id" => "defaultlisting", "name" => "Listing Page"), //, "soon" => 1
	2 => array("id" => "aboutus", "name" => "About Us Page", ),
	3 => array("id" => "contact", "name" => "Contact Us Page",),
	4 => array("id" => "faq", "name" => "FAQ Page",),
	5 => array("id" => "testimonials", "name" => "Testimonials Page"),
	
	6 => array("id" => "privacy", "name" => "Privacy Page"),
	7 => array("id" => "terms", "name" => "Terms &amp; Conditions Page"),
	
	12 => array("id" => "how", "name" => "How it Work's Page"),
	
 
);
$i=1;
foreach($ppg as $pb){
?>

 
   <div class="container <?php if($i%2){ ?>bg-light<?php } ?> py-3">
   <div class="row px-0">
      <div class="col-6">
         <div class="mt-1"><?php echo $pb['name']; ?> </div>
      </div>
      
      <div class="col-6">
      
      <?php if(isset($pb['soon'])){ ?>
      <div class="text-muted small text-uppercase mt-3 font-weight-bold">Coming Soon!</div>
      <?php }else{ ?>
      <select data-placeholder="Default Page" name="admin_values[pageassign][<?php echo $pb['id']; ?>]" style="width:200px;" class="chzn-select">
            <option></option>
            <option value="">Default Design</option>
   
               
                  <?php foreach ( $elementorArray as $key => $title ) {      
               
               
               $option = '<option value="'. $key.'"';
               if( _ppt(array('pageassign', $pb['id'] )) == $key){ $option .= " selected=selected "; $EditLink = substr($key,10,100); } 
               $option .= '>';
               $option .= $title;
               $option .= '</option>';
               echo $option; 
                } ?>
         </select> 
         
         <div class="div">   
      <?php if(_ppt(array('pageassign',$pb['id'])) != "" && isset($EditLink)){  ?>
         
         <a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo $EditLink; ?>&action=elementor" class="small btn btn-warning btn-sm rounded-0 btn-sm mr-2" target="_blank" ><i class="fa fa-pencil"></i> Edit Design</a>
         
         <?php } ?>
         
          <?php if(strlen(_ppt(array('links', $pb['id']))) > 0 ){ ?>
         <a href="<?php echo _ppt(array('links', $pb['id'])); ?>" target="_blank" class="small text-muted"><u>view page</u></a>
       	<?php } ?>
         
         </div>
       <?php } ?> 
            
    
      </div>
   </div>
</div>
<!-- ------------------------- --> 


<?php $i++; } ?> 



</div>






</div>

<div class="col-md-6">




<div class="bg-white p-5 shadow">


<div class="tabheader my-4">
<img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/elementor.png" class="border ml-2 float-right" />
<h4><span>Section Changes</span></h4> 
<p class="text-muted lead">Select an elementor template below to replace part of the existing theme page with your design.</p>

</div>


<?php

$ppg = array(

   	1 => array("id" => "header", "name" => "Header"),
	2 => array("id" => "footer", "name" => "Footer"),
	3 => array("id" => "breadcrumbs", "name" => "Breadcrumbs"),
	
	6 => array("id" => "about-section", "name" => "About Us - Content"),
 
	4 => array("id" => "how-section", "name" => "How it Work's - Content"),

	5 => array("id" => "faq-section", "name" => "FAQ - Content"),
 
	7 => array("id" => "test-section", "name" => "Testimonials - Content"),
 
 
 	10 => array("id" => "cash-section", "name" => "Cash Back - Content"),
 
	
 
);

if(THEME_KEY != "cp"){
unset($ppg[10]);
}

$i=1;
foreach($ppg as $pb){
?>

 
   <div class="container <?php if($i%2){ ?>bg-light<?php } ?> py-3">
   <div class="row px-0">
      <div class="col-6">
         <div class="mt-1"><?php echo $pb['name']; ?> </div>
      </div>
      
      <div class="col-6">
      
      <?php if(isset($pb['soon'])){ ?>
      <div class="text-muted small text-uppercase mt-3 font-weight-bold">Coming Soon!</div>
      <?php }else{ ?>
      <select data-placeholder="Default Page" name="admin_values[pageassign][<?php echo $pb['id']; ?>]" style="width:200px;" class="chzn-select">
            <option></option>
            <option value="">Default Design</option>
   
               
                  <?php foreach ( $elementorArray as $key => $title ) {      
               
               
               $option = '<option value="'. $key.'"';
               if( _ppt(array('pageassign', $pb['id'] )) == $key){ $option .= " selected=selected "; $EditLink = substr($key,10,100); } 
               $option .= '>';
               $option .= $title;
               $option .= '</option>';
               echo $option; 
                } ?>
         </select> 
         
         <div class="div">   
      <?php if(_ppt(array('pageassign',$pb['id'])) != "" && isset($EditLink)){  ?>
         
         <a href="<?php echo home_url(); ?>/wp-admin/post.php?post=<?php echo $EditLink; ?>&action=elementor" class="small btn btn-warning btn-sm rounded-0 btn-sm mr-2" target="_blank" ><i class="fa fa-pencil"></i> Edit Design</a>
         
         <?php } ?>
         
          <?php if(strlen(_ppt(array('links', $pb['id']))) > 0 ){ ?>
         <a href="<?php echo _ppt(array('links', $pb['id'])); ?>" target="_blank" class="small text-muted"><u>view page</u></a>
       	<?php } ?>
         
         </div>
       <?php } ?> 
            
    
      </div>
   </div>
</div>
<?php if($pb['id'] == "breadcrumbs"){ echo "<hr />"; } ?>

<?php $i++; } ?> 



</div>


 <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#logo]').tab('show');"  class="btn btn-secondary mb-4 btn-lg btn-block text-left mt-4"><i class="fa fa-arrow-left mr-3"></i> Go Back</a>
 
 


</div>

</div>

