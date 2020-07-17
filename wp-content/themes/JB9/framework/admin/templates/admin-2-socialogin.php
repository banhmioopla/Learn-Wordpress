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



// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
 
 
$providers = array(

	"twitter" => array(
		"name" => "Twitter",
		"help" => "https://developer.twitter.com/en/apps/",
		"icon" => "fa-twitter",
	),

	"facebook" => array(
		"name" => "Facebook",
		"help" => "https://developers.facebook.com/apps/",
		"icon" => "fa-facebook-f",
	),
	
	"google" => array(
		"name" => "Google",
		"help" => "https://developers.google.com/identity/",
		"icon" => "fa-google",
	),
	 
	"linkedin" => array(
		"name" => "Linked-in",
		"help" => "https://www.linkedin.com/developers",
		"icon" => "fa-linkedin",
	),
	 
);
 
?> 



<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<div class="tabheader mb-4">


<a href="https://www.youtube.com/watch?v=8wCycTF-WbU" class="btn btn-sm mb-4 btn-outline-dark float-right" target="_blank"><i class="fa fa-video-camera" aria-hidden="true"></i> Video Tutorial</a>

 
 


         <h4><span>Social Login</span></h4>
      </div>

 
 
 
 
 
   
<?php foreach($providers as $key => $pro){ ?>


<div class="container px-0 bg-light mb-4 p-4">
<div class="row">

    <div class="col-5">
    
        <label class="txt500"><?php echo $pro['name']; ?></label>
        
        <p class="text-muted">Help with this API can be found <a href="<?php echo $pro['help']; ?>" target="_blank">here</a></p>
        
         <div class="mt-2">                  
                                     
                                      <label class="radio off" >
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('social_<?php echo $key; ?>').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('social_<?php echo $key; ?>').value='1'">
                                      </label>
                                      <div class="toggle <?php if(_ppt('social_'.$key.'') == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                      
<input type="hidden" id="social_<?php echo $key; ?>" name="admin_values[social_<?php echo $key; ?>]" 
                                 value="<?php if(_ppt('social_'.$key.'') == ""){ echo 0; }else{ echo _ppt('social_'.$key.''); } ?>"> 
                                 </div>
                                 
                                 
                                 
               <?php if(_ppt('social_'.$key.'_key1') != "" && _ppt('social_'.$key.'_key2') != ""){ ?>
               
               
                  <a class="btn btn-success btn-sm mt-4" href="<?php echo home_url(); ?>/?sociallogin=<?php echo $pro['name']; ?>" rel="nofollow" target="_blank">
                  Test <?php echo $pro['name']; ?> Login
                  </a>
               
              
               <?php } ?>
                                 
        
    </div>
    
    <div class="col-7">
    

    <div class="row"> 
  
  
    <div class="col-md-12">
                   
      <div class="form-group">
    	<label class="txt500">App Key <span class="required">*</span></label><br />
        <input type="text" class="form-control" name="admin_values[social_<?php echo $key; ?>_key1]" value="<?php echo _ppt('social_'.$key.'_key1'); ?>" />
        	</div>
            
 	</div>
    
    
    <div class="col-md-12">
                   
         <div class="form-group">
    	<label class="txt500">Secret Key <span class="required">*</span></label><br />
        <input type="<?php if(defined('WLT_DEMOMODE')){ echo "password"; }else{  echo "text"; } ?>" class="form-control" name="admin_values[social_<?php echo $key; ?>_key2]" value="<?php echo _ppt('social_'.$key.'_key2'); ?>" />
        </div>
        
        <label class="txt500">Callback URL</label><br />
       
       <?php if($pro['name'] == "Twitter"){ ?>
		<p><?php echo home_url().'?sociallogin='.$pro['name']; ?></p>
 		<?php }else{ ?>
        <p><?php echo home_url().'/?sociallogin='.$pro['name']; ?></p>
        <?php } ?>
        
 
    
    </div>
    
</div>                  
    
</div>
</div>
</div>


 
 

    
<?php }  ?>

 
 
</div></div>

<div class="col-lg-4">




 

<div class="container bg-light py-3 mb-4 p-4">
   <div class="row">

      <div class="col-4">
         <div class="">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('allow_socialbuttons').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('allow_socialbuttons').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('allow_socialbuttons') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
         </div>
         <input type="hidden" id="allow_socialbuttons" name="admin_values[allow_socialbuttons]" value="<?php echo _ppt('allow_socialbuttons'); ?>">
      </div>
      
      <div class="col-8 text-left">
         <h4 class="txt500">Social Login</h4>

      </div>
      
      <div class="col-12">
      
       <div class="text-muted py-3">Turn on/off social login features allowing members to login/register with their social media accounts.</div>
      
      </div>
      
      
   </div>
   
    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 
     
</div>









  


</div>


</div>

<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div> 