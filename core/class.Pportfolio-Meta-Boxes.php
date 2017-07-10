<?php

/*
 * define the custom meta boxes
 * and add options when needed
 *
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly

class Pportfolio_Meta_Boxes {

    /*
	 * start the custom meta boxes
	 *
	 */
	static function init() {

        add_action( 'add_meta_boxes', array( 'Pportfolio_Meta_Boxes', 'dynamic_meta_box' ) );

        add_action( 'save_post', array( 'Pportfolio_Meta_Boxes', 'save_meta_box' ), 10, 2 );

    }

	static function dynamic_meta_box() {

        $meta_options = include PPORTFOLIO_DIR . 'inc/meta_options.php';

        $post_type = get_post_type();

        if( array_key_exists( $post_type, $meta_options ) ) {

            add_meta_box(
                $meta_options[ $post_type ]['id'],
                $meta_options[ $post_type ]['title'],
                array( 'Pportfolio_Meta_Boxes', 'dynamic_meta_box_callback' ),
                $post_type
            );

        }

    }

	static function dynamic_meta_box_callback( $post ) {

        $meta_options = include PPORTFOLIO_DIR . 'inc/meta_options.php';

        $post_type = get_post_type();

        echo '<div class="pl-custom-meta">';

        wp_nonce_field( 'pportfolio-meta-save', 'nonce_meta_save' );

        foreach( $meta_options[ $post_type ]['fields'] as $field_id => $field ) {

            $field_include = PPORTFOLIO_DIR . 'templates/options/' . esc_attr( $field['type'] ) . '.php';
            if( file_exists( $field_include ) ) {
                include $field_include;
            }
        }

        echo '</div>';

    }

	static function save_meta_box( $post_id, $post ) {

        // verify the nonce before proceeding
        if ( ! isset( $_POST['nonce_meta_save'] ) || ! wp_verify_nonce( $_POST['nonce_meta_save'], 'pportfolio-meta-save' ) ) { return; }

        // get the post type object
        $post_type = get_post_type_object( $post->post_type );

        $meta_options = include PPORTFOLIO_DIR . 'inc/meta_options.php';

        // check if the current user has permission to edit the post
        if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) { return; }

        // get the posted data and sanitize it for use as an HTML class
        foreach( $meta_options[ $post->post_type ]['fields'] as $field_id => $field ) {

            $$field_id = isset( $_POST[ $field_id ] ) ? sanitize_text_field( $_POST[ $field_id ] ) : '';

            // get the meta key
            $meta_key = $field_id;

            // get the meta value of the custom field key
            $meta_value = get_post_meta( $post_id, $meta_key, true );

            // if a new meta value was added and there was no previous value, add it
            if ( $$field_id && $meta_value == '' ) {
                add_post_meta( $post_id, $meta_key, $$field_id, true );
            }
            // if the new meta value does not match the old value, update it
            elseif ( $$field_id && $$field_id !== $meta_value ) {
                update_post_meta( $post_id, $meta_key, $$field_id );
            }
            // if there is no new meta value but an old value exists, delete it
            elseif ( $$field_id == '' && $meta_value ) {
                delete_post_meta( $post_id, $meta_key, $meta_value );
            }

        }

    }

}

Pportfolio_Meta_Boxes::init();
