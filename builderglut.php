<?php
/**
 * Plugin Name:       Builderglut
 * Plugin URI:        https://wordpress.org/plugins/builderglut/
 * Description:       Gutenberg Blocks and Templates for WordPress
 * Version:           1.0.2
 * Author:            AppGlut
 * Author URI:        https://profiles.wordpress.org/appglut
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       builderglut
 * Domain Path:       /languages
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Add a menu item to the admin dashboard.
add_action('admin_menu', 'builderglut_add_admin_menu');
function builderglut_add_admin_menu() {
    add_menu_page(
        __('Builderglut Dashboard', 'builderglut'), // Translatable menu title
        __('Builderglut', 'builderglut'), // Translatable menu name
        'manage_options',
        'builderglut',
        'builderglut_dashboard_page',
        'dashicons-welcome-learn-more',
        23
    );
}


// Display the content for the plugin dashboard.
function builderglut_dashboard_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Welcome to Builderglut!', 'builderglut' ); ?></h1>
        <p><?php esc_html_e( "This is your plugin's dashboard where you can manage settings and view information.", 'builderglut' ); ?></p>
    </div>
    <?php
}


// Register and enqueue block editor assets for Gutenberg block.
function builderglut_register_block() {
    // Enqueue the block editor script.
    wp_enqueue_script(
        'builderglut-block',
        plugins_url('block.js', __FILE__),
        array('wp-blocks', 'wp-element', 'wp-editor'),
        '1.0.0',
        true // Load script in footer
    );

    // Register the block type.
    register_block_type('builderglut/heading', array(
        'editor_script' => 'builderglut-block',
    ));
}
add_action('init', 'builderglut_register_block');

