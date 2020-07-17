<?php global $CORE, $userdata, $wpdb, $settings; 


if(isset($settings['show'])){ 	$show = $settings['show']; }else{ $show = 5; }
if(isset($settings['custom'])){ $custom = $settings['custom']; }else{ $custom  = "new"; }
if(isset($settings['small']) && $settings['small'] != 1){ $small  = ""; }else{  $small = "extrasmall=1"; }
if(isset($settings['padding'])){ $padding = $settings['padding']; }else{ $padding  = "50"; }
if(isset($settings['customvalue'])){ $customvalue = $settings['customvalue']; }else{ $customvalue  = ""; }
if(!isset($settings['eid'])){ $settings['eid'] = 1; }

if(!isset($settings['cats'])){ $cats = ""; }else{ $cats = $settings['cats']; }
?>
<div class="carousel1 <?php if(isset($settings['class'])){ echo $settings['class']; } ?> small-list">	
<div class="owl-carousel" id="<?php echo $settings['eid']; ?>" data-autoPlay="1" data-items="<?php echo $show; ?>" data-stagePadding="<?php echo $padding; ?>">
<?php echo str_replace("w-lg-20","", str_replace("w-lg-30","",do_shortcode('[LISTINGS dataonly=1 show=20 '.$small.' cat="'.$cats.'" custom="'.$custom .'" customvalue="'.$customvalue .'" carousel=1]'))); ?> 


</div>
</div> 
<script>
jQuery(document).ready(function() {
jQuery("#<?php echo $settings['eid']; ?>").owlCarousel({ items : <?php echo $show; ?>, autoPlay : true, loop:true, stagePadding:<?php echo $padding; ?>, margin:10, });
}); 
</script> 