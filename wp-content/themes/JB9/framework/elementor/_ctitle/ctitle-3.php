<?php global $CORE, $userdata, $wpdb, $settings;
 
?><div class="ctitle3 <?php if($settings['class'] != ""){ echo $settings['class']; }else{ echo "text-center"; } ?>">
<h1 class="h4"><?php if($settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>SOME AWESOME CONTENT HERE<?php } ?></h1>
<p class="lead"><?php if($settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>Curabitur quis iaculis sem.<?php } ?></p>
</div>