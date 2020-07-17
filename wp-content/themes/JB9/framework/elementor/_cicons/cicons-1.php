<?php

global $settings, $CORE;
 
?>
<style>
.cicons1 .item {    border: 1px solid #dfdfdf;   padding: 10px 7px;    margin-bottom: 15px;    background-color: #fff; 		font-size: 14px;    color: #aaaaaa;}
.cicons1 .item .icon {    width: 66px;    height: 66px;    line-height: 62px;	    float: left;    margin-left: 20px; margin-right:10px;}
.cicons1 .item .fa { font-size: 50px;  }
.cicons1 strong { display:block; font-size: 16px;    font-weight: bold; text-transform:uppercase; color: #333333;     margin-top: 5px; }

</style>
<div class="cicons1">
 
      <div class="row">
         <div class="col-lg-3 col-6 col-md-6 d-none d-md-block d-md-lg">
            <div data-wow-duration="1s" class="wow bounceInUp animated item">  
               <span class="icon">
               <i class="fa <?php if(isset($settings['box1_icon']) && $settings['box1_icon'] != ""){ echo $settings['box1_icon']; }else{ ?>fa-bullhorn<?php } ?> text-secondary"></i>
               </span>
               <strong><?php if(isset($settings['box1_txt1']) && $settings['box1_txt1'] != ""){ echo $settings['box1_txt1']; }else{ echo __("Big Savings","premiumpress"); } ?></strong>
               <span><?php if(isset($settings['box2_txt2']) && $settings['box2_txt2'] != ""){ echo $settings['box2_txt2']; }else{ echo __("Save upto 70%","premiumpress"); } ?></span>
            </div>
         </div>
         
         <div class="col-lg-3 col-12 col-sm-6">
            <div data-wow-duration="1.5s" class="wow bounceInUp animated item">  
               <span class="icon">
               <i class="fa <?php if(isset($settings['box2_icon']) && $settings['box2_icon'] != ""){ echo $settings['box2_icon']; }else{ ?>fa-cube<?php } ?> text-secondary"></i>
               </span>
               <strong><?php if(isset($settings['box2_txt1']) && $settings['box2_txt1'] != ""){ echo $settings['box2_txt1']; }else{ echo __("Add Your Items","premiumpress"); } ?></strong>
               <span><?php if(isset($settings['box2_txt2']) && $settings['box2_txt2'] != ""){ echo $settings['box2_txt2']; }else{ echo __("Sell your stuff here","premiumpress"); } ?></span>
            </div>
         </div>
      
         <div class="col-lg-3 col-12 col-sm-6">
            <div data-wow-duration="2s" class="wow bounceInUp animated item">
               <span class="icon">
               <i class="fa <?php if(isset($settings['box3_icon']) && $settings['box3_icon'] != ""){ echo $settings['box3_icon']; }else{ ?>fa-user-circle<?php } ?> text-secondary"></i>
               </span>
               <strong><?php if(isset($settings['box3_txt1']) && $settings['box3_txt1'] != ""){ echo $settings['box3_txt1']; }else{ echo __("Join Free","premiumpress"); } ?></strong>
               <span><?php if(isset($settings['box3_txt2']) && $settings['box3_txt2'] != ""){ echo $settings['box3_txt2']; }else{ echo __("Get started today!","premiumpress"); } ?></span>
            </div>
         </div>
         
         <div class="col-lg-3 col-6 col-md-6">
            <div data-wow-duration="2s" class="wow bounceInUp animated item d-none d-md-block d-md-lg">  
               <span class="icon">
               <i class="fa <?php if(isset($settings['box4_icon']) && $settings['box4_icon'] != ""){ echo $settings['box4_icon']; }else{ ?>fa-support<?php } ?> text-secondary"></i>
               </span>
               <strong><?php if(isset($settings['box4_txt1']) && $settings['box4_txt1'] != ""){ echo $settings['box4_txt1']; }else{ echo __("24/7 Support","premiumpress"); } ?></strong>
               <span><?php if(isset($settings['box4_txt2']) && $settings['box4_txt2'] != ""){ echo $settings['box4_txt2']; }else{ echo __("Always here to help","premiumpress"); } ?></span>
            </div>
         </div>
      </div>
</div>
 