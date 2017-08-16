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

        if( empty( $categories ) ) {
            return '<p class="pl-label-alert">' . esc_html__( 'Category can\'t be empty. Edit the portfolio element and select a category.', '' ) . '</p>';
        }

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
            //$thumb_size = ( isset( $options['portfolio_thumb_grid'] ) and ! empty( $options['portfolio_thumb_grid'] ) ) ? esc_attr( $options['portfolio_thumb_grid'] ) : 'large';
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
            echo '<p class="pl-label-alert">' . esc_html__( 'No projects found. Add some by going to "Projects > Add New".', '' ) . '</p>';
        }

        return '<div class="pl-portfolio-outer' . $class . '" style="' . $style . '"' . $id . '>'.
            ob_get_clean() .
        '</div>';

    }
}
new Playouts_Element_Portfolio_Grid;

class Playouts_Element_Carousel extends Playouts_Repeater_Element {

    static $index = 0;
    static $title_font_size = 60;
    static $sub_title_font_size = 17;

    function init() {

        $this->module = 'bw_carousel';
        $this->module_item = 'bw_carousel_item';
        $this->name = esc_html__( 'Portfolio Carousel', 'peenapo-layouts-txd' );
        $this->view = 'repeater';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-portfolio-txd' ) );
        $this->module_color = '#4d49ee';
        $this->params = array(
            'items' => array(
                'type'               => 'repeater',
                'label'              => esc_html__( 'Carousel slides', 'peenapo-layouts-txd' ),
                'description'        => esc_html__( 'You can add as many slides as you need, just click the plus icon.', 'peenapo-layouts-txd' ),
            ),
            'title_font_size' => array(
                'type'              => 'number_slider',
                'label'             => esc_html__( 'Title Font Size', 'peenapo-portfolio-txd' ),
                'append_after'      => 'pixels',
                'min'               => 20,
                'max'               => 150,
                'step'              => 1,
                'value'             => 60,
            ),
            'sub_title_font_size' => array(
                'type'              => 'number_slider',
                'label'             => esc_html__( 'Sub Title Font Size', 'peenapo-portfolio-txd' ),
                'append_after'      => 'pixels',
                'min'               => 15,
                'max'               => 50,
                'step'              => 1,
                'value'             => 17,
            ),
            'autoplay' => array(
                'type'              => 'true_false',
                'label'             => esc_html__( 'Enable Slider Autoplay', 'peenapo-layouts-txd' ),
			),
            'autoplay_interval' => array(
                'type'              => 'number_slider',
                'label'             => esc_html__( 'Autoplay Interval.', 'peenapo-portfolio-txd' ),
				'description'       => esc_html__( '1000 ms = 1 second.', 'peenapo-portfolio-txd' ),
                'append_after'      => 'Milliseconds',
                'min'               => 2000,
                'max'               => 10000,
                'step'              => 100,
                'value'             => 4000,
                'depends'           => array( 'element' => 'autoplay', 'value' => '1' ),
            ),
            'enable_down' => array(
                'type'              => 'true_false',
                'label'             => esc_html__( 'Enable Scroll Down Button', 'peenapo-layouts-txd' ),
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

    static function construct( $atts = array(), $content = null ) {

        self::$title_font_size = ( isset( $atts['title_font_size'] ) and ! empty( $atts['title_font_size'] ) ) ? (int) $atts['title_font_size'] : 60;
        self::$sub_title_font_size = ( isset( $atts['sub_title_font_size'] ) and ! empty( $atts['sub_title_font_size'] ) ) ? (int) $atts['sub_title_font_size'] : 17;

    }

    static function output( $atts = array(), $content = null ) {

        extract( $assigned_atts = shortcode_atts( array(
            'title_font_size'   => 60,
            'sub_title_font_size' => 17,
            'autoplay'          => false,
            'autoplay_interval' => 4000,
            'enable_down'       => false,
            'inline_class'      => '',
            'inline_id'         => '',
            'inline_css'        => '',
        ), $atts ) );

        $style = $class = $id = $attr = '';

        $class .= ! empty( $inline_class ) ? ' ' . esc_attr( $inline_class ) : '';
        $id .= ! empty( $inline_id ) ? ' id="' . esc_attr( $inline_id ) . '"' : '';
        $style .= ! empty( $inline_css ) ? esc_attr( $inline_css ) : '';

        self::$index = 0;

        ob_start();

        if( $autoplay ) { $attr .= ' data-autoplay="' . (int) $autoplay_interval . '"]'; }

        echo '<div class="pl-carousel' . $class . '" style="' . $style . '"' . $id . $attr . '>';
            echo $content;
            echo '<a href="#" class="pl-carousel-nav pl-carousel-nav-prev"><i class="pl-7s-angle-left"></i></a>';
            echo '<a href="#" class="pl-carousel-nav pl-carousel-nav-next"><i class="pl-7s-angle-right"></i></a>';
            echo ( $enable_down ? '<span class="bw-carousel-down"></span>' : '' );
        echo '</div>';

        return ob_get_clean();

    }
}
new Playouts_Element_Carousel;

class Playouts_Element_Carousel_Item extends Playouts_Repeater_Item_Element {

    function init() {

        $this->module = 'bw_carousel_item';
        $this->module_parent = 'bw_carousel';
        $this->name = esc_html__( 'Carousel Slide', 'peenapo-layouts-txd' );
        $this->view = 'repeater_item';

        $this->params = array(
            'title' => array(
                'type'               => 'textfield',
				'label'              => esc_html__( 'Title', 'peenapo-layouts-txd' ),
				'value'              => esc_html__( 'Slide title', 'peenapo-layouts-txd' ),
			),
            'top_title' => array(
                'type'               => 'textfield',
				'label'              => esc_html__( 'Top-Title', 'peenapo-layouts-txd' ),
			),
            'sub_title' => array(
                'type'               => 'textfield',
				'label'              => esc_html__( 'Sub-Title', 'peenapo-layouts-txd' ),
			),
            'position' => array(
                'type'              => 'select',
				'label'             => esc_html__( 'Text Position', 'peenapo-layouts-txd' ),
				'description'       => esc_html__( 'Select the position of the slide text content', 'peenapo-layouts-txd' ),
				'options'           => array(
                    'top_left'      => 'Top Left',
                    'top_middle'    => 'Top Middle',
                    'top_right'     => 'Top Right',
                    'center_left'   => 'Center Left',
                    'center_middle' => 'Center Middle',
                    'center_right'  => 'Center Right',
                    'bottom_left'   => 'Bottom Left',
                    'bottom_middle' => 'Bottom Middle',
                    'bottom_right'  => 'Bottom Right',
                ),
                'value'             => 'center_middle'
			),
            'image' => array(
                'type'              => 'image',
                'label'             => esc_html__( 'Background Image', 'peenapo-layouts-txd' ),
            ),
            'url' => array(
				'label'              => esc_html__( 'Link', 'peenapo-layouts-txd' ),
				'type'               => 'textfield',
				'placeholder'        => 'http://',
			),
            'color' => array(
				'label'              => esc_html__( 'Text Color', 'peenapo-layouts-txd' ),
				'type'               => 'colorpicker',
                'width'              => 50
			),
            'sub_color' => array(
				'label'              => esc_html__( 'Sub Text Color', 'peenapo-layouts-txd' ),
				'type'               => 'colorpicker',
                'width'              => 50
			),
            'switch_header' => array(
                'type'              => 'true_false',
                'label'             => esc_html__( 'Switch Header Color', 'peenapo-layouts-txd' ),
				'description'       => esc_html__( 'Enable this options if you need to change the color of the header for specific slider. Note: the theme you are using should support this feature.', 'peenapo-layouts-txd' ),
            ),
            'switch_header_type' => array(
                'type'              => 'select',
				'label'             => esc_html__( 'Header Color Type', 'peenapo-layouts-txd' ),
				'description'       => esc_html__( 'Select the type of header you want for this specific slide', 'peenapo-layouts-txd' ),
				'options'           => array(
                    'light'         => 'Light Color ( White )',
                    'dark'          => 'Dark Color ( Black )',
                ),
                'value'             => 'light',
                'depends'           => array( 'element' => 'switch_header', 'value' => '1' ),
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

    static function construct( $atts = array(), $content = null ) {

        Playouts_Element_Carousel::$index += 1;

    }

    static function output( $atts = array(), $content = null ) {

        extract( $assigned_atts = shortcode_atts( array(
            'title'             => '',
            'top_title'         => '',
            'sub_title'         => '',
            'position'          => 'center_middle',
            'image'             => '',
            'url'               => '',
            'color'             => '',
            'switch_header'     => false,
            'switch_header_type' => 'light',
            'sub_color'         => '',
            'inline_class'      => '',
            'inline_id'         => '',
            'inline_css'        => '',
        ), $atts ) );

        $style = $class = $id = '';

        $class .= ! empty( $inline_class ) ? ' ' . esc_attr( $inline_class ) : '';
        $id .= ! empty( $inline_id ) ? ' id="' . esc_attr( $inline_id ) . '"' : '';
        $style .= ! empty( $inline_css ) ? esc_attr( $inline_css ) : '';

        if( $color ) { $style .= 'color:' . esc_attr( $color ) . ';'; }

        ob_start();

        if( $switch_header ) {
            $class .= ' pl-call-header-' . esc_attr( $switch_header_type );
        }

        $title_font_size = Playouts_Element_Carousel::$title_font_size;
        $sub_title_font_size = Playouts_Element_Carousel::$sub_title_font_size;

        echo '<article class="pl-carousel-slide' . $class . '" style="' . ( Playouts_Element_Carousel::$index == 1 ? 'z-index:1;' : '' ) . $style . '"' . $id . '>';

            if( $image ) {
                echo '<figure class="featured-image" style="background-image:url(' . esc_url( $image ) . ');"></figure>';
            }

            switch( $position ) {
                case 'top_left':        $style .= 'vertical-align:top;text-align:left;'; break;
                case 'top_middle':      $style .= 'vertical-align:top;text-align:center;'; break;
                case 'top_right':       $style .= 'vertical-align:top;text-align:right;'; break;
                case 'center_left':     $style .= 'vertical-align:middle;text-align:left;'; break;
                case 'center_middle':   $style .= 'vertical-align:middle;text-align:center;'; break;
                case 'center_right':    $style .= 'vertical-align:middle;text-align:right;'; break;
                case 'bottom_left':     $style .= 'vertical-align:bottom;text-align:left;'; break;
                case 'bottom_middle':   $style .= 'vertical-align:bottom;text-align:center;'; break;
                case 'bottom_right':    $style .= 'vertical-align:bottom;text-align:right;'; break;
            }

            echo '<div class="pl-carousel-text pl-table">';
                echo '<div class="pl-cell" style="' . $style . '">';
                    echo '<' . ( $url ? 'a href="' . esc_url( $url ) . '"' : 'div' ) . '>';
                        echo '<p class="pl-carousel-top-title" style="' . ( $sub_color ? 'color:' . esc_attr( $sub_color ) . ';' : '' ) . 'font-size:' . $sub_title_font_size . 'px;">' . esc_attr( $top_title ) . '</p>';
                        echo '<h2 class="pl-carousel-title" style="font-size:' . $title_font_size . 'px;">' . esc_attr( $title ) . '</h2>';
                        echo ( $sub_title ? '<p class="pl-carousel-sub-title">' . wp_kses_data( $sub_title ) . '</p>' : '' );
                    echo '</' . ( $url ? 'a' : 'div' ) . '>';
                echo '</div>';
            echo '</div>';

        echo '</article>';

        return ob_get_clean();

    }
}
new Playouts_Element_Carousel_Item;

/*class Playouts_Element_Rail_Slider extends Playouts_Repeater_Element {

    static $index = 0;

    function init() {

        $this->module = 'bw_rail_slider';
        $this->module_item = 'bw_rail_slider_item';
        $this->name = esc_html__( 'Rail Slider', 'peenapo-layouts-txd' );
        $this->view = 'repeater';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-portfolio-txd' ) );
        $this->module_color = '#4d49ee';
        $this->params = array(
            'items' => array(
                'type'               => 'repeater',
                'label'              => esc_html__( 'Rail Slider Items', 'peenapo-layouts-txd' ),
                'description'        => esc_html__( 'You can add as many items as you need, just click the plus icon.', 'peenapo-layouts-txd' ),
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

    static function construct( $atts = array(), $content = null ) {}

    static function output( $atts = array(), $content = null ) {

        extract( $assigned_atts = shortcode_atts( array(
            'inline_class'      => '',
            'inline_id'         => '',
            'inline_css'        => '',
        ), $atts ) );

        $style = $class = $id = $attr = '';

        $class .= ! empty( $inline_class ) ? ' ' . esc_attr( $inline_class ) : '';
        $id .= ! empty( $inline_id ) ? ' id="' . esc_attr( $inline_id ) . '"' : '';
        $style .= ! empty( $inline_css ) ? esc_attr( $inline_css ) : '';

        self::$index = 0;

        ob_start();

        echo '<div class="pl-rail-slider' . $class . '" style="' . $style . '"' . $id . $attr . '>';
            echo '<div class="pl-rail-slider-inner pl-no-select">';
                echo $content;
            echo '</div>';
        echo '</div>';

        return ob_get_clean();

    }
}
new Playouts_Element_Rail_Slider;

class Playouts_Element_Rail_Slider_Item extends Playouts_Repeater_Item_Element {

    function init() {

        $this->module = 'bw_rail_slider_item';
        $this->module_parent = 'bw_rail_slider';
        $this->name = esc_html__( 'Rail Slider Item', 'peenapo-layouts-txd' );
        $this->view = 'repeater_item';

        $this->params = array(
            'image' => array(
                'type'              => 'image',
                'label'             => esc_html__( 'Background Image', 'peenapo-layouts-txd' ),
            ),
            'title' => array(
                'type'               => 'textfield',
				'label'              => esc_html__( 'Rail slider title', 'peenapo-layouts-txd' ),
				'value'              => esc_html__( 'Slide title', 'peenapo-layouts-txd' ),
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

    static function construct( $atts = array(), $content = null ) {

        Playouts_Element_Carousel::$index += 1;

    }

    static function output( $atts = array(), $content = null ) {

        extract( $assigned_atts = shortcode_atts( array(
            'title'             => '',
            'image'             => '',
            'inline_class'      => '',
            'inline_id'         => '',
            'inline_css'        => '',
        ), $atts ) );

        $style = $class = $id = $attr = '';

        $class .= ! empty( $inline_class ) ? ' ' . esc_attr( $inline_class ) : '';
        $id .= ! empty( $inline_id ) ? ' id="' . esc_attr( $inline_id ) . '"' : '';
        $style .= ! empty( $inline_css ) ? esc_attr( $inline_css ) : '';

        $attr .= ' data-item="' . (int) Playouts_Element_Carousel::$index . '"';

        $image_id = Playouts_Functions::get_image_id_from_url( $image );
        $_image = wp_get_attachment_image_src( $image_id, 'large' );
        $attr .= ' data-image="' . esc_url( $_image[0] ) . '"';
        $attr .= ' data-image-width="' . (int) $_image[1] . '"';
        $attr .= ' data-image-height="' . (int) $_image[2] . '"';

        ob_start();

        if( ! $image ) { return; }

        echo '<div class="pl-rail-item' . $class . '" style="' . $style . '"' . $id . $attr . '>';
            echo '<figure class="pl-rail-image"><span></span></figure>';
        echo '</div>';

        return ob_get_clean();

    }
}
new Playouts_Element_Rail_Slider_Item;*/
