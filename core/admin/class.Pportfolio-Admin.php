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

        # add support settings tab
        add_filter( 'bwg_support', array( 'Pportfolio_Admin', 'add_support_settings_tab_portfolio' ) );
        add_action( 'playouts_support_portfolio', array( 'Pportfolio_Admin', 'add_support_settings_tab_content_portfolio' ) );

        # enqueue scripts
        add_action( 'admin_enqueue_scripts', array( 'Pportfolio_Admin', 'enqueue_scripts' ) );

    }

    static function add_support_settings_tab_portfolio( $support_layouts_settings ) {

        $support_layouts_settings['portfolio'] = array( 'label' => __( 'Portfolio', 'peenapo-portfolio-txd-txd' ) );
        return $support_layouts_settings;

    }

    static function add_support_settings_tab_content_portfolio() {

        include PPORTFOLIO_DIR . 'templates/support-settings.php';

    }

    static function enqueue_scripts() {

            # css
    		wp_enqueue_style( 'pportfolio', PPORTFOLIO_URL . 'assets/admin/css/pportfolio.css' );

            # js
            wp_register_script( 'pportfolio', PPORTFOLIO_URL . 'assets/admin/js/pportfolio.js', array(), '1.0', true );
    		wp_localize_script( 'pportfolio', 'pportfolio_data', array(
                'ajax' => admin_url( 'admin-ajax.php' ),
                'i18n' => array(
                    'gallery_welcome' => esc_html__( 'Start uploading your gallery by clicking the button "Edit gallery".', 'peenapo-portfolio-txd' )
                )
            ));
    		wp_enqueue_script( 'pportfolio' );



    }

}

Pportfolio_Admin::init();
