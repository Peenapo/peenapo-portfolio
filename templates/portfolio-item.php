<li class="pl-portfolio-item">
    <div class="pl-portfolio-featred">
        <?php
            if( has_post_thumbnail() ) {
                the_post_thumbnail( $thumb_size );
            }else{
                d( get_post_meta( get_the_ID(), 'pportfolio_gallery', true ) );
            }
        ?>
    </div>
</li>
