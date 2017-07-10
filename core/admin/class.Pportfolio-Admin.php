<?php

/*
 * main admin class to initiate the plugin
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly

class Pportfolio_Admin {

    /*
	 * initiates the admin functions
	 *
	 */
	static function init() {

        # enqueue scripts
        add_action( 'admin_enqueue_scripts', array( 'Pportfolio_Admin', 'enqueue_scripts' ) );

    }

    static function enqueue_scripts() {

            # css
    		wp_enqueue_style( 'pportfolio', PPORTFOLIO_URL . 'assets/admin/css/pportfolio.css' );

            # js
            wp_register_script( 'pportfolio', PPORTFOLIO_URL . 'assets/admin/js/pportfolio.js', array(), '1.0', true );
    		wp_localize_script( 'pportfolio', 'pportfolio_data', array(
                'ajax' => admin_url( 'admin-ajax.php' )
            ));
    		wp_enqueue_script( 'pportfolio' );



    }

}

Pportfolio_Admin::init();
