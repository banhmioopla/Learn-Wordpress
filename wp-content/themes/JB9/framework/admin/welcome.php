<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;
 
// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(1);

?>

    
    
 
    <div class="row mt-5">
    <div class="col-lg-6 mb-4">
    
    <div class="card1 shadow bg-danger" style="background: #297dd6 url(<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/bg1.png) no-repeat right top;">   
     
    <h3 class="text-white">Child Themes</h3>
    <p class="text-white mt-3" style="font-size:16px;">Choose a website design.</p>
    
    <a href="themes.php?page=premiumpresschildthemes" class="btn btn-dark mt-3" >View Designs</a>
    
    </div>
     
    
    </div>
    <div class="col-lg-6 mb-4">  
    
    <div class="card1 shadow" style="background: #297dd6 url(<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/bg2.png) no-repeat right top;">   
    
    <h3 class="text-white">Customize</h3>
    <p class="text-white mt-3" style="font-size:16px;">Modify website layout.</p>
    
    <a href="admin.php?page=15" class="btn btn-dark mt-3">Customize Design</a>
    
    </div>
    
    </div>    
    
    </div> 
   
    
    
    
    <div class="mt-5">
    <div class="row">
        <div class="col-md-4 mb-4">
        
        <div class="bg-white shadow" style="border-radius: 7px;">
        	
            <div class="p-5 pb-2 text-center">
            
            <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/icon1.png" class="img-fluid mb-4" />
            
        	<h5 class="mb-3">Customer Support</h5>
            
            <p style="font-size:16px;" class="text-muted">Create a support ticket and speak to one of our trained support staff.</p>
            
            </div>
        
            <div class="btnbox bg-light text-center p-3 py-4" style="border-radius: 7px;">
            
            <a href="https://www.premiumpress.com/account/" class="btn btn-dark">Create Ticket</a>
            
            </div>
        
        </div>
        
        
        </div>   
        <div class="col-md-4 mb-4">
        
        <div class="bg-white shadow" style="border-radius: 7px;">
        	
            <div class="p-5 text-center">
            
            <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/icon2.png" class="img-fluid mb-4" />
            
        	<h5 class="mb-3">Community Forums</h5>
            
            <p style="font-size:16px;" class="text-muted">Ask the community via our member forums and chat with other users.</p>
            </div>
        
            <div class="btnbox bg-light text-center p-3 py-4" style="border-radius: 7px;">
            
            <a href="https://www.premiumpress.com/forums/" class="btn btn-dark">Visit Forums</a>
            
            </div>
        
        </div>
        
        
        </div>
        <div class="col-md-4">
        
        
        <div class="bg-white shadow" style="border-radius: 7px;">
        	
            <div class="p-5 text-center">
            
            <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/icon3.png" class="img-fluid mb-4" />
            
        	<h5 class="mb-3">Video Tutorials</h5>
            
            <p style="font-size:16px;" class="text-muted">Watch &amp; learn with our collection of YouTube video tutorials.</p>
            </div>
        
            <div class="btnbox bg-light text-center p-3 py-4" style="border-radius: 7px;">
            
            <a href="https://www.premiumpress.com/tutorials/?lc=<?php echo get_option('wlt_license_key'); ?>" class="btn btn-dark">Watch Videos</a>
            
            </div>
        
        </div>
        
        
        </div>
    </div>
    </div>     


<?php
// LOAD IN HEADER
echo $CORE_ADMIN->FOOTER(1); 
?>
   