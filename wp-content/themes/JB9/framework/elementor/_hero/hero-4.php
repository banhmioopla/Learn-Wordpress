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

.hero4 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.hero4{
	position:relative;
	overflow:hidden;
}
.hero4 img{
	width:100%;
	height:auto;
}
.hero4 .contentbox{
	width:100%;
	position:absolute;
	left:0%;
	top:50%;
	transform:translateY(-50%);
	-webkit-transform:translateY(-50%);
	-moz-transform:translateY(-50%);
	z-index:101;
	text-align:center;
 
	color:#fff;
	font-weight:400;
}
.hero4 .contentbox h1{
	font-size:108px;
	border:2px solid #fff;
	display:inline-block;
	line-height:108px;
	padding:15px 35px;
	margin-bottom:65px;
}
.hero4 .contentbox .maintext{
	font-size:39px;
	font-weight:300;
	line-height:60px;
	margin:0 auto 40px;
	max-width:630px;
}
.hero4 .contentbox a.cbtn{
	border-radius: 40px;
    display: inline-block;
    font-size: 18px;
    line-height: normal;
    padding: 16px 42px;
    position: relative;
    text-align: center;
	text-transform:uppercase;
	text-decoration:none;
	letter-spacing:1px;
}

@media only screen and (max-width: 991px) {
	.hero4 .contentbox h1{ font-size:72px; margin-bottom:30px; line-height:normal;}
	.hero4 .contentbox .maintext{ font-size:28px; margin-bottom:28px; line-height:normal; max-width:444px;}
	.hero4 .contentbox a.cbtn{ padding:12px 36px; font-size:16px;}
}
@media only screen and (max-width: 767px) {
	.hero4 .contentbox h1{ font-size:62px; margin-bottom:30px; line-height:normal;}
	.hero4 .contentbox .maintext{ font-size:24px; margin-bottom:28px; line-height:normal; max-width:380px;}
	.hero4 .contentbox a.cbtn{ padding:11px 30px; font-size:14px;}
}
@media only screen and (max-width: 639px) {
	.hero4 .contentbox h1{ font-size:44px; margin-bottom:20px; line-height:normal;}
	.hero4 .contentbox .maintext{ font-size:20px; margin-bottom:15px; line-height:normal; max-width:315px;}
	.hero4 .contentbox a.cbtn{ padding:11px 30px; font-size:14px;}
}
@media only screen and (max-width: 479px) {
	.hero4 .contentbox h1{ font-size:32px; margin-bottom:15px; line-height:normal; padding:8px 20px;}
	.hero4 .contentbox .maintext{ font-size:14px; margin-bottom:15px; line-height:normal; max-width:215px;}
	.hero4 .contentbox a.cbtn{ padding:7px 20px; font-size:11px;}
}
@media only screen and (max-width: 359px) {
	.hero4 .contentbox h1{ font-size:28px; margin-bottom:10px; line-height:normal; padding:5px 17px;}
	.hero4 .contentbox .maintext{ font-size:12px; margin-bottom:10px; line-height:normal; max-width:187px;}
	.hero4 .contentbox a.cbtn{ padding:6px 15px; font-size:9px;}
}
</style>
<div class="hero4 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
   <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero4.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
    <div class="contentbox">
    	<h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>TITLE HERE<?php } ?></h1>
        <div class="maintext">
        	<?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. 
            <?php } ?>
        </div>
       
       <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="cbtn btn-secondary" style="cursor:pointer;">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
                 </a> 
       
       
    </div>
</div>