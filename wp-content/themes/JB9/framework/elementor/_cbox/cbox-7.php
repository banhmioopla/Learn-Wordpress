<?php global $settings; ?>
<style>
  
.cbox7 {
	box-sizing: border-box;
	padding-bottom: 30px;
}
.cbox7 .imgbox {
	width: 100%;
	position: relative;
	overflow: hidden;
}
.cbox7 .imgbox .img {
	width: 100%;
	max-width: 100%;
	height: auto;
	-moz-transition: all 0.3s ease;
	-o-transition: all 0.3s ease;
	-webkit-transition: all 0.3s ease;
	transition: all 0.3s ease;
	-moz-transform: scale(1, 1);
	-ms-transform: scale(1, 1);
	-o-transform: scale(1, 1);
	-webkit-transform: scale(1, 1);
	transform: scale(1, 1);
	vertical-align: middle;
}
.cbox7 .imgbox .boxcontent {
	box-sizing: border-box;
	position: absolute;
	left: 0px;
	top: 0px;
	color: rgb(255, 255, 255);
	height: 100%;
	width: 100%;
	padding: 4% 5% 0px;
}
.cbox7 .imgbox .boxcontent .desc {
	width: 60%;
}

.cbox7 .boxcontent .cbtn {
	overflow: visible;
	position: absolute;
	left: 5.4%;
	bottom: 9.3%;
	padding: 0px;
	border-width: initial;
	border-style: none;
	border-color: initial;
	background: none;
	color: #fff;
	display:inline-block;
	padding:10px;
	text-decoration:none;
	border:2px solid white;
}


@media only screen and (min-width: 1200px) {
.cbox7 .itemlink:hover .imgbox:before {
	top: -3px;
}
.cbox7 .imgbox .boxcontent .title {
	font: bold 60px/58px;
	margin: 1px 0px 5px;
}
.cbox7 .itemlink:hover .imgbox .img {
	-moz-transform: scale(1.1, 1.1);
	-ms-transform: scale(1.1, 1.1);
	-o-transform: scale(1.1, 1.1);
	-webkit-transform: scale(1.1, 1.1);
	transform: scale(1.1, 1.1);
}
.cbox7 .imgbox .boxcontent .cbtn .uc_link_add {
	font: bold 20px/26px ;
	padding: 16px 20px 18px 21px;
}
.cbox7 .imgbox .boxcontent .cbtn .uc_link_add:after {
	font-size: 30px;
	line-height: 60px;
	width: 60px;
}
.cbox7 .itemlink:hover .imgbox .title {
	animation: 0.5s ease-in-out 0s normal none 1 moveFromLeft;
	-webkit-animation: 0.5s ease-in-out 0s normal none 1 moveFromLeft;
}
.cbox7 .itemlink:hover .imgbox .desc {
	animation: 0.4s ease-in-out .2s normal none 1 moveFromLeft;
	-webkit-animation: 0.4s ease-in-out .2s normal none 1 moveFromLeft;
}
.cbox7 .itemlink:hover .imgbox .cbtn {
	animation: 0.4s ease-in-out .1s normal none 1 moveFromBottom;
	-webkit-animation: 0.4s ease-in-out .1s normal none 1 moveFromBottom;
}
bo  .cbox7 .itemlink:hover .imgbox .cbtn:hover .uc_link_add {
	background: rgba(41, 41, 41, 0.9);
}
.cbox7 .itemlink:hover .imgbox .cbtn:hover .uc_link_add:after {
	background: rgba(255, 91, 35, 0.8);
}
}

@media (min-width: 992px) and (max-width: 1199px) {
.cbox7 .boxcontent {
	font-size: 13px;
	line-height: 18px;
}
.cbox7 .boxcontent .title {
	font: bold 40px/38px "Lora", serif;
	margin: 1px 0 5px;
}
.cbox7 .boxcontent .desc {
	width: 80%;
	margin: 0 0 10px;
}

.cbox7 .imgbox .boxcontent .cbtn .uc_link_add:after {
	font-size: 30px;
	line-height: 60px;
	width: 60px;
}
}

@media (min-width: 768px) and (max-width: 991px) {
.cbox7 .boxcontent {
	font-size: 13px;
	line-height: 18px;
}
.cbox7 .boxcontent .title {
	font: bold 30px/28px ;
	margin : 1px 0 5px;
}
.cbox7 .boxcontent .desc {
	width: 80%;
}
.cbox7 .boxcontent .cbtn .uc_link_add {
	font: bold 16px/20px ;
	padding: 8px 10px 10px 11px;
}
.cbox7 .imgbox .boxcontent .cbtn .uc_link_add:after {
	font-size: 20px;
	line-height: 38px;
	width: 38px;
}
}

@media (min-width: 480px) and (max-width: 767px) {
.cbox7 .boxcontent .title {
	font: bold 20px/22px ;
}
.cbox7 .boxcontent .desc {
	display: none;
}
.cbox7 .imgbox .boxcontent .cbtn .uc_link_add {
	font: bold 16px/20px ;
	padding: 8px 10px 10px 11px;
}
.cbox7 .imgbox .boxcontent .cbtn .uc_link_add:after {
	font-size: 20px;
	line-height: 38px;
	width: 38px;
}
}

@media (max-width: 479px) {
.cbox7 {
	padding: 0 5px 10px;
}
.cbox7 .boxcontent .title {
	font: bold 14px/18px ;
}
.cbox7 .boxcontent .desc {
	display: none;
}
.cbox7 .imgbox .boxcontent .cbtn .uc_link_add {
	font: bold 12px/18px ;
	padding: 5px 7px 6px 7px;
}
.cbox7 .imgbox .boxcontent .cbtn .uc_link_add:after {
	font-size: 15px;
	line-height: 29px;
	width: 29px;
}
}

@media (max-width: 350px) {
.cbox7 {
	width: 100%;
	padding: 0 5px 10px;
}
.cbox7 .boxcontent {
	font-size: 13px;
	line-height: 18px;
}
.cbox7 .boxcontent .title {
	font: bold 25px/28px ;
	margin: 1px 0 5px;
}
.cbox7 .boxcontent .desc {
	width: 80%;
}
.cbox7 .boxcontent .cbtn .uc_link_add {
	font: bold 16px/20px ;
	padding: 8px 10px 10px 11px;
}
.cbox7 .imgbox .boxcontent .cbtn .uc_link_add:after {
	font-size: 15px;
	line-height: 29px;
	width: 29px;
}
}
</style>
<div class="cbox7">
			<div class="itemlink">
			 
				<div class="imgbox">
					<img src="<?php if(!isset($settings['img1']) || (isset($settings['img1']) && $settings['img1'] == "")){ echo "https://www.premiumpress.com/_demoimages/microjob/4.jpg"; }else{  echo $settings['img1']; } ?>" alt="<?php echo $settings['txt1']; ?>" class="img">
					<div class="boxcontent">
						<h2 class="title"><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>AWESOME TITLE HERE<?php } ?></h2>
						<p class="desc"><?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu.<?php } ?></p>
                        <a class="cbtn" href="<?php echo $settings['btn_link']; ?>"><?php echo $settings['btn_txt']; ?></a>
						 
					</div>
				</div>
			</div>
</div> 