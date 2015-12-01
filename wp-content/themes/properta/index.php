<?php get_header(); ?>

<div class="row">
    <div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php if ( get_post_type() == 'post' ) : ?>
                    <?php get_template_part( 'templates/content-post-row' ); ?>
                <?php else: ?>
                    <?php get_template_part( 'templates/content', get_post_format() ); ?>
                <?php endif; ?>
            <?php endwhile; ?>

            <?php the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'properta' ),
                'next_text'          => __( 'Next page', 'properta' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'properta' ) . ' </span>',
            ) ); ?>
        <?php else : ?>
            <?php get_template_part( 'templates/content', 'none' ); ?>
        <?php endif; ?>

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
    </div><!-- /.content -->

    <?php get_sidebar(); ?>
</div><!-- /.row -->

<?php get_footer(); ?>
