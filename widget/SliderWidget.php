<?php

/**
 * Vsellis Slider Widget
 *
 * @package SliderWidget
 * @author Vsellis
 */
class SliderWidget extends WP_Widget {

	protected $url;

	protected $path;

	protected $version = '0.0.1';

	protected $widget_slug = 'vsellis-slider-widget';

	public function __construct() {

		$this->url  = plugin_dir_url( __FILE__ );
		$this->path = plugin_dir_path( __FILE__ );

		parent::__construct(
			$this->get_widget_slug(),
			__( 'Vsellis Slider', $this->get_widget_slug() ),
			array(
				'classname'   => $this->get_widget_slug() . '-class',
				'description' => __( 'A slider widget.', $this->get_widget_slug() )
			)
		);
		// admin styles and scripts
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

		// frontend styles and scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );
	}

	/**
	 * @return string
	 */
	public function get_widget_slug() {
		return $this->widget_slug;
	}

	public function widget( $args, $instance ) {
		$widget_string = $args['before_widget'];
		ob_start();
		include( plugin_dir_path( __FILE__ ) . 'views/widget.php' );
		$widget_string .= ob_get_clean();
		$widget_string .= $args['after_widget'];
		print $widget_string;
	}

	public function form( $instance ) {
		include( plugin_dir_path( __FILE__ ) . 'views/admin.php' );
	}

	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

	/**
	 * Registers and enqueues admin-specific styles.
	 */
	public function register_admin_styles() {
		wp_enqueue_style( $this->get_widget_slug() . '-admin-styles', plugins_url( 'css/admin.css', __FILE__ ) );
	}

	/**
	 * Registers and enqueues admin-specific JavaScript.
	 */
	public function register_admin_scripts() {
		wp_enqueue_script( $this->get_widget_slug() . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ),
			array( 'jquery' ) );
	}

	/**
	 * Registers and enqueues widget-specific styles.
	 */
	public function register_widget_styles() {
		wp_enqueue_style( 'slick', $this->url . 'css/slick.css', $this->version );
		wp_enqueue_style( $this->get_widget_slug() . '-style', $this->url . 'css/frontend.css' );
	} // end register_widget_styles

	/**
	 * Registers and enqueues widget-specific scripts.
	 */
	public function register_widget_scripts() {
		wp_enqueue_script( 'slick', $this->url . 'js/vendor/slick.min.js', array(), $this->version );
		wp_enqueue_script( 'fitvids', $this->url . 'js/vendor/jquery.fitvids.js', array(), $this->version );
		wp_enqueue_script('vsellis-slider-widget', $this->url . '/js/frontend.js', array('jquery'), $this->version);
	}
}