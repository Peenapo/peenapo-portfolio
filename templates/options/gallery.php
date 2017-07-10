<div class="pl-custom-meta-field pl-custom-meta-textfield">
    <div class="pl-meta-gallery">

        <label for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_attr( $field['title'] ); ?></label>

        <div class="bottom">
            <span class="btn add-items"><i class="fa fa-plus"></i><?php esc_html_e( 'Edit Gallery', 'peenapo-portfolio-txd' )?></span>
        </div>

        <input type="text"
            class="gallery-ids"
            id="<?php echo esc_attr( $field_id ); ?>"
            name="<?php echo esc_attr( $field_id ); ?>"
            value="<?php echo esc_attr( get_post_meta( $post->ID, $field_id, true ) ); ?>">

        <ul class="items"></ul>

        <i class="fa fa-refresh icon-spin"></i>

    </div>
</div>
