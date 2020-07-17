<?php global $settings; ?>
<div class="cbox5 cbox6">
	<div class="cbox5-box-wrap">
      <div class="flip-box ifb-auto-height  horizontal_flip_left flip-ifb-auto-height">
        <div class="ifb-flip-box"> 
            <div class="inner ifb-face ifb-front">
             
            	<img src="<?php if(isset($settings['img1']) && $settings['img1'] != ""){ echo $settings['img1']; }else{ ?>https://via.placeholder.com/285x400.png?text=PremiumPress+Themes<?php } ?>" 
                alt="<?php echo $settings['txt1']; ?>" class="img-fluid">
               
                <div class="text-box1 bg-primary"><span>
				<?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>Title Here<?php } ?> </span>
                </div>
                
			</div>
            <div class="uc_back ifb-face ifb-back">
                <div class="inner_inner bg-light">
                    
                    <h2><?php if(isset($settings['txt1']) && $settings['txt1'] != ""){ echo $settings['txt1']; }else{ ?>Inner Title Here<?php } ?>
                        <div class="border"></div>
                    </h2>
                    
                    <p>                    
                    <?php if(isset($settings['txt2']) && $settings['txt2'] != ""){ echo $settings['txt2']; }else{ ?>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et risus arcu.
					<?php } ?>
                    </p>
                  
                    <a href="<?php if(isset($settings['btn_link'])){ echo $settings['btn_link']; } ?>" class="btn btn-dark p-1 px-2 mt-3">
					<?php if(isset($settings['btn_txt'])){ echo $settings['btn_txt']; }else{  echo __("Read More","premiumpress");  } ?> <i class="fa fa-arrow-circle-right" style=" font-size:27px; color:#fff; vertical-align:middle; margin-left:15px;"></i>
                    </a>
                    
                </div>
            </div>
		 </div>
       </div>
     </div>
</div>
<?php if(!isset($GLOBALS['cbox5js'])){ $GLOBALS['cbox5js'] =1; ?>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
(jQuery),	
function(a) {
        "use strict";
        function d() {}
        function f() {}		
		 
		 jQuery(document).ready(function(a) {
            var e = jQuery(".ult-no-mobile").length;
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && e >= 1 ? jQuery(".ult-animation").css("opacity", 1) : d(), f(), jQuery(".ubtn").hover(function() {}, 
			function() {}),
			 /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? jQuery(".ifb-flip-box").on("click", function(a) {
                var b = jQuery(this);
                b.hasClass("ifb-hover") ? b.removeClass("ifb-hover") : b.addClass("ifb-hover")
            }) : jQuery(".ifb-flip-box").on("hover", function(a) {
                var b = jQuery(this);
                b.hasClass("ifb-hover") ? b.removeClass("ifb-hover") : b.addClass("ifb-hover")
            }), 
			 jQuery(".square_box-icon").each
        })
    }(jQuery) 
	
</script>
<?php } ?>