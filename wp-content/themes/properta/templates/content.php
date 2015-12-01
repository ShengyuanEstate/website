<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
			</a>
		</div><!-- /.entry-thumbnail -->
	<?php endif; ?>

	<header class="entry-header page-header">
		<?php if ( is_page() || is_single() ) : ?>
			<h1><?php the_title(); ?></h1>
            <?php if ( is_single() ) : ?>
                <span class="post-meta post-author">
                    <i class="fa fa-user"></i>
                    <?php the_author(); ?>
                </span>
                <span class="post-meta post-date">
                    <i class="fa fa-calendar"></i>
                    <?php echo get_the_date(); ?>
                </span><!-- /.post-date -->
                <span class="post-meta post-tags"><?php the_tags( '<i class="fa fa-tags"></i>', ', ' ) ?></span>
            <?php endif; ?>
		<?php else: ?>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <?php the_content( sprintf(
            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'properta' ), array( 'span' => array( 'class' => array() ) ) ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ) ); ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'properta' ),
			'after'  => '</div>',
		) ); ?>

        <?php if ( comments_open() || get_comments_number() ): ?>
            <?php comments_template( '', true ); ?>
        <?php endif; ?>

    </div><!-- .entry-content -->

</article><!-- #post-## -->
