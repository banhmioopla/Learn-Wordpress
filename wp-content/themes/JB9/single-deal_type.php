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

global $CORE, $CORE_DIRECTORY, $post, $userdata;

$GLOBALS['flag-deal'] = 1;
$GLOBALS['flag-nobreadcrumbs'] = 1;

if(!_ppt_checkfile("single-deal_type.php")){  

// STAR RATING
$starrating = get_post_meta($post->ID, 'starrating', true);
if(!is_numeric($starrating)){ $starrating = 0; }

$starreviews = get_post_meta($post->ID, 'starrating_votes', true);
if(!is_numeric($starreviews)){ $starreviews = 0; }

function _hook_extra_css($css){ global $CORE, $post;
 
 
ob_start();
?>

<style>
 /**
 * Hero Header
*/
.hero-header {
	position: relative;
	padding: 140px 0 140px;
	background-position: center center;
	background-repeat: no-repeat;
	background-size: cover;
	background-color: #34495e;
	z-index:0;
}


.hero-header::after {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.6);
	content: ""
}


.main-search-wrapper {
    width: 70%;
    margin: 0 auto;
    background: rgba(0, 123, 255, 0.82);
    padding: 55px 50px 45px;
    color: #FFF;
	z-index:1;
}

.main-search-wrapper h2 {
    color: #FFF;
    line-height: 1.2;
    margin: 0 0 10px;
}

.main-search-wrapper .lead {
    font-weight: 300;
    letter-spacing: 0.5px;
    font-size: 18px;
}


.box-count-down .box-count{  width: 70px;  height:60px;  border:1px solid #eaeaea;  float: left;     border-radius: 4px;  text-align: center;  padding: 2px;  position: relative;  color: #333;  margin-right: 13px;  background: #fff;}
.box-count-down .box-count:last-child{ margin-right:0px; }
.box-count-down .dot{  display: none;}
.box-count-down .box-count:before{  width: 100%;  height: 100%;  background: #fff;  float: left;  content: '';} 
.box-count-down .number{  position: absolute;  width: 100%;  left: 0;  top: 10px;  font-weight:bold;}
.box-count-down .text{  position: absolute;  width: 100%;  left: 0;  bottom: 8px;  font-size: 10px;}



.deal-old-price {
	 
		float: left;
		font-size: 20px;
		text-decoration: line-through;
}
.deal-new-price {
	 
		float: left;
		font-size: 30px;
		margin: 0 10px;
}
.deal-save-price {		 
    text-transform: uppercase;
    font-size: 35px;
    border: 1px solid red;
    background: red;
    padding: 10px; margin-right:15px; text-align:center;
}

.deal-save-price span {
			display: block;
			margin-right: 5px;
			font-size: 12px;
			color: $colorMain;	
		}
		
		
		

ul.review-list {
    margin-top: 30px;
 
}

ul.review-list > li {
position: relative;
    padding-bottom: 0;
        background: #f5f5f5;
    padding: 20px 50px 10px 10px;
    margin-bottom: 20px;
 
}
@media (max-width: 668px) {
ul.review-list > li { padding: 0px; border:0px; }
}
ul.review-list li .rating-from {
    line-height: 1.25;
    display: block;
    font-size: 13px;
    color: #A8A8A8;
    letter-spacing: 1px;
}

ul.review-list li img {
    width: 50px;
    height: 50px;
    position: absolute;
   
    border: 2px solid #EDEDED;
    padding: 2px;
    border-radius: 50%;
}

ul.review-list li .content {
    padding-left: 70px;
    float: left;
	width:100%;
}

ul.review-list li .content h6 {
    color: #333;
    line-height: 1.2;
    margin: 0 0 3px;
    font-weight: 600;
}

ul.review-list li .content .review-date {
    text-align: right;
    line-height: 1;
    margin: 0 0 10px;
    font-size: 11px;
    color: #999;
}
 
ul.review-list li .review-entry {
    margin: 20px 0px;
}

ul.review-list li .ratingboxes {     background: #efefef;    padding: 15px 20px 10px 30px; margin-top:20px; }


 

ul.review-list li .rating-total-score .rating-wrapper {
    margin-bottom: 0;
}

ul.review-list li .rating-total-score .rating-wrapper > span,
.rating-total-score .rating-wrapper > div {
    display: inline-block;
    vertical-align: middle;
}

ul.review-list li .rating-total-score .rating-wrapper > span {
    font-size: 16px;
    margin-right: 5px;
    font-weight: 600;
    color: #222;
}

 
ul.review-list li .review-label-top {
    display: block;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-size: 10.5px;
    font-weight: 700;
    line-height: 1.2;
}

ul.review-list li ul.list-with-icon li {
    font-size: 13px;
    line-height: 1.65;
}

ul.review-list li ul.list-with-icon li i {
    top: 5px;
}

ul.review-list li .rating-wrapper-wrapper {
    border-left: 1px dashed #D5D5D5;
    padding: 20px 15px 15px;
    background: #E6E8EB;
    margin-bottom: 30px;
}

ul.review-list li .review-entry .rating-item .ri {
    font-size: 11px;
}

ul.review-list li .review-entry .alt-rating-icon-sm .rating-item .ri {
    font-size: 10px;
}

@media only screen and (max-width: 1199px) {}

@media only screen and (max-width: 991px) {}

@media only screen and (max-width: 767px) {
    ul.review-list li .image {
        width: 50px;
        height: 50px;
        position: relative;
        top: 0;
        left: 0;
        border: 2px solid #EDEDED;
        padding: 2px;
        border-radius: 50%;
    }
    ul.review-list li .content {
        padding-left: 0;
        float: none;
		background:
    }
	
}

@media (max-width: 479px) {
    ul.review-list li .rating-wrapper-wrapper {
        margin-top: -40px;
        padding-bottom: 0;
    }
    ul.review-list li .rating-wrapper + .rating-wrapper {
        margin-top: 0;
    }
    ul.review-list li .rating-wrapper-wrapper .rating-wrapper {
        float: left;
        width: 50%;
        margin-bottom: 15px;
    }
	ul.review-list > li {
	background:none;
	}
}

.ppt-comment-form-single form {      padding: 20px 20px 0px 20px; border: 5px solid #ddd;}
.ppt-comment-form-single .ratingbox { margin-bottom: 20px; }
.ppt-comment-form-single textarea { min-height:200px; }
.ppt-comment-form-single label { font-size:13px; text-transform:uppercase; letter-spacing:1px; margin:0px; color:#666; }

.ppt-comment-form-single .btn { background: #d9251d; border: 1px solid #ef281f; color:#FFFFFF; text-transform:uppercase;  }
.ppt-comment-form-single h4 {  font-size:16px; margin-bottom:10px; text-transform:uppercase;  }
				
				
.ratingboxborder { border-bottom:1px solid #e6e6e6; padding-bottom:10px; }
.rating-header > div {
    display: inline-block;
    vertical-align: top;
}
.rating-header .raring-numbner {
    font-size: 46px;
    font-weight: 700;
 
    margin-right: 15px;
}
.ppt-comment-form-single { display:none; }

.btn-white { background:#fff; font-weight:bold; color:#0066CC; text-transform:uppercase;  }

.prielabel { color:#fbff03 }
@media (max-width: 767px) {
	.hero-header {
		padding: 50px 0 40px;
		background-image: none;  
	}
	.main-search-wrapper { width:100% !important; }
	h1 {
		font-size: 31px;
	}
	
	.section-title h2 { font-size:26px !important; }
}

@media (max-width: 479px) {

	.hero-header {
		padding:0px !important; margin:0px;
		background-image: none;
		
	}
	 .main-search-wrapper { width:100% !important;   }

	.hero-header h1 { margin-top:20px; }
	
	.box-count-down .box-count{  width: 60px;  height:60px;  border:1px solid #eaeaea;  float: left;     border-radius: 4px;  text-align: center;  padding: 2px;  position: relative;  color: #333;  margin-right: 13px;  background: #fff;}

}
</style>
<?php

$newcss = ob_get_clean();
$newcss = str_replace("<style>","", str_replace("</style>","",$newcss)); 
$newcss = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $newcss)); 
return $css.$newcss;
}
add_action('hook_v9_extra_css','_hook_extra_css');




// GET VALUE
$date = get_post_meta($post->ID,'expiry_date',true);
if($date == ""){
	$date = $wpdb->get_var( "SELECT meta_value FROM $wpdb->postmeta WHERE post_id =('".$post->ID."') AND meta_key=('expiry_date') LIMIT 1" );
}

// GET DATE PARTS
$vv = $CORE->date_timediff($date);


get_header($CORE->pageswitch());
 
if (have_posts()) : while (have_posts()) : the_post();

?><div class="hero-header" style="background-image:url('<?php echo do_shortcode('[IMAGE pathonly=1]'); ?>'); background-size:cover;">
   <div class="container">
      <div class="row">
         <div class="main-search-wrapper">
            <div class="row">
               <div class="col-xl-6">
                  <?php if(get_post_meta($post->ID, "price", true) != ""){ ?>
                  <div class="deal-prices clearfix mt-3">
                     <div class="deal-save-price float-right"> <span><?php echo __("You save","premiumpress") ?>:</span> <?php echo get_post_meta($post->ID, "saving", true); ?>%		</div>
                     <div class="mb-2 text-uppercase prielabel"><?php echo __("List Price","premiumpress") ?></div>
                     
                     <?php if(get_post_meta($post->ID, "price-old", true) != ""){ ?>
                     <div class="deal-old-price"> <?php echo hook_price(get_post_meta($post->ID, "price-old", true)); ?></div>
                     <?php } ?>
                     
                      <div class="deal-new-price"> <?php echo hook_price(get_post_meta($post->ID, "price", true)); ?> </div>
                    
                  </div>
                  <?php }elseif(get_post_meta($post->ID, "saving", true) != ""){ ?>
                  <div class="deal-prices clearfix mt-3">
                     <div class="deal-save-price"> <span><?php echo __("You save","premiumpress") ?>:</span> <?php echo get_post_meta($post->ID, "saving", true); ?>%		</div>
                  </div>
                  <?php } ?>
                  <div class="text-uppercase h5 mt-4 mb-3"><i class="fa fa-clock-o"></i> <?php echo __("Expires In","premiumpress") ?></div>
                  <div class="clearfix mt-1">
                     <?php if($vv['expired'] == 1){	?>
                     <?php echo __("This deal has ended.","premiumpress") ?>
                     <?php }else{ ?>
                     <script>
                        jQuery(document).ready(function(){
                        
                        
                        var dateStr =	"<?php echo $date; ?>";
                        		var a		=	dateStr.split(' ');
                        		var d		=	a[0].split('-');
                        		var t		=	a[1].split(':');
                        		var finalDate1 = new Date(d[0],(d[1]-1),d[2],t[0],t[1],t[2],t[2]);
                        
                        jQuery('#buybox-timer').countdown({
                        					until: finalDate1,
                        					layout:jQuery('#auction_timer_layout_single_side').html(),
                        					//format: $this.data( "format" ),
                        					//labels: labels, 
                        					timezone: <?php echo get_option('gmt_offset'); ?>,
                        					//compact: true,
                        					//serverSync: ajax_serverSync(),
                        					onExpiry: function(){
                        						 
                        						// CORE AJAX EXPIRE
                        						ajax_expire();
                        						
                        					},
                        					alwaysExpire: true,
                        		});	
                        });
						
						function ajax_expire() {
							jQuery.ajax({
								type: "POST",
								url: '<?php echo get_home_url(); ?>/',
								data: {
									action: "expire_check_listing",
									pid: <?php echo $post->ID; ?>
								},
								success: function(e) {
								
								//console.log(e+'<-- ajax_expire');
								
								   // alert(e);
									// RELOAD PAGE
									//window.open('<?php echo get_permalink($post->ID); ?>', "_self");
								},
								error: function(e) {
									//alert("error" + e)
								}
							})
						}

                     </script>
                     <div id="buybox-timer" class="h4"></div>
                     <div id="auction_timer_layout_single_side" style="display:none;">
                        <di class="box-count-down mb-2">
      <span class="countdown-lastest is-countdown">
      <span class="box-count bg-light"><span class="number">{dn}</span><span class="text"><?php echo __("Days","premiumpress"); ?></span></span>
      <span class="dot">:</span>
      <span class="box-count bg-light"><span class="number">{hnn}</span> <span class="text"><?php echo __("Hrs","premiumpress"); ?></span></span>
      <span class="dot">:</span>
      <span class="box-count bg-light"><span class="number">{mnn}</span> <span class="text"><?php echo __("Mins","premiumpress"); ?></span></span>
      <span class="dot">:</span>
      <span class="box-count bg-light"><span class="number">{snn}</span> <span class="text"><?php echo __("Secs","premiumpress"); ?></span></span>
                           </span>
                        </di>
                     </div>
                     <?php } ?>
                  </div>
               </div>
               <div class="col-xl-6">
                  <h1 class="h3 mb-3"><?php echo do_shortcode('[TITLE]'); ?></h1>
                  <?php echo do_shortcode('[EXCERPT]'); ?>
                  <?php if(get_post_meta($post->ID,'link',true)){ ?>
                  <a href="<?php echo get_post_meta($post->ID,'link',true); ?>" class="btn btn-white float-right mt-4 text-white" rel="nofollow">
				  <span class="pr-3"><?php echo __("Visit Deal Website","premiumpress") ?></span>
                  <i class="fa fa-angle-right"></i></a>
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<main id="main">
   <?php //get_template_part( 'page', 'top' ); ?>
   <section>
      <div class="container py-5">
         <div class="row">
            <div class="col-md-10 offset-md-1">
            
            
             
               <div class="card">
                  <div class="card-body typography p-lg-5">
                    
                     <?php echo do_shortcode('[CONTENT media=0]'); ?>
                     <?php if($post->post_content == ""){ ?>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
                     <?php } ?>
                  </div>
               </div>
         
            </div>
         </div>
      </div>
   </section>
   <?php get_template_part( 'page', 'bottom' ); ?>  
</main>
<!-- end main -->
<?php endwhile; endif;

get_footer($CORE->pageswitch());

}
?>