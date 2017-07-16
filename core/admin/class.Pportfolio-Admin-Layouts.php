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
