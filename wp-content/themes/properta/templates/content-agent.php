<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		endif;
		?>
    </header><!-- .entry-header -->

    <div class="entry-content">

        <div class="agent-block">
            <div class="agent-thumbnail">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'post-thumbnail' ); ?>
                <?php endif; ?>
            </div>

            <div class="agent-content">
                <?php the_content( sprintf( __( 'Continue reading %s', 'properta' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) ); ?>
            </div><!-- /.agent-content -->

            <div class="agent-overview">
                <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'phone', true ); ?>
                <?php if ( ! empty( $phone ) ) : ?>
                    <div class="agent-phone">
                        <i class="fa fa-phone"></i>
                        <?php echo esc_attr( $phone ); ?>
                    </div><!-- /.agent-box-phone -->
                <?php endif; ?>

                <?php $email = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'email', true ); ?>
                <?php if ( ! empty( $email ) ) : ?>
                    <div class="agent-email">
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>">
                            <?php echo esc_attr( $email ); ?>
                        </a>
                    </div><!-- /.agent-box-email -->
                <?php endif; ?>

                <?php $web = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'web', true ); ?>
                <?php if ( ! empty( $web ) ) : ?>
                    <div class="agent-web">
                        <i class="fa fa-globe"></i>
                        <a href="<?php echo esc_attr( $web ); ?>">
                            <?php echo esc_attr( $web ); ?>
                        </a>
                    </div><!-- /.agent-box-web -->
                <?php endif; ?>

                <?php $address = get_post_meta( get_the_ID(), REALIA_AGENT_PREFIX . 'address', true ); ?>
                <?php if ( ! empty( $address ) ) : ?>
                    <div class="agent-address">
                        <i class="fa fa-map-marker"></i>
                        <?php echo esc_attr( $address ); ?>
                    </div><!-- /.agent-box-web -->
                <?php endif; ?>
            </div><!-- /.agent-overview -->
        </div><!-- /.agent-content -->

        <?php if ( is_single() ) : ?>
            <?php Realia_Query::loop_agent_properties(); ?>

            <?php if ( have_posts() ) : ?>
                <hr>

                <h3 class="agent-properties-title"><?php echo __('Assigned Properties', 'properta'); ?></h3>

                <div class="agent-properties type-box item-per-row-3">
	                <div class="properties-row">
		                <?php $index = 0; ?>
	                    <?php while ( have_posts() ) : the_post(); ?>
	                        <div class="property-container">
	                            <?php include 'properties/box.php'; ?>
	                        </div><!-- /.property-container -->

					        <?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
						        </div><div class="properties-row">
					        <?php endif; ?>

					        <?php $index++; ?>
	                    <?php endwhile; ?>
	                </div><!-- /.properties-row -->
                </div><!-- /.agent-properties -->
            <?php endif;?>

            <?php wp_reset_query(); ?>
        <?php endif; ?>

        <?php include 'agents/contact-form.php'; ?>

        <?php wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'properta' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'properta' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) ); ?>

        <?php if ( comments_open() || get_comments_number() ) : ?>
            <div class="box"><?php comments_template( '', true ); ?></div>
        <?php endif; ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
