<?php

global $settings;
 
?> 
 
 
<div class="cat-item-wrapper category-1 catstyle-<?php echo $settings['style']; ?>">
<div class="row">
<?php
		$i = 1; $n = 1; $cat=1; $offset = 0; $sampledata = array();
		
		if(isset($settings['offset'])){ $offset = $settings['offset']; }
		if(isset($settings['sampledata'])){ $sampledata = $settings['sampledata']; }
		
		$args = array(
			'taxonomy'     => THEME_TAXONOMY,
			'orderby' 		=> $settings['orderby'], 
			'order' 		=> $settings['order'], 
			'show_count'   => 0,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'title_li'     => '',
			'hide_empty'   => 0,
			 
		);
$categories = get_categories($args);

$imgDefaults = array(
                  1 => "https://www.premiumpress.com/_demoimages/microjob/c1.jpg",
                  2 => "https://www.premiumpress.com/_demoimages/microjob/c2.jpg",
                  3 => "https://www.premiumpress.com/_demoimages/microjob/c3.jpg",
                  4 => "https://www.premiumpress.com/_demoimages/microjob/c4.jpg",
                  5 => "https://www.premiumpress.com/_demoimages/microjob/c1.jpg",
                  6 => "https://www.premiumpress.com/_demoimages/microjob/c2.jpg",
                  7 => "https://www.premiumpress.com/_demoimages/microjob/c3.jpg",
                  8 => "https://www.premiumpress.com/_demoimages/microjob/c4.jpg",
                  9 => "https://www.premiumpress.com/_demoimages/microjob/c1.jpg",
                  10 => "https://www.premiumpress.com/_demoimages/microjob/c2.jpg",
                  11 => "https://www.premiumpress.com/_demoimages/microjob/c3.jpg",
                  12 => "https://www.premiumpress.com/_demoimages/microjob/c4.jpg",
);
	$shown=1;			  
foreach ($categories as $category) { 

		// HIDE PARENT
		if($category->parent != 0 ){ $i++; continue; }
	
		if($shown > $settings['show'] ){ $i++;continue; }
		 
		// CHECK FOR OFFSET
		if($i < $offset){ $i++; continue; }	 
		
		$shown++;
		 
		
		// ICON		
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) ){
		$caticon = $sampledata[$i]['icon'];
		}elseif(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id] != ""   ){
		$caticon = "fa ".str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]);
		}else{
		$caticon = "fa fa-check";
		}
		
		// IMAGE
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) ){
		$catimage = $sampledata[$i]['image'];
		}elseif(isset($category->term_id) && isset($GLOBALS['CORE_THEME']['category_icon_'.$category->term_id]) && $GLOBALS['CORE_THEME']['category_icon_'.$category->term_id] != ""   ){
        $catimage = str_replace("&", "&amp;",$GLOBALS['CORE_THEME']['category_icon_'.$category->term_id]);
        }elseif(isset($imgDefaults[$i])){
        $catimage = $imgDefaults[$i];
        }
		
		// LINK 
		$link = get_term_link($category);
		
		// NAME
		if(defined('WLT_DEMOMODE') && isset($sampledata[$i]) ){
		$name = $sampledata[$i]['name'];
		}else{
		$name = $category->name;
		}
		
		
?> 

<?php if($settings['style'] == 1){ ?>
<div class="col-xl-3 col-md-4 col-12">
    <div class="cat-item">
    
        <a href="<?php echo $link; ?>">
            <div class="icon bg-primary">
                <i class="text-white fa <?php echo $caticon; ?>"></i>
            </div>
            
            <div class="content">
                <h6 class="text-dark text-uppercase"><?php echo $name; ?></h6>
                <span><?php echo $category->count; ?> <?php echo __("listings","premiumpress"); ?></span>
            </div>
        </a>    
    </div>								
</div>

<?php }elseif($settings['style'] == 2){ ?>

 <div class="col-xl-3 col-md-4 col-12">
                  <div class="cat-item1 bg-white">
                     <a href="<?php echo $link; ?>">
                        <div class="icon bg-primary">
                           <img src="<?php echo  $catimage; ?>" class="img-fluid" />
                        </div>
                        <div class="content bg-white text-center">
                           <h6 class="text-dark text-uppercase"><?php echo $name; ?></h6>
                           <span><?php echo $category->count; ?> <?php echo __("listings","premiumpress"); ?></span>
                        </div>
                     </a>
                  </div>
	</div>


<?php }elseif($settings['style'] == 3){ ?>

<div class="col-xl-3 col-md-4 col-12">
                  <div class="cat-item2 bg-white">
                     <a href="<?php echo $link; ?>">
                        <div class="content">
                           <h6 class="text-dark text-uppercase"><span class="float-left"><?php echo $category->name; ?></span> <span class="float-right countb bg-primary text-light px-2"><?php echo $category->count; ?></span> </h6>
                        </div>
                     </a>
                  </div>
               </div>
               
<?php }elseif($settings['style'] == 4){ ?>

<div class="col-md-3 col-6 mb-3">
                  <div class="cat-item4 p-3 p-lg-5">
                     <a href="<?php echo $link; ?>">
                        <div class="content text-center">
                        <div class="icon"> <i class="fa <?php echo $caticon; ?>"></i> </div>                        
                        <h6 class="text-uppercase text-center mt-3"><?php echo $name; ?></h6>
                        </div>
                     </a>
                  </div>
               </div>
                
<?php } ?>


<?php $i++; } ?>
</div>
</div>
