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
		}
	}

	public function wp_woo_bet(){
		global $wpdb;
		return $wpdb->prefix."woo_bet";
	}

}
