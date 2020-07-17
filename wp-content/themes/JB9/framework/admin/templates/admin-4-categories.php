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

  
 
   
<?php 
 
 
$args = array(
	'taxonomy'     =>  THEME_TAXONOMY,
	'orderby'      => 'name',
	'order'		 	=> 'asc',
	'offset'		=>'',
	'show_count'   => 0,
	'pad_counts'   => 1,
	'hierarchical' => 0,
	'title_li'     => '',
	'hide_empty'   => 0,
);
$categories = get_categories($args);
 $i=1;
 
$parent_arrays = array(); 
$child_arrays = array(); 
foreach ($categories as $term) {

	if($term->parent == 0){
	
	$parent_arrays[$term->term_id] =  array( "name" => $term->name );
	
	}else{
	
	$child_arrays[$term->term_id] =  array("parent" => $term->parent, "name" => $term->name);
	
	} 

}

?>


   
<div class="row">   
<div class="col-md-6">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">

<div class="tabheader mb-4">

       <h4><span>Current Categories</span></h4>
      </div>

  		<textarea class="form-control"  style="height:400px !important;width:100%;"><?php 
		
		foreach($parent_arrays as $k => $g){
		
		echo $g['name']."\n";
			
			foreach($child_arrays as $c){
			
			if($c['parent'] == $k){
			
			echo "-".$c['name']."\n";
			}
			
			
			}
		
		}		
		
		?></textarea>    
   
    
    
</div>
    
  
</div>
<div class="col-md-6">



<div class="bg-white p-5 shadow" style="border-radius: 7px;">

<div class="tabheader mb-4">

       <h4><span>Import New Categories</span></h4>
      </div>
 
  <?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>


<input type="hidden" name="admin_action" value="category_import" />    
 
  <textarea class="form-control" id="default-textarea" style="height:400px !important;width:100%;" name="cat_import"></textarea>       
            
<hr />
	<div class="checkbox"><input type="checkbox" value="1" name="deleteall" />Delete all and reimport</div>
<hr />
            
             <div style="text-align:center"><button type="submit" class="btn btn-primary">Import New Categories</button></div>    
     
 
  <?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>
  
    
      
 </div></div>
 
 