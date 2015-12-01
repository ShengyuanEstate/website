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

<?php if ( ! empty( $instance['description'] ) ) : ?>
	<div class="description">
		<?php echo wp_kses( $instance['description'], wp_kses_allowed_html( 'post' ) ); ?>
	</div><!-- /.description -->
<?php endif; ?>

<?php if ( have_posts() ) : ?>
	<div class="item-per-row-<?php echo esc_attr( $instance['per_row'] ); ?>">
		<?php if ( $instance['per_row'] != 1 ) : ?>
			<div class="pricing-row">
		<?php endif; ?>

		<?php $index = 0; ?>
		<?php while ( have_posts() ) : the_post(); ?>

            <?php $price = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'price', true ); ?>
            <?php $description = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'description', true ); ?>
            <?php $table_items = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'items', true ); ?>
            <?php $button_text = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'button_text', true ); ?>
            <?php $button_url = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'button_url', true ); ?>
            <?php $highlighted = get_post_meta( get_the_ID(), REALIA_PRICING_PREFIX . 'highlighted', true ); ?>

			<div class="pricing-container">
                <div class="pricing-inner <?php if ( $highlighted ) : ?>highlighted<?php endif; ?>">
                    <div class="pricing-header">
                        <?php if( get_the_title() ) : ?>
                            <h2 class="pricing-title"><?php the_title(); ?></h2>
                        <?php endif; ?>
                        <?php if( ! empty( $price ) ) : ?>
                            <h3 class="pricing-price"><?php echo $price; ?></h3>
                        <?php endif; ?>
                        <?php if( ! empty( $description ) ) : ?>
                            <h5 class="pricing-description"><?php echo $description; ?></h5>
                        <?php endif; ?>
                    </div><!-- /.pricing-header -->
                    <?php if( is_array( $table_items ) && ! empty( $table_items ) ) : ?>
                        <ul class="pricing-items">
                            <?php foreach ( $table_items as $table_item ) : ?>
                                <li><?php echo esc_attr( $table_item ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if ( ! empty ( $button_text ) ) : ?>
                        <a href="<?php echo $button_url; ?>" class="btn">
                            <?php echo $button_text; ?>
                        </a>
                    <?php endif; ?>
                </div><!-- /.pricing-inner -->
            </div><!-- /.pricing-container -->

			<?php if ( ( $index + 1 ) % $instance['per_row'] == 0 && $instance['per_row'] != 1 && Realia_Query::loop_has_next() ) : ?>
				</div><div class="pricing-row">
			<?php endif; ?>

			<?php $index++; ?>
		<?php endwhile; ?>

		<?php if ( $instance['per_row'] != 1 ) : ?>
			</div><!-- /.properties-row -->
		<?php endif; ?>
	</div>
<?php else : ?>
	<div class="alert alert-warning">
		<?php echo __( 'No pricing tables found.', 'realia-pricing' ); ?>
	</div><!-- /.alert -->
<?php endif; ?>

<?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>