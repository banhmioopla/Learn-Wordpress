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

 ?>


<form method="post" name="admin_save_form" id="admin_save_form" enctype="multipart/form-data">
	<input type="hidden" name="submitted" value="yes">
	<input type="hidden" name="tab"  value="email">
	 
<style>
.ah {  
 background: #f7f7f7;
border: 1px solid #dddddd;
border-radius: 4px;
-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05); 
display: block;
padding: 8px 15px;
color: #269ccb;
font-weight: bold;
margin-bottom:10px;
}
.cb { margin-right:10px !important; }
</style>
 

 
 <script>
function changeboxme(id){

 var v = jQuery("#"+id).val();
 if(v == 1){
 jQuery("#"+id).val('0');
 }else{
 jQuery("#"+id).val('1');
 }
 
}
</script>



<div class="row">
    <div class="col-md-6">
    
    <label>Report Features</label>
    
    <div class="small margin-bottom2">Tick the features below you want to include in your report.</div>
    
    <div class="ah">    
    <input name="" type="checkbox" value="1" class="cb" onchange="changeboxme('box1');" <?php if(_ppt(array('wlt_report','f1')) == 1){ ?>checked="checked"<?php } ?>  /> 10 Most Recent Listings
    <input type="hidden" name="admin_values[wlt_report][f1]" value="<?php echo _ppt(array('wlt_report','f1')); ?>" id="box1" />   
    </div>
    
     <div class="ah">    
    <input name="" type="checkbox" value="1" class="cb" onchange="changeboxme('box2');" <?php if(_ppt(array('wlt_report','f2')) == 1){ ?>checked="checked"<?php } ?> /> 10 Most Popular Listings
    <input type="hidden" name="admin_values[wlt_report][f2]" value="<?php echo _ppt(array('wlt_report','f2')); ?>" id="box2" />   
    </div>   
    
    <div class="ah">    
    <input name="" type="checkbox" value="1" class="cb" onchange="changeboxme('box3');" <?php if(_ppt(array('wlt_report','f3')) == 1){ ?>checked="checked"<?php } ?> /> 10 Most User Rated Listings
    <input type="hidden" name="admin_values[wlt_report][f3]" value="<?php echo _ppt(array('wlt_report','f3')); ?>" id="box3" />   
    </div>  
      
    <div class="ah">    
    <input name="" type="checkbox" value="1" class="cb" onchange="changeboxme('box4');" <?php if(_ppt(array('wlt_report','f4')) == 1){ ?>checked="checked"<?php } ?> /> 10 Most Recent Orders
    <input type="hidden" name="admin_values[wlt_report][f4]" value="<?php echo _ppt(array('wlt_report','f4')); ?>" id="box4" />   
    </div>
    
    <div class="ah">    
    <input name="" type="checkbox" value="1" class="cb" onchange="changeboxme('box5');" <?php if(_ppt(array('wlt_report','f5')) == 1){ ?>checked="checked"<?php } ?> /> 10 Most User Search Terms
    <input type="hidden" name="admin_values[wlt_report][f5]" value="<?php echo _ppt(array('wlt_report','f5')); ?>" id="box5" />   
    </div>    
    
    <div class="ah">    
    <input name="" type="checkbox" value="1" class="cb" onchange="changeboxme('box6');" <?php if(_ppt(array('wlt_report','f6')) == 1){ ?>checked="checked"<?php } ?> /> 10 Most Recent Comments
    <input type="hidden" name="admin_values[wlt_report][f6]" value="<?php echo _ppt(array('wlt_report','f6')); ?>" id="box6" />   
    </div>  
      
    <div class="ah">    
    <input name="" type="checkbox" value="1" class="cb" onchange="changeboxme('box7');" <?php if(_ppt(array('wlt_report','f7')) == 1){ ?>checked="checked"<?php } ?> /> 10 Most Active Listing Authors
    <input type="hidden" name="admin_values[wlt_report][f7]" value="<?php echo _ppt(array('wlt_report','f7')); ?>" id="box7" />   
    </div>  
    
            
    </div>
    
    <div class="col-md-6">
    
        <label>Email Daily Report</label>
        
    	<div class="small">Enter your email below to recieve the daily report.</div> 
    
    	<div class="card mb-2"><div class="card-body">
       
            <div class="form-group">
            
                <label>Email Report To</label>
              
                <input type="text" name="admin_values[wlt_report][email]" class="form-control" value="<?php echo _ppt(array('wlt_report','email')); ?>">
             
            </div>
   
           
        </div></div>
        
        
        
       <label>Download Report Now</label>
        
    	<div class="small">Select the date range to download the report now.</div> 
    
    	<div class="card"><div class="card-body">
       
       
       
       <script>jQuery(function(){ jQuery('#reg_field_1_date1').datetimepicker({pickTime: false});  jQuery('#reg_field_2_date1').datetimepicker({pickTime: false});}); </script>
	     
            <div class="m-t-0">
            
                <label>Date From</label>            
                
      <div class="input-group" id="reg_field_1_date1" data-date-format="yyyy-MM-dd">
          
          <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fal fa-calendar"></i></span></span>
                    
                    <input type="text" name="date1" value="<?php echo date('Y-m-d H:i:s' , strtotime('-7 days')); ?>" id="date1"  data-format="yyyy-MM-dd hh:mm:ss" class="form-control" />
                              
                </div>
                
            </div>
            
            
            <div class="">
                <label>Date To</label>
                
                	 
                    
                     <div class="input-group" id="reg_field_2_date1" data-date-format="yyyy-MM-dd">
          
          <span class="add-on input-group-prepend"><span class="input-group-text"><i class="fal fa-calendar"></i></span></span>
                    
                    <input type="text" name="date2" value="<?php echo date('Y-m-d H:i:s'); ?>" id="date2"  data-format="yyyy-MM-dd hh:mm:ss" class="form-control" />
                             
                </div>
                
            </div>  
            
             
            
          <button class="btn btn-info mt-3" onclick="jQuery('#runreportnow').val('yes');">Generate Report</button> 
    
    <input name="runreportnow" value="" id="runreportnow" type="hidden" />
            
       
        </div></div>
        



     
    </div></div> 
    

</div></div>     