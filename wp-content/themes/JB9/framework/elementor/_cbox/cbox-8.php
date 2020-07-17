<?php global $settings; ?>

<style>
.herobox {
  text-align: center;
  padding: 50px 30px;
  border-radius: 3px;
  margin-bottom: 30px; 
  background: rgba(255, 255, 255, 0.7); }
.herobox i {  font-size: 80px;  } 
</style>

<div class="herobox eh">
<i class="fa <?php if(isset($settings['icon']) && $settings['icon'] != ""){ echo $settings['icon']; }else{ ?>fa-cog<?php } ?> text-primary mb-3"></i>           
<h4><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></h4>
<p><?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu.<?php } ?></p>
</div>