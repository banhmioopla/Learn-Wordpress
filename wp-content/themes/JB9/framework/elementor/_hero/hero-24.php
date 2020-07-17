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

?><style>
.hero24 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
  line-height:normal;
}

.hero24 .uc_container_holder{
	position:relative;
	width:100%;
}
	
.hero24 .uc_container_holder img{
	width:100%;
	display: block;
}
.hero24 .uc_container_text_box{
	position:absolute;
	top:50%;
	padding:0 15px;
	width: 34%;
	right:10%;
	-webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
	transform: translateY(-50%);
}
.hero24 .uc_container_text_box h1{
	font-size:67px;
	 
	font-weight:bold;
	color:#ffffff;
	max-width:428px;	
	}
.hero24 .uc_paragraph{
 
	font-size:23px;
	color:#ffffff;
	font-weight:300;
	margin-top:33px;
	line-height: 44px;
}
.hero24 .uc_container_text_box a{
	font-size:18px;
 
	font-weight:600;
	color:#ffffff;
	padding:22px 50px;
	border:3px solid #ffffff;
	text-decoration:none;
	display:inline-block;
	text-transform:uppercase;
	letter-spacing:2px;
	margin-top:50px;
}
@media screen and (max-width: 992px) {
	.hero24 .uc_container_text_box h1{ max-width:343px;}
}

@media screen and (min-width: 1025px) and (max-width: 1300px) {
	.hero24 .uc_container_text_box{ width:45%;right: 6%;}
	.hero24 .uc_container_text_box a{margin-top: 40px; padding: 15px 35px;}
	.hero24 .uc_paragraph{font-size: 20px;margin-top: 22px;}
}

@media screen and (min-width: 980px) and (max-width: 1024px) {
	.hero24 .uc_container_text_box{ width:45%;right: 6%;}
	.hero24 .uc_container_text_box h1{ font-size:50px;}
	.hero24 .uc_container_text_box a{margin-top: 40px; padding: 15px 35px;}
	.hero24 .uc_paragraph{font-size: 20px;margin-top: 22px;}
}
@media screen and (min-width: 800px) and (max-width: 979px) {
	.hero24 .uc_container_text_box{width: 50%;  right: 0;}
	.hero24 .uc_container_text_box h1{font-size: 34px;line-height: normal;}
	.hero24 .uc_paragraph{ line-height:normal;font-size:18px;margin-top: 10px;}
	.hero24 .uc_container_text_box a { margin-top: 22px; padding:12px 28px;font-size: 14px;}
}

@media screen and (min-width: 640px) and (max-width: 799px) {
	.hero24 .uc_container_text_box { right: 0; width: 54%;}
	.hero24 .uc_container_text_box h1{	font-size:24px;}
	.hero24 .uc_paragraph{font-size: 16px;margin-top: 16px;line-height:normal;}
	.hero24 .uc_container_text_box a {  font-size: 12px;  padding: 10px 22px;  }
}
@media screen and (min-width: 480px) and (max-width: 639px) {
	.hero24 .uc_container_text_box h1{	font-size:24px;}
	.hero24 .uc_container_text_box { right: 0; width: 100%; text-align:center;}
	.hero24 .uc_paragraph{font-size: 15px;line-height:normal;}
	.hero24 .uc_container_text_box a{	 margin-top: 18px; font-size: 15px; padding: 5px 15px; letter-spacing:inherit;}
	.hero24 .uc_container_text_box h1{ max-width:100%; }
}
@media screen and (min-width: 320px) and (max-width: 479px) {
	.hero24 .uc_container_text_box h1{	font-size:24px;line-height: 24px;}
	.hero24 .uc_container_text_box { right: 0; width: 100%; text-align:center;}
	.hero24 .uc_paragraph{font-size: 12px;line-height:normal;margin-top: 5px;}
	.hero24 .uc_container_text_box a{  margin-top: 10px; font-size: 12px; padding: 5px 15px; letter-spacing:inherit;}
	.hero24 .uc_container_text_box h1{ max-width:100%; }
}
</style>
<div class="hero24 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    	
        
    <div class="uc_container_holder">        
   
        <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero24.jpg<?php } ?>" alt="<?php echo $settings['img1_txt1']; ?>">
       
        <div class="uc_container_text_box">
        
            <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>awesome title here<?php } ?></h1>
            
            <div class="uc_paragraph"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend.
            <?php } ?></div>
            
            <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>">
            <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>SEARCH WEBSITE<?php } ?>
            </a>
        
        </div>  
            
     </div>
</div>