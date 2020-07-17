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
 
global $CORE, $settings; 
?>
 
 

<div class="row banners-1">


<?php if($settings['show'] == 1){ ?>

    <div class="col-md-12">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b1_link']; ?>">
        <img src="<?php if(isset($settings['b1']) && strlen($settings['b1']) > 1){ echo $settings['b1'];  }else{ ?>http://via.placeholder.com/1140x450<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
    
<?php }elseif($settings['show'] == 2){ ?>

    <div class="col-sm-6 col-12">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b1_link']; ?>">
        <img src="<?php if(isset($settings['b1']) && strlen($settings['b1']) > 1 ){ echo $settings['b1'];  }else{ ?>http://via.placeholder.com/570x220<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
    
 
    <div class="col-sm-6 d-none d-sm-block">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b2_link']; ?>">
        <img src="<?php if(isset($settings['b2']) && strlen($settings['b2']) > 1 ){ echo $settings['b2'];  }else{ ?>http://via.placeholder.com/570x220<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
 

<?php }elseif($settings['show'] == 3){ ?>
	
    <div class="col-md-4 col-6">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b1_link']; ?>">
        <img src="<?php if(isset($settings['b1']) && strlen($settings['b1']) > 1){ echo $settings['b1'];  }else{ ?>http://via.placeholder.com/350x140<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
    
 
    <div class="col-md-4 col-6">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b2_link']; ?>">
        <img src="<?php if(isset($settings['b2']) && strlen($settings['b2']) > 1){ echo $settings['b2'];  }else{ ?>http://via.placeholder.com/350x140<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
    
    <div class="col-md-4 d-none d-sm-block">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b3_link']; ?>">
        <img src="<?php if(isset($settings['b3']) && strlen($settings['b3']) > 1){ echo $settings['b3'];  }else{ ?>http://via.placeholder.com/350x140<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
    
    
<?php }elseif($settings['show'] == 4){ ?>
	
    <div class="col-md-3 col-6">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b1_link']; ?>">
        <img src="<?php if(isset($settings['b1']) && strlen($settings['b1']) > 1){ echo $settings['b1'];  }else{ ?>http://via.placeholder.com/257x105<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
    
 
    <div class="col-md-3 col-6">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b2_link']; ?>">
        <img src="<?php if(isset($settings['b2']) && strlen($settings['b2']) > 1){ echo $settings['b2'];  }else{ ?>http://via.placeholder.com/257x105<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
    
    <div class="col-md-3 col-6">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b3_link']; ?>">
        <img src="<?php if(isset($settings['b3']) && strlen($settings['b3']) > 1){ echo $settings['b3'];  }else{ ?>http://via.placeholder.com/257x105<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>

    <div class="col-md-3 col-6">
    <div class="banner-boder-zoom">
    <a href="<?php echo $settings['b4_link']; ?>">
        <img src="<?php if(isset($settings['b4']) && strlen($settings['b4']) > 1){ echo $settings['b4'];  }else{ ?>http://via.placeholder.com/257x105<?php } ?>" class="img-fluid" alt="banner image" />
    </a>   
    </div>
    </div>
    
<?php } ?>
            
</div> 