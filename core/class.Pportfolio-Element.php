<?php

/*
 * define all the portfolio elements
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly

class Playouts_Element_Portfolio_Grid extends Playouts_Element {

    function init() {

        $this->module = 'bw_portfolio_grid';
        $this->name = esc_html__( 'Portfolio Grid', 'peenapo-portfolio-txd' );
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
            'cols' => array(
                'type'              => 'number_slider',
                'label'             => esc_html__( 'Columns Per Row', 'peenapo-portfolio-txd' ),
				'description'       => esc_html__( 'The number of column per row', 'peenapo-portfolio-txd' ),
                'append_after'      => 'columns',
                'min'               => 2,
                'max'               => 6,
                'step'              => 1,
                'value'             => 3,
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
            ),
            'title_position' => array(
                'label'             => esc_html__( 'Title Position', 'peenapo-portfolio-txd' ),
                'type'              => 'select',
                'options'           => array(
                    'after_image'       => 'After Image',
                    'inside_image'      => 'Inside Image',
                    'none'              => 'None',
                ),
                'value'             => 'after_image',
            ),
            'title_size' => array(
                'type'              => 'number_slider',
                'label'             => esc_html__( 'Title Font Size', 'peenapo-portfolio-txd' ),
                'append_after'      => 'pixels',
                'min'               => 15,
                'max'               => 50,
                'step'              => 1,
                'value'             => 20,
            ),
            'text_alignment' => array(
                'type'              => 'select',
				'label'             => esc_html__( 'Text Alignment', 'peenapo-layouts-txd' ),
                'options'           => array(
                    ''                  => 'Inherit',
                    'left'              => 'Left',
                    'center'            => 'Center',
                    'right'             => 'Right',
                ),
                'value'             => '',
			),
            'enable_overlay' => array(
                'type'              => 'true_false',
                'label'             => esc_html__( 'Enable Overlay', 'peenapo-layouts-txd' ),
            ),
            'overlay_bg_color' => array(
                'type'              => 'colorpicker',
                'label'             => esc_html__( 'Overlay Background Color', 'peenapo-layouts-txd' ),
                'depends'           => array( 'element' => 'enable_overlay', 'value' => '1' ),
            ),
            'enable_category' => array(
                'type'              => 'true_false',
                'label'             => esc_html__( 'Enable Category', 'peenapo-layouts-txd' ),
                'width'             => 50
            ),
            'enable_filter' => array(
                'type'              => 'true_false',
                'label'             => esc_html__( 'Enable Filter', 'peenapo-layouts-txd' ),
                'width'             => 50
            ),
            'filter_alignment' => array(
                'type'              => 'select',
				'label'             => esc_html__( 'Filter Alignment', 'peenapo-layouts-txd' ),
                'options'           => array(
                    'left'              => 'Left',
                    'center'            => 'Center',
                    'right'             => 'Right',
                ),
                'value'             => '',
                'depends'           => array( 'element' => 'enable_filter', 'value' => '1' ),
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
            'cols'              => 3,
            'gaps'              => 0,
            'title_position'    => 'after_image',
            'title_size'        => 20,
            'text_alignment'    => 'inherit',
            'enable_overlay'    => false,
            'overlay_bg_color'  => '',
            'enable_category'   => false,
            'enable_filter'     => false,
            'filter_alignment'  => 'left',
            'inline_class'      => '',
            'inline_id'         => '',
            'inline_css'        => '',
        ), $atts ) );

        $style = $class = $id = $_title = '';

        $class .= ! empty( $inline_class ) ? ' ' . esc_attr( $inline_class ) : '';
        $id .= ! empty( $inline_id ) ? ' id="' . esc_attr( $inline_id ) . '"' : '';
        $style .= ! empty( $inline_css ) ? esc_attr( $inline_css ) : '';

        $style .= ! empty( $text_alignment ) ? 'text-align:' . esc_attr( $text_alignment ) : '';

        if( empty( $categories ) ) { return; }

        $class .= ' pl-portfolio-cols-' . (int) $cols;

        $_args = array(
            'post_type'     => 'playouts_portfolio',
            'tax_query' => array(
                array (
                    'taxonomy' => 'playouts_portfolio_category',
                    'field' => 'term_id',
                    'terms' => explode( ',', esc_attr( $categories ) ),
                )
            )
        );

        $_query = new WP_Query( $_args );

        ob_start();
        if ( $_query->have_posts() ) {

            $options = Playouts_Public::$options;
            $thumb_size = ( isset( $options['portfolio_thumb_grid'] ) and ! empty( $options['portfolio_thumb_grid'] ) ) ? esc_attr( $options['portfolio_thumb_grid'] ) : 'large';
            $_style = '';
            if( $gaps ) {
                $_style .= 'width:calc(100% + ' . (int) $gaps . 'px);';
            }

            if( $enable_filter ) {

                $_filter_style = '';
                if( $filter_alignment ) {
                    $_filter_style .= 'text-align:' . esc_attr( $filter_alignment ) . ';';
                }

                echo '<div class="pl-filter" style="' . $_filter_style . '"><ul>';
                    echo '<li data-filter="*" class="pl-active">' . esc_html__( 'All', 'peenapo-portfolio-txd' ) . '</li>';
                    foreach( explode( ',', $categories ) as $category ) {
                        $cat_obj = get_term( $category, 'playouts_portfolio_category' );
                        echo '<li data-filter=".pl-to-filter-' . $category . '">' . $cat_obj->name . '</li>';
                    }
                echo '</ul></div>';

            }

            echo '<ul class="pl-portfolio" style="' . $_style . '">';

                while ( $_query->have_posts() ) { $_query->the_post();

                    if( $title_position == 'after_image' ) {
                        $_terms_arr = get_the_terms( get_the_ID(), 'playouts_portfolio_category' );
                        $_terms = array();
                        foreach( $_terms_arr as $_t ) {
                            $_terms[] = '<a href="' . get_term_link( $_t ) . '">' . $_t->name . '</a>';
                        }
                        $_title = '<div class="pl-portfolio-item-content">'.
                            '<h4><a href="' . get_permalink() . '" style="font-size:' . (int) $title_size . 'px;">' . get_the_title() . '</a></h4>'.
                            ( $enable_category ? '<span>' . implode( ', ', $_terms ) . '</span>' : '' ) .
                        '</div>';
                    }elseif( $title_position == 'inside_image' ) {
                        $_terms_arr = get_the_terms( get_the_ID(), 'playouts_portfolio_category' );
                        $_terms = array();
                        foreach( $_terms_arr as $_t ) {
                            $_terms[] = '<span>' . $_t->name . '</span>';
                        }
                        $_title = '<div class="pl-table">'.
                            '<div class="pl-cell">'.
                                '<div class="pl-portfolio-item-content">'.
                                    '<h4 style="font-size:' . (int) $title_size . 'px;">' . get_the_title() . '</h4>'.
                                    ( $enable_category ? '<span>' . implode( ', ', $_terms ) . '</span>' : '' ) .
                                '</div>'.
                            '</div>'.
                        '</div>';
                    }

                    include PPORTFOLIO_DIR . 'templates/item-grid.php';

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
new Playouts_Element_Portfolio_Grid;
