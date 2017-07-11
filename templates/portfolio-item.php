<li class="pl-portfolio-item"<?php if( $gaps ) { echo " style='padding:0 " . (int) $gaps . "px " . (int) $gaps . "px 0;'"; } ?>>
    <div class="pl-portfolio-item-inner">
        <?php $gallery = get_post_meta( get_the_ID(), 'pportfolio_gallery', true ); ?>
        <?php if( has_post_thumbnail() or ! empty( $gallery ) ) : ?>
            <div class="pl-portfolio-featred">
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
                    ?>
                </a>
            </div>
        <?php endif; ?>
        <div class="pl-portfolio-item-content">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        </div>
    </div>
</li>
