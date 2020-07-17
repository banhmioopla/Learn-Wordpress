<?php
   /* 
   * Theme: PREMIUMPRESS CORE FRAMEWORK FILE
   * Url: www.premiumpress.com
   * Author: Mark Fail
   *
   * THIS FILE WILL BE UPDATED WITH EVERY UPDATE
   * IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
   *
   * http://codex.wordpress.org/Child_Themes
   */
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
    
   global $CORE, $post, $userdata, $settings;
   
   
   $categories = wp_list_categories( 
   	array(
   	'taxonomy'  	=> 'listing',
   	'depth'         => 1,	
   	'hierarchical'  => 1,		
   	'hide_empty'    => 0,
   	'echo'			=> false,
   	'title_li' 		=> '',
   	'orderby' 		=> 'term_order',
   	'walker'		=> new walker_shortcode_dcats,
   	'limit' 		=> 16,
   	'show_count'	=> 0,
   	) 
   ); 
   
   ?>
<div class="hero27 bg-dark <?php if(isset($settings['class'])){ echo $settings['class']; } ?>" style="background:url('<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero27.jpg<?php } ?>'); background-size: cover; position:relative;">
   <div class="search-inner">
      <div class="py-5 text-center text-white">
         
           <h1 class="mt-lg-4"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>awesome title here<?php } ?></h1>
           
           
            <?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ ?>  
              <p class="mt-4 lead">
			  <?php echo $settings['img1_txt3']; ?>               
               </p>
           <?php } ?>
           
           <?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ ?>  
              <p class="mt-4 lead">
			  <?php echo $settings['img1_txt2']; ?>               
               </p>
           <?php } ?>
               
         
       
       
         <form action="<?php echo home_url(); ?>/" method="get" name="searchform" class="clearfix mt-5">
            <div class="input-group">
               <input type="text" name="s" placeholder="<?php echo __("I'm looking for...","premiumpress") ?>" class="form-control rounded-0">   
               <div class="input-group-prepend" style="position:relative;">
                  <select class="form-control rounded-0"  name="catid" style="margin-left:-1px;">
                     <option><?php echo __("All Categories","premiumpress") ?></option>
                     <?php echo $CORE->CategoryList(array(0,false,0,'listing')); ?>
                  </select>
               </div>
               <div class="input-group-prepend" style="position:relative;">
                  <button type="submit" class="px-4 btn-primary btn"><i class="fa fa-search"></i> </button>
               </div>
            </div>
         </form>
      </div>
   </div>
   <div class="cats-inner">
      <div class="container">
         <div class="row categories">
            <ul class="list-unstyled m-0 p-0">
               <?php echo str_replace("text-primary","",$categories); ?>
            </ul>
         </div>
      </div>
   </div>
</div>