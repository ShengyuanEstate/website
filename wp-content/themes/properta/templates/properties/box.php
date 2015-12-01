<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>

<div class="property-box">
    <div class="property-box-image <?php if ( ! has_post_thumbnail() ) { echo 'without-image'; } ?>">
        <a href="<?php the_permalink(); ?>" class="property-box-image-inner <?php if ( ! empty( $agent ) ) : ?>has-agent<?php endif; ?>">
			<?php
	        /**
	         * realia_before_property_box_image
	         */
	        do_action( 'realia_before_property_box_image', get_the_ID() );
	        ?>

            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'property-box-thumbnail' ); ?>
            <?php endif; ?>

			<?php
	        /**
	         * realia_after_property_box_image
	         */
	        do_action( 'realia_after_property_box_image', get_the_ID() );
	        ?>

            <?php $is_featured = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'featured', true ); ?>
            <?php $is_reduced = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'reduced', true ); ?>

            <?php if ( $is_featured && $is_reduced ) : ?>
                <span class="property-badge"><?php echo __( 'Featured', 'properta' ); ?> / <?php echo __( 'Reduced', 'properta' ); ?></span>
            <?php elseif ( $is_featured ) : ?>
                <span class="property-badge"><?php echo __( 'Featured', 'properta' ); ?></span>
            <?php elseif ( $is_reduced ) : ?>
                <span class="property-badge"><?php echo __( 'Reduced', 'properta' ); ?></span>
            <?php endif; ?>

            <?php if ( $is_sticky ) : ?>
                <span class="property-badge property-badge-sticky"><?php echo __( 'TOP', 'properta' ); ?></span>
            <?php endif; ?>
        </a>
    </div><!-- /.property-image -->

    <div class="property-box-content">

        <?php $price = Realia_Price::get_property_price(); ?>
        <?php if ( ! empty( $price ) ) : ?>
            <div class="property-box-price">
                <?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
            </div><!-- /.property-box-price -->
        <?php endif; ?>

        <div class="property-box-title">
	        <?php
	        /**
	         * realia_before_property_box_title
	         */
	        do_action( 'realia_before_property_box_title', get_the_ID() );
	        ?>

            <h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>

	        <?php
	        /**
	         * realia_after_property_box_title
	         */
	        do_action( 'realia_after_property_box_title', get_the_ID() );
	        ?>
        </div><!-- /.property-box-title -->

	    <div class="property-box-body">
		    <?php
		    /**
		     * realia_before_property_box_body
		     */
		    do_action( 'realia_before_property_box_body', get_the_ID() );
		    ?>

            <?php $location = Realia_Query::get_property_location_name(); ?>
            <?php if ( ! empty( $location ) ) : ?>
                <div class="property-box-location">
                    <?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?>
                </div>
            <?php endif; ?>

		    <?php
		    /**
		     * realia_after_property_box_body
		     */
		    do_action( 'realia_after_property_box_body', get_the_ID() );
		    ?>
	    </div><!-- /.property-box-body -->
    </div><!-- /.property-box-content -->
    <?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
    <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
    <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
    <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>

    <?php if ( ! empty( $area ) || ! empty( $beds ) || ! empty( $baths ) || ! empty( $garages ) ) :?>
        <div class="property-box-meta">

            <?php if ( ! empty( $area ) ) : ?>
                <span class="property-box-meta-item property-box-meta-item-area" title="<?php echo __('Home Area', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
                    <i class="fa fa-arrows-alt"></i>
                    <?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?>
                </span><!-- /.property-box-meta-item -->
            <?php endif; ?>

            <?php if ( ! empty( $beds ) ) : ?>
                <span class="property-box-meta-item property-box-meta-item-beds" title="<?php echo __('Beds', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
                    <i class="fa fa-bed"></i>
                    <?php echo esc_attr( $beds ); ?>
                </span><!-- /.property-box-meta-item -->
            <?php endif; ?>

            <?php if ( ! empty( $baths ) ) : ?>
                <span class="property-box-meta-item property-box-meta-item-baths" title="<?php echo __('Baths', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
                    <i class="fa fa-tint"></i>
                    <?php echo esc_attr( $baths ); ?>
                </span><!-- /.property-box-meta-item -->
            <?php endif; ?>

            <?php if ( ! empty( $garages ) ) : ?>
                <span class="property-box-meta-item property-box-meta-item-garages" title="<?php echo __('Garages', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
                    <i class="fa fa-car"></i>
                    <?php echo esc_attr( $garages ); ?>
                </span><!-- /.property-box-meta-item -->
            <?php endif; ?>

        </div><!-- /.property-box-meta -->
    <?php endif; ?>
</div>
