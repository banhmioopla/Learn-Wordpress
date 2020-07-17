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

.hero8 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.hero8{
	position:relative;
	overflow:hidden;
	clear:both;
	background:#f1f1f1;
}
.hero8 .uc_container_left{
	float:left;
	width:50%;
}
.hero8 .uc_container_left .uc_container_holder{
	 
    font-weight: 400;
    left: 8%;
    position: absolute;
    text-align: center;
    top: 50%;
    transform: translateY(-50%);
    width: 34%;
    z-index: 101;
}
 
.hero8 .uc_container_left .uc_container_holder h1{
	font-size: 13px;
    font-weight: 700;
    letter-spacing: 5px;
    margin: 0 0 18px;
    text-transform: uppercase;
	color:#212127;
}
.hero8 .uc_container_left .uc_container_holder h2{
	font-size:68px;
	margin-bottom:23px;
	font-weight:700;
	line-height:71px;
	color:#212127;
	letter-spacing:-4px;
	padding-bottom:26px;
	position:relative;
}
.hero8 .uc_container_left .uc_container_holder h2::after, 
.hero8 .uc_container_left .uc_container_holder h2::before{
	background: #000;
	content: "";
	display: block;
	height: 2px;
	position: absolute;
	bottom: 0%;
	left:48%;
	width: 6%;
}
.hero8 .uc_container_left .uc_container_holder .uc_paragraph{
	color: #212127;
 
    font-size: 18px;
    font-weight: 400;
    line-height: 29px;
    margin: 0 auto 47px;
    max-width: 69%;
    opacity: 0.7;
}
.hero8 .uc_container_left .uc_container_holder a.uc_portfolio{
	background:#f1f1f1;
	border-radius: 40px;
    color: #212127;
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
	border:1px solid #212127;
}
.hero8 .uc_container_left .uc_container_holder a.uc_portfolio:hover{
	border-radius: 40px;
}
.hero8 .uc_container_right{
	float:right;
	width:50%;
	position:relative;
}
.hero8 .uc_container_right img{
	width:100%;
	height:auto;
}

@media only screen and (max-width: 1240px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:62px;}
}
@media only screen and (max-width: 1100px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:58px;}
}
@media only screen and (max-width: 1024px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:57px; line-height:60px; max-width:inherit;}
}
@media only screen and (max-width: 980px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:64px; line-height:normal;}
	.hero8 .uc_container_left .uc_container_holder .uc_paragraph{ font-size:14px; line-height:24px; margin-bottom:22px; max-width: inherit;}
	.hero8 .uc_container_left .uc_container_holder a.uc_portfolio{ line-height:40px; padding:4px 30px;}
	 
}
@media only screen and (max-width: 780px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:32px; max-width: inherit; line-height:normal; letter-spacing:-3px;}
	 
}
@media only screen and (max-width: 680px) {
	.hero8 .uc_container_left .uc_container_holder h1{ letter-spacing:4px;}
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:22px; max-width: inherit; line-height:normal; letter-spacing:-1px; padding-bottom:10px; margin-bottom:10px;}
	.hero8 .uc_container_left .uc_container_holder .uc_paragraph{ line-height:normal; margin-bottom:20px; }
	.hero8 .uc_container_right .uc_play img { width: 30%;}
	.hero8 .uc_container_left .uc_container_holder{ width:44%; left:3%;}
}
@media only screen and (max-width: 580px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:18px;}
	.hero8 .uc_container_left .uc_container_holder a.uc_portfolio { font-size: 9px; line-height: 33px; padding: 0 20px;}
	.hero8 .uc_container_left .uc_container_holder .uc_paragraph{ font-size:12px;}
}
@media only screen and (max-width: 480px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:32px; max-width: inherit; letter-spacing:-1px; line-height:normal;}
	.hero8 .uc_container_right, .hero8 .uc_container_left{ width:100%; float:none;}
	.hero8 .uc_container_left .uc_container_holder { position: relative; top:20px; width: 100%; transform:none; left:0; padding:0 5%;}
	.hero8 .uc_container_right{ margin-bottom:10px;}
	.hero8 .uc_container_left .uc_container_holder a.uc_portfolio{ margin-bottom:50px;}
	uc_container_left{ margin:40px 0;}
}
@media only screen and (max-width: 360px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:28px; max-width: inherit; letter-spacing:-1px; line-height:normal;}
}
@media only screen and (max-width: 320px) {
	.hero8 .uc_container_left .uc_container_holder h2{ font-size:24px; max-width: inherit; letter-spacing:-1px; line-height:normal;}
} 
</style>
<div class="hero8 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
    <div class="uc_container_right">
    	<img src="<?php if(strlen($settings['img1']) > 0){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero8.jpg<?php } ?>" alt="<?php echo $settings['img1_txt1']; ?>">
    </div>
    
    <div class="uc_container_left">
        <div class="uc_container_holder">
        	 
            <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>TAKING CARE OF YOURSELF<?php } ?></h1>
            <h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>Business<?php } ?></h2>
            <div class="uc_paragraph"><?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
            
              <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_portfolio">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
                 </a>  
                 
        </div>
    </div>
</div>