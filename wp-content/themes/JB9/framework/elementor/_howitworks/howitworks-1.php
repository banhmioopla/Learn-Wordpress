<?php global $CORE, $userdata, $wpdb, $settings; ?>

<style>

.howworks1 .fa {
   position:absolute;
 
   right:10px;
    font-size: 30px;
    
    opacity: 0.4;
}
.howworks1 .box { position:relative; overflow:hidden; }
.howworks1 h6, .howworks1 .fa { text-shadow: 1px 1px #343940; }
.howworks1 p { color:#333333; }
</style> 
    
<div class="howworks1 <?php if(isset($settings['class']) && $settings['class'] != ""){ echo $settings['class']; }else{ echo " mb-3"; } ?>">
<div class="bg-primary">
    
    <div  class="bg-dark clearfix text-white">
    
    <h6 class="mb-0 small p-2"><?php echo __("How it works","premiumpress"); ?></h6>
    
    </div>
    
    <div class="box p-3 text-white"   style="background: #ffffff1e;">
    
    <i class="fa text-white fa-search"></i>
    
    <h6><?php echo __("Search and discover","premiumpress"); ?></h6>
    
    <p class="small pb-0"><?php echo __("Search for items you want.","premiumpress"); ?></p>
    
    </div>
    
    <div class="box p-3 text-white"   style="background: #ffffff3e;">
   
    <i class="fa text-white fa-handshake-o"></i>
    
    <h6><?php echo __("Make an offer","premiumpress"); ?></h6>
    
    <p class="small pb-0"><?php echo __("Make an offer for chosen items.","premiumpress"); ?></p>
    
    </div> 
    
    <div class="box p-3 text-white"   style="background: #ffffff5e;">
   
    <i class="fa text-white fa-money"></i>
    
    <h6><?php echo __("Payment and feedback","premiumpress"); ?></h6>
    
    <p class="small pb-0"><?php echo __("Pay and leave feedback.","premiumpress"); ?></p>
    
    </div> 
</div>   
</div> 
                     
<div class="small mb-3">

Not yet a member? <a href="<?php echo wp_registration_url(); ?>" style="text-decoration:underline;">Signup / login here.</a>

</div>