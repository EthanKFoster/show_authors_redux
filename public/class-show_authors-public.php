<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       ethanfoster.com
 * @since      1.0.0
 *
 * @package    Show_authors
 * @subpackage Show_authors/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Show_authors
 * @subpackage Show_authors/public
 * @author     Ethan Foster <ethankfoster@gmail.com>
 */
class Show_authors_Public {

	/**
	 * The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/show_authors-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Show_authors_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Show_authors_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/show_authors-public.js', array(), $this->version, false );

		wp_localize_script($this->plugin_name, 'ajax', array('url' => admin_url( 'admin-ajax.php')));

		wp_enqueue_script($this->plugin_name);

	}

	public function show_authors_server(){
	
		if(!wp_verify_nonce($_REQUEST['nonce'], "show_authors_nonce")){
			exit("No naughty business please");
		}
		
		$users = get_users();
		$user_number = 0;
	
		foreach ($users as $user){
			$result['user'.$user_number] = $user->display_name;
			$user_number++;
		}
		
		$result = json_encode($result);
		echo $result;
		
		die();
	}

	/**
	 * Server side function to deny author names through admin-ajax
	 *
	 * @since    1.0.0
	*/
	public function show_authors_nopriv_server(){
		$result['type'] = "must login";
		$result = json_encode($result);
		echo $result;
		die();
	}

	/**
	 * This function is tied to our show_authors shortcode as our plugin frontend
	 *
	 * @since    1.0.0
	*/
	public function render_frontend(){
		?>
			<div
				id="showUsers"
				class='users-div'
				data-nonce="<?php echo wp_create_nonce("show_authors_nonce");?>"
				post-id="<?php echo get_the_ID();?>"
				user="<?php echo get_current_user_id();?>"
			>
				<button onclick="showUsers()">show users</button>
	
				<ul id="userList">
	
				</ul>
			</div>
		<?php
	}

}
