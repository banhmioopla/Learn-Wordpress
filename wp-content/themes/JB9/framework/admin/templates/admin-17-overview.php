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

 
$options = array(
 
	"fields" => array(
	
		"name" => "Advanced Search Fields",
		"desc"	=> "Edit, add and remove search fields from your advanced search.",
		"icon" => "fa-search",
		"link" => "#",
	
	),

	"settings" => array(
	
		"name" => "Search Page Settings",
		"desc"	=> "Edit the display of your search results page.",
		"icon" => "fa-th",
		"link" => "#",
	
	),
	
 

	
);

foreach($options as $key => $opt){ ?>

	<?php if(isset($opt['sep'])){ ?>
    
    <h4><?php echo $opt['name']; ?></h4>
    
    <?php }else{ ?>
    
    
    <div class="card iconbox">
    
        <div class="card-body">
        
                <i class="fa <?php echo $opt['icon']; ?>"></i>
            
                <div class="icon-text">
                
                <a <?php if($opt['link'] == "#"){ ?>href="#<?php echo $key; ?>" onclick="jQuery('#ShowTab').val('<?php echo $key; ?>')" data-toggle="tab"<?php }else{ ?> href="<?php echo $opt['link']; ?>"<?php } ?> class="btn btn-primary btn-sm float-right">
                View Page
                
                </a>
                
                <strong><?php echo $opt['name']; ?></strong>
                    
                <?php echo $opt['desc']; ?>
                
                </div><!-- end txt -->
            
            </div>
            
        </div><!-- end card -->
        
    <div class="clearfix"></div>
    
    <?php } ?>

<?php } ?>