<?php

/**
 * Plugin Name:       Show Authors
 * Plugin URI:        www.example.com
 * Description:       This is a plugin for showing the authors of posts. Assignment from Miles.
 * Version:           1.0.0
 * Author:            Ethan Foster
 * Author URI:        ethanfoster.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       show_authors
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SHOW_AUTHORS_VERSION', '1.0.0' );

require plugin_dir_path( __FILE__ ) . 'includes/class-show_authors.php';

function run_show_authors() {

	$plugin = new Show_authors();
	$plugin->run();

}

run_show_authors();
