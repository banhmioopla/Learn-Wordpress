<?php global $CORE, $userdata, $wpdb, $settings;
 
?><div class="ctitle2 <?php if($settings['class'] != ""){ echo $settings['class']; }else{ echo "text-center"; } ?>">
<h5><?php if($settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>SOME AWESOME CONTENT HERE<?php } ?></h5>
<h1><?php if($settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>Curabitur quis iaculis sem.<?php } ?></h1>
</div>