<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This is the main class that is responsible for registering
 * the core functions, including the files and setting up all features. 
 * 
 * To add a new class, here's what you need to do: 
 * 1. Add your new class within the following folder: core/includes/classes
 * 2. Create a new variable you want to assign the class to (as e.g. public $helpers)
 * 3. Assign the class within the instance() function ( as e.g. self::$instance->helpers = new Rental_Directory_For_Casperlet_Helpers();)
 * 4. Register the class you added to core/includes/classes within the includes() function
 * 
 * HELPER COMMENT END
 */

if ( ! class_exists( 'Rental_Directory_For_Casperlet' ) ) :

	/**
	 * Main Rental_Directory_For_Casperlet Class.
	 *
	 * @package		RRCLET
	 * @subpackage	Classes/Rental_Directory_For_Casperlet
	 * @since		1.0.0
	 * @author		Nolan Perry
	 */
	final class Rental_Directory_For_Casperlet {

		/**
		 * The real instance
		 *
		 * @access	private
		 * @since	1.0.0
		 * @var		object|Rental_Directory_For_Casperlet
		 */
		private static $instance;

		/**
		 * RRCLET helpers object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Rental_Directory_For_Casperlet_Helpers
		 */
		public $helpers;

		/**
		 * RRCLET settings object.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @var		object|Rental_Directory_For_Casperlet_Settings
		 */
		public $settings;
		public $options;

		/**
		 * Throw error on object clone.
		 *
		 * Cloning instances of the class is forbidden.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to clone this class.', 'rental-directory-for-casperlet' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @access	public
		 * @since	1.0.0
		 * @return	void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'You are not allowed to unserialize this class.', 'rental-directory-for-casperlet' ), '1.0.0' );
		}

		/**
		 * Main Rental_Directory_For_Casperlet Instance.
		 *
		 * Insures that only one instance of Rental_Directory_For_Casperlet exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @access		public
		 * @since		1.0.0
		 * @static
		 * @return		object|Rental_Directory_For_Casperlet	The one true Rental_Directory_For_Casperlet
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Rental_Directory_For_Casperlet ) ) {
				self::$instance					= new Rental_Directory_For_Casperlet;
				self::$instance->base_hooks();
				self::$instance->includes();
				self::$instance->helpers		= new Rental_Directory_For_Casperlet_Helpers();
				self::$instance->settings		= new Rental_Directory_For_Casperlet_Settings();
                self::$instance->options		= new RRCLET_Options();
				//Fire the plugin logic
				new Rental_Directory_For_Casperlet_Run();

				/**
				 * Fire a custom action to allow dependencies
				 * after the successful plugin setup
				 */
				do_action( 'RRCLET/plugin_loaded' );
			}
	self::$instance->options->RRCLET_register_stuff();
	new RR_CLET_Shortcodes_Rentals();
			return self::$instance;
		}

		/**
		 * Include required files.
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function includes() {
			require_once RRCLET_PLUGIN_DIR . 'core/includes/classes/class-rental-directory-for-casperlet-helpers.php';
			require_once RRCLET_PLUGIN_DIR . 'core/includes/classes/class-rental-directory-for-casperlet-settings.php';

			require_once RRCLET_PLUGIN_DIR . 'core/includes/classes/class-rental-directory-for-casperlet-run.php';
			require_once RRCLET_PLUGIN_DIR . 'core/includes/classes/class-RRCLET-options.php';
			require_once RRCLET_PLUGIN_DIR . 'core/includes/classes/class-RRCLET-shortcode-rentals.php';
		}

		/**
		 * Add base hooks for the core functionality
		 *
		 * @access  private
		 * @since   1.0.0
		 * @return  void
		 */
		private function base_hooks() {
			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access  public
		 * @since   1.0.0
		 * @return  void
		 */
		public function load_textdomain() {
			load_plugin_textdomain( 'rental-directory-for-casperlet', FALSE, dirname( plugin_basename( RRCLET_PLUGIN_FILE ) ) . '/languages/' );
		}

	}

endif; // End if class_exists check.