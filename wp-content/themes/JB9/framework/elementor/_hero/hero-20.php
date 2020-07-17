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
.hero20 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}

.hero20{
	position:relative;
	width:100%;
}

.hero20 img{
	width:100%;
	display: block;
}

.hero20 .uc_container_text_box{ 
	 
    left: 50%;
    margin-left: -24%;
    padding: 85px 0;
    position: absolute;
    text-align: center;
    top: 50%;
    transform: translateY(-50%);
     width: 48%;
	
}

.uc_top-text{
	font-family: "Montserrat",sans-serif;
	 font-size: 18px;
	 text-transform: uppercase;
	 letter-spacing:6px;
	 font-weight:400;
	 color:#ffffff;
	 opacity: 0.7;
}
.hero20 .uc_container_text_box h1{
	font-size:3.5vw;
	font-family: 'Montserrat', sans-serif;
	font-weight:700;
	color:#ffffff;	
	line-height: 70px;
	 padding:30px 0;
	 background:url(border.jpg) no-repeat bottom center;
}
.hero20 .uc_container_text_box .fa{ color:#ffffff; font-size:3.5vw; padding:45px 53px; border:1px solid #ffffff; border-radius:50%;}
.hero20 .uc_paragraph{
	font-family: 'PT Serif', serif;
	font-size:23px;
	color:#ffffff;
	font-weight:400;
	margin: 40px 0;
	line-height: 30px;
	padding: 0 50px;
}

.hero20 .uc_container_text_box a{
	font-size:13px;
	background:#f44219;
	font-family: 'Montserrat', sans-serif;
	font-weight:700;
	color:#ffffff;
	padding:18px 40px;
	text-decoration:none;
	display:inline-block;
	text-transform:uppercase;
	letter-spacing:2px;
	border-radius:35px;
}
.hero20 .start-btn a{ 
	background:none;
	padding: 0px;
	margin-top:0px;
}

@media only screen and (max-width:1299px) {
	.hero20 .uc_container_text_box{padding: 35px 0;}
	.hero20 .uc_container_text_box h1{ line-height:normal;}
}
@media only screen and (max-width: 1024px) {
	.hero20 .uc_container_text_box{ width: 740px;margin-left: -370px;}
	.hero20 .uc_paragraph{font-size: 19px;margin:15px 0;line-height: normal;}
	.hero20 .uc_container_text_box a { margin-top: 14px; padding:12px 28px;font-size: 14px;}
	.hero20 .uc_container_text_box h1{ line-height:normal;}
	.hero20 .uc_container_text_box .fa{ padding: 37px 42px;font-size: 3vw;}
}
@media only screen and (max-width: 800px) {	
	
	.hero20 .uc_container_text_box{ width: 100%;margin-left:0;padding: 15px; left:0px;}
	.hero20 .uc_paragraph{margin: 4px 0;}
	.hero20 .uc_container_text_box a { margin-top: 14px; padding:12px 28px;font-size: 14px;}
	.hero20 .uc_container_text_box h1{ line-height:normal; padding: 4px 0;}
	.hero20 .start-btn a{ margin-top:0px;padding:0px;}
}
	
@media only screen and (max-width: 768px) {	

	.hero20 .uc_socila_icon { right: 15px; }	
	.hero20 .uc_container_text_box .fa{ padding: 25px 29px;font-size: 3vw; margin:10px 0 0 0;}
}
@media only screen and (max-width: 640px) {	
	.hero20 .uc_paragraph{ font-size: 14px;padding: 0px;}
	.hero20 .uc_container_text_box { border: 5px solid #ffffff;}
	.uc_top-text {font-size: 10px;letter-spacing: 4px;}
	.hero20 .uc_container_text_box h1{ font-size: 5.5vw;}
	.hero20 .uc_container_text_box a { font-size: 10px; padding: 10px 15px;}
	.hero20 .uc_container_text_box { border: none; padding:0px;}
	.hero20 .start-btn a{ margin-top:0px;padding:0px;}
	

}
@media only screen and (max-width: 480px) {	
	.uc_top-text {font-size: 9px;}
	.hero20 .uc_container_text_box .fa{padding: 12px 14px;}
	.hero20 .uc_container_text_box a {  font-size: 8px; margin-top: 0;}
	.hero20 .uc_paragraph { font-size: 12px;}
}
@media only screen and (max-width: 360px) {	
	.hero20 .uc_paragraph{ display:none;}
	.hero20 .uc_container_text_box .fa{ margin:15px 0;}
}
</style>
<div class="hero20 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    	
    
    <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero20.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
    
    
    <div class="uc_container_text_box">
        <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>Sed luctus, dolor in vulputate mattis.<?php } ?></h1>
        <div class="start-btn">
        
        <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; } ?>"><i class="fa fa-play" aria-hidden="true"></i></a>
        
        </div>
        <div class="uc_paragraph"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
        
        <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_btn">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>LEARN MORE<?php } ?>
        </a> 
        
        
            </div>      
</div>