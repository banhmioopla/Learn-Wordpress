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
 
.hero15 {
	position: relative;
	padding: 240px 0 140px;
	background-position: center center;
	background-repeat: no-repeat;
	background-size: cover;
	background-color: #000;
	z-index:0;
}

@media (max-width: 767px) {
	.hero15 {
		padding: 100px 0 40px;
		background-image: none;
	}
	h1 {
		font-size: 31px;
	}
}
@media (max-width: 479px) {
.hero15 {
		padding: 50px 0 40px;
		background-image: none;
	}
	.hero15 h1 { font-size:26px; }
	.hero15 .hero15-texting p { font-size:16px; }
}

.hero15::after {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.6);
	content: ""
}

.hero15 .hero15-texting {
	color: rgba(255, 255, 255, 0.9);
	position: relative;
	z-index: 100;
}

.hero15 .hero15-texting h1 {
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: 1.5px;
}

 
.hero15.windows-height-bg {
	overflow: hidden;
}
 

@media only screen and (max-width: 767px) {
	.hero15 .form-group {
		width: 100%;
	}
}

@media (max-width: 479px) {
	.hero15 .form-group {
		width: 100%;
	}
}
 
 
.hero15 .btn { font-size:16px; font-weight:bold; }
@media (min-width: 1200px) {
.hero15 {padding: 240px 0 340px !important;}
.hero15 h1 { font-size: 50px; }
.hero15 .w50 {
		width: 50%;
	}
}
@media (max-width: 768px) {
.hero15 { text-align:center !important; }
.hero15 .btn { padding:10px !important; width:100%; margin:0px; }
}

</style>
<div class="hero15 main-search-form-wrapper" style="background: url('<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://premiumpress.com/_demoimages/elementor/_hero/hero24.jpg<?php } ?>');  no-repeat center center; position: relative;  background-size: cover; ">
    <div class="hero15-texting text-left">
    <div class="container">
        <div class="w50">
<h1 class="text-uppercase mb-3"><?php if(isset($settings['img1_txt1']) && $settings['img1_txt1'] != ""){ echo $settings['img1_txt1']; }else{ ?>The online business directory that makes a difference <?php } ?></h1>
<p class="lead"><?php if(isset($settings['img1_txt2']) && $settings['img1_txt2'] != ""){ echo $settings['img1_txt2']; }else{ ?>Find local businesses in your area right here, right now!<?php } ?></p>
<a href="<?php echo home_url(); ?>/?s=" class="btn btn-outline-light btn-lg mt-2 text-uppercase py-3 px-5 mr-3 rounded-0"><span><?php echo __("Search Website","premiumpress") ?></span></a> 

<a href="<?php if(isset($settings['img1_btnlink']) && $settings['img1_btnlink'] != ""){ echo $settings['img1_btnlink']; }else{ echo home_url()."/?s="; }?>"  class="btn btn-outline-light btn-lg mt-2 text-uppercase py-3 px-5 rounded-0"><?php if(isset($settings['img1_btntxt']) && $settings['img1_btntxt'] != ""){ echo $settings['img1_btntxt']; }else{ ?>Learn More<?php } ?></a>

</div>
        </div>
    </div>
</div>
 