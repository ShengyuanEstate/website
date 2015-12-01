<?php get_header(); ?>

<div class="row">
	<div class="content <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>col-sm-8 col-md-9<?php else : ?>col-sm-12<?php endif; ?>">
		<?php dynamic_sidebar( 'sidebar-content-top' ); ?>

		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
			</header><!-- .page-header -->

			<?php
			/**
			 * realia_before_agent_archive
			 */
			do_action( 'realia_before_agent_archive' );
			?>



            <div class="agent-box-archive type-box item-per-row-3">
                <div class="agents-row ">

                <?php $index = 0; ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <div class="agent-container">
                        <?php echo Realia_Template_Loader::load( 'agents/box' ); ?>
                    </div><!-- /.agent-container -->

                    <?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
                        </div><div class="agents-row">
                    <?php endif; ?>

                    <?php $index++; ?>

                <?php endwhile; ?>

                </div><!-- /.agents-row -->
            </div><!-- /.agent-box-archive -->

			<?php
			/**
			 * realia_after_agent_archive
			 */
			do_action( 'realia_after_agent_archive' );
			?>

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
