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

?>
<style>

.hero11 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.hero11 .uc_container_holder
{
	background:#ffffff;
	width:100%;
	display:table;
	overflow:hidden;
}

.hero11 .uc_content_half
{
	display:table-cell;
	width:50%;
	height:100%;
	vertical-align:middle;
}

.hero11 .uc_content_half:last-child
{
	vertical-align:top;
}

.hero11 .uc_content_half .uc_caption
{
	font-family: 'Roboto Slab', serif;
	max-width:464px;
	padding-right:25px;
	padding-left:25px;
	font-size:20px;
	line-height:37px;
	color:#919191;
	overflow:hidden;
	position:relative;
	margin:0 auto;
	height:100%;
	
}

.hero11 .uc_content_half .uc_caption p
{
	margin:0 0 20% 0;
	font-weight:300;
}

.hero11 .uc_content_half .uc_caption h2
{
	font-size:53px;
	line-height:63px;
	color:#019fff;
	font-weight:300;
	margin:0 0 19px 0;
}

.hero11 .uc_content_half .uc_caption a.uc_color_btn
{
	background: #04ace9;
	font-size:15px;
	display:block;
	float:left;
	line-height:57px;
	font-weight:700;
	text-decoration:none;
	text-align:center;
	color:#ffffff;
	padding:0 26px;
	margin:0 0 100px 0;
	border-radius:120px;
	letter-spacing:2px;
	box-shadow:#c1e6f6 0px 6px 20px;
	transition:all 0.3s ease-in-out;
	-webkit-transition:all 0.3s ease-in-out;
	-moz-transition:all 0.3s ease-in-out;
	-ms-transition:all 0.3s ease-in-out;
}



.hero11 .uc_content_half .uc_caption a.uc_white_color_btn
{
	font-family: 'Lato', sans-serif;
	font-size:15px;
	display:block;
	float:right;
	line-height:57px;
	font-weight:700;
	text-decoration:none;
	text-align:center;
	color:#019fff;
	padding:0 26px;
	margin:0 0 100px 0;
	border-radius:120px;
	letter-spacing:2px;
	box-shadow:#f3f3f3 0px 6px 20px;
	transition:all 0.3s ease-in-out; 
	-webkit-transition:all 0.3s ease-in-out;
	-moz-transition:all 0.3s ease-in-out;
	-ms-transition:all 0.3s ease-in-out;
	
}



.hero11 .uc_content_half img
{
	max-width:100%;
	width:100%;
}
.hero11 .uc_content_half span.bbb
{
	font-family: 'Roboto Slab', serif;
	display:block;
	font-size:19px;
	letter-spacing:3px;
	line-height:50px;
	font-weight:400;
	background-color:#00377b;
	width:395px;
	margin:9% 0 14%; 
	color:#ffffff;
	text-align:center;
	text-transform:uppercase;
}

@media only screen and (min-width: 1200px) and (max-width: 1371px)
{
	.hero11 .uc_content_half .uc_caption h2{ font-size:36px; line-height:42px; }	
	.hero11 .uc_content_half .uc_caption a.uc_color_btn{ line-height:46px;}
	.hero11 .uc_content_half .uc_caption a.uc_white_color_btn{ line-height:46px;}
}
@media only screen and (min-width: 1024px) and (max-width: 1199px)
{
	.hero11 .uc_content_half span{ font-size:16px; line-height:38px;}
	.hero11 .uc_content_half .uc_caption h2{ font-size:40px; line-height:47px;}
	.hero11 .uc_content_half .uc_caption{ font-size:19px; line-height:30px;}
	.hero11 .uc_content_half .uc_caption p{   margin: 0 0 13%;}
	.hero11 .uc_content_half .uc_caption a.uc_color_btn{ font-size:13px; line-height:47px; padding: 0 20px;}
	.hero11 .uc_content_half .uc_caption a.uc_white_color_btn { font-size:13px; line-height:47px; padding: 0 20px;}
}
@media only screen and (max-width: 1023px)
{
	.hero11 .uc_content_half span{ font-size:16px; line-height:38px;}
	.hero11 .uc_content_half span{ width:285px; font-size:13px;}
	.hero11 .uc_content_half .uc_caption h2{ font-size:30px; line-height:34px;}
	.hero11 .uc_content_half .uc_caption{ font-size:15px; line-height:25px; max-width:352px;}
	.hero11 .uc_content_half .uc_caption p{margin: 0 0 13%;}
	.hero11 .uc_content_half .uc_caption a.uc_color_btn{ font-size:13px; line-height:39px; padding: 0 20px;}
	.hero11 .uc_content_half .uc_caption a.uc_white_color_btn { font-size:13px; line-height:39px; padding: 0 20px;}
}

@media only screen and (max-width: 769px)
{
	.hero11 .uc_content_half { width:100%; display:block;}
	.hero11 .uc_content_half span{ font-size: 19px; line-height:50px; width:350px;  }
	.hero11 .uc_content_half .uc_caption h2{ font-size:51px; line-height:63px;}
	.hero11 .uc_content_half .uc_caption p{  font-size: 20px; line-height: 37px; margin-bottom:60px;}
	.hero11 .uc_content_half .uc_caption{ max-width:446px;}
	.hero11 .uc_content_half .uc_caption a.uc_color_btn{ font-size:13px; line-height:47px; padding:0 27px;  }
	.hero11 .uc_content_half .uc_caption a.uc_color_btn{ font-size:13px; line-height:47px; padding:0 27px;  }
}

@media only screen and (max-width: 600px)
{
	.hero11 .uc_content_half span{ font-size:13px; line-height:38px; width:273px;}
	.hero11 .uc_content_half .uc_caption h2{ font-size:40px; line-height:47px;}
	.hero11 .uc_content_half .uc_caption{ font-size:19px; line-height:30px;}
	.hero11 .uc_content_half .uc_caption p{   margin: 0 0 13%;}
	.hero11 .uc_content_half .uc_caption a.uc_color_btn{ font-size:13px; line-height:47px; padding: 0 20px;}
	.hero11 .uc_content_half .uc_caption a.uc_white_color_btn { font-size:13px; line-height:47px; padding: 0 20px;}
}

@media only screen and (max-width: 414px)
{
	.hero11 .uc_content_half span{ width:100%; text-align:center;}
	.hero11 .uc_content_half .uc_caption h2{ font-size:30px; line-height:40px;}
	.hero11 .uc_content_half .uc_caption p{ font-size:16px; line-height:27px;	}
	.hero11 .uc_content_half .uc_caption a.uc_color_btn,.hero11 .uc_content_half .uc_caption a.uc_white_color_btn{ font-size:11px; line-height:37px; padding:0 15px; }
}
</style>
<div class="hero11 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
       
    	<div class="uc_container_holder">
        	<div class="uc_content_half">
            	<span class="bbb"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></span>
                <div class="uc_caption">
                	<h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>Curabitur quis iaculis sem. <?php } ?></h2>
                    <p><?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend.<?php } ?></p>
                    
                    <a href="<?php echo _ppt(array('links','contact')); ?>" class="uc_color_btn"><?php echo __("Contact Us","premiumpress"); ?></a>  
                     
                    <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_white_color_btn">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
         </a>
                    
                </div>
            </div>
            <div class="uc_content_half">
            	 
                <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero11.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
            </div>
        </div>
  </div>