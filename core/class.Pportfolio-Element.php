<?php

/*
 * define all the portfolio elements
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly

class Playouts_Element_Portfolio extends Playouts_Element {

    function init() {

        $this->module = 'bw_portfolio';
        $this->name = esc_html__( 'Portfolio', 'peenapo-layouts-txd' );
        $this->view = 'element';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-layouts-txd' ) );
        $this->module_color = '#4d49ee';
        $this->params = array(
            'text_color' => array(
                'type'              => 'colorpicker',
                'label'             => esc_html__( 'Text Color', 'peenapo-layouts-txd' ),
                'value'             => '',
            ),
            'inline_class' => array(
                'type'              => 'textfield',
                'label'             => esc_html__( 'CSS Classes', 'peenapo-layouts-txd' ),
                'tab'               => array( 'inline' => esc_html__( 'Inline', 'peenapo-layouts-txd' ) ),
            ),
            'inline_id' => array(
                'type'              => 'textfield',
                'label'             => esc_html__( 'Element ID', 'peenapo-layouts-txd' ),
                'tab'               => array( 'inline' => esc_html__( 'Inline', 'peenapo-layouts-txd' ) ),
            ),
            'inline_css' => array(
                'type'              => 'textarea',
                'label'             => esc_html__( 'Inline CSS', 'peenapo-layouts-txd' ),
                'tab'               => array( 'inline' => esc_html__( 'Inline', 'peenapo-layouts-txd' ) ),
            ),
        );

    }

    static function output( $atts = array(), $content = null ) {

        extract( $assigned_atts = shortcode_atts( array(
            'text_color'        => '',
            'inline_class'      => '',
            'inline_id'         => '',
            'inline_css'        => '',
        ), $atts ) );

        $style = $class = $id = '';

        $class .= ! empty( $inline_class ) ? ' ' . esc_attr( $inline_class ) : '';
        $id .= ! empty( $inline_id ) ? ' id="' . esc_attr( $inline_id ) . '"' : '';
        $style .= ! empty( $inline_css ) ? esc_attr( $inline_css ) : '';

        $_args = array(
            'post_type' => 'playouts_portfolio',
        );

        $_query = new WP_Query( $_args );

        ob_start();
        if ( $_query->have_posts() ) {

            $options = Playouts_Public::$options;
            $thumb_size = ( isset( $options['portfolio_thumb_grid'] ) and ! empty( $options['portfolio_thumb_grid'] ) ) ? esc_attr( $options['portfolio_thumb_grid'] ) : 'large'; 

            echo '<ul class="pl-portfolio">';

                while ( $_query->have_posts() ) { $_query->the_post();
                    include PPORTFOLIO_DIR . 'templates/portfolio-item.php';
                }

            echo '<ul>';

            wp_reset_postdata();

        }else{
            // no posts found
        }

        return '<div class="pl-portfolio-outer' . $class . '" style="' . $style . '"' . $id . '>'.
            ob_get_clean() .
        '</div>';

    }
}
new Playouts_Element_Portfolio;
