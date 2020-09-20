<?php

// Homepage Sidebar
function unite_new_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Homepage Sidebar', 'unite' ),
        'id'            => 'sidebar-home-page',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}

add_action( 'widgets_init', 'unite_new_widgets_init' );

// Filter scripts
function unite_filter_search_scripts() {
    wp_enqueue_script( 'unite_filter_search', get_stylesheet_directory_uri(). '/script.js', array(), '1.0', true );
}

// Shortcode: [unite_filter_search]
function unite_filter_search_shortcode() {

    unite_filter_search_scripts(); ?>
 
    <div id="unite-filter-search">
        <ul class="agencies-list">
            <li><a class="agencies-list_item active" id="all" href="#!" data-slug="">All Real Estate</a></li>      
                
                <?php
                $args= array (
                    'post_type'     => 'agency'
                );
                $agencies = new WP_Query($args);
                while($agencies->have_posts()) {
                    $agencies->the_post(); ?>

                    <li><a class="agencies-list_item" id="<?php echo get_the_ID(); ?>" href="#!" data-slug="<?= $agencies->slug; ?>"><?php the_title(); ?></a></li>                   
                                    
                <?php
                }
                wp_reset_query();
                ?>

        </ul>
    </div>
     
    <?php
}
 
add_shortcode ('unite_filter_search', 'unite_filter_search_shortcode');