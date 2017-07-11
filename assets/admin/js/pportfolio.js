window.jQuery = window.$ = jQuery;

var Pportfolio = {

    start: function() {

        if( $('.pl-meta-gallery').length ) {
            Pportfolio.gallery.init();
        }

    }

    ,gallery: {

        init: function() {

            Pportfolio.gallery.create();
            Pportfolio.gallery.get_preview();

        },

        create: function() {

            var $edit_button = $('.pl-button-edit-gallery');

            var frame = wp.media({
                displaySettings: false,
                id: 'bwgallery-frame',
                title: 'BwGallery',
                filterable: 'uploaded',
                frame: 'post',
                state: 'gallery-edit',
                library: {type: 'image'},
                multiple: true, // Set to true to allow multiple files to be selected
                editing: true,
                selection: Pportfolio.gallery.select()
            });

            $edit_button.on('click', function(e) {

                e.preventDefault();

                frame.on('update', function() {

                    var controller = frame.states.get('gallery-edit');
                    var library = controller.get('library');
                    var ids = library.pluck('id');

                    $('.pl-field-gallery-ids').val( ids.join(',') );

                    var items = '';

                    for ( var i = 0; i < ids.length; i++ ) {
                        items += '<li><div class="item">' + ids[i] + '</div></li>';
                    }

                    $('.pl-meta-gallery-items').html( items );

                    Pportfolio.gallery.get_preview();

                });

                frame.open();

            });

        },

        get_preview: function() {

            var $gallery = $('.pl-meta-gallery');

            $('.pl-meta-gallery').removeClass('pl-loaded');

            $.ajax({
                type: 'POST',
                url: pportfolio_data.ajax,
                data: {
                    action: '__get_gallery_preview',
                    attachments_ids: $('input', $gallery).val(),
                    field_key: $('.gallery-field', $gallery).val(),
                    post_id: $('.gallery-post', $gallery).val(),
                    field_name: $gallery.closest('.field').attr('data-field_name'),
                },
                beforeSend: function() {},
                success: function( response ) {

                    var result = JSON.parse( response );

                    if ( result.success ) {
                        $('.pl-gallery-welcome').remove();
                        $('.pl-meta-gallery-items').html(result.output);
                    }

                    if ( ! result.success && ! $('.pl-meta-gallery-items li').length ) {
                        $('.pl-meta-gallery-inner').append('<p class="pl-gallery-welcome">' + window.pportfolio_data.i18n.gallery_welcome + '</p>');
                    }

                    setTimeout(function() {
                        $('.pl-meta-gallery').addClass('pl-loaded');
                    }, 60);

                }
            });

        },

        select: function() {

            var galleries_ids = $('.pl-field-gallery-ids').val(),
                shortcode = wp.shortcode.next('gallery', '[gallery ids="' + galleries_ids + '"]'),
                defaultPostId = wp.media.gallery.defaults.id,
                attachments, selection;

            // bail if we didn't match the shortcode or all of the content.
            if ( ! shortcode ) { return; }

            // ignore the rest of the match object.
            shortcode = shortcode.shortcode;

            // no images, return false
            if ( shortcode.get('ids') == '' ) {
                return;
            }

            if ( _.isUndefined( shortcode.get('id') ) && ! _.isUndefined( defaultPostId ) )
                shortcode.set('id', defaultPostId);

            attachments = wp.media.gallery.attachments(shortcode);
            selection = new wp.media.model.Selection(attachments.models, {
                props: attachments.props.toJSON(),
                multiple: true
            });

            selection.gallery = attachments.gallery;

            // fetch the query's attachments, and then break ties from the
            // query to allow for sorting.
            selection.more().done(function() {

                // break ties with the query.
                selection.props.set({ query: false });
                selection.unmirror();
                selection.props.unset('orderby');

            });

            return selection;
        }

    },

}

Pportfolio.start();
