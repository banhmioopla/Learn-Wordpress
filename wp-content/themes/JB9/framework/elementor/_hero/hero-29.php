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
.hero29 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}

.hero29{
	position:relative;
	width:100%;
}
.hero29:before{
	background:rgba(0, 0, 0, 0.8);
	content:"";
	width:100%;
	height:100%;
	left:0px;
	top:0px;
	position:absolute;
}
	
.hero29 img{
	width:100%;
	display: block;
}

.hero29 .container_text_box{ 
	padding:0%;
	position:absolute;	
	top:50%;
	left: 20%;
	width: 40%;
	-webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
	transform: translateY(-50%);
}

 
.hero29 .container_text_box h1{
	font-size:3.5vw;
	font-weight:300;
	color:#ffffff;	
	line-height: 66px;
}
.hero29 .paragraph{
	font-size:18px;
	color:#ffffff;
	font-weight:400;
	margin-top:20px;
	line-height: 28px;
}

.hero29 .container_text_box a{
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
	.hero29 .container_text_box a { margin-top: 20px;}
}
@media only screen and (max-width: 1024px) {
	.hero29 .paragraph{font-size: 14px;margin-top: 4px;line-height: 20px;}
	.hero29 .container_text_box a { margin-top: 14px; padding:12px 28px;font-size: 14px;}
	.hero29 .container_text_box h1{ line-height:normal;}
}
@media only screen and (max-width: 800px) {	
	.hero29 .container_text_box h1{ line-height:normal;}
	.hero29 .container_text_box {  left: 15px;  width: 100%;}
	.hero29 .container_text_box a { margin-top: 10px; font-size: 10px; padding: 5px 14px;}
	
}
	
@media only screen and (max-width: 768px) {	

	.hero29 .socila_icon { right: 15px; }
}
@media only screen and (max-width: 640px) {	

	.hero29 .paragraph { font-size: 15px;}
	.hero29 .paragraph{ display:none;}
	 
	.hero29 .container_text_box h1{ letter-spacing: 5px;  font-size: 5.5vw;}
	 
}
@media only screen and (max-width: 360px) {	
	  
	.hero29 .container_text_box a {  font-size: 8px;}

}
</style>
<div class="hero29 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    	      
     <img src="<?php if(strlen($settings['img1']) > 0){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero17.jpg<?php } ?>" alt="<?php echo $settings['img1_txt1']; ?>">
    
    <div class="container_text_box">
       
       <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>AWESOME TITLE<?php } ?></h1>
        <div class="paragraph">
        	<?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend.
        <?php } ?>
        </div>
        <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>">
		<?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>SEARCH WEBSITE<?php } ?>
        </a>
    </div>      
</div>