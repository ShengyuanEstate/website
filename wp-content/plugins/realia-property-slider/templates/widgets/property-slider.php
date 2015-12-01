<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

<?php if ( ! empty( $instance['title'] ) ) : ?>
	<?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
	<?php echo wp_kses( $instance['title'], wp_kses_allowed_html( 'post' ) ); ?>
	<?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
<?php endif; ?>

<?php if ( have_posts() ) :  ?>
	<div class="property-slider-list owl-carousel owl-theme">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php $image_id = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'slider_image_id', true ); ?>
			<?php $image_thumbnail_src = wp_get_attachment_image_src( $image_id, $instance['size']  ); ?>
			<?php $image = get_post_meta( get_the_ID(), REALIA_PROPERTY_PREFIX . 'slider_image', true ); ?>

			<div class="property-slider-item" data-dot="<img src='<?php echo $image_thumbnail_src[0]; ?>' alt='<?php the_title(); ?>'>" style="height: <?php echo ! empty( $instance['height'] ) ? $instance['height'] : '500px'; ?>;">
				<div class="property-slider-item-image" style="background-image: url('<?php echo esc_attr( $image ); ?>');">
				</div><!-- /.property-slider-item-image -->

				<div class="property-slider-item-info-wrapper">
					<div class="property-slider-item-info">
						<div class="property-slider-item-info-inner">
							<div class="property-slider-item-info-price">
								<?php echo Realia_Price::get_property_price(); ?>
							</div><!-- property-slider-item-info-price -->

							<div class="property-slider-item-info-title">
								<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							</div><!-- /.property-slider-item-info-title -->

							<div class="property-slider-item-info-location">
								<?php echo Realia_Query::get_property_location_name(); ?>
							</div><!-- /.property-slider-item-info-location -->

							<div class="property-slider-item-info-more">
								<a href="<?php the_permalink(); ?>">
									<?php echo __( 'View Detail', 'realia-property-carousel' ); ?>
								</a>
							</div><!-- /.property-slider-item-info-location -->
						</div><!-- /.property-slider-item-info-inner -->
					</div><!-- /.property-slider-item-info -->
				</div><!-- /.property-slider-item-info-wrapper -->
			</div><!-- /.property-slider-item -->
		<?php endwhile; ?>
	</div><!-- /.property-carousel-list -->

	<div class="property-slider-dots"></div><!-- /.property-slider-dots -->

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var el = $('#<?php echo esc_attr( $args['widget_id'] ); ?> .property-slider-list');
			el.owlCarousel({
				responsive: {
					0: {
						dots: false
					},
					768: {
						dots: <?php if ( ! empty( $instance['disable_dots'] ) ) : ?>false<?php else : ?>true<?php endif; ?>
					}
				},
				responsiveClass: true,
				loop: true,
				items: 1,
				mouseDrag: false,
				onInitialized: function() {
					var length = el.find('.owl-item:not(.cloned)').length;
					el.find('.owl-prev').prepend('<span>' + length + ' / ' + length +'</span>');
					el.find('.owl-next').prepend('<span>2 / ' + length +'</span>');
				},
				onTranslated: function() {
					var items = el.find('.owl-item:not(.cloned)');
					var length = items.length;
					var index = items.index($('.active'));

					var prev = index;
					if (index <= 0) {
						prev = length;
					}

					var next = index + 2;
					if (index + 1 == length) {
						next = 1;
					}

					el.find('.owl-prev span').text(prev + ' / ' + length);
					el.find('.owl-next span').text(next + ' / ' + length);
				},
				<?php if ( ! empty( $instance['show_arrows'] ) ) : ?>
					nav: true,
				<?php endif; ?>

				<?php if ( ! empty( $instance['disable_dots'] ) ) : ?>
					dots: false,
				<?php endif; ?>

				<?php if ( ! empty( $instance['autoplay'] ) ) : ?>
					autoplay: true,
					<?php if ( ! empty( $instance['autoplay_timeout'] ) ) : ?>
						autoplayTimeout: <?php echo esc_attr( $instance['autoplay_timeout'] ); ?>,
					<?php endif; ?>
				<?php endif; ?>
			});
		});
	</script>
<?php endif; ?>

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>