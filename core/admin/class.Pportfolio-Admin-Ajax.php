<?php

if ( ! defined( 'ABSPATH' ) ) { exit; } # exit if accessed directly

/*
 * admin ajax callbacks
 *
 *
 */
class Pportfolio_Admin_Ajax {

	/*
	 * ajax callabcks
	 *
	 */
	static $callbacks = array(
		/*
		 * get a preview for gallery field
		 *
		 */
		'__get_gallery_preview',
	);

	/*
	 * loop the callbacks and set the hooks
	 *
	 */
	static function init() {

		foreach( self::$callbacks as $callback ) {

			add_action( 'wp_ajax_nopriv_' . $callback, array( 'Pportfolio_Admin_Ajax', $callback ) );
			add_action( 'wp_ajax_' . $callback, array( 'Pportfolio_Admin_Ajax', $callback ) );

		}
	}

	/*
	 * get a preview for gallery field
	 *
	 */
	static function __get_gallery_preview() {

        $result = array( 'success' => false, 'output' => '' );

        $ids = isset( $_POST['attachments_ids'] ) ? $_POST['attachments_ids'] : null;

        $post_meta = get_post_meta( $_POST['post_id'], $_POST['field_name'], true );

        if( isset( $post_meta['items'] ) and is_array( $post_meta['items'] ) ) {
            $items_data = $post_meta['items'];
        }

        if( empty( $ids ) ) {
            die( json_encode( $result ) );
        }

        $default = array(
            'title' => '',
            'caption' => '',
            'video' => false,
            'video_url' => '',
            'video_autoplay' => false
        );

        foreach( explode( ',', $ids ) as $id ) {

            $attach = wp_get_attachment_image_src( $id, 'thumbnail', false );
            $item_data = array_merge( $default, isset( $items_data[$id] ) ? $items_data[$id] : array()  );

            $result["output"] .= '
            <li class="' . ( ( $item_data['video'] == true ) ? 'video' : '' ) . '">
                <div class="item-holder">
                    <img src="' . ( isset( $attach[0] ) ? $attach[0] : BW_URI_FRAME_ASSETS . 'img/admin/empty.png' ) . '">
                    <span class="fa fa-pencil"></span>
                </div>
            </li>';
        }

        $result["success"] = true;
        die( json_encode( $result ) );

	}

}

Pportfolio_Admin_Ajax::init();
