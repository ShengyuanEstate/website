<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php
$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
$count = ! empty( $instance['count'] ) ? $instance['count'] : 4;
$visible_items = ! empty( $instance['visible_items'] ) ? $instance['visible_items'] : 4;
$margin = ! empty( $instance['margin'] ) ? $instance['margin'] : 30;
$show_prev_next = ! empty( $instance['show_prev_next'] ) ? $instance['show_prev_next'] : '';
$show_pagination = ! empty( $instance['show_pagination'] ) ? $instance['show_pagination'] : '';
$attribute = ! empty( $instance['attribute'] ) ? $instance['attribute'] : '';
$classes = ! empty( $instance['classes'] ) ? $instance['classes'] : '';
?>

<!-- TITLE -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
		<?php echo __( 'Title', 'realia-property-carousel' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
	        type="text"
	        value="<?php echo esc_attr( $title ); ?>">
</p>

<!-- DESCRIPTION -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">
		<?php echo __( 'Description', 'realia-subscribe' ); ?>
	</label>

	<textarea class="widefat"
	          rows="4"
	          id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
	          name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?></textarea>
</p>

<!-- COUNT -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>">
		<?php echo __( 'Count', 'realia-property-carousel' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"
	        type="number"
	        value="<?php echo esc_attr( $count ); ?>">
</p>

<!-- VISIBLE ITEMS -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'visible_items' ) ); ?>">
		<?php echo __( 'Visible items', 'realia-property-carousel' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'visible_items' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'visible_items' ) ); ?>"
	        type="number"
	        value="<?php echo esc_attr( $visible_items ); ?>">
</p>

<!-- MARGIN -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'margin' ) ); ?>">
		<?php echo __( 'Margin', 'realia-property-carousel' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'margin' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'margin' ) ); ?>"
	        type="number"
	        value="<?php echo esc_attr( $margin ); ?>">
</p>

<!-- SHOW PREV/NEXT -->
<p>
	<input  type="checkbox"
	        class="checkbox"
		<?php echo ! empty( $show_prev_next ) ? 'checked="checked"' : ''; ?>
	        id="<?php echo esc_attr( $this->get_field_id( 'show_prev_next' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'show_prev_next' ) ); ?>">

	<label for="<?php echo esc_attr( $this->get_field_id( 'show_prev_next' ) ); ?>">
		<?php echo __( 'Show prev/next', 'realia-property-carousel' ); ?>
	</label>
</p>

<!-- SHOW PAGINATION -->
<p>
	<input  type="checkbox"
	        class="checkbox"
		<?php echo ! empty( $show_pagination ) ? 'checked="checked"' : ''; ?>
	        id="<?php echo esc_attr( $this->get_field_id( 'show_pagination' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'show_pagination' ) ); ?>">

	<label for="<?php echo esc_attr( $this->get_field_id( 'show_pagination' ) ); ?>">
		<?php echo __( 'Show pagination', 'realia-property-carousel' ); ?>
	</label>
</p>

<!-- ATTRIBUTE -->
<p>
	<strong><?php echo __( 'Choose attribute', 'realia-property-carousel' ); ?></strong><br>
</p>

<ul>
	<li>
		<label>
			<input  type="radio"
			        class="radio"
				<?php echo ( empty( $attribute ) || $attribute == 'on' ) ? 'checked="checked"' : ''; ?>
			        id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">
			<?php echo __( 'It doesn\'t matter', 'realia-property-carousel' ); ?>
		</label>
	</li>

	<li>
		<label>
			<input  type="radio"
			        class="radio"
			        value="featured"
				<?php echo ( $attribute == 'featured' ) ? 'checked="checked"' : ''; ?>
			        id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">
			<?php echo __( 'Featured only', 'realia-property-carousel' ); ?>
		</label>
	</li>

	<li>
		<label>
			<input  type="radio"
			        class="radio"
			        value="reduced"
				<?php echo ( $attribute == 'reduced' ) ? 'checked="checked"' : ''; ?>
			        id="<?php echo esc_attr( $this->get_field_id( 'attribute' ) ); ?>"
			        name="<?php echo esc_attr( $this->get_field_name( 'attribute' ) ); ?>">

			<?php echo __( 'Reduced only', 'realia-property-carousel' ); ?>
		</label>
	</li>
</ul>


<!-- CLASSES -->
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>">
		<?php echo __( 'Classes', 'realia' ); ?>
	</label>

	<input  class="widefat"
	        id="<?php echo esc_attr( $this->get_field_id( 'classes' ) ); ?>"
	        name="<?php echo esc_attr( $this->get_field_name( 'classes' ) ); ?>"
	        type="text"
	        value="<?php echo esc_attr( $classes ); ?>">
	<br>
	<small><?php echo __( 'Additional classes e.g. <i>fullwidth background-gray</i>', 'realia' ); ?></small>
</p>