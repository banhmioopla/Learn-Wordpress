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
.hero14 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}

.hero14 .blue-background{
	position:relative;
	width:100%;
	
}	

.hero14 .uc_container_text_box{ 
	padding:13% 0;
	width: 100%;
}

.hero14 .logo{
	position: absolute;
    left: 12%;
	top:50px;
}
.hero14 .uc_socila_icon {
    position: absolute;
    right:12%;
	top:50px;
}
.hero14 .uc_socila_icon a{
	color:#ffffff;
	display:inline-block;
}
.hero14 .uc_socila_icon .fa{ 
	margin-left:20px;
	}

.hero14 .uc_container_text_box h1{
	font-size:3.5vw;
	font-family: 'Playfair Display', serif;
	font-weight:400;
	color:#ffffff;	
	line-height: 65px;
    text-align: center;
    width: 50%;
	margin:0 auto;
	padding: 0 0 65px;
}
.hero14 .uc_paragraph{	
	font-family: 'Montserrat', sans-serif;
	font-size:17px;
	color:#ffffff;
	font-weight:300;
	line-height: 44px;
	opacity:0.6;
	 width: 315px;
	 text-align:center;
	 margin:0 auto;
}
.hero14 .profile-box{
	position:relative;	
}
.hero14 .profile-box .profile-image{
	position:absolute;
	width:120px;
	border:8px solid #ffffff;
	border-radius:50%;
	margin:0 auto;
	left: 0;
	right:0px;
	top:-60px;
}


.hero14 .profile-box a.contact-box{
	position:absolute;
	top:80px;
	left:50%;
	margin-left:-70px;
	text-align:center;
	width:137px;
	color: #004a80;
	text-decoration:none;
    font-family: "Montserrat",sans-serif;
    font-size: 14px;
    font-weight: 700;
	text-transform:uppercase;
	letter-spacing: 3px;
}

@media only screen and (max-width:1300px) {
	.hero14 .uc_paragraph{ line-height:normal;font-size: 22px;margin-top: 25px;}
	.hero14 .uc_container_text_box a { margin-top: 20px;}
}
@media only screen and (max-width: 1024px) {
	.hero14 .uc_container_text_box h1{ line-height:normal; padding: 0;}
	.hero14 .uc_paragraph{  font-size: 16px;}
}
@media only screen and (max-width: 800px) {	
	
}
	
@media only screen and (max-width: 768px) {	
.hero14 .logo{top:15px; left:15px;}
.hero14 .uc_socila_icon {top:15px; right:15px;}
.hero14 .uc_paragraph { font-size: 12px; margin-top: 10px;}
	
}
@media only screen and (max-width: 640px) {		
.hero14 .uc_container_text_box {  padding: 8% 0 15%;}
.hero14 .uc_paragraph{width:100%;}

}
@media only screen and (max-width: 480px) {
.hero14 .logo{top:10px; left:15px;}	
.hero14 .uc_container_text_box {  padding: 20% 0;}
.hero14 .uc_container_text_box h1{ width: 100%;font-size: 5vw; padding:0 15px;}
}
@media only screen and (max-width: 360px) {
	.hero14 .uc_container_text_box {  padding: 20% 0 25%;}
}
</style>
<div class="hero14 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">
    <div class="blue-background bg-primary">   
    	 
       	<div class="uc_container_text_box">
            <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>Our Law Firm is changing the approach to client care. <?php } ?> </h1>
            <div class="uc_paragraph">
			
			<?php if(isset($settings['img1_txt1']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>TRIAL LAWYERS OF THE YEAR 2017<?php } ?>
            
            <div>
            <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>" class="mt-5" style="color:white !important; text-decoration:underline !important;">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
         </a>
         </div>
            
            </div>
            
            
         
        </div>  
       
    </div>
</div>