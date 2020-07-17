     
		<?php // Get RSS Feed(s)
        include_once( ABSPATH . WPINC . '/feed.php' );
        
        // Get a SimplePie feed object from the specified feed source.
        $rss = fetch_feed( 'https://www.premiumpress.com/feed/?post_type=blog_type' );
        
        $maxitems = 10;
        
        if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly
        
            // Figure out how many total items there are, but limit it to 5. 
            $maxitems = $rss->get_item_quantity( 5 ); 
        
            // Build an array of all the items, starting with element 0 (first element).
            $rss_items = $rss->get_items( 0, $maxitems );
        
        endif;
        ?>
        
    <div class="card">
    
    <div class="card-header">PremiumPress Lastest News</div>
    
    <div class="card-body">
    
      
<div class="newsfeed">

       
        <ul class="list-unstyled">
            <?php if ( $maxitems == 0 ) : ?>
                <li><?php _e( 'No items', 'my-text-domain' ); ?></li>
            <?php else : ?>
                <?php // Loop through each feed item and display each item as a hyperlink. ?>
                <?php foreach ( $rss_items as $item ) : ?>
                    <li>
           
                        <a href="<?php echo esc_url( $item->get_permalink() ); ?>"
                            title="<?php printf( __( 'Posted %s', 'my-text-domain' ), $item->get_date('j F Y | g:i a') ); ?>" target="_blank">
                            <?php echo esc_html( $item->get_title() ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
</div>

    </div>
    </div>