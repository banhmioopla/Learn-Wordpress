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

// SAVE CUSTOM FIELD DATE
if(isset($_POST['csubscriptions']) && current_user_can('administrator') ){

update_option("csubscriptions", $_POST['csubscriptions']);
}
  
$csubscriptions = get_option("csubscriptions"); 
 
if(!is_array($csubscriptions)){ $csubscriptions = array(); }  
 
// SETUP ARRAY FOR EXISTING KEYS
// ENCASE THE USER HASNT REALISED THEY ARE THE SAME
$ekeys = array();
  
?> 
 

<script>
jQuery(document).ready(function() {	
    jQuery( "#package-list" ).sortable(); 

});
</script> 





<div class="row">

<div class="col-lg-8">

<div class="bg-white p-3 shadow" style="border-radius: 7px;">


      
<div class="accordion" id="accordionExample">
 
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/c/0.png" class="title-img">
          <div class="title">Packages</div>
        </button>
      </h2>
    </div>    


    <div id="collapseOne" class="collapse <?php if(!isset($_POST['submitted'])){ ?>show<?php } ?>" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body px-0">
      
      
      <div class="tabheader mb-4"> 
      <a href="javascript:void(0);" onClick="jQuery('#package-list .cfielditem').hide(); jQuery('#package-list_new').clone().appendTo('#package-list');" class="btn btn-sm btn-primary float-right">Add New</a>	

      <h4><span>Membership Packages</span></h4> </div>
 
 
 
<ul id="package-list">
<?php 
 

if(is_array($csubscriptions) && !empty($csubscriptions) ){ $i=0; 
 

foreach($csubscriptions['name'] as $data){ 

	if($csubscriptions['name'][$i] != "" ){  ?>
    
    
<li class="cfielditem closed " id="rowid-<?php echo $i; ?>">
	
    <div class="heading">
       
     	<div class="showhide">
        
         <a href="#" onclick="jQuery('.cf-<?php echo $i; ?>').fadeToggle();" rel="tooltip" data-original-title="Show/Hide Options" data-placement="top" class="btn btn-primary btn-sm">
            <i class="fa fa-search" aria-hidden="true"></i>
            </a>   
        
        
        <a href="#" onClick="jQuery('#rowid-<?php echo $i; ?>').html('').hide();" rel="tooltip" data-original-title="Delete" data-placement="top" class="btn btn-dark confirmdelete btn-sm">
        <i class="fas fa-times" aria-hidden="true"></i>
        </a>
        
        
                                          
        </div>     
        
               

        <div class="name">
         
        
        <small><strong>key: <?php echo $csubscriptions['key'][$i]; ?></strong></small>
        
        &nbsp; <strong><?php echo stripslashes($csubscriptions['name'][$i]); ?></strong>  
        
        <?php if(isset($csubscriptions['recurring'][$i]) && $csubscriptions['recurring'][$i] == '1'){ echo "<span class='badge badge-danger ml-2 mt-2'>recurring</span>"; } ?>


        
        </div>
    
    </div>
    
    <div class="inside cf-<?php echo $i; ?>">  
         
<div class="row">
   <div class="col-md-12"> 
      <label class="txt500">Display Name <span class="required">*</span></label>      
      <input type="text" name="csubscriptions[name][]" id="title-<?php echo $i; ?>" value="<?php echo stripslashes($csubscriptions['name'][$i]); ?>" class="form-control"  />
   </div>
   <?php /*
   <div class="col-md-6"> 
      <label class="txt500">Sub Title (optional)</label>      
      <input type="text" name="csubscriptions[subtitle][]" id="title-<?php echo $i; ?>" value="<?php echo $csubscriptions['subtitle'][$i]; ?>" class="form-control"  />
   </div>
   */ ?>
</div>
<!-- end row -->
<div class="mt-3 mb-3">
   <label class="txt500">Description</label>
   <textarea name="csubscriptions[desc][]" class="form-control" style="height:100px !important;"><?php if(isset($csubscriptions['desc'][$i])){ echo stripslashes($csubscriptions['desc'][$i]); } ?></textarea>
</div>
<div class="row mt-1">
   <div class="col-md-4">
      <label class="txt500">Price <span class="required">*</span></label>
      <div class="input-group">
         <span class="input-group-prepend input-group-text"><?php echo hook_currency_symbol(''); ?></span>
         <input type="text" name="csubscriptions[price][]" id="price-<?php echo $i; ?>" value="<?php echo $csubscriptions['price'][$i]; ?>" class="form-control"  />  
      </div>
   </div>
   <div class="col-md-4">
   
   
      <label class="txt500">Renewal Frequency</label>
       <?php if(isset($csubscriptions['days'][$i]) && in_array($csubscriptions['days'][$i], array(1,7,30,365) )){ ?>
      <select class="form-control" name="csubscriptions[days][]">
      <option value="1" <?php if(isset($csubscriptions['days'][$i]) && $csubscriptions['days'][$i] == 1){ echo "selected=selected"; } ?>>Daily</option>
      <option value="7" <?php if(isset($csubscriptions['days'][$i]) && $csubscriptions['days'][$i] == 7){ echo "selected=selected"; } ?>>Weekly</option>
      <option value="30" <?php if(isset($csubscriptions['days'][$i]) && $csubscriptions['days'][$i] == 30){ echo "selected=selected"; } ?>>Monthly</option>
      <option value="365" <?php if(isset($csubscriptions['days'][$i]) && $csubscriptions['days'][$i] == 365){ echo "selected=selected"; } ?>>Yearly</option>
      <option value="99">Custom Frequency</option>
      </select>
      <?php }else{ ?>
      <input type="text" name="csubscriptions[days][]" class="form-control" value="<?php echo $csubscriptions['days'][$i]; ?>">
      <?php } ?>
      
   </div>
   
   
   <div class="col-md-4">
      <label class="txt500">Recurring Payment</label>
      <div style="margin-top: 5px;">
         <label class="radio off">
         <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('pak-recurring-<?php echo $i; ?>').value='0'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('pak-recurring-<?php echo $i; ?>').value='1'">
         </label>
         <div class="toggle <?php if(isset($csubscriptions['recurring'][$i]) && $csubscriptions['recurring'][$i] == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="pak-recurring-<?php echo $i; ?>" name="csubscriptions[recurring][]"
         value="<?php if(isset($csubscriptions['recurring'][$i])){ echo $csubscriptions['recurring'][$i]; } ?>">
   </div>
</div>
        
        
<?php if(THEME_KEY == "da"){ ?>
<h6 class="bg-success text-white text-center py-2 mb-4 mt-4">Website Access</h6> 

<div class="row mt-1">
   <div class="col-md-6">
      <label class="txt500">Send Virtual Gifts</label> 
      <p class="desc">This will allow users to send virtual gifts to other members.</p>           
   </div> 
   <div class="col-md-6">   
      <div style="margin-top: 5px;">
         <label class="radio off mt-4">
         <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('pak-gift-<?php echo $i; ?>').value='0'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('pak-gift-<?php echo $i; ?>').value='1'">
         </label>
         <div class="toggle <?php if(isset($csubscriptions['access_gift'][$i]) && $csubscriptions['access_gift'][$i] == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="pak-gift-<?php echo $i; ?>" name="csubscriptions[access_gift][]"
         value="<?php if(isset($csubscriptions['access_gift'][$i])){ echo $csubscriptions['access_gift'][$i]; }else{ echo 0; }  ?>">
   </div>
</div> 

<div class="row mt-1">
   <div class="col-md-6">
      <label class="txt500">Send &amp; Receive Messages</label> 
      <p class="desc">This will allow users to send and receive messages.</p>
           
   </div> 
   <div class="col-md-6">   
      <div style="margin-top: 5px;">
         <label class="radio off mt-4">
         <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('pak-msg-<?php echo $i; ?>').value='0'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('pak-msg-<?php echo $i; ?>').value='1'">
         </label>
         <div class="toggle <?php if(isset($csubscriptions['access_messages'][$i]) && $csubscriptions['access_messages'][$i] == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="pak-msg-<?php echo $i; ?>" name="csubscriptions[access_messages][]"
         value="<?php if(isset($csubscriptions['access_messages'][$i])){ echo $csubscriptions['access_messages'][$i]; }else{ echo 0; }  ?>">
   </div>
</div>  

<div class="row mt-1">
   <div class="col-md-6">
      <label class="txt500">Chat room Access</label> 
      <p class="desc">This will allow users to access the chat room page.</p>
           
   </div> 
   <div class="col-md-6">   
      <div style="margin-top: 5px;">
         <label class="radio off mt-4">
         <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('pak-chat-<?php echo $i; ?>').value='0'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('pak-chat-<?php echo $i; ?>').value='1'">
         </label>
         <div class="toggle <?php if(isset($csubscriptions['access_chatroom'][$i]) && $csubscriptions['access_chatroom'][$i] == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="pak-chat-<?php echo $i; ?>" name="csubscriptions[access_chatroom][]"
         value="<?php if(isset($csubscriptions['access_chatroom'][$i])){ echo $csubscriptions['access_chatroom'][$i]; }else{ echo 0; }  ?>">
   </div>
</div>        


<div class="row mt-1">
   <div class="col-md-6">
      <label class="txt500">Featured Profile</label> 
      <p class="desc">This will appear top of searches and display a featured badge.</p>
           
   </div> 
   <div class="col-md-6">   
      <div style="margin-top: 5px;">
         <label class="radio off mt-4">
         <input type="radio" name="toggle" 
            value="off" onchange="document.getElementById('pak-fea-<?php echo $i; ?>').value='0'">
         </label>
         <label class="radio on">
         <input type="radio" name="toggle"
            value="on" onchange="document.getElementById('pak-fea-<?php echo $i; ?>').value='1'">
         </label>
         <div class="toggle <?php if(isset($csubscriptions['access_featured'][$i]) && $csubscriptions['access_featured'][$i] == '1'){  ?>on<?php } ?>">
            <div class="yes">ON</div>
            <div class="switch"></div>
            <div class="no">OFF</div>
         </div>
      </div>
      <input type="hidden" id="pak-fea-<?php echo $i; ?>" name="csubscriptions[access_featured][]"
         value="<?php if(isset($csubscriptions['access_featured'][$i])){ echo $csubscriptions['access_featured'][$i]; }else{ echo 0; } ?>">
   </div>
</div> 


<div class="row formrow mt-3">
   <div class="col-md-6">
      <label class="txt500">Max Media Uploads</label>
      <p class="text-muted">Set the max number of images/videos users can add to their profile.</p>
   </div>
   <div class="col-md-4">
      <div class="input-group">
         <span class="input-group-prepend input-group-text">#</span>
         <input type="text" name="csubscriptions[access_maxuploads][]" value="<?php if(!isset($csubscriptions['access_maxuploads'][$i])){ echo 10; }else{ echo $csubscriptions['access_maxuploads'][$i]; } ?>" class="form-control"  />  
      </div>
   </div>
</div>




<?php }else{ ?>
<h6 class="bg-success text-white text-center py-2 mb-4 mt-4">Listings</h6>
<div class="row formrow mt-3">
   <div class="col-md-7 pr-5">
      <label class="txt500">Listing Included</label>
      <p class="text-muted">Set a number of listings that comes free with this membership.</p>
   </div>
   <div class="col-md-5">
      <div class="input-group">
         <span class="input-group-prepend input-group-text">#</span>
         <input type="text" name="csubscriptions[listings][]" value="<?php if(!isset($csubscriptions['listings'][$i])){ echo 10; }else{ echo $csubscriptions['listings'][$i]; } ?>" class="form-control"  />  
      </div>
   </div>
</div>
<div class="row formrow">
   <div class="col-md-7 pr-5">
      <label class="txt500">Listing Package</label>
      <p class="text-muted">This specifics which package (including features) the listings are assigned too.</p>
   </div>
   <div class="col-md-5">
     
     
     
<select name="csubscriptions[listings_pak][]" class="form-control">
<option value=""></option>
<?php $k=0; 
$paknames = array('Basic','Standrad','Premium');

while($k < 3){ ?>
<option value="<?php echo $k; ?>" <?php if(isset($csubscriptions['listings_pak'][$i]) && $csubscriptions['listings_pak'][$i] == $k){ echo "selected=selected"; } ?>><?php if(_ppt('pak'.$k.'_name') == ""){ echo $paknames[$k]; }else{ echo _ppt('pak'.$k.'_name'); } ?> </option>
<?php $k++; } ?>
 
</select>
     
   </div>
   <div class="col-md-4">
   </div>
</div>
<?php } ?> 
        
     
        
        
        <?php if(defined('WLT_CREDITSYSTEM')){ ?>
        <h6 class="bg-success text-white text-center py-2 mb-4">Credit &amp; Tokens </h6>
        
        
        <div class="row py-2 mt-1"> 
        
            <div class="col-md-7 pr-5">
            
            <label class="mt-3">Credit Included</label>
            
            <p class="text-muted mt-2">Set the amount of credit that is added to a users account who subscribes to this membership. </p>
            
            </div>
        
        	<div class="col-md-4">
            
            <small>To begin with</small>
            
            <div class="input-group">
              <span class="input-group-prepend input-group-text">#</span>
              <input type="text" name="csubscriptions[credit][]" value="<?php if(!isset($csubscriptions['credit'][$i])){ echo 10; }else{ echo $csubscriptions['credit'][$i]; } ?>" class="form-control"  />  
            </div> 
            
            <small>Per Day</small>
            
             <div class="input-group">
              <span class="input-group-prepend input-group-text">#</span>
              <input type="text" name="csubscriptions[day_credit][]" value="<?php if(!isset($csubscriptions['day_credit'][$i])){ echo 10; }else{ echo $csubscriptions['day_credit'][$i]; } ?>" class="form-control"  />  
            </div>     
            
              
            </div>
            
         </div>
         <div class="row py-2"> 
         
            <div class="col-md-7 pr-5">
            
            <label class="mt-3">Tokens Included</label>
            
            <p class="text-muted mt-2">Set the amount of tokens that is added to a users account who subscribes to this membership. </p>
            
            </div>
            
        	<div class="col-md-4"> 
            
            <small>To begin with</small>
            <div class="input-group">
              <span class="input-group-prepend input-group-text">#</span>
              <input type="text" name="csubscriptions[tokens][]" value="<?php if(!isset($csubscriptions['tokens'][$i])){ echo 10; }else{ echo $csubscriptions['tokens'][$i]; } ?>" class="form-control"  />  
            </div>  
            
            <small>Per Day</small>
            
             <div class="input-group">
              <span class="input-group-prepend input-group-text">#</span>
              <input type="text" name="csubscriptions[day_tokens][]" value="<?php if(!isset($csubscriptions['day_tokens'][$i])){ echo 10; }else{ echo $csubscriptions['day_tokens'][$i]; } ?>" class="form-control"  />  
            </div> 
            
            

           </div> 
           
           <div class="col-md-4">
			 
            
            
            </div>
            
        </div><!-- end row -->

<?php } ?>
         
        
        
        
        
        
       <h6 class="bg-success text-white text-center py-2 mb-4 mt-4">Admin Extras</h6>
 
    
        
        <div class="row mt-1">
 
        
        	<div class="col-md-6">
            
             <label class="txt500">Unique Package Key <span class="required">*</span> </label>
             
             <?php
			 if(in_array($csubscriptions['key'][$i],$ekeys)){
			 	$key = $csubscriptions['key'][$i]."".rand(0,10000);
			 }else{
				$key = $csubscriptions['key'][$i];			 	
			 }
			 $ekeys[] = $key;
			 ?>
             
              <input type="text" name="csubscriptions[key][]" id="key-<?php echo $i; ?>" value="<?php echo $key; ?>" class="form-control"  />        
             
            </div>   
                 
        <div class="col-md-6">
        
        
        <label class="txt500">Hide Package</label>
        

<?php

	// ADD ON SUBSCRIPTIONS
 
	if(is_array($csubscriptions) && !empty($csubscriptions) ){ 
	 
		$h=0;	
		foreach($csubscriptions['name'] as $xxx){ 
			if(strlen($xxx) > 0){
			
			$status[$csubscriptions['key'][$h]] = $xxx;
			
			}
		$h++;
		}
		
	}
	
	$value1 = array();
	if(isset($csubscriptions['hide'][$i])){ $value1 = $csubscriptions['hide'][$i]; }
	if(!is_array($value1)){  $value1 = array();  }
 	
	?>
	<select name="csubscriptions[hide][<?php echo $i; ?>][]" style="width:100%; height:100px;" multiple="multiple">
		<?php foreach($status as $key1 => $club){ ?>
		<option value="<?php echo $key1; ?>" <?php if( in_array($key1, $value1) ){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
		<?php } ?>
        <option></option>
   </select>
   
    <p class="mt-2 text-muted">Here you choose which subscriptions are hidden when a user has purchased this one.</p>
       
        
        </div>
        
        </div>
        
        

	</div>
    
</li>

 <?php $i++; } ?>    
    
<?php } ?>    

<?php } ?>  
</ul>
 

</div></div>


 
<?php if(is_array($csubscriptions) && count($csubscriptions) > 0 ){  ?>  
    
      

    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/c/1.png" class="title-img">
          <div class="title">Transfer </div>
        </button>
      </h2>
    </div>    


    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body bg-light">
<div class="tabheader mb-4"> <h4><span>Transfer Memberships</span></h4> </div>
 


 
<div class="row">


<div class="col-md-6">

      <label class="txt500">From Package</label>
        <select onchange="jQuery('#fromM').val(this.value);" class="form-control">
        <option></option>
          <?php $i = 0; if(is_array($csubscriptions) && !empty($csubscriptions) ){   foreach($csubscriptions['name'] as $data){ if($csubscriptions['name'][$i] != "" ){ ?> 
          
                <option value="<?php echo $csubscriptions['key'][$i]; ?>"><?php echo stripslashes($csubscriptions['name'][$i]); ?></option>
                
          <?php } $i++;  } } ?> 
          
        </select>

</div>

<div class="col-md-6">

<label class="txt500">To Package</label>

        <select onchange="jQuery('#toM').val(this.value);" class="form-control">
        <option></option>
          <?php $i = 0; if(is_array($csubscriptions) && !empty($csubscriptions) ){   foreach($csubscriptions['name'] as $data){ if($csubscriptions['name'][$i] != "" ){ ?> 
          
                <option value="<?php echo $csubscriptions['key'][$i]; ?>"><?php echo stripslashes($csubscriptions['name'][$i]); ?></option>
                
          <?php } $i++;  } } ?> 
          
        </select>

</div>


</div>

<div class="text-center py-4">
<button class="btn btn-primary " type="button" onclick="document.TransferFormMembership.submit();">Start Transfer</button>
</div>
</div></div>
<?php } ?> 








    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/images/icons/c/2.png" class="title-img">
          <div class="title">Settings</div>
        </button>
      </h2>
    </div>    


    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body bg-light">
 
 

<div class="tabheader mb-4"> <h4><span>Membership Settings</span></h4> </div>


 
<div class="container px-0 border-bottom mb-3">
<div class="row py-2">
    <div class="col-6">    
        <label class="txt500">Membership On Sign-up</label>
         <p class="text-muted">Here you can set a membership that is automatically assigned to members when they register.</p>
      
         
    </div>
    
    <div class="col-6">


	<?php

	$status = array(
		"" => "None",
		 
	);
	
	// ADD ON SUBSCRIPTIONS
	$csubscriptions = get_option("csubscriptions"); 
	if(is_array($csubscriptions) && !empty($csubscriptions) ){ 
	 
		$i=0;	
		foreach($csubscriptions['name'] as $xxx){ 
			if(strlen($xxx) > 0){
			
			$status[$csubscriptions['key'][$i]] = $xxx;
			
			}
		$i++;
		}
		
	}
 
	
	?>
	<select name="admin_values[regmembership]"   class="form-control" style="widht:100%;">
		<?php foreach($status as $key => $club){ ?>
		<option value="<?php echo $key; ?>" <?php if(_ppt('regmembership') == $key){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
		<?php } ?>
	</select>  
    
    
        
    </div>
    
</div></div>
 
<!-- ------------------------- -->
 
<div class="container px-0 border-bottom mb-3">
<div class="row py-2">

    <div class="col-6">
    
        <label class="txt500">Page Access</label>
         <p class="text-muted">Here you can set a default membership for listings preventing non-members from viewing pages. </p>
     
      
    </div>
    
    <div class="col-6">
    
	<?php

	$status = array(
		"" => "Everyone",
		"1" => "Members Only",		
		"subs" => "Members With Subscriptions",
	 
	);
	
	// ADD ON SUBSCRIPTIONS
	$csubscriptions = get_option("csubscriptions"); 
	if(is_array($csubscriptions) && !empty($csubscriptions) ){ 
	 
		$i=0;	
		foreach($csubscriptions['name'] as $xxx){ 
			if(strlen($xxx) > 0){
			
			$status[$csubscriptions['key'][$i]] = $xxx;
			
			}
		$i++;
		}
		
	}
 
	
	?>
	<select name="admin_values[listingaccess]"   class="form-control" style="widht:100%;">
		<?php foreach($status as $key => $club){ ?>
		<option value="<?php echo $key; ?>" <?php if(_ppt('listingaccess') == $key){  echo "selected=selected"; } ?>><?php echo $club; ?></option>
		<?php } ?>
	</select>  
    
        
    
</div>
</div></div>
 
 
<!-- ------------------------- -->
 
<div class="container px-0 border-bottom mb-3">
<div class="row py-2">

    <div class="col-6">
    
        <label class="txt500">Redirect</label>
         <p class="text-muted">This is the link a user will be redirected to if they do not have access. </p>
     
      
    </div>
    
    <div class="col-6">
    
     <input type="text" class="form-control btn-block"  name="admin_values[listingaccess_redirect]" value="<?php 
	 
	 if(_ppt('listingaccess_redirect') == ""){ 
	 
	 	echo _ppt(array('links','memberships'))."?noaccess=1"; 
	 
	 }else{ 
	 
		 echo _ppt('listingaccess_redirect'); 
	 
	 } 
	 
	 ?>">
     
     <div class="small mt-2">Add '?noaccess=1' for extra details.</div>

	</div>
</div>    
 </div>
<!-- ------------------------- -->
<div class="container px-0">
<div class="row py-2">
<div class="col-12">

<label class="txt500">Hidden Content Message</label>
<p class="text-muted">This content is displayed within a page or post when a member is unable to view content due to membership restrictions.</p>

<textarea name="admin_values[listingaccessmsg]" style="height:200px !important;" class="form-control"><?php if(_ppt('listingaccessmsg') == ""){ ?><div class="alert alert-danger rounded-0">
<h4>Content Hidden</h4><p class="mb-0">Content content is visible to members only!</p>
</div><?php }else{ echo stripslashes(_ppt('listingaccessmsg')); } ?></textarea>
</div>


</div>

</div>



<hr />
<h6><i class="fa fa-info mr-2" aria-hidden="true"></i> Example Usage</h6>
<p>Here is an example of how to hide content within your own pages using the membership system;</p>

<pre class="bg-dark text-white p-4 border">
[MEMBERSHIP show="mem1, mem2, {key here}"] &nbsp; my hidden secret content &nbsp; [/MEMBERSHIP]
</pre>
 
 
</div>


</div>
</div>

</div>





 
 


</div>

<div class="col-lg-4">





<div class="container bg-light py-3 mb-4 p-4">
   <div class="row">

      <div class="col-4">
         <div class="">
            <label class="radio off">
            <input type="radio" name="toggle" 
               value="off" onchange="document.getElementById('enable_memberships').value='0'">
            </label>
            <label class="radio on">
            <input type="radio" name="toggle"
               value="on" onchange="document.getElementById('enable_memberships').value='1'">
            </label>
            <div class="toggle <?php if(_ppt('enable_memberships') == '1'){  ?>on<?php } ?>">
               <div class="yes">ON</div>
               <div class="switch"></div>
               <div class="no">OFF</div>
            </div>
         </div>
         <input type="hidden" id="enable_memberships" name="admin_values[enable_memberships]" value="<?php echo _ppt('enable_memberships'); ?>">
      </div>
      
      <div class="col-8 text-left">
         <h4 class="txt500">Memberships</h4>

      </div>
      
      <div class="col-12">
      
       <div class="text-muted py-3">Turn on/off to allow members to purchase advertising from you.</div>
      
      </div>
      
      
   </div>
   
    <button type="submit" class="btn btn-lg btn-primary btn-block rounded-0"><?php echo __("Save Settings","premiumpress-admin"); ?></button> 
    
    
    <div class="mt-4">
    
    <?php if(_ppt(array('links','memberships')) == ""){ ?>    
    <p class="text-danger pb-0"><i class="fa fa-warning"></i> Memberships page not set. Please <a href="admin.php?page=2&tab=pagelinks" target="_blank">configure here.</a></p>     
    <?php }else{ ?>    
    <p class="text-muted pb-0"><i class="fa fa-angle-right"></i> Visit the memberships <a href="<?php echo _ppt(array('links','memberships')); ?>" target="_blank">page here.</a></p>    
    <?php } ?>
    </div>
     
</div>
 




 <div class="bg-light p-3 mt-5">
 
 
<div class="tabheader mt-2"> <h4><span><i class="fa fa-bar-chart float-right text-primary mr-2"></i> Membership Statistics</span></h4> </div>

<?php $ores = $wpdb->get_results("SELECT count(*) as total FROM ".$wpdb->usermeta." WHERE  meta_key = 'wlt_subscription' ");
 ?>

<div class="p-3 border-bottom mb-2">

Users With Memberships <span class="float-right"><a href="users.php?memid=99" target="_blank"><?php if(isset($ores[0])){ echo $ores[0]->total; }else{ echo 0; } ?></a></span>

</div>

<?php $i=0; 


if(is_array($csubscriptions) && !empty($csubscriptions) ){ $i=0; 
 

foreach($csubscriptions['name'] as $data){ 

	if($csubscriptions['name'][$i] != "" ){ 
	
	$ores = $wpdb->get_results("SELECT count(*) as total FROM ".$wpdb->usermeta." WHERE  meta_key = 'wlt_subscription' AND meta_value LIKE '%".$csubscriptions['key'][$i]."%'");
	 
?>
 
        
<div class="p-3 border-bottom mb-2">

<i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo $csubscriptions['name'][$i]; ?>


<span class="float-right"><a href="users.php?memid=<?php echo $csubscriptions['key'][$i]; ?>" target="_blank"><?php if(isset($ores[0])){ echo $ores[0]->total; }else{ echo 0; } ?></a></span>

</div>

<?php  } $i++; } } ?>


 

</div>



</div></div>



















<div style="display:none"><div id="package-list_new">

    <li class="cfielditem"> 
    
    <div class="heading">
    <div class="name">New Package</div>
    </div>
    <div class="inside">    
       
        <label class="txt500">Package Name <span class="required">*</span></label>
        <input type="text" name="csubscriptions[name][]" value="" id="nfaqt" class="form-control" />  
        <input type="hidden" name="csubscriptions[price][]" value="100"  />  
        <input type="hidden" name="csubscriptions[key][]" value="subs<?php echo count($csubscriptions); ?>"   />    
  	 
        <input type="hidden" name="csubscriptions[recurring][]" value="0"   />    
        <input type="hidden" name="csubscriptions[tokens][]" value="0"   />    
        <input type="hidden" name="csubscriptions[credit][]" value="0"   />   
        
                <input type="hidden" name="csubscriptions[day_tokens][]" value="5"   />    
        <input type="hidden" name="csubscriptions[day_credit][]" value="5"   />  
         
        <input type="hidden" name="csubscriptions[days][]" value="30"   />    
        <input type="hidden" name="csubscriptions[subtitle][]" value=""   />
         <input type="hidden" name="csubscriptions[stars][]" value="0"   />
         <input type="hidden" name="csubscriptions[icon][]" value="fa fa-star"   />
         <input type="hidden" name="csubscriptions[active][]" value="0"   />
         
         
         <input type="hidden" name="csubscriptions[hide][]" value="0"   />
        
    <hr />
    <button class="btn btn-primary" type="submit" onclick="checknotblank()">Save</button>
    
    </div>
    
    </li>  
      
</div></div>

<script>
function checknotblank(){
if(jQuery('#nfaqt').val() == ""){  jQuery('#nfaqt').val(' '); }
}
</script>