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
	public function deactivate() {
		global $wpdb;

		/* REMOVE TABLE FROM DATABASE */
		$wpdb->query("DROP TABLE IF EXISTS wp_woo_bet");
	}

}
