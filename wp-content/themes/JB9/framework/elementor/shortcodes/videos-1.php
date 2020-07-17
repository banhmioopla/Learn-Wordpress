<?php global $CORE, $userdata, $post, $settings; 
/*
 [name] =&gt; file_example_MP4_480_1_5MG.mp4
            [type] =&gt; video/mp4
            [postID] =&gt; 637
            [size] =&gt; 1570024
            [src] =&gt; http://localhost/V9/wp-content/uploads/2019/09/file_example_MP4_480_1_5MG-1.mp4
            [thumbnail] =&gt; https://via.placeholder.com/150x100.png?text=No+Preview
            [filepath] =&gt; C:\xampp\htdocs\V9/wp-content/uploads/2019/09/file_example_MP4_480_1_5MG-1.mp4
            [id] =&gt; 660
            [default] =&gt; 
            [order] =&gt; 0
            [dimentions] =&gt; 0
            [dpi] =&gt; 0
*/

?><div class="container-fluid">
<div class="row videos-1">
<?php
foreach($settings['videos'] as $vid){  
?><div class="col-6 px-1">
<figure class="mb-3"><?php echo do_shortcode('[video src="'.$vid['src'].'" height="230px" poster="'.$vid['thumbnail'].'"][/video]'); ?></figure>
</div>
<?php
}

?>
</div></div>