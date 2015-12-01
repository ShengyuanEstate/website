<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

<?php if ( ! empty( $instance['classes'] ) ) : ?>
	<div class="<?php echo esc_attr( $instance['classes'] );?>">
<?php endif; ?>

<?php if ( ! empty( $instance['title'] ) ) : ?>
	<?php echo wp_kses( $args['before_title'], wp_kses_allowed_html( 'post' ) ); ?>
	<?php echo wp_kses( $instance['title'], wp_kses_allowed_html( 'post' ) ); ?>
	<?php echo wp_kses( $args['after_title'], wp_kses_allowed_html( 'post' ) ); ?>
<?php endif; ?>

<?php if ( ! empty( $instance['description'] ) ) : ?>
	<div class="description">
		<?php echo wp_kses( $instance['description'], wp_kses_allowed_html( 'post' ) ); ?>
	</div><!-- /.description -->
<?php endif; ?>

<?php if ( have_posts() ) : ?>
	<div class="properties-carousel-list owl-carousel owl-theme">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="properties-carousel-item">
				<?php include Realia_Template_Loader::locate( 'properties/box' ); ?>
			</div><!-- /.properties-carousel-item -->
		<?php endwhile; ?>
	</div><!-- /.properties-carousel-list -->

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#<?php echo esc_attr( $args['widget_id'] ); ?> .properties-carousel-list').owlCarousel({
				loop: true,
				responsiveClass: true,
				responsive: {
					0: {
						items: 1,
						dots: false
					},
					768: {
						items: 3
					},
					991: {
						items: <?php echo ! empty( $instance['visible_items'] ) ? $instance['visible_items'] : 4; ?>
					}

				},
				items: <?php echo ! empty( $instance['visible_items'] ) ? $instance['visible_items'] : 4; ?>,
				margin: <?php echo ! empty( $instance['margin'] ) ? $instance['margin'] : 30; ?>,
				nav: <?php echo ! empty( $instance['show_prev_next'] ) ? 'true' : 'false'; ?>,
				dots: <?php echo ! empty( $instance['show_pagination'] ) ? 'true' : 'false'; ?>
			});
		});
	</script>
<?php endif; ?>

<?php if ( ! empty( $instance['classes'] ) ) : ?>
	</div>
<?php endif; ?>

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>
