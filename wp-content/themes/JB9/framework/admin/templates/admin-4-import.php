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

// LOAD IN CORE VALUES
$csv_values = get_option("ppt_csv");

//update_option("ppt_csv","");

// GET FILE NAMES
$csv_files = get_option("ppt_csv_filenames"); 
?>

 



<?php

if (get_magic_quotes_gpc()) { ?>
<div class="alert alert-block alert-error">           
            <h4 class="alert-heading">Magic Quotes Detected</h4>
            <p>Please disable PHP magic quotes on your hosting account before running any imports otherwise it will fail.</p>
          </div>

<?php }

if(strpos(phpversion(),'5.3') !== false){ ?>
<div class="alert alert-block alert-error">           
<h4 class="alert-heading">PHP Version <?php echo phpversion(); ?> Detected</h4>
<p>Your hosting is running PHP version <?php echo phpversion(); ?> which may prevent local CSV files from being imported. If you cannot upload CSV files please ask your hosting to upgrade your PHP version to 5.4+.</p>
</div>     
<?php } ?> 


<div class="card">
<div class="card-header">
<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm float-right" >Upload CSV File</a>
 
<span>
Imported CSV Files
</span>
</div>
<div class="card-body1">   


      
 
 
 

 

 

<table id="csv_imports" class="responsive table table-striped table-bordered" >
<thead>
<tr>
	<th class="no_sort">Stored Table</th>
	<th class="no_sort" style="width:150px;text-align:center;">Rows</th>                
	<th class="no_sort" style="width:150px;text-align:center;">Actions</th>
</tr>
</thead>
<tbody>   


<?php  $o=1; if(is_array($csv_values)){  foreach($csv_values as $key => $row){  if($key == "0"){ continue; }  $o++; ?>
<tr>
<td>

<?php if(isset($csv_files[$key])){ echo $csv_files[$key]['name']; }else{ echo $key; } ?>



</td>

<td style="text-align:center;">

<?php echo number_format($row); ?>  

</td>        
<td class="ms text-center">

<a href="javascript:void(0);" onclick="jQuery('#tb-<?php echo $row; ?>').toggle();" rel="tooltip"  data-placement="top" data-original-title="preview file"  class="btn btn-sm btn-primary"><i class="fa fa-search"></i></a> 

<a class="btn btn-sm btn-primary" rel="tooltip" data-toggle="modal" href="#ImportCSVModal" data-placement="top" data-original-title="import file" 
onclick="jQuery('#csv_key1').val('<?php echo $key; ?>');jQuery('#csv_row1').val('<?php echo $row; ?>');"><i class="fa fa-download"></i></a> 
         
<form method="post" action="" style=" display: inline;">
<input type="hidden" name="admin_action" value="csv_delete" />
<input type="hidden" name="csvid" value="<?php echo $key; ?>" />
<button type="submit"  class="btn btn-sm btn-danger" rel="tooltip" data-placement="top"  data-original-title="delete file"><i class="fa fa-trash"></i></button>
</form> 

</td>
</tr>
         
<!-- end table main row -->


 <tr>
 <td id="tb-<?php echo $row; ?>" style="display:none;" colspan="3">
  <form method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="admin_action" value="csv_savetables" />
  <input type="hidden" name="database_table" value="<?php echo $key; ?>" />
  
         <table class="table table-bordered table-striped">
 
            <thead>
              <tr>
                <th>Database Key</th>
                <th>Column Value</th>
              </tr>
            </thead>
            <tbody>
<?php
$check_headers = array();
$row = $wpdb->get_results("SELECT * FROM ".$key." LIMIT 1", OBJECT);
 
if(is_object($row[0])){

foreach($row[0] as $key1=>$val){ if($key1 == ""){ continue; } 

$check_headers[$key1] = $key1;

?>
<tr><td>
<code><?php echo $key1; ?></code><small> - <a href="javascript:void(0);" onclick="jQuery('#changeme_<?php echo $key1; ?>').show();">rename</a></small>
<input type="hidden" name="table1[]" value="<?php echo $key1; ?>" />
<input type="text" style="display:none;" name="table2[]" id="changeme_<?php echo $key1; ?>" value="<?php echo $key1; ?>" />

</td><td><div style="max-width:300px;"><?php echo $val; ?></div></td></tr>

      
<?php } ?>        
              
            </tbody>
          </table>
          
<div class="text-center">

	<button type="submit" class="btn btn-primary">Save Changes</button>

</div>
        
<?php }   ?>  

        

<?php 

// CHECK THE HEADERS OTHERWISE SHOW WARNING
$showError = false; $showErrMsg = "";
$check_these_headers = array('post_title','post_content');
if(is_array($check_headers)){
foreach( $check_these_headers as $h){
	if(!in_array($h,$check_headers)){
		$showError = true;
		$showErrMsg .= "Missing Column Header: <b>".$h."</b><br />";
	}
}
}

if($showError){ ?> 
<tbody>     
<tr><td colspan="2">
<div class="alert alert-error">
<b>Warning!</b> Your CSV file is missing default columns headers. Any attempt to import will result in errors.
<hr /><?php echo $showErrMsg; ?>
<hr />
<?php if(is_array($row[0])){ ?>
<a href="<?php echo get_home_url(); ?>/wp-admin/admin.php?page=4&autofix=<?php echo $key; ?>" class="btn btn-error">Run Auto Fix</a>
<hr />
<?php } ?>
<a href="http://s.premiumpress.com/index.php?/Knowledgebase/Article/View/27/0/using-excel-spreadsheets-csv" target="_blank" style="color:#b94a48; text-align:center; text-decoration:underline">click here to see this knowledgebase article.</a>

</div>
 
 
<?php }   ?> 


</td>
</tr><!-- end div none -->
      

<?php } }  // end foreach ?>
            

</tbody>
</table> 

 
 







<form method="post" action="<?php echo get_home_url(); ?>/wp-admin/admin.php?page=4" name="savechartset">
<input type="hidden" name="charset" value="" id="charset" />

</form>
  
 
<form method="post" enctype="multipart/form-data" action="">
<input type="hidden" name="tab" value="csv"/>
<input type="hidden" name="admin_action" value="csv_upload" />
 
<div id="myModal" class="modal hide" tabindex="-1" role="dialog" >
<div class="modal-dialog" role="document">
<div class="modal-content">

      <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
              <h3 id="myModalLabel">Import CSV File</h3>
            </div>
            <div class="modal-body" style="min-height:350px;">
            
             Please ensure your .csv file is correctly formatted before uploading. If you are unsure how to format your files, please see this link: <b><a href="http://s.premiumpress.com/index.php?/Knowledgebase/Article/View/27/0/using-excel-spreadsheets-csv" target="_blank" style="text-decoration:underline;color:blue;">Formatting CSV Files</a></b> 
            <hr  />
            
            <b>Want to import an XML file?</b> All you need todo is convert it to CSV format using this free online tool: <a href="http://www.luxonsoftware.com/converter/xmltocsv" target="_blank" style="text-decoration:underline;color:blue;">XML to CSV convertor</a>
              
               <hr  />
                
  
  
  <input type="hidden" name="use_csv_header" id="use_csv_header" value="1" />
  
  
  
  <table class="table table-bordered table-striped">
          
         
            <tbody>
              <tr>
                <td>
                  <code>CSV File</code>
                </td>
                <td>   <div class="controls">
                  <div class="input-append row-fluid">
                    <input type="file"  name="file_source" id="file_source"> 
                    
                    <script>
jQuery(document).ready(function () {
jQuery.uniform.restore('input:file');
jQuery('#file_source').removeAttr( 'style' );
});
</script>
<style>
#file_source { opacity: 1; }
</style>
                     
                  </div>
                </div>
               
                </td>
              </tr>
              <tr>
                <td>
                  <code>Column Separator</code>
                </td>
                <td><input type="text" name="field_separate_char" id="field_separate_char" class="edt_30"  maxlength="1" value=","/></td>
              </tr>
              <tr>
                <td>
                  <code>Text qualifier /Enclose</code>
                </td>
                <td><input type="text" name="field_enclose_char" id="field_enclose_char" class="edt_30"  maxlength="1" value="<?php echo htmlspecialchars("\""); ?>"/></td>
              </tr>
              <tr>
                <td>
                  <code>Text Escape</code>
                </td>
                <td><input type="text" name="field_escape_char" id="field_escape_char" class="edt_30"  maxlength="1" value="<?php echo htmlspecialchars("\\"); ?>"/></td>
              </tr>
             
            </tbody>
          </table>
          
                       
            </div>
            
            <div class="modal-footer">
              <button class="btn" data-dismiss="modal">Close</button>
              <button class="btn btn-primary" type="submit">Save File</button>
            </div>
</div>
</div></div>
</form> 

<!-- Modal -->
<div class="modal fade" id="ImportCSVModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
 
      <div class="modal-body">
      
      <?php /*
            <h2 style="margin:0px;">Slow Import</h2> 
            <p>This is the recommended option for users on shared hosting accounts. It will take longer to import but has a better success rate for server setups with limitations on script execution times.
            </p>
             <a class="btn btn-primary" rel="tooltip" 
                  href="javascript:void(0);" onclick="StartImportCSV(jQuery('#csv_key1').val(),jQuery('#csv_row1').val());"
                  data-placement="left" data-original-title="start import" data-dismiss="modal">Start Slow Import</a> 
                  
                  <hr />
   */ ?>
                  <h2 class="h4">Quick Import</h2>
                  <hr />
                  
                  <p>This will attempt to import all items in one go. If you have a small amount of items to import this will run fine however if your file contains alot of data many hosting settings will timeout after a few minutes.
                  </p>
                  
<form method="post" action="<?php echo get_home_url(); ?>/wp-admin/admin.php?page=4&t=456" onsubmit="document.getElementById('modal-body1').innerHTML='Please Wait...<br><br>(this could take some time!)';">
<input type="hidden" name="admin_action" value="csv_import"  />
<input type="hidden" name="csv_key" id="csv_key1" value="0" />
<input type="hidden" name="csv_total" id="csv_total1" value="0" />
<input type="hidden" name="csv_row" id="csv_row1" value="0" />
<input type="hidden" name="csv_pagenumber" id="csv_pagenumber1" value="0" />
<input type="hidden" name="runall" value="yes" />

 <div><input type="checkbox" name="deleteall" value="1" />Delete All Existing Listings</div>
         
<hr />

<button type="submit" class="btn btn-primary"  rel="tooltip" data-placement="left" data-original-title="start import">Start Quick Import</button>
</form>
      </div>
 
    </div>
  </div>
</div> 