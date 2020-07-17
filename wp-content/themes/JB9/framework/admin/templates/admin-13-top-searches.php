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
<?php
$saved_searches_array = get_option('recent_searches');
if(is_array($saved_searches_array) && !empty($saved_searches_array) ){ 

$saved_searches_array = $CORE->multisort( $saved_searches_array, array('views') );
$saved_searches_array = array_reverse($saved_searches_array, true);
?>


<div class="card">
<div class="card-header">

<a href="admin.php?page=13&tab=search&delrsall=1" class="float-right btn btn-primary btn-sm">Delete Keyword Data</a>
<span>
User Keyword Searches
</span>
</div>
<div class="card-body1"> 
<table class="table table-bordered table-striped">
<thead>
              <tr>
                <th>#</th>
                <th>Keyword</th>
             
                 
              </tr>
            </thead>
            <tbody>
<?php $f=1; foreach($saved_searches_array  as $key=>$searchdata){ if($f > 100){ continue; } ?>            
<tr>
<td style="width:30px;"><span class="label"><?php echo $searchdata['views']; ?> </span></td>
<td><a href="<?php echo get_home_url(); ?>/?s=<?php echo str_replace("_"," ",$key); ?>" target="_blank"><?php echo str_replace("_"," ",$key); ?></a></td>
 
 

</tr>
<?php $f++; } ?>
 
</tbody> </table>

</div></div>


<?php /*
<hr />
<a href="admin.php?page=premiumpress&delrsall" class="btn btn-info">Delete All Searches</a>
*/ ?>


<?php }else{ ?>
<div class="card-body text-center grey">No search data recorded.</div>
<?php } ?>