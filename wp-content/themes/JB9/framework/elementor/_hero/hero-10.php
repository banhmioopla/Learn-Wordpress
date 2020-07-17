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

.hero10 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.hero10{
	position:relative;
	overflow:hidden;
}
.hero10 img{
	width:100%;
	height:auto;
}
.hero10 .uc_container_holder{
	max-width:52%;
	text-align:left;
	position:absolute;
	left:10%;
	top:50%;
	transform:translateY(-50%);
	-webkit-transform:translateY(-50%);
	-moz-transform:translateY(-50%);
	z-index:101;
}
.hero10 .uc_container_holder h1{
	font-family: 'Lato', sans-serif;
	font-size:26px;
	color:#a53731;
	font-weight:700;
	margin:0 0 50px;
}
.hero10 .uc_container_holder h2{
	font-family: 'Roboto Slab', serif;
	font-size:67px;
	color:#fff;
	font-weight:300;
	margin-bottom:40px;
}
.hero10 .uc_container_holder a.uc_portfolio{
	border-radius: 40px;
    color: #fb5a41;
    display: block;
    font-family: "Lato",sans-serif;
    font-size: 21px;
    font-weight: 700;
    line-height: 52px;
    padding: 15px 0;
    position: relative;
    text-align: center;
    width: 233px;
	text-transform:uppercase;
	text-decoration:none;
	margin-bottom:200px;
	box-shadow:6px 6px 20px rgba(51,51,51,0.3);
}
.hero10 .uc_container_holder .uc_social{
	width:100%;
	text-align:left;
}

.hero10 .uc_container_holder .uc_social a{
	display:inline-block;
	width:60px;
	height:60px;
	margin:0px 6px;
	
	font-size:24px;
	text-align:center;
	line-height:60px;
	color:#FFF;
	
	border:2px solid #ffffff;
	border-radius:50%;
	
	transition:all 0.3s ease 0s;
	-webkit-transition:all 0.3s ease 0s;
	
	opacity: 0;
    transform: translate(50%, 0%) matrix3d(0, 1, 0, 0, -1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
	-webkit-transform: translate(50%, 0%) matrix3d(0, 1, 0, 0, -1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);
    transform-origin: 50% 50% 0;
	-webkit-transform-origin: 50% 50% 0;
    transform-style: flat;
	-webkit-transform-style: flat;
    visibility: hidden;
	
	transition:all 0.3s ease 0s;
	-webkit-transition:all 0.3s ease 0s;
	
	}
	
.hero10 .uc_container_holder .uc_social a{
	visibility:inherit;
	opacity:1;
	transform: none;
	-webkit-transform: none;
	}	
	
.hero10 .uc_container_holder .uc_social a:hover{
	background:#ffffff;
	color:#212121;
	}	
	
.hero10 .uc_container_holder .uc_social a i{
	}


@media only screen and (max-width: 1500px) {
	.hero10 .uc_container_holder h2{ font-size:58px;}	
	.hero10 .uc_container_holder a.uc_portfolio{ margin-bottom:140px;}
}

@media only screen and (min-width: 992px) and (max-width: 1199px) {
	.hero10 .uc_container_holder h2{ font-size:48px;}
	.hero10 .uc_container_holder{ max-width:55%;}	
	.hero10 .uc_container_holder h1{ font-size:22px;}
	.hero10 .uc_container_holder a.uc_portfolio{ line-height:44px; margin-bottom:60px;}
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
	.hero10 .uc_container_holder h2{ font-size:36px;}	
	.hero10 .uc_container_holder h1{ font-size:18px; margin-bottom:30px;}
	.hero10 .uc_container_holder a.uc_portfolio{ line-height:28px; font-size:18px; width:190px; margin-bottom:50px;}
}

@media only screen and (max-width: 767px) {
	.hero10 .uc_container_holder h2{ font-size:29px;}	
	.hero10 .uc_container_holder h1{ font-size:18px; margin-bottom:38px;}
	.hero10 .uc_container_holder a.uc_portfolio{ line-height:24px; font-size:18px; width:180px; margin-bottom:22px;}
	.hero10 .uc_container_holder .uc_social a{ width:40px; height:40px; line-height:40px;}
}
@media only screen and (max-width: 639px) {
	.hero10 .uc_container_holder{ max-width:75%; left:4%;}
	.hero10 .uc_container_holder h2{ font-size:27px; margin-bottom:20px;}	
	.hero10 .uc_container_holder h1{ font-size:20px; margin-bottom:14px;}
	.hero10 .uc_container_holder a.uc_portfolio{ font-size: 13px; line-height: normal; padding: 15px 0; width: 140px;}
	.hero10 .uc_container_holder .uc_social a{ width:30px; height:30px; line-height:30px; font-size:16px;}
}
@media only screen and (max-width: 479px) {
	.hero10 .uc_container_holder{ max-width:80%; left:4%;}
	.hero10 .uc_container_holder h2{ font-size:19px; margin-bottom:14px;}	
	.hero10 .uc_container_holder h1{ font-size:14px; margin-bottom:7px;}
	.hero10 .uc_container_holder a.uc_portfolio{ font-size: 14px; line-height: normal; padding: 11px 0; width: 135px; margin-bottom:10px;}
}
@media only screen and (max-width: 359px) {
	.hero10 .uc_container_holder{ max-width:90%; left:4%;}
	.hero10 .uc_container_holder h2{ font-size:19px; margin-bottom:15px;}	
	.hero10 .uc_container_holder h1{ font-size:12px; margin-bottom:10px;}
	.hero10 .uc_container_holder a.uc_portfolio{ font-size: 12px; line-height: normal; padding: 7px 0; width: 130px;}
	.hero10 .uc_container_holder .uc_social a{ width:22px; height:22px; line-height:18px; font-size:12px;}
}
</style>
<div class="hero10 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
    <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero10.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
   
    <div class="uc_container_holder">
    	<h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></h1>
        <h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>Curabitur quis iaculis sem. <?php } ?></h2>
        
        <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_portfolio  bg-white">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
         </a>
    </div>
</div>