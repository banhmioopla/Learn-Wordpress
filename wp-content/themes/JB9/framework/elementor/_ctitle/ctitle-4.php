<?php global $CORE, $userdata, $wpdb, $settings;
 
?><div class="ctitle4 <?php if(isset($settings['class']) && $settings['class'] != ""){ echo $settings['class']; }else{ echo "mb-5 text-left text-dark"; } ?>">
<h2><?php if($settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>SOME AWESOME CONTENT HERE<?php } ?></h2>
<hr style="width:50px; height:3px;" class="bg-primary float-left" />
</div>