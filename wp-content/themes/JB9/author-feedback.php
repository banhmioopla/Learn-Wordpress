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

global $CORE, $userdata, $authorID;


$args = array(
	'post_type' => 'wlt_feedback',
	'posts_per_page'	=> '150',
	'meta_query' => array(
			 
			array(
				'key'		=> 'uid',
				'value' 	=> $authorID,
				'compare' 		=> '=',
			),
			 
		),
);
// GET USER FEEDBACK
$query = new WP_Query($args); 
$posts = $query->posts;
 
// GET MY FEEDBACK
$args = array(
	'post_type' => 'wlt_feedback',
	'posts_per_page'	=> '150',
	'author' => $authorID,
	'meta_query' => array(
			 
			array(
				'key'		=> 'replyid',			 
				'compare' 		=> 'NOT EXISTS',
			),
			 
		),
);
$query1 = new WP_Query($args); 
$posts1 = $query1->posts;
?>



<div class="tab-pane fade active show" id="t1" role="tabpanel">


<?php if(empty($posts)){ ?> 
<div class="small my-5"><div class="bg-light p-4 m-4 text-center font-weight-bold" style="opacity: 0.5;"><?php echo __("No feedback recieved","premiumpress") ?></div></div>   
<?php }elseif(!empty($posts)){ ?> 
	<div class=" clearfix pt-5">
		<?php foreach($posts as $post){
		 
		// DISPLAY FEEDBACK 
 		get_template_part( 'content', 'feedback' );
		
		// NOW LETS CHECK FOR A REPLY TO THIS FEEDBACK
		$args = array(
			'post_type' => 'wlt_feedback',
			'posts_per_page'	=> '150',
			'meta_query' => array(					 
					array(
						'key'		=> 'replyid',
						'value' 	=> $post->ID,
						'compare' 		=> '=',
					),					 
				),		);
		// GET USER FEEDBACK
		$sub_query = new WP_Query($args); 
		$reply_query = $sub_query->posts;
		
		if(!empty($reply_query)){  
		
		foreach($reply_query as $reply_post){ ?>
        
        <div class="card card-feedback feedback-reply">        
            <div class="card-image">            
                 <?php echo "<a href='".get_author_posts_url( $reply_post->post_author )."'>".get_avatar($reply_post->post_author,50)."</a>"; ?>            
            </div>             
            <div class="card-text card-body">
                 <h5><?php echo $reply_post->post_title; ?></h5>                
                 <p class="small grey"><?php echo hook_date($reply_post->post_date); ?></p>                 
                 <p class="desc size14"><?php echo $reply_post->post_content; ?></p>               
            </div>        
        </div>     
        
        <?php  }  // end foreach
    
		} // end if
		
		wp_reset_postdata(); ?>        
       
     <?php  }  // end foreach ?>
     
     </div><!-- review wrapper -->
    
<?php } // end if ?>	

<?php wp_reset_postdata();  ?>  
</div>

<div class="tab-pane fade" id="t2" role="tabpanel">
<?php if(empty($posts1)){ ?> 
<div class="small my-5"><div class="bg-light p-4 m-4 text-center font-weight-bold" style="opacity: 0.5;"><?php echo __("No feedback left","premiumpress") ?></div></div>   
<?php }elseif(!empty($posts1)){ ?> 
	<div class=" clearfix pt-5">
		<?php foreach($posts1 as $post){
		 
		// DISPLAY FEEDBACK 
 		get_template_part( 'content', 'feedback' );
		
		// NOW LETS CHECK FOR A REPLY TO THIS FEEDBACK
		$args = array(
			'post_type' => 'wlt_feedback',
			'posts_per_page'	=> '150',
			'meta_query' => array(					 
					array(
						'key'		=> 'replyid',
						'value' 	=> $post->ID,
						'compare' 		=> '=',
					),					 
				),		);
		// GET USER FEEDBACK
		$sub_query = new WP_Query($args); 
		$reply_query = $sub_query->posts;
		
		if(!empty($reply_query)){  
		
		foreach($reply_query as $reply_post){ ?>
        
        <div class="card card-feedback feedback-reply">        
            <div class="card-image">            
                 <?php echo "<a href='".get_author_posts_url( $reply_post->post_author )."'>".get_avatar($reply_post->post_author,50)."</a>"; ?>            
            </div>             
            <div class="card-text card-body">
                 <h5><?php echo $reply_post->post_title; ?></h5>                
                 <p class="small grey nomargin"><?php echo hook_date($reply_post->post_date); ?></p>                 
                 <p class="desc size14"><?php echo $reply_post->post_content; ?></p>               
            </div>        
        </div>     
        
        <?php  }  // end foreach
    
		} // end if
		
		wp_reset_postdata(); ?>        
       
     <?php  }  // end foreach ?>
     
     </div><!-- review wrapper -->
    
<?php } // end if ?>	

<?php wp_reset_postdata();  ?> 
</div>
