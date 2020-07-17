<?php
   /*
   Template Name: [JOBS - APPLY]
   */
    
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
    
   global  $userdata, $CORE; $CORE->Authorize();
   
   $GLOBALS['flag-apply'] = 1;   
   
   if(!_ppt_checkfile("tpl-apply.php")){  
   
   
      if( isset($_POST['jb_action']) ){
      
      		switch($_POST['jb_action']){
   		
   			case "updatestatus": {
   			
   			 
   				update_post_meta($_POST['job_id'], "job_status", $_POST['job_status']);				
   				
   				// SEND EMAIL TO APPLICANT
				$data1 = array();
   				$CORE->email_system($_POST['buyer_id'], 'application_statuschange', $data1);
   			
   				$GLOBALS['error_type'] = 1;
   				$GLOBALS['error_message'] = __("Status Updated Successfully","premiumpress");	 
    		
   			} break;
   		
   			case "updateresume": { 	
   			 
   				update_post_meta($_POST['job_id'], "resumeid", $_POST['resumeid']);
   			
   				$GLOBALS['error_type'] = 1;
   				$GLOBALS['error_message'] = __("Resume Updated Successfully","premiumpress");	 
   			
   			
   			} break;
   		
      			case "delapplication":{
      			
   				if(is_numeric($_POST['appid'])){
   					
   					$g = wp_delete_post($_POST['appid'], true);
   					 
   					$GLOBALS['error_type'] = 1;
   					$GLOBALS['error_message'] = __("Application Deleted Successfully","premiumpress");	
   				}
      			
      			
      			} break;
      		
      			case "apply":{
      		 
   			// ADD A NEW JOB TO THE SYTEM
   			$my_post = array();
   			$my_post['post_title'] 		= "New Job Application";
   			$my_post['post_content'] 	= "";
   			$my_post['post_excerpt'] 	= "";
   			$my_post['post_status'] 	= "publish";
   			$my_post['post_type'] 		= "ppt_jobs";
   			$my_post['post_author'] 	= 1;
   			$POSTID 					= wp_insert_post( $my_post );
   			
   			// STORE POST ID
   			add_post_meta($POSTID, "post_id", $_POST['jbid'] );
   			 
   			// SAVE THE BUYERS ID
   			add_post_meta($POSTID, "buyer_id", $userdata->ID); 
   			
   			// SAVE THE BUYERS ID
   			add_post_meta($POSTID, "seller_id", $_POST['jbaid']); 
   			
   			// ADD STATUS
   			add_post_meta($POSTID, "job_status", 1);
   			
   			// SEND EMAIL TO employeer
   			$data1 = array(); 
   			$CORE->email_system($_POST['jbaid'], 'newapply', $data1);
   			
   
      			} break;
      }
   }
   
   function _hook_extra_css($css){
   ob_start();
   
   ?>
<style>
   .list-group-item { background:none; border-top: 1px solid rgba(0, 0, 0, 0.04) !important; border-bottom: 1px solid rgba(0, 0, 0, 0.04) !important; }
   .list-group-flush span { float:right; }
   .list-group-flush .list-group-item { padding:10px 0px; }
   .list-group-flush .list-group-item:before {      content: "\f291";  font: normal normal normal 14px/1 FontAwesome; margin-right:10px; color:#6c88a5; }
   .buybox { background: #efffe4 !important; } 
   .location:before { content: "\F041" !important; }
   .member:before { content: "\F007" !important; }
   .time:before {     content: "\F017" !important; }
   .case:before {     content: "\f0b1" !important;  }
   .jobid:before { content: "\f2bc" !important;  }
   .daysto:before { content: "\f274" !important;  }
   .jobsdone:before { content: "\f05d" !important;  }
   .refunded:before { content: "\f02d" !important;  }
   .pfunds:before { content: "\f042" !important;  }
   .rfunds:before { content: "\f05d" !important;  }
   /*------------------------------------------------------*/
   /* WORKFLOW STYLES
   /*------------------------------------------------------*/
   .chatbox {     border: 1px solid #ddd;    padding: 0px 20px 20px 20px;}
   .chatbox ul { max-height: 400px;    overflow-y: auto;}
   .chat{    list-style: none;    margin: 0;    padding: 0;}
   .chat li{    margin-bottom: 10px;    padding-bottom: 5px;    border-bottom: 1px dotted #B3A9A9;}
   .chat li.left .chat-body{    margin-left: 60px;}
   .chat li.right  { float:none; }
   .chat li.right img { max-height:50px; max-width:50px; }
   .chat li.right .chat-body{    margin-right: 60px;}
   .chat li .chat-body p{    margin: 0;    color: #777777;}
   #workflow_message { float:left; width: 80%; }
   .tip {		background: #fff;		border: 1px solid #efeeee;		padding: 0px;	padding-left:30px;	font-size: 1.2em;		position: relative;	width: 100%; }
   .tip:before {		position: absolute;		top: -14px;		left: 98px;		display: inline-block;		border-right: 14px solid transparent;		border-bottom: 14px solid #fff;		border-left: 14px solid transparent;		border-bottom-color: rgba(0, 0, 0, 0.2);		content: '';	}
   .tip:after {		position: absolute;		top: -12px;		left: 99px;		display: inline-block;		border-right: 12px solid transparent;		border-bottom: 12px solid #fff;		border-left: 12px solid transparent;		content: '';	}
   .tip.left:before {		border-top: 14px solid transparent;		border-right: 14px solid #fff;		border-bottom: 14px solid transparent;		border-right-color: #efeeee;		left: -28px;		top: 20px;}
   .tip.left:after {		border-top: 12px solid transparent;		border-right: 12px solid #ffffff;		border-bottom: 12px solid transparent;		left: -24px;		top: 22px;	}
   .ppt-topic .desc { font-size: 16px; }
</style>
<?php
   $newcss = ob_get_clean();
   $newcss = str_replace("<style>","", str_replace("</style>","",$newcss)); 
   $newcss = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $newcss)); 
   return $css.$newcss;
   }
   add_action('hook_v9_extra_css','_hook_extra_css'); 
   get_header($CORE->pageswitch()); ?>
<main id="main">
   <div class="container mb-5 my-5">
      <div class="row">
         <div class="col-md-3">
            <div class="card card-body p-3">
               <h6><?php echo __("Job Applicants","premiumpress") ?></h6>
               <ul class="list-group list-group-flush mt-3">
                  <li class="list-group-item jobid"><?php echo __("Approved","premiumpress") ?> <span class="badge badge-success badge-pill" id="count-approved">0</span></li>
                  <li class="list-group-item jobid"><?php echo __("Under Review","premiumpress") ?> <span class="badge badge-info badge-pill" id="count-review">0</span></li>
                  <li class="list-group-item daysto"><?php echo __("Unsuccessful","premiumpress") ?> <span class="badge badge-danger badge-pill" id="count-rejected">0</span> </li>
                  <li class="list-group-item daysto"><?php echo __("In Progress","premiumpress") ?> <span class="badge badge-warning badge-pill" id="count-progress">0</span> </li>
               </ul>
               <script>
                  jQuery(document).ready(function(){ 
                  
                  jQuery('#count-approved').html( jQuery('.job-approved').length); 
                  jQuery('#count-progress').html( jQuery('.job-progress').length); 
                  jQuery('#count-rejected').html( jQuery('.job-rejected').length); 
                  jQuery('#count-review').html( jQuery('.job-underreview').length);  
                  
                  
                  });
               </script>
            </div>
            <a href="<?php echo _ppt(array('links','resume')); ?>" class="btn btn-block my-4 btn-primary"><?php echo __("My Resumes","premiumpress"); ?></a>
         </div>
         <div class="col-md-9">
            <div class="card card-body">
               <div class="bg-light p-3 mt-3">
                  <div id="accordion">
                     <?php	
                        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                        
                        $args = array(
                           'post_type' 		=> 'ppt_jobs',
                           'posts_per_page' 	=> 12,
                           'paged' 			=> $paged,
                        	'post_status'		=> 'publish',
                        'meta_query' => array(	
                        'relation'    => 'AND',					
                        array(							
                        'relation'    => 'OR',											 
                        'user1'    => array(
                        'key' => 'buyer_id',
                        'compare' => '=',
                        'value' => $userdata->ID,							 			
                        ),			 
                        'user2'   => array(
                        'key'     => 'seller_id',							
                        'compare' => '=',
                        'value' => $userdata->ID,	
                        
                        ),						
                        ),	
                        ),
                        );					
                        $wp_query = new WP_Query($args); 
                        
                        // COUNT EXISTING ADVERTISERS	 
                        $tt = $wpdb->get_results($wp_query->request, OBJECT);
                        
                        $i=1;
                        if(!empty($tt)){
                        foreach($tt as $p){
                        
                        $post = get_post($p->ID);
                        
                        // GET BUYER ID
                        $job_buyer_id = get_post_meta($p->ID,'buyer_id',true);
                        
                        $job_seller_id = get_post_meta($p->ID,'seller_id',true);
                        
                        // GET POST ID FOR JOB
                        $job_status = get_post_meta($p->ID,'job_status',true);
                        
                        // GET POST ID FOR JOB
                        $job_post_id = get_post_meta($p->ID,'post_id',true);
                        
                        // GET POST ID FOR JOB
                        $order_total = $CORE->order_total(get_post_meta($p->ID,'order_id',true));
                        
                        // CHECK IF FUNDS PAID
                        $job_donedate = get_post_meta($p->ID,'jobdone',true);
                        
                        // RESUME ID
                        $cr = get_post_meta($p->ID, "resumeid", true); 
                        
                        
                        ?>
                     <div class="card rounded-0">
                        <div class="card-header" id="heading<?php echo $p->ID; ?>">
                           <h5 class="mb-0">
                              <div class=" btn btn-block <?php if($i == 1){ ?>collapsed<?php } ?>" data-toggle="collapse" data-target="#collapse<?php echo $p->ID; ?>" aria-controls="collapse<?php echo $p->ID; ?>">
                                 <span class="float-left text-dark font-weight-bold text-left">
                                    <?php if($job_buyer_id == $userdata->ID){ ?>
                                    <div class="small"><?php echo __("You applied for","premiumpress"); ?>;</div>
                                    <?php }else{ ?>
                                    <div class="small"><?php echo __("Your job","premiumpress"); ?>;</div>
                                    <?php } ?>
                                    <?php echo get_the_title( $job_post_id ); ?> (#<?php echo $p->ID; ?>)
                                 </span>
                                 <?php if($job_status == 2){ ?>                              
                                 <span class="badge badge-info float-right job-underreview"><?php echo __("Under Review","premiumpress"); ?></span>
                                 <?php }elseif($job_status == 3){ ?>                              
                                 <span class="badge badge-danger float-right job-rejected"><?php echo __("Unsuccessful","premiumpress"); ?></span>  
                                 <?php }elseif($job_status == 4){ ?>                              
                                 <span class="badge badge-success float-right job-approved"><?php echo __("Approved","premiumpress"); ?></span>                              
                                 <?php }else{ ?>
                                 <span class="badge badge-warning float-right job-progress"><?php echo __("In Progress","premiumpress"); ?></span>
                                 <?php } ?>
                              </div>
                           </h5>
                        </div>
                        <div id="collapse<?php echo $p->ID; ?>" class="collapse rounded-0 <?php if($i == 1){ ?>show<?php } ?>" aria-labelledby="heading<?php echo $p->ID; ?>" data-parent="#accordion">
                           <div class="card-body">
                              <div class="container mb-4">
                                 <?php if($job_donedate != ""){ ?>
                                 <div class="alert alert-info"><?php echo __("This job was complete and funds released on","premiumpress"); ?>:
                                    <?php echo hook_date($job_donedate); ?>
                                 </div>
                                 <?php } ?>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <ul class="payment-right pl-0">
                                          <li>
                                             <div class="left">
                                                <?php if($job_buyer_id == $userdata->ID){ ?>
                                                <?php echo __("Employer","premiumpress"); ?>:
                                                <?php }else{ ?>
                                                <?php echo __("Applicant","premiumpress"); ?>:
                                                <?php } ?>
                                             </div>
                                             <div class="right"><span>
                                                <?php if($job_buyer_id == $userdata->ID){ ?>
                                                <a href="<?php echo get_author_posts_url($job_seller_id); ?>"><?php echo $CORE->user_display_name($job_seller_id); ?></a>
                                                <?php }else{ ?>
                                                <a href="<?php echo get_author_posts_url($job_buyer_id); ?>"><?php echo $CORE->user_display_name($job_buyer_id); ?></a>
                                                <?php } ?>
                                                </span>
                                             </div>
                                             <div class="clearfix"></div>
                                          </li>
                                          <li>
                                             <div class="left"><?php echo __("Job Description","premiumpress"); ?>:</div>
                                             <div class="right">
                                                <a href="<?php echo get_permalink( $job_post_id); ?>" target="_blank"><?php echo __("click here","premiumpress"); ?></a>
                                             </div>
                                             <div class="clearfix"></div>
                                          </li>
                                          <li>
                                             <div class="left"><?php echo __("Send Message","premiumpress"); ?>:</div>
                                             <div class="right">
                                                <a href="<?php echo _ppt(array('links','myaccount')); ?>?u=<?php if($job_buyer_id == $userdata->ID){ echo $job_seller_id; }else{ echo $job_buyer_id; } ?>" target="_blank"><?php echo __("click here","premiumpress"); ?></a>
                                             </div>
                                             <div class="clearfix"></div>
                                          </li>
                                          <li>
                                             <div class="left"><?php echo __("Application Sent","premiumpress"); ?>:</div>
                                             <div class="right">
                                                <span id="ppexpirydate"><?php echo hook_date($post->post_date); ?></span>
                                             </div>
                                             <div class="clearfix"></div>
                                          </li>
                                          <?php if($job_buyer_id == $userdata->ID){ ?>
                                          <li>
                                             <a href="javascript:void(0);" onclick="jQuery('#del-<?php echo $p->ID; ?>').submit();" class="btn btn-primary"><?php echo __("Delete Application","premiumpress"); ?></a>
                                             <form method="post" action="" id="del-<?php echo $p->ID; ?>">
                                                <input type="hidden" name="jb_action" value="delapplication"> 
                                                <input name="appid" type="hidden" value="<?php echo $p->ID; ?>"  /> 
                                             </form>
                                          </li>
                                          <?php } ?>
                                       </ul>
                                    </div>
                                    <div class="col-md-6 pl-5">
                                       <?php if(is_numeric($cr) && $job_buyer_id != $userdata->ID){ ?>                  
                                       <div class="card bg-light py-4 p-3 mb-4">          
                                          <a href="<?php echo get_post_field('post_content', $cr); ?>" target="_blank" class="btn btn-warning btn-block rounded-0 "><?php echo __("Download Applicants Resume","premiumpress"); ?></a>          
                                       </div>
                                       <?php } ?>
                                       <?php if($job_seller_id == $userdata->ID && $job_donedate == ""){ ?>
                                       <form method="post" action="" class="mb-4">
                                          <input type="hidden" name="jb_action" value="updatestatus"> 
                                          <input type="hidden" name="job_id" value="<?php echo $p->ID; ?>">
                                          <input type="hidden" name="seller_id" value="<?php echo $job_seller_id; ?>">
                                          <input type="hidden" name="buyer_id" value="<?php echo $job_buyer_id; ?>">
                                          <select name="job_status" class="form-control">
                                             <option value="1"><?php echo __("In Progress","premiumpress"); ?></option>
                                             <option value="2" <?php echo selected(  $job_status, 2); ?>><?php echo __("Under Review","premiumpress"); ?></option>
                                             <option value="3" <?php echo selected(  $job_status, 3); ?>><?php echo __("Unsuccessful","premiumpress"); ?></option>
                                             <option value="4" <?php echo selected(  $job_status, 4); ?>><?php echo __("Approved","premiumpress"); ?></option>
                                          </select>
                                          <div class="text-right mt-4">
                                             <button class="btn btn-primary rounded-0" id="btn-chat"><?php echo __("Update Application Status","premiumpress"); ?></button>
                                          </div>
                                       </form>
                                       <?php } ?>
                                       <?php if($job_buyer_id == $userdata->ID && $job_donedate == ""){ 
									   
									   
									     $args = array(
                                                  'post_type' 		=> 'wlt_resume',
                                                  'posts_per_page' 	=> 100,
                                                	'author' 			=> $userdata->ID,
                                                  'paged' 			=> 1,
                                                );
                                                $wp_query = new WP_Query($args); 
                                                
                                                $tt = $wpdb->get_results($wp_query->request, OBJECT);     
                                           
										    if(!empty($tt)){   
                                          ?>
                                       <label><?php echo __("Select resume for this job","premiumpress"); ?>;</label>
                                       <form method="post" action="" class="mb-4">
                                          <input type="hidden" name="jb_action" value="updateresume"> 
                                          <input type="hidden" name="job_id" value="<?php echo $p->ID; ?>">
                                          <input type="hidden" name="seller_id" value="<?php echo $job_seller_id; ?>">
                                          <select name="resumeid" class="form-control">
                                            
											<?php foreach($tt as $p1){  $post1 = get_post($p1->ID); ?>
                                             <option value="<?php echo $p1->ID; ?>" <?php echo selected(  $cr, $p1->ID ); ?>  /><?php echo $post1->post_title; ?></option>
                                             <?php } ?>
                                          </select>
                                          <div class="text-right mt-4">
                                             <button class="btn btn-primary rounded-0" id="btn-chat"><?php echo __("Update Attached Resume","premiumpress"); ?></button>
                                          </div>
                                       </form>
                                       <?php }   } ?>
                                       <?php if($job_donedate != ""){ ?>
                                       <div class="text-right">
                                          <?php if($job_buyer_id == $userdata->ID){ ?>
                                          <a href="<?php echo  get_author_posts_url( $job_seller_id ); ?>/?pid=<?php echo $job_post_id; ?>" class="btn btn-primary"><?php echo __("Leave Feedback","premiumpress"); ?></a>
                                          <?php }else{ ?>
                                          <a href="<?php echo  get_author_posts_url( $job_buyer_id ); ?>/?pid=<?php echo $job_post_id; ?>" class="btn btn-primary"><?php echo __("Leave Feedback","premiumpress"); ?></a>
                                          <?php } ?>                                    
                                       </div>
                                       <?php } ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php $i++;  }
                        }else{?>
                     <div class="text-center h4 text-secondary mt-4"><?php echo __("Your job center is empty.","premiumpress"); ?></div>
                     <p class="text-center lead mt-3"><?php echo __("Apply or submit a job today and get started!","premiumpress"); ?></p>
                     <?php } ?>
                  </div>
                  <!-- end accordian -->
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php get_template_part( 'page', 'bottom' ); ?>  
</main>
<!-- end main -->
<?php get_footer($CORE->pageswitch()); } ?>