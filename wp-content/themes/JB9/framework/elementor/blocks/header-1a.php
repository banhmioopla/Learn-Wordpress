<?php global $CORE, $userdata, $wpdb;

// MY FAVOURITES
$c2 = 0;
if($userdata->ID){

	// MY FAVOURITES
	$c2 = $CORE->user_favs_count();
}
?>


<header class="ppt-header header-1 no-sticky viewport-lg <?php if(isset($GLOBALS['header-transparent'])){ ?>header-transparent-on<?php } ?>">

   <!-- HEADER TOP --> 
   <div class="header-top-1 d-none d-md-block" id="header-top">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <ul class="top-bar-menu clearfix mb-0">
                  <li>
                     <?php if(!$userdata->ID){ ?>
                     <a href="<?php echo wp_registration_url(); ?>">
                     <?php echo __("Sign up/in","premiumpress"); ?>
                     </a>
                     <?php }else{ ?>
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>">
                     <?php echo __("My Account","premiumpress"); ?>
                     </a>
                     <?php } ?>
                  </li>
                  <li><a href="<?php echo _ppt(array('links','blog')); ?>"><?php echo __("Blog","premiumpress"); ?></a></li>
                  <li><a href="<?php echo _ppt(array('links','aboutus')); ?>"><?php echo __("About Us","premiumpress"); ?></a></li>
                  <li><a href="<?php echo _ppt(array('links','contact')); ?>"><?php echo __("Contact","premiumpress"); ?></a></li>
               </ul>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
               <div class="socials">
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','twitter')); ?>" title="Twitter"><i class="fa <?php echo _ppt(array('social','twitter_icon')); ?>"></i></a>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','facebook')); ?>" title="Facebook"><i class="fa <?php echo _ppt(array('social','facebook_icon')); ?>"></i></a>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','dribbble')); ?>" title="Google plus"><i class="fa <?php echo _ppt(array('social','dribbble_icon')); ?>"></i></a> 
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','linkedin')); ?>" title="Dribbble"><i class="fa <?php echo _ppt(array('social','linkedin_icon')); ?>"></i></a>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','skype')); ?>" title="Skype"><i class="fa <?php echo _ppt(array('social','skype_icon')); ?>"></i></a>
                  <a class="social" target="_blank" href="<?php echo _ppt(array('social','youtube')); ?>" title="Skype"><i class="fa <?php echo _ppt(array('social','youtube_icon')); ?>"></i></a>               
               </div>
               <ul class="top-bar-menu float-right clearfix mb-0">
                  <li><?php echo $CORE->_curreny_dropdown_menu(0); ?></li>
                  <?php if(_ppt('language_dropdown') == 1){ ?> 
                  <li><?php echo $CORE->_language_dropdown_menu(0); ?> </li>
                  <?php } ?>
               </ul>
            </div>
         </div>
      </div>
   </div>
   
   
   
      <div class="burger-menu mt-4">
      <div class="line-menu line-half first-line"></div>
      <div class="line-menu"></div>
      <div class="line-menu line-half last-line"></div>
   </div>
   <div class="center-menu-2"  id="header-logo">
      <div class="container py-4">
         <div class="row">
            <div class="col-md-4">
               <div class="logo text-left pl-0" data-mobile-logo="<?php echo $GLOBALS['CORE_THEME']['logo_url']; ?>" data-sticky-logo="<?php echo $GLOBALS['CORE_THEME']['logo_url']; ?>">
                  <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
                  <?php echo hook_logo(0); ?>
                  </a>
               </div>
            </div>
            <div class="col-md-5 d-none d-lg-block">
            
            <?php if(!isset($GLOBALS['header-transparent'])){ ?>
            
               <form action="<?php echo get_home_url(); ?>/" method="get" name="" id="searchform1">
                  <input type="hidden" name="catid" value="" id="searchform1_catid" />
                  <div class="form-group mb-1">
                     <div class="input-group">
                        <div class="input-group-addon dropdown hidden-md-down">
                           <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" id="searchform_title"><?php echo __("Categories","premiumpress") ?></a>
                           <div class="dropdown-menu" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut" id="catselect">
                              <?php
                                 echo wp_list_categories( array(
                                 								'taxonomy'  	=> 'listing',
                                 								'depth'         => 1,	
                                 								'hierarchical'  => 1,		
                                 								'hide_empty'    => 0,
                                 								'echo'			=> false,
                                 								'title_li' 		=> '',
                                 								'show_count' 	=> 0,
                                 								'orderby' 		=> 'term_order',
                                 								'walker'		=> new walker_dropdown_categories_form,
                                 								 
                                 								) );
                                 
                                 ?>
                           </div>
                        </div>
                        <input type="text" class="form-control" name="s" value="<?php if(isset($_GET['s'])){ echo strip_tags($_GET['s']); } ?>" >
                        <button><i class="fa fa-search text-dark"></i></button> 
                     </div>
                  </div>
               </form>
               
               <?php } ?>
               
            </div>
            <div class="col-md-3 d-none d-lg-block">
               <div class="hicons row float-right mt-1">
                  <div class="phonebox">
                     <?php if(!$userdata->ID){ ?>                 
                     <a href="<?php echo wp_login_url(); ?>" class="text-dark">
                     <span class="iconsmall"><i class="fa fa-lock text-primary"></i></span>
                     <span class="content mr-3">
                     <span class="text1 mb-1"><?php echo __("members area","premiumpress"); ?></span>
                     <span class="text2"><?php echo __("Sign up/in here","premiumpress"); ?></span>  
                     </span>              
                     </a>
                     <?php }else{ ?>
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>" class="text-dark">
                     <span class="iconsmall"><i class="fa fa-user-circle text-primary"></i></span>
                     <span class="content mr-3">
                     <span class="text1 mb-1"><?php echo __("My Account","premiumpress"); ?></span>
                     <span class="text2"><?php echo __("view dashboard","premiumpress"); ?></span> 
                     </span>               
                     </a>
                     <?php } ?>  
                  </div>
                  <a href="<?php if($userdata->ID){ ?><?php echo home_url(); ?>/?s=&favs=1<?php }else{ ?><?php echo site_url('wp-login.php?action=login', 'login_post'); ?><?php } ?>" class="mx-4 text-dark">
                     <div class="icon icon1"> 
                        <span class="count bg-secondary"><?php echo $c2; ?></span> 
                     </div>
                     <div class="small text-uppercase"><?php echo __("favorites","premiumpress"); ?></div>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   <?php if(!isset($GLOBALS['header-transparent'])){ ?>
   
   <div class="header-nav-inner center-menu-2 bg-primary"  id="header-menu">
   <div class="container">
       
     
 
      
      
      <div class="box-header-nav">
         <nav class="ppt-menu separate-line submenu-scale text-left">
         <?php ob_start(); ?>
          
         <li class="float-right addon-cartbtn">
            <a href="<?php echo _ppt(array('links','cart')); ?>" class="btn btn-secondary rounded-0 mr-2 cartbtn">
            <?php echo __("Basket","premiumpress"); ?> (<span class="cart-basket-count"></span>)
            <span class="iconb"><i class="fa fa-shopping-basket text-white"></i></span>
            </a> 
         </li>
         <?php
            $addon = ob_get_clean();
                     ?>
         <nav class="ppt-menu  text-left">
            <?php 
               ob_start();	
               echo do_shortcode('[MAINMENU class="" style="1"]');
               $menu = ob_get_clean();                  
               echo str_replace("</ul>",  $addon."</ul>", $menu);
                
                ?>
         </nav>
      </div>
   </div>
   <?php } ?>
</header>

<script>					   
jQuery("#catselect").on("click", "a", function(){
   
   jQuery('#searchform1_catid').val(jQuery(this).data("catid"));
   jQuery('#searchform_title').html(jQuery(this).attr("data-name"));
   
});

<?php if(isset($_GET['catid']) && is_numeric($_GET['catid'])){ ?>
jQuery(document).ready(function() {

	jQuery("#catselect a").each(function(){
		if(jQuery(this).attr("data-catid") == "<?php echo $_GET['catid']; ?>"){
		jQuery('#searchform_title').html(jQuery(this).attr("data-name"));
		}
	});

});
<?php } ?>
 </script> 