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
.hero19 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
    line-height:normal;
}

.hero19 .uc_container_holder{
	position:relative;
	width:100%;
}
	
.hero19 .uc_container_holder img{
	width:100%;
}
.hero19 .uc_container_text_box{
	position:absolute;
	top:50%;
	width:100%;
	text-align:center;
	padding:0 15px;
	-webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
	transform: translateY(-50%);
}
.hero19 .uc_container_text_box h1{
	font-size:6.5vw;
	 
	font-weight:bold;
	color:#ffffff;	
	}
.hero19 .uc_paragraph{
	font-family:"Georgia";
	font-size:32px;
	color:#ffffff;
	font-style:italic;
	margin: 0 auto;
    max-width: 920px;
}
.hero19 .uc_container_text_box a{
	font-size:24px;
	 
	font-weight:600;
	color:#ffffff;
	padding:22px 30px;
	border:4px solid #ffffff;
	text-decoration:none;
	display:inline-block;
	text-transform:uppercase;
	letter-spacing:1px;
	margin-top:50px;
}


@media only screen and (max-device-width: 1300px) {
	.hero19 .uc_paragraph{font-size: 24px;}
}

@media only screen and (max-device-width: 1024px) {
	.hero19 .uc_paragraph{font-size: 24px;}
}
@media only screen and (max-device-width: 678px) {
	.hero19 .uc_container_text_box a{	 font-size: 18px; padding: 15px 24px;border: 2px solid #ffffff;}
	.hero19 .uc_paragraph{font-size: 20px;}
	.hero19 .uc_container_text_box a{font-size: 20px; padding: 19px 30px;}
}
@media only screen and (max-device-width: 640px) {
	.hero19 .uc_paragraph{font-size: 18px;}
}
@media only screen and (max-device-width: 480px) {
	.hero19 .uc_paragraph{font-size: 15px;}
	.hero19 .uc_container_text_box a{	 margin-top: 18px; font-size: 15px; padding: 5px 15px; letter-spacing:inherit;}
}
@media only screen and (max-device-width: 360px) {
	.hero19 .uc_paragraph{font-size: 15px;}
	.hero19 .uc_container_text_box a{	 margin-top: 18px; font-size: 15px; padding: 5px 15px; letter-spacing:inherit;}
}
</style>
<div class="hero19 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    	
     
    <div class="uc_container_holder">        
        
        
         <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero19.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
   
        
        <div class="uc_container_text_box">
        	<h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>AWESOME TITLE<?php } ?></h1>
            <div class="uc_paragraph"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
           
           
            <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="uc_portfolio">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
                 </a> 
            
            
        </div>      
     </div>
</div>