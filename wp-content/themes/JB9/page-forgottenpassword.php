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
?>

<?php global $CORE, $errortext; ?>

<?php get_header($CORE->pageswitch()); ?>
<main id="main">
   <?php get_template_part( 'page', 'top' ); ?>
   <div class="container">
      <?php hook_login_before(); ?>  
      <section>
         <?php if(strlen($errortext) > 1){ ?>
         <div class="alert alert-danger <?php echo $errorStyle; ?> text-center"><?php echo $errortext; ?></div>
         <?php } ?>  
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <form class="lostpasswordform" name="lostpasswordform" id="loginform" action="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post'); ?>" method="post">
                  <div class="text-center titleblock">
                     <h4 class="title"><?php echo __("Password Reset","premiumpress") ?></h4>
                     <p class="subtitle"><?php echo __("Enter your account username or email below and we will send you a new password.","premiumpress"); ?></p>
                  </div>
                  <div class="line bg-primary">&nbsp;</div>
                  <div class="modal-body mt-2">
                     <div class="form-group clearfix">
                        <label for="name"><?php echo __("Username/Email","premiumpress"); ?></label> 
                        <input type="text"  name="user_login" id="user_login" value="<?php echo esc_attr(stripslashes($_POST['user_login'])); ?>" class="form-control"/>        
                     </div>
                     <?php do_action('lostpassword_form'); ?>
                     <div class="clearfix"></div>
                     <div class="text-center mt-3">
                        <input type="submit" name="submit" id="submit" class="btn btn-secondary btn-block"  tabindex="15" value="<?php echo __("Continue","premiumpress"); ?>" />
                     </div>
               </form>
               </div>
            </div>
         </div>
      </section>
      <?php hook_login_after(); ?>
   </div>
   <!-- end container -->
   <?php get_template_part( 'page', 'bottom' ); ?>  
</main>
<!-- end main -->
<?php get_footer($CORE->pageswitch());  ?>