<?php
/*
Template Name: [PAGE - REGISTER]
*/

global $CORE, $errortext, $errorStyle; 

if(!_ppt_checkfile("tpl-register.php")){
?>
<?php get_header($CORE->pageswitch()); get_template_part( 'page', 'top' ); ?>


      <?php hook_login_before(); ?>  
      <section>
         <?php if(strlen($errortext) > 1){ ?>
         <div class="alert <?php echo $errorStyle; ?> text-center"><?php echo $errortext; ?></div>
         <?php } ?>  
         <?php get_template_part( 'ajax-modal', 'register' ); ?>
      </section>
      <?php hook_login_after(); ?>
 
<?php get_template_part( 'page', 'bottom' ); get_footer($CORE->pageswitch()); ?>

<?php } ?>