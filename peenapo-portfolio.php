<?php
/*
Plugin Name: Peenapo Portfolio
Plugin URI: https://www.peenapo.com
Description: Peenapo Portfolio is an addon for Peenapo Layouts
Version: 1.0
Author: Peenapo
Text Domain: peenapo-portfolio-txd
License: GNU General Public License v3+
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) ) { exit; } // exit if accessed directly

/*
 * set content directories
 *
 */
if( ! defined( 'PPORTFOLIO_DIR' ) ) { define( 'PPORTFOLIO_DIR', plugin_dir_path( __FILE__ ) ); }
if( ! defined( 'PPORTFOLIO_URL' ) ) { define( 'PPORTFOLIO_URL', plugin_dir_url( __FILE__ ) ); }

/*
 * lets boot this scrap
 *
 */
class Pportfolio_Bootstrap {

	/*
	 * initiates the plugin
	 *
	 */
	static function init() {

		# after active plugins and pluggable functions are loaded
        add_action( 'plugins_loaded', array( 'Pportfolio_Bootstrap', 'components' ) );

		# make the plguin translatable
        add_action( 'init', array( 'Pportfolio_Bootstrap', 'translatable' ) );

    }

	/*
	 * after active plugins and pluggable functions are loaded
	 * we can load the required components
	 *
	 */
    static function components() {

        // check if Peenapo Layouts Plugin is active
        if( ! class_exists('Playouts_Bootstrap') ) { return; }

		include PPORTFOLIO_DIR . 'core/class.Pportfolio-Post-Types.php';
		include PPORTFOLIO_DIR . 'core/class.Pportfolio-Meta-Boxes.php';
		include PPORTFOLIO_DIR . 'core/class.Pportfolio-Element.php';

        if( is_admin() ) {

            include PPORTFOLIO_DIR . 'core/admin/class.Pportfolio-Admin.php';
            include PPORTFOLIO_DIR . 'core/admin/class.Pportfolio-Admin-Ajax.php';
            include PPORTFOLIO_DIR . 'core/admin/class.Pportfolio-Admin-Layouts.php';

        }else{

			include PPORTFOLIO_DIR . 'core/class.Pportfolio-Public.php';

		}

    }

	/*
	 * make the plguin translatable
	 *
	 */
    static function translatable() {

		load_plugin_textdomain( 'peenapo-portfolio-txd', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');

	}

}

Pportfolio_Bootstrap::init();
