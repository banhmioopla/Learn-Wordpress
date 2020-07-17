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

 
$options = array(


	 "cleanup" => array(
	
		"name" => __("System Cleanup Tools","premiumpress-admin"),
		"desc"	=> "Here are a selection of tools to cleanup your website.",
		"icon" => "26.png",
		"link" => "#",
		"path" => "4-cleanup",
	),
	

	 "child" => array(
	
		"name" => __("Export Child Theme","premiumpress-admin"),
		"desc"	=> "Here you can export your child theme &amp; settings.",
		"icon" => "27.png",
		"link" => "#",
		"path" => "4-child",
	),
	
/*
	 "massimport" => array(
	
		"name" => __("Exporasd","premiumpress-admin"),
		"desc"	=> "Here you can export your child theme &amp; settings.",
		"icon" => "27.png",
		"link" => "#",
		"path" => "4-massimport",
	),
*/
 
	
  	"catimport" => array(
	
		"name" => "Category Import",
		"desc"	=> "Mass import and export your listing categories below.",
		"icon" => "23.png",
		"path" => "4-categories",
	
	),
	
	"faq" => array(
	
		"name" => __("F.A.Q Setup","premiumpress-admin"),
		"desc"	=> "Here you can setup questions and answers for your website.",
		"icon" => "24.png",
		"link" => "#",
		"path" => "4-faq",
	),	
	 "test" => array(
	
		"name" => __("Testimonial Setup","premiumpress-admin"),
		"desc"	=> "Here you can setup custom testimonials for your website.",
		"icon" => "25.png",
		"link" => "#",
		"path" => "4-testimonials",
	),	
	
 /*
 	"plugins" => array(
	
		"name" =>  __("Recommended Plugins","premiumpress-admin"),
		"desc"	=> "A collection of recommended plugins for this theme.",
		"icon" => "4.png",
		"link" => "#",
		"path" => "4-plugins",
	),
		

	"setuptools" => array(
	
		"name" => "Clean-up Tools",
		"desc"	=> "Reset small parts of your website here, reset colours, delete all listing, etc.",
		"icon" => "fa-trash",
		"link" => "#",
	
	),
	


	
 	"csv" => array(
	
		"name" => "CSV Import Tool",
		"desc"	=> "Use this tool to import listings and categories with a Microsoft Excel Spreadsheet.",
		"icon" => "fa fa-file-excel-o",
		"link" => "#",
	
	),
	


	"database" => array(
	
		"name" => "Database Tools",
		"desc"	=> "Reinstall your missing database tables.",
		"icon" => "fa-database ",
		"link" => "#",
	
	),
 
	
 	"listing" => array(
	
		"name" => "Bulk Changes",
		"desc"	=> "Make bulk changes to your website, publish all listings, feature all listings, etc.",
		"icon" => "fa-list-ol ",
		"link" => "#",
	
	),
	
	*/
	 

	
		
		
);

 


 
$i=1;
?>
 
<div id="mainsection">
<div class="row">
<?php $i=1; foreach($options as $key => $opt){ if( isset($opt['hideme']) ){ $i++; continue; } ?>
<div class="col-md-6 mb-4">
<div class="bg-white shadow-sm p-4" style="border-radius: 7px;">
<div class="row">
<div class="col-2">
<img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/<?php echo $opt['icon']; ?>" width="64" >
</div>
<div class="col-7">
<h5 class="mb-2 txt-500"><?php echo $opt['name']; ?></h5>
<p class="text-muted pb-0" style="font-size:16px;" style="min-height:40px;"><?php echo $opt['desc']; ?></p>
</div>
<div class="col-3">
<a class="btn btn-dark btn-sm btn-block mt-4" href="javascript:void(0);" onclick="showthispage('<?php echo $key; ?>');">View</a>
</div>
</div>
</div>
</div>
<?php $i++; } ?>
</div>
</div>


<?php $i=1; foreach($options as $key => $opt){ 

	
?>
   <section id="<?php echo $key; ?>" role="tabpanel" data-name="<?php echo $opt['name']; ?>" data-key="tab-<?php echo $key; ?>" data-icon="<?php echo $opt['icon']; ?>" style="display:none;">   
      
     
      <?php 
         if(is_array($opt['path'])){ 
         	echo get_template_part( $opt['path'][0], $opt['path'][1] );
         }else{ 
         	get_template_part('framework/admin/templates/admin', $opt['path'] );
         } 
         ?> 
      
   </section>
<?php $i++; } ?>