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
 
.hero7 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.hero7{
	position:relative;
	overflow:hidden;
}
.hero7 img{
	width:100%;
	height:auto;
}
.hero7 .uc_container_holder{
	width:100%;
	text-align:center;
	position:absolute;
	left:0%;
	top:50%;
	transform:translateY(-50%);
	-webkit-transform:translateY(-50%);
	-moz-transform:translateY(-50%);
	z-index:101;
	color:#FFFFFF;
}
.hero7 .uc_container_holder .uc_main_content_box{
	max-width:26.5%;
	margin:0 auto;
}
.hero7 .uc_container_holder .uc_content_box{
	background:#dc3b46;
	padding:21% 19% 0;
	margin-bottom:55px;
	clear:both;
	overflow:hidden;
	
}
.hero7 .uc_container_holder .uc_main_content_box h1{
	font-size:16px;
	font-weight:400;
	margin-bottom:20px;
	line-height:normal;
	letter-spacing:7px;
	opacity:0.7;
}
.hero7 .uc_container_holder .uc_main_content_box h2{
	background:url(line.jpg) no-repeat center bottom;
	font-weight:400;
	margin-bottom:23px;
	padding-bottom:25px;
	font-size:36px;
	line-height:40px;
}
.hero7 .uc_container_holder .uc_main_content_box .uc_paragraph{
	font-size:16px;
	font-weight:400;
	display:block;
	line-height:24px;
	margin:0 auto 53px;
	opacity:0.7;
	 
}
.hero7 .uc_container_holder .uc_main_content_box a.uc_read_btn{
 
	padding:9% 0%;
	display:block;
	font-size:16px;
 
	font-weight:700;
	text-decoration:none;
}
.hero7 .uc_container_holder .uc_main_content_box .uc_social a{
	margin:0 16px;
	color:#fff;
	font-size:18px;
}

@media only screen and (max-width: 1500px) {
	.hero7 .uc_container_holder .uc_main_content_box{ max-width:36%;}
}
@media only screen and (max-width: 1300px) {
	.hero7 .uc_container_holder .uc_main_content_box{ max-width:38%;}
}
@media only screen and (max-width: 1199px) {
	.hero7 .uc_container_holder .uc_main_content_box{ max-width:50%;}
	.hero7 .uc_container_holder .uc_content_box{ margin-bottom:20px; padding:10% 15% 0;}
	.hero7 .uc_container_holder .uc_main_content_box a.uc_read_btn{ padding:5% 0;}
}
@media only screen and (max-width: 991px) {
	.hero7 .uc_container_holder .uc_main_content_box{ max-width:60%;}
	.hero7 .uc_container_holder .uc_content_box{ padding: 6% 12% 0;}
	.hero7 .uc_container_holder .uc_main_content_box h2{ font-size:28px; line-height:32px; margin-bottom:15px;}
	.hero7 .uc_container_holder .uc_main_content_box .uc_paragraph{ max-width:70%; font-size:14px; margin-bottom:20px;}
}
@media only screen and (max-width: 767px) {
	.hero7 .uc_container_holder .uc_main_content_box{ max-width:60%;}
	.hero7 .uc_container_holder .uc_main_content_box h2 { font-size: 18px; line-height: normal; margin-bottom: 10px; padding-bottom: 10px;}
	.hero7 .uc_container_holder .uc_content_box{ padding-top:3%;}
	.hero7 .uc_container_holder .uc_main_content_box a.uc_read_btn{ padding:3% 0; font-size: 13px;}
	.hero7 .uc_container_holder .uc_main_content_box h1{ font-size:10px; margin-bottom:10px;}
}
@media only screen and (max-width: 639px) {
	.hero7 .uc_container_holder .uc_main_content_box{ max-width:65%;}
	.hero7 .uc_container_holder .uc_main_content_box .uc_paragraph{ display:none;}
	.hero7 .uc_container_holder .uc_main_content_box h2{ font-size:14px; margin-bottom:10px; background:none;}
	.hero7 .uc_container_holder .uc_main_content_box a.uc_read_btn{ font-size:12px;}
	
}
@media only screen and (max-width: 479px) {
	.hero7 .uc_container_holder .uc_main_content_box{ max-width:75%;}
}
@media only screen and (max-width: 359px) {
	.hero7 .uc_container_holder .uc_main_content_box{ max-width:75%;}
	.hero7 .uc_container_holder .uc_content_box{ padding-top:3%; margin-bottom:10px;}
	.hero7 .uc_container_holder .uc_main_content_box h2{ font-size12px; margin-bottom:5px; letter-spacing:10px;}
	.hero7 .uc_container_holder .uc_main_content_box a.uc_read_btn{ font-size:9px;}
	.hero7 .uc_container_holder .uc_main_content_box h1{ font-size:9px; letter-spacing:4px; margin-bottom:5px;}
}
</style>
<div class="hero7 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
      <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero7.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
    <div class="uc_container_holder">
    	<div class="uc_main_content_box">
           <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></h1>
        
            <div class="uc_content_box bg-secondary py-5">
                <h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>FUN SLOGAN<?php } ?></h2>
                <div class="uc_paragraph">
                   <?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>YOUR OWN TEXT CAN BE ENTERED HERE VIA THE ADMIN AREA<?php } ?> 
                </div>
               
                 <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_read_btn bg-white text-dark">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
         </a>
            </div>
          
        </div>
    </div>
</div>