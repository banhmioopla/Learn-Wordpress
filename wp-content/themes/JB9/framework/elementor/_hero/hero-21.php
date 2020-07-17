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
.hero21 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}


.hero21 .logo{
    margin:0;
	width:108px;
}	

.hero21 img{
	width:100%;
	display: block;
}
.hero21 .uc_container_inner{
	width: 80%;
	padding:0 0 0 7%;
	margin:15% 0;
	}
.hero21 .uc_container_text_box{ 
	 background: #39cb7d none repeat scroll 0 0;
	 padding: 4%;
}


.hero21 .uc_container_text_box h1{
	font-size:4vw;
	font-family: 'Montserrat', sans-serif;
	font-weight:700;
	color:#ffffff;	
	line-height: 76px;
	padding:0px;
}
.hero21 .uc_paragraph{
	font-family: 'PT Serif', serif;
	font-size:18px;
	color:#ffffff;
	font-weight:400;
	line-height: 27px;
	font-style:italic;
	width: 100%;
	margin: 25px 0 40px;
}

.hero21 .uc_container_inner a.uc_button{
	font-size:13px;
	border:1px solid #ffffff;
	font-family: 'Montserrat', sans-serif;
	font-weight:bold;
	color:#ffffff;
	padding: 20px 70px;
	text-decoration:none;
	display:inline-block;
	text-transform:uppercase;
	letter-spacing:2px;
	border-radius: 43px;
}
.hero21 .top-text{
	font-size:13px;
	font-family: 'Montserrat', sans-serif;
	color:#ffffff;
	font-weight:700;
	 letter-spacing: 7px;
	 margin:0 0 25px 0;
}


@media only screen and (max-width:1300px) {
	.hero21 .uc_paragraph{ line-height:normal;font-size: 24px;margin-top: 25px;}
	.hero21 .uc_container_text_box a { margin-top: 20px;}
	.hero21 .uc_container_inner{ width: 74%;}
	.hero21 .uc_container_text_box h1{ padding:5px 0; line-height: normal;}
	.hero21 .uc_paragraph{ width:70%; margin:15px 0;}
}
@media only screen and (max-width: 768px) {	
	.hero21 .uc_container_inner { width: 100%;}
	.hero21 .uc_paragraph {  font-size: 18px;}
	.hero21 .uc_container_inner a.uc_button{ padding: 3% 11%;}
	.hero21 .top-text	{margin: 0 0 5%;}
	.hero21 .uc_container_inner { margin: 12% 0;}
}
@media only screen and (max-width: 640px) {	
	.hero21 .uc_paragraph {  font-size: 15px;}
}
@media only screen and (max-width: 480px) {	
	.hero21 .uc_paragraph {  font-size: 12px;}
}
</style>
<div class="hero21">    	
   <div class="uc_container_text_box  bg-green <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    
       
        <div class="uc_container_inner">
            <div class="top-text"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>PREMIUMPRESS THEMES<?php } ?></div>
          <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>THIS IS WHERE YOU PUT YOUR AWESOME TITLE<?php } ?></h1>
            <div class="uc_paragraph"><?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt32']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
            
            <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_button">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>LEARN MORE<?php } ?>
        </a> 
       </div>
    </div> 
</div>