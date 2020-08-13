<?php
/*
Plugin Name: Action Plan Widgets for Wellbeing Liverpool
Plugin URI: https://www.jnragency.co.uk/
Description: Action Plan Widgets for Wellbeing Liverpool
Version: 0.2
Author: GM
Author URI: https://www.jnragency.co.uk/
*/

// Register and load the widget
function jr_load_widget() {
    register_widget( 'jr_widget' );
}
add_action( 'widgets_init', 'jr_load_widget' );
 
// Creating the widget 
class jr_widget extends WP_Widget {
	 
	function __construct() {
		parent::__construct(
			 
			// Base ID of your widget
			'jr_widget', 
			 
			// Widget name will appear in UI
			__('Wellbeing Liverpool Shortlist Widget', 'jr_widget_domain'), 
			 
			// Widget description
			array( 'description' => __( 'Beta widget for displaying user shortlist', 'jr_widget_domain' ), ) 
		);
	}
	 
	// Creating widget front-end
	 
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		 
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		 
		// This is where you run the code and display the output
		echo __( '', 'jr_widget_domain' );

			if ( isset($user_id) && isset($site_id) ){

				// Get function (returns array of IDs): 
				// print_r ( "<!-- " . get_user_favorites($user_id, $site_id) . " -->" );

				// Get function (returns html list): 
				// print_r ( get_user_favorites_list($user_id, $site_id, $include_links, $filters, $include_button, $include_thumbnails = false, $thumbnail_size = 'thumbnail', $include_excerpt = false) ) ;

				// Print function (prints an html list): 
				the_user_favorites_list($user_id, $site_id, $include_links = true, $filters, $include_button, $include_thumbnails = false, $thumbnail_size = 'thumbnail', $include_excerpt = false) ;

				// Print clear favourites button
				the_clear_favorites_button($site_id, $text);
			} else {
				the_user_favorites_list();
				the_clear_favorites_button();
			}


		echo $args['after_widget'];
	}
	         
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'New title', 'jr_widget_domain' );
		}
		// Widget admin form
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}
	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
} // Class jr_widget ends here







