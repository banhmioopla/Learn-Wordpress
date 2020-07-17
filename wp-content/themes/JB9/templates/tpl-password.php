<?php
/*
Template Name: [PAGE - FORGOTTEN PASSWORD]
*/

global $CORE, $errortext, $errorStyle; 

if(!_ppt_checkfile("tpl-password.php")){
?>
<?php get_template_part( 'page', 'forgottenpassword' ); ?>
<?php } ?>