<?php global $CORE, $userdata, $wpdb, $settings; ?>
<style>
.cta2.bg-dark a { color:#FFFFFF;}
.cta2.withimg { padding:100px 0px !important; }
</style>
<div class="cta2 content-fluid py-5 <?php if(isset($settings['class']) && $settings['class'] != ""){ echo $settings['class']; }else{ ?>bg-light<?php } ?>" <?php if(isset($settings['img']) && $settings['img'] != ""){ ?>style="background:url('<?php echo $settings['img']; ?>');"<?php } ?>>
<div class="container">
<div class="row">

    <div class="col-md-6">
    
    <div class="pl-5">
    <h3><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></h3>
    
    <p class="mt-3">
    
   <?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>
   
   Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu.
   
   <?php } ?>
    
    </p>
    </div>
    
    
    </div>
    
      <div class="col-md-2"></div>
   
    
    <div class="col-md-4 text-left">
    
    <p><?php echo __("Sign up for Newsletter","premiumpress") ?></p>
    
     <?php get_template_part( 'templates/widget', 'newsletter' ); ?>   
    </div>

</div>
</div>
</div>