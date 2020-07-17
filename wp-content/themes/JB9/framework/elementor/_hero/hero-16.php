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
.hero16{
	position:relative;
	width:100%;
}
.hero16:before{
	background:rgba(0, 0, 0, 0.8);
	content:"";
	width:50%;
	height:100%;
	left:0px;
	top:0px;
	position:absolute;
}
	
.hero16 img{
	width:100%;
	display: block;
}

.hero16 .text_box{ 
	padding:0%;
	position:absolute;	
	top:50%;
	left: 10%;
	width: 33%;
	-webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
	transform: translateY(-50%);
}

.uc_top-text{
	 font-size: 12px;
	 letter-spacing:6px;
	 font-weight:700;
	 color:#ffffff;
	  margin: 0 0 20px;
}
.hero16 .text_box h1{
	font-size:3.5vw;
	font-weight:300;
	color:#ffffff;	
	line-height: 66px;
}
.hero16 .uc_paragraph{
	font-size:18px;
	color:#ffffff;
	font-weight:400;
	margin-top:20px;
	line-height: 28px;
}

.hero16 .text_box a{
	font-size:12px;
	border:1px solid #ffffff;
	font-weight:700;
	color:#ffffff;
	padding:18px 57px;
	text-decoration:none;
	display:inline-block;
	margin-top:35px;
	border-radius: 43px;
}


@media only screen and (max-width:1300px) {
	.hero16 .text_box a { margin-top: 20px;}
}
@media only screen and (max-width: 1024px) {
	.hero16 .uc_paragraph{font-size: 14px;margin-top: 4px;line-height: 20px;}
	.hero16 .text_box a { margin-top: 14px; padding:12px 28px;font-size: 14px;}
	.hero16 .text_box h1{ line-height:normal;}
}
@media only screen and (max-width: 800px) {	
	.hero16 .text_box h1{ line-height:normal;}
	.hero16 .text_box {  left: 15px;  width: 42%;}
	.hero16 .text_box a { margin-top: 10px; font-size: 10px; padding: 5px 14px;}
	
}
	
@media only screen and (max-width: 768px) {	

	.hero16 .uc_socila_icon { right: 15px; }
}
@media only screen and (max-width: 640px) {	

	.hero16 .uc_paragraph { font-size: 15px;}
	.hero16 .uc_paragraph{ display:none;}
	.hero16 .uc_top-text {font-size: 10px;letter-spacing: 4px;}
	.hero16::before{ width:59%;}
	.hero16 .text_box h1{ letter-spacing: 5px;  font-size: 5.5vw;}
	.hero16 .uc_top-text{  margin: 0 0 5px;}

}
@media only screen and (max-width: 360px) {	
	.uc_top-text {font-size: 9px;}
	.hero16::before{ width:59%;}
	.hero16 .text_box a {  font-size: 8px;}

}
</style>
<div class="hero16 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    	      
    
     
      <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero16.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
   
    
    
    <div class="text_box">
        <?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ ?><div class="uc_top-text"><?php echo $settings['img1_txt3']; ?></div><?php } ?>
        <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></h1>
        <div class="uc_paragraph">
        <?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
          
        <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_portfolio mb-5">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Search Website<?php } ?>
        </a> 
        
    </div>      
</div>