<?php namespace WPDevsClub_Lesson_Var_Vars;

class Meta implements I_Meta {

	protected $post_id = 0;

	protected $meta_key = '';

	protected $defaults = array();

	protected $is_single = false;

	protected $_subtitle = '';

	protected $_access = '';

	protected $_tldr = '';

	/**
	 * Instantiate the Meta object
	 *
	 * Notice that we are passing in a $config array to set the initial initialize this object.
	 * In this lesson, I've hardcoded the meta subkeys (i.e. $_subtitle, etc.).  In a real app,
	 * you would want this to be a generic, multi-purpose Meta class to serve ALL meta, which is
	 * why you pass in the $config file.  But for this lesson we are focused on the concepts of
	 * variable variables only and not modularity.
	 *
	 * @since 1.0.0
	 *
	 * @param array $config
	 * @param int $post_id
	 */
	public function __construct( array $config, $post_id = 0 ) {
		$this->init_properties( $config, $post_id );

		$this->get_meta();
	}

	/**
	 * Initialize the instance's properties
	 *
	 * @since 1.0.0
	 *
	 * @param array     $config
	 * @param int       $post_id
	 * @return void
	 */
	protected function init_properties( array $config, $post_id = 0 ) {
		global $post;

		foreach( $config as $property => $value ) {
			if ( property_exists( $this, $property ) ) {
				$this->$property = $value;
			}
		}

		$this->post_id = $post_id > 0 ? $post_id : $post->ID;
	}

	/**
	 * Fill up the instance's properties with the meta data
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function get_meta() {

		//* Go fetch the meta from the database
		$meta = get_post_meta( $this->post_id, $this->meta_key, $this->is_single );

		//* Shift $meta off of the 0 index to get at the actual meta array
		$meta = isset( $meta[0] ) ? $meta[0] : array();

		//* Loop through the meta we expect to receive.  If it's in $meta from the database
		//* store it into the property.  Otherwise, store the default value.
		foreach ( $this->defaults as $sub_key => $default_value ) {
			$this->$sub_key = array_key_exists( $sub_key, $meta )
				? $meta[ $sub_key ]
				: $default_value;
		}
	}

	/**
	 * Generic property get() method
	 *
	 * Notice how we first check if the property exists.  Then if it does, we return
	 * the instance's property value.  Otherwise, the default value is returned.
	 *
	 * @since 1.0.0
	 *
	 * @param string    $property
	 * @param mixed     $default_value
	 * @return mixed
	 */
	public function get( $property, $default_value = null ) {
		return property_exists( $this, $property )
			? $this->$property
			: $default_value;
	}

	/**
	 * Magically Getter
	 *
	 * @since 1.0.0
	 *
	 * @param string    $property
	 * @return mixed
	 */
	public function __get( $property ) {
		return $this->get( $property );
	}
}