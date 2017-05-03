<?php

class SettingsPage {

	protected $version;

	protected $path;

	public function __construct( $version ) {
		$this->version = $version;
		$this->url     = plugin_dir_url( __FILE__ );
		$this->path    = plugin_dir_path( __FILE__ );

		add_action( 'admin_enqueue_scripts', array( $this, 'loadAssets' ) );

		$this->registerMenu();
		$this->ajaxCalls();
	}

	public function loadAssets() {


		if ( isset( $_GET['page'] ) && 'vsellis-slider-settings' == $_GET['page'] ) {
			wp_enqueue_media();

			wp_enqueue_script( 'vue', 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.1/vue.min.js' );
			wp_enqueue_script( 'vsellis-slider-admin', $this->url . 'js/vsellis-slider-settings.min.js',
				array(), $this->version );
		}


//		wp_enqueue_script('vuedraggable', $this->url .'js/', array('vsellis-slider-admin'), $this->version, true);
//		wp_enqueue_style('vuedraggable', '', array('vsellis-slider-admin'), $this->version, true);
	}

	public function register_menu_page() {
		add_menu_page(
			'Vsellis Slider Settings',
			'Slider Settings',
			'manage_options',
			'vsellis-slider-settings',
			array( $this, 'vsellis_render_page' )
		);
	}

	public function vsellis_render_page() {
		include( $this->path . 'partials/settings-page.php' );
	}

	public function registerMenu() {
		add_action( 'admin_menu', array( $this, 'register_menu_page' ) );
	}

	public function ajaxCalls() {
		add_action( 'wp_ajax_fetch_types', array( $this, 'fetchData' ) );
		add_action( 'wp_ajax_fetch_posts', array( $this, 'fetchPosts' ) );
		add_action( 'wp_ajax_fetch_info', array( $this, 'fetchInfo' ) );
		add_action( 'wp_ajax_save_slider', array( $this, 'saveSlider' ) );
		add_action( 'wp_ajax_fetch_slider', array( $this, 'fetchSlider' ) );
	}

	public function fetchData() {
		wp_send_json( array(
			'types' => get_post_types( array(
				'public' => true
			) )
		) );
	}

	public function fetchPosts() {
		wp_send_json( array(
			'posts' => get_posts( array(
				'posts_per_page' => - 1,
				'post_type'      => $_REQUEST['type']
			) )
		) );
	}

	public function fetchInfo() {

		$lede  = get_post_meta( $_REQUEST['id'], '_vsellis_post_lede', true );
		$video = get_post_meta( $_REQUEST['id'], '_vsellis_post_is_video', true );

		$is_video = false;

		if ( 'on' == $video ) {
			$type  = 'video';
			$is_video = true;
		} else {
			$type = 'image';
		}

		$img = get_the_post_thumbnail_url( $_REQUEST['id'], 'full' );

		wp_send_json( array(
			'title'   => get_the_title( $_REQUEST['id'] ),
			'img'     => $img,
			'link'    => get_the_permalink( $_REQUEST['id'] ),
			'content' => $lede,
			'type'    => $type,
			'video'   => $is_video
		) );
	}

	public function saveSlider() {
		update_option( 'home_slider', $_REQUEST['slider'] );
		wp_send_json( 'saved' );
	}

	public function fetchSlider() {
		$slider = get_option( 'home_slider' );

		wp_send_json( array(
			'slider' => $slider
		) );
	}
}