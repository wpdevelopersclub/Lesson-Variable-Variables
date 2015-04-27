<?php namespace WPDevsClub_Lesson_Var_Vars;

/**
 * Lesson Variable Variables
 *
 * @category   Lesson - Variable Variables & Variable Functions in WordPress
 * @package    Lesson
 * @since      1.0.3
 * @author     Tonya <hello@wpdevelopersclub.com>
 * @link       http://wpdevelopersclub.com/
 *
 * @license dual GNU General Public License 2.0+
 *
 * ------------------------------------------------------------------------
 * Copyright (c) wpdevelopersclub.com
 * ------------------------------------------------------------------------
 */

//* Oh no you don't. Exit if accessed directly
defined( 'ABSPATH' ) OR exit( 'Cheatin&#8217; uh?' );

class Lesson {

	/**
	 * The plugin's version
	 *
	 * @var string
	 */
	const VERSION = '1.0.0';

	/**
	 * The plugin's minimum WordPress requirement
	 *
	 * @var string
	 */
	const MIN_WP_VERSION = '3.2';

	/*************************
	 * Getters
	 ************************/

	public function version() {
		return self::VERSION;
	}

	public function min_wp_version() {
		return self::MIN_WP_VERSION;
	}

	/**
	 * Vanilla getter
	 *
	 * @since  1.0.0
	 *
	 * @param string    $property_name
	 * @return mixed
	 */
	public function __get( $property_name ) {
		return property_exists( $this, $property_name )
			? $this->$property_name
			: null;
	}

	/*************************
	 * Instantiate & Init
	 ************************/

	/**
	 * Instantiate the plugin
	 *
	 * @since 1.0.0
	 *
	 * @return self
	 */
	public function __construct() {
		$this->init_hooks();
	}

	/**
	 * Init the hooks for actions and filters
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	protected function init_hooks() {
		if ( ! is_admin() ) {
//			add_action( 'init', array( $this, 'lesson1' ) );

			add_action( 'init', array( $this, 'lesson2' ) );
		}
	}

	/*******************************************
	 * Lesson 1 -
	 * variable variables processing $config, $meta, and via get()
	 ******************************************/

	public function lesson1() {
		$config = include( trailingslashit( __DIR__ ) . 'lib/config/meta.php' );

		$meta = new Meta( $config, 1 );

		var_dump( $meta );

		var_dump( $meta->get( '_subtitle' ) );
	}

	/*******************************************
	 * Lesson 2 -
	 * variable variables processing $config, $meta, and via get()
	 ******************************************/

	public function lesson2() {

		$path = trailingslashit( __DIR__ );

		$objects = include( $path . 'lib/config/objects.php' );

		foreach ( $objects as $object => $objects_config ) {

			$config = include( $path . $objects_config['config'] );

			$meta = new $objects_config['classname']( $config, 1 );

			var_dump( $meta );

			var_dump( $meta->get( '_subtitle' ) );
		}
	}
}