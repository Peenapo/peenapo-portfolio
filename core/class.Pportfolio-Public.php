<?php

/*
 * define the public part
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly

class Pportfolio_Public {

    /*
	 * start here
	 *
	 */
	static function init() {

        // filter the single_template with our custom template
        add_filter( 'single_template', array( 'Pportfolio_Public', 'portfolio_template' ) );
        add_action( 'pportfolio_template_portfolio', array( 'Pportfolio_Public', 'portfolio_output' ) );

        # enqueue scripts
        add_action( 'wp_enqueue_scripts', array( 'Pportfolio_Public', 'enqueue_scripts' ) );

    }

    static function portfolio_template( $single_template ) {

        global $post;

        // checks for single template by post type
        if ( $post->post_type == 'playouts_portfolio' ) {
            // check for theme template
            if( ! locate_template( 'single-playouts_portfolio.php' ) ) {
                $single_template = PPORTFOLIO_DIR . 'templates/single-playouts_portfolio.php';
            }
        }
        return $single_template;
    }

    static function portfolio_output() {

        include PPORTFOLIO_DIR . 'templates/portfolio-content.php';

    }

    static function enqueue_scripts() {

        if( ( is_single() and get_post_type() == 'playouts_portfolio' ) or Playouts_Public::is_builder_used() ) {

            # css
            wp_enqueue_style( 'pportfolio-style', PPORTFOLIO_URL . 'assets/css/pportfolio.css' );

            # js
            wp_enqueue_script( 'jquery' );

            # dynamic enqueue
            if( in_array( 'bw_portfolio_grid', Playouts_Public::$parsed_ids ) ) {
                wp_enqueue_script( 'bw-isotope', PPORTFOLIO_URL . 'assets/js/vendor/isotope.pkgd.min.js', array( 'jquery', 'playouts-front-plugins' ), '1.0', true );
            }

            wp_enqueue_script( 'pportfolio-main', PPORTFOLIO_URL . 'assets/js/pportfolio.js', array( 'jquery', 'playouts-front-plugins' ), '1.0', true );


        }

    }

}

Pportfolio_Public::init();
