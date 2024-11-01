<?php

/**
 * Retrieves post categories for use in Elementor addons if the function 'ut_elementor_addons_lite_get_post_categories' is not defined.
 * 
 * Fetches categories using get_terms() for the 'category' taxonomy, 
 * formats them into an associative array with category IDs as keys and names followed by counts as values, 
 * and returns the array of options.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_get_post_categories' ) ) {
    function ut_elementor_addons_lite_get_post_categories() {
        $options = array();
        $terms = get_terms( array( 
            'taxonomy'      => 'category',
            'hide_empty'    => true,
        ));
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $options[ $term->term_id ] = $term->name.' ('.$term->count.')';
            }
        }
        return $options;
    }
} 


/**
 * Retrieves public post types for use in Elementor addons.
 * 
 * Fetches post types that are public and shown in navigation menus, excluding specific types,
 * constructs an associative array with post type names as keys and labels as values,
 * then returns the array of post types.
 */
function ut_elementor_addons_lite_get_post_types() {
    $utal_cpts = get_post_types( array( 'public'   => true, 'show_in_nav_menus' => true ), 'object' );
    $utal_exclude_cpts = array( 'elementor_library', 'attachment' );
    foreach ( $utal_exclude_cpts as $exclude_cpt ) {
        unset($utal_cpts[$exclude_cpt]);
    }
    $post_types = array_merge($utal_cpts);
    foreach( $post_types as $type ) {
        $types[ $type->name ] = $type->label;
    }
    return $types;
}


/**
 * Retrieves post orderby options for use in Elementor addons.
 * 
 * Constructs an associative array with various orderby options 
 * and their corresponding human-readable labels, then returns the array.
 */
function ut_elementor_addons_lite_get_post_orderby() {
    $orderby = array(
        'ID'            => esc_html( 'Post ID','ut-elementor-addons-lite' ),
        'author'        => esc_html( 'Post Author','ut-elementor-addons-lite' ),
        'title'         => esc_html( 'Title','ut-elementor-addons-lite' ),
        'date'          => esc_html( 'Date','ut-elementor-addons-lite' ),
        'modified'      => esc_html( 'Last Modified Date','ut-elementor-addons-lite' ),
        'parent'        => esc_html( 'Parent Id','ut-elementor-addons-lite' ),
        'rand'          => esc_html( 'Random','ut-elementor-addons-lite' ),
        'comment_count' => esc_html( 'Comment Count','ut-elementor-addons-lite' ),
        'menu_order'    => esc_html( 'Menu Order','ut-elementor-addons-lite' ),
    );
    return $orderby;
}


/**
 * Retrieves authors for use in Elementor addons if the function 'ut_elementor_addons_lite_get_authors' is not defined.
 * 
 * This function fetches users using get_users(), formats them into an associative array 
 * with user IDs as keys and display names as values, and returns the array of options.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_get_authors' ) ) {
    function ut_elementor_addons_lite_get_authors() {
        $options = array();
        $users = get_users();
        foreach ( $users as $user ) {
            $options[ $user->ID ] = $user->display_name;
        }
        return $options;
    }
}


/**
 * Retrieves tags for use in Elementor addons if the function 'ut_elementor_addons_lite_get_tags' is not defined.
 * 
 * This function fetches tags using get_tags(), formats them into an associative array 
 * with tag IDs as keys and names followed by counts as values, and returns the array of options.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_get_tags' ) ) {
    function ut_elementor_addons_lite_get_tags() {
        $options = array();
        $tags = get_tags();
        foreach ( $tags as $tag ) {
            $options[ $tag->term_id ] = $tag->name.' ('.$tag->count.')';
        }
        return $options;
    }
}


/**
 * Retrieves posts for use in Elementor addons if the function 'ut_elementor_addons_lite_get_posts' is not defined.
 * 
 * This function fetches posts using get_posts() for the 'post' post type, 
 * formats them into an associative array with post IDs as keys and titles as values, 
 * and returns the array of options.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_get_posts' ) ) {
    function ut_elementor_addons_lite_get_posts() {
        $post_list = get_posts( array(
            'post_type'         => 'post',
            'orderby'           => 'date',
            'order'             => 'DESC',
            'posts_per_page'    => -1,
        ) );
        $posts = array();
        if ( ! empty( $post_list ) && ! is_wp_error( $post_list ) ) {
            foreach ( $post_list as $post ) {
             $posts[ $post->ID ] = $post->post_title;
         }
     }
     return $posts;
 }
}


if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

/**
 * Retrieves products for use in Elementor addons if the function 'ut_elementor_addons_lite_get_products' is not defined.
 * 
 * This function fetches products using get_posts() for the 'product' post type, 
 * formats them into an associative array with post IDs as keys and titles as values, 
 * and returns the array of options.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_get_products' ) ) {
    function ut_elementor_addons_lite_get_products() {
        $post_list = get_posts( array(
            'post_type'         => 'product',
            'orderby'           => 'date',
            'order'             => 'DESC',
            'posts_per_page'    => -1,
        ) );
        $posts = array();
        if ( ! empty( $post_list ) && ! is_wp_error( $post_list ) ) {
            foreach ( $post_list as $post ) {
             $posts[ $post->ID ] = $post->post_title;
         }
     }
     return $posts;
 }
}

/**
 * Retrieves product categories for use in Elementor addons if the function 'ut_elementor_addons_lite_get_product_categories' is not defined.
 * 
 * This function fetches product categories using get_terms() for the 'product_cat' taxonomy, 
 * formats them into an associative array with category IDs as keys and names followed by counts as values, 
 * and returns the array of options.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_get_product_categories' ) ) {
    function ut_elementor_addons_lite_get_product_categories() {
        $options = array();
        $terms = get_terms( array( 
            'taxonomy'      => 'product_cat',
            'hide_empty'    => true,
        ));
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $options[ $term->term_id ] = $term->name.' ('.$term->count.')';
            }
        }
        return $options;
    }
}

/**
 * Retrieves product tags for use in Elementor addons if the function 'ut_elementor_addons_lite_product_get_tags' is not defined.
 * 
 * This function fetches product tags using get_terms() for the 'product_tag' taxonomy, 
 * formats them into an associative array with tag IDs as keys and names followed by counts as values, 
 * and returns the array of options.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_product_get_tags' ) ) {
    function ut_elementor_addons_lite_product_get_tags() {
        $options = array();
        $tags = get_terms( 'product_tag' );
        if ( ! empty( $tags ) && ! is_wp_error( $tags ) ){
            foreach ( $tags as $tag ) {
                $options[ $tag->term_id ] = $tag->name.' ('.$tag->count.')';
            }
        }
        return $options;
    }
}

}


/**
 * Generates a custom query arguments array for Elementor addons if the function 'ut_elementor_addons_lite_query' is not defined.
 * 
 * This function constructs an array of query arguments based on the provided settings and parameters,
 * including post type, categories, tags, authors, order, offset, and posts per page. It then returns
 * the generated array of arguments for use in custom queries.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_query' ) ) {
    function ut_elementor_addons_lite_query($settings,$first_id='',$postsPerPage = 6, $offset= '' ){     
        $post_type      = 'post';
        $category       = '';
        $tags           = '';
        $exclude_posts  = '';
        $offset = empty($offset) ? $settings['offset'] : $offset ; 
        $category       = $settings['categories'];
        $tags           = $settings['tags'];
        $exclude_posts  = $settings['exclude_posts'];
        $orderby = isset($settings['orderby']) ? $settings['orderby'] : 'ID' ;
        $meta_key = '';
        $date = '';

        //Categories
        $post_cat = '';
        $post_cats = $category;
        if ( ! empty( $category) ) {
            asort($category);    
        }
        
        if ( !empty( $post_cats) ) {
            $post_cat = implode( ",", $post_cats );
        }
        
        if ( !empty($first_id)) {
            $post_cat = $first_id;
        }
        // Post Authors
        $post_author = '';
        $post_authors = isset( $settings['authors'] ) ? $settings['authors'] : '';
        if ( !empty( $post_authors) ) {
            $post_author = implode( ",", $post_authors );
        }
        $args = array(
            'post_status'           => array( 'publish' ),
            'post_type'             => $post_type,
            'post__in'              => '',
            'cat'                   => $post_cat,
            'author'                => $post_author,
            'tag__in'               => $tags,
            'orderby'               => $orderby,
            'order'                 => $settings['order'],
            'post__not_in'          => $exclude_posts,
            'offset'                => $offset,
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => $postsPerPage,
            'meta_key' => $meta_key,
            'date_query' => $date
        );

        return $args;

    }
}

/**
 * Limits the length of content and returns a truncated version if the function 'ut_elementor_addons_lite_letter_count' is not defined.
 * 
 * This function accepts content and a character limit as parameters. It strips HTML tags and shortcodes from the content,
 * truncates it to the specified character limit, and adds ellipsis if the content exceeds the limit. The truncated content
 * is wrapped in a <div> element with the class 'content-excerpt'.
 */
if( ! function_exists( 'ut_elementor_addons_lite_letter_count' ) ) {
    function ut_elementor_addons_lite_letter_count( $content, $limit ) {
        if( !empty($limit) && ($limit != 0) ){
            $striped_content = strip_tags( $content );
            $striped_content = strip_shortcodes( $striped_content );
            $limit_content = mb_substr( $striped_content, 0, $limit );

            if ( strlen( $limit_content ) < strlen( $content ) ) {
                $limit_content .= "...";
            }
            return '<div class="content-excerpt">'. $limit_content . '</div>';
        }
    }
}


/**
 * Outputs the formatted post categories if the function 'ut_elementor_addons_lite_post_categories' is not defined.
 * 
 * This function echoes the list of post categories separated by commas, wrapped in a <span> element with the class 'blog-category'.
 */
if ( ! function_exists('ut_elementor_addons_lite_post_categories') ) {
    function ut_elementor_addons_lite_post_categories( $args = array( 'id' => '', 'option' => true ) ) {
        echo '<span class="blog-category">' . wp_kses_post(get_the_category_list(', ')) . '</span>'; 
    }
}


/**
 * Outputs the formatted post author if the function 'ut_elementor_addons_lite_post_author' is not defined.
 * 
 * This function echoes the post author's name preceded by 'By', both wrapped in <span> elements with appropriate classes.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_post_author' ) ) {
    function ut_elementor_addons_lite_post_author( ) {
        echo '<span class="blog-author"><span class="blog-by">'. esc_html( 'By','ut-elementor-addons-lite' ) . '</span> ' . esc_html( get_the_author() ) . '</span>';
    }
}


/**
 * Outputs the formatted post date if the function 'ut_elementor_addons_lite_post_date' is not defined.
 * 
 * This function echoes the post date wrapped in a <span> element with the class 'blog-date'.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_post_date' ) ) {
    function ut_elementor_addons_lite_post_date( ) {
        echo '<span class="blog-date">' . esc_html( get_the_date( get_option( 'date_format' ) ) ) . '</span>';     
    }
}


/**
 * Retrieves the customizer logo URL for use in Elementor addons.
 * 
 * Fetches the custom logo ID set in the theme customizer, then retrieves
 * the URL of the corresponding image. If a custom logo is set, it returns
 * the image URL wrapped in an <img> tag; otherwise, it returns an empty string.
 */
function ut_elementor_addons_lite_get_cutomizer_logo(){
    $custom_logo_id_func = get_theme_mod( 'custom_logo' );
    $site_logo_img = wp_get_attachment_image_url( $custom_logo_id_func , 'full' );
    ob_start();
    ?>
    <?php if ( $custom_logo_id_func ) : ?>
        <img src="<?php echo esc_attr( $site_logo_img ); ?>" alt="custom_logo">
    <?php endif ?>
    <?php
    $site_logo_img_url = ob_get_clean();
    return $site_logo_img_url;
}


/**
 * Retrieves available navigation menus for use in Elementor addons.
 * 
 * Fetches all registered navigation menus using wp_get_nav_menus(),
 * then formats them into an associative array with each menu's slug
 * as the key and its name as the value. Sets the first menu as the default.
 */
function ut_elementor_addons_lite_navmenu_navbar_menu_select() {
    $menus_item = wp_get_nav_menus();
    $items = array();
    $i     = 0;
    foreach ( $menus_item as $menu_item ) {
        if ( $i == 0 ) {
            $default = $menu_item->slug;
            $i ++;
        }
        $items[ $menu_item->slug ] = $menu_item->name;
    }
    return $items;
}


/**
 * Retrieves available menus for use in Elementor addons.
 * 
 * Fetches all registered navigation menus using wp_get_nav_menus(),
 * then formats them into an associative array with each menu's slug
 * as the key and its name as the value.
 */
function ut_elementor_addons_lite_get_menus() {
    $menus = wp_get_nav_menus();
    $items = ['0' => esc_html__( 'Select Menu', 'ut-elementor-addons-lite' ) ];
    foreach ( $menus as $menu ) {
        $items[ $menu->slug ] = $menu->name;
    }
    return $items;
}


/**
 * Retrieves available Elementor templates for use in Elementor addons.
 * 
 * This function checks if the function 'ut_elementor_addons_lite_get_elementor_templates'
 * is not already defined. If not, it retrieves a list of Elementor templates
 * and returns them as an array of options, with each option containing the template ID and title.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_get_elementor_templates' ) ) {
    function ut_elementor_addons_lite_get_elementor_templates() {
        $args = [
            'post_type' => 'elementor_library',
        ];
        $page_templates = get_posts( $args );
        $options = array();
        if ( !empty( $page_templates ) && !is_wp_error( $page_templates ) ) {
            $options['0'] = esc_html__('Select Template','ut-elementor-addons-lite');
            foreach ( $page_templates as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        }
        return $options;
    }
}


/**
 * Retrieves available sidebar options for use in Elementor addons.
 * 
 * This function checks if the function 'ut_elementor_addons_lite_sidebar_options'
 * is not already defined. If not, it retrieves a list of registered sidebars
 * and returns them as an array of options, with each option containing the sidebar ID and name.
 */
if ( ! function_exists( 'ut_elementor_addons_lite_sidebar_options' ) ) {
    function ut_elementor_addons_lite_sidebar_options() {
        global $wp_registered_sidebars;
        $sidebar_options = [];
        if ( ! $wp_registered_sidebars ) {
            $sidebar_options['0'] = esc_html__( 'No sidebars were found', 'ut-elementor-addons-lite' );
        } else {
            $sidebar_options['0'] = esc_html__( 'Select Sidebar', 'ut-elementor-addons-lite' );
            foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
                $sidebar_options[ $sidebar_id ] = $sidebar['name'];
            }
        }
        return $sidebar_options;
    }
}


/**
 * Retrieves a list of TablePress tables for use in Elementor addons.
 * 
 * This function checks if the function 'ut_elementor_addons_lite_tablepress_table_list'
 * is not already defined. If not, it retrieves a list of TablePress tables and returns
 * them as an array of options, with each option containing the table ID and name.
 */
if ( ! function_exists('ut_elementor_addons_lite_tablepress_table_list') ) {
    function ut_elementor_addons_lite_tablepress_table_list() {
        $tablepress_option = array();
        if (class_exists('TablePress')) {
            $tablepress_id          = \TablePress::$model_table->load_all( false );
            $tablepress_option[0] = esc_html__( 'Select Table', 'ut-elementor-addons-lite' );
            foreach ( $tablepress_id as $table_id ) {
                $table = \TablePress::$model_table->load( $table_id, false, false );
                if ( '' === trim( $table['name'] ) ) {
                    $table['name'] = esc_html__( '(no name)', 'ut-elementor-addons-lite' );
                }
                $tablepress_option[$table['id']] = $table['name'];
            }
        } else {
            $tablepress_option[0] = esc_html__( 'Create a Table First', 'ut-elementor-addons-lite' );
        }
        return $tablepress_option;
    }
}


/**
 * Outputs the Calendly JavaScript script tag if the function 'ut_elementor_addons_lite_calendly' doesn't exist.
 * 
 * This function includes the Calendly JavaScript file if the function 'ut_elementor_addons_lite_calendly'
 * is not already defined. This helps prevent conflicts when the script is included multiple times.
 */
if ( ! function_exists( "ut_elementor_addons_lite_calendly" ) ) {
    function ut_elementor_addons_lite_calendly()
    {
        ?>
        <script src='<?php echo UTAL_JS_DIR; ?>/calendly.js'></script>
        <?php
    }
}


/**
 * Adds a custom column to the Elementor Library posts screen to display shortcode.
 * 
 * Hooks into the 'manage_elementor_library_posts_columns' filter to add a column named 'ut_elementor_library',
 * which shows the shortcode for each Elementor Library post.
 */
add_filter( 'manage_elementor_library_posts_columns', 'ut_set_custom_edit_elementor_library_columns' );
function ut_set_custom_edit_elementor_library_columns( $columns ) {
    $columns['ut_elementor_library'] = esc_html__( 'Shortcode', 'ut-elementor-addons-lite' );
    return $columns;
}


/**
 * Registers a shortcode called 'ut_elementor' and defines the corresponding shortcode function.
 * 
 * This shortcode function retrieves the ID attribute passed via the shortcode and 
 * uses Elementor's frontend API to fetch and display the content of the specified Elementor template.
 * 
 * @param array $atts An array of attributes passed to the shortcode.
 * @return void
 */
add_shortcode( 'ut_elementor', 'ut_elementor_shortcode_function' );
function ut_elementor_shortcode_function( $atts ) {
    $id = $atts['id'];
    if ( ! empty( $id ) ) {
        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( absint( $id ) );
    }
}


/**
 * Adds a custom column to the Elementor Library posts screen and displays the shortcode for each Elementor Library post.
 * 
 * @param string $column   The name of the column to display.
 * @param int    $post_id  The ID of the current Elementor Library post.
 * @return void
 */
add_action( 'manage_elementor_library_posts_custom_column' , 'ut_custom_elementor_library_column', 10, 2 );
function ut_custom_elementor_library_column( $column, $post_id ) {
    switch ( $column ) {
        case 'ut_elementor_library' :
        echo '<input type="text" class="widefat" onfocus="this.select()" value=\'[ut_elementor id="'.$post_id.'"]\' style="width:100%;" readonly>';
        break;
    }
}







