<?php

class VueBoilerplate {

	protected $version;

	public function __construct() {
		$this->version = '0.0.1';

//		$this->loadDependencies();
//		$this->loadAdminSettingsPage();
//		$this->loadWidget();
		$this->createShortcode();
	}
	
	public function createShortcode()
	{
	    add_shortcode('soutwest_leaderboard', 'leaderboard_shortcode');
	}

	public function leaderboard_shortcode()
	{
	    echo 'test';
	}

	public function loadDependencies() {
//		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/SettingsPage.php';
//		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widget/SliderWidget.php';
	}

	public function loadAdminSettingsPage() {
		$settingsPage = new SettingsPage( $this->version );
	}

	public function loadWidget() {
		add_action( 'widgets_init', array( $this, 'register_widget' ) );
	}

	public function register_widget() {
		register_widget( 'SliderWidget' );
	}
}