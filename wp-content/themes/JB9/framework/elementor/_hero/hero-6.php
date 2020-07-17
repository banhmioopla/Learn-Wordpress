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

.hero6 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.hero6{
	position:relative;
	overflow:hidden;
}
.hero6 img{
	width:100%;
	height:auto;
}
.hero6 .uc_container_holder{
	max-width:43%;
	text-align:left;
	position:absolute;
	left:7%;
	top:50%;
	transform:translateY(-50%);
	-webkit-transform:translateY(-50%);
	-moz-transform:translateY(-50%);
	z-index:101;
 
	color:#25262b;
	font-weight:400;
}
.hero6 .uc_container_holder h1{
	font-size: 18px;
    font-weight: 400;
    letter-spacing: 8px;
    margin: 0 0 80px;
    text-transform: uppercase;
}
.hero6 .uc_container_holder h2{
	 
	font-size:52px;
	margin-bottom:20px;
	font-weight:400;
	line-height:86px;
}
.hero6 .uc_container_holder h3{
	font-size:22px;
	margin-bottom:100px;
	color:#f91944;
	text-transform: uppercase;
	font-weight:400;
}
.hero6 .uc_container_holder a.uc_portfolio{
	background:#4a4547;
	border-radius: 40px;
    color: #ffffff;
    display: inline-block;
    font-size: 16px;
    font-weight: 700;
    line-height: 52px;
    padding: 9px 65px;
    position: relative;
    text-align: center;
	text-transform:uppercase;
	text-decoration:none;
	letter-spacing:3px;
	box-shadow:6px 6px 20px rgba(51,51,51,0.3);
}


.hero6 .uc_play {
    left: 0;
    position: absolute;
    text-align: center;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    z-index: 101;
}
.hero6 .uc_play img {
    width: auto;
}

@media only screen and (max-width: 1500px) {
	.hero6 .uc_container_holder h1{ margin-bottom:60px; font-size:14px; letter-spacing:6px;}
	.hero6 .uc_container_holder h2{ font-size:42px; line-height:66px;}
	.hero6 .uc_container_holder h3{ margin-bottom:70px;}
}
@media only screen and (max-width: 1199px) {
	.hero6 .uc_container_holder h1{ margin-bottom:60px; font-size:14px;}
	.hero6 .uc_container_holder h2{ font-size:33px; line-height:48px;}
	.hero6 .uc_container_holder h3{ margin-bottom:70px; font-size:18px;}
	.hero6 .uc_container_holder a.uc_portfolio{ font-size:16px; padding:9px 65px;}
}
@media only screen and (max-width: 991px) {
	
	.hero6 .uc_container_holder h1 { font-size: 10px; letter-spacing: 5px; margin-bottom: 30px;}
	.hero6 .uc_container_holder h2{ font-size:24px; line-height:38px;}
	.hero6 .uc_container_holder h3{ margin-bottom:40px; font-size:16px;}
	.hero6 .uc_container_holder a.uc_portfolio { font-size: 12px; padding: 0 50px;}
}
@media only screen and (max-width: 767px) {
	.hero6 .uc_container_holder h2 { font-size: 19px; line-height: 30px;}
	.hero6 .uc_container_holder a.uc_portfolio { font-size: 11px; line-height: 42px; padding: 0 40px;}
}
@media only screen and (max-width: 639px) {
	.hero6 .uc_container_holder h2 { font-size: 15px; line-height: 23px;}
	.hero6 .uc_container_holder h1 { font-size: 8px; letter-spacing: 2px; margin-bottom: 20px;}
	.hero6 .uc_container_holder h3{ font-size:13px; margin-bottom:26px;}
	.hero6 .uc_container_holder a.uc_portfolio { font-size: 10px; line-height: 36px; padding: 0 24px;}
}
@media only screen and (max-width: 479px) {
	.hero6 .uc_container_holder h2{ font-size:11px; line-height:18px;}
	.hero6 .uc_container_holder h1 { font-size: 7px; letter-spacing: 1px; margin-bottom: 10px;}
	.hero6 .uc_container_holder h3 { font-size: 10px; margin-bottom: 10px;}
	.hero6 .uc_container_holder a.uc_portfolio { font-size: 7px; line-height: 26px; padding: 0 15px;}
}
@media only screen and (max-width: 359px) {
	.hero6 .uc_container_holder h2 { font-size: 10px; line-height: 16px; margin-bottom: 7px;}
	.hero6 .uc_container_holder h1 { letter-spacing: 0px;}
}
</style>
<div class="hero6 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
   <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero6.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
    
    <div class="uc_container_holder">
    	<h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>MAKE SOMETHING beautiful<?php } ?></h1>
        <h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>Look deep into nature, and then you will understand everything better.<?php } ?></h2>
        <h3><?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>Albert Einstein<?php } ?></h3>
         
         <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_portfolio">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
         </a> 
        
    </div>
  
  	<div class="uc_play">
        <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>">
          <img src="https://premiumpress.com/_demoimages/elementor/_hero/play-btn.png" alt="learn more">
        </a>
    </div>
</div>