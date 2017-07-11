<?php

$thumbnail_sizes = get_intermediate_image_sizes();
$thumbnail_sizes_options = array();
foreach( $thumbnail_sizes as $thumb_size ) {
    $thumbnail_sizes_options[ $thumb_size ] = $thumb_size;
}

return array(

    'portfolio_slug' => array(
        'type'              => 'textfield',
        'label'             => esc_html__( 'Project Slug', 'peenapo-layouts-txd' ),
        'description'       => esc_html__( 'The slug of the project url. It is recommended to re-save the permalink format after you change ths option by going to Settings > Permalinks.', 'peenapo-layouts-txd' ),
        'placeholder'       => 'project',
    ),

    'portfolio_thumb_grid' => array(
        'type'              => 'select',
        'label'             => esc_html__( 'Grid Thumbnail Size', 'peenapo-layouts-txd' ),
        'description'       => esc_html__( 'Select the image size for the grid elements.', 'peenapo-layouts-txd' ),
        'options'           => $thumbnail_sizes_options,
        'value'             => 'large'
    ),

    'portfolio_thumb_single' => array(
        'type'              => 'select',
        'label'             => esc_html__( 'Single Thumbnail Size', 'peenapo-layouts-txd' ),
        'description'       => esc_html__( 'Select the image size for the single preview of the projects.', 'peenapo-layouts-txd' ),
        'options'           => $thumbnail_sizes_options,
        'value'             => 'large'
    ),

);
