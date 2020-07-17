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

.hero3 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.hero3{
	position:relative;
	overflow:hidden;
	clear:both;
	background:#f1f1f1;
}
.hero3 .uc_container_left{
	float:left;
	width:50%;
}
.hero3 .uc_container_left .uc_container_holder{
	width:40%;
	text-align:left;
	position:absolute;
	left:7%;
	top:50%;
	transform:translateY(-50%);
	-webkit-transform:translateY(-50%);
	-moz-transform:translateY(-50%);
	z-index:101;
	
	font-weight:400;
}
.hero3 .uc_container_left .uc_container_holder h1{
	font-size: 13px;
    font-weight: 700;
    letter-spacing: 8px;
    margin: 0 0 18px;
	color:#212127;
	opacity:0.7;
}
.hero3 .uc_container_left .uc_container_holder h2{
	font-size:68px;
	margin-bottom:23px;
	font-weight:700;
	line-height:71px;
	color:#212127;
	max-width:70%;
	letter-spacing:-4px;
	padding-bottom:26px;
	position:relative;
}
.hero3 .uc_container_left .uc_container_holder h2::after, 
.hero3 .uc_container_left .uc_container_holder h2::before{
	background: #000;
	content: "";
	display: block;
	height: 2px;
	position: absolute;
	bottom: 0%;
	width: 10%;
}
.hero3 .uc_container_left .uc_container_holder .uc_paragraph{
	font-size:18px;
	margin-bottom:47px;
	color:#212127;
	font-weight:400;
	opacity:0.7;
	line-height:29px;
}
.hero3 .uc_container_left .uc_container_holder a.uc_portfolio{
	border-radius: 40px;
    color: #ffffff;
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    line-height: 52px;
    padding: 4px 50px;
    position: relative;
    text-align: center;
	text-transform:uppercase;
	text-decoration:none;
	letter-spacing:3px;
}

.hero3 .uc_container_right{
	float:right;
	width:50%;
	position:relative;
}
.hero3 .uc_container_right img{
	width:100%;
	height:auto;
}
.hero3 .uc_container_right .uc_play{
	width:100%;
	text-align:center;
	position:absolute;
	left:0%;
	top:50%;
	transform:translateY(-50%);
	-webkit-transform:translateY(-50%);
	-moz-transform:translateY(-50%);
	z-index:101;
}
.hero3 .uc_container_right .uc_play img{
	width:auto;
}


@media only screen and (max-width: 1240px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:62px;}
}
@media only screen and (max-width: 1100px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:58px;}
}
@media only screen and (max-width: 1024px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:57px; line-height:60px; max-width:inherit;}
}
@media only screen and (max-width: 980px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:45px; max-width: 85%; line-height:normal;}
	.hero3 .uc_container_left .uc_container_holder .uc_paragraph{ font-size:14px; line-height:24px; margin-bottom:22px;}
	.hero3 .uc_container_left .uc_container_holder a.uc_portfolio{ line-height:40px; padding:4px 30px;}
}
@media only screen and (max-width: 780px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:32px; max-width: inherit; line-height:normal; letter-spacing:-3px;}
}
@media only screen and (max-width: 680px) {
	.hero3 .uc_container_left .uc_container_holder h1{ letter-spacing:4px;}
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:22px; max-width: inherit; line-height:normal; letter-spacing:-1px; padding-bottom:10px; margin-bottom:10px;}
	.hero3 .uc_container_left .uc_container_holder .uc_paragraph{ line-height:normal; margin-bottom:20px; }
	.hero3 .uc_container_right .uc_play img { width: 30%;}
}
@media only screen and (max-width: 580px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:18px;}
	.hero3 .uc_container_left .uc_container_holder a.uc_portfolio { font-size: 9px; line-height: 33px; padding: 0 20px;}
	.hero3 .uc_container_left .uc_container_holder .uc_paragraph{ font-size:12px;}
}
@media only screen and (max-width: 480px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:32px; max-width: inherit; letter-spacing:-1px; line-height:normal;}
	.hero3 .uc_container_right, .hero3 .uc_container_left{ width:100%; float:none; }
	.hero3 .uc_container_left{ padding:40px 0 30px 0px;}
	.hero3 .uc_container_left .uc_container_holder { position: relative; top:0; width: 86%; transform:none;}
}
@media only screen and (max-width: 360px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:28px; max-width: inherit; letter-spacing:-1px; line-height:normal;}
}
@media only screen and (max-width: 320px) {
	.hero3 .uc_container_left .uc_container_holder h2{ font-size:24px; max-width: inherit; letter-spacing:-1px; line-height:normal;}
}








</style>
<div class="hero3 hero-2 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
    
    <div class="uc_container_left">
        <div class="uc_container_holder">
            <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>TITLE HERE<?php } ?></h1>
            <h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. 
            <?php } ?></h2>
            <div class="uc_paragraph"><?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. 
            <?php } ?></div>
            
            <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_portfolio bg-primary">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
            </a> 
                 
        </div>
    </div>
  
  	<div class="uc_container_right">
    	 
        <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero3.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>">
        
        
        <div class="uc_play">
        	<a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; } ?>">
              <img src="https://premiumpress.com/_demoimages/elementor/_hero/play_button.png" alt="" title="">
         	</a>
        </div>
    </div>
  
</div>