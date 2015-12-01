<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="property-small">
    <div class="property-small-inner">
        <div class="property-small-image <?php if ( ! has_post_thumbnail() ) { echo 'without-image'; } ?>">
            <?php if ( has_post_thumbnail() ) :   ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                </a>
            <?php endif; ?>
        </div><!-- /.property-small-image -->

        <div class="property-small-content">
            <h3 class="property-small-title">
                <a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
            </h3><!-- /.property-small-title -->

            <?php $type = Realia_Query::get_property_type_name(); ?>
            <?php if ( ! empty( $type ) ) : ?>
                <div class="property-small-type">
                    <?php echo wp_kses( $type, wp_kses_allowed_html( 'post' ) ); ?>
                </div><!-- /.property-small-type -->
            <?php endif; ?>


            <?php $price = Realia_Price::get_property_price(); ?>
            <?php if ( ! empty( $price ) ) : ?>
                <div class="property-small-price">
                    <?php echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); ?>
                </div><!-- /.property-small-price -->
            <?php endif; ?>
        </div><!-- /.property-small-content -->
    </div><!-- /.property-small-inner -->

    <?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
    <?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
    <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
    <?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>

    <?php if ( ! empty( $area ) || ! empty( $beds ) || ! empty( $baths ) || ! empty( $garages ) ) :?>
        <div class="property-small-meta">

            <?php if ( ! empty( $area ) ) : ?>
                <span class="property-small-meta-item property-small-meta-item-area">
                    <i class="fa fa-arrows-alt"></i>
                    <?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?>
                </span><!-- /.property-small-meta-item -->
            <?php endif; ?>

            <?php if ( ! empty( $beds ) ) : ?>
                <span class="property-small-meta-item property-small-meta-item-beds">
                    <i class="fa fa-bed"></i>
                    <?php echo esc_attr( $beds ); ?>
                </span><!-- /.property-small-meta-item -->
            <?php endif; ?>

            <?php if ( ! empty( $baths ) ) : ?>
                <span class="property-small-meta-item property-small-meta-item-baths">
                    <i class="fa fa-tint"></i>
                    <?php echo esc_attr( $baths ); ?>
                </span><!-- /.property-small-meta-item -->
            <?php endif; ?>

            <?php if ( ! empty( $garages ) ) : ?>
                <span class="property-small-meta-item property-small-meta-item-garages">
                    <i class="fa fa-car"></i>
                    <?php echo esc_attr( $garages ); ?>
                </span><!-- /.property-small-meta-item -->
            <?php endif; ?>

        </div><!-- /.property-small-meta -->
    <?php endif; ?>

</div><!-- /.property-small -->
