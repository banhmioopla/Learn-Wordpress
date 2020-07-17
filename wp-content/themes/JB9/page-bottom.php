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
   
   global $CORE;
   
   if(!_ppt_checkfile("page-bottom.php")){  
  
   	  if(defined('PPTCOL-NONE')){
	  
	  // DO NOTHING
	  echo "</div>";
   
   	  }elseif(defined('PPTCOL-LEFT')){ 
   	  
   	  get_template_part( 'sidebar', 'left-wrap-bottom' ); 
   	  
   	  }elseif(defined('PPTCOL')){ 
   	  
   	  echo "</div></div>"; get_sidebar(); get_template_part( 'sidebar', 'wrap-bottom' ); 
   	  
   	  }else{
	  
	   
		  if(isset($GLOBALS['flag-search'])){
		  
		  // DO NOTHING
		   
		  }else{
		  
		  echo "</div></div>";
		  
		  }
   	  
   	  }
   	  
   	  ?>
</div>
</main>  
 
<?php if(strlen($CORE->BANNER('footer')) > 0){ ?>
<div class="border-top py-4">
<div class="container">
<div class="row">
    <div class="col-12 text-center">
        <?php echo $CORE->BANNER('footer'); ?>
    </div>
</div>
</div>
</div>
<?php } ?>  
  
<?php } ?>