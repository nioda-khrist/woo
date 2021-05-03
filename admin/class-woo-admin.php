<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       woo.com
 * @since      1.0.0
 *
 * @package    Woo
 * @subpackage Woo/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo
 * @subpackage Woo/admin
 * @author     woo <woo@gmail.com>
 */
class Woo_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-admin.css', array(), $this->version, 'all' );

		// enqueue style only on specific pages
		$valid_pages = array("ticket-reservation","ticket-list");
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

		if(in_array($page,$valid_pages)){
			wp_enqueue_style( "woo-styles", WOO_PLUGIN_URL . 'assets/css/styling.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// enqueue style only on specific pages
		$valid_pages = array("ticket-reservation","ticket-list");
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";

		if(in_array($page,$valid_pages)){
			// Load jquery and make it dependency
			wp_enqueue_script( "jquery" );
			wp_enqueue_script( "woo-scripts", WOO_PLUGIN_URL . 'assets/js/scripts.js', array( 'jquery' ), $this->version, false );

			// Add some javascript variable inside the page
			wp_localize_script( "jquery", "woo_js", array(
				"ajaxURL" => admin_url("admin-ajax.php"),
			));
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-admin.js', array( 'jquery' ), $this->version, false );

	}

	// Create menu function
	public function ticket_menu(){
		// hook that creates the main menu
		add_menu_page( "Ticket Reservation", "Ticket Reservation", "manage_options", "ticket-reservation", array( $this, "ticket_dashboard" ), "dashicons-cloud-saved", 40 );

		// function that goes to first menu list
		add_submenu_page( "ticket-reservation", "Reservation", "Reservation", "manage_options", "ticket-reservation", array( $this, "ticket_dashboard"));

		// function that creates second menu list
		add_submenu_page( "ticket-reservation", "List", "List", "manage_options", "ticket-list", array($this, "ticket_list"), 5 );
	}

	public function ticket_dashboard(){
		echo "<h4>hello</h4>";
	}

	public function ticket_list(){
		// create a buffer
		ob_start();

		// include the template file
		include_once(WOO_PLUGIN_PATH . "admin/partials/woo-admin-display.php"); // -> store content to buffer

		// read content
		$template = ob_get_contents();

		// end buffer
		ob_end_clean();
		echo $template;
	}

	public function handle_ajax_admin(){

		// handle ajax
		$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : "";

		if(!empty($param)){

			if($param == 'first_ajax'){

				echo json_encode(array(
					"status" => 1,
					"message" => "FIRST AJAX",
					"data" => array(
						"name" => "Joukan"
					)
				));

			}

		}

		wp_die();
	}

}
