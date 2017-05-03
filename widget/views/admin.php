<?php
$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', $this->get_widget_slug() );
?>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ) ?></label>
	<input type="text"
	       class="widefat"
	       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
	       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
	       value="<?php echo esc_attr( $title ); ?>"
	>

</p>