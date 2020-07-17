<?php global $CORE, $userdata, $wpdb, $settings;

// MY FAVOURITES
$c2 = 0;
if($userdata->ID){

	// MY FAVOURITES
	$c2 = $CORE->user_favs_count();
}
?>
 
<header class="ppt-header header-6 no-sticky viewport-lg">

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
            <div class="col-md-3">
               <div class="logo text-left pl-0" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
                  <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
                  <?php echo hook_logo(0); ?>
                  </a>
               </div>
            </div>
            <div class="col-md-4 d-none d-lg-block">
            
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
                        <button><i class="fa fa-search"></i></button> 
                     </div>
                  </div>
               </form>
               
               <?php } ?>
               
            </div>
            <div class="col-md-5 d-none d-lg-block">
           
            
            <ul class="links">
                       
            <?php if(!$userdata->ID){ ?>
            <li class="icon1"> 
                     <a href="<?php echo wp_registration_url(); ?>">
                     <?php echo __("Sign up/in","premiumpress"); ?>
                     </a>
             </li>
             <?php }else{ ?>
             <li class="icon0"> 
                     <a href="<?php echo _ppt(array('links','myaccount')); ?>">
                     <?php echo __("My Account","premiumpress"); ?>
                     </a>
           </li>
           <?php } ?>
            
            </li>
            <li class="icon2"> <a href="<?php echo home_url(); ?>/?s=&favs=1" class="text-dark"><?php echo __("Favorites","premiumpress"); ?><?php if($c2 > 0){ ?><span><?php echo $c2; ?></span><?php } ?></a></li>
            <li class="icon3"> 
            
            <a href="<?php echo _ppt(array('links','cart')); ?>">
           
            <?php echo __("Basket","premiumpress"); ?><span class="cart-basket-count"></span>           
            </a> 
             
            
            </li>
            
            </ul>
             
             
            </div>
         </div>
      </div>
   </div>
   
   <?php if(!isset($GLOBALS['header-transparent'])){ ?>
   
   <div class="header-nav-inner center-menu-2 bg-primary"  id="header-menu">
   <div class="container" style=" position: relative;">
  
         <nav class="ppt-menu separate-line submenu-scale text-left">
         <?php ob_start(); ?>
          <li class="menu-item d-block d-sm-none"><a href="<?php echo _ppt(array('links','cart')); ?>"> <?php echo __("My Basket","premiumpress"); ?><span class="cart-basket-count"></span> </a></li>
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
 