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

		/* select if page name is already exist */
		$create_post = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT ID from " . $wpdb->prefix . "posts WHERE post_name = %s", 'ticket_reservation'
			)
		);

		// delete page with the selected page ID
		$pg_id = $create_post->ID;
		if($pg_id>0){
			wp_delete_post( $pg_id, true );
		}
	}

}
