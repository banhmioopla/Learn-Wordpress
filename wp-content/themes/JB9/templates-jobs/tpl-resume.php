<?php
   /*
   Template Name: [JOBS - MY RESUME]
   */
    
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
    
   global  $userdata, $CORE; $CORE->Authorize();
   
   $GLOBALS['flag-resume'] = 1;
   
   
   if( isset($_POST['jb_action']) ){
   		switch($_POST['jb_action']){
   		
   			case "delresume":{
   			
				if(is_numeric($_POST['csvid'])){
					
					$g = wp_delete_post($_POST['csvid'], true);
					 
					$GLOBALS['error_type'] = 1;
					$GLOBALS['error_message'] = __("Resume Deleted Successfully","premiumpress");	
				}
   			
   			
   			} break;
   		
   			case "saveresume": {			 
   		 	 
   				// NOW SAVE THE CV TO THE RESUME
   				if($_FILES['mycsv']['type'] == "application/pdf"){
   				 
   				 
   					// LOAD IN WORDPRESS FILE UPLOAOD CLASSES
   					$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
   					if(!function_exists('get_file_description')){
   					require $dir_path . "/wp-load.php";
   					require $dir_path . "/wp-admin/includes/file.php";
   					require $dir_path . "/wp-admin/includes/media.php";	
   					}
   				
   					// create an array of the $_FILES for each file
   					$file_array = array(
   						'name' 		=> $userdata->ID."_".$_FILES['mycsv']['name'],
   						'type'		=> $_FILES['mycsv']['type'],
   						'tmp_name'	=> $_FILES['mycsv']['tmp_name'],
   						'error'		=> $_FILES['mycsv']['error'],
   						'size'		=> $_FILES['mycsv']['size'],
   					);
   					
   					// upload the file to the server
   					$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ) );					 
   					$uploaded_file['name'] = $file_array['name'];
   					
   					// CHECK FOR ERRORS
   					if(!isset($uploaded_file['error']) ){		
   						 
   						$my_post = array();
   						$my_post['post_title'] 		= $_FILES['mycsv']['name'];
   						$my_post['post_content'] 	= $uploaded_file['url'];
   						$my_post['post_excerpt'] 	= $uploaded_file['file'];
   						$my_post['post_status'] 	= "publish";
   						$my_post['post_type'] 		= "wlt_resume";
   						$my_post['post_author'] 	= $userdata->ID;
   						$myresumeid					= wp_insert_post( $my_post );
   					 
   						
   					}else{
   					
   					echo $uploaded_file['error'];
   					}// end if			
   					
   				}// end if 
   			
   		 	$GLOBALS['error_message'] = __("Resume Updated Successfully","premiumpress");	
   				
   			
   			} break;
   }
   }
   
   get_header($CORE->pageswitch()); ?>
<main id="main">
   
   <div class="container">
      <section class="my-5 bg-white p-lg-55">
         <div class="row">
            <div class="col-md-4">
               <div class="card rounded-0">
                  <div class="card-body">
                     <h5 class="card-title"><?php echo __("Upload Resume","premiumpress") ?></h5>
                     <p><?php echo __("Select a resume file in .PDF format to save it to your account.","premiumpress") ?></p>
                     <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="jb_action" value="saveresume"> 
                        <input name="mycsv" type="file" class="form-control"  /> 
                        <button class="btn btn-primary btn-block mt-3"><?php echo __("Upload File","premiumpress") ?></button>
                     </form>
                  </div>
               </div>
            </div>
            <div class="col-md-8 p-lg-5">
               <?php echo $CORE->error_display(); ?> 
               <h4><?php echo __("My Uploaded Resumes","premiumpress") ?></h4>
               <hr />
               <?php	
                  $args = array(
                      'post_type' 			=> 'wlt_resume',
                      'posts_per_page' 	=> 100,
                  	'post_author' 	=> $userdata->ID,
                      'paged' 				=> 1,
                  );
                  $wp_query = new WP_Query($args); 
                  
                  // COUNT EXISTING ADVERTISERS	 
                  $tt = $wpdb->get_results($wp_query->request, OBJECT);
                  
                  if(!empty($tt)){
                  foreach($tt as $p){
                  
                  $post = get_post($p->ID);
				  
				  if($post->post_author != $userdata->ID){ continue; }
                  
                  ?>
               <div class="bg-light mb-4 p-3 border shadow-sm">
                  <div class="row">
                     <div class="col-md-9">
                        <h4><?php echo $post->post_name; ?></h4>
                     </div>
                     <div class="col-md-3 text-right">
                        <a href="<?php echo $post->post_content; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-search"></i></a>
                        <a href="javascript:void(0);" onclick="jQuery('#del-<?php echo $post->ID; ?>').submit();" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                     </div>
                  </div>
               </div>
               <form method="post" action="" id="del-<?php echo $post->ID; ?>">
                  <input type="hidden" name="jb_action" value="delresume"> 
                  <input name="csvid" type="hidden" value="<?php echo $p->ID; ?>"  /> 
               </form>
               <?php }}?>
            </div>
         </div>
      </section>
   </div>
  
</main>
<?php get_footer($CORE->pageswitch());  ?>