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
// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values"); 
 
// LOAD IN LANGUAGE FILES
$wlt_languagefiles = get_option("wlt_languagefiles");
if(!is_array($wlt_languagefiles)){ $wlt_languagefiles = array(); }
  
?> 



<div class="pptwarning">
 
This section is for older customers as we now recommend you use language plugins instead of editing the core language files. It's quicker, easier and provider alot more support for backups, import/export etc

</div>


<div class="row-fluid">
<div class="span6">

 

   <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
            <thead>
            <tr>
              <th class="no_sort">Filename </th>
                            
              <th class="no_sort" style="width:110px;text-align:center;">Actions</th>
              
            </thead>
            <tbody>
            
        <?php foreach($wlt_languagefiles as $key=>$field){ ?>
		<tr>
         <td>
         
		 <p><?php echo stripslashes($field['name']); ?></p>
		 <small>added <?php echo hook_date($field['name']); ?></small>
         
         </td>         
        
         <td class="ms">
         <center>
                <div class="btn-group1">
                                    
                  <a class="btn btn-inverse btn-small confirm" rel="tooltip" data-placement="bottom" 
                  data-original-title="Remove"
                  href="admin.php?page=16&delete_file=<?php echo $key; ?>"
                  ><i class="gicon-remove icon-white"></i></a> 
                </div>
            </center>
            </td>
            </tr>
            <?php  }   ?> 

            </tbody>
            </table>
<hr /> 

<a data-toggle="modal" href="#EmailModal" class="btn btn-success">Upload Language File</a>


</div>
<div class="span6">

<div class="box gradient">
<div class="title">

<!--
<a data-toggle="modal" href="#VideoModelBox" class="btn btn-warning youtube" onclick="PlayPPTVideo('lkuP0JEsbjY','videoboxplayer','479','350');" style="float:right;margin-top:5px; margin-right:5px;">Watch Video</a>
-->

<div class="row-fluid"><h3>  Settings</h3></div></div><div class="content">


<?php if(defined('CUSTOM_LANGUAGE_FILE')){ ?>
<p class="alert alert-info">The child theme your running has a custom language file enabled therefore this section has been disabled.</p>
<?php }else{ ?>
<br />
<label  for="default-select">Display Language</label>
<div class="controls span7">
<select name="admin_values[language]"  id="language">
<option>English</option>

		<?php
		
		$HandlePath = TEMPLATEPATH . '/templates/'.$core_admin_values['template'].'/';	
	 
	    $count=1;
		if($handle1 = opendir($HandlePath)) {
      
	  	while(false !== ($file = readdir($handle1))){	

		if(substr($file,-4) ==".php" && substr($file,0,8) == "language"){
		$file = str_replace(".php","",$file); 
		$name = explode("_",$file);
		?>
			<option <?php if ($core_admin_values['language'] == $file) { echo ' selected="selected"'; } ?> value="<?php echo $file; ?>"><?php echo $name[1]." ".$name[0]; ?></option>
		<?php
		} }}


		$HandlePath = TEMPLATEPATH . '/framework/';	
	 
	    $count=1;
		if($handle1 = opendir($HandlePath)) {
      
	  	while(false !== ($file = readdir($handle1))){	

		if(substr($file,-4) ==".php" && substr($file,0,10) == "_language_"){
		$file = str_replace(".php","",$file); 
		$name = explode("_",$file);
		?>
			<option <?php if ($core_admin_values['language'] == $file) { echo ' selected="selected"'; } ?> value="<?php echo $file; ?>"><?php echo $name[0]." ".$name[2]; ?></option>
		<?php
		} }} 
		
		// CHECK IF CHILD THEME HAS A LANGUAGE FILE 
		
		?>
        
<?php foreach($wlt_languagefiles as $key=>$field){ ?>
<option value="<?php echo $key; ?>" <?php if (is_numeric($core_admin_values['language']) && $core_admin_values['language'] == $key) { echo "selected=selected"; } ?>><?php echo $field['name']." (".$field['date'].")"; ?></option>
<?php } ?>
</select>
</div>
<?php } ?> 

<div class="clearfix"></div>

<div class="well">

<b>Note</b> additional language files provided are for example purposes only. We do not guarantee the language file transaction accuracy.
</div>

<hr />

<div style="text-align:center;padding:20px;">
<a href="admin.php?page=16&downloadfile=1" style="padding: 20px;border-radius: 10px;background: #ddd;text-align: Center;">Download Core Language File</a>
</div>

<div class="clearfix"></div>
 
</div> <!-- End .content --> 
</div><!-- End .box --> 



</div>
</div> 