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

.hero23 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}
.hero23 .uc_container_holder
{
	position:relative;
	width:100%;

}

.hero23 .uc_container_holder img
{
	width:100%;
}
.hero23 a.uc_play_btn img
{
	width:auto;
}

.hero23 .uc_social_media
{
	width:57px;
	position:absolute;
	top:72px;
	right:70px;
}

.hero23 .uc_social_media a
{
	display:block;
	width:53px;
	height:53px;
	font-size:27px;
	text-align:center;
	text-decoration:none;
	line-height:53px;
	color:#212829;
	border:#212829 2px solid;
	transition:all 0.3s ease-in-out;
	-moz-transition:all 0.3s ease-in-out;
	-webkit-transition:all 0.3s ease-in-out;
	-ms-transition:all 0.3s ease-in-out;
}
.hero23 .uc_social_media a:first-child
{
	border-bottom:0px;
}

.hero23 .uc_social_media a:hover
{
	color:#555555;
}

.hero23 .uc_caption
{
	font-family:"Georgia", serif;
	font-style:italic;
	position:absolute;
	font-size:24px;
	line-height:32px;
	color:#8a8e90;
	left:14%;
	top:46%;
	transform:translateY(-50%);
	overflow:hidden;
}

.hero23 .uc_caption .uc_sub_title
{
	margin:0 0 47px 0;
	max-width:53%;
}
.hero23 .uc_caption h2
{
	font-family: 'Lobster', cursive;
	font-style:normal;
	padding:0 0 46px 0;
	margin:0 0 50px 0;
	font-size:87px;
	line-height:104px;
	font-weight:400;
	color:#212829;
	text-shadow:#d9d9d9 5px 8px 0px;
	position:relative;
	max-width:236px;
}

.hero23 .uc_caption h2:after
{
	position:absolute;
	width:93px;
	border:#ffb834 2px solid;
	display:block;
	left:0;
	bottom:0px;
	content:'';
}
.hero23 a.uc_traveling_btn
{
	font-family: 'Montserrat', sans-serif;
	padding:0 34px;
	margin:0 0 10px 0;
	line-height:77px;
	font-size:21px;
	color:#ffffff;
	transition:all 0.3s ease-in-out;
	text-align:center;
	box-shadow:#d9d9d9 5px 9px 0px;
	display:block;
	text-decoration:none;
	font-style:normal;
	float:left;
}

.hero23 a.uc_play_btn
{
	position:absolute;
	left:52%;
	width:173px;
	margin-left:-110px;
	z-index:99;
	top:43%;
	transform:translateY(-50%)
}

.hero23 a.uc_play_btn img
{
	width:100%;
}



@media only screen and (max-width: 1300px)
{
	.hero23 a.uc_play_btn{ width:146px; top:48%;}
}

@media only screen and (min-width: 900px) and (max-width: 1200px)
{
	.hero23 .uc_caption h2{ font-size:62px; line-height:80px; padding:0 0 30px 0; margin:0 0 30px 0;}
	.hero23 a.uc_play_btn{ left:50%; top:48%; width:118px; margin-left:-59px;}
	.hero23 .uc_caption{ left:8%; font-size:20px; line-height:25px;}
	.hero23 a.uc_traveling_btn{ font-size:17px; line-height:62px;}
}

@media only screen and (max-width: 899px)
{

	.hero23 .uc_social_media a{ width:44px; height:44px; font-size:20px; line-height:44px;}
	.hero23 .uc_caption{ left:8%;}
	.hero23 .uc_caption h2{ font-size:44px; line-height:60px; margin:0 0 20px 0; padding:0 0 20px 0;}
	.hero23 .uc_caption h2::after{ border:#ffb834 1px solid; width:67px;}
	.hero23 .uc_caption{ font-size:18px; line-height:22px;}
	.hero23 a.uc_traveling_btn{ font-size:14px;  line-height:50px; padding:0 20px;}
	.hero23 .uc_caption p{ margin:0 0 26px 0;}
	.hero23 a.uc_play_btn{ width:92px; left:58%; top:56%;}
	.hero23 .uc_caption{ font-size:14px; line-height:20px;}
}

@media only screen and (max-width: 700px)
{

	.hero23 .uc_social_media a{ width:36px; height:36px; font-size:17px; line-height:36px;}
	.hero23 .uc_caption{ left:8%;}
	.hero23 .uc_caption h2{ font-size:30px; line-height:44px; margin:0 0 13px 0; padding:0 0 13px 0;}
	.hero23 .uc_caption h2::after{ border:#ffb834 1px solid; width:67px;}
	.hero23 .uc_caption{ font-size:18px; line-height:22px;}
	.hero23 a.uc_traveling_btn{ font-size:11px;  line-height:41px; padding:0 15px; box-shadow:3px 6px 0 #d9d9d9;}
	.hero23 .uc_caption p{ margin:0 0 14px 0;}
	.hero23 a.uc_play_btn{ width:70px; left:69%; top:48%;}
	.hero23 .uc_caption{ font-size:14px; line-height:20px;}
	.hero23 .uc_social_media{ right:35px; top:38px; width:37px;}
	.hero23 .uc_caption .uc_sub_title{ margin-bottom:20px;}
}

@media only screen and (max-width: 540px)
{
	.hero23 .uc_caption .uc_sub_title{ max-width:40%; margin-bottom:11px;} 
	
}

@media only screen and (max-width: 440px)
{
	.hero23 .uc_social_media a{ width:30px; height:30px; font-size:14px; line-height:30px;}
	.hero23 .uc_caption{ left:8%;}
	.hero23 .uc_caption h2{ font-size:20px; line-height:27px; margin:0 0 10px 0; padding:0 0 10px 0;}
	.hero23 .uc_caption h2::after{ border:#ffb834 1px solid; width:30px;}
	.hero23 .uc_caption{ font-size:18px; line-height:22px;}
	.hero23 a.uc_traveling_btn{ font-size:8px;  line-height:34px; padding:0 15px; box-shadow:2px 3px 0 #d9d9d9;}
	.hero23 .uc_caption p{ margin:0 0 14px 0;}
	.hero23 a.uc_play_btn{ width:70px; left:50%; margin-left:-35px; top:48%;}
	.hero23 .uc_caption{ font-size:9px; line-height:13px;}
	.hero23 .uc_social_media{ right:18px; top:18px; width:30px;}
}

@media only screen and (max-width: 360px)
{
	.hero23 .uc_caption .uc_sub_title{ max-width:34%; margin-bottom:11px;} 
}
.hero23 a.uc_traveling_btn {
    background-color: #212829;
}
</style>
<div class="hero23">
       
    	<div class="uc_container_holder">
        	
            <a class="uc_play_btn" href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; } ?>"><img src="https://premiumpress.com/_demoimages/elementor/_hero/uc_play_btn.png" alt=""></a>
            
            
            
        	<div class="uc_caption">
                <h2><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>Awesome title here<?php } ?></h2>
                <div class="uc_sub_title"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
			 
                
                <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_traveling_btn">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>LEARN MORE<?php } ?>
        </a> 
                
            </div>
    	    <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero23.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
    
        </div>
   
    </div>