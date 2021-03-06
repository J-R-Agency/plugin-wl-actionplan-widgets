<?php
/*
Plugin Name: Action Plan Widgets for Wellbeing Liverpool
Plugin URI: https://www.matchstickcreative.co.uk/
Description: Action Plan Widgets for Wellbeing Liverpool
Version: 0.6
Author: GM
Author URI: https://www.matchstickcreative.co.uk/
*/

// Register and load the widget
function mc_load_widgets() {
    register_widget( 'mc_actionplan_widget' );
    register_widget( 'mc_shortlist_widget' );
}
add_action( 'widgets_init', 'mc_load_widgets' );
 

// Creating the action plan widget 
class mc_actionplan_widget extends WP_Widget {
	 
	function __construct() {
		parent::__construct(
			 
			// Base ID of your widget
			'mc_actionplan_widget', 
			 
			// Widget name will appear in UI
			__('Wellbeing Liverpool Action Plan Widget', 'mc_actionplan_widget'), 
			 
			// Widget description
			array( 'description' => __( 'Beta widget for displaying user action plan', 'mc_actionplan_widget_domain' ), ) 
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
		echo __( '', 'mc_actionplan_widget_domain' );

			// Display Goal - dependency on Action Plan plugin
			echo wl_return_goal();

		echo $args['after_widget'];
	}


	         
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'New title', 'mc_actionplan_widget_domain' );
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
} // Class mc_actionplan_widget ends here



// Creating the shortlist widget 
class mc_shortlist_widget extends WP_Widget {
	 
	function __construct() {
		parent::__construct(
			 
			// Base ID of your widget
			'mc_shortlist_widget', 
			 
			// Widget name will appear in UI
			__('Wellbeing Liverpool Shortlist Widget', 'mc_shortlist_widget'), 
			 
			// Widget description
			array( 'description' => __( 'Beta widget for displaying user shortlist', 'mc_shortlist_widget_domain' ), ) 
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
		echo __( '', 'mc_shortlist_widget_domain' );

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
			$title = __( 'New title', 'mc_shortlist_widget_domain' );
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
} // Class mc_actionplan_widget ends here










