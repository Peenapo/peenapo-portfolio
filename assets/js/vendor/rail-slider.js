window.jQuery = window.$ = jQuery;

var $body = $('body');

var Pportfolio_rail = {

    start: function() {

        this.bind();
        this.init();

    },

    bind: function() {

        $('.pl-rail-slider').on('click', '.pl-rail-item', Pportfolio_rail.on_slide_click );

        $('.pl-rail-slider').on('mousewheel', function (e) {
            var $slider = $(this);
            if( $slider.hasClass('pl-animate') ) { return; }
            if( e.originalEvent.deltaY < 0 ) {
                var index = $slider.find('.pl-rail-item').index( $slider.find('.pl-active').prev() );
            }else{
                var index = $slider.find('.pl-rail-item').index( $slider.find('.pl-active').next() );
            }
            Pportfolio_rail.focus( index, $slider );
        });

    },

    init: function() {

        $('.pl-rail-slider').each(function() {
            Pportfolio_rail.item( $('.pl-rail-item', this).eq(0), $(this) );
        });

    },

    item: function( self, $slider ) {

        var image = self.attr('data-image');
        var $image = $('<img src="' + image + '">');
        $image.imagesLoaded(function() {
            self.find('.pl-rail-image').html( $image );
            self.closest('.pl-rail-item').addClass('pl-loaded');
            if( $('.pl-rail-slider-inner', $slider).outerWidth() < $slider.outerWidth() ) {
                Pportfolio_rail.item( self.next('.pl-rail-item'), $slider );
            }else{
                Pportfolio_rail.set_offset_heights( $slider );
            }
        });

    },

    /*calc_rail_width: function( $slider ) {

        var total_width = 0;
        $slider.find('.pl-rail-item').each(function() {
            total_width += $(this).outerWidth();
        });
        $slider.find('.pl-rail-slider-inner').width( total_width );

    },*/

    set_offset_heights: function( $slider ) {

        if( $slider.find('.pl-rail-item:not(.pl-loaded)').length ) {
            $slider.find('.pl-rail-item:not(.pl-loaded)').each(function() {

                var self = $(this);
                var height = self.outerHeight();
                var data_width = parseInt( self.attr('data-image-width') );
                var data_height = parseInt( self.attr('data-image-height') );
                var dimentions = height / data_height;
                var _width = parseInt( dimentions * data_width );

                self.css( 'width', _width );

            }).promise().done( function() {
                //Pportfolio_rail.calc_rail_width( $slider );
                Pportfolio_rail.focus( 0, $slider, false );
            });
        }else{
            Pportfolio_rail.focus( 0, $slider, false );
        }

    },

    focus: function( index, $slider, animate = true ) {

        if( $slider.hasClass('pl-animate') ) { return; }

        var sliderWidth = $slider.outerWidth();
        var $inner = $slider.find('.pl-rail-slider-inner');
        var $to_focus = $slider.find('.pl-rail-item').eq( index );
        var focus_left = $to_focus.offset().left - $inner.offset().left;
        var slide_left = ( ( sliderWidth * .5 ) - ( $to_focus.outerWidth() * .5 ) ) - focus_left;

        $slider.find('.pl-rail-item').removeClass('pl-active');
        $to_focus.addClass('pl-active');

        if( animate ) {
            $slider.addClass('pl-animate');
            TweenLite.to( $inner, .17, { left: slide_left, ease: Power3.easeOut, onComplete: function() {
                $slider.removeClass('pl-animate');
                if( $('.pl-rail-item:not(.pl-loaded):first', $slider ).length ) {
                    Pportfolio_rail.check_appearance( $('.pl-rail-item:not(.pl-loaded):first', $slider ), $slider );
                }
            }});
        }else{
            TweenLite.set( $inner, { left: slide_left } );
        }

    },

    check_appearance: function( self, $slider ) {

        //console.log( $slider.outerWidth() );
        //console.log( $slider.find('.pl-rail-slider-inner').offset().left );
        console.log( self.offset().left );
        console.log( self.position().left );

        if( ( $slider.outerWidth() - $slider.find('.pl-rail-slider-inner').offset().left ) > self.position().left ) {

            var image = self.attr('data-image');
            var $image = $('<img src="' + image + '">');

            self.closest('.pl-rail-item').addClass('pl-loaded');
            //console.log( self.offset().left );
            //console.log( self.position().left );

            $image.imagesLoaded(function() {
                self.find('.pl-rail-image').html( $image );
            });

            if( self.next('.pl-rail-item').length ) {
                //Pportfolio_rail.check_appearance( self.next('.pl-rail-item'), $slider );
            }

        }

    },

    on_slide_click: function() {

        var $slider = $(this).closest('.pl-rail-slider');
        var index = $slider.find('.pl-rail-item').index( $(this) );

        Pportfolio_rail.focus( index, $slider );

    },

}

Pportfolio_rail.start();
