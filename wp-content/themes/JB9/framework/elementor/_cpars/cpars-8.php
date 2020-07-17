<?php global $CORE, $userdata, $wpdb, $settings; 

if(isset($settings['sampledata'])){
	$sampledata = $settings['sampledata'];
}else{ 
	
	$sampledata = array(
					  1 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat1.jpg", "icon" => ""), 
					  2 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat2.jpg", "icon" => ""), 
					  3 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat3.jpg", "icon" => ""), 
					  4 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat4.jpg", "icon" => ""), 
					  5 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat5.jpg", "icon" => ""), 
					  6 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat6.jpg", "icon" => ""), 
					  7 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat7.jpg", "icon" => ""), 
					  8 => array("name" => "", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat8.jpg", "icon" => ""),   
	);

}

?>
<div class="cpars8 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
    <div class="row">
      <div  class="col-12 col-sm-6 col-md-8 cat-item">
         <div style="background-image: url('<?php echo $sampledata[1]['image']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[1]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[1]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 cat-item">
         <div style="background-image: url('<?php echo $sampledata[2]['image']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[2]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[2]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 cat-item">
         <div style="background-image: url('<?php echo $sampledata[3]['image']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[3]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[3]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 cat-item">
         <div style="background-image: url('<?php echo $sampledata[4]['image']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[4]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[4]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-md-4 cat-item">
         <div style="background-image: url('<?php echo $sampledata[5]['image']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[5]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[5]['name']; ?></a>
         </div>
      </div>
   </div>
</div>