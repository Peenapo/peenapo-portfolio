<?php

/*
 * define the custom post types
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly

class Pportfolio_Post_Types {

    /*
	 *
	 *
	 */
	static function init() {

        add_action( 'init', array( 'Pportfolio_Post_Types', 'register' ) );

    }

	static function register() {

        /*
         * portfolio post type
         *
         */
        $plural_portfolio = esc_html__( 'Projects', 'linked-cartel' );
        $singular_portfolio = esc_html__( 'Project', 'linked-cartel' );

        $labels_portfolio = array(
            'name' 					    => $plural_portfolio,
            'singular_name' 		    => $singular_portfolio,
            'menu_name'                 => $plural_portfolio,
            'all_items'                 => sprintf( esc_html__( 'All %s', 'linked-cartel' ), $plural_portfolio ),
            'add_new' 				    => esc_html__( 'Add New', 'linked-cartel' ),
            'add_new_item' 			    => sprintf( esc_html__( 'Add %s', 'linked-cartel' ), $singular_portfolio ),
            'edit' 					    => esc_html__( 'Edit', 'linked-cartel' ),
            'edit_item' 			    => sprintf( esc_html__( 'Edit %s', 'linked-cartel' ), $singular_portfolio ),
            'new_item' 				    => sprintf( esc_html__( 'New %s', 'linked-cartel' ), $singular_portfolio ),
            'view' 					    => sprintf( esc_html__( 'View %s', 'linked-cartel' ), $singular_portfolio ),
            'view_item' 			    => sprintf( esc_html__( 'View %s', 'linked-cartel' ), $singular_portfolio ),
            'search_items' 			    => sprintf( esc_html__( 'Search %s', 'linked-cartel' ), $plural_portfolio ),
            'not_found' 			    => sprintf( esc_html__( 'No %s found', 'linked-cartel' ), $plural_portfolio ),
            'not_found_in_trash' 	    => sprintf( esc_html__( 'No %s found in trash', 'linked-cartel' ), $plural_portfolio ),
            'parent'                    => sprintf( esc_html__( 'Parent %s', 'linked-cartel' ), $singular_portfolio ),
        );

        $args_portfolio = array(
            'labels'                    => $labels_portfolio,
            'taxonomies'                => array( 'playouts_portfolio_category', 'post_tag' ),
            'public'                    => true,
            'publicly_queryable'        => true,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'query_var'                 => true,
            'rewrite'                   => array( 'slug' => 'project' ),
            'capability_type'           => 'post',
            'has_archive'               => true,
            'hierarchical'              => false,
            'menu_position'             => 25.1,
            'supports'                  => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
            'menu_icon'                 => 'dashicons-portfolio',
        );

        register_post_type( 'playouts_portfolio', $args_portfolio );

        /*
         * portfolio taxonomy
         *
         */
    	$portfolio_category_labels = array(
    		'name'                      => _x( 'Categories', 'taxonomy general name', 'peenapo-layouts-txd' ),
    		'singular_name'             => _x( 'Category', 'taxonomy singular name', 'peenapo-layouts-txd' ),
    		'search_items'              => __( 'Search Categories', 'peenapo-layouts-txd' ),
    		'popular_items'             => __( 'Popular Categories', 'peenapo-layouts-txd' ),
    		'all_items'                 => __( 'All Categories', 'peenapo-layouts-txd' ),
    		'parent_item'               => null,
    		'parent_item_colon'         => null,
    		'edit_item'                 => __( 'Edit Category', 'peenapo-layouts-txd' ),
    		'update_item'               => __( 'Update Category', 'peenapo-layouts-txd' ),
    		'add_new_item'              => __( 'Add New Category', 'peenapo-layouts-txd' ),
    		'new_item_name'             => __( 'New Category Name', 'peenapo-layouts-txd' ),
    		'separate_items_with_commas'=> __( 'Separate categories with commas', 'peenapo-layouts-txd' ),
    		'add_or_remove_items'       => __( 'Add or remove categories', 'peenapo-layouts-txd' ),
    		'choose_from_most_used'     => __( 'Choose from the most used categories', 'peenapo-layouts-txd' ),
    		'not_found'                 => __( 'No categories found.', 'peenapo-layouts-txd' ),
    		'menu_name'                 => __( 'Categories', 'peenapo-layouts-txd' ),
    	);
    	$portfolio_category_args = array(
            'hierarchical'              => false,
            'public'                    => false,
            'labels'                    => $portfolio_category_labels,
            'show_ui'                   => true,
            'show_admin_column'         => true,
            'query_var'                 => true,
            'rewrite'                   => array( 'slug' => 'project_category' ),
    	);
    	register_taxonomy( 'playouts_portfolio_category', 'playouts_portfolio', $portfolio_category_args );


        /*
         * gallery post type
         *
         */
        $plural_gallery = esc_html__( 'Galleries', 'linked-cartel' );
        $singular_gallery = esc_html__( 'Gallery', 'linked-cartel' );

        $labels_gallery = array(
            'name' 					    => $plural_gallery,
            'singular_name' 		    => $singular_gallery,
            'menu_name'                 => $plural_gallery,
            'all_items'                 => sprintf( esc_html__( 'All %s', 'linked-cartel' ), $plural_gallery ),
            'add_new' 				    => esc_html__( 'Add New', 'linked-cartel' ),
            'add_new_item' 			    => sprintf( esc_html__( 'Add %s', 'linked-cartel' ), $singular_gallery ),
            'edit' 					    => esc_html__( 'Edit', 'linked-cartel' ),
            'edit_item' 			    => sprintf( esc_html__( 'Edit %s', 'linked-cartel' ), $singular_gallery ),
            'new_item' 				    => sprintf( esc_html__( 'New %s', 'linked-cartel' ), $singular_gallery ),
            'view' 					    => sprintf( esc_html__( 'View %s', 'linked-cartel' ), $singular_gallery ),
            'view_item' 			    => sprintf( esc_html__( 'View %s', 'linked-cartel' ), $singular_gallery ),
            'search_items' 			    => sprintf( esc_html__( 'Search %s', 'linked-cartel' ), $plural_gallery ),
            'not_found' 			    => sprintf( esc_html__( 'No %s found', 'linked-cartel' ), $plural_gallery ),
            'not_found_in_trash' 	    => sprintf( esc_html__( 'No %s found in trash', 'linked-cartel' ), $plural_gallery ),
            'parent' 				    => sprintf( esc_html__( 'Parent %s', 'linked-cartel' ), $singular_gallery ),
        );

        $args_gallery = array(
            'labels'                    => $labels_gallery,
            'taxonomies'                => array( 'playouts_gallery_category' ),
            'public'                    => true,
            'publicly_queryable'        => true,
            'show_ui'                   => true,
            'show_in_menu'              => true,
            'query_var'                 => true,
            'rewrite'                   => array( 'slug' => 'gallery' ),
            'capability_type'           => 'post',
            'has_archive'               => true,
            'hierarchical'              => false,
            'menu_position'             => 25.2,
            'supports'                  => array( 'title', 'author', 'thumbnail', 'excerpt' ),
            'menu_icon'                 => 'dashicons-format-gallery',
        );

        register_post_type( 'playouts_gallery', $args_gallery );

        /*
         * gallery taxonomy
         *
         */
    	$gallery_category_labels = array(
    		'name'                      => _x( 'Categories', 'taxonomy general name', 'peenapo-layouts-txd' ),
    		'singular_name'             => _x( 'Category', 'taxonomy singular name', 'peenapo-layouts-txd' ),
    		'search_items'              => __( 'Search Categories', 'peenapo-layouts-txd' ),
    		'popular_items'             => __( 'Popular Categories', 'peenapo-layouts-txd' ),
    		'all_items'                 => __( 'All Categories', 'peenapo-layouts-txd' ),
    		'parent_item'               => null,
    		'parent_item_colon'         => null,
    		'edit_item'                 => __( 'Edit Category', 'peenapo-layouts-txd' ),
    		'update_item'               => __( 'Update Category', 'peenapo-layouts-txd' ),
    		'add_new_item'              => __( 'Add New Category', 'peenapo-layouts-txd' ),
    		'new_item_name'             => __( 'New Category Name', 'peenapo-layouts-txd' ),
    		'separate_items_with_commas'=> __( 'Separate categories with commas', 'peenapo-layouts-txd' ),
    		'add_or_remove_items'       => __( 'Add or remove categories', 'peenapo-layouts-txd' ),
    		'choose_from_most_used'     => __( 'Choose from the most used categories', 'peenapo-layouts-txd' ),
    		'not_found'                 => __( 'No categories found.', 'peenapo-layouts-txd' ),
    		'menu_name'                 => __( 'Categories', 'peenapo-layouts-txd' ),
    	);
    	$gallery_category_args = array(
            'hierarchical'              => false,
            'public'                    => false,
            'labels'                    => $gallery_category_labels,
            'show_ui'                   => true,
            'show_admin_column'         => true,
            'query_var'                 => true,
            'rewrite'                   => array( 'slug' => 'gallery_category' ),
    	);
    	register_taxonomy( 'playouts_gallery_category', 'playouts_gallery', $gallery_category_args );

    }

}

Pportfolio_Post_Types::init();
