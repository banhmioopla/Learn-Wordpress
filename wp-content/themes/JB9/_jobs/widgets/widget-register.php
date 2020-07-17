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

global $CORE, $post, $userdata;

if(!$userdata->ID || ( !isset($_GET['preview_nonce']) ||!isset($_GET['action']) ) ){ 

?>
<div class="bg-primary p-4 text-light">

<h4 class="text-uppercase mb-2"><?php echo __("I'm an employer","premiumpress") ?></h4>

<p class="small"><?php echo __("Employers can post new job offers &amp; manage applications.","premiumpress") ?></p>

<a href="<?php echo _ppt(array('links','register')); ?>?type=1" class="btn btn-light btn-block rounded-0 mt-3"><?php echo __("Register Now","premiumpress") ?></a>

</div>

<div class="bg-secondary p-4 mb-3 text-light">

<h4 class="text-uppercase mb-3"><?php echo __("I'm a job seeker","premiumpress") ?></h4>

<p class="small"><?php echo __("Job seekers can add resumes and apply for jobs.","premiumpress") ?></p>

<a href="<?php echo _ppt(array('links','register')); ?>?type=2" class="btn btn-light btn-block rounded-0  mt-3"><?php echo __("Register Now","premiumpress") ?></a>

</div>

<p class="mb-4"><?php echo __("Already a member?","premiumpress") ?> <a href="<?php echo wp_login_url( '' ); ?> "><u><?php echo __("login here","premiumpress") ?></u></a> </p>

<?php } ?>