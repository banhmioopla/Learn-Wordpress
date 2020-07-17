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
.hero17 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}

.hero17{
	position:relative;
	width:100%;
}

.hero17 img{
	width:100%;
	display: block;
}

.hero17 .uc_container_text_box{ 
	 border: 10px solid #ffffff;
    left: 50%;
    margin-left: -482px;
    padding: 85px 0;
    position: absolute;
    text-align: center;
    top: 50%;
    transform: translateY(-50%);
    width: 964px;
	
}

.uc_top-text{
	 
	 font-size: 18px;
	 text-transform: uppercase;
	 letter-spacing:6px;
	 font-weight:400;
	 color:#ffffff;
	 opacity: 0.7;
}
.hero17 .uc_container_text_box h1{
	font-size:4vw;
 
	font-weight:300;
	color:#ffffff;	
	line-height: 74px;
	 letter-spacing:20px;
	 padding:30px 0;
 
	 width: 415px;
	 text-align: center;
	   margin: 0 auto;
}
.hero17 .uc_paragraph{
 
	font-size:18px;
	color:#ffffff;
	font-weight:400;
	margin: 40px auto;
    width: 300px;
	line-height: 28px;
}

.hero17 .uc_container_text_box a{
	font-size:13px;
 
	font-weight:700;
	color:#ffffff;
	padding:23px 55px;
	text-decoration:none;
	display:inline-block;
	text-transform:uppercase;
	letter-spacing:2px;
}


@media only screen and (max-width:1299px) {
	.hero17 .uc_container_text_box{padding: 35px 0;}
}
@media only screen and (max-width: 1024px) {
	.hero17 .uc_container_text_box{ width: 740px;margin-left: -370px;}
	.hero17 .uc_paragraph{font-size: 14px;margin-top: 4px;line-height: 20px;}
	.hero17 .uc_container_text_box a { margin-top: 14px; padding:12px 28px;font-size: 14px;}
	.hero17 .uc_container_text_box h1{ line-height:normal;}
}
@media only screen and (max-width: 800px) {	
	
	.hero17 .uc_container_text_box{ width: 70%;margin-left: -35%;padding: 15px 0;}
	.hero17 .uc_paragraph{margin: 4px auto;}
	.hero17 .uc_container_text_box a { margin-top: 14px; padding:12px 28px;font-size: 14px;}
	.hero17 .uc_container_text_box h1{ line-height:normal; padding: 4px 0;}
}
	
@media only screen and (max-width: 768px) {	

	.hero17 .uc_socila_icon { right: 15px; }
}
@media only screen and (max-width: 640px) {	
	.hero17 .uc_paragraph{ }
	.hero17 .uc_container_text_box { border: 5px solid #ffffff;}
	.uc_top-text {font-size: 10px;letter-spacing: 4px;}
	.hero17 .uc_container_text_box h1{ letter-spacing: 5px;  font-size: 5.5vw; width:100%;}
	.hero17 .uc_container_text_box a { font-size: 10px; padding: 10px 15px;}
	.hero17 .uc_container_text_box { border: none; padding:0px; width:100%; left: 0;margin-left: 0;}

}
@media only screen and (max-width: 360px) {	
	.uc_top-text {font-size: 9px;}
	.hero17 .uc_container_text_box a {  font-size: 8px; margin-top: 0;}
	.hero17 .uc_paragraph { font-size: 12px; width:100%;}
}
</style>
<div class="hero17 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    	
    <img src="<?php if(strlen($settings['img1']) > 0){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero17.jpg<?php } ?>" alt="<?php echo $settings['img1_txt1']; ?>">
    <div class="uc_container_text_box">
        <div class="uc_top-text"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>AWESOME TITLE<?php } ?></div>
        <h1><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>COMPANY NAME<?php } ?></h1>
        <div class="uc_paragraph">
        <?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend.
        <?php } ?>
        </div>
        <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="bg-white text-dark">
		<?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>SEARCH WEBSITE<?php } ?>
        </a>
    </div>      
</div>