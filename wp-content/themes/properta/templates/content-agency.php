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

        <div class="agency-content-wrapper">
            <div class="agency-header">
                <div class="agency-thumbnail">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                    <?php endif; ?>
                </div>

                <div class="agency-overview">
                    <?php $phone = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'phone', true ); ?>
                    <?php if ( ! empty( $phone ) ) : ?>
                        <div class="agency-phone">
                            <i class="fa fa-phone"></i>
                            <?php echo esc_attr( $phone ); ?>
                        </div><!-- /.agent-box-phone -->
                    <?php endif; ?>

                    <?php $email = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'email', true ); ?>
                    <?php if ( ! empty( $email ) ) : ?>
                        <div class="agency-email">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:<?php echo esc_attr( $email ); ?>">
                                <?php echo esc_attr( $email ); ?>
                            </a>
                        </div><!-- /.agent-box-email -->
                    <?php endif; ?>

                    <?php $web = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'web', true ); ?>
                    <?php if ( ! empty( $web ) ) : ?>
                        <div class="agency-web">
                            <i class="fa fa-globe"></i>
                            <a href="<?php echo esc_attr( $web ); ?>">
                                <?php echo esc_attr( $web ); ?>
                            </a>
                        </div><!-- /.agent-box-web -->
                    <?php endif; ?>

                    <?php $address = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'address', true ); ?>
                    <?php if ( ! empty( $address ) ) : ?>
                        <div class="agency-address">
                            <i class="fa fa-map-marker"></i>
                            <?php echo esc_attr( $address ); ?>
                        </div><!-- /.agent-box-web -->
                    <?php endif; ?>
                </div><!-- /.agency-overview -->
            </div><!-- /.agency-header -->

            <div class="agency-content">
                <?php the_content( sprintf( __( 'Continue reading %s', 'properta' ), the_title( '<span class="screen-reader-text">', '</span>', false ) ) ); ?>
            </div><!-- /.agency-content -->
        </div><!-- /.agency-content-wrapper -->

        <?php if ( is_single() ) : ?>
            <!-- Agency's location -->
            <?php $location = get_post_meta( get_the_ID(), REALIA_AGENCY_PREFIX . 'location', true ); ?>

            <?php if ( ! empty( $location ) && 2 == count( $location ) ) : ?>
                <hr>

                <!-- MAP -->
                <div class="map-position">
                    <div id="simple-map"
                         data-latitude="<?php echo esc_attr( $location['latitude'] ); ?>"
                         data-longitude="<?php echo esc_attr( $location['longitude'] ); ?>">
                    </div><!-- /#map-property -->
                </div><!-- /.map-property -->
            <?php endif; ?>

            <!-- Agency's agents -->
            <?php Realia_Query::loop_agency_agents(); ?>

            <?php if ( have_posts() ) : ?>
                <hr>

                <h3 class="agent-properties-title"><?php echo __('Assigned Agents', 'properta'); ?></h3>

                <div class="agency-agents type-box item-per-row-3">
	                <div class="agents-row">
		                <?php $index = 0; ?>
	                    <?php while ( have_posts() ) : the_post(); ?>
	                        <div class="agent-container">
		                        <?php include 'agents/box.php'; ?>
	                        </div>

			                <?php if ( 0 == ( ( $index + 1 ) % 3 ) && Realia_Query::loop_has_next() ) : ?>
		                        </div><div class="agents-row">
			                <?php endif; ?>

			                <?php $index++; ?>
	                    <?php endwhile; ?>
	                </div><!-- /.agents-row -->
                </div><!-- /.agency-agents -->
            <?php endif;?>

            <?php wp_reset_query(); ?>
        <?php endif; ?>

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
