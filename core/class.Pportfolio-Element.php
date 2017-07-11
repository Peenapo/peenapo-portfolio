<?php

/*
 * define all the portfolio elements
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly

class Playouts_Element_Portfolio extends Playouts_Element {

    function init() {

        $this->module = 'bw_portfolio';
        $this->name = esc_html__( 'Portfolio', 'peenapo-portfolio-txd' );
        $this->view = 'element';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-portfolio-txd' ) );
        $this->module_color = '#4d49ee';
        $this->params = array(
            'categories' => array(
                'label'             => esc_html__( 'Select Categories', 'peenapo-portfolio-txd' ),
                'type'              => 'taxonomy',
                'taxonomy'          => 'playouts_portfolio_category',
                'multiple'          => true,
            ),
            'layout' => array(
                'label'             => esc_html__( 'Layout', 'peenapo-portfolio-txd' ),
                'type'              => 'select',
                'options'           => array(
                    'grid'          => 'Grid',
                ),
                'value'             => 'grid'
            ),
            'cols' => array(
                'type'              => 'number_slider',
                'label'             => esc_html__( 'Columns Per Row', 'peenapo-portfolio-txd' ),
				'description'       => esc_html__( 'The number of column per row', 'peenapo-portfolio-txd' ),
                'append_after'      => 'columns',
                'min'               => 2,
                'max'               => 6,
                'step'              => 1,
                'value'             => 3,
                'depends'           => array( 'element' => 'layout', 'value' => array( 'grid' ) ),
            ),
            'gaps' => array(
                'type'              => 'number_slider',
                'label'             => esc_html__( 'Gaps', 'peenapo-portfolio-txd' ),
				'description'       => esc_html__( 'Spacing between grid items in pixels', 'peenapo-portfolio-txd' ),
                'append_after'      => 'pixels',
                'min'               => 0,
                'max'               => 200,
                'step'              => 1,
                'value'             => 40,
                'depends'           => array( 'element' => 'layout', 'value' => array( 'grid' ) ),
            ),
            'inline_class' => array(
                'type'              => 'textfield',
                'label'             => esc_html__( 'CSS Classes', 'peenapo-portfolio-txd' ),
                'tab'               => array( 'inline' => esc_html__( 'Inline', 'peenapo-portfolio-txd' ) ),
            ),
            'inline_id' => array(
                'type'              => 'textfield',
                'label'             => esc_html__( 'Element ID', 'peenapo-portfolio-txd' ),
                'tab'               => array( 'inline' => esc_html__( 'Inline', 'peenapo-portfolio-txd' ) ),
            ),
            'inline_css' => array(
                'type'              => 'textarea',
                'label'             => esc_html__( 'Inline CSS', 'peenapo-portfolio-txd' ),
                'tab'               => array( 'inline' => esc_html__( 'Inline', 'peenapo-portfolio-txd' ) ),
            ),
        );

    }

    static function output( $atts = array(), $content = null ) {

        extract( $assigned_atts = shortcode_atts( array(
            'categories'        => '',
            'layout'            => 'grid',

            'cols'              => 3,
            'gaps'              => 0,

            'inline_class'      => '',
            'inline_id'         => '',
            'inline_css'        => '',
        ), $atts ) );

        $style = $class = $id = '';

        $class .= ! empty( $inline_class ) ? ' ' . esc_attr( $inline_class ) : '';
        $id .= ! empty( $inline_id ) ? ' id="' . esc_attr( $inline_id ) . '"' : '';
        $style .= ! empty( $inline_css ) ? esc_attr( $inline_css ) : '';

        if( empty( $categories ) ) { return; }

        $class .= ' pl-portfolio-layout-' . esc_attr( $layout );

        switch( $layout ) {
            case 'grid':
                $class .= ' pl-portfolio-cols-' . (int) $cols;
                if( $gaps ) {
                    $style .= 'width:calc(100% + ' . (int) $gaps . 'px);';
                }
                break;
        }


        $_args = array(
            'post_type'     => 'playouts_portfolio',
            'tax_query' => array(
                array (
                    'taxonomy' => 'playouts_portfolio_category',
                    'field' => 'term_id',
                    'terms' => esc_attr( $categories ),
                )
            )
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
