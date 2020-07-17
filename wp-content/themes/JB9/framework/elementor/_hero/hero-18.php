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
.hero18 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}

.hero18{
	position:relative;
	width:100%;
}

 	
.hero18 img{
	width:100%;
	display: block;
}
.uc_solid_header .uc_container_inner{
	width: 65%;
	margin:0 auto;
	}
.hero18 .uc_container_text_box{ 
	padding:0%;
	position:absolute;	
	top:50%;
	left:10%;
	width: 71%;
	-webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
	transform: translateY(-50%);
}


.hero18 .uc_socila_icon {
    position: absolute;
    right: 12%;
	top:50px;
}
.hero18 .uc_socila_icon a{
	color:#ffffff;
	display:inline-block;
}
.hero18 .uc_socila_icon .fa{ 
	margin-left:20px;
	}

.hero18 .uc_container_text_box h1{
	font-size:70px;
 
	font-family:"Times New Roman", Times, serif;
	font-weight:400;
 	
	line-height: 82px;
	padding: 35px 0;
}
.hero18 .uc_paragraph{
	font-family:"Times New Roman", Times, serif;
	font-size:18px;
	 
	font-weight:400;
	line-height: 27px;
	font-style:italic;
	width: 50%;
	margin-bottom:80px;
}

.hero18 .uc_container_text_box a{
	font-size:13px;
	border:1px solid #212529;
 
	font-weight:bold;
 
	padding:18px 45px;
	text-decoration:none;
	display:inline-block;
	text-transform:uppercase;
	letter-spacing:2px;
	border-radius: 43px;
}


@media only screen and (max-width:1300px) {
	.hero18 .uc_paragraph{ line-height:normal;font-size: 24px;margin-top: 25px;}
	.hero18 .uc_container_text_box a { margin-top: 20px;}
	.hero18 .uc_container_inner{ width: 74%;}
	.hero18 .uc_container_text_box h1{ padding:5px 0; line-height: normal;}
	.hero18 .uc_paragraph{ width:70%; margin:15px 0;}
}
@media only screen and (max-width: 1024px) {
	
	.hero18 .uc_container_inner{ width: 74%;}
	.hero18 .uc_container_text_box h1{ padding:5px 0; line-height: normal;}
	.hero18 .uc_paragraph{ width:100%; margin:15px 0;}
	.hero18 .uc_container_text_box a { margin-top: 10px;}
	 
}
@media only screen and (max-width: 980px) {	
	.hero18 .uc_container_text_box{left: 12%;  width: 75%;}
}
@media only screen and (max-width: 800px) {	
	.hero18 .uc_paragraph{ font-size: 19px;}
	.hero18 .uc_container_text_box{left: 15%; width: 78%}
}
	
@media only screen and (max-width: 768px) {	
	 
	.hero18 .uc_container_inner{ width:100%; padding:0 20px}
 
	.hero18 .uc_container_text_box h1{ padding: 5px 0 15px;}
	.hero18 .uc_paragraph { font-size: 16px; width: 100%;  margin-bottom: 20px;}
	.hero18 .uc_container_text_box{left: 9%; width: 81%}
	
}
@media only screen and (max-width: 640px) {	
	.hero18 .uc_container_text_box h1{ padding: 5px 0;}
	.hero18 .uc_paragraph{ margin: 5px 0;}
	.hero18 .uc_paragraph { font-size: 14px; margin-bottom: 10px;}
	.hero18 .uc_container_text_box a { font-size: 11px; margin-top: 5px;  padding: 12px 20px;}
}
@media only screen and (max-width: 480px) {	
 
	.hero18 .uc_paragraph { font-size: 12px;}
	.hero18 .uc_container_text_box h1{ background:none;}
	.hero18 .uc_container_text_box a { font-size: 9px; margin-top: 5px;  padding: 10px 20px;}
	.hero18 .uc_container_text_box{left: 0; width: 100%;padding: 0 20px;}
 
}
@media only screen and (max-width: 360px) {	

.hero18 .uc_container_text_box a { font-size: 9px; margin-top: 5px;  padding: 9px 15px;}
.hero18 .uc_container_inner { padding: 50px 15px 0;}
.hero18 .uc_paragraph { font-size: 12px;margin-bottom: 2px;}
.hero18 .uc_container_text_box h1 { padding: 0;}
.hero18 .uc_container_text_box{padding: 25px 20px 0;}

}
@media only screen and (max-width: 320px) {	
.hero18 .uc_container_inner {  padding: 38px 15px 0}
.hero18 .uc_paragraph { font-size: 12px;margin-bottom: 2px;}
.hero18 .uc_container_text_box a {margin-top: 4px;}

}
</style>
<div class="hero18 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">  
  	
   <img src="<?php if(isset($settings['img1']) && strlen($settings['img1']) > 0){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero18.jpg<?php } ?>" alt="<?php echo $settings['img1_txt1']; ?>">
     
       <div class="uc_container_text_box">
            <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>TREAT <BR /> YOURSELF<?php } ?></h1>
            <div class="uc_paragraph"><?php if(isset($settings['img1_txt3']) && $settings['img1_txt3'] != ""){ echo $settings['img1_txt3']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
            
            
            <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>LETS WORK TOGETHER<?php } ?>
                 </a>  
            
        </div> 
</div>