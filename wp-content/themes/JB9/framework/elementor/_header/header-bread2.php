<?php global $CORE, $userdata, $wpdb, $settings;
 
?>
<div class="elementor_header header-bread2 py-3 small border-bottom ">
  
      <div class="container">
         <div class="row">
            <div class="col-8">
            
               <?php echo $CORE->BREADCRUMBS(); ?>
            </div>
            <div class="col-4 text-right">
            	<?php if(defined('WLT_DEMOMODE') ||  get_option('users_can_register') == 1){ ?>
				  <?php if(!$userdata->ID){ ?>
                  <a href="<?php echo wp_login_url(); ?>">
                   <span><?php echo __("Sign up/in","premiumpress"); ?></span>
                  </a>
                  
                  <?php if(_ppt('social_facebook') == 1){ ?>
                    <a href="<?php echo wp_login_url(); ?>" class="ml-3">
                    <img src="<?php echo get_template_directory_uri(); ?>/framework/img/facebooklogin.png" alt="facebook login" /> 
					</a>
                    <?php } ?>
                    
                  <?php }else{ ?>
                  <a href="<?php echo _ppt(array('links','myaccount')); ?>">               
                   <span><?php echo __("My Account","premiumpress"); ?></span>
                  </a>
                  <?php } ?>   
                  <?php } ?>
            </div>
         </div>
      </div>
 
</div>