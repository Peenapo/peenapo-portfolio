window.jQuery = window.$ = jQuery;

var Pportfolio = {

    start: function() {

        this.isotope.start();

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

}

Pportfolio.start();
