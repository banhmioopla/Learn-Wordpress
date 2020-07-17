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

global $CORE, $post, $show_price; 

if(!_ppt_checkfile("content-listing.php")){

	// GET THE PRICE DUE
	$payment_due = get_post_meta($post->ID,'total_price_due',true);

   // GET THE RATING DATA
   $ratingT = get_post_meta($post->ID, 'starrating_total', true);
   if($ratingT == ""){ $ratingT =0; }
   $ratingV = get_post_meta($post->ID, 'starrating_votes', true);
   if($ratingV == ""){ $ratingV = 0; }			
   $rating = get_post_meta($post->ID, 'starrating', true); 
   if($rating == ""){ $rating = "0"; }else{ $rating = number_format($rating,1); }
   
   $show_price = false;
   if(in_array(THEME_KEY, array('at','ct','rt','mj','cm','sp'))){ 
   $show_price = true;
   }
   
   

if(!function_exists('item_footer_parts')){

function item_footer_parts(){  global $post, $CORE, $show_price;
?>

    <?php if($show_price){ ?>
    
    <div class="show-small pricetag font-weight-bold">
    
    
    <?php if(THEME_KEY == "mj"){ ?>
    
    <div class="show-small rating-small float-right mr-2 hide-mobile"> 
	<?php echo do_shortcode('[RATING id="'.$post->ID.'"]'); ?>
	</div>
	
    <?php }  ?>
    
    <?php if(in_array(THEME_KEY, array('sp'))){ echo do_shortcode('[PRODUCT-PRICE]'); }else{ echo do_shortcode('[PRICE]');  }?>
    </div>
    
    <?php }elseif(in_array(THEME_KEY, array('jb'))){ ?> 
    <div class="show-small">
    <?php echo do_shortcode('[SALARY]'); ?> 
    </div>
    
    <?php }elseif(in_array(THEME_KEY, array('dt'))){ ?>  
    <div class="show-small rating-small"> 
	<?php echo do_shortcode('[RATING]'); ?> 

    <span class="float-right hide-mobile">
    <?php if(strlen(do_shortcode('[DISTANCE]')) < 2){ ?>
    <?php echo do_shortcode('[FAVS icon=1 text_before="" text_remove="" text=""]'); ?>
    <?php }else{ ?>
    <?php echo do_shortcode('[DISTANCE]'); ?>
    <?php } ?>
    </span>
    </div> 
    
    <?php }elseif(in_array(THEME_KEY, array('da'))){ ?>  
    <div class="show-small"> 
	<?php echo do_shortcode('[ZODIACSIGN symbol=1]'); ?>  <?php echo do_shortcode('[ZODIACSIGN]'); ?> <span class="float-right hide-mobile"><?php echo do_shortcode('[CITY link=1]'); ?></span>
    </div> 
    
	<?php }elseif(in_array(THEME_KEY, array('vt'))){ ?>
    <div class="show-small rating-small">
    <?php echo do_shortcode('[CATEGORYICON]'); ?> <?php echo do_shortcode('[CATEGORY]'); ?> <span class="float-right rating-small hide-mobile"><?php echo do_shortcode('[RATING]'); ?></span>
    </div>
    
    <?php }elseif(!in_array(THEME_KEY, array('jb'))){ ?> 
    <div class="show-small rating-small">
    <?php echo do_shortcode('[RATING]'); ?>
    </div>
    <?php } ?> 

<?php 
} }
   
if(!function_exists('item_footer_links')){

function item_footer_links(){  global $post, $CORE, $show_price;
 

?>

    <!-- link list -->
    <ul class="list-links list-inline mb-0 hide-small">
    
	<?php if(in_array(THEME_KEY, array('da'))){ ?>
       
    <li class="list-inline-item"><?php echo do_shortcode('[GENDER]'); ?></li>   
    <li class="list-inline-item"><?php echo do_shortcode('[AGE]'); ?> </li> 
    <li class="list-inline-item"><?php echo do_shortcode('[ZODIACSIGN symbol=1]'); ?>  <?php echo do_shortcode('[ZODIACSIGN]'); ?></li>    
     
	<?php }elseif(in_array(THEME_KEY, array('dt'))){ ?>
    
     <?php  $website = get_post_meta($post->ID,'website',true); if(strlen($website) > 1){ 	  
	  $web = str_replace("https://","",str_replace("http://","",$website));
	  if(substr($web,0,4) != "http"){ $web = "http://".$web; }
	  ?>	   
    <li class="list-inline-item">
      <a href="<?php echo $web; ?>" rel="nofollow" target="_blank"><?php echo __( 'Website', 'premiumpress' ); ?></a>
    </li> 
    <?php } ?>
      
    <li class="list-inline-item">
      <a href="https://www.google.com/maps/dir/<?php echo str_replace(",","",str_replace(" ","+",get_post_meta($post->ID,'map-location',true))); ?>" target="_blank">
	  <?php echo __( 'Directions', 'premiumpress' ); ?></a> 
    </li> 
      
    <li class="list-inline-item"><?php echo do_shortcode('[CATEGORY]'); ?></li>    
    <li class="list-inline-item"><?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?></li>
    
	<?php }elseif(in_array(THEME_KEY, array('mj'))){ ?>
    
    <li class="list-inline-item"> <?php echo do_shortcode('[CATEGORY]'); ?></li>    
    <li class="list-inline-item"><?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?></li>
    <li class="list-inline-item"><?php echo do_shortcode('[SALES]'); ?> <?php echo __("sold","premiumpress") ?></li> 
 
	<?php }elseif(in_array(THEME_KEY, array('sp'))){ ?>
    
    <li class="list-inline-item"> <?php echo do_shortcode('[CATEGORY]'); ?></li>    
   
 
	<?php }elseif(in_array(THEME_KEY, array('jb'))){ ?>
    
   	<li class="list-inline-item"><?php echo do_shortcode('[SALARY]'); ?> </li>
    <li class="list-inline-item"><?php echo do_shortcode('[TYPE]'); ?></li>
    <li class="list-inline-item"><?php echo do_shortcode('[CITY link=1]'); ?></li>
 
 
    <?php }elseif(in_array(THEME_KEY, array('at'))){ ?>
    
    <li class="list-inline-item"><?php echo do_shortcode('[TIMER layout="" finished_class=""]'); ?></li>
    <li class="list-inline-item"><?php echo do_shortcode('[BIDS]'); ?> <?php echo __("bids","premiumpress") ?></li>    
   
    <?php }else{ ?>
    
    <li class="list-inline-item"> <?php echo do_shortcode('[CATEGORY]'); ?></li>    
    <li class="list-inline-item"><?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?></li>
     
    <?php } //end elseif ?>
    
    
	<?php if($show_price){ ?>    
    <li class="list-inline-item font-weight-bold h5"> <?php if(in_array(THEME_KEY, array('sp'))){ echo do_shortcode('[PRODUCT-PRICE]'); }else{ echo do_shortcode('[PRICE]');  }?></li>
    <?php } ?> 
  
    <?php if(_ppt('google') == 1 && in_array(THEME_KEY, array("dt","da","ct","at","rt","jb"))){ ?>
    <li class="list-inline-item"><?php echo do_shortcode('[DISTANCE]'); ?> </li>   
    <?php } ?>

    </ul>

<?php } }



?>
<div class="listing-list-item eqh <?php if(in_array(THEME_KEY, array('at','ct','cm','sp'))){ echo 'w-lg-20'; }else{ echo 'w-lg-30'; } ?> <?php if(_ppt('search_image_bottom') == 1){ echo "hide-bottom"; } ?> <?php if(_ppt('search_image_style') == 1){ echo "img-tall"; } ?>" 
data-marker-id="<?php echo $post->ID; ?>">
<div class="listing-wrap clearfix"> 




   <div class="image bg-white">
   <a href="<?php echo get_permalink($post->ID); ?>">
      <figure class="mb-0">
      
   	  <?php if($payment_due > 0){ ?>
      
	  <div class="featured-ribbon">
	  <?php echo __("awaiting payment","premiumpress"); ?>
      </div>
      
      <?php }elseif($post->post_status == "draft"){ ?> 
           
      <div class="featured-ribbon">
	  <?php echo __("Draft","premiumpress"); ?>
      </div>
      
      <?php }elseif($post->post_status == "pending"){ ?>  
           
      <div class="featured-ribbon">
	  <?php echo __("pending approval","premiumpress"); ?>
      </div>
      
      <?php }elseif(_ppt('search_ribbon') == 1 &&  ( get_post_meta($post->ID,'featured', true) == 1 || get_post_meta($post->ID,'featured', true) == "yes" )){ ?>
      
      <div class="featured-ribbon">
      <?php echo __("Featured","premiumpress"); ?>
      </div>
      
      <?php } ?>
 
      <?php echo do_shortcode('[IMAGE link=0]'); ?> 
   
             
      <?php if(in_array(THEME_KEY, array('da'))){ global $CORE_DATING; if($CORE_DATING->USERONLINE($post->post_author)){ ?>
      <div class="topbit">
      <?php echo $CORE->user_online($post->post_author, 1);  ?>
      </div>
      <?php } } ?>
      
      <?php if(in_array(THEME_KEY, array('vt'))){ ?>
      <i class="fa fa-play-circle"></i>
      <?php } ?>
      
      <?php if(_ppt('search_title') != 1){ ?>  
       <h5 class="bg-dark text-white font-weight-normal show-small"><?php echo do_shortcode('[TITLE]'); ?></h5> 
       <?php } ?>
       
      </figure>
           
   </a>
   </div> 








<?php

$style = _ppt('search_item_style');
switch($style){
default:

	case "1": {
?>




    
     <!-- 3 boxes --> 
    <div class="boxes b2 clearfix show-small <?php if(_ppt('search_image_bottom') != 1){ ?>bg-light<?php } ?>">
    

		<?php if(in_array(THEME_KEY, array('sp'))){ ?>

		 <div><?php echo do_shortcode('[CATEGORYICON]'); ?><span class="block"><?php echo do_shortcode('[CATEGORY limit=1]'); ?></span></div>
         <div> <i class="fa fa-eye"></i> <span class="block"><?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress"); ?></span> </div>

		<?php }elseif(in_array(THEME_KEY, array('rt'))){ ?>

         <div> <i class="fa fa-bed"></i> <span class="block"> <?php echo get_post_meta($post->ID,'bed', true); ?> <?php echo __("beds","premiumpress") ?></span>  </div>
         <div> <i class="fa fa-bath"></i> <span class="block"> <?php echo get_post_meta($post->ID,'bath', true); ?> <?php echo __("baths","premiumpress") ?> </span></div>
 
 		<?php }elseif(in_array(THEME_KEY, array('jb'))){ ?>

        <div><i class="fa fa-briefcase" aria-hidden="true"></i><span class="block"> <?php echo do_shortcode('[TYPE]'); ?></span> </div>
     	<div><i class="fa fa-map-marker"></i><span class="block"><u><?php echo do_shortcode('[CITY link=1]'); ?></u></span></div>
    
 		<?php }elseif(in_array(THEME_KEY, array('ct'))){ ?>

        <div><i class="fa fa-binoculars" aria-hidden="true"></i><span class="block"> <?php echo do_shortcode('[HITS]'); ?>  <?php echo __("views","premiumpress") ?> </span> </div>
     	<div><i class="fa fa-map-marker"></i><span class="block"><u><?php echo do_shortcode('[CITY link=1]'); ?></u></span></div>
    
 		<?php }elseif(in_array(THEME_KEY, array('at'))){ ?>

        <div><i class="fa fa-hand-paper-o" aria-hidden="true"></i><span class="block"> <?php echo do_shortcode('[BIDS]'); ?> <?php echo __("bids","premiumpress") ?></span> </div>
     	<div><i class="fa fa-clock-o"></i>  <span class="block">  <?php echo do_shortcode('[TIMER layout="" finished_class=""]'); ?>  </span> </div>  
        
		<?php }elseif(in_array(THEME_KEY, array('vt'))){ ?>

         <div> <i class="fa fa-clock-o"></i> <span class="block"> <?php echo do_shortcode('[DURATION]'); ?></span>  </div>
         <div> <i class="fa fa-eye"></i> <span class="block"><?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress"); ?></span> </div>

    	<?php }elseif(in_array(THEME_KEY, array('mj'))){ ?>
       
        <div> <i class="fa fa-binoculars"></i> <span class="block"> <?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?> </span></div>
        <div> <i class="fa fa-bullhorn"></i>  <span class="block"><?php echo do_shortcode('[SALES]'); ?> <?php echo __("sold","premiumpress") ?> </span></div>
    
		<?php }elseif(in_array(THEME_KEY, array('da'))){ ?>
        
         <div> <?php echo do_shortcode('[GENDER-ICON]'); ?> <span class="block">   <?php echo do_shortcode('[GENDER]'); ?></span></div>
         <div> <span class="text-uppercase small"><?php echo __("age","premiumpress"); ?></span> <span class="block font-weight-bold"> <?php echo do_shortcode('[AGE]'); ?> </span>  </div>
        
        <?php }else{ ?>
       
         <div><i class="fa fa-binoculars"></i> <span class="block"> <?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?> </span></div>          
        <div><i class="fa fa-map-marker"></i> <span class="block"><u><?php echo do_shortcode('[CITY link=1]'); ?></u></span></div>
         
       
	   <?php } ?>  
         
    </div> 
   
   <div class="content cs">
   
    <!-- title -->
    <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark hide-small">
	<h4><?php echo do_shortcode('[TITLE]'); ?></h4>
    </a> 
    
    <!-- excerpt -->
    <p class="desc hide-small">
    <?php echo do_shortcode('[EXCERPT]'); ?>
    </p>
    
    <?php if(in_array(THEME_KEY, array('at','ct','rt','mj'))){ ?>    
    <div class="authoricon float-right show-small">
    <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" class="userphoto rounded-5">
            <?php echo get_avatar( $post->post_author, 200 ); ?>
    </a>
    </div>
    <?php } ?>
    
    <!-- item parts -->
    <?php item_footer_parts(); ?>
    
    <!-- link list -->
    <?php item_footer_links(); ?>    
        
    <!-- favs icon -->
    <span class="fav-like hide-small"><?php echo do_shortcode('[FAVS icon=1 text_before="" text_remove="" text=""]'); ?></span>  
       
   </div>
   
   <div class="absolute-right-top">
      <div class="relatrive">
      
 		<?php if(!in_array(THEME_KEY, array('da'))){ ?>   
         <div class="ratingbox text-center <?php if($rating == 0){ ?>norating<?php } ?>">
            <input type="hidden" class="rating"  data-filled="fa fa-star rating-rated" data-empty="far fa-star" disabled value="<?php echo $rating; ?>"/>
            <?php if($rating == 0){ ?>
            <div class="mt-2"><?php echo __( 'Not yet reviewed!', 'premiumpress' ); ?></div>
            <?php }else{ ?>
            <div class="clearfix my-2"> 
               <span class="ratingnum"><?php echo $rating; ?></span> 
               <span class="ratingtxt"><em><?php echo  sprintf( _n( '%s review', '%s reviews', $ratingV, 'premiumpress' ), $ratingV ); ?></em></span>
            </div>
            <?php } ?>
         </div>
         <?php } ?>
      

      </div>
   </div>
   
   <div class="absolute-right-bottom hide-ipad hide-mobile">
   
  
      <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary btn-sm text-uppercase btn-block rounded-0"><?php echo __("read more","premiumpress") ?></a>
    
   </div>
   


<?php } break;

case "2": { ?>


    
     <!-- 3 boxes --> 
    <div class="boxes b3 clearfix show-small <?php if(_ppt('search_image_bottom') != 1){ ?>bg-light<?php } ?>">
    
		<?php if(in_array(THEME_KEY, array('sp'))){ ?>
        
        <div> <i class="fa fa-hashtag"></i> <span class="block"><?php echo do_shortcode('[ID]'); ?> </span> </div>
        <div> <i class="fa fa-eye"></i> <span class="block"><?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress"); ?></span> </div>
 		<div><?php echo do_shortcode('[CATEGORYICON]'); ?><span class="block"><?php echo do_shortcode('[CATEGORY limit=1]'); ?></span></div>
 
		<?php }Elseif(in_array(THEME_KEY, array('rt'))){ ?>

         <div> <i class="fa fa-bed"></i> <span class="block"> <?php echo get_post_meta($post->ID,'bed', true); ?> <?php echo __("beds","premiumpress") ?></span>  </div>
         <div> <i class="fa fa-bath"></i> <span class="block"> <?php echo get_post_meta($post->ID,'bath', true); ?> <?php echo __("baths","premiumpress") ?> </span></div>
         <div> <i class="fa fa-window-maximize"></i>  <span class="block"><?php echo get_post_meta($post->ID,'size', true); ?> <?php echo __("sqft","premiumpress") ?> </span></div>
    
 		<?php }elseif(in_array(THEME_KEY, array('jb'))){ ?>

        <div><i class="fa fa-briefcase" aria-hidden="true"></i><span class="block"> <?php echo do_shortcode('[TYPE]'); ?></span> </div>
     	<div><i class="fa fa-map-marker"></i><span class="block"><u><?php echo do_shortcode('[CITY link=1]'); ?></u></span></div>
		<div><i class="fa fa-binoculars" aria-hidden="true"></i><span class="block"> <?php echo do_shortcode('[HITS]'); ?>  <?php echo __("views","premiumpress") ?> </span> </div>

 		<?php }elseif(in_array(THEME_KEY, array('ct'))){ ?>
        
		<div><?php echo do_shortcode('[CATEGORYICON]'); ?><span class="block"><?php echo do_shortcode('[CATEGORY limit=1]'); ?></span></div>
        <div><i class="fa fa-binoculars" aria-hidden="true"></i><span class="block"> <?php echo do_shortcode('[HITS]'); ?> </span> </div>
     	<div><i class="fa fa-map-marker"></i><span class="block"><u><?php echo do_shortcode('[CITY link=1]'); ?></u></span></div>
    
		<?php }elseif(in_array(THEME_KEY, array('at'))){ ?>

        <div><i class="fa fa-hand-paper-o" aria-hidden="true"></i><span class="block"> <?php echo do_shortcode('[BIDS]'); ?> <?php echo __("bids","premiumpress") ?></span> </div>
        <div><i class="fa fa-binoculars" aria-hidden="true"></i><span class="block"> <?php echo do_shortcode('[HITS]'); ?>  <?php echo __("views","premiumpress") ?> </span> </div>
     	<div><i class="fa fa-clock-o"></i>  <span class="block">  <?php echo do_shortcode('[TIMER layout="" finished_class=""]'); ?>  </span> </div>  
 
    
 		<?php }elseif(in_array(THEME_KEY, array('vt'))){ ?>

         <div> <i class="fa fa-clock-o"></i> <span class="block"> <?php echo do_shortcode('[DURATION]'); ?></span>  </div>
         <div> <i class="fa fa-eye"></i> <span class="block"><?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress"); ?></span> </div>
         <div> <i class="fa fa-thumbs-up"></i>  <span class="block"> <?php echo do_shortcode('[SUCCESSRATE]'); ?>% </span></div>
    
 		<?php }elseif(in_array(THEME_KEY, array('mj'))){ ?>
       
         <div> <i class="fa fa-binoculars"></i> <span class="block"> <?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?> </span></div>
         <div> <i class="fa fa-clock-o"></i> <span class="block"> <?php echo do_shortcode('[DAYS]'); ?> <?php echo __("days","premiumpress") ?></span>  </div>
         <div> <i class="fa fa-bullhorn"></i>  <span class="block"><?php echo do_shortcode('[SALES]'); ?> <?php echo __("sold","premiumpress") ?> </span></div>
             
		<?php }elseif(in_array(THEME_KEY, array('da'))){ ?>
        
         <div> <?php echo do_shortcode('[GENDER-ICON]'); ?> <span class="block">   <?php echo do_shortcode('[GENDER]'); ?></span></div>
         <div> <span class="text-uppercase small"><?php echo __("age","premiumpress"); ?></span> <span class="block font-weight-bold"> <?php echo do_shortcode('[AGE]'); ?> </span>  </div>
         <div> <?php echo do_shortcode('[ZODIACSIGN symbol=1]'); ?>  <span class="block"> <?php echo do_shortcode('[ZODIACSIGN]'); ?> </span></div>
        
        <?php }else{ ?>
	
         <div> <i class="fa fa-binoculars"></i><span class="block"> <?php echo do_shortcode('[HITS]'); ?> <?php echo __("views","premiumpress") ?> </span></div>
         <div><?php echo do_shortcode('[CATEGORYICON]'); ?><span class="block"><?php echo do_shortcode('[CATEGORY limit=1]'); ?></span></div>     
         <div><i class="fa fa-map-marker"></i> <span class="block"><u><?php echo do_shortcode('[CITY link=1]'); ?></u></span></div>
         
         <?php } ?>
         
        
    </div>  
 
   
   <div class="content cs">
   
    <!-- title -->
    <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark hide-small">
	<h4><?php echo do_shortcode('[TITLE]'); ?></h4>
    </a> 
    
    <!-- excerpt -->
    <p class="desc hide-small">
    <?php echo do_shortcode('[EXCERPT]'); ?>
    </p>
    
    <?php if(in_array(THEME_KEY, array('at','ct','mj'))){ ?>    
    <div class="authoricon float-right show-small">
    <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" class="userphoto rounded-5">
            <?php echo get_avatar( $post->post_author, 200 ); ?>
    </a>
    </div>
    <?php } ?>
    
    <!-- item parts -->
    <?php item_footer_parts(); ?>
    
    <!-- link list -->
    <?php item_footer_links(); ?>    
    
    <!-- favs icon -->
    <span class="fav-like hide-small"><?php echo do_shortcode('[FAVS icon=1 text_before="" text_remove="" text=""]'); ?></span>  
    
   </div>
   
   <div class="absolute-right-top">
      <div class="relatrive">
		<?php if(!in_array(THEME_KEY, array('da','jb'))){ ?> 
         <div class="ratingbox text-center <?php if($rating == 0){ ?>norating<?php } ?>">
            <input type="hidden" class="rating"  data-filled="fa fa-star rating-rated" data-empty="far fa-star" disabled value="<?php echo $rating; ?>"/>
            <?php if($rating == 0){ ?>
            <div class="mt-2"><?php echo __( 'Not yet reviewed!', 'premiumpress' ); ?></div>
            <?php }else{ ?>
            <div class="clearfix my-2"> 
               <span class="ratingnum"><?php echo $rating; ?></span> 
               <span class="ratingtxt"><em><?php echo  sprintf( _n( '%s review', '%s reviews', $ratingV, 'premiumpress' ), $ratingV ); ?></em></span>
            </div>
            <?php } ?>
         </div>    
		<?php } ?>
      </div>
   </div>
   
   <div class="absolute-right-bottom hide-ipad hide-mobile">
      <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary btn-sm text-uppercase btn-block rounded-0"><?php echo __("read more","premiumpress") ?></a>
   </div>
   
 


<?php } break;

case "3": { ?>

 
   
   <div class="content cs">
   
    <!-- title -->
    <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark">
	<h4><?php echo do_shortcode('[TITLE]'); ?></h4>
    </a> 
   
    <?php if(in_array(THEME_KEY, array('sp'))){ ?>
    <?php echo do_shortcode('[ADDCART class="btn btn-sm btn-outline-dark float-right"]<i class="fa fa-shopping-cart"></i>[/ADDCART]'); ?>
    <?php } ?>  
    
    <!-- excerpt -->
    <p class="mb-2 show-small">
    <u><?php echo do_shortcode('[CATEGORY]'); ?></u>
    </p>
    
    <!-- excerpt -->
    <p class="desc hide-small">
    <?php echo do_shortcode('[EXCERPT]'); ?>
    </p>    

    <!-- item parts -->
    <?php item_footer_parts(); ?>
    
    <!-- link list -->
    <?php item_footer_links(); ?>    
    
    <!-- favs icon -->
    <span class="fav-like hide-small"><?php echo do_shortcode('[FAVS icon=1 text_before="" text_remove="" text=""]'); ?></span>  
   
       
   </div>
   
   <div class="absolute-right-top">
      <div class="relatrive">
		
		<?php if(!in_array(THEME_KEY, array('jb','da'))){ ?> 
         <div class="ratingbox text-center <?php if($rating == 0){ ?>norating<?php } ?>">
            <input type="hidden" class="rating"  data-filled="fa fa-star rating-rated" data-empty="far fa-star" disabled value="<?php echo $rating; ?>"/>
            <?php if($rating == 0){ ?>
            <div class="mt-2"><?php echo __( 'Not yet reviewed!', 'premiumpress' ); ?></div>
            <?php }else{ ?>
            <div class="clearfix my-2"> 
               <span class="ratingnum"><?php echo $rating; ?></span> 
               <span class="ratingtxt"><em><?php echo  sprintf( _n( '%s review', '%s reviews', $ratingV, 'premiumpress' ), $ratingV ); ?></em></span>
            </div>
            <?php } ?>
         </div>
 		<?php } ?>

      </div>
   </div>
   
   <div class="absolute-right-bottom hide-ipad hide-mobile">
      <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary btn-sm text-uppercase btn-block rounded-0"><?php echo __("read more","premiumpress") ?></a>
   </div>
   
 

<?php } break;

// ALL STYLES FOR TESTING
case "4": { ?>
 
    
  
   <div class="content cs bg-light-small">
   
    <!-- title -->
    <a href="<?php echo get_permalink($post->ID); ?>" class="text-dark hide-small">
	<h4><?php echo do_shortcode('[TITLE]'); ?></h4>
    </a> 
    
    <!-- excerpt -->
    <p class="desc hide-small">
    <?php echo do_shortcode('[EXCERPT]'); ?>
    </p>
    
    <!-- item parts -->
    <?php item_footer_parts(); ?>
    
    <!-- link list -->
    <?php item_footer_links(); ?>    
    
    <!-- favs icon -->
    <span class="fav-like hide-small"><?php echo do_shortcode('[FAVS icon=1 text_before="" text_remove="" text=""]'); ?></span>  
       
   </div>
   
   <div class="absolute-right-top">
      <div class="relatrive">
		<?php if(!in_array(THEME_KEY, array('jb','da'))){ ?>
         <div class="ratingbox text-center <?php if($rating == 0){ ?>norating<?php } ?>">
            <input type="hidden" class="rating"  data-filled="fa fa-star rating-rated" data-empty="far fa-star" disabled value="<?php echo $rating; ?>"/>
            <?php if($rating == 0){ ?>
            <div class="mt-2"><?php echo __( 'Not yet reviewed!', 'premiumpress' ); ?></div>
            <?php }else{ ?>
            <div class="clearfix my-2"> 
               <span class="ratingnum"><?php echo $rating; ?></span> 
               <span class="ratingtxt"><em><?php echo  sprintf( _n( '%s review', '%s reviews', $ratingV, 'premiumpress' ), $ratingV ); ?></em></span>
            </div>
            <?php } ?>
         </div>
 		<?php } ?>

      </div>
   </div>
   
   <div class="absolute-right-bottom hide-ipad hide-mobile">
      <a href="<?php echo get_permalink($post->ID); ?>" class="btn btn-primary btn-sm text-uppercase btn-block rounded-0"><?php echo __("read more","premiumpress") ?></a>
   </div>
   
 

<?php }  break; }?>

</div>
</div><!-- end item #<?php echo $post->ID; ?> -->

<?php  } ?>

<?php
if(isset($GLOBALS['flag-searchpage']) && !in_array(THEME_KEY, array('cp','cm','sp','vt','ph','da')) && get_post_meta($post->ID,'map-log',true) != "" ){
    
   		$long 		= get_post_meta($post->ID,'map-log',true);
   		$lat 		= get_post_meta($post->ID,'map-lat',true);
   		$ib = 		$CORE->media_get($post->ID,"image");
		if(isset($ib[0]) && isset($ib[0]['thumbnail'])){				 	
   		$image = 	$ib[0]['thumbnail'];
		}else{
		$image = "";
   		}
		
   		$extra1 = "";
   		$extra2 = "";
   			
   		$extra1 = get_post_meta($post->ID,'map-city',true);
   		if(get_post_meta($post->ID,'map-area',true) != ""){
   			$extra1 .= ", ".get_post_meta($post->ID,'map-area',true);
   		}
   		 	
   		?>
<script>
   mapmarker = {
   
   	"id"	: "<?php echo $post->ID; ?>",	
   	"lat" 	: "<?php echo $lat; ?>",
   	"long" 	: "<?php echo $long; ?>", 
   	"url"  	: "<?php echo the_permalink($post->ID); ?>",
   	"title" : "<?php echo esc_html(str_replace("'","",substr(strip_tags($post->post_title),0,28))); ?>",
   	"desc" 	: "<?php echo esc_html(str_replace("'","",substr(strip_tags($post->post_content),0,110))); ?>",
   	"img" 	: "<?php echo $image; ?>",	
   	"extra1" : "<?php echo do_shortcode('[LOCATION]'); ?>",
   	"extra2" : "<?php echo do_shortcode('[CATEGORY link=0 limit=1]'); ?>",
   };	
   
   mapmarkerdata.push(mapmarker);	
</script>
<?php } ?>