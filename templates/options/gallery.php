<div class="pl-custom-meta-field pl-custom-meta-textfield">
    <div class="pl-meta-gallery">

        <label class="pl-meta-title" for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_attr( $field['title'] ); ?></label>

        <div class="pl-bottom-holder">
            <span class="pl-button pl-button-edit-gallery"><?php esc_html_e( 'Edit Gallery', 'peenapo-portfolio-txd' )?></span>
        </div>

        <input type="hidden"
            id="<?php echo esc_attr( $field_id ); ?>"
            class="pl-field-gallery-ids"
            name="<?php echo esc_attr( $field_id ); ?>"
            value="<?php echo esc_attr( get_post_meta( $post->ID, $field_id, true ) ); ?>">

        <div class="pl-meta-gallery-inner">
            <ul class="pl-meta-gallery-items pl-no-select"></ul>

            <div class="pl-spinner">
                <span class="pl-spinner__side pl-side--left"><span class="pl-spinner__fill"></span></span>
                <span class="pl-spinner__side pl-side--right"><span class="pl-spinner__fill"></span></span>
            </div>
        </div>

    </div>
</div>
