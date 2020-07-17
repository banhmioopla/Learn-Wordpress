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
.hero22 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}
.hero22 {
	position:relative;
	
}

.hero22 .logo{    	
	position:absolute;
	left:0px; 
	top:0px;
}	
.hero22 .logo a{
	width:158px;	
	background:#f84a3c;
	padding:20px 35px;
	display: block;
}

.hero22 img{
	width:100%;
	display: block;
}
.hero22 .uc_container_inner{
	margin: 0 auto;
    padding: 0;
    width: 65%;
	text-align: center;
	}
.hero22 .uc_container_inner a{
	display:block;
	margin-bottom:80px;
	
}
.hero22 .uc_container_text_box{ 
	position:absolute; 
	bottom:9%;	 
	 left: 0%;
}


.hero22 .uc_container_text_box h1{
	font-size:42px;
 
	font-weight:300;
	color:#ffffff;	
	line-height: 49px;
	padding:0px;
	text-align:left;
}
.hero22 .uc_paragraph{
	 
	font-size:16px;
	color:#ffffff;
	font-weight:400;
	line-height: 27px;
	font-style:italic;
	width: 100%;
	margin: 35px 0 0;
	opacity: 0.7;	
	text-align: left;
}
.hero22 .uc_paragraph a{color:#f84a3c; display:inline-block;margin-bottom: 0;}

.hero22 h2{
	font-size:13px;
	 
	color:#ffffff;
	font-weight:700;
	 letter-spacing: 7px;
	 margin:0 0 25px 0;
	 text-transform:uppercase;
	 text-align:left;
}
.uc_software_header .start-btn {
	text-align:center;
}
.uc_software_header .uc_container_inner a{ display:inline-block;}
.hero22 .start-btn .fa-play{ padding:45px 53px; border:1px solid #ffffff; border-radius:50%; font-size:55px; color:#ffffff;}

@media only screen and (max-width:1300px) {
	.hero22 .start-btn .fa-play { font-size: 38px; padding: 28px 35px;}
	.hero22 .uc_container_inner a {margin-bottom: 30px;}	
		
}
@media only screen and (max-width:980px) {
.hero22 .uc_container_text_box h1 { line-height: normal; font-size:32px}


}
@media only screen and (max-width:800px) {
.hero22 .uc_container_text_box h1 { font-size:28px}


}
@media only screen and (max-width: 768px) {	
.hero22 .uc_container_text_box h1 { font-size:24px}
	.hero22 .uc_container_inner { width: 100%;}
	.hero22 .uc_paragraph {  font-size: 16px;margin: 15px 0 0;}
	.hero22 .top-text	{margin: 0 0 5%;}
	.hero22 .uc_container_text_box{ padding:0 20px;}
	.hero22 .start-btn .fa-play { font-size: 25px; padding: 25px 30px;}
}
@media only screen and (max-width: 639px) {	
.hero22 .uc_container_text_box h1 { font-size:20px}
.hero22 .uc_container_inner a { margin-bottom: 22px;}
	.hero22 .uc_paragraph {  font-size: 15px;}
	.hero22 .logo {position: inherit; text-align:center;background: #f84a3c;}
	.hero22 .logo a{ddisplay: block; margin: 0 auto;}
	.hero22 .uc_container_text_box { bottom: 2%;}
	.hero22 .start-btn .fa-play { font-size: 25px; padding: 18px 22px;}
	.hero22 h2{font-size:10px;margin: 0 0 10px;}
	.hero22 .uc_paragraph{ margin: 15px 0 0;}
	.hero22 .logo a { padding: 9px 35px;}	
}

@media only screen and (max-width: 480px) {	
.hero22 .uc_container_text_box h1 { font-size: 16px;}
	.hero22 .uc_container_inner a {  margin-bottom: 15px;}
	.hero22 .uc_paragraph {  font-size: 12px;}
	.hero22 .uc_paragraph a{ margin-bottom:0px;}
	.hero22 .uc_paragraph{ margin: 5px 0 0;}
}
@media only screen and (max-width: 360px) {	
.hero22 .uc_container_text_box h1 { font-size: 14px;}
.hero22 .start-btn .fa-play { font-size: 15px; padding: 14px 18px;}


}
</style>
<div class="hero22 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    
 
   <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero22.jpg<?php } ?>" alt="<?php echo $settings['img1_txt1']; ?>">
   
   <div class="uc_container_text_box">
        <div class="uc_container_inner">
            <a href="<?php if($settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="start-btn"><i aria-hidden="true" class="fa fa-play"></i></a>
            
              <h2><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>Awesome Title<?php } ?></h2>
             	 
            <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?> Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend.<?php } ?></h1>
           
             
             
       </div>
    </div> 
</div>