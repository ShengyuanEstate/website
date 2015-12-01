<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<div class="row">
    <div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
        <?php dynamic_sidebar( 'sidebar-content-top' ); ?>

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1><?php echo single_cat_title(); ?></h1>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			</header><!-- .page-header -->


			<?php if ( get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) == '1' ) : ?>
				<div class="property-box-archive type-box item-per-row-3">
					<div class="properties-row">
			<?php endif; ?>

			<?php $index = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if ( get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) == '1' ) : ?>
					<div class="property-container">
						<?php echo Realia_Template_Loader::load( 'properties/box' ); ?>
					</div><!-- /.property-container -->

					<?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
						</div><div class="properties-row">
					<?php endif; ?>
				<?php else : ?>
					<?php echo Realia_Template_Loader::load( 'properties/row' ); ?>
				<?php endif; ?>
				<?php $index++; ?>
			<?php endwhile; ?>

			<?php if ( get_theme_mod( 'realia_general_show_property_archive_as_grid', null ) == '1' ) : ?>
					</div><!-- /.properties-row -->
				</div><!-- /.property-box-archive -->
			<?php endif; ?>

			<?php the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'properta' ),
				'next_text'          => __( 'Next page', 'properta' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'properta' ) . ' </span>',
			) ); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

        <?php dynamic_sidebar( 'sidebar-content-bottom' ); ?>
    </div><!-- /.content -->

    <?php get_sidebar(); ?>
</div><!-- /.row -->

<?php get_footer(); ?>
