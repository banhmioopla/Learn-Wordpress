<?php




class Walker_Admin_Taxonomy extends Walker_Category {
 
    public $tree_type = 'category'; 
    public $db_fields = array ('parent' => 'parent', 'id' => 'term_id');
 
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
    
            return;
 
        $indent = str_repeat("\t", $depth);
         
    }
 
 
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( 'list' != $args['style'] )
            return;
 
        $indent = str_repeat("\t", $depth);
      
    }
 
 
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );
 
        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }
		
		$sep = "";
		if($category->parent == 0){
		
		}else{
		$sep = " -- ";
		}
		
		if( in_array($category->term_id, $args['selected']) ){
		$output .= '<option value="'.$category->term_id.'" selected=selected>'. $sep . $cat_name .' (' . number_format_i18n( $category->count ) . ') </option>';
		}else{
		$output .= '<option value="'.$category->term_id.'">'. $sep . $cat_name .' (' . number_format_i18n( $category->count ) . ') </option>';
		}
        
 
         
    }
 
    public function end_el( &$output, $page, $depth = 0, $args = array() ) {
     
            return; 
        
    }
 
}



class walker_inline_menu extends Walker_Nav_Menu {   

 public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
 
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = ' list-inline-item menu-item-' . $item->ID;
 
        /**
         * Filters the arguments for a single nav menu item.
         *
         * @since 4.4.0
         *
         * @param array  $args  An array of arguments.
         * @param object $item  Menu item data object.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
 
        /**
         * Filters the CSS class(es) applied to a menu item's list item element.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of wp_nav_menu() arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
 
        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param object $item    The current menu item.
         * @param array  $args    An array of wp_nav_menu() arguments.
         * @param int    $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
 
        $output .= $indent . '<li' . $id . $class_names .'>';
 
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
 
        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title  Title attribute.
         *     @type string $target Target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param object $item  The current menu item.
         * @param array  $args  An array of wp_nav_menu() arguments.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
 
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
 
        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );
 
        /**
         * Filters a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string $title The menu item's title.
         * @param object $item  The current menu item.
         * @param array  $args  An array of wp_nav_menu() arguments.
         * @param int    $depth Depth of menu item. Used for padding.
         */
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
 
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
 
        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @since 3.0.0
         *
         * @param string $item_output The menu item's starting HTML output.
         * @param object $item        Menu item data object.
         * @param int    $depth       Depth of menu item. Used for padding.
         * @param array  $args        An array of wp_nav_menu() arguments.
         */
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
/* =============================================================================
D_CATEGORIES SHORTCODE WALKER
========================================================================== */

class walker_dropdown_categories extends Walker_Category {  

function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) { global $CORE;
    /** This filter is documented in wp-includes/category-template.php */
    $cat_name = apply_filters(
        'list_cats',
        esc_attr( $category->name ),
        $category
    );
 
    // Don't generate an element if the category name is empty.
    if ( ! $cat_name ) {
        return;
    }
	
		// CHECK FOR CATEGORY TRANSLATIONS
		$catTrans = _ppt('category_translation');
		$lang = $CORE->_language_current();
		if($catTrans != "" && $lang != "en_US"){ 
			if(isset($catTrans[strtolower($lang)]) && isset($catTrans[strtolower($lang)][$category->term_id]) ){			
				$cat_name = $catTrans[strtolower($lang)][$category->term_id];			
			}		
		}
 
    $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" class="dropdown-item" ';
    if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
        /**
         * Filters the category description for display.
         *
         * @since 1.2.0
         *
         * @param string $description Category description.
         * @param object $category    Category object.
         */
        $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
    }
	
	
 
    $link .= '>';
    $link .= $cat_name . '</a>';
 
    if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
        $link .= ' ';
 
        if ( empty( $args['feed_image'] ) ) {
            $link .= '(';
        }
 
        $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';
 
        if ( empty( $args['feed'] ) ) {
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
        } else {
            $alt = ' alt="' . $args['feed'] . '"';
            $name = $args['feed'];
            $link .= empty( $args['title'] ) ? '' : $args['title'];
        }
 
        $link .= '>';
 
        if ( empty( $args['feed_image'] ) ) {
            $link .= $name;
        } else {
            $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
        }
        $link .= '</a>';
 
        if ( empty( $args['feed_image'] ) ) {
            $link .= ')';
        }
    } 
 
    if ( ! empty( $args['show_count'] ) ) {
        $link .= ' (' . number_format_i18n( $category->count ) . ')';
    }
    if ( 'list' == $args['style'] ) {
        //$output .= "\t<li";
        $css_classes = array(
            'cat-item',
            'cat-item-' . $category->term_id,
        );
 
        if ( ! empty( $args['current_category'] ) ) {
            // 'current_category' can be an array, so we use `get_terms()`.
            $_current_terms = get_terms( $category->taxonomy, array(
                'include' => $args['current_category'],
                'hide_empty' => false,
            ) );
 
            foreach ( $_current_terms as $_current_term ) {
                if ( $category->term_id == $_current_term->term_id ) {
                    $css_classes[] = 'current-cat';
                } elseif ( $category->term_id == $_current_term->parent ) {
                    $css_classes[] = 'current-cat-parent';
                }
                while ( $_current_term->parent ) {
                    if ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] =  'current-cat-ancestor';
                        break;
                    }
                    $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                }
            }
        }
 
        /**
         * Filters the list of CSS classes to include with each category in the list.
         *
         * @since 4.2.0
         *
         * @see wp_list_categories()
         *
         * @param array  $css_classes An array of CSS classes to be applied to each list item.
         * @param object $category    Category data object.
         * @param int    $depth       Depth of page, used for padding.
         * @param array  $args        An array of wp_list_categories() arguments.
         */
        $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
 
        //$output .=  ' class="' . $css_classes . '"';
        $output .= "$link\n";
    } elseif ( isset( $args['separator'] ) ) {
        $output .= "\t$link" . $args['separator'] . "\n";
    } else {
        $output .= "\t$link<br />\n";
    }
	
	}



    //function start_lvl(&$output, $depth=1, $args=array()) {  
    //    $output .= "\n<ul class=\"product_cats\">\n";  
    //}  

   // function end_lvl(&$output, $depth=0, $args=array()) {  
   //     $output .= "</ul>\n";  
    //}  
 
    function end_el(&$output, $item, $depth=0, $args=array()) {  
     $output .= "\n";  
   }  
}
 
/* =============================================================================
D_CATEGORIES SHORTCODE WALKER
========================================================================== */

class walker_dropdown_categories_form extends Walker_Category {  

function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) { global $CORE;
    /** This filter is documented in wp-includes/category-template.php */
    $cat_name = apply_filters(
        'list_cats',
        esc_attr( $category->name ),
        $category
    );
 
    // Don't generate an element if the category name is empty.
    if ( ! $cat_name ) {
        return;
    }
	
		// CHECK FOR CATEGORY TRANSLATIONS
		$catTrans = _ppt('category_translation');
		$lang = $CORE->_language_current();
		if($catTrans != "" && $lang != "en_US"){ 
			if(isset($catTrans[strtolower($lang)]) && isset($catTrans[strtolower($lang)][$category->term_id]) ){			
				$cat_name = $catTrans[strtolower($lang)][$category->term_id];			
			}		
		}
 
    $link = '<a href="#" data-catid="'.$category->term_id.'" data-name="'.$category->name.'" class="dropdown-item" ';
	
    if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
        /**
         * Filters the category description for display.
         *
         * @since 1.2.0
         *
         * @param string $description Category description.
         * @param object $category    Category object.
         */
        $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
    }
	
	
 
    $link .= '>';
    $link .= $cat_name . '</a>';
 
    if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
        $link .= ' ';
 
        if ( empty( $args['feed_image'] ) ) {
            $link .= '(';
        }
 
     $link = '<a href="#" data-catid="'.$category->term_id.'" data-name="'.$category->name.'" class="dropdown-item" ';
 
        if ( empty( $args['feed'] ) ) {
            $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
        } else {
            $alt = ' alt="' . $args['feed'] . '"';
            $name = $args['feed'];
            $link .= empty( $args['title'] ) ? '' : $args['title'];
        }
 
        $link .= '>';
 
        if ( empty( $args['feed_image'] ) ) {
            $link .= $name;
        } else {
            $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
        }
        $link .= '</a>';
 
        if ( empty( $args['feed_image'] ) ) {
            $link .= ')';
        }
    } 
 
    if ( ! empty( $args['show_count'] ) ) {
        $link .= ' (' . number_format_i18n( $category->count ) . ')';
    }
    if ( 'list' == $args['style'] ) {
        //$output .= "\t<li";
        $css_classes = array(
            'cat-item',
            'cat-item-' . $category->term_id,
        );
 
        if ( ! empty( $args['current_category'] ) ) {
            // 'current_category' can be an array, so we use `get_terms()`.
            $_current_terms = get_terms( $category->taxonomy, array(
                'include' => $args['current_category'],
                'hide_empty' => false,
            ) );
 
            foreach ( $_current_terms as $_current_term ) {
                if ( $category->term_id == $_current_term->term_id ) {
                    $css_classes[] = 'current-cat';
                } elseif ( $category->term_id == $_current_term->parent ) {
                    $css_classes[] = 'current-cat-parent';
                }
                while ( $_current_term->parent ) {
                    if ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] =  'current-cat-ancestor';
                        break;
                    }
                    $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                }
            }
        }
 
        /**
         * Filters the list of CSS classes to include with each category in the list.
         *
         * @since 4.2.0
         *
         * @see wp_list_categories()
         *
         * @param array  $css_classes An array of CSS classes to be applied to each list item.
         * @param object $category    Category data object.
         * @param int    $depth       Depth of page, used for padding.
         * @param array  $args        An array of wp_list_categories() arguments.
         */
        $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
 
        //$output .=  ' class="' . $css_classes . '"';
        $output .= "$link\n";
    } elseif ( isset( $args['separator'] ) ) {
        $output .= "\t$link" . $args['separator'] . "\n";
    } else {
        $output .= "\t$link<br />\n";
    }
	
	}



    //function start_lvl(&$output, $depth=1, $args=array()) {  
    //    $output .= "\n<ul class=\"product_cats\">\n";  
    //}  

   // function end_lvl(&$output, $depth=0, $args=array()) {  
   //     $output .= "</ul>\n";  
    //}  
 
    function end_el(&$output, $item, $depth=0, $args=array()) {  
     $output .= "\n";  
   }  
} 

/* =============================================================================
ADVANCED SEARCH WALKER FOR CUSTOM TAXONOMIES
========================================================================== */
function count_tax_amount_search($category, $nid){ global $wpdb;

	// NO RESULTS
	if($category->count < 1){ return 0; }

	
	// CHECK FOR PRICE SEARCHES
	$priceSearch = false;
	if(isset($_GET['price1']) && $_GET['price1'] > 0){
	$priceSearch = true;
	}
	
	// DONT DO THIS FOR ALL CATEGORIES
	//if($category->category_parent == 0 && !$priceSearch ){ return $category->count; }

 	// THIS CATEGORY
	$tax[] = array('taxonomy' => $category->taxonomy, 'field'  => 'term_id', 'terms'    => $category->term_id );
 	
	// CHECK FO EXISTING CATEGORY $cancontinue = false;
	$cat = get_query_var('term'); 
	if(strlen($cat) > 1){
		$vv = get_term_by('slug', $cat, 'listing');		 
		$tax[] = array('taxonomy' => 'listing', 'field'  => 'term_id', 'terms' => array( $vv->term_id ), 'operator' => 'IN'  );
	}
	
	
	if(is_array($_GET)){
		foreach($_GET as $key => $data){
		 	
			
			if(substr($key,0,2) == "ct" && is_numeric(substr($key,-2)) ){ 
				
				$cancontinue = true;
				
				// GET DATA FROM DATABASE
				$SQL = "SELECT * FROM ".$wpdb->prefix."core_search WHERE id = ('".substr($key,-2)."') LIMIT 1";
				$fields = $wpdb->get_results($SQL, ARRAY_A);
			 	
				// APPLY TO QUERY
				$tax[] = array('taxonomy' => $fields[0]['key'], 'field'  => 'term_id', 'terms' => $data, 'operator' => 'IN'  );
		 
			
			}// end if	
			
				
		}	// end foreach
	}// end if
	

	
	/*if(!$cancontinue){
	
		// RETURN 0 OTHERWISE WILL SHOW RESULTS FOR EVERYTHING
		if(!isset($_GET['advanced_search']) ) { return 0; }
		
		
		return $category->count;
	}*/
 
 
	// BUILT ARRAY
	$args = array(
		'post_type' => 'listing_type',
		'tax_query' => array( 'relation' => 'AND', $tax ),
	);
	
	// ADD ON PRICE SEARCH
 
	if($priceSearch){
		$args = array_merge($args, array( 'meta_query' => array(
			array(
				'key' => "price",
				'type' => 'NUMERIC',
				'value' => array($_GET['price1'],$_GET['price2']),
				'compare'=> 'BETWEEN'	
			), 
		), ) );
		
	 
	}
	
	
	
	//echo "------------------";
	//print_r($args);
	//echo "------------------";
	//die(print_r($args));
	 
	$query = new WP_Query( $args );
	$count = $query->found_posts;
	
	return $count;
}


class walker_search_taxonomies extends Walker_Category {  




		function start_lvl( &$output, $depth = 0, $args = array() ) {
		
		return;
	 
		}
		function end_lvl( &$output, $depth = 0, $args = array() ) {
		
		return;
	            
	    }
 

 
function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );
 
        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }
		
		$link = "";
		 
		
		// CHECK BOX FOR SELECTED ATTRIBUTE
	 	$checkedm = "";
		if(isset($_GET['ct'.$args['fieldid']]) && in_array($category->term_id, $_GET['ct'.$args['fieldid']]) ){
		$checkedm = "checked=checked";	
		} 
		
		
		// NEW COUNT
		$count = count_tax_amount_search($category, $args['fieldid']); 
		if($count == 0){ return; }
		  
		ob_start(); ?> 
	   
        <?php if ($args['has_children'] ) {  }else{ ?>
        
        
         <span class="pull-right grey small">(<?php echo number_format_i18n($count); ?>)</span>
            
        
        <label class="checkbox <?php echo str_replace("checked=checked", "checked", $checkedm); if($category->taxonomy =="color"){ echo trim(strtolower(str_replace(" ","",$category->name))); } ?>" >
                                                        
            <input type="checkbox" data-toggle="checkbox" name="ct<?php echo $args['fieldid']; ?>[]" value="<?php echo $category->term_id; ?>" <?php echo $checkedm; ?>>
            
        <?php echo $cat_name; ?>
      
        </label>
        <?php }
		
		$link .= ob_get_clean();
	 
   
        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );
 
            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );
 
                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }
 
            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
 
            $output .=  ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    } 

   // function end_el(&$output, $item, $depth=0, $args=array()) {  
   //     $output .= "</li>\n";  
   // }  
}  






class walker_search_taxonomies_filter extends Walker_Category {  
}  






/* =============================================================================
BASIC CATEGORY WALKER
========================================================================== */

class walker_basic_categories extends Walker_Category {  

  public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
  
  global $CORE;
                /** This filter is documented in wp-includes/category-template.php */
                $cat_name = apply_filters(
                        'list_cats',
                        esc_attr( $category->name ),
                        $category
                );
				
// CHECK FOR CATEGORY TRANSLATIONS
		$catTrans = _ppt('category_translation');
		$lang = $CORE->_language_current();
		if($catTrans != "" && $lang != "en_US"){ 
			if(isset($catTrans[strtolower($lang)]) && isset($catTrans[strtolower($lang)][$category->term_id]) ){			
				$cat_name = $catTrans[strtolower($lang)][$category->term_id];			
			}		
		}
				
				
                // Don't generate an element if the category name is empty.
                if ( ! $cat_name ) {
                        return;
                }
                $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
                if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
                        /**
                         * Filter the category description for display.
                         *
                         * @since 1.2.0
                         *
                         * @param string $description Category description.
                         * @param object $category    Category object.
                         */
                        $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
                }
                $link .= '>';
                $link .= $cat_name . '</a>';
                if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
                        $link .= ' ';
                        if ( empty( $args['feed_image'] ) ) {
                                $link .= '(';
                        }
                        $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';
                        if ( empty( $args['feed'] ) ) {
                                $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
                        } else {
                                $alt = ' alt="' . $args['feed'] . '"';
                                $name = $args['feed'];
                                $link .= empty( $args['title'] ) ? '' : $args['title'];
                        }
                        $link .= '>';
                        if ( empty( $args['feed_image'] ) ) {
                                $link .= $name;
                        } else {
                                $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
                        }
                        $link .= '</a>';
                        if ( empty( $args['feed_image'] ) ) {
                                $link .= ')';
                        }
                }
                if ( ! empty( $args['show_count'] ) ) {
                        $link .= ' <span class="count">' . number_format_i18n( $category->count ) . '</span>';
                }
                if ( 'list' == $args['style'] ) {
                        $output .= "\t<li";
                        $css_classes = array(
                                'cat-item',
                                'cat-item-' . $category->term_id,
                        );
                        if ( ! empty( $args['current_category'] ) ) {
                                // 'current_category' can be an array, so we use `get_terms()`.
                                $_current_terms = get_terms( $category->taxonomy, array(
                                        'include' => $args['current_category'],
                                        'hide_empty' => false,
                                ) );
                                foreach ( $_current_terms as $_current_term ) {
                                        if ( $category->term_id == $_current_term->term_id ) {
                                                $css_classes[] = 'current-cat';
                                        } elseif ( $category->term_id == $_current_term->parent ) {
                                                $css_classes[] = 'current-cat-parent';
                                        }
                                        while ( $_current_term->parent ) {
                                                if ( $category->term_id == $_current_term->parent ) {
                                                        $css_classes[] =  'current-cat-ancestor';
                                                        break;
                                                }
                                                $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                                        }
                                }
                        }
                        /**
                         * Filter the list of CSS classes to include with each category in the list.
                         *
                         * @since 4.2.0
                         *
                         * @see wp_list_categories()
                         *
                         * @param array  $css_classes An array of CSS classes to be applied to each list item.
                         * @param object $category    Category data object.
                         * @param int    $depth       Depth of page, used for padding.
                         * @param array  $args        An array of wp_list_categories() arguments.
                         */
                        $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
                        $output .=  ' class="' . $css_classes . '"';
                        $output .= ">$link\n";
                } elseif ( isset( $args['separator'] ) ) {
                        $output .= "\t$link" . $args['separator'] . "\n";
                } else {
                        $output .= "\t$link<br />\n";
                }
        }

 

}


/* =============================================================================
ADVANCED SEARCH WALKER
========================================================================== */

class walker_search_categories extends Walker_Category {  


	function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( 'list' != $args['style'] )
				return;
	 
			$indent = str_repeat("\t", $depth);
			
			$output .= "<div class='accordion-inner'>";
			
			$output .= "$indent<ul class='children 123'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	      
		  if ( 'list' != $args['style'] )
                        return;
	
	                $indent = str_repeat("\t", $depth);
	                $output .= "$indent</ul>\n";
					
					$output .= "</div>";
	 }
 

 
function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
	
	global $CORE;

        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );
		
 
        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }
 
        $link = '';

		// CHECK FOR CATEGORY TRANSLATIONS
		$catTrans = _ppt('category_translation');
		$lang = $CORE->_language_current();
		if($catTrans != "" && $lang != "en_US"){ 
			if(isset($catTrans[strtolower($lang)]) && isset($catTrans[strtolower($lang)][$category->term_id]) ){			
				$cat_name = $catTrans[strtolower($lang)][$category->term_id];			
			}		
		}
 		
		// ADD ON ICON IF HAS ONE
 		$icon = "";
		//if(isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && strlen($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) > 1){		
		//	$icon = "<i class='fa ".$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]."'></i> ";		
		//}
 
        $link .= '';
		
		// CHECK BOX
	 	$checkedm = "";
		if(isset($_GET['ct'.$args['fieldid']]) && in_array($category->term_id, $_GET['ct'.$args['fieldid']]) ){
		$checkedm = "checked=checked";	
		} 
		
		// CHECK FO EXISTING CATEGORY
		$cat = get_query_var('term');
		if(strlen($cat) > 1){
	 
			$vv = get_term_by('slug', $cat, 'listing');
			 
			if(isset($vv->term_id) && $category->term_id == $vv->term_id ){
			$checkedm = "checked=checked";	
			}
		}
			
		 // NEW COUNT
		$count =  count_tax_amount_search($category, $args['fieldid']); 
		if($count == 0){ return; }
		

		
		ob_start();
		?>
  
        
        <?php  if ($args['has_children'] && $category->parent == 0 ) { ?>
        
         <a data-toggle="collapse" data-parent="#accordion" href="#scat<?php echo $category->term_id; ?>" class="collapsed">
        
        <?php echo $icon . $cat_name; ?> 
        
        </a>
        
            <div class='accordion-body collapse <?php if($checkedm != "" || $category->parent != 0  ){ echo "in"; } ?>' id='scat<?php echo $category->term_id; ?>' data-pid="<?php echo $category->category_parent; ?>">        
        
            <ul class="children">
            
            <li>
            
             <div class="allcats"><a href="<?php echo esc_url( get_term_link( $category ) ); ?>" ><?php echo __('All Listings','premiumpress'); ?></a></div>
        
            </li>
            
            </ul> 
     
        <?php }else{ ?>
        
            <label class="checkbox <?php echo str_replace("checked=checked", "checked", $checkedm); ?>">
                                                        
                <input type="checkbox" data-toggle="checkbox" name="ct<?php echo $args['fieldid']; ?>[]" value="<?php echo $category->term_id; ?>" <?php echo $checkedm; ?>>
                
            <?php echo $icon . $cat_name; ?>  
            
            <?php if($checkedm != ""){ ?> 
            <script>
			jQuery(document).ready(function(){ 			
				// GET PID DATA				
				var parentid = jQuery('.adscatlist .cat-item-<?php echo $category->category_parent; ?>').data( "pid" );
				//console.log(parentid+'<--');
				jQuery('#scat'+parentid).addClass('in');
			});
			</script>
            <?php } ?>
             
        
        <?php } ?>
        
    
            
            
            
          
            
            
            
            
            
            
            
            
													
	
													
		 </label>
		<?php
		
		$link .= ob_get_clean();
	 
   
        if ( 'list' == $args['style'] ) {
			
			if($category->category_parent == 0){
			$pid = $category->term_id;
			}else{
			$pid = $category->category_parent;
			}
		
            $output .= "\t<li data-pid='".$pid."' ";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );
 
            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );
 
                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }
 
            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
 
            $output .=  ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    } 

   // function end_el(&$output, $item, $depth=0, $args=array()) {  
   //     $output .= "</li>\n";  
   // }  
}  







/* =============================================================================
ADVANCED SEARCH WALKER
========================================================================== */

class walker_search_categories_filter extends Walker_Category {  


	function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( 'list' != $args['style'] )
				return;
	 
			$indent = str_repeat("\t", $depth);
			
			$output .= "<div class='accordion-inner'>";
			
			$output .= "$indent<ul class='children 123'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	      
		  if ( 'list' != $args['style'] )
                        return;
	
	                $indent = str_repeat("\t", $depth);
	                $output .= "$indent</ul>\n";
					
					$output .= "</div>";
	 }
 

 
function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
	
	global $CORE;

        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );
		
 
        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }
 
        $link = '';

		// CHECK FOR CATEGORY TRANSLATIONS
		$catTrans = _ppt('category_translation');
		$lang = $CORE->_language_current();
		if($catTrans != "" && $lang != "en_US"){ 
			if(isset($catTrans[strtolower($lang)]) && isset($catTrans[strtolower($lang)][$category->term_id]) ){			
				$cat_name = $catTrans[strtolower($lang)][$category->term_id];			
			}		
		}
 		
		// ADD ON ICON IF HAS ONE
 		$icon = "";
		//if(isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && strlen($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) > 1){		
		//	$icon = "<i class='fa ".$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]."'></i> ";		
		//}
 
        $link .= '';
		
		// CHECK BOX
	 	$checkedm = "";
		if(isset($_GET['ct'.$args['fieldid']]) && in_array($category->term_id, $_GET['ct'.$args['fieldid']]) ){
		$checkedm = "checked=checked";	
		} 
		
		// CHECK FO EXISTING CATEGORY
		$cat = get_query_var('term');
		if(strlen($cat) > 1){
	 
			$vv = get_term_by('slug', $cat, 'listing');
			 
			if(isset($vv->term_id) && $category->term_id == $vv->term_id ){
			$checkedm = "checked=checked";	
			}
		}
			
		 // NEW COUNT
		$count =  count_tax_amount_search($category, $args['fieldid']); 
		if($count == 0){ return; }
		

		
		ob_start();
		?>
  
        
        <?php  if ($args['has_children'] && $category->parent == 0 ) { ?>
        
        
        <label class="checkbox <?php echo str_replace("checked=checked", "checked", $checkedm); ?>">
                                                        
                <input type="checkbox" data-toggle="checkbox" name="ct<?php echo $args['fieldid']; ?>[]" value="<?php echo $category->term_id; ?>" <?php echo $checkedm; ?>>
             
             </label>
             
         <a data-toggle="collapse" data-parent="#accordion" href="#scat<?php echo $category->term_id; ?>" class="collapsed" style="margin-left:30px;">
        
        
        <?php echo $icon . $cat_name; ?> 
        
        </a>
        
            <div class='accordion-body collapse <?php if($checkedm != "" || $category->parent != 0  ){ echo "in"; } ?>' id='scat<?php echo $category->term_id; ?>' data-pid="<?php echo $category->category_parent; ?>">        
        
            
     
        <?php }else{ ?>
        
            <label class="checkbox <?php echo str_replace("checked=checked", "checked", $checkedm); ?>">
                                                        
                <input type="checkbox" data-toggle="checkbox" name="ct<?php echo $args['fieldid']; ?>[]" value="<?php echo $category->term_id; ?>" <?php echo $checkedm; ?>>
                
            <?php echo $icon . $cat_name; ?>  
            
            <?php if($checkedm != ""){ ?> 
            <script>
			jQuery(document).ready(function(){ 			
				// GET PID DATA				
				var parentid = jQuery('.adscatlist .cat-item-<?php echo $category->category_parent; ?>').data( "pid" );
				//console.log(parentid+'<--');
				jQuery('#scat'+parentid).addClass('in');
			});
			</script>
            <?php } ?>
             
        
        <?php } ?>
        
    
            
            
            
          
            
            
            
            
            
            
            
            
													
	
													
		 </label>
		<?php
		
		$link .= ob_get_clean();
	 
   
        if ( 'list' == $args['style'] ) {
			
			if($category->category_parent == 0){
			$pid = $category->term_id;
			}else{
			$pid = $category->category_parent;
			}
		
            $output .= "\t<li data-pid='".$pid."' ";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );
 
            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );
 
                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }
 
            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
 
            $output .=  ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    } 

   // function end_el(&$output, $item, $depth=0, $args=array()) {  
   //     $output .= "</li>\n";  
   // }  
}  










/* =============================================================================
D_CATEGORIES SHORTCODE WALKER
========================================================================== */

class walker_shortcode_dcats extends Walker_Category {  



function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) { global $CORE;
        /** This filter is documented in wp-includes/category-template.php */
        $cat_name = apply_filters(
            'list_cats',
            esc_attr( $category->name ),
            $category
        );
 
        // Don't generate an element if the category name is empty.
        if ( ! $cat_name ) {
            return;
        }
		
		if(!isset($args['limit_list'])){
		$args['limit_list'] = 5;
		}
		
		// FIRST CHECK LIST LIMIT
		if($category->parent == 0){
			$GLOBALS['_list_count'] = 0;
			$GLOBALS['_list'] = $GLOBALS['_list'] + 1;
		}elseif(!isset($GLOBALS['_list_count']) && $category->parent != 0){		
			$GLOBALS['_list_count'] = 1;
		}elseif(isset($GLOBALS['_list_count']) && $category->parent != 0){	
			$GLOBALS['_list_count'] ++;
		}		
		if($GLOBALS['_list_count'] > $args['limit_list']){ return; }
		
		if($GLOBALS['_list'] > $args['limit']){ return; }
		
 
        $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" '; 		
		// ADD ON ICON IF HAS ONE
 		$icon = "";
		if(isset($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) && strlen($GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]) > 2){		
			$icon = "<i class='fa text-primary ".$GLOBALS['CORE_THEME']['category_icon_small_'.$category->term_id]."'></i> ";		
		}
 
        $link .= '>';
	  
		// CHECK FOR CATEGORY TRANSLATIONS
		$catTrans = _ppt('category_translation');
		$lang = $CORE->_language_current();
		if($catTrans != "" && $lang != "en_US"){ 
			if(isset($catTrans[strtolower($lang)]) && isset($catTrans[strtolower($lang)][$category->term_id]) ){			
				$cat_name = $catTrans[strtolower($lang)][$category->term_id];			
			}		
		}
		
		  if ( ! empty( $args['show_count'] ) ) {
            $link .= ' <span class="catcount float-right">(' . number_format_i18n( $category->count ) . ')</span>';
        }
		
        $link .= $icon . $cat_name. '</a>';
		
 
      
        if ( 'list' == $args['style'] ) {
            $output .= "\t<li";
            $css_classes = array(
                'cat-item',
                'cat-item-' . $category->term_id,
            );
 
            if ( ! empty( $args['current_category'] ) ) {
                // 'current_category' can be an array, so we use `get_terms()`.
                $_current_terms = get_terms( $category->taxonomy, array(
                    'include' => $args['current_category'],
                    'hide_empty' => false,
                ) );
				
				
 
                foreach ( $_current_terms as $_current_term ) {
                    if ( $category->term_id == $_current_term->term_id ) {
                        $css_classes[] = 'current-cat';
                    } elseif ( $category->term_id == $_current_term->parent ) {
                        $css_classes[] = 'current-cat-parent';
                    }
                    while ( $_current_term->parent ) {
                        if ( $category->term_id == $_current_term->parent ) {
                            $css_classes[] =  'current-cat-ancestor';
                            break;
                        }
                        $_current_term = get_term( $_current_term->parent, $category->taxonomy );
                    }
                }
            }
			
			if($category->parent == 0){
			 $css_classes[] = 'cat-parent';
 			}
			
            /**
             * Filters the list of CSS classes to include with each category in the list.
             *
             * @since 4.2.0
             *
             * @see wp_list_categories()
             *
             * @param array  $css_classes An array of CSS classes to be applied to each list item.
             * @param object $category    Category data object.
             * @param int    $depth       Depth of page, used for padding.
             * @param array  $args        An array of wp_list_categories() arguments.
             */
            $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );
 
            $output .=  ' class="' . $css_classes . '"';
            $output .= ">$link\n";
        } elseif ( isset( $args['separator'] ) ) {
            $output .= "\t$link" . $args['separator'] . "\n";
        } else {
            $output .= "\t$link<br />\n";
        }
    } 

     function end_el(&$output, $item, $depth=0, $args=array()) {  
	
	 	if($GLOBALS['_dcats_count'] > $args['limit']){ return; }
         $output .= "</li>\n";  
     }  
}  






/* =============================================================================
FILTER WALKERS
========================================================================== */


class walker_shortcode_filter_tax extends Walker_Category {  



function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) { global $CORE;

 
  
    	
	   if( isset($_GET['catid123']) && $_GET['catid123'] != $item->term_id && $args['child_of'] == "" ){ 
		
		// DO NOTHING
		
		 	
		}else{
		
		
		?> 
        
 <li id="filter-<?php echo $args['taxonomy']; ?><?php echo $item->term_id; ?>" data-type="<?php echo $args['taxonomy']; ?>" data-value="<?php echo $item->term_id; ?>">
    <a href="javascript:void(0);" onclick="addtaxfilter('<?php echo $item->term_id; ?>','<?php echo $args['taxonomy']; ?>');">
	<?php if($args['child_of'] != ""){ ?>
     <i class="fa fa-angle-right" aria-hidden="true"></i>
	<?php } ?>
	<?php echo esc_attr( $item->name ); ?>
    </a>
      
  </li> 
  
        <?php
		
		}
		 
		
    }  

    function end_el(&$output, $item, $depth=0, $args=array(), $id = 0) {  
      return;
    }  
	
	function start_lvl( &$output,  $depth = 0, $args = array(), $id = 0 ) {  
		return; 
	}
	
	function end_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
		return;
	} 
}  






class walker_shortcode_filter_cats extends Walker_Category {  



function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) { global $CORE;
  
    	
	   if( isset($_GET['catid']) && $_GET['catid'] != $item->term_id && $args['child_of'] == "" ){ 
		
		// DO NOTHING
		
		 	
		}else{
		
		
		?> 
        
 <li id="filter-catid<?php echo $item->term_id; ?>" data-type="catid" data-value="<?php echo $item->term_id; ?>">
    <a href="javascript:void(0);" onclick="addnewfilter('<?php echo $item->term_id; ?>','<?php if($args['child_of'] == ""){ echo 'catid'; }else{ echo 'catid'; } /* removed subcat*/ ?>');">
	<?php if($args['child_of'] != ""){ ?>
     <i class="fa fa-angle-right" aria-hidden="true"></i>
	<?php } ?>
	<?php echo esc_attr( $item->name ); ?>
    </a>
      
  </li> 
  
        <?php
		
		}
		 
		
    }  

    function end_el(&$output, $item, $depth=0, $args=array(), $id = 0) {  
      return;
    }  
	
	function start_lvl( &$output,  $depth = 0, $args = array(), $id = 0 ) {  
		return; 
	}
	
	function end_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
		return;
	} 
}  
 
/* =============================================================================
PAGE NAVIGATION
========================================================================== */


class wlt_admin_paginator {
    var $items_per_page;
    var $items_total;
    var $current_page;
    var $num_pages;
    var $mid_range;
    var $low;
    var $high;
    var $limit;
    var $return;
	var $pagelink;
    var $default_ipp = 25;
 
    function Paginator()
    {
        $this->current_page = 1;
        $this->mid_range = 7;
        $this->items_per_page = (!empty($_GET['ipp'])) ? $_GET['ipp']:$this->default_ipp;
    }
 
    function paginate()
    {
		if(!isset($_GET['ipp'])){ $_GET['ipp'] = 20; }
		
        if(isset($_GET['ipp']) && $_GET['ipp'] == 'All')
        {
            $this->num_pages = ceil($this->items_total/$this->default_ipp);
            $this->items_per_page = $this->default_ipp;
        }
        else
        {
            if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
            $this->num_pages = ceil($this->items_total/$this->items_per_page);
        }
		if(!isset($_GET['cpage'])){ $_GET['cpage'] =1; }
		
        $this->current_page = (int) $_GET['cpage']; // must be numeric > 0
        if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
        if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
        $prev_page = $this->current_page-1;
        $next_page = $this->current_page+1;
 
        if($this->num_pages > 10)
        {
            $this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"page-link\" href=\"".$this->pagelink."&cpage=$prev_page&ipp=$this->items_per_page\">Previous</a> ":"<a class=\"page-link inactive\" href=\"#\">Previous</a>";
 
            $this->start_range = $this->current_page - floor($this->mid_range/2);
            $this->end_range = $this->current_page + floor($this->mid_range/2);
 
            if($this->start_range <= 0)
            {
                $this->end_range += abs($this->start_range)+1;
                $this->start_range = 1;
            }
            if($this->end_range > $this->num_pages)
            {
                $this->start_range -= $this->end_range-$this->num_pages;
                $this->end_range = $this->num_pages;
            }
            $this->range = range($this->start_range,$this->end_range);
 
            for($i=1;$i<=$this->num_pages;$i++)
            {
                if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
                // loop through all pages. if first, last, or in range, display
                if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
                {
                    $this->return .= ($i == $this->current_page And $_GET['cpage'] != 'All') ? "<a title=\"Go to page $i of $this->num_pages\" class=\"page-link current\" href=\"#\">$i</a> ":"<a class=\"page-link\" title=\"Go to page $i of $this->num_pages\" href=\"".$this->pagelink."&cpage=$i&ipp=$this->items_per_page\">$i</a> ";
                }
                if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return;
            }
            $this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And ($_GET['cpage'] != 'All')) ? "<a class=\"page-link\" href=\"".$this->pagelink."&cpage=$next_page&ipp=$this->items_per_page\">Next</a>\n":"<a class=\"inactive\" href=\"#\">Next</a>\n";
			
            //$this->return .= ($_GET['cpage'] == 'All') ? "<a class=\"page-link current\" style=\"margin-left:10px\" href=\"#\">All</a> \n":"<a class=\"page-link\" href=\"".$this->pagelink."&cage=1&ipp=All\">All</a> \n";
        }
        else
        {
            for($i=1;$i<=$this->num_pages;$i++)
            {
                $this->return .= ($i == $this->current_page) ? "<a class=\"page-link current\" href=\"#\">$i</a>":"<a class=\"page-link\" href=\"".$this->pagelink."&cpage=$i&ipp=$this->items_per_page\">$i</a>";
            }
            //$this->return .= "<a class=\"page-link\" href=\"".$this->pagelink."&cpage=1&ipp=All\">All</a> \n";
        }
        $this->low = ($this->current_page-1) * $this->items_per_page;
        $this->high = ($_GET['ipp'] == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
        $this->limit = ($_GET['ipp'] == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
    }
 
    function display_items_per_page()
    {
        $items = '';
        $ipp_array = array(10,25,50,100,'All');
        foreach($ipp_array as $ipp_opt)    $items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n":"<option value=\"$ipp_opt\">$ipp_opt</option>\n";
        return "<span class=\"page-item\">Items per page:</span><select class=\"page-link\" onchange=\"window.location='".$this->pagelink."&cpage=1&ipp='+this[this.selectedIndex].value;return false\">$items</select>\n";
    }
 
    function display_jump_menu()
    {
        for($i=1;$i<=$this->num_pages;$i++)
        {
            $option .= ($i==$this->current_page) ? "<option value=\"$i\" selected>$i</option>\n":"<option value=\"$i\">$i</option>\n";
        }
        return "<span class=\"page-link\">Page:</span><select class=\"page-link\" onchange=\"window.location='".$this->pagelink."&cpage='+this[this.selectedIndex].value+'&ipp=$this->items_per_page';return false\">$option</select>\n";
    }
 
    function display_pages()
    {
        return $this->return;
    }
}

/* =============================================================================
COMMENTS MOBILE WALKER
========================================================================== */

class ppt_comment_walker_mobile_single extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
		// constructor – wrapper for the comments list
		function __construct() { ?>
  
			 
		<?php }

		// start_lvl – wrapper for child comments list
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
	   
			<div class="child-comments comments-list">

		<?php }
	
		// end_lvl – closing wrapper for child comments list
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
 
			</div>

		<?php }

		// start_el – HTML for comment template
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
	 
			
			global $CORE, $post;
		 
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
	
			if ( 'article' == $args['style'] ) {
				$tag = 'article';
				$add_below = 'comment';
			} else {
				$tag = 'article';
				$add_below = 'comment';
			}
			
			// GET COMMENT SCORE
			$score = get_post_meta($comment->comment_ID, 'score', true);
			
			// STAR RATING
			$STAR = "";
			if($score != ""){
			$STAR = "";; // removed
			}
			
			 
			// GET POST AUTHOR
			if(isset($comment_ID)){
			$authorID = get_comment_author( $comment_ID );			
			$authora = get_user_by('email',$comment->comment_author_email);			
			$post_authorID = get_post_field( 'post_author', $comment_post_ID );
			}else{
			$authorID = 1;
			$authora = 1;
			$post_authorID = 1;
			}
			 
			 ?><article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
 
<div class="review-6 container">


<figure class="gravatar" style="float: left; margin-top: 5px; margin-right:15px;">
            <a href="<?php echo get_author_posts_url( $post_authorID ); ?>">
            <?php echo get_avatar( $comment, 25, '[default gravatar URL]', 'Author’s gravatar' ); ?>
            </a>
</figure>
         
				<h1 class="font-16 capitalize regularbold"><?php comment_author(); ?></h1>
				
                <em class="color-highlight font-11 small-text">
                
				<?php $diff = $CORE->date_timediff(get_comment_date()." ".get_comment_time()); echo $diff['string']." ". __("ago","premiumpress") ; ?> 
				 
                </em>
                
				<p>
				<?php comment_text() ?> 
				</p>
                
                
</div>

 <?php if ($comment->comment_approved == '0') : ?>
      <p class="comment-meta-item">Your comment is awaiting moderation.</p>
 <?php endif; ?>
 

   <div class="clearfix"></div>
</article>

 <div class="decoration"></div>
                
		<?php }

		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
			
        

		<?php }

		// destructor – closing wrapper for the comments list
		function __destruct() { ?>
 
		
		<?php }

}

/* =============================================================================
COMMENTS WALKER
========================================================================== */

class ppt_comment_walker extends Walker_Comment {
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
		// constructor – wrapper for the comments list
		function __construct() { ?>
  
			 
		<?php }

		// start_lvl – wrapper for child comments list
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
	   
			<div class="child-comments comments-list">

		<?php }
	
		// end_lvl – closing wrapper for child comments list
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 2; ?>
 
			</div>

		<?php }

		// start_el – HTML for comment template
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
	 
			
			global  $post_authorID, $args;
			
		 	$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); 
	
			 
		 	
			// GET POST AUTHOR
			if(isset($comment_ID)){
			$authorID = get_comment_author( $comment_ID );			
			$authora = get_user_by('email',$comment->comment_author_email);			
			$post_authorID = get_post_field( 'post_author', $comment_post_ID );
			}else{
			$authorID = 1;
			$authora = 1;
			$post_authorID = 1;
			}
			
			if(!isset($GLOBALS['comment-style'])){ $GLOBALS['comment-style'] = 1; }
			 
			// GET FILE
			get_template_part('framework/elementor/shortcodes/comment-'.$GLOBALS['comment-style']);	
			 	
		 
		
		}

		// end_el – closing HTML for comment template
		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
			
        

		<?php }

		// destructor – closing wrapper for the comments list
		function __destruct() { ?>
 
		
		<?php }

}
 
/* =============================================================================
WALKER CLASSES
========================================================================== */


class Walker_CategorySelection extends Walker_Category {  


     function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) { global $CORE; 
	 
	 
	 
		// CAT PRICES
		if(!isset($GLOBALS['catprices'])){
			$GLOBALS['catprices'] = get_option('wlt_catprices'); 
			if(!is_array($GLOBALS['catprices'])){ $GLOBALS['catprices'] = array(); }
	 	}
		
 
		// CHECK FOR CAT PRICE
		$eprice = ""; $ejquery = "";
		if(isset($GLOBALS['catprices'][$item->term_id]) && is_numeric($GLOBALS['catprices'][$item->term_id])  && $GLOBALS['catprices'][$item->term_id] > 0 ){ 
				$eprice = " (+".hook_price($GLOBALS['catprices'][$item->term_id]).')'; 
				
				$ejquery = "addExtraPrice('".$GLOBALS['catprices'][$item->term_id]."','".$item->term_id."','category');";
			 
		}
 
		
		if(isset($args['parent_only']) && $args['parent_only'] == 1 && $item->parent != 0){
		
		// DO NOTHING
		
		}else{
		
		
		?> 
        
        <li data-catid="<?php echo $item->term_id; ?>" 
        
        <?php if($ejquery != ""){ ?>
        data-price="<?php echo $GLOBALS['catprices'][$item->term_id] ?>"
        <?php } ?>
        
        
         class="list-group-item catpid-<?php echo $item->parent; ?> catid-<?php echo $item->term_id; ?>" onclick="addToSelectedCats('<?php echo $item->term_id; ?>', '<?php echo $item->parent; ?>', '<?php echo esc_attr( $item->name ); ?>', '<?php echo esc_url( get_term_link( $item ) ); ?>','<?php echo $args['level']; ?>','');<?php echo $ejquery; ?>" style="cursor:pointer;">
              
            <?php echo esc_attr( $item->name ); ?>  <?php if($eprice != ""){ ?><span class="tag tag-success"><?php echo $eprice ; ?></span><?php } ?>
            
          </li>
        <?php
		
		}
		 
		
    }  

    function end_el(&$output, $item, $depth=0, $args=array(), $id = 0) {  
      return;
    }  
	
	function start_lvl( &$output,  $depth = 0, $args = array(), $id = 0 ) {  
		return; 
	}
	
	function end_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
		return;
	}
	
	
}

class Walker_CategorySelectionBAK extends Walker_Category {  


     function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) { global $CORE; 
	 
		// CAT PRICES
		if(!isset($GLOBALS['catprices'])){
		$GLOBALS['catprices'] = get_option('wlt_catprices'); 
		if(!is_array($GLOBALS['catprices'])){ $GLOBALS['catprices'] = array(); }
	 	}
		
		$GLOBALS['thiscatitemid'] = $item->term_id; 
		  
		// CHECK IF WE HAVE AN ICONS
		$image = "";		
		if(isset($GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]) && strlen($GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]) > 1){			
			$image = "<i class='fa ".$GLOBALS['CORE_THEME']['category_icon_small_'.$item->term_id]."'></i>"; 
		}		 
		
        $output .= "<li class=\"list-group-item\">";
		
		// CATEGORY VIEW
		$output .= "<a href='".esc_url( get_term_link( $item ) )."' class='pull-right hidden-xs' target='_blank'><small>".' (' . number_format( $item->count ) . ')'. " ".$CORE->_e(array('button','35'))."</small> </a>";
		
		// CHECK IF PARENT CAT IS DISABLED
		$disableParent = "";
		if(isset($GLOBALS['tpl-add']) && isset($GLOBALS['CORE_THEME']['disablecategory']) && $GLOBALS['CORE_THEME']['disablecategory'] == 1 && $item->parent == 0 ){	
		$disableParent = "disabled=disabled";
		}
		
		// CHECK FOR CAT PRICE
		$eprice = ""; $ejquery = "";
		if(isset($GLOBALS['catprices'][$item->term_id]) && is_numeric($GLOBALS['catprices'][$item->term_id]) && !in_array($item->term_id, explode(",",$args['selected']))  ){ 
				$eprice = " (+".hook_price($GLOBALS['catprices'][$item->term_id]).')'; 
				
				if($GLOBALS['CORE_THEME']['show_enhancements'] == 1){
				$ejquery = "onclick=\"listingenhancement('catb".$item->term_id."',".$GLOBALS['catprices'][$item->term_id].")\"id='catb".$item->term_id."'";
				}
		}
		
		// TEXT AND LINKS 
		if(in_array($item->term_id, explode(",",$args['selected']))){
		$output .= " <div class='tcbox'><input type='checkbox' class='tcheckbox' name='form[category][]' value='".$item->term_id."' ".$ejquery." checked=checked ".$disableParent."></div>";
		}else{
		$output .= " <div class='tcbox'><input type='checkbox' class='tcheckbox' name='form[category][]' value='".$item->term_id."' ".$ejquery." ".$disableParent."></div>";
		}		
		
		// DISPLAY
		$output .= "<span class='twrap'> ".$image." <strong>".esc_attr( $item->name )."</strong> ".$eprice." </span>";	 
		
		// FLAG
		$GLOBALS['lastparent_id'] = $item->term_id;
		 
		
    }  

    function end_el(&$output, $item, $depth=0, $args=array(), $id = 0) {  
        $output .= "</li>\n";  
    }  
	
	function start_lvl( &$output,  $depth = 0, $args = array(), $id = 0 ) { global $item;
 	 
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);		
		
		// HIDE CATS
		$output .= '<a href="javascript:void(0);" class="label label-default hidesub'. $GLOBALS['thiscatitemid'].'" style="display:none;"  
		onclick="jQuery(\'.hidesub'. $GLOBALS['thiscatitemid'].'\').hide(); jQuery(\'.showsub'. $GLOBALS['thiscatitemid'].'\').show(); jQuery(\'.subcats_'.$GLOBALS['thiscatitemid'].'\').hide();"> <i class="fa fa-chevron-up"></i> </a>';
		
		$output .= ' <a href="javascript:void(0);" class="label label-warning showsub'. $GLOBALS['thiscatitemid'].'"  
		onclick="jQuery(\'.hidesub'. $GLOBALS['thiscatitemid'].'\').show(); jQuery(\'.showsub'. $GLOBALS['thiscatitemid'].'\').hide(); jQuery(\'.subcats_'.$GLOBALS['thiscatitemid'].'\').show();"><i class="fa fa-chevron-down"></i></a> ';
		
		$output .= "<div  class='subcats_".$GLOBALS['thiscatitemid']."' style='display:none;'>";		
	
		// WRAPPER
		$output .= "<div style='max-height:600px; margin:0px; margin-top:10px; padding:0px; overflow: scroll;padding-right:10px;padding-bottom:10px;border-top:1px solid #ddd;padding-bottom:5px;'>";
 		
		// LIST
		$output .= "$indent<ul class='children' style='margin:0px;padding:0px; margin-top:10px; background:#fafafa;'>\n";
	}
	
	function end_lvl( &$output, $depth = 0, $args = array(), $id = 0 ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div></div>\n";
	}
	
	
}

/* =============================================================================
  [FRAMEWORK] BOOTSTRAP MENU WALKER FOR WORDPRESS
   ========================================================================== */
class Bootstrap_Walker1 extends Walker_Nav_Menu {     
     
        /* Start of the <ul> 
         * 
         * Note on $depth: Counterintuitively, $depth here means the "depth right before we start this menu".  
         *                   So basically add one to what you'd expect it to be 
         */         
        function start_lvl(&$output, $depth = 0, $args = array()) 
        {
		
            $tabs = str_repeat("\t", $depth); 
            // If we are about to start the first submenu, we need to give it a dropdown-menu class 
			if(!isset($GLOBALS['flasg_smalldevicemenubar'])){ $mname = "dropdown-menu"; } else { $mname = "smalldevice_dropmenu"; }
			
				if ( ( $depth == 0 || $depth == 1 ) ) { //really, level-1 or level-2, because $depth is misleading here (see note above) 
					$output .= "\n{$tabs}<ul class=\"".$mname."\">\n"; 
				} else { 
					$output .= "\n{$tabs}<ul>\n"; 
				}
			 
            return;
        } 
         
        /* End of the <ul> 
         * 
         * Note on $depth: Counterintuitively, $depth here means the "depth right before we start this menu".  
         *                   So basically add one to what you'd expect it to be 
         */         
        function end_lvl(&$output, $depth = 0, $args = array())  
        {
		
            if ($depth == 0) { // This is actually the end of the level-1 submenu ($depth is misleading here too!) 
                 
                // we don't have anything special for Bootstrap, so we'll just leave an HTML comment for now 
                $output .= '<!--.dropdown-->'; 
            } 
            $tabs = str_repeat("\t", $depth); 
            $output .= "\n{$tabs}</ul ><!--endchild-->\n";  // // KEEP THIS SPACE AFTER UL!!!! 
            return; 
        }
                 
        /* Output the <li> and the containing <a> 
         * Note: $depth is "correct" at this level 
         */         
        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)  
        {    
            global $wp_query;
			 
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : ''; 
            $class_names = $value = ''; 
            $classes = empty( $item->classes ) ? array() : (array) $item->classes; 

            /* If this item has a dropdown menu, add the 'dropdown' class for Bootstrap */ 
			
            if ($item->hasChildren) { 
                $classes[] = 'dropdown'; 
                // level-1 menus also need the 'dropdown-submenu' class 
                if($depth == 1) { 
                    $classes[] = 'dropdown-submenu'; 
                } 
            }else{			
			$classes[] = ''; 
			}			

            /* This is the stock Wordpress code that builds the <li> with all of its attributes */ 
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ); 
            $class_names = ' class="' . esc_attr( $class_names ) . '"'; 
            $output .= $indent . '<li ' . $value . $class_names .'>';  //id="menu-item-'. $item->ID . '"    
			         
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : ''; 
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : ''; 
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : ''; 
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
			
			
			// DESCRIPTION USED FOR DISPLAY
			$description = "";
		 	//if(isset($item->description) && strpos($item->description,"fa-") === false){
			//$description = '<span class="desc">'.  esc_attr( $item->description ) .'</span>';
			//}
			 
			
			$icon = "";
			//if(isset($item->description) && strpos($item->description,"fa-") !== false){
			//$icon = "<i class='".$item->description."'></i> ";
			//}
			 
			
            $item_output = $args->before; 
			 
			
                    
            /* If this item has a dropdown menu, make clicking on this link toggle it */ 
            if ($item->hasChildren && $depth == 0 && !isset($GLOBALS['flasg_smalldevicemenubar']) ) { 
                $item_output .= '<a '. $attributes .' class="dropdown-toggle txt" data-hover="dropdown" data-delay="500" data-close-others="false">';	 //  data-toggle="dropdown"			
				 
            } else { 
                $item_output .= '<a'. $attributes .' class="txt">'.$icon; 
            }
	  		$iconpack = false;	
			
			// ADD ON CATEGORY ICON
			 
			$item_output .= $args->link_before . apply_filters( 'the_title', "<span>".__( $item->title , 'premiumpress' )."</span>", $item->ID ) . $args->link_after; 
			 
		 
            /* Output the actual caret for the user to click on to toggle the menu */             
            if ($item->hasChildren && $depth == 0) { 
				 
				$item_output .= $description. ' </a>';  //<b class="caret"></b> 				 
                
            } else { 
                $item_output .= $description. '</a>'; 
            } 

            $item_output .= $args->after; 
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ); 
            return; 
        }
        
        /* Close the <li> 
         * Note: the <a> is already closed 
         * Note 2: $depth is "correct" at this level 
         */         
        function end_el (&$output, $item, $depth  = 0, $args = array() )
        {
            $output .= '</li>'; 
            return;
        } 
         
        /* Add a 'hasChildren' property to the item 
         * Code from: http://wordpress.org/support/topic/how-do-i-know-if-a-menu-item-has-children-or-is-a-leaf#post-3139633  
         */ 
        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args = array(), &$output) 
        { 
            // check whether this item has children, and set $item->hasChildren accordingly 
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]); 

            // continue with normal behavior 
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output); 
        }         
}

/* =============================================================================
  [FRAMEWORK] BOOTSTRAP MENU WALKER FOR WORDPRESS
   ========================================================================== */
class Bootstrap_Walker extends Walker_Nav_Menu {     
     
        /* Start of the <ul> 
         * 
         * Note on $depth: Counterintuitively, $depth here means the "depth right before we start this menu".  
         *                   So basically add one to what you'd expect it to be 
         */         
        function start_lvl(&$output, $depth = 0, $args = array()) 
        {
		
            $tabs = str_repeat("\t", $depth); 
            // If we are about to start the first submenu, we need to give it a dropdown-menu class 
			if(!isset($GLOBALS['flasg_smalldevicemenubar'])){ $mname = "dropdown-menu"; } else { $mname = "smalldevice_dropmenu"; }
			
				if ( ( $depth == 0 || $depth == 1 ) ) { //really, level-1 or level-2, because $depth is misleading here (see note above) 
					$output .= "\n{$tabs}<ul class=\"".$mname."\">\n"; 
				} else { 
					$output .= "\n{$tabs}<ul>\n"; 
				}
			 
            return;
        } 
         
        /* End of the <ul> 
         * 
         * Note on $depth: Counterintuitively, $depth here means the "depth right before we start this menu".  
         *                   So basically add one to what you'd expect it to be 
         */         
        function end_lvl(&$output, $depth = 0, $args = array())  
        {
		
            if ($depth == 0) { // This is actually the end of the level-1 submenu ($depth is misleading here too!) 
                 
                // we don't have anything special for Bootstrap, so we'll just leave an HTML comment for now 
                $output .= '<!--.dropdown-->'; 
            } 
            $tabs = str_repeat("\t", $depth); 
            $output .= "\n{$tabs}</ul ><!--endchild-->\n"; // KEEP THIS SPACE AFTER UL!!!! 
            return; 
        }
                 
        /* Output the <li> and the containing <a> 
         * Note: $depth is "correct" at this level 
         */         
        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)  
        {    
            global $wp_query;
			 
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : ''; 
            $class_names = $value = ''; 
            $classes = empty( $item->classes ) ? array() : (array) $item->classes; 

            /* If this item has a dropdown menu, add the 'dropdown' class for Bootstrap */ 
			
            if ($item->hasChildren) { 
                $classes[] = 'dropdown'; 
                // level-1 menus also need the 'dropdown-submenu' class 
                if($depth == 1) { 
                    $classes[] = 'dropdown-submenu'; 
                } 
            }else{
			
			$classes[] = ''; 
			}
			

            /* This is the stock Wordpress code that builds the <li> with all of its attributes */ 
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ); 
            $class_names = ' class="' . esc_attr( $class_names ) . '"'; 
            $output .= $indent . '<li ' . $value . $class_names .'>';  //id="menu-item-'. $item->ID . '"    
			         
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : ''; 
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : ''; 
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : ''; 
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
			
			
			// DESCRIPTION USED FOR DISPLAY
			$description = "";
		 	//if(isset($item->description) && strpos($item->description,"fa-") === false){
			//$description = '<span class="desc">'.  esc_attr( $item->description ) .'</span>';
			//}
			 
			
			$icon = "";
			//if(isset($item->description) && strpos($item->description,"fa-") !== false){
			//$icon = "<i class='".$item->description."'></i> ";
			//}
			 
			
            $item_output = $args->before; 
			 
			
                    
            /* If this item has a dropdown menu, make clicking on this link toggle it */ 
            if ($item->hasChildren && $depth == 0 && !isset($GLOBALS['flasg_smalldevicemenubar']) ) { 
                $item_output .= '<a '. $attributes .' class="dropdown-toggle txt" data-hover="dropdown" data-delay="500" data-close-others="false">';	 //  data-toggle="dropdown"			
				 
            } else { 
                $item_output .= '<a'. $attributes .' class="txt">'.$icon; 
            }
	  		$iconpack = false;	
			
			// ADD ON CATEGORY ICON
			 
			$item_output .= $args->link_before . apply_filters( 'the_title', "<span>".__( $item->title , 'premiumpress' )."</span>", $item->ID ) . $args->link_after; 
			 
		 
            /* Output the actual caret for the user to click on to toggle the menu */             
            if ($item->hasChildren && $depth == 0) { 
				 
				$item_output .= $description. ' </a>';  //<b class="caret"></b> 				 
                
            } else { 
                $item_output .= $description. '</a>'; 
            } 

            $item_output .= $args->after; 
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ); 
            return; 
        }
        
        /* Close the <li> 
         * Note: the <a> is already closed 
         * Note 2: $depth is "correct" at this level 
         */         
        function end_el (&$output, $item, $depth  = 0, $args = array() )
        {
            $output .= '</li>'; 
            return;
        } 
         
        /* Add a 'hasChildren' property to the item 
         * Code from: http://wordpress.org/support/topic/how-do-i-know-if-a-menu-item-has-children-or-is-a-leaf#post-3139633  
         */ 
        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args = array(), &$output) 
        { 
            // check whether this item has children, and set $item->hasChildren accordingly 
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]); 

            // continue with normal behavior 
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output); 
        }         
}


/* =============================================================================
  [FRAMEWORK] BOOTSTRAP MENU WALKER FOR WORDPRESS
   ========================================================================== */
 
class Bootstrap_Walker_Mobile extends Walker_Nav_Menu {     
     
        /* Start of the <ul> 
         * 
         * Note on $depth: Counterintuitively, $depth here means the "depth right before we start this menu".  
         *                   So basically add one to what you'd expect it to be 
         */         
        function start_lvl(&$output, $depth = 0, $args = array()) 
        {
		
            $tabs = str_repeat("\t", $depth); 
            // If we are about to start the first submenu, we need to give it a dropdown-menu class 
		 
				if ( ( $depth == 0 || $depth == 1 ) ) { //really, level-1 or level-2, because $depth is misleading here (see note above) 
					$output .= "\n{$tabs}<ul>\n"; 
				} else { 
					$output .= "\n{$tabs}<ul >\n"; 
				}
			 
            return;
        } 
         
        /* End of the <ul> 
         * 
         * Note on $depth: Counterintuitively, $depth here means the "depth right before we start this menu".  
         *                   So basically add one to what you'd expect it to be 
         */         
        function end_lvl(&$output, $depth = 0, $args = array())  
        {
		
            if ($depth == 0) { // This is actually the end of the level-1 submenu ($depth is misleading here too!) 
                 
                // we don't have anything special for Bootstrap, so we'll just leave an HTML comment for now 
                $output .= '<!--.dropdown-->'; 
            } 
            $tabs = str_repeat("\t", $depth); 
            $output .= "\n{$tabs}</ul ><!--endchild-->\n"; // KEEP THIS SPACE AFTER UL!!!! 
            return; 
        }
                 
        /* Output the <li> and the containing <a> 
         * Note: $depth is "correct" at this level 
         */         
        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)  
        {    
            global $wp_query;
			 
            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : ''; 
            $class_names = $value = ''; 
            $classes = empty( $item->classes ) ? array() : (array) $item->classes; 

            /* If this item has a dropdown menu, add the 'dropdown' class for Bootstrap */ 
			
            if ($item->hasChildren) { 
                $classes[] = 'dropdown'; 
                // level-1 menus also need the 'dropdown-submenu' class 
                if($depth == 1) { 
                    $classes[] = 'dropdown-submenu'; 
                } 
            }else{
			
			$classes[] = ''; 
			}
			

            /* This is the stock Wordpress code that builds the <li> with all of its attributes */ 
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ); 
            $class_names = ' class="' . esc_attr( $class_names ) . '"'; 
            $output .= $indent . '<div ' . $value . $class_names .'>';  //id="menu-item-'. $item->ID . '"    
			         
            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : ''; 
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : ''; 
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : ''; 
            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : ''; 
			
			
			// DESCRIPTION USED FOR DISPLAY
			$description = "";
 			
			$icon = "";
	 			
            $item_output = $args->before; 
                    
            /* If this item has a dropdown menu, make clicking on this link toggle it */ 
            if ($item->hasChildren && $depth == 0 && !isset($GLOBALS['flasg_smalldevicemenubar']) ) { 
                $item_output .= '<a '. $attributes .'>';	 //  data-toggle="dropdown"			
				 
            } else { 
                $item_output .= '<a'. $attributes .' class="txt"><em><i class="fa fa-angle-right"></i> '.$icon; 
            }
	  		$iconpack = false;	
			
			// ADD ON CATEGORY ICON
			 
			$item_output .= $args->link_before . apply_filters( 'the_title', "".$item->title."", $item->ID ) . $args->link_after; 
			 
		 
            /* Output the actual caret for the user to click on to toggle the menu */             
            if ($item->hasChildren && $depth == 0) { 
				 
				$item_output .= $description. ' </a>';  //<b class="caret"></b> 				 
                
            } else { 
                $item_output .= $description. '</em></a>'; 
            } 

            $item_output .= $args->after; 
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args ); 
            return; 
        }
        
        /* Close the <li> 
         * Note: the <a> is already closed 
         * Note 2: $depth is "correct" at this level 
         */         
        function end_el (&$output, $item, $depth  = 0, $args = array() )
        {
            $output .= '</div>'; 
            return;
        } 
         
        /* Add a 'hasChildren' property to the item 
         * Code from: http://wordpress.org/support/topic/how-do-i-know-if-a-menu-item-has-children-or-is-a-leaf#post-3139633  
         */ 
        function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args = array(), &$output) 
        { 
            // check whether this item has children, and set $item->hasChildren accordingly 
            $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]); 

            // continue with normal behavior 
            return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output); 
        }         
}
/* =============================================================================
	  WIDGET CLASS FOR SELECTIVE WIDGET AREAS
	========================================================================== */
class wf_wn {
  static $debug_output = '';

  // add hooks and filters
  public static function init() {
    // admin area
    if (is_admin()) {
      // widget related hooks
      add_action('sidebar_admin_setup',    array('wf_wn', 'modify_controls'));
      add_action('in_widget_form',         array('wf_wn', 'form'), 10, 3);
      add_action('widgets_admin_page',     array('wf_wn', 'dialog_container'));
      add_filter('widget_update_callback', array('wf_wn', 'update'), 10, 3);
     
      // server-side AJAX callback
      add_action('wp_ajax_wf_wn_dialog', array('wn_ajax', 'dialog'));
  
    } else { // frontend
      add_filter('widget_display_callback', array('wf_wn', 'widget_display'), 10, 3);
      add_filter('wp_footer', array('wf_wn', 'footer_debug'));
    }
  } // init 
 

  // check if debugging is enabled
  public static function is_debug() {
    if (isset($_GET['wn-debug']) && current_user_can('manage_options')) {
      return true;
    } else {
      return false;
    }
  } // is_debug


  // display debug info in footer
  public static function footer_debug() {
    if (self::is_debug()) {
      echo '<div id="wn_debug" style="clear: both; font-family: monospace; padding: 10px; margin: 10px; border: 1px solid black; background-color: #F9F9F9; color: black;">';
      echo '<b>debug data</b><br />' . self::$debug_output . '</div>';
    }
  } // footer_debug


  // check if widget is enabled on the current page
  // main plugin function, only one used on frontend
  public static function widget_display($instance, $obj, $args) { global $wp_query;
    if (self::is_debug()) {
      self::$debug_output .= '<br />Widget: ' . $obj->name . ($instance['title']? ' (' . $instance['title'] . ')': '') . '; WN operator: ' . ($instance['wn_show']? $instance['wn_show']: 'off') . '<br />';
    }
	
if(!isset($instance['wn_active_hooks'])){ $instance['wn_active_hooks']=""; $instance['wn_show']=""; }

    parse_str($instance['wn_active_hooks'], $ac_hooks);
    $show = strtolower($instance['wn_show']);

    // is Ninja enabled for this widget?
    if (empty($ac_hooks) || empty($show) || !is_array($ac_hooks)) {
      if (self::is_debug()) {
        self::$debug_output .= 'Widget is <b>visible</b><br />';
      }
      return $instance;
    }
 

    foreach($ac_hooks as $condition => $params) {

      // remove 0 from params list
      if ($params[0] == '0') {
        // no aditional params for this conditional
        $params = null;
      } else {
        // explode string by "," so we can get an array of selected items (pages, posts, categories, ...)
        $params = explode(',', $params[0]);
      }
	  
	  	
	  
      if(sizeof($params) == 1) {
        $params = $params[0];
      }

      // if debugging is enabled log each conditional tag call
      if (self::is_debug()) {
        self::$debug_output .= '&nbsp;&nbsp;' . $condition;
        self::$debug_output .= '(' . (is_null($params)? '': print_r($params, true)) . ') == ';
        self::$debug_output .= (call_user_func($condition, $params)? 'true': 'false') . '<br />';
      }
 
      // OR condition
      if ($show == 'or') {
	  
        $show_it = false;
		
		
		// CUSTOM TAXONOMY FOR RESPONSIVE FRAMEWORK
		if($condition == "in_category"){   
		
			$ca = $wp_query->get_queried_object();
		  
			if(isset($ca->term_id) && ( $params == $ca->term_id || (is_array($params) && in_array($ca->term_id,$params)) )){
				$show_it = true;
				break;
			} 
		
		} 
		 
		if($condition == "is_wlt_home_page"){ // CUSOTOM ELEMENTS ADDED BY MARK
		
			if(isset($GLOBALS['flag-home'])){
				$show_it = true;
				break;
			}
			
		}elseif($condition == "is_callback_page"){ // CUSOTOM ELEMENTS ADDED BY MARK
		
			if(isset($GLOBALS['tpl-callback'])){
				$show_it = true;
				break;
			}
			
		}elseif($condition == "is_wlt_blog_page"){ // CUSOTOM ELEMENTS ADDED BY MARK
		
			if(isset($GLOBALS['flag-blog'])){
				$show_it = true;
				break;
			}
					 
        // show widget as soon as one criteria is met
        }elseif (call_user_func($condition, $params)) {		
		 
          $show_it = true;
          break;
        }
		
		
      } elseif ($show == 'and') { // AND condition
	  

        $show_it = true;
		
		// ADDED BY MARK TO STOP HOME PAGE SHOWING INAEGORY 
		if(isset($GLOBALS['flag-home']) && $condition == "in_category"){
		
		 $show_it = false; 
          break;

		} 
		
        // hide widget as soon as one criteria is not met
        if (!call_user_func($condition, $params)) {
          $show_it = false; 
          break;
        }
		//die($GLOBALS['premiumpress']['catID']);
		//die($show_it.print_r($params).$condition);
		
      } elseif ($show == 'not') { // NOT condition
        $show_it = true; 
		
		
        // hide widget as soon as one criteria is met
        if (call_user_func($condition, $params)) {
          $show_it = false;
          break;
        }
      } else { // should never happen but if it does show widget
        $show_it = true;
      }
    } // foreach hook

    if ($show_it) {
      if (self::is_debug()) {
        self::$debug_output .= 'Widget is <b>visible</b><br />';
      }
      return $instance;
    } else {
      if (self::is_debug()) {
        self::$debug_output .= 'Widget is <b>not visible</b><br />';
      }
      return false;
    }
  } // widget_display


  // modify widget controls; force min width to fit WN GUI
  public static function modify_controls() {
    global $wp_registered_widgets, $wp_registered_widget_controls;

    foreach ($wp_registered_widgets as $id => $widget) {
      // check if default widget width is bigger then our custom width
      if ($wp_registered_widget_controls[$id]['width'] < 400) {
        $wp_registered_widget_controls[$id]['width'] = 400;
      }
    } // foreach widget
  } // modify_controls


 // inject help content
  public static function admin_footer() {
  ?>
<div id="wn-help-container" style="display: none;">
  <div id="wn-help-options">
  <ul>
    <li>the widget will be shown on all pages</li>
    <li>logical "or" operator will show the widget if any tag returns <i>true</i></li>
    <li>logical "and" operator will show the widget only if all tags return <i>true</i></li>
    <li>last option, logical "not" displays the widget only if all tags return <i>false</i></li>
  </ul>
  </div>
  
  <div id="wn-help-is_wlt_listing_category">
  <p>Checks if the page being displayed is the search results page.</p>
  </div>

  <div id="wn-help-is_wlt_listing">
  <p>Checks if the page being displayed is a listing description page.</p>
  </div>
  
  <div id="wn-help-is_wlt_blog_page">
  <p>Checks if the page being displayed is the blog page template.</p>
  </div>
  
  <div id="wn-help-is_wlt_home_page">
  <p>Checks if the page being displayed is the home page.</p>
  </div>  
  
  <div id="wn-help-is_page">
  <p>Checks if the page being displayed is the one selected.</p>
  </div>    
  
     
</div>
  <?php
  } // admin_footer

  // generate Widget Ninja GUI
  public static function form($instance, $widget, $widget_option) {
    $active_hooks = array(); 
    $widget_id = $instance->id;
	
	if(!isset($widget_option['wn_show'])){ $widget_option['wn_show'] = ""; }
	if(!isset($widget_option['wn_active_hooks'])){ $widget_option['wn_active_hooks'] = ""; }
	 

    echo '<div class="widget-control-actions">
    <div class="alignright">
      <img alt="" title="" class="ajax-feedback " src="' . admin_url() .'images/wpspin_light.gif" style="visibility: hidden;">
      <input type="submit" value="' . 'Save' . '" class="button-primary widget-control-save" id="savewidget" name="savewidget">
    </div>
    <br class="clear">
    </div>';

    echo '<br /><p><b>Widget Display Options</b></p>';

    // WN status options
    $wn_status[] = array('val' => '',    'label' => 'Show Widget.');
    $wn_status[] = array('val' => 'or',  'label' => 'Show widget if ANY active conditional tag returns TRUE (logical OR)');
    $wn_status[] = array('val' => 'and', 'label' => 'Show widget if ALL active conditional tags return TRUE (logical AND)');
    $wn_status[] = array('val' => 'not', 'label' => 'Show widget if ALL active conditional tags return FALSE');

    echo '<select name="' . $instance->get_field_name('wn_show') . '" id="' . $instance->get_field_id('wn_show') . '" class="wn_status ' . $instance->get_field_id('wn_show') . '" style="font-size:16px; width:100%;">';
    wf_wn_common::create_select_options($wn_status, $widget_option['wn_show']);
    echo '</select>';
    echo ' <a href="#" wn-help="options" class="help" title="Click to show help"><img alt="Click to show help" title="Click to show help" src="' . get_bloginfo('template_url').'/framework/widgets/images/help.png" /></a>';

    // check if widget ninja is enabled for this widget
    if ($widget_option['wn_show'] != '') {
      $display = 'display: block;';
    } else {
      $display = 'display: none;';
    }
    // list available hook options
    echo '<div class="hook_options ' . $instance->get_field_id('wn_show') . '" style="' . $display . '">';

    // conditional tags, WP built-in and custom
    // $hooks[] = array('wnfn' => 'is_home:0', 'label' => 'is_home');
    //$hooks[] = array('wnfn' => 'is_front_page:0', 'label' => 'is_front_page');

    $hooks[] = array('wnfn' => 'is_wlt_home_page:0', 'label' => 'HOME PAGE', "helptext" => "is_wlt_home_page");
	$hooks[] = array('wnfn' => 'is_wlt_blog_page:0', 'label' => 'BLOG PAGE', "helptext" => "is_wlt_blog_page");
	$hooks[] = array('wnfn' => 'is_wlt_listing_category:0', 'label' => 'SEARCH RESULTS PAGE', "helptext" => "is_wlt_listing_category");
	$hooks[] = array('wnfn' => 'is_page:0', 'dialog' => 'pages', 'label' => 'IS PAGE', "helpertext" => "is_page");
	$hooks[] = array('wnfn' => 'is_wlt_listing:0', 'label' => 'LISTING PAGE', "helptext" => "is_wlt_listing");
	
	
	
 	
	//$hooks[] = array('wnfn' => 'is_category:0', 'dialog' => 'categories', 'label' => 'is_category');
    $hooks[] = array('wnfn' => 'in_category:0', 'dialog' => 'categories',  'label' => 'in_category');

    //$hooks[] = array('wnfn' => 'is_tag:0', 'dialog' => 'tags', 'label' => 'is_tag');
    //$hooks[] = array('wnfn' => 'has_tag:0', 'dialog' => 'tags', 'label' => 'has_tag');

    
    $hooks[] = array('wnfn' => 'is_single:0', 'dialog' => 'posts',  'label' => 'IS BLOG POST');
    $hooks[] = array('wnfn' => 'is_singular:0', 'label' => 'IS POST_TYPE', 'dialog' => 'post_types');
    //$hooks[] = array('wnfn' => 'is_sticky:0', 'label' => 'is_sticky');
    $hooks[] = array('wnfn' => 'is_author:0', 'dialog' => 'authors',  'label' => 'IS AUTHOR');

    $hooks[] = array('wnfn' => 'is_404:0', 'label' => '404 PAGE');
    $hooks[] = array('wnfn' => 'is_search:0', 'label' => 'is_search');
    $hooks[] = array('wnfn' => 'is_archive:0', 'label' => 'is_archive');
    //$hooks[] = array('wnfn' => 'is_preview:0', 'label' => 'is_preview');
    // works only on WP >= v3.1
     

    $hooks[] = array('wnfn' => 'is_paged:0', 'label' => 'is_paged');
	
   
	//$hooks[] = array('wnfn' => 'is_callback_page:0', 'label' => 'CALLBACK PAGE');

    //$hooks[] = array('wnfn' => 'comments_open:0', 'label' => 'comments_open');
   //$hooks[] = array('wnfn' => 'has_excerpt:0', 'label' => 'has_excerpt');

    $hooks[] = array('wnfn' => 'wn_is_user_guest:0', 'label' => 'IS GUEST');
    $hooks[] = array('wnfn' => 'is_user_logged_in:0', 'label' => 'IS MEMBER');
    $hooks[] = array('wnfn' => 'current_user_can:manage_options', 'label' => 'IS ADMIN');

    // check which hooks are active
    parse_str($widget_option['wn_active_hooks'], $ac_hooks);

    // if there are any active hooks
    if (is_array($ac_hooks)) {
      // foreach available hook see if it's active
      $tmp_hooks = $hooks;
      foreach ($hooks as $hook_key => $hook_value){
        $clean_id = explode(':', $hook_value['wnfn']);

        if (isset($ac_hooks[$clean_id[0]]) && is_array($ac_hooks[$clean_id[0]])) { //??
          // check if our hook has any parameters defined
		  $hook_attachments = "";
		  if(isset($ac_hooks[$hook_value['label']])){
          $hook_attachments = $ac_hooks[$hook_value['label']];
		  }
          if (is_array($hook_attachments)) {
            $attachments = $hook_attachments[0];
            $hook_value['wnfn'] = $hook_value['label'] . ':' . $attachments;
          }
          // add used hooks to active array and remove them from available array
          $active_hooks[] = $hook_value;
          unset($tmp_hooks[$hook_key]);
        } // if (is_array($ac_hooks))
      } // foreach ($hooks)
      $hooks = $tmp_hooks;
    } // if (is_array($ac_hooks))

    // active hooks
    echo '<h4 class="wn-title"><span class="extra-vis active">Active</span> conditional tags</h4>';
    echo '<div class="wn-drag-description">Only active tags determine widget\'s visibility. Drag tags here to create complex conditional statements based on <a target="_blank" href="http://codex.wordpress.org/Conditional_Tags">conditional tags</a>.</div>';
    echo '<ul id="' . $instance->get_field_id('wn_active_hooks') . '" class="wn_Connected active_tags">';
    wf_wn_common::create_list($instance->get_field_id('wn_active_hooks'), $active_hooks, 'active', $widget_id);
    echo '</ul>';

    // available/unactive hooks
    echo '<h4 class="wn-title"><span class="extra-vis inactive">Inactive</span> conditional tags</h4>';
    echo '<div class="wn-drag-description">Drag tags you want to disable to this area.</div>';
    echo '<ul id="' . $instance->get_field_id('wn_available_hooks') . '" class="wn_Connected inactive_tags">';
    wf_wn_common::create_list($instance->get_field_id('wn_available_hooks'), $hooks, 'available', $widget_id);
    echo '</ul>';

    // hidden input field for remembering active conditions
    echo '<input type="hidden" name="' . $instance->get_field_name('wn_active_hooks') . '" id="' . $instance->get_field_id('wn_active_hooks') . '" class="serialized_tags" value="" />';
    echo '</div>';
    echo '<br class="clear" />';

    echo '<div id="wn-info-message"><p>Please remember to click <strong>Save</strong> after making any changes to widget\'s settings.</p></div>';
    echo '<br class="clear" />';
  } // form


  // update widget options
 public static  function update($instance, $new_instance, $old_instance) {
    $instance['wn_show'] = $new_instance['wn_show'];
    $instance['wn_active_hooks'] = $new_instance['wn_active_hooks'];

    return $instance;
  } // update


  // dialog box container
  public static function dialog_container() {
    echo '<div class="dialog_loading_container" style="display: none;">
           <div class="dialog_loading" id="loading">
            <img src="' . get_bloginfo('template_url').'/framework/widgets/images/loading.gif" alt="Loading dialog, please wait!" title="Loading dialog, please wait!" />
           </div>
          </div>';
    echo '<div class="dialog" id="dialog"></div>';
  } // dialog_container


  // CSS fixes for IE 7 and 8
  public static function admin_header() {
    echo '<!--[if IE 8]> ';
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_url').'/framework/widgets/css/wn-ie8.css" />';
    echo " <![endif]-->\n";

    echo '<!--[if IE 7]> ';
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_url').'/framework/widgets/css/wn-ie7.css" />';
    echo ' <![endif]-->';
  } // admin_header
 
} // class wf_wn

class wf_wn_common extends wf_wn {
  // helper function for creating select's options
  public static function create_select_options($options, $selected = null, $output = true) {
    $out = "\n";

    foreach ($options as $tmp) {
      if ($selected == $tmp['val']) {
        $out .= "<option selected=\"selected\" value=\"{$tmp['val']}\">{$tmp['label']}&nbsp;</option>\n";
      } else {
        $out .= "<option value=\"{$tmp['val']}\">{$tmp['label']}&nbsp;</option>\n";
      }
    }

    if($output) {
      echo $out;
    } else {
      return $out;
    }
  } // create_select_options

  // helper function for $_POST checkbox handling
  function check_var_isset(&$values, $variables) {
    foreach ($variables as $key => $value) {
      if (!isset($values[$key])) {
        $values[$key] = $value;
      }
    }
  } // check_var_isset

  // helper function for displaying LI elements
  public static function create_list($list_id, $options, $class, $widget_id, $output = true) {
    $out = "\n";

    if (is_array($options)) {
      foreach ($options as $sub_array) {
	  
	  	if(!isset($sub_array['helptext'])){ $sub_array['helptext'] = ""; }
        if (is_array($sub_array) && trim($sub_array['label'])) {
          $out .= '<li wnfn="' . $sub_array['wnfn'] . '" id="wn_' . $widget_id . '_' . $sub_array['label'] . '" class="' . $class . '">' . $sub_array['label'] . "\n";
          if (isset($sub_array['dialog'])) {
            $out .= '<a href="#" class="promptID" id="' . $sub_array['dialog'] . '"><img title="Options" alt="Options" src="' . get_bloginfo('template_url').'/framework/widgets/images/attach.gif" /></a>';
          }
          $out .= '<a wn-help="' . $sub_array['helptext'] . '" href="#" class="help" title="Click to show help"><img alt="Click to show help" title="Click to show help" src="' . get_bloginfo('template_url').'/framework/widgets/images/help.png" /></a>';
          $out .= '</li>';
        }
      }
    }

    if ($output) {
      echo $out;
    } else {
      return $out;
    }
  } // create_list
} // class wf_wn_common

class wn_ajax extends wf_wn {
  // create dialog content
  function dialog() {
    if (!$_POST || !isset($_POST['params'])) {
      die('Bad request.');
    }

    // prevent browsers from caching the request
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

    // Fetch posted params
    $conditional = explode(':', @$_POST['params']);
    $dialog_name = @$_POST['dialog_name'];
    $selected = explode(',', $conditional[1]);

    call_user_func(array('wn_ajax', $dialog_name), $selected);

    // WP bug workaround
    die();
  } // dialog

  // Function for marking selected items
  function is_selected($item, $haystack) {
    // If item is in array then it's selected
    if (is_array($haystack)) {
      if (in_array($item, $haystack)) {
        // Item is selected
        $selected['class'] = 'wn-selected';
        return $selected;
      } else {
        // Item isn't selected
        return '';
      }
    }
  } // function is_selected

  // list categories
  function categories($params) {
      // Set categories arguments
      $categories_args = array('hide_empty' => '0', 'taxonomy' => THEME_TAXONOMY);
      $out .= '<ul id="wn_selectable_categories" title="Select categories you want to attach">';

      // Get categories from table
      $categories = get_categories($categories_args);

      if ($categories) {
        foreach ($categories as $category) {
          $selected = self::is_selected($category->cat_ID, $params);
		  if(!isset($selected['class'])){ $selected['class'] =""; }
          $out .= '<li class="' . $selected['class'] . '">';
          $out .= '<a href="#" id="' . $category->cat_ID . '">' . $category->cat_name . '</a>' . $selected['img'];
          $out .= '</li>';
         } // end foreach $categories
      } else {
          $out .= '<li>';
          $out .= 'Sorry there are no categories available!';
          $out .= '</li>';
      }

      $out .= '</ul>';
      echo $out;

  } // categories

  // list tags
  function tags($params) {
    $out .= '<ul id="wn_selectable_tag" title="Select tags you want to attach">';

    // Fetch all tags
    $tags = get_tags(array('hide_empty'=>'0'));

    if ($tags) {
      foreach ($tags as $tag ) {
        $selected = self::is_selected($tag->slug, $params);
        $out .= '<li class="' . $selected['class'] . '">';
        $out .= '<a href="#" id="' . $tag->slug . '">' . $tag->name . '</a>' . $selected['img'];
        $out .= '</li>';
      }
    } else {
      $out .= '<li>';
      $out .= 'Sorry there are no tags available!';
      $out .= '</li>';
    }

    $out .= '</ul>';
    echo $out;
  } // tags

  // list pages
  function pages($params) {
    $out .= '<ul id="wn_selectable_pages" title="Select pages you want to attach">';
    // Fetch all pages
    $pages = get_pages();

    if ($pages) {
      foreach ($pages as $page) {
        $selected = self::is_selected($page->ID, $params);
		if(!isset($selected['class'])){ $selected['class'] = ""; }
        $out .= '<li class="' . $selected['class'] . '">';
        $out .= '<a href="#" id="' . $page->ID . '">' . $page->post_title . '</a>' . $selected['img'];
        $out .= '</li>';
      }
    } else {
      $out .= '<li>';
      $out .= 'Sorry there are no pages available!';
      $out .= '</li>';
    }

    $out .= '</ul>';
    echo $out;
  } // pages

  // list posts
  function posts($params) {
    $out .= '<ul id="wn_selectable_posts" title="Select posts you want to attach">';

    // Fetch all posts
    $posts = get_posts();

    if ($posts) {
      foreach ($posts as $post) {
        $selected = self::is_selected($post->ID, $params);
		if(!isset($selected['class'])){ $selected['class'] = ""; }
        $out .= '<li class="' . $selected['class'] . '">';
        $out .= '<a href="#" id="' . $post->ID . '">' . $post->post_title . '</a>' . $selected['img'];
        $out .= '</li>';
      }
    } else {
      $out .= '<li>';
      $out .= 'Sorry there are no posts available!';
      $out .= '</li>';
    }

    $out .= '</ul>';
    echo $out;
  } // list_posts

  // list authors
  function authors($params) {
    global $wpdb;
    $out .= '<ul id="wn_selectable_authors" title="Select authors you want to attach">';

    // Fetch all authors
    $args = array('echo' => '0', 'exclude_admin' => false, 'style'=>'none');
    $authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");

    if ($authors) {
      foreach ($authors as $author) {
        $selected = self::is_selected($author->ID, $params);
		if(!isset($selected['class'])){ $selected['class'] = ""; }
        $out .= '<li class="' . $selected['class'] . '">';
        $out .= '<a href="#" id="' . $author->ID . '">' . $author->user_nicename . '</a>' . $selected['img'];
        $out .= '</li>';
      }
    } else {
      $out .= '<li>';
      $out .= 'Sorry there are no authors available!';
      $out .= '</li>';
      }

    $out .= '</ul>';
    echo $out;
  } // list_authors

  // list post types
  function post_types($params) {
    $out .= '<ul id="wn_selectable_post_types" title="Select post types you want to attach">';

    // Fetch all post types
    $post_types = get_post_types('','objects');
    // Array of post types to exclude
    $exclude = array('nav_menu_item', 'revision');

    if ($post_types) {
      foreach ($post_types as $post_type) {
        $selected = self::is_selected($post_type->name, $params);
        if (!in_array($post_type->name, $exclude)) {
			if(!isset($selected['class'])){ $selected['class'] = ""; }
          $out .= '<li class="' . $selected['class'] . '">';
          $out .= '<a href="#" id="' . $post_type->name . '">' . $post_type->name . '</a>' . $selected['img'];
          $out .= '</li>';
        }
      }
    } else {
      $out .= '<li>';
      $out .= 'Sorry there are no post types available!';
      $out .= '</li>';
    }

    $out .= '</ul>';
    echo $out;
  } // pages

  // list page templates
  function page_templates($params) {
    $out .= '<ul id="wn_selectable_page_templates" title="Select page templates you want to attach">';

    // Fetch templates list
    $templates = get_page_templates();
    ksort($templates);

    if ($templates) {
      foreach ($templates as $template_name => $template_file) {
        $selected = self::is_selected($template_file, $params);
		if(!isset($selected['class'])){ $selected['class'] = ""; }
          $out .= '<li class="' . $selected['class'] . '">';
          $out .= '<a href="#" id="' . $template_file . '">' . $template_name . '</a>' . $selected['img'];
          $out .= '</li>';
      }
    }

    $out .= '</ul>';
    echo $out;
  } // page_templates
} // class wn_ajax

// checks if user is a guest; not logged in
// moved outside class so it's accessible to other plugins
function wn_is_user_guest() {
  if (is_user_logged_in()) {
    return false;
  } else {
    return true;
  }
} // wn_is_user_guest

function is_wlt_home_page(){ // CUSOTOM ELEMENTS ADDED BY MARK
		
	if(isset($GLOBALS['flag-home'])){
		return true;
	}
	return false;
}

function is_wlt_listing_category(){

	if(isset($GLOBALS['flag-search'])){
		return true;
	}
	return false;
}

function is_wlt_listing(){

	if(isset($GLOBALS['flag-single'])){
		return true;
	}
	return false;
}
function is_wlt_blog_page(){

	if(isset($GLOBALS['flag-blog'])){
		return true;
	}
	return false;
}

?>