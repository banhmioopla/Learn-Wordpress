<?php global $CORE, $userdata, $wpdb, $settings; 

if(isset($settings['sampledata']) && is_array($settings['sampledata']) ){
	$sampledata = $settings['sampledata'];
}else{ 
	
	$sampledata = array(
					  1 => array("name" => "Text Here", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat1.jpg", "link" => ""), 
					  2 => array("name" => "Text Here", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat2.jpg", "link" => ""), 
					  3 => array("name" => "Text Here", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat3.jpg", "link" => ""), 
					  4 => array("name" => "Text Here", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat4.jpg", "link" => ""), 
					  5 => array("name" => "Text Here", "img" => "https://premiumpress.com/_demoimages/elementor/_hero/cat5.jpg", "link" => ""), 
			  
	);

}

?>
<div class="ccat-7 cpars8 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
    <div class="row">
      <div  class="col-12 col-sm-6 col-lg-3 cat-item">
         <div style="background-image: url('<?php echo $sampledata[1]['img']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[1]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[1]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-6 cat-item">
         <div style="background-image: url('<?php echo $sampledata[2]['img']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[2]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[2]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 cat-item">
         <div style="background-image: url('<?php echo $sampledata[3]['img']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[3]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[3]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 cat-item">
         <div style="background-image: url('<?php echo $sampledata[4]['img']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[4]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[4]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 cat-item">
         <div style="background-image: url('<?php echo $sampledata[5]['img']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[5]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[5]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 cat-item">
         <div style="background-image: url('<?php echo $sampledata[6]['img']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[6]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[6]['name']; ?></a>
         </div>
      </div>
      <div class="col-12 col-sm-6 col-lg-3 cat-item">
         <div style="background-image: url('<?php echo $sampledata[7]['img']; ?>');" class="cat-image">
            <a href="<?php echo $sampledata[7]['link']; ?>" class="cover-wrapper"><?php echo $sampledata[7]['name']; ?></a>
         </div>
      </div>      
   </div>
</div>