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
 
 
if(!_ppt_checkfile("sidebar.php")){

global $CORE, $post, $settings;
 
if(isset($GLOBALS['flag-add'])){

	$sidebarID = "add";

}elseif(isset($GLOBALS['flag-taxonomy'])){

	$sidebarID = "taxonomy";

}elseif(isset($GLOBALS['flag-blog'])){

	$sidebarID = "blog";
		
}elseif(isset($GLOBALS['flag-single'])){

	$sidebarID = "listing";
	
}elseif(isset($GLOBALS['flag-search'])){

	$sidebarID = "search";

}else{

	$sidebarID = "page";

}

 
	// SET DEFAULTS
	ob_start();
	dynamic_sidebar($sidebarID); 
	$sidebar_content = ob_get_clean();
 
	
?>

<?php if(!isset($settings['no-width'])){ ?>
 
<aside class="sidebar-<?php echo $sidebarID; ?> <?php 

if(isset($GLOBALS['flag-single']) && in_array(THEME_KEY , array('cm') ) ){ ?> col-12 col-lg-5 mt-30-xs<?php }

if(in_array(THEME_KEY , array('cp') ) ){ ?> col-12 col-sm-4 col-md-4 mt-30-xs<?php }

elseif(in_array(THEME_KEY , array('dt','mj','da','at','ct','rt','jb','vt','ph','so')) && isset($GLOBALS['flag-single']) ){ ?> col-12 col-lg-4<?php }

else{ ?> col-12 col-lg-3<?php } if(defined('PPTCOL-LEFT') && !isset($GLOBALS['flag-single'])  ){ echo " hide-mobile"; }?>">
<?php } ?>

    <?php	
 	
	// ADVERTISING WIDGET	 		
	echo $CORE->BANNER($sidebarID,'mb-4', "top");		
	?>  
    <?php 
	
	// SET DEFAULTS
	ob_start();
	dynamic_sidebar($sidebarID); 
	$sidebar_content = ob_get_clean();
	
	if($sidebar_content == "" && $sidebarID == "add"){
	
	
		get_template_part( 'widgets/widget', 'add-renew' );
	
	
	}elseif($sidebar_content == "" && $sidebarID == "page"){
 
	
		if(THEME_KEY == "so"){
		
		
			if(!in_array(THEME_KEY, array('sp','cm','da')) ){
		
			get_template_part( 'widgets/widget', 'button' ); 
  			
			}
			
			get_template_part( 'widgets/widget', 'categorylist' );
			
			get_template_part( 'widgets/widget', 'listings' ); 
			
			echo $CORE->BANNER($sidebarID,'mt-4', "bottom");
			
			get_template_part( 'widgets/widget', 'social' );	
  
    		get_template_part( 'widgets/widget', 'listings-recent' );
			
			get_template_part( 'widgets/widget', 'newsletter' ); 	
		
	
		}elseif(THEME_KEY == "cp"){			 
			
			get_template_part( 'widgets/widget', 'social' ); 
  
			get_template_part( '_coupon/widgets/widget', 'sidebar-stores' );	
			
		 	echo $CORE->BANNER($sidebarID,'mt-4', "bottom");	
  			
    		get_template_part( '_coupon/widgets/widget', 'sidebar-categories' );
			
			get_template_part( '_coupon/widgets/widget', 'sidebar-deals' );
			
			get_template_part( 'widgets/widget', 'listings-recent' );
			
			get_template_part( 'widgets/widget', 'newsletter' ); 			 
		
		}else{
		
			if(!in_array(THEME_KEY, array('sp','cm','da')) ){
		
			get_template_part( 'widgets/widget', 'button' ); 
  			
			}
			
			if(THEME_KEY == "dt"){
			
			get_template_part( 'widgets/widget', 'categorylist' );
			
			}
			
			get_template_part( 'widgets/widget', 'listings' ); 
			
			echo $CORE->BANNER($sidebarID,'mt-4', "bottom");
			
			get_template_part( 'widgets/widget', 'social' );	
  
    		get_template_part( 'widgets/widget', 'listings-recent' );
			
			get_template_part( 'widgets/widget', 'newsletter' ); 	
		}

	}elseif(THEME_KEY == "cp" && $sidebar_content == "" && $sidebarID == "taxonomy"){	
	
	  
	 	get_template_part( 'widgets/widget', 'taxonomy' );	
		 
		
		get_template_part( 'widgets/widget', 'listings-recent' );
		
		if(THEME_KEY == "cp" && get_query_var( 'taxonomy' ) == "store"  ){	
		
		dynamic_sidebar('store');
		
		}elseif( get_query_var( 'taxonomy' ) == "listing" ){
		
		dynamic_sidebar('category');
		
		}		
 		
	}elseif($sidebar_content == "" && ( $sidebarID == "search" || $sidebarID == "taxonomy")){		
		
		
		if(!in_array(THEME_KEY, array('sp','cm','da')) ){
		
		get_template_part( 'widgets/widget', 'button' ); 
  			
		}
		 
		
		if(THEME_KEY == "dt"){
			
			get_template_part( 'widgets/widget', 'categorylist' );
		
		}else{
		
			get_template_part( 'widgets/widget', 'search' ); 	
		
		}
		
				 
		get_template_part( 'widgets/widget', 'listings' ); 
			
		echo $CORE->BANNER($sidebarID,'mt-4', "bottom");
			
		get_template_part( 'widgets/widget', 'social' );	
  
    	get_template_part( 'widgets/widget', 'listings-recent' );
		
		if(!in_array(THEME_KEY,array("rt","dt"))){
		get_template_part( 'widgets/widget', 'categories' );
		}
		
		get_template_part( 'widgets/widget', 'newsletter' ); 
			
		dynamic_sidebar('search');
	
 
	}elseif($sidebar_content == "" && $sidebarID == "blog"){
	 	 
		get_template_part( 'widgets/widget', 'blog-categories' );
		
		get_template_part( 'widgets/widget', 'blog-recent' );
		
		get_template_part( 'widgets/widget', 'newsletter' ); 
		
		dynamic_sidebar('blog');
 
	
	}elseif($sidebar_content == "" && $sidebarID == "listing"){	
		
		
		if(THEME_KEY == "ph"){
		
		get_template_part( 'widgets/widget', 'like' ); 
		
		get_template_part( '_photography/widgets/widget', 'buybox' ); 
		
		get_template_part( 'widgets/widget', 'listings-recent' ); 
		
		
		}
		
		if(THEME_KEY == "so"){
		
		get_template_part( '_software/widgets/widget', 'buybox' ); 
		
		get_template_part( 'widgets/widget', 'listings' ); 
		
 		
		
		}
		
		
		if(THEME_KEY == "dt"){
		
		get_template_part( 'widgets/widget', 'like' ); 
						
		   get_template_part( '_directory/widgets/widget', 'call' );  
     
		   get_template_part( '_directory/widgets/widget', 'openinghours' );
		   
		 
		   get_template_part( '_directory/widgets/widget', 'claimlisting' );
		 	
			get_template_part( '_directory/widgets/widget', 'nearby' );
			
		}
		
		if(THEME_KEY == "cp"){
			
			get_template_part( 'widgets/widget', 'taxonomy' );	
		}
		
		if(THEME_KEY == "mj"){	
		
			get_template_part( '_micro/widgets/widget', 'buybox' );
       
        	get_template_part( '_micro/widgets/widget', 'seller' );
		
		}
		
		if(THEME_KEY == "da"){	
		
			get_template_part( '_dating/widgets/widget', 'photo' ); 
		
		}		

		if(THEME_KEY == "at"){
			
			get_template_part( '_auction/widgets/widget', 'buybox' );
		 	
			get_template_part( 'widgets/widget', 'single-sellerbox' );
			 
		
		}	
		
		if(THEME_KEY == "ct"){		
		 	
			get_template_part( '_classifieds/widgets/widget', 'buybox' ); 
			get_template_part( 'widgets/widget', 'single-contactform' ); 

		}	
		
		if(THEME_KEY == "jb"){		
		 	
			get_template_part( '_jobs/widgets/widget', 'jobdetails' );
			 
			get_template_part( '_jobs/widgets/widget', 'companydetails' ); 

		}	
		
		if(THEME_KEY == "rt"){		
		 		
			get_template_part( '_realestate/widgets/widget', 'pricebox' ); 
                              
			get_template_part( '_realestate/widgets/widget', 'contact' ); 
		}
		
		if(THEME_KEY == "cm"){
				
		 	get_template_part( '_compare/widgets/widget', 'table' ); 
                                
		}
		
		if(THEME_KEY == "vt"){
				
		 	get_template_part( '_video/widgets/widget','sidebar-access' ); 
           	  
			get_template_part( '_video/widgets/widget','sidebar-details' ); 
                               
		}		
		 
		
	 	
	}elseif($sidebar_content == ""){ ?>
   
        
    <?php }else{ ?>

    <?php echo $sidebar_content; ?>
    
    <?php } ?>
    
    <?php	
 	
	// ADVERTISING WIDGET	 		
	echo $CORE->BANNER($sidebarID,'mt-4', "bottom");		
	?>    
<?php if(!isset($settings['no-width'])){ ?>
</aside>
<?php } ?>
<?php } ?>