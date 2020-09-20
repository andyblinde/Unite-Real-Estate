<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package unite
 */
?>
	<div id="secondary" class="widget-area col-sm-12 col-md-4" role="complementary">

        <?php do_action( 'before_sidebar' ); ?>

		<?php 
                
        if ( is_front_page() ) {
            dynamic_sidebar( 'sidebar-home-page' );            
            }

        else {
            dynamic_sidebar( 'sidebar-1' );
            }
        // end sidebar widget area ?>

	</div><!-- #secondary -->
