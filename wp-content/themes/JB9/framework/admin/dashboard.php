<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;



// POST TYPE CHANGE IN 8.3
if(get_option('wlt_db_update_916') == ""){

	 $old = array('tpl-page-account.php', 'tpl-page-memberships.php', 'tpl-page-blog.php', 
	 'tpl-callback.php', 'tpl-page-contact.php', 'tpl-page-aboutus.php', 'tpl-page-faq.php', 
	 'tpl-page-advancedsearch.php', 'tpl-page-terms.php', 'tpl-page-privacy.php', 'tpl-add.php', 
	 'tpl-page-testimonials.php');
	
	 foreach($old as $n){
 		$wpdb->query("UPDATE ".$wpdb->postmeta." SET meta_value='templates/".$n."' WHERE meta_key='_wp_page_template' AND meta_value='".$n."' LIMIT 1");
 	 }
 
	
	if(THEME_KEY == "cp"){
		
		$old = array('tpl-page-coupon-cashback.php', 'tpl-page-coupon-stores.php', 'tpl-page-coupon-deals.php' );
		foreach($old as $n){
			$wpdb->query("UPDATE ".$wpdb->postmeta." SET meta_value='templates-coupon/".$n."' WHERE meta_key='_wp_page_template' AND meta_value='".$n."' LIMIT 1");
		}
	}
	update_option("wlt_db_update_916","complete");	
}



$GLOBALS['NOSIDEBAR'] = true;

$count_posts 	= wp_count_posts(THEME_TAXONOMY.'_type'); 
$count_users	= count_users();
$order_total 	= $wpdb->get_row("SELECT sum(order_total) AS total FROM ".$wpdb->prefix."core_orders");

// LOAD IN HEADER
echo $CORE_ADMIN->HEAD(); ?>




<div class="row">
   <div class="col-md-3" style="overflow: hidden;">
    <?php get_template_part('framework/admin/templates/admin', 'mainmenu' ); ?> 
      <div class="list-group" id="sidebarmenu" role="tablist"></div>
      <?php get_template_part('framework/admin/templates/admin', 'supportmenu' ); ?> 
   </div>
   <div class="col-md-9">
      <div class="tab-content">









<div class="row">
   <div class="col-xl-3 col-md-6 col-12 mb-3">
      <div class="dashbox a2 clearfix">
         <div class="inner icon1">
            <span class="num"><?php echo $count_users['total_users']; ?></span>
            <div class="txt">Users</div>
         </div>
         <a href="users.php?page=users">
            <div class="top">View All Users</div>
         </a>
      </div>
      <!-- end dashbox 1-->
   </div>
   <div class="col-xl-3 col-md-6 col-12 mb-3">
      <div class="dashbox a3 clearfix">
         <div class="inner icon2">
            <span class="num"><?php if(!isset($order_total->total)){ echo 0; }else{ if($order_total->total < 1){ echo "0"; }else{ echo hook_price(round($order_total->total,2)); } } ?></span>
            <div class="txt">Sales</div>
         </div>
         <a href="admin.php?page=6">
            <div class="top">View All Orders</div>
         </a>
      </div>
      <!-- end dashbox 2-->
   </div>
   <div class="col-xl-3 col-md-6 col-12 mb-3">
      <div class="dashbox a4 clearfix">
         <div class="inner icon3">
            <span class="num"><?php echo number_format($count_posts->publish+$count_posts->draft+$count_posts->pending+$count_posts->trash,0); ?></span>
            <div class="txt">Listings</div>
         </div>
         <a href="admin.php?page=manage">
            <div class="top">View All Listings</div>
         </a>
      </div>
      <!-- end dashbox 3 -->
   </div>
   <div class="col-xl-3 col-md-6 col-12 mb-3">
      <div class="dashbox a1 clearfix">
         <div class="inner icon4">
            <span class="num"><?php 
               $saved_searches_array = get_option('recent_searches');
               if(!is_array($saved_searches_array)){ $saved_searches_array = array(); }
               echo number_format(count($saved_searches_array)); ?></span>
            <div class="txt">Searches</div>
         </div>
         <a href="admin.php?page=13&tab=search">
            <div class="top">View All Searches</div>
         </a>
      </div>
      <!-- end dashbox 3 -->
   </div>
</div>










<?php //get_template_part('framework/admin/templates/admin', '0-graph' ); ?> 
<div class="row">
   <div class="col-md-12">
      <?php get_template_part('framework/admin/templates/admin', 'dashboard-graph' ); ?> 
   </div>
</div>

<style>
.nav-item a { line-height:50px; color:#666; }
.nav-item a.active { font-weight:bold; }
</style>
<div class="row mt-4">
   <div class="col-md-12">
   
   <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active px-3" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-drivers-license-o"></i> New Users</a>
  </li>
  <li class="nav-item">
    <a class="nav-link px-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-user"></i> Top Users</a>
  </li>
  <li class="nav-item">
    <a class="nav-link px-3" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-search"></i> Top Searches</a>
  </li>
   <li class="nav-item">
    <a class="nav-link px-3" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-briefcase"></i> Recent Orders</a>
  </li>
</ul>
<div class="tab-content border-0 p-0" id="myTabContent" style="min-height:400px;">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
 	 <a href="users.php?page=users" class="btn btn-sm btn-outline-dark float-right rounded-0 my-2">View All</a>
     <?php get_template_part('framework/admin/templates/admin', 'dashboard-new-members' ); ?>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <a href="users.php?submitted=no&page=users&us&orderby=logincount&order=desc&show=20" class="btn btn-sm btn-outline-dark float-right rounded-0 my-2">View All</a>
  <?php get_template_part('framework/admin/templates/admin', 'dashboard-top-members' ); ?> 
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
   <a href="admin.php?page=13&tab=search" class="btn btn-sm btn-outline-dark float-right rounded-0 my-2">View All</a>
  <?php get_template_part('framework/admin/templates/admin', 'dashboard-top-searches' ); ?>
  </div>
  
   <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
   <a href="admin.php?page=6" class="btn btn-sm btn-outline-dark float-right rounded-0 my-2">View All</a>
 <?php get_template_part('framework/admin/templates/admin', 'dashboard-top-orders' ); ?> 
  </div> 
  
</div>

   
   </div>
</div>





 



      </div>
   </div>
</div>





<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(1);  ?>