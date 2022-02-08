<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       ethanfoster.com
 * @since      1.0.0
 *
 * @package    Show_authors
 * @subpackage Show_authors/includes
 */


class Show_authors {

	protected $loader;
	protected $plugin_name;
	protected $version;

	/**
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 */

	public function __construct() {
		if ( defined( 'SHOW_AUTHORS_VERSION' ) ) {
			$this->version = SHOW_AUTHORS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'show_authors';

		$this->load_dependencies();
		$this->define_public_hooks();
																	
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 * - Show_authors_Loader. Orchestrates the hooks of the plugin.
	 * - Show_authors_Admin. Defines all hooks for the admin area.
	 * - Show_authors_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-show_authors-loader.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-show_authors-public.php';

		$this->loader = new Show_authors_Loader();

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Show_authors_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_ajax_show_authors', $plugin_public, 'show_authors_server' );
		$this->loader->add_action( 'wp_ajax_nopriv_show_authors', $plugin_public, 'show_authors_nopriv_server' );
		$this->loader->add_shortcode( 'show_authors', $plugin_public, 'render_frontend' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Show_authors_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}



}
