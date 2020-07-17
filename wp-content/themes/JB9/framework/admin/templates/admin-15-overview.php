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
   
    
   	
   	"logo" => array(
   	
   		"name" => "Header/Footer",
   		"desc"	=> "Here you can adjust the global design options for your webiste.",
   		"icon" => "fa-paint-brush",
   		"link" => "#",
           "path" => "15-logo",
   	
   	),
    
   	
   	 /* 
   	"content" => array(
   	
   		"name" => "Home Page",
   		"desc"	=> "Here you can setup your website home page.",
   		"icon" => "fa-header",
   		"link" => "#",
           "path" => "15-homeedit",
   	
   	),*/
    
   	"pagebuilder" => array(
   	
   		"name" => "Elementor Templates",
   		"desc"	=> "Here you can install Elementor templates for this child theme.",
   		"icon" => "fa-certificate",
   		"path" => "15-pagebuilder",
   	
   	), 
    
   	
   	 
   	
   	//"s1" => array( "sep" => true, "name" => "Additional Design Options", ),
   
   	
    
   
   	"pageassign" => array(
   	
   		"name" => "Page Linking",
   		"desc"	=> "Here you can setup custom pages to be displayed instead of the default ones. Simply select a new page from the drop down list.",
   		"icon" => "fa-link",
   		"path" => "15-pageassign",
   	
   	),  
   	
   	
   	/*		
   	"cats" => array(
   	
   		"name" => "Website Categories",
   		"desc"	=> "Here you can setup and configure your website categories. Use the link below to view all available options.",
   		"icon" => "fa-bullseye",
   		"link" => "edit-tags.php?taxonomy=listing&post_type=listing_type",
   	
   	), */
   	
   	/*
   	"menu" => array(
   	
   		"name" => "Menu Options",
   		"desc"	=> "Menus are managed by the WordPress core system. Press the button below to be redirected to the WordPress menu editor.",
   		"icon" => "fa-bars",
   		"link" => "nav-menus.php",
   	
   	),
   
   	 
   	 
   	"widgets" => array(
   	
   		"name" => "Widgets",
   		"desc"	=> "Widgets are managed by the WordPress core system. Press the button below to be rediected to the WordPress widgets interface.",
   		"icon" => "fa-hourglass-1",
   		"link" => "widgets.php",
   	
   	),
   	*/
   	 
   	 
   
   	
   	/*
   		"css" => array(
   	
   		"name" => "Custom CSS/Styles",
   		"desc"	=> "Here you can add custom CSS and disable core CSS files used by the software.",
   		"icon" => "fa-code",
   		"link" => "#",
   		"path" => "15-css",
   	
   	),
   	*/
   	
   
   );
   
   if(defined('NOHOMEPAGECONTENT')){
   unset($options['content']);
   }
    
     
   $options = hook_v9_adminoptions_1($options);
   
   $i=1;
   ?>
<div class="bg-danger shadow rounded-1" id="MainNavArea" style="display:none;">
   <ul class="nav nav-tabs" id="MainTabs" role="tablist">
      <?php $i=1; foreach($options as $key => $opt){ ?>
      <li class="nav-item">
         <a class="nav-link <?php if($i == 1){ echo "active"; } ?>" id="tab-<?php echo $key; ?>" data-toggle="tab" href="#<?php echo $key; ?>" role="tab" aria-controls="<?php echo $key; ?>" aria-selected="true">
         <i class="fa <?php echo $opt['icon']; ?> mr-2"></i>
         <?php echo $opt['name']; ?>
         </a>
      </li>
      <?php $i++; } ?>
   </ul>
</div>
<div class="tab-content">
   <?php
      $i=1;
      foreach($options as $key => $opt){ ?>
   <section class="tab-pane menuitem fade <?php if($i == 1){ echo "show active"; } ?>" id="<?php echo $key; ?>" role="tabpanel" data-name="<?php echo $opt['name']; ?>" data-key="tab-<?php echo $key; ?>" data-icon="<?php echo $opt['icon']; ?>">   
      <?php if(isset($opt['link']) && strlen($opt['link']) > 1){  ?>
      <a href="<?php echo $opt['link']; ?>" class="btn btn-lg btn-outline-primary"> <span class="pr-3">Continue </span> <i class="fa fa-angle-right"></i> </a>
      <?php }else{ ?>
      <?php 
         if(is_array($opt['path'])){ 
         	echo get_template_part( $opt['path'][0], $opt['path'][1] );
         }else{ 
         	get_template_part('framework/admin/templates/admin', $opt['path'] );
         } 
         ?> 
      <?php } ?>
   </section>
   <?php $i++; } ?>
</div>