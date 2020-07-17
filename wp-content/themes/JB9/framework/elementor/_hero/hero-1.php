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

.hero1 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}

.hero1{
	position:relative;
	width:100%;
	overflow:hidden;
}
	
.hero1 img{
	width:100%;
	display: block;
}

.hero1 .bg_slice::before{   
	content: "";
    height: 100%;
    left: -13%;
    position: absolute;
    top: 0;
    transform: skewX(-20deg);
    width: 61%;
}
.hero1 .uc_container_text_box{ 
	padding:0 0 0 8%;
	position:absolute;	
	top:50%;
	left: 0%;
	width: 50%;
	-webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
	transform: translateY(-50%);}

 
.hero1 .uc_container_text_box h1{
	font-size:70px;
	font-weight:bold;
	color:#ffffff;	
	line-height: 90px;
	position:relative;
}
 
.hero1 .uc_paragraph{

	font-size:32px;
	color:#ffffff;
	font-weight:300;
	margin-top:50px;
	line-height: 44px;
	width: 71%;
}

.hero1 .uc_container_text_box a{
	font-size:22px;
	 
	font-weight:400;
	color:#ff2a75;
	padding:27px 52px;
	text-decoration:none;
	display:inline-block;
	text-transform:uppercase;
	letter-spacing:2px;
	margin-top:50px;
	border-radius: 43px;
}



@media screen and (min-width: 1025px) and (max-width: 1300px) {
	.hero1 .uc_paragraph{ line-height:normal;font-size: 20px;margin-top: 75px;}
	.hero1 .uc_container_text_box h1::after{bottom: -50px;}
	.hero1 .uc_container_text_box p{margin-top: 64px;}
	.hero1 .uc_container_text_box a { margin-top: 20px;}
}
@media screen and (min-width: 890px) and (max-width: 1024px) {
	.hero1 .uc_paragraph{ line-height:normal;font-size: 20px;}
	.hero1 .uc_container_text_box a { margin-top: 22px; padding:12px 28px;font-size: 14px;}
	.hero1 .uc_container_text_box h1{ line-height:normal;}
}
@media screen and (min-width: 657px) and (max-width: 889px) {
	
	 
	.hero1 .uc_paragraph{ line-height:normal;font-size: 20px;}
	.hero1 .uc_container_text_box a { margin-top: 22px; padding:12px 28px;font-size: 14px;}
	.hero1 .uc_container_text_box h1{ line-height:normal;}
	.hero1 .uc_paragraph{ margin-top: 74px;}
	
}

@media screen and (min-width: 481px) and (max-width: 656px) {
	
	.hero1 .uc_container_text_box { padding: 0 0 0 3%;}
	.hero1 .uc_container_text_box h1::after { display:none;}
	.hero1 .uc_paragraph{ line-height:normal;font-size: 18px;}
	.hero1 .uc_container_text_box a { margin-top: 22px; padding:12px 28px;font-size: 14px;}
	.hero1 .uc_container_text_box h1{ line-height:normal;}
	.hero1 .uc_paragraph{ margin-top: 24px;}
	
}
@media screen and (min-width: 320px) and (max-width: 480px) {
	
	.hero1 .bg_slice::before{ width:65%;}
	.hero1 .uc_container_text_box { padding: 0 0 0 3%;width: 53%;}
	.hero1 .uc_container_text_box h1::after { display:none;}
	.hero1 .uc_paragraph{ line-height:normal;font-size: 16px;  margin-top: 4px; width: 95%;}
	.hero1 .uc_container_text_box a {  font-size: 12px; margin-top: 9px; padding: 9px 15px;}
	.hero1 .uc_container_text_box h1{ line-height:normal;}
}
@media only screen and (max-width: 320px) {
	.hero1 .uc_paragraph {
    font-size: 12px;
	}
}
	
.hero1 .bg_slice::before {
    background: #324d79;
}
</style>
 
<div class="hero1 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    	     
    <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero1.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>">
    <div class="bg_slice">
   <div class="uc_container_text_box">
            <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>TITLE HERE<?php } ?></h1>
        <div class="uc_paragraph">
        	<?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
            Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. 
            <?php } ?>
        </div>
        
         <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="btn-primary text-white">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
                 </a> 
                 
        </div>
     </div>      
</div>