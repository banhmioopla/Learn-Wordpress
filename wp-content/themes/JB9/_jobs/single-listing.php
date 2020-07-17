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
 
global $post, $CORE, $userdata;
 
get_header($CORE->pageswitch());

if($post->post_author == $userdata->ID){   get_template_part('author', 'toolbox' );   } ?>

<?php get_template_part( '_jobs/widgets/widget', 'title' );  ?>  

<main id="main">
   <div class="container py-5">
      <div class="row">
         <div class="col-lg-8 pr-lg-5">
            <select class="form-control mb-4" id="mobile-submenu" onchange="selectWidgetBox(this.value)">
               <option value="#widget-maindetails"><?php echo __("Show Description","premiumpress") ?></option>
            </select>
            <?php get_template_part( '_jobs/widgets/widget', 'content' );  ?>           
      </div>
      <?php get_sidebar(); ?>	
   </div>
   </div>
</main>
<script>

   jQuery(window).on('resize', function(){
   var win = jQuery(this);        
   SingleMobileMenuDisplay(win.width());
   });
   jQuery(document).ready(function() {
   var win = jQuery(this);       
   SingleMobileMenuDisplay(win.width());
   jQuery('.widget').each(function(index,item){			
   var id = this.id;		
   jQuery('#mobile-submenu').append('<option value="#'+id+'">' + jQuery('#'+id).data('title') + '</option>');
   });	
   });
   function selectWidgetBox(h){
   jQuery('.widget').hide();
   jQuery('#widget-maindetails').hide();	 	
   jQuery(h).show();		
   }
   function SingleMobileMenuDisplay(winsize){ 
      if (winsize < 991.98) {		  
   	  jQuery('#mobile-submenu').show();
   if(jQuery('#mobile-submenu').val() == "#widget-maindetails"){
   	jQuery('.widget').hide();
     jQuery('#widget-maindetails').show();
   }				
   }else{	  	
     jQuery('#widget-maindetails').show();
   	jQuery('#mobile-submenu').hide(); 
   jQuery('.widget').show();	  
   }
   }   
</script>
<?php get_footer($CORE->pageswitch()); ?>