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
  
 
$saved_searches_array = get_option('recent_searches');
if(is_array($saved_searches_array) && !empty($saved_searches_array) ){ 

$saved_searches_array = $CORE->multisort( $saved_searches_array, array('views') );
$saved_searches_array = array_reverse($saved_searches_array, true);
?>

<table class="table table-bordered table-striped">
<thead>
              <tr>
                <th>Keyword</th>
                <th># Searches</th>
           
              </tr>
            </thead>
            <tbody>
 
 
    <?php
    
     $f=1; 
     
     foreach($saved_searches_array  as $key=>$searchdata){
     
      if($f > 8){ continue; }      
    
    ?>
 <tr>
 
<td>
<a href="<?php echo get_home_url(); ?>/?s=<?php echo str_replace("_"," ",$key); ?>" target="_blank"><?php echo str_replace("_"," ",$key); ?></a>
</td> 

 
<td>


<?php echo $searchdata['views']; ?> views

</td> 

</tr>
    
 
    
    <?php  $f++; } ?> 
    
    
    
</tbody> </table>


<?php }else{ ?>
<div class="card-body text-center">No search data recorded.</div>
<?php } ?>