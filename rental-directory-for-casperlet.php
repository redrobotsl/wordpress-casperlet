<?php
/**
 * Rental Directory for CasperLet
 *
 * @package       RRCLET
 * @author        Nolan Perry
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Rental Directory for CasperLet
 * Plugin URI:    https://darknebula.world
 * Description:   Shows CasperLet Rentals
 * Version:       1.0.0
 * Author:        Nolan Perry, LLC
 * Author URI:    https://darknebula.world
 * Text Domain:   rental-directory-for-casperlet
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with Rental Directory for CasperLet. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function RRCLET() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'RRCLET_NAME',			'Rental Directory for CasperLet' );

// Plugin version
define( 'RRCLET_VERSION',		'1.0.0' );

// Plugin Root File
define( 'RRCLET_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'RRCLET_PLUGIN_BASE',	plugin_basename( RRCLET_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'RRCLET_PLUGIN_DIR',	plugin_dir_path( RRCLET_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'RRCLET_PLUGIN_URL',	plugin_dir_url( RRCLET_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once RRCLET_PLUGIN_DIR . 'core/class-rental-directory-for-casperlet.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Nolan Perry
 * @since   1.0.0
 * @return  object|Rental_Directory_For_Casperlet
 */
function RRCLET() {
	return Rental_Directory_For_Casperlet::instance();
}

RRCLET();
