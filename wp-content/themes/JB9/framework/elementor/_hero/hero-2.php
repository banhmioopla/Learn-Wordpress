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
 
.hero2 .hccontainer_holder
{
	position:relative;
 
}
.hero2 .hccontainer_holder img
{
	width:100%;
}

.hero2 .hccaption
{ 
	font-size:32px;
	line-height:46px;
	color:#ffffff;
	font-weight:300;
	position:absolute;
	left:15%;
	transform:translateX(-50%);
	top:65%;
	transform:translateY(-50%);
}

.hero2 .hccaption h1
{
	font-size:66px;
	line-height:72px;
	font-weight:700;
	margin:0 0 22px 0;
	
}

.hero2 .hccaption .hcdescription
{
	margin-bottom:46px;
	max-width:437px;
}

.hero2 .hccaption .hclogo img
{
	margin:0 0 80px 0;
	width:auto;
}

.hero2 .hccaption a.hclisten_btn
{
	color:#ffffff;
	padding:29px 44px;
	text-decoration:none;
	display:block;
	float:left;
	font-size:20px;
	line-height:20px;
	font-weight:600;
	letter-spacing:2px;
	transition:all 0.3s ease-in-out;
	-moz-transition:all 0.3s ease-in-out;
	-webkit-transition:all 0.3s ease-in-out;
	-ms-transition:all 0.3s ease-in-out;
	border-radius:128px;	
}



@media only screen and (min-width: 1200px) and (max-width: 1464px)
{
	.hero2 .hccaption{ top:40%;}
	.hero2 .hccaption .hclogo img{ margin-bottom:48px;}
	.hero2 .hccaption h1{ margin-bottom:7px;}
	.hero2 .hccaption p{ margin-bottom:25px;}
}

@media only screen and (min-width: 900px) and (max-width: 1199px)
{
	 
	.hero2 .hccaption .hclogo img{ margin-bottom:5%; width:21%;}
	.hero2 .hccaption h1{ font-size:44px; line-height:50px;}
	.hero2 .hccaption{ font-size:25px; line-height:32px; top:48%;}
	.hero2 .hccaption a.hclisten_btn{ font-size:16px;  padding: 17px 26px;}
	.hero2 .hccaption p{ margin-bottom:30px;}
	.hero2 .hccaption .hcdescription{ max-width:344px;}
}

@media only screen and (min-width: 768px) and (max-width: 899px)
{
	 
	.hero2 .hccaption .hclogo img{ margin-bottom:5%; width:18%;}
	.hero2 .hccaption h1{ font-size:38px; line-height:40px;}
	.hero2 .hccaption{ font-size:22px; line-height:26px; top:48%;}
	.hero2 .hccaption a.hclisten_btn{ font-size:13px;  padding: 12px 26px;}
	.hero2 .hccaption p{ margin-bottom:30px;}
	.hero2 .hccaption .hcdescription{ max-width:296px;}
}

@media only screen and (min-width: 590px) and (max-width: 767px)
{
	 
	.hero2 .hccaption .hclogo img{ margin-bottom:5%; width:18%;}
	.hero2 .hccaption h1{ font-size:38px; line-height:40px;}
	.hero2 .hccaption{ font-size:22px; line-height:26px; top:41%;}
	.hero2 .hccaption a.hclisten_btn{ font-size:13px;  padding: 12px 26px;}
	.hero2 .hccaption .hcdescription{ max-width:296px; font-size:21px; margin-bottom:20px;}
}

@media only screen and (min-width: 416px) and (max-width: 589px)
{
	 
	.hero2 .hccaption .hclogo img{ margin-bottom:5%; width:31%;}
	.hero2 .hccaption h1{ font-size:23px; line-height:38px; margin-bottom:7px;}
	.hero2 .hccaption{ font-size:13px; line-height:16px; top:45%;}
	.hero2 .hccaption a.hclisten_btn{ font-size:13px;  padding: 8px 19px;}
	.hero2 .hccaption p{ margin-bottom:9px;}
	.hero2 .hccaption .hcdescription{ max-width:205px; font-size:14px; margin-bottom:20px;}
}

@media only screen and (min-width: 416px) and (max-width: 480px)
{
	.hero2 .hccaption .hclogo img{ margin-bottom:5%; width:22%;}
	.hero2 .hccaption{ top:36%;}
	.hero2 .hccaption .hcdescription{ margin-bottom:20px;}
}

@media only screen and (min-width: 320px) and (max-width: 415px)
{
	 
	.hero2 .hccaption .hclogo img{ margin-bottom:2%; width:14%;}
	.hero2 .hccaption h1{ font-size:19px; line-height:19px; margin-bottom:7px;}
	.hero2 .hccaption{ font-size:13px; line-height:16px; top:21%;}
	.hero2 .hccaption a.hclisten_btn{ font-size:13px;  padding: 8px 19px;}
	.hero2 .hccaption p{ margin-bottom:9px;}
	.hero2 .hccaption .hcdescription{ margin-bottom:14px; max-width:179px;}
}
</style>
<div class="hero2 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
    	<div class="hccontainer_holder">
        	<div class="hccaption">
            	 
                <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>TITLE HERE<?php } ?></h1>
                <div class="hcdescription"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. 
            <?php } ?></div>
				  
                <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="hclisten_btn bg-primary">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
                 </a> 
            </div>
    		<img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero2.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>">
        </div>
</div>  