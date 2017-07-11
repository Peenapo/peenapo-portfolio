<article class="pl-single-project">

    <?php
        while ( have_posts() ) : the_post();

            $options = Playouts_Public::$options;

            $gallery_meta = get_post_meta( get_the_ID(), 'pportfolio_gallery', true );
            if( $gallery_meta ) {

                echo '<ul class="pl-project-gallery">';

                    $gallery_arr = array_filter( explode( ',', $gallery_meta ) );

                    foreach( $gallery_arr as $gallery_image_id ) {
                        echo '<li>';
                            echo wp_get_attachment_image( $gallery_image_id, ( isset( $options['portfolio_thumb_single'] ) and ! empty( $options['portfolio_thumb_single'] ) ) ? esc_attr( $options['portfolio_thumb_single'] ) : 'large' );
                        echo '</li>';
                    }

                echo '</ul>';

            }else{

                echo '<div class="pl-project-featured">';
                    the_post_thumbnail();
                echo '</div>';

            }

            the_content();

        endwhile;
    ?>

</article>
