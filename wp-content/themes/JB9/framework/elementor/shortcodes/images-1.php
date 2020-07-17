<?php global $CORE, $userdata, $wpdb, $post, $settings; 


?><div class="container-fluid">
<div class="row images-1">
<?php
foreach($settings['images'] as $img){ if($img['src'] == ""){ continue; }  

if($img['thumbnail'] == ""){ $img['thumbnail'] = $img['src']; }

?><div class="col-6 col-sm-3 px-1">
<a href="<?php echo $img['src']; ?>" data-gal="prettyPhoto[gal]"><figure class="mb-3">
<img src="<?php echo $img['thumbnail']; ?>" alt="<?php if(isset($img['name'])){ echo $img['name']; }else{ echo $post->post_title; } ?>" class="imgid-<?php if(isset($img['id'])){ echo $img['id']; } ?> img-fluid mb-4" />
</figure>
</a>
</div>
<?php
}

?>
</div></div>