<?php

/**
 * Fired during plugin activation
 *
 * @link       woo.com
 * @since      1.0.0
 *
 * @package    Woo
 * @subpackage Woo/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woo
 * @subpackage Woo/includes
 * @author     woo <woo@gmail.com>
 */
class Woo_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function activate() {
		global $wpdb;

		/* CREATE NEW TABLE */
		if($wpdb->get_var("SHOW tables like '" . $this->wp_woo_bet() . "'") != $this->wp_woo_bet()){
			$table_query="CREATE TABLE IF NOT EXISTS `" . $this->wp_woo_bet() . "` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(150) NOT NULL,
				`price` int(11) NOT NULL,
				`status` int(11) NOT NULL DEFAULT '1',
				`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=latin1";

			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			dbDelta($table_query);

			/* INSERT DATA FROM DATABASE */
			$insert_query = "INSERT into " . $this->wp_woo_bet() . "(name, price, status) VALUES ('Item 1', 240, 1), ('Item 2', 245, 1)";
			$wpdb->query($insert_query);
		}

		/* select if page name is already exist */
		$create_post = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * from " . $wpdb->prefix . "posts WHERE post_name = %s", 'ticket_reservation'
			)
		);

		// check if page name already exist
		if(!empty($create_post)){

		}else{
			$post_arr_data = array(
				"post_title" => "Ticket Reservation",
				"post_name" => "ticket_reservation",
				"post_status" => "publish",
				"post_author" => get_current_user_id(),
				"post_content" => "Simple page",
				"post_type" => "page"
			);

			// insert post using array data
			wp_insert_post( $post_arr_data );
		}
	}

	// create a name so we don't have to replicate each name
	public function wp_woo_bet(){
		global $wpdb;
		return $wpdb->prefix."woo_bet"; //prefix in the database
	}

}
