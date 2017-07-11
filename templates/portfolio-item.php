<li class="pl-portfolio-item"<?php if( $gaps ) { echo " style='padding:0 " . (int) $gaps . "px " . (int) $gaps . "px 0;'"; } ?>>
    <div class="pl-portfolio-item-inner">
        <?php $gallery = get_post_meta( get_the_ID(), 'pportfolio_gallery', true ); ?>
        <?php if( has_post_thumbnail() or ! empty( $gallery ) ) : ?>
            <div class="pl-portfolio-image"<?php if( $title_position == 'after_image' ) { echo ' style="margin:0 0 30px 0;"'; } ?>>
                <a href="<?php the_permalink(); ?>">
                    <?php
                        if( has_post_thumbnail() ) {
                            the_post_thumbnail( $thumb_size );
                        }else{

                            if( ! empty( $gallery ) ) {
                                $gallery_ids = array_filter( explode( ',', $gallery ) );
                                echo wp_get_attachment_image( $gallery_ids[0], $thumb_size );
                            }
                        }

                        if( $enable_overlay ) {
                            echo '<div class="pl-portfolio-overlay"' . ( $overlay_bg_color ? ' style="background-color:' . esc_attr( $overlay_bg_color ) . ';"' : '' ) . '>';
                            if( $title_position == 'inside_image' ):
                                echo $_title;
                            endif;
                            echo '</div>';
                        }
                    ?>
                </a>
            </div>
        <?php endif; ?>
        <?php if( $title_position == 'after_image' ): ?>
            <?php echo $_title; ?>
        <?php endif; ?>
    </div>
</li>
