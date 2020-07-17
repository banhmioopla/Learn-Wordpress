<?php global $CORE, $userdata, $wpdb, $settings;
   ?>
<div class="cpars7 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
   <div class="inner">
      <div class="cpars7_left">
         
         
         <?php $i=1; while($i < 4){ ?>
         <div class="ccontent">
         <?php if(isset($settings[$i.'link']) && $settings[$i.'link'] != ""){ ?>
         <a href="<?php echo $settings[$i.'link']; ?>" style="text-decoration:underline;">
         <?php } ?>
            <h3><span><?php if(isset($settings[$i.'title']) && $settings[$i.'title'] != ""){ echo $settings[$i.'title']; }else{ ?>Example Title Here<?php } ?></span>
               <em class="badge badge-success p-1"><?php if(isset($settings[$i.'num']) && $settings[$i.'num'] != ""){ echo $settings[$i.'num']; }else{ echo '<i class="fa fa-angle-right" aria-hidden="true"></i>'; } ?></em> 
            </h3>
        <?php if(isset($settings[$i.'link']) && $settings[$i.'link'] != ""){ ?>
        </a>
        <?php } ?>
            <p><?php if(isset($settings[$i.'desc']) && $settings[$i.'desc'] != ""){ echo $settings[$i.'desc']; }else{ ?>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<?php } ?></p>
         </div>
         <?php $i++; } ?>
         
     </div>
      
      <div class="cpars7_figure text-center">
         <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/350x500.png?text=PremiumPress+Themes<?php } ?>" alt="<?php echo $settings['1title']; ?>" class="img-fluid">
      </div>
      <div class="cpars7_right">
      
        <?php $i=4; while($i < 7){ ?>
         <div class="ccontent">
         <?php if(isset($settings[$i.'link']) && $settings[$i.'link'] != ""){ ?>
         <a href="<?php echo $settings[$i.'link']; ?>" style="text-decoration:underline;">
         <?php } ?>
            <h3><span><?php if(isset($settings[$i.'title']) && $settings[$i.'title'] != ""){ echo $settings[$i.'title']; }else{ ?>Example Title Here<?php } ?></span>
               <em class="badge badge-success p-1"><?php if(isset($settings[$i.'num']) && $settings[$i.'num'] != ""){ echo $settings[$i.'num']; }else{ echo '<i class="fa fa-angle-left" aria-hidden="true"></i>'; } ?></em> 
            </h3>
             <?php if(isset($settings[$i.'link']) && $settings[$i.'link'] != ""){ ?>
        </a>
        <?php } ?> 
            <p><?php if(isset($settings[$i.'desc']) && $settings[$i.'desc'] != ""){ echo $settings[$i.'desc']; }else{ ?>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.<?php } ?></p>
        
         </div>
         <?php $i++; } ?>
         
         
      </div>
   </div>
</div>