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

global $CORE, $wpdb;

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
?>



<div class="card">
<div class="card-header">

<a href="#" rel="tooltip" data-original-title="This is where you upload the images that will appear in you banner." data-placement="top" class="btn btn-help btn-sm float-right"><i class="fa fa fa-info" aria-hidden="true"></i></a>

  <a class="btn btn-primary btn-sm float-right" href="javascript:void(0);" onclick="loadSingleForm('#admin_banner_wrap')">Add Banner</a>
  
<span>
Banners 
</span>
</div>
<div class="card-body1"> 


 
         
 <?php $wlt_banners = get_option("wlt_banners");  
		 
		 // update_option("wlt_banners","");
		if(is_array($wlt_banners) && count($wlt_banners) > 0 ){  ?>
        
        
            <table id="datatable_example" class="responsive table table-striped table-bordered">
            <thead>
            <tr>
              <th class="no_sort"> </th>
               <th class="no_sort">Views</th>
                            
              <th class="no_sort" style="width:110px;text-align:center;">Actions</th>
              
            </thead>
            <tbody>
            
        <?php
 	  
		foreach($wlt_banners as $key=>$field){  if(!is_numeric($key)){ continue; }  ?>
		<tr>
         <td>
		 <div style="font-weight:bold;"><?php echo stripslashes($field['subject']); ?></div>
        
         <small> Category: <?php
		  
		 if(isset($field['category']) && is_array($field['category'])){ 
		 foreach($field['category'] as $k => $p){
		 
		 if(!is_numeric($p)){ continue; }
		 
		 	$v = get_term_by('id', $p, THEME_TAXONOMY);
			if(!is_wp_error($v)){
				$l = get_term_link($v->slug, THEME_TAXONOMY);
				if(!is_wp_error($l)){
		 		echo " <a href='".$l."' target='_blank'>".$v->name. "</a>";
				}
			}
		 }
		 }else{
		 echo "All Categories";
		 }
		 ?> 
    </small>
    
         </td>         
        <td class="ms" style="text-align:center;"><?php if(!isset($field['views']) || (isset($field['views']) && $field['views'] == "" ) ){ echo 0; }else{ echo number_format($field['views']); } ?>
        </td>
         <td class="ms">
         <center>
                <div class="btn-group1">
                  <a class="btn btn-sm btn-primary" rel="tooltip" 
                  href="admin.php?page=7&edit_banner=<?php echo $key; ?>"
                  data-placement="bottom" data-original-title=" edit "><i class="fa fa-pencil"></i></a> 
                  
                                    
                  <a class="btn btn-sm btn-danger confirm" rel="tooltip" data-placement="bottom" 
                  data-original-title="Delete"
                  href="admin.php?page=7&delete_banner=<?php echo $key; ?>"
                  ><i class="fa fa-trash"></i></a> 
                </div>
            </center>
            </td>
            </tr>
            <?php  }   ?> 
 
            </tbody>
            </table>
             
         <?php } ?>        
         

</div><!-- end card block -->
</div><!-- end card -->