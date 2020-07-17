<?php global $CORE, $userdata, $wpdb, $settings;
 
?>

<style>


.cpars4 h2 {
    font-size: 48px;
    line-height: 58px;
    font-weight: 500;
    letter-spacing: 0px;
}
 
.cpars4 .inner {
    top: 50%;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
 
    position: relative;
    float: left;
    width: 100%;
}
 
</style>
<div class="cpars4 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
<div class="content-fluid"><div class="row">

<div class="col-md-6">


<div class="inner pr-5 ">
                                                <h2><?php echo $settings['txt1']; ?></h2>
                                                <hr class="no_line" style="margin: 0 auto 15px;">
                                                <p><?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></p>
                                                <hr class="no_line" style="margin: 0 auto 15px;">
                                                 <a href="<?php if(isset($settings['btn_link']) && $settings['btn_link'] != ""){ echo $settings['btn_link']; }else{ echo home_url()."/?s="; }?>" class="btn btn-primary p-3 px-lg-5">
				 <?php if(isset($settings['btn_txt']) && $settings['btn_txt'] != ""){ echo $settings['btn_txt']; }else{  echo __("Learn More","premiumpress");  } ?>
                 </a> 
                                            </div>

</div>


<div class="col-md-6">

<img src="<?php if($settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/700x500.png?text=PremiumPress+Themes<?php } ?>" alt="<?php echo $settings['txt1']; ?>" class="img-fluid rounded">

</div>

</div></div>
</div>