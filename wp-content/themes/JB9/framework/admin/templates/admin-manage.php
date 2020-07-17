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

global $wpdb, $CORE;

if(!isset($_GET['type'])){ $_GET['type'] = "listing_type"; }

$LISTING_TYPE = $_GET['type'];

 
// GET ITESM PER PAGE
if(isset($_GET['show']) && is_numeric($_GET['show'])){
	$ITEMSPERPAGE = $_GET['show'];
}else{
	$ITEMSPERPAGE = 20;
}

// GET ROWS
if(isset($_GET['cpage']) && $_GET['cpage'] > 1){
	$pstop = $ITEMSPERPAGE;
	$pint = $_GET['cpage']-1;
	$pstart = ($ITEMSPERPAGE*$pint);
}else{
	$pstop = $ITEMSPERPAGE;
	$pstart =0;
}

// GET SEARCH RESULTS AND FILTERS
$SQL_WHERE = " WHERE ".$wpdb->prefix."posts.post_type='".$LISTING_TYPE."' AND ";

 
if(isset($_GET['s_d1']) && $_GET['s_d1'] > 1 && $_GET['tab'] == "home"){
 

}
 

// BUILD SEARCH QUERY
$args = array();
$args['post_type'] = $LISTING_TYPE;	
$args['posts_per_page'] = $ITEMSPERPAGE;

if(isset($_GET['cpage']) && is_numeric($_GET['cpage']) ){
$args['paged'] = $_GET['cpage'];
}
 
if(isset($_GET['cat']) && is_numeric($_GET['cat']) ){
	$args['tax_query'] = array(array(
		 
				'taxonomy' => 'listing',			 
				'field'    => 'term_id',
				'terms'    => array( $_GET['cat'] ),
				'operator' => 'IN',
				),		 
	);
}

if(isset($_GET['s_k']) && strlen($_GET['s_k']) > 1 && $_GET['tab'] == "home" ){
	$args['s'] = strip_tags($_GET['s_k']);	
}
if(isset($_GET['s_d3']) && $_GET['s_d3'] != "" && $_GET['s_d3'] != "any"){
	$args['post_status'] =$_GET['s_d3'];	 
}
if(isset($_GET['new'])){
	$args['date_query'] =   array( 
		array(
			'year'  => date('Y') ,
			'month' => date('m'),
			'day'   => date('d'),
		),
      ); 
}
if(isset($_GET['featured'])){
$args['meta_query'] = array(
		array(
			'key'     => 'featured',
			'value'   => "yes",
			'compare' => '=',
		),
	);
}

if(isset($_GET['orderby'])){

	switch($_GET['orderby']){
	
				case "ID": {
								
					$args['orderby'] 	= "ID";
					$args['order'] 		= $_GET['order'];
					
				} break;
				
				case "post_title": 
				case "title": {
				
					$args['orderby'] 	= "title";
					$args['order'] 		= $_GET['order'];
					
				} break;
				
				case "post_date":
				case "date": {
				
					$args['orderby'] 	= "date";
					$args['order'] 		= $_GET['order'];
					
				} break;
				
				case "post_author":
				case "author": {

					$args['orderby'] 	= "post_author";
					$args['order'] 		= $_GET['order'];
				
				} break;
				
				case "post_modified": {
				
					$args['orderby'] 	= "post_modified";
					$args['order'] 		= $_GET['order'];
					
				} break;
	
				case "hits": {
				
					$args['meta_query']   = array(	
					 				 
						'hits'    => array(
							'key' => 'hits',							 			
						),			 
					);
					
					$args['orderby'] 	= "hits";
					$args['order'] 		= $_GET['order'];
				
				
				} break;
	
				case "featured": {
				
					$args['meta_query']   = array(	
					
						'relation'    => 'AND',	
					
							array(
							
							'relation'    => 'OR',	
										 
							'featured'    => array(
								'key' => 'featured',							 			
							),			 
							'featured1'   => array(
								'key'     => 'featured',							
								'compare' => 'NOT EXISTS',
												
							),						
						),	
					); 
					
					$args['orderby'] 	= "featured";
					$args['order'] 		= $_GET['order'];
				
				
				} break;
		
		case "price": {

		$args['meta_query']   = array(	
					
					'relation'    => 'AND',	
					
						array(
						 				 
							'price'    => array(
								'key'     => 'price',
								'type'    => 'NUMERIC',
								'compare' => 'EXISTS',
								//'value'   => ''				
							),		 
							 
						
						),		
					); 
		
		$args['orderby'] = 'price';
		$args['order'] 		= $_GET['order'];
		 	
		} break;
		
	} // end switch

}

// PERFORM QUERY
$the_query = new WP_Query( $args );
 

// TOTAL RESULTS
$TOTALITEMS = $the_query->found_posts;
 
// TOTAL PAGES
$TOTALPAGES = round($TOTALITEMS/$ITEMSPERPAGE);
 

?> 


<form action="" method="get">
<input type="hidden" name="submitted" value="no">
<input type="hidden" name="page" value="manage">
 
<input type="hidden" name="type" value="<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>">
 


<div class="card mb-3">
<div class="card-header">

<button class="btn btn-primary btn-sm float-right" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search</button> 
 

<span>
<i class="fa fa-filter" aria-hidden="true"></i> Filter Results
</span>
</div>
<div class="card-body"> 


   
<div  class="row">
<div class="col-md-4">

<label>Search Keyword</label>
  
	 <input name="s_k" class="form-control" value="<?php if(isset($_GET['s_k'])){ echo $_GET['s_k']; } ?>" />
     
</div> 


<div class="col-md-4">
 
<label>Category</label><br />

<?php wp_dropdown_categories( 'show_count=1&hierarchical=1&taxonomy=listing&class=form-control' ); ?>
<?php if(!isset($_GET['cat']) || isset($_GET['cat']) && !is_numeric($_GET['cat']) ){ ?>
<script>
jQuery(document).ready(function() {
jQuery("#cat").prepend("<option value='' selected=selected>All Categories</option>");
});
</script>
<?php } ?>
</div>

 

<div class="col-md-4">
 
 <label>Status</label><br />
  <select class="form-control" name="s_d3">
  <option value="any">Any</option>
      <option value="publish">Live</option>
      <option value="draft">Draft </option>            
       <option value="pending">Pending Review </option>       
  
  </select>
</div>

</div> 
 
<div class="row mt-1">

<div class="col-md-4">
 
 <label>Order By</label><br />
  <select class="form-control" name="orderby">
  <option value="any">Any</option>
  
	<option value="ID" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "ID"){ echo "selected=selected"; } ?>>ID</option>  
	<option value="post_date" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "post_date"){ echo "selected=selected"; } ?>>Date</option>  
	<option value="post_author" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "post_author"){ echo "selected=selected"; } ?>>Author</option>  
    
  <option value="hits" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "hits"){ echo "selected=selected"; } ?>>Visitors</option>  
 
  <option value="post_title" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "post_title"){ echo "selected=selected"; } ?>>Title</option>  

  <option value="price" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "price"){ echo "selected=selected"; } ?>>Price</option>
  <option value="featured" <?php if(isset($_GET['orderby']) && $_GET['orderby'] == "featured"){ echo "selected=selected"; } ?>>Featured</option>

  </select>
</div>

<div class="col-md-4">
 
 <label>Order</label><br />
  <select class="form-control" name="order">
  <option value="asc">ASC</option>
  <option value="desc" <?php if(isset($_GET['order']) && $_GET['order'] == "desc"){ echo "selected=selected"; } ?>>DESC</option>  
  </select>
</div>

<div class="col-md-4">

 <label>Show</label><br />
  <select class="form-control" name="show">
 
  <option value="5" <?php if(isset($_GET['show']) && $_GET['show'] == "5"){ echo "selected=selected"; } ?>>5</option>  
  <option value="10" <?php if(isset($_GET['show']) && $_GET['show'] == "10"){ echo "selected=selected"; } ?>>10</option>  
  <option value="20" <?php if(!isset($_GET['show']) || isset($_GET['show']) && $_GET['show'] == "20"){ echo "selected=selected"; } ?>>20</option>  
  <option value="50" <?php if(isset($_GET['show']) && $_GET['show'] == "50"){ echo "selected=selected"; } ?>>50</option>  
  <option value="100" <?php if(isset($_GET['show']) && $_GET['show'] == "100"){ echo "selected=selected"; } ?>>100</option>  
  <option value="200" <?php if(isset($_GET['show']) && $_GET['show'] == "200"){ echo "selected=selected"; } ?>>200</option>   
  
  </select>

</div>


</div>


</div><!-- end card block -->
</div><!-- end card -->
 
<a href="post-new.php?post_type=listing_type"  class="btn btn-sm btn-primary"> <i class="fa fa-check" aria-hidden="true"></i> Add New</a>

 
<a href="edit-tags.php?taxonomy=listing&post_type=<?php echo $LISTING_TYPE; ?>"  class="btn btn-sm btn-secondary float-right" > <i class="fa fa-folder-open" aria-hidden="true"></i> Manage Categories</a>


</form>





<div class="clearfix"></div>
 
<div class="card">
<div class="card-header">

<div id="ajax_response_msg" class="float-right" style="color:green;"></div><!-- ajax -->

<span>
Found <?php echo $TOTALITEMS; ?> items. (page <?php if(!isset($_GET['cpage'])){ echo 1; }else{ echo $_GET['cpage']; } ?> of <?php if($TOTALPAGES == 0){ echo 1; }else{ echo $TOTALPAGES; } ?>)
</span>
</div>
<div class="card-body1"> 



<style>

.image img { max-width:52px; max-height:52px; overflow: hidden; border:1px solid #ddd; padding:2px; }
.featured i { font-size:20px; color:#ccc; }
.featured i.fa-star { color: #ff8c52; text-shadow: 1px 1px #fff; }
.wlt_shortcode_category a { font-size:12px; }
.wlt_shortcode_category a:after {     content: "\f105"; font-family: FontAwesome; margin-left:5px;  }
.wlt_shortcode_category a:last-child::after {  content: ''; }
</style>

<table  class="responsive table table-striped table-bordered " >
            <thead>
            <tr>
             <th class="no_sort" style="text-align:center;">
                Image
              </th>
             
              <th class="no_sort" >
                <?php if($LISTING_TYPE == "fixture"){ ?> Scores<?php }else{ ?>Title<?php } ?>
              </th> 
                <th class="no_sort" style="text-align:center;">
                <a href="edit.php?post_type=<?php echo $LISTING_TYPE; ?>&page=manage&type=<?php echo $LISTING_TYPE; ?>&featured=1">Featured</a>
              </th>
           
           <?php if(defined('WLT_CART') ){ ?>
             <th class="no_sort" style="text-align:center;">
               Price 
              </th>
              <?php }else{ ?>
              
                 <th class="no_sort" style="text-align:center;">
                Views
              </th>
              
              <?php } ?>
 		 
              <th class="ms no_sort" style="text-align:center;">
                Actions
              </th>
            </tr>
            </thead>
            <tbody>

<script>
function update_field_title(id, title){
 
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/index.php',		
		data: {
            admin_action: "update_title",
			title: title,
			id, id
 
        },
        success: function(response) {
			jQuery('#ajax_response_msg').html(response);			
        },
        error: function(e) {
            alert("error "+e)
        }
    }); 


 
}

function update_field_custom(pid, key, value){
 
    jQuery.ajax({
        type: "POST",
        url: '<?php echo home_url(); ?>/index.php',		
		data: {
            admin_action: "update_custom_field",
			pid, pid,
			key: key,
			value: value
 
        },
        success: function(response) {
			jQuery('#ajax_response_msg').html(response);			
        },
        error: function(e) {
            alert("error "+e)
        }
    }); 


 
}
</script>
       
<?php 
 

 
if ( $the_query->have_posts() ):
$tabin = 1;
while ( $the_query->have_posts() ) : $the_query->the_post();  ?>

<tr id="postid-<?php echo $post->ID; ?>">
 
 <td style="text-align:center; width:80px;">
 
     <div class="image">
     <?php echo do_shortcode('[IMAGE pid="'.$post->ID.'"]'); ?>
     </div>
 
 </td>
 


 
<td>
	








<?php if($LISTING_TYPE == "fixture"){ ?>



<div class="margin-bottom1">
    <div class="row">
        <div class="col-md-4">
        
       <div class="font-size11 margin-bottom1"><?php echo get_the_title(get_post_meta($post->ID,'team1',true)); ?></div>
        
        <input type="text" value="<?php echo get_post_meta($post->ID,'score1',true); ?>" onChange="update_field_custom('<?php echo $post->ID; ?>', 'score1', this.value);" tabindex="<?php echo $tabin; ?>" style="width:100%" />
        </div>
        <div class="col-md-4">
       
       
       <div class="font-size11 margin-bottom1"><?php echo get_the_title(get_post_meta($post->ID,'team2',true)); ?> </div>
        
        <input type="text" value="<?php echo get_post_meta($post->ID,'score2',true); ?>" onChange="update_field_custom('<?php echo $post->ID; ?>', 'score2', this.value);"  tabindex="<?php echo $tabin; ?>" style="width:100%" />
       
        </div>
        <div class="col-md-4">
       
       
      <div class="font-size11 margin-bottom1"> Status</div>
        
<?php

$status = array(
	"1" => "OK",
	"2" => "Finished",
	"3" => "Postponed",
	"4" => "Cancelled",
);

$fix_status = get_post_meta($post->ID,'status',true);

?>
 
  
    <select name="custom[status]" style="width:100%" onChange="update_field_custom('<?php echo $post->ID; ?>', 'status', this.value);">
    <?php foreach($status as $key => $club){ ?>
    <option value="<?php echo $key; ?>" <?php if($key == $fix_status){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
    <?php } ?>
    </select>
  
       
        </div>
        
        
    </div>
</div>
<div class="font-size11 margin-top1 grey">
<?php echo hook_date(get_post_meta($post->ID,'date',true)); ?>
</div>

<?php }else{ ?>
 
<div class="margin-bottom1">
    <div class="row">
        <div class="col-md-12">
        <input type="text" value="<?php echo $post->post_title; ?>" onChange="update_field_title('<?php echo $post->ID; ?>', this.value);" tabindex="<?php echo $tabin; ?>" style="width:100%" />
        </div>
       
    </div>
</div>


<?php } ?>









<?php if($post->post_status == "draft"){ ?><span class="tag tag-danger">Draft</span><?php } ?>

<?php echo do_shortcode('[CATEGORY pid="'.$post->ID.'" limit=5 type="'.$LISTING_TYPE.'s"]');  ?>
 
        
</td>
 <td style="text-align:center; width:80px;">
 
    
   <?php $is_featured = get_post_meta($post->ID ,"featured",true); 
   
   
   ?>
   <a href="javascript:void(0);" onclick="ajax_featured_listing('<?php echo $post->ID; ?>');">
   <div class="featured mt-1"><i class="fa <?php if($is_featured == "yes"){ ?>fa-star<?php }else{ ?>fa-star-o<?php } ?>"></i></div>
   </a>
 
 </td>
 
 
 <td style="text-align:center; width:80px;">
 
     <?php if(defined('WLT_CART')){ ?>
     <div class="mt-1"><?php echo do_shortcode('[PRODUCT-PRICE]'); ?></div>
    <?php }else{ ?>
    <div class="mt-1"><?php $hits = get_post_meta($post->ID,'hits', true); if(is_numeric($hits) && $hits > 0){ echo number_format($hits);}else{ echo 0; } ?></div>
    <?php } ?>
 
 </td>

 
              
<td class="ms" style="text-align:center; width:100px">

<div class="mt-1">

<a class="btn btn-primary btn-sm" href="post.php?post=<?php echo $post->ID; ?>&action=edit"  rel="tooltip" data-original-title="Edit" data-placement="top">
	<i class="fa fa-pencil"></i>
</a> 

<?php /*   
<a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="ajax_load_media(<?php echo $post->ID; ?>);"  rel="tooltip" data-original-title="Manage Files" data-placement="top">
	<i class="fa fa-photo"></i>
</a> */ ?>


<a href="javascript:void(0);" onclick="ajax_delete_listing(<?php echo $post->ID; ?>);" class="btn btn-danger btn-sm" rel="tooltip" data-placement="top" data-original-title="Delete">
	<i class="fa fa-trash"></i>
</a>      

</div>      
                
              </td>
            </tr>
            
<?php $tabin++; endwhile; ?>
 

<?php  endif; ?>            
              
             
            </tbody>
            </table> 
 

       
            
</div><!-- end card block -->
</div><!-- end card -->

<div class="clearfix"></div>

<div class="mb-3 mt-3">


    <a href="admin.php?page=premiumpress&exportalllistings=1" class="btn btn-info btn-sm float-right" ><i class="fa fa-download" aria-hidden="true"></i> Export All</a>
          
     
    <div class="mb-3"> Page <?php if(!isset($_GET['cpage'])){ echo 1; }else{ echo $_GET['cpage']; } ?> of <?php if($TOTALPAGES == 0){ echo 1; }else{ echo $TOTALPAGES; } ?></div> 
                
    <nav aria-label="Page navigation">
    <ul class="pagination">
    <?php
    $pages = new wlt_admin_paginator;
    $pages->items_total = $TOTALITEMS;
    $pages->items_per_page = $ITEMSPERPAGE;
    $pages->mid_range = $ITEMSPERPAGE/2;
    $pages->pagelink = home_url()."/wp-admin/admin.php?tab=home&".$_SERVER['QUERY_STRING'];
    $pages->paginate();
    echo $pages->display_pages();
    ?>
    </ul>
    </nav>


</div>
 