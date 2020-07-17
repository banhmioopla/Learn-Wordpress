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
.hero9 *{
	margin:0;
	padding:0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	
}

.hero9{
	position:relative;
	width:100%;
}
	
.hero9 img{
	width:100%;
	display: block;
}
.uc_container_inner{
	width: 47%;
	margin:0 auto;
	}
.hero9 .uc_container_text_box{ 
	padding:0%;
	position:absolute;	
	top:50%;
	left: 0%;
	width: 100%;
	-webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
	transform: translateY(-50%);
}


.hero9 .uc_socila_icon {
    position: absolute;
    right: 20%;
	top:50px;
}
.hero9 .uc_socila_icon a{
	color:#ffffff;
	display:inline-block;
}
.hero9 .uc_socila_icon .fa{ 
	margin-left:20px;
	}

.hero9 .uc_container_text_box h1{
	font-size:70pz;
 
	color:#ffffff;	
	line-height: 102px;
}
.hero9 .uc_paragraph{
	 
	font-size:32px;
	color:#ffffff;
	font-weight:300;
	margin-top:20px;
	line-height: 44px;
}

.hero9 .uc_container_text_box a{
	font-size:11px;
	border:1px solid #ffffff;
	 
	font-weight:700;
	color:#ffffff;
	padding:18px 45px;
	text-decoration:none;
	display:inline-block;
	text-transform:uppercase;
	letter-spacing:2px;
	margin-top:35px;
	border-radius: 43px;
}


@media only screen and (max-width:1300px) {
	.hero9 .uc_paragraph{ line-height:normal;font-size: 24px;margin-top: 25px;}
	.hero9 .uc_container_text_box a { margin-top: 20px;}
}
@media only screen and (max-width: 1024px) {
	.hero9 .uc_paragraph{ line-height:normal;font-size: 20px;}
	.hero9 .uc_container_text_box a { margin-top: 22px; padding:12px 28px;font-size: 14px;}
	.hero9 .uc_container_text_box h1{ line-height:normal;}
	.hero9 .uc_socila_icon{top: 7px;}
	.hero9 .uc_socila_icon .fa{ margin-left:10px;}
}
@media only screen and (max-width: 800px) {	
	.hero9 .uc_paragraph{ line-height:normal;font-size: 20px;}
	.hero9 .uc_container_text_box h1{ line-height:normal;}
	.hero9 .uc_paragraph{ margin-top: 0px;}
	.hero9 .uc_container_text_box a { margin-top: 10px; font-size: 10px; padding: 5px 14px;}
	.hero9 .uc_socila_icon{top: 7px;}
	.hero9 .uc_socila_icon .fa{ margin-left:10px;}
	.hero9 .uc_socila_icon a{display:inline-block;}
}
	
@media only screen and (max-width: 768px) {	

	.uc_container_inner{ width:100%; padding:0 15px}
	.hero9 .uc_socila_icon { right: 15px; }
}
@media only screen and (max-width: 480px) {	

	.hero9 .uc_paragraph { font-size: 15px;}

}
</style>
<div class="hero9 <?php if(isset($settings['class'])){ echo $settings['class']; } ?>">    	
           
    <img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero9.jpg<?php } ?>" alt="<?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; } ?>"> 
   
    
       <div class="uc_container_text_box">
       		<div class="uc_container_inner">
                <h1><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>My Awesome Title<?php } ?></h1>
                <div class="uc_paragraph"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>
        Curabitur quis iaculis sem. Sed fermentum augue eu felis dignissim eleifend. Sed luctus, dolor in vulputate mattis, purus mi pharetra ante.
        <?php } ?></div>
                <a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>">
				 <?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?>
                 </a> 
                
           </div>
        </div>      
    </div>