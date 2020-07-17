<?php
   /* 
   * Theme: PREMIUMPRESS CORE FRAMEWORK FILE
   * Url: www.premiumpress.com
   * Author: Mark Fail1
   *
   * THIS FILE WILL BE UPDATED WITH EVERY UPDATE
   * IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
   *
   * http://codex.wordpress.org/Child_Themes
   */
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   global $CORE, $settings, $userdata; 
 
   
   $show_amount1 = 4;
   $show_amount2 = 12;
   
   if(in_array(THEME_KEY, array('jb'))){ 
   $show_amount1 = 4;
   $show_amount2 = 8;
   }elseif(in_array(THEME_KEY, array('at','ct','cm','sp'))){ 
   $show_amount1 = 5;
   $show_amount2 = 15;
   }
   
   // + GLOBAL HEADER
   get_header($CORE->pageswitch()); 
   
    ?>
<?php if(in_array(THEME_KEY , array('dt'))){ ?>
<section class="border-bottom">
      <?php  
	  
        $settings = array(
         
         // IMAGES
         "img1" 			=> $CORE->homeCotent('hero', 'img1'),
         	 
         // TEXT
         "img1_txt1" 		=> $CORE->homeCotent('hero', 'txt1'),	
         "img1_txt2" 		=> $CORE->homeCotent('hero', 'txt2'),
         "img1_txt3" 		=> $CORE->homeCotent('hero', 'txt3'),
           
		 // BTN
         "img1_btntxt" 		=> $CORE->homeCotent('hero', 'img1_btntxt'),	
         "img1_btnlink" 	=> $CORE->homeCotent('hero', 'img1_btnlink'), 
		  
		 "class" => "text-dark bg-light"
		 
         );
               
         // CODE
         get_template_part('framework/elementor/_hero/hero-27');
          
         ?>
</section> 
<?php }elseif(in_array(THEME_KEY , array('vt'))){ ?>
<section class="py-5 border-bottom bg-light hide-mobile hide-ipad">
   <div class="container px-lg-4">
      <div class="row">
         <?php $i=1; while($i < 5){ ?> 
         <div class="col-md-3 p-0"> 
            <?php  
               $settings = array(
               // IMAGES
               "css" 		=> "bg-white", 
               // IMAGES
               "img1" 		=> $CORE->homeCotent('img'.$i, 'img'),         	 
               // TEXT
               "txt1" 		=> $CORE->homeCotent('img'.$i, 'txt1'),	
               "txt2" 		=> $CORE->homeCotent('img'.$i, 'txt2'),
               // BTN
               "btn_txt" 		=> $CORE->homeCotent('img'.$i, 'btntxt'),         
               "btn_link" 	=> $CORE->homeCotent('img'.$i, 'btnlink'),                   
               );
                     
               // CODE
               get_template_part('framework/elementor/_cbox/cbox-5');
                
               ?>
         </div>
         <?php $i++; } ?> 
      </div>
   </div>
</section>
<?php }else{ ?>
<section class="border-bottom">
      <?php  
	  
        $settings = array(
         
         // IMAGES
         "img1" 			=> $CORE->homeCotent('hero', 'img1'),
         	 
         // TEXT
         "img1_txt1" 		=> $CORE->homeCotent('hero', 'txt1'),	
         "img1_txt2" 		=> $CORE->homeCotent('hero', 'txt2'),
         "img1_txt3" 		=> $CORE->homeCotent('hero', 'txt3'),
           
		 // BTN
         "img1_btntxt" 		=> $CORE->homeCotent('hero', 'img1_btntxt'),	
         "img1_btnlink" 	=> $CORE->homeCotent('hero', 'img1_btnlink'), 
		  
		 "class" => "text-dark bg-light"
		 
         );
               
         // CODE
         get_template_part('framework/elementor/_hero/hero-34');
          
         ?>
</section> 
<?php } ?>

<?php if($CORE->homeCotent('ctitle1', 'yesno1') != 0){ ?>
<section class="py-5 bg-white border-bottom">
   <div class="container">
      <div class="col-md-12 mb-3">
       <a href="<?php echo home_url(); ?>/?s=&se=2" class="btn btn-primary btn-lg px-5 rounded-0 float-right"><?php echo __("View More","premiumpress") ?></a>
         <?php
            $settings = array(  "txt1" 		=> $CORE->homeCotent('ctitle1', 'txt1') );            
            get_template_part('framework/elementor/_ctitle/ctitle-4');               
            ?>
      </div>
      <div class="col-12">
          	
            <?php if(THEME_KEY == "da"){ ?>
            <?php echo str_replace("","",do_shortcode('[LISTINGS dataonly=1 show=8 custom="gender" customvalue=2 nav=0 small=1 ]')); ?> 
            <?php }else{ ?>
            <?php echo str_replace("","",do_shortcode('[LISTINGS dataonly=1 show='.$show_amount1.' custom="featured" nav=0 small=1 ]')); ?> 
         	<?php } ?>
            
      </div>     
   </div>
</section>
<?php } ?> 

<?php if($CORE->homeCotent('box1', 'yesno1') != 0){ ?>
<section class="py-5 bg-light border-bottom">
   <div class="container">
      <?php 
        $settings = array(
         
         // IMAGES
         "img1" 			=> $CORE->homeCotent('box1', 'img1'),
         	 
         // TEXT
         "txt1" 		=> $CORE->homeCotent('box1', 'txt1'),	
         "txt2" 		=> $CORE->homeCotent('box1', 'txt2'),
            
		 // BTN
         "btn_txt" 		=> $CORE->homeCotent('box1', 'btn_txt'),	
         "btn_link" 	=> $CORE->homeCotent('box1', 'btn_link'), 
		  
		 "class" => "text-dark"
		 
         );
         get_template_part('framework/elementor/_cpars/cpars-3'); 
         ?>
   </div>
</section>
<?php } ?>

<?php if($CORE->homeCotent('ctitle2', 'yesno1') != 0){ ?>
<section class="py-5 bg-white border-bottom">
   <div class="container">
      <div class="col-md-12 mb-3">
       <a href="<?php echo home_url(); ?>/?s=&se=1" class="btn btn-primary btn-lg px-5 rounded-0 float-right"><?php echo __("View More","premiumpress") ?></a>
         <?php
            $settings = array(  "txt1" 		=> $CORE->homeCotent('ctitle2', 'txt1') );            
            get_template_part('framework/elementor/_ctitle/ctitle-4');               
            ?>
      </div>
      <div class="col-12">
          	
            <?php if(THEME_KEY == "da"){ ?>
            <?php echo str_replace("","",do_shortcode('[LISTINGS dataonly=1 show=8 custom="gender" customvalue=1 nav=0 small=1 ]')); ?> 
            <?php }else{ ?>
            <?php echo str_replace("","",do_shortcode('[LISTINGS dataonly=1 show='.$show_amount2.' custom="new" nav=0 small=1 ]')); ?> 
          	<?php } ?>
      </div>     
   </div>
</section>
<?php } ?>

<?php if(!in_array(THEME_KEY , array('da','rt'))){ ?>

<?php if($CORE->homeCotent('ctitle3', 'yesno1') != 0){ ?>
<section class="py-5 bg-white border-bottom">
   <div class="container">
      <div class="col-md-12 mb-3">
       <a href="<?php echo home_url(); ?>/?s=&se=1" class="btn btn-primary btn-lg px-5 rounded-0 float-right"><?php echo __("View More","premiumpress") ?></a>
         <?php
            $settings = array(  "txt1" 		=> $CORE->homeCotent('ctitle3', 'txt1') );            
            get_template_part('framework/elementor/_ctitle/ctitle-4');               
            ?>
      </div>
   <?php
      $settings = array();      
      get_template_part('framework/elementor/_ccats/ccat-4');
      ?> 
   </div>
</section>
<?php } ?>
<?php } ?>


<?php 
    
   // + GLOBAL FOOTER
   get_footer($CORE->pageswitch()); ?>