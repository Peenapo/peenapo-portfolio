<?php

return array(

    'playouts_portfolio' => array(
        'id' => 'peenapo_layouts_gallery_meta',
        'title' => __( 'Gallery Options', 'peenapo-portfolio-txd' ),
        'callback' => array( 'Pportfolio_Meta_box', 'callback_gallery_meta' ),
        'fields' => array(

            'pportfolio_gallery' => array(
                'type' => 'gallery',
                'title' => __( 'Gallery', 'peenapo-portfolio-txd' ),
            ),

        )
    ),

    /*'playouts_gallery' => array(
        'id' => 'peenapo_layouts_gallery_meta',
        'title' => __( 'Gallery Options', 'peenapo-portfolio-txd' ),
        'callback' => array( 'Pportfolio_Meta_box', 'callback_gallery_meta' ),
        'fields' => array(

            'pportfolio_gallery' => array(
                'type' => 'gallery',
                'title' => __( 'Gallery', 'peenapo-portfolio-txd' ),
            ),

        )
    )*/

);
