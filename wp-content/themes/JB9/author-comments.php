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

if(!_ppt_checkfile("author-comments.php")){

?>
<?php if(_ppt('comments') == 1){ ?>
<h3 class="caps margin-bottom2"><?php echo __("My Recent Comments","premiumpress"); ?></h3>
<hr class="dashed margin-bottom2" />
<?php $g =  get_comments( array( 'author__in' => $authorID,	'number' => 5, 'include_unapproved' => false ) ); 
   if(is_array($g) && !empty($g)){
   
   ?>
<div class="ppt-comments">
   <?php foreach($g as $comment){ ?>
   <article class="comment byuser comment-author-admin bypostauthor even thread-even depth-1" id="comment-3" itemprop="comment" itemscope="" itemtype="http://schema.org/Comment">
      <div class="comment_wrap">
         <figure class="gravatar">
            <?php echo str_replace("userphoto","userphoto", get_avatar( $authorID, 50 ) ); ?> 
         </figure>
         <div class="comment-body" itemprop="text">
            <div class="title">
               <a href="<?php echo get_permalink($comment->comment_post_ID); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a>
            </div>
            <div class="datediff">
               <?php echo hook_date($comment->comment_date); ?>
            </div>
            <div class="comment-text"> 
               <?php echo wpautop($comment->comment_content); ?> 
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
   </article>
   <?php } ?>
</div>
<?php }else{ ?>
<p class="grey font-size14 margin-bottom2"><?php echo __("No comments left by this user.","premiumpress"); ?></p>
<?php } ?>
<?php } ?>
<?php } ?>