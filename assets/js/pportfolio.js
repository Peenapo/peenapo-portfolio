window.jQuery = window.$ = jQuery;

var $body = $('body');

var Pportfolio = {

    start: function() {

        this.isotope.start();
        this.carousel.start();

    },

    isotope: {

        start: function() {

            this.build();

        },

        build: function() {

            var $isotope_container = $('.pl-portfolio');

            $isotope_container.each(function() {

                var self = $(this);

                self.imagesLoaded(function() {

                    self.isotope({
                        speed: 200,
                        easing: 'ease-out',
                        itemSelector: '.pl-portfolio-item',
                        layoutMode: 'masonry',
                        isOriginLeft: ! $('body').hasClass('rtl'),
                        transitionDuration: '0.4s',
                        hiddenStyle: {
                            opacity: 0,
                            transform: 'scale(0.5)'
                        },
                        visibleStyle: {
                            opacity: 1,
                            transform: 'scale(1)'
                        }
                    });

                    var $filter = self.closest('.pl-portfolio-outer').find('.pl-filter');

                    if( $filter.length ) {

                        $( 'li', $filter ).on('click', Pportfolio.isotope.filter);

                    }

                });

            });

        },

        filter: function() {

            var self = $(this),
                $filter = self.closest('.pl-filter').find('li'),
                $portfolio = self.closest('.pl-portfolio-outer').find('.pl-portfolio');

            $filter.removeClass('pl-active');
            self.addClass('pl-active');

            $portfolio.isotope({ filter: self.attr('data-filter') });

        }

    }

    ,carousel: {

        index: [],
        autoplay_interval: [],

        start: function() {

            if( ! $('.pl-carousel').length ) { return; }

            Pportfolio.carousel.setImage();
            Pportfolio.carousel.bind();

        },

        set_interval: function( $carousel, index ) {

            clearTimeout( Pportfolio.carousel.autoplay_interval[ index ] );

            if( typeof $carousel.attr('data-autoplay') !== 'undefined' ) {
                Pportfolio.carousel.autoplay_interval[ index ] = setTimeout(function() {

                    $carousel.find('.pl-carousel-nav-next').trigger('click');
                    Pportfolio.carousel.set_interval( $carousel, index );

                }, $carousel.attr('data-autoplay') );
            }

        },

        setImage: function() {

            $('.pl-carousel').each(function(i) {

                var self = $(this);

                Pportfolio.carousel.index[i] = 0;

                var $currentSlide = $('.pl-carousel-slide', this).eq( 0 );

                if( $currentSlide.hasClass('pl-call-header-light') || $currentSlide.hasClass('pl-call-header-dark') ) {
                    $body.addClass( $currentSlide.hasClass('pl-call-header-light') ? 'pl-is-header-light' : 'pl-is-header-dark' );
                }

                Pportfolio.carousel.set_interval( self, i );

            });

            $('.pl-carousel-slide').each(function() {

                //collect the nodes
                var img = $('img', this);
                var parent = $(this);

                img.removeAttr('img').removeAttr('style');

                //set initial width
                img.attr( 'width', parent.width() );

                //if it's not enough, increase the width according to the height difference
                if ( img.height() < parent.height() ) {
                    img.css( 'width', img.width() * parent.height() / img.height() );
                }

                //position the image in the center
                img.css({
                    left: parseInt( ( img.width() - parent.width() ) / -2 ) + 'px',
                    top: parseInt( ( img.height() - parent.height() ) / -2 ) + 'px'
                });

            });

        },

        bind: function() {

            var $firstSlide = $('.pl-carousel-slide:eq(0)');

            $('.pl-carousel').on('click', '.pl-carousel-nav', Pportfolio.carousel.click)

        },

        click: function(e) {

            e.preventDefault();

            if( $('.pl-carousel-slide', $carousel).length <= 1 ) { return; }

            var $carousel = $(this).closest('.pl-carousel');
            var carousel_index = $('.pl-carousel').index( $carousel );

            if( $carousel.hasClass('pl-animate') ) { return; }

            var self = $(this);

            var dir = self.hasClass('pl-carousel-nav-next');

            var nextIndex = Pportfolio.carousel.index[ carousel_index ] + ( dir ? +1 : -1 );

            if( nextIndex >= $('.pl-carousel-slide', $carousel).length ) { nextIndex = 0; }
            if( nextIndex < 0 ) { nextIndex = $('.pl-carousel-slide', $carousel).length - 1; }

            Pportfolio.carousel.slide( $carousel, Pportfolio.carousel.index[ carousel_index ], nextIndex, dir );

            Pportfolio.carousel.index[ carousel_index ] = nextIndex;

            Pportfolio.carousel.set_interval( $carousel, carousel_index );

        },

        slide: function( $carousel, currentIndex, nextIndex, dir ) {

            $carousel.addClass('pl-animate pl-hide-title');

            if( $carousel.find('.pl-call-header-light, .pl-call-header-dark').length ) {
                $body.removeClass( 'pl-is-header-light pl-is-header-dark' );
            }

            setTimeout(function() {
                $carousel.removeClass('pl-hide-title');
            }, 500 );

            var $currentSlide = $('.pl-carousel-slide', $carousel).eq( currentIndex );
            var $nextSlide = $('.pl-carousel-slide', $carousel).eq( nextIndex );

            if( $nextSlide.hasClass('pl-call-header-light') || $nextSlide.hasClass('pl-call-header-dark') ) {
                setTimeout(function() {
                    $body.addClass( $nextSlide.hasClass('pl-call-header-light') ? 'pl-is-header-light' : 'pl-is-header-dark' );
                }, 300);
            }

            $('.pl-carousel-slide', $carousel).removeAttr('style');
            $currentSlide.css('z-index', 1);
            $nextSlide.css('z-index', 2);
            TweenLite.fromTo( $nextSlide, .8, {x: ( dir ? '100%' : '-100%' ) }, {x:'0%', ease: Power2.easeInOut, onComplete: function() {
                $carousel.removeClass('pl-animate');
            }});

            TweenLite.fromTo( $currentSlide, .8, {x:'0%'}, {x: ( dir ? '-30%' : '30%' ), ease: Power3.easeInOut });

        }

    }

}

Pportfolio.start();
