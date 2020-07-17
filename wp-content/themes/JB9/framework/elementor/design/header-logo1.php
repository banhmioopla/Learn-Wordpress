<?php global $CORE, $userdata, $wpdb, $settings;
 
?>

<div class="ppt-header header-innner  <?php if(isset($settings['class'])){ echo $settings['class']." "; } ?><?php if(isset($settings['transparent'])){ ?>header-transparent-on<?php } ?> <?php if(isset($settings['shadow'])){ ?>header-shadow<?php } ?> header-light viewport-lg <?php if(isset($settings['nosticky'])){ ?>no-sticky<?php } ?>">
<div  id="header-menu">
   <div class="container">
      <div class="ppt-header-container">
         <div class="logo" data-mobile-logo="<?php echo hook_logo(array(1,0)); ?>" data-sticky-logo="<?php echo hook_logo(array(1,0)); ?>">
            <a href="<?php echo get_home_url(); ?>/" title="<?php echo get_bloginfo('name'); ?>">
            <?php echo hook_logo(0); ?>
            </a>
         </div>
         <div class="burger-menu">
            <div class="line-menu line-half first-line"></div>
            <div class="line-menu"></div>
            <div class="line-menu line-half last-line"></div>
         </div>
       
          <?php
		  ob_start(); ?>      
           
             
         <li class="menu-item myaccount">
           <?php if(!$userdata->ID){ ?>
                  <a href="<?php echo wp_login_url(); ?>">
                   <span><?php echo __("Sign up/in","premiumpress"); ?></span>
                  </a>
                  <?php }else{ ?>
                  <a href="<?php echo _ppt(array('links','myaccount')); ?>">               
                   <span><?php echo __("My Account","premiumpress"); ?></span>
                  </a>
                  <?php } ?>         
         </li>         
		 <?php if(THEME_KEY == "sp" || ( isset($settings['basket']) && $settings['basket'] == 1 ) ){ ?>
         
         <li class="menu-item">          
         <a href="<?php echo _ppt(array('links','cart')); ?>">
         <span><i class="fa fa-shopping-basket"></i>  <strong class="pr-2 d-block d-sm-none" style="display:inline-block"><?php echo __("My Basket","premiumpress"); ?></strong> (<span class="cart-basket-count"></span>)</span>
         </a>
         </li> 
         
         <?php } ?>
         
		 <?php if(THEME_KEY == "jb" && _ppt(array('links','apply')) != "" ){ ?>
         <li class="menu-item">          
         <a href="<?php echo _ppt(array('links','apply')); ?>">
         <span><i class="fa fa-bookmark-o mr-2"></i>  <?php echo __("Job Center","premiumpress"); ?></span>
         </a>
         </li> 
         <?php } ?>
         <?php if(THEME_KEY == "mj"){ 
		 
		 
// COUNT OPEN JOBS
$count = 0;
if($userdata->ID){
 $args = array(
                        'post_type' 		=> 'ppt_jobs',
                        'posts_per_page' 	=> 12,
                        'paged' 			=> 1,
                     	'post_status'		=> 'publish',
						'meta_query' => array(	
						'relation'    => 'AND',					
							array(							
							'relation'    => 'OR',											 
							'user1'    => array(
								'key' => 'buyer_id',
								'compare' => '=',
								'value' => $userdata->ID,							 			
							),			 
							'user2'   => array(
								'key'     => 'seller_id',							
								'compare' => '=',
								'value' => $userdata->ID,	
												
							),						
						),	
						),
                     );					
                     $wp_query2 = new WP_Query($args); 
                     
                     // COUNT EXISTING ADVERTISERS	 
                     $open = $wpdb->get_results($wp_query2->request, OBJECT);
$count = count($open);

}
		 
		 ?>
          <li class="menu-item">
            <a 
               <?php if($userdata->ID){ ?>
               href="<?php echo _ppt(array('links','workdesk')); ?>" 
               <?php }else{ ?>
               href="<?php echo wp_login_url(); ?>"
               <?php } ?>
               data-toggle="tooltip" data-placement="bottom" title="<?php echo __("My Work Desk","premiumpress"); ?>">
            	<i class="fa fa-briefcase"></i>
            
             <?php if($count > 0){ ?><span class="badge badge-warning badge-pill" style="    position: absolute;    top: 30px;    left: 30px;"><?php echo $count; ?></span><?php } ?>
            </a>
         </li>
         <?php } ?>
         <?php
		 $addon = ob_get_clean();		 
		 ?>        
         <nav class="ppt-menu separate-line submenu-top-border submenu-scale">
            <?php 
			ob_start();	
			echo do_shortcode('[MAINMENU class="" style="1"]');
			$image = ob_get_clean();
		 	
			echo str_replace("</ul>",  $addon."</ul>", $image);
			 
			 ?> 
         </nav>
      </div>
   </div>
</div>
</div>
 