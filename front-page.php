<?php

    if ( get_option( 'show_on_front' ) == 'posts' ) {
        get_template_part( 'index' );
    } elseif ( 'page' == get_option( 'show_on_front' ) ) {

 get_header(); ?>

	<div id="primary" class="content-area col-sm-12 col-md-8">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">

                        <div class="properties">
                        <?php

                        if ( false === ( $properties = get_transient( 'properties_cached_query' ) ) ) :
                        
                        $args= array (
                            'post_type'		=> 'real_estate'
                        );

                        $properties = new WP_Query($args);

                        set_transient( 'properties_cached_query', $properties, 60*60*12 );
                        
                        endif;

                        while($properties->have_posts()) {
                            $properties->the_post();

                            $agencies = get_field('agency');
                            if( $agencies ):
                                foreach( $agencies as $agency ):
                                endforeach;
                            endif; ?>

                            <div class="col-md-4 property-preview <?php if ( $agencies ) : echo $agency->ID; endif; ?>">
                            	
                                <a href="<?php echo the_permalink(); ?>">
                                <div class="property-image">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="" class="img-responsive">
                                </div>    
                                    <h4><?php the_title(); ?></h4>
                                </a>
                                <div class="real-estate-meta-fields">
                                    <?php if( get_field('area') ): ?>
                                    <p>Area: <?php the_field('area'); ?></p>
                                    <?php endif; ?>
                                    <?php if( get_field('cost_of') ): ?>
                                    <p>Cost of: <?php the_field('cost_of'); ?> Eur</p>
                                    <?php endif; ?>
                                    <?php if( get_field('address') ): ?>
                                    <p>Addres: <?php the_field('address'); ?></p>
                                    <?php endif; ?>
                                    <?php if( get_field('living_area') ): ?>
                                    <p>Living area: <?php the_field('living_area'); ?></p>
                                    <?php endif; ?>
                                    <?php if( get_field('floor') ): ?>
                                    <p>Floor: <?php the_field('floor'); ?></p>
                                    <?php endif; ?>
                                                                        
                                </div>							    	
                            </div>

                        <?php
                        }
                        wp_reset_query();
                        ?>
                        </div><!-- .properties -->

						<?php the_content(); ?>
						<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
					<?php edit_post_link( __( 'Edit', 'unite' ), '<footer class="entry-meta"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
				</article><!-- #post-## -->

					<div class="home-widget-area row">

						<div class="col-sm-6 col-md-4 home-widget">
							<?php if( is_active_sidebar('home1') ) dynamic_sidebar( 'home1' ); ?>
						</div>

						<div class="col-sm-6 col-md-4 home-widget">
							<?php if( is_active_sidebar('home2') ) dynamic_sidebar( 'home2' ); ?>
						</div>

						<div class="col-sm-6 col-md-4 home-widget">
							<?php if( is_active_sidebar('home3') ) dynamic_sidebar( 'home3' ); ?>
						</div>

					</div>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

    <?php
        get_sidebar();
    ?>

<?php
	get_footer();
}
?>