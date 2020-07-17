<?php
global $userdata, $post; ?>

<?php do_action( "pptv9_before_inner_body_close", $post ); ?>

</div><!-- end page -->

<?php do_action( "pptv9_after_body_close", $post ); ?>
 
<?php wp_footer(); ?>

<?php do_action( "pptv9_after_wp_footer", $post ); ?>

</body> 

</html>