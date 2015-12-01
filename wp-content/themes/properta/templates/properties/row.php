<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article <?php post_class( 'property-row' ); ?>>
    <div class="property-row-image">
        <a href="<?php the_permalink(); ?>">
            <?php $is_sticky = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'sticky', true ); ?>
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

            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'property-row-thumbnail' ); ?>
            <?php endif; ?>
        </a>
    </div><!-- /.property-row-image -->

	<div class="property-row-content">
		<div class="property-row-content-inner">
			<div class="property-row-main">
				<h2 class="property-row-title entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>

				<?php $location = Realia_Query::get_property_location_name(); ?>
				<?php if ( ! empty( $location ) ) : ?>
					<div class="property-row-location">
						<?php echo wp_kses( $location, wp_kses_allowed_html( 'post' ) ); ?>
					</div>
				<?php endif; ?>

                <?php $price = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'price', true ); ?>
                <?php if ( ! empty( $price ) ) : ?>
                    <div class="property-row-meta-item property-row-meta-item-price">
                        <span><?php echo __( 'Price', 'properta' ); ?>:</span>
                        <strong><?php echo Realia_Price::get_property_price(); ?></strong>
                    </div><!-- /.property-box-meta-item -->
                <?php endif; ?>

				<div class="property-row-body">
					<p><?php the_excerpt(); ?></p>
				</div><!-- /.property-row-body -->
			</div><!-- /.property-row-main -->

			<?php $area = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'home_area', true ); ?>
			<?php $beds = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'beds', true ); ?>
            <?php $baths = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'baths', true ); ?>
			<?php $garages = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'garages', true ); ?>
			<?php $status = Realia_Query::get_property_status_name(); ?>
			<?php $type = Realia_Query::get_property_type_name(); ?>

			<?php if ( ! empty( $area ) || ! empty( $status ) || ! empty( $type ) || ! empty( $garages ) || ! empty( $beds )  || ! empty( $baths ) ) :?>
				<div class="property-row-meta">

					<?php if ( ! empty( $type ) ) : ?>
						<span class="property-row-meta-item property-row-meta-item-type" title="<?php echo __('Type', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
							<i class="fa fa-home"></i>
							<?php echo esc_attr( $type ); ?>
						</span><!-- /.property-box-meta-item -->
					<?php endif; ?>

					<?php if ( ! empty( $area ) ) : ?>
						<span class="property-row-meta-item property-row-meta-item-area" title="<?php echo __('Home Area', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
							<i class="fa fa-arrows-alt"></i>
							<?php echo esc_attr( $area ); ?> <?php echo get_theme_mod( 'realia_measurement_area_unit', 'sqft' ); ?>
						</span><!-- /.property-box-meta-item -->
					<?php endif; ?>

                    <?php if ( ! empty( $beds ) ) : ?>
                        <span class="property-row-meta-item property-row-meta-item-beds" title="<?php echo __('Beds', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
							<i class="fa fa-bed"></i>
                            <?php echo esc_attr( $beds ); ?>
						</span><!-- /.property-box-meta-item -->
                    <?php endif; ?>

                    <?php if ( ! empty( $baths ) ) : ?>
                        <span class="property-row-meta-item property-row-meta-item-baths" title="<?php echo __('Baths', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
                            <i class="fa fa-tint"></i>
                            <?php echo esc_attr( $baths ); ?>
                        </span><!-- /.property-box-meta-item -->
                    <?php endif; ?>

                    <?php if ( ! empty( $garages ) ) : ?>
                        <span class="property-row-meta-item property-row-meta-item-garages" title="<?php echo __('Garages', 'properta'); ?>" data-toggle="tooltip" data-placement="bottom">
							<i class="fa fa-car"></i>
							<?php echo esc_attr( $garages ); ?>
						</span><!-- /.property-box-meta-item -->
                    <?php endif; ?>

					<?php if ( ! empty( $status ) ) : ?>
						<span class="property-row-meta-item property-row-meta-item-status">
							<strong><?php echo esc_attr( $status ); ?></strong>
						</span><!-- /.property-box-meta-item -->
					<?php endif; ?>
				</div><!-- /.property-row-meta -->
			<?php endif; ?>
		</div><!-- /.property-row-content-inner -->
	</div><!-- /.property-row-content -->
</article>
