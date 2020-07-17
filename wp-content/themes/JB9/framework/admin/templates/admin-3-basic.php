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

global $CORE, $default_email_array; 

 
?>

<?php get_template_part('framework/admin/templates/admin', 'form-top' ); ?>

 
<div class="row">

<div class="col-lg-8">

<div class="bg-white p-5 shadow" style="border-radius: 7px;">


<?php 

$default_email_array = $CORE->email_list();

$all_emails = _ppt('emails');

 
if(is_array($default_email_array)){ $i=0; 

foreach($default_email_array as $key => $val ){ 


if(isset($val["break"])){ 
?>
 
<div class="tabheader mb-4">
 
         <h4><span><?php echo $val["break"]; ?></span></h4>
      </div>
      
      
<?php


}else{

$subject 	= "";
$body 		=	"";
$sms 		= "";

if(isset($all_emails[$key]['subject'])){
$subject 	= $all_emails[$key]['subject'];
}

if($subject == "" && isset($default_email_array[$key]['default_subject']) ){
$subject = $default_email_array[$key]['default_subject'];
}

if(isset($all_emails[$key]['body'])){
$body 		= $all_emails[$key]['body'];
}

if($body == "" && isset($default_email_array[$key]['default_body']) ){
$body = $default_email_array[$key]['default_body'];
}

if(isset($all_emails[$key]['sms'])){
$sms 	= $all_emails[$key]['sms'];
}


if($sms == "" && isset($default_email_array[$key]['default_sms']) ){
$sms = $default_email_array[$key]['default_sms'];
}

?>


<div class="container px-0">
<div class="row py-2">


<div class="col-2">

 <div class="">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('<?php echo $key; ?>_enable').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('<?php echo $key; ?>_enable').value='1'">
                                  </label>
                                  <div class="toggle <?php if( isset($all_emails[$key]['enable']) && $all_emails[$key]['enable'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                                
                                          
                             <input type="hidden" id="<?php echo $key; ?>_enable" name="admin_values[emails][<?php echo $key; ?>][enable]"
                             value="<?php if(isset($all_emails[$key]['enable'])){ echo $all_emails[$key]['enable']; }else{ echo 0; } ?>">  
    

</div>

    <div class="col-6">
    
    <h6 class="txt500"><?php echo $val['name'] ?></h6> 
    
    <p class="mb-4 text-muted"><?php if(isset($val['desc'])){ echo $val['desc']; } ?></p>

    
    </div>
    <div class="col-md-4">
    
    <div class="">
    <a href="javascript:void(0);" onclick="jQuery('#<?php echo $key; ?>_showemail').toggle();" class="btn btn-success rounded-0 px-4">Email</a> | 
    <a href="javascript:void(0);" onclick="jQuery('#<?php echo $key; ?>_showsms').toggle();" class="btn btn-warning rounded-0 px-4">SMS</a> 
    </div>
    
    
    
    
    
     
                
                           
                   
    </div>
    
 
     
</div>


<div class="row py-2" style="display:none;" id="<?php echo $key; ?>_showemail">
<div class="col-12">
 
    <input type="text"  name="admin_values[emails][<?php echo $key; ?>][subject]" class="form-control mt-1 mb-2"  value="<?php echo stripslashes($subject); ?>" placeholder="Subject Here..."> 
  
    <?php echo wp_editor( stripslashes($body), 'email_id_'.$key, array( 'textarea_name' => 'admin_values[emails]['.$key.'][body]', 'editor_height' => '200px') );  ?>            
          
	<?php if(isset($val['shortcodes']) && is_array($val['shortcodes'])){ ?>
    <ul class="list-inline mt-3 small">
      <li class="list-inline-item font-weight-bold text-muted">Shortcodes:</li>
      <?php foreach($val['shortcodes'] as $g){ ?>
      <li class="list-inline-item">(<?php echo $g; ?>)</li>
      <?php } ?>
      <li class="list-inline-item">(date)</li>
      <li class="list-inline-item">(time)</li>
      <li class="list-inline-item">(link)</li>
    </ul>
    <?php } ?>
	 
</div>
</div>


<div class="row py-2" style="display:none;" id="<?php echo $key; ?>_showsms">
<div class="col-12">
 
    <textarea name="admin_values[emails][<?php echo $key; ?>][sms]" class="form-control mt-1 mb-2" style="height:100px; width:100%;"><?php echo stripslashes($sms); ?></textarea> 
    
    <p>Max: 100 Characters.</p>
   
	 
</div>
</div>

</div>



<?php } ?>

<?php $i++; } } ?> 


</div></div>

<div class="col-lg-4">


 

    <div class="card1 shadow my-1 bg-danger p-4" style="height:110px;">
    
    
     <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/17.png" class="text-white float-left mr-3" width="42" />
      
    <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#logs]').tab('show');" class="btn btn-dark float-right">View </a>
      <h4 class="text-white">Email Logs</h4>
      <p class="text-white" style="font-size:16px;">View sent emails.</p>  
   </div>   
    

    <div class="card1 shadow my-1 bg-success p-4 mt-4" style="height:110px;">
    
   <img src="<?php echo get_bloginfo('template_url')."/framework/admin/"; ?>images/icons/18.png" class="text-white float-left mr-3" width="42" />
  
      <a href="javascript:void(0);" onclick="jQuery('#MainTabs a[href=#send]').tab('show');" class="btn btn-dark float-right">Send </a>
      <h4 class="text-white">Send Email</h4>
      <p class="text-white" style="font-size:16px;">Sent a quick email.</p>  
   </div>   
 
 


 




</div>

</div>


<div class="bg-primary p-1 text-center mt-5 shadow" style="border-radius: 7px;">

<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 

</div>


<?php get_template_part('framework/admin/templates/admin', 'form-bottom' ); ?>