<?php namespace WPDevsClub_Lesson_Var_Vars;

interface I_Meta {

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
	public function get( $property, $default_value = null );
}