=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: ethanfoster.com
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin aims to retrieve users from the wordpress database and display as a list on the frontend using a shortcode. 

== Description ==

assignment:

    Challenge in ajax:
    Create a custom wordpress plugin that has a shortcode called
    shortcode_show_authors.
    In that shortcode, display a button that says: "click here to see all site users".
    Use a nonce token to authenticate the button click. 
    Using ajax, grab all of the known user display_names  from the database for the entire site.
    Send the users response back to the frontend using json. Display them in a list.
    Only show the list if you are logged in as an admin.
    If you are not logged in, show a message saying you must be logged in to see the list

== Installation ==

1. Upload `show_authors.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

==================