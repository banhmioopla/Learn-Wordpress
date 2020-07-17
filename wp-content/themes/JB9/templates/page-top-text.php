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
   
   global $post;
   
   // GET TEMPLATE IF AVAILABLE
   $template = str_replace("templates/","",get_post_meta( $post->ID, '_wp_page_template', true ));
     
	// FEATURED IMAGE
	if ( isset($post->ID) && has_post_thumbnail() ) {
	$featured_image = get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); 
	}else{
			switch($template){		
			case "tpl-add.php": {			
			$img = "title-add.jpg";			
			} break;
			case "tpl-page-contact.php": {	
			$img = "title-contact.jpg";
			} break;
			case "tpl-page-how.php": {	
			$img = "title-how.jpg";
			} break;		
			case "tpl-page-aboutus.php": {	
			$img = "title-aboutus.jpg";
			} break;
			case "tpl-page-sellspace.php": {	
			$img = "title-sellspace.jpg";
			} break;
			case "tpl-page-testimonials.php": {	
			$img = "title-feedback.jpg";
			} break;
			case "tpl-page-blog.php": {	
			$img = "title-blog.jpg";
			} break;
			case "tpl-page-faq.php": {	
			$img = "title-faq.jpg";
			} break;
			case "tpl-page-top.php": {	
			$img = "title-top.jpg";
			} break;	
			case "templates-coupon/tpl-page-coupon-cashback.php": {	
			$img = "title-cash.jpg";
			} break;	
			default: {		
				$img = "title-default.jpg";
			}		
		}// end switch
		
		$featured_image = "https://premiumpress.com/_demoimages/pagetitle/".$img;
	
	} 

	// 1. PAGE HEADER
	$page_header = "";
	if( isset($post->ID) && strlen(get_post_meta($post->ID,'pageheader_title',true)) > 2 ){
		$page_header = stripslashes(get_post_meta($post->ID,'pageheader_title',true));
	}else{	
	
		switch($template){		
			case "tpl-add.php": {			
				switch(strtoupper(THEME_KEY)){				
					case "DT": { $page_header = __("Add Business","premiumpress");  } break;
					case "CP": { $page_header = __("Add Coupon","premiumpress");  } break;
					case "DP": { $page_header = __("Add Profile","premiumpress");  } break;
					case "JB":
					case "MJ": { $page_header = __("Add Job","premiumpress");  } break;
					case "CT": { $page_header = __("Add Classified","premiumpress");  } break;
					 
					
					default: { $page_header = __("Add Listing","premiumpress");  } break;				
				}// end switch			
			} break;
			case "tpl-page-contact.php": {	
			$page_header = __("Contact Us","premiumpress");  
			} break;
			case "tpl-page-how.php": {	
			$page_header = __("How it works","premiumpress");  
			} break;		
			case "tpl-page-aboutus.php": {	
			$page_header = __("About Us","premiumpress");  
			} break;
			case "tpl-page-top.php": {	
			$page_header = __("Top 10","premiumpress");  
			} break;
			case "tpl-page-sellspace.php": {	
			$page_header = __("Advertising","premiumpress");  
			} break;
			case "tpl-page-testimonials.php": {	
			$page_header = __("User Feedback","premiumpress");  
			} break;
			case "tpl-page-blog.php": {	
			$page_header = __("Latest News","premiumpress");  
			} break;	
			case "tpl-page-memberships.php": {	
			$page_header = __("Memberships","premiumpress");  
			} break;			
			default: {	
			 
				if(isset($post->post_title) && strlen($post->post_title) > 1){ 
					$page_header = $post->post_title;	
				}else{
					$page_header = "Page Title";	
				}	
				
			}		
		}// end switch
	 
	}

	// 2. PAGE DESC
	$page_sub = "";
	if( strlen(get_post_meta($post->ID,'pageheader_sub',true)) > 2 ){
		$page_sub = stripslashes(get_post_meta($post->ID,'pageheader_sub',true));
	}else{	
		switch($template){		
			case "tpl-add.php": {			
				switch(strtoupper(THEME_KEY)){				
					//case "DT": { } break;
					//case "CP": { } break;
					default: { $page_sub = __("It's quick and easy! Select a package and enter your details to get started!","premiumpress"); } break;				
				}// end switch			
			} break;
			case "tpl-page-contact.php": {	
			$page_sub = __("Fill in the form below and one of our friendly support staff will contact you back ASAP regarding your question or query.","premiumpress"); 
			} break;
			case "tpl-page-how.php": {	
			$page_sub = __("It's quick and easy to get started! Learn how our website works in less than 2 minutes!","premiumpress"); 
			} break;
			case "tpl-page-top.php": {	
			$page_sub = __("Below are some of our most popular listings, see for yourself what all the hype is about!","premiumpress"); 
			} break;			
			case "tpl-page-sellspace.php": {	
			$page_sub = __("Upload your own banners and add them to our website using our new advertising system!","premiumpress"); 
			} break;			
			case "tpl-page-testimonials.php": {	
			$page_sub = __("Below you'll find some of our recent client feedback provided to us by our customers.","premiumpress"); 
			} break;
			case "tpl-page-blog.php": {	
			$page_sub = __("Keep updated with our latest company news and updates from our blog posts below.","premiumpress"); 
			} break;
			case "templates-coupon/tpl-page-coupon-cashback.php": {	
			$page_sub = __("Earn money online with our cash-back system today!","premiumpress"); 
			} break;
			case "tpl-page-faq.php": {	
			$page_sub = __("We've compiled some of our most common question and answers for you below.","premiumpress"); 
			} break;
			case "tpl-page-memberships.php": {	
			$page_sub = __("Subscribe to one of our membership packages below and full access to our website!","premiumpress"); 
			} break;
			//case "tpl-page-aboutus.php": {	 } break;
			default: {		
			$page_sub = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";		
			}		
		}// end switch
	 
	}
	

	// 3. PAGE SUB
	$page_desc = "";
	if( strlen(get_post_meta($post->ID,'pageheader_desc',true) ) > 2 ){
		$page_desc = stripslashes(get_post_meta($post->ID,'pageheader_desc',true));
	}else{
		switch($template){		
			case "tpl-add.php": {			
				switch(strtoupper(THEME_KEY)){				
					//case "DT": { } break;
					//case "CP": { } break;
					default: { $page_desc = __("Increase your listing exposure, traffic and website visitors with our premium listing packages.","premiumpress"); } break;				
				}// end switch			
			} break;
			case "tpl-page-contact.php": {	
				$page_desc = __("Please allow up-to 48 hours for a responce - thank you!","premiumpress"); 
			} break;
			case "tpl-page-how.php": {	
			$page_desc = __("If you have any problems or questions, please don't hesitate to get in touch with our team using the contact page.","premiumpress"); 
			} break;
			//case "tpl-page-aboutus.php": {	 } break;
			case "tpl-page-top.php": {	
			$page_desc = __("Create your own listing today and add it to our website!","premiumpress");
			} break;			
			case "tpl-page-sellspace.php": {	
			$page_desc = __("Select your desired package from the list below, contact us for any help or special requirments.","premiumpress");
			} break;
			case "tpl-page-testimonials.php": {	
			$page_desc = __("Contact us today and let us know your feedback to be added to our website.","premiumpress"); 
			} break;			
			case "tpl-page-blog.php": {	
			$page_desc = __("Don't forget to subscribe to our newsletter to stay updated and get notifications to your inbox!","premiumpress");
			} break;
			case "templates-coupon/tpl-page-coupon-cashback.php": {	
			$page_desc = __("Create your free account on our website today and earn money with our cash-back system.","premiumpress"); 
			} break;
			case "tpl-page-faq.php": {	
			$page_desc = __("If you can't find what your looking for, contact us today so we can help you further.","premiumpress"); 
			} break;
			case "tpl-page-memberships.php": {	
			$page_desc = __("If you have any questions or queries, please use our contact page to get in touch!","premiumpress"); 
			} break;
			default: {		
				$page_desc = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue.";		
			}		
		}// end switch
	 
	}
   
   ?>
<div id="pagetitletop">
   <div class="row mb-5 border-bottom pb-lg-5">
      <div class="col-md-7">
         <?php if($post->post_content == ""){ ?> 
         <h1 class="mb-4"><?php echo $page_header; ?></h1>
         <p class="lead"><?php echo $page_sub; ?></p>
         <p><?php echo $page_desc; ?></p>
         <?php }else{ ?>
         <?php the_content(); ?>
         <?php } ?>
      </div>
      <div class="col-md-5 hide-mobile">
         <div style="position:relative;">             
            <img src="<?php echo $featured_image; ?>" alt="<?php echo $page_header; ?>" class="img-fluid"> 
            <div style="position:absolute; top:0;" class="hide-ipad">
               <img src="<?php echo FRAMREWORK_URI; ?>/img/overlay.png" alt="OVERLAY" class="img-fluid">
            </div>
         </div>
      </div>
   </div>
</div>