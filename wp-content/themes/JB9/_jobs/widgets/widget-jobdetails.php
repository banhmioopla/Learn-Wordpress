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

?>

<div class="widget" id="widget-jobdetails" data-title="<?php echo __("Job Details","premiumpress") ?>">
   <div class="widget-wrap">
      <div class="widget-block">
    
         <div class="widget-content p-2">




<div class="dwrap clearfix mb-3">
<i class="fal fa-calendar text-primary"></i>
<ul class="list-unstyled">
<li class=" mb-3"><?php echo __("Date Posted","premiumpress") ?></li>
<li class="text-muted"><?php echo hook_date($post->post_date); ?></li>
</ul>
</div>


<div class="dwrap clearfix mb-3">
<i class="fa fa-users text-primary"></i>
<ul class="list-unstyled">
<li class=" mb-3"><?php echo __("Applicants Applied","premiumpress") ?></li>
<li class="text-muted"><?php echo do_shortcode('[APPLICANTS]'); ?> <?php echo __("Resumes Sent","premiumpress") ?></li>
</ul>
</div>
 



<div class="dwrap clearfix mb-3">
<i class="fa fa-map-marker text-primary"></i>
<ul class="list-unstyled">
<li class=" mb-3"><?php echo __("Location","premiumpress") ?></li>
<li class="small text-muted"><?php echo do_shortcode('[LOCATION]'); ?></li>
</ul>
</div>



<div class="dwrap clearfix mb-3">
<i class="fa fa-briefcase text-primary"></i>
<ul class="list-unstyled">
<li class=" mb-3"><?php echo __("Job Title","premiumpress") ?></li>
<li class="text-muted"><?php echo do_shortcode('[TITLE]'); ?></li>
</ul>
</div>


<div class="dwrap clearfix mb-3">
<i class="fa fa-clock-o text-primary"></i>
<ul class="list-unstyled">
<li class=" mb-3"><?php echo __("Hours","premiumpress") ?></li>
<li class="text-muted"><?php echo do_shortcode('[HOURS]'); ?></li>
</ul>
</div>


<div class="dwrap clearfix mb-3">
<i class="fa fa-money text-primary"></i>
<ul class="list-unstyled">
<li class=" mb-3"><?php echo __("Salary","premiumpress") ?></li>
<li class="text-muted"><?php echo do_shortcode('[SALARY]'); ?></li>
</ul>
</div>

<div class="dwrap clearfix mb-3">
<i class="fa fa-th-large text-primary"></i>
<ul class="list-unstyled">
<li class=" mb-3"><?php echo __("Experience","premiumpress") ?></li>
<li class="small text-muted"><?php echo do_shortcode('[EXPERIENCE]'); ?></li>
</ul>
</div>

<div class="dwrap clearfix mb-3">
<i class="fa fa-filter text-primary"></i>
<ul class="list-unstyled">
<li class=" mb-3"><?php echo __("Category","premiumpress") ?></li>
<li class="text-muted"><?php echo do_shortcode('[CATEGORY]'); ?></li>
</ul>
</div>



           
           
         </div>
      </div>
   </div>
</div>