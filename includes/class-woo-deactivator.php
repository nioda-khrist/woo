<?php

/**
 * Fired during plugin deactivation
 *
 * @link       woo.com
 * @since      1.0.0
 *
 * @package    Woo
 * @subpackage Woo/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Woo
 * @subpackage Woo/includes
 * @author     woo <woo@gmail.com>
 */
class Woo_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	// create a variable to hold the parameter
	private $table_activator;

	// create a constructor to accept child or parameters
	public function __construct($activator){
		$this->$table_activator = $activator;
	}

	public function deactivate() {
		global $wpdb;

		/* REMOVE TABLE FROM DATABASE */
		$wpdb->query("DROP TABLE IF EXISTS " . $this->$table_activator->wp_woo_bet());
	}

}
