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
.hero-1 {	position: relative;	padding: 240px 0 140px;	background-position: center center;	background-repeat: no-repeat;	background-size: cover;	background-color: #000;	z-index:0;}
.hero-1::after {	position: absolute;	left: 0;	top: 0;	width: 100%;	height: 100%;	background: rgba(0, 0, 0, 0.6);	content: "";}
.hero-1 .hero-1-texting {	color: rgba(255, 255, 255, 0.9);	position: relative;	z-index: 100;}
.hero-1 .hero-1-texting h1 {	font-weight: 700; 	letter-spacing: 1.5px;}
.hero-1-wrap .main-search-form-inner {    width: 80%;    margin: 0 auto;    position: relative;    border: 8px solid rgba(255, 255, 255, 0.4);    background: rgba(255, 255, 255, 0.4);    border-radius: 3px;    -webkit-box-shadow: 0px 0px 21px 0px rgba(0, 0, 0, 0.24);    -moz-box-shadow: 0px 0px 21px 0px rgba(0, 0, 0, 0.24);    box-shadow: 0px 0px 21px 0px rgba(0, 0, 0, 0.24);}
.hero-1-wrap .form-holder {    margin-right: 120px;}
.hero-1-wrap .form-group {    margin-bottom: 0;    background: #FFF;    padding: 17px 18px 10px;    -moz-transition: all 0.3s ease-out;    -webkit-transition: all 0.3s ease-out;    transition: all 0.3s ease-out;    height: 65px;}
.hero-1-wrap .form-group.focus,.hero-1-wrap .form-group:hover {    background-color: #efefef;}
.hero-1-wrap .form-holder label {    font-size: 10px;    line-height: 1;    display: block;    margin: 0 0 5px;    letter-spacing: 0.5px;    -moz-transition: all 0.3s ease-out;    -webkit-transition: all 0.3s ease-out;    transition: all 0.3s ease-out;	text-align:left;}
.hero-1-wrap .row.gap-1 {    margin-right: -1px;    margin-left: 0px;}
.hero-1-wrap .gap-1 > div { padding:0px; padding-right:1px; }
.hero-1-wrap .form-holder .form-control {    border-radius: 0;    border: 0;    padding: 0;    height: auto;    font-weight: 400;    font-size: 16px;    background: transparent;}
.hero-1-wrap .form-holder .bootstrap-select {    margin-top: -6px;}
.hero-1-wrap .form-holder .bootstrap-select .dropdown-toggle {    font-size: 16px;    height: auto;    border-radius: 0;    border: 0;    padding: 0;    padding-right: 15px;    margin: 0;	background:transparent;}
.hero-1-wrap .form-holder .bootstrap-select .dropdown-menu .form-control {    border: 1px solid #ccc;    border-radius: 3px;    height: 34px;    padding: 6px 12px;    font-size: 13px;    margin: 5px 0 0;}
.hero-1-wrap .form-holder .bootstrap-select.btn-group .dropdown-toggle .caret {    right: 0;}
.hero-1-wrap .btn-holder {    position: absolute;    top: 0;    bottom: 0;    right: 0;    width: 119px;}
.hero-1-wrap .btn-holder .btn {    border-radius: 0;    margin: 0;    height: 65px;    line-height: 65px;    padding-top: 0;    padding-bottom: 0;    font-size: 16px;    border: 0;}
@media (max-width: 767px) {
.hero-1 {		padding: 100px 0 40px;		background-image: none;	}
h1 {		font-size: 31px;	}
}
@media (max-width: 479px) {
.hero-1 {		padding: 50px 0 40px;		background-image: none;	}
.hero-1 h1 { font-size:26px; }
.hero-1 .hero-1-texting p { font-size:16px; }
}
@media only screen and (max-width: 767px) {	.hero-1 .form-group {		width: 100%;	}}
@media (max-width: 479px) {	.hero-1 .form-group {		width: 100%;	}}

@media only screen and (max-width: 1199px) {
.hero-1-wrap .main-search-form-inner {        width: 90%;    }
}
@media only screen and (max-width: 991px) {
.hero-1-wrap .main-search-form-inner {        width: 96%;    }
.hero-1-wrap .form-holder .form-control { font-size: 13px;    }
.hero-1-wrap .form-holder .bootstrap-select {        margin-top: -11px;    }   
}
@media (max-width: 767px) {
.hero-1-wrap .form-holder {        margin-right: 0;    }
.hero-1-wrap .btn-holder {        position: relative;        top: 0;        bottom: 0;        right: 0;        width: 100%;    }
.hero-1-wrap .btn-holder .btn {        height: 45px;        line-height: 45px;        font-size: 12px;    }
.hero-1-wrap .form-group-main {        margin-bottom: 1px;    }
}

 
  
</style>
<div class="hero-1 hero-1-wrap">
   <div class="hero-1-texting text-center text-lg-left">
      <div class="container text-center text-white">
         <h1><?php echo __($settings['img1_txt1'],"premiumpress") ?></h1>
         <p class="my-3 pb-4 lead"><?php echo __($settings['img1_txt2'],"premiumpress") ?></p>
         <div class="hero-1-wrap-01">
            <div class="container">
               <div class="main-search-form-inner bg-change-focus-addclass-wrapper">
                   <form action="<?php echo home_url(); ?>/" method="get" name="searchform" id="searchform" onsubmit="return checkFields();">
                     <div class="form-holder">
                        <div class="row gap-1">
                           <div class="col-md-12 col-lg-8">
                              <div class="form-group bg-change-focus-addclass mb-1-xs">
                                 <label class="text-primary text-uppercase"><?php echo __("Keyword","premiumpress") ?></label>
                                 <input type="text" class="form-control" placeholder="<?php echo __("I'm looking for...","premiumpress") ?>" name="s" id="s" />
                              </div>
                           </div>
                           <div class="col-md-12 col-lg-4">
                              <div class="row gap-1">
                                 <div class="col-md-12">
                                    <div class="form-group bg-change-focus-addclass  mb-1-xs">
                                       <label class="text-primary text-uppercase"><?php echo __("Category","premiumpress") ?></label>
                                       <select class="form-control selectpicker"  name="catid" id="basic_catid">
                                       <?php if(!isset($_GET['cat1'])){ $selcat = ""; }else{ $selcat = $_GET['cat1']; } echo $CORE->CategoryList(array($selcat,false,0,THEME_TAXONOMY)); ?>
                                       </select>
                                    </div>
                                 </div>
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="btn-holder">
                        <button type="submit" class="btn btn-block btn-primary text-uppercase"><?php echo __("Search","premiumpress") ?></button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
          
      </div>
   </div>
</div>
<script>
   function checkFields(){
   
   	if( jQuery('#s').val().length === 0 ) {
   	
   	jQuery('#s').css('border', '1px solid red'); 
   	return false;
   	} else {
   	return true;
   	}
   }
   
</script>