<?php
   if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
   
   global $CORE, $post, $userdata;
    
   
   if(!_ppt_checkfile("comments.php")){
    
   if ( post_password_required() ) {
   	return;
   }
   ?>
<?php if(!$userdata->ID){ ?>
<div class="mt-3 pb-5"><?php echo __("Only members can leave comments.","premiumpress"); ?> 
   <span><a href="<?php echo wp_login_url(get_permalink($post->ID)); ?> "><u><?php echo __("Login","premiumpress"); ?></u></a> <?php echo __("or","premiumpress"); ?> <a href="<?php echo wp_registration_url(get_permalink($post->ID)); ?> "><u><?php echo __("Register!","premiumpress"); ?></u></a></span>
</div>
<?php } ?>
<?php if ( have_comments() ) : ?>
<div class="ppt-comments">
   <?php
      wp_list_comments( array(
          //'per_page'   => 2,
          'max_depth'  => 3,	 
          'avatar_size'=> 34,
          'format'     => 'html5',
          //'callback' => 'html5_comment'
          'walker' => new  ppt_comment_walker,
      ) );
      
      
      ?>
</div>
<?php endif; // have_comments() ?>
<?php 
   $fields =  array(
   
     'author' =>
       '<p>  ' .
     
       '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
       '" size="30" placeholder="' . __( 'Name', 'premiumpress' ) . '" class="form-control" /></p>',
   
     'email' =>
       '<p>  ' .
   
       '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
       '" size="30" placeholder="' . __( 'Email', 'premiumpress' ) . '" class="form-control" /></p>',
   
     'url' =>
       '<p>' .
       '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
       '" size="30" placeholder="' . __( 'Website', 'premiumpress' ) . '" class="form-control" /></p>',
     
   	
   );
    
   
   
   ?>
<?php if($userdata->ID > 0){ 
   // CUSTOM CODE BUTTON
   			$reg_nr1 = rand("0", "9"); $reg_nr2 = rand("0", "9"); $bb = "";
   			
   			ob_start(); 
   		 	?>
<?php comment_id_fields(); ?>
<?php if(_ppt('comment_captcha') == 1 && _ppt('google_recap_sitekey') != ""){ ?>
<div class="g-recaptcha my-3" data-sitekey="<?php echo stripslashes(_ppt('google_recap_sitekey')); ?>"></div>
<?php }elseif(_ppt('comment_captcha') == 1){	 ?>
<div class="row clearfix margin-top2 margin-bottom2">
   <div class="col-md-6">
      <?php echo __("What is the sum of:","premiumpress"); ?>
   </div>
   <div class="col-md-2">
      <span class="num-check"><?php echo $reg_nr1.' + '.$reg_nr2; ?> = </span>
   </div>
   <div class="col-md-4">                      
      <input type="text" name="reg_val" tabindex="500" class="form-control"> 
      <input type="hidden" name="reg1" value="<?php echo $reg_nr1; ?>" />
      <input type="hidden" name="reg2" value="<?php echo $reg_nr2; ?>" />
   </div>
</div>
<?php } ?> 
<div class="clearfix my-3">
   <input name="agreetc" type="checkbox" id="agreetc" class="float-left mr-2 mt-1" onchange="UpdateTCA()" />
   <span class="small"><?php echo sprintf(__( "Agree to <a href=\"%s\">terms &amp; conditions.</a>", "premiumpress"), ""._ppt(array('links','terms'))."", ""  ); ?></span>
</div>
<script>		
   jQuery(document).ready(function() {
   jQuery('#submit').addClass("btn btn-primary rounded-0").attr("disabled", true);		
   });
    
   function UpdateTCA(){					 
   if(jQuery('#agreetc').is(':checked') ){                        	
                     jQuery('#submit').removeAttr("disabled");
                     }else{
   	jQuery('#submit').attr("disabled", true);
                     	alert("<?php echo __("Please agree to the website terms and conditions.","premiumpress"); ?>");
                     	return false;
                     } 					 
   }
   
</script>
<?php $form_addon = ob_get_clean(); ?>
<?php $comments_args = array(
   // change the title of send button 
   'label_submit'=> __( "Post Comment", "premiumpress"),
    'comment_notes_before' => '',
   // change the title of the reply section
   'title_reply'=> '', //__("Comments","premiumpress")." <hr />",
   // remove "Text or HTML to be displayed after the set of comment fields"
   'comment_notes_after' => $form_addon,
   // redefine your own textarea (the comment body)
   'comment_field' => '<p><textarea id="comment" name="comment" aria-required="true" class="form-control"></textarea></p>',
   'logged_in_as' => '',
   // FIELDS
   'fields' => apply_filters( 'comment_form_default_fields', $fields ),
   );
   ?> 
<div class="ppt-comment-form"><?php comment_form($comments_args); ?></div>
<?php } ?>
<?php } ?>