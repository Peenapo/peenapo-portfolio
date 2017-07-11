window.jQuery = window.$ = jQuery;

var Pportfolio = {

    start: function() {

        this.isotope.start();

    },

    isotope: {

        start: function() {

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
                });
            });

        }

    }

}

Pportfolio.start();
