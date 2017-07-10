<div class="pl-custom-meta-field pl-custom-meta-textfield">
    <label class="pl-meta-title" for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_attr( $field['title'] ); ?></label>
    <input class="widefat" type="text" name="<?php echo esc_attr( $field_id ); ?>" id="<?php echo esc_attr( $field_id ); ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, $field_id, true ) ); ?>" size="30" />
</div>
