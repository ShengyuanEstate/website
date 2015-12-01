<?php
$ids = ! empty( $instance['ids'] ) ? $instance['ids'] : '';
$height = ! empty( $instance['height'] ) ? $instance['height'] : '500px';
$size = ! empty( $instance['size'] ) ? $instance['size'] : 'thumbnail';
$classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';
$show_arrows = ! empty( $instance['show_arrows'] ) ? $instance['show_arrows'] : '';
$disable_dots = ! empty( $instance['disable_dots'] ) ? $instance['disable_dots'] : '';
$autoplay = ! empty( $instance['autoplay'] ) ? $instance['autoplay'] : '';
$autoplay_timeout = ! empty( $instance['autoplay_timeout'] ) ? $instance['autoplay_timeout'] : '';
?>

<!-- IDS -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'ids' ) ); ?>">
		<?php echo __( 'IDs', 'realia-property-slider' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'ids' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'ids' ) ); ?>"
	        type="text"
	        value="<?php echo esc_attr( $ids ); ?>">
	<br>
	<small><?php echo __( 'Property IDs, separated by commas.', 'realia-property-slider' ); ?></small>
</p>

<!-- CLASSES -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>">
		<?php echo __( 'Classes', 'realia-property-slider' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'classes' ) ); ?>"
	        type="text"
	        value="<?php echo esc_attr( $classes ); ?>">
	<br>
	<small><?php echo __( 'Additional classes appended to body class and separated by , e.g. <i>transparent-header, property-slider-append-top</i>', 'realia-property-slider' ); ?></small>
</p>

<!-- HEIGHT -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
		<?php echo __( 'Container height', 'realia-property-slider' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>"
	        type="text"
	        value="<?php echo esc_attr( $height ); ?>">
	<br>
	<small><?php echo __( 'Default value 500px.', 'realia-property-slider' ); ?></small>
</p>

<!-- SIZE -->
<?php $sizes = get_intermediate_image_sizes(); ?>

<?php if ( ! empty( $sizes ) ) : ?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>">
			<?php echo __( 'Thumbnail size', 'realia-property-slider' ); ?>
		</label>

		<select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>">
			<?php foreach ( $sizes as $thumb_size ) : ?>
				<option value="<?php echo esc_attr( $thumb_size ); ?>" <?php echo ( $size == $thumb_size ) ? 'selected="selected"' : ''; ?>>
					<?php echo esc_attr( $thumb_size ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</p>
<?php endif; ?>

<!-- SHOW ARROWS -->
<p>
	<input  type="checkbox"
	        class="checkbox"
			<?php echo ! empty( $show_arrows ) ? 'checked="checked"' : ''; ?>
	        id="<?php echo esc_attr( $this->get_field_id( 'show_arrows' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'show_arrows' ) ); ?>">

	<label for="<?php echo esc_attr( $this->get_field_id( 'show_arrows' ) ); ?>">
		<?php echo __( 'Show arrows', 'realia-property-carousel' ); ?>
	</label>
</p>

<!-- DISABLE DOTS -->
<p>
	<input  type="checkbox"
	        class="checkbox"
			<?php echo ! empty( $disable_dots ) ? 'checked="checked"' : ''; ?>
	        id="<?php echo esc_attr( $this->get_field_id( 'disable_dots' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'disable_dots' ) ); ?>">

	<label for="<?php echo esc_attr( $this->get_field_id( 'disable_dots' ) ); ?>">
		<?php echo __( 'Disable dots', 'realia-property-carousel' ); ?>
	</label>
</p>

<!-- AUTOPLAY -->
<p>
	<input  type="checkbox"
	        class="checkbox"
			<?php echo ! empty( $autoplay ) ? 'checked="checked"' : ''; ?>
	        id="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'autoplay' ) ); ?>">

	<label for="<?php echo esc_attr( $this->get_field_id( 'autoplay' ) ); ?>">
		<?php echo __( 'Autoplay', 'realia-property-carousel' ); ?>
	</label>
</p>

<!-- AUTOPLAY TIMEOUT -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'autoplay_timeout' ) ); ?>">
		<?php echo __( 'Autoplay timeout', 'realia-property-slider' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'autoplay_timeout' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'autoplay_timeout' ) ); ?>"
	        type="integer"
	        value="<?php echo esc_attr( $autoplay_timeout ); ?>">
	<br>
	<small><?php echo __( 'Default value 2000.', 'realia-property-slider' ); ?></small>
</p>