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
 
.hero13 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
 
}
.hero13{
	position:relative;
	overflow:hidden;
}
.hero13 img{
	width:100%;
	height:auto;
}
.hero13 .uc_container_holder{
	max-width:84%;
	text-align:left;
	position:absolute;
	left:8%;
	top:45%;
	transform:translateY(-50%);
	-webkit-transform:translateY(-50%);
	-moz-transform:translateY(-50%);
	z-index:101;
	
	
	color:#ffffff;
	font-weight:400;
}


.hero13 .uc_container_holder_top{
	max-width:84%;
	text-align:left;
	position:absolute;
	left:8%;
	top:5%;
}


.hero13 .uc_container_holder h1{
	font-size:52px;
	margin-bottom:30px;
	font-weight:700;
	line-height:86px;
}
.hero13 .uc_container_holder .uc_cont_paragrapgh{
	font-size:23px;
	margin-bottom:60px;
	color:#FFF;
	font-weight:400;
	opacity:0.7;
	font-family:Georgia;
	line-height:32px;
	max-width:60%;
}
.hero13 .uc_container_holder a.uc_portfolio{
 
	border-radius: 40px;
    
    display: inline-block;
    font-size: 13px;
    font-weight: 700;
    line-height: 44px;
    padding: 6px 60px;
    position: relative;
    text-align: center;
	text-transform:uppercase;
	text-decoration:none;
	letter-spacing:3px;
	box-shadow:6px 6px 20px rgba(51,51,51,0.3);
}


.hero13 .uc_container_holder_bottom{
	width:84%;
	text-align:left;
	position:absolute;
	left:8%;
	bottom:10%;
}
.hero13 .uc_container_holder_bottom .uc_footer{
	border-top:1px solid #fff;
	padding-top:35px;
	color:#fff;
}
.hero13 .uc_container_holder_bottom .uc_footer .uc_footer_box{
	display:inline-block;
	width:26%;
	margin-right:10.5%;
	vertical-align:text-top;
}
.hero13 .uc_container_holder_bottom .uc_footer .uc_footer_box:last-child{ margin-right:0%;}
.hero13 .uc_container_holder_bottom .uc_footer .uc_footer_box strong{
	text-transform:uppercase;
	font-size:14px;
	color:#fff;
	font-weight:600;
	margin-bottom:10px;
	display:block;
}
.hero13 .uc_container_holder_bottom .uc_footer .uc_footer_box .uc_paragraph{
	color: #fff;
    font-family: Georgia;
    font-size: 16px;
    font-weight: 400;
    line-height: 24px;
	opacity:0.7;
	
}

@media only screen and (max-width: 1170px) {
	.hero13 .uc_container_holder a.uc_portfolio{ margin-bottom:50px;}
	.hero13 .uc_container_holder h1{ font-size:46px; line-height:normal; margin-bottom:20px;}
	.hero13 .uc_container_holder cont_paragrapgh{ font-size:20px; margin-bottom:30px;}
	.hero13 .uc_container_holder .uc_cont_paragrapgh{ max-width:80%;}
}
@media only screen and (max-width: 1040px) {
	.hero13 .uc_container_holder_bottom .uc_footer .uc_footer_box { margin-right: 5%; width: 29.5%;}
	.hero13 .uc_container_holder h1{ margin-bottom:10px;}
}
@media only screen and (max-width: 980px) {
	.hero13 .uc_container_holder_bottom .uc_footer .uc_footer_box { margin-right: 1%; width: 32%;}
	.hero13 .uc_container_holder_bottom .uc_footer .uc_footer_box .uc_paragraph{ font-size:13px;}
	.hero13 .uc_container_holder .uc_cont_paragrapgh{ max-width:100%; font-size:20px; margin-bottom:20px;}
}
@media only screen and (max-width: 890px) {
	.hero13 .uc_container_holder cont_paragrapgh { font-size: 16px; line-height: 24px; margin-bottom: 20px;}
	.hero13 .uc_container_holder_bottom .uc_footer .uc_footer_box .uc_paragraph{ line-height:18px;}
	.hero13 .uc_container_holder a.uc_portfolio{ padding:2px 35px; line-height:34px;}
}
@media only screen and (max-width: 768px) {
	.hero13 .uc_container_holder h1{ font-size:38px;}
	.hero13 .uc_container_holder .uc_cont_paragrapgh{ font-size:18px; margin-bottom:20px;}
}
@media only screen and (max-width: 740px) {
	.hero13 .uc_container_holder_bottom .uc_footer{ display:none;}
	.hero13 .uc_container_holder a.uc_portfolio{ margin-bottom:0;}
	.hero13 .uc_container_holder{ top:50%;}
	.hero13 .uc_container_holder h1{ margin-top:10%;}
	.hero13 .uc_container_holder a.uc_portfolio{ letter-spacing:1px;}
}
@media only screen and (max-width: 490px) {
	.hero13 .uc_container_holder a.uc_portfolio{ font-size:11px; padding:0 30px; line-height:32px;}
	.hero13 .uc_container_holder cont_paragrapgh{ line-height:18px;}
	.hero13 .uc_container_holder h1{ font-size:32px;}
	.hero13 .uc_container_holder .uc_cont_paragrapgh {
		font-size: 15px;
		line-height: normal;
		margin-bottom: 15px;
	}
}
@media only screen and (max-width: 380px) {
	.hero13 .uc_container_holder h1{ font-size:25px; margin-top:15%;}
	.hero13 .uc_container_holder a.uc_portfolio {
		font-size: 9px;
		line-height: normal;
		padding: 6px 20px;
	}
	.hero13 .uc_container_holder .uc_cont_paragrapgh {
		font-size: 14px;
		line-height: normal;
		margin-bottom: 10px;
	}
	
} 
</style>
<div class="hero13 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">

       <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero13.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
   
    <div class="uc_container_holder">
        <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>Awesome title here.<?php } ?></h1>
        <div class="uc_cont_paragrapgh"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
         
        <a href="<?php if(isset($settings['img1_txt1']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_portfolio btn-primary mb-5">
				 <?php if(isset($settings['img1_txt1']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
                 </a>  
                 
    </div>
    
    <div class="uc_container_holder_bottom">
        <div class="uc_footer">
            <div class="uc_footer_box">
                <strong><?php if(isset($settings['img1_txt1']) && $settings['img2_txt1'] != ""){ echo $settings['img2_txt1']; }else{ ?>Your Title Here<?php } ?></strong>
                <div class="uc_paragraph">
                   <?php if(isset($settings['img1_txt1']) && $settings['img2_txt2'] != ""){ echo $settings['img2_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra.
        <?php } ?>
                </div>
            </div>
            <div class="uc_footer_box">
                <strong><?php if(isset($settings['img1_txt1']) && $settings['img3_txt1'] != ""){ echo $settings['img3_txt1']; }else{ ?>Your Title Here<?php } ?></strong>
                <div class="uc_paragraph">
                     <?php if(isset($settings['img1_txt1']) && $settings['img3_txt2'] != ""){ echo $settings['img3_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra.
        <?php } ?>
                </div>
            </div>
            <div class="uc_footer_box">
                <strong><?php if(isset($settings['img1_txt1']) && $settings['img4_txt1'] != ""){ echo $settings['img4_txt1']; }else{ ?>Your Title Here<?php } ?></strong>
                <div class="uc_paragraph">
                     <?php if(isset($settings['img1_txt1']) && $settings['img4_txt2'] != ""){ echo $settings['img4_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra.
        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>