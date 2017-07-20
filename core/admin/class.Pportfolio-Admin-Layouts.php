<?php

/*
 * class for portfolio layouts
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly


class Playouts_Layout_Portfolio_2_Cols_Boxed extends Playouts_Admin_Layout {

    function init() {

        $this->id = 'bw_layout_portfolio_2_cols_boxed';
        $this->name = esc_html__( 'Portfolio 2 Columns Boxed', 'peenapo-portfolio-txd' );
        $this->layout_view = 'row';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-portfolio-txd' ) );
        $this->image = PLAYOUTS_ASSEST . 'admin/images/__layouts/portfolio/2_cols_boxed.png';

    }

    static function output() {
        return '[bw_row row_layout="standard" overlay_bg_second="#f5f5f5" overlay_direction="top right" overlay_opacity="50" static_height="30" margin_top="150" margin_bottom="150"][bw_column overlay_bg_second="#f5f5f5" overlay_opacity="50"][bw_portfolio_grid cols="2" gaps="70" title_position="inside_image" title_size="28" text_alignment="left" enable_overlay="1" overlay_bg_color="rgba(234,53,53,0.63)" enable_category="1" enable_filter="1" filter_alignment="left"][/bw_portfolio_grid][/bw_column][/bw_row]';
    }
}
new Playouts_Layout_Portfolio_2_Cols_Boxed;



class Playouts_Layout_Portfolio_3_Cols_Wide extends Playouts_Admin_Layout {

    function init() {

        $this->id = 'bw_layout_portfolio_3_cols_wide';
        $this->name = esc_html__( 'Portfolio 3 Columns Wide', 'peenapo-portfolio-txd' );
        $this->layout_view = 'row';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-portfolio-txd' ) );
        $this->image = PLAYOUTS_ASSEST . 'admin/images/__layouts/portfolio/3_cols_wide.png';

    }

    static function output() {
        return '[bw_row row_layout="full" overlay_bg_second="#f5f5f5" overlay_direction="top right" overlay_opacity="50" static_height="30" margin_top="150" margin_bottom="150" padding_right="70" padding_left="70"][bw_column overlay_bg_second="#f5f5f5" overlay_opacity="50"][bw_portfolio_grid cols="3" gaps="70" title_position="inside_image" title_size="28" text_alignment="left" enable_overlay="1" overlay_bg_color="rgba(234,53,53,0.63)" enable_category="1" enable_filter="1" filter_alignment="left"][/bw_portfolio_grid][/bw_column][/bw_row]';
    }
}
new Playouts_Layout_Portfolio_3_Cols_Wide;



class Playouts_Layout_Portfolio_5_Cols_Wide extends Playouts_Admin_Layout {

    function init() {

        $this->id = 'bw_layout_portfolio_5_cols_wide';
        $this->name = esc_html__( 'Portfolio 5 Columns Wide', 'peenapo-portfolio-txd' );
        $this->layout_view = 'row';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-portfolio-txd' ) );
        $this->image = PLAYOUTS_ASSEST . 'admin/images/__layouts/portfolio/5_cols_wide.png';

    }

    static function output() {
        return '[bw_row row_layout="full" overlay_bg_second="#f5f5f5" overlay_direction="top right" overlay_opacity="50" static_height="30" margin_top="150" margin_bottom="150" padding_right="70" padding_left="70"][bw_column overlay_bg_second="#f5f5f5" overlay_opacity="50"][bw_portfolio_grid cols="5" gaps="70" title_position="after_image" title_size="20" text_alignment="left" enable_overlay="1" overlay_bg_color="rgba(255,255,255,0.75)" enable_filter="1" filter_alignment="left"][/bw_portfolio_grid][/bw_column][/bw_row]';
    }
}
new Playouts_Layout_Portfolio_5_Cols_Wide;



class Playouts_Layout_Portfolio_2_Cols_Boxed_Autotype extends Playouts_Admin_Layout {

    function init() {

        $this->id = 'bw_layout_portfolio_2_cols_boxed_autotype';
        $this->name = esc_html__( 'Portfolio 2 Columns Boxed with Autotype Text', 'peenapo-portfolio-txd' );
        $this->layout_view = 'row';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-portfolio-txd' ) );
        $this->image = PLAYOUTS_ASSEST . 'admin/images/__layouts/portfolio/2_cols_boxed_autotype.png';

    }

    static function output() {
        return '[bw_row row_layout="standard" background="color" bg_color="#f1f1f1" overlay_bg_second="#f5f5f5" overlay_direction="top right" overlay_opacity="50" vertical_alignment="center" enable_static_height="1" static_height="60"][bw_column overlay_bg_second="#f5f5f5" overlay_opacity="50"][bw_auto_type static_heading="Lorem ipsum dolor sit amet" h_tag="h2" font_size="90" bold_text="1"][bw_auto_type_item text="Curabitur viverra felis"][/bw_auto_type_item][bw_auto_type_item text="Etiam at dolor"][/bw_auto_type_item][bw_auto_type_item text="Fusce congue, tortor"][/bw_auto_type_item][/bw_auto_type][/bw_column][/bw_row][bw_row row_layout="standard" overlay_bg_second="#f5f5f5" overlay_direction="top right" overlay_opacity="50" static_height="30" margin_bottom="30"][bw_column overlay_bg_second="#f5f5f5" overlay_opacity="50"][bw_portfolio_grid cols="2" gaps="70" title_position="inside_image" title_size="28" text_alignment="left" enable_overlay="1" overlay_bg_color="rgba(234,53,53,0.63)" enable_category="1" enable_filter="1" filter_alignment="left"][/bw_portfolio_grid][/bw_column][/bw_row]';
    }
}
new Playouts_Layout_Portfolio_2_Cols_Boxed_Autotype;



class Playouts_Layout_Portfolio_2_Cols_Boxed_Heading extends Playouts_Admin_Layout {

    function init() {

        $this->id = 'bw_layout_portfolio_2_cols_boxed_heading';
        $this->name = esc_html__( 'Portfolio 2 Columns Boxed with heading Text', 'peenapo-portfolio-txd' );
        $this->layout_view = 'row';
        $this->category = array( 'portfolio' => __( 'Portfolio', 'peenapo-portfolio-txd' ) );
        $this->image = PLAYOUTS_ASSEST . 'admin/images/__layouts/portfolio/3_cols_boxed_heading.png';

    }

    static function output() {
        return '[bw_row row_layout="standard" overlay_bg_second="#f5f5f5" overlay_direction="top right" overlay_opacity="50" vertical_alignment="center" text_alignment="center" enable_static_height="1" static_height="100"][bw_column overlay_bg_second="#f5f5f5" overlay_opacity="50"][bw_heading title="HELLO" h_tag="h1" text_alignment="inherit" font_size_heading="120" font_size_content="15" font_size_top="15" bold_text="1" max_width="600" speed="450" delay="100"][/bw_heading][/bw_column][/bw_row][bw_row row_layout="standard" overlay_bg_second="#f5f5f5" overlay_opacity="50"][bw_column overlay_bg_second="#f5f5f5" overlay_opacity="50"][bw_portfolio_grid cols="3" gaps="90" title_position="inside_image" title_size="20" text_alignment="center" enable_overlay="1" overlay_bg_color="rgba(237,176,54,0.66)" enable_category="1" enable_filter="1" filter_alignment="left"][/bw_portfolio_grid][/bw_column][/bw_row]';
    }
}
new Playouts_Layout_Portfolio_2_Cols_Boxed_Heading;
