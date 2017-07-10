<?php

return array(

    'playouts_gallery' => array(
        'id' => 'peenapo_layouts_gallery_meta',
        'title' => __( 'My Tracks', 'peenapo-portfolio-txd' ),
        'callback' => array( 'Pportfolio_Meta_box', 'callback_gallery_meta' ),
        'fields' => array(

            'test_text' => array(
                'type' => 'textfield',
                'title' => __( 'Test', 'peenapo-portfolio-txd' ),
            ),

            'test_gallery' => array(
                'type' => 'gallery',
                'title' => __( 'Gallery', 'peenapo-portfolio-txd' ),
            ),

        )
    ),

);
