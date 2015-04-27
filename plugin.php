<?php namespace WPDevsClub_Lesson_Var_Vars;

/**
 * Plugin Name: Lesson - Variable Variables & Variable Functions in WordPress
 * Plugin URI: http://wpdevelopersclub.com
 * Description: Accompanying lesson code for Lesson - Variable Variables & Variable Functions in WordPress
 * Version: 1.0.0
 * Author: Tonya
 * Author URI: http://wpdevelopersclub.com
 *
 * @license GNU General Public License 2.0+ or later
 *
 * ------------------------------------------------------------------------
 * Copyright 2015 wpdevelopersclub.com
 * ------------------------------------------------------------------------
 */

/*
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

//* Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheating&#8217; uh?' );
}

require_once( __DIR__ . '/assets/vendor/autoload.php' );

register_activation_hook( __FILE__,  __NAMESPACE__ . '\\activation_hooks' );
/**
 * Handle all activation hooks
 *
 * @since  1.0.0
 *
 * @return void
 */
function activation_hooks() {

	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
	check_admin_referer( "activate-plugin_{$plugin}" );

	if ( version_compare( $GLOBALS['wp_version'], Lesson::MIN_WP_VERSION, '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );

		$message = sprintf( '<strong>%s</strong> %s',
			sprintf( __( 'WPDevsClub Lesson %s requires WordPress %s or higher.' , 'wpdevsclub' ), Lesson::version(), Lesson::min_wp_version() ),
			sprintf( __( 'Please <a href="%s">upgrade WordPress</a> to a current version.', 'wpdevsclub' ), 'https://codex.wordpress.org/Upgrading_WordPress' )
		);
		wp_die( $message );
	}

	update_post_meta( 1, 'wpdevsclub_lesson_varvars', array(
		'_subtitle'     => 'My Awesome Subtitle',
		'_access'       => 'public',
		'_tldr'         => 'this is a short description describing the lesson',
		'_video_link'   => 'https://www.youtube.com/watch?v=wC5JkyCZkVo',
	) );
}

register_uninstall_hook( __FILE__,       __NAMESPACE__ . '\\uninstall' );
/**
 * Handle tasks when the plugin is deactivated
 *
 * @since  1.0.0
 *
 * @param  bool $network_wide
 * @return void
 */
function uninstall( $network_wide ) {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	check_admin_referer( 'bulk-plugins' );

	// Important: Check if the file is the one
	// that was registered during the uninstall hook.
	if ( __FILE__ != WP_UNINSTALL_PLUGIN ) {
		return;
	}

	delete_post_meta_by_key( 'wpdevsclub_lesson_varvars' );
}

//if ( ! empty ( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] ) {
//	add_action( 'admin_notices', __NAMESPACE__ . 'check_admin_notices', 0 );
//	function check_admin_notices() {
//		global $errors;
//
//
//	}
//}

//* Time to launch Core
if ( version_compare( $GLOBALS['wp_version'], Lesson::MIN_WP_VERSION, '>' ) ) {
	new Lesson();
}