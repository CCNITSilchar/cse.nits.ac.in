<?php
/*
Plugin Name: Vertical Scroll Recent Post
Plugin URI: http://www.gopiplus.com/work/2010/07/18/vertical-scroll-recent-post/
Description: Vertical Scroll Recent Post plugin scroll the recent post title in the widget, the post scroll from bottom to top vertically.
Author: Gopi Ramasamy, Sudavar
Author URI: http://www.gopiplus.com/work/2010/07/18/vertical-scroll-recent-post/
Version: 12
Tags: Vertical, scroll, recent, post, title, widget
vsrp means Vertical Scroll Recent Post
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

require_once dirname( __FILE__ ) . '/class-vertical-scroll-recent-post-widget.php';
require_once dirname( __FILE__ ) . '/class-vertical-scroll-recent-post-installer.php';
require_once dirname( __FILE__ ) . '/class-vertical-scroll-recent-post-settings.php';

register_activation_hook( __FILE__ , array( 'Vsrp_Widget_Installer', 'activate' ) );
register_deactivation_hook( __FILE__ , array( 'Vsrp_Widget_Installer', 'deactivate' ) );
register_uninstall_hook( __FILE__ , array( 'Vsrp_Widget_Installer', 'unistall' ) );

function vsrp_textdomain() {
    load_plugin_textdomain( 'vertical-scroll-recent-post', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'vsrp_textdomain' );

if ( is_admin() )
    $my_settings_page = new Vsrp_Widget_Settings();

function vsrp_add_files() {
    wp_register_script( 'vsrp_js', plugins_url().'/vertical-scroll-recent-post/vertical-scroll-recent-post.js' );
    wp_register_style ( 'vsrp_css', plugins_url().'/vertical-scroll-recent-post/vertical-scroll-recent-post.css' );
}
add_action( 'wp_enqueue_scripts', 'vsrp_add_files' );
add_action( 'login_enqueue_scripts', 'vsrp_add_files' );
add_action( 'admin_enqueue_scripts', 'vsrp_add_files' );

// register widget
function register_vrsp_widget() {
    register_widget( 'Vertical_Recent_Post_Widget' );
}
add_action( 'widgets_init', 'register_vrsp_widget' );

// Feature: Shortcode for birthdays in pages/posts
function vsrp_shortcode( $atts ) {
    $attr = shortcode_atts( array(
        'class' => '',
        'vsrp_id' => '0'
    ), $atts );

    $instance = array( 'class' => $attr[ 'class' ], 'vsrp_id' => $attr[ 'vsrp_id' ] );
    echo "<div class=\"{$instance[ 'class' ]}\">" . Vertical_Recent_Post_Widget::vsrp( $instance ) . "</div>";
}
add_shortcode( 'vsrp', 'vsrp_shortcode' );

// Feature: Add button for shortcode in WordPress editor
// (thanks to: http://wordpress.stackexchange.com/questions/72394/how-to-add-a-shortcode-button-to-the-tinymce-editor)
add_action( 'init', 'vsrp_shortcode_button_init' );
function vsrp_shortcode_button_init() {
    //Abort early if the user will never see TinyMCE
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) && get_user_option( 'rich_editing' ) == 'true' )
        return;

    //Add a callback to regiser our tinymce plugin   
    add_filter( "mce_external_plugins", "vsrp_register_tinymce_plugin" );

    // Add a callback to add our button to the TinyMCE toolbar
    add_filter( 'mce_buttons', 'vsrp_add_tinymce_button' );
}

//This callback registers our plug-in
function vsrp_register_tinymce_plugin( $plugin_array ) {
    $plugin_array[ 'vsrp_button' ] = plugins_url() . '/vertical-scroll-recent-post/vertical-scroll-recent-post-shortcode.js';
    return $plugin_array;
}

//This callback adds our button to the toolbar
function vsrp_add_tinymce_button( $buttons ) {
    //Add the button ID to the $button array
    $buttons[] = "vsrp_button";
    return $buttons;
}

function vsrp_control() {
    echo '<p><b>' . __( 'Vertical Scroll Recent Post', 'vertical-scroll-recent-post' ) . '</b>' . __( 'Check official website for more information', 'vertical-scroll-recent-post' );
    ?> <a target="_blank" href="http://www.gopiplus.com/work/2010/07/18/vertical-scroll-recent-post/"><?php _e( 'click here', 'vertical-scroll-recent-post' ); ?></a></p><?php
}
?>